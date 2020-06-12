<?php
if (isset($_GET['id']) && isset($_GET['cateid']) && isset($_GET['pageno'])) {
    $id = $_GET['id'];
    $cateid = $_GET['cateid'];
    $pageno = $_GET['pageno'];
    // var_dump($id,$cateid,$pageno);
}
// var_dump($id,$cateid,$pageno);
$router = new apps_libs_router();
$post = new apps_models_Post();



$query = $post->buildQueryParameter([
    "select" => "*",
    "where" => "id =" . $id
])->select();
// var_dump($query);

foreach ($query as $value) { // lặp để gán dữ liệu vào biến
    $idpost = $value['id'];
    $namepost = $value['name'];
    $cateidpost = $value['cate_id'];
    $summary = $value['summary'];
    $content = $value['content'];
}

function test_input($data) // kiểm tra - lọc dữ liệu đầu vào
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 

$idEdit = test_input($router->getPOST('idpost'));
$cateidEdit = test_input($router->getPOST('cateidpost'));
$nameEdit = test_input($router->getPOST('namepost'));
$summaryEdit = test_input($router->getPOST('summary'));
$contentEdit = test_input($router->getPOST('content'));

// $post->update();
// die();

if ($router->getPOST('edit')) {
    $post->id = $id;
    $post->cateid=$cateid;
    $post->name = $nameEdit;
    $post->summary=$summaryEdit;
    $post->content= $contentEdit;


    $post->update(); // update data


    $url = $router->createUrl('posts/postsByCategory',['id' => $cateid,'pageno' => $pageno]);
    header("Location: $url");

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<!-- <?=$router->createUrl('posts/edit',['id' => $id, 'cateid'=>$cateid, 'pageno' => $pageno])?> -->
<body>
    <div class="container">
    <h2 class="d-flex justify-content-center">Chỉnh Sửa Bài Viết</h2>
        <h3><a class="btn btn-outline-primary" href='<?= $router->createUrl('posts/postsByCategory',['id' => $cateid, 'cateid'=>$cateid, 'pageno' => $pageno]); ?>'>quay về trang quản lí chuyên mục</a></h3>
        <div class="row">
            <div class="col-sm-6">
                <form action="" method="post">
                    <label for="exampleFormControlTextarea1">#id</label>
                    <input class="form-control form-control-sm" type="text" value="<?= $idpost ?>" name="idpost" disabled>
                    <label for="exampleFormControlTextarea1">category id</label>
                    <input class="form-control form-control-sm" type="text" value="<?= $cateidpost ?>" name="cateidpost" disabled>
                    <label for="exampleFormControlTextarea1">Name</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="namepost"><?= $namepost ?></textarea>
                    <label for="exampleFormControlTextarea1">Summary</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="summary"><?= $summary ?></textarea>
                    <label for="exampleFormControlTextarea1">Content</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="9" name="content"><?= $content ?></textarea>
                    <br>
                    <input type="submit" class="btn btn-outline-primary logbtn" value="Edit" name="edit">
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!-- http://localhost/webpagePHP/admin/index.php/?id=37&cateid=2&pageno=2&r=posts%2Fedit -->