   
 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="<?php echo base_url()?>?/adminDashboard" class="header-left-tab-a">Admin Panel / </a>
              <span class="header-left-tab-span">Vendor</span>
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
              <a class="nav-link  nav-link-add-product nav-link-product-tab" href="?/vendor" >Add Vendor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#" >View Vendor</a>
            </li>
          </ul>
          <section class="content">
            <div class="container-fluid">
              <div class="text-center" id="customer-status"></div>
              <div class="table-responsive mt-3" id="">
              <span class="d-block medium-text mb-2">All Vendors</span>
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>Vendor Name</th>
                      <th>Phone Number</th>
                      <th>GSTIN Number</th>
                      <th>User Name</th>
                      <th>Opening Balance</th>
                      <th>City</th>
                      <th>Deactive</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="get_customers">
                    <!-- <tr>
                      <td>Brunoi Tandel</td>
                      <td>ab@gm.com</td>
                      <td>9876543210</td>
                      <td>12/05/2020</td>
                      <td>77</td>
                      <td>7</td>
                      <td>
                        <div class="custom-control custom-switch d-inline">
                          <input type="checkbox" class="custom-control-input" id="change_status_customer_1">
                          <label class="custom-control-label" for="change_status_customer_1"></label>
                        </div>
                      </td>
                    </tr> -->
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
  <div class="modal fade" id="edit_vendor">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Edit Vendor</h4>
        </div>
        <input type="hidden" name="edit_vendor_id" id="edit_vendor_id">
        <div class="modal-body modal-body-edit-coupon">
            <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
              <div class="row">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Vendor Name</label>
                  <input type="text" class="input-txt" name="vendorname" id="vendorname" placeholder="Enter Vendor Name">
                  <div id="vendorname-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Contact Number </label>
                  <input type="text" class="input-txt" name="phonenumber" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="phonenumber" placeholder="Contact Number">
                  <div id="phonenumber-error-msg-div"></div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Email</label>
                  <input type="text" class="input-txt" name="email" id="email" placeholder="Vendor email">
                  <div id="email-error-msg-div"></div>
                </div>
                 <div class="col-sm-6">
                  <label class="product-details-span-light">GST Type</label>
                  <select class="input-txt" name="gst_type" id="gst_type">
                     
                  </select>
                  <div id="gst-type-error-msg-div"></div>
                </div>
            </div>

             <div class="row mt-2">
             
                <div class="col-sm-6">
                  <label class="product-details-span-light">GST Number</label>
                  <input type="text" class="input-txt" name="gstinumber" id="gstinumber" placeholder="Enter GST Number">
                  <div id="gstinumber-error-msg-div"></div>
                </div>
                <div class="col-sm-4"> 
                  <label class="product-details-span-light">Opening Balance</label>
                      <input type="number" class="input-txt" name="openingBalance" id="openingBalance" placeholder="Enter Opening Balance">
                      <div id="openingBalance-error-msg-div"></div>  
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
                <!-- <input type="text" class="input-txt" name="state" id="state" placeholder="Enter state"> -->
                <select class="input-txt" name="state" id="state">
                </select>
                <div id="state-error-msg-div"></div>  
              </div>
              <div class="col-sm-3">
                <label class="product-details-span-light">Pincode</label>
                <input type="number" class="input-txt" name="pincode" id="pincode" placeholder="Enter pincode">
                <div id="pincode-error-msg-div"></div>  
              </div>
            </div>
            <div class="row mt-2">
              
            </div>
               
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="edit-vendor-close-btn" name="edit-vendor-close-btn" data-dismiss="modal">Close</button>
          <button class="btn btn-add text-white mt-0" onclick="updatevendorDetails()" id="edit_vendor_btn" name="edit_vendor_btn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Coupon Modal Ends -->

<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/admin-js/vendor-js/add-vendor-js.js"></script>
<script src="<?php echo base_url()?>assets/customeJS/admin-js/vendor-js/vendorListJs.js"></script>