<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['bulletin'] );

	require_once ROOT_PATH . "/scripthub/apps/bulletin/models/bulletin.class.php";
	$cms = new bulletin ( );
	
	$data = $cms->getAll(START, LIMIT, '', true);
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=list&p=", "", PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
?>