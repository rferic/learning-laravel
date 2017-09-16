<div class="container">
	<div class="content">
		<h1 class="text-center">@yield('title')</h1>
		<div class="text-center pull-right">
			<a href="/tickets/create">Create new ticket</a>
		</div>
		<h3>Tickets List</h3>
		
		@if (session('status'))
		<div class="alert alert-success">
			{{session('status')}}
		</div>
		@endif
		
		@if ($tickets->isEmpty())
		<p>Not found tickets</p>
		@else
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tickets AS $ticket)
				<tr>
					<td>{!! $ticket->id !!}</td>
					<td><a href="{!! action('TicketsController@show', $ticket->slug) !!}">{!! $ticket->title !!}</a></td>
					<td>{!! $ticket->status ? 'Open' : 'Close' !!}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	</div>
</div>