<?php

class Cliente{
	
	public $id;
	public $nome;
	public $telefone;
	public $email;
	
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
