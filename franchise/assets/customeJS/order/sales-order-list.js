get_warehouse_product();
function get_warehouse_product() {
  $.ajax({
    type  : 'ajax',
    url   : '?/StoreBilling/get_current_store_sales_order_data',
    async : false,
    dataType : 'json',
    success : function(data){
      // alert(JSON.stringify(data))
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) { 
          var name ='Unregistered';
          var mobile_num ='Unregistered';
          if (data[i].customer_mobile_number !='') {
            mobile_num = data[i].customer_mobile_number;
            name = data[i].customer_name;
          }
          
          html+='<tr>'
            html+='<td>'+j+'</td>'
            html+='<td id="customer_name'+data[i].sales_id+'">'+name+'</td>'
            html+='<td id="customer_mobile_number'+data[i].sales_id+'">'+mobile_num+'</td>'
            html+='<td id="bill_number'+data[i].sales_id+'">'+data[i].bill_number+'</td>'
            html+='<td id="total_'+data[i].sales_id+'"><i class="fa fa-rupee"></i>'+data[i].total+'</td>'
            html+='<td id="created_date_'+data[i].sales_id+'">'+data[i].created_date+'</td>'
            
            if(data[i].order_status == '1'){
              html+='<td id="status_'+data[i].order_status+'" class="text-success">Confirm</td>'
            }else if(data[i].order_status == '0'){
              html+='<td id="status_'+data[i].order_status+'" class="text-danger">Cancel</td>'
            }else if(data[i].order_status == '3'){
               html+='<td id="status_'+data[i].order_status+'" class="text-warning">Hold</td>'
            }else{
               html+='<td id="status_'+data[i].order_status+'" class="text-info">Updated</td>'
            }

            if(data[i].balance == data[i].post_paid){
              html+='<td id="credit_status_'+data[i].bill_number+'" class="text-success">Paid</td>'
            }else{
              html+='<td id="credit_status_'+data[i].bill_number+'" class="text-danger">Unpaid<a id="credit_bill_store_'+data[i].bill_number+' " onclick="view_credit_bill('+data[i].sales_id+','+data[i].bill_number+')" class="edit-a"><i class="fa fa-pencil text-info"></i></a></td>'
            }
            if(data[i].order_status == '3'){
               html+='<td><a id="edit_store_'+data[i].sales_id+' " onclick="view_store_bill('+data[i].sales_id+')" class="edit-a"><i class="fa fa-eye"></i></a><a id="edit_store_'+data[i].sales_id+' " onclick="edit_store_bill('+data[i].sales_id+')" class="edit-a"><i class="fa fa-pencil"></i></a></td>'
            }else{
              html+='<td><a id="edit_store_'+data[i].sales_id+' " onclick="view_store_bill('+data[i].sales_id+')" class="edit-a"><i class="fa fa-eye"></i></a><a download href="?/SaleReport/sale_report/'+data[i].sales_id+'"><i class="fa fa-download"></i></a></td>'
            }
            
          html+='</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="8" class="text-center">No Order Found.</td>'+
        '</tr>';  
    }
    $('#get_purchase_order').html(html);   
  }
  }); 
}

function edit_store_bill(id){
  // alert("test")
  window.location.assign("?/edit-sales-bill/"+id);
  // window.loaction = ;
}


function view_credit_bill(id,bill_num){
   $.ajax({
    type  : 'ajax',
    url   : '?/StoreBilling/get_current_store_sales_order_data/'+id,
    async : false,
    dataType : 'json',
    success : function(data){
      if (data !='') { 
        $("#display-calc-data").modal('show');
        var balance = data.productData[0].balance;  
        $("#credited_bill").html(balance);
        $("#sales_id").val(id);
        $("#bill_number").val(bill_num);

      } 
    }
  });
}

$("#post-paid-amount").on('click',function(){
  $('#pay-amount-error').html('');
  var balance = $("#credited_bill").html();
  var id = $("#sales_id").val();
  var bill_num = $("#bill_number").val();
  var pay_amount = $("#pay_amount").val();
 
  balance = parseFloat(balance);
  pay_amount = parseFloat(pay_amount)

  if (balance == pay_amount) { 
    $('#pay-amount-error').html('');
    var formdata = new FormData();
      formdata.append('pay_amount',pay_amount);
      formdata.append('bill_number',bill_num);
       $.ajax({
          type  : 'POST',
          url   : '?/StoreBilling/update_credited_bill/'+id,
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success : function(data){
            if (data.status == '1') { 
            $("#credit_status_"+bill_num).html('<span class="text-success">Paid</span>')
            $("#display-calc-data").modal('hide');
                toastr.success('successfully paid amount');
            }else{
              toastr.error('failed paid. Please try again.');
            }
          }
        });

  }else{
    $('#pay-amount-error').html('<span class="text-danger text-small">amount didn\'t match.</span>');
  }

});

