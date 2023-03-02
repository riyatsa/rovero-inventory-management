  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Outlet Panel / </a>
              <span class="header-left-tab-span">Outlet Product</span>
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
              <a class="nav-link active nav-link-add-product nav-link-product-tab" href="#" >Add Product</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab d-none" href="?/StoreProduct/bulk_add_product">Add Bulk Product</a>
            </li>
              <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/ProductList/details" >View All Product</a>
            </li>

          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
              <div class="row mt-4">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Select Warehouse</label>
                <select id="select_warehouse" class="form-control input-txt float-right">
                 <option selected value="">Select Warehouse</option>
                 <?php 
                 if (count($warehouse) > 0) {
                   foreach ($warehouse as $key => $value) {
                     echo "<option value='".$value['warehouseId']."'>".$value['warehouseName']."</option>";
                   }
                 }
                 ?>
               </select>
                </div>
                <div class="col-sm-6">
                <label class="product-details-span-light">Warehouse Product</label>
                <select id="get_products" class="select2 form-control input-txt float-right">
                 <option selected value="">Select Product</option>
                 
               </select>
                </div>

                <div class="col-sm-6">
                  <label class="product-details-span-light mt-3">Select Product Category</label>
                  <select class="form-control input-txt" name="select_product_category" id="select_product_category" >
                    <option value="">Select Category</option>
                    <?php foreach ($category as $key => $value) {
                      echo "<option value='".$value['category_id']."'>".$value['category_name']."</option>";
                    } ?>
                  </select>
                  <div id="select-category-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light mt-3">Select Unit</label>
                  <select class="form-control input-txt" name="select_unit" id="select_unit" >
                    <option value="">Select Unit</option>
                    <?php foreach ($unit as $key => $value) {
                      echo "<option value='".$value['unit_id']."'>".$value['unit_name']."</option>";
                    } ?>
                  </select>
                  <div id="select_unit-error-msg-div"></div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Item Code</label>
                  <input type="number" class="form-control input-txt" name="item_code" onkeyup="get_barcode_single_product()" id="item_code" placeholder="Enter Item Code.">
                  <div id="item-code-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Item Name</label>
                  <input type="text" class="form-control input-txt" name="item_name" id="item_name" placeholder="Enter Item Name.">
                  <div id="item-name-error-msg-div"></div>
                </div>

                <div class="col-sm-6">
                  <label class="product-details-span-light mt-3">Discount in Percentage </label>
                  <input type="number" class="form-control input-txt" name="discount_in_percent" id="discount_in_percent" min="0" max="100" value="0" placeholder="Enter Discount">
                  <div id="discount_in_percent-error"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light mt-3">Discount in Price</label>
                  <input type="number" class="form-control input-txt" name="discount_in_price" id="discount_in_price" min="0" value="0" placeholder="Enter Discount in Price">
                  <div id="discount_in_price-error"></div>
                </div>
              </div>
              <!--  -->
              <div class="row mt-3">
                <div class="col-sm-3">
                  <label class="product-details-span-light">Sale Price</label>
                  <input type="number" readonly class="form-control input-txt" name="sale_price" id="sale_price" placeholder="Enter Sale Price.">
                  <div id="sale-price-error-msg-div"></div>
                </div>
                <div class="col-sm-3 d-none">
                  <label class="product-details-span-light">Sale TAX Type</label>
                  <select class="form-control input-txt" name="sale_tax_price" id="sale_tax_price" >
                    <option value="exclude">Exclude</option> 
                    <option value="include">Include</option> 
                  </select>
                  <div id="sale-tax-price-error-msg-div"></div>
                </div>
                <div class="col-sm-3">
                  <label class="product-details-span-light">Wholesale Price</label>
                  <input type="number" readonly class="form-control input-txt" name="purchase_price" id="purchase_price" placeholder="Enter Wholesale Price.">
                  <div id="purchase-price-error-msg-div"></div>
                </div>
                <div class="col-sm-3">
                  <label class="product-details-span-light">MRP Price</label>
                  <input type="number" readonly class="form-control input-txt" name="mrp_price" id="mrp_price" placeholder="Enter mrp Price.">
                  <div id="mrp-price-error-msg-div"></div>
                </div>
                <div class="col-sm-3 d-none">
                  <label class="product-details-span-light">Purchase TAX Type</label>
                  <select class="form-control input-txt" name="purchase_tax_type" id="purchase_tax_type" >
                    <option value="exclude">Exclude</option> 
                    <option value="include">Include</option> 
                  </select>
                  <div id="purchase-tax-type-error-msg-div"></div>
                </div>
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
                
                <div class="col-sm-3">
                  <label class="product-details-span-light">Opening quantity</label>
                  <input type="text" class="form-control input-txt" name="opening_quantity" id="opening_quantity" placeholder="Enter Opening quantity.">
                  <div id="opening-quantity-error-msg-div"></div>
                </div>
               
                <div class="col-sm-3">
                  <label class="product-details-span-light">Date</label>
                  <input type="text" readonly class="form-control input-txt" name="date" id="date" placeholder="Enter date.">
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