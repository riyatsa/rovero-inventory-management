<?php 
  $home = '';
  $werehouse = '';
  $store = '';
  $vendor = '';
  $product = '';
  $order = '';
  $payment_details = ''; 
  $blog = '';
  $testimonial = '';
  $subscribers = '';
  $feedback_get_in_touch = '';
  $product_rating = '';
  $loginLogs ='';
  $coupon = ''; 
  if (strtolower(uri_string()) == 'admindashboard' || strtolower(uri_string()) == 'admin-panel') {
    $home = "active";
  } else if (strtolower(uri_string()) == 'ware-house' ||
            strtolower(uri_string()) == 'warehouse-details') {
    $werehouse = 'active'; 
  }else if (strtolower(uri_string()) == 'store' || strtolower(uri_string()) == 'store/storelist') {
    $store = 'active'; 
  }else if(strtolower(uri_string()) == 'loginlogs'){
    $loginLogs ='active';
  }
  else if (strtolower(uri_string()) == 'vendor' || strtolower(uri_string()) == 'vendor/vendorlist') {
    $vendor = 'active'; 
  }else if (strtolower(uri_string()) == 'productlist/details') {
    $product = 'active'; 
  }else if (strtolower(uri_string()) == 'coupon') {
    $coupon = 'active';  
  }else {
    $home = 'active';
  }

  $sidebar_expand_or_collapse = '';
  if ($this->session->userdata('sidebar_expand_or_collapse') == 'sidebar-collapse') {
    $sidebar_expand_or_collapse = ' sidebar-collapse';
  }
?>
<body class="sidebar-mini layout-fixed<?php echo $sidebar_expand_or_collapse;?>">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="sidebar-expand-close-bar"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <span class="nav-link header-left-description">Admin Panel</span>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li id="notifications-d" class="nav-item dropdown">
        <a class="nav-link nav-link-notification" data-toggle="dropdown" href="#">
          <i class="fa fa-bell fa-bell-notification"></i>
          <span id="notificationCount"class="badge badge-danger navbar-badge"></span>
        </a>
        <div id="dropdown-menu" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <!-- <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a> -->
          
        </div>
        <!-- <div class="dropdown-divider"></div> -->
          <!-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
      </li>
      <li class="nav-item">
        <span class="nav-link pt-1 pr-1 pl-5">
          <span class="header-admin-greetings">Hi Admin</span>
          <img src="<?php echo base_url()?>assets/dist/img/admin-img/dummy.svg" class="admin-img-hdr">
        </span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?/adminLogin">
          <span class="header-admin-greetings logout-fa"><i class="fa fa-power-off" aria-hidden="true"></i></span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar">
    <!-- Brand Logo -->
    <a href="<?php echo base_url().'?/admin-panel' ?>" class="brand-link text-center">
      <!-- <img class="w-100" src="<?php echo base_url()?>assets/dist/img/sidebar-logo/001.jpg" alt="Logo" class="brand-image"> --> 
      <span class="brand-link-span">Rover</span>  
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
      </div>

      <!-- Sidebar Menu -->
      <nav class="custom-sidebar-nav-menu">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item sidebar-nav-item-mrgn" title="Dashboard">
            <a href="?/admin-panel" class="sidebar-nav nav-link <?php echo $home; ?>">
              <i class="fas fa-home"></i></span>
              <p class="sidebar-nav-link-name">Dashboard</p>
            </a>
          </li>
          <li class="nav-item sidebar-nav-item-mrgn" title="Warehouse Details">
            <a href="?/ware-house" class="sidebar-nav nav-link <?php echo $werehouse; ?>">
              <i class="fas fa-warehouse"></i>
              <p class="sidebar-nav-link-name">Warehouse Details</p>
            </a>
          </li>
          <li class="nav-item sidebar-nav-item-mrgn" title="Store Details">
            <a href="?/store" class="sidebar-nav nav-link <?php echo $store; ?>">
              <i class="fas fa-store"></i>
              <p class="sidebar-nav-link-name">Store Details</p>
            </a>
          </li>
          
          <li class="nav-item sidebar-nav-item-mrgn" title="Vendors">
            <a href="?/vendor" class="sidebar-nav nav-link <?php echo $vendor; ?>">
              <i class="fas fa-industry"></i>
              <p class="sidebar-nav-link-name">Vendors</p>
            </a>
          </li>

          <li class="nav-item sidebar-nav-item-mrgn" title="Login Logs">
            <a href="?/loginLogs" class="sidebar-nav nav-link <?php echo $loginLogs; ?>">
              <i class="fas fa-history"></i>
              <p class="sidebar-nav-link-name">Login Logs</p>
            </a>
          </li>

          <li class="nav-item sidebar-nav-item-mrgn" title="Product">
            <a href="?/ProductList/details" class="sidebar-nav nav-link <?php echo $product; ?>">
              <i class="fab fa-product-hunt"></i>
              <p class="sidebar-nav-link-name">Product</p>
            </a>
          </li>

          <li class="nav-item sidebar-nav-item-mrgn" title="Coupon">
            <a href="?/coupon" class="sidebar-nav nav-link <?php echo $coupon; ?>">
              <i class="fas fa-credit-card"></i>
              <p class="sidebar-nav-link-name">Coupon</p>
            </a>
          </li>
       <!--     <li class="nav-item sidebar-nav-item-mrgn" title="Blogs">

            <a href="?/blog/addblog" class="sidebar-nav nav-link <?php echo $blog; ?>">
              <i class="fa fa-newspaper-o"></i>
            </a>
          </li>
          <li class="nav-item sidebar-nav-item-mrgn" title="Customers">
            <a href="?/customer" class="sidebar-nav nav-link <?php echo $customer; ?>">
              <i class="fa fa-users"></i>
            </a>
          </li>
          <li class="nav-item sidebar-nav-item-mrgn" title="Testimonials">
            <a href="?/testimonial" class="sidebar-nav nav-link <?php echo $testimonial; ?>">
              <i class="fa fa-quote-left"></i>
            </a>
          </li>
          <li class="nav-item sidebar-nav-item-mrgn" title="Subscribers">
            <a href="?/customer/subscribers" class="sidebar-nav nav-link <?php echo $subscribers; ?>">
              <i class="fa fa-envelope"></i>
            </a>
          </li>
          <li class="nav-item sidebar-nav-item-mrgn" title="Get in Touch(Feedback)">
            <a href="?/customer/feedback" class="sidebar-nav nav-link <?php echo $feedback_get_in_touch; ?>">
              <i class="fa fa-comments-o"></i>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>