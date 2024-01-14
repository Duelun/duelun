<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Processors\AwsStats;
use App\Models\ContactAudit;

class DashboardController extends Controller
{
    //

    public function index(Request $request) {
        $start_date = $request->query('start_date') ?? date("Y-m-01");
        $end_date = $request->query('end_date') ?? date("Y-m-t");
        //$p = new AwsStats('05','2021','duelun.com');
        //dd($p->data);

        $created_data = $this->getData($start_date, $end_date);

        $emails_received = $this->getEmailReceivedThisWeek();
        $emails_blocked = $this->getEmailBlockedThisWeek();

        $data = [
            "start_date" => $start_date,
            "end_date" => $end_date,
            "emails_received" => $emails_received,
            "emails_blocked" => $emails_blocked,
            "daily_visitors" => $created_data[0],
            "top5" => $created_data[1],
            "clickthrough" => $created_data[2],
            "readtime" => $created_data[3]
        ];

        return view('dashboard')->with('data', $data);
    }

    private function processDaily($unique_daily_visitors) {
        $processed_daily = array(
            "labels" => array(),
            "data" => array()
        );
        foreach($unique_daily_visitors as $items) {
            $processed_daily["labels"][] = $items["date"];
            $processed_daily["data"][] = $items['total_visit'];
        }
        return $processed_daily;
    }
    private function processTop5($top5) {
        $processed_top5 = array(
            "labels" => array(),
            "data" => array()
        );
        foreach($top5 as $items) {
            $processed_top5["labels"][] = urldecode($items["raw_page"]);
            $processed_top5["data"][] = $items['total_visit'];
        }
        return $processed_top5;
    }
    private function processClickthrough($clickthrough) {
        $processed_clickthrough = array(
            "labels" => array(),
            "data" => array()
        );
        foreach($clickthrough as $c) {
            if(!in_array($c["date"], $processed_clickthrough["labels"])) {
                $processed_clickthrough["labels"][] = $c["date"];
            }
            $page = ucfirst($c['page']);
            if(!isset($processed_clickthrough["data"][$page])) {
                $processed_clickthrough["data"][$page] = [];
            }
            $processed_clickthrough["data"][$page][] = $c["total_visit"];

        }
        return $processed_clickthrough;
    }
    private function processReadTime($start_date, $readtime) {
        $processed = array(
            "labels" => array(),
            "data" => array()
        );

        //Make sure we have all dates
        $begin = new \DateTime( $start_date );
        $end   = new \DateTime( date("Y-m-d") );
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $processed["labels"][] = $i->format("Y-m-d");
        }

        //First process so we have doc => [date] arr
        $per_doc = [];
        foreach($readtime as $obj) {
            $page = urldecode(explode("/document/deu/", $obj['raw_page'])[1]);
            if(!isset($per_doc[$page])) $per_doc[$page] = [];
            $per_doc[$page][$obj["date"]] = (int)$obj['minutes_read'];
        }
        //Now for each document
        foreach($per_doc as $doc => $arr) {
            //Go through all the dates we have in order
            foreach($processed["labels"] as $date) {
                //Check if we have data for the date in the temporary structure, if not
                //then push 0, otherwise the minutes read
                if(!isset($per_doc[$doc][$date])) {
                    $processed["data"][$doc][] = 0;
                } else {
                    $processed["data"][$doc][] = $per_doc[$doc][$date];
                }
            }
        }
        return $processed;
    }

    public function getData($start_date, $end_date) {
        $unique_daily_visitors = app("App\Http\Controllers\VisitorController")->getUniqueVisitorsPerDay($start_date, $end_date);
        $top5 = app("App\Http\Controllers\VisitorController")->getTop5MostVisited($start_date, $end_date);
        $clickthrough = app("App\Http\Controllers\VisitorController")->getClickThroughPerDay($start_date, $end_date);
        $readtime = app("App\Http\Controllers\VisitorController")->getReadTimePerDay($start_date, $end_date);

        $processed_daily = $this->processDaily($unique_daily_visitors);
        $processed_top5 = $this->processTop5($top5);
        $processed_clickthrough = $this->processClickthrough($clickthrough);
        $processed_readtime = $this->processReadTime($start_date, $readtime);

        return [$processed_daily, $processed_top5, $processed_clickthrough, $processed_readtime];
    }

    public function getEmailReceivedThisWeek() {
        $audit = ContactAudit::where([
            [\DB::raw('created_at'), '>=', \DB::raw('DATE_SUB(NOW(), INTERVAL 1 WEEK)')]
        ])->selectRaw('count(id) as cnt')->groupBy([\DB::raw('week(created_at)')])->get()->toArray();

        return $audit[0]['cnt'] ?? 0;
    }

    public function getEmailBlockedThisWeek() {
        $audit = ContactAudit::where([
            [\DB::raw('created_at'), '>=', \DB::raw('DATE_SUB(NOW(), INTERVAL 1 WEEK)')],
            ['is_blocked', '=', '1']
        ])->selectRaw('count(id) as cnt')->groupBy([\DB::raw('week(created_at)')])->get()->toArray();

        return $audit[0]['cnt'] ?? 0;
    }
}
