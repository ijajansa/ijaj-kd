<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ward extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
