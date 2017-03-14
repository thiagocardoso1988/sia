<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'SIA') - Sistema de Irrigação Automático</title>

	@section('stylesheets')
	@show

</head>
<body>
	
	@section('pre-body')
	@show

	<div class="container">
		@yield('content')
	</div>

	@section('pos-body')
	@show

	@section('scripts')
	@show

</body>
</html>