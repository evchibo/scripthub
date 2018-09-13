<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);

 
	require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
	$usersClass = new users();
			
	$users = $usersClass->getAll(0, 0, $itemsClass->usersWhere);
	abr('users', $users);


#WEEKLY FEATURES ITEMS
	$weeklyItems = $itemsClass->getAll(0, 4, " `status` = 'active' AND `weekly_to` >= '".date('Y-m-d')."' ", "`datetime` DESC");
	abr('weeklyItems', $weeklyItems);
	
	if($itemsClass->foundRows > 4) {
		abr('haveWeekly', 'yes');
	}

#LOAD CATEGORIES
		require_once ROOT_PATH.'/scripthub/apps/categories/models/categories.class.php';
		$categoriesClass = new categories();
	
		$categories = $categoriesClass->getAll();
		abr('categories', $categories);	 
	
#RECENT ITEMS
	$recentItems = $itemsClass->getAll(0, 40, " `status` = 'active' ", '`datetime` DESC');
	kshuffle($recentItems);
	abr('recentItems', $recentItems);
	
#FREE ITEM
	$freeItem = $itemsClass->getAll(0, 1, " `status` = 'active' AND `free_file` = 'true' ");
	if(is_array($freeItem)) {
		$freeItem = array_shift($freeItem);
	}
	abr('freeItem', $freeItem);
	
#FEATURED AUTHOR
	require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
	$usersClass = new users();

	$featuredAuthor = $usersClass->getAll(0, 1, " `status` = 'activate' AND `featured_author` = 'true' ", 'RAND()');
	if(is_array($featuredAuthor)) {
		$featuredAuthor = array_shift($featuredAuthor);

		$featuredItems = $itemsClass->getAll(0, 3, " `status` = 'active' AND `user_id` = '".intval($featuredAuthor['user_id'])."' ");
		abr('featuredItems', $featuredItems);
		
		abr('featuredAuthorInfo', langMessageReplace($langArray['featured_author_info'], array(
																'USERNAME' => $featuredAuthor['username'],
																'MONTH' => $langArray['monthArr'][date('n', strtotime($featuredAuthor['register_datetime']))],
																'YEAR' => date('Y', strtotime($featuredAuthor['register_datetime'])),
																'ITEMS' => $featuredAuthor['items'],
																'SALES' => $featuredAuthor['sales']
															)));
	}
	abr('featuredAuthor', $featuredAuthor);
	

#FOLLOWING ITEMS
	if(check_login_bool()) {
		$following = $usersClass->getFollowersID($_SESSION['user']['user_id']);
		if(is_array($following)) {
			$whereQuery = '';
			foreach($following as $f) {
				if($whereQuery != '') {
					$whereQuery .= ' OR ';
				}
				$whereQuery .= " `user_id` = '".intval($f['follow_id'])."' ";
			}
			
			$followingItems = $itemsClass->getAll(0, 9, " `status` = 'active' AND ($whereQuery) ", "`datetime` DESC");
			abr('followingItems', $followingItems);
			
			abr('followingItemsCount', $itemsClass->foundRows);
			abr('emptyThumb', (9-$itemsClass->foundRows));
		}
	}
#TOP AUTHORS
	

		$topAuthors = $usersClass->getAll(0, 9, " `status` = 'activate' and `sales` > 0 ", "`sales` DESC");
		abr('topAuthors', $topAuthors);
		
		abr('topAuthorsCount', $usersClass->foundRows);
		abr('emptyThumb', (9-$usersClass->foundRows));
		
	

#RANDOM CATEGORIES
	$randCategories = array_rand($mainCategories, 5);
	abr('randCategories', $randCategories);	
	
#LOW PRICE
	$lowPrice = $itemsClass->getAll(0, 1, " `status` = 'active' ", "`price` ASC");
	if(is_array($lowPrice)) {
		$lowPrice = array_shift($lowPrice);
		$lowPrice = $lowPrice['price'];
	}
	abr('lowPrice', $lowPrice);
	
#QUICK NEWS
	
	require_once ROOT_PATH.'/scripthub/apps/qnews/models/qnews.class.php';
	$qnews = new qnews();
	$data = array();
	foreach($qnews->getAll(0, 1, "`visible` = 'true'") AS $key => $value) {
		if($value['photo']) {
			$data[$key] = $value;
			$data[$key]['thumb'] = 'static/uploads/qnews/260x140/' . $value['photo'];
		}
	}
	
	abr('qnews_data', $data);
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a>');
	

	
?>