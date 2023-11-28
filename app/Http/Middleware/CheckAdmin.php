<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!session()->has("admin")) {

            return redirect('/');
        }
        else {

            $checkAdmin = Admin::where("id" , session("admin"))->get();
            if($checkAdmin->count() == 0) {

                return redirect('/');
            }
        }

        return $next($request);
    }
}
