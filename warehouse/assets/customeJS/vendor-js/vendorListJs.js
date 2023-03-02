get_customers();
function get_customers() {
	$.ajax({
    type  : 'ajax',
    url   : '?/vendor/VendorView/', 
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
          if (data[i].vendor_status =='1') {
            check ='checked';
          }else{
            check ='';
        	}

          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td id="vendor_name_'+data[i].vendor_Id+'">'+data[i].vendor_name+'</td>'+
            '<td id="phone_number_'+data[i].vendor_Id+'">'+data[i].phone_number+'</td>'+
            '<td id="gstin_number_'+data[i].vendor_Id+'">'+data[i].gstin_number+'</td>'+
            '<td id="email_'+data[i].vendor_Id+'">'+data[i].email+'</td>'+
            '<td id="opening_balance_'+data[i].vendor_Id+'">'+data[i].opening_balance+'</td>'+
            '<td id="city_'+data[i].vendor_Id+'">'+data[i].city+'</td>'+
            '<td>'+
              '<div class="custom-control custom-switch d-inline">'+
                '<input type="checkbox" '+check+' onclick="vendor_status('+data[i].vendor_Id +','+data[i].vendor_status+')" class="custom-control-input" id="change_vendor_status'+data[i].vendor_Id +'">'+
                '<label class="custom-control-label" for="change_vendor_status'+data[i].vendor_Id +'"></label>'+
              '</div>'+
            '</td>'+
            '<td><a href="#" id="edit_store_'+data[i].vendor_Id+' " onclick="edit_store('+data[i].vendor_Id+')" class="edit-a">Edit</a></td>'+
            
          '</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="9" class="text-center">No Vendor found.</td>'+
        '</tr>';	
    }
    $('#get_customers').html(html);   
  }
  });
}

function edit_store(id){
  $('#edit_vendor').modal('show');
  $.ajax({
    type: "POST",
    url: base_url+"?/vendor/VendorView/"+id, 
    dataType: "json",
    success: function(data){
      // console.log(data.storeName);
        var edit_vendor_id = $('#edit_vendor_id').val(data.vendor_Id);
        var storename = $('#vendorname').val(data.vendor_name);
        var phonenumber = $('#phonenumber').val(data.phone_number);
        var username = $('#email').val(data.email);  
        var gstinumber = $('#gstinumber').val(data.gstin_number);
        var openingBalance =$('#openingBalance').val(data.opening_balance);
        var address = $('#address').val(data.address);
        var city = $('#city').val(data.city);
        var stateList= ['Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana',
        'Himachal Pradesh','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya',
        'Mizoram','Nagaland','Odisha','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh',
        'Uttarakhand','West Bengal']

        var state = '';
        state += '<option value="">Select State</option>';

        for (var i = 0; i < stateList.length; i++) {
          if(data.state != stateList[i]){
            state += '<option  value="'+stateList[i]+'">'+stateList[i]+'</option>';
          }else{
            state += '<option selected value="'+stateList[i]+'">'+stateList[i]+'</option>';
          }
          
        }

        $('#state').html(state);
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
function vendor_status(id,status){
	var vendor_status = '';
	if (status !='1') {
		vendor_status ='1';
	}else{
		vendor_status ='0';
	}
	$.ajax({
		type: "POST",
		url: base_url+"?/vendor/updateVendorStatus/"+id,
  	data: {vendor_status: vendor_status},
		dataType: "json",
		success: function(data){
			if (data.status == '1') {
        $('#change_vendor_status'+id).attr("onclick","vendor_status("+id+","+vendor_status+")");
        toastr.success('Vendor status has been updated successfully.');
			} else {
        $('#change_vendor_status'+id).attr("onclick","vendor_status("+id+","+status+")");
        if(status == '0'){
          $('#change_vendor_status'+id). prop("checked", false);
        }else{
          $('#change_vendor_status'+id). prop("checked", true);
        }
        toastr.error('Something went wrong updating the vendor status. Please try again.');
		  }
		},
    error: function(data){
       $('#change_vendor_status'+id).attr("onclick","vendor_status("+id+","+status+")");
        if(status == '0'){
          $('#change_vendor_status'+id). prop("checked", false);
        }else{
          $('#change_vendor_status'+id). prop("checked", true);
        }
      toastr.error('Something went wrong updating the vendor status. Please try again.');
    } 
	});
}



function updatevendorDetails(){

  var edit_vendor_id = $('#edit_vendor_id').val();
  var vendorname = $('#vendorname').val();
  var phonenumber = $('#phonenumber').val();
  var email = $('#email').val(); 
  var gst_type = $('#gst_type'). children("option:selected").val();
  var gstinumber = $('#gstinumber').val();
  var openingBalance =$('#openingBalance').val();
  var address = $('#address').val();
  var city = $('#city').val();
  var state = $('#state').val();
  var pincode = $('#pincode').val();
  // alert(address);
  if (edit_vendor_id != '' && vendorname !='' && phonenumber !='' && email !='' && gstinumber !='' && 
    openingBalance !='' && gst_type !='' && address  !='' && state  !='' && pincode  !='') {
    var formdata = new FormData();
  $('#edit-vendor-close-btn').prop('disabled',true);
  $('#edit_vendor_btn').prop('disabled',true);
  $('#edit_vendor_btn').css('background','#b3b3b3');
  // $('#Store-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding store.</span>');
 
  formdata.append('vendor_name',vendorname);
  formdata.append('phone_number',phonenumber);
  formdata.append('email',email); 
  formdata.append('gstin_number',gstinumber);
  formdata.append('opening_balance',openingBalance);
  formdata.append('gst_type',gst_type);
  formdata.append('address',address);
  formdata.append('city',city);
  formdata.append('state',state);
  formdata.append('pincode',pincode);   

    $.ajax({
      type: "POST",
        url: base_url+"?/vendor/updateVendor/"+edit_vendor_id,
        data:formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
          if (data.status == '1') {
            $('#vendor_name_'+edit_vendor_id).html(vendorname);
            $('#phone_number_'+edit_vendor_id).html(phonenumber);
            $('#email_'+edit_vendor_id).html(email); 
            $('#gstin_number_'+edit_vendor_id).html(gstinumber);
            $('#openingbalance_'+edit_vendor_id).html(openingBalance);
            // $('#address').val('');
            $('#city_'+edit_vendor_id).html(city);
            // $('#state').val('');
            // $('#pincode').val('');
            $('#edit_vendor').modal('hide');
          toastr.success('New werehouse has been updated successfully.');

          }else{
          toastr.error('Something went wrong while updating werehouse. Please try again.');

          }
          $('#edit-vendor-close-btn').prop('disabled',false);
          $('#edit_vendor_btn').prop('disabled',false);
          $('#edit_vendor_btn').css('background','#1D3327');
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