<?
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

class answers extends base {
	
	function __construct() {
		$this->tableName = 'answers';
	}
	
	/*
	 * GET FUNCTIONS
	 */
	public function getAll($start=0, $limit=0, $where='', $byQuiz=false) {
		global $mysql, $language;
		
		$limitQuery = '';
		if($limit!=0) {
			$limitQuery = " LIMIT $start,$limit ";
		}
		
		if($where!='') {
			$where = " WHERE ".$where;
		}
		
		$mysql->query("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM `quiz_answers`
			$where
			ORDER BY `id` ASC
			$limitQuery
		", __FUNCTION__ );
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$return = array();
		while($d = $mysql->fetch_array()) {
			if($byQuiz) {
				$return[$d['quiz_id']][$d['id']] = $d;
			}
			else {
				$return[$d['id']] = $d;
			}
		}
		
		$this->foundRows = $mysql->getFoundRows();
		
		return $return;
	}
	
	public function get($id) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `quiz_answers`
			WHERE `id` = '".intval($id)."'
		", __FUNCTION__ );
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return $mysql->fetch_array();
	}
	
	/*
	 * ADD
	 */
	public function add() {
		global $mysql, $langArray, $config;
		
		if(!isset($_POST['quiz_id']) || !is_numeric($_POST['quiz_id'])) {
			$error['quiz'] = $langArray['error_fill_this_field'];
		}
		
		if(!isset($_POST['name']) || trim($_POST['name']) == '') {
			$error['name'] = $langArray['error_fill_this_field'];
		}
		
		if(isset($error)) {
			return $error;
		}
		
		if(!isset($_POST['right'])) {
			$_POST['right'] = 'false';
		}
		else {
			$mysql->query("
				UPDATE `quiz_answers`
				SET `right` = 'false'
				WHERE `quiz_id` = '".intval($_POST['quiz_id'])."'
			");
		}
		
		$mysql->query("
			INSERT INTO `quiz_answers` (
				`quiz_id`,
				`name`,
				`right`
			)
			VALUES (
				'".intval($_POST['quiz_id'])."',
				'".sql_quote($_POST['name'])."',
				'".sql_quote($_POST['right'])."'
			)
		", __FUNCTION__ );
		
		return true;
	}
	
	/*
	 * EDIT
	 */
	public function edit($id) {
		global $mysql, $langArray;
		
		if(!isset($_POST['name']) || trim($_POST['name']) == '') {
			$error['name'] = $langArray['error_fill_this_field'];
		}

		if(isset($error)) {
			return $error;
		}
		
		if(!isset($_POST['right'])) {
			$_POST['right'] = 'false';
		}
		else {
			$answer = $this->get($id);
			
			$mysql->query("
				UPDATE `quiz_answers`
				SET `right` = 'false'
				WHERE `quiz_id` = '".intval($answer['quiz_id'])."'
			");
		}
				
		$mysql->query("
			UPDATE `quiz_answers`
			SET `name` = '".sql_quote($_POST['name'])."',
					`right` = '".sql_quote($_POST['right'])."'
			WHERE `id` = '".intval($id)."'
		", __FUNCTION__ );
		
		return true;
	}
	
	/*
	 * DELETE
	 */
	public function delete($id) {
		global $mysql;
		
		$mysql->query("
			DELETE FROM `quiz_answers`
			WHERE `id` = '".intval($id)."'
		", __FUNCTION__ );
		
		return true;
	}	
	
}

?>