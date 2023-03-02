get_warehouse_product();
function get_warehouse_product() {
	$.ajax({
    type  : 'ajax',
    url   : '?/StoreOrder/get_order_store_order_list',
    async : false,
    dataType : 'json',
    success : function(data){
      // alert(JSON.stringify(data))
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) { 
          
          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td id="vendor_name_'+data[i].purchase_id+'">'+data[i].warehouseName+'</td>'+
            '<td id="bill_number'+data[i].purchase_id+'">'+data[i].bill_number+'</td>'+ 
            '<td id="total_'+data[i].purchase_id+'"><i class="fa fa-rupee"></i>'+data[i].total+'</td>'+ 
            '<td id="created_date_'+data[i].purchase_id+'">'+data[i].created_date+'</td>'+ 
            '<td><a href="#" id="edit_store_'+data[i].purchase_id+' " onclick="view_store('+data[i].purchase_id+')" class="edit-a"><i class="fa fa-eye"></i></a></td>'+ 
          '</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="5" class="text-center">No Order Found.</td>'+
        '</tr>';	
    }
    $('#get_purchase_order').html(html);   
  }
  }); 
}

function view_store(id){
  $("#view_store").modal('show');


  $.ajax({
    type  : 'ajax',
    url   : '?/StoreOrder/get_store_purchase_order/'+id,
    async : false,
    dataType : 'json',
    success : function(data){
      let html = '';
      let html_tr ='';

        html +='<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">';
        html +='<tr>';
        html +='<td width="30" rowspan="13">&nbsp;</td>';
        html +='<td height="50">&nbsp;</td>';
        html +='<td width="30" rowspan="13">&nbsp;</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:34px; font-weight:bold; line-height:50px;">'+data['warehouseName']+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#000; line-height:30px;">Phone number: '+data['phoneNumber']+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:30px; line-height:70px; color:#00C; font-weight:bold;">Tax Invoice</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td><table width="100%" border="0" cellspacing="0" cellpadding="0">';
        html +='<tr>';
        html +='<td width="220" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Bill To</td>';
        html +='<td width="500">&nbsp;</td>';
        html +='<td width="220" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Invoice No.:'+data['bill_number']+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">'+data['storename']+'</td>';
        html +='<td>&nbsp;</td>';
        html +='<td align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Date:'+data['bill_date']+'</td>';
        html +='</tr>';
        html +='</table></td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td>&nbsp;</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td><table width="100%" border="0" cellspacing="0" cellpadding="0">';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#00C;">#</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#00C;">Item Name</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#00C;">HSN/SAC</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#00C;">Quantity</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#00C;">Unit</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#00C;">Price/Unit</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#00C;">GST</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#00C;">Amount</td>';
        html +='</tr>';
        var j=1;
        for (var i = 0; i < data.product.length; i++) {
          
      
        html_tr +='<tr>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+j++ +'</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].product_name+'</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].barcode+'</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].product_qty+'</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].unit_name+'</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+data.product[i].product_price+'</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+data.product[i]['tax_price']+'('+data.product[i]['tax_persent']+'% )</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+data.product[i]['product_amount']+'</td>';
        html_tr +='</tr>';
      }
        html +=html_tr;
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">Total</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">'+data['qty']+'</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹'+data['tax_price_total']+'</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹'+data['grand_total']+'</td>';
        html +='</tr>';
        html +='</table></td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td>&nbsp;</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td><table width="100%" border="0" cellspacing="0" cellpadding="0">';
        html +='<tr>';
        html +='<td width="430" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">';
     /*   html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; text-transform:uppercase; font-size:16px; font-weight:bold; color:#666; line-height:30px; padding:3px 7px;">INVOICE AMOUNT IN WORDS</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333; background:#f1f1f1; padding:5px 7px;">One Hundred Rupees and One Paisa only</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; text-transform:uppercase; font-size:16px; font-weight:bold; color:#666; line-height:30px; padding:3px 7px;">TERMS AND CONDITIONS</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333; background:#f1f1f1; padding:5px 7px;">Thanks for doing business with us!</td>';
        html +='</tr>';*/
        html +='</table></td>';
        html +='<td width="80">&nbsp;</td>';
        html +='<td width="430" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">Sub Total</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ '+data['total']+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">SGST&copy;'+data['tax_persent_total']/2 +'%</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ '+data['tax_price_total']/2 +'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">SGST&copy;'+data['tax_persent_total']/2 +'%</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ '+data['tax_price_total']/2 +'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#fff; font-weight:bold; padding:7px 7px; background:#00C;">Total</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#fff; font-weight:bold; padding:7px 7px; background:#00C; text-align:right;">₹ '+data['grand_total']+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">Received</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ '+data['paid']+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; border-bottom:1px solid #CCC;">Balance</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right; border-bottom:1px solid #CCC;">₹ '+data['balance']+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; text-align:center; color:#036; line-height:70px; font-size:14px;">For, My Company</td>';
        html +='</tr>';
        html +='</table></td>';
        html +='</tr>';
        html +='</table></td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td height="70">&nbsp;</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td><table width="100%" border="0" cellspacing="0" cellpadding="0">';
        html +='<tr>';
        html +='<td>&nbsp;</td>';
        html +='<td width="430" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; text-align:center; color:#000; line-height:30px;">Authorized Signator</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td>&nbsp;</td>';
        html +='<td width="430">&nbsp;</td>';
        html +='</tr>';
        html +='</table></td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td>&nbsp;</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td height="50" align="center"><input style="padding:5px;" value="Print Document" type="button" onclick="myFunction()" class="btn btn-info button float-center"></td>';
        html +='</tr>';
        html +='</table>';

        $("#get_store_purchase_order").html(html);

    }
  });
}
  function myFunction()
{
      // $("#print").show(); 
    // window.print(); 
      $('.button').hide();
      var divToPrint=document.getElementById('get_store_purchase_order');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);
  $('.button').hide();
}