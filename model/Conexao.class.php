<?php
	class Conexao extends PDO{
		private static $instancia;

		private function __construct($dns, $user, $pass){
			parent::__construct($dns, $user, $pass);
		}

		public static function getInstancia(){
			if(!isset(self::$instancia)){
				try{
					self::$instancia=new self("mysql:dbname=teste_software_vista;host=localhost;charset=utf8mb4","root","root");
				}catch(Exception $e){
					die('Erro ao conectar na base de dados');
				}
			}
			return self::$instancia;
		}
	}
