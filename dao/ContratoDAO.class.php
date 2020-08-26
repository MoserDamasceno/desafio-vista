<?php

class ContratoDAO {

	private $conexao;

	public function __construct () {
		$this->conexao=Conexao::getInstancia();
	}

	public function cadastrarContrato ( $contrato ) {
		$data  = array(
			'imovel_id' => $contrato->imovel_id,
			'proprietario_id' => $contrato->proprietario_id,
			'locatario_id' => $contrato->locatario_id,
			'inicio' => $contrato->inicio,
			'fim' => $contrato->fim,
			'taxa_administracao' => $contrato->taxa_administracao,
			'valor_aluguel' => $contrato->valor_aluguel,
			'condominio' => $contrato->condominio,
			'iptu' => $contrato->iptu
		);
		$query = new Query;	
		$erro  = $query->insert('contratos', $data);

		if ( !$erro[1] ) {
			return $query->lastInsertId('id');
		} else {
			return $erro;
		}
	}

	public function buscarContrato($id)
	{
		$select = new Query;
		$select->select();
		$select->where('id = ' . $id);

		return $select->queryRow('contratos');
	}

	public function listarContratos () {

		$select = new Query;
		$select->select('c.*, p.nome as proprietario, l.nome as locatario, i.endereco, i.cidade, i.bairro');
		$select->from('contratos as c');
		$select->classe('Contrato');
		$select->innerJoin('proprietarios as p', 'p.id=c.proprietario_id');
		$select->innerJoin('clientes as l', 'l.id=c.locatario_id');
		$select->innerJoin('imoveis as i', 'i.id=c.imovel_id');
		
		return $select->query('contratos as c');
	}

	public function alterarContrato( $contrato ) {
		$data  = array(
			'imovel_id' => $contrato->imovel_id,
			'proprietario_id' => $contrato->proprietario_id,
			'locatario_id' => $contrato->locatario_id,
			'inicio' => $contrato->inicio,
			'fim' => $contrato->fim,
			'taxa_administracao' => $contrato->taxa_administracao,
			'valor_aluguel' => $contrato->valor_aluguel,
			'condominio' => $contrato->condominio,
			'iptu' => $contrato->iptu
		);
		$query = new Query;
		$query->where('id = '.$contrato->id);

		return $query->update('contratos', $data);
	}

	public function excluirContrato ( $id ) {

		$query = new Query;
		$query->where('id = '. $id);

		return $query->delete('contratos');
	}

}