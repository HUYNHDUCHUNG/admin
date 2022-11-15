<?php
session_start();
?>
<?php
$id = $_GET["key"];
require("../SQL/connect.php");
$sql = "SELECT * FROM category WHERE id_category = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$parent = $row["parent_category"];
if (isset($_POST["bntUpdate"])) {
    $name = $_POST["name"];
    $parent = $_POST["parent"];
    $sql = "UPDATE category SET name_category = '$name', parent_category = '$parent' Where id_category = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        mysqli_close($conn);
        header("location:category.php?id=category");
    }
}
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
    <div class="container">
        <?php
        include("../Include/menu.php");
        include("../Include/header.php")
        ?>
        <div class="breadcrumb-bar">
            <div class="container">
                <?php
                echo "<a href='/admin/'>Trang chủ</a>";
                echo "<a href='category.php?id=category'>Danh mục</a>";
                if ($_GET['id'] == 'updateCategory') {
                    $key = $_GET['key'];
                    echo "<a href='?id=updateCategory&key=$key'>Sửa danh mục</a>";
                }
                ?>
            </div>
        </div>
        <div class="content">
            <div class="add-category">
                <h3>Sửa danh mục</h3>
                <hr>
                <form action="" method="POST">
                    <table>
                        <tr>
                            <td>Tên danh mục:</td>
                            <td><input type="text" value="<?php echo $row['name_category'] ?>" name="name"></td>
                        </tr>
                        <tr>
                            <td>Danh mục cha:</td>
                            <td>
                                <select name="parent">
                                    <option value="0">Không</option>
                                    <?php
                                    $sql = "SELECT * FROM category";
                                    // $sqlParent = "SELECT * FROM category Where id_category = $id";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $row["id_category"] ?>" <?php if ($row['id_category'] == $parent) echo "selected"; ?>><?php echo $row["name_category"] ?></option>
                                    <?php
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="Sửa" class="bntAdd" name="bntUpdate">
                    <a href="category.php?id=category">Hủy</a>
                </form>
            </div>
        </div>

    </div>
    <script src="./Js/main.js"></script>
</body>

</html>