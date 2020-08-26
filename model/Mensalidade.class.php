<?php

class Mensalidade
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

	public function calcularMensalidade($contrato)
	{
		$this->valor = $contrato->valor_aluguel + $contrato->condominio + $contrato->iptu;
	}

	public function calcularDataFim()
	{
		$fim = date('Y-m-d', strtotime("+12 months", strtotime($this->inicio)));
		$this->fim = $fim;
	}



}
