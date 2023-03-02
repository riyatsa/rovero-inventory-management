<?php 
  $home = '';
  $werehouse = '';
  $gst = '';
  $unit = '';
  $product = '';
  $order = '';
  $customer = ''; 
  $loginlog ='';
  $coupon = '';
  $report = '';
  // echo uri_string();
  if (strtolower(uri_string()) == 'admindashboard' || strtolower(uri_string()) == 'admin-panel') {
    $home = "active";
  } else if (strtolower(uri_string()) == 'storeorder/details' || strtolower(uri_string()) == 'storeorder') {
    $werehouse = 'active'; 
  } else if (strtolower(uri_string()) == 'storebilling/details' || strtolower(uri_string()) == 'storebilling' ) {
    $order = 'active'; 
  }else if (strtolower(uri_string()) == 'unit' ) {
    $unit = 'active'; 
  }else if(strtolower(uri_string()) == 'productlist/details'|| strtolower(uri_string()) == 'storeproduct'){
    $product ='active';
  }else if(strtolower(uri_string()) == 'coupon'){
    $coupon ='active';
  }else if(strtolower(uri_string()) == 'customer' || strtolower(uri_string()) == 'customer/customerlist'){
    $customer ='active';
  }else if(strtolower(uri_string()) == 'salereport'){
    $report ='active';
  }else {
    $home = 'active';
  }

$sessionData ='';
if ($this->session->userdata('logged_in_store_user')) { 

  $sessionData = $this->session->userdata('logged_in_store_user'); 
  // print_r($sessionData);
}
  $path = '';
  if($sessionData['role'] != 'add_product_user'){
    $path = '?/StoreBilling';
  }else{
    $path = '?/ProductList/details';
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
        <span class="nav-link header-left-description">Outlet Panel</span>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <?php 
            if($sessionData['role'] != 'add_product_user'){
      ?>
      <li class="nav-item mt-2">
        <a class="btn btn-danger" href="?/StoreBilling">Add Billing</a>
      </li>
       <?php
            }
          ?>
      <!-- Notifications Dropdown Menu -->
     <!--  <li id="notifications-d" class="nav-item dropdown">
        <a class="nav-link nav-link-notification" data-toggle="dropdown" href="#">
          <i class="fa fa-bell fa-bell-notification"></i>
          <span id="notificationCount"class="badge badge-danger navbar-badge"></span>
        </a>
        <div id="dropdown-menu" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
 -->
          <!-- <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a> -->
          
        <!-- </div> -->
        <!-- <div class="dropdown-divider"></div> -->
          <!-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
      <!-- </li> -->

      <li class="nav-item">
        <span class="nav-link pt-1 pr-1 pl-5">
          <span class="header-admin-greetings">Hi, <?php echo $sessionData['userName']?></span>
          <img src="<?php echo base_url()?>assets/dist/img/admin-img/dummy.svg" class="admin-img-hdr">
        </span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?/storeLogin">
          <span class="header-admin-greetings logout-fa"><i class="fa fa-power-off" aria-hidden="true"></i></span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar">
    <!-- Brand Logo -->
    <a href="<?php echo base_url().$path ?>" class="brand-link text-center" style="position: relative;width: 73px;">
      <!-- <img src="<?php echo base_url()?>assets/dist/img/sidebar-logo/001.jpg" alt="Logo" class="brand-image"> -->
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
          
    <!--       <li class="nav-item sidebar-nav-item-mrgn" title="Dashboard">
            <a href="<?php echo $path ;?>" class="sidebar-nav nav-link <?php echo $home; ?>">
              <i class="fa fa-home"></i>
            </a>
          </li> -->

          <?php 
            if($sessionData['role'] != 'add_product_user'){
          ?>
          <li class="nav-item sidebar-nav-item-mrgn" title="Store Billing">
            <a href="?/StoreBilling" class="sidebar-nav nav-link <?php echo $order; ?>">
             <!-- <i class="fas fa-clipboard"></i> -->
               <i class="fas fa-clipboard"></i>
              <p class="sidebar-nav-link-name">Store Billing</p>
            </a>
          </li>
          <?php
            }
          ?>
<!--           <li class="nav-item sidebar-nav-item-mrgn" title="Purchase Order">
            <a href="?/StoreOrder" class="sidebar-nav nav-link <?php echo $werehouse; ?>">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
          </li>
  -->
           <?php 
            if($sessionData['role'] == 'add_product_user'){
          ?>
          <li class="nav-item sidebar-nav-item-mrgn" title="Produt details">
            <a href="?/ProductList/details" class="sidebar-nav nav-link <?php echo $product; ?>">
              <!-- <i class="fa fa-product-hunt" aria-hidden="true"></i> -->
                 <i class="fa fa-product-hunt"></i>
              <p class="sidebar-nav-link-name">Produt details</p>

            </a>
          </li>
          <?php
            }
          ?>
         <!--  <li class="nav-item sidebar-nav-item-mrgn" title="Customer">
            <a href="?/customer" class="sidebar-nav nav-link <?php echo $customer; ?>">
            <i class="fa fa-user" aria-hidden="true"></i>
            </a>
          </li>

          <li class="nav-item sidebar-nav-item-mrgn" title="Coupon">
            <a href="?/coupon" class="sidebar-nav nav-link <?php echo $coupon; ?>">
              <i class="fa fa-credit-card"></i>
            </a>
          </li>

          <li class="nav-item sidebar-nav-item-mrgn" title="Reoprt">
            <a href="?/saleReport" class="sidebar-nav nav-link <?php echo $report; ?>">
              <i class="fa fa-file-excel-o"></i>
            </a>
          </li>
            -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>