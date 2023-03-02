
 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
             <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Warehouse Panel / </a>
              <span class="header-left-tab-span">WareHouse Product List</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="product-tabs-container">
          <ul class="nav nav-tabs" role="tablist"> 
            <li class="nav-item d-none">
              <a class="nav-link nav-link-product-tab" href="#">Add Product Category</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link  nav-link-add-product nav-link-product-tab" href="?/warehouse-product" >Add Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab" href="?/WareHouseProduct/bulk_add_product">Add Bulk Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#" >View All Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab " href="?/warehouse-product-barcode" >View Product Barcode</a>
            </li>
          </ul>
          <section class="content">
            <div class="container-fluid">
              <div class="text-center" id="customer-status"></div>
              <!--  <button class="btn btn-add text-white mt-0 float-right" onclick="addGstModal()" id="add_gst_btn" name="add_gst_btn">Add GST</button> -->
               <select id="color-code" onchange="get_warehouse_product()" class="form-control mt-2 col-sm-2 float-right">
                 <option value="0">All</option>
                 <option value="1">Green</option>
                 <option value="2">Blue</option>
                 <option value="3">Red</option>
               </select>
              <span class="d-block medium-text mt-3 mb-2">All Products</span>
              <div class="table-responsive" id="">
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th class="table-header-width">Product Title</th>
                      <th class="table-header-width">Barcode</th> 
                      <th >Available Stock</th> 
                      <!-- <th>Unit Name</th>  -->
                      <th>MRP Price</th>
                      <th>Retail Price</th>
                      <th>Wholesale Price</th>
                      <th>Purchase Price</th>
                      <th>Activate/ Deactivate</th> 
                      <th>Product Edit</th>
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
 

<!-- Edit GST Modal Starts -->
  <div class="modal fade" id="edit_store">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0"> 
          <h4 class="modal-title-edit-coupon">Edit Product Details</h4>
        </div>
        <input type="hidden" name="product_id" id="product_id">
         <div class="row mt-4">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Select Product Category</label>
                  <select class="form-control input-txt" name="select_product_category" id="select_product_category" >
                    <option value="">Select Category</option>
                    <?php foreach ($category as $key => $value) {
                      echo "<option value='".$value['category_id']."'>".$value['category_name']."</option>";
                    } ?>
                  </select>
                  <div id="select-category-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Select Unit</label>
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
                  <input type="number" class="form-control input-txt" name="item_code" id="item_code" placeholder="Enter Item Code.">
                  <div id="item-code-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Item Name</label>
                  <input type="text" class="form-control input-txt" name="item_name" id="item_name" placeholder="Enter Item Name.">
                  <div id="item-name-error-msg-div"></div>
                </div>
              </div>
              <!--  -->
            <!--   <div class="row mt-3">
                <div class="col-sm-3">
                  <label class="product-details-span-light">Sale Price</label>
                  <input type="number" class="form-control input-txt" name="sale_price" id="sale_price" placeholder="Enter Sale Price.">
                  <div id="sale-price-error-msg-div"></div>
                </div>
                <div class="col-sm-3">
                  <label class="product-details-span-light">Sale TAX Type</label>
                  <select class="form-control input-txt" name="sale_tax_price" id="sale_tax_price" >
                    <option value="exclude">Exclude</option> 
                    <option value="include">Include</option> 
                  </select>
                  <div id="sale-tax-price-error-msg-div"></div>
                </div>

                <div class="col-sm-3">
                  <label class="product-details-span-light">Purchase TAX Type</label>
                  <select class="form-control input-txt" name="purchase_tax_type" id="purchase_tax_type" >
                    <option value="exclude">Exclude</option> 
                    <option value="include">Include</option> 
                  </select>
                  <div id="purchase-tax-type-error-msg-div"></div>
                </div>
              </div> -->
               <!--  -->
               <div class="row mt-3">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Product MRP</label>
                  <input type="number" class="form-control input-txt" name="product_mrp" id="product_mrp" placeholder="Enter Product MRP.">
                  <div id="mrp-price-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Retail Price</label>
                  <!-- <div class="row">
                    <div class="col-sm-6">
                      <input type="number" class="form-control input-txt"  name="retail_price_percentage" placeholder="Enter Retail percentage" id="retail_price_percentage">
                    </div>  
                    <div class="col-sm-6"> -->
                       <input type="text" class="form-control input-txt"  name="retail_price" id="retail_price" placeholder="Enter Retail Price">
                      
                   <!--  </div>                  
                  </div> -->
                  <!-- <select class="form-control input-txt" name="sale_tax_price" id="sale_tax_price" >
                    <option value="exclude">Exclude</option> 
                    <option value="include">Include</option> 
                  </select> -->
                  <div id="retail-price-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Wholesale Price</label>
                  <!--  <div class="row">
                    <div class="col-sm-6"> -->
                      <!-- <input type="number" class="form-control input-txt"  name="wholesale_price_percentage" placeholder="Enter Wholesale percentage" id="wholesale_price_percentage"> -->
                   <!--  </div>  
                    <div class="col-sm-6">  -->
                  <input type="number" class="form-control input-txt"  name="wholesale_price" id="wholesale_price" placeholder="Enter Wholesale Price.">
                 <!--    </div>                  
                  </div> -->
                  <div id="wholesale-price-error-msg-div"></div>
                </div>
                <div class="col-sm-6 d-none">
                  <label class="product-details-span-light">Purchase Price</label>
                 <!--  <div class="row">
                    <div class="col-sm-6">
                      <input type="number" class="form-control input-txt"  name="purchase_price_percentage" placeholder="Enter Purchase percentage" id="purchase_price_percentage">
                    </div>  
                    <div class="col-sm-6">  -->
                  <!-- <input type="number" class="form-control input-txt" name="wholesale_price" id="wholesale_price" placeholder="Enter Wholesale Price."> -->
                  <input type="number" class="form-control input-txt" disabled name="purchase_price" id="purchase_price" placeholder="Enter Purchase Price.">
                   <!--  </div>                  
                  </div> -->
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
                
                <div class="col-sm-3">
                  <label class="product-details-span-light">Available Stock</label>
                  <input type="text" class="form-control input-txt" name="available_quantity" id="available_quantity" placeholder="Enter Available quantity.">
                  <div id="available-quantity-error-msg-div"></div>
                </div>
               
                <div class="col-sm-3 d-none">
                  <label class="product-details-span-light">Date</label>
                  <input type="text" class="date-min-today form-control input-txt" name="date" id="date" placeholder="Enter date.">
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
      
              </div>
        <div class="modal-footer border-0">
          <button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn"  data-dismiss="modal">Cancel</button>
                  <button class="btn btn-add btn-add-2 text-white mt-0" onclick="saveProducts()" id="add_new_product_btn" name="add_new_product_btn">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit GST Modal Ends -->

<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/product/productListJS.js"></script> 