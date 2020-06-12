<?php
$router = new apps_libs_router();
$post = new apps_models_Post();
$category = new apps_models_Categories();

$queryCategories = $category->buildQueryParameter([
    "select" => "id, name"
])->select();

$queryOne = $post->buildQueryParameter([
    "select" => "id, name, summary, cate_id",
    "where" => "id =1"
])->select();

$queryMany = $post->buildQueryParameter([ // lấy số lượng bản ghi cua
    "select" => "id, cate_id, name",
    "where" => "cate_id = 2",
    "other" => "2, 2"
])->selectMany();

$queryCateTravel = $category->buildQueryParameter([ // lấy id của thằng Điểm Đến
    "select" => "id",
    "where" => "name = 'điểm đến'"
])->select();

$querySocial = $category->buildQueryParameter([ // laays id của thằng xã hội
    "select" => "id",
    "where" => "name = 'xã hội'"
])->select();

$querySportid = $category->buildQueryParameter([ // laays id của thằng xã hội
    "select" => "id",
    "where" => "name = 'thể thao'"
])->select();

$queryCarousel = $post->buildQueryParameter([ // lấy số lượng bản ghi của Xã Hội
    "select" => "id, cate_id, name, summary",
    "where" => "cate_id = " . (int) $queryCateTravel[0]['id'],
    "other" => "3, 3"
])->selectMany();

$querySportpost = $post->buildQueryParameter([ // lấy số lượng bản ghi của Xã Hội
    "select" => "id, cate_id, name, summary",
    "where" => "cate_id = " . (int) $querySportid[0]['id'],
    "other" => "3, 3"
])->selectMany();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trang web báo tin tức</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <style>
        <?php
        include '../view/css/header.css';
        include '../view/css/style.css';
        include '../view/css/footer.css';

        ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include 'header.php' ?>
    <section>
        <div class="section-1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="hot-news">
                            <?php
                            foreach ($queryOne as $value) {
                                echo '<a href="' . $router->createUrl('postDetail', ['id' => $value['id'], 'cate_id' => $value['cate_id']]) . '" class="link-hot-news">';
                                echo '<img src="http://127.0.0.1:8887/tin1.png" alt="" title="">';
                                echo '</a>';
                                echo '<h2><a href="' . $router->createUrl('postDetail', ['id' => $value['id'], 'cate_id' => $value['cate_id']]) . '">' . $value['name'] . '</a></h2>';
                                echo '<p>' . $value['summary'] . ' </p>';
                            }
                            ?>
                        </div>

                    </div>
                    <?php
                    foreach ($queryMany as $value) {
                        echo '<div class="col-sm-3"><div class="second-hot-news">';
                        echo '<a href="' . $router->createUrl('postDetail', ['id' => $value['id'],'cate_id' => $value['cate_id']]) . '">';
                        echo '<img src="http://127.0.0.1:8887/2.jpg" alt="" title=""></a><h2>';
                        echo '<a href=' . $router->createUrl('postDetail', ['id' => $value['id'],'cate_id' => $value['cate_id']]) . '>' . $value['name'] . '</a>';
                        echo '</h2></div></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="travel">
            <div class="container ">
                <h2 class="title-travel">
                    <?php echo '<a href="' . $router->createUrl('listpost', ['id' => $queryCateTravel[0]['id']]) . '">Điểm Đến </a>' ?>
                </h2>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                        $i = 0;
                        foreach ($queryCarousel as $value) {
                            if ($i == 0) {
                                echo '<div class="carousel-item active">';
                            } else {
                                echo '<div class="carousel-item">';
                            }
                            echo '<a href="' . $router->createUrl('postDetail', ['id' => $value['id'],'cate_id' => $value['cate_id']]) . '"><img class="d-block w-100" src="https://i.picsum.photos/id/' . $value['id'] . '/960/450.jpg" alt="First slide"></a>';
                            echo '<div class="carousel-caption d-none d-md-block">';
                            echo '<h5>' . $value['name'] . '</h5>';
                            echo '<p>' . $value['summary'] . '</p>';
                            echo '</div></div>';
                            $i++;
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="remarkable">
            <div class="container">
                <h2 class="title-travel">
                    <?php echo '<a href="' . $router->createUrl('listpost', ['id' => $querySportid[0]['id']]) . '"> Thể Thao</a>' ?>
                </h2>
                <?php
                foreach ($querySportpost as $value) {
                    echo '<div class="remarkable-news">';
                    echo '<div class="media ">';
                    echo '<a href="#">
                        <img class="align-self-center mr-3" src="http://127.0.0.1:8887/200.jpg" alt="Generic placeholder image">
                        </a>';
                    echo '<div class="media-body">';
                    echo '<h5 class="mt-0"><a href="'.$router->createUrl('postDetail',['id' => $value['id'],'cate_id' => $value['cate_id']]).'">'.$value['name'].'</a></h5>';
                    echo '<p>'.$value['summary'].'</p>';
                    echo '</div></div></div>';
                }
                ?>
        </div>
        </div>
        <div class="emagazine">
            <div class="container">
                <h2 class="title-travel">
                    <?php echo '<a href="' . $router->createUrl('listpost', ['id' => $queryCateTravel[0]['id']]) . '">Xã Hội </a>' ?>
                </h2>
            </div>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4 d-flex justify-content-center">
                                    <div class="card d-flex" style="width: 18rem;">
                                        <img src="http://127.0.0.1:8887/22-250x150.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 d-flex justify-content-center">
                                    <div class="card" style="width: 18rem;">
                                        <img src="http://127.0.0.1:8887/21-250x150.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 d-flex justify-content-center">
                                    <div class="card" style="width: 18rem;">
                                        <img src="http://127.0.0.1:8887/23-250x150.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4 d-flex justify-content-center">
                                    <div class="card d-flex" style="width: 18rem;">
                                        <img src="http://127.0.0.1:8887/34-250x150.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 d-flex justify-content-center">
                                    <div class="card" style="width: 18rem;">
                                        <img src="http://127.0.0.1:8887/36-250x150.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 d-flex justify-content-center">
                                    <div class="card" style="width: 18rem;">
                                        <img src="http://127.0.0.1:8887/22-250x150.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text"> title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4 d-flex justify-content-center">
                                    <div class="card d-flex" style="width: 18rem;">
                                        <img src="http://127.0.0.1:8887/34-250x150.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 d-flex justify-content-center">
                                    <div class="card" style="width: 18rem;">
                                        <img src="http://127.0.0.1:8887/23-250x150.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 d-flex justify-content-center">
                                    <div class="card" style="width: 18rem;">
                                        <img src="http://127.0.0.1:8887/21-250x150.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev arrow" href="#carouselExampleControls" role="button" data-slide="prev">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <a class="carousel-control-next arrow" href="#carouselExampleControls" role="button" data-slide="next">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

    </section>
    <?php include 'footer.php' ?>
</body>

</html>