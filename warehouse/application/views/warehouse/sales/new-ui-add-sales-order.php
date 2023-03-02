 <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <label>
               <a href="#" class="header-left-tab-a">Rover / </a>
  <!-- <script src="http://localhost/supermarket/assets/customeJS/store/notificationJS.js"></script> -->
 
               <span class="header-left-tab-span">Create Bill</span>
               </label>
            </div>
         </div>
      </div>
   </div>
 <?php $sessionData = $this->session->userdata('logged_in_warehouse');?>
   <style>
     .autocomplete {
      position: relative;
      display: inline-block;
   } 
   .autocomplete-items {
      /*position: absolute;*/
      border-bottom: none;
      border-top: none;
      z-index: 99;
      top: 100%;
      left: 0;
      right: 0;
   }
   .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      border: 1px solid #8e26d4;
      border-bottom: 1px solid #d4d4d4;
   }
   .autocomplete-items div:hover {
      background-color: #e9e9e9;
   }
   .autocomplete-active {
      background-color: rgb(30, 255, 169) !important;
      color: #ffffff;
   }
</style>
   <section class="content">
      <div class="container-fluid">
         <div class="product-tabs-container">
           <!--  <ul class="nav nav-tabs" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#">Add Purchase Order</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab" href="?/PurchaseOrder/purchsedetails" >View All Purchase Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/PurchaseOrder/storePurchsedetails" >Store Purchase Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/PurchaseOrder/store_return_order" >Return Store Purchase Order</a>
            </li>
          </ul> -->
            <ul class="nav nav-tabs" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="?/SalesOrder">Add Sales Order</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/SalesOrder/sales_details" >View All Sales Order</a>
            </li>
                     <li class="nav-item d-none">
              <a class="nav-link nav-link-product-tab" href="?/SalesOrder/re_approve_details" >View Re-Approve Sales Order</a>
            </li>
          </ul>
         <section class="billing">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-9">
                  <div class="bill-box">
                     <div class="row">
                        <div class="col-md-5">
                           <label class="radio-inline">
                              <input type="radio" id="invoice_type_wholesale" name="invoice_type" checked value="1">Whole Sale
                           </label>
                           <label class="radio-inline ml-4">
                              <input type="radio" id="invoice_type_retail" name="invoice_type"value="0">Retail
                           </label>
                        </div>
                        <div class="col-md-5">
                           <label class="radio-inline">
                              <input type="radio" id="is_contact_registered" name="is_contact" checked value="1">User Contact
                           </label>
                           <label class="radio-inline ml-4">
                              <input type="radio" id="is_contact_unregistered" name="is_contact" value="0">Outlet
                           </label>
                            <!-- <label>Warehouse</label> -->
                          <!--  <input type="hidden" name="party_id" id="bill_state_id">
                           <select class="select2" id="search_field_warehouse" onchange="get_autocomplete(this.value)">
                           <?php 
                             if (count($store) > 0) {
                               foreach ($store as $key => $value) {
                                 echo "<option value='".$value['storeId']."'>".$value['storeName']."</option>";
                               }
                             }
                             ?>
                           </select> -->
                        </div>

                      <!--   <div class="col-md-2 bal-point d-none" id="div-point">
                           <h3>Balance Point : <span id="customer_points">0</span> </h3>
                           <button id="point_button" class="btn btn-info" style="display: none;" onclick="apply_points()">Apply</button>
                           <input type="hidden" class="form-control tp-fld" name="customer_point_apply" id="customer_point_apply" value="0">
                              <input type="hidden" class="form-control tp-fld" name="customer_point_less" id="customer_point_less" value="0">
                           <input type="hidden" name="threshold_balance" id="threshold_balance" value="<?php echo $threshold['threshold_balance']?>">  
                           <input type="hidden" name="threshold_bill_amount" id="threshold_bill_amount" value="<?php echo $threshold['threshold_bill_amount']?>">  
                           <input type="hidden" name="percent" id="percent" value="<?php echo $threshold['percent']?>">
                        </div> -->
                     </div>
                     <div class="row mt-3">
                        <div class="col-md-4 pl-0 fill" id="div-number">
                           <span><i class="fa fa-mobile bg-icon" aria-hidden="true"></i></span> <input type="number" name="contact_no" id="contact_no" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Customer Phone Number">
                           <div id="address-phone-number-error-msg-div"></div>
                           <div id="phone-number-info-msg-div"></div>
                        </div>
                        <div class="col-md-4 fill" id="div-name">
                           <span><i class="fa fa-users bg-icon" aria-hidden="true"></i></span>
                           <input type="text" placeholder="Customer Name" name="customer_name" id="customer_name">
                           <div id="customer_name-error-msg-div"></div>
                        </div>
                        <div class="col-md-4 fill" id="customer-option" style="display: none;">
                           <input type="hidden" name="party_id" id="bill_state_id">
                           <select class="select2" id="search_field_warehouse" >
                           <?php 
                             if (count($store) > 0) {
                               foreach ($store as $key => $value) {
                                 echo "<option data-gst_number='{$value['gstinNumber']}' data-id='{$value['storeId']}' value='".$value['storeName']."'>".$value['storeName']."</option>";
                               }
                             }
                             ?>
                           </select>
                        </div>

                         <div class="col-md-4 fill" id="div-gst">
                           <span><i class="fa fa-calendar bg-icon" aria-hidden="true"></i></span>
                           <input type="text" placeholder="Enter GST Number" name="customer_gst_number" id="customer_gst_number"> 
                        </div>

                        <!-- <div class="col-md-12" id="customer-credit-point" style="display:none;">
                           
                        </div> -->
                        <!-- <div class="col-md-2 pl-0 bal-point" id="div-point">
                           <h3>Balance Point : <span id="customer_points">0</span> </h3>
                           <button id="point_button" class="btn btn-info" style="display: none;" onclick="apply_points()">Apply</button>
                           <input type="hidden" class="form-control tp-fld" name="customer_point_apply" id="customer_point_apply" value="0">
                              <input type="hidden" class="form-control tp-fld" name="customer_point_less" id="customer_point_less" value="0">
                           <input type="hidden" name="threshold_balance" id="threshold_balance" value="<?php echo $threshold['threshold_balance']?>">  
                           <input type="hidden" name="threshold_bill_amount" id="threshold_bill_amount" value="<?php echo $threshold['threshold_bill_amount']?>">  
                           <input type="hidden" name="percent" id="percent" value="<?php echo $threshold['percent']?>">
                        </div> -->
                        <div class="col-md-3">
                           <div class="form-group mb-0 d-none">
                              <label class="tp-txt">Customer Address</label>
                              <textarea class="form-control tp-fld" id="customer_address" placeholder="Enter Address"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="bod-bot"></div>
                     <div class="row mt-4 mb-2">
                        <div class="col-md-9 fill2">
                           <input type="text" placeholder="Search by item name / code" id="selected-item-name">
                           <div id="selected-item-name-error-msg-div"></div>
                           <input type="hidden" id="selected-item-product-id">
                        </div>
                        <div class="col-md-3 pl-0 fill">
                           <button id="add-new-item-btn">Add</button>
                        </div>
                     </div>
                  </div>
                  <div class="text-center" id="price-error"></div>
                  <!--Table-->
                  <div class="lft-mar">
                     <table id="table-bill" class="table table-bill table-striped mt-4">
                        <thead>
                           <tr>
                              <th width="25%" rowspan="2" scope="col">Item</th>
                              <th width="9%" rowspan="2" scope="col">Item Code</th>
                              <th width="7%" rowspan="2" scope="col">Qty</th>
                              <th width="9%" rowspan="2" scope="col">Available Qty</th>
                              <th class="d-none" width="7%" rowspan="2" scope="col">Unit</th>
                              <th  width="7%" rowspan="2" scope="col">MRP</th>
                              <th width="7%" rowspan="2" scope="col" class="price aln-cntr-price">
                                 Price / Unit
                                 <div class="tax">
                                    <div class="form-group d-none">
                                      <select class="form-control tax-fld"  id="tax_type" >
                                         <option value="0">Tax Included</option>
                                         <option value="1">Tax Excluded</option>
                                      </select>
                                    </div>
                                 </div>
                              </th>
                              <th colspan="2" align="center" scope="col" class="aln-cntr d-none">Discount</th>
                              <th colspan="2" scope="col" class="aln-cntr">Tax</th>
                              <th width="10%" rowspan="2" valign="middle" scope="col">Amount</th>
                              <th width="5%" rowspan="2" scope="col">Actions</th>
                           </tr>
                           <tr>
                              <th class="d-none"  width="7%" scope="col" class="aln-cntr">%</th>
                              <th  class="d-none" width="5%" scope="col" class="aln-cntr aln-cntr-amt">Amount</th>
                              <th width="10%" scope="col" class="aln-cntr">%</th>
                              <th scope="col" class="aln-cntr aln-cntr-amt">Amount</th>
                           </tr>
                        </thead>
                        <tbody id="tbody-bill"></tbody>
                     </table>
                  </div>
                   <div class="row lft-mar">
                     <div class="col-md-12">
                        <a href="#" class="view mt-3" onclick="view_all_items_modal()" >
                           <i class="fa fa-eye eye" aria-hidden="true"></i> View all Items
                        </a>
                     </div>
                  </div>
                 <!--  <div class="row mt-3">
                   <div class="col-md-12">
                     <div class="custom-file-input">
                       <input type="file" id="product_images" name="product_images[]" multiple="multiple" class="input-file" >
                       <button class="btn btn-file-upload text-white">Upload Attachment</button>
                     </div>
                     <span class="max-image-upload-note d-block">*Max-Min 5 Images</span>
                   </div>
                 </div>
                 <div class="row" id="selectedFiles">
                 </div> -->
                  <!--Table-->
                 
                  <div class="row fixed-bottom billing-date-venue-div">
                     <div class="col-md-2 pl-0">
                        <input id="bill_date" type="hidden" value="<?php echo date('Y-m-d') ?>">
                        <p class="bill-detail">Date : <?php echo date('Y-m-d') ?></p>
                     </div>
                     <div class="col-md-6">
                        <input id="customer_city" type="hidden" value="<?php echo $sessionData['city']?>">
                         <input id="bill_state" type="hidden" value="<?php echo $sessionData['state']?>">
                         <input id="customer_pincode" type="hidden" value="<?php echo $sessionData['pincode']?>">
                        <p class="bill-detail"><?php echo $sessionData['city']?> - <?php echo $sessionData['state']?> - <?php echo $sessionData['pincode']?></p>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 pr-0">
                  <div class="bill-sum">
                     <h3>Bill Summary</h3>
                     <p>Total amount and coupon applied</p>
                     <div class="row tol-del mt-4">
                       <div class="col-md-12 pl-0 bal-point" id="div-point">
                           <p>Balance Point : <span id="customer_points">0</span> </p>
                           <button id="point_button" class="btn btn-info" style="display: none;" onclick="apply_points()">Apply</button>
                           <input type="hidden" class="form-control tp-fld" name="customer_point_apply" id="customer_point_apply" value="0">
                              <input type="hidden" class="form-control tp-fld" name="customer_point_less" id="customer_point_less" value="0">
                           <input type="hidden" name="threshold_balance" id="threshold_balance" value="<?php echo $threshold['threshold_balance']?>">  
                           <input type="hidden" name="threshold_bill_amount" id="threshold_bill_amount" value="<?php echo $threshold['threshold_bill_amount']?>">  
                           <input type="hidden" name="percent" id="percent" value="<?php echo $threshold['percent']?>">
                        </div>
                     </div>
                     <div class="row tol-del mt-2" id="customer-credit-point" style="display:none;"> 
                     </div>
                     <div class="row tol-del mt-4">
                        <div class="col-md-7">
                           <p>Total Items</p>
                        </div>
                        <div class="col-md-5 pl-0">
                           <input type="text" class="text-right" id="total_quantity_count" readonly placeholder="0" value="0">
                        </div>
                     </div>
                     <div class="row tol-del mt-3">
                        <div class="col-md-7">
                           <p>Total Amount (INR)</p>
                        </div>
                        <div class="col-md-5 pl-0">
                           <input type="text" class="text-right" placeholder="0" value="0" readonly id="total_amount">
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-md-12">
                           <div class="cop-code">
                              <input type="text" placeholder="Coupon Code" id="CouponCode">
                              <button id="coupon-code-btn" onclick="valid_coupon()">Apply</button>
                              <input type="hidden" id="applied_coupon_type" value="0">
                              <input type="hidden" id="coupon_code" value="0">
                              <input type="hidden" id="order_discounted_percentage" value="0">
                              <input type="hidden" id="order_discounted_price" value="0.00">
                           </div>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-md-12">
                           <div class="cop-code" id="referel-div">
                              <input type="text" placeholder="Referal" id="referral"> 
                              <input type="hidden" id="referrel_code" name="referrel_code" value="0">
                              <button onclick="valid_referral()">Apply</button>
                           </div>
                           <div class="text-center" id="error-referral"></div>
                        </div>
                     </div>
                     <div class="row mt-4">
                        <div class="col-md-12">
                           <div class="cop-code">
                              <select class="w-100" id="payment_type">
                                 <option selected="">Cash</option>
                                 <option>Credit</option>
                                 <option>Cheque</option>
                                 <option>Online</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-md-12">
                           <div class="cop-code">
                              <input type="text" class="w-100" style="display: none;" placeholder="Reference Number" id="reference_no">
                           </div>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-md-12">
                           <div class="cop-code">
                              <textarea class="w-100">Description</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="row tol-del mt-3">
                        <div class="col-md-7">
                           <p>Grand Total (INR)</p>
                        </div>
                        <div class="col-md-5 pl-0">
                           <input type="text" class="text-right" placeholder="0" value="0" readonly id="main_total_amount">
                        </div>
                     </div>
                     <div class="row tol-del mt-3">
                        <div class="col-md-5">
                           <p>Paid</p>
                        </div>
                        <div class="col-md-7 pl-0">
                           <input type="number" oninput="this.value = Math.abs(this.value)" min="0" class="text-right" placeholder="0" onkeyup="paid_amounts()" value="0" id="paid_price">
                           <div id="paid-warnign-msg"></div>
                        </div>
                     </div>
                     <div class="row tol-del mt-3">
                        <div class="col-md-6">
                           <p>Balance</p>
                        </div>
                        <div class="col-md-6">
                           <p id="balance_total" class="text-right mr-2">0</p>
                        </div>
                     </div>
                     <div class="row tol-del mt-4">
                        <div class="col-md-6 pr-2">
                           <!-- <button id="hold-product-order" class="hold" onclick="save_product_order_confirm(3)">HOLD</button> -->
                        </div>
                        <div class="col-md-6 pl-2">
                           <button id="save-product-order" class="save" onclick="save_product_order_confirm()">SAVE</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
         </div>
      </div>
   </section>
