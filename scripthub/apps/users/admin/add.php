<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['add'] );

	$cms = new users ( );
	
	if (isset ( $_POST ['add'] )) {
		$status = $cms->add ();
		if ($status !== true) {
			abr('error', $status);
		} else {
			refresh ( "?m=" . $_GET ['m'] . "&c=list", $langArray ['add_complete'] );
		}
	}
	
	require_once ROOT_PATH.'/scripthub/apps/'.$_GET['m'].'/models/groups.class.php';
	$g = new groups();
	
	$groups = $g->getAll();
	abr('groups', $groups);
	
?>