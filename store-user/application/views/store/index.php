   
 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="<?php echo base_url()?>?/adminDashboard" class="header-left-tab-a">Store Panel / </a>
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
          <!-- <div class="col-12 col-sm-6 col-md-3"> -->
          <!--   <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total WareHouse</span>
                <span class="info-box-number"><?php //echo $total_warehouse;?></span>
              </div> -->
              <!-- /.info-box-content -->
            <!-- </div> -->
            <!-- /.info-box -->
          <!-- </div> -->
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-product-hunt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Product</span>
                <span class="info-box-number"><?php echo $total_product['totalProduct'];?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <div class="row">
                  <div class="col-sm-6">
                    <span class="info-box-text">Sales Order</span>
                    <span class="info-box-number"><?php echo $total_sales['totalSalesOrder'];?></span>
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
             
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-shopping-basket"></i></span>

              <div class="info-box-content">
                <div class="row">
                  <div class="col-sm-6">
                    <span class="info-box-text">Purchase Order</span>
                    <span class="info-box-number"><?php echo $total_purchase['totalOrder'];?></span>
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

        <!-- bar chart -->
        <div class="row">
          <div class="col-md-6">
             <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">sales Purchase Bar Chart</h3>

                <div class="card-tools">
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i> -->
                  <!-- </button> -->
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 500px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- END BAR CHART -->
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
