<?php

class Usuario{
	
	public $id;
	public $nome;
	public $login;
	public $senha;
	public $tipo_usuario;
	public $status;
	public $hash;
	
	public function __get($atributo){
		return $this->$atributo;
	}
	public function __set($atributo,$valor){
		$this->$atributo=$valor;
	}
	public function __toString(){
		return $this->nome;
	}

}