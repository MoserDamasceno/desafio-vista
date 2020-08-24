<?php

class Utils
{

	static function encrypt($string)
	{
		$salt = sha1($string);
		return md5($string.$salt);
	}

	static function pre($string, $die = false)
	{
		echo '<pre>';
		var_dump($string);
		echo '</pre>';
		if ($die) {
			die;
		}
	}

	static function redirect($url)
	{
		if ($url == 'back') {
			echo '<script type="text/javascript">window.history.back();</script>';
		}else{
			echo '<meta http-equiv="refresh" content="0;url='.$url.'">';
		}
	}

	static function convertDate($data, $output)
	{
		if ($data) {
			switch ($output) {
				case 'mysql':
				$data = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
				return $data;
				case 'php':
				$data = date('d/m/Y', strtotime(str_replace('-', '/', $data)));
				return $data;
			}
		}

	}

	static function download($documento, $delete = null)
	{

		$arquivo = UPLOAD_DIR. $documento;

		if(isset($arquivo) && file_exists($arquivo)){
			/* faz o teste se a variavel não esta vazia e se o arquivo realmente existe */
			$tipo = strtolower(substr(strrchr(basename($arquivo),"."),1));
			switch($tipo){
				/*verifica a extensão do arquivo para pegar o tipo */
				case "pdf":
				$tipo="application/pdf";
				break;
				case "txt":
				$tipo="text/plain";
				break;
				case "zip":
				$tipo="application/zip";
				break;
				case "doc":
				$tipo="application/msword";
				break;
				case "xls":
				$tipo="application/vnd.ms-excel";
				break;
				case "ppt":
				$tipo="application/vnd.ms-powerpoint";
				break;
				case "gif":
				$tipo="image/gif";
				break;
				case "png":
				$tipo="image/png";
				break;
				case "jpg":
				$tipo="image/jpg";
				case "jpeg":
				$tipo="image/jpeg";
				break;
				case "mp3":
				$tipo="audio/mpeg";
				break;
				case "php": /* deixar vazio por seurança */
				case "htm": /* deixar vazio por seurança */
				case "html": /* deixar vazio por seurança */
				case "exe": /* deixar vazio por seurança */
				break;

			}
			if($tipo == "application/zip")
			{
				header("Content-Type: " . $tipo);
				header("Content-Transfer-Encoding: binary");
				header('Pragma: public');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header("Cache-Control: public");
				header("Content-Description: File Transfer");
			}
			else
			{
				header("Content-Type: ".$tipo);
			}
			/* informa o tamanho do arquivo ao navegador */
			header("Content-Disposition: attachment; filename=".basename($arquivo));

			/* informa o tipo do arquivo ao navegador */
			header("Content-Length: ".filesize($arquivo));
			/* informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo */
			ob_end_flush();
			readfile($arquivo);
			/* lê o arquivo */

			if ($delete !== null) {
				unlink(UPLOAD_DIR. $documento);
			}
			exit;
			/* aborta pós-ações */
		}


	}

	static function calculaPorcentagem($data_inicio, $data_fim)
	{
		$date  = new DateTime($data_inicio);
		$date2 = new DateTime($data_fim);

		Utils::pre($date->diff($date2));
	}

	static function objectToArray($object) {
		$res_array = array();
		foreach ($object as $obj) {
			$res_array[] = (array) $obj;
		}
		return $res_array;
	}

	static function jsonEncodeObjeto($item){
		if(!is_array($item) && !is_object($item)){
			return json_encode($item);
		}else{
			$pieces = array();
			foreach($item as $k=>$v){
				$pieces[] = "\"$k\":".Utils::jsonEncodeObjeto($v);
			}
			return '{'.implode(',',$pieces).'}';
		}
	}

	static function objectToObject($instance, $className) {
		return unserialize(sprintf(
			'O:%d:"%s"%s',
			strlen($className),
			$className,
			strstr(strstr(serialize($instance), '"'), ':')
			));
	}

	static function removeAcentos($string, $slug = false) {
		// $string = strtolower($string);

		// Código ASCII das vogais
		$ascii['a'] = range(224, 230);
		$ascii['e'] = range(232, 235);
		$ascii['i'] = range(236, 239);
		$ascii['o'] = array_merge(range(242, 246), array(240, 248));
		$ascii['u'] = range(249, 252);

	  	// Código ASCII dos outros caracteres
		$ascii['b'] = array(223);
		$ascii['c'] = array(231);
		$ascii['d'] = array(208);
		$ascii['n'] = array(241);
		$ascii['y'] = array(253, 255);

		foreach ($ascii as $key=>$item) {
			$acentos = '';
			foreach ($item AS $codigo) $acentos .= chr($codigo);
			$troca[$key] = '/['.$acentos.']/i';
		}

		$string = preg_replace(array_values($troca), array_keys($troca), $string);

	  	// Slug?
		if ($slug) {
		// Troca tudo que não for letra ou número por um caractere ($slug)
			$string = preg_replace('/[^a-z0-9]/i', $slug, $string);
		// Tira os caracteres ($slug) repetidos
			$string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
			$string = trim($string, $slug);
		}

		return $string;
	}

	static function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && self::in_array_r($needle, $item, $strict))) {
				return true;
			}
		}

		return false;
	}

	static function prettyPrint( $json )
	{
		$result = '';
		$level = 0;
		$in_quotes = false;
		$in_escape = false;
		$ends_line_level = NULL;
		$json_length = strlen( $json );

		for( $i = 0; $i < $json_length; $i++ ) {
			$char = $json[$i];
			$new_line_level = NULL;
			$post = "";
			if( $ends_line_level !== NULL ) {
				$new_line_level = $ends_line_level;
				$ends_line_level = NULL;
			}
			if ( $in_escape ) {
				$in_escape = false;
			} else if( $char === '"' ) {
				$in_quotes = !$in_quotes;
			} else if( ! $in_quotes ) {
				switch( $char ) {
					case '}': case ']':
					$level--;
					$ends_line_level = NULL;
					$new_line_level = $level;
					break;

					case '{': case '[':
					$level++;
					case ',':
					$ends_line_level = $level;
					break;

					case ':':
					$post = " ";
					break;

					case " ": case "\t": case "\n": case "\r":
					$char = "";
					$ends_line_level = $new_line_level;
					$new_line_level = NULL;
					break;
				}
			} else if ( $char === '\\' ) {
				$in_escape = true;
			}
			if( $new_line_level !== NULL ) {
				$result .= "\n".str_repeat( "\t", $new_line_level );
			}
			$result .= $char.$post;
		}

		return $result;
	}


}

?>