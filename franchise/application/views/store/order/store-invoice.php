<style>
  @media print
{
  .button
  {
    display: none;
  }
}
</style>
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <label>
               <a href="<?php echo base_url()?>" class="header-left-tab-a">Outlet Panel / </a>
               <span class="header-left-tab-span">Create Bill</span>
               </label>
            </div>
         </div>
      </div>
   </div>

   <?php
$store = $this->session->userdata('logged_in_store');
   // var_dump($bill);
   ?>

<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="30" rowspan="13">&nbsp;</td>
    <td height="50">&nbsp;</td>
    <td width="30" rowspan="13">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:34px; font-weight:bold; line-height:50px;"><?= $bill['warehouseName']; ?></td>
  </tr>
  <tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px;">Phone number: <?= $bill['phoneNumber']; ?></td>
  </tr>
  <tr>
    <td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:30px; line-height:70px; color:#fa423b; font-weight:bold;">Tax Invoice</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="220" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Bill To</td>
        <td width="500">&nbsp;</td>
        <td width="220" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Invoice No.: <?= $bill['bill_number']?></td>
      </tr>
      <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"><?= $store['storeName']?></td>
        <td>&nbsp;</td>
        <td align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Date: <?= $bill['bill_date']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF;/* padding:12px 7px 12px 12px;*/ background:#fa423b;">Sr. No.</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF;/* padding:12px 7px 12px 12px;*/ background:#fa423b;">Item Name</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF;/* padding:12px 7px 12px 12px;*/ background:#fa423b;">Barcode</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF;/* padding:12px 7px 12px 12px;*/ background:#fa423b;">Quantity</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF;/* padding:12px 7px 12px 12px;*/ background:#fa423b;">MRP</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF;/* padding:12px 7px 12px 12px;*/ background:#fa423b;">Price/Unit</td>
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">GST</td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; /*padding:12px 7px 12px 12px;*/ background:#fa423b;">Amount</td>
      </tr>
      <?php 
      $i = 1;
      foreach ($bill['product'] as $key => $value) {
        ?>
        <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; /*padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;"><?php echo $i++; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; /*padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;"><?php echo $value['product_name']; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; /*padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;"><?php echo $value['barcode']; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; /*padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;"><?php echo $value['product_qty']; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; /*padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;">₹ <?php echo isset($value['product_mrp'])?$value['product_mrp']:''; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; /*padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;">₹ <?php echo $value['product_price']; ?></td>
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ <?php //echo $value['tax_price']."(".$value['tax_persent']."% )"; ?></td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;">₹ <?php echo $value['product_amount']; ?></td>
      </tr>
      <?php
      }
      ?>
      <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;">&nbsp;</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;">&nbsp;</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;">&nbsp;</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;">&nbsp;</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;">&nbsp;</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;">&nbsp;</td>
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000;">&nbsp;</td>
      </tr>


      <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000; font-weight:bold;">Total</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000; font-weight:bold;"><?php echo $bill['qty']; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ <?php //echo $bill['tax_price_total']; ?></td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px 7px 12px;*/ border-bottom:1px solid #000; font-weight:bold;">₹ <?php echo round($bill['grand_total'],2); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="430" valign="top"><!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; text-transform:uppercase; font-size:16px; font-weight:bold; color:#666; line-height:30px; padding:3px 7px;">INVOICE AMOUNT IN WORDS</td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333; background:#f1f1f1; padding:5px 7px;">One Hundred Rupees and One Paisa only</td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; text-transform:uppercase; font-size:16px; font-weight:bold; color:#666; line-height:30px; padding:3px 7px;">TERMS AND CONDITIONS</td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333; background:#f1f1f1; padding:5px 7px;">Thanks for doing business with us!</td>
          </tr>
        </table> -->
        <!-- array(9) { ["warehouseName"]=> string(16) "Hebbal Warehouse" ["bill_number"]=> string(10) "1602853621" ["phoneNumber"]=> string(10) "1234567890" ["bill_date"]=> string(10) "2020-10-16" ["total"]=> int(26) ["qty"]=> int(1) ["amount_price"]=> float(26) ["amount"]=> array(2) { [0]=> string(5) "26.00" [1]=> string(4) "0.00" } ["product"]=> array(1) { [0]=> array(9) { ["product_id"]=> string(2) "46" ["barcode"]=> string(10) "1234567896" ["unit_name"]=> string(6) "LITERS" ["product_name"]=> string(5) "pro 7" ["product_qty"]=> string(1) "1" ["product_price"]=> string(2) "26" ["product_amount"]=> float(26.65) ["tax_persent"]=> string(3) "2.5" ["tax_price"]=> string(4) "0.65" } } } -->
      </td>
        <td width="80">&nbsp;</td>
        <td width="430" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">Sub Total</td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px;*/ text-align:right;">₹ <?php echo round($bill['grand_total'] - $bill['tax_price_total'],2);?></td>
          </tr>

          <?php

            $tax_sgst = $bill['tax_persent_total']/count($bill['product']); 
            $tax_sgst = $tax_sgst/2;
          
          ?>
 
          <tr>
            <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">CGST&copy;<?php //echo $tax_sgst ?>%</td> -->
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">CGST</td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px;*/ text-align:right;">₹ <?php echo $bill['tax_price_total']/2; ?></td>
          </tr>
          <tr>
            <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">SGST&copy;<?php  //echo $tax_sgst; ?>%</td> -->
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px;*/ ">SGST</td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px;*/ text-align:right;">₹ <?php echo $bill['tax_price_total']/2; ?></td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#fff; font-weight:bold;/* padding:7px 7px;*/ background:#fa423b;">Total</td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#fff; font-weight:bold;/* padding:7px 7px;*/ background:#fa423b; text-align:right;">₹ <?php echo round($bill['grand_total'],2); ?></td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">Received</td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px;*/ text-align:right;">₹ <?= $bill['paid']?></td>
          </tr>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px;*/ border-bottom:1px solid #CCC;">Balance</td>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;/* padding:7px 7px;*/ text-align:right; border-bottom:1px solid #CCC;">₹ <?php echo round($bill['balance'],2); ?></td>
          </tr>
          <tr>
            <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; text-align:center; color:#036; line-height:70px; font-size:14px;">For, My Company</td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="70">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td width="430" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; text-align:center; color:#000; line-height:30px;">Authorized Signator</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="430">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="50" align="center"><input style="padding:5px;" value="Print Document" type="button" onclick="myFunction()" class="btn btn-info button float-center"></td>
  </tr>
</table>
</div>

<script>
  function myFunction()
{
      $("#print").show(); 
    window.print(); 
}
</script>