<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <label>
               <a href="<?php echo base_url()?>" class="header-left-tab-a">Warehouse Panel / </a>
               <span class="header-left-tab-span">Generate Report</span>
               </label>
            </div>
         </div>
      </div>
   </div>

    <section class="content">
        <ul class="nav nav-tabs" role="tablist">  
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="?/saleReport">Report</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab" href="?/BillReport" >Bill Report</a>
            </li>
          </ul>
      <div class="container">
        <div class="error-data"></div>
        <div class="row mt-3">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="payment-gst-container">
            <span class="d-block medium-text">Generate Report</span>
              <!-- <form autocomplete="off" action="?/SaleReport/daily_sale_report" method="POST"> -->
            <div class="row mt-3">
              <div class="col-md-12">
                <span class="product-details-span-light">Report For</span>
                <select class="form-control input-txt" name="table" id="table">
                  <option selected value="">Select Report For</option>
                  <option value="sales">Sales</option>
                  <option value="purchase">Purchase</option>
                   <option value="product">Product</option>
                   <option value="vendor">Vendor</option>
                  
                </select>
              </div>

               <div class="col-md-12" id="vendor-data" style="display: none;">
                <span class="product-details-span-light">Select Vendor</span>
                <select class="form-control input-txt" name="vendor" id="vendor">
                  <!-- <option selected value="all">All</option>  -->
                  <?php
                  $vendor = $this->db->get('vendor_details')->result_array();
                  foreach ($vendor as $key => $value) {
                    echo "<option value='".$value['vendor_Id']."'>".$value['vendor_name']."</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-12 mt-3">
                <span class="product-details-span-light">Duration</span>
                <select class="form-control input-txt" required name="duration" id="duration">
                  <!-- <option selected value="">Select Duration</option> -->
                  <option selected value="all">ALL</option>
                  <option value="today">Today</option>
                  <option value="week">Weekly</option>
                  <option value="month">Monthly</option>
                  <option value="year">Yearly</option>
                  <option value="between">Between Date</option>
                </select>
              </div>
              <div class="col-md-12 mt-3" id="duration-date" style="display: none;">
                <span class="product-details-span-light d-block">Duration</span>
                <div class="row">
                  <div class="col-md-6">
                    <span class="product-details-span-light">From</span>
                    <input class="form-control input-txt mdate" type="text" name="from" id="from" value="">
                  </div>
                  <div class="col-md-6">
                    <span class="product-details-span-light">To</span>
                    <input class="form-control input-txt mdate" type="text" name="to" id="to" value="">
                  </div>
                </div>
              </div>
              <div class="col-md-12 mt-3 text-right">
                <button class="btn btn-add text-white" id="generate_report" name="generate_report">Generate</button>
              </div>
            </div>
          <!-- </form> -->
          </div>
        </div>
      </div>
    </section>
  </div>
<script src="<?php echo base_url()?>assets/customeJS/warehouse/report/orderReportJS.js"></script>
  <script>
    $('#duration').change(function(){
    var duration = $('#duration').val();
    if (duration == 'between') {
      $("#duration-date").show();
    } else {
      $("#duration-date").hide();
    }
});
$('#table').change(function(){
    var table = $('#table').val();
    if (table == 'vendor') {
      $("#vendor-data").show();
    } else {
      $("#vendor-data").hide();
    }
});
$('#from').val('');
$('#to').val('');
  </script>