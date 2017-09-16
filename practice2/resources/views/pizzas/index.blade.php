<?php //TODO	dd($pizzas) => var_dump for Laravel   ?>

@extends('layouts.app')

@section('title', 'Pizza\'s User')

@section('content')
	<div class="container">
		<?php
		//TODO	link_to_action => for print link to controller (controller:method, text, params, attributes)
		?>

		@include('partials.nav')

		@include('partials.flash')

		@forelse($pizzas AS $pizza)
			<div class="panel panel-default">
				<div class="panel-heading">{{ $pizza->name }}</div>
				<div class="panel-body">
					<p>Price: {{ $pizza->price}}</p>
					{{ $pizza->description }}
				</div>
				<div class="panel-footer">
					<?php //TODO	link_to_action => for print link to controller (controller:method, text, params, attributes) ?>
						{{ link_to_action('PizzaController@edit', 'Edit', ['id' => $pizza->id], ['class' => 'col-md-2']) }}

						<?php //TODO	trashed() => check of this object has been logic removed  ?>
						@if($pizza->trashed())

							<?php //TODO	{{ ... }} => SCAPE HTML ?>
							<?php //TODO	OPEN FORM ?>
							{{ Form::open(['method' => 'PATCH', 'route' => ['pizzas.restore', $pizza->id]]) }}

							<?php //TODO	PRINT A SUBMIT ?>
							{{ Form::submit('Restore', ['class' => 'btn btn-xs btn-warning col-md-2']) }}

							<?php //TODO	CLOSE FORM ?>
							{{ Form::close() }}
						@endif

						<span class="pull-right">
							{{ Form::open(['method' => 'DELETE', 'route' => ['pizzas.destroy', $pizza->id]]) }}
							{{ Form::submit('Remove', ['class' => 'btn btn-xs btn-danger']) }}
							{{ Form::close() }}
						</span>
						<p class="clearfix"></p>
					</div>
				</div>
			@empty
				<div class="alert alert-danger">Pizzas not found</div>
			@endforelse

			@if($pizzas)
				{{ $pizzas->links() }}
			@endif
		</div>
	@endsection
