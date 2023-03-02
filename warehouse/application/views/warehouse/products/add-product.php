  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">WareHouse Panel / </a>
              <span class="header-left-tab-span">WareHouse Product</span>
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
              <a class="nav-link nav-link-product-tab" href="?/product-category">Add Product Category</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link active nav-link-add-product nav-link-product-tab" href="#" >Add Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab" href="?/WareHouseProduct/bulk_add_product">Add Bulk Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/warehouse-product-details" >View All Product</a>
            </li>
             <li class="nav-item">
              <a class="nav-link nav-link-product-tab " href="?/warehouse-product-barcode" >View Product Barcode</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
              <div class="row mt-4">
                <div class="col-sm-4">
                  <label class="product-details-span-light">Select Product Category</label>
                  <select class="form-control input-txt" name="select_product_category" id="select_product_category" >
                    <option value="">Select Category</option>
                    <?php foreach ($category as $key => $value) {
                      echo "<option value='".$value['category_id']."'>".$value['category_name']."</option>";
                    } ?>
                  </select>
                  <div id="select-category-error-msg-div"></div>
                </div>
                <div class="col-sm-4">
                  <label class="product-details-span-light">Select Unit</label>
                  <select class="form-control input-txt" name="select_unit" id="select_unit" >
                    <option value="">Select Unit</option>
                    <?php foreach ($unit as $key => $value) {
                      echo "<option value='".$value['unit_id']."'>".$value['unit_name']."</option>";
                    } ?>
                  </select>
                  <div id="select_unit-error-msg-div"></div>
                </div>
                <div class="col-sm-4">
                  <label class="product-details-span-light">Barcode Status</label>
                  <select class="form-control input-txt" name="barcode_status" id="barcode_status" >
                    <option value="1">Generated</option> 
                    <option value="0">Not Generated</option> 
                  </select>
                  <div id="barcode_status-error-msg-div"></div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-6">
                 <div class="row">
                   <div class="col-sm-9">
                      <label class="product-details-span-light">Item Code</label>
                  <input type="number" class="form-control input-txt" name="item_code" onkeyup="check_duplication_code()" id="item_code" placeholder="Generate/Enter Item Code.">
                   </div>
                   <div class="col-sm-3 mt-4" id="barcode-btn">
                     <button class="btn btn-success mt-2 btn-barcode">Generate</button>
                   </div>
                 </div>
                  <div id="item-code-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Item Name</label>
                  <input type="text" class="form-control input-txt" name="item_name" onkeyup="check_duplication()" id="item_name" placeholder="Enter Item Name.">
                  <div id="item-name-error-msg-div"></div>
                </div>
              </div>
              <!--  -->
              <div class="row mt-3">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Product MRP</label>
                  <input type="number" class="form-control input-txt" name="product_mrp" id="product_mrp" placeholder="Enter Product MRP.">
                  <div id="mrp-price-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Retail Price</label>
                 <!--  <div class="row">
                    <div class="col-sm-6">
                      <input type="number" class="form-control input-txt"  name="retail_price_percentage" disabled placeholder="Enter Retail percentage" id="retail_price_percentage">
                    </div>  
                    <div class="col-sm-6"> -->
                       <input type="text" class="form-control input-txt"  name="retail_price" id="retail_price" placeholder="Enter Retail Price">
                      
                  <!--   </div>                  
                  </div> -->
                  <!-- <select class="form-control input-txt" name="sale_tax_price" id="sale_tax_price" >
                    <option value="exclude">Exclude</option> 
                    <option value="include">Include</option> 
                  </select> -->
                  <div id="retail-price-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Wholesale Price</label>
                   <!-- <div class="row">
                    <div class="col-sm-6">
                      <input type="number" class="form-control input-txt" disabled  name="wholesale_price_percentage" placeholder="Enter Wholesale percentage" id="wholesale_price_percentage">
                    </div>  
                    <div class="col-sm-6">  -->
                  <input type="number" class="form-control input-txt"  name="wholesale_price" id="wholesale_price" placeholder="Enter Wholesale Price.">
                  <!--   </div>                  
                  </div> -->
                  <div id="wholesale-price-error-msg-div"></div>
                </div>
                <div class="col-sm-6 d-none">
                  <label class="product-details-span-light">Purchase Price</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="number" class="form-control input-txt"   name="purchase_price_percentage" placeholder="Enter Purchase percentage" id="purchase_price_percentage">
                    </div>  
                    <div class="col-sm-6"> 
                  <!-- <input type="number" class="form-control input-txt" name="wholesale_price" id="wholesale_price" placeholder="Enter Wholesale Price."> -->
                  <input type="number" class="form-control input-txt"  name="purchase_price" id="purchase_price" placeholder="Enter Purchase Price.">
                    </div>                  
                  </div>
                  <div id="purchase-price-error-msg-div"></div>
                </div>
                <!-- <div class="col-sm-3">
                  <label class="product-details-span-light">Purchase TAX Type</label>
                  <select class="form-control input-txt" name="purchase_tax_type" id="purchase_tax_type" >
                    <option value="exclude">Exclude</option> 
                    <option value="include">Include</option> 
                  </select>
                  <div id="purchase-tax-type-error-msg-div"></div>
                </div> -->
              </div>
              <!--  -->
              <div class="row mt-3">
                <div class="col-sm-3">
                   <label class="product-details-span-light">Select TAX Rate</label>
                  <select class="form-control input-txt" name="select_tax_rate" id="select_tax_rate" >
                    <option value="">Select GST RATE</option>
                    <?php foreach ($gst as $key => $value) {
                      echo "<option value='".$value['gst_value']."'>".$value['gst_name']."</option>";
                    } ?>
                  </select>
                  <div id="select-tax-rate-error-msg-div"></div>
                </div>
                
                <div class="col-sm-3 d-none">
                  <label class="product-details-span-light">Opening quantity</label>
                  <input type="text" class="form-control input-txt" name="opening_quantity" id="opening_quantity" placeholder="Enter Opening quantity.">
                  <div id="opening-quantity-error-msg-div"></div>
                </div>
               
                <div class="col-sm-3 d-none">
                  <label class="product-details-span-light">Date</label>
                  <input type="text" class="form-control input-txt" readonly="" name="date" id="date" value="<?php echo date('Y-m-d');?>" placeholder="Enter date.">
                  <div id="date-error-msg-div"></div>
                </div>
                <div class="col-sm-3">
                  <label class="product-details-span-light">Minimum Stock</label>
                  <input type="number" class="form-control input-txt" name="minimum_stock" id="minimum_stock" placeholder="Enter Minimum Stock.">
                  <div id="minimum-stock-error-msg-div"></div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12 text-center">
                  <div class="text-center" id="product-error"></div>
                </div>
                <div class="col-md-12 text-right">
                  <button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn">Cancel</button>
                  <button class="btn btn-add btn-add-2 text-white mt-0" onclick="saveProducts()" id="add_new_product_btn" name="add_new_product_btn">Add</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<!-- Custome JS -->
 
<script src="<?php echo base_url()?>assets/customeJS/product/add-product.js"></script>