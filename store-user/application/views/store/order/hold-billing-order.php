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
 <?php $sessionData = $this->session->userdata('logged_in_store_user');
$store = $this->db->where('storeId',$sessionData['soreId'])->get('storedetails')->row_array();
  ?>
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <label>
               <a href="<?php echo base_url()?>" class="header-left-tab-a">Outlet Panel / </a>
               <span class="header-left-tab-span">Update Bill</span>
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
              <a class="nav-link active nav-link-product-tab" href="#">Update Bill</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab" href="?/StoreBilling/details">View All Bills</a>
            </li>
             <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/StoreBilling/hold_bills" >View All Hold Order</a>
            </li>
          </ul>
            <section id="party">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-4">
                        <?php
                        // print_r($threshold);
                        ?>

                        <input type="hidden" name="sales_id" id="sales_id" value="<?php echo $order['sales_id']; ?>">
                         <div class="form-group mb-0 d-none">
                        <label class="tp-fld">Sale Invoice Type</label>
                     <select id="invoice_type" class="form-control" name="invoice_type">
                        <option value="">Select Invoice Type</option>
                        <option value="0">Retail User</option>
                        <option value="1">Wholesale User</option>
                     </select>
                     <div id="invoice-type-error"></div>
                     </div>
                      <div  class="form-group pt-2" id="registered">
                       <button class="btn btn-success" onclick="register_user()" >Unregister</button>
                     </div >
                        <div class="form-group mb-0" id="div-number">
                           <label class="tp-txt">Customer Mobile Number</label>
                           <input type="text" class="form-control tp-fld" name="contact_no" id="contact_no" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<?php echo $order['customer_mobile_number']; ?>" placeholder="Customer Contact Number">
                           <div id="address-phone-number-error-msg-div"></div>
                           <div id="phone-number-info-msg-div"></div>
                        </div>

                        <div class="form-group mb-0" id="div-name">
                           <label class="tp-txt">Customer Name</label>
                           <input type="text" class="form-control tp-fld" name="customer_name" value="<?php echo $order['customer_name']; ?>" id="customer_name" placeholder="Customer Name"> 
                           <div id="customer_name-error-msg-div"></div>

                        </div>
                        <div class="form-group mb-0" id="div-point">
                           <label class="tp-txt">Balance Point</label>
                           <span id="customer_points">0</span>
                           <button id="point_button" class="btn btn-info" style="display: none;" onclick="apply_points()">Apply</button>
                           <input type="hidden" class="form-control tp-fld" name="customer_point_apply" id="customer_point_apply" value="0">
                              <input type="hidden" class="form-control tp-fld" name="customer_point_less" id="customer_point_less" value="0">
                           <input type="hidden" name="threshold_balance" id="threshold_balance" value="<?php echo $threshold['threshold_balance']?>">  
                           <input type="hidden" name="threshold_bill_amount" id="threshold_bill_amount" value="<?php echo $threshold['threshold_bill_amount']?>">  
                           <input type="hidden" name="percent" id="percent" value="<?php echo $threshold['percent']?>">  

                        </div>
                        <div class="form-group mb-0 d-none">
                           <label class="tp-txt">Customer Address</label>
                           <textarea class="form-control tp-fld" id="customer_address" placeholder="Enter Address"></textarea>
                        </div>
                        
                     </div>
                     <div class="col-md-4"></div>
                     <div class="col-md-3">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="tp-txt">Bill Date</div>
                           </div>
                           <div class="col-md-8">
                              <div class="tp-bx">
                                 <div class="form-group">
                                    <!-- date-min-today -->
                                    <input class="form-control tp-fld2 " id="bill_date" type="text" value="<?php echo date('Y-m-d') ?>" readonly="" placeholder="07/10/2020">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class="tp-txt">Customer City</div>
                           </div>
                           <div class="col-md-8">
                              <div class="tp-bx">
                                 <div class="form-group">
                                    <input class="form-control tp-fld" id="customer_city" type="text" placeholder="Enter City" readonly="" value="<?php echo $store['city']?>">
                                    <div id="customer_city-error-msg-div"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class="tp-txt">State of Supply</div>
                           </div>
                           <div class="col-md-8">
                              <div class="tp-bx">
                                 <div class="form-group">
                                    <input class="form-control tp-fld" id="bill_state" type="text" placeholder="Enter State" readonly="" value="<?php echo $store['state']?>"> 
                                    <div id="state-error-msg-div"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class="tp-txt">Pincode</div>
                           </div>
                           <div class="col-md-8">
                              <div class="tp-bx">
                                 <div class="form-group">
                                    <input class="form-control tp-fld" id="customer_pincode" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  readonly=""  type="text" placeholder="Enter Pincode" value="<?php echo $store['pincode']?>">
                                    <div id="pincode-error-msg-div"></div>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                     <div class="col-md-1"></div>
                      <div id="price-error" class="col-md-12 text-center"></div>
                  </div>
               </div>
               
               <div class="w-100">
                  <div class="party-tbl">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th width="30%" rowspan="2" scope="col">Item</th>
                              <th width="9%" rowspan="2" scope="col">Item Code</th>
                              <th width="7%" rowspan="2" scope="col">Qty</th>
                              <th width="7%" rowspan="2" scope="col">Available Qty</th>
                              <th class="d-none" width="7%" rowspan="2" scope="col">Unit</th>
                              <th  width="7%" rowspan="2" scope="col">MRP</th>
                              <th width="7%" rowspan="2" scope="col" class="price aln-cntr-price">
                                 Price/Unit
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
                        <tbody>

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
                           <tr id="tr_item<?php echo $i; ?>">
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
                                    <input class="form-control tbl-fld total_qty" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  type="text" id="qty<?php echo $i; ?>" value="<?php echo $product_qty[$key]; ?>" onkeyup="sumMyvalue(<?php echo $i; ?>)" placeholder="1">
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
                                    <input class="form-control tbl-fld price" id="price<?php echo $i; ?>" value="<?php echo $product_price[$key];?>" onkeyup="sumMyvalue(<?php echo $i; ?>)" type="text" placeholder="25">
                                   
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
                                    <select class="form-control tbl-fld2 main_gst" onchange="sumMyvalue(<?php echo $i; ?>)" id="main_gst<?php echo $i; ?>">
                                       <option value="0">Select GST</option>
                                       <!-- <option value="5">GST@5%</option>
                                       <option value="0">None</option> -->
                                        <?php
                                        $gsts ='';
                                       if (count($gst) > 0) {
                                         foreach ($gst as $key2 => $val) { 
                                          if ($tax_persent[$key] == $val['gst_value']) { 
                                           echo "<option selected value='".$val['gst_value']."'>".$val['gst_name']."</option>";
                                          }else{
                                             echo "<option value='".$val['gst_value']."'>".$val['gst_name']."</option>";
                                          }
                                         }
                                       }
                                       ?>
                                    </select>
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
                                 <!-- <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a> -->
                                 <a class="delete" title="Delete" onclick="remove_tr(<?php echo $i; ?>)"><i class="material-icons">&#xE872;</i></a>
                              </td>
                           </tr>
                           <?php
                           $i++;
                        }}
                           ?>
                        </tbody>
                     </table>
                     <div class="total-bx">
                        <div class="total-cnt1">
                           <button type="button" class="btn btn-info add-new d-inline width-unset"><i class="fa fa-plus"></i> Add Row</button>
                           <div class="total-txt2">Total</div>
                        </div>
                        <div class="total-cnt2">
                           <div class="total-txt"><span id="total_qty">0</span></div>
                        </div>
                        <div class="total-cnt3">
                           <div class="total-txt"><span id="main_total">0</span></div>
                        </div>
                        <div class="total-cnt4">&nbsp;</div>
                        <div class="clr"></div>
                     </div>
                  </div>
               </div>
               <div class="container-fluid">
                  <div class="party-ftr">
                     <div class="row">
                         <div class="col-md-3">
                           <div class="form-group">
                              <label>Payment Type</label>
                              <select class="form-control  tbl-fld1" id="payment_type">
                                 <option selected><?php echo $order['payment_type'];?></option>
                                 <option  >Cash</option>
                                 <option>Cheque</option>
                                 <option>Online</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <input class="form-control tbl-fld1" id="reference_no" type="text" style="display: none;" placeholder="Reference Number">
                           </div>
                           <div class="form-group">
                              <textarea class="form-control tbl-fld3" id="order_description" name="order_description" cols="" rows="" placeholder="Description"><?php echo $order['decription'];?></textarea>
                           </div>
                        </div>
                        <div class="col-md-5"></div>
                        <div class="col-md-4">
                           <div class="form-group row">
                              <label class="col-md-4 col-form-label text-right ln-ht-25">Apply Coupon</label>
                              <div class="col-md-6">
                                 <input type="text" class="form-control tbl-fld3 text-right" id="CouponCode"  value="0">
                                 <input type="hidden" id="applied_coupon_type"  value="0">
                                 <input type="hidden" id="coupon_code"  value="0">
                                 <input type="hidden" id="order_discounted_percentage"  value="0">
                                 <input type="hidden" id="order_discounted_price"  value="0">
                              </div>
                              <div class="col-md-2" id="applied-coupon-div"> 
                                <button class="btn btn-info" onclick="valid_coupon()" >apply</button>
                              </div>
                           </div>
                           <div class="form-group row" id="diduct_value"></div>
                           <div class="form-group row">
                              <label class="col-md-4 col-form-label text-right ln-ht-25">Total</label>
                              <div class="col-md-8">
                                 <input type="text" readonly class="form-control tbl-fld3 text-right" id="main_total_amount"  value="0">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-md-4 col-form-label text-right ln-ht-25">Paid</label>
                              <div class="col-md-8">
                                 <input type="text" class="form-control tbl-fld3 text-right" onkeyup="paid_amounts()" id="paid_price" value="<?php echo $order['paid']; ?>">
                              </div>
                              <div id="paid-warnign-msg"></div>
                           </div>
                           <div class="form-group row">
                              <label class="col-md-4 col-form-label text-right ln-ht-25"><strong>Balance</strong></label>
                              <div class="col-md-8">
                                 <div class="text-right ln-ht-25"><span id="balance_total">0</span></div>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label class="col-md-4 col-form-label text-right ln-ht-25">Referral / Mobile No</label>
                              <div class="col-md-6">
                                 <input type="text" class="form-control tbl-fld3 text-right" id="referral"  value="0">
                                 <input type="hidden" id="referrel_code" name="referrel_code" value="0">
                                 <div class="text-center" id="error-referral"></div>
                              </div>
                              <div class="col-md-2" id="applied-coupon-div"> 
                                <button class="btn btn-info" onclick="valid_referral()" >apply</button>
                              </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="w-100">
                  <div class="save-bx">
                     <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                           <div class="save-btn"><a href="javascript::" id="save-product-order" onclick="save_product_order_confirm()">Save</a></div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </section>
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



