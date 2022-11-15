<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:../Login/login.php");
}
?>
<?php
require("../SQL/connect.php");
if (isset($_POST['submit'])) {
    $file = $_FILES["filename"];
    $file_arr = $file['name'];

    $size_allow = 10; // Tối đa 10MB
    $ext_allow = ['jpg', 'jpeg', 'png', 'jfif']; // Định dạng cho phép
    $errors = []; // Lấy lỗi của mỗi file
    $count = 0; // Số file đã được tải
    $name_file = []; // tên lưu vào csdl
    $mess = ''; // thông báo lỗi file ra span
    if (empty($file_arr[0])) {
        $mess = 'Vui lòng chọn file để tải!';
    } else {
        foreach ($file_arr as $key => $item) {
            $ext = explode('.', $item)[1];

            $new_file = md5(uniqid());

            $new_file .= '.' . $ext;
            $name_file[$key] = $new_file;

            $size = $file['size'][$key];

            $size = $size / 1024 / 1024;

            $file_tmp = $file['tmp_name'][$key];

            if (in_array($ext, $ext_allow)) {
                if ($size <= $size_allow) {
                    $upload = @move_uploaded_file($file_tmp, "../Image/product/" . $new_file);
                    if (!$upload) {
                        $errors[][$key] = "Tải file thất bại";
                    } else {
                        $count++;
                    }
                } else {
                    $errors[][$key] = "size_error";
                }
            } else {
                $errors[][$key] = "ext_error";
            }
        }
    }
    if ($count > 0) {
        // echo "Đã tải thành công " . $count . " file";
        $name_tmp = '';
        for ($i = 0; $i < sizeof($name_file); $i++) {
            if ($i == sizeof($name_file) - 1) {
                $name_tmp .= $name_file[$i];
            } else {
                $name_tmp .= $name_file[$i] . '/';
            }
        }

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

        $sql = "INSERT INTO product(image_product,name_product,gender_product,price_product,
                oldprice_product,descript_product,conserve_product,quantity_product,brand_product,
                origin_product,material_product,designs_product,color_product,category_product) 
                VALUES('$name_tmp','$nameProduct','$gender',$price,$odlPrice,'$descript','$conserve',
                $quantity,'$brand','$origin','$material','$designs','$color',$category)";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            mysqli_close($conn);
            header("location:product.php?id=product");
        } else {
            echo "Cập nhật thất bại" . mysqli_error($conn);
        }
    } else {
        if (!empty($errors)) {
            foreach ($errors as $error) {
                foreach ($error as $index => $err_name) {
                    if ($err_name == 'ext_error') {
                        $mess .= "Định dạng không hợp lệ file: " . $file['name'][$index] . '<br/>';
                    } elseif ($err_name == 'size_error') {
                        $mess .= "Dung lượng file không được quá " . $size_allow . "MB kiểm tra file:" . $file['name'][$index] . '<br/>';
                    } else {
                        $mess .= "Tải file thất bại" . $file['name'][$index] . '<br/>';
                    }
                }
            }
            // if (!empty($mess)) {
            //     echo $mess;
            // }
        }
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
    <div class="container">
        <?php
        include("../Include/menu.php");
        include("../Include/header.php");
        ?>
        <div class="breadcrumb-bar">
            <div class="container">
                <?php
                echo "<a href='/admin/'>Trang chủ</a>";
                echo "<a href='product.php?id=product'>Sản phẩm</a>";
                if ($_GET['id'] == 'addProduct') {
                    echo "<a href='?id=addProduct'>Thêm sản phẩm</a>";
                }
                ?>
            </div>
        </div>
        <div class="product">
            <div class="main_product">
                <div class="mainAdd_product">
                    <h2>Thêm sản phẩm</h2>
                    <form action="" enctype="multipart/form-data" method="POST">
                        <div class="form_field">
                            <label for="">Hình ảnh:</label>
                            <input type="file" name="filename[]" multiple>
                            <span style="padding: 0 15px; color:red"><?php if (!empty($mess)) {
                                                                            echo $mess;
                                                                        } ?></span>
                        </div>
                        <div class="form_field">
                            <label for="">Tên sản phẩm:</label>
                            <input type="text" name="name" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form_field">
                            <label for="">Giới tính:</label>
                            <select name="gender" id="">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Unisex">Cả hai</option>
                            </select>
                        </div>
                        <div class="form_field">
                            <label for="">Giá mới:</label>
                            <input type="number" name="price" placeholder="Nhập giá tiền mới">
                        </div>
                        <div class="form_field">
                            <label for="">Giá cũ:</label>
                            <input type="number" name="oldPrice" placeholder="Nhập giá tiền cũ">
                        </div>
                        <div class="form_field">
                            <label for="">Mô tả:</label>
                            <textarea name="descript" cols="30" rows="10" placeholder="Thêm mô tả"></textarea>
                        </div>
                        <div class="form_field">
                            <label for="">Hướng dẫn:</label>
                            <textarea name="conserve" cols="30" rows="10" placeholder="Thêm hướng dẫn"></textarea>
                        </div>
                        <div class="form_field">
                            <label for="">Số lượng:</label>
                            <input type="number" name="quantity" placeholder="Nhập số lượng">
                        </div>
                        <div class="form_field">
                            <label for="">Thương hiệu:</label>
                            <input type="text" name="brand" placeholder="Nhập thương hiệu">
                        </div>
                        <div class="form_field">
                            <label for="">Xuất xứ:</label>
                            <input type="text" name="origin" placeholder="Xuất xứ">
                        </div>
                        <div class="form_field">
                            <label for="">Chất liệu:</label>
                            <input type="text" name="material" placeholder="Chất liệu">
                        </div>
                        <div class="form_field">
                            <label for="">Thiết kế:</label>
                            <input type="text" name="designs" placeholder="Thiết kế">
                        </div>
                        <div class="form_field">
                            <label for="">Màu sắc:</label>
                            <input type="text" name="color" placeholder="Màu sắc">
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
                                    <option value="<?php echo $row['id_category'] ?>"><?php echo $row['name_category'] ?></option>
                                <?php
                                }
                                mysqli_close($conn);
                                ?>
                            </select>
                        </div>
                        <div class="bnt">
                            <input type="submit" name="submit" value="Thêm">
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