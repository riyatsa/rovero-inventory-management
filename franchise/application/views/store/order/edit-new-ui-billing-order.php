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
 <?php $sessionData = $this->session->userdata('logged_in_store');?>
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
            <ul class="nav nav-tabs" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#">Create Bill</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab" href="?/StoreBilling/details">View All Bills</a>
            </li>
                       <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/StoreBilling/hold_bills" >View All Hold Order</a>
            </li>
          </ul>
         <section class="billing">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-9">
                  <div class="bill-box">
                     <div class="row">
                        <div class="col-md-5">
                           <input type="hidden" name="sales_id" id="sales_id" value="<?php echo $order['sales_id']; ?>">
                           <label class="radio-inline">
                              <input type="radio" id="invoice_type_wholesale" name="invoice_type" checked value="1">Whole Sale
                           </label>
                           <label class="radio-inline ml-4">
                              <input type="radio" id="invoice_type_retail" name="invoice_type"value="0">Retail
                           </label>
                        </div>
                        <div class="col-md-5">
                           <label class="radio-inline">
                              <input type="radio" id="is_contact_registered" name="is_contact" checked value="1">Registered
                           </label>
                           <label class="radio-inline ml-4">
                              <input type="radio" id="is_contact_unregistered" name="is_contact" value="0">Unregistered
                           </label>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-md-5 pl-0 fill" id="div-number">
                           <span><i class="fa fa-mobile bg-icon" aria-hidden="true"></i></span> <input type="number" name="contact_no" id="contact_no" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<?php echo $order['customer_mobile_number']; ?>"  placeholder="Customer Phone Number">
                           <div id="address-phone-number-error-msg-div"></div>
                           <div id="phone-number-info-msg-div"></div>
                        </div>
                        <div class="col-md-5 fill" id="div-name">
                           <span><i class="fa fa-users bg-icon" aria-hidden="true"></i></span>
                           <input type="text" placeholder="Customer Name" name="customer_name" value="<?php echo $order['customer_name']; ?>" id="customer_name">
                           <div id="customer_name-error-msg-div"></div>
                        </div>
                        <div class="col-md-2 pl-0 bal-point" id="div-point">
                           <h3>Balance Point : <span id="customer_points">0</span> </h3>
                           <button id="point_button" class="btn btn-info" style="display: none;" onclick="apply_points()">Apply</button>
                           <input type="hidden" class="form-control tp-fld" name="customer_point_apply" id="customer_point_apply" value="0">
                              <input type="hidden" class="form-control tp-fld" name="customer_point_less" id="customer_point_less" value="0">
                           <input type="hidden" name="threshold_balance" id="threshold_balance" value="<?php echo $threshold['threshold_balance']?>">  
                           <input type="hidden" name="threshold_bill_amount" id="threshold_bill_amount" value="<?php echo $threshold['threshold_bill_amount']?>">  
                           <input type="hidden" name="percent" id="percent" value="<?php echo $threshold['percent']?>">
                        </div>
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
                        <tbody id="tbody-bill">
                           <?php

                       /*    SELECT `store_product_id`, `product_id`, `category_id`, `storeId`, `store_user_id`, `store_role`, `product_title`, `unit_id`, `barcode`, `wholesale_price`, `sale_price`, `sale_tax_type`, `purchase_price`, `mrp_price`, `purchase_tax_type`, `tax_rate`, `discount_in_percent`, `discount_in_price`, `quantity`, `opening_quantity`, `at_price`, `date`, `minimum_stock`, `warehouseId`, `main_stock_value`, `iteam_location`, `product_status`, `import_excel`, `created_date`, `updated_date` FROM `store_products` WHERE 1*/
                           $product_id = explode(',', $order['product_id']);
                            $product_name = explode(',', $order['product']);
                            // $product_barcode = explode(',', $order['barcode']);
                            $product_qty = explode(',', $order['quntity']);
                            $product_price = explode(',', $order['price']);
                            $amount = explode(',', $order['amount']);
                            $tax_persent = explode(',', $order['tax_persent']);
                            $tax_price = explode(',', $order['tax_price']);
                            $mrp_price = explode(',', $order['mrp_price']);
                                // $productId = array();
                            // return $amount;
                            $total = 0;
                            $qty = 0;
                            $amount_price = 0; 
                            $tax_price_total =0;
                            $tax_persent_total =0;
                            $grand_total =0;
                            $i = 1;
                              foreach ($product_id as $key => $prId) { 
                                if ($prId !='' && $prId !='0') { 
                                  $barcode = $this->db->query("SELECT barcode,quantity FROM store_products WHERE store_product_id=".$prId)->row_array();
                                $row['barcode'] = isset($barcode['barcode'])?$barcode['barcode']:'';
                                $row['qty'] = isset($barcode['quantity'])?$barcode['quantity']:'';
                           ?>
                           <tr id="tr-item-<?php echo $i; ?>">
                              <td class="newtwo-bx">
                                 <div class="form-group">
                                  <input type="hidden" class="hidden_row" value="0">
                                  <input type="hidden" class="order_product_id" value="<?php echo $prId; ?>" id="order_product_id<?php echo $i; ?>" >
                                    <input class="form-control tbl-fld order_item_name" id="item_name<?php echo $i; ?>" value="<?php echo $product_name[$key]; ?>" type="text" onkeyup="sumMyvalue(<?php echo $i; ?>)" placeholder="Cheri">
                                 </div>
                             
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld order_item_code" type="text" id="item_code<?php echo $i; ?>" value="<?php echo $row['barcode']; ?>" onkeyup="get_barcode_value()" onfocus="get_barcode_value()" placeholder="1234567">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld total_qty" min="0" oninput="this.value = Math.abs(this.value)"   type="number" id="qty<?php echo $i; ?>" value="<?php echo $product_qty[$key]; ?>" onkeyup="sumMyvalue(<?php echo $i; ?>)" placeholder="1">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld ptotal_qty" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" readonly  type="text" id="pqty<?php echo $i; ?>" value="<?php echo $row['qty']; ?>" onkeyup="sumMyvalue(<?php echo $i; ?>)" placeholder="1">
                                 </div>
                              </td>
                              <td class="d-none">
                                 <div class="form-group">
                                    <select class="form-control tbl-fld2 select_unit" onchange="sumMyvalue()" id="select_unit">
                                       <option value="0">None</option>
                                       <?php
                                       $units ='';
                                       if (count($unit) > 0) {
                                         foreach ($unit as $key1 => $val) { 
                                           echo  "<option value='".$val['unit_id']."'>".$val['unit_name']."</option>";
                                         }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                  <input class="form-control tbl-fld mrp_price" value="<?php echo $mrp_price[$key]; ?>" id="mrp_price<?php echo $i; ?>" onkeyup="sumMyvalue(<?php echo $i; ?>)" type="text" placeholder="25" readonly >
                               </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                     <input type="hidden" name="perfect_price" id="perfect_price">
                                    <input class="form-control tbl-fld price" id="price<?php echo $i; ?>" value="<?php echo $product_price[$key];?>" onkeyup="sumMyvalue(<?php echo $i; ?>)" min="0" oninput="this.value = Math.abs(this.value)"  type="number" placeholder="25">
                                   
                                 </div>
                              </td>
                              <td class="d-none">
                                 <div class="form-group">
                                    <input class="form-control tbl-fld discount" onkeyup="sumMyvalue(<?php echo $i; ?>)" id="discount<?php echo $i; ?>" type="text">
                                 </div>
                              </td>
                              <td class="d-none">
                                 <div class="form-group">
                                    <input class="form-control tbl-fld discount_price" onkeyup="sumMyvalue(<?php echo $i; ?>)" id="discount_price<?php echo $i; ?>" type="text">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    
                                    <input type="text" class="form-control tbl-fld2 main_gst" onkeyup="sumMyvalue(<?php echo $i; ?>)" id="main_gst<?php echo $i; ?>" value="<?php echo $tax_persent[$key]; ?>">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld gst_price" onkeyup="sumMyvalue(<?php echo $i; ?>)" type="text" id="gst_price<?php echo $i; ?>" value="<?php echo $tax_price[$key]; ?>" placeholder="1.25">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld sub_amount" type="text" onkeyup="sumMyvalue(<?php echo $i; ?>)" id="total_price<?php echo $i; ?>" value="<?php echo $amount[$key];?>" placeholder="26.25">
                                 </div>
                              </td>
                              <td>
                                
                                 <a class="delete" title="Delete" onclick="remove_selected_item(<?php echo $i; ?>)"><i class="fa fa-trash text-danger"></i></a>
                              </td>
                           </tr>
                           <?php
                           $i++;
                        }}
                           ?>
                        </tbody>
                     </table>
                  </div>
                  <!--Table-->
                  <div class="row lft-mar">
                     <div class="col-md-12">
                        <a href="#" class="view mt-3" onclick="view_all_items_modal()" >
                           <i class="fa fa-eye eye" aria-hidden="true"></i> View all Items
                        </a>
                     </div>
                  </div>
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
                                 <option selected><?php echo $order['payment_type'];?></option>
                                 <option >Cash</option>
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
                              <textarea class="w-100"><?php echo $order['decription'];?></textarea>
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
                           <input type="number"  min="0" oninput="this.value = Math.abs(this.value)"   onkeyup="paid_amounts()"  class="text-right" placeholder="0" value="0" value="<?php echo $order['paid']; ?>" id="paid_price">
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
                           <button id="hold-product-order" class="hold" onclick="save_product_order_confirm(3)">HOLD</button>
                        </div>
                        <div class="col-md-6 pl-2">
                           <button id="save-product-order" class="save" onclick="save_product_order_confirm(1)">SAVE</button>
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
            <div class="table-responsive" id="">

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
              <!--  <table class="table table-striped datatable w-100">
                  <thead>
                     <tr>
                        <th># No.</th>
                        <th>Product Name</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                        <th>Quantity Aailable</th>
                     </tr>
                  </thead>
                  <tbody id="all-items-list"></tbody>
               </table> -->
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
         
        <div class="modal-footer border-0">
          <button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn"  data-dismiss="modal">Cancel</button>
                  <button class="btn btn-add btn-add-2 text-white mt-0" onclick="order_confirm()" id="add_new_product_btn" name="add_new_product_btn">Confirm</button>
        </div>
      </div>
    </div>
  </div> 
<!--Add confirm field Ends -->
<script>
   var add_new_item_i = <?php echo $i; ?>;
</script>
<script src="<?php echo base_url()?>assets/customeJS/order/edit-new-ui-billing-order.js"></script>

<script>
   $(function() {
      $.ui.autocomplete.prototype._renderMenu = function(ul, items) {
         var self = this;
         ul.append("<table class='table-bordered w-100'><thead><tr><th>ID#</th><th>Product&nbsp;Name</th><th>Product&nbsp;Price</th></tr></thead><tbody></tbody></table>");
         $.each( items, function( index, item ) { 
            self._renderItemData(ul, ul.find("table tbody"), item );
         });
      };
      $.ui.autocomplete.prototype._renderItemData = function(ul,table, item) {
         return this._renderItem( table, item ).data( "ui-autocomplete-item", item );
      };
      $.ui.autocomplete.prototype._renderItem = function(table, item) {
         var invoice_type = $("#invoice_type").val();
         var price = 0;
         if (invoice_type =='1') { 
            price = item.wholesale_price; 
         } else {
            price = item.purchase_price; 
         }
         return $( "<tr class='ui-menu-item' role='presentation'></tr>" ).append( "<td >"+item.store_product_id+"</td>"+"<td>"+item.product_title+"</td>"+"<td>"+price+"</td>" ).appendTo( table);
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
            source: "?/StoreOrder/get_store_product?", 
            select: function( event, ui ) {
               $("#selected-item-name").val(ui.item.product_title);
               $("#selected-item-product-id").val(ui.item.store_product_id);
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
         $("#div-point").show();
      } else {
         $("#div-number").hide();
         $("#div-name").hide();
         $("#div-point").hide();
      }
   });
</script> 