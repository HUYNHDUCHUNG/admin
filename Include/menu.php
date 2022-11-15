<div class="menu">
    <div class="logo-details">
        <i class="fa-brands fa-reddit"></i>
        <span class="logo_name" style="color: #fff;">New Balance</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="/admin/index.php">
                <i class='bx bx-grid-alt'></i>
                Trang chủ
            </a>
        </li>
        <li>
            <a href="/admin/Category/category.php?id=category">
                <i class='bx bx-collection'></i>
                Danh mục
            </a>
        </li>
        <li>
            <a href="/admin/Product/product.php?id=product">
                <i class='bx bx-book-alt'></i>
                Sản phẩm
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-pie-chart-alt-2'></i>
                Thống kê
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-line-chart'></i>
                Biểu đồ
            </a>
        <li>
        <li>
            <a href="#">
                <i class='bx bx-plug'></i>
                Quản trị
            </a>
            <i class='bx bxs-chevron-down arrow'></i>
        </li>
        <ul class="sub-menu">
            <li><a href="#">Người dùng</a></li>
            <li><a href="#">Quản trị viên</a></li>
            <li><a href="#">Bổ sung</a></li>
        </ul>
        <li>
            <a href="#">
                <i class='bx bx-compass'></i>
                Ứng dụng
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-history'></i>
                Lịch sử
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-cog'></i>
                Cài đặt
            </a>
        </li>
        <li>
            <div class="profile-details">
                <span>Xin chào! <?php echo $_SESSION["user"] ?> </span>
                <a href="/admin/Login/logout.php" onclick="return confirm('Bạn chắc chắn muốn đăng xuất!')"><i class='bx bx-log-out'></i></a>
            </div>
        </li>
    </ul>
</div>