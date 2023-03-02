
$('#select_product_category').change(function(){
  var category = $('#select_product_category').val(); 
  $('#select-category-error-msg-div').html('');
  if (category != '') { 
      $('#select-category-error-msg-div').html(''); 
   
  } else {
    $('#select-category-error-msg-div').html('<span class="text-danger error-msg-small">Please Select Category.</span>');  
  }
});
 

$('#select_unit').change(function(){
  var select_unit = $('#select_unit').val(); 
  $('#select_unit-error-msg-div').html('');
  if (select_unit != '') { 
      $('#select_unit-error-msg-div').html(''); 
   
  } else {
    $('#select_unit-error-msg-div').html('<span class="text-danger error-msg-small">Please Select unit.</span>');  
  }
});

$('#sale_tax_price').change(function(){
  var sale_tax_price = $('#sale_tax_price').val(); 
  $('#sale-tax-type-error-msg-div').html('');
  if (sale_tax_price != '') { 
      $('#sale-tax-type-error-msg-div').html(''); 
   
  } else {
    $('#sale-tax-type-error-msg-div').html('<span class="text-danger error-msg-small">Please Select tax type.</span>');  
  }
});

$('#select_tax_rate').change(function(){
  var select_tax_rate = $('#select_tax_rate').val(); 
  $('#select-tax-rate-error-msg-div').html('');
  if (select_tax_rate != '') { 
      $('#select-tax-rate-error-msg-div').html(''); 
   
  } else {
    $('#select-tax-rate-error-msg-div').html('<span class="text-danger error-msg-small">Please Select rate.</span>');  
  }
});

$("#item_name").keyup(function(){
  var item_name = $('#item_name').val();
  if (item_name != '') { 
      $('#item-name-error-msg-div').html('');
   
  } else {
    $('#item-name-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the name.</span>');
  }
});

$("#purchase_price").keyup(function(){
  var purchase_price = $('#purchase_price').val();
  if (purchase_price != '') { 
      $('#purchase-price-error-msg-div').html('');
   
  } else {
    $('#purchase-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter purchase price.</span>');
  }
});

$("#item_code").keyup(function(){
  var item_code = $('#item_code').val();
  if (item_code != '') { 
      $('#item-code-error-msg-div').html('');
   
  } else {
    $('#item-code-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the Item Code.</span>');
  }
});
/*product_mrp
retail_price
wholesale_price*/

$("#product_mrp").keyup(function(){
  var product_mrp = $('#product_mrp').val();
  if (product_mrp != '') { 
      $('#mrp-price-error-msg-div').html('');
   
  } else {
    $('#mrp-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the price.</span>');
  }
});

$("#retail_price").keyup(function(){
  var retail_price = $('#retail_price').val();
  if (retail_price != '') { 
      $('#retail-price-error-msg-div').html('');
   
  } else {
    $('#retail-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the Retail price.</span>');
  }
});

$("#wholesale_price").keyup(function(){
  var wholesale_price = $('#wholesale_price').val();
  if (wholesale_price != '') { 
      $('#wholesale-price-error-msg-div').html('');
   
  } else {
    $('#wholesale-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the Wholesale price.</span>');
  }
});


$("#opening_quantity").keyup(function(){
  var opening_quantity = $('#opening_quantity').val();
  if (opening_quantity != '') { 
      $('#opening-quantity-error-msg-div').html('');
   
  } else {
    $('#opening-quantity-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the opening quantity.</span>');
  }
});

$("#date").keyup(function(){
  var date = $('#date').val();
  if (date != '') { 
      $('#date-error-msg-div').html('');
   
  } else {
    $('#date-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the date.</span>');
  }
});

$("#minimum_stock").keyup(function(){
  var minimum_stock = $('#minimum_stock').val();
  if (minimum_stock != '') { 
      $('#minimum-stock-error-msg-div').html('');
   
  } else {
    $('#minimum-stock-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the minimum stock.</span>');
  }
});

