<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Scopes\OfferScope;
use App\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class ColletcController extends Controller
{
    public function index()
    {
//       $numbers=[1,2,3,4,5];
//       $col=collect($numbers);
//       return $col ;

//      $names= collect(['name','age']);
//     $result= $names->combine(['ahmed','28']);
//     return $result;

//        $ages=collect([2,3,5,6,8,5]);
//       return $ages->countBy();


//        $ages=collect([2,3,5,6,8,5]);
//       return $ages->duplicates();


    }

    public function complex()
    {
        $offers = Offer::withoutGlobalScope(OfferScope::class)->get();
        //remove
        $offers->each(function ($offer) {
            if ($offer->status == 0) {
                unset($offer->details_ar);
                $offer->name = 'mustafa';
                return $offer;
            }
        });


        return $offers;
    }


    public function complex_offer()
    {
        $offers = Offer::withoutGlobalScope(OfferScope::class)->get();
        $offers = collect($offers);
        $offers->filter(function ($value, $key) {
            return $value['status'] = 0;
        });

        return $offers;
    }

    public function complex_offer_transForm()
    {
        $offers = Offer::withoutGlobalScope(OfferScope::class)->get();
        $offers = collect($offers);
       $offer= $offers->transform(function ($value, $key) {
            return 'name is ' . $value['name_en'];
        });
        return $offer;
    }

}
