<!doctype html>
<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Signin page</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-theme.min.css') }}
    {{ HTML::style('css/Signin.css') }}
    <script src="/js/vendor/jquery-1.11.0.js"></script>
    {{ HTML::script('js/vendor/bootstrap.js') }}
	</head>
	<body>
		<div class="container">
			@yield('main')
		</div>
	@yield('footer')
	</body>
</html>
