

$('#customername').on('keyup blur',function(){
	var customername = $('#customername').val(); 
	if (customername != '') {
		$('#customername-error-msg-div').html('');
	} else {
		$('#customername-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Customer name.</span>');
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

function refralCode(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();
	// var year = d.getFullYear();
    result = "Ro"+result+month+""+day
    return result;
}

function saveCustomerDetails(){

	var customername = $('#customername').val();
	var phonenumber = $('#phonenumber').val();
	var address = $('#address').val();
	var city = $('#city').val();
	var state = $('#state').val();
	var pincode = $('#pincode').val();
	// alert(address);
	if (customername !='' && phonenumber !='' && address  !='' && state  !='' && pincode  !='') {
		
		var formdata = new FormData();
		$('#cancelStoreDetailsbtn').prop('disabled',true);
		$('#saveStoreDetailsbtn').prop('disabled',true);
		$('#saveStoreDetailsbtn').css('background','#b3b3b3');
		$('#Customer-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding Customer.</span>');

		formdata.append('customername',customername);
		formdata.append('phonenumber',phonenumber);
		formdata.append('refral_code',refralCode(4));
		formdata.append('address',address);
		formdata.append('city',city);
		formdata.append('state',state);
		formdata.append('pincode',pincode);		

		$.ajax({
			type: "POST",
		  	url: base_url+"?/Customer/insertCustomer",
		  	data:formdata,
		  	dataType: 'json',
		    contentType: false,
		    processData: false,
		  	success: function(data) {
		  		if (data.status == '1') {
		  			$('#customername').val('');
					$('#phonenumber').val('');
					
					$('#address').val('');
					$('#city').val('');
					$('#state').val('');
					$('#pincode').val('');
					toastr.success('New Customer has been added successfully.');
		  		}else{
		  		toastr.error('Something went wrong while adding Customer. Please try again.');

		  		}
		  		$('#cancelStoreDetailsbtn').prop('disabled',false);
		  		$('#saveStoreDetailsbtn').prop('disabled',false);
		  		$('#saveStoreDetailsbtn').css('background','#1D3327');
		  		$('#Customer-error').html('');
		  	}
		});

	}else{
		if (customername != '') {
				$('#customername-error-msg-div').html('');
			} else {
				$('#customername-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the werehouse name.</span>');
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