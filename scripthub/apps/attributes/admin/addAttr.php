<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['add'].' '.$langArray['attribute'] );

	if(!isset($_GET['id']) && !is_numeric($_GET['id'])) {
		refresh("/" . $languageURL . adminURL . "/?m=" . $_GET ['m'] . "&c=list");
	}

	$cms = new attributes ( );
	
	if (isset ( $_POST ['add'] )) {
		$_POST['category_id'] = $_GET['id'];
		
		$status = $cms->add ();
		if ($status !== true) {
			abr('error', $status);
		} else {
			refresh ( "?m=" . $_GET ['m'] . "&c=attr&id=".$_GET['id'], $langArray ['add_complete'] );
		}
	}
	else {
		$_POST['visible'] = 'true';
	}
	
	$categoriesClass = new categories();
	$pdata = $categoriesClass->get($_GET['id']);
	abr('pdata', $pdata);
		
?>