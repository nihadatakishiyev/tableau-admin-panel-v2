<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class RestApiAuthHelper
{
    public static function getAuthToken(){
        $res = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post(config('services.tableau_restapi.url'), [
            'credentials' => [
                'name' => config('services.tableau_restapi.username'),
                'password' => config('services.tableau_restapi.password'),
                'site' => [
                    'contentUrl' => ''
                ]
            ]
        ])->body();

        return json_decode($res)->credentials->token;
    }

    public static function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}
