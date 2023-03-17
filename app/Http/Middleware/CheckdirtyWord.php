<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckdirtyWord
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
        $dirtyWords = ['apple', 'orange'];
        $req = $request->all();

        foreach ($req as $key => $value) {
            if ($key === 'name') {
                foreach ($dirtyWords as $dirtyWord) {
                    if (strpos($value, $dirtyWord) !== false) {
                        return response('dirty!', 400);
                    }
                }
            }
        }
        return $next($request);
    }
}
