   
 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
             <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Outlet Panel / </a>
              <span class="header-left-tab-span">Product List</span>
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
              <a class="nav-link  nav-link-add-product nav-link-product-tab" href="?/StoreProduct" >Add Product</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab d-none" href="?/StoreProduct/bulk_add_product">Add Bulk Product</a>
            </li>
              <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="?/ProductList/details" >View All Product</a>
            </li>
          </ul>
          <section class="content">
            <div class="container-fluid">

              <div class="text-center" id="customer-status"></div>
               <!-- <button class="btn btn-add text-white mt-0 float-right" onclick="addGstModal()" id="add_gst_btn" name="add_gst_btn">Add GST</button> -->
               <div class="row "> 
                <div class="col-sm-6"></div>
                <select id="select_warehouse" class="col-sm-4 mt-2 form-control input-txt  float-right">
                 <option selected value="">Select Warehouse</option>
                 
               </select>
               <select id="color-code" onchange="get_color()" class="form-control mt-2 col-sm-2 float-right">
                 <option value="0">All</option>
                 <option value="1">Green</option>
                 <option value="2">Blue</option>
                 <option value="3">Red</option>
               </select>
               
               </div>
              <div class="table-responsive mt-3" id="">
              <span class="d-block medium-text mb-2">All Products</span>
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>Product Title</th>
                      <th>Barcode</th> 
                      <th>Quantity</th>  
                      <th>Retail Price</th>
                      <th>Wholesale Price</th>
                      <!-- <th>Purchase Price</th> -->
                      <th>MRP price</th>
                      <th>Product status</th> 
                      <th class="d-none">Edit</th>
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
          <h4 class="modal-title-edit-coupon">Update Stock</h4>
        </div>
        <input type="hidden" name="product_id" id="product_id">
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

           <div class="row mt-3">
            <div class="col-sm-4">
              <label class="product-details-span-light">Purchase Price</label>
              <input type="number" class="form-control input-txt" name="purchase_price" id="purchase_price" placeholder="Enter Purchase Price.">
              <div id="purchase-price-error-msg-div"></div>
            </div>
            <div class="col-sm-4">
              <label class="product-details-span-light">Retail Price</label>
              <input type="number" class="form-control input-txt" name="retail_price" id="retail_price" placeholder="Enter Retail Price.">
              <div id="retail-price-error-msg-div"></div>
            </div>
            <div class="col-sm-4">
              <label class="product-details-span-light">MRP Price</label>
              <input type="number" class="form-control input-txt" name="mrp_price" id="mrp_price" placeholder="Enter MRP Price.">
              <div id="mrp-price-error-msg-div"></div>
            </div>
          </div>

        <div class="row mt-3">
          <div class="col-sm-6">
            <label class="product-details-span-light">Stock Value</label>
            <input type="number" class="form-control input-txt" name="stock" id="stock" placeholder="Enter Item Code.">
            <div id="item-code-error-msg-div"></div>
          </div>
          <div class="col-sm-6">
          </div>
            
        </div>       
        <div class="modal-footer border-0">
          <button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn"  data-dismiss="modal">Cancel</button>
          <button class="btn btn-add btn-add-2 text-white mt-0" onclick="updateStock()" id="add_new_product_btn" name="add_new_product_btn">Update
          </button>
        </div>  
      </div>
    </div>
  </div>

  <!-- Edit GST Modal Ends -->

<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/store/product/productListJS.js"></script> 