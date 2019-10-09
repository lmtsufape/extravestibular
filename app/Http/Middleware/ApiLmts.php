<?php

namespace extravestibular\Http\Middleware;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use Auth;

use Closure;

class ApiLmts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public $api = 'lmts.api/api/';
    // public $api = 'http://app.uag.ufrpe.br/api/api/';


    public function handle($request, Closure $next)
    {
        if(Auth::check()){
          return $next($request);
        }
        else{
          try {
              $client = new Client(); //GuzzleHttp\Client
              $response = $client->request('GET',$this->api . 'curso/', ['headers' => [
                                                                           'Authorization' => session('token_type').' '.session('access_token'),
                                                                           'Content-Type' => 'application/json',
                                                                           'X-Requested-With' => 'XMLHttpRequest'
                                                                          ]
                                                                      ]);
              if($response->getStatusCode() == 201){
                return $next($request);
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
