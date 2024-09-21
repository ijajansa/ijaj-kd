<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $primaryKey='id';

    public function inspector()
    {
    	return $this->belongsTo('App\Models\Customer','inspector_id','id');
    }
}
