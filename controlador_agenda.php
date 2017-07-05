<?php

	function abrirArquivo(){

		$contatosAuxiliar = file_get_contents('contatos.json');
		$contatosAuxiliar = json_decode($contatosAuxiliar, true);

		return $contatosAuxiliar;
	}

	function cadastrar(){
			
		$contatosAuxiliar = abrirArquivo();

		$contato = [
			'id'       => uniqid(),
			'nome'     => $_POST['nome'],
			'email'    => $_POST['email'],
			'telefone' => $_POST['telefone']
			];
			
		array_push($contatosAuxiliar, $contato);

		$contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);

		file_put_contents('contatos.json', $contatosJson);
		
		header("Location: index.phtml");
	
	}
	
	function pegarContatos(){
		
		$contatosAuxiliar = abrirArquivo();
		
		return $contatosAuxiliar;
		
	}

	function excluirContato($id){

		$contatosAuxiliar = abrirArquivo();


		print_r($contatosAuxiliar);
		
		foreach ($contatosAuxiliar as $posicao => $contato){ //iteração
			if($id == $contato['id']) {			
				unset($contatosAuxiliar[$posicao]);
			
			}
		}
		
		$contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);
		
		file_put_contents('contatos.json', $contatosJson);
	
		header("Location: index.phtml");
	
	}

	function editarContato($id){
		
		$contatosAuxiliar = abrirArquivo();

		foreach ($contatosAuxiliar as $contato){ //iteração
			if ($contato['id'] == $id){
				return $contato;
			}
		}
	}

	function SalvarContatoEditado($id){

		$contatosAuxiliar = abrirArquivo();

		foreach ($contatosAuxiliar as $posicao => $contato){ //iteração
			if ($contato['id'] == $id){
				
				$contatosAuxiliar[$posicao]['nome']     = $_POST['nome'];
				$contatosAuxiliar[$posicao]['email']    = $_POST['email'];
				$contatosAuxiliar[$posicao]['telefone'] = $_POST['telefone'];

				break;
			}
		}

		$contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);

		file_put_contents('contatos.json', $contatosJson);
		
		header("Location: index.phtml");

	}

	if ($_GET['acao'] == 'cadastrar') {
		cadastrar();
	} elseif ($_GET['acao'] == 'excluir'){
		excluirContato($_GET['id']);
	} elseif ($_GET['acao'] == 'editar') {
		SalvarContatoEditado($_POST['id']);
	}
