<?php

$id;
$name;
$date;
$email;


$router = new apps_libs_router();
$category = new apps_models_Categories();


$query = $category->buildQueryParameter([
    "select" => "*",
    "where" => "id =" . (int) $_GET['id']
])->select(); // dùng câu lệnh để lấy dữ liệu từ db thông qua id ở url 


foreach ($query as $value) { // lặp để gán dữ liệu vào biến
    $id = $value['id'];
    $name = $value['name'];
    $date = $value['create_date'];
    $email = $value['email'];
}

function test_input($data) // kiểm tra - lọc dư liệu đầu vào
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// $category->update(); 
$idEdit = test_input($router->getPOST('id'));
$nameEdit = test_input($router->getPOST('name'));
$dateEdit = test_input($router->getPOST('date'));
$emailEdit = test_input($router->getPOST('email'));

if ($router->getPOST('edit')) {
    // $category->id = 1; // rows cần update data
    $category->idedit = $id; // id want to edit
    $category->name = $nameEdit; // name want to edit
    $category->create_date = $dateEdit; // date want to edit
    $category->email = $emailEdit; //email want to edit

    $category->update();
    $router->redirect('categories/categori'); // go to categori file when update sussecs
}
// die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2 class="d-flex justify-content-center">Chỉnh Sửa Danh Mục Bài Viết</h2>
        <h3><a class="btn btn-outline-primary" href='<?= $router->createUrl('categories/categori'); ?>'>quay về trang quản lí chuyên mục</a></h3>
        <div class="row">
            <div class="col-sm-6">
                <form action="<?= $router->createUrl('categories/edit',['id' => $value['id']]) ?>" method="post">
                    <label for="">ID</label>
                    <input class="form-control" type="text" value="<?=$id?>" name="id" disabled>
                    <label for="">Name</label>
                    <input class="form-control" type="text" value="<?=$name?>" name="name">
                    <label for="">Date</label>
                    <input class="form-control" type="text" value="<?=$date?>" name="date">
                    <label for="">Email</label>
                    <input class="form-control" type="text" value="<?=$email?>" name="email">
                    <br>
                    <input type="submit" class="btn btn-outline-primary logbtn" value="Edit" name="edit">
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>