<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( ROOT_PATH . "/scripthub/apps/" . $_GET ['m'] . "/admin/addAnswer.php" );
_setTitle ( $langArray ['edit'].' '.$langArray['answer'] );

	if(!isset($_GET['id']) && !is_numeric($_GET['id'])) {
		refresh("/" . $languageURL . adminURL . "/?m=" . $_GET ['m'] . "&c=list", 'INVALID ID', 'error');
	}

	if(!isset($_GET['fid']) || !is_numeric($_GET['fid'])) {
		refresh('?m='.$_GET['m'].'&c=files&id='.$_GET['id'], 'INVALID ID', 'error');
	}

	$cms = new answers();
	
	if(isset($_POST['edit'])) {
		$status = $cms->edit ($_GET['fid']);
		if ($status !== true) {			
			abr('error', $status);
		} else {
			refresh ( "?m=" . $_GET ['m'] . "&c=answers&id=".$_GET['id'], $langArray ['edit_complete'] );
		}
	}
	else {
		$_POST = $cms->get($_GET['fid']);
	}
	
	$categoriesClass = new quiz();
	$pdata = $categoriesClass->get($_GET['id']);
	abr('pdata', $pdata);
				
?>