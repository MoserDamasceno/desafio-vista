<?php

class UsuarioDAO {

	private $conexao;

	public function __construct () {

		$this->conexao=Conexao::getInstancia();
	}

	public function cadastrarUsuario ( $usuario ) {

		$data = array(
			'nome' => $usuario->nome,
			'login' => $usuario->login,
			'senha' => $usuario->senha,
			'tipo_usuario' => $usuario->tipo_usuario,
			'pais_id' => $usuario->pais_id
		);

		$query = new Query;

		return $query->insert('usuarios', $data);
	}

	public function listarUsuarios () {

		$query = new Query;
		$query->select('u.id_usuario, u.nome, u.login, t.tipo_usuario, u.pais_id, u.status, u.hash, t.id_tipo_usuario, p.id_pais, p.pais, p.sigla');
		$query->classe('Usuario');
		$query->innerJoin('tipos_usuarios as t', 't.id_tipo_usuario=u.tipo_usuario');
		$query->leftJoin('paises as p', 'p.id_pais=u.pais_id');
		$query->where('t.id_tipo_usuario != 3');
		$query->where('deleted = 0');
		$query->orderBy('u.nome');

		return $query->get('usuarios as u');
	} 

	public function listarDistribuidores () {

		$sql  = "SELECT * FROM usuarios AS u ";
		$sql .= "INNER JOIN tipos_usuarios as t ON t.id_tipo_usuario=u.tipo_usuario ";
		$sql .= "LEFT JOIN paises as p ON p.id_pais=u.pais_id ";
		$sql .= "WHERE u.tipo_usuario = 2 AND deleted = 0 ORDER BY u.nome";
		$consulta = $this->conexao->query($sql);

		return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
	}

	public function buscarDistribuidor ( $id_usuario ) {

		$sql  = "SELECT * from usuarios  AS u ";
		$sql .= "INNER JOIN tipos_usuarios as t ON t.id_tipo_usuario=u.tipo_usuario ";
		$sql .= "LEFT JOIN paises as p ON p.id_pais=u.pais_id ";
		$sql .= "WHERE u.id_usuario = $id_usuario AND u.tipo_usuario = 2 AND deleted = 0 ORDER BY u.nome";
		$consulta = $this->conexao->query($sql);

		return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
	}

	public function listarAdministradores () {

		$query = new Query;
		$query->where('tipo_usuario = 1');
		$query->where('status = 1');
		$query->where('deleted = 0');
		$query->orderBy('nome');

		return $query->get('usuarios');
	} 

	public function verificarUsuario ( $login, $senha ) {

		$login = addslashes($login);
		$senha = addslashes($senha);

		$sql  = "SELECT * FROM usuarios ";
		$sql .= "WHERE login='{$login}' AND senha='{$senha}' AND status=1 AND deleted = 0";
		
		$consulta =	$this->conexao->query($sql);
		return $consulta->fetchObject('Usuario');
	}

	public function buscarUsuario ( $param ) {

		$query = new Query;

		if ( is_numeric($param) ) {
			$cond = 'id_usuario = '.$param;
		} else {
			$cond = 'login like "'.$param.'"';
		}

		$query->where($cond);
		$query->where('deleted = 0');
		$query->classe('Usuario');

		return $query->getRow('usuarios');
	}

	public function buscarHash ( $hash , $id_usuario = null ) {

		$query = new Query;

		if ( $id_usuario !== null ) {
			$query->where('id_usuario = '.$id_usuario);
		}

		$query->where('hash like "'.$hash.'"');
		$query->where('deleted = 0');
		$query->classe('Usuario');

		return $query->getRow('usuarios');
	}

	public function alterarUsuario ( $usuario ) {

		$data = array(
			'nome'			=> $usuario->nome,
			'login'			=> $usuario->login,
			'tipo_usuario'	=> $usuario->tipo_usuario,
			'hash'			=> $usuario->hash
		);

		if ( $usuario->senha ) {
			$data['senha'] = $usuario->senha;
		}

		$query = new Query;
		$query->where('id_usuario = '.$usuario->id_usuario);

		return $query->update('usuarios', $data);
	}

	public function alterarSenha ( $usuario ) {

		$data['senha'] = $usuario->senha;		
		$query 		   = new Query;
		$query->where('id_usuario = '.$usuario->id_usuario);

		return $query->update('usuarios', $data);
	}

	public function excluirUsuario ( $id ) {

		$data  = array('deleted' => 1);
		$query = new Query;
		$query->where('id_usuario = '.$id);
		
		return $query->update('usuarios', $data);
	}

	public function ativarUsuario ( $id ) {

		$data  = array('status' => 1);
		$query = new Query;
		$query->where('id_usuario = '.$id);
		
		return $query->update('usuarios', $data);
	}

	public function desativarUsuario ( $id ) {

		$data  = array('status' => 0);
		$query = new Query;
		$query->where('id_usuario = '.$id);
		
		return $query->update('usuarios', $data);
	}

	public function buscarDistribuidoresComModificacao () {

		$query = new Query;
		$query->classe('Usuario');
		$query->innerJoin('distribuidores_produtos_regras as dpr', 'dpr.distribuidor_id = u.id_usuario');
		$query->innerJoin('documentos as d', ' dpr.id_distribuidores_produtos_regras = d.distribuidores_produtos_regras_id');
		$query->where('SUBSTR(d.hora_upload, 1 ,10) = CURRENT_DATE()');
		$query->where('u.deleted = 0');
		$query->groupBy('u.id_usuario');

		return $query->get('usuarios as u');
	}
	
}

?>