function check_duplication(){
	var name = $("#item_name").val();
	 $.ajax({
	      type: "POST",
	        url: base_url+"?/WareHouseProduct/check_duplication_name/",
	        data:{ name:name },
	        dataType: 'json',
	        success: function(data) {
	        	if (data.status=='0') {
					$("#item-name-error-msg-div").html('<span class="text-danger">Already Available.</span>');
						 $('#cancel_add_new_product_btn').prop('disabled',true);
	          $('#add_new_product_btn').prop('disabled',true);
	          $('#add_new_product_btn').css('background','#1D3327');
	        	}else{
	        			          $('#cancel_add_new_product_btn').prop('disabled',false);
	          $('#add_new_product_btn').prop('disabled',false);
	          $('#add_new_product_btn').css('background','#1D3327');
					$("#item-name-error-msg-div").html('');	        		
	        	}
	        }
	    });
}

function check_duplication_code(){
	var barcode = $("#item_code").val();
	 $.ajax({
	      type: "POST",
	        url: base_url+"?/WareHouseProduct/check_duplication_barcode/",
	        data:{ barcode:barcode },
	        dataType: 'json',
	        success: function(data) {
	        	if (data.status=='0') {
					$("#item-code-error-msg-div").html('<span class="text-danger">Already Available.</span>');
						 $('#cancel_add_new_product_btn').prop('disabled',true);
	          $('#add_new_product_btn').prop('disabled',true);
	          $('#add_new_product_btn').css('background','#1D3327');
	        	}else{
	        			          $('#cancel_add_new_product_btn').prop('disabled',false);
	          $('#add_new_product_btn').prop('disabled',false);
	          $('#add_new_product_btn').css('background','#1D3327');
					$("#item-code-error-msg-div").html('');	        		
	        	}
	        }
	    });
}


