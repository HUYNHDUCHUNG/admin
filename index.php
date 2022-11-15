<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <!-- box icon linl -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- fontawesom link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("location:./Login/login.php");
    }
    ?>
    <div class="container">
        <?php
        include("./Include/menu.php");
        include("./Include/header.php");
        ?>
        <div class="breadcrumb-bar">
            <div class="container">
                <?php
                echo "<a href='./'>Trang chủ</a>";
                ?>
            </div>
        </div>
        <div class="home-page">
            <div class="page-top">
                <div class="page-top-left">
                    <img src="./Image/circle.png" alt="">
                    <h3>Doanh thu hàng tháng <i class="fas fa-chart-bar"></i></h3>
                    <h2>500.000.000 VND</h2>
                    <p>Giảm 50%</p>
                </div>
                <div class="page-top-mid">
                    <img src="./Image/circle.png" alt="">
                    <h3>Đơn hàng tháng <i class="fas fa-bookmark"></i></h3>
                    <h2>5000</h2>
                    <p>Giảm 10%</p>
                </div>
                <div class="page-top-right">
                    <img src="./Image/circle.png" alt="">
                    <h3>Khách truy cập trực tuyến <i class="far fa-gem"></i></h3>
                    <h2>500</h2>
                    <p>Tăng 5%</p>
                </div>
            </div>
            <div class="page-bottom">
                <div class="page-bottom-left">
                    <div class="header">
                        <h3>Truy cập và thông kê bán hàng</h3>
                        <ul>
                            <li><span class="temp"></span>Miền bắc</li>
                            <li><span class="temp"></span>Miền trung</li>
                            <li><span class="temp"></span>Miền nam</li>
                        </ul>
                    </div>
                    <div class="footer">
                        <div class="column"><span></span><span></span><span></span></div>
                        <div class="column"><span></span><span></span><span></span></div>
                        <div class="column"><span></span><span></span><span></span></div>
                        <div class="column"><span></span><span></span><span></span></div>
                        <div class="column"><span></span><span></span><span></span></div>
                        <div class="column"><span></span><span></span><span></span></div>
                        <div class="column"><span></span><span></span><span></span></div>
                        <div class="column"><span></span><span></span><span></span></div>
                        <div class="month">
                            <span class="item">JAN</span>
                            <span class="item">FEB</span>
                            <span class="item">MAR</span>
                            <span class="item">APR</span>
                            <span class="item">MAY</span>
                            <span class="item">JUN</span>
                            <span class="item">JUL</span>
                            <span class="item">AUG</span>
                        </div>
                    </div>

                </div>
                <div class="page-bottom-right">
                    <h3>Nguồn lưu lượng</h3>
                    <div class="flex-circle">
                        <div class="circle">
                        </div>
                    </div>

                    <ul>
                        <li><span class="temp"></span> Công cụ tìm kiếm</li>
                        <li><span class="temp"></span>Nhấp trực tiếp</li>
                        <li><span class="temp"></span>Nhấp dấu trang</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <script src="./Js/main.js"></script>
</body>

</html>