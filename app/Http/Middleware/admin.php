<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth ;
use App\Traits\ApiResponser ;



use Closure;

class admin
{
    use ApiResponser;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role_id == 'admin'){
        return $next($request); }
        return $this->success('','You don\'t have access privileges',);

    }
}
