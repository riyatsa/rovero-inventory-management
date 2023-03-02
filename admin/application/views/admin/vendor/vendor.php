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
              <a class="nav-link active nav-link-add-product nav-link-product-tab" href="#" >Add Vendor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/vendor/vendorList" >View Vendor</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
              <div class="row mt-4">
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
                  <input type="text" class="input-txt" name="email" id="email" placeholder="Vendor Email">
                  <div id="email-error-msg-div"></div>
                </div>
                <!-- <div class="col-sm-6"> 
                  <label class="product-details-span-light">Password</label>
                      <input type="password" class="input-txt" name="password" id="password" placeholder="Enter vendor Password">
                      <div id="password-error-msg-div"></div>  
              </div>  -->
               <div class="col-sm-6"> 
                  <label class="product-details-span-light">Opening Balance</label>
                  <input type="number" class="input-txt" name="openingBalance" id="openingBalance" placeholder="Enter Opening Balance">
                  <div id="openingBalance-error-msg-div"></div>  
                </div>  
            </div>

             <div class="row mt-2">
              <div class="col-sm-6">
                  <label class="product-details-span-light">GST Type</label>
                  <select class="input-txt" name="gst_type" id="gst_type">
                    <option value="">Select GST Type</option>
                    <option value="unregistered">Unregistrade</option>
                    <option value="registered_business_regular">Registered Business - Regular</option>
                    <option value="registered_business_composition">Registered Business - Composition</option>
                  </select>
                  <div id="gst-type-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">GST Number</label>
                  <input type="text" class="input-txt" name="gstinumber" id="gstinumber" placeholder="Enter GST Number">
                  <div id="gstinumber-error-msg-div"></div>
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
            <!-- <div class="row mt-2">
              <div class="col-sm-4"> 
                  <label class="product-details-span-light">Opening Balence</label>
                      <input type="number" class="input-txt" name="openingBalance" id="openingBalance" placeholder="Enter Opening Balence">
                      <div id="openingBalance-error-msg-div"></div>  
                </div>  
            </div> -->
              <div class="row mt-3">
                <div class="col-md-12 text-center">
                  <div class="text-center" id="vendor-error"></div>
                </div>
                <div class="col-md-12 text-right">
                  <button class="btn btn-default btn-close btn-add-2 ml-2" id="cancelvendorDetailsbtn">Cancel</button>
                  <button class="btn btn-add btn-add-2 text-white mt-0" onclick="savevendorDetails()" id="savevendorDetailsbtn" name="savevendorDetailsbtn">Add</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/admin-js/vendor-js/add-vendor-js.js"></script>