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



            </ul>

        </div>
    </nav>


            <div class="content">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('error')}}
                        </div>
                    @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('messages.Offer name') }}</th>
                        <th scope="col">{{__('messages.Offer price ')}}</th>
                        <th scope="col">{{__('messages.Offer details')}}</th>
                        <th scope="col">photo</th>
                        <th scope="col" colspan="2">{{__('messages.operation')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $offer)
                    <tr>

                        <th scope="row">{{$offer ->id}}</th>
                        <td>{{$offer ->name}}</td>
                        <td>{{$offer ->price}}</td>
                        <td>{{$offer ->details}}</td>
                        <td><img style="width: 90px; height: 90px;"  src="{{asset('images/offers/'.$offer->photo)}}" alt="img"></td>
                        <td><a href="{{url('offers/edit/'.$offer ->id)}}" class="btn btn-success">{{__('messages.update')}}</a></td>
                        <td><a href="{{url('offers/delete/'.$offer ->id)}}" class="btn  btn-danger">{{__('messages.delete')}}</a></td>

                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>




    </body>
</html>
