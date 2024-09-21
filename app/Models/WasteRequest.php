<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteRequest extends Model
{
    use HasFactory;
    public function request_items()
    {
        return $this->hasMany('App\Models\WasteRequestItem','request_id','id');
    }
    public function request_cd_items()
    {
        return $this->hasMany('App\Models\WasteRequestItem','request_id','id')->where('category_id',10);
    }
    
    public function request_e_items()
    {
        return $this->hasMany('App\Models\WasteRequestItem','request_id','id')->where('category_id',11);
    }
}