<script src="<?php echo base_url()?>assets/customeJS/order/edit-billing-order.js"></script>
 
<script>
  $(function() { 

/* var xhReq = new XMLHttpRequest();
 xhReq.open("POST", "?/WareHouseProduct/get_warehouse_product", false);
 xhReq.send(null);*/
 // var serverResponse = xhReq.responseText; 
 //alert(serverResponse); // Shows "15"
 // console.log(serverResponse)
//overriding jquery-ui.autocomplete .js functions
$.ui.autocomplete.prototype._renderMenu = function(ul, items) {
  var self = this;
  //table definitions
  // ul.append("<div class='content-wrapper'><input class='btn btn-info' type='submit' onclick='view_product_modal()' value='add new' ><table class='table table-responsive table-bordered' style='width: auto;'><thead><tr><th>ID#</th><th>Product&nbsp;Name</th><th>Product&nbsp;Price</th></tr></thead><tbody></tbody></table></div>");
  ul.append("<table class='table-bordered table-inline'><thead><tr><th>ID#</th><th>Product&nbsp;Name</th><th>Product&nbsp;Price</th></tr></thead><tbody></tbody></table>");
  $.each( items, function( index, item ) { 
    self._renderItemData(ul, ul.find("table tbody"), item );
  });0
};
$.ui.autocomplete.prototype._renderItemData = function(ul,table, item) {
  return this._renderItem( table, item ).data( "ui-autocomplete-item", item );
};
$.ui.autocomplete.prototype._renderItem = function(table, item) {
         var invoice_type = 0;//$("#invoice_type").val();
   var price = 0;
        if (invoice_type =='1') { 
         price = item.wholesale_price; 
      }else{
         price = item.sale_price; 
      }
  return $( "<tr class='ui-menu-item' role='presentation'></tr>" )
    //.data( "item.autocomplete", item )
    .append( "<td >"+item.store_product_id+"</td>"+"<td>"+item.product_title+"</td>"+"<td>"+price+"</td>" )
    .appendTo( table );
}; 

 $('table').on('focus', '.order_item_name', function (e) {
  /*    var invoice_type = $("#invoice_type").val();
   if (invoice_type =='') {
      $("#invoice-type-error").html("<span class='text-danger'>Please Select Invoice Type</span>");
      return false;
   }*/
   $("#invoice-type-error").html("");
   var MyID = $(this).attr("id"); 
   var number = MyID.match(/\d+/); 
   if (number ==null) {
    number ='';
   }
   var warehouse_id = $("#search_field_warehouse").val();
   if (warehouse_id =='') {
      // alert("Please Select the warehouse.")
      $("#price-error").html('<span class="text-danger text-center w-100">Please Select the warehouse.</span>');
      return false;
   }

   $( "#"+MyID ).autocomplete({ 
    minLength: 1,
    source: "?/StoreOrder/get_store_product?", 
    select: function( event, ui ) {
      console.log(ui);
          $( "#item_name"+number ).val( ui.item.product_title );
          $("#item_code"+number).val(ui.item.barcode);
      $( "#qty"+number ).val(1);
      $( "#pqty"+number ).val(ui.item.quantity);
      $("#order_product_id"+number).val(ui.item.store_product_id);

            
         if (invoice_type =='1') { 
            $( "#price"+number ).val(ui.item.wholesale_price); 
            $("#perfect_price"+number).val(ui.item.wholesale_price);
         }else{
            $( "#price"+number ).val(ui.item.sale_price); 
            $("#perfect_price"+number).val(ui.item.sale_price);
         }
      // $( "#price"+number ).val( ui.item.sale_price); 
      // $("#perfect_price"+number).val(ui.item.sale_price);
      $( "#mrp_price"+number ).val( ui.item.mrp_price); 
       // $('#select_unit'+number).val(ui.item.unit_id).trigger('change');
       $('#main_gst'+number).val(ui.item.tax_rate);//.trigger('change');
       $( "#qty"+number ).focus();
        $(".add-new").click();
      sumMyvalue(number);
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
   var i = <?php echo $i; ?>;
   $(".add-new").click(function(){ 
      // alert(".add-new")
   var inc = i - 1;
   var item_code = '';
   if (inc > 0) {
      item_code = $("#item_code"+inc).val();
      // alert(item_name)
   }else{
       item_code = $("#item_code").val();
       // alert(item_name)
   }
   if (item_code =='' || item_code ==undefined) {
      
      // alert(item_code)
      if (item_code !=undefined) { 
         
      return false;
      }
   }
    var index = $("table tbody tr:last-child").index();
        var row = '<tr id="tr_item'+i+'">' +
            '<td><input type="hidden" class="order_product_id" id="order_product_id'+i+'" ><input type="hidden" class="hidden_row" value="'+i+'"><input type="text" class="form-control tbl-fld order_item_name" id="item_name'+i+'" placeholder="Name"></td>' +
            '<td><input type="text" class="form-control tbl-fld order_item_code"  onkeyup="get_barcode_value('+i+')" onfocus="get_barcode_value('+i+')" id="item_code'+i+'" placeholder="Item Code"></td>' +
            '<td><input type="text" class="form-control tbl-fld total_qty" oninput="oninput_fun('+i+')" onkeyup="sumMyvalue('+i+')" id="qty'+i+'" placeholder="Quantity"></td>' +
            '<td><input type="text" class="form-control tbl-fld ptotal_qty" oninput="oninput_fun('+i+')" onkeyup="sumMyvalue('+i+')" id="pqty'+i+'" readonly placeholder="Quantity"></td>' +
            '<td class="d-none" ><select class="form-control tbl-fld2 select_unit" onchange="sumMyvalue('+i+')" id="select_unit'+i+'" ><option value="0">None</option>'+units+'</select></td>' + 
            '<td><input class="form-control tbl-fld mrp_price" id="mrp_price'+i+'" readonly onkeyup="sumMyvalue('+i+')" type="text" placeholder="25"></td>' + 
            '<td><input type="hidden" name="perfect_price" id="perfect_price'+i+'"><input type="text" class="form-control tbl-fld price" onkeyup="sumMyvalue('+i+')" id="price'+i+'" placeholder="Price"></td>' +
            '<td class="d-none" ><input type="text" class="form-control tbl-fld discount" onkeyup="sumMyvalue('+i+')" id="discount'+i+'" placeholder="Percentage" value="0"></td>' +
            '<td class="d-none"><input type="text" class="form-control tbl-fld discount_price" onkeyup="sumMyvalue('+i+')" id="discount_price'+i+'" placeholder="Amount" value="0"></td>' +
            '<td><select class="form-control tbl-fld2 main_gst" onchange="sumMyvalue('+i+')" id="main_gst'+i+'" ><option value="0">Select GST</option>'+gsts+'</select></td>' +
            '<td><input type="text" class="form-control tbl-fld gst_price" onkeyup="sumMyvalue('+i+')" id="gst_price'+i+'" placeholder="Amount"></td>' +
            '<td><input type="text" class="form-control tbl-fld sub_amount" onkeyup="sumMyvalue('+i+')" id="total_price'+i+'" placeholder="Amount"></td>' +
      '<td><a class="delete" title="Delete" onclick="remove_tr('+i+')"><i class="material-icons">&#xE872;</i></a></td>' +
        '</tr>';
      $("table").append(row);   
    $("table tbody tr").eq(index + 1).find(".edit").toggle();
     // $("#item_code"+i).focus()
        i++;
        inc = 0;
    });
  // Add row on add button click
 /* $(document).on("click", ".add", function(){
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
      if(!$(this).val()){
        $(this).addClass("error");
        empty = true;
      } else{
                $(this).removeClass("error");
            }
    });
    $(this).parents("tr").find(".error").first().focus();
    if(!empty){
      input.each(function(){
        $(this).parent("td").html($(this).val());
      });     
      $(this).parents("tr").find(".add, .edit").toggle();
      $(".add-new").removeAttr("disabled");
    }   
    })*/
  
  // Delete row on delete button click
 /* $(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
    $(".add-new").removeAttr("disabled");
    });*/
  function remove_tr(id=''){

   $("#tr_item"+id).remove();
   // $(".add-new").removeAttr("disabled");
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
      // $('.total_qty').keypress(function (e) {
         // alert("enter")
      if (e.which === 13) { 
           $(this).closest('tr').nextAll().eq(0).find('.order_item_code').focus()
      }
     });

function register_user(){
   $("#div-number").hide();
$("#div-name").hide();
$("#div-point").hide();
$("#registered").html('<button class="btn btn-success" onclick="unregister_user()" >register</button>');
}

function unregister_user(){
    $("#div-number").show();
$("#div-name").show();
$("#div-point").show();  
$("#registered").html('<button class="btn btn-success" onclick="register_user()" >Unregister</button>');
}
</script>

 