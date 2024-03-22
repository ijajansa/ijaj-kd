<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $primaryKey = 'id';
    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id'); 
    }
}
