<?php
namespace App;
require_once __DIR__ .'/config.php';
require_once TOPAZ_WRAPPER_FILE;
use Sys\Users;
use Sys\SystemSession;

use Sys\Utils;
use Sys\Cookie;
use Sys\Router;

//CAN WE MAKE CONNECTION WITH DATABASE
$pdo = null;
$dsn = 'mysql:host=' . TOPAZ_DBHOST . ';dbname=' . TOPAZ_DBNAME;		
try
{
    $pdo = new \PDO($dsn, TOPAZ_DBUSER, TOPAZ_DBPASS);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC); 			
}
catch (\PDOException $e ) 
{
   error_log($e->getMessage());
   echo "DATABASE CONNECTION ISSUE! <br>";
   echo $e->getMessage();
   die();
} 	

//IS DATABASE EMPTY?
$stmt = $pdo->query('SHOW TABLES FROM '. TOPAZ_DBNAME .' ;');			
if (!$stmt->rowCount())
{
    //IT IS EMPTY
    $sqlFile = file_get_contents(TOPAZ_ROOT_DIR . '/init.sql');    
    
    try 
    {  
        $pdo->query($sqlFile);
    } 
    catch (\PDOException $e)
    {
       echo "DATABASE CREATION ISSUE! <br>";
       echo $e->getMessage();
       die();
    }
}




Utils::startSecureSession();

if (inDevelopment())
{
    \Tracy\Debugger::enable();
}


if (!Users::haveRole())
{
    Users::setRoleGuest();
}



$router = new Router();
$router->init();



