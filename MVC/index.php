<?php
session_start();
require_once("Controller/User_Controller.php");

$controller = new User_Controller;
$controller->log();



/*
$controller=$_GET["Controller"];
$action=$_GET["action"];
//$_SERVER['URL_REQUEST']

include("C:\UwAmp\www\PPE3MVC\MVC\Controller\User_Controller.php");
if($controller=="User_Controller"){
    $obj=new User_Controller();
    $obj->{$action}();

    if($action=="log"){
    $obj->log();
    }

}*/

?>
