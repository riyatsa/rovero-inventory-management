
/*  file name : couponJs.js
*	created date: 14-05-2020
*/
var fadeout_time = 5000;
var alphabets_only = /^[A-Za-z ]+$/;
var alphanumeric_only = /^[a-zA-Z0-9]+$/;
var discount_percentage_max_value = 100;
var discount_amount_max_value = 99999;
var discount_amount_max_value_length = 5;
var min_purchase_amount_max_value_length = 5;
var min_purchase_amount_max_value = 99999;
show_product(); //call function show all product
  var reg = /^[0-9]+$/;
     
function show_product(date_from='0',date_to='0',discount_from='0',discount_to='0'){
    $.ajax({
		type  : 'ajax',
		url   : '?/coupon/getCoupens/'+date_from+'/'+date_to+'/'+discount_from+'/'+discount_to,
		async : false,
		dataType : 'json',
		success : function(data){
            let html='';
            if (data.length > 0) {
            	var j = 1;
              	for (var i = 0; i < data.length; i++) {
                	var check ='';
                	if (data[i].coupon_status =='1') {
                		check ='checked';
                	}else{
                		check ='';
                	}
                	var html_discount_type = '';
                	var html_discount_type_per_amt_show = '';
                	if (data[i].coupon_category_name == '0') {
                		html_discount_type = 'Percentage';
                		html_discount_type_per_amt_show = ' <i class="fa fa-percent"></i>';
                	} else {
                		html_discount_type = 'Amount';
                		html_discount_type_per_amt_show = ' <i class="fa fa-inr"></i>';
                	}
                	html+='<tr>'+
                	  '<td>'+j+'</td>'+
                      '<td>'+data[i].coupon_name+'</td>'+
                      '<td>'+data[i].coupon_code+'</td>'+
                      '<td>'+html_discount_type+'</td>'+
                      '<td>'+data[i].coupon_discount+html_discount_type_per_amt_show+'</td>'+
                      '<td>'+data[i].coupon_expiry_date+'</td>'+
                      '<td>'+
                        '<div class="custom-control custom-switch d-inline">'+
                          '<input type="checkbox" '+check+' onclick="coupen_status('+data[i].coupon_id+','+data[i].coupon_status+')" class="custom-control-input" id="change_status_coupon_'+data[i].coupon_id+'">'+
                          '<label class="custom-control-label" for="change_status_coupon_'+data[i].coupon_id+'"></label>'+
                        '</div>'+
                        '<a href="#" id="edit_coupen_'+data[i].coupon_id+'" onclick="edit_coupen('+data[i].coupon_id+')" data-coupon_code='+data[i].coupon_code+' data-coupon_name='+data[i].coupon_name+' data-coupon_discount='+data[i].coupon_discount+' data-coupon_expiry_date='+data[i].coupon_expiry_date+' data-coupon_category_name='+data[i].coupon_category_name+' data-coupon_minimum_purchase_amount='+data[i].coupon_minimum_purchase_amount+' class="edit-a">Edit</a>'+
                      '</td>'+
                    '</tr>';
                    j++;
                }
            }else{
             	html+='<tr>'+
                      '<td colspan="7" class="text-center">No Coupon Found.</td>'+
                    '</tr>';	
            }
            $('#coupen_data').html(html); 
        }
    });
}

