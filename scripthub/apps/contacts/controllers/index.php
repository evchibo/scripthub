<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['contacts']);

#LOAD CATEGORIES
	$categoriesClass = new ccategories();
	
	$categories = $categoriesClass->getAll(0, 0, " `visible` = 'true'");
	abr('categories', $categories);

#SEND CONTACT
	if(isset($_POST['submit'])) {
		$contactsClass = new contacts();
		
		$s = $contactsClass->add();
		if($s === true) {
			refresh('/'.$languageURL.'support/', $langArray['complete_send_email'], 'complete');
		}
		else {
			addErrorMessage($langArray['error_all_fields_required'], '', 'error');
		}
	}	
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'contacts/" title="">'.$langArray['contacts'].'</a>');		
	

?>