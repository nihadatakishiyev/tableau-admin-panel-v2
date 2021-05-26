<?php

namespace App\Http\Controllers;

use App\Helpers\HomeContentHelper;
use App\Models\Project;
use App\Models\Tenant;
use App\Models\User;
use App\Models\View;
use App\Models\Workbook;
use App\Helpers\TrustedAuthHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;

class DashboardController extends Controller
{

    public function index(){
        $homeContentHelper = new HomeContentHelper(auth()->user()->getPermittedViews());

        return view('home')
            ->with('recents', $homeContentHelper->getRecentContent())
            ->with('recoms', $homeContentHelper->getRecommendationContent());
    }

    public function view(Project $proj, Workbook $wb, View $view){
        return TrustedAuthHelper::renderView($proj, $wb, $view);
    }

    public function test(){

        $projs = auth()->user()->getPermittedHierarchy();

        foreach ($projs as $proj) {
            echo $proj->name;
            foreach ($proj->workbooks as $workbook) {;
                if (count($workbook->views) == 1){
                    $event->menu->addIn($proj->name, [
                        'key' => $workbook->name,
                        'text' => $workbook->name,
                        'url' => url('/') .
                            '/dashboard/'
                            . $proj->id
                            . '/'. $workbook->id
                            . '/' . $workbook->views->first()->id,
                        'shift' => 'ml-2'
                    ]);
                }
                else if (count($workbook->views) > 1){
                    $event->menu->addIn($proj->name, [
                        'key' => $workbook->name,
                        'text' => $workbook->name,
                        'shift' => 'ml-2'
                    ]);

                    foreach ($workbook->views as $view) {
                        $event->menu->addIn($workbook->name, [
                            'text' => $view->name,
                            'url' => url('/') .
                                '/dashboard/'
                                . $proj->id
                                . '/'. $workbook->id
                                . '/' . $view->id,
                            'shift' => 'ml-4'
                        ]);
                    }
                }
            }
        }
    }
}

