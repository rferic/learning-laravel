@extends('layouts.admin')

@section('content')
    <div class="container">

        @if(COUNT($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() AS $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- TODO this Form open normal without Model because this not correspond with another Model (is a relationship) --}}
        {!! Form::open([
            'route' => ['admin.ingredients-pizzas.update', $pizza->id],
            'method' => 'PUT'
        ]) !!}
            {{--
            {!! Form::hidden('pizza', $pizza->id) !!}
            --}}
            <div class="form-group">
                {!! Form::label('pizza_id', 'Pizza') !!}
                {{-- TODO print select (name, options, defaultValue, attributes) --}}
                {!! Form::select('pizza_id', $pizzas, $pizza->id, ['class' => 'form-control', 'disabled']) !!}
            </div>

            {{-- TODO print select with Array for can select multioptions --}}
            <div class="form-group">
                {!! Form::label('ingredients[]', 'Ingredients') !!}
                {{-- TODO print select (name, options, defaultValue, attributes) --}}
                {!! Form::select(
                    'ingredients[]',
                    $ingredients,
                    $pizza->ingredients()->pluck('id')->toArray(), //return Array with Ingredients ID
                    ['class' => 'form-control', 'multiple']
                ) !!}
            </div>

            {!! Form::submit('Edit Ingredients of "' . $pizza->name . '"', ['class' => 'btn btn-success']) !!}

        {!! Form::close() !!}

    </div>
@endsection
