<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recycle extends Model
{
    use HasFactory;
    public $fillable = ['added_date','name','mobile_number','ward','address','weight','payment','receipt','category','type'];
}
