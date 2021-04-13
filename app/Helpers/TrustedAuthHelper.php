<?php

namespace App\Helpers;

use App\Models\Project;
use App\Models\View;
use App\Models\Workbook;
use Illuminate\Support\Facades\Http;

class TrustedAuthHelper {

    private static function get_trusted_ticket(): string
    {
        $address = config('services.tableau.address');
        return Http::asForm()->post("http://$address/trusted", [
            'username' => config('services.tableau.user'),
        ])->body();
    }

    private static function get_trusted_url($view_url, $existsValidTicket): string
    {
        $params = config('services.tableau.params');

        if ($existsValidTicket){
            return "views/$view_url?$params";
        }

        $ticket = self::get_trusted_ticket();

        if ($ticket < 0)
            throw new \Exception("Server did not return a valid ticket");

        auth()->user()->setTicketCookie();

        return "trusted/$ticket/views/$view_url?$params";
    }

    public static function renderView(Project $proj, Workbook $wb, View $view){
            if ($view->workbook_id == $wb->id && $wb->project_id == $proj->id && auth()->user()->can($proj->name . '.' . $wb->name . '.' . $view->name)){
                try {
                    auth()->user()->existsValidTicket() ?
                        $url = self::get_trusted_url( $view->tableau_url, 1)
                        :$url = self::get_trusted_url($view->tableau_url, 0);
                }  catch (\Exception $e){
                    abort(500);
//                        return $e->getMessage();
                }
                return view('renderView')->with('url', $url);
            }
            abort(404);
    }
}