</div>

<div class="modal" id="view-all-items-modal">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">

         <!-- Modal Header -->
         <div class="modal-header">
            <h4 class="modal-title">All Items</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>

         <!-- Modal body -->
         <div class="modal-body">
             <div class="lft-mar">
                     <table id="table-bill" class="table table-bill table-striped mt-4">
                        <thead>
                           <tr>
                              <th width="25%" rowspan="2" scope="col">Item</th>
                              <th width="9%" rowspan="2" scope="col">Item Code</th>
                              <th width="7%" rowspan="2" scope="col">Qty</th>
                              <th width="9%" rowspan="2" scope="col">Available Qty</th>
                              <th class="d-none" width="7%" rowspan="2" scope="col">Unit</th>
                              <th  width="7%" rowspan="2" scope="col">MRP</th>
                              <th width="7%" rowspan="2" scope="col" class="price aln-cntr-price">
                                 Price / Unit
                                 <div class="tax">
                                    <div class="form-group d-none">
                                      <select class="form-control tax-fld"  id="tax_type" >
                                         <option value="0">Tax Included</option>
                                         <option value="1">Tax Excluded</option>
                                      </select>
                                    </div>
                                 </div>
                              </th>
                              <th colspan="2" align="center" scope="col" class="aln-cntr d-none">Discount</th>
                              <th colspan="2" scope="col" class="aln-cntr">Tax</th>
                              <th width="10%" rowspan="2" valign="middle" scope="col">Amount</th>
                              <th width="5%" rowspan="2" scope="col">Actions</th>
                           </tr>
                           <tr>
                              <th class="d-none"  width="7%" scope="col" class="aln-cntr">%</th>
                              <th  class="d-none" width="5%" scope="col" class="aln-cntr aln-cntr-amt">Amount</th>
                              <th width="10%" scope="col" class="aln-cntr">%</th>
                              <th scope="col" class="aln-cntr aln-cntr-amt">Amount</th>
                           </tr>
                        </thead>
                        <tbody id="all-items-list"></tbody>
                     </table>
                  </div>
         </div>

         <!-- Modal footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>

      </div>
   </div>
