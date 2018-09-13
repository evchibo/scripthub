<?
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

function smarty_modifier_domain($url) {
	$data = parse_url($url);
	return $data['host'];
}

?>