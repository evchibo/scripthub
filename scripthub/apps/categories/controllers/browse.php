<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setTitle($langArray['browse_categories_setTitle']);

	$categoryID = get_id(1);
	if(is_numeric($categoryID) || $categoryID == 'all') {
		


		require_once ROOT_PATH.'/scripthub/apps/categories/models/categories.class.php';
		$categoriesClass = new categories();
	
		$categories = $categoriesClass->getAll();
		abr('categories', $categories);		
			
	
		
	}	
	else {
		$allCategories = $categoriesClass->getAllWithChilds(0, " `visible` = 'true' ");
		$categoriesbrowseList = $categoriesClass->generatebrowseList($allCategories);
		abr('categoriesbrowseList', $categoriesbrowseList);		

	}
	
?>