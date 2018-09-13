<?
/**
 * Copyright (c) 2018. 
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */

/**
@version 2
@author Venko007

Example:

$cache = new cache;
// Get var if not 60 seconds old
$variable = $cache->Get("variable_with_id", 60);

if (!$variable) {
    // Cache file expired or is inexistant
    // Do something to get new data
    $cache->Set("variable_with_id", $newdata);
    $variable = $newdata;
}

echo $variable;

 **/

class cache {
	// Where things are cached to (must have trailing slash!)
	var $cacheDir = "../cache/phpcache/";
	// How long to cache something for in seconds, default 1hr
	var $defaultCacheLife = "3600";
	
	function __construct() {
		//global $config;
		$this->cacheDir = ROOT_PATH . $this->cacheDir;
	}
	/**
        Set($varId, $varValue) --
        Creates a file named "cache.VARID.TIMESTAMP"
        and fills it with the serialized value from $varValue.
        If a cache file with the same varId exists, Delete()
        will remove it.
	 **/
	function Set($varId, $varValue) {
		global $config;
		
		if ($config ['debug'] == 1) {
			add_debug ( "recache: " . $varId . " = " . $varValue );
		}
		
		// Clean up old caches with same varId
		// $this->Delete($varId);
		// Create new file
		// $fileHandler = fopen($this->cacheDir . "cache." . $varId . "." . time(), "a");
		$file = $this->cacheDir . "cache." . $varId;
		//echo $file.'<br />';
		$fileHandler = fopen ( $file, "w" );
		// Write serialized data
		$s = fwrite ( $fileHandler, serialize ( $varValue ) );
		fclose ( $fileHandler );
		
		return $s;
	}
	
	/**
        Get($varID, $cacheLife) --
        Retrives the value inside a cache file
        specified by $varID if the expiration time
        (specified by $cacheLife) is not over.
        If expired, returns FALSE
	 **/
	function Get($varId, $cacheLife = "") {
		global $config;
		// Set default cache life
		//$cacheLife = (! empty ( $cacheLife )) ? $cacheLife : $this->defaultCacheLife;
		

		if ($cacheLife !== false && $cacheLife != '0' && ! is_numeric ( $cacheLife )) {
			$cacheLife = $this->defaultCacheLife;
		}
		
		if($cacheLife == 0) {
			$cacheLife = false;
		}
		
		/* Loop through the directory looking for cache file */
		/* $dirHandler = dir($this->cacheDir);
        while ($file = $dirHandler->read()) {
            /* Check for cache file with requested varId * /
            if (preg_match("/cache.$varId.[0-9]/", $file)) {
                $cacheFileName = explode(".", $file);
                // Cache file creation time
                $cacheFileLife = $cacheFileName[2];
                // Full location
                $cacheFile = $this->cacheDir . $file;

                /* Check to see if cache file has expired or not * /
                if ( $cacheLife == 0 || (time() - $cacheFileLife) <= $cacheLife) {
                    $fileHandler = fopen($cacheFile, "r");
                    $varValueResult = fread($fileHandler, filesize($cacheFile));
                    fclose($fileHandler);
                    // Still good, return unseralized data
                    return unserialize($varValueResult);
                } else {
                    // Cache expired, break loop
                    break;
                }
            }
        }
        $dirHandler->close();
        */
		$file = $this->cacheDir . "cache." . $varId;
		//echo '<br />';
		
		if (file_exists ( $file ) && filesize ( $file ) > 0) {
			if ($cacheLife === false || (time () - filemtime ( $file )) <= $cacheLife) {
				$fileHandler = fopen ( $file, "r" );
				$varValueResult = fread ( $fileHandler, filesize ( $file ) );
				fclose ( $fileHandler );
				// Still good, return unseralized data
				return unserialize ( $varValueResult );
			} else {
				
				if ($config ['debug'] == 1) {					
					//add_debug ( "cache expire: " . $varId . " TimeExpire: " . unix_time ( filectime ( $file ) ) );
				}
				
				return false;
			}
		} else {			
			if ($config ['debug'] == 1) {
				add_debug ( "cache file not exists! " . $varId );
			}
			
			return false;
		}
		
		return FALSE;
	}
	
	/**
        Delete($varId) --
        Loops through the cache directory and
        removes any cache files with the varId
        specified in $varID
	 **/
	function Delete($varId) {
		/*$dirHandler = dir($this->cacheDir);
        while ($file = $dirHandler->read()) {
            if (preg_match("/cache.$varId.[0-9]/", $file)) {
                unlink($this->cacheDir . $file); // Delete cache file
            }
        }
        $dirHandler->close();
   		*/
		$file = $this->cacheDir . "cache." . $varId;
		if (file_exists ( $file )) {
			unlink ( $file );
			return true;
		}
		return false;
	}

}

?>