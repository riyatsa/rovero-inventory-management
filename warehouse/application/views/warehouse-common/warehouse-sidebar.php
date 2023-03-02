<?php 
  $home = '';
  $werehouse = '';
  $gst = '';
  $unit = '';
  $product = '';
  $purchaseOrder = '';
  $vendors = ''; 
  $sales = '';
  $testimonial = '';
  $subscribers = '';
  $feedback_get_in_touch = '';
  $product_rating = '';
  $loginlog ='';
  $coupon ='';
  $sales_order = '';
  $store = '';
  $report = '';
   $customer ='';
  if (strtolower(uri_string()) == 'admindashboard' || strtolower(uri_string()) == 'admin-panel') {
    $home = "active";
  } else if (strtolower(uri_string()) == 'warehouse-users' ) {
    $werehouse = 'active'; 
  } else if (strtolower(uri_string()) == 'gst' ) {
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
  }else if (strtolower(uri_string()) == 'vendor' ||
            strtolower(uri_string()) == 'vendor/vendorlist') {
    $vendors = 'active'; 
  }else if (strtolower(uri_string()) == 'purchaseorder' || 
            strtolower(uri_string()) == 'purchaseorder/purchsedetails' ||
            strtolower(uri_string()) == 'purchase0rder/storepurchsedetails') {
    $purchaseOrder = 'active'; 
  }else if (strtolower(uri_string()) == 'sales' || 
            strtolower(uri_string()) == 'salesorder' || 
            strtolower(uri_string()) == 'salesorder/sales_details') {
    $sales = 'active'; 
  }else if (strtolower(uri_string()) == 'store-product') {
    $store = 'active'; 
  }
  else if (strtolower(uri_string()) == 'salereport') {
    $report = 'active'; 
  }else if(strtolower(uri_string()) == 'customer' || strtolower(uri_string()) == 'customer/customerlist'){
    $customer ='active';
  }
  else {
    $home = 'active';
  }
$sessionData ='';
if ($this->session->userdata('logged_in_warehouse')) { 

  $sessionData = $this->session->userdata('logged_in_warehouse'); 
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
          <span id="notificationCount"class="badge badge-info navbar-badge"></span>
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

       <li id="notifications-d_1" class="nav-item dropdown">
        <a class="nav-link nav-link-notification" data-toggle="dropdown" href="#">
          <i class="fa fa-bell fa-bell-notification"></i>
          <span id="notificationCount_1"class="badge badge-info navbar-badge"></span>
        </a>
        <div id="dropdown-menu_1" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

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
          <span class="header-admin-greetings">Hi, <?php echo $session = $sessionData['warehouseName'] ? $sessionData['warehouseName'] : '' ; ?></span>
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
      <!-- <img class="w-100" src="<?php echo base_url()?>assets/dist/img/sidebar-logo/001.jpg" alt="Logo" class="brand-image"> -->
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
          <li class="nav-item sidebar-nav-item-mrgn" title="Dashboard">
            <a href="?/warehouse-panel" class="sidebar-nav nav-link <?php echo $home; ?>">
              <!-- <i class="fa fa-home"></i> -->
               <i class="fa fa-home"></i>
              <p class="sidebar-nav-link-name">Dashboard</p>
            </a>
          </li>
          <li class="nav-item sidebar-nav-item-mrgn" title="Product Details">
            <a href="?/warehouse-product" class="sidebar-nav nav-link <?php echo $product; ?>">
              <!-- <i class="fa fa-product-hunt" aria-hidden="true"></i> -->
               <i class="fa fa-product-hunt"></i>
              <p class="sidebar-nav-link-name">Product Details</p>
            </a>
          </li>

          <li class="nav-item sidebar-nav-item-mrgn" title="purchase Order">
            <a href="?/purchaseOrder" class="sidebar-nav nav-link <?php echo $purchaseOrder; ?>">
              <!-- <i class="fa fa-shopping-cart" aria-hidden="true"></i> -->
              <i class="fa fa-shopping-cart"></i>
              <p class="sidebar-nav-link-name">purchase Order</p>
            </a>
          </li>
          
          <li class="nav-item sidebar-nav-item-mrgn" title="Sales Order">
            <a href="?/SalesOrder" class="sidebar-nav nav-link <?php echo $sales; ?>">
              <!-- <i class="fas fa-clipboard"></i> -->
              <i class="fas fa-clipboard"></i>
              <p class="sidebar-nav-link-name">Sales Order</p>
            </a>
          </li>

          <li class="nav-item sidebar-nav-item-mrgn" title="GST Details">
            <a href="?/GST" class="sidebar-nav nav-link <?php echo $gst; ?>">
             <!-- <i class="fa fa-percent"></i> -->
             <i class="fa fa-percent"></i>
              <p class="sidebar-nav-link-name">GST Details</p>
            </a>
          </li>
         <li class="nav-item sidebar-nav-item-mrgn" title="Unit">
            <a href="?/unit/" class="sidebar-nav nav-link <?php echo $unit; ?>">
              <!-- <i class="fa fa-balance-scale"></i> -->
              <i class="fa fa-balance-scale"></i>
              <p class="sidebar-nav-link-name">Unit</p>
            </a>
          </li>
           <li class="nav-item sidebar-nav-item-mrgn" title="Add ware house User">
            <a href="?/warehouse-users/" class="sidebar-nav nav-link <?php echo $werehouse; ?>">
              <!-- <i class="fas fa-warehouse fa fa-user"></i> -->
              <i class="fas fa-warehouse fa fa-user"></i>
              <p class="sidebar-nav-link-name">warehouse User</p>
            </a>
          </li>
          <li class="nav-item sidebar-nav-item-mrgn" title="Customer">
            <a href="?/customer" class="sidebar-nav nav-link <?php echo $customer; ?>">
            <!-- <i class="fa fa-users" aria-hidden="true"></i> -->
            <i class="fa fa-users"></i>
              <p class="sidebar-nav-link-name">Customer</p>
            </a>
          </li>
          <!-- <li class="nav-item sidebar-nav-item-mrgn" title="Coupon">
            <a href="?/coupon" class="sidebar-nav nav-link <?php echo $coupon; ?>">
              <i class="fa fa-credit-card"></i>
            </a>
          </li> -->
          <li class="nav-item sidebar-nav-item-mrgn" title="vendors">
            <a href="?/vendor" class="sidebar-nav nav-link <?php echo $vendors; ?>">
              <!-- <i class="fa fa-industry"></i> -->
              <i class="fa fa-industry"></i>
              <p class="sidebar-nav-link-name">vendors</p>
            </a>
          </li>
          

           <li class="nav-item sidebar-nav-item-mrgn" title="Store Product">
            <a href="?/store-product" class="sidebar-nav nav-link <?php echo $store; ?>">
              <!-- <i class="fa fa-newspaper-o"></i> -->
              <i class="fa fa-newspaper-o"></i>
              <p class="sidebar-nav-link-name">Store Product</p>
            </a>
          </li>

           <li class="nav-item sidebar-nav-item-mrgn" title="Report">
            <a href="?/saleReport" class="sidebar-nav nav-link <?php echo $report; ?>">
              <!-- <i class="fa fa-file-excel-o"></i> -->
              <i class="fa fa-file-excel-o"></i>
              <p class="sidebar-nav-link-name">Report</p>
            </a>
          </li>

         <!-- <li class="nav-item sidebar-nav-item-mrgn" title="Customers">
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
  <script src="<?php echo base_url()?>assets/customeJS/warehouse/notificationJS.js"></script>