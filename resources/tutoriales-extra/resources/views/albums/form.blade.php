@if (isset($editable))
    {!! Form::model($album, ['route' => ['albums.update', $album->id], 'method' => 'PUT']) !!}
@else
    {!! Form::model($album, ['route' => 'albums.store']) !!}
@endif

{!! Form::hidden('album_id', $album->id) !!}

<div class="col-md-12 form-group">
    {!! Form::label('name', 'Nombre del albúm', ['class' => 'text-success']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
</div>

<div class="col-md-12 form-group">
    {!! Form::label('plupload1', 'Imágenes del plupload 1', ['class' => 'text-success']) !!}
    <div id="plupload1">
        <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
    </div>
</div>

<div class="col-md-12 form-group">
    {!! Form::label('plupload2', 'Imágenes del plupload 2', ['class' => 'text-success']) !!}
    <div id="plupload2">
        <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
    </div>
</div>

<div class="col-md-12 form-group">
    {!! Form::label('plupload3', 'Imágenes del plupload 3', ['class' => 'text-success']) !!}
    <div id="plupload3">
        <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
    </div>
</div>

<div class="col-md-12 form-group">
    @if (!isset($editable))
        {!! Form::submit('Crear albúm', ['class' => 'btn btn-success btn-block']) !!}
    @else
        {!! Form::submit('Actualizar albúm', ['class' => 'btn btn-success btn-block']) !!}
    @endif
</div>

{!! Form::close() !!}