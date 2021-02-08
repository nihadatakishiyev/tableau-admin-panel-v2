<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CrudTrait, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'department_id',
        'unit_id',
        'position_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static $logAttributes = ['name', 'department_id', 'unit_id', 'position_id', 'email'];

    protected static $ignoreChangedAttributes = ['password', 'remember_token', 'updated_at'];

//    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'user';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} user";
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function getSidebar(){
         $trees = Project::with('workbooks', 'workbooks.views')->get();
         $perms = $this->getPermissionsViaRoles();
         $res = [];
        foreach ($perms as $perm){
            $arr = explode('.', $perm->name);
            if (sizeof($arr) == 1){
                foreach ($trees as $tree)
                    if ($tree->name == $perm->name){
//                        return $content = $tree;
                        array_push($res, $tree);
                    };
            }
            else if (sizeof($arr) == 2){
                foreach ($trees as $tree){
                    if ($tree->name == $arr[0]){
                        foreach ($tree as $i => $workbook){
                            if ($workbook->name == $arr[1]){
                                return $tree[$i];
                            }
                        }
                    }
                }
            }
            else if (sizeof($arr) == 3){
                foreach ($trees as $tree){
                    if ($tree->name == $arr[0]){
                        foreach ($tree->workbooks as $i => $workbook){
                            if ($workbook->name == $arr[1]){
                                foreach ($workbook->views as $j => $view){
                                    if ($view->name == $arr[2]){
                                        $parse = [
                                            'name' => $arr[0],
                                            'workbooks' => [
                                                'name' => $arr[1],
                                                'views' => [
                                                    'name' => $arr[2],
                                                    'tableau_url' => $tree->workbooks[$i]->views[$j]->tableau_url
                                                ]
                                            ]
                                        ];
                                        array_push($res, $parse);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return json_encode($res);
    }
}
