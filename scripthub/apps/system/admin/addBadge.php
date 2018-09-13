<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

if(!isset($_GET['type']) || !in_array($_GET['type'], array('other','buyers','authors','referrals', 'system'))) {
		refresh('?m='.$_GET['m'].'&c=badges&type=system', 'INVALID TYPE', 'error');
	}

	_setView ( __FILE__ );
	_setTitle ( $langArray ['add'].' '.$langArray ['badges'].' › '. ucfirst($_GET['type']) );

	$is_from_to = false;
	if(in_array($_GET['type'], array('buyers','authors','referrals'))) {
		$is_from_to = true;
	}
	abr('is_from_to', $is_from_to);
	
	
	require_once ROOT_PATH.'/scripthub/apps/system/models/badges.class.php';
	$badges = new badges();

	if (isset ( $_POST ['add'] )) {
		$status = $badges->add ();
		if ($status !== true) {
			abr('error', $status);
		} else {
			refresh ( "?m=" . $_GET ['m'] . "&c=badges&type=" . $_GET['type'], $langArray ['add_complete'] );
		}
	}
	else {
		$_POST['visible'] = 'true';
	}

	$types_system = array();
	if($_GET['type'] == 'system') {
		$types_system = array(
			'location_global_community' => $langArray['location_global_community'],
			'has_free_file_month' => $langArray['has_free_file_month'],
			'has_been_featured' => $langArray['has_been_featured'],
			
			'power_elite_author' => $langArray['power_elite_author'],
			'elite_author' => $langArray['elite_author'],
			
			'has_had_item_featured' => $langArray['has_had_item_featured'],
			'is_exclusive_author' => $langArray['is_exclusive_author']
		);
	}
	
	abr('types_system', $types_system);