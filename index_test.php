<?php

	session_start();

		$existe = isset($_SESSION['usuario_online']);

		if($existe == false){
			//redirecionar
			header("Location: login.php");
		}

?>

<!DOCTYPE html>

	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
		<title>Document</title>
	</head>
	<body>

		<div class="social">

			<a href="verifica_usuario.php?acao=sair" class="sair">Sair</a>

			<img src="https://i1.wp.com/www.inspi.com.br/wp-content/uploads/2014/03/120515.gif?resize=640%2C640" alt="" width="200" height="200">
			<h3>Bem vindo!</h3>
		</div>

	</body>
	</html>
