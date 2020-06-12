<?php
$categories = new apps_models_Categories();
$user = new apps_libs_userIdentity();
$router = new apps_libs_router();
$query = $categories->buildQueryParameter(
    [
        "select" => "*",
        // "where" => " 1 "
    ]
)->select();
// var_dump($query);
// die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <h2 class="d-flex justify-content-center">Danh Mục Bài Viết</h2>
        <h3 ><a class="btn btn-outline-primary" href='<?= $router->createUrl('home'); ?>'>quay về trang chủ</a></h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th!>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                foreach ($query as $value) {
                    echo "<tr>";
                    echo "<td>".$value['id']."</td>";
                    echo "<td><a href='".$router->createUrl('posts/postsByCategory',['id' => $value['id'],'pageno'=>1])."'>".$value['name']."</a></td>";
                    echo "<td>".$value['create_date']."</td>";
                    echo "<td>".$value['email']."</td>";
                    echo "<td><a href='".$router->createUrl('categories/edit',['id' => $value['id']])."'>Sửa</a></td>";
                    echo "<td><a href='".$router->createUrl('categories/delete',['id' => $value['id']])."'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
                </tr>
            </tbody>
        </table>
        <button><a href='<?= $router->createUrl('categories/detail'); ?>'>Thêm Danh Mục</a></button>
    </div>
</body>

</html>