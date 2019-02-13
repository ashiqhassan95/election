<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Cookie;

class CheckForVoterLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $strLength = strlen($request->getRequestUri());
        $electionSlug = substr($request->getRequestUri(), $strLength - 10, 10);
        if (!session()->has('voter_uid'))
            return redirect()->route('election.vote.login', $electionSlug);

        return $next($request);
    }
}
