<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['featured_files']);

	abr('checkItemsType', 'yes');

	require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
	$usersClass = new users();
		
#FEATURED ITEMS
	$sixMonthsAgo = date('Y-m-d', mktime(0, 0, 0, (date('m')-6), date('d'), date('Y')));

	$items = $itemsClass->getAll(0, 0, " `status` = 'active' AND `weekly_to` >= '".date('Y-m-d')."' AND `weekly_to` >= '".$sixMonthsAgo."' ", "`datetime` DESC");
	
	if(is_array($items)) {
		
		abr('topItem', array_shift($items));
		
		$users = $usersClass->getAll(0, 0, $itemsClass->usersWhere);
		abr('users', $users);
				
	}
	abr('items', $items);
	
	#LOAD CATEGORIES
	require_once ROOT_PATH.'/scripthub/apps/categories/models/categories.class.php';
	$categoriesClass = new categories();

	$categories = $categoriesClass->getAll();
	abr('categories', $categories);	
	
#FEATURED AUTHOR
	$featuredAuthors = $usersClass->getAll(0, 0, " `status` = 'activate' AND `featured_author` = 'true' ");
	abr('featuredAuthors', $featuredAuthors);

#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'items/feature/" title="">'.$langArray['featured_files'].'</a>');		
	 
?>