<?php
class base_url{

    public function __construct() {
    }

    public function baseurl(){
        $base = dirname($_SERVER["SCRIPT_NAME"]);
        $base = str_replace('\\','/',$base);
        if ($base == '/') { $base = NULL; }
        //define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].$base.'/');
        define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].$base.'/');
    }
}
?>
