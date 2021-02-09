<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class TrustedAuthHelper {

    public static function get_trusted_ticket($wgserver, $user) {

        $ticket = Http::asForm()->post("http://$wgserver/trusted", [
            'username' => $user,
        ])->body();

        return $ticket;
    }

    public static function get_trusted_url($user, $server, $view_url, $site) {
        $params = ':embed=yes&:toolbar=yes&:tabs=no';
        $ticket = self::get_trusted_ticket($server, $user);

        return "http://$server/trusted/$ticket/$view_url?$params";
    }
}
