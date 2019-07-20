
@extends('backLayout.app')
@section('title')
  Login
@stop

@section('style')

@stop
@section('content')

<div class="row">
    @foreach($users as $user)
  <div class="col-md-3">      
    <div style="border: 1px solid blue">
    <h2 style="align:center"> {{ $user->first_name }} {{ $user->last_name}}</h2>
    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->color(38, 38, 38, 0.85)->backgroundColor(255, 255, 255, 0.82)->size(200)->generate($user->QRpassword)) !!} ">      
    </div>  
  </div>
    @endforeach

</div>

@endsection