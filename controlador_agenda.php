<?php

	function abrirArquivo(){
		$contatosAuxiliar = file_get_contents('contatos.json'); // lê o arquivo .json
		$contatosAuxiliar = json_decode($contatosAuxiliar, true); // converte o json em array
		return $contatosAuxiliar;
	}

	function salvarArquivo($contatosAuxiliar){
		$contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT); //converte array para json, com uma visualização melhor
		file_put_contents('contatos.json', $contatosJson); //salva os dados em um arquivo .json
		header("Location: index.phtml"); //redireciona a página
	}

	function cadastrar($nome, $email, $telefone){
			
		$contatosAuxiliar = abrirArquivo();
		$contato = [
		 	'id'       => uniqid(), 
            		'nome'     => $nome,
            		'email'    => $email,
            		'telefone' => $telefone
        	];
			
		array_push($contatosAuxiliar, $contato); //adiciona elementos no final do array
		salvarArquivo($contatosAuxiliar);
	
	}
	
	function pegarContatos($busca = null){
		
		$contatosAuxiliar = abrirArquivo();
		$contatosEncontrados = [];

		if ($busca == null OR $busca == "") {

			$contatosEncontrados = $contatosAuxiliar;

		 } else {

		 	foreach ($contatosAuxiliar as $contato) { //itera sobre o array
		 		if (strtolower($contato['nome']) == strtolower($busca)) {
		 			$contatosEncontrados[] = $contato;
		 		}
		 	}
		 }

		return $contatosEncontrados;
	}

	function excluirContato($id){
		$contatosAuxiliar = abrirArquivo();
		print_r($contatosAuxiliar);
		
		foreach ($contatosAuxiliar as $posicao => $contato){ //itera sobre o array
			if($id == $contato['id']) {			
				unset($contatosAuxiliar[$posicao]);
			
			}
		}
		
		salvarArquivo($contatosAuxiliar);
	
	}
	
	function editarContato($id){
		
		$contatosAuxiliar = abrirArquivo();

		foreach ($contatosAuxiliar as $contato){ //iteração
			if ($contato['id'] == $id){
				return $contato;
			}
		}
	}


	function SalvarContatoEditado($id, $nome, $email, $telefone){
		
		$contatosAuxiliar = abrirArquivo();
		foreach ($contatosAuxiliar as $posicao => $contato){ //iteração
			if ($contato['id'] == $id){
				$contatosAuxiliar[$posicao]['nome']     = $nome;
             			$contatosAuxiliar[$posicao]['email']    = $email;
             			$contatosAuxiliar[$posicao]['telefone'] = $telefone;
				break;
			}
		}
		salvarArquivo($contatosAuxiliar);
	}
	
	if ($_GET['acao'] == 'cadastrar') {
		cadastrar($_POST['nome'], $_POST['email'], $_POST['telefone']);
	} elseif ($_GET['acao'] == 'excluir'){
		excluirContato($_GET['id']);
	} elseif ($_GET['acao'] == 'editar') {
		SalvarContatoEditado($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
	}
