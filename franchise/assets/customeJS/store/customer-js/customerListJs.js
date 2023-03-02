get_customers();
function get_customers() {
	$.ajax({
    type  : 'ajax',
    url   : '?/Customer/viewCustomer/',
    async : false,
    dataType : 'json',
    success : function(data){
      // alert(JSON.stringify(data))
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) {
          var check ='';
          // alert(data[i].customer_status)
          if (data[i].customer_status =='1') {
            check ='checked';
          }else{
            check ='';
        	}

          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td id="storename_'+data[i].customer_id+'">'+data[i].name+'</td>'+
            '<td id="phonenumber_'+data[i].customer_id+'">'+data[i].mobile_number+'</td>'+
            '<td id="refral_code_'+data[i].customer_id+'">'+data[i].refral_code+'</td>'+
            '<td id="balance_point_'+data[i].customer_id+'">'+ parseFloat( data[i].balance).toFixed(2)+'</td>'+
            '<td id="city_'+data[i].customer_id+'">'+data[i].city+'</td>'+
            '<td><a href="#" id="edit_store_'+data[i].customer_id+' " onclick="edit_store('+data[i].customer_id+')" class="edit-a">Edit</a> <a href="#" id="view_store_'+data[i].customer_id+' " onclick="get_credit_history('+data[i].mobile_number+')" class="edit-a">View</a> <a href="#" id="view_store__'+data[i].customer_id+' " onclick="get_customer_history('+data[i].mobile_number+')" class="edit-a">History</a></td>'+
            
          '</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="7" class="text-center">No Customer found.</td>'+
        '</tr>';	
    }
    $('#get_customers').html(html);   
  }
  });
}


function get_credit_history(num) {

  $("#display-credit-history").modal('show');

  $.ajax({
    type  : 'ajax',
    url   : '?/StoreBilling/get_credit_history/'+num,
    async : false,
    dataType : 'json',
    success : function(data){ 
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) { 
          var name ='Unregistered';
          var mobile_num ='Unregistered';
          if (data[i].customer_mobile !='') {
            mobile_num = data[i].customer_mobile;
            name = data[i].customer_name;
          }
          
          html+='<tr>'
            html+='<td>'+j+'</td>'
            html+='<td id="customer_name'+data[i].credit_id+'">'+name+'</td>'
            html+='<td id="customer_mobile'+data[i].credit_id+'">'+mobile_num+'</td>'
            html+='<td id="bill_number'+data[i].credit_id+'">'+data[i].bill_number+'</td>'
            html+='<td id="total_'+data[i].credit_id+'"><i class="fa fa-rupee"></i>'+data[i].credit_balance+'</td>'
            html+='<td id="created_date_'+data[i].credit_id+'">'+data[i].created_date+'</td>'
            
            if(data[i].credit_status == '1'){
              html+='<td id="status_'+data[i].credit_status+'" class="text-success">Paid</td>'
            }else if(data[i].credit_status == '0'){
               html+='<td id="status_'+data[i].bill_number+'" class="text-danger">Unpaid <a id="credit_bill_store_'+data[i].bill_number+' " onclick="view_credit_bill(\''+data[i].bill_number+'\',\''+data[i].role+'\')" class="edit-a"><i class="fa fa-pencil text-info"></i></a></td>'
            } 
            
          html+='</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="7" class="text-center">No Result Found.</td>'+
        '</tr>';  
    }
    $('#get_credit_order').html(html);   
  }
  }); 
}


