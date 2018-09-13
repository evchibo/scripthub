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

session_id($_POST['sessID']);

include_once $config ['scripthub_core'] . "/initEngine.php";


// Check the upload
if (!check_login_bool()) {
	echo "ERROR:invalid upload";
	exit ( 0 );
}

if (! isset ( $_FILES ["file"] )) {
	echo "ERROR:invalid upload";
	exit ( 0 );
}

require_once '../../models/files.class.php';
$filesClass = new files( );

$s = $filesClass->addFile();
if(is_array($s)) {
	echo json_encode(array(
		'status' => 'done',
		'file' => $s
	));
}
else {
	echo json_encode(array(
		'status' => $s
	));
}

exit ( 0 );
?>