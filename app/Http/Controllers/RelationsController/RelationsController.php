<?php

namespace App\Http\Controllers\RelationsController;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;
use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;

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


        return User::whereHas('phone', function ($q) {
            $q->where('code', '970');
        })->get();
    }

    public function getUserNotHasPhone()
    {
        return User::whereDoesntHave('phone')->get();

    }


    ########### one to many relation mehtods ############

    public function getHospitalDoctors()
    {
        $hospital = Hospital::find(1);  // Hospital::where('id',1) -> first();  //Hospital::first();

        // return  $hospital -> doctors;   // return hospital doctors

        $hospital = Hospital::with('doctors')->find(1);

        //return $hospital -> name;


        $doctors = $hospital->doctors;

//         foreach ($doctors as $doctor){
//            echo  $doctor -> name.'<br>';
//         }

        $doctor = Doctor::find(3);

        return $doctor->hospital->name;

    }

    public function hostpitals()
    {
        $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('doctors.hospitls', compact('hospitals'));
    }

    public function doctors($hospita_id)
    {
        $hospital = Hospital::find($hospita_id);
        $doctors = $hospital->doctors;
        return view('doctors.docotrs', compact('doctors'));
    }

    public function hostpitalsHasDoctors()
    {
        $hospital = Hospital::whereHas('doctors')->get();
        return $hospital;
    }

    public function hostpitalsHasDoctorsMale()
    {
        return $hospital = Hospital::with('doctors')->whereHas('doctors', function ($q) {
            $q->where('gender', 1);
        })->get();
    }

    public function hostpitalsNotHasDoctors()
    {
        $hospital = Hospital::whereDoesntHave('doctors')->get();
        return $hospital;
    }

    public function delete($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        if (!$hospital)
            return abort('404');

        $hospital->doctors()->delete();
        $hospital->delete();
    return redirect()->route('all');

    }
    ##########
}
