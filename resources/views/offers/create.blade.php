<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">



        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item active">
                    <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }} <span class="sr-only">(current)</span></a>
                </li>
                @endforeach

                {{--@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
                    {{--<li>--}}
                        {{--<a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
                            {{--{{ $properties['native'] }}--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--@endforeach--}}


            </ul>

        </div>
    </nav>


            <div class="content">
                <div class="title m-b-md">
                    {{trans('messages.Add your offer')}}

                </div><br>
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <form method="post" action="{{route('offers.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="photo">اختر صورة العرض</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" value="{{old('photo')}}"   name="photo" aria-describedby="emailHelp">
                        @error('photo')
                        <small class="form-text text-danger ">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="name"> {{trans('messages.Offer name ar')}}</label>
                        <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" value="{{old('name_ar')}}"   name="name_ar"aria-describedby="emailHelp">
                        @error('name_ar')
                        <small class="form-text text-danger ">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name"> {{trans('messages.Offer name en')}}</label>
                        <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en" value="{{old('name_en')}}"   name="name_en"aria-describedby="emailHelp">
                        @error('name_en')
                        <small class="form-text text-danger ">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="price">{{trans('messages.Offer price ')}}</label>
                        <input type="password" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="offer_details">{{trans('messages.Offer details ar')}}</label>
                        <input type="text" class="form-control @error('details_ar') is-invalid @enderror" name="details_ar" id="offer_details">
                        @error('details_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="offer_details">{{trans('messages.Offer details en')}}</label>
                        <input type="text" class="form-control @error('details_en') is-invalid @enderror" name="details_en" id="offer_details">
                        @error('details_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-primary">Save Offer</button>
                </form>







        </div>
    </body>
</html>
