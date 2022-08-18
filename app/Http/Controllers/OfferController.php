<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;

    public function createOffer()
    {
        //view for add this offer
        return view('ajaxoffers.create');
    }

    public function storeOffer(OfferRequest $request)
    {
        //save offer into database using ajax
        //save photo in folder

        $photo = $this->saveImage($request->photo, 'images/offers');


        //insert data to database

        $offer = Offer::create([
            'photo' => $photo,
            "name_ar" => $request->name_ar,
            "name_en" => $request->name_en,
            "price" => $request->price,
            "details_ar" => $request->details_ar,
            "details_en" => $request->details_en,
        ]);
        if ($offer) {
            return response()->json([
                'msg' => 'تم اضافة العرض بنجاح',
                'status' => true,

            ]);
        } else {
            return response()->json([
                'msg' => 'حدث خطأ ما, يرجى المحاولة مرة اخرى',
                'status' => false,

            ]);
        }


    }

    public function all()
    {
        $offers = Offer::select('id',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'price',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details',
            'photo'
        )
            ->get();
        return view('ajaxoffers.all', compact('offers'));
    }

    public function delete(Request $request)
    {
        //check if offer id if exists
        $offer = Offer::find($request->id); //or Offer::where('id','$offer_id')->first();
        if (!$offer) {
            return response()->json([
                'msg' => 'حدث خطأ ما, يرجى المحاولة مرة اخرى',
                'status' => false,

            ]);
        }
        $offer->delete();
        return response()->json([
            'msg' => 'تم الحذف بنجاح',
            'status' => true,
            'id'=>$request->id
        ]);
    }
    public function edit(Request $request){
        //it retuns 404 page if not found
        //Offer::findOrFail($offer_id);

        //or
        $offer = Offer::find($request->offer_id); //serach in given table id only
        if (!$offer) {
            return response()->json([
                'msg' => 'هذا العرض غير موجود',
                'status' => false,

            ]);
        }
        $offer = Offer::select('id', 'name_ar', 'name_en', 'price', 'details_ar', 'details_en')->find($request->offer_id);


        return view('ajaxoffers.edit', compact('offer'));

    }
    public function update(Request $request){
        //1-validet data in OfferRequest file


        //2-check if offer exists
        $offer = Offer::find($request->offer_id);
        if (!$offer) {
            return response()->json([
                'msg' => 'هذا العرض غير موجود',
                'status' => false,

            ]);
        }

        //3-update offer
        $offer->update($request->all());

        return response()->json([
            'msg' => 'تم التحديث بنجاح',
            'status' => true,

        ]);

    }
}
