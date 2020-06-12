<?php
$post = new apps_models_Post();
$router = new apps_libs_router();
$category = new apps_models_Categories();
$cate = $category->buildQueryParameter([
    "select" => "id, name"
])->select();
$query =  $post->buildQueryParameter([
    "select" => "*",
    "other" => "ORDER BY id DESC LIMIT 1"
])->selectEnd();
foreach ($query as $value) {
    $id = $value['id'];
}
// $post->insert();
function test_input($data) // kiểm tra - lọc dữ liệu đầu vào
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$newsId = test_input($router->getPOST('id'));
$newCateId = test_input($router->getPOST('cateid'));
$name = test_input($router->getPOST('namepost'));
$summary = test_input($router->getPOST('summary'));
$content = test_input($router->getPOST('content'));
if ($router->getPOST('add') && $newCateId && $name && $summary && $content) {
    $post->id = $id + 1;
    $post->cateid = (int) $newCateId;
    $post->name = $name;
    $post->summary = $summary;
    $post->content = $content;

    $post->insert();
    $url =$router->createUrl('home');

    header("location: $url");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2 class="d-flex justify-content-center">Chỉnh Sửa Bài Viết</h2>
        <h3><a class="btn btn-outline-primary" href='<?= $router->createUrl('home') ?>'>quay về</a></h3>
        <div class="row">
            <div class="col-sm-6">
                <form action="" method="post">
                    <label for="exampleFormControlTextarea1">#id</label>
                    <input class="form-control form-control-sm" type="text" value="<?= $id + 1 ?>" name="id" disabled>
                    <label for="exampleFormControlSelect1">Chuyên Mục</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="cateid">
                        <?php
                            foreach($cate as $value){
                                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                            }
                        ?>
                    </select>
                    <label for="exampleFormControlTextarea1">Name</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="namepost"></textarea>
                    <label for="exampleFormControlTextarea1">Summary</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="summary"></textarea>
                    <label for="exampleFormControlTextarea1">Content</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="9" name="content"></textarea>

                    <br>
                    <input type="submit" class="btn btn-outline-primary logbtn" value="Add" name="add">
                </form>
            </div>
        </div>
    </div>
</body>

</html>