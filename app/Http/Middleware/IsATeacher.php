<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsATeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role !== 'teacher') {
                return redirect("/");
            }
        }

        return $next($request);
    }
}
