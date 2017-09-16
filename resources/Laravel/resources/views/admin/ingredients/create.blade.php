@extends('layouts.admin')

@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($ingredient, ['action' => 'Admin\IngredientController@store']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('price', 'Precio') !!}
        {!! Form::text('price', old('price'), ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Añadir un ingrediente', ['class' => 'btn btn-success']) !!}

    {!! Form::close() !!}
@endsection