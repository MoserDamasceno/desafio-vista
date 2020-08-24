<?php 

	$requestURI = explode('/', $_SERVER['REQUEST_URI']);
	$scriptName = explode('/',$_SERVER['SCRIPT_NAME']);

	for ( $i= 0; $i < sizeof($scriptName); $i++ ) {

		if ( $requestURI[$i] == $scriptName[$i] ) {
			unset($requestURI[$i]);
		}
	}

	$command = array_filter(array_values($requestURI));
	
	if ( count($command) ) {

		$file 	= 'controller/'.ucfirst($command[0]).'Controller.class.php';
		$classe = ucfirst($command[0]).'Controller';
		$funcao = (isset($command[1])) ? $command[1] : 'index' ;
		$param  = array();

		if ( sizeof($command) > 2 ) {

			for ( $i=3; $i <= sizeof($command); $i++ ) { 
				$param[] = $command[$i-1];
			}	
		}

		if ( !LoginController::logado() && $classe != 'AjaxController' ) {

			if ( $classe != 'LoginController' && $funcao != 'logar' ) {
				Utils::redirect(BASE_URL);
				die;
			}
		}

		if ( is_callable( $classe.'::'.$funcao ) ) {

			if ( LoginController::verificarPermissao($classe, $funcao) ) {

				$conf = array($classe,$funcao);

				if ( count($param)<= 0 ) {
					$param = null;
				}

				call_user_func($conf, $param);

			} else {
				MensagemController::index('Você não tem permissão para acessar esta página <br/><br/><a href="'.BASE_URL.'"> Voltar</a>.', 'Erro');
				die;
			}

		} else {
			MensagemController::index('Página não encontrada.', 'Erro 404');
		}

	} else {

		if ( !LoginController::logado() ) {
			LoginController::index();
			die;
		}

		DashboardController::index();
	}
	
?>