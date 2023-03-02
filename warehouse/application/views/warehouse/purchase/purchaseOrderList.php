  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
             <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Warehouse Panel / </a>
              <span class="header-left-tab-span">Purchase Order List</span>
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
              <a class="nav-link nav-link-product-tab" href="?/PurchaseOrder">Add Purchase Order</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#" >View All Purchase Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/PurchaseOrder/storePurchsedetails" >Store Indent</a>
            </li>
            <li class="nav-item d-none">
              <a class="nav-link nav-link-product-tab" href="?/PurchaseOrder/store_return_order" >Return Store Purchase Order</a>
            </li>
          </ul>
          <section class="content">
            <div class="container-fluid">
              <div class="text-center" id="customer-status"></div>
              <!--  <button class="btn btn-add text-white mt-0 float-right" onclick="addGstModal()" id="add_gst_btn" name="add_gst_btn">Add GST</button> -->
              <div class="table-responsive mt-3" id="">
              <span class="d-block medium-text mb-3">All Product Purchase List</span>
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>Vendor Name</th>
                      <th>Bill Number</th> 
                      <th>Total Amount</th> 
                      <th>Date</th> 
                      <th>View</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="get_purchase_order">
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
 

<!-- Edit GST Modal Starts -->
  <div class="modal fade" id="edit_store">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Edit Product Details</h4>
        </div>
        <input type="hidden" name="product_id" id="product_id">
         <div class="row mt-4">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Select Product Category</label>
                  <select class="form-control input-txt" name="select_product_category" id="select_product_category" >
                    <option value="">Select Category</option>
                    <?php foreach ($category as $key => $value) {
                      echo "<option value='".$value['category_id']."'>".$value['category_name']."</option>";
                    } ?>
                  </select>
                  <div id="select-category-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Select Unit</label>
                  <select class="form-control input-txt" name="select_unit" id="select_unit" >
                    <option value="">Select Unit</option>
                    <?php foreach ($unit as $key => $value) {
                      echo "<option value='".$value['unit_id']."'>".$value['unit_name']."</option>";
                    } ?>
                  </select>
                  <div id="select_unit-error-msg-div"></div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-6">
                  <label class="product-details-span-light">Item Code</label>
                  <input type="number" class="form-control input-txt" name="item_code" id="item_code" placeholder="Enter Item Code.">
                  <div id="item-code-error-msg-div"></div>
                </div>
                <div class="col-sm-6">
                  <label class="product-details-span-light">Item Name</label>
                  <input type="text" class="form-control input-txt" name="item_name" id="item_name" placeholder="Enter Item Name.">
                  <div id="item-name-error-msg-div"></div>
                </div>
              </div>
              <!--  -->
              <div class="row mt-3">
                <div class="col-sm-3">
                  <label class="product-details-span-light">Sale Price</label>
                  <input type="number" class="form-control input-txt" name="sale_price" id="sale_price" placeholder="Enter Sale Price.">
                  <div id="sale-price-error-msg-div"></div>
                </div>
                <div class="col-sm-3">
                  <label class="product-details-span-light">Sale TAX Type</label>
                  <select class="form-control input-txt" name="sale_tax_price" id="sale_tax_price" >
                    <option value="exclude">Exclude</option> 
                    <option value="include">Include</option> 
                  </select>
                  <div id="sale-tax-price-error-msg-div"></div>
                </div>
                <div class="col-sm-3">
                  <label class="product-details-span-light">Purchase Price</label>
                  <input type="number" class="form-control input-txt" name="purchase_price" id="purchase_price" placeholder="Enter Purchase Price.">
                  <div id="purchase-price-error-msg-div"></div>
                </div>
                <div class="col-sm-3">
                  <label class="product-details-span-light">Purchase TAX Type</label>
                  <select class="form-control input-txt" name="purchase_tax_type" id="purchase_tax_type" >
                    <option value="exclude">Exclude</option> 
                    <option value="include">Include</option> 
                  </select>
                  <div id="purchase-tax-type-error-msg-div"></div>
                </div>
              </div>
              <!--  -->
              <div class="row mt-3">
                <div class="col-sm-3">
                   <label class="product-details-span-light">Select TAX Rate</label>
                  <select class="form-control input-txt" name="select_tax_rate" id="select_tax_rate" >
                    <option value="">Select GST RATE</option>
                    <?php foreach ($gst as $key => $value) {
                      echo "<option value='".$value['gst_id']."'>".$value['gst_name']."</option>";
                    } ?>
                  </select>
                  <div id="select-tax-rate-error-msg-div"></div>
                </div>
                
                <div class="col-sm-3">
                  <label class="product-details-span-light">Opening quantity</label>
                  <input type="text" class="form-control input-txt" name="opening_quantity" id="opening_quantity" placeholder="Enter Opening quantity.">
                  <div id="opening-quantity-error-msg-div"></div>
                </div>
               
                <div class="col-sm-3">
                  <label class="product-details-span-light">Date</label>
                  <input type="text" class="date-min-today form-control input-txt" name="date" id="date" placeholder="Enter date.">
                  <div id="date-error-msg-div"></div>
                </div>
                <div class="col-sm-3">
                  <label class="product-details-span-light">Minimum Stock</label>
                  <input type="number" class="form-control input-txt" name="minimum_stock" id="minimum_stock" placeholder="Enter Minimum Stock.">
                  <div id="minimum-stock-error-msg-div"></div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12 text-center">
                  <div class="text-center" id="product-error"></div>
                </div>
      
              </div>
        <div class="modal-footer border-0">
          <button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn"  data-dismiss="modal">Cancel</button>
                  <button class="btn btn-add btn-add-2 text-white mt-0" onclick="saveProducts()" id="add_new_product_btn" name="add_new_product_btn">Edit</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit GST Modal Ends -->

 <?php 
  $sessionData ='';
  if ($this->session->userdata('logged_in_warehouse')) { 

    $sessionData = $this->session->userdata('logged_in_warehouse'); 
  }
 ?>
