<?php 
namespace Sys;


class UserSession
{
	public static function haveSession() 
	{
		if (isset($_SESSION['_TOPAZ_USER_']))
		{
			return true;
		}
		return false;		
	}
	
	public static function destroy() 
	{
		if (isset($_SESSION['_TOPAZ_USER_']))
		{
			unset ($_SESSION['_TOPAZ_USER_']);
		}
	}
	
	public static function set($key, $value) 
	{
		$_SESSION['_TOPAZ_USER_'][$key] = $value;
	}
	
	public static function init($key, $value) 
	{
		if (!self::keyExists($key))
		{ 
			$_SESSION['_TOPAZ_USER_'][$key] = $value;
		}
	}

	public static function get($key) 
	{
		if (isset($_SESSION['_TOPAZ_USER_']))
		{
			if (isset($_SESSION['_TOPAZ_USER_'][$key])) 
			{
				return $_SESSION['_TOPAZ_USER_'][$key];
				
			}
			return false;
		}
	}
	
	public static function keyExists($key) 
	{
		if (isset($_SESSION['_TOPAZ_USER_']))
		{
			if (isset($_SESSION['_TOPAZ_USER_'][$key])) 
			{
				return true;				
			}
			return false;
		}
	}
	
	public static function getJson() 
	{
		if (isset($_SESSION['_TOPAZ_USER_']))
		{
			return json_encode($_SESSION['_TOPAZ_USER_']);
		}
	}
	
	public static function getArray() 
	{
		if (isset($_SESSION['_TOPAZ_USER_']))
		{
			return $_SESSION['_TOPAZ_USER_'];
		}
	}
	
	public static function setMultipleValues($arr) 
	{
		foreach ($arr as $k => $v)
		{
			$_SESSION['_TOPAZ_USER_'][$k] = $v;
		}
	}
	
	public static function setJson($json) 
	{
		$arr = json_decode($json);
		self::$setMultipleValues($arr);		
	}
	



};
