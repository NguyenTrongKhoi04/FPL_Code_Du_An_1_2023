<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">ADMIN</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="AdminController.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Trang chủ</span>
    </a>
    <a class="nav-link" href="<?=$adminAction?>dangxuat">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Đăng Xuất</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    DANH SÁCH
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Tài Khoản</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quản Lý Tài Khoản</h6>
            <a class="collapse-item" href="cards.html">Danh Sách Tài Khoản</a>
            <a class="collapse-item" href="buttons.html">Thêm Tài Khoản</a>

            <h6 class="collapse-header">Giỏ hàng-Bill-Comment</h6>
            <a class="collapse-item" href="buttons.html">Danh Sách Giỏ Hàng</a>
            <a class="collapse-item" href="buttons.html">Danh Sách Comment</a>
            <a class="collapse-item" href="buttons.html">Danh Sách Bill</a>

        </div>
    </div>
    
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Quản lý đồ ăn</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
    data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Product</h6>
            <a class="collapse-item" href="<?=$adminAction?>ListProduct">Danh sách món ăn</a>
            <a class="collapse-item" href="utilities-color.html">Thêm món ăn</a>
            <h6 class="collapse-header">Danh mục</h6>
            <a class="collapse-item" href="utilities-color.html">Danh mục chính</a>
            <a class="collapse-item" href="utilities-color.html">Thêm danh mục chính </a>
            <a class="collapse-item" href="utilities-color.html">Danh mục phụ</a>
            <a class="collapse-item" href="utilities-color.html">Thêm danh mục phụ</a>
            <h6 class="collapse-header">Size</h6>
            <a class="collapse-item" href="utilities-border.html">Size</a>
            <a class="collapse-item" href="utilities-border.html">Thêm size</a>
            <a class="collapse-item" href="utilities-border.html">Size default</a>
            <a class="collapse-item" href="utilities-border.html">Thêm size default</a>
            <h6 class="collapse-header">Pro-Details</h6>
            <a class="collapse-item" href="utilities-animation.html">Details</a>
            <a class="collapse-item" href="utilities-other.html">Thêm Details</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Bàn ăn</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Orders</h6>
            <a class="collapse-item" href="utilities-animation.html">Danh sách Order</a>
            <a class="collapse-item" href="utilities-other.html">Danh Sách Order phụ</a>
            </div>
    </div>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Thống kê
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Bil</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
    </div>
    
</li>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item active">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>