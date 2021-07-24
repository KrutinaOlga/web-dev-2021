<?php
spl_autoload_register(function ($class){
    $dirs = [
      ".",  "./test", "./data", "./core", "./model"
    ];
    $file_name= $class.".php";
    foreach ($dirs as $d) {
        if (file_exists($d ."/". $file_name)) {
            include_once $d ."/". $file_name;
            break;
        }
    }
 
});