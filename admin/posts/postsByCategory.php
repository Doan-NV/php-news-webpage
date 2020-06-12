<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$router = new apps_libs_router();
$posts = new apps_models_Post();


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
    <title>Bài Viết Theo Danh Mục</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
    <section class="category">
        <div class="remarkable">
            <div class="container">
                <h2 class="title-travel">bài viết của chuyên mục</h2>
                <br>
                <h4><a class="btn btn-outline-primary" href="<?=$router->createUrl('categories/categori')?>">Quay lại Danh Mục Bài Viết</a></h4>
                <?php foreach ($queryMany as $value) {
                    echo "<div class='row'>";
                    echo "<div class='col-sm-8'>";
                    echo "<div class='media'>";
                    echo "<div class='media-body'>";
                    echo "<h4 class='mt-0'>stt bài viết: " . $value['id'] . "</h4>";
                    echo "<h5 class='mt-0'>Tên Bài Viết: " . $value['name'] . "</h5>";
                    echo "<p> Tóm tắt: " . $value['summary'] . "</p>";
                    echo "<hr>";
                    echo "</div></div></div>";
                    echo "<div class='col-sm-2'>";
                    echo "<a class='btn btn-outline-danger' 
                    href='".$router->createUrl('posts/delete',['id' => $value['id'],'cateid' => $value['cate_id'],'pageno' => $_GET['pageno']])."'>Xóa bài Viết</a>";
                    echo "</div>";
                    echo "<div class='col-sm-2'>";
                    echo "<a class='btn btn-outline-primary' 
                    href='".$router->createUrl('posts/edit',['id' => $value['id'],'cateid' => $value['cate_id'],'pageno' => $_GET['pageno']])."'>Sửa Bài Viết</a>";
                    echo "</div>";
                    echo "</div>";
                } ?>
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
                         href='".$router->createUrl('posts/postsByCategory',['id' => $queryMany[0]['cate_id'],'pageno' => $i])."'>".$i."</a></li>";
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
</body>

</html>