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

        {!! Form::model(
            $pizza,
            ['route' => ['pizzas.update', $pizza->id],
            'class' => 'form-horizontal',
            'method' => 'PUT',
            'id' => 'edit-pizza'
            ]
        ) !!}

        {{ Form::hidden('user_id', auth()->user()->id) }}

        {{ Form::hidden('id', $pizza->id) }}

        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('price', 'Precio') !!}
            {!! Form::text('price', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Descripción') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Editar pizza', ['class' => 'btn btn-success']) !!}

        {!! Form::close() !!}

    </div>

@endsection