  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="/" class="header-left-tab-a">Admin Panel / </a>
              <span class="header-left-tab-span">WareHouse</span>
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
              <a class="nav-link nav-link-add-product nav-link-product-tab" href="?/ware-house" >Add WareHouse</a>
            </li>
             <li class="nav-item">
              <a class="nav-link nav-link-product-tab active" href="#" >View WareHouse</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="view-all-product-tab" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
               <div class="row">
        <!--   <div class="col-md-3 d-none">
            <div class="sticky-top sticky-top-filter">
              <div class="col-padding-filter-layout">
                <span class="text-danger" id="filter-error"></span>
                <span class="d-block medium-text">Filter By</span>
                <span class="d-block small-text-1">Date</span>
                <div class="input-group input-group-custom-filter mt-2">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom">
                      <span class="fa-custom-filter">From</span>
                    </div>
                  </div>
                  <input type="text" class="form-control main-input-txt input-filter input-filter-date mdate" id="date_from" name="date_from">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom">
                      <span class="fa fa-calendar fa-custom-filter"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group input-group-custom-filter mt-2">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom input-group-text-to">
                      <span class="fa-custom-filter">To</span>
                    </div>
                  </div>
                  <input type="text" class="form-control main-input-txt input-filter input-filter-date mdate" id="date_to" name="date_to">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom">
                      <span class="fa fa-calendar fa-custom-filter"></span>
                    </div>
                  </div>
                </div>
                <span class="d-block small-text-1 mt-3">Discount</span>
                <div class="input-group input-group-custom-filter mt-2">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom">
                      <span class="fa-custom-filter">From </span>
                      <span class="fa-custom-filter fa-custom-filter-2 pl-2">%</span>
                    </div>
                  </div>
                  <input type="text" class="form-control main-input-txt input-filter input-discount-filter" id="discount_from" name="discount_from" placeholder="0">
                </div>
                <div class="input-group input-group-custom-filter mt-2">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom">
                      <span class="fa-custom-filter">To</span>
                      <span class="fa-custom-filter fa-custom-filter-2 pl-2">%</span>
                    </div>
                  </div>
                  <input type="text" class="form-control main-input-txt input-filter input-discount-filter" id="discount_to" name="discount_to" placeholder="0">
                </div>
                <button class="btn btn-filter btn-block text-white" onclick="get_filter()" id="filter_coupon_btn" name="filter_coupon_btn">Filter</button>
                 <button class="btn btn-filter btn-block text-white" onclick="get_reset()" id="filter_coupon_btn" name="filter_coupon_btn">Reset</button>
              </div>
            </div>
          </div> -->
          <div class="col-md-12">
            <div class="col-padding-main-layout">  
              <!-- <div class="custom-border"></div> -->
              <div class="text-center" id="coupen-status"></div>
              <span class="d-block medium-text mt-3 mb-3">All WareHouse</span>

              <div class="table-responsive" id="">
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>WareHouse Name</th>
                      <th>WareHouse User</th>
                      <th>Contact Number</th>
                      <th>Opening Balance</th>
                      <th>GST Number</th>
                      <th>Actions</th>
                      <th>Active/Deactive</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="were-house-details">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Delete Product Modal Starts -->
  <div class="modal fade" id="delete_werehouse">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit-category">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon text-danger font-weight-bold">Delete WareHouse?</h4>
        </div>
        <div class="modal-body modal-body-edit-coupon">
          <div class="row">
            <div class="col-md-7">
              <span>Are You sure you want to delete a the WareHouse "<label id="delete-product-name"></label>"?</span>
              <input type="hidden" name="delete-werehouse" id="delete-werehouse" value="">
            </div>
            <div class="col-md-4">
              <button class="btn btn-add btn-add-2 btn-danger btn-delete text-white mt-0" onclick="deletewerehouse()" id="delete_product_btn" name="delete_product_btn">Delete</button>
              <button class="btn btn-default btn-close btn-add-2 ml-2" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0"></div>
      </div>
    </div>
  </div>
  <!-- Delete Product Modal Modal Ends -->

  <!-- Edit Product Modal Starts -->
  <div class="modal fade" id="edit-werehouse-details">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Update WareHouse</h4>
        </div>
        <div class="modal-body">
          
              <!--  -->
              <div class="row mt-4">
                <div class="col-sm-6">
                  <input type="hidden" name="" id="warehouseId">
                  <label class="product-details-span-light">WereHouse Name</label>
                  <input type="text" class="input-txt" name="werehousename" id="werehousename" placeholder="Enter WareHouse Name">
                  <div id="main-heading-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Contact Number </label>
                  <input type="text" class="input-txt" name="phonenumber"  oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="phonenumber" placeholder="Contact Number">
                  <div id="phonenumber-error-msg-div"></div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-6">
                  <label class="product-details-span-light">User Name</label>
                  <input type="text" class="input-txt" name="username" id="username" placeholder="WareHouse User Name">
                  <div id="username-error-msg-div"></div>
                </div>
                <div class="col-sm-6 d-none"> 
                  <label class="product-details-span-light">Password</label>
                  <input type="password" class="input-txt" name="password" id="password" placeholder="Enter WareHouse Password">
                  <div id="password-error-msg-div"></div>  
              </div> 
            </div>

             <div class="row mt-3">
                  <div class="col-sm-4">
                  <label class="product-details-span-light">GST Type</label>
                  <select class="input-txt" name="gst_type" id="gst_type">
                    <option value="">Select GST Type</option>
                    <option value="unregistered">Unregistrade</option>
                    <option value="registered_business_regular">Registered Business - Regular</option>
                    <option value="registered_business_composition">Registered Business - Composition</option>
                  </select>
                  <div id="gst_type-error-msg-div"></div>
                </div>
                <div class="col-sm-4">
                  <label class="product-details-span-light">GST Number</label>
                  <input type="text" class="input-txt" name="gstinumber" id="gstinumber" placeholder="GST Number">
                  <div id="gstinumber-error-msg-div"></div>
                </div>
                <div class="col-sm-4"> 
                  <label class="product-details-span-light">Opening Balence</label>
                  <input type="number" class="input-txt" name="openingBalance" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="openingBalance" placeholder="Enter Opening Balence">
                  <div id="openingBalance-error-msg-div"></div>  
              </div> 
            </div>
            <div class="row mt-2">
              <div class="col-sm-12">
                <label class="product-details-span-light"> WereHouse Address </label>
                <textarea class="input-txt mt-3"  id="Address" placeholder="Enter WereHouse Address"></textarea>
                <div id="Address-error-msg-div"></div>
              </div>
              <div class="col-sm-12">
                <div class="row mt-3">
                  <div class="col-sm-4">
                    <label class="product-details-span-light">City</label>
                    <input type="text" class="input-txt" name="city" id="city" placeholder="Enter City">
                    <div id="city-error-msg-div"></div>
                  </div>
                  <div class="col-sm-4">
                    <label class="product-details-span-light">State</label>
                    <select class="input-txt" name="state" id="state">
                    </select>
                    <div id="state-error-msg-div"></div>
                  </div>
                  <div class="col-sm-4">
                    <label class="product-details-span-light">Pincode</label>
                    <input type="text" class="input-txt" name="pincode" id="pincode" placeholder="Enter Pincode">
                    <div id="pincode-error-msg-div"></div>
                  </div>
                </div>
              </div>
            </div>

              <div class="row mt-3">
                <div class="col-md-12 text-center">
                  <div class="text-center" id="werehouse-error"></div>
                </div> 
              </div>

              <!--  -->
        <div class="modal-footer border-0">
          <button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn" name="cancel_add_new_product_btn" data-dismiss="modal">Cancel</button>
          <button class="btn btn-add btn-add-2 text-white mt-0" onclick="savewerehouse()" id="add_new_product_btn" name="add_new_product_btn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Product Modal Ends -->

<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/admin-js/werehouse.js"></script>