$('#coupon_category_type').change(function(){
	var coupon_category_type = $('#coupon_category_type').val();
	$('#discount_percentage_amount').val('');
	$('#coupon_discount_error').html('');
	if (coupon_category_type != '') {
		if (coupon_category_type == 0 || coupon_category_type == 1) {
			$('#discount_percentage_amount').prop('disabled',false);
			$('#coupon_category_error_div').html('');
			if (coupon_category_type == 0) {
				$('#discount_percentage_amount').attr("placeholder", "Discount in %");
			} else if (coupon_category_type == 1) {
				$('#discount_percentage_amount').attr("placeholder", "Discount in amount");
			}
		} else {
			$('#coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
			$('#discount_percentage_amount').attr("placeholder", "");	
		}
	} else {
		$('#coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
		$('#discount_percentage_amount').attr("placeholder", "");
		$('#discount_percentage_amount').prop('disabled',true);
	}
});

$("#coupon_name").keyup(function(){
	var coupon_name = $('#coupon_name').val();
	if (coupon_name != '') {
		if (!alphabets_only.test(coupon_name)) {
			$('#coupon_name_error').html('<span class="text-danger error-msg-small">Coupon name should have only alphabets</span>');
			$('#coupon_name').focus();
			$('#coupon_name').val(coupon_name.slice(0,-1));
		} else {
			$('#coupon_name_error').html('');
		}
	} else {
		$('#coupon_name_error').html('<span class="text-danger error-msg-small">Please enter the coupon name.</span>');
	}
});

$("#coupon_name").focusout(function() {
   var coupon_name = $('#coupon_name').val();
	if (coupon_name != '') {
		if (!alphabets_only.test(coupon_name)) {
			$('#coupon_name_error').html('<span class="text-danger error-msg-small">Coupon name should have only alphabets</span>');
			$('#coupon_name').focus();
			$('#coupon_name').val(coupon_name.slice(0,-1));
		} else {
			$('#coupon_name_error').html('');
		}
	} else {
		$('#coupon_name_error').html('<span class="text-danger error-msg-small">Please enter the coupon name.</span>');
	}
});

$('#coupon_code').keyup(function(){
	var coupon_code = $('#coupon_code').val();
	if (coupon_code != '') {
		if (!alphanumeric_only.test(coupon_code)) {
			$('#coupon_code_error').html('<span class="text-danger error-msg-small">Coupon code can be only alphanumeric</span>');
			$('#coupon_code').focus();
			$('#coupon_code').val(coupon_code.slice(0,-1));
		} else {
			$('#coupon_code_error').html('');
		}
	} else {
		$('#coupon_code_error').html('<span class="text-danger error-msg-small">Please enter the coupon code</span>');
	}
});

$("#coupon_code").focusout(function() {
   var coupon_code = $('#coupon_code').val();
	if (coupon_code != '') {
		if (!alphanumeric_only.test(coupon_code)) {
			$('#coupon_code_error').html('<span class="text-danger error-msg-small">Coupon code can be only alphanumeric</span>');
			$('#coupon_code').focus();
			$('#coupon_code').val(coupon_code.slice(0,-1));
		} else {
			$('#coupon_code_error').html('');
		}
	} else {
		$('#coupon_code_error').html('<span class="text-danger error-msg-small">Please enter the coupon code</span>');
	}
});

$('#discount_percentage_amount').keyup(function(){
	var coupon_category_type = $('#coupon_category_type').val();
	var discount_percentage_amount = $('#discount_percentage_amount').val();

	if (coupon_category_type != '') {
		if (discount_percentage_amount != '') {
			if (!isNaN(discount_percentage_amount)) {
				if (coupon_category_type == 0 || coupon_category_type == 1) {
					$('#coupon_category_error_div').html('');
					if (coupon_category_type == 0) {
						if (discount_percentage_amount > discount_percentage_max_value) {
							$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be more than '+discount_percentage_max_value+'</span>');
							$('#discount_percentage_amount').focus();
							$('#discount_percentage_amount').val(discount_percentage_max_value);
						} else if (discount_percentage_amount < 0) {
							$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be less than 0</span>');
							$('#discount_percentage_amount').focus();
							$('#discount_percentage_amount').val('0');
						} else {
							$('#coupon_discount_error').html('');
						}
					} else if (coupon_category_type == 1) {
						if (discount_percentage_amount > discount_amount_max_value) {
							$('#discount_percentage_amount').val(discount_percentage_amount.slice(0,discount_amount_max_value_length));
							$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be more than '+discount_amount_max_value+'</span>');
						} else if (discount_percentage_amount < 0) {
							$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be less than 0</span>');
							$('#discount_percentage_amount').val('0');
						} else {
							$('#coupon_discount_error').html('');
						}
						$('#discount_percentage_amount').attr("placeholder", "Discount in amount");
					}
				} else {
					$('#coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
					$('#discount_percentage_amount').attr("placeholder", "");	
				}
			} else {
				$('#discount_percentage_amount').focus();
				$('#discount_percentage_amount').val(discount_percentage_amount.slice(0,-1));
				$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount can only be number</span>');
			}
		} else {
			$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Please enter the discount</span>');
		}
	} else {
		$('#coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
	}
});

$('#discount_percentage_amount').focusout(function(){
	var coupon_category_type = $('#coupon_category_type').val();
	var discount_percentage_amount = $('#discount_percentage_amount').val();

	if (coupon_category_type != '') {
		if (discount_percentage_amount != '') {
			if (!isNaN(discount_percentage_amount)) {
				if (coupon_category_type == 0 || coupon_category_type == 1) {
					$('#coupon_category_error_div').html('');
					if (coupon_category_type == 0) {
						if (discount_percentage_amount > discount_percentage_max_value) {
							$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be more than '+discount_percentage_max_value+'</span>');
							$('#discount_percentage_amount').focus();
							$('#discount_percentage_amount').val(discount_percentage_max_value);
						} else if (discount_percentage_amount < 0) {
							$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be less than 0</span>');
							$('#discount_percentage_amount').focus();
							$('#discount_percentage_amount').val('0');
						} else {
							$('#coupon_discount_error').html('');
						}
					} else if (coupon_category_type == 1) {
						if (discount_percentage_amount > discount_amount_max_value) {
							$('#discount_percentage_amount').val(discount_percentage_amount.slice(0,discount_amount_max_value_length));
							$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be more than '+discount_amount_max_value+'</span>');
						} else if (discount_percentage_amount < 0) {
							$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be less than 0</span>');
							$('#discount_percentage_amount').val('0');
						} else {
							$('#coupon_discount_error').html('');
						}
						$('#discount_percentage_amount').attr("placeholder", "Discount in amount");
					}
				} else {
					$('#coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
					$('#discount_percentage_amount').attr("placeholder", "");	
				}
			} else {
				$('#discount_percentage_amount').focus();
				$('#discount_percentage_amount').val(discount_percentage_amount.slice(0,-1));
				$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount can only be number</span>');
			}
		} else {
			$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Please enter the discount</span>');
		}
	} else {
		$('#coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
	}
});

$('#coupon_min_purchase_price').keyup(function(){
	var coupon_min_purchase_price = $('#coupon_min_purchase_price').val();
	if (!isNaN(coupon_min_purchase_price)) {
		if (coupon_min_purchase_price.length > min_purchase_amount_max_value_length) {
			$('#coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount cannot be more than '+min_purchase_amount_max_value+'</span>');
			$('#coupon_min_purchase_price').val(coupon_min_purchase_price.slice(0,min_purchase_amount_max_value_length));
		} else if (coupon_min_purchase_price < 0) {
			$('#coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount cannot be less than 0</span>');
			$('#coupon_min_purchase_price').val('0');
		} else {
			$('#coupon_min_pruchase_price_error_div').html('');
		}
	} else {
		$('#coupon_min_purchase_price').val(coupon_min_purchase_price.slice(0,-1));
		$('#coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount can only be numbers</span>');
	}
});

$('#expiry_date').change(function(){
	var expiry_date = $('#expiry_date').val();
	if (expiry_date != '') {
		$('#coupon_expiry_date_error').html('');
	} else {
		$('#coupon_expiry_date_error').html('<span class="text-danger error-msg-small">Please enter the coupon expiry date</span>');
	}
});

function addcoupen() {
	var coupon_name = $('#coupon_name').val();
	var coupon_code = $('#coupon_code').val();
	var discount_percentage_amount = $('#discount_percentage_amount').val();
	var expiry_date = $('#expiry_date').val();
	var coupon_category_type = $('#coupon_category_type').val();
	var coupon_min_purchase_price = $('#coupon_min_purchase_price').val();

	if ((coupon_category_type == 0 || coupon_category_type == 1) && coupon_name !='' && coupon_code !='' && discount_percentage_amount !='' && expiry_date !='' 
		&& alphabets_only.test(coupon_name) && alphanumeric_only.test(coupon_code) && !isNaN(discount_percentage_amount)) {
		$('#add_coupon').prop('disabled',true);
		$('#add_coupon').css('background','#b3b3b3');
		$('#coupen-error').html('<span class="d-block text-center text-warning error-msg">Please wait while we are adding the coupon.</span>');
		$.ajax({
			type: "POST",
		  	url: base_url+"?/coupon/addCoupon",
		  	data: {coupon_category_type:coupon_category_type,couponName: coupon_name, couponCode: coupon_code,couponDiscount:discount_percentage_amount,coupon_min_purchase_price:coupon_min_purchase_price,couponExpiryDate:expiry_date},
		  	 dataType: "json",
		  	success: function(data){
			  	if (data.status == 'success') {
			  		$('#coupon_name').val('');
					$('#coupon_code').val('');
					$('#discount_percentage_amount').val('');
					$('#discount_percentage_amount').prop('disabled',true);
					$('#discount_percentage_amount').attr("placeholder", "");
					$('#coupon_min_purchase_price').val('');
					$('#expiry_date').val('');
			  		toastr.success('New coupon has been added successfully.');
					show_product();
			  	} else {
			  		toastr.error('Something went wrong while adding the coupon. Please try again');
		  		}
		  		$('#add_coupon').prop('disabled',false);
				$('#add_coupon').css('background','#1D3327');
				$('#coupen-error').html('');
		  	}
		});
	}else{
		if (coupon_name != '') {
			if (!alphabets_only.test(coupon_name)) {
				$('#coupon_name_error').html('<span class="text-danger error-msg-small">Coupon name should have only alphabets</span>');
			} else {
				$('#coupon_name_error').html('');
			}
		} else {
			$('#coupon_name_error').html('<span class="text-danger error-msg-small">Please enter the coupon name.</span>');
		}

		if (coupon_code != '') {
			if (!alphanumeric_only.test(coupon_code)) {
				$('#coupon_code_error').html('<span class="text-danger error-msg-small">Coupon code can be only alphanumeric</span>');
			} else {
				$('#coupon_code_error').html('');
			}
		} else {
			$('#coupon_code_error').html('<span class="text-danger error-msg-small">Please enter the coupon code</span>');
		}

		if (discount_percentage_amount == '') {
			$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Please enter the discount</span>');
		} else {
			$('#coupon_discount_error').html('');
		}

		if (coupon_category_type != '') {
			if (discount_percentage_amount != '') {
				if (!isNaN(discount_percentage_amount)) {
					if (coupon_category_type == 0 || coupon_category_type == 1) {
						$('#coupon_category_error_div').html('');
						if (coupon_category_type == 0) {
							if (discount_percentage_amount > discount_percentage_max_value) {
								$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be more than '+discount_percentage_max_value+'</span>');
								$('#discount_percentage_amount').focus();
								$('#discount_percentage_amount').val(discount_percentage_max_value);
							} else if (discount_percentage_amount < 0) {
								$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be less than 0</span>');
								$('#discount_percentage_amount').focus();
								$('#discount_percentage_amount').val('0');
							} else {
								$('#coupon_discount_error').html('');
							}
						} else if (coupon_category_type == 1) {
							if (discount_percentage_amount > discount_amount_max_value) {
								$('#discount_percentage_amount').val(discount_percentage_amount.slice(0,discount_amount_max_value_length));
								$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be more than '+discount_amount_max_value+'</span>');
							} else if (discount_percentage_amount < 0) {
								$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be less than 0</span>');
								$('#discount_percentage_amount').val('0');
							} else {
								$('#coupon_discount_error').html('');
							}
							$('#discount_percentage_amount').attr("placeholder", "Discount in amount");
						}
					} else {
						$('#coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
						$('#discount_percentage_amount').attr("placeholder", "");	
					}
				} else {
					$('#discount_percentage_amount').focus();
					$('#discount_percentage_amount').val(discount_percentage_amount.slice(0,-1));
					$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Discount can only be number</span>');
				}
			} else {
				$('#coupon_discount_error').html('<span class="text-danger error-msg-small">Please enter the discount</span>');
			}
		} else {
			$('#coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
		}

		if (!isNaN(coupon_min_purchase_price)) {
			if (coupon_min_purchase_price.length > min_purchase_amount_max_value_length) {
				$('#coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount cannot be more than '+min_purchase_amount_max_value+'</span>');
				$('#coupon_min_purchase_price').val(coupon_min_purchase_price.slice(0,min_purchase_amount_max_value_length));
			} else if (coupon_min_purchase_price < 0) {
				$('#coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount cannot be less than 0</span>');
				$('#coupon_min_purchase_price').val('0');
			} else {
				$('#coupon_min_pruchase_price_error_div').html('');
			}
		} else {
			$('#coupon_min_purchase_price').val(coupon_min_purchase_price.slice(0,-1));
			$('#coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount can only be numbers</span>');
		}

		if (expiry_date != '') {
			$('#coupon_expiry_date_error').html('');
		} else {
			$('#coupon_expiry_date_error').html('<span class="text-danger error-msg-small">Please enter the coupon expiry date</span>');
		}

		let html = "<span class='d-block text-center text-danger error-msg'>Please fill all the necessary details.</span>";
		$('#coupen-error').html(html);
	}
}

function edit_coupen(id){
	$.ajax({
		type: "POST",
	  	url: base_url+"?/coupon/get_edit_coupon_details",
	  	data: {id:id},
		dataType: "json",
	  	success: function(data){
	  		var edit_coupon_category_type_dropdown_values = '';
	  		if (data.coupon_category_name == 0) {
	  			edit_coupon_category_type_dropdown_values += '<option value="">Select Coupon Type</option>'+
                		'<option value="0" selected>Discount in percentage</option>'+
                		'<option value="1">Discount in amount</option>';
	  		} else if (data.coupon_category_name == 1) {
	  			edit_coupon_category_type_dropdown_values += '<option value="">Select Coupon Type</option>'+
                		'<option value="0">Discount in percentage</option>'+
                		'<option value="1" selected>Discount in amount</option>';
	  		} else {
	  			edit_coupon_category_type_dropdown_values += '<option value="">Select Coupon Type</option>'+
                		'<option value="0">Discount in percentage</option>'+
                		'<option value="1">Discount in amount</option>';
	  		}

		  	$('#edit_coupen_error').html('');
		  	$('#coupen-status').removeAttr('style');

		  	$('#edit_coupon_category_type').html(edit_coupon_category_type_dropdown_values);
		  	$('#edit_coupen_id').val(id);
			$('#edit_coupon_name').val(data.coupon_name);
			$('#edit_coupon_code').val(data.coupon_code);
			$('#edit_discount_percentage_amount').val(data.coupon_discount);
			$('#edit_coupon_min_purchase_price').val(data.coupon_minimum_purchase_amount);
			$('#edit_expiry_date').val(data.coupon_expiry_date);

			$('#edit_coupon').modal('show');
		}
	});
}

$('#edit_coupon_category_type').change(function(){
	var edit_coupon_category_type = $('#edit_coupon_category_type').val();
	$('#edit_discount_percentage_amount').val('');
	$('#edit_coupon_discount_error').html('');
	if (edit_coupon_category_type != '') {
		if (edit_coupon_category_type == 0 || edit_coupon_category_type == 1) {
			$('#edit_discount_percentage_amount').prop('disabled',false);
			$('#edit_coupon_category_error_div').html('');
			if (edit_coupon_category_type == 0) {
				$('#edit_discount_percentage_amount').attr("placeholder", "Discount in %");
			} else if (edit_coupon_category_type == 1) {
				$('#edit_discount_percentage_amount').attr("placeholder", "Discount in amount");
			}
		} else {
			$('#edit_coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
			$('#edit_discount_percentage_amount').attr("placeholder", "");	
		}
	} else {
		$('#edit_coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
		$('#edit_discount_percentage_amount').attr("placeholder", "");
		$('#edit_discount_percentage_amount').prop('disabled',true);
	}
});

$("#edit_coupon_name").keyup(function(){
	var coupon_name = $('#edit_coupon_name').val();
	if (coupon_name != '') {
		if (!alphabets_only.test(coupon_name)) {
			$('#edit_coupon_name_error').html('<span class="text-danger error-msg-small">Coupon name should have only alphabets</span>');
			$('#edit_coupon_name').focus();
			$('#edit_coupon_name').val(coupon_name.slice(0,-1));
		} else {
			$('#edit_coupon_name_error').html('');
		}
	} else {
		$('#edit_coupon_name_error').html('<span class="text-danger error-msg-small">Please enter the coupon name.</span>');
	}
});

$("#edit_coupon_name").focusout(function() {
  	var coupon_name = $('#edit_coupon_name').val();
	if (coupon_name != '') {
		if (!alphabets_only.test(coupon_name)) {
			$('#edit_coupon_name_error').html('<span class="text-danger error-msg-small">Coupon name should have only alphabets</span>');
			$('#edit_coupon_name').focus();
			$('#edit_coupon_name').val(coupon_name.slice(0,-1));
		} else {
			$('#edit_coupon_name_error').html('');
		}
	} else {
		$('#edit_coupon_name_error').html('<span class="text-danger error-msg-small">Please enter the coupon name.</span>');
	}
});

$('#edit_coupon_code').keyup(function(){
	var coupon_code = $('#edit_coupon_code').val();
	if (coupon_code != '') {
		if (!alphanumeric_only.test(coupon_code)) {
			$('#edit_coupon_code_error').html('<span class="text-danger error-msg-small">Coupon code can be only alphanumeric</span>');
			$('#edit_coupon_code').focus();
			$('#edit_coupon_code').val(coupon_code.slice(0,-1));
		} else {
			$('#edit_coupon_code_error').html('');
		}
	} else {
		$('#edit_coupon_code_error').html('<span class="text-danger error-msg-small">Please enter the coupon code</span>');
	}
});

$("#edit_coupon_code").focusout(function() {
  	var coupon_code = $('#edit_coupon_code').val();
	if (coupon_code != '') {
		if (!alphanumeric_only.test(coupon_code)) {
			$('#edit_coupon_code_error').html('<span class="text-danger error-msg-small">Coupon code can be only alphanumeric</span>');
			$('#edit_coupon_code').focus();
			$('#edit_coupon_code').val(coupon_code.slice(0,-1));
		} else {
			$('#edit_coupon_code_error').html('');
		}
	} else {
		$('#edit_coupon_code_error').html('<span class="text-danger error-msg-small">Please enter the coupon code</span>');
	}
});

     
 

$('#edit_discount_percentage_amount').keyup(function(){
	var coupon_category_type = $('#edit_coupon_category_type').val();
	var discount_percentage_amount = $('#edit_discount_percentage_amount').val();

	if (coupon_category_type != '') {
		if (discount_percentage_amount != '') {
			if (!isNaN(discount_percentage_amount)) {
				if (coupon_category_type == 0 || coupon_category_type == 1) {
					$('#edit_coupon_category_error_div').html('');
					if (coupon_category_type == 0) {
						if (discount_percentage_amount > discount_percentage_max_value) {
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be more than '+discount_percentage_max_value+'</span>');
							$('#edit_discount_percentage_amount').focus();
							$('#edit_discount_percentage_amount').val(discount_percentage_max_value);
						} else if (discount_percentage_amount < 0) {
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be less than 0</span>');
							$('#edit_discount_percentage_amount').focus();
							$('#edit_discount_percentage_amount').val('0');
						}else if(!reg.test(discount_percentage_amount)){
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % Only Digit</span>');
							$('#edit_discount_percentage_amount').focus();
							$('#edit_discount_percentage_amount').val('0');
						} else {
							$('#edit_coupon_discount_error').html('');
						}
					} else if (coupon_category_type == 1) {
						if (discount_percentage_amount > discount_amount_max_value) {
							$('#edit_discount_percentage_amount').val(discount_percentage_amount.slice(0,discount_amount_max_value_length));
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be more than '+discount_amount_max_value+'</span>');
						} else if (discount_percentage_amount < 0) {
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be less than 0</span>');
							$('#edit_discount_percentage_amount').val('0');
						}else if(!reg.test(discount_percentage_amount)){
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount Only digits</span>');
							$('#edit_discount_percentage_amount').val('0');
						} else {
							$('#edit_coupon_discount_error').html('');
						}
						$('#edit_discount_percentage_amount').attr("placeholder", "Discount in amount");
					}
				} else {
					$('#edit_coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
					$('#edit_discount_percentage_amount').attr("placeholder", "");	
				}
			} else {
				$('#edit_discount_percentage_amount').focus();
				$('#edit_discount_percentage_amount').val('');
				$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount can only be number</span>');
			}
		} else {
			$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Please enter the discount</span>');
		}
	} else {
		$('#edit_coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
	}
});

$("#edit_discount_percentage_amount").focusout(function() {
  	var coupon_category_type = $('#edit_coupon_category_type').val();
	var discount_percentage_amount = $('#edit_discount_percentage_amount').val();

	if (coupon_category_type != '') {
		if (discount_percentage_amount != '') {
			if (!isNaN(discount_percentage_amount)) {
				if (coupon_category_type == 0 || coupon_category_type == 1) {
					$('#edit_coupon_category_error_div').html('');
					if (coupon_category_type == 0) {
						if (discount_percentage_amount > discount_percentage_max_value) {
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be more than '+discount_percentage_max_value+'</span>');
							$('#edit_discount_percentage_amount').focus();
							$('#edit_discount_percentage_amount').val(discount_percentage_max_value);
						} else if (discount_percentage_amount < 0) {
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be less than 0</span>');
							$('#edit_discount_percentage_amount').focus();
							$('#edit_discount_percentage_amount').val('0');
						}else if(!reg.test(discount_percentage_amount)){
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % Only digits</span>');
							$('#edit_discount_percentage_amount').focus();
							$('#edit_discount_percentage_amount').val('0');
						} else {
							$('#edit_coupon_discount_error').html('');
						}
					} else if (coupon_category_type == 1) {
						if (discount_percentage_amount > discount_amount_max_value) {
							$('#edit_discount_percentage_amount').val(discount_percentage_amount.slice(0,discount_amount_max_value_length));
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be more than '+discount_amount_max_value+'</span>');
						} else if (discount_percentage_amount < 0) {
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be less than 0</span>');
							$('#edit_discount_percentage_amount').val('0');
						}else if(!reg.test(discount_percentage_amount)){
							$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be less than 0</span>');
							$('#edit_discount_percentage_amount').focus();
							$('#edit_discount_percentage_amount').val('0');
						} else {
							$('#edit_coupon_discount_error').html('');
						}
						$('#edit_discount_percentage_amount').attr("placeholder", "Discount in amount");
					}
				} else {
					$('#edit_coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
					$('#edit_discount_percentage_amount').attr("placeholder", "");	
				}
			}else if(!reg.test(discount_percentage_amount)){
				$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be less than 0</span>');
				$('#edit_discount_percentage_amount').focus();
				$('#edit_discount_percentage_amount').val('0');
			} else {
				$('#edit_discount_percentage_amount').focus();
				$('#edit_discount_percentage_amount').val('');
				$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount can only be number</span>');
			}
		} else {
			$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Please enter the discount</span>');
		}
	} else {
		$('#edit_coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
	}
});

$('#edit_coupon_min_purchase_price').keyup(function(){
	var edit_coupon_min_purchase_price = $('#edit_coupon_min_purchase_price').val();
	if (!isNaN(edit_coupon_min_purchase_price)) {
		if (edit_coupon_min_purchase_price.length > min_purchase_amount_max_value_length) {
			$('#edit_coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount cannot be more than '+min_purchase_amount_max_value+'</span>');
			$('#coupon_min_purchase_price').val(edit_coupon_min_purchase_price.slice(0,min_purchase_amount_max_value_length));
		} else if (edit_coupon_min_purchase_price < 0) {
			$('#edit_coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount cannot be less than 0</span>');
			$('#edit_coupon_min_purchase_price').val('0');
		}else if(!reg.test(edit_coupon_min_purchase_price)){
		$('#edit_coupon_min_purchase_price').val('');
		$('#edit_coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount can only be numbers</span>');
	
		} else {
			$('#edit_coupon_min_pruchase_price_error_div').html('');
		}
	}else if(!reg.test(edit_coupon_min_purchase_price)){
		$('#edit_coupon_min_purchase_price').val('');
		$('#edit_coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount can only be numbers</span>');
	
	} else {
		$('#edit_coupon_min_purchase_price').val('');
		$('#edit_coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount can only be numbers</span>');
	}
});

$('#edit_expiry_date').change(function(){
	var expiry_date = $('#edit_expiry_date').val();
	if (expiry_date != '') {
		$('#edit_coupon_expiry_date_error').html('');
	} else {
		$('#edit_coupon_expiry_date_error').html('<span class="text-danger error-msg-small">Please enter the coupon expiry date</span>');
	}
});

function edit_coupon_btn(){
	var id = $('#edit_coupen_id').val();
	var coupon_name = $('#edit_coupon_name').val();
	var coupon_code = $('#edit_coupon_code').val();
	var coupon_expiry_date = $('#edit_expiry_date').val();
	var coupon_category_type = $('#edit_coupon_category_type').val();
	var discount_percentage_amount = $('#edit_discount_percentage_amount').val();
	var edit_coupon_min_purchase_price = $('#edit_coupon_min_purchase_price').val();

	if (edit_coupon_min_purchase_price !='' && coupon_category_type !='' && coupon_name !='' && coupon_code !='' && discount_percentage_amount !='' && coupon_expiry_date !='' 
		&& alphabets_only.test(coupon_name) && alphanumeric_only.test(coupon_code) && !isNaN(discount_percentage_amount)) {
		$('#edit-coupon-close-btn').prop('disabled',true);
		$('#edit_coupon_btn').prop('disabled',true);
		$('#edit_coupon_btn').css('background','#b3b3b3');
		$('#edit_coupen_error_modal').html('<span class="d-block text-warning error-msg">Please wait while we are updating the coupon</span>');
	 	$.ajax({
			type: "POST",
		  	url: base_url+"?/coupon/editCoupon/"+id,
		  	data: {coupon_category_type:coupon_category_type,edit_coupon_min_purchase_price:edit_coupon_min_purchase_price,couponName: coupon_name, couponCode: coupon_code,couponDiscount:discount_percentage_amount,couponExpiryDate:coupon_expiry_date},
		  	 dataType: "json",
		  	success: function(data){
			  	if (data.status == 'success') {
			  		toastr.success('Coupon has been updated successfully.');
					show_product();
					$('#edit_coupon').modal('hide');
			  	} else {
			  		toastr.error('Something went wrong while updating the coupon. Please try again.');
			  	}
			  	$('#edit-coupon-close-btn').prop('disabled',false);
			  	$('#edit_coupon_btn').prop('disabled',false);
		  		$('#edit_coupon_btn').css('background','#1D3327');
		  		$('#edit_coupen_error_modal').html('');
		  	} 
		});
	}else{
		if (coupon_name != '') {
			if (!alphabets_only.test(coupon_name)) {
				$('#edit_coupon_name_error').html('<span class="text-danger error-msg-small">Coupon name should have only alphabets</span>');
				$('#edit_coupon_name').focus();
				$('#edit_coupon_name').val(coupon_name.slice(0,-1));
			} else {
				$('#edit_coupon_name_error').html('');
			}
		} else {
			$('#edit_coupon_name_error').html('<span class="text-danger error-msg-small">Please enter the coupon name.</span>');
		}

		if (coupon_code != '') {
			if (!alphanumeric_only.test(coupon_code)) {
				$('#edit_coupon_code_error').html('<span class="text-danger error-msg-small">Coupon code can be only alphanumeric</span>');
				$('#edit_coupon_code').focus();
				$('#edit_coupon_code').val(coupon_code.slice(0,-1));
			} else {
				$('#edit_coupon_code_error').html('');
			}
		} else {
			$('#edit_coupon_code_error').html('<span class="text-danger error-msg-small">Please enter the coupon code</span>');
		}

		if (discount_percentage_amount != '') {
			$('#edit_coupon_discount_error').html('');
		} else {
			$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Please enter the discount</span>');
		}

		if (coupon_category_type != '') {
			if (discount_percentage_amount != '') {
				if (!isNaN(discount_percentage_amount)) {
					if (coupon_category_type == 0 || coupon_category_type == 1) {
						$('#edit_coupon_category_error_div').html('');
						if (coupon_category_type == 0) {
							if (discount_percentage_amount > discount_percentage_max_value) {
								$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be more than '+discount_percentage_max_value+'</span>');
								$('#edit_discount_percentage_amount').focus();
								$('#edit_discount_percentage_amount').val(discount_percentage_max_value);
							} else if (discount_percentage_amount < 0) {
								$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in % cannot be less than 0</span>');
								$('#edit_discount_percentage_amount').focus();
								$('#edit_discount_percentage_amount').val('0');
							} else {
								$('#edit_coupon_discount_error').html('');
							}
						} else if (coupon_category_type == 1) {
							if (discount_percentage_amount > discount_amount_max_value) {
								$('#edit_discount_percentage_amount').val(discount_percentage_amount.slice(0,discount_amount_max_value_length));
								$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be more than '+discount_amount_max_value+'</span>');
							} else if (discount_percentage_amount < 0) {
								$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount in amount cannot be less than 0</span>');
								$('#edit_discount_percentage_amount').val('0');
							} else {
								$('#edit_coupon_discount_error').html('');
							}
							$('#edit_discount_percentage_amount').attr("placeholder", "Discount in amount");
						}
					} else {
						$('#edit_coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
						$('#edit_discount_percentage_amount').attr("placeholder", "");	
					}
				} else {
					$('#edit_discount_percentage_amount').focus();
					$('#edit_discount_percentage_amount').val(discount_percentage_amount.slice(0,-1));
					$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Discount can only be number</span>');
				}
			} else {
				$('#edit_coupon_discount_error').html('<span class="text-danger error-msg-small">Please enter the discount</span>');
			}
		} else {
			$('#edit_coupon_category_error_div').html('<span class="text-danger error-msg-small">Please select coupon type</span>');
		}

		if (!isNaN(edit_coupon_min_purchase_price)) {
			if (edit_coupon_min_purchase_price.length > min_purchase_amount_max_value_length) {
				$('#edit_coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount cannot be more than '+min_purchase_amount_max_value+'</span>');
				$('#coupon_min_purchase_price').val(edit_coupon_min_purchase_price.slice(0,min_purchase_amount_max_value_length));
			} else if (edit_coupon_min_purchase_price < 0) {
				$('#edit_coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount cannot be less than 0</span>');
				$('#edit_coupon_min_purchase_price').val('0');
			} else {
				$('#edit_coupon_min_pruchase_price_error_div').html('');
			}
		} else {
			$('#edit_coupon_min_purchase_price').val(edit_coupon_min_purchase_price.slice(0,-1));
			$('#edit_coupon_min_pruchase_price_error_div').html('<span class="text-danger error-msg-small">Minimum purchase amount can only be numbers</span>');
		}

		if (expiry_date != '') {
			$('#edit_coupon_expiry_date_error').html('');
		} else {
			$('#edit_coupon_expiry_date_error').html('<span class="text-danger error-msg-small">Please enter the coupon expiry date</span>');
		}
		
		let html = "<span class='text-danger error-msg'>Please Fill the all fields.</span>";
		$('#edit_coupen_error_modal').html(html);
	}
}

function coupen_status(id,status) {
	$('#coupen-status').removeAttr('style');
	var c_status = '';
	if (status !='1') {
		c_status ='1';
	}else{
		c_status ='0';
	}
	$.ajax({
		type: "POST",
	  	url: base_url+"?/coupon/statusCoupon/"+id,
	  	data: {couponStatus: c_status},
	  	 dataType: "json",
	  	success: function(data){
		  	if (data.status == 'success') {
		  		toastr.success('Coupon status has been updated successfully.');
				show_product();
		  	} else {
		  		toastr.error('Something went wrong while updating the coupon status. Please try again.');
	  		}
	  	} 
	});
}

function get_filter(){
	$('#filter-error').html('');
	var date_from = $('#date_from').val();
	var date_to = $('#date_to').val();
	var discount_from = $('#discount_from').val();
	var discount_to = $('#discount_to').val();
	if (date_from !='' && date_to !='' && discount_from !='' && discount_to !='') {
		$('#filter-error').html('');
		show_product(date_from,date_to,discount_from,discount_to);	
	}else{
		$('#filter-error').html('All Field Required');
	}
}

function get_reset(){
	$('#date_from').val('');
$('#date_to').val('');
$('#discount_from').val('');
$('#discount_to').val('');
show_product();
}

$('#discount_from').keyup(function(){
    var discount_from = $('#discount_from').val();
       // var pincode = $('#pincode').val();
       var reg = /^[0-9]+$/;
    if (discount_from != '') {
    	if (discount_from.length > 5) {
    		$('#filter-error').html('<span class="text-danger error-msg-small">cannot be more than 2 digits.</span>');
        	$('#discount_from').val(discount_from.slice(0,5));
    	}else if(!reg.test(discount_from)){
    		$('#filter-error').html('<span class="text-danger error-msg-small">Please Enter Digit only.</span>');
    		$('#discount_from').val('');
    	} else {
    		$('#filter-error').html('');
    	}
    } else {
    	$('#filter-error').html('<span class="text-danger error-msg-small">Please enter the discount</span>');
    }
});

$('#discount_to').keyup(function(){
    var discount_to = $('#discount_to').val();
       // var pincode = $('#pincode').val();
       var reg = /^[0-9]+$/;
    if (discount_to != '') {
    	if (discount_to.length > 5) {
    		$('#filter-error').html('<span class="text-danger error-msg-small">cannot be more than 2 digits.</span>');
        	$('#discount_to').val(discount_to.slice(0,5));
    	}else if(!reg.test(discount_to)){
    		$('#filter-error').html('<span class="text-danger error-msg-small">Please Enter Digit only.</span>');
    		$('#discount_to').val('');
    	} else {
    		$('#filter-error').html('');
    	}
    } else {
    	$('#filter-error').html('<span class="text-danger error-msg-small">Please enter the discount</span>');
    }
});