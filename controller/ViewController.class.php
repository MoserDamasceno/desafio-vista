<?php 

class ViewController 
{

	static function view($pagina, $param = null)
	{
		$arquivo = (file_exists('view/'.$pagina.'.php')) ? 'view/'.$pagina.'.php' : 'view/'.$pagina.'/index.php';
		if ($param !== null) {
			if (is_array($param) && count($param)) {
				foreach ($param as $key => $value) {
					$$key = $value;
				}
			}
		}	
		
		include $arquivo;
		
	}

}


?>