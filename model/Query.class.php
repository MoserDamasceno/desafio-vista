<?php 

	/**
	* Classe para criar SQL Query
	*
	* @author Moser Damasceno
	* @version 1.0
	* @since 1.0.1
	* @copyright GPL © 2015
	* @access public
	* @package model
	* @example $query = new Query;
	*          return $query->get('usuarios'); // Retorna todos os itens da tabela usuários
	*/

	class Query
	{
		private $conexao;
		private $sql;
		private $select = 'SELECT *';
		private $from;
		private $where;
		private $innerJoin;
		private $leftJoin;
		private $rightJoin;
		private $queryType;
		private $orderBy;
		private $groupBy;
		private $limit;
		private $class;

		/**
		 * Quando é instanciado um objeto desta classe, é criado uma conexão com o banco de dados no padrão SingleTone
		 * 
		 * @method  __construct
		 * @author Moser Damasceno
		 * @date    2015-02-16
		 * @since   1.0.1
		 * @access public
		 */
		public function __construct(){
			$this->conexao=Conexao::getInstancia();
		}

		/**
		 * Retorna a query atual.
		 * 
		 * @method __toString
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @return string     Query construída té o momento
		 */
		public function __toString(){

			return $this->constructSelect(null);;
		}

		/**
		 * Determina as colunas que serão retornadas do banco de dados nos resultados.
		 * @method select
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.1
		 * @access public
		 * @param  string     $columns nomes das colunas separado por vírgulas. Valor padrão '*' (todas)
		 * @return void
		 */
		public function select($columns = null)
		{
			if (!is_array($columns)) {
				$columns = ($columns !== null)? $columns : '*';
			}else{
				$columns = implode(',', $columns);	
			}
			$this->select = 'SELECT '.$columns; 
			$this->queryType  = 'select';
		}

		/**
		 * Determina em qual tabela será feito a busca
		 * @method from
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.1
		 * @access 
		 * @param  string     $table tabela no qual será feito a busca
		 * @return void
		 */
		public function from($table)
		{
			$this->from = 'FROM '.$table;
		}

		/**
		 * Determina tabelas que serão inseridas na busca relacionada
		 * @method innerJoin
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $table nome da tabela a ser inserida na busca
		 * @param  string     $where parametro de relação
		 * @return void
		 * @example $query = new Query;
		 *          $query->innerJoin('tipos_usuarios as t', 't.id_tipo_usuario = u.id_usuario' );
		 *          $result = $query->get('usuarios as u');
		 */
		public function innerJoin($table, $where)
		{
			$this->innerJoin .= ' INNER JOIN '.$table.' ON '.$where;
		}

		/**
		 * Determina tabelas que serão inseridas na busca relacionada
		 * @method leftJoin
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $table nome da tabela a ser inserida na busca
		 * @param  string     $where parametro de relação
		 * @return void
		 * @example $query = new Query;
		 *          $query->leftJoin('tipos_usuarios as t', 't.id_tipo_usuario = u.id_usuario' );
		 *          $result = $query->get('usuarios as u');
		 */
		public function leftJoin($table, $where)
		{
			$this->leftJoin .= ' LEFT JOIN '.$table.' ON '.$where;
		}

		/**
		 * Determina tabelas que serão inseridas na busca relacionada
		 * @method rightJoin
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $table nome da tabela a ser inserida na busca
		 * @param  string     $where parametro de relação
		 * @return void
		 * @example $query = new Query;
		 *          $query->rightJoin('tipos_usuarios as t', 't.id_tipo_usuario = u.id_usuario' );
		 *          $result = $query->get('usuarios as u');
		 */
		public function rightJoin($table, $where)
		{
			$this->rightJoin .= ' RIGHT JOIN '.$table.' ON '.$where;
		}

		/**
		 * Determina a ordem do resultado da busca
		 * @method orderBy
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  strig     $order colunas que irão ser base para ordenar o resultado
		 * @return void
		 * @example $query = new Query;
		 *          $query->orderBy('nome ASC, idade DESC');
		 *          $result = $query->get('usuarios');
		 */
		public function orderBy($order)
		{
			$this->orderBy = ' ORDER BY '.$order;
		}

		/**
		 * Determina as colunas que serão base para agrupar os resultados
		 * @method groupBy
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  strig     $group colunas que irão ser base para agrupar o resultado
		 * @return void
		 * @example $query = new Query;
		 *          $query->groupBy('idade');
		 *          $result = $query->get('usuarios');
		 */
		public function groupBy($group)
		{
			$this->groupBy = ' GROUP BY '.$group;
		}

		/**
		 * Determina parâmetros para a busca
		 * @method where
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $param parametro para busca
		 * @return void
		 */
		public function where($param)
		{
			if (!$this->where) {
				$this->where = ' WHERE '. $param;
			}else{
				$this->where .= ' AND ' . $param;
			}
		}

		/**
		 * Determina parâmetros para a busca
		 * @method whereOr
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $param parametro para busca
		 * @return void
		 */
		public function whereOr($param)
		{
			if (!$this->where) {
				$this->where = ' WHERE '. $param;
			}else{
				$this->where .= ' OR ' . $param;
			}
		}

		/**
		 * Determina limite de resultados da busca
		 * @method limit
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  int     $limit número de resultados que serão retornados.
		 * @return void
		 */
		public function limit($limit)
		{
			$this->limit = ' LIMIT '.$limit;
		}

		/**
		 * Determina se o resultado será um Std Object ou um Objeto de uma classe específica.
		 * @method classe
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $class Nome da classe para retornar os resultados
		 * @return void
		 */
		public function classe($class)
		{
			$this->class = $class;
		}	

		/**
		 * Faz a busca no banco de dados em objetos
		 * @method get
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $table Nome da tabela para buscar os resultados
		 * @return array            retorna um array de objetos com o retultadoda busca
		 */
		public function get($table = null)
		{
			$sql =  $this->constructSelect($table);
			$consulta= $this->conexao->query($sql);
			if ($this->class) {
				$result=$consulta->fetchAll(PDO::FETCH_CLASS,$this->class);
			}else{
				$result=$consulta->fetchAll(PDO::FETCH_OBJ);
			}
			return $result;
		}

		/**
		 * Faz a busca no banco de dados e retorna os dados em array
		 * @method getArray
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access
		 * @param  string     $table Nome da tabela para buscar os resultados
		 * @return array            array multivalorado com resultado da query
		 */
		public function getArray($table = null)
		{
			$sql =  $this->constructSelect($table);
			$consulta= $this->conexao->query($sql);
			$result=$consulta->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		/**
		 * Faz a busca no bando de dados. Usada para quando precisar retornar apenas um elemento.
		 * @method getRow
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $table Nome da tabela para buscar os resultados
		 * @param  boolean     $array
		 * @return Object/Array      Se $array for verdadeiro o resultado será um array, se for falso um Objeto.
		 */
		public function getRow($table = null, $array = null)
		{
			$sql =  $this->constructSelect($table);
			$consulta= $this->conexao->query($sql);
			if (!$array) {
				if ($this->class) {
					$res = $consulta->fetch(PDO::FETCH_OBJ);
					$result = Utils::objectToObject($res ,$this->class);
				}else{
					$result=$consulta->fetch(PDO::FETCH_OBJ);
				}
			}else{
				$result=$consulta->fetch(PDO::FETCH_ASSOC);
			}
			return $result;
		}

		/**
		 * Insere os dados no banco de dados
		 * @method insert
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $table Nome da tabela para inserir os valores
		 * @param  array     $data  array com os campos e valores para ser inserido na tabela do banco de dados.
		 * @return array            array com os resultados da consulta mysql. Se êxito retorna um único elemento com valor '00000'
		 */
		public function insert($table,$data)
		{
			if (is_array($data) && count($data)) {
				$fields = implode(', ',array_keys( $data ));
				$values = '';
				for ($i=0; $i < count($data); $i++) { 
					$values .= (($i+1) == count($data)) ? '?' : '?,' ;
				}
				$com=$this->conexao->prepare("INSERT INTO $table ($fields) VALUES ($values)");
				$i = 1;
				foreach ($data as $key => $value) {
					$com->bindValue($i, $data[$key]);
					$i++;
				}
				$com->execute();
				return $com->errorInfo();
			}
		}

		/**
		 * Efetua a atualização de campos em tabela da base de dados.
		 * @method update
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $table Nome da tabela para atualizar os valores
		 * @param  array     $data  array com os campos e valores para ser alterados na tabela do banco de dados.
		 * @return array            array com os resultados da consulta mysql. Se êxito retorna um único elemento com valor '00000'
		 */
		public function update($table, $data)
		{
			if (is_array($data) && count($data) && $this->where) {
				$fields = '';
				$cont = 0;
				foreach ($data as $key => $value) {
					$fields .= (($cont+1) == count($data)) ? $key. ' = ?' : $key. ' = ?, ' ;
					$cont++;
				}
				$com = $this->conexao->prepare("UPDATE $table SET $fields {$this->where}");
				$i = 1;
				foreach ($data as $key => $value) {
					$com->bindValue($i, $data[$key]);
					$i++;
				}
				$com->execute();
				$erro = $com->errorCode();
				
				$this->conexao=null;
				return $erro;
			}

		}

		/**
		 * Apaga um registro no banco de dados.
		 * 
		 * @method delete
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string     $from Nome da tabela para apagar o registro
		 * @return array            array com os resultados da consulta mysql. Se êxito retorna um único elemento com valor '00000'
		 */
		public function delete($from = null)
		{	
			if ($from !== null) {
				$this->from = $from;
			}
			if ($this->where) {
				$com = $this->conexao->prepare("DELETE FROM {$this->from} {$this->where}");
				$com->execute();
				$this->conexao=null;
				return $com->errorCode();
			}
		}


		/**
		 * Retorna o último id inserido por auto increment
		 * @method lastInsertId
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string       $primary nome da primary key com auto increment para buscar o id
		 * @return int 			retorna o número do últimoi id inserido
		 */
		public function lastInsertId($primary)
		{
			return $this->conexao->lastInsertId($primary);
		}

		/**
		 * Faz a contrução da consulta baseado em atributos alterados pelos métodos.
		 * @method constructSelect
		 * @author Moser Damasceno
		 * @date   2015-02-16
		 * @since  1.0.0
		 * @access public
		 * @param  string          $table Nome da tabela para executar a consulta
		 * @return string 			Retorna o resultado da query criada.
		 */
		private function constructSelect($table)
		{
			if ($this->select) {
				$this->sql .= $this->select;
			}

			if ($table !== null) {
				$this->sql .= ' FROM '.$table;
			}else{
				$this->sql .=' '. $this->from;
			}

			if ($this->innerJoin) {
				$this->sql .= $this->innerJoin;
			}

			if ($this->leftJoin) {
				$this->sql .= $this->leftJoin;
			}

			if ($this->rightJoin) {
				$this->sql .= $this->rightJoin;
			}

			if ($this->where) {
				$this->sql .= $this->where;
			}

			if ($this->groupBy) {
				$this->sql .= $this->groupBy;
			}

			if ($this->orderBy) {
				$this->sql .= $this->orderBy;
			}

			if ($this->limit) {
				$this->sql .= $this->limit;
			}

			return $this->sql;


		}

		
		/**
		 * Deprecated - Faz a query conforme Query Type setada anteriormente
		 * 
		 * @method  query
		 * @author Moser Damasceno
		 * @date    2015-02-16
		 * @since   1.0.0
		 * @package Query
		 * @access public
		 * @deprecated
		 */
		public function query($table = null)
		{
			switch ($this->queryType) {
				case 'select':
				$sql =  $this->constructSelect($table);
				$consulta= $this->conexao->query($sql);
				if ($this->class) {
					$produtos=$consulta->fetchAll(PDO::FETCH_CLASS,$this->class);
				}else{
					$produtos=$consulta->fetchAll(PDO::FETCH_OBJ);
				}
				
				return $produtos;

				case 'update':
				return $this->constructUpdate($table);
				break;
				case 'delete':
				return $this->constructDelete($table);
				break;
				
			}
		}

		/**
		 * Deprecated - Faz a query e retorna uma linha conforme QueryType setada anteriormente
		 * 
		 * @method  query row
		 * @author Moser Damasceno
		 * @date    2015-02-16
		 * @since   1.0.0
		 * @package Query
		 * @access public
		 * @deprecated
		 */
		public function queryRow($table = null)
		{
			switch ($this->queryType) {
				case 'select':
				$sql =  $this->constructSelect($table);
				$consulta= $this->conexao->query($sql);
				$produtos=$consulta->fetch(PDO::FETCH_OBJ);
				return $produtos;

				case 'update':
				return $this->constructUpdate($table);
				break;
				case 'delete':
				return $this->constructDelete($table);
				break;
				
			}
		}
	}