function view_store_bill(id){
  


  $.ajax({
    type  : 'ajax',
    url   : '?/StoreBilling/get_current_store_sales_order_data/'+id,
    async : false,
    dataType : 'json',
    success : function(data){ 
      console.log(JSON.stringify(data))
      if(data.productData[0].order_status == '1' || data.productData[0].order_status == '2' || data.productData[0].order_status == '3'){
        $('#cancle_button').html('<input id="cancle_bill_button" style="padding:5px;" value="Cancel Invoice" type="button" onclick="cancle_bill('+data.productData[0].sales_id+')" class="btn btn-danger button">')
      }else{
        $('#cancle_button').html('<input id="cancle_bill_button" style="padding:5px;" disabled value="Already Canceled" type="button" onclick="cancle_bill('+data.productData[0].sales_id+')" class="btn btn-danger button">')
      }
      
      $('#store_address').html(data.productData[0].customer_city+','+data.productData[0].customer_state+'-'+data.productData[0].customer_pincode);
      $('#bill_date').html(data.productData[0].created_date); 
      $('#bill_number').html(data.productData[0].bill_number); 
      $('#customer_name').html(data.productData[0].customer_name); 
      $('#customer_refral').html(data.customerDetail.refral_code);


      // console.log(JSON.stringify(data));
      var product_id = data.productData[0].product_id.split(","); 
      var product_name = data.productData[0].product.split(","); 
      var quntity = data.productData[0].quntity.split(","); 
      var unit_id = data.productData[0].unit_id.split(",");  
      var price = data.productData[0].price.split(","); 
      var mrp = data.productData[0].mrp_price.split(","); 
      var tax_persent = data.productData[0].tax_persent.split(",");
      var tax_price = data.productData[0].tax_price.split(",");  
      var amount = data.productData[0].amount.split(","); 
      

      var productDetails = []
      
      var tax_total_price = 0
     
        for (var i = 0; i < product_id.length; i++) { 
            var productDatas = {};  
            productDatas['product_name'] = product_name[i]
            productDatas['quntity'] = parseInt(quntity[i])
            productDatas['price'] = price[i]
            productDatas['mrp'] = mrp[i]
            productDatas['GST'] = tax_persent[i]+","+tax_price[i]
            productDatas['amount'] = amount[i]
            
            productDetails.push(productDatas)  
        } 

      // alert(product_id.length)

        var price_semi_total = getArraySum(price); 
 
        var amount_semi_total = getArraySum(amount);
        // alert(amount_semi_total)
        // console.log('Price : '+price)
        // console.log('Amount : '+amount)
        // console.log('quntity : '+quntity)
        // console.log('Detail : '+JSON.stringify(productDetails))

        var tax_price_semi_total = getArraySum(tax_price); 

        var tax_persent_semi_total = getArraySum(tax_persent);
        // for (var k = 0; k < tax_persent.length; k++) {
        //     tax_persent_semi_total += tax_persent[k] << 0;
        // }

        var total_quntity = getArraySum(quntity);
        // for (var k = 0; k < quntity.length; k++) {
        //     total_quntity += quntity[k] << 0;
        // }
 
      var html_header = '';
      var html_table_data = '';
      var html_total = '';

      html_header +='<tr>'
      // html_header +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:2px dashed #000;">#</td>'
      html_header +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:2px dashed #000;">PRODUCT</td>'
      html_header +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:2px dashed #000;">QTY</td>'
      // html_header +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:2px dashed #000;">Tax</td>'
      html_header +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:2px dashed #000;">MRP</td>'
      html_header +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:2px dashed #000;">RATE</td>'
      html_header +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:2px dashed #000;">AMT</td>'
      // html_header +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#000; padding:12px 7px 12px 7px; border-bottom:2px dashed #000;">Saving</td>'
      html_header +='</tr>'
      var j ;
      var price_total = 0;
      var saving_toal = 0;
      for (var i = 0; i < productDetails.length ; i++) {
        j=i+1;
        
        var saving =0;
        saving = productDetails[i].mrp - productDetails[i].price;
        saving = saving*productDetails[i].quntity
        saving_toal += saving;
        var gst = productDetails[i]['GST'].split(",");
        html_table_data +='<tr>'
         // html_table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000;">'+j+'</td>'
         html_table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;">'+productDetails[i].product_name+'</td>'
         html_table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;">'+productDetails[i].quntity+'</td>'
         // html_table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000;">'+gst[0]+'%</td>'
         html_table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;">'+productDetails[i].mrp+'</td>'
         html_table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;">'+parseFloat(productDetails[i].price).toFixed(2)+'</td>'
         html_table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;">'+parseFloat(productDetails[i].amount).toFixed(2)+'</td>'
         // html_table_data +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000;">'+saving.toFixed(2)+'</td>'
        html_table_data +='</tr>'
        
      } 

      html_total +='<tr>'
      // +parseFloat(price_semi_total).toFixed(2)+
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">Total</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">'+total_quntity+'</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">'+parseFloat(amount_semi_total).toFixed(2)+'(incl tax.)</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">'+saving_toal.toFixed(2)+'</td>'
      html_total +='</tr>'
      
      if(data.productData[0].point !='0') {
        
        html_total +='<tr>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">Discount point</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">- '+parseFloat(data.productData[0].point).toFixed(2)+'</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='</tr>'
      }else{}

      if(data.productData[0].order_discounted_percentage !='0') { 
         var total_disc = parseFloat(data.productData[0].amount).toFixed(2)-parseFloat(data.productData[0].order_discounted_price).toFixed(2);
        
        html_total +='<tr>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">Discount Price</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">- '+total_disc+'</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='</tr>'
      }else{
        // html_total +='<tr>'
        // // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">Discount Price</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">'+parseFloat(total_disc).toFixed(2)+'</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        // html_total +='</tr>'
      }
      // html_total +='<tr>'
      //   html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
      //   html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
      //   html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
      //   html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
      //   html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
      //   html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">Total Amount</td>'
      //   html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">'+parseFloat(data[0][0].total).toFixed(2)+'</td>'
      //   html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
      // html_total +='</tr>'
       
      html_total +='<tr>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">Total Amount</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">'+Math.round(parseFloat(data.productData[0].total).toFixed(2))+'</td>'
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:0px solid #000; font-weight:bold;">&nbsp;</td>'
      html_total +='</tr>'

      html_total +='<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>/*<td>&nbsp;</td>*/</tr>'
           
      html_total +='<tr>'
        
        
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">CGST Amt</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">SGST Amt</td>' 
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
      html_total +='</tr>'

      var sgst_cgst = tax_persent_semi_total/productDetails.length;

      sgst_cgst = sgst_cgst/2 
      sub_total = parseFloat(amount_semi_total) - parseFloat(tax_price_semi_total)
      // +parseFloat(sgst_cgst).toFixed(2)+
      html_total +='<tr>'
        
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">'+parseFloat(tax_price_semi_total/2) .toFixed(2)+'</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">'+parseFloat(tax_price_semi_total/2 ).toFixed(2)+'</td>' 
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
         
        
        
      html_total +='</tr>'

       html_total +='<tr>'
        
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">Saving Amount</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">'+saving_toal.toFixed(2)+'</td>' 
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'
        html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        // html_total +='<td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>' 
        if(data.productData[0].order_status == '1' || data.productData[0].order_status == '2' || data.productData[0].order_status == '3'){
        html_total +='<td id="canceled_invoice" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">&nbsp;</td>'    
        }else{
        html_total +='<td id="canceled_invoice" class ="text-danger" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000; padding:7px 7px 7px 12px; border-bottom:2px dashed #000; font-weight:bold;">Canceled Invoice</td>'    
        }
        
        
      html_total +='</tr>'
  
      html_header += html_table_data+=html_total

      $('#bill_data').html(html_header)

      $("#view_store_bill").modal('show');  

    }
  });
}

function close_model(){ 

  $("#view_store_bill").modal('hide');
  
}
function getArraySum(a){
    var total=0;
    for(var i in a) { 
        total += parseFloat(a[i]);
         
    }
    return total;
}
function cancle_bill(id){

  $.ajax({
    type  : 'ajax',
    url   : '?/StoreBilling/change_store_bill_order_status/'+id,
    async : false,
    dataType : 'json',
    success : function(data){ 
      if(data.status){
        $('#cancle_button').html('<input id="cancle_bill_button" style="padding:5px;" disabled value="All ready Canceled" type="button" class="btn btn-danger button">')  
        $('#status_'+id).addClass('text-danger')
        $('#status_'+id).html('Cancel')
        $('#canceled_invoice').html('canceled Invoice')
        $('#canceled_invoice').addClass('text-danger')
        toastr.success(data.message);
      }else{
        toastr.error(message+' Please try again.');

      }
      
    }
  })
}

