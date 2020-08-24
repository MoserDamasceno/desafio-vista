<?php 

$packages = array('controller','model','dao');

foreach ( $packages as $pack ) {

	$mydir = opendir($pack); 

	while ( $fn = readdir($mydir) ) {

		if ( $fn != '.' && $fn != '..' ) {
			include $pack.'/'.$fn; 
		}
	} 
}

?>