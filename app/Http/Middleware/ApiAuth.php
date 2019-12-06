<?php

namespace App\Http\Middleware;

use Lmts\src\controller\LmtsApi;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;

use Auth;

use Closure;

class ApiAuth{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
          return $next($request);
        }
        else{
          try {
                $api = new LmtsApi();
                $check= $api->check();
                if($check){
                  return $next($request);
                }
                else{
                  session(['tipo' => null, 'token_type' => null, 'name' => null, 'id' => null, 'email' => null, 'cursoId' => null]);
                  return redirect('login');
                }

              } catch (ClientException $e) {
                session(['tipo' => null, 'token_type' => null, 'name' => null, 'id' => null, 'email' => null, 'cursoId' => null]);
                return redirect('login');
                }
          session(['tipo' => null, 'token_type' => null, 'name' => null, 'id' => null, 'email' => null, 'cursoId' => null]);
          return redirect('login');
        }
    }


}
