<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

function smarty_function_userBox($params, &$smarty) {
	if (! isset ( $params ['type'] )) {
		return userBox ( $params ['data'] );
	}
	
	return $params ['type'] ( $params ['data'] );
}
?>