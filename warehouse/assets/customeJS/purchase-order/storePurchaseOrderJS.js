get_warehouse_product();
function get_warehouse_product() {
    $.ajax({
    type  : 'ajax',
    url   : '?/PurchaseOrder/get_order_store_order_list',
    async : false,
    dataType : 'json',
    success : function(data){
        console.log(JSON.stringify(data))
      // alert(JSON.stringify(data))
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) { 
          
          html+='<tr>'
            html+='<td>'+j+'</td>'
            html+='<td id="vendor_name_'+data[i].purchase_id+'">'+data[i].storeName+'</td>'
            html+='<td id="bill_number'+data[i].purchase_id+'">'+data[i].bill_number+'</td>'
            html+='<td id="total_'+data[i].purchase_id+'"><i class="fa fa-rupee"></i>'+data[i].total+'</td>'
            html+='<td id="created_date_'+data[i].purchase_id+'">'+data[i].created_date+'</td>'
            if(data[i].approve_reject == '2'){
                html+='<td id="status_'+data[i].purchase_id+'" class="text-warning">Pending</td>'
            }else if(data[i].approve_reject == '1'){
                html+='<td id="status_'+data[i].purchase_id+'" class="text-success">Accepted</td>'
            }else if(data[i].approve_reject == '0'){
                html+='<td id="status_'+data[i].purchase_id+'" class="text-danger">Rejected</td>'
            }else {
                html+='<td id="status_'+data[i].purchase_id+'" class="text-info">Updated</td>'
            }
            
            html+='<td><a href="#" id="edit_store_'+data[i].purchase_id+' " onclick="view_store('+data[i].purchase_id+')" class="edit-a"><i class="fa fa-eye"></i></a></td>'
          html+='</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="7" class="text-center">No Order Found.</td>'+
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
    url   : '?/PurchaseOrder/get_store_purchase_order/'+id,
    async : false,
    dataType : 'json',
    success : function(data){ 
      // console.log(JSON.stringify(data))
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
        html +='<td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:30px; line-height:70px; color:#fa423b; font-weight:bold;">Purchase Order</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td><table width="100%" border="0" cellspacing="0" cellpadding="0">';
        html +='<tr>';
        html +='<td width="220" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Bill To</td>';
        html +='<td width="500">&nbsp;</td>';
        html +='<td width="220" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">Invoice No.:'+data['bill_number']+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; line-height:25px;">'+data['storename']['storeName']+'</td>';
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
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">#</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Item Name</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">HSN/SAC</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Quantity</td>';
        // html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Unit</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Price/Unit</td>';
        // html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">GST</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Amount</td>';
        html +='</tr>';
        var j=1;
        for (var i = 0; i < data.product.length; i++) {
          
      
        html_tr +='<tr>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+j++ +'</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].product_name+'</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].barcode+'</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].product_qty+'</td>';
        // html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].unit_name+'</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+data.product[i].product_price+'</td>';
        // html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+parseFloat(data.product[i]['tax_price']).toFixed(2)+'('+data.product[i]['tax_persent']+'% )</td>';
        html_tr +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+data.product[i]['product_amount']+'</td>';
        html_tr +='</tr>';
      }
        html +=html_tr;
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        // html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        // html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">Total</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">'+data['qty']+'</td>';
        // html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>';
        // html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹'+parseFloat(data['tax_price_total']).toFixed(2)+'</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹'+parseFloat(data['grand_total']).toFixed(2)+'</td>';
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
        var cgst_sgst = data['tax_persent_total']/data.product.length;
        cgst_sgst = cgst_sgst/2;
        var subtotal = parseFloat(data['grand_total'])-parseFloat(data['tax_price_total']);
        html +='</table></td>';
        html +='<td width="80">&nbsp;</td>';
        html +='<td width="430" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">Sub Total</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ '+parseFloat(subtotal).toFixed(2)+'</td>';
        html +='</tr>';
        html +='<tr>';
        // html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">SGST&copy;'+parseFloat(cgst_sgst ).toFixed(2)+'%</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">SGST</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ '+parseFloat(data['tax_price_total']/2 ).toFixed(2)+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">CGST</td>';
        // html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">SGST&copy;'+parseFloat(cgst_sgst).toFixed(2)+'%</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ '+parseFloat(data['tax_price_total']/2 ).toFixed(2)+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#fff; font-weight:bold; padding:7px 7px; background:#fa423b;">Total</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#fff; font-weight:bold; padding:7px 7px; background:#fa423b; text-align:right;">₹ '+parseFloat(data['grand_total']).toFixed(2)+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px;">Received</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right;">₹ '+parseFloat(data['grand_total']).toFixed(2)+'</td>';
        html +='</tr>';
        html +='<tr>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; border-bottom:1px solid #CCC;">Balance</td>';
        html +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px; text-align:right; border-bottom:1px solid #CCC;">₹ '+parseFloat(data['balance']).toFixed(2)+'</td>';
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
        // html +='<tr>';
        // html +='<td height="50" align="center"><input style="padding:5px;" value="Print Document" type="button" onclick="myFunction()" class="btn btn-info button float-center"></td>';
        // html +='</tr>';
        
        // html +='<tr>';
        // html +='<td height="50" align="center"><input style="padding:5px;" value="Reject" type="button" onclick="myFunction()" class="btn btn-info button float-center"></td>';
        // html +='</tr>'; 
        html +='</table>';
        html +='<table class="w-100 mb-3">';
            if(data.approve_reject_status == 0){
                html +='<tr>'; 
                html +='<td class="text-right"><input style="padding:5px;" value="Rejected" type="button" class="btn btn-danger button "> </td>';
                html +='</tr>';
            }else if(data.approve_reject_status == 1){
                html +='<tr>'; 
                html +='<td class="text-right"><input style="padding:5px;" value="Accepted" type="button" class="btn btn-success button"> </td>';
                html +='</tr>'; 
            }else if(data.approve_reject_status == 2){
                html +='<tr>'; 
                html +='<td class="text-right"><input style="padding:5px;" value="Accept" type="button" onclick="purchaseOrderRejectApproverd('+id+','+1+')" class="btn btn-success button"> <input style="padding:5px;" value="Reject" type="button" onclick="purchaseOrderRejectApproverd('+id+','+0+')" class="btn btn-danger button "> </td>';
                html +='</tr>';
            }
            
        html +='</table>';

        $("#get_store_purchase_order").html(html);

    }
  });
}


function purchaseOrderRejectApproverd(id,status){
     
    var formdata = new FormData();
    formdata.append('purchase_id',id);
    formdata.append('status',status);
    $.ajax({
        type  : 'POST',
        url   : '?/PurchaseOrder/change_puchase_order_status/'+id, 
        data  : formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success : function(data){
            $("#view_store").modal('hide');
            if(data.status == 1){  

                if(status == 1){

                    toastr.success('Your Order Accepted');
                    window.location = "?/store-purchase-order/"+id;
                }else{
                    toastr.success('Your Order Rejeted');
                }
                
            }else{
                toastr.error('Please try again.');
            }
        }
    })
}
//   function myFunction()
// {
//       // $("#print").show(); 
//     // window.print(); 
//       $('.button').hide();
//       var divToPrint=document.getElementById('get_store_purchase_order');

//   var newWin=window.open('','Print-Window');

//   newWin.document.open();

//   newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

//   newWin.document.close();

//   setTimeout(function(){newWin.close();},10);
//   $('.button').hide();
// }