@extends('layouts.app')

@section('content')
<div class="container">
	
	{!! Form::open(['method'=>'POST','action'=>'Backend\RoleController@store']) !!}
		@include('access.role.form')
  	{!! Form::close() !!}

</div>
@endsection