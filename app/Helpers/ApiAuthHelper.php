<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Http;

class ApiAuthHelper
{
    private static $url = 'http://192.168.20.213/api/3.9/auth/signin';

    public static function getAuthToken(){
        $res = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post(self::$url, [
            'credentials' => [
                'name' => 'ehim.analytics',
                'password' => 'Ld!@M21%bn20',
                'site' => [
                    'contentUrl' => ''
                ]
            ]
        ])->body();

        return json_decode($res)->credentials->token;
    }
}
