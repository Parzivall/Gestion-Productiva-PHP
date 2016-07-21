<?php

require_once("Core/Session.php");

class HomeController{
    
    private $model;
    
    public function __construct(){
    }
    
    public function Index(){
        require_once 'Views/header.php';
        require_once 'Views/sidebar.php';
        require_once 'Views/panel.php';
        require_once 'Views/Home/index.php';
        require_once 'Views/footer.php';
    }
    
}