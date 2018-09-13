<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

#CHECK FOR INSTALL
if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/scripthub/config/config.php')) {
	header('Location: /scripthub/setup/index.php');
	die();
}

require_once 'scripthub/config.php';
require_once $config ['root_path'] . '/scripthub/core/functions.php';
include_once $config ['scripthub_core'] . "/initEngine.php";
	
require_once ROOT_PATH.'/scripthub/apps/system/models/system.class.php';
$systemClass = new system();
	
$currency = $systemClass->getActiveCurrency();
abr('currency', $currency);

# META DATA
$meta = $systemClass->getAllKeyValue();
$smarty->assign('title', $meta['meta_title']);
$smarty->assign('meta_keywords', $meta['meta_keywords']);
$smarty->assign('meta_description', $meta['meta_description']);
$smarty->assign('site_logo', $meta['site_logo']);

$config['paypal']['business'] = $meta['paypal_email'];
	

if($_GET['module'] != 'admin') {
	
#SUBSCRIBE TO NEWSLETTER	
	if(isset($_POST['subscribe'])) {
		require_once ROOT_PATH.'/scripthub/apps/bulletin/models/bulletin.class.php';
		$bulletinClass = new bulletin();				
		
		$s = $bulletinClass->addBulletinEmail();
		if($s === true) {
			refresh('', $langArray['complete_add_to_newsletter'], 'complete');
		}
		elseif($s == 'already') {
			refresh('', $langArray['already_in_newsletter'], 'info');
		}
		else {
			refresh('', $langArray['error_newsletter'], 'error');
		}
	}
	
#SAVE REFERAL USERNAME	
	if(isset($_GET['ref'])) {
		$_SESSION['temp']['referal'] = $_GET['ref'];
	}
	
#LOAD PAGES IN MENU
	require_once ROOT_PATH.'/scripthub/apps/pages/models/pages.class.php';
	$pagesClass = new pages();
	
	$menuPages = $pagesClass->getAll(0, 0, " `visible` = 'true' AND `menu` = 'true' ", true);
	abr('menuPages', $menuPages);
	
	$footerPages = $pagesClass->getAll(0, 0, " `visible` = 'true' AND `footer` = 'true' ", true);
	abr('footerPages', $footerPages);
	
#LOAD MAIN CATEGORIES
	require_once ROOT_PATH.'/scripthub/apps/categories/models/categories.class.php';
	$categoriesClass = new categories();

	$mainCategories = $categoriesClass->getAll(0, 0, " `visible` = 'true' AND `sub_of` = '0' ");
	$allCats = $categoriesClass->getAllWithChilds(0, '`visible` = \'true\'');
	abr('mainCategories', $allCats[0]);
	unset($allCats[0]);
	abr('allCats', $allCats);
	//abr('mainCategories', $mainCategories);
	
#LOAD COUTNERS
	require_once ROOT_PATH.'/scripthub/apps/items/models/items.class.php';
	$itemsClass = new items();

	abr('itemsCount', $itemsClass->getItemsCount());	

	require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
	$usersClass = new users();
	
	abr('usersCount', $usersClass->getUsersCount(" `status` = 'activate' "));

	
#UPDATE USER AMOUNT
	if(check_login_bool()) {
		$_SESSION['user'] = $usersClass->get($_SESSION['user']['user_id']);
	}
	
}


	include_once $config ['scripthub_core'] . "/endEngine.php";
	
?>