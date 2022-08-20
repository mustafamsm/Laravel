@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    الاطباء

                </div>

                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">title</th>
                        <th scope="col">operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($doctors) && $doctors->count()>0)

                        @foreach($doctors as $doctor)
                            <tr>
                                <td scope="row">{{$doctor->id}}</td>
                                <td>{{$doctor->name}}</td>
                                <td>{{$doctor->title}}</td>
                                <td><a href="{{route('hospital.doctors',$doctor->id)}}" class="btn btn-success">عرض
                                        الاطباء</a></td>
                            </tr>

                        @endforeach

                    @else
                        <h1>no data</h1>
                    @endif
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@stop
