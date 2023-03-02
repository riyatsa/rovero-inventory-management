   
 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
             <a href="<?php echo base_url()?>?/adminDashboard" class="header-left-tab-a">Warehouse Panel / </a>
              <span class="header-left-tab-span">GST</span>
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
              <a class="nav-link  nav-link-add-product nav-link-product-tab" href="?/store" >Add Store</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#" >View Store</a>
            </li>
          </ul> -->
          <section class="content">
            <div class="container-fluid">
              <div class="text-center" id="customer-status"></div>
               <button class="btn btn-add text-white mt-0 float-right" onclick="addGstModal()" id="add_gst_btn" name="add_gst_btn">Add GST</button>
              <span class="d-block medium-text">All GST List</span>
              <div class="table-responsive mt-3" id="">
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>GST</th>
                      <th>GST Value</th> 
                      <th>Active/Deactive</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="get_customers">
                     <!-- Custom code will be hear in data table  -->
                  </tbody>
                </table>
              </div>
            </div>
          </section> 
        </div>
      </div>
    </section>
  </div>

<!-- Add GST Modal Starts -->
  <div class="modal fade" id="add_store">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Add GST</h4>
        </div>
        <input type="hidden" name="gst_id" id="gst_id">
        <div class="modal-body modal-body-edit-coupon">
          <div class="row">
            <div class="col-sm-6">
              <label class="product-details-span-light">GST Tag</label>
              <input type="text" class="input-txt" name="add_gst_name" id="add_gst_name" placeholder="Enter GST Tag">
              <div id="add_gst-name-error-msg-div"></div>
            </div>
            <div class="col-sm-6">
              <label class="product-details-span-light">GST Value</label>
              <input type="number" class="input-txt" name="add_gst_value" id="add_gst_value" placeholder="Enter GST Value">
              <div id="add_gst_value-error-msg-div"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="add-gst-close-btn" name="add-gst-close-btn" data-dismiss="modal">Close</button>
          <button class="btn btn-add text-white mt-0" onclick="addGst()" id="add_gst_btn" name="add_gst_btn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add GST Modal Ends -->


<!-- Edit GST Modal Starts -->
  <div class="modal fade" id="edit_store">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Edit GST</h4>
        </div>
        <input type="hidden" name="gst_id" id="gst_id">
        <div class="modal-body modal-body-edit-coupon">
          <div class="row">
            <div class="col-sm-6">
              <label class="product-details-span-light">GST Tag</label>
              <input type="text" class="input-txt" name="gst_name" id="gst_name" placeholder="Enter GST Tag">
              <div id="gst-name-error-msg-div"></div>
            </div>
            <div class="col-sm-6">
              <label class="product-details-span-light">GST Value</label>
              <input type="number" class="input-txt" name="gst_value" id="gst_value" placeholder="Enter GST Value">
              <div id="gst_value-error-msg-div"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="edit-gst-close-btn" name="edit-store-close-btn" data-dismiss="modal">Close</button>
          <button class="btn btn-add text-white mt-0" onclick="updateGstDetails()" id="edit_gst_btn" name="edit_gst_btn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit GST Modal Ends -->

<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/gst/gstListJs.js"></script> 