<?php
// tự động load các class trong code
spl_autoload_register(function ($classname) {
    $exp = str_replace("_", "/", $classname);
    $path = str_replace("apps", "", dirname(__FILE__));
    // var_dump($path."/".$exp.".php");
    include_once $path."/".$exp.".php";
});

?>