function saveProducts(){

	var category = $("#select_product_category").val();
	var select_unit = $("#select_unit").val();
	var item_code = $("#item_code").val();
	var item_name = $("#item_name").val();
	var product_mrp = $("#product_mrp").val();
	var retail_price = $("#retail_price").val();
	var wholesale_price = $("#wholesale_price").val();
	var purchase_tax_type = $("#purchase_tax_type").val();
	var select_tax_rate = $("#select_tax_rate").val();
	var opening_quantity = $("#opening_quantity").val();
	var date = $("#date").val();
	var minimum_stock = $("#minimum_stock").val();
	var purchase_price = $('#purchase_price').val();

	if (category !='' && select_unit !='' && item_code !='' &&
		item_name !='' &&
		product_mrp !='' &&
		retail_price !='' &&
		wholesale_price !='' &&
		purchase_tax_type !='' &&
		select_tax_rate !='' && 
		date !=''
		) { 

		 $('#cancel_add_new_product_btn').prop('disabled',true);
	          $('#add_new_product_btn').prop('disabled',true);
	          $('#add_new_product_btn').css('background','#1D3327');
	          $('#product-error').html('<span class="text-warning error-msg-small">Please wait we are adding product details.</span>'); 

		var formdata = new FormData();
		  formdata.append('category_id',category);
		  formdata.append('unit_id',select_unit);
		  formdata.append('barcode',item_code);
		  formdata.append('product_title',item_name);
		  formdata.append('product_mrp',product_mrp);
		  formdata.append('retail_price',retail_price);
		  formdata.append('wholesale_price',wholesale_price);
		  formdata.append('purchase_price',purchase_price);
		  formdata.append('purchase_tax_type',purchase_tax_type);
		  formdata.append('tax_rate',select_tax_rate);
		  formdata.append('opening_quantity',opening_quantity);
		  formdata.append('date',date);
		  formdata.append('minimum_stock',minimum_stock);
	  $.ajax({
	      type: "POST",
	        url: base_url+"?/WareHouseProduct/add_warehouse_product/",
	        data:formdata,
	        dataType: 'json',
	        contentType: false,
	        processData: false,
	        success: function(data) {
	          if (data.status == '1') { 
	          	$("#select_product_category").val('');
				$("#select_unit").val('');
				$("#item_code").val('');
				$("#item_name").val('');
				$("#sale_price").val('');
				$("#sale_tax_price").val('');
				$("#purchase_price").val('');
				$("#purchase_tax_type").val('');
				$("#select_tax_rate").val('');
				$("#opening_quantity").val('');
				$("#date").val();
				$("#minimum_stock").val();
	          toastr.success('New warehouse product has been update successfully.');
	          }else{
	          toastr.error('Something went wrong while updating warehouse product . Please try again.');

	          }
	          $('#cancel_add_new_product_btn').prop('disabled',false);
	          $('#add_new_product_btn').prop('disabled',false);
	          $('#add_new_product_btn').css('background','#1D3327');
	          $('#product-error').html('');
	        }
	    }); 
	}else{
		if (category != '') { 
		      $('#select-category-error-msg-div').html(''); 
		   
		  } else {
		    $('#select-category-error-msg-div').html('<span class="text-danger error-msg-small">Please Select Category.</span>');  
		  }
		if (item_name != '') { 
		      $('#item-name-error-msg-div').html('');
		   
		  } else {
		    $('#item-name-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the name.</span>');
		  }
		if (item_code != '') { 
		      $('#item-code-error-msg-div').html('');
		   
		  } else {
		    $('#item-code-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the Item Code.</span>');
		  }
		if (product_mrp != '') { 
		      $('#mrp-price-error-msg-div').html('');
		  } else {
		    $('#mrp-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the price.</span>');
		  }

		  if (wholesale_price != '') { 
		      $('#wholesale-price-error-msg-div').html(''); 
		  } else {
		    $('#wholesale-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the price.</span>');
		  }
		if (retail_price != '') { 
		      $('#retail-price-error-msg-div').html('');
		   
		  } else {
		    $('#retail-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the retail price.</span>');
		  }
		if (opening_quantity != '') { 
		      $('#opening-quantity-error-msg-div').html('');
		   
		  } else {
		    $('#opening-quantity-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the opening quantity.</span>');
		  }
		if (date != '') { 
		      $('#date-error-msg-div').html('');
		   
		  } else {
		    $('#date-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the date.</span>');
		  }
		if (minimum_stock != '') { 
		      $('#minimum-stock-error-msg-div').html('');
		   
		  } else {
		    $('#minimum-stock-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the minimum stock.</span>');
		  }

		  if (purchase_price != '') { 
		      $('#purchase-price-error-msg-div').html('');
		   
		  } else {
		    $('#purchase-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter purchase price.</span>');
		  }


	    if (select_unit != '') { 
		      $('#select_unit-error-msg-div').html(''); 
		   
		  } else {
		    $('#select_unit-error-msg-div').html('<span class="text-danger error-msg-small">Please Select unit.</span>');  
		  }
		  if (sale_tax_price != '') { 
		      $('#sale-tax-type-error-msg-div').html(''); 
		   
		  } else {
		    $('#sale-tax-type-error-msg-div').html('<span class="text-danger error-msg-small">Please Select tax type.</span>');  
		  }
		  if (select_tax_rate != '') { 
		      $('#select-tax-rate-error-msg-div').html(''); 
		   
		  } else {
		    $('#select-tax-rate-error-msg-div').html('<span class="text-danger error-msg-small">Please Select rate.</span>');  
		  }
		  if (item_name != '') { 
		      $('#item-name-error-msg-div').html('');
		   
		  } else {
		    $('#item-name-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the name.</span>');
		  }


	}

}

function import_excel(){
	var files = $('#import_excel')[0].files[0];
	if (files != undefined) {
		$('#excel-error-msg-div').html('');

		var formdata = new FormData(); 
		formdata.append('files', files);
		
		$('#excel-error-msg-div').html('<span class="text-warning error-msg-small">Please wait while we are submitting the details</span>');
		$('#import_excel_file').prop('disabled',true);
		$('#import_excel_file').css('background','#b3b3b3');

		$.ajax({
			type: "POST",
		  	url: base_url+"?/wareHouseProduct/importExcel",
		  	data: formdata,
		  	dataType: "json",
		  	contentType: false,
		    processData: false,
		  	success: function(data){
		  		$('#excel-error-msg-div').html('');
		  		$('#import_excel_file').prop('disabled',false);
		  		$('#import_excel_file').css('background','#005799');
			  	if (data.status == '1') {
			  		toastr.success('New users has been added successfully.');
					$('#import_excel').val('');
			  	} else {
			  		toastr.error('OOPS! Something went wrong while adding the users details. Please try again.');
		  		}
		  	} 
		});
	} else {
		$('#excel-error-msg-div').html('<span class="text-danger error-msg-small">Please select a valid excel sheet.</span>');
	}
}