<?php
$router = new apps_libs_router();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $id = test_input($router->getPOST('id'));
  $name = test_input($router->getPOST('name'));
  $email = test_input($router->getPOST('email'));
  $date = test_input($router->getPOST('date'));
  $category = new apps_models_Categories();
  if($router->getPOST('submit') && is_numeric($id) && $name && $email){
    $category->id = $id;
    $category->name = $name;
    $category->email = $email;
    $category->create_date = $date;
    $category->insert();
    // $url =$router->createUrl('categories/categori');
    // header("Location: $url");
    $router->redirect('categories/categori');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2>Thêm Danh Mục</h2>
        <h3><a class="btn btn-outline-primary" href='<?= $router->createUrl('logout'); ?>'>Logout</a></h3>
        <h3><a class="btn btn-outline-primary" href='<?= $router->createUrl('categories/categori'); ?>'>quay về trang quản lí chuyên mục</a></h3>
        <br><br>
        <div class="row">
            <div class="col-sm-6">
                <form action="" method="post">
                    <label for="">ID</label>
                    <input class="form-control form-control-sm" type="text" placeholder="#id" name="id">
                    <label for="">tên danh mục</label>
                    <input class="form-control form-control-sm" type="text" placeholder="Danh Mục" name="name">
                    <label for="">date</label>
                    <input class="form-control form-control-sm" type="text" placeholder="dd/mm/yyyy" name="date">
                    <label for="">Email</label>
                    <input class="form-control form-control-sm" type="text" placeholder="email@gamil.com" name="email">
                    <br>
                    <input type="submit" class="logbtn" value="Thêm" name ="submit">
                </form>
            </div>
        </div>
    </div>
</body>

</html>