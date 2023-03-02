   
 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Admin Panel / </a>
              <span class="header-left-tab-span">Store</span>
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
              <a class="nav-link  nav-link-add-product nav-link-product-tab" href="?/unit/" >Unit Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#" >Unit Sub Category</a>
            </li>
          </ul>
          <section class="content">
            <div class="container-fluid">
              <div class="text-center" id="customer-status"></div>
              <div class="row">
                  <div class="col-sm-6">
                    <span class="d-block medium-text mt-2">All Unit List</span>
                  </div>
                  <div class="col-sm-6">
                    <button class="btn btn-add text-white float-right" onclick="addUnitSubCategoryModal()" id="add_unit_btn" name="add_unit_btn">Add Unit Category</button>
                  </div>
                  
              </div>
              <div class="table-responsive mt-3" id="">
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>Unit Name</th>
                      <th>Unit Short Name</th> 
                      <th>Active/Deactive</th>
                      <th>Edit</th>
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

<!-- Add unit Modal Starts -->
  <div class="modal fade" id="addUnitSubCategory">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Add unit</h4>
        </div>
        <input type="hidden" name="unit_id" id="unit_id">
        <div class="modal-body modal-body-edit-coupon">
          <div class="row">
            <div class="col-sm-4">
              <label class="product-details-span-light">Unit category</label>
              <select class="input-txt" name="unit_category" id="unit_category">
              </select>
              <div id="unit-category-error-msg-div"></div>
            </div>

            <div class="col-sm-4">
              <label class="product-details-span-light">unit Tag</label>
              <input type="text" class="input-txt" name="add_unit_subcategory_name" id="add_unit_subcategory_name" placeholder="Enter unit Tag">
              <div id="add_unit-name-error-msg-div"></div>
            </div>
            <div class="col-sm-4">
              <label class="product-details-span-light">unit Value</label>
              <input type="text" class="input-txt" name="add_unit_subcategory_value" id="add_unit_subcategory_value" placeholder="Enter unit Value">
              <div id="add_unit_value-error-msg-div"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="add-unit-close-btn" name="add-unit-close-btn" data-dismiss="modal">Close</button>
          <button class="btn btn-add text-white mt-0" onclick="addunitSubCategory()" id="add_unit_btn" name="add_unit_btn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add unit Modal Ends -->


<!-- Edit unit Modal Starts -->
  <div class="modal fade" id="edit_unit_sub_category">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Edit unit</h4>
        </div>
        <input type="hidden" name="unit_id" id="unit_id">
        <div class="modal-body modal-body-edit-coupon">
          <div class="row">
            <div class="col-sm-6">
              <label class="product-details-span-light">unit Tag</label>
              <input type="text" class="input-txt" name="unit_name" id="unit_name" placeholder="Enter unit Tag">
              <div id="unit-name-error-msg-div"></div>
            </div>
            <div class="col-sm-6">
              <label class="product-details-span-light">unit Value</label>
              <input type="number" class="input-txt" name="unit_value" id="unit_value" placeholder="Enter unit Value">
              <div id="unit_value-error-msg-div"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="edit-unit-close-btn" name="edit-store-close-btn" data-dismiss="modal">Close</button>
          <button class="btn btn-add text-white mt-0" onclick="updateunitSubCategoryDetails()" id="edit_unit_btn" name="edit_unit_btn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit unit Modal Ends -->

<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/unit/unitSubCategoryListJs.js"></script> 