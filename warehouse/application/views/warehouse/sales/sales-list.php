  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
             <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Warehouse Panel / </a>
              <span class="header-left-tab-span">Sales Order List</span>
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
              <a class="nav-link nav-link-product-tab" href="?/SalesOrder">Add Sales Order</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#" >View All Sales Order</a>
            </li>
                     <li class="nav-item d-none">
              <a class="nav-link nav-link-product-tab" href="?/SalesOrder/re_approve_details" >View Re-Approve Sales Order</a>
            </li>
          </ul>
          <section class="content">
            <div class="container-fluid">
              <div class="text-center" id="customer-status"></div>
              <!--  <button class="btn btn-add text-white mt-0 float-right" onclick="addGstModal()" id="add_gst_btn" name="add_gst_btn">Add GST</button> -->
              <div class="table-responsive mt-3" id="">
              <span class="d-block medium-text mb-2">Sales List</span>
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>Store Name</th>
                      <th>Customer Name</th>
                      <th>Bill Numebr</th> 
                      <th>Total Amount</th> 
                      <th>Date</th>
                      <th>Order Status</th>
                      <th>View</th>
                      <!-- <th>Edit</th> -->
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
 <?php 
  $sessionData ='';
  if ($this->session->userdata('logged_in_warehouse')) { 

    $sessionData = $this->session->userdata('logged_in_warehouse'); 
  }
 ?>
 <!-- View Purchase Order -->
<div class="modal fade sales_order" id="sales_order_View">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Transfer Order(Sales Order)</h4>
        </div>
        <div id="sales_order_View_body" class="modal-body">
          <table class="w-100" border="0" align="center" cellpadding="0" cellspacing="0">
            
            <tr>
              <td style="width: 70%;">
                <span style="display: block; font-family:Arial, Helvetica, sans-serif; font-size:34px; font-weight:bold; line-height:50px;"><?php echo $session = $sessionData['warehouseName'] ? $sessionData['warehouseName'] : '' ; ?></span>

                <span style="display: block; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px;">Phone number: <?php echo $session = $sessionData['PhoneNumber'] ? $sessionData['PhoneNumber'] : '' ; ?></span>

                <span style="display: block; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px;">GSTIN Number: <?php echo $session = $sessionData['gstinNumber'] ? $sessionData['gstinNumber'] : '' ; ?></span>

                
              </td>
              <td style="width:30%;text-align: right;" >
                  <img style="width: 100%;" src="<?php echo base_url()?>assets/dist/img/sidebar-logo/001.jpg" alt="Rover">
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:30px; line-height:70px; color:#fa423b; font-weight:bold;">Transfer Order</td>
            </tr>
<!-- Vagar kam nu che  -->
            <tr style="display: none;">
              <td id="watehouse_name" style="font-family:Arial, Helvetica, sans-serif; font-size:34px; font-weight:bold; line-height:50px;"><?php echo $session = $sessionData['warehouseName'] ? $sessionData['warehouseName'] : '' ; ?></td>
            </tr>
            <tr style="display: none;">
            <td id="warehouse_number" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px;">Phone number: <?php echo $session = $sessionData['PhoneNumber'] ? $sessionData['PhoneNumber'] : '' ; ?></td>
            </tr>
            <tr style="display: none;">
            <td id="warehouse_number" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px;">GSTIN Number: <?php echo $session = $sessionData['gstinNumber'] ? $sessionData['gstinNumber'] : '' ; ?></td>
            </tr>
            <tr style="display: none;">
              <td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:30px; line-height:70px; color:#fa423b; font-weight:bold;">Tax Invoice</td>
            </tr>
<!-- Vagar kam nu che  -->
            <tr>
              <td colspan="2" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="220" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Bill To</td>
                  <td width="500">&nbsp;</td>
                  <td id="sales_number" width="220" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"></td>
                </tr>
                <tr>
                  <td id="store_name" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"></td>
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
                    <tr id="tr_points" style="display:none;">  
                    </tr> 
                    <tr id="tr_desc" style="display:none;">  
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
<script src="<?php echo base_url()?>assets/customeJS/sales/sales-order-list.js"></script>
<script>
function printDiv() 
{
  $('#print_button').hide();

  var divToPrint=document.getElementById('sales_order_View_body');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);
  $('#print_button').show();
}
</script>