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
               <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Warehouse Panel / </a>
               <span class="header-left-tab-span">Sales Order</span>
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
              <a class="nav-link active nav-link-product-tab" href="#">Add Sales Order</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab" href="?/SalesOrder/sales_details" >View All Sales Order</a>
            </li>
          </ul>
            <section id="party">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-3">
                        <div class="form-group mb-0">
                           <label>Store</label>
                           <input type="hidden" name="party_id" id="bill_state_id">
                           <input class="form-control" id="searchField" onkeyup="get_autocomplete()" onfocus="get_autocomplete()" onblur="get_autocomplete()" type="text" placeholder="Search Party">
                        </div>
                       <!--  <div class="newone">
                           <div class="w-100 border-bottom">
                              <div class="row">
                                 <div class="col-md-7">
                                    <div class="add-party"><a href="#" data-toggle="modal" data-target="#additem"><i class="fa fa-plus"></i>Add Party</a></div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="add-party-hd">Party Banance</div>
                                 </div>
                              </div>
                           </div>
                           <div class="w-100 myTable">
                              <div class="row">
                                 <div class="col-md-7">
                                    <div class="add-party-txt">Cash Sale</div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="add-party-txt2">12</div>
                                 </div>
                              </div>
                           </div>
                           <div class="w-100 myTable">
                              <div class="row">
                                 <div class="col-md-7">
                                    <div class="add-party-txt">IDEA</div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="add-party-txt2">30</div>
                                 </div>
                              </div>
                           </div>
                           <div class="w-100 myTable">
                              <div class="row">
                                 <div class="col-md-7">
                                    <div class="add-party-txt">Lakshmi Grasory</div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="add-party-txt2">16</div>
                                 </div>
                              </div>
                           </div>
                        </div> -->
                     </div>
                     <div class="col-md-2">
                        <label>Sale Invoice Type</label>
                     <select id="invoice_type" class="form-control" name="invoice_type">
                        <option value="">Select Invoice Type</option>
                        <option value="0">Retail User</option>
                        <option value="1">Wholesale User</option>
                     </select>
                     <div id="invoice-type-error"></div>
                     </div>
                     <div class="col-md-3"></div>
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
                                    <input class="form-control tp-fld2 mdate" id="bill_date" type="text" value="<?php echo date('Y-m-d') ?>" placeholder="07/10/2020">
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
                                    <select class="form-control tp-fld" id="bill_state">
                                       <?php
                                       $stateList = array('Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana',
                                                         'Himachal Pradesh','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya',
                                                         'Mizoram','Nagaland','Odisha','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh',
                                                         'Uttarakhand','West Bengal');
                                    foreach ($stateList as $key => $value) {
                                       echo "<option value='".$value."'>".$value."</option>";
                                    }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1"></div>
                     <div class="col-md-12 text-danger" id="price-error"></div>
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
                              <th width="7%" rowspan="2" scope="col">MRP</th>
                              <th width="7%" rowspan="2" scope="col" class="price">
                                 Price/Unit
                                 <div class="tax">
                                    <div class="form-group">
                                      <select class="form-control tax-fld"  id="tax_type" >
                                         <option value="0">Tax Included</option>
                                         <option value="1">Tax Excluded</option>
                                      </select>
                                    </div>
                                 </div>
                              </th>
                              <th colspan="2" align="center" scope="col" class="aln-cntr d-none" >Discount</th>
                              <th colspan="2" scope="col" class="aln-cntr">Tax</th>
                              <th width="10%" rowspan="2" valign="middle" scope="col">Amount</th>
                              <th width="5%" rowspan="2" scope="col">Actions</th>
                           </tr>
                           <tr>
                              <th width="7%" scope="col" class="aln-cntr d-none">%</th>
                              <th width="5%" scope="col" class="aln-cntr d-none">Amount</th>
                              <th width="10%" scope="col" class="aln-cntr">%</th>
                              <th width="5%" scope="col" class="aln-cntr">Amount</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr id="tr_item">
                              <td class="newtwo-bx">
                                 <div class="form-group">
                                  <input type="hidden" class="hidden_row" value="0">
                                  <input type="hidden" class="order_product_id" id="order_product_id" >
                                    <input class="form-control tbl-fld order_item_name" id="item_name" type="text" onkeyup="sumMyvalue()" placeholder="Cheri">
                                 </div> 
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld order_item_code" type="text" id="item_code" onkeyup="get_barcode_value()" onfocus="get_barcode_value()" placeholder="1234567">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld total_qty" type="text" id="qty" onkeyup="sumMyvalue()" placeholder="1">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld ptotal_qty" readonly type="text" id="pqty" onkeyup="sumMyvalue()" placeholder="1">
                                 </div>
                              </td>
                              <td class="d-none">
                                 <div class="form-group">
                                    <select class="form-control tbl-fld2 select_unit" onchange="sumMyvalue()" id="select_unit">
                                       <option value="0">None</option>
                                       <?php
                                       $units ='';
                                       if (count($unit) > 0) {
                                         foreach ($unit as $key => $val) { 
                                           echo  "<option value='".$val['unit_id']."'>".$val['unit_name']."</option>";
                                         }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group"> 
                                    <input class="form-control tbl-fld mrp_price" id="mrp_price" readonly onkeyup="sumMyvalue()" type="text" placeholder="25">
                                 </div>
                              </td>
                               <td>
                                 <div class="form-group">
                                     <input type="hidden" name="perfect_price" id="perfect_price">
                                    <input class="form-control tbl-fld price" id="price" onkeyup="sumMyvalue()" type="text" placeholder="25">
                                 </div>
                              </td>
                              <td class="d-none">
                                 <div class="form-group">
                                    <input class="form-control tbl-fld discount" onkeyup="sumMyvalue()" id="discount" type="text">
                                 </div>
                              </td>
                              <td class="d-none">
                                 <div class="form-group">
                                    <input class="form-control tbl-fld discount_price" onkeyup="sumMyvalue()" id="discount_price" type="text">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <select class="form-control tbl-fld2 main_gst" onchange="sumMyvalue()" id="main_gst">
                                       <option value="0">Select GST</option>
                                       <!-- <option value="5">GST@5%</option>
                                       <option value="0">None</option> -->
                                        <?php
                                        $gsts ='';
                                       if (count($gst) > 0) {
                                         foreach ($gst as $key => $val) { 
                                           echo "<option value='".$val['gst_value']."'>".$val['gst_name']."</option>";
                                         }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld gst_price" onkeyup="sumMyvalue()" type="text" id="gst_price" placeholder="1.25">
                                 </div>
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input class="form-control tbl-fld sub_amount" type="text" onkeyup="sumMyvalue()" id="total_price" placeholder="26.25">
                                 </div>
                              </td>
                              <td>
                                 <!-- <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a> -->
                                 <a class="delete" title="Delete" onclick="remove_tr()"><i class="material-icons">&#xE872;</i></a>
                              </td>
                           </tr>
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
                                 <input type="text" class="form-control tbl-fld3 text-right" onkeyup="paid_amounts()" id="paid_price" value="0">
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


  <!-- Edit Coupon Modal Starts -->
  <div class="modal fade" id="edit_store">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0"> 
          <h4 class="modal-title-edit-coupon">Add Store</h4> 
        </div>
        <input type="hidden" name="edit_store_id" id="edit_store_id">
        <div class="modal-body modal-body-edit-coupon">
            <div class="tab-content">
            <div class="tab-pane fade show active" id="add-product-tab" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
              <div class="row">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Store Name</label>
                  <input type="text" class="input-txt" name="storename" id="storename" placeholder="Enter Store Name">
                  <div id="storename-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Contact Number </label>
                  <input type="text" class="input-txt" name="phonenumber" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="phonenumber" placeholder="Contact Number">
                  <div id="phonenumber-error-msg-div"></div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-6">
                  <label class="product-details-span-light">User Name</label>
                  <input type="text" class="input-txt" name="username" id="username" placeholder="Store User Name">
                  <div id="username-error-msg-div"></div>
                </div>
                <div class="col-sm-6"> 
                  <label class="product-details-span-light">Password</label>
                      <input type="password" class="input-txt" name="password" id="password" placeholder="Enter Store Password">
                      <div id="password-error-msg-div"></div>  
              </div> 
                 <div class="col-sm-6">
                  <label class="product-details-span-light">GST Type</label>
                  <select class="input-txt" name="gst_type" id="gst_type">
                    <option value="">Select GST Type</option>
                    <option value="unregistered">Unregistrade</option>
                    <option value="registered_business_regular">Registered Business - Regular</option>
                    <option value="registered_business_composition">Registered Business - Composition</option>  
                  </select>  
                  </select>
                  <div id="gst-type-error-msg-div"></div>
                </div>
            </div>

             <div class="row mt-2">
             
                <div class="col-sm-6">
                  <label class="product-details-span-light">GST Number</label>
                  <input type="text" class="input-txt" name="gstinumber" id="gstinumber" placeholder="Enter GST Number">
                  <div id="gstinumber-error-msg-div"></div>
                </div>
                <div class="col-sm-6"> 
                  <label class="product-details-span-light">Opening Balence</label>
                      <input type="number" class="input-txt" name="openingBalance" id="openingBalance" placeholder="Enter Opening Balence">
                      <div id="openingBalance-error-msg-div"></div>  
                </div>  
            </div>

            <div class="row mt-2">
              <div class="col-sm-12">
                <label class="product-details-span-light">Address</label>
                <!-- <input type="number" class="input-txt" name="address" id="address" placeholder="Enter address"> -->
                <textarea class="input-txt"  name="address" id="address" placeholder="Enter address"></textarea>
                <div id="address-error-msg-div"></div>  
              </div>
              <div class="col-sm-4">
                <label class="product-details-span-light">City</label>
                <input type="text" class="input-txt" name="city" id="city" placeholder="Enter city">
                <div id="city-error-msg-div"></div>  
              </div>
              <div class="col-sm-4">
                <label class="product-details-span-light">State</label>
                <select class="input-txt" name="state" id="state">
                  <?php 
                     foreach ($stateList as $key => $value) {
                        echo "<option value='".$value."'>".$value."</option>";
                     }
                  ?>
                </select>
                <div id="state-error-msg-div"></div>  
              </div>
              <div class="col-sm-4">
                <label class="product-details-span-light">Pincode</label>
                <input type="number" class="input-txt" name="pincode" id="pincode" placeholder="Enter pincode">
                <div id="pincode-error-msg-div"></div>  
              </div>
            </div>
            <div class="row mt-2">
              
            </div>
               
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-default btn-close" id="edit-store-close-btn" name="edit-store-close-btn" data-dismiss="modal">Close</button>
          <button class="btn btn-add text-white mt-0" onclick="updateStoreDetails()" id="edit_store_btn" name="edit_store_btn">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Coupon Modal Ends -->

  
  

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

 

<script src="<?php echo base_url()?>assets/customeJS/sales/sales-order.js"></script>
 
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

  ul.append("<div class='content-wrapper'><div class='container-fluid'><div class='row'> <table class='table table-responsive'><thead><tr><th>ID#</th><th>Product&nbsp;Name</th><th>Product&nbsp;Price</th></tr></thead><tbody></tbody></table></div></div></div>");
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
      }else{
         price = item.retail_price; 
      }
  return $( "<tr class='ui-menu-item' role='presentation'></tr>" )
    //.data( "item.autocomplete", item )
    .append( "<td >"+item.product_id+"</td>"+"<td>"+item.product_title+"</td>"+"<td>"+price+"</td>" )
    .appendTo( table );
}; 

 $('table').on('focus', '.order_item_name', function (e) {
   var invoice_type = $("#invoice_type").val();
   if (invoice_type =='') {
      $("#invoice-type-error").html("<span class='text-danger'>Please Select Invoice Type</span>");
      return false;
   }
   $("#invoice-type-error").html("");
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
      $( "#pqty"+number ).val(ui.item.quantity);
      $("#order_product_id"+number).val(ui.item.product_id);
      
         if (invoice_type =='1') { 
            $( "#price"+number ).val(ui.item.wholesale_price); 
            $("#perfect_price"+number).val(ui.item.wholesale_price);
         }else{
            $( "#price"+number ).val(ui.item.retail_price); 
            $("#perfect_price"+number).val(ui.item.retail_price);
         }
          $("#mrp_price"+number ).val(ui.item.product_mrp); 
       $('#select_unit'+number).val(ui.item.unit_id).trigger('change');
       $('#main_gst'+number).val(ui.item.tax_rate).trigger('change');
       $("#qty"+number).focus();
        $(".add-new").click();
      sumMyvalue(number);
      return false;
    }
  })
});

});
 
</script>
 