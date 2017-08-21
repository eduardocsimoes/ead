<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LOGIN - EAD</title>
	<style type="text/css">
		form{
			width: 300px;
			height: 300px;
			background-color: #DDD;
			margin: auto;
			margin-top: 30px;
			padding: 20px;
			border-radius: 10px;
		}
		input{
			width: 270px;
			padding: 15px;
			font-size: 14px;
			border: 1px solid #CCC;
		}
		input[type=submit]{
			width: 300px;
			padding: 15px;
			font-size: 14px;
			border: 1px solid #CCC;
		}		
	</style>
</head>
<body>
	<form method="POST" action="">
		<h2>Login</h2>
		<input type="email" name="email" placeholder="E-mail"><br><br>
		<input type="password" name="senha" placeholder="******"><br><br>
		<input type="submit" value="Entrar">
	</form>	
</body>
</html>