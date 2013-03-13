<?php

/**
 *
 * 
 */

//  
if (!defined('CHARGEOVERAPI_LOADER_REQUIREONCE'))
{
	define('CHARGEOVERAPI_LOADER_REQUIREONCE', true);
}

if (!defined('CHARGEOVERAPI_LOADER_AUTOLOADER'))
{
	define('CHARGEOVERAPI_LOADER_AUTOLOADER', true);
}

/**
 * 
 */
class ChargeOverAPI_Loader
{
	/**
	 * 
	 */
	static public function load($file, $autoload = true)
	{
		//print('loading file [' . $file . ']' . "\n");
		
		if ($autoload and 
			ChargeOverAPI_Loader::_autoload())
		{
			return true;
		}
		
		static $loaded = array();
		
		if (isset($loaded[$file]))
		{
			return true;
		}
		
		$loaded[$file] = true;
		
		// Make sure we're using the right paths...
		$file = str_replace('/', DIRECTORY_SEPARATOR, $file);
		
		if (CHARGEOVERAPI_LOADER_REQUIREONCE)
		{
			require_once CHARGEOVERAPI_BASEDIR . $file;
		}
		else
		{
			require CHARGEOVERAPI_BASEDIR . $file;
		}
		
		return true;
	}
	
	/**
	 * 
	 */
	static protected function _autoload()
	{
		if (!CHARGEOVERAPI_LOADER_AUTOLOADER)
		{
			return false;
		}
		
		static $done = false;
		static $auto = false;
		
		if (!$done)
		{
			$done = true;
			
			if (function_exists('spl_autoload_register'))
			{
				// Register the autoloader, and return TRUE
				spl_autoload_register(array( 'ChargeOverAPI_Loader', '__autoload' ));
				
				$auto = true;
				return true;
			}
		}
		
		return $auto;
	}
	
	/**
	 * 
	 */
	static public function __autoload($name)
	{
		if (strtolower(substr($name, 0, 13)) == 'chargeoverapi')
		{
			$file = DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $name) . '.php';
			ChargeOverAPI_Loader::load($file, false);
		}
	}
	
	/** 
	 * Import (require_once) a bunch of PHP files from a particular PHP directory
	 * 
	 * @param string $dir
	 * @return boolean
	 */
	static public function import($dir, $autoload = true)
	{
		$dh = opendir(CHARGEOVERAPI_BASEDIR . $dir);
		if ($dh)
		{
			while (false !== ($file = readdir($dh)))
			{
				$tmp = explode('.', $file);
				if (end($tmp) == 'php' and 
					!is_dir(CHARGEOVERAPI_BASEDIR . $dir . DIRECTORY_SEPARATOR . $file))
				{
					ChargeOverAPI_Loader::load($dir . DIRECTORY_SEPARATOR . $file, $autoload);
				}
			}
			
			return closedir($dh); 
		}
		
		return false;
	}	
}
