<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

_setView(__FILE__);

$orderID = 0;
if(isset($_SESSION['tmp']['order_id'])) {
	$orderID = (int)$_SESSION['tmp']['order_id'];
}

require_once ROOT_PATH.'/scripthub/apps/items/models/orders.class.php';

$cms = new orders();

$order_info = $cms->get($orderID);

if($order_info) {
	
	$payments = glob(dirname(dirname(dirname(__FILE__))) . '/payments/controllers/*.php');
	
	$payments_data = array();
	$sort_order = array(); 
	
	if($payments) {
		$order_obj = array();
		foreach($payments AS $row => $value) {
			$key = basename($value, '.php');
			
			if(isset($meta[$key . '_status']) && $meta[$key . '_status']) {

				$logo = '';
				if(isset($meta[$key . '_logo'])) {
					$logo = $meta[$key . '_logo'];
				}
				
				if(isset($meta[$key . '_sort_order'])) {
					$sort_order[$key] = $meta[$key . '_sort_order']; 
				} else {
					$sort_order[$key] = 0;
				}
				
				require_once ROOT_PATH.'/scripthub/apps/payments/models/' . $key . '.class.php';
				$order_obj[$key] = new $key($meta);
				
				$payments_data[$key] = array(
					'title' => isset($langArray[$key]) ? $langArray[$key] : ucfirst($key),
					'description' => isset($langArray[$key . '_info']) ? $langArray[$key . '_info'] : '',
					'form' => $order_obj[$key]->generateForm($order_info),
					'logo' => $logo
				);
				
			}
			
		}
		
		if($payments_data) {
			array_multisort($sort_order, SORT_ASC, $payments_data);
		
			abr('payments_data', $payments_data);
			
		} else {
			addErrorMessage($langArray['no_payment_methods'], '', 'error');
		}
		
	} else {
		addErrorMessage($langArray['no_payment_methods'], '', 'error');
	}
	
} else {
	addErrorMessage($langArray['order_is_expired'], '', 'error');
}