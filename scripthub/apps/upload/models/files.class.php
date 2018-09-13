<?php
/**
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

class files extends base {
	
	public function addFile() {
		global $mysql, $config;
		
		$this->uploadFileDirectory = 'temporary/';
		$this->maxFileSize = $config['max_upload_size'];
		$this->fileExt = $config['upload_ext'];
		
		$file = $this->upload('file', '', true);
		if(substr($file, 0, 6) == 'error_') {
			$error['file'] = $file;
		}
				
		if(isset($error)) {
			return $error;
		}
		
		$fileArr = array(
			'filename' => $file,
			'name' => $_FILES['file']['name'],
			'size' => number_format($_FILES['file']['size'] / 1024 / 1024, 2),
			'uploaded' => time()
		);
		
		$_SESSION['temp']['uploaded_files'][$file] = $fileArr;
		
		return $fileArr;
	}
	
}

?>