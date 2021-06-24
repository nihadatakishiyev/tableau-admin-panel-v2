<?php


namespace App\Helpers;


class MenuGenerationHelper
{
    public static function projChecker($perms, $name): bool
    {
        foreach ($perms as $perm) {
            $temp = explode( '.', $perm->name);
            if (abs(!strcmp($temp[0], $name))){
                return true;
            }
        }
        return false;
    }

    public static function wbChecker($perms, $name): bool // $perms, workbook->name
    {
        foreach ($perms as $perm) {
            $temp = explode( '.', $perm->name);
            if (count($temp) > 1 && abs(!strcmp($temp[1], $name))){
                return true; //if user has no permission
            }
        }
        return false; // if user has permission
    }

    public static function viewChecker($perms, $name): bool
    {
        foreach ($perms as $perm) {
            $temp = explode( '.', $perm->name);
            if (count($temp) > 2 && abs(!strcmp($temp[2], $name))){
                return true;
            }
        }
        return false;
    }

    public static function generateSidebar($event){
        $projs = auth()->user()->getPermittedHierarchy();

        foreach ($projs as $proj) {
            $event->menu->add([
                'key' => 'proj' . $proj->id,
                'text' => mb_strtoupper($proj->name),
                'icon' => 'fas fa-project-diagram'
            ]);
            foreach ($proj->workbooks as $workbook) {
                if (count($workbook->views) == 1){
                    $event->menu->addIn('proj' . $proj->id, [
                        'key' => 'wb' . $workbook->id,
                        'text' => $workbook->name,
                        'url' => url('/') . '/dashboard/' . $proj->id . '/'. $workbook->id . '/' . $workbook->views->first()->id,
                        'shift' => 'ml-2',
                        'icon' => 'fas fa-book'
                    ]);
                }
                else {
                    $event->menu->addIn('proj' . $proj->id, [
                        'key' => 'wb' . $workbook->id,
                        'text' => $workbook->name,
                        'shift' => 'ml-2',
                        'icon' => 'fas fa-book'
                    ]);
                    foreach ($workbook->views as $view) {
                        $event->menu->addIn('wb' . $workbook->id, [
                            'text' => $view->name,
                            'url' => url('/') . '/dashboard/' . $proj->id . '/'. $workbook->id . '/' . $view->id,
                            'shift' => 'ml-4',
                            'icon' => 'fas fa-file'
                        ]);
                    }
                }
            }
        }
    }

    public static function generateSidebarOld($event)
    {
        $projs = auth()->user()->getPermittedHierarchy();

        foreach ($projs as $proj){
            $event->menu->add([
                'header' => strtoupper($proj->name),
            ]);
            foreach ($proj->workbooks as $workbook){
                $arr = [];
                foreach ($workbook->views as $view){
                    array_push($arr, [
                        'text' => $view->name,
                        'id' => $view->id,
                        'url' => url('/') .
                            '/dashboard/'
                            . $proj->id
                            . '/'. $workbook->id
                            . '/'. $view->id,
                        'shift' => 'ml-3'
                    ]);
                }
                if (sizeof($arr) > 1){
                    $event->menu->add([
                        'key' => $workbook->name,
                        'text' => $workbook->name,
                        'submenu' => $arr
                    ]);
                } else if (sizeof($arr) == 1){
                    $event->menu->add([
                        'key' => $workbook->name,
                        'text' => $workbook->name,
                        'url' => url('/') .
                            '/dashboard/'
                            . $proj->id
                            . '/'. $workbook->id
                            . '/' . $arr[0]['id'],
                    ]);
                }
            }
        }
    }
}
