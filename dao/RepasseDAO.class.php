<?php

class RepasseDAO
{

	private $conexao;

	public function __construct()
	{
		$this->conexao = Conexao::getInstancia();
	}

	public function cadastrarRepasse($repasse)
	{
		$data  = array(
			'contrato_id' => $repasse->contrato_id,
			'valor' => $repasse->valor,
			'mes' => $repasse->mes,
			'paga' => 0
		);
		$query = new Query;
		$erro  = $query->insert('repasses', $data);

		if (!$erro[1]) {
			return $query->lastInsertId('id');
		} else {
			return $erro;
		}
	}

	public function buscarRepasse($id)
	{
		$select = new Query;
		$select->select();
		$select->where('id = ' . $id);

		return $select->queryRow('repasses');
	}

	public function buscarRepassesContrato($contrato)
	{
		$select = new Query;
		$select->select();
		$select->where('contrato_id = ' . $contrato);

		return $select->query('repasses');
	}

	public function listarRepasses()
	{
		$select = new Query;
		$select->select('m.*, c.*, p.nome as proprietario');
		$select->from('repasses as m');
		$select->classe('Repasse');
		$select->innerJoin('contratos as c', 'c.id=m.contrato_id');
		$select->innerJoin('proprietarios as p', 'p.id=c.proprietario_id');
		// $select->innerJoin('clientes as l', 'l.id=c.locatario_id');

		return $select->query('repasses as c');
	}

	public function alterarRepasse($repasse)
	{
		$data  = array(
			'contrato_id' => $repasse->contrato_id,
			'valor' => $repasse->valor,
			'mes' => $repasse->mes,
			'paga' => $repasse->paga
		);
		$query = new Query;
		$query->where('id = ' . $repasse->id);

		return $query->update('repasses', $data);
	}

	public function pagarRepasse($repasse)
	{
		$data  = array(
			'paga' => 1
		);
		$query = new Query;
		$query->where('id = ' . $repasse);

		return $query->update('repasses', $data);
	}

	public function excluirRepasse($id)
	{
		$query = new Query;
		$query->where('id = ' . $id);

		return $query->delete('repasses');
	}
}
