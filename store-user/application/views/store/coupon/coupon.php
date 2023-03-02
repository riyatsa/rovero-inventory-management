
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="/" class="header-left-tab-a">Store Panel / </a>
              <span class="header-left-tab-span">Coupon</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         <!--  <div class="col-md-3 d-none">
            <div class="sticky-top sticky-top-filter">
              <div class="col-padding-filter-layout">
                <span class="text-danger" id="filter-error"></span>
                <span class="d-block medium-text">Filter By</span>
                <span class="d-block small-text-1">Date</span>
                <div class="input-group input-group-custom-filter mt-2">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom">
                      <span class="fa-custom-filter">From</span>
                    </div>
                  </div>
                  <input type="text" class="form-control main-input-txt input-filter input-filter-date mdate" id="date_from" name="date_from">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom">
                      <span class="fa fa-calendar fa-custom-filter"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group input-group-custom-filter mt-2">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom input-group-text-to">
                      <span class="fa-custom-filter">To</span>
                    </div>
                  </div>
                  <input type="text" class="form-control main-input-txt input-filter input-filter-date mdate" id="date_to" name="date_to">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom">
                      <span class="fa fa-calendar fa-custom-filter"></span>
                    </div>
                  </div>
                </div>
                <span class="d-block small-text-1 mt-3">Discount</span>
                <div class="input-group input-group-custom-filter mt-2">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom">
                      <span class="fa-custom-filter">From </span>
                      <span class="fa-custom-filter fa-custom-filter-2 pl-2">%</span>
                    </div>
                  </div>
                  <input type="text" class="form-control main-input-txt input-filter input-discount-filter" id="discount_from" name="discount_from" placeholder="0">
                </div>
                <div class="input-group input-group-custom-filter mt-2">
                  <div class="input-group-append">
                    <div class="input-group-text input-group-text-custom">
                      <span class="fa-custom-filter">To</span>
                      <span class="fa-custom-filter fa-custom-filter-2 pl-2">%</span>
                    </div>
                  </div>
                  <input type="text" class="form-control main-input-txt input-filter input-discount-filter" id="discount_to" name="discount_to" placeholder="0">
                </div>
                <button class="btn btn-filter btn-block text-white" onclick="get_filter()" id="filter_coupon_btn" name="filter_coupon_btn">Filter</button>
                 <button class="btn btn-filter btn-block text-white" onclick="get_reset()" id="filter_coupon_btn" name="filter_coupon_btn">Reset</button>
              </div>
            </div>
          </div> -->
          <div class="col-md-12">
            <div class="col-padding-main-layout">
              <span class="d-block medium-text">Add Coupon</span>
              <div class="row mt-4">
                <div class="col-md-4">
                  <select class="input-txt" name="coupon_category_type" id="coupon_category_type">
                    <option value="">Select Coupon Type</option>
                    <option value="0">Discount in percentage</option>
                    <option value="1">Discount in amount</option>
                  </select>
                  <div id="coupon_category_error_div"></div>
                </div>
                <div class="col-md-4">
                  <input type="text" class="input-txt" name="coupon_name" id="coupon_name" placeholder="Coupon Name">
                  <div id="coupon_name_error"></div>
                </div>
                <div class="col-md-4">
                  <input type="text" class="input-txt" name="coupon_code" id="coupon_code" placeholder="Coupon Code">
                  <div id="coupon_code_error"></div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-md-4">
                  <input type="text" class="input-txt" name="discount_percentage_amount" id="discount_percentage_amount" placeholder="" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" disabled>
                  <div id="coupon_discount_error"></div>
                </div>
                <div class="col-md-4">
                  <input type="text" class="input-txt" name="coupon_min_purchase_price" id="coupon_min_purchase_price" placeholder="Minimum purchase amount" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" >
                  <div id="coupon_min_pruchase_price_error_div"></div>
                </div>
                <div class="col-md-4">
                  <div class="input-group input-group-custom-main">
                    <input type="text" class="form-control main-input-txt input-coupon-date date-min-today" name="expiry_date" id="expiry_date" placeholder="Expiry Date">
                    <div class="input-group-append">
                      <div class="input-group-text input-group-text-custom-2">
                        <span class="fa fa-calendar fa-custom-filter"></span>
                      </div>
                    </div>
                  </div>
                  <div id="coupon_expiry_date_error"></div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mt-3" id="coupen-error"></div>
                <div class="col-md-12 mt-3 text-right">
                  <button class="btn btn-add text-white" id="add_coupon" onclick="addcoupen()" name="add_coupon">Add</button>
                </div>
              </div>
              <div class="custom-border"></div>
              <div class="text-center" id="coupen-status"></div>
              <span class="d-block medium-text mt-3 mb-3">All Coupons</span>

              <div class="table-responsive" id="">
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>Coupon Name</th>
                      <th>Coupon Code</th>
                      <th>Discount type</th>
                      <th>Discount of</th>
                      <th>Expiry Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="coupen_data">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Edit Coupon Modal Starts -->
  <div class="modal fade" id="edit_coupon">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Edit Coupon</h4>
        </div>
        <input type="hidden" name="edit_coupen_id" id="edit_coupen_id">
        <div class="modal-body modal-body-edit-coupon">
          <div class="row">
            <div class="col-md-4">
              <select class="input-txt" name="edit_coupon_category_type" id="edit_coupon_category_type"></select>
              <div id="edit_coupon_category_error_div"></div>
            </div>
            <div class="col-md-4">
              <input type="text" class="input-txt" name="edit_coupon_name" id="edit_coupon_name" placeholder="Coupon Name">
              <div id="edit_coupon_name_error"></div>
            </div>
            <div class="col-md-4">
              <input type="text" class="input-txt" name="edit_coupon_code" id="edit_coupon_code" placeholder="Coupon Code">
              <div id="edit_coupon_code_error"></div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-4">
              <input type="text" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="input-txt" name="edit_discount_percentage_amount" id="edit_discount_percentage_amount" placeholder="">
              <div id="edit_coupon_discount_error"></div>
            </div>
            <div class="col-md-4">
              <input type="text" class="input-txt" name="edit_coupon_min_purchase_price" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="edit_coupon_min_purchase_price" placeholder="Minimum purchase amount">
              <div id="edit_coupon_min_pruchase_price_error_div"></div>
            </div>
            <div class="col-md-4">
              <div class="input-group input-group-custom-main input-group-custom-edit">
                <input type="text" class="form-control main-input-txt input-coupon-date date-min-today" name="edit_expiry_date" id="edit_expiry_date" placeholder="Expiry Date">
                <div class="input-group-append">
                  <div class="input-group-text input-group-text-custom-2">
                    <span class="fa fa-calendar fa-custom-filter"></span>
                  </div>
                </div>
              </div>
              <div id="edit_coupon_expiry_date_error"></div>
            </div>
          </div>
          <div id="edit_coupen_error_modal" class="text-center mt-3"></div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="edit-coupon-close-btn" name="edit-coupon-close-btn" data-dismiss="modal">Close</button>
          <button class="btn btn-add text-white mt-0" onclick="edit_coupon_btn()" id="edit_coupon_btn" name="edit_coupon_btn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Coupon Modal Ends -->

   <!-- Custome JS -->
  
<script src="<?php echo base_url()?>assets/customeJS/store/coupon/couponJs.js"></script>
<!-- <script src="<?php echo base_url()?>assets/customeJS/test-couponJs.js"></script> -->