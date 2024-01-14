<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use Crawler;
use Auth;
use App\Models\Visitor;

class VisitorCounter extends Middleware
{
    /**
     * Handle an incoming request
     * 
     * @param \Illuminate\Http\Request $req
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, bool $enableGrouping = true) {
        //Adding special endpoints where we want to store what the request actually
        //means where its not wildly obvious
        $page_mappings = array(
            "/api/login/validate" => "index_logged_in_user",
            "/" => "/home"
        );

        $referer = $request->header('referer');
        $parsed = parse_url($referer);
        if(isset($parsed['path'])) {
            $referer = $parsed['path'];
        } else {
            $referer = 'BEACON PINGED FROM OUTSIDE';
        }

        if(!Crawler::isCrawler()) {
            $endpoint = $request->getPathInfo();
            if($endpoint == '/') $endpoint = "/home";
            if($endpoint == '/api/beacon') $endpoint = $referer;

            $logged_in = Auth::user();
            $user_id = null;
            if($logged_in !== null) {
                $user_id = $logged_in->id;
            }
            
            $ip = hash('sha512', $request->ip());
            $conditions = [
                ['ip', $ip], 
                ['raw_page', $endpoint]
            ];
            if($user_id !== null) {
                $conditions[] = ['user_id', $user_id];
            }
            
            if(Visitor::where('date', today())->where($conditions)->count() < 1 || !$enableGrouping) {
                Visitor::create([
                    'date' => today(),
                    'ip' => $ip,
                    'raw_page' => $endpoint,
                    'actual_page' => (isset($page_mappings[$endpoint]) ? $page_mappings[$endpoint] : $endpoint),
                    'count' => 1,
                    'user_id' => $user_id
                ]);
            } else {
                $visitor = Visitor::where('date', today())->where($conditions)->first();
                $visitor->count = $visitor->count+1;
                $visitor->save();
            }

        }


        return $next($request);
    }
}
