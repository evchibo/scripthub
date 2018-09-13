<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

define ( 'USING_LANGUAGE', false );

require_once '../../../config.php';
require_once $config ['root_path'] . '/scripthub/core/functions.php';
include_once $config ['scripthub_core'] . "/initEngine.php";

admin_login();

if (isset ( $_POST ['deleteMail'] ) && isset ( $_POST ['id'] ) && isset($_SESSION['user']['access']['contacts'])) {

	require_once ROOT_PATH . "/scripthub/apps/contacts/models/contacts.class.php";
	$cms = new contacts( );
	
	$cms->delete ( intval ( $_POST ['id'] ) );
	die ( json_encode ( array_merge ( $_POST, array (
		'status' => 'true' 
	) ) ) );
}
elseif (isset ( $_POST ['deleteCategory'] ) && isset ( $_POST ['id'] ) && isset($_SESSION['user']['access']['contacts'])) {

	require_once ROOT_PATH . "/scripthub/apps/contacts/models/ccategories.class.php";
	$cms = new ccategories( );
	
	$cms->delete ( intval ( $_POST ['id'] ) );
	die ( json_encode ( array_merge ( $_POST, array (
		'status' => 'true' 
	) ) ) );
}

echo json_encode ( array_merge ( $_POST, array (
	'status' => 'unknown error' 
) ) );
die ();

?>