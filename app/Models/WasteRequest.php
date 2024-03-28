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
}
