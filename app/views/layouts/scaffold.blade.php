<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		{{HTML::style('public/assets/css/main.css')}}
		
<link rel="stylesheet" href="assets/css/main.css"/>

		<style>
			table form { margin-bottom: 0; }
			form ul { margin-left: 0; list-style: none; }
			.error { color: red; font-style: italic; }
			body { padding-top: 20px; }
		</style>
	</head>

	<body>

		<div class="container">
			@if (Session::has('message'))
				<div class="flash alert">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif

			@yield('main')
		</div>
		<footer style="background-color:#298A08;">
	    </footer>
	</body>

</html>