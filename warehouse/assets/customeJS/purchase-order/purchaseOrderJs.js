get_warehouse_product();
function get_warehouse_product() {
	$.ajax({
    type  : 'ajax',
    url   : '?/PurchaseOrder/getPurchseDetails',
    async : false,
    dataType : 'json',
    success : function(data){ 
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) { 
          
          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td id="vendor_name_'+data[i].purchase_id+'">'+data[i].vendor_name+'</td>'+
            '<td id="bill_number'+data[i].purchase_id+'">'+data[i].bill_number+'</td>'+ 
            '<td id="total_'+data[i].purchase_id+'"><i class="fa fa-rupee"></i>'+data[i].total+'</td>'+ 
            '<td id="created_date_'+data[i].purchase_id+'">'+data[i].created_date+'</td>'+ 
            '<td><a href="#" id="view_purchase_'+data[i].purchase_id+' " onclick="view_purchase('+data[i].purchase_id+')" class="edit-a"><i class="fa fa-eye" aria-hidden="true"></i></a><a download href="?/PurchaseOrder/po_attachments/'+data[i].purchase_id+'"><i class="fa fa-download"></i></a></td>'+
            
          '</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="6" class="text-center">No Customer found.</td>'+
        '</tr>';	
    }
    $('#get_purchase_order').html(html);   
  }
  }); 
} 

function view_purchase(id){  
  $('#purchase_order_View').modal('show');

  $.ajax({
    type  : 'ajax',
    url   : '?/PurchaseOrder/getPurchseDetailsView/'+id,
    async : false,
    dataType : 'json',
    success : function(data){
      console.log(JSON.stringify(data))  
      // alert(JSON.stringify(data.product_id))

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

      // $('#store_name').html(data.party_name)
      // $('#vendor_phone_number').html('Phone number:'+data.invoice.phone_number) 
       
      $('#party_name').html(data.party_name)
      $('#party_number').html("Phone Number : "+data.party_number)
      $('#party_gstin_number').html("GSTIN : "+data.party_gstin_number)

      $('#sales_number').html('Invoice No.: '+data.bill_number)
      $('#sales_date').html('Date: '+data.bill_date)
      var table_data = '';
          table_data +='<tr>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">#</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Item Name</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Barcode</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Quantity</td>'
            // table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Unit</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Price/Unit</td>'
            // table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">GST</td>'
            table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FFF; padding:12px 7px 12px 12px; background:#fa423b;">Amount</td>'
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
            // table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">'+data.product[i].unit_name+'</td>'
            table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+data.product[i]['product_price']+'</td>'
           
            // table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+parseFloat(data.product[i]['tax_price']).toFixed(2)+' ('+data.product[i]['tax_persent']+'%)</td>'
            table_datas +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">₹ '+parseFloat(data.product[i]['product_amount']).toFixed(2)+'</td>'
            table_datas +='</tr>'
          } 
          var table_data_row = '';
      table_data_row +='<tr>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        // table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        // table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000;">&nbsp;</td>'
      table_data_row +='</tr>'


      table_data_row +='<tr>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">Total</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">'+data.qty+'</td>'//total quntity
        // table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>'
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">&nbsp;</td>'
        // table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ '+parseFloat(data.tax_price_total).toFixed(2)+'</td>'//tax_price_total
        table_data_row +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:1px solid #000; font-weight:bold;">₹ '+parseFloat(data.grand_total).toFixed(2)+'</td>'//grand_total
      table_data_row +='</tr>'
        table_data += table_datas +=table_data_row; 
        $('#table_data').html(table_data)


        var sub_total = parseFloat(data['grand_total']) - parseFloat(data['tax_price_total']);
        var sgst_cgst = data['tax_price_total']/2;//$bill['grand_total']-$bill['tax_price_total']

        var sgst_cgst_per = data['tax_persent_total']/data.product.length;
         sgst_cgst_per = sgst_cgst_per/2

        $('#sub_toal').html('₹'+sub_total.toFixed(2))
        
        $('#cgst_price').html('₹'+sgst_cgst.toFixed(2))
        $('#sgst_price').html('₹'+sgst_cgst.toFixed(2))

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