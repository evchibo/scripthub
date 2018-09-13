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

if (isset ( $_POST ['deleteGroup'] ) && isset ( $_POST ['id'] ) && isset($_SESSION['user']['access']['bulletin'])) {

	require_once ROOT_PATH . "/scripthub/apps/bulletin/models/bulletinGroups.class.php";
	$cms = new bulletinGroups( );
	
	$cms->delete ( intval ( $_POST ['id'] ) );
	die ( json_encode ( array_merge ( $_POST, array (
		'status' => 'true' 
	) ) ) );
}
if (isset ( $_POST ['deleteSEmail'] ) && isset ( $_POST ['id'] ) && isset($_SESSION['user']['access']['bulletin'])) {

	require_once ROOT_PATH . "/scripthub/apps/bulletin/models/bulletin.class.php";
	$cms = new bulletin( );
	
	$cms->deleteSEmail ( intval ( $_POST ['id'] ) );
	die ( json_encode ( array_merge ( $_POST, array (
		'status' => 'true' 
	) ) ) );
}

echo json_encode ( array_merge ( $_POST, array (
	'status' => 'unknown error' 
) ) );
die ();

?>