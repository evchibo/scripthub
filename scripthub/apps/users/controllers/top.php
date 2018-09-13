<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['top_authors']);

	$usersClass = new users();

	$limit = 50;
	$start = (PAGE-1)*$limit;
	
	abr('number', ($start+1));
	
	$users = $usersClass->getAll($start, $limit, " `items` > 0 AND `status` = 'activate' ", "`sales` DESC");
	abr('users', $users);
	
	abr('paging', paging('/'.$languageURL.'top_authors/?p=', '', PAGE, $limit, $usersClass->foundRows));
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'users/top/" title="">'.$langArray['top_authors'].'</a>');		
	

?>