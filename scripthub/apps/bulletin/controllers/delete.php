<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);

	if(!isset($_GET['email'])) {
		refresh('/');
	}
	
	require_once ROOT_PATH . "/scripthub/apps/bulletin/models/bulletin.class.php";
	$bulletinClass = new bulletin();
	
	$bulletinClass->deleteEmail($_GET['email']);
		
	addErrorMessage($_GET['email'].$langArray['complete_unsubscribe'], '', 'complete');

?>