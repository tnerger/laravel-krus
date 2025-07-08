<?php

namespace App\Http\Middleware;

use App\Models\Employer as ModelsEmployer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Employer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (null === $request->user() || null === $request->user()->employer) {
            return redirect()->route('employer.create')
                ->with('error', 'You need to Register as employer first!');
        }

        /* Kleines eigenes Middleware Experiment:
        * Wenn ein User den Account von einem anderen Employer aufruft, dann
        * Soll der User in SEINEN umgeleitet werden.
        */

        // Employer aus der Route parameter holen
        $employer = $request->route('employer');

        if ($request->user()->employer->id != $employer) {
            return redirect()->route('employer.job.index', $request->user()->employer)
                ->with('success', 'You have been successfully redirected to YOUR index ;-) ');
        }
        return $next($request);
    }
}
