<?php
    // var_dump($_GET['cateid']);
    if(isset($_GET['id'])  && is_numeric($_GET['id'])){
        $id = $_GET['id'];
    }
    var_dump($_GET['pageno']);
    // die();
    $router = new apps_libs_router();
    $post = new apps_models_Post();
    $post->id = $id;
    $post->delete();


    $url = $router->createUrl('posts/postsByCategory',['id'=>$_GET['cateid'],'pageno'=>$_GET['pageno']]);
    // còn bug khi xóa hết các bản ghi ở 1 pageno

    var_dump($url);
    // die();
    header("Location: $url");
    

?>