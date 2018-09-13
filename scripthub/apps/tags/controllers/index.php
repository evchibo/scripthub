<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setLayout('clean');
	
	if(!isset($_GET['q'])) {
		$_GET['q'] = '';
	}
	if(!isset($_GET['limit'])) {
		$_GET['limit'] = 10;
	}

	$tagsClass = new tags();
	
	$tags = $tagsClass->getAll(0, $_GET['limit'], " `name` LIKE '%".sql_quote($_GET['q'])."%' ");
	if(is_array($tags)) {
		foreach($tags as $t) {
			echo $t['name']."\n";
		}
	}

?>