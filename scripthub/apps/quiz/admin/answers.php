<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['answers'] );

	if(!isset($_GET['id']) && !is_numeric($_GET['id'])) {
		refresh("/" . $languageURL . adminURL . "/?m=" . $_GET ['m'] . "&c=list");
	}

	$cms = new answers ( );

	$data = $cms->getAll(START, LIMIT, " `quiz_id` = '".intval($_GET['id'])."' ");
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=answers&id=".$_GET['id']."&p=", "", PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
	
	$categoriesClass = new quiz();
	$pdata = $categoriesClass->get($_GET['id']);
	abr('pdata', $pdata);
	
?>