<?php
    $router = new apps_libs_router();
    // check data
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    $username = test_input($router->getPOST('username'));
    $password = test_input($router->getPOST('password'));

    $identity = new apps_libs_userIdentity();

    if($router->getPOST('submit') && $username && $password){

        $identity->username = $username;
        $identity->password = $password;
        // đã nhận được giá trị rồi.
        $identity->login();
        // die();
        if($identity->isLogin()){
            $router->homePage();
        }else{
            echo "<h2 style='position: absolute;left: 37%;top: 10%; z-index:1'>username or password is incorrect</h2>";
        }
    }
    if($identity->isLogin()){
        $router->homePage();
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <style> <?php include '../view/css/style-login.css';?> </style>
</head>

<body>

    <form action="<?php echo $router->createUrl('login')?>" class="login-form" method="POST">
        <h1>Login</h1>

        <div class="txtb">
            <input type="text" name="username">
            <span data-placeholder="Username"></span>
        </div>

        <div class="txtb">
            <input type="password" name="password">
            <span data-placeholder="Password"></span>
        </div>

        <input type="submit" class="logbtn" value="Login" name ="submit">

        <div class="bottom-text">
            Don't have account? <a href="#">Sign up</a>
        </div>

    </form>

    <script type="text/javascript">
        $(".txtb input").on("focus", function() {
            $(this).addClass("focus");
        });

        $(".txtb input").on("blur", function() {
            if ($(this).val() == "")
                $(this).removeClass("focus");
        });
    </script>


</body>

</html>