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
                // $client = new Client(); //GuzzleHttp\Client
                // $headers  =[
                //              'Content-Type' => 'application/json',
                //              'X-Requested-With' => 'XMLHttpRequest',
                //              'Authorization' => 'Bearer '.session('access_token'),
                //            ];
                // $response = $client->request('GET','http://lmts.api/api/curso/', ['headers' => $headers]);
                $api = new ApiLmts();
                $check= $api->check();
                // if($response->getStatusCode() == 201){
                //   return $next($request);
                // }
                if($check){
                  return $next($request);
                }
                else{
                  Auth::logout();
                  session(['tipo' => null, 'token_type' => null, 'name' => null, 'id' => null, 'email' => null, 'cursoId' => null]);
                  return $next($request);
                }

              } catch (ClientException $e) {
                Auth::logout();
                session(['tipo' => null, 'token_type' => null, 'name' => null, 'id' => null, 'email' => null, 'cursoId' => null]);
                return $next($request);
                }
          Auth::logout();
          session(['tipo' => null, 'token_type' => null, 'name' => null, 'id' => null, 'email' => null, 'cursoId' => null]);
          return $next($request);


        }
    }


}
