<?php

namespace Sys;

class Utils
{
	private function __construct() {}
	private function __clone() {}
	
	public static function getRootUrl()
	{
		$doc_root = preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']);
		$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
		$domain = $_SERVER['SERVER_NAME'];
		$base_url = preg_replace("!^${doc_root}!", '', __DIR__);
		$port = $_SERVER['SERVER_PORT'];

		if (strval($port) === '80' || strval($port) === '443')
		{
			return $protocol .'://'. $domain;
		}
		else
		{
			return $protocol .'://'. $domain .':'. $port;
		}
		
		return null;		
	}
	
	public static function isHttps()
	{
		$c1 = filter_input(INPUT_SERVER, 'HTTPS') !== null;
		$c2 = filter_input(INPUT_SERVER, 'SERVER_PORT', FILTER_SANITIZE_NUMBER_INT);
		$c2 = intval($c2) === 443;

		if ($c1 || $c2) {
			return true;
		}
		return false;		
	} 
	
	
	public static function startSecureSession() 
	{		
		$sess_name = session_name();		
		
		if (self::isHttps()) 
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
	
	public static function endSecureSession() 
	{
		$_SESSION = [];
		session_destroy();
	}
	
	public static function consoleDump($msg, $title=null)
	{
		$backtrace = debug_backtrace();
		$file = $backtrace[0]['file'];
		$line = $backtrace[0]['line'];
		
		$titleString = '';
		
		if (isset($title))
		{
			$titleString = $title . ' ##';
		}
				
		error_log("\033[0;34m " . $titleString);
		error_log('## ' . $file . '('. $line . ')' );
		error_log(print_r($msg, true));
		error_log("\033[0m");
	}	
	
}


