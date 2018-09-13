<?php
/**
 * Copyright (c) 2018. 
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

class watermark {
	
	public $watermarkFile = NULL; //this is watermark file (PNG)
	private $imageType = "jpg";
	private $position='downright'; //this is position of watermark.. at this time we have downright and center
	
	/**
	 * function constructor
	 *
	 * @param string $watermark
	 */
	function __construct($watermark, $position='') {
		if(!isset($watermark)) {
			die('Error with load watermark');
		}
		
		if($position!='') {
			$this->position = $position;
		}
		
		$this->watermarkFile = $watermark;
	}
	
	/**
	 * function getImageType
	 *
	 * @param string $imageFile
	 */
	private function getImageType($imageFile) {
		$imageInfo = getimagesize($filename);
		
		$imageInfo[2] = strtolower($imageInfo[2]);
		
		switch($imageInfo[2]) {
			case 'jpg': 
				$this->imageType = "jpg";
				break;
			
			case 'gif': 
				$this->imageType = "gif";
				break;
				
			case 'png': 
				$this->imageType = "png";
				break;
				
			default: 
				die('Wrong file type.');
				break;
		}
	}

	/**
	 * function addWatermark
	 *
	 * @param string $imageFile
	 * @param string $destinationFile
	 */
	function addWatermark($imageFile, $destinationFile=true) {
		
		if($destinationFile) {
			$destinationFile = $imageFile;
		}
		
		$watermark = @imagecreatefrompng($this->watermarkFile) or exit('Cannot open the watermark file.');
	  imageAlphaBlending($watermark, false);
	  imageSaveAlpha($watermark, true);
	
    $image_string = @file_get_contents($imageFile) or exit('Cannot open image file.');
    $image = @imagecreatefromstring($image_string) or exit('Not a valid image format.');

    $imageWidth=imageSX($image);
	  $imageHeight=imageSY($image);
	
    $watermarkWidth=imageSX($watermark);
    $watermarkHeight=imageSY($watermark);
	
    if($this->position == 'center') {
    	$coordinate_X = ( $imageWidth - $watermarkWidth ) / 2;
	    $coordinate_Y = ( $imageHeight - $watermarkHeight ) / 2;
    }
    else {
	    $coordinate_X = ( $imageWidth - 5) - ( $watermarkWidth);
	    $coordinate_Y = ( $imageHeight - 5) - ( $watermarkHeight);
    }
	
    imagecopy($image, $watermark, $coordinate_X, $coordinate_Y, 0, 0, $watermarkWidth, $watermarkHeight);
	
    if($this->imageType == 'jpg') {
    	imagejpeg ($image, $destinationFile, 100);
    }
    elseif($this->imageType == 'gif') {
    	imagegif ($image, $destinationFile);
    }
    elseif($this->imageType == 'png') {
    	imagepng ($image, $destinationFile, 100);
    }
    
    imagedestroy($image);
    imagedestroy($watermark);
	
	}
	
} 

?>