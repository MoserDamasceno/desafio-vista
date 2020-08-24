<?php

class Contrato
{

	public $id;
	public $imovel_id;
	public $proprietario_id;
	public $locatario_id;
	public $inicio;
	public $fim;
	public $taxa_administracao;
	public $valor_aluguel;
	public $condominio;
	public $iptu;

	public function __get($atributo)
	{
		return $this->$atributo;
	}
	public function __set($atributo, $valor)
	{
		$this->$atributo = $valor;
	}

}
