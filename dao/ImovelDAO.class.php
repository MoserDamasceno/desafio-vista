<?php

class ImovelDAO {

	private $conexao;

	public function __construct () {
		$this->conexao=Conexao::getInstancia();
	}

	public function cadastrarImovel ( $imovel ) {
		$data  = array(
			'endereco' => $imovel->endereco,
			'numero' => $imovel->numero,
			'complemento' => $imovel->complemento,
			'bairro' => $imovel->bairro,
			'cidade' => $imovel->cidade,
			'estado' => $imovel->estado,
			'proprietario_id' => $imovel->proprietario_id,
		);
		$query = new Query;	
		$erro  = $query->insert('imoveis', $data);

		if ( !$erro[1] ) {
			return $query->lastInsertId('id');
		} else {
			return $erro;
		}
	}

	public function buscarImovel($id)
	{
		$select = new Query;
		$select->select();
		$select->where('id = ' . $id);

		return $select->queryRow('imoveis');
	}

	public function listarImoveis () {

		$select = new Query;
		$select->select();

		return $select->query('imoveis');
	}

	public function alterarImovel( $imovel ) {
		$data  = array(
			'endereco' => $imovel->endereco,
  	    	'numero' => $imovel->numero,
			'complemento' => $imovel->complemento,
			'bairro' => $imovel->bairro,
			'cidade' => $imovel->cidade,
			'estado' => $imovel->estado,
			'proprietario_id' => $imovel->proprietario_id,
		);
		$query = new Query;
		$query->where('id = '.$imovel->id);

		return $query->update('imoveis', $data);
	}

	public function excluirImovel ( $id ) {

		$query = new Query;
		$query->where('id = '. $id);

		return $query->delete('imoveis');
	}

}