<?php
$router = new apps_libs_router();
$admin = new apps_libs_userIdentity();
// var_dump($_SESSION);
if($_SESSION){
    require 'home.html.php';
}else{
    $url = $router->createUrl('login');
    header("location: $url");
}
?>