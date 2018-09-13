<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

require_once ROOT_PATH.'/scripthub/apps/payments/models/payments_abstract.class.php';

class paypal extends payments_abstract {
	
	public function generateForm($order_data = array()) {
		global $langArray, $currency, $config, $languageURL;
		
		if($this->getMeta('paypal_sandbox_mode')) {
			$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		} else {
			$url = 'https://www.paypal.com/cgi-bin/webscr';
		}
		
		$form  = '<form class="form-for-pay" action="' . $url . '" method="post" id="paypal_form_submit">'."\n";
		$form .= '<input type="hidden" name="cmd" value="_cart">'."\n";
		$form .= '<input type="hidden" name="upload" value="1" />'."\n";
		$form .= '<input type="hidden" name="charset" value="utf-8" />'."\n";
		$form .= '<input type="hidden" name="redirect_cmd" value="_xclick">'."\n";
		$form .= '<input type="hidden" name="no_note" value="1" />'."\n";
		$form .= '<input type="hidden" name="rm" value="2" />'."\n";
		$form .= '<input type="hidden" name="paymentaction" value="sale" />';
		$form .= '<input type="hidden" name="business" value="' . $this->getMeta('paypal_email') . '">'."\n";
		$form .= '<input type="hidden" name="item_number_1" value="' . (int)$order_data['id'] . '">'."\n";
		$form .= '<input type="hidden" name="item_name_1" value="Buy ' . htmlspecialchars($order_data['item_name'], ENT_QUOTES, 'utf-8') . '">'."\n";
		$form .= '<input type="hidden" name="amount_1" value="' . (float)$order_data['price'] . '">'."\n";
		$form .= '<input type="hidden" name="quantity_1" value="1">'."\n";
		$form .= '<input type="hidden" name="currency_code" value="' . $currency['code'] . '">'."\n";
		$form .= '<input type="hidden" name="no_shipping" value="1">'."\n";
		$form .= '<input type="hidden" name="no_note" value="1">'."\n";
		$form .= '<input type="hidden" name="notify_url" value="http://' . $config['domain'] . '/' . $languageURL . 'payments/paypal/">'."\n";
		$form .= '<input type="hidden" name="return" value="http://' . $config['domain'] . '/' . $languageURL . 'payments/paypal/pdt/">'."\n";
//		$form .= '<input type="hidden" name="return" value="http://' . $config['domain'] . '/' . $languageURL . 'users/downloads/">'."\n";
		$form .= '<input type="hidden" name="cancel_return" value="http://' . $config['domain'] . '/' . $languageURL . 'items/' . $order_data['item_id'] . '/' . url($order_data['item_name']) . '.html">'."\n";
		$form .= '<input type="hidden" name="image_url" value="">'."\n";
		$form .= '<input type="hidden" name="email" value="' . $this->getUserData('email') . '">'."\n";
		$form .= '<input type="hidden" name="first_name" value="' . $this->getUserData('firstname') . '">'."\n";
		$form .= '<input type="hidden" name="last_name" value="' . $this->getUserData('lastname') . '">'."\n";
		$form .= '<input type="hidden" name="custom" value="' . (int)$order_data['id'] . '">'."\n";
		$form .= '<input type="hidden" name="custom2" value="' . ($order_data['extended'] == 'true' ? 'extended' : 'regular') . '">'."\n";
		$form .= '<input type="hidden" name="amount" value="' . (float)$order_data['price'] . '">'."\n";
		$form .= '<input type="hidden" name="cs" value="0">'."\n";
		$form .= '<input type="hidden" name="page_style" value="PayPal">'."\n";
		$form .= '<button id="paypal-purchase-button" class="btn-icon purchase" type="submit">Purchase</button>'."\n";
		$form .= '</form>'."\n";
		
		return $form;
	}
	
	public function generateDepositForm($order_data = array()) {
		global $langArray, $currency, $config, $languageURL;
		
		if($this->getMeta('paypal_sandbox_mode')) {
			$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		} else {
			$url = 'https://www.paypal.com/cgi-bin/webscr';
		}
		
		$form  = '<form class="form-for-pay" action="' . $url . '" method="post" id="paypal_form_submit">'."\n";
		$form .= '<input type="hidden" name="cmd" value="_cart">'."\n";
		$form .= '<input type="hidden" name="upload" value="1" />'."\n";
		$form .= '<input type="hidden" name="charset" value="utf-8" />'."\n";
		$form .= '<input type="hidden" name="redirect_cmd" value="_xclick">'."\n";
		$form .= '<input type="hidden" name="no_note" value="1" />'."\n";
		$form .= '<input type="hidden" name="rm" value="2" />'."\n";
		$form .= '<input type="hidden" name="paymentaction" value="sale" />';
		$form .= '<input type="hidden" name="business" value="' . $this->getMeta('paypal_email') . '">'."\n";
		$form .= '<input type="hidden" name="item_number_1" value="' . (int)$order_data['id'] . '">'."\n";
		$form .= '<input type="hidden" name="item_name_1" value="' . $langArray['make_deposit'] . ' - #' . (int)$order_data['id'] . '">'."\n";
		$form .= '<input type="hidden" name="amount_1" value="' . (float)$order_data['deposit'] . '">'."\n";
		$form .= '<input type="hidden" name="quantity_1" value="1">'."\n";
		$form .= '<input type="hidden" name="currency_code" value="' . $currency['code'] . '">'."\n";
		$form .= '<input type="hidden" name="no_shipping" value="1">'."\n";
		$form .= '<input type="hidden" name="no_note" value="1">'."\n";
		$form .= '<input type="hidden" name="notify_url" value="http://' . $config['domain'] . '/' . $languageURL . 'payments/deposit_paypal/">'."\n";
		$form .= '<input type="hidden" name="return" value="http://' . $config['domain'] . '/' . $languageURL . 'payments/deposit_paypal/pdt/">'."\n";
		$form .= '<input type="hidden" name="cancel_return" value="http://' . $config['domain'] . '/' . $languageURL . 'users/deposit">'."\n";
		$form .= '<input type="hidden" name="image_url" value="">'."\n";
		$form .= '<input type="hidden" name="email" value="' . $this->getUserData('email') . '">'."\n";
		$form .= '<input type="hidden" name="first_name" value="' . $this->getUserData('firstname') . '">'."\n";
		$form .= '<input type="hidden" name="last_name" value="' . $this->getUserData('lastname') . '">'."\n";
		$form .= '<input type="hidden" name="custom" value="' . (int)$order_data['id'] . '">'."\n";
		$form .= '<input type="hidden" name="amount" value="' . (float)$order_data['deposit'] . '">'."\n";
		$form .= '<input type="hidden" name="cs" value="0">'."\n";
		$form .= '<input type="hidden" name="page_style" value="PayPal">'."\n";
		$form .= '<button id="paypal-purchase-button" class="btn-icon purchase" type="submit">Purchase</button>'."\n";
		$form .= '</form>'."\n";
		
		return $form;
	}
	
}

?>