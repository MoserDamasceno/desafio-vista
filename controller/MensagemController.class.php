<?php 
	
	class MensagemController 
	{

		/**
		 * Exibe uma mensagem ao usuário
		 * @method index
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access static
		 * @param  string     $mensagem Mensagem a ser exibida, pode ser usado código HTML
		 * @param  string     $titulo   Título da mensagem (ex: erro, sucesso, etc)
		 * @return void
		 */
		static function index($mensagem = null, $titulo = '')
		{
			$data['mensagem'] = $mensagem;
			$data['titulo'] = $titulo;

			ViewController::view('templates/header');
			ViewController::view('mensagem',$data);
			ViewController::view('templates/footer');
		}

		/**
		 * Exibe a mensagem caso o usuário não esteja logado ainda. 
		 * 
		 * @method login
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access static
		 * @param  string     $mensagem Mensagem a ser exibida, pode ser usado código HTML
		 * @param  string     $titulo   Título da mensagem (ex: erro, sucesso, etc)
		 * @return void
		 */
		static function login($mensagem = null, $titulo = 'Message')
		{
			$data['mensagem'] = $mensagem;
			$data['titulo'] = $titulo;
			
			ViewController::view('templates/clean-head');
			ViewController::view('mensagem/login',$data);
		}
	}
	

?>