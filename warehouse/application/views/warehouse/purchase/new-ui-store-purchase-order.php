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
            <ul class="nav nav-tabs" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#">Add Purchase Order</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab" href="?/PurchaseOrder/purchsedetails" >View All Purchase Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/PurchaseOrder/storePurchsedetails" >Store Indent</a>
            </li>
            <li class="nav-item d-none">
              <a class="nav-link nav-link-product-tab" href="?/PurchaseOrder/store_return_order" >Return Store Purchase Order</a>
            </li>
          </ul>
         <section class="billing">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-9">
                  <div class="bill-box">
                     <div class="row">
                        <div class="col-md-5 d-none">
                           
                        </div>
                        <div class="col-md-5">
                           <input type="hidden" name="party_id" value="<?php echo $order['purchased_by']; ?>" id="bill_state_id">
                        </div>
                     </div>
                     <div class="row mt-3">
                       
                        <div class="col-md-3">
                           <div class="form-group mb-0 d-none">
                              <label class="tp-txt">Customer Address</label>
                              <textarea class="form-control tp-fld" id="customer_address" placeholder="Enter Address"></textarea>
                           </div>
                        </div>
                     </div>
                     <!-- <div class="bod-bot"></div> -->
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
                              <th class="d-none" width="7%" rowspan="2" scope="col">MRP</th>
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
                          /*$order_data = array(
                            'storeId' =>$result['purchased_by'],
                            'bill_number' =>$time,
                            'bill_date' =>date('Y-m-d'),
                            'invoice_type'=>1,
                            'state_of_supply' =>$result['state_of_supply'],
                            'product_id'=>$result['product_id'],
                            'product' =>$result['product'],
                            'quntity' =>$result['quntity'],
                            'unit_id' =>$result['unit_id'],
                            'price' =>$result['price'],
                            'discount_persent' =>$result['discount_persent'],
                            'discount_price' =>$result['discount_price'],
                            'tax_persent' =>$result['tax_persent'],
                            'tax_price' =>$result['tax_price'],
                            'amount' =>$result['amount'],
                            'total' =>$result['total'],
                            'paid' =>$result['paid'],
                            'balance' =>$result['balance'],
                            'purchased_by'=>$result['wareshouse_id'],
                            'role'=>'warehouse',
                            'payment_type' =>$result['payment_type'],
                            'decription' =>$result['decription'],
                            'created_date' =>date('Y-m-d H:i:s'),
                            'updated_date' =>date('Y-m-d H:i:s'),
                          ); */ 
                            $product_id = explode(',', $order['product_id']);
                            $product_name = explode(',', $order['product']);
                            // $product_barcode = explode(',', $order['barcode']);
                            $product_qty = explode(',', $order['quntity']);
                            $product_price = explode(',', $order['price']);
                            $amount = explode(',', $order['amount']);
                            $tax_persent = explode(',', $order['tax_persent']);
                            $tax_price = explode(',', $order['tax_price']);
                            // $unit_id = explode(',', $order['unit_id']);
                                // $productId = array();
                            // return $amount;
                            $total = 0;
                            $qty = 0;
                            $amount_price = 0; 
                            $tax_price_total =0;
                            $tax_persent_total =0;
                            $grand_total =0;
                            $i = 1;
                            $key_value = 0;
                              foreach ($product_id as $key => $prId) { 
                                if ($prId !='' && $prId !='0') { 
                                  $barcode = $this->db->query("SELECT barcode,quantity FROM warehouse_products WHERE product_id=".$prId)->row_array();
                                $row['barcode'] = isset($barcode['barcode'])?$barcode['barcode']:'';
                           ?>
                           <tr id="tr-item-<?php echo $key; ?>">
                              <td class="newtwo-bx">
                                 <div class="form-group">
                                  <input type="hidden" class="hidden_row" value="0">
                                  <input type="hidden" class="order_product_id" value="<?php echo $prId; ?>" id="order_product_id<?php echo $key; ?>" >
                                    <input class="form-control tbl-fld order_item_name" id="item_name<?php echo $key; ?>" value="<?php echo $product_name[$key]; ?>" type="text" onkeyup="sumMyvalue(<?php echo $key; ?>)" placeholder="Cheri">
                                 </div>
                               
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld order_item_code" type="text" id="item_code<?php echo $key; ?>" value="<?php echo $row['barcode']; ?>" onkeyup="get_barcode_value(<?php echo $key; ?>)" onfocus="get_barcode_value(<?php echo $key; ?>)" placeholder="1234567">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld total_qty"  min="0" oninput="this.value = Math.abs(this.value)"   type="number" id="qty<?php echo $key; ?>" value="<?php echo $product_qty[$key]; ?>" onkeyup="sumMyvalue(<?php echo $key; ?>)" placeholder="1">
                                 </div>
                              </td> 
                               <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld ptotal_qty" type="text" id="pqty<?php echo $key; ?>" value="<?php echo $barcode['quantity']; ?>" readonly placeholder="1">
                                 </div>
                              </td>
                              <td class="d-none">
                                 <div class="form-group">
                                     
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld price" value="<?php echo $product_price[$key]; ?>" id="price<?php echo $key; ?>" onkeyup="sumMyvalue(<?php echo $key; ?>)"  min="0" oninput="this.value = Math.abs(this.value)"   type="number" placeholder="25">
                                 </div>
                              </td>
                       <!--        <td class="d-none">
                                 <div class="form-group">
                                    <input class="form-control tbl-fld discount" onkeyup="sumMyvalue()" id="discount" type="text">
                                 </div>
                              </td>
                              <td class="d-none">
                                 <div class="form-group">
                                    <input class="form-control tbl-fld discount_price" onkeyup="sumMyvalue()" id="discount_price" type="text">
                                 </div>
                              </td> -->
                              <td>
                                 <div class="form-group">
                                   <input type="text" name="main_gst" id="main_gst<?php echo $key; ?>" onclick="sumMyvalue(<?php echo $key; ?>)" value="<?php echo isset($tax_persent[$key])?$tax_persent[$key]:0; ?>" class="form-control tbl-fld2 main_gst" >
                                 <!--    <select class="form-control tbl-fld2 main_gst" onchange="sumMyvalue()"  id="main_gst">
                                       <option value="0">Select GST</option> 
                                        <?php
                                        $gsts ='';
                                     /*  if (count($gst) > 0) {
                                         foreach ($gst as $k => $val) { 
                                           if ($val['gst_value'] == $tax_persent[$key]) {
                                            echo "<option selected value='".$val['gst_value']."'>".$val['gst_name']."</option>";
                                           }else{
                                            echo "<option value='".$val['gst_value']."'>".$val['gst_name']."</option>";
                                           }
                                         }
                                       }*/
                                       ?>
                                    </select> -->
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld gst_price" onkeyup="sumMyvalue(<?php echo $key; ?>)" value="<?php echo $tax_price[$key]; ?>" type="text" id="gst_price<?php echo $key; ?>" placeholder="1.25">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld sub_amount" type="text" value="<?php echo $amount[$key]; ?>" onkeyup="sumMyvalue(<?php echo $key; ?>)" id="total_price<?php echo $key; ?>" placeholder="26.25">
                                 </div>
                              </td>
                              <td>
                                 <!-- <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a> -->
                                 <a class="delete" title="Delete" onclick="remove_selected_item(<?php echo $key; ?>)"><i class="material-icons">&#xE872;</i></a>
                              </td>
                           </tr>
                           <?php 
                           $i++;

                            $key_value = $key;
                            }}
                           ?>


                        </tbody>
                     </table>
                  </div>
                   <div class="row lft-mar">
                     <div class="col-md-12">
                        <a href="#" class="view mt-3" onclick="view_all_items_modal()" >
                           <i class="fa fa-eye eye" aria-hidden="true"></i> View all Items
                        </a>
                     </div>
                  </div>
                  <div class="row mt-3">
                   <div class="col-md-12">
                    <!--  <div class="custom-file-input">
                       <input type="file" id="product_images" name="product_images[]" multiple="multiple" class="input-file" >
                       <button class="btn btn-file-upload text-white">Upload Attachment</button>
                     </div> -->
                     <!-- <span class="max-image-upload-note d-block">*Max-Min 5 Images</span> -->
                   </div>
                 </div>
                <!--  <div class="row" id="selectedFiles">
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
                   
                     <div class="row mt-4">
                        <div class="col-md-12">
                           <div class="cop-code">
                              <select class="w-100" id="payment_type">
                                 <option selected="">Cash</option>
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
                              <!-- <textarea class="w-100">Description</textarea> -->
                               <textarea class="w-100" id="order_description" name="order_description" cols="" rows="" placeholder="Description"><?php echo $order['decription']; ?></textarea>
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
                           <input  type="number" oninput="this.value = Math.abs(this.value)" min="0" class="text-right" placeholder="0" value="<?php echo $order['paid']; ?>" onkeyup="paid_amounts()" id="paid_price">
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
                              <th class="d-none"  width="7%" rowspan="2" scope="col">MRP</th>
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
<!--   <div class="modal fade" id="view_order_confirm">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Are you sure want to conform this order ?</h4>
        </div> 
         
        <div class="modal-footer border-0" id="confirm-order">
          
        </div>
      </div>
    </div>
  </div>   -->
<!--Add confirm field Ends -->


  
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
   // var add_new_item_i = <?php echo $key_value;?>;
 var purchase_id = <?php echo $purchase_id;?>;
</script>


<script src="<?php echo base_url()?>assets/customeJS/purchase-order/new-ui-new-purchase-order.js"></script>

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
         $("#div-point").show();
      } else {
         $("#div-number").hide();
         $("#div-name").hide();
         $("#div-point").hide();
      }
   });
</script> 