<?php

class MensalidadeDAO
{

	private $conexao;

	public function __construct()
	{
		$this->conexao = Conexao::getInstancia();
	}

	public function cadastrarMensalidade($mensalidade)
	{
		$data  = array(
			'contrato_id' => $mensalidade->contrato_id,
			'valor' => $mensalidade->valor,
			'mes' => $mensalidade->mes,
			'paga' => 0
		);
		$query = new Query;
		$erro  = $query->insert('mensalidades', $data);

		if (!$erro[1]) {
			return $query->lastInsertId('id');
		} else {
			return $erro;
		}
	}

	public function buscarMensalidade($id)
	{
		$select = new Query;
		$select->select();
		$select->where('id = ' . $id);

		return $select->queryRow('mensalidades');
	}

	public function buscarMensalidadesContrato($contrato)
	{
		$select = new Query;
		$select->select();
		$select->where('contrato_id = ' . $contrato);

		return $select->query('mensalidades');
	}

	public function listarMensalidades()
	{
		$select = new Query;
		$select->select('m.*, c.*, p.nome as proprietario');
		$select->from('mensalidades as m');
		$select->classe('Mensalidade');
		$select->innerJoin('contratos as c', 'c.id=m.contrato_id');
		$select->innerJoin('proprietarios as p', 'p.id=c.proprietario_id');
		// $select->innerJoin('clientes as l', 'l.id=c.locatario_id');

		return $select->query('mensalidades as c');
	}

	public function alterarMensalidade($mensalidade)
	{
		$data  = array(
			'contrato_id' => $mensalidade->contrato_id,
			'valor' => $mensalidade->valor,
			'mes' => $mensalidade->mes,
			'paga' => $mensalidade->paga
		);
		$query = new Query;
		$query->where('id = ' . $mensalidade->id);

		return $query->update('mensalidades', $data);
	}

	public function pagarMensalidade($mensalidade)
	{
		$data  = array(
			'paga' => 1
		);
		$query = new Query;
		$query->where('id = ' . $mensalidade);

		return $query->update('mensalidades', $data);
	}

	public function excluirMensalidade($id)
	{
		$query = new Query;
		$query->where('id = ' . $id);

		return $query->delete('mensalidades');
	}
}
