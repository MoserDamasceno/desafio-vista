<?php

class LoginController {

	static function index () {
		ViewController::view('templates/clean-head');
		ViewController::view('login');
	}

	static function esqueci_senha ( $hash = null ) {

		$usuarioDAO = new UsuarioDAO;

		if ( $_POST ) {

			$email   = $_POST['email'];
			$usuario = $usuarioDAO->buscarUsuario($email);

			if ( $usuario ) {

				$usuario->hash = Utils::encrypt($usuario->login. time());
				$usuarioDAO->alterarUsuario($usuario);

				$options = array(
					'email' => $email,
					'nome' => $usuario->nome,
					'subject' => 'Password Recovery',
					'body' => 'Click on the following link to retrieve your password.<br/><br/>
						<a href="'.BASE_URL.'login/esqueci_senha/'.$usuario->hash.'" >'.BASE_URL.'login/esqueci_senha/'.$usuario->hash.'</a>'
					);

				echo (Email::enviar($options)) ? '1' : '0' ;
			} else {
				echo '2';
			}

		} else if ( $hash !== null ) {

			$user_hash = $usuarioDAO->buscarHash($hash[0]);

			if ( $user_hash ) {
				$data['usuario'] = $user_hash;
				ViewController::view('templates/clean-head');
				ViewController::view('login/nova-senha', $data);
			} else {
				Utils::redirect(BASE_URL);
			}
		}
	}

	static function change_password()
	{
		if ($_POST) {
			$senha = $_POST['senha'];
			$senha2 = $_POST['senha2'];
			$hash = $_POST['hash'];
			$id_usuario = $_POST['id_usuario'];
			
			if ( $senha == $senha2 ) {
				$usuarioDAO = new UsuarioDAO;
				$usuario = $usuarioDAO->buscarHash($hash, $id_usuario);
				if ($usuario) {
					$usuario->senha = Utils::encrypt($senha);
					$usuario->hash = null;
					$res = $usuarioDAO->alterarUsuario($usuario);
					if ($res) {
						$mensagem = 'Password has been updated! <br /><br /><a href="'.BASE_URL.'">Back</a>';
						MensagemController::login($mensagem);
					}else{
						$mensagem = 'Password could not ben updated! <br /><br /><a href="'.BASE_URL.'">Back</a>';
						MensagemController::login($mensagem);
					}
				}else{
					$mensagem = 'This user does not exists! <br /><br /><a href="'.BASE_URL.'">Back</a>';
					MensagemController::login($mensagem);
				}
			}else{
				$mensagem = 'Passwords are not the same! <br /><br /><a href="javascript:window.history.back()">Back</a>';
				MensagemController::login($mensagem);
			}
		}else{
			Utils::redirect(BASE_URL);
		}
	}


	/**
	 * Efetua o Logoff do usuário do sistema
	 *
	 * @method deslogar
	 * @author Moser Damasceno
	 * @date   2020-08-20
	 * @since  1.0.0
	 */
	static function deslogar()
	{
		session_destroy();
		Utils::redirect(BASE_URL);

	}

	/**
	 * Verifica se há algum usuário logado
	 * @method logado
	 * @author Moser Damasceno
	 * @date   2020-08-20
	 * @since  1.0.0
	 * @return Boolean
	 *
	 */
	static function logado()
	{
		if (isset($_SESSION['id_usuario'])) {
			$registro = $_SESSION['registro'];
			$limite = 1800; // Tempo em segundos para a sessão expirar
			$segundos = time()- $registro;
			if($segundos>$limite)
			{
				session_destroy();
				Utils::redirect(BASE_URL);
			}
			else{
				$_SESSION['registro'] = time();
				return true;
			}
		}else{
			return false;
		}
		
	}


