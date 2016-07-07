@extends('layouts.app')

@section('content')
<div class="container">
	
	{!! Form::open(['method'=>'POST','action'=>'Backend\PermissionController@store']) !!}
		@include('access.permission.form')
  	{!! Form::close() !!}

</div>
@endsection