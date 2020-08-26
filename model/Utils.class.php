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