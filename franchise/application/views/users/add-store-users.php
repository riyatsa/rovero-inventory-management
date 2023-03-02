
   <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="/" class="header-left-tab-a">Outlet Panel / </a>
              <span class="header-left-tab-span">Outlet Users</span>
            </label>
          </div>
        </div>
      </div>
    </div>
 

    <section class="content">
      <div class="container-fluid"> 
          <span class="d-block medium-text">Add Outlet Users</span>
         <div class="row mt-4">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Outlet User Name</label>
                  <input type="text" class="input-txt" name="werehousename" id="werehousename" placeholder="Enter Store User Name">
                  <div id="werehousename-error-msg-div"></div>
                </div>
                 <div class="col-sm-6">
                  <label class="product-details-span-light">Outlet Role</label>
                  <select class="input-txt" id="w-role">
                    <option value="">Select Role</option>
                    <option value="add_product_user">Product User</option>
                    <option value="salesuser">sales User</option>
                    
                  </select>
                  <div id="w-role-error-msg-div"></div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-6">
                  <label class="product-details-span-light">User Email </label>
                  <input type="text" class="input-txt" name="w-email" id="w-email" placeholder="User Email">
                  <div id="w-email-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Enter Password</label>
                   <input type="password" class="input-txt" name="w-password" id="w-password" placeholder="Enter Your Password">
                  <div id="w-password-error-msg-div"></div>
                </div>
                <div class="col-md-12">
                  <div class="werehouse-error"></div>
                </div>
                <div class="col-md-12 text-right mt-3">
                  <button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn">Cancel</button>
                  <button class="btn btn-add btn-add-2 text-white mt-0" onclick="save_warehouse_user()" id="add_new_product_btn" name="add_new_product_btn">Add</button>
                </div>
              </div>
        <div class="table-responsive mt-3" id="">
        <span class="d-block medium-text">All Store Users</span>
          <table class="datatable table table-striped">
            <thead class="thead-bd-color">
              <tr>
                <th>Sr No.</th>
                <th>User Name</th>
                <th>Email ID</th>
                <th>Role</th> 
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="tbody-datatable" id="warehouse-users"> 
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
 


 <!-- Edit Coupon Modal Starts -->
  <div class="modal fade" id="edit-warehouse-users">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Edit Store User</h4>
        </div>
        <input type="hidden" name="edit_coupen_id" id="edit_coupen_id">
        <div class="modal-body modal-body-edit-coupon">
          <div class="row mt-4">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Store Name</label>
                  <input type="hidden" id="usersId">
                  <input type="text" class="input-txt mt-3" name="edit-werehousename" id="edit-werehousename" placeholder="Enter Store User Name">
                  <div id="edit-werehousename-error-msg-div"></div>
                </div>
                 <div class="col-sm-6">
                  <label class="product-details-span-light">Store Role</label>
                  <select class="input-txt mt-3" id="edit-w-role">
                    <option value="">Select Role</option>
                    <option value="add_product_user">Product User</option>
                    <option value="salesuser">sales User</option>
                    
                  </select>
                  <div id="edit-w-role-error-msg-div"></div>
                </div>
              </div>
              <div class="row mt-2">

                <div class="col-sm-6">
                  <label class="product-details-span-light">User Email </label>
                  <input type="text" class="input-txt mt-3" name="edit-w-email" id="edit-w-email" placeholder="User Email">
                  <div id="edit-w-email-error-msg-div"></div>
                </div>
                <div class="col-sm-6 d-none">
                  <label class="product-details-span-light">Enter Password</label>
                   <input type="password" class="input-txt mt-3" name="edit-w-password" id="edit-w-password" placeholder="Enter the password">
                  <div id="edit-w-password-error-msg-div"></div>
                </div>
                <div class="col-md-12">
                  <div class="edit-werehouse-error"></div>
                </div> 
              </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="edit-coupon-close-btn" name="edit-coupon-close-btn" data-dismiss="modal">Close</button>
          <button class="btn btn-add text-white mt-0" onclick="edit_update_warehouse_btn()" id="edit-user" name="edit-user">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Coupon Modal Ends -->
 
   <!-- Custome JS -->
  
<script src="<?php echo base_url()?>assets/customeJS/users/add-store-users.js"></script> 