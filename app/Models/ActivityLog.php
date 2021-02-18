<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use CrudTrait, HasFactory;

    protected $fillable = [
      'log_name', 'description', 'subject_type', 'subject_id', 'causer_id', 'properties'
    ];
}
