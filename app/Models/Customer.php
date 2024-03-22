<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey='id';

    public function inspector()
    {
    	return $this->belongsTo('App\Models\Customer','inspector_id','id');
    }
}