</div>

<!-- confirm field Starts -->
  <div class="modal fade" id="view_order_confirm">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Are you sure want to conform this order ?</h4>
        </div> 
         
        <div class="modal-footer border-0" id="confirm-order">
          
        </div>
      </div>
    </div>
  </div>  
<!--Add confirm field Ends -->






<!-- Edit Coupon Modal Starts -->
  <div class="modal fade" id="display-credit-history">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0"> 
          <h4 class="modal-title-edit-coupon">Customer Credit</h4> 
        </div>
        <input type="hidden" name="edit_Customer_id" id="edit_Customer_id">
        <div class="modal-body modal-body-edit-coupon">
            <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">  
              <div class="row" id="">
              <span class="d-block medium-text mb-2">Customer Credit</span>
                <table class="table">
                  <thead >
                    <tr>
                      <th>Sr No.</th>
                      <th>Customer Name</th>
                      <th>Phone Number</th>
                      <th>Bill Number</th>
                      <th>Balance</th> 
                      <th>Date</th> 
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="get_credit_order">
                     <!-- Dynamic able will come here -->
                  </tbody>
                </table>
              </div> 

            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="edit-Customer-close-btn" name="edit-Customer-close-btn" data-dismiss="modal">Close</button> 
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Coupon Modal Ends -->


  
  
