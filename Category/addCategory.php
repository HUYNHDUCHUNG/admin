<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/category.css">
    <!-- box icon linl -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- fontawesom link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
    <?php
    require("../SQL/connect.php");
    if (isset($_POST['bntAdd'])) {
        $name = $_POST["name"];
        $parent = $_POST["parent"];
        $sql = "INSERT INTO category(name_category,parent_category) VALUES('$name','$parent')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            mysqli_close($conn);
            header("location:category.php?id=category");
        } else {
            echo "Cập nhật thất bại" . mysqli_error($conn);
        }
    }
    ?>
    <div class="container">
        <?php
        include("../Include/menu.php");
        include("../Include/header.php")
        ?>
        <div class="breadcrumb-bar">
            <div class="container">
                <?php
                echo "<a href='../'>Trang chủ</a>";
                echo "<a href='category.php?id=category'>Danh mục</a>";
                if ($_GET['id'] == 'addCategory') {
                    echo '<a href="?id=addCategory">Thêm danh mục</a>';
                }
                ?>
            </div>
        </div>
        <div class="content">
            <div class="add-category">
                <h3>Thêm danh mục</h3>
                <hr>
                <form action="" method="POST">
                    <table>
                        <tr>
                            <td>Tên danh mục:</td>
                            <td><input type="text" placeholder="Tên danh mục" name="name"></td>
                        </tr>
                        <tr>
                            <td>Danh mục cha:</td>
                            <td>
                                <select name="parent">
                                    <option value="0">Không</option>
                                    <?php
                                    require("../SQL/connect.php");
                                    $sql = "SELECT * FROM category";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $row["id_category"] ?>"><?php echo $row["name_category"] ?></option>
                                    <?php
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="Thêm" class="bntAdd" name="bntAdd">
                    <a href="category.php?id=category">Hủy</a>
                </form>
            </div>
        </div>

    </div>
    <script src="./Js/main.js"></script>
</body>

</html>