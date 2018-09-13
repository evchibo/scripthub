<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['queue_update']);

	$cms = new items ( );
	
	$data = $cms->getAllForUpdate(START, LIMIT);
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=queue_update&p=", "", PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
	
?>