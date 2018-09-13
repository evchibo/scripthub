<?php
/**
 * Copyright (c) 2018. 
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

if ($_GET ['controller'] != 'login') {
	admin_login ();
	
	if (isset ( $_GET ['m'] ) && ! isset ( $_SESSION ['user'] ['access'] [$_GET ['m']] )) {		
		if($_GET['m'] == 'users' && $_GET['c'] == 'edit' && $_GET['id'] == $_SESSION['user']['user_id']) {
			$personalEdit = 'yes';
			abr('personalEdit', $personalEdit);
		}
		else {
			refresh ( "/". $languageURL . adminURL . '/?access_error=' . $_GET ['m'], $langArray ['access_error'], 'error' );
		}
	}
}

abr ( "domain", $config ['domain'] );


?>