@extends('layouts.app')

@section('content')
<div class="container">
	
	{!! Form::model($role,['method'=>'PATCH','action'=>['Backend\RoleController@update',$role->id]]) !!}
		@include('access.role.form')
  	{!! Form::close() !!}

</div>
@endsection