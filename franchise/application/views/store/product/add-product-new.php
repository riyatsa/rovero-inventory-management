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
              <a class="nav-link  nav-link-product-tab d-none"  href="?/StoreProduct/bulk_add_product">Add Bulk Product</a>
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
                <select id="get_products" multiple class="select2 form-control input-txt float-right">
                 <option selected value="">Select Product</option>
                 
               </select>
                </div>
            </div>
               <!--  -->
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
 
<script src="<?php echo base_url()?>assets/customeJS/product/add-product-new.js"></script>