@extends('layouts.app')
@section('content')
    <div class="container ">

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    الخدمات

                </div>

                <br>

                <table class="table table-dark"    >
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($services) && $services->count()>0)

                        @foreach($services as $service)
                            <tr>
                                <td scope="row">{{$service->id}}</td>
                                <td>{{$service->name}}</td>

                            </tr>

                        @endforeach

                    @else
                        <h1>no data</h1>
                    @endif
                    </tbody>
                </table>
    <br><br>
                <form method="post" action="{{route('doctor.save')}}"  >
                    @csrf

                    <div class="form-group">
                        <label for="photo">اختر طبيب</label>

                        <select name="doctor_id" class="form-control" >
                            @foreach($doctors as $doctor)
                            <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="photo">اختر الخدمات</label>

                        <select name="servicesIds[]" id="" class="form-control" multiple>
                            @foreach($allservice as $service)
                            <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                        </select>
                    </div>





                    <button type="submit" class="btn btn-primary">Save  </button>
                </form>


            </div>
        </div>
    </div>
@stop
