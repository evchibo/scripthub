<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['language'] );

	$cms = new system ( );
	
	if(isset($_POST['save'])) {
		$cms->saveCurrency();
		refresh('?m='.$_GET['m'].'&c='.$_GET['c']);
	}
	
	$data = $cms->getCurrency();
	abr('data', $data);
	
?>