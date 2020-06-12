<?php
$router = new apps_libs_router();
$post = new apps_models_Post();
$category = new apps_models_Categories();

$queryCategories = $category->buildQueryParameter([
    "select" => "id, name"
])->select();?>


<header>
        <div class="header-1">
            <div class="container navbar-trending">
                <nav class="navbar navbar-expand-sm" style="padding: 0px">
                    <a class="nav-link  link-trending" href="#">
                        <i class="fas fa-star"></i> Home
                    </a>
                    <a class="nav-link link-trending" href="#">
                        <i class="fas fa-star"></i> more
                    </a>
                    <a class="nav-link link-trending" href="#">
                        <i class="fas fa-star"></i> không E không phải Đấng
                    </a>

                    <div class="collapse navbar-collapse mr-auto navbar-nav" id="navbarSupportedContent">
                        <div class="navbar-nav mr-auto">
                        </div>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control form-control-sm mr-sm-2 " type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-sm btn-outline-success my-1 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
        <div class="header-2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="logo">
                            <a class="" href="<?php echo $router->createUrl('home') ?>">
                                <img src="http://127.0.0.1:8887/logo.png" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="intro-web">
                            <a href="<?php echo $router->createUrl('home') ?>">
                                <h4>BaoLaCai.vn</h4>
                                <p class="">abc xyz</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-7 col-xs-12">
                        <div class="hot-trending">
                            <a href="#">#Trái đất lọc member - 1 đi không trở lại</a>
                            <a href="#">#Trứng rán cần mỡ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="categories">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a href="<?php echo $router->createUrl('home') ?>" class="nav-link active"><i class="fas fa-home"></i></a>
                </li>
                <?php
                foreach($queryCategories as $value){
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link active abc" href="'.$router->createUrl('listpost',['id'=> $value['id'], 'pageno'=>1]).'">'.$value['name'].'</a>';
                    echo '</li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-ellipsis-h"></i></a>
                </li>
            </ul>
        </div>
    </header>