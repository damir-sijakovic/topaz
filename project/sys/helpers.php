<?php
namespace App;
use Sys\Utils;


function dd($msg, $title=null)
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


function inDevelopment()
{
	if (strtoupper(TOPAZ_MODE) === strtoupper('Development'))
	{
		return true;
	}
	
	return false;
}
