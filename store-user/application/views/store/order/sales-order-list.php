  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
             <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Store Panel / </a>
              <span class="header-left-tab-span">View All Bills</span>
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
              <a class="nav-link nav-link-product-tab" href="?/StoreBilling">Create Bill</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="#" >View All Bills</a>
            </li>
                         <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/StoreBilling/hold_bills" >View All Hold Order</a>
            </li>
          </ul>
          <section class="content">
            <div class="container-fluid">
              <div class="text-center" id="customer-status"></div>
              <!--  <button class="btn btn-add text-white mt-0 float-right" onclick="addGstModal()" id="add_gst_btn" name="add_gst_btn">Add GST</button> -->
              <div class="table-responsive mt-3" id="">
              <span class="d-block medium-text mb-2">All Bills</span>
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <!-- client name,client number, bill number,amount -->
                    <tr>
                      <th>Sr No.</th>
                      <th>Customer Name</th>
                      <th>Customer Number</th> 
                      <th>Bill Number</th> 
                      <th>Total Amount</th> 
                      <th>Date</th>
                      <th>Bill Status</th>   
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
  <!-- View Purchase Order -->

<?php $store = $this->session->userdata('logged_in_store_user'); 
 $store = $this->db->where('storeId',$store['soreId'])->get('storedetails')->row_array();
 ?>
<div class="modal fade view_store_bill" id="view_store_bill">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-edit">
        <div class="modal-header border-0">
          <h4 class="modal-title-edit-coupon">Sales Order</h4>
        </div>
        <div class="modal-body">
          <table class="px-1" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #CCC;">
            <tr>
              <td width="20" rowspan="16">&nbsp;</td>
              <td id="cancle_button"  width="300" height="50">&nbsp;</td>
              <td width="20" rowspan="16">&nbsp;</td>
            </tr>
            <tr>
              <td style="font-family:Arial, Helvetica, sans-serif; font-size:30px; font-weight:bold; line-height:34px; text-align:center; text-transform:uppercase;"><?php echo $store['storeName']?></td>
            </tr>
            <tr>
              <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px; text-align:center;"></td>
            </tr>
            <tr>
              <td id="store_name"style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px; text-align:center; font-weight:bold;">Cash Receipt</td>
            </tr>
            <tr>
              <td id="store_address" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; line-height:21px; text-align:center;"></td>
            </tr>
            <tr>
              
              <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px; text-align:center;">GSTIN No : <?= $store['gstinNumber']?></td>
            </tr>
            <tr>
              <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:25px; text-align:center;"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="34%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Date</td>
                  <td id="bill_date" width="220" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"></td>
                </tr>
                <tr>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Invoice No</td>
                  <td id="bill_number"  align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"></td>
                </tr>

               <!--  <tr>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Manager</td>
                  <td id="manager_store_name" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"><?php echo $store['storeName']?></td>
                </tr> -->
                <tr>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Customer Name</td>
                  <td id="customer_name" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"></td>
                </tr>
                <tr>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Referral Code</td>
                  <td id="customer_refral" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
                  <table id="bill_data" width="100%" border="0" cellspacing="0" cellpadding="0"> 
                     
                </table>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; line-height:30px; text-align:center; text-transform:uppercase;">||Thank you visit again||</td>
            </tr>
            <tr>
              <td height="50" align="center">
                <input id="print_button" style="padding:5px;" value="Print Document" type="button" onclick="printDiv()" class="btn btn-info button float-center">
                <input id="back_button" style="padding:5px;" value="Back" type="button" onclick="close_model()" class="btn btn-warning float-center">
              </td>
            </tr>  
          </table>
           
        </div>  
      </div>
    </div>
  </div>
  <!-- View Purchase Order Ends -->
<script>
function printDiv() 
{
   $('#print_button').hide();
  $('#cancle_button').hide();
  $('#back_button').hide();

  var divToPrint=document.getElementById('view_store_bill');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);
  $('#print_button').show();
  $('#cancle_button').show();
  $('#back_button').show();
}
</script>
<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/order/sales-order-list.js"></script> 