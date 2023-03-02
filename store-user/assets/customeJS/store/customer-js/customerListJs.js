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
            '<td id="city_'+data[i].customer_id+'">'+data[i].city+'</td>'+
            '<td><a href="#" id="edit_store_'+data[i].customer_id+' " onclick="edit_store('+data[i].customer_id+')" class="edit-a">Edit</a></td>'+
            
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