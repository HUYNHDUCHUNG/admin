<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["user"])) {
        header("location:../index.php");
    }
    $error = '';
    require("../SQL/connect.php");
    if (isset($_POST["btnLogin"])) {
        $userName = $_POST["userName"];
        $passWord = $_POST["passWord"];
        $sql = "SELECT * FROM admin WHERE username_admin = '$userName'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {
            if ($row["password_admin"] == $passWord) {
                $_SESSION["user"] = $userName;
                header("location:../index.php");
            }
            else{
                $error = "Mật khẩu hoặc tài khoản không chính xác!";
            }
        }else{
            $error = "Mật khẩu hoặc tài khoản không chính xác!";
        }
    }

    ?>
    <div class="container">
        <div class="main">
            <h1>Đăng nhập</h1>
            <form action="" method="POST">
                <div class="form-field">
                    <label for=""><i class="fas fa-user"></i></label>
                    <input type="text" placeholder="Username" name = userName>
                </div>
                <div class="form-field">
                    <label for=""><i class="fas fa-lock"></i></label>
                    <input type="password" placeholder="Password" name="passWord">
                </div>
                <div class="mess">
                    <span><?= empty($error) ? "" : $error?></span>
                </div>
                <div class="form-field">
                    <input class="btnLogin" type="submit" value="Đăng nhập" name="btnLogin">
                </div>
            </form>
        </div>
    </div>
</body>

</html>