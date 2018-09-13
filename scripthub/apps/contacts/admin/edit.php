<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( ROOT_PATH . "/scripthub/apps/" . $_GET ['m'] . "/admin/add.php" );
_setTitle ( $langArray ['edit'] );

	if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
		refresh('?m='.$_GET['m'].'&c=list', 'INVALID ID', 'error');
	}

	if(!isset($_GET['p'])) {
		$_GET['p'] = '';
	}	
	
	$cms = new ccategories();
	
	if(isset($_POST['edit'])) {
		$status = $cms->edit ($_GET['id']);
		if ($status !== true) {			
			abr('error', $status);
		} else {
			refresh ( "?m=" . $_GET ['m'] . "&c=categories&p=".$_GET['p'], $langArray ['edit_complete'] );
		}
	}
	else {
		$_POST = $cms->get($_GET['id']);
	}

		
?>