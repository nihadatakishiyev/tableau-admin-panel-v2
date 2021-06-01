<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthLog extends Model
{
    use CrudTrait, HasFactory;


    protected $fillable = [
       'user_id', 'action_name', 'ip_address'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
