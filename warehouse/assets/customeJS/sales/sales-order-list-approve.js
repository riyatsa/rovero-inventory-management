get_warehouse_sales_product();
function get_warehouse_sales_product() {
	$.ajax({
    type  : 'ajax',
    url   : '?/SalesOrder/get_sales_orders_approve',
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
            '<td id="vendor_name_'+data[i].sales_id+'">'+data[i].storeName+'</td>'+
            '<td id="bill_number'+data[i].sales_id+'">'+data[i].bill_number+'</td>'+ 
            '<td id="total_'+data[i].sales_id+'"><i class="fa fa-rupee"></i>'+data[i].total+'</td>'+ 
            '<td id="created_date_'+data[i].sales_id+'">'+data[i].created_date+'</td>'; 
            if(data[i].warehouse_return_status == '2'){
                html+='<td id="status_'+data[i].sales_id+'" class="text-warning">Pending</td>'
            }else if(data[i].warehouse_return_status == '1'){
                html+='<td id="status_'+data[i].sales_id+'" class="text-success">Accepted</td>'
            }else if(data[i].warehouse_return_status == '0'){
                html+='<td id="status_'+data[i].sales_id+'" class="text-danger">Rejected</td>'
            }else {
                html+='<td id="status_'+data[i].sales_id+'" class="text-info">Updated</td>'
            }

           /* if (data[i].qty_status ==1) {
              html+='<td><a href="#" id="view_sales'+data[i].sales_id+' " onclick="view_sales('+data[i].sales_id+')" class="edit-a"><i class="fa fa-eye" aria-hidden="true"></i></a><a href="?/SalesOrder/re_edit_sales_bill/'+data[i].sales_id+'"><i class="fa fa-pencil"></i></a></td>' 
            }else{*/
              html+='<td><a href="#" id="view_sales'+data[i].sales_id+' " onclick="view_sales('+data[i].sales_id+')" class="edit-a"><i class="fa fa-eye" aria-hidden="true"></i></a></td>' 

            // }
          html+='</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="7" class="text-center">No Sales Order found.</td>'+
        '</tr>';	
    }
    $('#get_purchase_order').html(html);   
  }
  }); 
}

