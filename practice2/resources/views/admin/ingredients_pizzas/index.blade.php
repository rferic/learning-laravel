<?php //TODO	dd($pizzas) => var_dump for Laravel   ?>

@extends('layouts.app')

@section('title', 'Ingredients on Pizzas')

@section('content')
	<div class="container">

		@include('partials.admin-nav')

		@include('partials.flash')

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Pizza</th>
					<th>Price</th>
					<th>Ingredients</th>
					<th with="10%">Edit</th>
					<th with="10%">Remove</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($pizzas as $pizza)
					<tr>
						<td>{{ $pizza->id }}</td>
						<td>{{ $pizza->name }}</td>
						<td>{{ $pizza->price }}</td>
						<td>
							@if($pizza->ingredients)
								<?php $ingredientsList = Array(); ?>

								@foreach($pizza->ingredients as $key => $ingredient)
									<?php array_push($ingredientsList, $ingredient->name); ?>
								@endforeach

								<?php echo join(', ', $ingredientsList); ?>
							@endif
						</td>
						<td>
							{{ link_to_action('Admin\IngredientPizzaController@edit', 'Edit pizza ingredient', ['id' => $pizza->id], ['class' => 'btn btn-xs btn-info']) }}
						</td>
						<td>
							{{ Form::open(['method' => 'DELETE', 'route' => ['admin.ingredients-pizzas.destroy', $pizza->id]]) }}
								{{ Form::submit('Remove pizza ingredient relation', ['class' => 'btn btn-xs btn-danger']) }}
							{{ Form::close() }}
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="6">Pizzas not found</td>
					</tr>
				@endforelse
			</tbody>
		</table>

		@if($pizzas)
			{{ $pizzas->links() }}
		@endif
	</div>
@endsection
