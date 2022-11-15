<?php
$condition = '';
if (isset($_GET['searchCategory'])) {
    $name = $_GET["searchName"];
    $condition = " WHERE name_category LIKE '%$name%'";
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
    <?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("location:../Login/login.php");
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
                if ($_GET['id'] == 'category') {
                    echo "<a href='category.php?id=category'>Danh mục</a>";
                }
                ?>
            </div>
        </div>
        <div class="content">
            <div class="content-top">
                <div class="content-top-right">
                    <div class="search_form">
                        <form action="" method="GET">
                            <input type="hidden" name = "id" value="category">
                            <input type="text" placeholder="Tìm kiếm" name="searchName">
                            <input type="submit" name="searchCategory" value="Tìm">
                        </form>
                    </div>
                    <select name="" id="">
                        <option value="">Tên</option>
                        <option value="">STT</option>
                    </select>
                    <select name="" id="">
                        <option value="">Số hiển thị</option>
                    </select>
                </div>
                <button><a href="addCategory.php?id=addCategory"><i class="fas fa-plus"></i> Thêm</a></button>
            </div>
            <?php
            require("../SQL/connect.php");
            $sql = "SELECT * FROM category $condition";
            $result = mysqli_query($conn, $sql)

            ?>
            <div class="content-bottom">
                <table>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>STT</th>
                        <th>Tên Danh mục</th>
                        <th>Danh mục cha</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><?php echo $row['id_category'] ?></td>
                            <td><?php echo $row['name_category'] ?></td>
                            <td><?php echo $row['parent_category'] ?></td>
                            <td><a href="updateCategory.php?id=updateCategory&key=<?php echo $row['id_category']; ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a href="deleteCategory.php?key=<?php echo $row['id_category']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa')"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    <?php
                    }
                    mysqli_close($conn);
                    ?>
                </table>
            </div>
        </div>

    </div>
    <script src="./Js/main.js"></script>
</body>

</html>