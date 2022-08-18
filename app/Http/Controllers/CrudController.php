<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use  Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\Console\Input\Input;

class CrudController extends Controller
{

    use OfferTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    }

    public function getOffers()
    {
//       return Offer::get();
        return Offer::select('id', 'name')->get();
    }

    public function create()
    {
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {
        //validate data before insert to database
        //method make(request array,role array,masseg array);

//       $messages=$this->getMessages();
//        $rules=$this->getRules();
//        $validator=Validator::make($request->all(), $rules,$messages) ;
//        if($validator->fails()){
//            return redirect()->back()->withErrors($validator)->withInput();
//        }

        //save photo in folder
        $photo = $this->saveImage($request->photo, 'images/offers');


        //insert data to database

        Offer::create([
            'photo' => $photo,
            "name_ar" => $request->name_ar,
            "name_en" => $request->name_en,

            "price" => $request->price,
            "details_ar" => $request->details_ar,
            "details_en" => $request->details_en,
        ]);
        return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);


    }


    public function getAllOffers()
    {
        $offers = Offer::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'price', 'details_' . LaravelLocalization::getCurrentLocale() . ' as details','photo')->get();
        return view('Offers.all', compact('offers'));
    }

    public function editOffer($offer_id)
    {
        //it retuns 404 page if not found
        //Offer::findOrFail($offer_id);

        //or
        $offer = Offer::find($offer_id); //serach in given table id only
        if (!$offer) {
            return redirect()->back();
        }
        $offer = Offer::select('id', 'name_ar', 'name_en', 'price', 'details_ar', 'details_en')->find($offer_id);
        return view('offers.edit', compact('offer'));

    }

    public function updateOffer(OfferRequest $request, $offer_id)
    {
        //1-validet data in OfferRequest file


        //2-check if offer exists
        $offer = Offer::find($offer_id);
        if (!$offer) {
            return redirect()->back();
        }

        //3-update offer
        $offer->update($request->all());

        return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);


    }


    public function deleteOffer($offer_id)
    {
        //check if offer id if exists
       $offer= Offer::find($offer_id); //or Offer::where('id','$offer_id')->first();
        if(!$offer){
            return redirect()->back()->with(['error'=>__('messages.offer not exists')]);
        }
        $offer->delete();
        return redirect()->route('offers.all')->with(['success'=>__('messages.offer deleted successfully')]);

    }

    public function getVideo()
    {
        $video = Video::first();


        event(new VideoViewer($video));


        return view('video')->with('video', $video);
    }

//        protected function getMessages(){
//        return  $messages=[
//            'name.required'=>__('messages.offer name required'),
//            'name.unique'=>trans('messages.offer name must be unique'),
//            'price.numeric'=>'سعر العرض رقم فقط!',
//            'price.required'=>'سعر العرض مطلوب!',
//            'details.required'=>'تفاصيل العرض مطلوب!',
//        ];
//        }
//    protected function getRules(){
//       return  $rules=[
//           'name'=>'required|max:100|unique:offers,name',
//           'price'=>'required|numeric',
//           'details'=>'required',
//       ];
//    }


}
