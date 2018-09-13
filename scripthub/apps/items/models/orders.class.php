<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

class orders {
	
	public $row = '';
	public $whereQuery = '';
	public $usersWhere = '';
	
	public function getAll($where='', $order='`paid_datetime` DESC') {
		global $mysql;
		
		if($where!='') {
			$where = " WHERE ".$where;
		}
		
		$mysql->query("
			SELECT *
			FROM `orders`
			$where
			ORDER BY $order		
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
			FROM `orders`
			WHERE `id` = '".intval($id)."'
		");		
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return $mysql->fetch_array();
	}
	
	public function add($price, $extended='false') {
		global $mysql, $item;
		
		$mysql->query("
			INSERT INTO `orders` (
				`user_id`,
				`owner_id`,
				`item_id`,
				`item_name`,
				`price`,
				`datetime`,
				`extended`
			)
			VALUES (
				'".intval($_SESSION['user']['user_id'])."',
				'".intval($item['user_id'])."',
				'".intval($item['id'])."',
				'".sql_quote($item['name'])."',
				'".sql_quote($price)."',
				NOW(),
				'".sql_quote($extended)."'
			)
		");
		
		return $mysql->insert_id();
	}
	
	/* v 1.11 */
	public function IsPay($order_id) {
		$row = $this->get($order_id);
		if(!is_array($row)) {
			return false;
		}
		return $row['paid'] == 'true' ? true : false;
	}
	
	public function orderIsPay($order_id) {
		global $mysql, $langArray, $config;
		
		$row = $this->get($order_id);
		if(!is_array($row)) {
			return 'error_paing'; //ERROR
		}
					
		#LOAD USERS SOLD					
		require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
		$usersClass = new users();
					
		$user = $usersClass->get($row['owner_id']);
					
		#GET PERCENT
		require_once ROOT_PATH.'/scripthub/apps/percents/models/percents.class.php';
		$percentsClass = new percents();
					
		$percent = $percentsClass->getPercentRow($user);
		$percent = $percent['percent'];
					
		$receiveMoney = floatval($row['price']) * floatval($percent) / 100;
					
		$mysql->query("
			UPDATE `orders`
			SET `paid` = 'true',
				`paid_datetime` = NOW(),
				`receive` = '".sql_quote($receiveMoney)."'
			WHERE `id` = '".intval($order_id)."'
		");
					
		$mysql->query("
			UPDATE `users`
			SET `earning` = `earning` + '".sql_quote($receiveMoney)."',
				`total` = `total` + '".sql_quote($receiveMoney)."',
				`sold` = `sold` + '".floatval($row['price'])."',
				`sales` = `sales` + 1
			WHERE `user_id` = '".intval($row['owner_id'])."'
			LIMIT 1
		");
					
		$you = $usersClass->get($row['user_id']);

		#CHECK REFERAL					
		if($you['referal_id'] != '0') {
						
			$this->referalMoney($row, $you);
						
		}
					
		#UPDATE YOU BUY
		$mysql->query("
			UPDATE `users`
			SET `buy` = `buy` + 1
			WHERE `user_id` = '".intval($row['user_id'])."'
			LIMIT 1 
		");
					
		#UPDATE ITEM
		$setQuery = '';
		if($row['extended'] == 'true') {
			$setQuery = " `status` = 'extended_buy', ";
			$mysql->query("
				UPDATE `users`
				SET `items` = `items` - 1
				WHERE `user_id` = '".intval($row['owner_id'])."'
				LIMIT 1 
			");
		}
					
		$mysql->query("
			UPDATE `items`
			SET `sales` = `sales` + 1,
				$setQuery
				`earning` = `earning` + '".sql_quote($row['price'])."'
			WHERE `id` = '".intval($row['item_id'])."'
		");
					
		return true;
	}
	/* end v1.11 */
	
	public function success() {
		global $mysql, $langArray, $config;
		
		require_once ROOT_PATH.'/scripthub/classes/paypal.class.php';
		$paypalClass = new paypal();
		echo 1234;
		exit;
		if($paypalClass->validate_ipn()) {
		     
			if($paypalClass->ipn_data['receiver_email'] == $config['paypal']['business'] && $paypalClass->ipn_data['txn_id'] != 0) {
		
				if($paypalClass->ipn_data['payment_status'] == 'Completed') {
					
					$row = $this->get($paypalClass->ipn_data['custom']);
					if(!is_array($row)) {
						return 'error_paing'; //ERROR
					}
					
					if($row['price'] != $paypalClass->ipn_data['mc_gross']) {
						return 'error_paing'; //ERROR
					}
					
#LOAD USERS SOLD					
					require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
					$usersClass = new users();
					
					$user = $usersClass->get($row['owner_id']);
					
#GET PERCENT
					require_once ROOT_PATH.'/scripthub/apps/percents/models/percents.class.php';
					$percentsClass = new percents();
					
					$percent = $percentsClass->getPercentRow($user);
					$percent = $percent['percent'];
					
					$receiveMoney = floatval($row['price']) * floatval($percent) / 100;
					
					$mysql->query("
						UPDATE `orders`
						SET `paid` = 'true',
								`paid_datetime` = NOW(),
								`receive` = '".sql_quote($receiveMoney)."'
						WHERE `id` = '".intval($paypalClass->ipn_data['custom'])."'
					");
					
					$mysql->query("
						UPDATE `users`
						SET `earning` = `earning` + '".sql_quote($receiveMoney)."',
								`total` = `total` + '".sql_quote($receiveMoney)."',
								`sold` = `sold` + '".floatval($row['price'])."',
								`sales` = `sales` + 1
						WHERE `user_id` = '".intval($row['owner_id'])."'
						LIMIT 1
					");
					
					$you = $usersClass->get($row['user_id']);

#CHECK REFERAL					
					if($you['referal_id'] != '0') {
						
						$this->referalMoney($row, $you);
						
					}
					
					#UPDATE YOU BUY
					$mysql->query("
						UPDATE `users`
						SET `buy` = `buy` + 1
						WHERE `user_id` = '".intval($row['user_id'])."'
						LIMIT 1 
					");
					
					#UPDATE ITEM
					$setQuery = '';
					if($row['extended'] == 'true') {
						$setQuery = " `status` = 'extended_buy', ";
						
						$mysql->query("
							UPDATE `users`
							SET `items` = `items` - 1
							WHERE `user_id` = '".intval($row['user_id'])."'
							LIMIT 1 
						");
					}
					
					$mysql->query("
						UPDATE `items`
						SET `sales` = `sales` + 1,
								$setQuery
								`earning` = `earning` + '".sql_quote($row['price'])."'
						WHERE `id` = '".intval($row['id'])."'
					");
					
					return true;
				}
				else {
					return 'error_paing'; //ERROR
				}
							
			}
			else {
				return 'error_paing'; //ERROR
			}
			
		}
		else {
			return 'error_paing'; //ERROR
		}
	}
	
	public function referalMoney($row, $you) {
		global $mysql;
		
		require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
		$usersClass = new users();
		
		require_once ROOT_PATH.'/scripthub/apps/system/models/system.class.php';
		$systemClass = new system();
		
		$totals = $usersClass->getTotalReferals($you['user_id'], $you['referal_id']);
		
		$configure = $systemClass->getAllKeyValue();
		
		
		
		if((int)$configure['referal_sum'] && ($totals+1) > (int)$configure['referal_sum']) {
			$mysql->query("
				UPDATE `users`
				SET `referal_id` = 0
				WHERE `user_id` = '".intval($you['user_id'])."'
				LIMIT 1 
			");
			return false;
		}
		
		
		$referalMoney = floatval($row['price']) * (int)$configure['referal_percent'] / 100;
						
		$mysql->query("
			UPDATE `users`
			SET `earning` = `earning` + '".sql_quote($referalMoney)."',
					`total` = `total` + '".sql_quote($referalMoney)."',
					`referal_money` = `referal_money` + '".sql_quote($referalMoney)."'
			WHERE `user_id` = '".intval($you['referal_id'])."'
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
				'".intval($row['user_id'])."',
				'".intval($row['owner_id'])."',
				'".intval($row['item_id'])."',
				'".sql_quote($row['item_name'])."',
				'".sql_quote($row['price'])."',
				NOW(),
				'".sql_quote($referalMoney)."',
				'true',
				NOW(),
				'referal'
			)
		");
		
		$mysql->query("
			INSERT INTO `users_referals_count` (
				`user_id`,
				`referal_id`,
				`datetime`
			)
			VALUES (
				'".intval($you['user_id'])."',
				'".intval($you['referal_id'])."',
				NOW()
			)
		");
	}
	
	public function buy($price, $extended=false) {
		global $mysql, $item;
		
		
		
		require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
		$usersClass = new users();
		
		$you = $usersClass->get($_SESSION['user']['user_id']);
		
		$deposit = 0;
		$earning = 0;
		if($you['deposit'] > $price) {
			$deposit = $price;
		}
		else {
			$deposit = $you['deposit'];
			$earning = floatval($price) - floatval($you['deposit']);
		}
		
#GET PRICE FROM USER	
		$mysql->query("
			UPDATE `users`
			SET `deposit` = `deposit` - '".floatval($deposit)."',
					`earning` = `earning` - '".floatval($earning)."',
					`total` = `total` - '".floatval($price)."'
			WHERE `user_id` = '".intval($you['user_id'])."'
			LIMIT 1
		");
		
		$_SESSION['user']['deposit'] = floatval($_SESSION['user']['deposit']) - floatval($deposit);
		$_SESSION['user']['earning'] = floatval($_SESSION['user']['earning']) - floatval($earning);
		$_SESSION['user']['total'] = floatval($_SESSION['user']['total']) - floatval($price);
		
#CHECK REFERAL
		if($you['referal_id'] != '0') {
			
			$this->referalMoney(array(
				'price' => $price,
				'user_id' => $_SESSION['user']['user_id'],
				'owner_id' => $item['user_id'],
				'item_id' => $item['id'],
				'item_name' => $item['name']
			), $you);
			
		}

#ADD PRICE TO OWNER USER
		$user = $usersClass->get($item['user_id']);
		
		require_once ROOT_PATH.'/scripthub/apps/percents/models/percents.class.php';
		$percentsClass = new percents();
		
		$percent = $percentsClass->getPercentRow($user);
		$percent = $percent['percent'];
		
		$receiveMoney = floatval($price) * floatval($percent) / 100;
					
		$mysql->query("
			UPDATE `users`
			SET `earning` = `earning` + '".floatval($receiveMoney)."',
					`total` = `total` + '".floatval($receiveMoney)."',
					`sold` = `sold` + '".floatval($price)."',
					`sales` = `sales` + 1
			WHERE `user_id` = '".intval($user['user_id'])."'
			LIMIT 1
		");
		
#ADD ORDER
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
				`paid_datetime`
			)
			VALUES (
				'".intval($_SESSION['user']['user_id'])."',
				'".intval($item['user_id'])."',
				'".intval($item['id'])."',
				'".sql_quote($item['name'])."',
				'".sql_quote($price)."',
				NOW(),
				'".sql_quote($receiveMoney)."',
				'true',
				NOW()
			)
		");	
		
		$mysql->query("
			UPDATE `users`
			SET `buy` = `buy` + 1
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."'
			LIMIT 1 
		");
		
#UPDATE ITEM
		$setQuery = '';
		if($extended) {
			$setQuery = " `status` = 'extended_buy', ";
		}
			
		$mysql->query("
			UPDATE `items`
			SET `sales` = `sales` + 1,
					$setQuery
					`earning` = `earning` + '".sql_quote($price)."'
			WHERE `id` = '".intval($item['id'])."'
		");		

		return true;
	}
	
	public function isBuyed($id) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `orders`
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."' AND `item_id` = '".intval($id)."'  AND paid = 'true' AND `type`='buy'
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$this->row = $mysql->fetch_array();
		
		return true;
	}
	
	
	public function getAllBuyed($where='') {
		global $mysql;
		
		if($where!='') {
			$where = " WHERE ".$where;
		}
		
		$mysql->query("
			SELECT *
			FROM `orders`
			$where
			ORDER BY `paid_datetime` DESC
		");
			
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$whereQuery = '';
		while($d = $mysql->fetch_array()) {
			if($this->whereQuery != '') {
				$this->whereQuery .= " OR ";
			}
			$this->whereQuery .= " `id` = '".intval($d['item_id'])."' ";
		}
		
		$mysql->query("
			SELECT *
			FROM `items`
			WHERE $this->whereQuery
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
	
	
	public function getWeekStats() {
		global $mysql;
		
		$buff = 6 - date('N');	
		$lastWeekDay = date('Y-m-d', mktime(0, 0, 0, date('m'), (date('d') - $buff - date('N')), date('Y')));
		$firstWeekDay = date('Y-m-d', mktime(0, 0, 0, date('m'), (date('d') + $buff + 2), date('Y')));
		
//		echo $lastWeekDay.' '.$firstWeekDay;
		
		$mysql->query("
			SELECT *
			FROM `orders`
			WHERE `owner_id` = '".intval($_SESSION['user']['user_id'])."' AND `paid` = 'true' AND `datetime` > '".$lastWeekDay."' AND `datetime` < '".$firstWeekDay."'
		");
		
		$weekStats = array('earning' => 0, 'sold' => 0);
		
		if($mysql->num_rows() == 0) {
			return $weekStats;
		}
		
		while($d = $mysql->fetch_array()) {
			$weekStats['sold']++;
			$weekStats['earning'] += $d['receive'];
		}
		
		return $weekStats;
	}
	
	
	public function getStatement($userID, $month, $year) {
		global $mysql;
		
		$lastMonth = date('Y-m-d 23:59:59', mktime(0, 0, 0, ($month-1), date('t', mktime(0, 0, 0, ($month-1), 1, $year)), $year));
		$nextMonth = date('Y-m-d 00:00:00', mktime(0, 0, 0, ($month+1), 1, $year));	
		
		$mysql->query("
			(
				SELECT `user_id`, `owner_id`, `price`, `receive`, `paid_datetime` as `datetime`, `item_name`, `type` as `referal`, CONCAT('order') as `type`
				FROM `orders`
				WHERE (`owner_id` = '".intval($userID)."' OR `user_id` = '".intval($userID)."') AND `paid` = 'true' AND `paid_datetime` > '".$lastMonth."' AND `paid_datetime` < '".$nextMonth."'
			)
			UNION		
			(
				SELECT `user_id`, CONCAT('') as `owner_id`, `deposit` as `price`, CONCAT('') as `receive`, `datetime`, CONCAT('') as `item_name`, CONCAT('') as `referal`, CONCAT('deposit') as `type`
				FROM `deposit`
				WHERE `user_id` = '".intval($userID)."' AND `paid` = 'true' AND `datetime` > '".$lastMonth."' AND `datetime` < '".$nextMonth."'
			)
			UNION
			(
				SELECT `user_id`, CONCAT('') as `owner_id`, `amount` as `price`, CONCAT('') as `receive`, `datetime`, CONCAT('') as `item_name`, CONCAT('') as `referal`, CONCAT('withdraw') as `type`
				FROM `withdraw`
				WHERE `user_id` = '".intval($userID)."' AND `paid` = 'true' AND `datetime` > '".$lastMonth."' AND `datetime` < '".$nextMonth."'
			)
			ORDER BY `datetime` DESC
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
	
	
	
	public function getTopSellers($start=0, $limit=0, $where='') {
		global $mysql;
		
		$limitQuery = '';
		if($limit!=0) {
			$limitQuery = " LIMIT $start,$limit ";
		}
		
		$mysql->query("
			SELECT *, COUNT(`item_id`) AS `sales` 
			FROM `orders`
			WHERE `type` = 'buy' AND `paid` = 'true' $where
			GROUP BY `item_id`
			ORDER BY `sales` DESC
			$limitQuery
		");
			
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$return = array();
		$whereQuery = '';
		while($d = $mysql->fetch_array()) {
			$return[$d['item_id']] = $d;
			
			if($whereQuery != '') {
				$whereQuery .= ' OR ';
			}
			$whereQuery .= " `id` = '".intval($d['item_id'])."' ";
		}
		
		
		
		$mysql->query("
               SELECT *
               FROM `items`
               LEFT JOIN `items_to_category` as ic ON `ic`.`item_id` = `items`.`id`  
               WHERE $whereQuery
         ");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$this->usersWhere = '';
		while($d = $mysql->fetch_array()) {
			$d['sales'] = $return[$d['id']]['sales'];
			
			$categories = explode('|', $d['categories']);
			unset($d['categories']);
			$d['categories'] = array();
			$row=0;
			foreach($categories AS $cat) {
				$categories1 = explode(',', $cat);
				foreach($categories1 as $c) {
					$c = trim($c);
					if($c != '') {
						$d['categories'][$row][$c] = $c;
					}
				}
				$row++;
			}
			
			$return[$d['id']] = $d;
			
			if($this->usersWhere != '') {
				$this->usersWhere .= ' OR ';
			}
			$this->usersWhere .= " `user_id` = '".intval($d['user_id'])."' ";
		}
		
		return $return;
	}
	
	public function getTopAuthors($start=0, $limit=0, $where='') {
		global $mysql;
		
		$limitQuery = '';
		if($limit!=0) {
			$limitQuery = " LIMIT $start,$limit ";
		}
		
		$mysql->query("
			SELECT *, COUNT(`owner_id`) AS `sales` 
			FROM `orders`
			WHERE `type` = 'buy' AND `paid` = 'true' $where
			GROUP BY `owner_id`
			ORDER BY `sales` DESC
			$limitQuery
		");
			
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$return = array();
		$whereQuery = '';
		while($d = $mysql->fetch_array()) {
			$return[$d['owner_id']] = $d;
			
			if($whereQuery != '') {
				$whereQuery .= ' OR ';
			}
			$whereQuery .= " `user_id` = '".intval($d['owner_id'])."' ";
		}
		
		$mysql->query("
			SELECT *
			FROM `users`
			WHERE $whereQuery
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		while($d = $mysql->fetch_array()) {
			$d['sales'] = $return[$d['user_id']]['sales'];
			$return[$d['user_id']] = $d;
		}
		
		return $return;
	}
	
	public function isItemBuyed($itemID, $usersWhere) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `orders`
			WHERE `item_id` = '".intval($itemID)."' AND `type` = 'buy' AND `paid` = 'true' AND ($usersWhere)			
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$return = array();
		while($d = $mysql->fetch_array()) {
			$return[$d['user_id']] = $d;
		}
		
		return $return;
	}
	
	
	public function getSalesStatus($whereQuery='', $type='buy') {
		global $mysql;

		$mysql->query("
			SELECT COUNT(`id`) as `num`, SUM(`price`) as `total`, SUM(`receive`) AS `receive` 
			FROM `orders` 
			WHERE `type` = '".sql_quote($type)."' AND `paid` = 'true' $whereQuery 
			GROUP BY `type`
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return $mysql->fetch_array();
	}
	
	public function getSalesStatusByDay($whereQuery='', $type='buy') {
		global $mysql;
		
		$mysql->query("
			SELECT COUNT(`id`) as `num`, SUM(`price`) as `total`, SUM(`receive`) AS `receive` , DATE(`datetime`) AS `date`
			FROM `orders` 
			WHERE `type` = '".sql_quote($type)."' AND `paid` = 'true' $whereQuery 
			GROUP BY DATE(`datetime`)
			ORDER BY DATE(`datetime`) ASC
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$data = array();
		while ($d = $mysql->fetch_array()) {
			$data[$d['date']] = $d;
		}
		
		return $data;
	}
	
}

?>