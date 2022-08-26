<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
class Hospital extends Model
{
    protected $table = 'hospitals';
    protected $fillable = [
        'name', 'address', 'created_at', 'updated_at','country_id'

    ];

    protected $hidden = ['created_at', 'updated_at'];

    public $timestamps = true;

    public function doctors(){
        return $this -> hasMany('App\Models\Doctor','hospital_id','id');
    }

}
