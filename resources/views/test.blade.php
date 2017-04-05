<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="{{ url('api/senddata') }}" method="post" accept-charset="utf-8">
		<input type="text" name="umidade" placeholder="umidade">
		<input type="text" name="temperatura" placeholder="temperatura">
		<input type="text" name="id" placeholder="id">
		<button type="submit">Enviar</button>
	</form>
</body>
</html>