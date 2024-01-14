<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\VisitAudit;

class VisitAuditor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ip = hash('sha512', $request->ip());
        $user_agent = $request->userAgent();
        $page = $request->page;

        if(!$page || !in_array($page, ['donate', 'forum'])) return $next($request);

        VisitAudit::create([
            'ip' => $ip,
            'user_agent' => $user_agent,
            'page' => $page
        ]);

        return $next($request);
    }
}
