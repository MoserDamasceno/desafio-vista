<?php

class ProprietarioDAO {

	private $conexao;

	public function __construct () {
		$this->conexao=Conexao::getInstancia();
	}

	public function cadastrarProprietario ( $proprietario ) {

		$data  = array(
			'nome' => $proprietario->nome,
			'email' => $proprietario->email,
			'telefone' => $proprietario->telefone,
			'dia_repasse' => $proprietario->dia_repasse
		);
		$query = new Query;	
		$erro  = $query->insert('proprietarios', $data);

		if ( !$erro[1] ) {
			return $query->lastInsertId('id');
		} else {
			return $erro;
		}
	}

	public function buscarProprietario($id)
	{
		$select = new Query;
		$select->select();
		$select->where('id = ' . $id);

		return $select->queryRow('proprietarios');
	}

	public function listarProprietarios() {

		$select = new Query;
		$select->select();

		return $select->query('proprietarios');
	}

	public function alterarProprietario ( $proprietario ) {
		$data  = array(
			'nome' => $proprietario->nome, 
			'email' => $proprietario->email, 
			'telefone' => $proprietario->telefone,
			'dia_repasse' => $proprietario->dia_repasse
		);
		$query = new Query;
		$query->where('id = '.$proprietario->id);

		return $query->update('proprietarios', $data);
	}

	public function excluirProprietario ( $id ) {

		$query = new Query;
		$query->where('id = '. $id);

		return $query->delete('proprietarios');
	}

}