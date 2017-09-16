<div class="container">
	<div class="content">
		<h1 class="text-center">@yield('title')</h1>
		<div class="container col-md-8 col-md-offset-2">
			<div class="well well bs-component">				
				<form class="form-horizontal" method="post" action="/tickets">
					
					@foreach ($errors->all() as $error)
					<p class="alert alert-danger">{{$error}}</p>
					@endforeach
					
					<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
					<fieldset>
						<h3>Send new ticket</h3>
						<div class="form-group">
							<label for="title" class="col-lg-2 control-label">Title</label>
							<div class="col-lg-10">
								<input type="text" name="title" class="form-control" id="title" placeholder="Title">
							</div>
						</div>
						<div class="form-group">
							<label for="content" class="col-lg-2 control-label">Content</label>
							<div class="col-lg-10">
								<textarea name="content" class="form-control" rows="3" id="content"></textarea>
								<span class="help-block">Send your questions</span>
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-10 col-lg-offset-2">
								<button class="btn btn-default">Cancel</button>
								<button type="submit" class="btn btn-primary">Send</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>