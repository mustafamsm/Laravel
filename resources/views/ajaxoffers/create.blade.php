@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none">
            تم الحفظ بنجاح
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
        <form method="post" id="offerform" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="photo">اختر صورة العرض</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo"
                       aria-describedby="emailHelp">
                @error('photo')
                <small class="form-text text-danger ">{{$message}}</small>
                @enderror
            </div>


            <div class="form-group">
                <label for="name"> {{trans('messages.Offer name ar')}}</label>
                <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                       name="name_ar" aria-describedby="emailHelp">
                @error('name_ar')
                <small class="form-text text-danger ">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name"> {{trans('messages.Offer name en')}}</label>
                <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                       name="name_en" aria-describedby="emailHelp">
                @error('name_en')
                <small class="form-text text-danger ">{{$message}}</small>
                @enderror
            </div>


            <div class="form-group">
                <label for="price">{{trans('messages.Offer price ')}}</label>
                <input type="password" class="form-control @error('price') is-invalid @enderror" name="price"
                       id="price">
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>


            <div class="form-group">
                <label for="offer_details">{{trans('messages.Offer details ar')}}</label>
                <input type="text" class="form-control @error('details_ar') is-invalid @enderror" name="details_ar"
                       id="offer_details">
                @error('details_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="offer_details">{{trans('messages.Offer details en')}}</label>
                <input type="text" class="form-control @error('details_en') is-invalid @enderror" name="details_en"
                       id="offer_details">
                @error('details_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>


            <button type="button" id="save-offer" class="btn btn-primary">Save Offer</button>
        </form>


    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#save-offer', function (e) {
            e.preventDefault();
            var formData = new FormData($('#offerform')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{Route('ajaxoffer.store')}}",
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