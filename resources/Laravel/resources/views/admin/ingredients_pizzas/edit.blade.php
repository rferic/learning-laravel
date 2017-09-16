@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(
            [
                'route' => ['admin.ingredients_pizzas.update', $pizza->id],
                'method' => 'PUT'
            ])
        !!}

            {!! Form::hidden('pizza', $pizza->id) !!}

            <div class="form-group">
                {!! Form::label('pizza_id', 'Pizza') !!}
                {!! Form::select('pizza_id', $pizzas, $pizza->id, ['class' => 'form-control', 'disabled']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('ingredients[]', 'Ingredientes') !!}
                {!!
                    Form::select(
                        'ingredients[]',
                        $ingredients,
                        $pizza->ingredients()->pluck('id')->toArray(),
                        ['class' => 'form-control', 'multiple'])
                    !!}
            </div>

            {{ Form::submit('Editar relación pizza + ingrediente!', ["class" => "btn btn-success"]) }}
        {!! Form::close() !!}
    </div>
@endsection