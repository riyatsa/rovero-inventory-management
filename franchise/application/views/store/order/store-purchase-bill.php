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

<div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            ...
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
         </div>
      </div>
   </div>
</div>
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <label>
               <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">WareHouse Panel / </a>
               <span class="header-left-tab-span">Purchase Order</span>
               </label>
            </div>
         </div>
      </div>
   </div>
   <section class="content">
      <div class="container-fluid">
         <div class="product-tabs-container">
    
            <section id="party">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-4">
                           <input type="hidden" name="party_id" value="<?php echo $order['purchased_by']; ?>" id="bill_state_id">
                           <input type="hidden" name="purchase_id" value="<?php echo $order['purchase_id']; ?>" id="purchase_id">
                     <!--    <div class="form-group mb-0">
                           <label>Vendor</label>
                           <input class="form-control" id="searchField" onkeyup="get_autocomplete()" onfocus="get_autocomplete()" onblur="get_autocomplete()" type="text" placeholder="Search Vendor">
                           <div id="searchField-error"></div>
                        </div> -->
                     
                     </div>
                     <div class="col-md-4"></div>
                     <div class="col-md-3">
                        <div class="row d-none">
                           <div class="col-md-4">
                              <div class="tp-txt">Bill Number</div>
                           </div>
                           <div class="col-md-8">
                              <div class="tp-bx">
                                 <div class="form-group d-none">
                                    <input class="form-control tp-fld" id="bill_number" type="text" placeholder="12">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class="tp-txt">Bill Date</div>
                           </div>
                           <div class="col-md-8">
                              <div class="tp-bx">
                                 <div class="form-group">
                                    <input class="form-control tp-fld2 mdate1" readonly id="bill_date" type="text" value="<?php echo date('Y-m-d') ?>" placeholder="07/10/2020">
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
                                  <input type="text" class="form-control tp-fld2" readonly name="bill_state" value="<?php echo $order['state_of_supply']; ?>" id="bill_state">
                          <!--           <select class="form-control tp-fld" id="bill_state">
                                       <?php
                                       $stateList = array('Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana',
                                                         'Himachal Pradesh','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya',
                                                         'Mizoram','Nagaland','Odisha','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh',
                                                         'Uttarakhand','West Bengal');
                                    foreach ($stateList as $key => $value) {
                                       echo "<option value='".$value."'>".$value."</option>";
                                    }
                                       ?>
                                    </select> -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1"></div>
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
                              <th width="7%" scope="col" class="aln-cntr d-none">%</th>
                              <th width="5%" scope="col" class="aln-cntr aln-cntr-amt d-none">Amount</th>
                              <th width="10%" scope="col" class="aln-cntr">%</th>
                              <th scope="col" class="aln-cntr aln-cntr-amt">Amount</th>
                           </tr>
                        </thead>
                        <tbody>
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
                          // echo $order['price'];
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
                              foreach ($product_id as $key => $prId) { 
                                if ($prId !='' && $prId !='0') {  
                                  $barcode = $this->db->query("SELECT barcode,quantity FROM warehouse_products WHERE product_id=".$prId)->row_array();
                                $row['barcode'] = isset($barcode['barcode'])?$barcode['barcode']:'';
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
                                    <input class="form-control tbl-fld total_qty" type="text" id="qty<?php echo $i; ?>" value="<?php echo $product_qty[$key]; ?>" onkeyup="sumMyvalue(<?php echo $i; ?>)" placeholder="1">
                                 </div>
                              </td> 
                               <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld ptotal_qty" type="text" id="pqty<?php echo $i; ?>" value="<?php echo $barcode['quantity']; ?>" readonly placeholder="1">
                                 </div>
                              </td>
                  
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld price" value="<?php echo isset($product_price[$key])?$product_price[$key]:0; ?>" id="price<?php echo $i; ?>" onkeyup="sumMyvalue(<?php echo $i; ?>)" type="text" placeholder="25">
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
                                    <select class="form-control tbl-fld2 main_gst" onchange="sumMyvalue(<?php echo $i; ?>)"  id="main_gst<?php echo $i; ?>">
                                       <option value="0">Select GST</option>
                                       <!-- <option value="5">GST@5%</option>
                                       <option value="0">None</option> -->
                                        <?php
                                        $gsts ='';
                                       if (count($gst) > 0) {
                                         foreach ($gst as $k => $val) { 
                                           if ($val['gst_value'] == $tax_persent[$key]) {
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
                                    <input class="form-control tbl-fld gst_price" onkeyup="sumMyvalue(<?php echo $i; ?>)" value="<?php echo $tax_price[$key]; ?>" type="text" id="gst_price<?php echo $i; ?>" placeholder="1.25">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld sub_amount" type="text" value="<?php echo $amount[$key]; ?>" onkeyup="sumMyvalue(<?php echo $i; ?>)" id="total_price<?php echo $i; ?>" placeholder="26.25">
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
                           <!-- <button type="button" class="btn btn-info add-new d-inline width-unset"><i class="fa fa-plus"></i> Add Row</button> -->
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
                              <select class="form-control tbl-fld1" id="payment_type">
                                 <option>Cheque</option>
                                 <option>Online</option>
                                 <option>Cash</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <input class="form-control tbl-fld1" id="reference_no" type="text" placeholder="Reference Number">
                           </div>
                           <div class="form-group">
                              <textarea class="form-control tbl-fld3" id="order_description" name="order_description" cols="" rows="" placeholder="Description"></textarea>
                           </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                           <div class="form-group row">
                              <label class="col-md-3 col-form-label text-right ln-ht-25">Total</label>
                              <div class="col-md-9">
                                 <input type="text" readonly class="form-control tbl-fld3 text-right" id="main_total_amount"  value="0">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-md-3 col-form-label text-right ln-ht-25">Paid</label>
                              <div class="col-md-9">
                                 <input type="text" class="form-control tbl-fld3 text-right" value="<?php echo $order['paid']; ?>" onkeyup="paid_amounts()" id="paid_price" value="0">
                              </div>
                              <div id="paid-warnign-msg"></div>
                           </div>
                           <div class="form-group row">
                              <label class="col-md-3 col-form-label text-right ln-ht-25"><strong>Balance</strong></label>
                              <div class="col-md-9">
                                 <div class="text-right ln-ht-25"><span id="balance_total">0</span></div>
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
<script>
 var purchase_id = <?php echo $purchase_id;?>;
</script>


<script src="<?php echo base_url()?>assets/customeJS/order/store-purchase-order.js"></script>

<script>


  $(function() {
 
//overriding jquery-ui.autocomplete .js functions
/*$.ui.autocomplete.prototype._renderMenu = function(ul, items) {
  var self = this;
  //table definitions 
  ul.append("<input class='btn btn-info d-block' type='submit' onclick='view_product_modal()' value='add new'><table class='table-bordered table-inline'><thead><tr><th>ID#</th><th>Product&nbsp;Name</th><th>Product&nbsp;Price</th></tr></thead><tbody></tbody></table>");
  $.each( items, function( index, item ) { 
    self._renderItemData(ul, ul.find("table tbody"), item );
  });0
};
$.ui.autocomplete.prototype._renderItemData = function(ul,table, item) {
  return this._renderItem( table, item ).data( "ui-autocomplete-item", item );
};
$.ui.autocomplete.prototype._renderItem = function(table, item) {
  return $( "<tr class='ui-menu-item' role='presentation'></tr>" )
    //.data( "item.autocomplete", item )
    .append( "<td >"+item.product_id+"</td>"+"<td>"+item.product_title+"</td>"+"<td>"+item.purchase_price+"</td>" )
    .appendTo( table );
}; 

 $('table').on('focus', '.order_item_name', function (e) {
   var MyID = $(this).attr("id"); 
   var number = MyID.match(/\d+/); 
   if (number ==null) {
    number ='';
   }

   $( "#"+MyID ).autocomplete({ 
    minLength: 1,
    source: "?/WareHouseProduct/get_order_products/?", 
    select: function( event, ui ) {
      console.log(ui);
          $( "#item_name"+number ).val( ui.item.product_title );
          $("#item_code"+number).val(ui.item.barcode);
      $( "#qty"+number ).val(1);
      $("#order_product_id"+number).val(ui.item.product_id);
      $( "#price"+number ).val( ui.item.purchase_price ); 
       // $('#select_unit'+number).val(ui.item.unit_id).trigger('change');
       $('#main_gst'+number).val(ui.item.tax_rate).trigger('change');
       $("#qty"+number).focus();
        $(".add-new").click();
      sumMyvalue(number);
      return false;
    }
  })
});*/

});
 
</script>
 