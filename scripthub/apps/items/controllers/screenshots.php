<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);
_setLayout("screenshots");
	
	$itemID = get_id(2);
	
	$itemsClass = new items();
	
	$item = $itemsClass->get($itemID);
	if(!is_array($item) || (check_login_bool() && $item['status'] == 'unapproved' && $item['user_id'] != $_SESSION['user']['user_id']) || $item['status'] == 'queue' || $item['status'] == 'extended_buy') {
		header("HTTP/1.0 404 Not Found");
        header("Location: http://". DOMAIN ."/error");
	}
	abr('item', $item);

?>