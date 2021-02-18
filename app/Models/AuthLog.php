<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthLog extends Model
{
    use HasFactory;


    protected $fillable = [
       'user_id', 'action_name', 'ip_address'
    ];
}
