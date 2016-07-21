<?php

if(!isset($_SESSION)) { 
    session_start(); 
}
 
require_once 'Core/database.php';
$controller = 'Home';


require_once("Core/base_url.php");
$base_=new base_url();
$base_->baseurl();

// Todo esta lógica hara el papel de un FrontController
if(!isset($_REQUEST['c']))
{
    require_once "Controllers/$controller"."Controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    $controller->Index();    
}
else
{

    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    // Instanciamos el controlador
    require_once "Controllers/$controller"."Controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    
    // Llama la accion
    call_user_func( array( $controller, $accion ) );
}