function edit_store(id){
  $('#edit_Customer').modal('show');
  $.ajax({
    type: "POST",
    url: base_url+"?/Customer/viewCustomer/"+id, 
    dataType: "json",
    success: function(data){
      // console.log(data.storeName);
        var edit_Customer_id = $('#edit_Customer_id').val(data.customer_id);
        var customername = $('#customername').val(data.name);
        var phonenumber = $('#phonenumber').val(data.mobile_number); 
        var address = $('#address').val(data.address);
        var city = $('#city').val(data.city);
        var state = $('#state').val(data.state);
        var pincode = $('#pincode').val(data.pincode);
         
    }
  });
}
function store_status(id,status){
	var store_status = '';
	if (status !='1') {
		store_status ='1';
	}else{
		store_status ='0';
	}
	$.ajax({
		type: "POST",
		url: base_url+"?/store/updateStoreStatus/"+id,
  	data: {store_status: store_status},
		dataType: "json",
		success: function(data){
			if (data.status == '1') {
        $('#change_store_status'+id).attr("onclick","store_status("+id+","+store_status+")");
        toastr.success('Store status has been updated successfully.');
			} else {
        $('#change_store_status'+id).attr("onclick","store_status("+id+","+status+")");
        if(status == '0'){
          $('#change_store_status'+id). prop("checked", false);
        }else{
          $('#change_store_status'+id). prop("checked", true);
        }
        toastr.error('Something went wrong updating the store status. Please try again.');
		  }
		},
    error: function(data){
       $('#change_store_status'+id).attr("onclick","store_status("+id+","+status+")");
        if(status == '0'){
          $('#change_store_status'+id). prop("checked", false);
        }else{
          $('#change_store_status'+id). prop("checked", true);
        }
      toastr.error('Something went wrong updating the store status. Please try again.');
    } 
	});
}



