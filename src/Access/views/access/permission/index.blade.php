@extends('layouts.app')

@section('content')
<div class="container">

    @include('partials.flash') 
    
    <div class="row">
		<h2>Permission Management</h2>
		
		<a href="{{ route('admin.permission.create')}}"  class="btn all btn-primary">Create A Permission</a>
		 
		<p>The Relationship between Role and Permission below.</p>
		  
		  @foreach($permissions as $perm)
		  	<h3><a href="{{ route('admin.permission.edit', $perm->id) }}">{{ $perm->name }}</a>
		  		<a class="btn btn-xs btn-danger" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">
			  		<i class="fa fa-trash" title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
			  		</i>
					<form style="display:none" name="delete_item" method="POST" action="{{ route('admin.permission.destroy', $perm->id) }}">
						<input type="hidden" value="delete" name="_method">
						{{ csrf_field() }}
					</form>
				</a>
		  	</h3>
		  	
		  	
			<div class="list-group">
				<label >
		        		Slug: {{ $perm->slug }}
	            </label>
				
			</div>
			
			<div class="list-group">
				<label >
		        		Description: {{ $perm->description }}
	            </label>
			</div>
		  	
		  		
 		@endforeach
  
	</div>
    
</div>
@endsection

