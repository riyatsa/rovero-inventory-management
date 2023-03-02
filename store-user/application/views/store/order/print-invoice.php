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
               <a href="<?php echo base_url()?>" class="header-left-tab-a">Store Panel / </a>
               <span class="header-left-tab-span">Create Bill</span>
               </label>
            </div>
         </div>
      </div>
   </div>
<?php 
 $user = $this->session->userdata('logged_in_store_user');
 $store = $this->db->where('storeId',$user['soreId'])->get('storedetails')->row_array();
 // print_r($store);
// var_dump($bill);
?>
<div id="print_invoice" >
<table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #CCC;">
  <tr>
    <td width="20" rowspan="16">&nbsp;</td>
    <td width="300" height="50">&nbsp;</td>
    <td width="20" rowspan="16">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:30px; font-weight:bold; line-height:34px; text-align:center; text-transform:uppercase;"><?= $store['storeName']?></td>
  </tr>
  <tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px; text-align:center;"></td>
  </tr>
  <tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px; text-align:center; font-weight:bold;">Cash Receipt</td>
  </tr>
  
  <tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; line-height:21px; text-align:center;"><!-- 25, 3rd Main Road<br /> --><?= $store['city']." , ".$store['state']." - ".$store['pincode'] ?></td>
  </tr>
   <tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; line-height:21px; text-align:center;"><b>GSTIN No:</b> <?= (string)$store['gstinNumber']?></td>
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
        <td width="220" align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"><?= $bill['bill_date']; ?></td>
      </tr>
      <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Invoice No</td>
        <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"><?= $bill['bill_number']?></td>
      </tr>

     <!--  <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Manager</td>
        <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"><?= $store['storeName']?></td>
      </tr> -->
      <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Customer Name</td>
        <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"><?= $bill['customer_name']?></td>
      </tr>
      <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Referral Code</td>
        <td align="left" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;"><?= isset($bill['referal'])?$bill['referal']:''; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:1px solid #000;">#</td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:1px solid #000;">Name</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:1px solid #000;">Qty</td>
      <!--   <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:1px solid #000;">Tax</td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:1px solid #000;">MRP</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:1px solid #000;">Price</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:1px solid #000;">Total</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:1px solid #000;">Saving</td>
      </tr>
        <?php
        $i = 1;
        $saving =0;
        foreach ($bill['product'] as $key => $value) { 
          $saving +=round(((float)$value['mrp_price'] * (int)$value['product_qty']) - ((float)$value['product_price'] * (int)$value['product_qty']),2);
      ?>
      <tr>
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;"><?= $i++; ?></td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;"><?= $value['product_name']; ?></td>
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">12346</td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;"><?= $value['product_qty']; ?></td>
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;"><?= $value['tax_persent']; ?></td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;"><?= $value['mrp_price']; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;"><?= $value['product_price']; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;"><?= $value['product_amount']; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;"><?= round(((float)$value['mrp_price'] * (int)$value['product_qty']) - ((float)$value['product_price'] * (int)$value['product_qty']),2); ?></td>
      </tr>
      <?php
      
        }
      ?>
      <tr>
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">Total</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;"> <?= $bill['qty']; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td> 
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ <?= $bill['total']; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ <?= $bill['amount_price']; ?></td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ <?= $saving ?></td>
      </tr>
      <tr>
        <!-- <td>&nbsp;</td> -->
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>

       <tr> 
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td> -->
       
        <?php
         
        if($bill['order_discounted_percentage'] !='0') { 
          $total_disc = round($bill['grand_total']-$bill['order_discounted_price'],2);
        ?>
         <!-- <td>&nbsp;</td> -->
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">Discount Price</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ <?= $total_disc;?></td> 

         <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?php
        $point_total = 0;
        if ($bill['point'] !='0') {
          $point_total = round($total_disc - $bill['point'],2);
           ?>
        <tr>
         <!-- <td>&nbsp;</td> -->
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
      
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">Point</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">- ₹ <?php echo $bill['point']; ?></td>
        <td>&nbsp;</td>
         </tr>
           <?php
        }else{
          $point_total = $total_disc;
        }
        ?>


        <tr>
         <!-- <td>&nbsp;</td> -->
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
      
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">Total Amount</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ <?php echo round($point_total,2); ?></td>
        <td>&nbsp;</td>
         </tr>
          <?php
        }else{
          ?>

            <?php
        $point_total = 0;
        if ($bill['point'] !='0') {
          $point_total = round($bill['grand_total'] - $bill['point'],2);
           ?>
        <tr>
         <!-- <td>&nbsp;</td> -->
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
      
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">Point</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">- ₹ <?php echo $bill['point']; ?></td>
        <td>&nbsp;</td>
         </tr>
           <?php
        }else{
          $point_total = round($bill['grand_total'],2);
        }
        ?>
          <!-- <td>&nbsp;</td> -->
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
       
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">Total Amount</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ <?php echo round($point_total,2); ?></td>
         <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>
           </tr>
          <?php
        }
        ?>

   
          <?php

            $tax_sgst = $bill['tax_persent_total']/count($bill['product']); 
            $tax_sgst = $tax_sgst/2;
          
          ?>
      <tr>
        
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">CGST Amt</td>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">SGST Amt</td>
        <td>&nbsp;</td> 
         <td>&nbsp;</td> 
         <td>&nbsp;</td>
        <td>&nbsp;</td>
        <!-- <td>&nbsp;</td> -->
      </tr>
      <tr>   
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;"> <?php echo round($tax_sgst,2) ?>%</td>  -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ <?php echo round($bill['tax_price_total']/2,2); ?></td>
        <!-- <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;"><?php echo round($tax_sgst,2) ?>%</td> -->
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ <?php echo round($bill['tax_price_total']/2,2); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <!-- <td>&nbsp;</td> -->
      </tr>

      <!--  -->
     
    </table></td>
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
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:21px; font-weight:bold; line-height:30px; text-align:center; text-transform:uppercase;">Thank you</td>
  </tr>
  <tr>
    <td height="50" align="center"><input style="padding:5px;" value="Print Document" type="button" onclick="myFunction()" class="btn btn-info button float-center"></td>
  </tr> 
</table>
</div>
</div>
<script>
  function myFunction()
{
      // $("#print").show(); 
    // window.print(); 
      $('.button').hide();
      var divToPrint=document.getElementById('print_invoice');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><style>@media print{ .button { display: none; } }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);
  $('.button').show();
}
</script>

<!-- </div> -->