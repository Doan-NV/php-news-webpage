<?php

    $router = new apps_libs_router();
    $categories = new apps_models_Categories;
    
    $id = $_GET['id'];
    $categories->id = $id;
    $categories->delete();

    $url =$router->createUrl('categories/categori');
    header("Location: $url");
;
