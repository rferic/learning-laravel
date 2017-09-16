@if(isset($editable))
	{{-- TODO Form for Update --}}
	{{ Form::Model($album, ['route' => ['albums.update', $album->id], 'method' => 'PUT']) }}
@else
	{{-- TODO Form for Create --}}
	{{ Form::Model($album, ['route' => 'albums.store']) }}
@endif

{{ Form::hidden('album_id', $album->id) }}

@if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif

<div class="col-md-12 form-group">
	{!! Form::label('name', 'Nombre del albúm', ['class' => 'text-success']) !!}
	{!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
</div>

<div class="clsbox-1 col-md-4" runat="server"  >
	<h3>Pictures Section 1</h3>
	<div class="dropzones dropzone clsbox" id="mydropzone1" data-section="section1"></div>
</div>

<div class="clsbox-1 col-md-4" runat="server"  >
	<h3>Pictures Section 2</h3>
	<div class="dropzones dropzone clsbox" id="mydropzone2" data-section="section2"></div>
</div>

<div class="clsbox-1 col-md-4" runat="server"  >
	<h3>Pictures Section 3</h3>
	<div class="dropzones dropzone clsbox" id="mydropzone3" data-section="section3"></div>
</div>

<div class="col-md-12 form-group">
	<br />
	@if(isset($editable))
		{{ Form::submit('Update Album', ['class' => 'btn btn-success btn-block']) }}
	@else
		{{ Form::submit('Create Album', ['class' => 'btn btn-success btn-block']) }}
	@endif
</div>

{{ Form::close() }}

@if(isset($editable))
	<div class="col-md-12 form-group">
		{{ Form::Model($album, ['route' => ['albums.delete', $album->id], 'method' => 'DELETE']) }}
			{{ Form::submit('Remove Album', ['class' => 'btn btn-danger btn-block']) }}
		{{ Form::close() }}
	</div>
@endif
