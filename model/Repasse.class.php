<?php

class Repasse
{

	public $id;
	public $contrato_id;
	public $valor;
	public $mes;
	public $paga;
	
	public function __get($atributo)
	{
		return $this->$atributo;
	}
	public function __set($atributo, $valor)
	{
		$this->$atributo = $valor;
	}

	public function calcularRepasse($contrato)
	{
		$this->valor = $contrato->valor_aluguel - $contrato->taxa_administracao + $contrato->iptu;
	}

}
