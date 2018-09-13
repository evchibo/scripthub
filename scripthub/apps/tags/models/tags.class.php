<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

class tags extends base {
	
	function __construct() {
	
	}

	
	/*
	 * GET FUNCTIONS
	 */
	public function getAll($start=0, $limit=0, $where='') {
		global $mysql;
		
		$limitQuery = "";
		if($limit!=0) {
			$limitQuery = "LIMIT $start,$limit";
		}
		
		$whereQuery = '';
		if($where!='') {
			$whereQuery = " WHERE ".$where;
		}
		
		$return = $mysql->getAll("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM `tags`
			$whereQuery
			ORDER BY `name` ASC
			$limitQuery
		");
			
		$this->foundRows = $mysql->getFoundRows();
		
		return $return;
	}
	
	public function get($id) {
		global $mysql;
		
		$return = $mysql->getRow("
			SELECT *
			FROM `tags`
			WHERE `id` = '".intval($id)."'
		");
		
		return $return;
	}
	
	
	/*
	 * ADD
	 */
	public function add() {
		global $mysql, $langArray;

		if(!isset($_POST['name']) || trim($_POST['name']) == '') {
			$error['name'] = $langArray['error_fill_this_field'];
		}
		
		if(isset($error)) {
			return $error;
		}
		
		$mysql->query("
			INSERT INTO `tags` (
				`name`
			)
			VALUES (
				'".sql_quote($_POST['name'])."'
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
				
		$mysql->query("
			UPDATE `tags` 
			SET `name` = '".sql_quote($_POST['name'])."'
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
			DELETE FROM `tags`
			WHERE `id` = '".intval($id)."'
			LIMIT 1
		", __FUNCTION__ );
		
		return true;
	}
	
	public function isExistTag($tag) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `tags`
			WHERE `name` = '".sql_quote($tag)."'
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return $mysql->fetch_array();
	}
	
	public function getTagID($tag) {
		global $mysql;
		
		$row = $this->isExistTag($tag);
		if(is_array($row)) {
			return $row['id'];
		}
		
		$_POST['name'] = $tag;
		$this->add();
		
		return $mysql->insert_id();
	}
	

}
?>