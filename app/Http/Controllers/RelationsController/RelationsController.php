<?php

namespace App\Http\Controllers\RelationsController;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation()
    {
        $user = \App\User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(2);
        //     return  $user->phone->code;


        //or
//       $user=\App\User::find(2)->phone;


//       $phone=\App\Models\Phone::find(1)->user;
        return response()->json($user);
    }


    public function hasOneRelationResrve()
    {
        $phone = Phone::find(1);

        //make some attribute visible
        $phone->makeVisible(['user_id']);
//       $phone->makeHidden(['code']);


        return $phone->user;

    }

    public function getUserHasPhone()
    {
//    return User::whereHas('phone')->get();


    return User::whereHas('phone',function ($q){
        $q->where('code','970');
    })->get();
    }
    public function getUserNotHasPhone(){
        return User::whereDoesntHave('phone')->get();

    }
}
