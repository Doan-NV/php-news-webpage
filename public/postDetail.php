<?php
$id = $_GET['id'];
$cateid = $_GET['cate_id'];
$router = new apps_libs_router();
$posts = new apps_models_Post();
$category = new apps_models_Categories();
$queryPost = $posts->buildQueryParameter([
    "select" => "name, summary, content",
    "where" => "id = " . $id
])->select();
$queryMany = $posts->buildQueryParameter([ // lấy số lượng bản ghi (number) của 1 chuyên mục
    "select" => "id,name, cate_id",
    "where" => "cate_id =" .$cateid,
    "other" => "1,3"
])->selectMany();
// var_dump($queryMany);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <style>
        <?php
        include '../view/css/header.css';
        include '../view/css/post.css';
        include '../view/css/footer.css';

        ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "header.php" ?>
    <section class="section">
        <div class="container box-news">
            <div class="title">
                <?php
                foreach ($queryPost as $value) {
                    echo '<h2>' . $value['summary'] . '</h2>';
                }
                ?>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="icon-conn">
                        <a href="#" class="justify-content-center home"><i class="fas fa-home"></i></a>
                        <a href="#" class="justify-content-center facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="justify-content-center instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="content">
                        <?php
                        foreach ($queryPost as $value) {
                            echo '<p>' . $value['content'] . '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="related">
        <div class="container">
            <div class="more">
                <h2>Bài Viết Cùng Chuyên Mục</h2>
            </div>
            <div class="row">
                <?php
                    foreach($queryMany as $value){
                        echo '<div class="col-sm-4">';
                        echo '<div class="card">';
                        echo '<a href="'.$router->createUrl('postDetail', ['id' => $value['id'], 'cate_id' => $value['cate_id']]).'"><img class="card-img-top" src="http://127.0.0.1:8887/21-250x150.jpg" alt="Card image cap"></a>';
                        echo '<div class="card-body">';
                        echo '<a href="'.$router->createUrl('postDetail', ['id' => $value['id'], 'cate_id' => $value['cate_id']]).'">';
                        echo '<p class="card-text">'.$value['name'].'</p>';
                        echo '</div></div></div>';
                    }
                        
                ?>
            </div>
        </div>
    </section>

    <?php include 'footer.php' ?>
</body>

</html>