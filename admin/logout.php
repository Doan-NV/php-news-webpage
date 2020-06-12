<?php
    $router = new apps_libs_router();
    $identity =  new apps_libs_userIdentity();
    $identity->logout();
    $url = $router->createUrl('login');
    header("location: $url");
