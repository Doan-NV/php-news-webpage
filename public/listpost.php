<?php
$id = $_GET['id'];
$router = new apps_libs_router();
$posts = new apps_models_Post();
$category = new apps_models_Categories();

$queryNameCate = $category->buildQueryParameter([
    "select" => "name",
    "where" => "id = ".$id
])->select();
$name = $queryNameCate[0]['name'];
// var_dump($name);
$queryCount = $posts->buildQueryParameter([ // lấy số lượng bản ghi (number) của 1 chuyên mục
    "select" => "cate_id",
    "where" => "cate_id =" . (int) $id
])->selectCount();

// var_dump($queryCount[0]['COUNT(cate_id)']); // tổng số bản ghi có cate_id = ?
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$i=1;
$perpage = 5;
$offset = ($pageno - 1) * $perpage;
$total_pages = ceil($queryCount[0]['COUNT(cate_id)'] / $perpage);
// echo $total_pages;
$queryMany = $posts->buildQueryParameter([ // lấy số lượng bản ghi (number) của 1 chuyên mục
    "select" => "*",
    "where" => "cate_id =" . (int) $id,
    "other" => "$offset,$perpage"
])->selectMany();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"  crossorigin="anonymous">
    <link rel="stylesheet" href="./css/category.css">
    <style>
        <?php
        include '../view/css/header.css';
        include '../view/css/style.css';
        include '../view/css/footer.css';

        ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'header.php'; ?>
    <section class="category">
        <div class="remarkable">
            <div class="container">
                <h2 class="title-travel"><a href="#"><?php echo $name?></a></h2>

                <?php
                foreach ($queryMany as $value) {
                    echo '<div class="remarkable-news">';
                    echo '<div class="media ">';
                    echo '<a href="'.$router->createUrl('postDetail',['id'=>$value['id'], 'cate_id' => $value['cate_id']]).'">';
                    echo '<img class="align-self-center mr-3" src="http://127.0.0.1:8887/200.jpg" alt="Generic placeholder image">';
                    echo '<div class="media-body">';
                    echo '<p class="mt-0"><a href="'.$router->createUrl('postDetail',['id' =>$value['id'], 'cate_id' => $value['cate_id']]).'">' . $value['name'] . "</a></p>";
                    echo '<p>' . $value['summary'] . '</p>';
                    echo '</div></div></div>';
                }
                ?>
            </div>
        </div>

        <div class="">
            <nav aria-label="Page navigation example" class="">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php
                    while($i<=$total_pages){
                        echo "<li class='page-item'><a class='page-link'
                         href='".$router->createUrl('listpost',['id' => $queryMany[0]['cate_id'],'pageno' => $i])."'>".$i."</a></li>";
                        $i++;
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
<?php include 'footer.php'?>
</body>

</html>