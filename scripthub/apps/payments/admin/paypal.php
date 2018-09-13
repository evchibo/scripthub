<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView ( __FILE__ );
	_setTitle ( $langArray ['payments'] . ' › ' . ucfirst($_GET['c']) );
	
	$payments = scandir(dirname(dirname(__FILE__)) . '/controllers/');
	
	if(!in_array($_GET['c'] . '.php', $payments)) {
		refresh ( "/" . $languageURL . adminURL . "/?m=" . $_GET ['m'] . "&c=list" );
	}
	
	$key = $_GET['c'];
	
	$form = isset($_POST['form']) ? $_POST['form'] : array();
	
	if(isset($_POST['edit'])) {
		$cms = new system();
		$cms->editGroup ($key, $form);
		refresh ( "?m=" . $_GET ['m'] . "&c=list", $langArray ['edit_complete'] );
	}
	
	
	abr('group', $key);
	
	abr('statuses', array(
		0 => $langArray['unactive'],
		1 => $langArray['active']
	));

	if(isset($form[$key . '_status'])) {
		abr('status', $form[$key . '_status']);
	} else {
		abr('status', isset($meta[$key . '_status']) ? $meta[$key . '_status'] : 0);
	}

	if(isset($form[$key . '_email'])) {
		abr('email', $form[$key . '_email']);
	} else {
		abr('email', isset($meta[$key . '_email']) ? $meta[$key . '_email'] : '');
	}

	if(isset($form[$key . '_sandbox_mode'])) {
		abr('sandbox_mode', $form[$key . '_sandbox_mode']);
	} else {
		abr('sandbox_mode', isset($meta[$key . '_sandbox_mode']) ? $meta[$key . '_sandbox_mode'] : 0);
	}

	if(isset($form[$key . '_sort_order'])) {
		abr('sort_order', $form[$key . '_sort_order']);
	} else {
		abr('sort_order', isset($meta[$key . '_sort_order']) ? $meta[$key . '_sort_order'] : 0);
	}

	if(isset($form[$key . '_logo'])) {
		abr('logo', $form[$key . '_logo']);
	} else {
		abr('logo', isset($meta[$key . '_logo']) ? $meta[$key . '_logo'] : 0);
	}
	
	if(isset($form[$key . '_pdt_token'])) {
		abr('pdt_token', $form[$key . '_pdt_token']);
	} else {
		abr('pdt_token', isset($meta[$key . '_pdt_token']) ? $meta[$key . '_pdt_token'] : '');
	}