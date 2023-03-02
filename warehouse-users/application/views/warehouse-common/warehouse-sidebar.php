<?php 
  $home = '';
  $werehouse = '';
  $gst = '';
  $unit = '';
  $product = '';
  $order = '';
  $payment_details = ''; 
  $blog = '';
  $testimonial = '';
  $subscribers = '';
  $feedback_get_in_touch = '';
  $product_rating = '';
   $loginlog ='';
   $coupon ='';
   $sales = '';
  if (strtolower(uri_string()) == 'admindashboard' || strtolower(uri_string()) == 'admin-panel') {
    $home = "active";
  }/* else if (strtolower(uri_string()) == 'warehouse-users' ) {
    $werehouse = 'active'; 
  } */else if (strtolower(uri_string()) == 'gst' ) {
    $gst = 'active'; 
  }else if (strtolower(uri_string()) == 'unit' ) {
    $unit = 'active'; 
  }else if (strtolower(uri_string()) == 'coupon' ) {
    $coupon = 'active'; 
  }else if(strtolower(uri_string()) == 'warehouse-product' || 
            strtolower(uri_string()) == 'product-category' || 
            strtolower(uri_string()) == 'warehouse-product-details' ||
            strtolower(uri_string()) == 'warehouseproduct/bulk_add_product'){
    $product ='active';
  }else if (strtolower(uri_string()) == 'SalesOrder' || strtolower(uri_string()) == 'SalesOrder/details') {
   $sales = 'active';
  } else {
    $home = 'active';
  }
$sessionData ='';
if ($this->session->userdata('logged_in_warehouse_user')) { 

  $sessionData = $this->session->userdata('logged_in_warehouse_user'); 
}
  $sidebar_expand_or_collapse = '';
  if ($this->session->userdata('sidebar_expand_or_collapse') == 'sidebar-collapse') {
    $sidebar_expand_or_collapse = ' sidebar-collapse';
  }
?>
<body class="sidebar-mini layout-fixed <?php echo $sidebar_expand_or_collapse;?>">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
       <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="sidebar-expand-close-bar"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <span class="nav-link header-left-description">Warehouse Panel</span>
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
          <span class="header-admin-greetings">Hi, <?php echo $sessionData['userName']?></span>
          <img src="<?php echo base_url()?>assets/dist/img/admin-img/dummy.svg" class="admin-img-hdr">
        </span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?/WareHouseLogin">
          <span class="header-admin-greetings logout-fa"><i class="fa fa-power-off" aria-hidden="true"></i></span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar">
    <!-- Brand Logo -->
    <a href="<?php echo base_url().'?/warehouse-panel' ?>" class="brand-link text-center" style="position: relative;width: 73px;">
      <!-- <img src="<?php echo base_url()?>assets/dist/img/sidebar-logo/sidebar-logo.png" alt="Logo" class="brand-image"> -->
       <span class="brand-link-span">Rover</span>
      <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
      </div>

      <!-- Sidebar Menu -->
      <nav class="custom-sidebar-nav-menu">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php 
            if($sessionData['role'] == 'add_product_user'){
          ?>
          <!-- <li class="nav-item sidebar-nav-item-mrgn" title="Dashboard">
            <a href="?/warehouse-panel" class="sidebar-nav nav-link text-center <?php echo $home; ?>">
              <i class="fa fa-home"></i>
            </a>
          </li> -->
        
         <?php 
            }else{ ?>
          <li class="nav-item sidebar-nav-item-mrgn" title="Dashboard">
            <a href="?/warehouse-panel" class="sidebar-nav nav-link text-center <?php echo $home; ?>">
              <!-- <i class="fa fa-home"></i> -->
                <i class="fa fa-home"></i>
              <p class="sidebar-nav-link-name">Dashboard</p>
            </a>
          </li>
          <?php  }
            if($sessionData['role'] == 'add_product_user'){
          ?>
          <li class="nav-item sidebar-nav-item-mrgn" title="Product Details">
            <a href="?/warehouse-product" class="sidebar-nav nav-link text-center <?php echo $product; ?>">
              <!-- <i class="fa fa-product-hunt"></i> -->
                <i class="fa fa-product-hunt"></i>
              <p class="sidebar-nav-link-name">Product Details</p>
            </a>
          </li>
           <?php 
            }
            if($sessionData['role'] == 'add_product_userd'){
          ?>
          </li>
           <li class="nav-item sidebar-nav-item-mrgn" title="Coupon">
            <a href="?/coupon" class="sidebar-nav nav-link text-center <?php echo $coupon; ?>">
              <!-- <i class="fa fa-credit-card"></i> -->
                <i class="fa fa-credit-card"></i>
              <p class="sidebar-nav-link-name">Coupon</p>
            </a>
          </li>
           <?php 
            }
            if($sessionData['role'] == 'salesuser'){
          ?>
           <li class="nav-item sidebar-nav-item-mrgn" title="Product Sales">
            <a href="?/SalesOrder/" class="sidebar-nav nav-link text-center <?php echo $sales; ?>">
              <!-- <i class="fa fa-star"></i> -->
                <i class="fa fa-star"></i>
              <p class="sidebar-nav-link-name">Product Sales</p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>