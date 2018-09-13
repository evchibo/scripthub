<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);

	$percentsClass = new percents();
	
	$percents = $percentsClass->getAll();
	abr('percents', $percents);
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'percents/" title="">'.$langArray['percents'].'</a>');		
	
	
?>