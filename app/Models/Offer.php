<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
protected $table="offers";//if the name of model deffrint of table in databse

protected $fillable=['name_ar','name_en','price','photo','created_at','updated_at','details_ar','details_en'];//can accesed in database


protected $hidden=['created_at','updated_at'];//cant access on database
    public $timestamps=false;
}
