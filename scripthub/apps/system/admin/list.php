<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
_setTitle ( $langArray ['list'] );

	$cms = new system ( );

	$data = $cms->getAll(0, 0, 'config');
	
	$tmp = array();
	foreach($data AS $key => $value) {
		$value['help'] = isset($langArray[$value['key'] . '_help']) ? $langArray[$value['key'] . '_help'] : false;
		$tmp[$key] = $value;
	}
	
	abr('data', $tmp);

?>