<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);

if(!check_login_bool()) {
		$_SESSION['temp']['golink'] = '/'.$languageURL.'upload/index/';
		refresh('/'.$languageURL.'sign_in/');
}

	if($_SESSION['user']['quiz'] != 'true') {
		refresh('/'.$languageURL.'quiz/');
	} 	

	if(!isset($_GET['category']) || !is_numeric($_GET['category']) || $_GET['category'] == '0') {
		$_GET['category'] = '';
	}
	
	$allCategories = $categoriesClass->getAllWithChilds(0, " `visible` = 'true' ");
	if(!array_key_exists($_GET['category'], $allCategories)) {
		addErrorMessage($langArray['error_wrong_category'], '', 'error');
		abr('hideForm', 'true');
	}
	else {
		
		if(!isset($_POST['category'])) {
			$_POST['category'] = 0;
		}
		
		$categoriesSelect = $categoriesClass->generateSelect($allCategories, $_POST['category'], $_GET['category']);
		abr('categoriesSelect', $categoriesSelect);

#LOAD ATTRIBUTES
		require_once ROOT_PATH.'/scripthub/apps/attributes/models/attributes.class.php';
		$attributesClass = new attributes();
		
		$attributes = $attributesClass->getAllWithCategories(" `visible` = 'true' AND `categories` LIKE '%,".(int)$_GET['category'].",%' ");
		abr('attributes', $attributes);
		
#SAVE ITEM
		if(isset($_POST['upload'])) {
			require_once ROOT_PATH.'/scripthub/apps/items/models/items.class.php';
			$itemsClass = new items();
			
			$s = $itemsClass->add();
			if($s === true) {
				refresh('/'.$languageURL.'author_dashboard/', $langArray['complete_upload_item'], 'complete');
			}
			else {
				$message = '<ul>';
				foreach($s as $e) {
					$message .= '<li>'.$e.'</li>';
				}
				$message .= '</ul>';
				addErrorMessage($message, '', 'error');
			}
		}		
		
		$fileTypes = '';
	  foreach($config['upload_ext'] as $ext) {
	  	if($fileTypes != '') {	  		
	  		$fileTypes .= ';';
	  	}
	  	$fileTypes .= '*.'.$ext;	  	
	  }
	  abr('fileTypes', $fileTypes);
	  
	  abr('sessID', session_id());
		
	}
	
#BREADCRUMB	
	abr('breadcrumb', '<a href="/'.$languageURL.'" title="">'.$langArray['home'].'</a> \ <a href="/'.$languageURL.'upload/form/?category='.$_GET['category'].'" title="">'.$langArray['upload_theme'].'</a>');		
	

?>