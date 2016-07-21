<?php

require_once("Config.php");

class Database
{
    public static function Conectar()
    {
    	$stringConnection = 'mysql:host='.DB_SERVER.";dbname=".DB_DATABASE.";charset=".DB_CHARSET;
        $pdo = new PDO($stringConnection, DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}