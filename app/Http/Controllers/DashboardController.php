<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\View;
use App\Models\Workbook;
use App\Helpers\TrustedAuthHelper;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;

class DashboardController extends Controller
{

    public function index(){
        $dashboards = [
           'dashboard1' => [
               'name' => 'MyGov',
               'hour' => '4 hours ago'
           ],
            'dashboard2' => [
               'name' => 'Asan Finance lorem ipsum doler sit amet',
               'hour' => '2 hours ago'
           ],
            'dashboard3' => [
               'name' => 'EGov',
               'hour' => '3 hours ago'
           ],
            'dashboard4' => [
               'name' => 'AsanPay',
               'hour' => '1 hour ago'
           ],
        ];

        $projs = auth()->user()->getPermittedHierarchy();
        $view_ids = [];

        foreach ($projs as $proj) {
            foreach ($proj->workbooks as $wb){
                foreach ($wb->views as $view){
                    array_push($view_ids, $view->id);
                }
            }
        }

        $recents = DB::select('select p.user_id, v.name, p.page_url, TIMESTAMPDIFF(SECOND , max(p.created_at), now()) seconds
                        from page_visit_logs p
                        left join views v on v.id = reverse(left(REVERSE(page_url), locate(\'/\', REVERSE(page_url)) -1))
                        where user_id =' . auth()->id() . ' and page_url REGEXP \'/dashboard/[0-9]/[0-9]/[0-9]\'
                        and reverse(left(REVERSE(page_url), locate(\'/\', REVERSE(page_url)) -1)) in (' . implode(',', $view_ids) . ')
                        group by user_id, page_url, v.name
                        order by max(p.created_at) desc
                        limit 4');

        foreach ($recents as $recent){
            if ($recent->seconds < 60){
                $recent->seconds = 'few seconds ago';
            }
            else if ($recent->seconds < 3600){
                $recent->seconds = round($recent->seconds/60) . ngettext(' minute', ' minutes', $recent->seconds/60) . ' ago';
            }
            else if ($recent->seconds < 86400){
                $recent->seconds = round($recent->seconds/3600) . ngettext(' hour', ' hours', $recent->seconds/60) . ' ago';
            }
            else {
                $recent->seconds = round($recent->seconds/24/3600) . ngettext(' day', ' days', $recent->seconds/24/3600) . ' ago';
            }
        }

        return view('home')->with('dashboards', $dashboards)->with('recents', $recents);

    }

    public function view(Project $proj, Workbook $wb, View $view){
        return TrustedAuthHelper::renderView($proj, $wb, $view);
    }

    public function test(){

        $pathToImage = public_path('\screenshot.png');

        Browsershot::url('http://google.com')
            ->setNodeBinary('C:\Programs\nodejs\node.exe')
//            ->setNpmBinary('C:\Users\n.atakishiyev\AppData\Roamingg\npm')
            ->save($pathToImage);
    }
}