<div class="modal fade view_store_bill" id="display-calc-data">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Post Paid Bill</h4>
        </div>
        <div class="modal-body">
           <div class="row">
             <div class="col-sm-12">
               <label>Credited Bill<br/></label> 
             </div>
             <div class="col-sm-12">
               <span id="credited_bill">0</span>
             </div>
             <div class="col-sm-12">
               <label>Pay Amount</label>
               <input class="form-control" type="text" name="pay_amount" id="pay_amount">
               <input type="hidden" name="sales_id" id="sales_id">
                <input type="hidden" name="role" id="role">
               <input type="hidden" name="bill_number" id="bill_number">
               <div id="pay-amount-error">&nbsp;</div>
             </div>
             <div class="col-sm-12 text-right mt-2">
               <button class="btn btn-success" id="post-paid-amount" >Pay</button>
             </div>
           </div>
           
        </div>  
      </div>
    </div>
  </div>




<script src="<?php echo base_url()?>assets/customeJS/purchase-order/new-ui-store-purchase-order.js"></script>

<script>
   $(function() {
      $.ui.autocomplete.prototype._renderMenu = function(ul, items) {
         var self = this;

          var invoice_type = $("input[name='invoice_type']:checked").val();
         var price_type = 0;
         if (invoice_type =='1') { 
             price_type = "Wholesale&nbsp;Price"; 
         } else {
            price_type = "Retail&nbsp;Price"; 
         }
         ul.append("<table class='table-bordered w-100'><thead><tr><th>ID#</th><th>Product&nbsp;Name</th><th>"+price_type+"</th></tr></thead><tbody></tbody></table>");
         $.each( items, function( index, item ) { 
            self._renderItemData(ul, ul.find("table tbody"), item );
         });
      };
      $.ui.autocomplete.prototype._renderItemData = function(ul,table, item) {
         return this._renderItem( table, item ).data( "ui-autocomplete-item", item );
      };
      $.ui.autocomplete.prototype._renderItem = function(table, item) {
         var invoice_type = $("input[name='invoice_type']:checked").val();
         var price = 0;
         if (invoice_type =='1') { 
            price = item.wholesale_price; 
         } else {
            price = item.retail_price; 
         }
         return $( "<tr class='ui-menu-item' role='presentation'></tr>" ).append( "<td >"+item.product_id+"</td>"+"<td>"+item.product_title+"</td>"+"<td>"+price+"</td>" ).appendTo( table);
      }; 

      $('#selected-item-name').on('focus', function (e) {
         var invoice_type = $("input[name='invoice_type']:checked").val();
         if (invoice_type == '') {
            $("#invoice-type-error").html("<span class='text-danger error-msg-small'>Please Select Invoice Type</span>");
            return false;
         } else {
            $("#invoice-type-error").html("");
         }

         $("#invoice-type-error").html("");

         var warehouse_id = $("#search_field_warehouse").val();
         if (warehouse_id =='') {
            $("#price-error").html('<span class="text-danger text-center w-100">Please Select the warehouse.</span>');
            return false;
         }

         $("#selected-item-name").autocomplete({ 
            minLength: 1,
            source: "?/WareHouseProduct/get_order_products/?", 
            select: function( event, ui ) {
               $("#selected-item-name").val(ui.item.product_title);
               $("#selected-item-product-id").val(ui.item.product_id);
               $(".add-new").click();
               $("#selected-item-name").blur();
               return false;
            }
         })
      });
   });
