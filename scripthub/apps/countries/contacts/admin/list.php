<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['contacts'] );

	$cms = new contacts ( );
	
	$data = $cms->getAll(START, LIMIT);
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=list&p=", "", PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
?>