   
 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="<?php echo base_url()?>?/adminDashboard" class="header-left-tab-a">Outlet Panel / </a>
              <span class="header-left-tab-span">Customer</span>
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
              <a class="nav-link  nav-link-add-product nav-link-product-tab" href="?/customer" >Add Customer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#" >View Customer</a>
            </li>
          </ul>
          <section class="content">
            <div class="container-fluid">
              <div class="text-center" id="customer-status"></div>
              <div class="table-responsive mt-3" id="">
              <span class="d-block medium-text mb-2">All Customers</span>
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>Customer Name</th>
                      <th>Phone Number</th>
                      <th>Refral code</th>
                      <th>Balance Point</th>
                      <th>City</th> 
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="get_customers">
                     <!-- Dynamic able will come here -->
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>


  
<!-- Edit Coupon Modal Starts -->
  <div class="modal fade" id="display-purchase-history">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0"> 
          <h4 class="modal-title-edit-coupon">Customer Purchase History</h4> 
        </div>
        <input type="hidden" name="edit_Customer_id" id="edit_Customer_id">
        <div class="modal-body modal-body-edit-coupon">
            <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">  
              <div class="row" id="">
              <!-- <span class="d-block medium-text mb-2">Customer Purchase History</span> -->
                <table class="table">
                  <thead >
                    <tr>
                      <th>Sr No.</th>  
                      <!-- <th>Product ID </th> -->
                      <th>Product Name </th>
                      <th>Barcode  </th>
                      <th>Quantity </th>
                      <!-- <th>MRP </th> -->
                      <!-- <th>Retail Price </th> -->
                      <!-- <th>Wholesale Price </th> -->
                      <!-- <th>Purchase Price </th> -->
                      <!-- <th>Tax Rate </th> -->
                      <th>Product Sell Price(Per Product) </th>
                      <th>Total Amount </th>
                      <th>Bill Number </th>
                      <th>Bill Date </th>
                      <!-- <th>Customer Name</th> -->
                    </tr>           
                  </thead>
                  <tbody class="tbody-datatable" id="get_purchase_order">
                     <!-- Dynamic able will come here -->
                  </tbody>
                </table>
              </div> 

            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="edit-Customer-close-btn" name="edit-Customer-close-btn" data-dismiss="modal">Close</button> 
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Coupon Modal Ends -->







<!-- Edit Coupon Modal Starts -->
  <div class="modal fade" id="edit_Customer">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0"> 
          <h4 class="modal-title-edit-coupon">Edit Customer</h4> 
        </div>
        <input type="hidden" name="edit_Customer_id" id="edit_Customer_id">
        <div class="modal-body modal-body-edit-coupon">
            <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
              <div class="row">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Customer Name</label>
                  <input type="text" class="input-txt" name="customername" id="customername" placeholder="Enter Customer Name">
                  <div id="customername-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Contact Number </label>
                  <input type="text" class="input-txt" name="phonenumber" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="phonenumber" placeholder="Contact Number">
                  <div id="phonenumber-error-msg-div"></div>
                </div>
              </div>
              
            <div class="row mt-2">
              <div class="col-sm-3">
                <label class="product-details-span-light">Address</label>
                <!-- <input type="number" class="input-txt" name="address" id="address" placeholder="Enter address"> -->
                <textarea class="input-txt"  name="address" id="address" placeholder="Enter address"></textarea>
                <div id="address-error-msg-div"></div>  
              </div>
              <div class="col-sm-3">
                <label class="product-details-span-light">City</label>
                <input type="text" class="input-txt" name="city" id="city" placeholder="Enter city">
                <div id="city-error-msg-div"></div>  
              </div>
              <div class="col-sm-3">
                <label class="product-details-span-light">State</label>
                <input type="text" class="input-txt" name="state" id="state" placeholder="Enter state">
                <div id="state-error-msg-div"></div>  
              </div>
              <div class="col-sm-3">
                <label class="product-details-span-light">Pincode</label>
                <input type="number" class="input-txt" name="pincode" id="pincode" placeholder="Enter pincode">
                <div id="pincode-error-msg-div"></div>  
              </div>
            </div>
            
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="edit-Customer-close-btn" name="edit-Customer-close-btn" data-dismiss="modal">Close</button>
          <button class="btn btn-add text-white mt-0" onclick="updateCustomerDetails()" id="edit_Customer_btn" name="edit_Customer_btn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Coupon Modal Ends -->





<!-- Edit Coupon Modal Starts -->
  <div class="modal fade" id="display-credit-history">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0"> 
          <h4 class="modal-title-edit-coupon">Customer Credit</h4> 
        </div>
        <input type="hidden" name="edit_Customer_id" id="edit_Customer_id">
        <div class="modal-body modal-body-edit-coupon">
            <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">  
              <div class="row" id="">
              <span class="d-block medium-text mb-2">Customer Credit</span>
                <table class="table">
                  <thead >
                    <tr>
                      <th>Sr No.</th>
                      <th>Customer Name</th>
                      <th>Phone Number</th>
                      <th>Bill Number</th>
                      <th>Balance</th> 
                      <th>Date</th> 
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="get_credit_order">
                     <!-- Dynamic able will come here -->
                  </tbody>
                </table>
              </div> 

            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="edit-Customer-close-btn" name="edit-Customer-close-btn" data-dismiss="modal">Close</button> 
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Coupon Modal Ends -->

    
<div class="modal fade view_store_bill" id="display-calc-data">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Post Paid Bill</h4>
        </div>
        <div class="modal-body">
           <div class="row">
             <div class="col-sm-12">
               <label>Credited Bill<br/></label> 
             </div>
             <div class="col-sm-12">
               <span id="credited_bill">0</span>
             </div>
             <div class="col-sm-12">
               <label>Pay Amount</label>
               <input class="form-control" type="text" name="pay_amount" id="pay_amount">
               <input type="hidden" name="sales_id" id="sales_id">
                <input type="hidden" name="role" id="role">
               <input type="hidden" name="bill_number" id="bill_number">
               <div id="pay-amount-error">&nbsp;</div>
             </div>
             <div class="col-sm-12 text-right mt-2">
               <button class="btn btn-success" id="post-paid-amount" >Pay</button>
             </div>
           </div>
           
        </div>  
      </div>
    </div>
  </div>



<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/warehouse/customer-js/add-customer-js.js"></script>
<script src="<?php echo base_url()?>assets/customeJS/warehouse/customer-js/customerListJs.js"></script>