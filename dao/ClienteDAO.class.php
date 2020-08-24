<?php

class ClienteDAO {

	private $conexao;

	public function __construct () {
		$this->conexao=Conexao::getInstancia();
	}

	public function cadastrarCliente ( $cliente ) {

		$data  = array( 'nome' => $cliente->nome, 'email' => $cliente->email, 'telefone' => $cliente->telefone );
		$query = new Query;	
		$erro  = $query->insert('clientes', $data);

		if ( !$erro[1] ) {
			return $query->lastInsertId('id');
		} else {
			return $erro;
		}
	}

	public function buscarCliente($id)
	{
		$select = new Query;
		$select->select();
		$select->where('id = ' . $id);

		return $select->queryRow('clientes');
	}

	public function listarClientes () {

		$select = new Query;
		$select->select();

		return $select->query('clientes');
	}

	public function alterarCliente ( $cliente ) {

		$data  = array( 'cliente' => $cliente->cliente, 'sigla' => $cliente->sigla );
		$query = new Query;
		$query->where('id = '.$cliente->id);

		return $query->update('clientes', $data);
	}

	public function excluirCliente ( $id ) {

		$query = new Query;
		$query->where('id = '. $id);

		return $query->delete('clientes');
	}

}