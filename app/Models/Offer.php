<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
protected $table="offers";//if the name of model deffrint of table in databse

protected $fillable=['name_ar','name_en','price','photo','created_at','updated_at','details_ar','details_en','status'];//can accesed in database


protected $hidden=['created_at','updated_at'];//cant access on database
    public $timestamps=false;

//local scope
    public  function scopeInactive($query){
       return $query->where('status',0);
    }

    //global scope

    protected static function boot()
    {

        parent::boot();
        static::addGlobalScope(new OfferScope());
    }

    //mutators
    public function setNameEnAttribute($value){
        $this->attributes['name_en']= strtoupper($value);
    }
}
