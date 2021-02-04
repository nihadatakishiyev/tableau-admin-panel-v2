<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Http;

class ApiAuthHelper
{
    private static $url = 'http://192.168.20.213/api/3.9/auth/signin';

    public static function getAuthToken(){
        $req = Http::withHeaders([
            'Content' => 'application/json'
        ])->post(self::$url, [
            'credentials' => [
                'name' => 'ehim.analytics',
                'password' => 'Ld!@M21%bn20',
                'site' => [
                    'contentUrl' => ''
                ]
            ]
        ]);
    }
}
