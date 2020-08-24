<?php 

session_start();

$url = 'https://teste-vista-software.test/';
define('BASE_URL', $url);
define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] .'/' .$path.'uploads/');
define('TITLE', 'Desafio Vista Software');
define('LIB', BASE_URL.'library/');

?>