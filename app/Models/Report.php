<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $primaryKey = 'id';
    public function user(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id'); 
    }
    public function barcode(){
        return $this->belongsTo('App\Models\Bar', 'barcode_id', 'id')->with('ward')->with('hajeri'); 
    }

    public function mukadam(){
        return $this->belongsTo('App\Models\Customer', 'inspector_id', 'id'); 
    }

}
