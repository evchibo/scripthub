<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

class items {
	
	public $uploadFileDirectory = '';
	public $foundRows = 0;
	public $attributesWhere = '';
	public $attributeCategoriesWhere = '';
	public $usersWhere = '';
	
	public function __construct() {
		$this->uploadFileDirectory = 'items/';
	}
	
	public function getAll($start=0, $limit=0, $where='', $order='`datetime` ASC') {
		global $mysql;
		
		$limitQuery = '';
		if($limit!=0) {
			$limitQuery = " LIMIT $start,$limit ";
		}
		
		if($where!='') {
			$where = " WHERE ".$where;
		}
		
		$mysql->query("
			SELECT SQL_CALC_FOUND_ROWS *,
			(SELECT GROUP_CONCAT(`categories` SEPARATOR '|') FROM `items_to_category` WHERE `item_id` = `items`.`id`) AS `categories`
			FROM `items`
			$where
			ORDER BY $order
			$limitQuery
		");
			
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$this->usersWhere = '';
		$return = array();
		while($d = $mysql->fetch_array()) {
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
		
		$this->foundRows = $mysql->getFoundRows();
		
		return $return;
		
	}
	
	public function getAllForUpdate($start=0, $limit=0, $where='', $order='`datetime` ASC') {
		global $mysql;
		
		$limitQuery = '';
		if($limit!=0) {
			$limitQuery = " LIMIT $start,$limit ";
		}
		
		if($where!='') {
			$where = " WHERE ".$where;
		}
		
		$mysql->query("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM `temp_items`
			$where
			ORDER BY $order
			$limitQuery
		");
			
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$whereQuery = '';
		$return = array();
		while($d = $mysql->fetch_array()) {
			$return[$d['id']] = $d;
		}
		
		$this->foundRows = $mysql->getFoundRows();
		
		return $return;
		
	}
	
	public function get($id, $active = false) {
		global $mysql, $meta;
		
		$percents = 0;
		if(isset($meta['prepaid_price_discount'])) {
			$percents = $meta['prepaid_price_discount'];
		}
		
		$extended_price = 1;
		if(isset($meta['extended_price'])) {
			$extended_price = (int)$meta['extended_price'];
		}
		
		$sql = "
			SELECT *
			FROM `items`
			WHERE `id` = '".intval($id)."'
		";
		
		if($active) {
			$sql .= " AND `status` = 'active'";
		}
		
		$mysql->query($sql);
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$return = $mysql->fetch_array();
		if(strpos($percents, '%') !== false) {
			$return['prepaid_price'] = $return['price'] - ( ( $return['price'] / 100 ) * (int)$percents );
			$return['your_profit'] = (int)( ( $return['price'] / 100 ) * (int)$percents );
		} else {
			$return['prepaid_price'] = $return['price'] - (int)$percents;
			$return['your_profit'] = (int)$percents;
		}
		$return['extended_price'] = $return['price']*$extended_price;
		
		$mysql->query("
					SELECT 
						* 
					FROM 
						`items_to_category` 
					WHERE 
						`item_id` = '".intval($id)."'
				");
		
		$return['categories'] = array();
		if($mysql->num_rows() > 0) {
			$row=0;
			while($ca = $mysql->fetch_array()) {
				$categories = explode(',', $ca['categories']);
				foreach($categories as $c) {
					$c = trim($c);
					if($c != '') {
						$return['categories'][$row][$c] = $c;
					}
				}
				$row++;
			}
		}
		
#LOAD TAGS
		$mysql->query("
			SELECT *
			FROM `items_tags` AS it
			JOIN `tags` AS t
			ON t.`id` = it.`tag_id`
			WHERE it.`item_id` = '".intval($id)."'			
		");	
		
		if($mysql->num_rows() > 0) {
			while($d = $mysql->fetch_array()) {
				$return['tags'][$d['type']][$d['tag_id']] = $d['name'];
			}
		}
		
#LOAD ATTRIBUTES
		$mysql->query("
			SELECT *
			FROM `items_attributes`
			WHERE `item_id` = '".intval($id)."'			
		");		
				
		if($mysql->num_rows() > 0) {
			while($d = $mysql->fetch_array()) {
				if(isset($return['attributes'][$d['category_id']])) {
					if(!is_array($return['attributes'][$d['category_id']])) {
						$val = $return['attributes'][$d['category_id']];
						unset($return['attributes'][$d['category_id']]);
						$return['attributes'][$d['category_id']][$val] = $val;
					}
					$return['attributes'][$d['category_id']][$d['attribute_id']] = $d['attribute_id'];

					if($this->attributesWhere != '') {
						$this->attributesWhere .= " OR ";
					}
					$this->attributesWhere .= " `id` = '".intval($d['attribute_id'])."' ";
				}
				else {
					$return['attributes'][$d['category_id']] = $d['attribute_id'];
					
					if($this->attributeCategoriesWhere != '') {
						$this->attributeCategoriesWhere .= " OR ";
					}
					$this->attributeCategoriesWhere .= " `id` = '".intval($d['category_id'])."' ";

					if($this->attributesWhere != '') {
						$this->attributesWhere .= " OR ";
					}
					$this->attributesWhere .= " `id` = '".intval($d['attribute_id'])."' ";
				}
			}
		}
		
		return $return;
	}
	
	public function getForUpdate($id) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `temp_items`
			WHERE `id` = '".intval($id)."'
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$return = $mysql->fetch_array();
		
#LOAD TAGS
		$mysql->query("
			SELECT *
			FROM `temp_items_tags` AS it
			JOIN `tags` AS t
			ON t.`id` = it.`tag_id`
			WHERE it.`item_id` = '".intval($return['item_id'])."'			
		");	
		
		if($mysql->num_rows() > 0) {
			while($d = $mysql->fetch_array()) {
				$return['tags'][$d['type']][$d['tag_id']] = $d['name'];
			}
		}
		
		return $return;
	}
	
	/*
	 * ADD
	 */
	public function add() {
		global $mysql, $langArray, $attributes;
		
		if(!isset($_POST['name']) || trim($_POST['name']) == '') {
			$error['name'] = $langArray['error_not_set_name'];
		}

		if(!isset($_POST['description']) || trim($_POST['description']) == '') {
			$error['description'] = $langArray['error_not_set_description'];
		}
		
		if(!isset($_POST['thumbnail']) || trim($_POST['thumbnail']) == '') {
			$error['thumbnail'] = $langArray['error_not_set_thumbnail'];
		}
		else {
			$file = pathinfo($_POST['thumbnail']);
			if(strtolower($file['extension']) != 'jpg' && strtolower($file['extension']) != 'png') {
				$error['thumbnail'] = $langArray['error_thumbnail_jpg'];
			}
			elseif(!file_exists(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['thumbnail'])) {
				$error['thumbnail'] = $langArray['error_thumbnail_jpg'];
			}
		}
		
		if(!isset($_POST['theme_preview']) || trim($_POST['theme_preview']) == '') {
			$error['theme_preview'] = $langArray['error_not_set_theme_preview'];
		}
		else {
			$file = pathinfo($_POST['theme_preview']);
			if(strtolower($file['extension']) != 'zip') {
				$error['theme_preview'] = $langArray['error_theme_preview_zip'];
			}
			elseif(!file_exists(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['theme_preview'])) {
				$error['theme_preview'] = $langArray['error_theme_preview_zip'];
			} else {
				$zip = new ZipArchive;
				$res = $zip->open(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['theme_preview']);
				if($res === TRUE) {
					$images_count=0;
					for($i = 0; $i < $zip->numFiles; $i++) { 
					    if(strtolower(strrchr($zip->getNameIndex($i),".")) == '.jpg' ||
					      strtolower(strrchr($zip->getNameIndex($i),".")) == '.jpeg' || 
					      strtolower(strrchr($zip->getNameIndex($i),".")) == '.png') {
					      $images_count++;
					    }
					}
					$zip->close();
					if($images_count < 1) {
						$error['theme_preview'] = $langArray['error_theme_preview_zip_images'];
					}
				} else {
					$error['theme_preview'] = $langArray['error_theme_preview_zip'];
				}
			}
		}
		
		if(!isset($_POST['main_file']) || trim($_POST['main_file']) == '') {
			$error['main_file'] = $langArray['error_not_set_main_file'];
		}
		else {
			$file = pathinfo($_POST['main_file']);
			if(strtolower($file['extension']) != 'zip') {
				$error['main_file'] = $langArray['error_main_file_zip'];
			}
			elseif(!file_exists(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['main_file'])) {
				$error['main_file'] = $langArray['error_main_file_zip'];
			}			
		}

		if(!isset($_POST['category'])) {
			$error['category'] = $langArray['error_not_set_category'];
		} elseif(!is_array($_POST['category'])) {
			$error['category'] = $langArray['error_not_set_category'];
		} elseif(!count($_POST['category'])) {
			$error['category'] = $langArray['error_not_set_category'];
		}
		
		if(is_array($attributes)) {
			$attributesError = false;
			foreach($attributes as $a) {				
				if(!isset($_POST['attributes'][$a['id']])) {
					$attributesError = true;
					break;
				}				
			}
			
			if($attributesError) {
				$error['attributes'] = $langArray['error_set_all_attributes'];
			}
		}
		
		if(!isset($_POST['tags']['usage']) || trim($_POST['tags']['usage']) == '') {
			$error['tags_usage'] = $langArray['error_not_set_tags'];
		}
		
		if(!isset($_POST['tags']['style']) || trim($_POST['tags']['style']) == '') {
			$error['tags_style'] = $langArray['error_not_set_tags'];
		}
		
		if(!isset($_POST['tags']['features']) || trim($_POST['tags']['features']) == '') {
			$error['tags_features'] = $langArray['error_not_set_tags'];
		}
		
		if(!isset($_POST['source_license'])) {
			$error['source_license'] = $langArray['error_not_set_source_license'];
		}
		
		if(isset($_POST['demo_url']) && trim($_POST['demo_url']) && filter_var($_POST['demo_url'], FILTER_VALIDATE_URL) === false) {
			$error['demo_url'] = $langArray['error_demo_url'];
		}
	
		if($_POST['suggested_price'] && !preg_match('#^\d+(?:\.\d{1,})?$#', $_POST['suggested_price'])) {
			$error['suggested_price'] = $langArray['error_suggested_price'];
		}
		
		if(isset($error)) {
			return $error;
		}
		
		if(!isset($_POST['demo_url'])) {
			$_POST['demo_url'] = '';
		}
		
		if(!isset($_POST['comments_to_reviewer'])) {
			$_POST['comments_to_reviewer'] = '';
		}
		
		if(!isset($_POST['free_request'])) {
			$_POST['free_request'] = 'false';
		}
		
		require_once ROOT_PATH.'/scripthub/apps/categories/models/categories.class.php';
		$categoriesClass = new categories();			
		
		$mysql->query("
			INSERT INTO `items` (
				`user_id`,
				`name`,
				`description`,
				`thumbnail`,
				`theme_preview`,
				`main_file`,
				`main_file_name`,
				`demo_url`,
				`reviewer_comment`,
				`datetime`,
				`status`,
				`suggested_price`,
				`free_request`
			)
			VALUES (
				'".intval($_SESSION['user']['user_id'])."',
				'".sql_quote($_POST['name'])."',
				'".sql_quote($_POST['description'])."',
				'".sql_quote($_POST['thumbnail'])."',
				'".sql_quote($_POST['theme_preview'])."',
				'".sql_quote($_POST['main_file'])."',
				'".sql_quote($_SESSION['temp']['uploaded_files'][$_POST['main_file']]['name'])."',
				'".sql_quote($_POST['demo_url'])."',
				'".sql_quote($_POST['comments_to_reviewer'])."',
				NOW(),
				'queue',
				'".(float)$_POST['suggested_price']."',
				'".sql_quote($_POST['free_request'])."'
			)
		");
		
		$itemID = $mysql->insert_id();
		
		$allCategories = $categoriesClass->getAll();
		if(is_array($_POST['category'])) {
			foreach($_POST['category'] AS $category_id) {
				$categories = $categoriesClass->getCategoryParents($allCategories, $category_id);
				$categories = explode(',', $categories);
				array_pop($categories);
				$categories = array_reverse($categories);
				$categories = ','.implode(',', $categories).',';
				$mysql->query("
					INSERT INTO `items_to_category` (
						`item_id`,
						`categories`
					) 
					VALUES (
						'".sql_quote($itemID)."',
						'".sql_quote($categories)."'
					)
				");
			}
		} else {
			$categories = $categoriesClass->getCategoryParents($allCategories, $_POST['category']);
			$categories = explode(',', $categories);
			array_pop($categories);
			$categories = array_reverse($categories);
			$categories = ','.implode(',', $categories).',';
			$mysql->query("
				INSERT INTO `items_to_category` (
					`item_id`,
					`categories`
				) 
				VALUES (
					'".sql_quote($itemID)."',
					'".sql_quote($categories)."'
				)
			");
		}
		
		
#COPY FILES FROM TEMPORARY FOLDER
		recursive_mkdir(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/');
		
		copy(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['thumbnail'], DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/'.$_POST['thumbnail']);
		copy(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['theme_preview'], DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/'.$_POST['theme_preview']);
		copy(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['main_file'], DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/'.$_POST['main_file']);
		
		$zip = new ZipArchive;
		$res = $zip->open(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/'.$_POST['theme_preview']);
		if($res === TRUE) {
			$zip->extractTo(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/preview/');
			$zip->close();
		}
		
#RESIZE THUMBNAIL AND CREATE PREVIEW IMAGE		
		require_once ENGINE_PATH.'/classes/image.class.php';
		$imageClass = new Image();
		
		$imageClass->crop(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/'.$_POST['thumbnail'], 80, 80);
		
		$files = scandir(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/preview/');
		$previewFile = '';
		if(is_array($files)) {
			foreach($files as $f) {
				if(file_exists(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/preview/'.$f)) {
					$fileInfo = pathinfo(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/preview/'.$f);
					if(isset($fileInfo['extension']) && ( strtolower($fileInfo['extension']) == 'jpg' || strtolower($fileInfo['extension']) == 'png' ) ) {
						$previewFile = $f;
						break;
					}
				}
			}
		}

		if($previewFile != '') {
			$imageClass->forceType(2);
			$imageClass->crop(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/preview/'.$previewFile, 590, 300, DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$itemID.'/preview.jpg');			
		}
		
#DELETE TEMPORARY FILES
		if(is_array($_SESSION['temp']['uploaded_files'])) {
			foreach($_SESSION['temp']['uploaded_files'] as $f) {
				@unlink(DATA_SERVER_PATH.'/uploads/temporary/'.$f['filename']);
			}
		}		
		unset($_SESSION['temp']['uploaded_files']);
		
#INSERT TAGS
		require_once ROOT_PATH.'/scripthub/apps/tags/models/tags.class.php';
		$tagsClass = new tags();
				
		foreach($_POST['tags'] as $type=>$tags) {
			$arr = explode(',', $tags);
			foreach($arr as $tag) {
				$tag = trim($tag);
				if($tag != '') {
					$tagID = $tagsClass->getTagID($tag);
					
					$mysql->query("
						INSERT INTO `items_tags` (
							`item_id`,
							`tag_id`,
							`type`
						)
						VALUES (
							'".intval($itemID)."',
							'".intval($tagID)."',
							'".sql_quote($type)."'
						)
					");
				}
			}
		}		
		
#INSERT ATTRIBUTES
		$_POST['attributes'] = (array)(isset($_POST['attributes']) ? $_POST['attributes'] : array());
		foreach($_POST['attributes'] as $cID=>$a) {
			if(is_array($a)) {
				foreach($a as $ai) {
					$mysql->query("
						INSERT INTO `items_attributes` (
							`item_id`,
							`attribute_id`,
							`category_id`
						)
						VALUES (
							'".intval($itemID)."',
							'".sql_quote($ai)."',
							'".sql_quote($cID)."'
						)
					");
				}
			}
			else {
				$mysql->query("
					INSERT INTO `items_attributes` (
						`item_id`,
						`attribute_id`,
						`category_id`
					)
					VALUES (
						'".intval($itemID)."',
						'".sql_quote($a)."',
						'".sql_quote($cID)."'
					)
				");
			}
		}
				
		return true;
		
	}
	
	public function edit_upload($id) {
		global $mysql, $langArray, $item;
		
		if(isset($_POST['thumbnail']) && trim($_POST['thumbnail']) != '') {
			$file = pathinfo($_POST['thumbnail']);
			if(strtolower($file['extension']) != 'jpg' && strtolower($file['extension']) != 'png') {
				$error['thumbnail'] = $langArray['error_thumbnail_jpg'];
			}
			elseif(!file_exists(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['thumbnail'])) {
				$error['thumbnail'] = $langArray['error_thumbnail_jpg'];
			}
		}
		
		if(isset($_POST['theme_preview']) && trim($_POST['theme_preview']) != '') {
			$file = pathinfo($_POST['theme_preview']);
			if(strtolower($file['extension']) != 'zip') {
				$error['theme_preview'] = $langArray['error_theme_preview_zip'];
			}
			elseif(!file_exists(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['theme_preview'])) {
				$error['theme_preview'] = $langArray['error_theme_preview_zip'];
			} else {
				$zip = new ZipArchive;
				$res = $zip->open(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['theme_preview']);
				if($res === TRUE) {
					$images_count=0;
					for($i = 0; $i < $zip->numFiles; $i++) { 
					    if(strtolower(strrchr($zip->getNameIndex($i),".")) == '.jpg' ||
					      strtolower(strrchr($zip->getNameIndex($i),".")) == '.jpeg' || 
					      strtolower(strrchr($zip->getNameIndex($i),".")) == '.png') {
					      $images_count++;
					    }
					}
					$zip->close();
					if($images_count < 1) {
						$error['theme_preview'] = $langArray['error_theme_preview_zip_images'];
					}
				} else {
					$error['theme_preview'] = $langArray['error_theme_preview_zip'];
				}
			}
		}
		
		if(isset($_POST['main_file']) && trim($_POST['main_file']) != '') {
			$file = pathinfo($_POST['main_file']);
			if(strtolower($file['extension']) != 'zip') {
				$error['main_file'] = $langArray['error_main_file_zip'];
			}
			elseif(!file_exists(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['main_file'])) {
				$error['main_file'] = $langArray['error_main_file_zip'];
			}			
		}
		
		if(!isset($_POST['tags']['features']) || trim($_POST['tags']['features']) == '') {
			$error['tags_features'] = $langArray['error_not_set_tags'];
		}
		
		if(isset($error)) {
			return $error;
		}
		
		if(!isset($_POST['comments_to_reviewer'])) {
			$_POST['comments_to_reviewer'] = '';
		}
		
#COPY FILES FROM TEMPORARY FOLDER
		recursive_mkdir(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$id.'/temp/');
		
		$colQuery = '';
		$valQuery = '';
		
		if(isset($_POST['thumbnail']) && trim($_POST['thumbnail']) != '') {
			copy(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['thumbnail'], DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$id.'/temp/'.$_POST['thumbnail']);
			$colQuery .= " `thumbnail`, ";
			$valQuery .= " '".sql_quote($_POST['thumbnail'])."', ";
		}
		if(isset($_POST['theme_preview']) && trim($_POST['theme_preview']) != '') {
			copy(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['theme_preview'], DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$id.'/temp/'.$_POST['theme_preview']);
			$colQuery .= " `theme_preview`, ";
			$valQuery .= " '".sql_quote($_POST['theme_preview'])."', ";
		}
		if(isset($_POST['main_file']) && trim($_POST['main_file']) != '') {
			copy(DATA_SERVER_PATH.'/uploads/temporary/'.$_POST['main_file'], DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$id.'/temp/'.$_POST['main_file']);
			$colQuery .= " `main_file`, `main_file_name`, ";
			$valQuery .= " '".sql_quote($_POST['main_file'])."', '".sql_quote($_SESSION['temp']['uploaded_files'][$_POST['main_file']]['name'])."', ";
		}
		
		$mysql->query("
			INSERT INTO `temp_items` (
				`item_id`,
				`name`,
				$colQuery
				`reviewer_comment`,
				`datetime`
			)
			VALUES (
				'".intval($id)."',
				'".sql_quote($item['name'])."',
				$valQuery
				'".sql_quote($_POST['comments_to_reviewer'])."',
				NOW()
			)
		");
				
#DELETE TEMPORARY FILES
		if(isset($_SESSION['temp']['uploaded_files']) && is_array($_SESSION['temp']['uploaded_files'])) {
			foreach($_SESSION['temp']['uploaded_files'] as $f) {
				@unlink(DATA_SERVER_PATH.'/uploads/temporary/'.$f['filename']);
			}
		}		
		unset($_SESSION['temp']['uploaded_files']);
		
#INSERT TAGS
		require_once ROOT_PATH.'/scripthub/apps/tags/models/tags.class.php';
		$tagsClass = new tags();
				
		foreach($_POST['tags'] as $type=>$tags) {
			$arr = explode(',', $tags);
			foreach($arr as $tag) {
				$tag = trim($tag);
				if($tag != '') {
					$tagID = $tagsClass->getTagID($tag);
					
					$mysql->query("
						INSERT INTO `temp_items_tags` (
							`item_id`,
							`tag_id`,
							`type`
						)
						VALUES (
							'".intval($id)."',
							'".intval($tagID)."',
							'".sql_quote($type)."'
						)
					");
				}
			}
		}		
		
		return true;
	}
	
	public function edit($id, $fromAdmin=false) {
		global $mysql, $langArray, $attributes;
		
		if(!isset($_POST['description']) || trim($_POST['description']) == '') {
			$error['description'] = $langArray['error_not_set_description'];
		}
		
		if($fromAdmin && (!isset($_POST['price']) || trim($_POST['price']) == '' || $_POST['price'] == '0')) {
			$error['price'] = $langArray['error_not_set_price'];
		}
		
		if(isset($_POST['demo_url']) && trim($_POST['demo_url']) && filter_var($_POST['demo_url'], FILTER_VALIDATE_URL) === false) {
			$error['demo_url'] = $langArray['error_demo_url'];
		}
		
		if(!isset($_POST['category'])) {
			$error['category'] = $langArray['error_not_set_category'];
		} elseif ( !is_numeric($_POST['category']) && !is_array($_POST['category']) ) {
			$error['category'] = $langArray['error_not_set_category'];
		} 
		
		if(is_array($attributes)) {
			$attributesError = false;
			foreach($attributes as $a) {				
				if(!isset($_POST['attributes'][$a['id']])) {
					$attributesError = true;
					break;
				}				
			}
			
			if($attributesError) {
				$error['attributes'] = $langArray['error_set_all_attributes'];
			}
		}
		
		if(isset($error)) {
			return $error;
		} 
		
		$setQuery = '';		
		if($fromAdmin) {
			$setQuery .= " `price` = '".sql_quote($_POST['price'])."', ";

			if(isset($_POST['free_file'])) {
				$mysql->query("
					UPDATE `items`
					SET `free_file` = 'false'					
				");
				$setQuery .= " `free_file` = 'true', ";
			}
			
			if(isset($_POST['weekly_to']) && trim($_POST['weekly_to']) != '') {
				$setQuery .= " `weekly_to` = '".sql_quote($_POST['weekly_to'])."', ";
			}
		}		
		
		if(!isset($_POST['demo_url'])) {
			$_POST['demo_url'] = '';
		}
		
		if(!isset($_POST['free_request'])) {
			$_POST['free_request'] = 'false';
		}
		
		$mysql->query("
			UPDATE `items`
			SET `description` = '".sql_quote($_POST['description'])."',
					`free_request` = '".sql_quote($_POST['free_request'])."',
					$setQuery
					`demo_url` = '".sql_quote($_POST['demo_url'])."'
			WHERE `id` = '".intval($id)."'
			LIMIT 1
		");
					
		require_once ROOT_PATH.'/scripthub/apps/categories/models/categories.class.php';
		$categoriesClass = new categories();				
		$allCategories = $categoriesClass->getAll();
		$mysql->query("DELETE FROM `items_to_category` WHERE `item_id` = '".intval($id)."'");
		if(is_array($_POST['category'])) {
			foreach($_POST['category'] AS $category_id) {
				$categories = $categoriesClass->getCategoryParents($allCategories, $category_id);
				$categories = explode(',', $categories);
				array_pop($categories);
				$categories = array_reverse($categories);
				$categories = ','.implode(',', $categories).',';
				$mysql->query("
					INSERT INTO `items_to_category` (
						`item_id`,
						`categories`
					) 
					VALUES (
						'".intval($id)."',
						'".sql_quote($categories)."'
					)
				");
			}
		} else {
			$categories = $categoriesClass->getCategoryParents($allCategories, $_POST['category']);
			$categories = explode(',', $categories);
			array_pop($categories);
			$categories = array_reverse($categories);
			$categories = ','.implode(',', $categories).',';
			$mysql->query("
				INSERT INTO `items_to_category` (
					`item_id`,
					`categories`
				) 
				VALUES (
					'".intval($id)."',
					'".sql_quote($categories)."'
				)
			");
		}
		
#RENEW ATTRIBUTES
		$mysql->query("
			DELETE FROM `items_attributes`
			WHERE `item_id` = '".intval($id)."'
		");		
		$_POST['attributes'] = (array)(isset($_POST['attributes']) ? $_POST['attributes'] : array());
		foreach($_POST['attributes'] as $cID=>$a) {
			if(is_array($a)) {
				foreach($a as $ai) {
					if(!trim($ai)) { continue; }
					$mysql->query("
						INSERT INTO `items_attributes` (
							`item_id`,
							`attribute_id`,
							`category_id`
						)
						VALUES (
							'".intval($id)."',
							'".sql_quote($ai)."',
							'".sql_quote($cID)."'
						)
					");
				}
			}
			else {
				if(!trim($a)) { continue; }
				$mysql->query("
					INSERT INTO `items_attributes` (
						`item_id`,
						`attribute_id`,
						`category_id`
					)
					VALUES (
						'".intval($id)."',
						'".sql_quote($a)."',
						'".sql_quote($cID)."'
					)
				");
			}
		}
		
		if($fromAdmin) {
			if(isset($_POST['free_file'])) {
				$this->addUserStatus($id, 'freefile');
				$mysql->query("
					UPDATE `items`
					SET `free_file` = 'true'
					WHERE `id` = '".intval($id)."'
					LIMIT 1
				");
			} else {
				$mysql->query("
					UPDATE `items`
					SET `free_file` = 'false'
					WHERE `id` = '".intval($id)."'
					LIMIT 1
				");
			}
			if(isset($_POST['weekly_to']) && trim($_POST['weekly_to']) != '') {
				$this->addUserStatus($id, 'featured');
			}
		}

		return true;
	}
	
	public function delete($id, $unapprove=false) {
		global $mysql;
	
		recursive_rmdir(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$id.'/', true);
		
		$data = $this->get($id);
		
		#DELETE ITEM
		$mysql->query("
			DELETE FROM `items`
			WHERE `id` = '".intval($id)."'
		");
		
		$mysql->query("
			DELETE FROM `items_attributes`
			WHERE `item_id` = '".intval($id)."'
		");
		
		$mysql->query("
			DELETE FROM `items_collections`
			WHERE `item_id` = '".intval($id)."'
		");
		
		$mysql->query("
			DELETE FROM `items_comments`
			WHERE `item_id` = '".intval($id)."'
		");
		
		$mysql->query("
			DELETE FROM `items_faqs`
			WHERE `item_id` = '".intval($id)."'
		");
		
		$mysql->query("
			DELETE FROM `items_rates`
			WHERE `item_id` = '".intval($id)."'
		");
		
		$mysql->query("
			DELETE FROM `items_tags`
			WHERE `item_id` = '".intval($id)."'
		");
		
		$mysql->query("
			DELETE FROM `temp_items`
			WHERE `item_id` = '".intval($id)."'
		");
		
		$mysql->query("
			DELETE FROM `temp_items_tags`
			WHERE `item_id` = '".intval($id)."'
		");
		
		$mysql->query("
			DELETE FROM `items_to_category`
			WHERE `item_id` = '".intval($id)."'
		");
		
		if(!$unapprove) {
			$mysql->query("
				UPDATE `users`
				SET `items` = `items` - 1
				WHERE `user_id` = '".intval($data['user_id'])."'
				LIMIT 1
			");									
		}
		
		return true;		
	}
	
	public function deleteUpdate($id) {
		global $mysql;
		
		recursive_rmdir(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$id.'/temp/', true);
		
#DELETE TEMP ITEM TAGS
		$mysql->query("
			DELETE FROM `temp_items_tags`
			WHERE `item_id` = '".intval($id)."'
		");

#DELETE TEMP ITEM
		$mysql->query("
			DELETE FROM `temp_items`
			WHERE `item_id` = '".intval($id)."'
		");
		
		return true;		
	}
	
/*
 * ADMIN FUNCTIONS
 */	
	public function approve($id) {
		global $mysql, $data, $langArray;
		
		if($data['status'] == 'active') {
			return true;
		}
				
		if(!isset($_POST['price']) || trim($_POST['price']) == '' || $_POST['price'] == '0') {
			return $langArray['error_set_price'];
		}
		
		$_POST['price'] = str_replace(',', '.', $_POST['price']);
		$setQuery = '';
		if(isset($_POST['free_file'])) {
			$mysql->query("
				UPDATE `items`
				SET `free_file` = 'false'					
			");
			$setQuery .= " `free_file` = 'true', ";
		}
		
		if(isset($_POST['weekly_to']) && trim($_POST['weekly_to']) != '') {
			$setQuery .= " `weekly_to` = '".sql_quote($_POST['weekly_to'])."', ";
		}
		
		$mysql->query("
			UPDATE `items`
			SET `price` = '".sql_quote($_POST['price'])."',
					$setQuery
					`status` = 'active'
			WHERE `id` = '".intval($id)."'
			LIMIT 1
		");
		
		$mysql->query("
			UPDATE `users`
			SET `items` = `items` + 1
			WHERE `user_id` = '".intval($data['user_id'])."'
			LIMIT 1
		");
		
		return true;
	}
	
	public function unapprove($id) {
		global $mysql, $data, $langArray, $config;
		
		if($data['status'] == 'active') {
			return true;
		}
				
		if(!isset($_POST['comment_to_user']) || trim($_POST['comment_to_user']) == '') {
			return $langArray['error_set_comment_to_user'];
		}
		
		$mysql->query("
			UPDATE `items`
			SET `status` = 'unapproved'
			WHERE `id` = '".intval($id)."'
			LIMIT 1
		");
		
		$mysql->query("
			UPDATE `users`
			SET `items` = `items` + 1
			WHERE `user_id` = '".intval($data['user_id'])."'
			LIMIT 1
		");
				
#SEND EMAIL TO USER
		require_once ENGINE_PATH.'/classes/email.class.php';
		$emailClass = new email();
		
		$emailClass->fromEmail = 'no-reply@'.$config['domain'];
		$emailClass->subject = '['.$config['domain'].'] '.$langArray['email_unapprove_item_subject'];
		$emailClass->message = langMessageReplace($langArray['email_unapprove_item_text'], array(
																'THEMENAME' => $data['name'],
																'COMMENT' => $_POST['comment_to_user']
														));
		$emailClass->to($data['user']['email']);
		$emailClass->send();
				
		return true;
	}
	
	public function unapproveDelete($id) {
		global $mysql, $data, $langArray, $config;
		
		if($data['status'] == 'active') {
			return true;
		}
				
		if(!isset($_POST['comment_to_user']) || trim($_POST['comment_to_user']) == '') {
			return $langArray['error_set_comment_to_user'];
		}
		
		$this->delete($id, true);
		
#SEND EMAIL TO USER
		require_once ENGINE_PATH.'/classes/email.class.php';
		$emailClass = new email();
		
		$emailClass->fromEmail = 'no-reply@'.$config['domain'];
		$emailClass->subject = '['.$config['domain'].'] '.$langArray['email_unapprove_delete_item_subject'];
		$emailClass->message = langMessageReplace($langArray['email_unapprove_delete_item_text'], array(
																'THEMENAME' => $data['name'],
																'COMMENT' => $_POST['comment_to_user']
														));
		$emailClass->to($data['user']['email']);
		$emailClass->send();
				
		return true;
	}
	
	
	public function approveUpdate($id) {
		global $mysql, $data, $item, $langArray;

		$setQuery = '';
		
		if(isset($_POST['price']) && is_numeric($_POST['price']) && $_POST['price'] != '0') {
			$_POST['price'] = str_replace(',', '.', $_POST['price']);
			$setQuery .= " `price` = '".sql_quote($_POST['price'])."', ";
		}
				
#LOAD IMAGE CLASS	
		require_once ENGINE_PATH.'/classes/image.class.php';
		$imageClass = new Image();
		
		if($data['thumbnail'] != '') {
			$setQuery .= " `thumbnail` = '".sql_quote($data['thumbnail'])."', ";
			
			@unlink(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/'.$item['thumbnail']);
			
			copy(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/temp/'.$data['thumbnail'], DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/'.$data['thumbnail']);
			$imageClass->crop(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/'.$data['thumbnail'], 80, 80);
		}
		
		if($data['theme_preview'] != '') {
			$setQuery .= " `theme_preview` = '".sql_quote($data['theme_preview'])."', ";
			
			@unlink(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/'.$item['theme_preview']);
			recursive_rmdir(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/preview/', true);
			
			copy(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/temp/'.$data['theme_preview'], DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/'.$data['theme_preview']);
			
			$zip = new ZipArchive;
			$res = $zip->open(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/'.$data['theme_preview']);
			if($res === TRUE) {
				$zip->extractTo(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/preview/');
				$zip->close();
			}
			
			$files = scandir(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/preview/');
			$previewFile = '';
			if(is_array($files)) {
				foreach($files as $f) {
					if(file_exists(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/preview/'.$f)) {
						$fileInfo = pathinfo(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/preview/'.$f);
						if(strtolower($fileInfo['extension']) == 'jpg' || strtolower($fileInfo['extension']) == 'png') {
							$previewFile = $f;
							break;
						}
					}
				}
			}
			
			if($previewFile != '') {
				$imageClass->forceType(2);
				$imageClass->crop(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/preview/'.$previewFile, 590, 300, DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/preview.jpg');			
			}
		}
		
		if($data['main_file'] != '') {
			$setQuery .= "
				`main_file` = '".sql_quote($data['main_file'])."',
				`main_file_name` = '".sql_quote($data['main_file_name'])."',
			";
			
			@unlink(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/'.$item['main_file']);
			
			copy(DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/temp/'.$data['main_file'], DATA_SERVER_PATH.'/uploads/'.$this->uploadFileDirectory.$item['id'].'/'.$data['main_file']);
		}
		
		$mysql->query("
			UPDATE `items`
			SET $setQuery
					`status` = 'active'
			WHERE `id` = '".intval($item['id'])."'
			LIMIT 1
		");
		
#INSERT TAGS
		
		$mysql->query("
			DELETE FROM `items_tags`
			WHERE `item_id` = '".intval($item['id'])."' AND `type` = 'features'
		");
		
		require_once ROOT_PATH.'/scripthub/apps/tags/models/tags.class.php';
		$tagsClass = new tags();
				
		foreach($data['tags'] as $type=>$tags) {
			foreach($tags as $tagID=>$tag) {
				$mysql->query("
					INSERT INTO `items_tags` (
						`item_id`,
						`tag_id`,
						`type`
					)
					VALUES (
						'".intval($item['id'])."',
						'".intval($tagID)."',
						'".sql_quote($type)."'
					)
				");
			}
		}

		$this->deleteUpdate($item['id']);
		
		return true;
	}
	
	public function unapproveDeleteUpdate($id) {
		global $mysql, $item, $data, $langArray, $config;
		
		if(!isset($_POST['comment_to_user']) || trim($_POST['comment_to_user']) == '') {
			return $langArray['error_set_comment_to_user'];
		}
		
		$this->deleteUpdate($item['id']);
		
#SEND EMAIL TO USER
		require_once ENGINE_PATH.'/classes/email.class.php';
		$emailClass = new email();
		
		$emailClass->fromEmail = 'no-reply@'.$config['domain'];
		$emailClass->subject = '['.$config['domain'].'] '.$langArray['email_unapprove_delete_item_update_subject'];
		$emailClass->message = langMessageReplace($langArray['email_unapprove_delete_item_update_text'], array(
																'THEMENAME' => $item['name'],
																'COMMENT' => $_POST['comment_to_user']
														));
		$emailClass->to($item['user']['email']);
		$emailClass->send();
				
		return true;
	}
	
	public function isInUpdateQueue($id) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `temp_items`
			WHERE `item_id` = '".intval($id)."'
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return true;
	}
	
	public function getItemsCount() {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `items`
			WHERE `status` = 'active'
		");
		
		return $mysql->num_rows();
	}
	
	
	public function isRate($id) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `items_rates`
			WHERE `item_id` = '".intval($id)."' AND `user_id` = '".intval($_SESSION['user']['user_id'])."'
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return $mysql->fetch_array();
	}
	
	public function rate($id, $rate) {
		global $mysql, $item;
		
		$row = $this->isRate($id);
		if(is_array($row)) {
			return $item;
		}
		
		$item['votes'] = $item['votes'] + 1;
		$item['score'] = $item['score'] + $rate;
		$item['rating'] = $item['score'] / $item['votes'];
		$item['rating'] = round($item['rating']);
		
		$mysql->query("
			UPDATE `items`
			SET `rating` = '".intval($item['rating'])."',
					`score` = '".intval($item['score'])."',
					`votes` = '".intval($item['votes'])."'
			WHERE `id` = '".intval($id)."'
		");
		
		$mysql->query("
			INSERT INTO `items_rates` (
				`item_id`,
				`user_id`,
				`rate`,
				`datetime`
			)
			VALUES (
				'".intval($id)."',
				'".intval($_SESSION['user']['user_id'])."',
				'".intval($rate)."',
				NOW()
			)
		");
		
#INC USER RATES
		require_once ROOT_PATH.'/scripthub/apps/users/models/users.class.php';
		$usersClass = new users();

		$user = $usersClass->get($item['user_id']);
		
		$user['votes'] = $user['votes'] + 1;
		$user['score'] = $user['score'] + $rate;
		$user['rating'] = $user['score'] / $user['votes'];
		$user['rating'] = round($user['rating']);
		
		$mysql->query("
			UPDATE `users`
			SET `rating` = '".intval($user['rating'])."',
					`score` = '".intval($user['score'])."',
					`votes` = '".intval($user['votes'])."'
			WHERE `user_id` = '".intval($user['user_id'])."'
		");
		
		return $item;
	}
	
	
	public function getRates($where='') {
		global $mysql;
		
		if($where!='') {
			$where = " AND ($where) ";
		}
		
		$mysql->query("
			SELECT *
			FROM `items_rates`
			WHERE `user_id` = '".intval($_SESSION['user']['user_id'])."' $where
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$return = array();
		while($d = $mysql->fetch_array()) {
			$return[$d['item_id']] = $d;
		}
		
		return $return;
	}
	
	
	public function getTagItems($tagID, $tagType, $start=0, $limit=0, $where='', $order='`datetime` DESC') {
		global $mysql;
		
		$limitQuery = '';
		if($limit!=0) {
			$limitQuery = " LIMIT $start,$limit ";
		}
		
		$mysql->query("
			SELECT SQL_CALC_FOUND_ROWS i.*,
			(SELECT GROUP_CONCAT(`categories` SEPARATOR '|') FROM `items_to_category` WHERE `item_id` = `i`.`id`) AS `categories`
			FROM `items_tags` AS it
			JOIN `items` AS i
			ON i.`id` = it.`item_id`
			WHERE it.`tag_id` = '".intval($tagID)."' AND it.`type` = '".sql_quote($tagType)."' $where
			ORDER BY $order
			$limitQuery
		");
			
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		$this->usersWhere = '';
		$return = array();
		while($d = $mysql->fetch_array()) {
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
		
		$this->foundRows = $mysql->getFoundRows();
		
		return $return;
	}
	
	private function addUserStatus($id, $type='freefile') {
		$item = $this->get($id);
		if(is_array($item)) {
			if(!$this->isExistUserStatus($item['user_id'], $type)) {
				$this->insertUserStatus($item['user_id'], $type);
			}
		}		
		return true;
	}
	
	private function isExistUserStatus($id, $type) {
		global $mysql;
		
		$mysql->query("
			SELECT *
			FROM `users_status`
			WHERE `user_id` = '".intval($id)."' AND `status` = '".sql_quote($type)."'
		");
		
		if($mysql->num_rows() == 0) {
			return false;
		}
		
		return true;
	}
	
	private function insertUserStatus($id, $type) {
		global $mysql;
		
		$mysql->query("
			INSERT INTO `users_status` (
				`user_id`,
				`status`,
				`datetime`
			)
			VALUES (
				'".intval($id)."',
				'".sql_quote($type)."',
				NOW()
			)
		");
		
		return true;
	}
	
}

?>