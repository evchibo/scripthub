<?php
/**
 * Copyright (c) 2018. 
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

/*
 * load all modules
 */
$installedModules = array ();
foreach ( array_diff ( scandir ( ROOT_PATH . "scripthub/apps/" ), array (
	
	'.', 
	'..', 
	'index' 
) ) as $module ) {
	if (is_dir ( ROOT_PATH . "scripthub/apps/" . $module )) {
		
		//check for module admin config?
		if (file_exists ( ROOT_PATH . "/scripthub/apps/" . $module . "/admin/admin_config.php" )) {
			require_once ROOT_PATH . "/scripthub/apps/" . $module . "/admin/admin_config.php";
			if (! isset ( $admin_config ['show'] ) || $admin_config ['show'] === true) {
				$installedModules [$module] = $admin_config;
			}
		} else {
			$installedModules [$module] = true;
		}
		
	}
}
abr ( 'modules', $installedModules );
################################################


if (isset ( $_GET ['m'] ) && isset ( $_GET ['c'] ) && file_exists ( ROOT_PATH . '/scripthub/apps/' . $_GET ['m'] . '/admin/' . $_GET ['c'] . '.php' )) {
	$smarty->assign ( 'content_template', ROOT_PATH . '/scripthub/apps/' . $_GET ['m'] . '/admin/' . $_GET ['c'] . '.html' );
	require_once ROOT_PATH . '/scripthub/apps/' . $_GET ['m'] . '/admin/' . $_GET ['c'] . '.php';
} elseif (isset ( $_GET ['m'] ) && file_exists ( ROOT_PATH . '/scripthub/apps/' . $_GET ['m'] . '/admin/index.php' )) {
	$smarty->assign ( 'content_template', ROOT_PATH . '/scripthub/apps/' . $_GET ['m'] . '/admin/index.html' );
	require_once ROOT_PATH . '/scripthub/apps/' . $_GET ['m'] . '/admin/index.php';
} /*else {
	die ( "Controller not found!" );
}*/

?>