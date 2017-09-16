<?php //TODO	dd($pizzas) => var_dump for Laravel   ?>

@extends('layouts.app')

@section('title', 'Ingredient\'s User')

@section('content')
	<div class="container">
		
		@include('partials.nav')

		@include('partials.flash')

		@forelse($ingredients AS $ingredient)
			<div class="panel panel-default">
				<div class="panel-heading">{{ $ingredient->name }}</div>
				<div class="panel-body">
					<p>Price: {{ $ingredient->price}}</p>
				</div>
				<div class="panel-footer">
					{{ link_to_action('IngredientController@edit', 'Edit', ['id' => $ingredient->id], ['class' => 'col-md-2']) }}

					<span class="pull-right">
						{{ Form::open(['method' => 'DELETE', 'route' => ['ingredients.destroy', $ingredient->id]]) }}
							{{ Form::submit('Remove', ['class' => 'btn btn-xs btn-danger']) }}
						{{ Form::close() }}
					</span>
					<p class="clearfix"></p>
				</div>
			</div>
			@empty
				<div class="alert alert-danger">Ingredients not found</div>
		@endforelse
	</div>
@endsection