function view_sales(id){  
  $('#sales_order_View').modal('show');

  $.ajax({
    type  : 'ajax',
    url   : '?/SalesOrder/get_sales_order_veiw/'+id, 
    async : false,
    dataType : 'json',
    success : function(data){
      console.log(JSON.stringify(data))  
      // alert(JSON.stringify(data.product_id))

     /* var product_id = data.invoice[0].product_id.split(",");
      var productIds = [];

      var product_name = data.invoice[0].product.split(",");
      var productNames = [] 

      var quntity = data.invoice[0].quntity.split(",");
      var quntitys = [];

      var unit_id = data.invoice[0].unit_id.split(",");
      var unitIds = [];

      var price = data.invoice[0].price.split(",");
      var prices = [];

      var tax_persent = data.invoice[0].tax_persent.split(",");
      var tax_price = data.invoice[0].tax_price.split(",");
      var taxPrice = []

      var amount = data.invoice[0].amount.split(",");
      var amounts = []
      
      var productDetails = []

      var total_GST  = 0;
      var total_GST_price  = 0; 

     
        for (var i = 0; i < product_id.length; i++) { 
            var productData = {};  
            productData['product_name'] = product_name[i]
            productData['quntity'] = quntity[i]
            productData['price'] = price[i]
            productData['GST'] = tax_persent[i]+","+tax_price[i]
            productData['amount'] = amount[i]

            total_GST += parseFloat(tax_persent[i]);
            total_GST_price += parseFloat(tax_price[i]);

            productDetails.push(productData)  
        } */
 
      // console.log(JSON.stringify(productDetails))


       /* var amount_semi_total = 0;
        for (var k = 0; k < amount.length; k++) {
            amount_semi_total += amount[k] << 0;
        }

         var total_quntity = 0;
        for (var k = 0; k < quntity.length; k++) {
            total_quntity += quntity[k] << 0;
        }*/

      $('#store_name').html(data.party_name)
      // $('#vendor_phone_number').html('Phone number:'+data.invoice.phone_number) 
      $('#sales_number').html('Invoice No.: '+data.bill_number)
      $('#sales_date').html('Date: '+data.bill_date)
      var table_data = '';
          table_data +='<tr>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">#</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Item Name</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Barcode</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Quantity</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Received</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Price/Unit</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Amount</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Status</td>'
          table_data +='</tr>'
          var table_datas = '';
          var j=1;
          for (var i = 0; i < data.product.length ; i++) {
            /* var unit = '-'
            if(data.productDetail[i].unit_name != null){
                unit = data.productDetail[i].unit_name
            }*/
            table_datas +='<tr>'
            table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+ j++ +'</td>'
            table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i]['product_name']+'</td>'
            table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].barcode+'</td>'
            table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i]['product_qty']+'</td>'
            table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].received+'</td>'
            table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+data.product[i]['product_price']+'</td>'
           
            table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+parseFloat(data.product[i]['product_amount']).toFixed(2)+'</td>'
            table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i]['status']+'</td>'
            table_datas +='</tr>'
          } 
          var table_data_row = '';
      table_data_row +='<tr>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
      table_data_row +='</tr>'


      table_data_row +='<tr>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">Total</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">'+data.qty+'</td>'//total quntity
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ '+parseFloat(data.grand_total).toFixed(2)+'</td>'//grand_total
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;"></td>'//tax_price_total
      table_data_row +='</tr>'
             
        table_data += table_datas +=table_data_row; 

        $('#table_data').html(table_data)
        
        var new_accept = '';
        // alert(data.warehouse_return_status)

        new_accept +='<table class="w-100 mb-3 text-right">';
            if(data.warehouse_return_status == 0){
                new_accept +='<tr>'; 
                new_accept +='<td class="text-right"><input style="padding:5px;" value="Rejected" type="button" class="btn btn-danger button "> </td>';
                new_accept +='</tr>';
            }else if(data.warehouse_return_status == 1){
                new_accept +='<tr>'; 
                new_accept +='<td class="text-right"><input style="padding:5px;" value="Accepted" type="button" class="btn btn-success button"> </td>';
                new_accept +='</tr>'; 
            }else if(data.warehouse_return_status == 2){
                new_accept +='<tr>'; 
                new_accept +='<td class="text-right"><input style="padding:5px;" value="Accept" type="button" onclick="purchaseOrderRejectApproverd('+data.sales_id+','+1+')" class="btn btn-success button"> <input style="padding:5px;" value="Reject" type="button" onclick="purchaseOrderRejectApproverd('+data.sales_id+','+0+')" class="btn btn-danger button "> </td>';
                new_accept +='</tr>';
            }
            
        new_accept +='</table>';

        $("#newWin_accept_reject").html(new_accept);


        var sub_total = parseFloat(data['grand_total']) - parseFloat(data['tax_price_total']);
        var sgst_cgst = data['tax_price_total']/2;//$bill['grand_total']-$bill['tax_price_total']

        var sgst_cgst_per = data['tax_persent_total']/data.product.length;
         sgst_cgst_per = sgst_cgst_per/2

        $('#sub_toal').html('₹'+parseFloat(sub_total).toFixed(2))
        
        $('#cgst_price').html('₹'+parseFloat(sgst_cgst).toFixed(2))
        $('#sgst_price').html('₹'+parseFloat(sgst_cgst).toFixed(2))

        // $('#cgst_per').html('CGST&copy;'+sgst_cgst_per.toFixed(2)+'%')
        // $('#sgst_per').html('SGST&copy;'+sgst_cgst_per.toFixed(2)+'%')
        $('#cgst_per').html('CGST')
        $('#sgst_per').html('SGST')
        $('#total_price').html('₹'+parseFloat(data['grand_total']).toFixed(2))
        $('#received_price').html('₹'+parseFloat(data['paid']).toFixed(2))
        $('#balance').html('₹'+parseFloat(data['balance']).toFixed(2))


        // $('#total_price').html('₹'+data.invoice[0].total)
        // $('#received_price').html('₹'+data.invoice[0].paid)
        // $('#balance').html('₹'+data.invoice[0].balance)
        // $('#for_store').html('For, '+data.invoice[0].storeName)



    }
  }); 
  
}

function purchaseOrderRejectApproverd(id,status){
     
    var formdata = new FormData();
    formdata.append('sales_id',id);
    formdata.append('status',status);
    $.ajax({
        type  : 'POST',
        url   : '?/SalesOrder/change_warehouse_accept_order_status/'+id, 
        data  : formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success : function(data){
            $('#sales_order_View').modal('hide');
            if(data.status == 1){  

                if(status == 1){

                    toastr.success('Your Order Accepted');
                    window.location = "?/SalesOrder/re_edit_sales_bill/"+id;
                }else{
                  $("#newWin_accept_reject").html('');
                    toastr.success('Your Order Rejeted');
                }
                
            }else{
                toastr.error('Please try again.');
            }
        }
    })
}