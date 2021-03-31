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
}
