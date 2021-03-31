<?php


namespace App\Helpers;


class MenuGenerationHelper
{
    public static function projChecker($perms, $name): bool
    {
        foreach ($perms as $i => $perm) {
            $temp = explode( '.', $perm->name);
            if (!strcmp($temp[0], $name)){
                return true;
            }
        }
        return false;
    }

    public static function wbChecker($perms, $name): bool
    {
        foreach ($perms as $perm) {
            $temp = explode( '.', $perm->name);
            if (count($temp) > 1 && !strcmp($temp[1], $name)){
                return true;
            }
        }
        return false;
    }

    public static function viewChecker($perms, $name): bool
    {
        foreach ($perms as $perm) {
            $temp = explode( '.', $perm->name);
            if (count($temp) > 2 && !strcmp($temp[2], $name)){
                return true;
            }
        }
        return false;
    }

    public static function generateSidebar($event){
        $projs = auth()->user()->getPermittedHierarchy();

        foreach ($projs as $proj) {
            $event->menu->add([
                'key' => $proj->name,
                'text' => strtoupper($proj->name)
            ]);
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
