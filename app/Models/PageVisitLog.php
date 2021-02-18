<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageVisitLog extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
      'user_id', 'ip_address', 'page_url'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
