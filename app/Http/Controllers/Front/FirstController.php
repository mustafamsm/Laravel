<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FirstController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth')->except("showString2");
     }

    public function showName(){
        return "Hello world!";
    }
    public function showString1(){
         return "String 1";
    }
    public function showString2(){
    return "String 2";
    }
    public function showString3(){
    return "String 3";
    }
    public function showString4(){
    return "String 4";
    }
}
