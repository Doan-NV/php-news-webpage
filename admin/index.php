<?php
    // tự động loading các class trong project
    include "../apps/autoLoad.php";
    // $a = new apps_models_Admin();
    // $a->buildQueryParameter(
    //     [
    //         "select" => "name",
    //         "where" => "id = 2",
    //         "field" => [
    //             "id", "username", "password"
    //         ] 
    //     ]
    // )->select();
    $router = new apps_libs_router(__DIR__);
    $router->router();
    // $login = new apps_libs_userIdentity();
    // $login->logout();
?>