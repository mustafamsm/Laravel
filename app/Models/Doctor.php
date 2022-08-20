<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hospital;

class Doctor extends Model
{
    protected $table = 'doctors';
    protected $fillable = [
        'name', 'title', 'created_at', 'updated_at', 'hospital_id'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public $timestamps = true;

    public function hospital(){
        return $this -> belongsTo('App\Models\Hospital','hospital_id','id');
    }
}

