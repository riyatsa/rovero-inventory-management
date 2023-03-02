  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="/" class="header-left-tab-a">WareHouse Panel / </a>
              <span class="header-left-tab-span">Product Category</span>
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
              <a class="nav-link active nav-link-product-tab" href="#">Add Product Category</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/collections" >Add Our Collections Category</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link nav-link-add-product nav-link-product-tab" href="?/warehouse-product" >Add Product</a>
            </li>
             <li class="nav-item">
              <a class="nav-link  nav-link-product-tab" href="?/WareHouseProduct/bulk_add_product">Add Bulk Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/warehouse-product-details">View All Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab " href="?/warehouse-product-barcode" >View Product Barcode</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-category-tab" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
              <div class="row mt-4">
                <div class="col-sm-8">
                  <input type="text" class="input-txt" name="add_product_category" id="add_product_category" placeholder="Product Category">
                  <div id="category-error"></div>
                </div>
                <div class="col-sm-2">
                  <button class="btn btn-add btn-add-2 text-white mt-0" onclick="addCategory()" id="add_product_category_btn" name="add_product_category_btn">Add</button>
                </div>
              </div>
              <div class="custom-border mt-5 mb-5"></div>
              <div id="edit-product-category-error-div" class="text-center"></div> 
              <span class="d-block medium-text">Product Category Details</span>
              <div class="row" id="productCategoryDetails">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Edit Product Category Modal Starts -->
  <div class="modal fade" id="edit_product_category">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit-category">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Edit Category</h4>
        </div>
        <div class="modal-body modal-body-edit-coupon">
          <div class="row">
            <div class="col-md-7">
              <input type="text" class="input-txt" name="edit_category" id="edit_category" placeholder="Category Name">
              <input type="hidden" name="edit_id" id="edit_id">
              <div id="edit_category_error_msg_div"></div>
            </div>
            <div class="col-md-4">
              <button onclick="updateproductCategory()" class="btn btn-add btn-add-2 text-white mt-0" id="edit_product_category_btn" name="edit_product_category_btn">Save</button>
              <button class="btn btn-default btn-close btn-add-2 ml-2" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0"></div>
      </div>
    </div>
  </div>
  <!-- Edit Product Category Modal Modal Ends -->

  <!-- Delete Product Category Modal Starts -->
  <div class="modal fade" id="delete_product_category">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body modal-body-delete-coupon">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="remove_cat_id" id="remove_cat_id">
              <h4 class="modal-title-delete-product-category">Are you sure you want to delete the category?</h4>
            </div>
            <div class="col-md-6">
              <button class="btn btn-add btn-add-2 text-white mt-0" onclick="deletecategory()" id="delete_product_category_btn" name="delete_product_category_btn">Yes</button>
              <button class="btn btn-default btn-close btn-add-2 ml-2" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Product Category Modal Ends -->
 
  <!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/product/productCategoryJs.js"></script>
