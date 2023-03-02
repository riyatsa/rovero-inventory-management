  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="<?php echo base_url()?>?/admin-panel" class="header-left-tab-a">Admin Panel / </a>
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
              <a class="nav-link active nav-link-add-product nav-link-product-tab" href="#" >Add WareHouse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/warehouse-details" >View WareHouse</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">

              <!--  -->
              <div class="row mt-4">
                <div class="col-sm-6">
                  <label class="product-details-span-light">WareHouse Name</label>
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
                <div class="col-sm-6"> 
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
                    <option value="unregistered">Unregistered</option>
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
                  <label class="product-details-span-light">Opening Balance</label>
                  <input type="number" class="input-txt" name="openingBalance" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="openingBalance" placeholder="Enter Opening Balance">
                  <div id="openingBalance-error-msg-div"></div>  
              </div> 
            </div>
            <div class="row mt-3">
              <div class="col-sm-12">
                <label class="product-details-span-light"> WareHouse Address </label>
                <textarea class="input-txt" id="Address" placeholder="Enter WareHouse Address"></textarea>
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
                <div class="col-md-12 text-right">
                  <button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn">Cancel</button>
                  <button class="btn btn-add btn-add-2 text-white mt-0" onclick="savewerehouse()" id="add_new_product_btn" name="add_new_product_btn">Add</button>
                </div>
              </div>

              <!--  -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/admin-js/add-werehouse.js"></script>