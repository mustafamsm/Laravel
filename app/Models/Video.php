<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table="videos";//if the name of model deffrint of table in databse

    protected $fillable=['name','viewer'];//can accesed in database


    public $timestamps=false;
}