	/**
	 * Efetua o login do usuário no sistema.
	 *
	 * @method logar
	 * @author Moser Damasceno
	 * @date   2020-08-20
	 * @since  1.0.0
	 */
	static function logar()
	{
		if ($_POST) {
			$usuarioDAO = new UsuarioDAO;
			$usuario = $usuarioDAO->verificarUsuario($_POST['login'],Utils::encrypt($_POST['senha']));
			if ($usuario) {
				$_SESSION['id_usuario'] = $usuario->id_usuario;
				$_SESSION['nome'] = $usuario->nome;
				$_SESSION['login'] = $usuario->login;
				$_SESSION['tipo_usuario'] = $usuario->tipo_usuario;
				$_SESSION['status'] = $usuario->status;
				$_SESSION['registro'] = time(); 
			 }
			 else
			 {
				$mensagem = 'Invalid Login or Password!  <br /><br /><a href="'.BASE_URL.'">Back</a>';
				MensagemController::login($mensagem);
				die;
			 }
		}

		if ($usuario->tipo_usuario == 1) {
			Utils::redirect(BASE_URL);
		} else {
			Utils::redirect(BASE_URL . 'produto/documents');
		}

	}


	/**
	 * Verifica o tipo de usuário para ver a permissão do mesmo para determinadas áreas e retornos do site.
	 * @method verificarAcesso
	 * @author Moser Damasceno
	 * @date   2014-12-22
	 * @since  1.0.0
	 * @param  Integer $tipo_usuario Valor passado do tipo de usuário
	 * @return Boolean Retorna true para usuário admin e false para usuário normal.
	 */
	static function verificarAcesso($tipo_usuario = null)
	{

		if (!$tipo_usuario) {
			$tipo_usuario = $_SESSION['tipo_usuario'];
		}
		switch ($tipo_usuario) {
			case '1':
			case '3':
				return true;
			case '2':
				return false;
		}
	}


	/**
	 * Verifica a permissão do usuário para saber se o mesmo tem permissão de ver o menu ou acessar a página solicitada
	 *
	 * @method verificarPermissao
	 * @author Moser Damasceno
	 * @date   2020-08-20
	 * @since  1.0.0
	 * @param  String $controller
	 * @param  String $funcao
	 * @return Boolean
	 */
	static function verificarPermissao($controller, $funcao = null)
	{
		$tipo_usuario = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : false ;

		/** aberto ao usuário logado sem permissão de administrador*/
		$controllers['LoginController'] = array('deslogar');
		$controllers['UsuarioController'] = array('index', 'editar', 'alterar');
		$controllers['ProdutoController'] = array(
			'index',
			'documents',
			'distributors',
			'registration',
			'renewal',
			'amendments',
			'certificates',
			'upload_certificado',
			'download_certificado',
			'delete_certificado',
			'get_certificados_existentes',
			'salvar_certificados',
			'listar_documentos',
			'ver_registro',
			'upload_documento',
			'delete_documento',
			'download_documento',
			'alterar_registro',
			'download_amendment',
			'alterarData',
			'saveAmendments'
		);

		/** aberto sem necessidade de login */
		$controllers_opened['LoginController'] = array(
			'logar',
			'esqueci_senha',
			'change_password'
		);
		$controllers_opened['AjaxController'] = array(
			'enviar_email_distribuidores'
		);
		
		/** Verificação das permissões de acesso */
		switch ($tipo_usuario)
		{
			case '1':
			case '3':
				return true;
			case '2':
				if (!$funcao)
				{
					/*Verifica se o usuário tem permissão para ver os itens de menu*/
					return (in_array($controller, array_keys($controllers))) ? true : false;
				}
				else
				{
					/*Verifica se o usuário tem permissão para acessar a página solicitada*/
					return (in_array($controller, array_keys($controllers)) && in_array($funcao, $controllers[$controller])) ? true : false;
				}

			default:
				return (in_array($controller, array_keys($controllers_opened)) && in_array($funcao, $controllers_opened[$controller])) ? true : false;
		}
	}

}

?>