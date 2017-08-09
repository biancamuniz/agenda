<?php

	require 'controlador_agenda.php';
	$contato = editarContato($_GET['id']);

?>

<!DOCTYPE html>
<html>
	<head>

		<title></title>

	</head>

	<body>

		<form method="POST" action="controlador_agenda.php?acao=editar">
			
		<input type="text"   name="id"       value="<?= $contato['id'] ?>">
		<input type="text"   name="nome"     value="<?= $contato['nome'] ?>">
		<input type="email"  name="email"    value="<?= $contato['email'] ?>">
		<input type="number" name="telefone" value="<?= $contato['telefone'] ?>">

		<input type="submit" value="editar">

		</form>

	</body>

</html>