</script>


<!-- new order ui 09-10-2020 -->
<script>
  $("#myinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".myTable").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>
<script>
var input = document.getElementById('myinput');
/*var message = document.getElementsByClassName('newone')[0];
input.addEventListener('focus', function() {
    message.style.display = 'block';
});
input.addEventListener('focusout', function() {
    message.style.display = 'none';
});*/
</script>
      <?php
       $units ='';
       if (isset($unit) && count($unit) > 0) {
         foreach ($unit as $key => $val) { 
            $units .= "<option value='".$val['unit_id']."'>".$val['unit_name']."</option>";
         }
       }
       ?>   
     <?php
      $gsts ='';
     if (isset($gst) && count($gst) > 0) {
       foreach ($gst as $key => $val) { 
          $gsts .= "<option value='".$val['gst_value']."'>".$val['gst_name']."</option>";
       }
     }
     ?>


<script>
   var units = "<?php echo $units; ?>";
   var gsts = "<?php echo $gsts; ?>";
   var actions = $("table td:last-child").html(); 

  function remove_tr(id='') {
   $("#tr_item"+id).remove();
   total_amounts = 0;
   $('.sub_amount').each(function() {
      if ($(this).val() !='' && $(this).val() !=null) {
         total_amounts += parseFloat($(this).val());
      }
   });

   var total_qty =0;
   $(".total_qty").each(function() {
    if ($(this).val() !='' && $(this).val() !=null) {
        total_qty += parseInt($(this).val());
    }
    });

   $("#main_total").html(total_amounts);
   $("#main_total_amount").val(total_amounts);
   $("#total_qty").html(total_qty); 
  }
 
   function oninput_fun(id){
      var qty = $("#qty"+id).val();
      if (/\D/g.test(qty)){
         var qtys = qty.replace(/\D/g,'')
         $("#qty"+id).val(qtys);
      }
   }

   $('table').on('keypress', '.total_qty', function (e) {
      if (e.which === 13) { 
        // $(this).closest('tr').nextAll().eq(0).find('.order_item_code').focus()
        $("#selected-item-name").focus();
      }
   });

   function register_user() {
      var is_contact = $("#is_contact").val();
   }

   $('input[name="is_contact"]').on('click', function() {
      var is_contact = $('input[name="is_contact"]:checked').val();
      if (is_contact == 1) {
         $("#div-number").show();
         $("#div-name").show();
         $("#customer-option").hide();
      } else {
         $("#div-number").hide();
         $("#div-name").hide();
         $("#customer-option").show();
      }
   });
</script> 