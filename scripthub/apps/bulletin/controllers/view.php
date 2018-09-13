<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setLayout('newsletter');

	$bulletinID = get_id(2);
	
	$bulletinClass = new bulletin();
	
	$bulletin = $bulletinClass->get($bulletinID);
	if(!is_array($bulletin)) {
		refresh('/'.$languageURL);
	}
	abr('bulletin', $bulletin);
	
	$template = $bulletinClass->getTemplate();
	abr('bulletin', langMessageReplace($template, array(
    'DOMAIN' => $config['domain'],
    'BULLETINID' => $bulletinID,
    'EMAIL' => 'noemail',
    'CONTENT' => $bulletin['text']
  )));

?>