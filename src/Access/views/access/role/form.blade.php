	<div class="form-group">
		{!! Form::label('name','Role Name:') !!}
		{!! Form::text('name', null,['class'=>'form-control second','placeholder'=>'Name']) !!}
		
	</div>
			
	<div class="form-group">
		{!! Form::label('slug','Slug:') !!}
		{!! Form::text('slug', null,['class'=>'form-control second','placeholder'=>'Slug']) !!}
	</div>
		
	<div class="form-group">
		{!! Form::label('description','Description:') !!}
		{!! Form::text('description', null,['class'=>'form-control second','placeholder'=>'Description']) !!}
	</div>
	
	<div class="form-group">
	
		{!! Form::label('level','Level:') !!}
		{!! Form::text('level', null,['class'=>'form-control second','placeholder'=>'Number']) !!}
	</div>
	  	
	<div class="list-group">
		 @if (count($perms))
		 <ul style="margin:0;padding:0;list-style:none;">
		 @foreach($perms as $perm)
	       
	        <li>
	        	@if(!empty($role))
	        		<input type="checkbox" value="{{ $perm->id }}" name="permissions[]" {{ $role->permissions->lists('id')->contains($perm->id)? 'checked' : "" }}  id="material-{{ $perm->id }}" /> 
	        	@else
	        		<input type="checkbox" value="{{ $perm->id }}" name="permissions[]"  id="material-{{ $perm->id }}" /> 
	       		@endif
	       		
	       		<label for="permission-{{ $perm->id }}">
		        	<a style="color:black; text-decoration:none;" >
		        		{{ $perm->name."-----".$perm->description }}
		            </a>
	            </label>
	        </li>
	        
	        @endforeach
	     </ul>
	     @else
	     	<p>No any permissions</p>
	     @endif
	</div>
		
	<div class="list-group">
		<input class="btn btn-primary" type="submit" value="Submit">
	</div>
	