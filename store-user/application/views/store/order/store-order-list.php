  <style>
  @media print
{
  .button
  {
    display: none;
  }
}
</style>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
             <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Store Panel / </a>
              <span class="header-left-tab-span">Purchase Order List</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="product-tabs-container">
          <ul class="nav nav-tabs" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/StoreOrder">Add Purchase Order</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#" >View All Purchase Order</a>
            </li>
            
          </ul>
          <section class="content">
            <div class="container-fluid">
              <div class="text-center" id="customer-status"></div>
              <!--  <button class="btn btn-add text-white mt-0 float-right" onclick="addGstModal()" id="add_gst_btn" name="add_gst_btn">Add GST</button> -->
              <div class="table-responsive mt-3" id="">
              <span class="d-block medium-text mb-2">All Product Purchase List</span>
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>Warehouse Name</th>
                      <th>Bill Number</th> 
                      <th>Total Amount</th> 
                      <th>Date</th> 
                      <th>View</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="get_purchase_order">
                     <!-- Custom code will be hear in data table  -->
                  </tbody>
                </table>
              </div>
            </div>
          </section> 
        </div>
      </div>
    </section>



<!-- View Purchase Order -->
<div class="modal fade" id="view_store">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Purchase Store Order</h4>
        </div>
        <div class="row" id="get_store_purchase_order">
          
        </div>
         
      </div>
    </div>
  </div>
  <!-- View Purchase Order Ends -->

  </div>
 <script src="<?php echo base_url()?>assets/customeJS/order/purchaseorder.js"></script>