<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);

	$key = get_id(1);
	
	$page = $pagesClass->getByKey($key);
	if(!is_array($page)) {
		header("HTTP/1.0 404 Not Found");
        header("Location: http://". DOMAIN ."/error");	
	}
	abr('page', $page);

#SET META INFORMATION	
	if($page['meta_title'] != '') {
		$smarty->assign('title', $page['meta_title']);
	}
	else {
		$smarty->assign('title', $page['name']); 
	}
	
	if($page['meta_keywords'] != '') {
		$smarty->assign('meta_keywords', $page['meta_keywords']);
	}
	if($page['meta_description'] != '') {
		$smarty->assign('meta_description', $page['meta_description']);
	}

#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'pages/'.$page['key'].'.html" title="">'.$page['name'].'</a>');		
	
?>