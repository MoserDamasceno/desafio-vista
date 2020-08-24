<?php 
	
	/**
	* Classe controladora do módulo de usuários do sistema
	*
	* @author Moser Damasceno
	* @version 1.0.0
	* @access public
	* @package Usuario
	* @example Classe UsuarioController;
	*/

	class UsuarioController 
	{
		/**
		 * Direciona para a página de listagem de usuário
		 * @method index
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @return void
		 */
		static function index()
		{
			if (LoginController::verificarAcesso()) {
				Utils::redirect(BASE_URL.'usuario/listar');
			}else{
				Utils::redirect(BASE_URL.'produto/documents');
			}
		}

		/**
		 * Salva um novo usuário no sistema. 
		 * Exibe mensagem caso sucesso ou erro.
		 * 
		 * @method salvar
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access static
		 * @return void
		 */
		static function salvar()
		{
			$usuario = new Usuario;
			$usuario->nome = $_POST['nome'];
			$usuario->login = $_POST['login'];
			$usuario->senha = Utils::encrypt($_POST['senha']);
			$usuario->tipo_usuario = $_POST['tipo'];
			$usuario->pais_id = $_POST['pais'];
			$usuario->status = 1;

			$usuarioDAO = new UsuarioDAO;
			$erro = $usuarioDAO->cadastrarUsuario($usuario);

			if (!$erro[1]) {
				// $mensagem = 'User successfully added!<br/><br/><a href="'.BASE_URL.'usuario/listar">Back</a>';
				// MensagemController::index($mensagem);
				Utils::redirect(BASE_URL.'usuario/listar');
			}else if ($erro[1] == 1062) {
				$mensagem = 'User can\'t be created, the email: <b>'.$usuario->login.'</b> already been used.<br/><br/><a href="javascript:history.back()">Back</a>';
				MensagemController::index($mensagem);
			}else{
				$mensagem = 'User can\'t be created! Error message: '.$erro[2].'.<br/><br/><a href="'.BASE_URL.'usuario/criar">Back</a>';
				MensagemController::index($mensagem);
			}


		}

		/**
		 * Exibe a listagem de todos usuários do sistema
		 * 
		 * @method  listar
		 * @author Moser Damasceno
		 * @date    2015-02-16
		 * @since   1.0.0
		 * @package Usuario
		 * @access static
		 * @return  void
		 */
		static function listar()
		{
			$usuarioDAO = new UsuarioDAO;
			$data['usuarios'] = $usuarioDAO->listarUsuarios();
			
			$tipoDAO = new TipoUsuarioDAO;
			$tipos = $tipoDAO->listarTipos();
			$data['tipos'] = $tipos;

			$paisDAO = new PaisDAO;
			$paises = $paisDAO->listarPaises();
			$data['paises'] = $paises;

			ViewController::view('templates/header');
			ViewController::view('usuario/listar', $data);
			ViewController::view('templates/footer');
		}

		/**
		 * Exibe tela para edição de usuário
		 * 
		 * @method  editar
		 * @author Moser Damasceno
		 * @date    2015-02-16
		 * @since   1.0.0
		 * @package Usuario
		 * @access static
		 * @param   array     $id id do usuário a ser editado
		 * @return  void
		 */
		static function editar($id)
		{
		
			if (LoginController::verificarAcesso()) {
				$usuario = $id[0];
			}else{
				$usuario = $_SESSION['id_usuario'];
			}

			$usuarioDAO = new UsuarioDAO;
			$data['usuario'] = $usuarioDAO->buscarUsuario($usuario);

			$tipoDAO = new TipoUsuarioDAO;
			$tipos = $tipoDAO->listarTipos();
			$data['tipos'] = $tipos;

			$paisDAO = new PaisDAO;
			$paises = $paisDAO->listarPaises();
			$data['paises'] = $paises;

			ViewController::view('templates/header');
			ViewController::view('usuario/editar', $data);
			ViewController::view('templates/footer');

		}

		/**
		 * Efetua as alteraçoes do formulário de edição de usuários.
		 * 
		 * @method  alterar
		 * @author Moser Damasceno
		 * @date    2015-02-16
		 * @since   1.0.0
		 * @package Usuario
		 * @access static
		 * @return  void
		 */
		static function alterar()
		{

			$usuario = new Usuario;

			$usuario->id_usuario = $_POST['id_usuario'];
			$usuario->senha = (isset($_POST['senha']) && $_POST['senha'] != '' ) ?  Utils::encrypt($_POST['senha']) : false;
			$usuarioDAO = new UsuarioDAO;

			if (LoginController::verificarAcesso()) {
				$usuario->nome = $_POST['nome'];
				$usuario->login = $_POST['login'];
				$usuario->tipo_usuario = $_POST['tipo'];
				// $usuario->pais_id = $_POST['pais'];
				$erro = $usuarioDAO->alterarUsuario($usuario);
			}else{
				$erro = $usuarioDAO->alterarSenha($usuario);
			}

			if (!$erro[1]) {
				Utils::redirect(BASE_URL.'usuario');
			}else if ($erro[1] == 1062) {
				$mensagem = 'User can\'t be updated, the email: <b>'.$usuario->login.'</b> already been used.<br/><br/><a href="javascript:history.back()">Back</a>';
				MensagemController::index($mensagem);
			}else{
				$mensagem = 'User can\'t be updated! Error message: '.$erro[2].'.<br/><br/><a href="'.BASE_URL.'usuario/criar">Back</a>';
				MensagemController::index($mensagem);
			}


		}

		/**
		 * Ativa usuário que estava inativo no sistema.
		 * 
		 * @method  ativar
		 * @author Moser Damasceno
		 * @date    2015-02-16
		 * @since   1.0.0
		 * @package Usuario
		 * @access static
		 * @param   array     $id[0] id do usuário a ser ativado
		 * @return  void
		 */
		static function active($id)
		{
			$usuarioDAO = new UsuarioDAO;
			$erro = $usuarioDAO->ativarUsuario($id[0]);

			if (!$erro[1]) {
				Utils::redirect(BASE_URL.'usuario/listar');
			}else{
				$mensagem = 'User can\'t be activated! Error message: '.$erro[2].'.<br/><br/><a href="'.BASE_URL.'usuario/listar">Back</a>';
				MensagemController::index($mensagem);
			}
		}

		/**
		 * desativa usuário que estava ativo no sistema.
		 * 
		 * @method  desativar
		 * @author Moser Damasceno
		 * @date    2015-02-16
		 * @since   1.0.0
		 * @package Usuario
		 * @access static
		 * @param   array     $id[0] id do usuário a ser desativado
		 * @return  void
		 */
		static function desactive($id)
		{
			if ($id[0] != $_SESSION['id_usuario']) {
				$usuarioDAO = new UsuarioDAO;
				$erro = $usuarioDAO->desativarUsuario($id[0]);

				if (!$erro[1]) {
					Utils::redirect(BASE_URL.'usuario/listar');
				}else{
					$mensagem = 'User can\'t be unactivated! Error message: '.$erro[2].'.<br/><br/><a href="'.BASE_URL.'usuario/listar">Back</a>';
					MensagemController::index($mensagem);
				}
			}else{
				$mensagem = 'You must be unlogged to desactivate this user.<br/><br/><a href="'.BASE_URL.'usuario/listar">Back</a>';
				MensagemController::index($mensagem);
			}
		}

		/**
		 * Exclui um usuário do sistema
		 * 
		 * @method  excluir
		 * @author Moser Damasceno
		 * @date    2015-02-16
		 * @since   1.0.0
		 * @package Usuario
		 * @access static
		 * @param   array     $id[0] id do usuário a ser excluído
		 * @return  void
		 */
		static function delete($id)
		{
			if ($id[0] != $_SESSION['id_usuario']) {
				$usuarioDAO = new UsuarioDAO;
				$erro = $usuarioDAO->excluirUsuario($id[0]);

				if (!$erro[1]) {
					$mensagem = 'User successfully deleted.<br/><br/><a href="'.BASE_URL.'usuario/listar">Back</a>';
					MensagemController::index($mensagem);
				}else{
					$mensagem = 'User can\'t be deleted! Error message: '.$erro[2].'.<br/><br/><a href="'.BASE_URL.'usuario/listar">Back</a>';
					MensagemController::index($mensagem);
				}
			}else{
				$mensagem = 'You must be unlogged to delete this user.<br/><br/><a href="'.BASE_URL.'usuario/listar">Back</a>';
				MensagemController::index($mensagem);
			}
		}

		/**
		 * Deprecated - Ajax - Exiba Option com lista de tipos de usuários.
		 * @method  listar_option_tipo_usuario
		 * @author Moser Damasceno
		 * @date    2015-02-16
		 * @since   1.0.0
		 * @package Usuario
		 * @access static
		 * @return  void
		 * @deprecated
		 */
		static function listar_option_tipo_usuario()
		{
			$tipoDAO = new TipoUsuarioDAO;
			$tipos = $tipoDAO->listarTipos();
			foreach ($tipos as $tipo) {
				echo '<option value="'.$tipo->id_tipo_usuario.'">'.$tipo->tipo_usuario.'</option>'. PHP_EOL;
			}
		}




	}



?>