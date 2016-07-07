<div class="form-group">
	{!! Form::label('name','Permission Name:') !!}
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

		
<div class="list-group">
	<input class="btn btn-primary" type="submit" value="Submit">
</div>
	