<?php
// IMPORTANT! generate new key after install:
// echo | hexdump -n 16 -e '4/4 "%08X" 1 ""' /dev/random
define ('TOPAZ_SERVER_KEY', 'E716B2F388582C6836C0E2D8B8F8AD5B'); 
//define ('CSRF_TOKEN', bin2hex(openssl_random_pseudo_bytes(32)));

define ('TOPAZ_MODE', 'Development'); // development / production

//jwt
define ('TOPAZ_JWT_EXP', '+60 minutes'); //strtotime("+60 minutes") string gets passed as arg into strtotime()
define ('TOPAZ_JWT_NBF', null);          //

//database credentials
define ('TOPAZ_DBNAME',   'topaz');
define ('TOPAZ_DBUSER',   'topaz');
define ('TOPAZ_DBPASS',   'topaz');
define ('TOPAZ_DBHOST',   'myhostname-db');
#define ('TOPAZ_DBHOST',   'localhost');
define ('TOPAZ_DBDRIVER', 'pdo_mysql');

//dirs
define ('TOPAZ_ROOT_DIR',      __DIR__);
define ('TOPAZ_PUBLIC_DIR',    TOPAZ_ROOT_DIR .'/public');
define ('TOPAZ_APP_DIR',       TOPAZ_ROOT_DIR .'/app');
define ('TOPAZ_SYS_DIR',       TOPAZ_ROOT_DIR .'/sys');
define ('TOPAZ_TWIG_DIR',      TOPAZ_ROOT_DIR .'/templates');

//files
define ('TOPAZ_SERVICES_FILE',  TOPAZ_ROOT_DIR .'/services.php');
define ('TOPAZ_ROUTES_FILE',    TOPAZ_ROOT_DIR .'/routes.php');
define ('TOPAZ_WRAPPER_FILE',   TOPAZ_SYS_DIR .'/helpers.php');

//user roles
define('TOPAZ_USER_ADMIN',    'TOPAZ_USER_ADMIN');
define('TOPAZ_USER_USER',     'TOPAZ_USER_USER');
define('TOPAZ_USER_GUEST',    'TOPAZ_USER_GUEST');
define('TOPAZ_USER_BANNED',   'TOPAZ_USER_BANNED');
define('TOPAZ_USER_NOTVERIFIED', 'TOPAZ_USER_NOTVERIFIED');
