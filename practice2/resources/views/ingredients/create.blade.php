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

        {{ Form::model($ingredient, ['action' => 'IngredientController@store']) }}
        {{ Form::hidden('user_id', auth()->user()->id) }}
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

        {{ Form::submit('Add Ingredient', ['class' => 'btn btn-success']) }}

        {{ Form::close() }}
    </div>
@endsection
