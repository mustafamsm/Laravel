<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;


class UserController extends Controller
{

    public function showAdminName(){
        return "Mustafa";
    }
   public function getIndex(){
        return view('welcome');
   }
}
