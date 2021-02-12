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

    public static function get_trusted_url($user, $server, $view_url, $existsValidTicket) {
        $params = ':embed=yes&:toolbar=yes&:tabs=no';

        if ($existsValidTicket){
            return "/$view_url?$params";
        }
        else {
            $ticket = self::get_trusted_ticket($server, $user);
            auth()->user()->setTicketCookie();
        }

        if ($ticket < 0)
            throw new \Exception("Server did not return a valid ticket");

        return "trusted/$ticket/$view_url?$params";
    }
}
