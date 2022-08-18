@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none">
            تم التحديث بنجاح
        </div>
        <div class="title m-b-md">
            <h1 class="text-center">{{trans('messages.Add your offer')}}</h1>

        </div>
        <br>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        <form method="post" id="offerformUpdate" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$offer->id}}" name="offer_id">
            <div class="form-group">
                <label for="photo">اختر صورة العرض</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo"
                       aria-describedby="emailHelp">

            </div>


            <div class="form-group">
                <label for="name"> {{trans('messages.Offer name ar')}}</label>
                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                       name="name_ar" aria-describedby="emailHelp" value="{{$offer->name_ar}}">

            </div>
            <div class="form-group">
                <label for="name"> {{trans('messages.Offer name en')}}</label>
                <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                       name="name_en" aria-describedby="emailHelp" value="{{$offer->name_en}}">

            </div>


            <div class="form-group">
                <label for="price">{{trans('messages.Offer price ')}}</label>
                <input type="password" class="form-control @error('price') is-invalid @enderror" name="price"
                       id="price" value="{{$offer->price}}">

            </div>


            <div class="form-group">
                <label for="offer_details">{{trans('messages.Offer details ar')}}</label>
                <input type="text" class="form-control @error('details_ar') is-invalid @enderror" name="details_ar"
                       id="offer_details" value="{{$offer->details_ar}}">

            </div>

            <div class="form-group">
                <label for="offer_details">{{trans('messages.Offer details en')}}</label>
                <input type="text" class="form-control @error('details_en') is-invalid @enderror" name="details_en"
                       id="offer_details"value="{{$offer->details_en}}" >

            </div>


            <button type="button" id="update-offer" class="btn btn-primary">update Offer</button>
        </form>


    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#update-offer', function (e) {
            e.preventDefault();
            var formData = new FormData($('#offerformUpdate')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{Route('ajaxoffer.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                            if(data.status==true){
                                $("#success_msg").show();
                            }

                },
                error: function (reject) {

                }
            });
        })


    </script>

@endsection