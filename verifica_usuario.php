<?php

	session_start();

	function login(){

		$login = $_POST['login'];
		$senha = $_POST['senha'];

		$usuarios = file_get_contents('usuarios.json');
		$usuarios = json_decode($usuarios, true);

		$usuario_existe = false;

		foreach ($usuarios as $usuario){

				if ($login == $usuario['login'] AND $senha == $usuario['senha']) {

				$usuario_existe = true;

				$_SESSION['usuario_nome']   = $_POST['nome'];
				$_SESSION['usuario_login']  = $login;
				$_SESSION['usuario_senha']  = $senha;
				$_SESSION['usuario_online'] = true;

				//redirecionar
				header('location: index.phtml');

			}
		}

		if ($usuario_existe == false){
			header('Location: login.php');
		}
}

	function logout(){

		session_destroy();
		header("Location: login.php");
	}

	if ($_GET['acao'] == 'login'){
		login();
	}

	if ($_GET['acao'] == 'sair'){
		logout();
	}
