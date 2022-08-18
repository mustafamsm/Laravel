@extends('layouts.app')

@section('content')





    <div class="content">
        <div class="alert alert-success" id="success_msg1" style="display: none">
            تم الحذف بنجاح
        </div>
        <div class="alert alert-success" id="success_msg2" style="display: none">
            حدث خطأ ما, يرجى المحاولة مرة اخرى
        </div>
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
                <tr class="offerRow{{$offer ->id}}">

                    <th scope="row">{{$offer ->id}}</th>
                    <td>{{$offer ->name}}</td>
                    <td>{{$offer ->price}}</td>
                    <td>{{$offer ->details}}</td>
                    <td><img style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"
                             alt="img"></td>
                    <td><a href="{{url('offers/edit/'.$offer ->id)}}"
                           class="btn btn-success">{{__('messages.update')}}</a></td>
                    <td><a href="{{url('offers/delete/'.$offer ->id)}}"
                           class="btn  btn-danger">{{__('messages.delete')}}</a></td>
                    <td><a offer_id="{{$offer ->id}}" class="btn  btn-danger delete_btn">ajax-delete</a></td>
                    <td><a href="{{route("ajaxoffer.edit",$offer->id)}}"  class="btn  btn-success ">ajax-update</a></td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
            var offer_id = $(this).attr('offer_id');
            $.ajax({
                type: 'post',
                url: "{{Route('ajaxoffer.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': offer_id
                },


                success: function (data) {

                    if (data.status == true) {
                        $("#success_msg1").show();
                    } else {
                        $("#success_msg2").show();
                    }
                    $('.offerRow' + data.id).remove();
                },
                error: function (reject) {

                }
            });
        })
    </script>


@endsection