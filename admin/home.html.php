<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Xin Chào <?php echo $admin->getSESSION('name') ?></h1>
        <h3><a href='<?= $router->createUrl('logout'); ?>'>Logout</a></h3>
        <hr>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="<?= $router->createUrl('categories/categori'); ?>">Quản trị Chuyên Mục</a></li>
            <li class="list-group-item"><a href="<?= $router->createUrl('posts/addPost'); ?>">Thêm bài Viết</a></li>
        </ul>
    </div>
</body>

</html>