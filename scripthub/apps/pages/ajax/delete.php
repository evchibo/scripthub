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

if (isset ( $_POST ['delete'] ) && isset ( $_POST ['id'] ) && isset($_SESSION['user']['access']['pages'])) {
	require_once ROOT_PATH . "/scripthub/apps/pages/models/pages.class.php";
	$cms = new pages( );
	
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