function updateCustomerDetails(){
  var edit_Customer_id = $('#edit_Customer_id').val();
  var customername = $('#customername').val();
  var phonenumber = $('#phonenumber').val(); 
  var address = $('#address').val();
  var city = $('#city').val();
  var state = $('#state').val();
  var pincode = $('#pincode').val();
 
  // alert(edit_Customer_id);
  if (edit_Customer_id != '' && customername !='' && phonenumber !=''  && address  !='' && city != '' && state  !='' && pincode  !='') {
    var formdata = new FormData();

  $('#cancelCustomerDetailsbtn').prop('disabled',true);
  $('#saveCustomerDetailsbtn').prop('disabled',true);
  $('#saveCustomerDetailsbtn').css('background','#b3b3b3');
  // $('#Store-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding store.</span>');
 
  formdata.append('customername',customername);
  formdata.append('phonenumber',phonenumber);
  formdata.append('address',address);
  formdata.append('city',city);
  formdata.append('state',state);
  formdata.append('pincode',pincode);   


    $.ajax({
      type: "POST",
        url: base_url+"?/Customer/updateCustomer/"+edit_Customer_id,
        data:formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
          if (data.status == '1') {
            $('#storename_'+edit_Customer_id).html(customername);
            $('#phonenumber_'+edit_Customer_id).html(phonenumber);
             
            // $('#address').val('');
            $('#city_'+edit_Customer_id).html(city);
            // $('#state').val('');
            // $('#pincode').val('');
            $('#edit_Customer').modal('hide');
          toastr.success('New Customer has been updated successfully.');

          }else{
          toastr.error('Something went wrong while updating Customer. Please try again.');

          }
          $('#edit-store-close-btn').prop('disabled',false);
          $('#saveCustomerDetailsbtn').prop('disabled',false);
          $('#saveCustomerDetailsbtn').css('background','#1D3327');
          // $('#Store-error').html('');
        }
    });

  }else{
    if (storename != '') {
        $('#storename-error-msg-div').html('');
      } else {
        $('#storename-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Customer name.</span>');
      }
     
    if (phonenumber != '') {
      if(phonenumber.length > 10) {
        $('#phonenumber-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
        $('#customer_number').val(phonenumber.slice(0,10));
      } else if (isNaN(phonenumber)) {
        $('#phonenumber-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
        $('#phonenumber').val(phonenumber.slice(0,-1));
      } else {
        $('#phonenumber-error-msg-div').html('');
      }

    } else {
      $('#phonenumber-error-msg-div').html('<span class="text-danger error-msg-small">Please enter a valid phone number</span>');
    }
     
    if (address != '') {
        $('#address-error-msg-div').html('');
    } else {
        $('#address-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the address.</span>');
    }

    if (city != '') {
        $('#city-error-msg-div').html('');
    } else {
        $('#city-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the city.</span>');
    }

    if (state != '') {
        $('#state-error-msg-div').html('');
    } else {
        $('#state-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the state.</span>');
    }

    if (pincode != '') {
        $('#pincode-error-msg-div').html('');
    } else {
        $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the pincode.</span>');
    }

  }
}


function view_credit_bill(bill_num,role){
   $.ajax({
    type  : 'ajax',
    url   : '?/StoreBilling/get_current_store_sales_order_bill/'+bill_num+'/'+role,
    async : false,
    dataType : 'json',
    success : function(data){
      if (data !='') { 
        // alert("test")
        $("#display-calc-data").modal('show');
        var balance = data.productData[0].balance;  
        $("#credited_bill").html(balance);
        $("#sales_id").val(bill_num);
        $("#bill_number").val(bill_num);
        $("#role").val(role);
         $("#pay_amount").val('');
      } 
    }
  });
}


function get_customer_history(number){
   $.ajax({
    type  : 'ajax',
    url   : '?/StoreBilling/daily_sale_report/'+number,
    async : false,
    dataType : 'json',
    success : function(data){

      $("#display-purchase-history").modal('show');
     
      let html='';
      if (data.length > 0) {

        var j = 1;
        for (var i = 0; i < data.length; i++) { 
          var product_id ='Unregistered';
          var product_name ='Unregistered';
          if (data[i].product_id !='') {
            product_name = data[i].product_name;
            product_id = data[i].product_id;
          }
          
          html+='<tr>'
            html+='<td>'+j+'</td>'
            // html+='<td id="customer_name'+data[i].product_id+'">'+product_id+'</td>'
            html+='<td id="customer_mobile'+data[i].product_id+'">'+product_name+'</td>'
            html+='<td id="bill_number'+data[i].product_id+'">'+data[i].barcode+'</td>'
            // html+='<td id="total_'+data[i].product_id+'"><i class="fa fa-rupee"></i>'+data[i].product_mrp+'</td>'
            // html+='<td id="created_date_'+data[i].product_id+'">'+data[i].retail_price+'</td>'
            // html+='<td id="created_date_'+data[i].product_id+'">'+data[i].wholesale_price+'</td>'
            // html+='<td id="created_date_'+data[i].product_id+'">'+data[i].purchase_price+'</td>'
            // html+='<td id="created_date_'+data[i].product_id+'">'+data[i].tax_rate+'</td>'
            html+='<td id="created_date_'+data[i].product_id+'">'+data[i].product_qty+'</td>'
            html+='<td id="created_date_'+data[i].product_id+'">'+data[i].product_price+'</td>'
            html+='<td id="created_date_'+data[i].product_id+'">'+data[i].product_amount+'</td>'
            html+='<td id="created_date_'+data[i].product_id+'">'+data[i].bill_number+'</td>'
            html+='<td id="created_date_'+data[i].product_id+'">'+data[i].bill_date+'</td>'
            // html+='<td id="created_date_'+data[i].product_id+'">'+data[i].customer_name+'</td>'
            
            
          html+='</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="8" class="text-center">No Result Found.</td>'+
        '</tr>';  
    }
    $('#get_purchase_order').html(html);   
    }
  });  
}

$("#post-paid-amount").on('click',function(){
  $('#pay-amount-error').html('');
  var balance = $("#credited_bill").html();
  var id = $("#sales_id").val();
  var bill_num = $("#bill_number").val();
  var pay_amount = $("#pay_amount").val();
  var role = $("#role").val();
 
  balance = parseFloat(balance);
  pay_amount = parseFloat(pay_amount)

  if (balance == pay_amount) { 
    $('#pay-amount-error').html('');
    var formdata = new FormData();
      formdata.append('pay_amount',pay_amount);
      formdata.append('bill_number',bill_num);
      formdata.append('role',role);
       $.ajax({
          type  : 'POST',
          url   : '?/StoreBilling/update_credited_bill/'+id,
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success : function(data){
            if (data.status == '1') { 
            $("#status_"+bill_num).html('<span class="text-success">Paid</span>')
            $("#display-calc-data").modal('hide');
            $('#contact_no').keyup();
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
