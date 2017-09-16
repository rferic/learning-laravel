<div class="col-md-8 col-md-offset-2">
	<div class="well bs-component">
		<div class="content">
			<h2 class="header">{!! $ticket->title !!}</h2>
			
			@if (session('status'))
			<div class="alert alert-success">
				{{session('status')}}
			</div>
			@endif
		
			<p><strong>Status:</strong> {!! $ticket->status ? 'Open' : 'Close' !!}</p>
			<p>{!! $ticket->content !!}</p>
		</div>
		<a href="{!! action('TicketsController@edit', $ticket->slug) !!}" class="btn btn-info pull-left">Edit</a>
		<form method="post" action="{!! action('TicketsController@destroy', $ticket->slug) !!}" class="pull-left">
			<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
			<button type="submit" class="btn btn-danger">Remove</button>
		</form>
		<div class="clearfix"></div>
	</div>
	
	@foreach($comments AS $comment)
	<div class="well bs-component">
		<div class="content">
			{!!$comment->content!!}
		</div>
	</div>
	@endforeach
	
	<div class="well bs-component">
		<form class="form-horizontal" method="post" action="/comment">
			@foreach($errors->all() AS $error)
			<div class="alert alert-danger">{{ $error }}</div>
			@endforeach
			
			@if(session('status'))
			<div class="alert alert-success">{{ session('status') }}</div>
			@endif
			
			<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
			<input type="hidden" name="post_id" value="{!! $ticket->id !!}" />
			
			<fieldset>
				<legend>Reply</legend>
				<div class="form-group">
					<div class="col-md-12">
						<textarea class="form-control" rows="3" id="content" name="content"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="reset" class="btn btn-danger">Cancel</button>
						<button type="submit" class="btn btn-primary">Send</button>
						
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>