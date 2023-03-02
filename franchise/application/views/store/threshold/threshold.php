  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="<?php echo base_url()?>?/adminDashboard" class="header-left-tab-a">Outlet Panel / </a>
              <span class="header-left-tab-span">Threshold</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="product-tabs-container">
         <!--  <ul class="nav nav-tabs" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active nav-link-add-product nav-link-product-tab" href="#" >Add Customer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/customer/CustomerList" >View Customer</a>
            </li>
          </ul> -->
          <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
              <div class="row mt-4">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Threshold point</label>
                  <input type="number" class="input-txt" name="threshold_point" id="threshold_point" placeholder="Enter threshold point" value="<?php echo isset($threshold['threshold_balance'])?$threshold['threshold_balance']:'0'?>">
                  <div id="threshold-point-error-msg-div"></div>
                </div>
                 
              </div>
              
              <div class="row mt-4">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Threshold bill amount</label>
                  <input type="number" class="input-txt" name="threshold_bill_amount" id="threshold_bill_amount" placeholder="Enter threshold_bill amount" value="<?php echo isset($threshold['threshold_bill_amount'])?$threshold['threshold_bill_amount']:'0'?>">
                  <div id="threshold-bill-amount-error-msg-div"></div>
                </div>
                 
              </div>

              <div class="row mt-4">
                 
                <div class="col-sm-6">
                  <label class="product-details-span-light">Percentage</label>
                  <input type="number" class="input-txt" name="percentage" id="percentage" placeholder="Enter percentage" value="<?php echo isset($threshold['percent'])?$threshold['percent']:'0'?>">
                  <div id="percentage-error-msg-div"></div>  
                </div>
                
              </div>
             
              <div class="row mt-4">
                <!-- <div class="col-md-12 text-center">
                  <div class="text-center" id="Customer-error"></div>
                </div> -->
                <div class="col-sm-4">
                </div>
                <div class="col-sm-2 text-right">
                   
                  <button 
                    class="btn btn-add btn-add-2 text-white mt-0" 
                    onclick="edit_threshold_confirm()" 
                    id="saveCustomerDetailsbtn" 
                    name="saveCustomerDetailsbtn">
                    Update
                  </button>
                </div>   
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<!-- confirm field Starts -->
  <div class="modal fade" id="edit_threshold_confirm">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-threshold">
            Are you sure want to update thresholds ?
          </h4>
        </div>  
        <div class="modal-footer border-0">
          <button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn"  data-dismiss="modal">Cancel</button>
                  <button class="btn btn-add btn-add-2 text-white mt-0" onclick="updateThreshold()" id="add_new_product_btn" name="add_new_product_btn">Confirm</button>
        </div>
      </div>
    </div>
  </div>
   
  <!--Add confirm field Ends -->


<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/store/threshold/thresholdjs.js"></script>