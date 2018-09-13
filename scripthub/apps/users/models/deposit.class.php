<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

class deposit {
	
	public $foundRows = 0;
	public $usersWhere = '';	
	
	public function getAll($start=0, $limit=0, $where='') {
		global $mysql;
		
		$limitQuery = '';
		if($limit!=0) {
			$limitQuery = " LIMIT $start,$limit ";
		}
		
		if($where!='') {
			$where = " WHERE ".$where;
		}
		
		$mysql->query("
			SELECT *
			FROM `deposit`
			$where
			ORDER BY `datetime` DESC
			$limitQuery
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$return = array();
		while($d = $mysql->fetch_array()) {
			$return[] = $d;
		}
		
		return $return;
	}
	
	public function get($id) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `deposit`
			WHERE `id` = '".intval($id)."'
		");
		
		return $mysql->fetch_array();
	}
	
	public function add() {
		global $mysql;
		
		if(!isset($_POST['amount']) || !is_numeric($_POST['amount'])) {
			return false;			
		}
		
		$mysql->query("
			INSERT INTO `deposit` (
				`user_id`,
				`deposit`,
				`datetime`				
			)
			VALUES (
				'".intval($_SESSION['user']['user_id'])."',
				'".sql_quote($_POST['amount'])."',
				NOW()
			)
		");
		
		return $mysql->insert_id();
	}
	
	public function depositIsPay($deposit_id) {
		global $mysql, $langArray, $config;
		
		$row = $this->get($deposit_id);
		
		if($row) {
			
			if($row['paid'] == 'true') {
				return;
			}
			
			$mysql->query("
				UPDATE `users`
				SET `deposit` = `deposit` + '".sql_quote($row['deposit'])."',
						`total` = `total` + '".sql_quote($row['deposit'])."'
				WHERE `user_id` = '".intval($row['user_id'])."'
				LIMIT 1
			");
			
			$mysql->query("
				UPDATE `deposit`
				SET `paid` = 'true'								
				WHERE `id` = '".intval($deposit_id)."'
			");
			
			if(isset($_SESSION['user'])) {
				$_SESSION['user']['deposit'] = floatval($_SESSION['user']['deposit']) + floatval($row['deposit']);
				$_SESSION['user']['total'] = floatval($_SESSION['user']['total']) + floatval($row['deposit']);
			}
			
			require_once ROOT_PATH.'/scripthub/classes/history.class.php';
			$historyClass = new history();
			
			$historyClass->add($langArray['deposit_history'].$row['deposit'], $deposit_id, $row['user_id']);
			
#CHECK REFERAL
			require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
			$usersClass = new users();

			$user = $usersClass->get($row['user_id']);
			if($user['referal_id'] != '0') {
				
				$this->referalMoney($row, $user);
				
			}
		}
		
	}
	
	public function success() {
		global $mysql, $langArray, $config;
		
		require_once ROOT_PATH.'/scripthub/classes/paypal.class.php';
		$paypalClass = new paypal();
		
		if($paypalClass->validate_ipn()) {
		          
			if($paypalClass->ipn_data['receiver_email'] == $config['paypal']['business'] && $paypalClass->ipn_data['txn_id'] != 0) {
		
				if($paypalClass->ipn_data['payment_status'] == 'Completed' || $paypalClass->ipn_data['payment_status'] == 'Pending') {
					
					$row = $this->get($paypalClass->ipn_data['custom']);
					if(!is_array($row)) {
						return 'error_deposit'; //ERROR
					}
					
					if($row['deposit'] != $paypalClass->ipn_data['mc_gross']) {
						return 'error_deposit'; //ERROR
					}
					
					$mysql->query("
						UPDATE `users`
						SET `deposit` = `deposit` + '".sql_quote($paypalClass->ipn_data['mc_gross'])."',
								`total` = `total` + '".sql_quote($paypalClass->ipn_data['mc_gross'])."'
						WHERE `user_id` = '".intval($row['user_id'])."'
						LIMIT 1
					");
					
					$mysql->query("
						UPDATE `deposit`
						SET `paid` = 'true'								
						WHERE `id` = '".intval($paypalClass->ipn_data['custom'])."'
					");
					
					$_SESSION['user']['deposit'] = floatval($_SESSION['user']['deposit']) + floatval($paypalClass->ipn_data['mc_gross']);
					$_SESSION['user']['total'] = floatval($_SESSION['user']['total']) + floatval($paypalClass->ipn_data['mc_gross']);
					
					require_once ROOT_PATH.'/scripthub/classes/history.class.php';
					$historyClass = new history();
					
					$historyClass->add($langArray['deposit_history'].$paypalClass->ipn_data['mc_gross'], $paypalClass->ipn_data['txn_id']);
					
#CHECK REFERAL
					require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
					$usersClass = new users();

					$user = $usersClass->get($row['user_id']);
					if($user['referal_id'] != '0') {
						
						$this->referalMoney($row, $user);
						
					}
					
					return true;
				}
				else {
					return 'error_order_payment'; //ERROR
				}
							
			}
			else {
				return 'error_order_payment'; //ERROR
			}
			
		}
		else {
			return 'error_order_payment'; //ERROR
		}
	}

	public function referalMoney($row, $user) {
		
		global $mysql;
		
		require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
		$usersClass = new users();
		
		require_once ROOT_PATH.'/scripthub/apps/system/models/system.class.php';
		$systemClass = new system();
		
		$totals = $usersClass->getTotalReferals($user['user_id'], $user['referal_id']);
		
		$configure = $systemClass->getAllKeyValue();
		
		
		if((int)$configure['referal_sum'] && ($totals+1) > (int)$configure['referal_sum']) {
			$mysql->query("
				UPDATE `users`
				SET `referal_id` = 0
				WHERE `user_id` = '".intval($user['user_id'])."'
				LIMIT 1 
			");
			return false;
		}
		
		
		$referalMoney = floatval($row['deposit']) * (int)$configure['referal_percent'] / 100;
						
		$mysql->query("
			UPDATE `users`
			SET `earning` = `earning` + '".sql_quote($referalMoney)."',
					`total` = `total` + '".sql_quote($referalMoney)."',
					`referal_money` = `referal_money` + '".sql_quote($referalMoney)."'									
			WHERE `user_id` = '".intval($user['referal_id'])."'
			LIMIT 1
		");
		
		$mysql->query("
			INSERT INTO `orders` (
				`user_id`,
				`owner_id`,
				`item_id`,
				`item_name`,
				`price`,
				`datetime`,
				`receive`,
				`paid`,
				`paid_datetime`,
				`type`
			)
			VALUES (
				'".intval($user['user_id'])."',
				'".intval($user['referal_id'])."',
				'0',
				'deposit',
				'".sql_quote($row['deposit'])."',
				NOW(),
				'".sql_quote($referalMoney)."',
				'true',
				NOW(),
				'referal'
			)
		");
	}
	
	public function addWithdraw() {
		global $mysql, $langArray, $user;
		
		if(!isset($_POST['maximum_at_period_end']) || $_POST['maximum_at_period_end'] != 'true') {
			if(!isset($_POST['amount']) || !is_numeric($_POST['amount'])) {
				$error['amount'] = $langArray['wrong_amount'];
			}
			else {
				
				if(isset($_POST['service']) && $_POST['service'] == 'swift') {
					if($_POST['amount'] < 500) {
						$error['amount'] = $langArray['wrong_amount2'];
					}
					$maxAmount = $user['earning'] - 35;				
				}
				else {
					if($_POST['amount'] < 50) {
						$error['amount'] = $langArray['wrong_amount2'];
					}
					$maxAmount = $user['earning'];
				}
								
				if($_POST['amount'] > $maxAmount) {
					$error['amount'] = $langArray['wrong_amount2'];
				}
			}
		}
		
		if(!isset($_POST['service'])) {
			$error['service'] = $langArray['error_service'];
		}
		else {
			if($_POST['service'] == 'swift' && (!isset($_POST['instructions_from_author']) || trim($_POST['instructions_from_author']) == '')) {
				$error['service2'] = $langArray['error_details'];
			}
			elseif(!isset($_POST['payment_email_address']) || !isset($_POST['payment_email_address_confirmation']) || trim($_POST['payment_email_address']) == '' || $_POST['payment_email_address'] !== $_POST['payment_email_address_confirmation']) {
				$error['service2'] = $langArray['error_payment_email_address'];				
			}
		}

		if(isset($_POST['taxable_australian_resident']) && $_POST['hobbyist'] == 'false' && trim($_POST['abn']) == '' && trim($_POST['acn']) == '') {
			$error['australian'] = $langArray['error_australian_resident'];
		}
		
		if(isset($error)) {
			return $error;
		}
		
		if(!isset($_POST['taxable_australian_resident'])) {
			$_POST['taxable_australian_resident'] = 'false';
		}
		else {
			if($_POST['hobbyist'] == 'true') {
				$_POST['taxable_australian_resident'] = 'iam';
			}
			elseif($_POST['hobbyist'] == 'false') {			
				$_POST['taxable_australian_resident'] = 'iamnot';
			}
		}
		
		if(!isset($_POST['abn'])) {
			$_POST['abn'] = '';
		}
		if(!isset($_POST['acn'])) {
			$_POST['acn'] = ''; 
		}
		
		$text = '';
		if($_POST['service'] == 'swift') {
			$text = $_POST['instructions_from_author'];
		}
		else {
			$text = $_POST['payment_email_address'];
		}
		
		if(isset($_POST['maximum_at_period_end']) && $_POST['maximum_at_period_end'] == 'true') {
			$_POST['amount'] = 'all to '.date('t M Y');
		}
		
		$mysql->query("
			INSERT INTO `withdraw` (
				`user_id`,
				`amount`,
				`method`,
				`text`,
				`australian`,
				`abn`,
				`acn`,
				`datetime`
			)
			VALUES (
				'".intval($_SESSION['user']['user_id'])."',
				'".sql_quote($_POST['amount'])."',
				'".sql_quote($_POST['service'])."',
				'".sql_quote($text)."',
				'".sql_quote($_POST['taxable_australian_resident'])."',
				'".sql_quote($_POST['abn'])."',
				'".sql_quote($_POST['acn'])."',
				NOW()
			)
		");
		
		return true;		
	}
	
	
	public function getWithdraws($start=0, $limit=0) {
		global $mysql;
		
		$limitQuery = '';
		if($limit!=0) {
			$limitQuery = " LIMIT $start,$limit ";
		}
		
		$mysql->query("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM `withdraw`
			ORDER BY `datetime` DESC
			$limitQuery
		");
			
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$return = array();
		while($d = $mysql->fetch_array()) {
			$return[] = $d;
			
			if($this->usersWhere != '') {
				$this->usersWhere .= ' OR ';
			}
			$this->usersWhere .= " `user_id` = '".intval($d['user_id'])."' ";
		}
		
		$this->foundRows = $mysql->getFoundRows();
		
		return $return;
	}
	
	public function getWithdraw($id) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `withdraw`
			WHERE `id` = '".intval($id)."'
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return $mysql->fetch_array();
	}
	
	public function deleteWithdraw($id) {
		global $mysql;
		
		$row = $this->getWithdraw($id);
		if(!is_array($row) || $row['paid'] == 'true') {
			return true;
		}
		
		$mysql->query("
			DELETE FROM `withdraw`
			WHERE `id` = '".intval($id)."'
			LIMIT 1
		");
		
		return true;
	}
	
	public function payoutWithdraw() {
		global $mysql, $langArray, $user, $data;
		
		if(!isset($_POST['payout']) || !is_numeric($_POST['payout']) || $_POST['payout'] < 1) {
			return $langArray['error_set_valid_sum'];
		}
		
		if($_POST['payout'] > $user['earning']) {
			return $langArray['error_not_enought_money_earning'];
		}
		
		$mysql->query("
			UPDATE `users`
			SET `earning` = `earning` - '".floatval($_POST['payout'])."',
					`total` = `total` - '".floatval($_POST['payout'])."'
			WHERE `user_id` = '".intval($user['user_id'])."'
			LIMIT 1
		");
		
		$mysql->query("
			UPDATE `withdraw`
			SET `paid` = 'true',
					`paid_datetime` = NOW()
			WHERE `id` = '".intval($data['id'])."'
			LIMIT 1
		");
		
		return true;
	}
	
	
	public function getWithdrawCount($whereQuery) {
		global $mysql;
		
		if($whereQuery != '') {
			$whereQuery = " WHERE ".$whereQuery;
		}
		
		$mysql->query("
			SELECT COUNT(`id`) AS `num`, SUM(`amount`) AS `total`
			FROM `withdraw`
			$whereQuery
		");			
			
		return $mysql->fetch_array();
	}
	
}

?>