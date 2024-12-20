<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function install(){
        return $this->hasMany(Bar::class,'category_id','id')->where('is_delete',0);
    }
}
