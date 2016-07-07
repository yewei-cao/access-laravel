@extends('layouts.app')

@section('content')
<div class="container">
	
	{!! Form::model($perm,['method'=>'PATCH','action'=>['Backend\PermissionController@update',$perm->id]]) !!}
		@include('access.permission.form')
  	{!! Form::close() !!}

</div>
@endsection