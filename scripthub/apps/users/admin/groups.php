<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['groups'] );

	$cms = new groups ( );

	$data = $cms->getAll(START, LIMIT);
	abr('data', $data);

	$p = paging ( "?m=" . $_GET ['m'] . "&c=groups&p=", "", PAGE, LIMIT, $cms->foundRows );
	abr ( 'paging', $p );
?>