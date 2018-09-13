<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
	_setTitle ( $langArray ['payments']);
	
	$payments = glob(dirname(dirname(__FILE__)) . '/controllers/*.php');
	
	if(!is_array($payments)) $payments = array();
	
	$tmp = array();
	
	$statuses = array(
		1 => $langArray['active'],
		0 => $langArray['unactive']
	);
	
	foreach($payments AS $row => $value) {
		$key = basename($value, '.php');
		
		if($value == '.' || $value == '..' || strpos($key, '_') !== false) continue;
		
		$status = $langArray['unactive'];
		if(isset($meta[$key . '_status']) && isset($statuses[$meta[$key . '_status']])) {
			$status = $statuses[$meta[$key . '_status']];
		}
		
		$sort_order = 0;
		if(isset($meta[$key . '_sort_order'])) {
			$sort_order = $meta[$key . '_sort_order'];
		}
		
		$tmp[] = array(
			'key' => $key,
			'title' => isset($langArray[$key]) ? $langArray[$key] : ucfirst($key),
			'status' => $status,
			'sort_order' => $sort_order
		);
	}
	
	abr('data', $tmp);

?>