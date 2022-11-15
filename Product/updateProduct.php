<?php
$id = $_GET['key'];
require("../SQL/connect.php");
$sql = "SELECT * FROM product WHERE id_product = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$category = $row['category_product'];
$name_file = explode('/', $row['image_product']);

if (isset($_POST['submit'])) {
    $nameProduct = $_POST['name'];
    $gender = $_POST['gender'];
    $price = $_POST['price'];
    $odlPrice = $_POST['oldPrice'];
    $descript = $_POST['descript'];
    $conserve = $_POST['conserve'];
    $quantity = $_POST['quantity'];
    $brand = $_POST['brand'];
    $origin = $_POST['origin'];
    $material = $_POST['material'];
    $designs = $_POST['designs'];
    $color = $_POST['color'];
    $category = $_POST['category'];

    $sql = "UPDATE product SET name_product = '$nameProduct',gender_product = '$gender',price_product = $price,oldprice_product = $odlPrice,
                    descript_product = '$descript',conserve_product = '$conserve',quantity_product = $quantity,brand_product = '$brand',origin_product = '$origin',
                    material_product = '$material',designs_product = '$designs',color_product = '$color',category_product = $category WHERE id_product = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        mysqli_close($conn);
        header("location:product.php?id=product");
    } else {
        echo "Cap nhat that bai" . mysqli_error($conn);
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
    <link rel="stylesheet" href="../CSS/product.css">
    <!-- box icon linl -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- fontawesom link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("location:Login.php");
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
                echo "<a href='product.php?id=product'>Sản phẩm</a>";
                if ($_GET['id'] == 'updateProduct') {
                    $key = $_GET['key'];
                    echo "<a href='?id=updateProduct&key=$key'>Sửa sản phẩm</a>";
                }
                ?>
            </div>
        </div>
        <div class="product">
            <div class="main_product">
                <div class="mainAdd_product">
                    <h2>Sửa thông tin sản phẩm</h2>
                    <form action="" enctype="multipart/form-data" method="POST">
                        <div class="image_product">
                            <label for="">Hình ảnh:</label>
                            <div class="show_img">
                                <?php
                                foreach ($name_file as $item) {
                                ?>
                                    <div class="img"><img src="../Image/product/<?php echo $item ?>" alt="" style="display: block; width: 100px; height: auto; margin: 0 auto; border-radius: 5px;"></div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form_field">
                            <label for="">Tên sản phẩm:</label>
                            <input type="text" name="name" value="<?php echo $row['name_product'] ?>">
                        </div>
                        <div class="form_field">
                            <label for="">Giới tính:</label>
                            <select name="gender" id="">
                                <option value="Nam" <?php if ($row['gender_product'] == 'Nam') echo 'selected' ?>>Nam</option>
                                <option value="Nữ" <?php if ($row['gender_product'] == 'Nữ') echo 'selected' ?>>Nữ</option>
                                <option value="Unisex" <?php if ($row['gender_product'] == 'Unisex') echo 'selected' ?>>Cả hai</option>
                            </select>
                        </div>
                        <div class="form_field">
                            <label for="">Giá mới:</label>
                            <input type="number" name="price" value="<?php echo $row['price_product'] ?>">
                        </div>
                        <div class="form_field">
                            <label for="">Giá cũ:</label>
                            <input type="number" name="oldPrice" value="<?php echo $row['oldprice_product'] ?>">
                        </div>
                        <div class="form_field">
                            <label for="">Mô tả:</label>
                            <textarea name="descript" cols="30" rows="10"><?php echo $row['descript_product'] ?></textarea>
                        </div>
                        <div class="form_field">
                            <label for="">Hướng dẫn:</label>
                            <textarea name="conserve" cols="30" rows="10"><?php echo $row['conserve_product'] ?></textarea>
                        </div>
                        <div class="form_field">
                            <label for="">Số lượng:</label>
                            <input type="number" name="quantity" value="<?php echo $row['quantity_product'] ?>">
                        </div>
                        <div class="form_field">
                            <label for="">Thương hiệu:</label>
                            <input type="text" name="brand" value="<?php echo $row['brand_product'] ?>">
                        </div>
                        <div class="form_field">
                            <label for="">Xuất xứ:</label>
                            <input type="text" name="origin" value="<?php echo $row['origin_product'] ?>">
                        </div>
                        <div class="form_field">
                            <label for="">Chất liệu:</label>
                            <input type="text" name="material" value="<?php echo $row['material_product'] ?>">
                        </div>
                        <div class="form_field">
                            <label for="">Thiết kế:</label>
                            <input type="text" name="designs" value="<?php echo $row['designs_product'] ?>">
                        </div>
                        <div class="form_field">
                            <label for="">Màu sắc:</label>
                            <input type="text" name="color" value="<?php echo $row['color_product'] ?>">
                        </div>
                        <div class="form_field">
                            <label for="">Danh mục:</label>
                            <select name="category">
                                <?php
                                require("../SQL/connect.php");
                                $sql = "SELECT * FROM category";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option value="<?php echo $row['id_category'] ?>" <?php if ($category == $row['id_category']) echo 'selected' ?>><?php echo $row['name_category'] ?></option>
                                <?php
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                        </div>
                        <div class="bnt">
                            <input type="submit" name="submit" value="Sửa">
                            <a href="product.php?id=product">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        // <i class='bx bxs-chevron-up'></i>
        let downList = document.querySelectorAll(".arrow");
        let subMenu = document.querySelectorAll(".sub-menu");
        downList.forEach(function(item, index) {
            item.addEventListener("click", function() {
                subMenu[index].classList.toggle("active");
                item.classList.toggle("bxs-chevron-up");
            })
        })
    </script>
</body>

</html>