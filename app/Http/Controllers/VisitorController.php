<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Visitor;
use App\Models\VisitAudit;

/**
 * @group 4. Visitor statistics
 * 
 * These endpoints are utilised by dashboard widgets
 */

class VisitorController extends Controller
{
    //

    /**
     * api/manage/stats/most_visited_top5/{from_date}/{to_date}
     * 
     * Gets the top 5 most visited pages. Results an array of
     * total_visits, page name
     * for the 5 most visited pages on interval [$from_date, $to_date]
     * 
     * @queryParam from_date string required Start date of looking up stats in Y-m-d format. (ex. 2021-03-31)
     * @queryParam to_date string required End date of looking up stats in Y-m-d format. (ex. 2021-03-31)
     * 
     * @authenticated
     */
    public function getTop5MostVisited($from_date, $to_date) {

        $visitors = Visitor::where([
            ['date', '>=', $from_date],
            ['date', '<=', $to_date]
        ])->selectRaw("count(distinct(ip)) as total_visit, raw_page")->groupBy(['raw_page'])
        ->orderBy('total_visit', 'desc')->limit(5)->get()->toArray();


        return $visitors;

    }

    /**
     * api/manage/stats/clicks/{from_date}/{to_date}
     * 
     * Gets the number of clicks per date.
     * Results an array of 
     * total_visits, date
     * on the interval [$from_date, $to_date]
     * 
     * @queryParam from_date string required Start date of looking up stats in Y-m-d format. (ex. 2021-03-31)
     * @queryParam to_date string required End date of looking up stats in Y-m-d format. (ex. 2021-03-31)
     * 
     * @authenticated
     */
    public function getClicksPerDay($from_date, $to_date) {
        $visitors = Visitor::where([
            ['date', '>=', $from_date],
            ['date', '<=', $to_date]
        ])->selectRaw("sum(count) as total_visit, date")->groupBy(['date'])
        ->orderBy('date', 'asc')->get()->toArray();

        return $visitors;
    }


    /**
     * api/manage/stats/visitors/{from_date}/{to_date}
     * 
     * Gets the number of unique visitors (by ip address).
     * Results an array of 
     * total_visits, date
     * on the interval [$from_date, $to_date]
     * 
     * @queryParam from_date string required Start date of looking up stats in Y-m-d format. (ex. 2021-03-31)
     * @queryParam to_date string required End date of looking up stats in Y-m-d format. (ex. 2021-03-31)
     * 
     * @authenticated
     */
    public function getUniqueVisitorsPerDay($from_date, $to_date) {
        $visitors = Visitor::where([
            ['date', '>=', $from_date],
            ['date', '<=', $to_date]
        ])->selectRaw("count(distinct(ip)) as total_visit, date")->groupBy(['date'])
        ->orderBy('date', 'asc')->get()->toArray();

        return $visitors;
    }

    /**
     * api/manage/stats/user_clicks/{from_date}/{to_date}
     * 
     * Gets the number of registered user interaction (clicks) per date.
     * Results an array of 
     * total_clicks, date
     * on the interval [$from_date, $to_date] for logged in users only.
     * 
     * @queryParam from_date string required Start date of looking up stats in Y-m-d format. (ex. 2021-03-31)
     * @queryParam to_date string required End date of looking up stats in Y-m-d format. (ex. 2021-03-31)
     * 
     * @authenticated
     */
    public function getRegisteredUserClicksPerDay($from_date, $to_date) {
        $visitors = Visitor::where([
            ['date', '>=', $from_date],
            ['date', '<=', $to_date],
            ['user_id', '<>', '',' and']
        ])->selectRaw("sum(count) as total_visit, date")->groupBy(['date'])
        ->orderBy('date', 'asc')->get()->toArray();

        return $visitors;
    }


    /**
     * api/manage/stats/user_top5/{from_date}/{to_date}
     * 
     * Gets the top5 most interacting users in the range [$from_date, $to_date]
     * Results an array of 
     * total_visit, email
     * 
     * @queryParam from_date string required Start date of looking up stats in Y-m-d format. (ex. 2021-03-31)
     * @queryParam to_date string required End date of looking up stats in Y-m-d format. (ex. 2021-03-31)
     * 
     * @authenticated
     */
    public function getTop5MostInteractive($from_date, $to_date) {
        $visitors = Visitor::where([
            ['date', '>=', $from_date],
            ['date', '<=', $to_date],
            ['user_id', '<>', '',' and']
        ])->join('users', 'user_id', 'users.id')
        ->selectRaw("sum(count) as total_visit, users.email")->groupBy(['user_id'])
        ->orderBy('total_visit', 'desc')->limit(5)->get()->toArray();

        return $visitors;
    }


    /**
     * 
     */
    public function getClickThroughPerDay($from_date, $to_date) {
        $visitors = VisitAudit::where([
            ['created_at', '>=', $from_date],
            ['created_at', '<=', $to_date]
        ])->selectRaw("count(distinct(ip)) as total_visit, date(created_at) as date, page")
        ->groupBy(['page', \DB::raw('date(created_at)')])->orderBy(\DB::raw('date(created_at)'), 'asc')->get()->toArray();

        return $visitors;
    }


    public function getReadTimePerDay($from_date, $to_date) {
        $visitors = Visitor::whereNull('user_id')->where([
            ['date', '>=', $from_date],
            ['date', '<=', $to_date],
            ['raw_page', 'like', '%/document/deu/%']
        ])->selectRaw('count(id) minutes_read, date, raw_page')
        ->groupBy(['raw_page', 'date'])->orderBy('date', 'asc')->get()->toArray();

        return $visitors;
    }
}
