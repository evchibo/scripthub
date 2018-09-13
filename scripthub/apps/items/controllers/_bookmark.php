<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

require_once ROOT_PATH.'/scripthub/apps/collections/models/collections.class.php';
	$collectionsClass = new collections();
	
	if(check_login_bool() && isset($_POST['add_collection'])) {
		$s = $collectionsClass->bookmark($itemID);
		if($s === true) {
			refresh('/'.$languageURL.'items/'.$itemID, $langArray['complete_bookmark_item'], 'complete');
		}
		else {
			addErrorMessage($s, '', 'error');
		}
	}	
	
	if(check_login_bool()) {
		$collections = $collectionsClass->getAll(0, 0, " `user_id` = '".intval($_SESSION['user']['user_id'])."' ");
		abr('bookCollections', $collections);
	}
?>