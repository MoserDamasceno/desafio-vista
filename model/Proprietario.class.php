<?php

class Proprietario{
	
	private $id;
	private $nome;
	private $telefone;
	private $email;
	private $dia_repasse;
	
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


?>
