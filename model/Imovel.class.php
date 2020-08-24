<?php

class Imovel{
	
	private $id;
	private $endereco;
	private $proprietario_id;
	
	public function __get($atributo){
		return $this->$atributo;
	}
	public function __set($atributo,$valor){
		$this->$atributo=$valor;
	}

}


?>
