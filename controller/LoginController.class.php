<?php

class LoginController {

	static function index () {
		ViewController::view('templates/clean-head');
		ViewController::view('login');
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

		Utils::redirect(BASE_URL);

	}
}

?>