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
    {{ HTML::style('css/datepicker.css') }}
    {{ HTML::style('css/bootstrap-duallistbox.css') }}
    {{ HTML::style('css/dataTables.bootstrap.css') }}
    {{ HTML::style('vendor/bootstrapvalidator/css/bootstrapValidator.css') }}
    {{ HTML::style('css/cobapp.css') }}

    </style>

	<style>
	body {
	padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	    }
	    table form { margin-bottom: 0; }
	    form ul { margin-left: 0; list-style: none; }
	    .error { color: red; font-style: italic; }
	    body { padding-top: 20px; }
	    .arabic { direction: rtl; }

html {
    min-height: 100%;
    position: relative;
}
body {
    margin-bottom: 60px;
}
#footer {
    background-color: #F5F5F5;
    bottom: 0;
    height: 60px;
    position: absolute;
    width: 100%;
}
body > .container {
    padding: 60px 15px 0;
}
.container .text-muted {
    margin: 20px 0;
}
#footer > .container {
    padding-left: 15px;
    padding-right: 15px;
}
code {
    font-size: 80%;
}

.canvas-holder {
   /* margin: 20px 0; */
   /* padding: 4px 0; */
    position: relative;
}
.canvas-holder img {
    height: auto;
    width: 100%;
}

.labeled-chart-container {
    min-height: 180px;
    padding-right: 150px;
    position: relative;
}

.bar-legend {
    list-style: none outside none;
    position: absolute;
    right: 8px;
    top: 0;
}
.bar-legend li {
    border-radius: 5px;
    cursor: default;
    display: block;
    font-size: 14px;
    margin-bottom: 4px;
    padding: 2px 8px 2px 28px;
    position: relative;
    transition: background-color 200ms ease-in-out 0s;
}
.bar-legend li:hover {
    background-color: #fafafa;
}

.bar-legend li {
    background-color: #F0EEFF;
}
.bar-legend li span {
    border-radius: 5px;
    display: block;
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 20px;
}

.labeled-line-container {
    min-height: 180px;
    /* padding-right: 150px; */
    position: relative;
}

.line-legend {
    list-style: none outside none;
    position: absolute;
    right: 8px;
    top: 0;
}
.line-legend li {
    border-radius: 5px;
    cursor: default;
    display: block;
    font-size: 14px;
    margin-bottom: 4px;
    padding: 2px 8px 2px 28px;
    position: relative;
    transition: background-color 200ms ease-in-out 0s;
}
.line-legend li:hover {
    background-color: #fafafa;
}
.line-legend li span {
    border-radius: 5px;
    display: block;
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 20px;
}

	</style>
    {{ HTML::style('css/signin.css') }}
    {{ HTML::script('/js/vendor/jquery-1.11.0.js') }}
    {{ HTML::script('js/vendor/bootstrap.js') }}
    {{ HTML::script('js/vendor/jquery.dataTables.min.js') }}
    {{ HTML::script('js/vendor/dataTables.bootstrap.js') }}
    {{ HTML::script('js/custom/cobapp.js') }}

    </head>

    <body>
	@include ('layouts.partials.nav')

	<div class="container wrap">
	    <div class="content">
		@yield('content')

		@include('cobstart.cobsummary')
	    </div>
	</div>
	@include ('layouts.partials.footer')
    </body>
</html>
