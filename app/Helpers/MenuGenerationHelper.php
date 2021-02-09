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

    public static function generateAdminLte($event){
        $projs = auth()->user()->getContent();

        foreach ($projs as $proj){
            $event->menu->add([
                'header' => strtoupper($proj->name),
            ]);
            foreach ($proj->workbooks as $workbook){
                $arr = [];
                foreach ($workbook->views as $view){
                    array_push($arr, [
                        'text' => $view->name,
                        'url' => '/'
                            . $proj->id
                            . '/'. $workbook->id
                            . '/'. $view->id,
                        'shift' => 'ml-3'
                    ]);
                }
                $event->menu->add([
                    'key' => $workbook->name,
                    'text' => $workbook->name,
                    'submenu' => $arr
                ]);
            }
        }
    }
}
