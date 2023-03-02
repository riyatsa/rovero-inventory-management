var stateList= ['Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana',
'Himachal Pradesh','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya',
'Mizoram','Nagaland','Odisha','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh',
'Uttarakhand','West Bengal']


var state = '';
state += '<option selected value="">Select State</option>';

for (var i = 0; i < stateList.length; i++) {
	state += '<option  value="'+stateList[i]+'">'+stateList[i]+'</option>';
}

$('#state').html(state);


$('#storename').on('keyup blur',function(){
	var storename = $('#storename').val(); 
	if (storename != '') {
		$('#storename-error-msg-div').html('');
	} else {
		$('#storename-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the store name.</span>');
	}
}); 

$('#phonenumber').on('keyup blur',function(){
	var phonenumber = $('#phonenumber').val();
	if (phonenumber != '') {
		$('#phonenumber-error-msg-div').html('');
	} else {
		$('#phonenumber-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Contact Number.</span>');
	}
});


$('#username').on('keyup blur',function(){
	var username = $('#username').val();
	if (username != '') {
		$('#username-error-msg-div').html('');
	} else {
		$('#username-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the User Name.</span>');
	}
});


$('#password').on('keyup blur',function(){
	var password = $('#password').val();
	if (password != '') {
		$('#password-error-msg-div').html('');
	} else {
		$('#password-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the password.</span>');
	}
});

$('#gstinumber').on('keyup blur',function(){
	var gst_type =  $('#gst_type'). children("option:selected"). val();
	var gstinumber = $('#gstinumber').val();
	if(gst_type == ''){
		$('#gstinumber-error-msg-div').html('<span class="text-danger error-msg-small">Please select first GST Type.</span>');
	}else{
		if (gstinumber != '') {
			$('#gstinumber-error-msg-div').html('');
		} else {
			$('#gstinumber-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the GST Number.</span>');
		}
	}
	 
});


$('#openingBalance').on('keyup blur',function(){
	var openingBalance = $('#openingBalance').val();
	if (openingBalance != '') {
		$('#openingBalance-error-msg-div').html('');
	} else {
		$('#openingBalance-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Opening Balence.</span>');
	}
});


$('#gst_type').on('change',function(){
	
	var gst_type =  $(this). children("option:selected"). val()
	  
	if(gst_type == 'unregistered'){
		$('#gstinumber').val('none')
		$("#gstinumber").prop("readonly",true);
		$('#gstinumber-error-msg-div').html('');
	}else{
		$('#gstinumber').val('')
		$('#gstinumber-error-msg-div').html('');
		$('#gstinumber').attr('placeholder',"Enter GST Number")
		$("#gstinumber").prop("readonly",false);
	}
});

$('#address').on('keyup blur',function(){
	var address = $('#address').val();
	if (address != '') {
		$('#address-error-msg-div').html('');
	} else {
		$('#address-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the address.</span>');
	}
});

$('#city').on('keyup blur',function(){
	var city = $('#city').val();
	if (city != '') {
		$('#city-error-msg-div').html('');
	} else {
		$('#city-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the city.</span>');
	}
});

$('#state').on('keyup blur',function(){
	var state = $('#state').val();
	if (state != '') {
		$('#state-error-msg-div').html('');
	} else {
		$('#state-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the state.</span>');
	}
});

$('#pincode').on('keyup blur',function(){
	var pincode = $('#pincode').val();
	if (pincode != '') {
		$('#pincode-error-msg-div').html('');
	} else {
		$('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the pincode.</span>');
	}
});

function saveStoreDetails(){

	var storename = $('#storename').val();
	var phonenumber = $('#phonenumber').val();
	var username = $('#username').val();
	var password = $('#password').val();
	var gst_type = $('#gst_type'). children("option:selected").val();
	var gstinumber = $('#gstinumber').val();
	var openingBalance =$('#openingBalance').val();
	var address = $('#address').val();
	var city = $('#city').val();
	var state = $('#state').val();
	var pincode = $('#pincode').val();
	// alert(address);
	if (storename !='' && phonenumber !='' && username !='' && password !='' && gstinumber !='' && 
		openingBalance !='' && gst_type !='' && address  !='' && state  !='' && pincode  !='') {
		var formdata = new FormData();
	$('#cancelStoreDetailsbtn').prop('disabled',true);
	$('#saveStoreDetailsbtn').prop('disabled',true);
	$('#saveStoreDetailsbtn').css('background','#b3b3b3');
	$('#Store-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding store.</span>');

	formdata.append('storename',storename);
	formdata.append('phonenumber',phonenumber);
	formdata.append('username',username);
	formdata.append('password',password);
	formdata.append('gstinumber',gstinumber);
	formdata.append('openingBalance',openingBalance);
	formdata.append('gst_type',gst_type);
	formdata.append('address',address);
	formdata.append('city',city);
	formdata.append('state',state);
	formdata.append('pincode',pincode);		

		$.ajax({
			type: "POST",
		  	url: base_url+"?/store/insertStore",
		  	data:formdata,
		  	dataType: 'json',
		    contentType: false,
		    processData: false,
		  	success: function(data) {
		  		if (data.status == '1') {
		  			$('#storename').val('');
					$('#phonenumber').val('');
					$('#username').val('');
					$('#password').val('');
					$('#gstinumber').val('');
					$('#openingBalance').val('');
					$('#address').val('');
					$('#city').val('');
					$('#state').val('');
					$('#pincode').val('');
					toastr.success('New Store has been added successfully.');
		  		}else{
		  		toastr.error('Something went wrong while adding werehouse. Please try again.');

		  		}
		  		$('#cancelStoreDetailsbtn').prop('disabled',false);
		  		$('#saveStoreDetailsbtn').prop('disabled',false);
		  		$('#saveStoreDetailsbtn').css('background','#1D3327');
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
		if (password != '') {
				$('#password-error-msg-div').html('');
			} else {
				$('#password-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the password.</span>');
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