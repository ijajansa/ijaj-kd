<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    public $primaryKey = 'id';
    public function barcode(){
        return $this->belongsTo('App\Models\Bar', 'barcode_id', 'id'); 
    }
    public function ward(){
        return $this->belongsTo('App\Models\Ward', 'ward_id', 'id'); 
    }
    public function hajeri(){
        return $this->belongsTo('App\Models\HajeriShed', 'shed_id', 'id'); 
    }
}
