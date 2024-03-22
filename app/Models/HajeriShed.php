<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HajeriShed extends Model
{
    public $primaryKey = 'id';
    
    public function ward(){
        return $this->belongsTo('App\Models\Ward', 'ward_id', 'id'); 
    }
}
