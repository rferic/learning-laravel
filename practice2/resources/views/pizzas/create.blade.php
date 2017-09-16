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

        <!--TODO print Form create by Model (Pizza) -->
        {{ Form::model($pizza, ['action' => 'PizzaController@store']) }}

        {{ Form::hidden('user_id', auth()->user()->id) }}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    <!-- TODO old('name) => if form return error this input autocomplete with old params (this case ´name´)-->
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

        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', old('description'), ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Add Pizza', ['class' => 'btn btn-success']) }}

        {{ Form::close() }}
    </div>
@endsection
