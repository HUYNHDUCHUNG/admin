<?php
$condition = '';
if (isset($_GET['searchProduct'])) {
    $name = $_GET["searchName"];
    $condition = " WHERE name_product LIKE '%$name%' OR brand_product LIKE '%$name%'";
}
$order = '';
if(isset($_GET['order'])){
    if($_GET['order'] == 'priceDesc'){
        $order = " order by price_product DESC";
    }else if($_GET['order'] == 'priceAsc'){
        $order = " order by price_product ASC";
    }else if($_GET['order'] == 'quantityDesc'){
        $order = " order by quantity_product DESC";
    }else{
        $order = " order by quantity_product ASC";
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
                if ($_GET['id'] == 'product') {
                    echo "<a href='product.php?id=product'>Sản phẩm</a>";
                } 
                ?>
            </div>
        </div>
        <?php
            require("../SQL/connect.php");
            $sql = "SELECT * FROM product $condition $order";
            $result = mysqli_query($conn,$sql);
        ?>
        <div class="product">
            <div class="main_product">
                <div class="main_top">
                    <div class="filter_product">
                        <span>Điều kiện lọc</span>
                        <ul>
                            <li><a href="product.php?id=product&order=priceDesc">Giá tiền giảm dần</a></li>
                            <li><a href="product.php?id=product&order=priceAsc">Giá tiền tăng dần</a></li>
                            <li><a href="product.php?id=product&order=quantityDesc">Số lượng giảm dần</a></li>
                            <li><a href="product.php?id=product&order=quantityAsc">Số lượng tăng dần</a></li>
                        </ul>
                    </div>
                    <div class="search_form">
                        <form action="" method="GET">
                            <input type="hidden" name="id" value="product">
                            <input type="text" placeholder="Nhập từ khóa tìm kiếm sản phẩm,thương hiệu..." name="searchName">
                            <input type="submit" name="searchProduct" value="Tìm">
                        </form>
                    </div>
                    <button ><a href="addProduct.php?id=addProduct">Thêm sản phẩm</a></button>
                </div>
                <div class="main_bot">
                    <table>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th style="width: 120px;">Hình ảnh</th>
                            <th style="width: 200px; overflow: hidden;">Tên sản phẩm</th>
                            <th>Thương hiệu</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Danh mục</th>
                            <th>Tác vụ</th>
                        </tr>
                        <?php 
                            
                            while($row = mysqli_fetch_assoc($result)){
                                $img = explode('/',$row['image_product']);
                                $id = $row["category_product"];
                                $category = mysqli_query($conn,"SELECT * FROM category Where id_category = $id");
                                $name = mysqli_fetch_assoc($category)["name_category"];
                        ?>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><img src="../Image/product/<?=$img[0]?>" alt="" style="display: block; width: 100px; height: auto; margin: 0 auto; border-radius: 5px;"></td>
                            <td><?php echo $row['name_product']?></td>
                            <td><?php echo $row['brand_product']?></td>
                            <td><?php echo $row['price_product']?></td>
                            <td><?php echo $row['quantity_product']?></td>
                            <td><?php echo $name?></td>
                            <td>
                                <a href="updateProduct.php?id=updateProduct&key=<?php echo $row['id_product']?>"><i class="fas fa-edit"></i></a>
                                <a href="deleteProduct.php?key=<?php echo $row['id_product']?>" onclick="return confirm('Bạn chắc chắn muốn xóa sản phầm này')"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php
                            }
                            mysqli_close($conn);
                        ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script src="./Js/main.js"></script>
</body>

</html>