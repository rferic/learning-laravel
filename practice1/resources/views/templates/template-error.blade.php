<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>@yield('title')</title>

		<!-- Material Design fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- Bootstrap -->
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

		<!-- Bootstrap Material Design -->
		<link href="css/bootstrap-material-design/bootstrap-material-design.css" rel="stylesheet">
		<link href="css/bootstrap-material-design/ripples.min.css" rel="stylesheet">


		<link href="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body>
		@yield('content')
		
		<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<script src="js/bootstrap-material-design/ripples.min.js"></script>
		<script src="js/bootstrap-material-design/material.min.js"></script>
		<div class="container">
			<div class="content">
			<h1 class="text-center">ERROR 404: <sub>Page not found</sub></h1>
			</div>
		</div>
	</body>
</html>
