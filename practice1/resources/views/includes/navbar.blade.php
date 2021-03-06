<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel Practice 1</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
				<li @if ($view === 'home') class="active" @endif >
					 <a href="/">Home</a>
				</li>
				<li @if ($view === 'tickets') class="active" @endif >
					<a href="/tickets">Tickets</a>
				</li>
            </ul>
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</nav>