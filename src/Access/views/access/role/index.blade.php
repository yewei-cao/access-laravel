@extends('layouts.app')

@section('content')
<div class="container">

    @include('partials.flash') 
    
    <div class="row">
		<h2>Role Management</h2>
		
		<a href="{{ route('admin.role.create')}}"  class="btn all btn-primary">Create A Role</a>
		 
		<p>The Relationship between Role and Permission below.</p>
		  
		@foreach($roles as $role)
		  
		  	<h3><a href="{{ route('admin.role.edit', $role->id) }}">{{ $role->name }}</a>
		  		<a class="btn btn-xs btn-danger" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">
			  		<i class="fa fa-trash" title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
			  		</i>
					<form style="display:none" name="delete_item" method="POST" action="{{ route('admin.role.destroy', $role->id) }}">
						<input type="hidden" value="delete" name="_method">
						{{ csrf_field() }}
					</form>
				</a>
		  	</h3>
		  	
			<div class="list-group">
				
				<div class="col-sm-12">
					@foreach($permissions as $perm)
					 <button type="button" class="btn all {{ $role->permissions->lists('id')->contains($perm->id) ? 'btn-primary' : '' }}">
					 	{{ $perm->name }}
					 </button>
					 
					@endforeach
				</div>
				
			</div>
		  	
		  		
		 @endforeach
  
  
	</div>
    
</div>
@endsection

