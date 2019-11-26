<?php

namespace extravestibular\Http\Middleware;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use extravestibular\ApiLmts;

use Auth;

use Closure;

class ApiAuth
{

    // public $api = 'http://lmts.api/api/';
    public $api = 'http://app.uag.ufrpe.br/api/api/';


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
                $api = new ApiLmts();
                $check= $api->check();
                if($check){
                  return $next($request);
                }
                else{
                  // Auth::logout();
                  session(['tipo' => null, 'token_type' => null, 'name' => null, 'id' => null, 'email' => null, 'cursoId' => null]);
                  return redirect('login');
                }

              } catch (ClientException $e) {
                // Auth::logout();
                session(['tipo' => null, 'token_type' => null, 'name' => null, 'id' => null, 'email' => null, 'cursoId' => null]);
                return redirect('login');
                }
          // Auth::logout();
          session(['tipo' => null, 'token_type' => null, 'name' => null, 'id' => null, 'email' => null, 'cursoId' => null]);
          return redirect('login');
        }
    }


}
