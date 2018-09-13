<?
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

class users extends base {

	public $avatarError = false;
	public $homeimageError = false;
	
	function __construct() {
		global $config;
		
		$this->photoSizes = $config['avatar_photo_sizes'];
		$this->uploadFileDirectory = 'users/';
	}

	
	/*
	 * GET FUNCTIONS
	 */
	public function getAll($start=0, $limit=0, $where='', $order='`username` ASC') {
		global $mysql;
		
		$limitQuery = "";
		if($limit!=0) {
			$limitQuery = "LIMIT $start,$limit";
		}
		
		if($where != '') {
			$where = " WHERE ".$where;
		}
		
		$mysql->query("
			SELECT 
				SQL_CALC_FOUND_ROWS *,
				( SELECT COUNT(follow_id) FROM `users_followers` WHERE  `user_id` = `users`.`user_id` ) AS followers
			FROM `users`
			$where
			ORDER BY $order
			$limitQuery
		");

		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$return = array();
		while($d = $mysql->fetch_array()) {
			$return[$d['user_id']] = $d;
			
		}
			
		$this->foundRows = $mysql->getFoundRows();
		
		return $return;
	}
	
	public function get($id) {
		global $mysql, $langArray;
		
		$return = $mysql->getRow("
			SELECT *
			FROM `users`
			WHERE `user_id` = '".intval($id)."'
		" );
		
		if(is_array($langArray['moneyArr'])) {
			foreach($langArray['moneyArr'] as $k=>$v) {
				$return['moneyText'] = $v;
				if($return['buy'] <= $k) {
					break;
				}
			}
		}
		
		if(is_array($langArray['earningArr'])) {
			foreach($langArray['earningArr'] as $k=>$v) {
				$return['earningText'] = $v;
				if($return['sold'] <= $k) {
					break;
				}
			}
		}
		
		if($return['license'] != '') {
			$buff = unserialize($return['license']);
			unset($return['license']);
			$return['license'] = $buff;
			unset($buff);
		}
		if($return['social'] != '') {
			$buff = unserialize($return['social']);
			unset($return['social']);
			$return['social'] = $buff;
			unset($buff);
		}			
		
		if($return['groups'] != '') {
			$groups = unserialize($return['groups']);
			unset($return['groups']);		
			if(is_array($groups) && !empty($groups)) {
				
				$groupsWhere = '';
				
				foreach($groups as $k=>$v) {
					$return['groups'][$k] = $v;
					
					if($groupsWhere != '') {
						$groupsWhere .= " OR ";
					}
					$groupsWhere .= " `ug_id` = '".intval($k)."' ";
				}
				
				$mysql->query("
					SELECT *
					FROM `user_groups`
					WHERE $groupsWhere
				", __FUNCTION__ );
				
				if($mysql->num_rows() > 0) {
					$return['is_admin'] = true;
	
					while($d = $mysql->fetch_array()) {
						
						$modules = unserialize($d['rights']);
						foreach($modules as $k=>$v) {						
							if(!isset($return['modules'][$k])) {													
								$return['modules'][$k] = true;	
							}
						}
						
					}
					
					$return['access'] = $return['modules'];
				}
				else {
					$return['modules'] = '';
				}
								
			}
			else {
				$return['groups'] = '';
			}
		}
		
		$mysql->query("
			SELECT *
			FROM `countries`
			WHERE `id` = '".intval($return['country_id'])."'
		");
		
		$return['country'] = $mysql->fetch_array();
		
		$mysql->query("
			SELECT *
			FROM `users_status`
			WHERE `user_id` = '".intval($return['user_id'])."'
		");		
		
		if($mysql->num_rows() > 0) {
			while($d = $mysql->fetch_array()) {
				$return['statuses'][$d['status']] = $d;
			}
		}
		
		return $return;
	}
	
	public function getByUsername($username) {
		global $mysql;
		
		$return = $mysql->getRow("
			SELECT *
			FROM `users`
			WHERE `username` = '".sql_quote($username)."'
		" );
		
		if(!is_array($return)) {
			return false;
		}
		
		$buff = unserialize($return['license']);
		unset($return['license']);
		$return['license'] = $buff;
		unset($buff);		
		$buff = unserialize($return['social']);
		unset($return['social']);
		$return['social'] = $buff;
		unset($buff);
		
		$groups = unserialize($return['groups']);
		unset($return['groups']);		
		if(is_array($groups) && !empty($groups)) {
			
			$groupsWhere = '';
			
			foreach($groups as $k=>$v) {
				$return['groups'][$k] = $v;
				
				if($groupsWhere != '') {
					$groupsWhere .= " OR ";
				}
				$groupsWhere .= " `ug_id` = '".intval($k)."' ";
			}
			
			$mysql->query("
				SELECT *
				FROM `user_groups`
				WHERE $groupsWhere
			", __FUNCTION__ );
			
			if($mysql->num_rows() > 0) {
				$return['is_admin'] = true;

				while($d = $mysql->fetch_array()) {
					
					$modules = unserialize($d['rights']);
					foreach($modules as $k=>$v) {						
						if(!isset($return['modules'][$k])) {													
							$return['modules'][$k] = true;	
						}
					}
					
				}
			}
			else {
				$return['modules'] = '';
			}
							
		}
		else {
			$return['groups'] = '';
		}
		
#LOAD COUNTRY
		if($return['country_id'] != '0') {
			require_once ROOT_PATH.'/scripthub/apps/countries/models/countries.class.php';
			$countriesClass = new countries();
			
			$return['country'] = $countriesClass->get($return['country_id']);
		}	

#LOAD STATUS
		$mysql->query("
			SELECT *
			FROM `users_status`
			WHERE `user_id` = '".intval($return['user_id'])."'
		");		
		
		if($mysql->num_rows() > 0) {
			while($d = $mysql->fetch_array()) {
				$return['statuses'][$d['status']] = $d;
			}
		}
		
		return $return;
	}
	
	
	public function isExistUsername($username) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `users`
			WHERE `username` = '".sql_quote($username)."'
		", __FUNCTION__ );
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return true;
	}
	
	private function isExistEmail($email, $without='') {
		global $mysql;
		
		$whereQuery = '';
		if($without != '') {
			$whereQuery = " AND `email` <> '".sql_quote($without)."' ";
		}
		
		$mysql->query("
			SELECT *
			FROM `users`
			WHERE `email` = '".sql_quote($email)."' $whereQuery
		", __FUNCTION__ );
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return true;
	}
	
	/*
	 * ADD USER
	 */
	public function add() {
		global $mysql, $langArray, $languageURL, $config;

		if(!isset($_POST['firstname']) || trim($_POST['firstname']) == '') {
			$error['firstname'] = $langArray['error_fill_firstname'];
		}		
		if(!isset($_POST['lastname']) || trim($_POST['lastname']) == '') {
			$error['lastname'] = $langArray['error_fill_lastname'];
		}		
		
		if(!isset($_POST['email']) || trim($_POST['email']) == '') {
			$error['email'] = $langArray['error_fill_email'];
		}
		elseif(!check_email($_POST['email'])) {
			$error['email'] = $langArray['error_not_valid_email'];
		}
		elseif($this->isExistEmail($_POST['email'])) {
			$error['email'] = $langArray['error_exist_email'];
		}
		
		if(!isset($_POST['email_confirm']) || trim($_POST['email_confirm']) == '') {
			$error['email_confirm'] = $langArray['error_fill_email_confirm'];
		}
		if(isset($_POST['email']) && isset($_POST['email_confirm']) && $_POST['email'] !== $_POST['email_confirm']) {
			$error['email_confirm'] = $langArray['error_emails_not_match'];
		}		
		
		if(!isset($_POST['username']) || trim($_POST['username']) == '') {
			$error['username'] = $langArray['error_not_set_username'];
		}		
		elseif(!preg_match('/^[a-zA-Z0-9_]+$/i', $_POST['username'])) {
			$error['username'] = $langArray['error_not_valid_username'];
		}
		elseif($this->isExistUsername($_POST['username'])) {
			$error['username'] = $langArray['error_exist_username'];
		}

		if(!isset($_POST['password']) || trim($_POST['password']) == '') {
			$error['password'] = $langArray['error_fill_password'];
		}
		if(!isset($_POST['password_confirm']) || trim($_POST['password_confirm']) == '') {
			$error['password_confirm'] = $langArray['error_fill_password_confirm'];
		}
		elseif(isset($_POST['password']) && isset($_POST['password_confirm']) && $_POST['password'] !== $_POST['password_confirm']) {
			$error['password_confirm'] = $langArray['error_password_not_match'];
		}
		
		if(!isset($_POST['terms'])) {
			$error['terms'] = $langArray['error_not_agree_with_terms'];
		}
		
        
		require_once ROOT_PATH.'/scripthub/classes/recaptchalib.php';
		$resp = recaptcha_check_answer($config['recaptcha_private_key'],
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  	    if (!$resp->is_valid) {
	        $error['captcha'] = $langArray['error_wrong_captcha'];
  	    }
        
		
		if(isset($error)) {
			return $error;
		}
		
		if(!isset($_POST['status'])) {
			$_POST['status'] = 'waiting';
		}
		
		$groups = array();
		if(isset($_POST['groups']) && is_array($_POST['groups'])) {
			foreach($_POST['groups'] as $k=>$v) {
				$groups[$k] = $v;
			}			
		}
		
		$activationKey = md5(rand(0,10000).date('HisdmY').rand(0,10000));
		
		$referalID = 0;
		if(isset($_SESSION['temp']['referal'])) {
			if($this->isExistUsername($_SESSION['temp']['referal'])) {
				$referalID = $mysql->fetch_array();
				$referalID = $referalID['user_id'];
			}
			unset($_SESSION['temp']['referal']);
		}
		
		$mysql->query("
			INSERT INTO `users` (
				`username`,
				`password`,
				`email`,
				`firstname`,
				`lastname`,
				`register_datetime`,
				`status`,
				`groups`,
				`activate_key`,
				`referal_id`				
			)
			VALUES (
				'".sql_quote($_POST['username'])."',
				'".md5(md5($_POST['password']))."',
				'".sql_quote($_POST['email'])."',
				'".sql_quote($_POST['firstname'])."',
				'".sql_quote($_POST['lastname'])."',
				NOW(),
				'".sql_quote($_POST['status'])."',
				'".serialize($groups)."',
				'".sql_quote($activationKey)."',
				'".intval($referalID)."'
			)
		", __FUNCTION__ );
		
		if($referalID != 0) {
			$mysql->query("
				UPDATE `users`
				SET `referals` = `referals` + 1
				WHERE `user_id` = '".intval($referalID)."'
				LIMIT 1
			");
		}
		
#ADD TO BULLETIN
		if(isset($_POST['subscribe'])) {
			require_once ROOT_PATH.'/scripthub/apps/bulletin/models/bulletin.class.php';
			$bulletinClass = new bulletin();
			
			$bulletinClass->addBulletinEmail($_POST['email']);
		}
		
#SEND ACTIVATION LINK		
		require_once ENGINE_PATH.'/classes/email.class.php';
		$emailClass = new email();
		
		$emailClass->fromEmail = 'no-reply@'.$config['domain'];
		$emailClass->subject = '['.$config['domain'].'] '.$langArray['email_activate_subject'];
		$emailClass->message = langMessageReplace($langArray['email_activate_text'], array(
																'DOMAIN' => $config['domain'],
																'LINK' => 'http://'.$config['domain'].'/'.$languageURL.'sign_in/?command=activate&user='.$_POST['username'].'&key='.$activationKey
														));
		$emailClass->to($_POST['email']);

		$emailClass->send();
		
		return true;
	}
	
	/*
	 * EDIT USER
	 */
	public function edit($id, $editFromAdmin=true) {
		global $mysql, $config, $langArray;

		$setQuery = "";
		
		if(isset($_POST['status'])) {
			$setQuery .= " `status` = '".sql_quote($_POST['status'])."' ";
		}

		if($editFromAdmin) {
			$groups = array();		
			if(isset($_POST['groups']) && is_array($_POST['groups'])) {
				foreach($_POST['groups'] as $k=>$v) {
					$groups[$k] = $v;
				}			
			}
			
			if($setQuery != '') {
				$setQuery .= ',';
			}
			$setQuery .= " `groups` = '".serialize($groups)."' ";
			
			if(isset($_POST['featured_author'])) {
				$setQuery .= " , `featured_author` = 'true' ";
			}
			else {
				$setQuery .= " , `featured_author` = 'false' ";
			}
			
			
			
			
			
			
			
			
			
			
			
			if(isset($_POST['power_elite_author'])) {
				$setQuery .= " , `power_elite_author` = 'true' ";
			}
			else {
				$setQuery .= " , `power_elite_author` = 'false' ";
			}
			
			
			if(isset($_POST['elite_author'])) {
				$setQuery .= " , `elite_author` = 'true' ";
			}
			else {
				$setQuery .= " , `elite_author` = 'false' ";
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			if(isset($_POST['badges'])) {
				$setQuery .= " , `badges` = '" . implode(',', $_POST['badges']) . "' ";
			} else {
				$setQuery .= " , `badges` = '' ";
			}
			
			if(isset($_POST['password']) && trim($_POST['password']) != '') {
				$setQuery .= " , `password` = '".md5(md5($_POST['password']))."' ";
			}
			
			if(isset($_POST['commission_percent'])) {
				$setQuery .= " , `commission_percent` = '".(int)$_POST['commission_percent']."' ";
			}
		}
				
		if($setQuery != '') {
			$mysql->query("
				UPDATE `users`
				SET $setQuery
				WHERE `user_id` = '".intval($id)."'
				LIMIT 1
			", __FUNCTION__ );
		}
		
		return true;
	}
	
	/*
	 * DELETE USER
	 */
	public function delete($id) {
		global $mysql;

		recursive_rmdir(DATA_SERVER_PATH . "/uploads/" . $this->uploadFileDirectory . $id.'/', true);
		
		$mysql->query("
			DELETE FROM `users`
			WHERE `user_id` = '".intval($id)."'
			LIMIT 1
		", __FUNCTION__ );
		
		return true;
	}
	
	private function deleteAvatar($id) {
		global $mysql, $config;
		
		$user = $this->get($id);
		if(!is_array($user)) {
			return false;
		}
		deleteFile ( DATA_SERVER_PATH . "/uploads/" . $this->uploadFileDirectory . $id.'/' . $user ['avatar'] );
		if(is_array($config['avatar_photo_sizes'])) {
			foreach ( $config['avatar_photo_sizes'] as $k => $v ) {
				deleteFile ( DATA_SERVER_PATH . "/uploads/" . $this->uploadFileDirectory . $id.'/' . $k . '_' . $user ['avatar'] );
			}
		}
		
		$mysql->query("
			UPDATE `users`
			SET `avatar` = NULL
			WHERE `user_id` = '".intval($id)."'
			LIMIT 1
		", __FUNCTION__ );
		
		return true;
	}
	
	private function deleteHomeimage($id) {
		global $mysql, $config;
		
		$user = $this->get($id);
		if(!is_array($user)) {
			return false;
		}
		deleteFile ( DATA_SERVER_PATH . "/uploads/" . $this->uploadFileDirectory . $id.'/' . $user ['homeimage'] );
		if(is_array($config['homeimage_photo_sizes'])) {
			foreach ( $config['homeimage_photo_sizes'] as $k => $v ) {
				deleteFile ( DATA_SERVER_PATH . "/uploads/" . $this->uploadFileDirectory . $id.'/' . $k . '_' . $user ['homeimage'] );
			}
		}
		
		$mysql->query("
			UPDATE `users`
			SET `homeimage` = NULL
			WHERE `user_id` = '".intval($id)."'
			LIMIT 1
		", __FUNCTION__ );
		
		return true;
	}
	
	
	/*
	 * LOGIN
	 */
	public function login($admin=false) {
		global $mysql, $config;
		
		if(!isset($_POST['username']) || !isset($_POST['password'])) {
			return 'error_invalid_username_or_password';
		}
		
		$mysql->query("
			SELECT *
			FROM `users`
			WHERE `username` = '".sql_quote($_POST['username'])."' AND `password` = '".md5(md5($_POST['password']))."' AND `status` = 'activate'
		", __FUNCTION__ );
		
		if($mysql->num_rows() == 0) {
			return 'error_invalid_username_or_password';
		}
		
		$row = $mysql->fetch_array();
		$user = $this->get($row['user_id']);
		
		if($user['last_login_datetime'] == '' || $user['last_login_datetime'] == '0000-00-00 00:00:00') {
			$user['first_login'] = 'yes';
		}
		
		if($admin && ($user['groups'] == false || count($user['groups']) < 1)) {
			return 'error_invalid_username_or_password';
		}		
		

		$verKey = '';
		if(isset($_POST['rememberme'])) {

			$verKey = md5(rand(0,9999999).time().$user['user_id']);

			setcookie("user_id", $user['user_id'], time()+2592000, "/", ".".$config['domain']);
      		setcookie("verifyKey", $verKey, time()+2592000, "/", ".".$config['domain']);
		}

		$mysql->query("
			UPDATE `users`
			SET `last_login_datetime` = NOW(),
					`ip_address` = '".sql_quote($_SERVER['REMOTE_ADDR'])."', 
					`remember_key` = '".sql_quote($verKey)."'
			WHERE `user_id` = '".intval($user['user_id'])."'
			LIMIT 1
		", __FUNCTION__ );
		
		$_SESSION['user'] = $user;
		
		return true;
	}
	
	
	public function isValidVerifyKey($user_id, $key) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `users`
			WHERE `user_id` = '".intval($user_id)."' AND `remember_key` = '".sql_quote($key)."'
		", __FUNCTION__ );
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return true;
	}
	
	public function isValidActivateKey($username, $key) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `users`
			WHERE `username` = '".sql_quote($username)."' AND `activate_key` = '".sql_quote($key)."'
		", __FUNCTION__ );
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return true;
	}
	
	public function activateUser($username, $key) {
		global $mysql, $langArray;
		
		if(!$this->isValidActivateKey($username, $key)) {
			$error['valid'] = $langArray['error_not_valid_activate_key'];
		}
		
		if(isset($error)) {
			return $error;
		}
		
		$mysql->query("
			UPDATE `users`
			SET `status` = 'activate',
					`activate_key` = NULL
			WHERE `username` = '".sql_quote($username)."' AND `activate_key` = '".sql_quote($key)."'
			LIMIT 1
		");
		
		$_SESSION['user'] = $this->getByUsername($username);
		
		return true;
	}
	
	/*
	 * CHANGE PASSWORD
	 */
	public function changePassword() {
		global $mysql, $langArray, $config;
		
		$mysql->query("
			SELECT *
			FROM `users`
			WHERE `username` = '".sql_quote($_POST['username'])."' AND `email` = '".sql_quote($_POST['email'])."'
		", __FUNCTION__ );
		
		if($mysql->num_rows() == 0) {
			return 'error_invalid_username_email';
		}
		
		$d = $mysql->fetch_array();
		
	//generate password
		$alphabet = array (
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'M', 'N', 'P', 'R', 'S', 'T', 'W', 'X', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '2', '3', '4', '5', '6', '7', '8', '9' 
		);
		
		$code = '';
		for($i = 0; $i < 7; $i ++) {
			$random_number = rand ( 0, count ( $alphabet ) - 1 );
			$code .= $alphabet [$random_number];
		}
		
		$mysql->query("
			UPDATE `users`
			SET `password` = '".md5(md5($code))."'
			WHERE `user_id` = '".intval($d['user_id'])."'
			LIMIT 1
		", __FUNCTION__ );
		
		require_once ENGINE_PATH.'classes/email.class.php';
		$emailClass = new email();

		$emailClass->fromEmail = 'no-reply@'.$config['domain'];
		$emailClass->subject = '['.$config['domain'].'] '.$langArray['email_reset_password'];
		$emailClass->message = langMessageReplace($langArray['email_reset_password_text'], array(
																'DOMAIN' => $config['domain'],
																'USERNAME' => $d['username'],
																'PASSWORD' => $code
														));
		$emailClass->to($d['email']);
		
		$emailClass->send();
		
    return true;
	}

	/*
	 * LOST USERNAME
	 */
	public function lostUsername() {
		global $mysql, $langArray, $config;
		
		$mysql->query("
			SELECT *
			FROM `users`
			WHERE `email` = '".sql_quote($_POST['email'])."'
		", __FUNCTION__ );
		
		if($mysql->num_rows() == 0) {
			return 'error_invalid_user_email';
		}
		
		$d = $mysql->fetch_array();
		
		require_once ENGINE_PATH.'classes/email.class.php';
		$emailClass = new email();

		$emailClass->fromEmail = 'no-reply@'.$config['domain'];
		$emailClass->subject = '['.$config['domain'].'] '.$langArray['email_lost_username'];
		$emailClass->message = langMessageReplace($langArray['email_lost_username_text'], array(
																'DOMAIN' => $config['domain'],
																'USERNAME' => $d['username']
														));
		$emailClass->to($d['email']);
		
		$emailClass->send();
		
    return true;
	}
	
/* 
 * EDIT FUNCTIONS
 */
	public function editNewPassword() {
		global $mysql, $langArray;
		
		if(!isset($_POST['password']) || trim($_POST['password']) == '') {
			$error['password'] = $langArray['error_fill_password'];
		}
		else {
			$mysql->query("
				SELECT *
				FROM `users`
				WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."' AND `password` = '".md5(md5($_POST['password']))."'
			");
			
			if($mysql->num_rows() == 0) {
				$error['password'] = $langArray['error_wrong_old_password'];
			}
		}
		
		if(!isset($_POST['new_password']) || trim($_POST['new_password']) == '') {
			$error['new_password'] = $langArray['error_fill_password'];
		}
		if(!isset($_POST['new_password_confirm']) || trim($_POST['new_password_confirm']) == '') {
			$error['new_password_confirm'] = $langArray['error_fill_password_confirm'];
		}
		elseif(isset($_POST['new_password']) && isset($_POST['new_password_confirm']) && $_POST['new_password'] !== $_POST['new_password_confirm']) {
			$error['new_password_confirm'] = $langArray['error_password_not_match'];
		}
		
		if(isset($error)) {
			return $error;
		}
		
		$mysql->query("
			UPDATE `users`
			SET `password` = '".md5(md5($_POST['new_password']))."'
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."'
			LIMIT 1
		");
		
		return true;
	}	
	
	public function editFeatureItem() {
		global $mysql, $items;
		
		if(!isset($_POST['featured_item_id'])) {
			$_POST['featured_item_id'] = 0;
		}
		
		$_POST['featured_item_id'] = intval($_POST['featured_item_id']);
		
		if($_POST['featured_item_id'] != 0 && !array_key_exists($_POST['featured_item_id'], $items)) {
			$_POST['featured_item_id'] = 0;
		}
		
		$mysql->query("
			UPDATE `users`
			SET `featured_item_id` = '".intval($_POST['featured_item_id'])."'
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."'
			LIMIT 1
		");
		
		$_SESSION['user']['featured_item_id'] = $_POST['featured_item_id'];
		
		return true;
	}
	
	public function editExclusiveAuthor($type='true') {
		global $mysql;
		
		$mysql->query("
			UPDATE `users`
			SET `exclusive_author` = '".sql_quote($type)."'
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."'
			LIMIT 1
		");
		
		$_SESSION['user']['exclusive_author'] = $type;
		
		return true;
	}
	
	public function editSaveLicense() {
		global $mysql, $langArray;
		
		if(!isset($_POST['license']) || !is_array($_POST['license'])) {
			$error['license'] = $langArray['error_choose_license'];
		}
		
		if(isset($error)) {
			return $error;
		}
		
		$mysql->query("
			UPDATE `users`
			SET `license` = '".serialize($_POST['license'])."'
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."'
			LIMIT 1
		");
		
		$_SESSION['user']['license'] = $_POST['license'];
		
		return true;
	}
	
	public function editChangeAvatarImage() {
		global $mysql, $langArray, $config;
		
		$this->photoSizes = $config['avatar_photo_sizes'];
		$avatar = $this->upload('profile_image', $_SESSION['user']['user_id'].'/', false, true);
		if(substr($avatar, 0, 6) == 'error_') {
			$this->avatarError = $langArray[$avatar];
		}
		
		$this->photoSizes = $config['homeimage_photo_sizes'];
		$homeimage = $this->upload('homepage_image', $_SESSION['user']['user_id'].'/', false, true);
		if(substr($homeimage, 0, 6) == 'error_') {
			$this->homeimageError = $langArray[$homeimage];
		}
		
		$setQuery = '';
		if($avatar != '' && substr($avatar, 0, 6) != 'error_') {
			$this->deleteAvatar($_SESSION['user']['user_id']);
			$setQuery .= " `avatar` = '".sql_quote($avatar)."' ";
			$_SESSION['user']['avatar'] = $avatar;
		}
		if($homeimage != '' && substr($homeimage, 0, 6) != 'error_') {
			$this->deleteHomeimage($_SESSION['user']['user_id']);
			if($setQuery != '') {
				$setQuery .= ',';
			}
			$setQuery .= " `homeimage` = '".sql_quote($homeimage)."' ";
			$_SESSION['user']['homeimage'] = $homeimage;
		}
		
		if($setQuery != '') {			
			$mysql->query("
				UPDATE `users`
				SET $setQuery
				WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."'
				LIMIT 1
			");
		}
		
		return true;
	}
	
	public function editPersonalInformation() {
		global $mysql, $langArray;
		
		if(!isset($_POST['firstname']) || trim($_POST['firstname']) == '') {
			$error['firstname'] = $langArray['error_fill_firstname'];
		}		
		if(!isset($_POST['lastname']) || trim($_POST['lastname']) == '') {
			$error['lastname'] = $langArray['error_fill_lastname'];
		}		
		
		if(!isset($_POST['email']) || trim($_POST['email']) == '') {
			$error['email'] = $langArray['error_fill_email'];
		}
		elseif(!check_email($_POST['email'])) {
			$error['email'] = $langArray['error_not_valid_email'];
		}
		elseif($this->isExistEmail($_POST['email'], $_SESSION['user']['email'])) {
			$error['email'] = $langArray['error_exist_email'];
		}
		
		if(isset($error)) {
			return $error;
		}
		
		if(!isset($_POST['firmname'])) {
			$_POST['firmname'] = '';
		}

		if(!isset($_POST['profile_title'])) {
			$_POST['profile_title'] = '';
		}
		
		if(!isset($_POST['profile_desc'])) {
			$_POST['profile_desc'] = '';
		}
		
		if(!isset($_POST['live_city'])) {
			$_POST['live_city'] = '';
		}
		
		if(!isset($_POST['country_id']) || trim($_POST['country_id']) == '') {
			$_POST['country_id'] = '0';
		}
		
		if(!isset($_POST['freelance'])) {
			$_POST['freelance'] = 'false';
		}
		
		$mysql->query("
			UPDATE `users`
			SET `firstname` = '".sql_quote($_POST['firstname'])."',
					`lastname` = '".sql_quote($_POST['lastname'])."',
					`email` = '".sql_quote($_POST['email'])."',
					`firmname` = '".sql_quote($_POST['firmname'])."',
					`profile_title` = '".sql_quote($_POST['profile_title'])."',
					`profile_desc` = '".sql_quote($_POST['profile_desc'])."',
					`live_city` = '".sql_quote($_POST['live_city'])."',
					`country_id` = '".intval($_POST['country_id'])."',
					`freelance` = '".sql_quote($_POST['freelance'])."'
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."'
			LIMIT 1
		");
		
		$_SESSION['user']['firstname'] = $_POST['firstname'];
		$_SESSION['user']['lastname'] = $_POST['lastname'];
		$_SESSION['user']['email'] = $_POST['email'];
		$_SESSION['user']['firmname'] = $_POST['firmname'];
		$_SESSION['user']['profile_title'] = $_POST['profile_title'];
		$_SESSION['user']['profile_desc'] = $_POST['profile_desc'];
		$_SESSION['user']['live_city'] = $_POST['live_city'];
		$_SESSION['user']['country_id'] = $_POST['country_id'];
		$_SESSION['user']['freelance'] = $_POST['freelance'];
		
		return true;
		
	}
	
	

	public function editSocialInformation() {
		global $mysql, $langArray;

		if(isset($error)) {
			return $error;
		}
		
		if(!isset($_POST['behance'])) {
			$_POST['behance'] = '';
		}
		
		if(!isset($_POST['deviantart'])) {
			$_POST['deviantart'] = '';
		}
		
		if(!isset($_POST['digg'])) {
			$_POST['digg'] = '';
		}
		
		if(!isset($_POST['dribbble'])) {
			$_POST['dribbble'] = '';
		}
		
		if(!isset($_POST['facebook'])) {
			$_POST['facebook'] = '';
		}
		
		if(!isset($_POST['flickr'])) {
			$_POST['flickr'] = '';
		}
		
		if(!isset($_POST['forrst'])) {
			$_POST['forrst'] = '';
		}
		
		if(!isset($_POST['github'])) {
			$_POST['github'] = '';
		}
		
		if(!isset($_POST['googleplus'])) {
			$_POST['googleplus'] = '';
		}
		
		if(!isset($_POST['lastfm'])) {
			$_POST['lastfm'] = '';
		}
		
		if(!isset($_POST['linkedin'])) {
			$_POST['linkedin'] = '';
		}
		
		if(!isset($_POST['myspace'])) {
			$_POST['myspace'] = '';
		}
		
		if(!isset($_POST['reddit'])) {
			$_POST['reddit'] = '';
		}
		
		if(!isset($_POST['tumblr'])) {
			$_POST['tumblr'] = '';
		}
		
		if(!isset($_POST['twitter'])) {
			$_POST['twitter'] = '';
		}
		
		if(!isset($_POST['vimeo'])) {
			$_POST['vimeo'] = '';
		}
		
		if(!isset($_POST['youtube'])) {
			$_POST['youtube'] = '';
		}
						
		$mysql->query("
			UPDATE `users`
			SET `behance` = '".sql_quote($_POST['behance'])."',
					`deviantart` = '".sql_quote($_POST['deviantart'])."',
					`digg` = '".sql_quote($_POST['digg'])."',
					`dribbble` = '".sql_quote($_POST['dribbble'])."',
					`facebook` = '".sql_quote($_POST['facebook'])."',
					`flickr` = '".sql_quote($_POST['flickr'])."',
					`forrst` = '".sql_quote($_POST['forrst'])."',
					`github` = '".sql_quote($_POST['github'])."',
					`googleplus` = '".sql_quote($_POST['googleplus'])."',
					`lastfm` = '".sql_quote($_POST['lastfm'])."',
					`linkedin` = '".sql_quote($_POST['linkedin'])."',
					`myspace` = '".sql_quote($_POST['myspace'])."',
					`reddit` = '".sql_quote($_POST['reddit'])."',
					`tumblr` = '".sql_quote($_POST['tumblr'])."',
					`twitter` = '".sql_quote($_POST['twitter'])."',
					`vimeo` = '".sql_quote($_POST['vimeo'])."',
					`youtube` = '".sql_quote($_POST['youtube'])."'
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."'
			LIMIT 1
		");
		
		$_SESSION['user']['behance'] = $_POST['behance'];
		$_SESSION['user']['deviantart'] = $_POST['deviantart'];
		$_SESSION['user']['digg'] = $_POST['digg'];
		$_SESSION['user']['dribbble'] = $_POST['dribbble'];
		$_SESSION['user']['facebook'] = $_POST['facebook'];
		$_SESSION['user']['flickr'] = $_POST['flickr'];
		$_SESSION['user']['forrst'] = $_POST['forrst'];
		$_SESSION['user']['github'] = $_POST['github'];
		$_SESSION['user']['googleplus'] = $_POST['googleplus'];
		$_SESSION['user']['lastfm'] = $_POST['lastfm'];
		$_SESSION['user']['linkedin'] = $_POST['linkedin'];
		$_SESSION['user']['myspace'] = $_POST['myspace'];
		$_SESSION['user']['reddit'] = $_POST['reddit'];
		$_SESSION['user']['tumblr'] = $_POST['tumblr'];
		$_SESSION['user']['twitter'] = $_POST['twitter'];
		$_SESSION['user']['vimeo'] = $_POST['vimeo'];
		$_SESSION['user']['youtube'] = $_POST['youtube'];


		return true;
		
	}

	
	
	public function sendEmail() {
		global $mysql, $langArray, $user, $config;
		
		if(!isset($_POST['message']) || trim($_POST['message']) == '') {
			return $langArray['error_not_set_message'];
		}
		
		$mysql->query("
			INSERT INTO `users_emails` (
				`from_id`,
				`from_email`,
				`to_id`,
				`message`,
				`datetime`
			)
			VALUES (
				'".intval($_SESSION['user']['user_id'])."',
				'".sql_quote($_SESSION['user']['email'])."',
				'".intval($user['user_id'])."',
				'".sql_quote($_POST['message'])."',
				NOW()
			)
		");
		
#SEND EMAIL		
		require_once ENGINE_PATH.'/classes/email.class.php';
		$emailClass = new email();
		
		$emailClass->fromEmail = 'no-reply@'.$config['domain'];
		$emailClass->subject = '['.$config['domain'].'] '.$langArray['email_profile_subject'];
		$emailClass->message = langMessageReplace($langArray['email_profile_text'], array(
																'USERNAME' => $_SESSION['user']['username'],
																'EMAIL' => $_SESSION['user']['email'],
																'MESSAGE' => $_POST['message']
														));
		$emailClass->to($user['email']);

		$emailClass->send();
		
		return true;
	}
	
/* 
 * FOLLOW
 */	
	public function isFollow($id) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `users_followers`
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."' AND `follow_id` = '".intval($id)."'
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return true;
	}
	
	public function addFollow($id) {
		global $mysql;
		
		$mysql->query("
			INSERT INTO `users_followers` (
				`user_id`,
				`follow_id`
			)
			VALUES (
				'".intval($_SESSION['user']['user_id'])."',
				'".intval($id)."'
			)
		");
		
		return true;
	}
	
	public function deleteFollow($id) {
		global $mysql;
		
		$mysql->query("
			DELETE FROM `users_followers`
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."' AND `follow_id` = '".intval($id)."'
			LIMIT 1
		");
		
		return true;
	}
	
	public function followUser($id) {
		if($this->isFollow($id)) {
			$this->deleteFollow($id);
		}
		else {
			$this->addFollow($id);
		}
		
		return true;
	}
	
	public function getFollowers($userID, $start=0, $limit=0, $order='`user_id` ASC', $following=false) {
		global $mysql;
		
		$limitQuery = '';
		if($limit!=0) {
			$limitQuery = " LIMIT $start,$limit ";
		}
		
		if($following) {
			$whereQuery = " `follow_id` = '".intval($userID)."' ";
		}
		else {
			$whereQuery = " `user_id` = '".intval($userID)."' ";
		}
		
		$mysql->query("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM `users_followers`
			WHERE $whereQuery
			ORDER BY $order
			$limitQuery
		");
			
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$whereQuery = '';
		while($d = $mysql->fetch_array()) {
			if($whereQuery != '') {
				$whereQuery .= " OR ";
			}
			
			if($following) {
				$whereQuery .= " `user_id` = '".intval($d['user_id'])."' ";
			}
			else {
				$whereQuery .= " `user_id` = '".intval($d['follow_id'])."' ";
			}
		}
		
		$this->foundRows = $mysql->getFoundRows();
		
		return $this->getAll(0, 0, $whereQuery);
	}
	
	public function getFollowersID($userID, $start=0, $limit=0, $order='`user_id` ASC', $following=false) {
		global $mysql;
		
		$limitQuery = '';
		if($limit!=0) {
			$limitQuery = " LIMIT $start,$limit ";
		}
		
		if($following) {
			$whereQuery = " `follow_id` = '".intval($userID)."' ";
		}
		else {
			$whereQuery = " `user_id` = '".intval($userID)."' ";
		}
		
		$mysql->query("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM `users_followers`
			WHERE $whereQuery
			ORDER BY $order
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
	
	public function updateQuiz($id, $type) {
		global $mysql;
		
		$mysql->query("
			UPDATE `users`
			SET `quiz` = '".sql_quote($type)."'
			WHERE `user_id` = '".intval($id)."'
			LIMIT 1
		");
		
		return true;
	}
	
	
	public function getUsersCount($whereQuery='') {
		global $mysql;
		
		if($whereQuery != '') {
			$whereQuery = " WHERE ".$whereQuery;
		}
		
		$mysql->query("
			SELECT *
			FROM `users`
			$whereQuery
		");
			
		return $mysql->num_rows();
	}
	
	public function getStatistic($id) {
		global $mysql;

		$return = array();
		
#DEPOSIT		
		$mysql->query("
			SELECT SUM(`deposit`) as sum
			FROM `deposit`
			WHERE `user_id` = '".intval($id)."' AND `paid` = 'true'
			GROUP BY `user_id`
		");
		
		if($mysql->num_rows() == 0) {
			$return['deposit'] = 0;
		}
		else {
			$buff = $mysql->fetch_array();
			$return['deposit'] = $buff['sum'];
		}
		
#BUYED ITEMS		
		$mysql->query("
			SELECT o.*, i.`name` AS item_name
			FROM `orders` AS o
			JOIN `items` AS i
			ON i.`id` = o.`item_id`
			WHERE o.`user_id` = '".intval($id)."' AND o.`paid` = 'true'			
		");
		
		if($mysql->num_rows() > 0) {
			$return['total'] = 0;
			while($d = $mysql->fetch_array()) {
				$return['items'][] = $d;
				$return['total'] += $d['price'];
			}						
		}
		
		
		return $return;
	}
	
	public function getTotalReferals($id, $referal_id) {
		global $mysql;
		
		$mysql->query("
			SELECT COUNT(`id`) as sum
			FROM `users_referals_count`
			WHERE `user_id` = '".intval($id)."' AND `referal_id` = '".intval($referal_id)."'
			GROUP BY `referal_id`
			LIMIT 1
		");
		
		$buff = $mysql->fetch_array();
		if($buff) {
			return $buff['sum'];
		}
		
		return 0;
	}
	
}
?>