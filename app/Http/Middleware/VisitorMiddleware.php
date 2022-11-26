<?php

namespace App\Http\Middleware;

use App\Models\UserAgent;
use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class VisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $requestUserAgent = $request->header('User-Agent');
        $requestIpAddress = $request->ip();

        $agent = new Agent();
        $agent->setUserAgent($requestUserAgent);
        $userAgent = UserAgent::firstOrCreate([
            'device' => $agent->device() ?: null,
            'platform' => $agent->platform() ?: null,
            'browser' => $agent->browser() ?: null,
            'robot' => $agent->robot() ?: null,
            'is_desktop' => $agent->isDesktop(),
            'is_phone' => $agent->isPhone(),
            'is_robot' => $agent->isRobot(),
        ]);

        $visitor = Visitor::firstOrCreate([
            'user_agent_id' => $userAgent->id,
            'ip_address' => $requestIpAddress,
        ]);
        $visitor->requests += 1;
        $visitor->update();

        return $next($request);
    }
}
