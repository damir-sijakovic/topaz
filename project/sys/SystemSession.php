<?php 

namespace Sys;

class SystemSession
{
	public static function begin() 
	{		
		$sess_name = session_name();
		
		
		if (Http::isHttps()) 
		{
			session_start([
				'cookie_lifetime' => 0,
				'cookie_secure' => true,
				'cookie_httponly' => true,
				'cookie_samesite' => 'Strict',
				'cookie_path' => '/',
			]);
		}
		else
		{
			session_start([
				'cookie_lifetime' => 0,
				'cookie_secure' => false,
				'cookie_httponly' => true,
				'cookie_samesite' => 'Strict',
				'cookie_path' => '/',
			]);
		}	
	}
	
	public static function end() 
	{
		$_SESSION = [];
		session_destroy();
	}
	
	public static function haveSession() 
	{
		if (isset($_SESSION['_TOPAZ_SYSTEM_']))
		{
			return true;
		}
		return false;		
	}
	

	
	public static function destroy() 
	{
		if (isset($_SESSION['_TOPAZ_SYSTEM_']))
		{
			unset ($_SESSION['_TOPAZ_SYSTEM_']);
		}
	}
	

	
	public static function set($key, $value) 
	{
		$_SESSION['_TOPAZ_SYSTEM_'][$key] = $value;
	}
	
	public static function delete($key) 
	{
		if (isset($_SESSION['_TOPAZ_SYSTEM_'][$key]))
		{
			unset($_SESSION['_TOPAZ_SYSTEM_'][$key]);
			return true;
		}
		return false;		
	}
	
	public static function init($key, $value) 
	{
		if (!self::keyExists($key))
		{ 
			$_SESSION['_TOPAZ_SYSTEM_'][$key] = $value;
		}
	}
	

	public static function get($key) 
	{
		if (isset($_SESSION['_TOPAZ_SYSTEM_']))
		{
			if (isset($_SESSION['_TOPAZ_SYSTEM_'][$key])) 
			{
				return $_SESSION['_TOPAZ_SYSTEM_'][$key];
				
			}
			return false;
		}
	}
	
	public static function keyExists($key) 
	{
		if (isset($_SESSION['_TOPAZ_SYSTEM_']))
		{
			if (isset($_SESSION['_TOPAZ_SYSTEM_'][$key])) 
			{
				return true;				
			}
			return false;
		}
	}
	
	public static function getJson() 
	{
		if (isset($_SESSION['_TOPAZ_SYSTEM_']))
		{
			return json_encode($_SESSION['_TOPAZ_SYSTEM_']);
		}
	}
	
	public static function getArray() 
	{
		if (isset($_SESSION['_TOPAZ_SYSTEM_']))
		{
			return $_SESSION['_TOPAZ_SYSTEM_'];
		}
	}
	
	public static function setMultipleValues($arr) 
	{
		foreach ($arr as $k => $v)
		{
			$_SESSION['_TOPAZ_SYSTEM_'][$k] = $v;
		}
	}
	
	public static function setJson($json) 
	{
		$arr = json_decode($json);
		self::$setMultipleValues($arr);		
	}
	



};
