get_customers();
function get_customers() {
	$.ajax({
    type  : 'ajax',
    url   : '?/store/storeView/',
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
          if (data[i].storeStaus =='1') {
            check ='checked';
          }else{
            check ='';
        	}

          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td id="storename_'+data[i].storeId+'">'+data[i].storeName+'</td>'+
            '<td id="phonenumber_'+data[i].storeId+'">'+data[i].PhoneNumber+'</td>'+
            '<td id="gstinnumber_'+data[i].storeId+'">'+data[i].gstinNumber+'</td>'+
            '<td id="username_'+data[i].storeId+'">'+data[i].userName+'</td>'+
            '<td id="openingbalance_'+data[i].storeId+'">'+data[i].openingBalance+'</td>'+
            '<td id="city_'+data[i].storeId+'">'+data[i].city+'</td>'+
            '<td>'+
              '<div class="custom-control custom-switch d-inline">'+
                '<input type="checkbox" '+check+' onclick="store_status('+data[i].storeId +','+data[i].storeStaus+')" class="custom-control-input" id="change_store_status'+data[i].storeId +'">'+
                '<label class="custom-control-label" for="change_store_status'+data[i].storeId +'"></label>'+
              '</div>'+
            '</td>'+
            '<td><a href="#" id="edit_store_'+data[i].storeId+' " onclick="edit_store('+data[i].storeId+')" class="edit-a">Edit</a></td>'+
            
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
  $('#edit_store').modal('show');
  $.ajax({
    type: "POST",
    url: base_url+"?/store/storeView/"+id, 
    dataType: "json",
    success: function(data){
      // console.log(data.storeName);
        var edit_store_id = $('#edit_store_id').val(data.storeId);
        var storename = $('#storename').val(data.storeName);
        var phonenumber = $('#phonenumber').val(data.PhoneNumber);
        var username = $('#username').val(data.userName);  
        var gstinumber = $('#gstinumber').val(data.gstinNumber);
        var openingBalance =$('#openingBalance').val(data.openingBalance);
        var address = $('#address').val(data.address);
        var city = $('#city').val(data.city);
        var state = $('#state').val(data.state);
        var pincode = $('#pincode').val(data.pincode);
        var gst_type = '';
        if (data.gst_type == 'unregistered') {
                    gst_type += '<option value="">Select GST Type</option>';
                    gst_type += '<option  selected value="unregistered">Unregistrade</option>';
                    gst_type += '<option value="registered_business_regular">Registered Business - Regular</option>';
                    gst_type += '<option value="registered_business_composition">Registered Business - Composition</option>';
           }else if(data.gst_type == 'registered_business_regular'){
                    gst_type += '<option value="">Select GST Type</option>';
                    gst_type += '<option value="unregistered">Unregistrade</option>';
                    gst_type += '<option selected  value="registered_business_regular">Registered Business - Regular</option>';
                    gst_type += '<option value="registered_business_composition">Registered Business - Composition</option>';
           }else if(data.gst_type == 'registered_business_composition'){
                    gst_type += '<option value="">Select GST Type</option>';
                    gst_type += '<option value="unregistered">Unregistrade</option>';
                    gst_type += '<option value="registered_business_regular">Registered Business - Regular</option>';
                    gst_type += '<option selected  value="registered_business_composition">Registered Business - Composition</option>';
           }else {
                    gst_type += '<option value="">Select GST Type</option>';
                    gst_type += '<option value="unregistered">Unregistrade</option>';
                    gst_type += '<option value="registered_business_regular">Registered Business - Regular</option>';
                    gst_type += '<option value="registered_business_composition">Registered Business - Composition</option>';
           }
           $('#gst_type').html(gst_type);
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



function updateStoreDetails(){

  var edit_store_id = $('#edit_store_id').val();
  var storename = $('#storename').val();
  var phonenumber = $('#phonenumber').val();
  var username = $('#username').val(); 
  var gst_type = $('#gst_type'). children("option:selected").val();
  var gstinumber = $('#gstinumber').val();
  var openingBalance =$('#openingBalance').val();
  var address = $('#address').val();
  var city = $('#city').val();
  var state = $('#state').val();
  var pincode = $('#pincode').val();
  // alert(address);
  if (edit_store_id != '' && storename !='' && phonenumber !='' && username !='' && gstinumber !='' && 
    openingBalance !='' && gst_type !='' && address  !='' && state  !='' && pincode  !='') {
    var formdata = new FormData();
  $('#edit-store-close-btn').prop('disabled',true);
  $('#edit_store_btn').prop('disabled',true);
  $('#edit_store_btn').css('background','#b3b3b3');
  $('#Store-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding store.</span>');
 
  formdata.append('storename',storename);
  formdata.append('phonenumber',phonenumber);
  formdata.append('username',username); 
  formdata.append('gstinumber',gstinumber);
  formdata.append('openingBalance',openingBalance);
  formdata.append('gst_type',gst_type);
  formdata.append('address',address);
  formdata.append('city',city);
  formdata.append('state',state);
  formdata.append('pincode',pincode);   

    $.ajax({
      type: "POST",
        url: base_url+"?/store/updateStore/"+edit_store_id,
        data:formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
          if (data.status == '1') {
            $('#storename_'+edit_store_id).html(storename);
            $('#phonenumber_'+edit_store_id).html(phonenumber);
            $('#username_2'+edit_store_id).html(username); 
            $('#gstinnumber_'+edit_store_id).html(gstinumber);
            $('#openingbalance_'+edit_store_id).html(openingBalance);
            // $('#address').val('');
            $('#city_'+edit_store_id).html(city);
            // $('#state').val('');
            // $('#pincode').val('');
            $('#edit_store').modal('hide');
          toastr.success('New werehouse has been updated successfully.');

          }else{
          toastr.error('Something went wrong while updating werehouse. Please try again.');

          }
          $('#edit-store-close-btn').prop('disabled',false);
          $('#edit_store_btn').prop('disabled',false);
          $('#edit_store_btn').css('background','#1D3327');
          $('#Store-error').html('');
        }
    });

  }else{
    if (storename != '') {
        $('#storename-error-msg-div').html('');
      } else {
        $('#storename-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the werehouse name.</span>');
      }
    if (username != '') {
        $('#username-error-msg-div').html('');
      } else {
        $('#username-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the User Name.</span>');
      }
     
    if (gstinumber != '') {
        $('#gstinumber-error-msg-div').html('');
      } else {
        $('#gstinumber-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the GST Number.</span>');
      }
    if (openingBalance != '') {
        $('#openingBalance-error-msg-div').html('');
    } else {
        $('#openingBalance-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Opening Balence.</span>');
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