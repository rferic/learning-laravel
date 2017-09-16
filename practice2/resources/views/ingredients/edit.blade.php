@extends('layouts.app')

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

        {{ Form::model(
            $ingredient,
            [
                'route' => [
                    'ingredients.update',
                    $ingredient->id
                ],
                'class' => 'form-horizontal',
                'method' => 'PUT',
                'id' => 'edit-ingredient'
            ]) }}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('price', 'Price') }}
                        {{ Form::text('price', old('price'), ['class' => 'form-control']) }}
                    </div>

                </div>

            </div>

            {{ Form::submit('Edit Ingredient', ['class' => 'btn btn-success']) }}

        {{ Form::close() }}
    </div>
@endsection