<!-- View Purchase Order -->
<div class="modal fade purchase_order" id="purchase_order_View">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Purchase Order</h4>
        </div>
        <div class="modal-body">
           <table class="w-100" border="0" align="center" cellpadding="0" cellspacing="0">
            
            <tr>
              <td style="width: 70%;">
                <span id="party_name" style="display: block; font-family:Arial, Helvetica, sans-serif; font-size:34px; font-weight:bold; line-height:50px;"><?php echo $session = $sessionData['warehouseName'] ? $sessionData['warehouseName'] : '' ; ?></span>

                <span id="party_number" style="display: block; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px;">Phone number: <?php echo $session = $sessionData['PhoneNumber'] ? $sessionData['PhoneNumber'] : '' ; ?></span>

                <span id="party_gstin_number" style="display: block; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px;">GSTIN Number: <?php echo $session = $sessionData['gstinNumber'] ? $sessionData['gstinNumber'] : '' ; ?></span>

                
              </td>
              <td style="width:30%;text-align: right;" >
                  <img style="width: 100%;" src="<?php echo base_url()?>assets/dist/img/sidebar-logo/001.jpg" alt="Rover">
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:30px; line-height:70px; color:#fa423b; font-weight:bold;">Purchase Order</td>
            </tr>
 
            <tr>
              <td colspan="2" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="220" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Bill To</td>
                  <td width="500">&nbsp;</td>
                  <td id="sales_number" width="220" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"></td>
                </tr>
                <tr>
                  <td id="store_name" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">
                    <?php echo $session = $sessionData['warehouseName'] ? $sessionData['warehouseName'] : '' ; ?>
                  </td>
                  <td>&nbsp;</td>
                  <td id="sales_date"align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">
                <table id="table_data" width="100%" border="0" cellspacing="0" cellpadding="0">
                  
                </table>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="430" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                     
                  </table></td>
                  <td width="80">&nbsp;</td>
                  <td colspan="2" width="430" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">Sub Total</td>
                      <td id="sub_toal"style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ 97.10</td>
                    </tr>
                    <tr>
                      <td id="cgst_per" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;"></td>
                      <td id="cgst_price"style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ 1.46</td>
                    </tr>
                    <tr>
                      <td id="sgst_per" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;"></td>
                      <td id="sgst_price" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ 1.46</td>
                    </tr>
                    <tr>
                      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#fff; font-weight:bold; padding:7px 7px; background:#fa423b;">Total</td>
                      <td id="total_price"style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#fff; font-weight:bold; padding:7px 7px; background:#fa423b; text-align:right;">₹ 100.01</td>
                    </tr>
                    <tr>
                      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">Received</td>
                      <td id="received_price"style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ 100.01</td>
                    </tr>
                    <tr>
                      <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; border-bottom:1px solid #CCC;">Balance</td>
                      <td id="balance" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right; border-bottom:1px solid #CCC;">₹ 0.00</td>
                    </tr>
                    <tr>
                      <td id="for_store"colspan="2" style="font-family:Arial, Helvetica, sans-serif; text-align:center; color:#036; line-height:70px; font-size:14px;">For,<?php echo $session = $sessionData['warehouseName'] ? $sessionData['warehouseName'] : '' ; ?>
                      </td>
                    </tr>
                    <tr>
                      <td height="20">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; text-align:center; color:#000; line-height:30px;">Authorized Signator</td>
                      </td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="20">&nbsp;</td>
            </tr>
            <!-- <tr>
              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; text-align:center; color:#000; line-height:30px;">Authorized Signator</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td width="430">&nbsp;</td>
                </tr>
              </table></td>
            </tr> -->
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="50">&nbsp;</td>
            </tr>
            <tr>
               <td colspan="2" height="50" align="center"><input style="padding:5px;" value="Print Purchase Order" type="button" id="print_button" onclick="printDiv()" class="btn btn-info button float-center"></td>
            </tr>
          </table> 
        </div>  
      </div>
    </div>
  </div>
  <!-- View Purchase Order Ends -->
<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/purchase-order/purchaseOrderJs.js"></script> 
<script>


function printDiv() 
{
  $('#print_button').hide();

  var divToPrint=document.getElementById('purchase_order_View');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);
  $('#print_button').show();
}
</script>
