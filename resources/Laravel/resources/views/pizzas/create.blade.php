@extends('layouts.app')


@section('content')

    <div class="container">

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::model($pizza, ['action' => 'PizzaController@store']) !!}

            {{ Form::hidden('user_id', auth()->user()->id) }}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('price', 'Precio') !!}
                {!! Form::text('price', old('price'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Descripción') !!}
                {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Añadir una pizza', ['class' => 'btn btn-success']) !!}

        {!! Form::close() !!}

    </div>

@endsection