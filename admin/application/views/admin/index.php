      
 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="<?php echo base_url()?>?/adminDashboard" class="header-left-tab-a">Admin Panel / </a>
              <span class="header-left-tab-span">Dashboard</span>
            </label>
          </div>
        </div>
      </div>
    </div>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
           
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-product-hunt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Product</span>
                <span class="info-box-number"><?php echo $warehouseproduct;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <div class="row">
                  <div class="col-sm-6">
                    <span class="info-box-text">Sales Order</span>
                    <span class="info-box-number"><?php echo $warehouse_sales_order;?></span>
                  </div>
                  <div class="col-sm-6">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number"><i class="fa fa-rupee"></i><?php
                        if($total_sales['total_sales']!=''){
                          echo round($total_sales['total_sales'],2)."/-";  
                        }else{
                          echo"0/-";  
                        } 
                        ?></span>
                  </div>
                </div> 
               <!--  <span class="info-box-text">Sales</span>
                <span class="info-box-number"><?php echo $sales;?></span> -->
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-shopping-basket"></i></span>

              <div class="info-box-content">
                <div class="row">
                  <div class="col-sm-6">
                    <span class="info-box-text">Purchase Order</span>
                    <span class="info-box-number"><?php echo $warehouse_purchase_order;?></span>
                  </div>
                  <div class="col-sm-6">
                    <span class="info-box-text">Purchase</span>
                    <span class="info-box-number"><i class="fa fa-rupee"></i><?php
                        if($total_purchase['total']!=''){

                          echo round($total_purchase['total'],2)."/-";  
                        }else{
                          echo"0/-";  
                        } 
                        ?></span>
                  </div>
                </div> 
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div> 
      
      <div class="row">
          <!-- Total sales -->
          <div class="col-md-6">
             <div class="card">
              <div class="card-header card-kpi">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="card-title pt-2"><span class="analytics-title">Total Sales</span></h3>
                  </div>
                  <div class="col-md-8 text-right">
                    <select class="form-control d-inline kip-select" id="total_sales_select_time_store" onchange="get_total_sales()">
                      <option value="all">ALL</option>
                     <?php 
                     foreach ($store as $key => $value) {
                       echo "<option value='".$value['storeId']."'>".$value['storeName']."</option>";
                     }
                     ?>
                    </select>
                     <select class="form-control d-inline kip-select" id="total_sales_select_time" onchange="get_total_sales()">
                      <option value="all">All</option>
                      <option value="today">Today</option>
                      <option value="this_week">This Week</option>
                      <option value="this_month">This month</option>
                      <option value="three_month">Last 3 month</option>
                      <option value="six_month">Last 6 month</option>
                      <option value="this_year">This year</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center text-success total-sales" id="total_sales_count"></div>
              </div>
            </div>
          </div>
          <!-- END: total sales -->
          <!-- total purchase -->
                    <div class="col-md-6">
            <div class="card">
              <div class="card-header card-kpi">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="card-title pt-2"><span class="analytics-title">Average Sales Order Value</span></h3>
                  </div>
                  <div class="col-md-8 text-right">
                    <select class="form-control d-inline kip-select" id="avg_order_value_select_time_store" onchange="get_average_order_value()">
                      <option value="all">ALL</option>
                     <?php 
                     foreach ($store as $key => $value) {
                       echo "<option value='".$value['storeId']."'>".$value['storeName']."</option>";
                     }
                     ?>
                    </select>
                    <select class="form-control d-inline kip-select" id="avg_order_value_select_time" onchange="get_average_order_value()">
                      <option value="all">All</option>
                      <option value="today">Today</option>
                      <option value="this_week">This Week</option>
                      <option value="this_month">This month</option>
                      <option value="three_month">Last 3 month</option>
                      <option value="six_month">Last 6 month</option>
                      <option value="this_year">This year</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center text-success total-sales" id="avergare-order-sales"></div>
              </div>
            </div>
          </div>
          <!-- total purchase -->
        </div>
        
        <!-- purchase -->

        <div class="row">
          <!-- Total sales -->
          <div class="col-md-6">
             <div class="card">
              <div class="card-header card-kpi">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="card-title pt-2"><span class="analytics-title">Total Purchase</span></h3>
                  </div>
                  <div class="col-md-8 text-right">
                    <select class="form-control d-inline kip-select" id="total_purchase_select_time_store" onchange="get_total_purchase()">
                      <option value="all">ALL</option>
                     <?php 
                     foreach ($store as $key => $value) {
                       echo "<option value='".$value['storeId']."'>".$value['storeName']."</option>";
                     }
                     ?>
                    </select>
                    <select class="form-control d-inline kip-select" id="total_purchase_select_time" onchange="get_total_purchase()">
                      <option value="all">All</option>
                      <option value="today">Today</option>
                      <option value="this_week">This Week</option>
                      <option value="this_month">This month</option>
                      <option value="three_month">Last 3 month</option>
                      <option value="six_month">Last 6 month</option>
                      <option value="this_year">This year</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center text-success total-sales" id="total_purchase_count"></div>
              </div>
            </div>
          </div>
          <!-- END: total sales -->
          <!-- total purchase -->
                    <div class="col-md-6">
            <div class="card">
              <div class="card-header card-kpi">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="card-title pt-2"><span class="analytics-title">Average Purchase Order Value</span></h3>
                  </div>
                  <div class="col-md-8 text-right">

                    <select class="form-control d-inline kip-select" id="avg_purchase_order_value_select_time_store" onchange="get_average_purchase_order_value()">
                      <option value="all">ALL</option>
                     <?php 
                     foreach ($store as $key => $value) {
                       echo "<option value='".$value['storeId']."'>".$value['storeName']."</option>";
                     }
                     ?>
                    </select>
                    <select class="form-control d-inline kip-select" id="avg_purchase_order_value_select_time" onchange="get_average_purchase_order_value()">
                      <option value="all">All</option>
                      <option value="today">Today</option>
                      <option value="this_week">This Week</option>
                      <option value="this_month">This month</option>
                      <option value="three_month">Last 3 month</option>
                      <option value="six_month">Last 6 month</option>
                      <option value="this_year">This year</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center text-success total-sales" id="avergare-purchase-order-sales"></div>
              </div>
            </div>
          </div>
          <!-- total purchase -->
        </div>
        <!-- purchase -->
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header card-kpi">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="card-title pt-2"><span class="analytics-title">Number Of Sales Orders</span></h3>
                  </div>
                  <div class="col-md-8 text-right">
                    <select class="form-control d-inline kip-select" id="no_of_orders_select_time_store" onchange="get_total_no_of_orders()">
                      <option value="all">ALL</option>
                     <?php 
                     foreach ($store as $key => $value) {
                       echo "<option value='".$value['storeId']."'>".$value['storeName']."</option>";
                     }
                     ?>
                    </select>
                    <select class="form-control d-inline kip-select" id="no_of_orders_select_time" onchange="get_total_no_of_orders()">
                      <option value="all">All</option>
                      <option value="today">Today</option>
                      <option value="this_week">This Week</option>
                      <option value="this_month">This month</option>
                      <option value="three_month">Last 3 month</option>
                      <option value="six_month">Last 6 month</option>
                      <option value="this_year">This year</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center text-success total-sales" id="no-of-orders-count"></div>
              </div>
            </div>
          </div>

           <div class="col-md-6">
            <div class="card">
              <div class="card-header card-kpi">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="card-title pt-2"><span class="analytics-title">Number Of Purchase Orders</span></h3>
                  </div>
                  <div class="col-md-8 text-right">

                    <select class="form-control d-inline kip-select" id="no_of_purchase_orders_select_time_store" onchange="get_total_no_of_purchase_orders()">
                      <option value="all">ALL</option>
                     <?php 
                     foreach ($store as $key => $value) {
                       echo "<option value='".$value['storeId']."'>".$value['storeName']."</option>";
                     }
                     ?>
                    </select>
                    <select class="form-control d-inline kip-select" id="no_of_purchase_orders_select_time" onchange="get_total_no_of_purchase_orders()">
                      <option value="all">All</option>
                      <option value="today">Today</option>
                      <option value="this_week">This Week</option>
                      <option value="this_month">This month</option>
                      <option value="three_month">Last 3 month</option>
                      <option value="six_month">Last 6 month</option>
                      <option value="this_year">This year</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center text-success total-sales" id="no-of-purchase-orders-count"></div>
              </div>
            </div>
          </div>

        </div>


        <!--  -->
        <div class="row">
            <div class="col-md-6">
            <div class="card">
              <div class="card-header card-kpi">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="card-title pt-2"><span class="analytics-title">Total Returns</span></h3>
                  </div>
                  <div class="col-md-8 text-right">
                    <select class="form-control d-inline kip-select" id="total_returns_select_time_store" onchange="get_total_order_returns()">
                      <option value="all">ALL</option>
                     <?php 
                     foreach ($store as $key => $value) {
                       echo "<option value='".$value['storeId']."'>".$value['storeName']."</option>";
                     }
                     ?>
                    </select>
                    <select class="form-control d-inline kip-select" id="total_returns_select_time" onchange="get_total_order_returns()">
                      <option value="all">All</option>
                      <option value="today">Today</option>
                      <option value="this_week">This Week</option>
                      <option value="this_month">This month</option>
                      <option value="three_month">Last 3 month</option>
                      <option value="six_month">Last 6 month</option>
                      <option value="this_year">This year</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center text-success total-sales" id="total-returns-count"></div>
              </div>
            </div>
          </div>

           <div class="col-md-6">
            <div class="card">
              <div class="card-header card-kpi">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="card-title pt-2"><span class="analytics-title">Sales by Item</span></h3>
                  </div>
                  <div class="col-md-8 text-right">
                  <div class="row">
                     <div class="col-md-8 mt-2">
                       <select class="form-control d-inline kip-select" id="sales_by_item_select_store" onchange="get_sales_by_item_count()">
                      <option value="all">ALL</option>
                     <?php 
                     foreach ($store as $key => $value) {
                       echo "<option value='".$value['storeId']."'>".$value['storeName']."</option>";
                     }
                     ?>
                    </select>
                        <select class="select2 form-control d-inline kip-select mt-2" id="sales_by_item_select_product" onchange="get_sales_by_item_count()">
                      <option value="all">All Products</option>
                      <?php 
                        foreach ($all_product_names as $key => $value) { ?>
                          <option value="<?php echo $value['store_product_id']?>"><?php echo $value['product_title']?></option>
                      <?php } ?>
                    </select>  
                     </div>
                     <div class="col-md-4">
                       <select class="form-control d-inline kip-select mt-2" id="sales_by_item_select_time" onchange="get_sales_by_item_count()">
                      <option value="all">All</option>
                      <option value="today">Today</option>
                      <option value="this_week">This Week</option>
                      <option value="this_month">This month</option>
                      <option value="three_month">Last 3 month</option>
                      <option value="six_month">Last 6 month</option>
                      <option value="this_year">This year</option>
                    </select>
                     </div>
                   </div>

                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center" id="sales_by_item_error_div"></div>
                <div class="text-center chart-div">
                  <canvas height="300px" id="sales_by_item_count" class="charts-canvas"></canvas>
                </div>
              </div>
            </div>
          </div>
            <!--  -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header card-kpi">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="card-title pt-2"><span class="analytics-title">Top selling items</span></h3>
                  </div>
                  <div class="col-md-8 text-right"> 
                       <select class="form-control d-inline kip-select" id="top_selling_items_select_store" onchange="get_top_selling_items()">
                      <option value="all">ALL</option>
                     <?php 
                     foreach ($store as $key => $value) {
                       echo "<option value='".$value['storeId']."'>".$value['storeName']."</option>";
                     }
                     ?>
                    </select>  
                      <select class="form-control d-inline kip-select mt-2" id="top_selling_items_select" onchange="get_top_selling_items()">
                      <option value="5" selected>Top 5</option>
                      <option value="10">Top 10</option> 
                      <option value="15">Top 15</option> 
                    </select>
                     <select class="form-control d-inline kip-select" id="top_selling_items_select_time" onchange="get_top_selling_items()">
                      <option value="all">All</option>
                      <option value="today">Today</option>
                      <option value="this_week">This Week</option>
                      <option value="this_month">This month</option>
                      <option value="three_month">Last 3 month</option>
                      <option value="six_month">Last 6 month</option>
                      <option value="this_year">This year</option>
                    </select> 
                    
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="text-center" id="top_selling_items_error_div"></div>
                <div class="text-center chart-div">
                  <canvas height="350px" id="top_selling_items_result" class="charts-canvas"></canvas>
                </div>
              </div>
            </div>
          </div>
          <!--  -->
        </div>


      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
   <!-- /.content-wrapper -->
  <script src="<?php echo base_url()?>assets/customeJS/kpi/admin-kpi.js"></script>
