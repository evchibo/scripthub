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
	
	if(isset($_GET['subscribe']) && is_numeric($_GET['subscribe'])) {
		$cms->changeSubscribe($_GET['subscribe'], 'true');
	}
	elseif(isset($_GET['unsubscribe']) && is_numeric($_GET['unsubscribe'])) {
		$cms->changeSubscribe($_GET['unsubscribe'], 'false');
	}
	
	$data = $cms->getAllEmails(START, LIMIT);
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=emails&p=", "", PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
?>