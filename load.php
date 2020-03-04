<?php

ini_set('display_errors', 1);

define('ABSPATH', __DIR__);
define('ADMIN_PATH', ABSPATH. '/admin');
define('ADMIN_SCRIPT_PATH', ADMIN_PATH.'/scripts');

session_start();

require_once ADMIN_SCRIPT_PATH.'/database.php';
require_once ADMIN_SCRIPT_PATH.'/login.php';
require_once ADMIN_SCRIPT_PATH.'/user.php';

function redirect_to($location){
    if($location != null){
        header('Location: '.$location);
        exit;
    }
}