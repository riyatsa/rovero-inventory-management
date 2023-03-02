
$('#select_product_category').change(function(){
  var category = $('#select_product_category').val(); 
  $('#select-category-error-msg-div').html('');
  if (category != '') { 
      $('#select-category-error-msg-div').html(''); 
   
  } else {
    $('#select-category-error-msg-div').html('<span class="text-danger error-msg-small">Please Select Category.</span>');  
  }
});
 

 /*retail_price_percentage
wholesale_price_percentage
purchase_price_percentage*/
// product_mrp
/*product_mrp
retail_price
wholesale_price*/

$("#retail_price_percentage").on("keyup blur",function(){
	var r_price = $(this).val();
	var product_mrp = $("#product_mrp").val();
	if (r_price !='' ) {
		// alert(product_mrp)

		var  gst_price = parseFloat(product_mrp) - (parseFloat(product_mrp) * parseFloat(r_price)) / 100;
		$("#retail_price").val(gst_price);
		$("#wholesale_price_percentage").attr('disabled',false);
	}else{
		$("#wholesale_price_percentage").attr('disabled',true);
	}
})


$("#wholesale_price_percentage").on("keyup blur",function(){
	var w_price = $(this).val();
	var product_mrp = $("#product_mrp").val();
	if (w_price !='' ) {
		// alert(product_mrp)

		// 100 - (100 * 6) / 100

		var  gst_price = parseFloat(product_mrp) - (parseFloat(product_mrp) * parseFloat(w_price)) / 100;
		$("#wholesale_price").val(gst_price);
		$("#purchase_price_percentage").attr('disabled',false);
	}else{
		$("#purchase_price_percentage").attr('disabled',true);
	}
})


$("#purchase_price_percentage").on("keyup blur",function(){
	var p_price = $(this).val();
	var product_mrp = $("#product_mrp").val();
	if (p_price !='' ) {
		// alert(product_mrp)

		var  gst_price = parseFloat(product_mrp) - (parseFloat(product_mrp) * parseFloat(p_price)) / 100;
		$("#purchase_price").val(gst_price);
		// $("#wholesale_price_percentage").attr('disabled',false);
	}else{
		// $("#wholesale_price_percentage").attr('disabled',true);
	}
})





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
     
      var wholesale_price = $('#wholesale_price').val();
      if (parseFloat(wholesale_price) >= parseFloat(purchase_price)) {
      	 $('#purchase-price-error-msg-div').html('');
      }else{
      	$('#purchase-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the valid purchase price.</span>');
      	$('#purchase_price').val(0);
      }
   
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

  	$("#retail_price_percentage").attr('disabled',false);
      $('#mrp-price-error-msg-div').html('');
   
  } else {
  	$("#retail_price_percentage").attr('disabled',true);
    $('#mrp-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the price.</span>');
  }
});

$("#retail_price").keyup(function(){
  var retail_price = $('#retail_price').val();
  if (retail_price != '') { 
      
      var product_mrp = $('#product_mrp').val();
      // alert(product_mrp)
      // alert(retail_price)
      if (parseFloat(product_mrp) >= parseFloat(retail_price)) {
      	$('#retail-price-error-msg-div').html('');
      }else{
      	$('#retail-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the Retail price.</span>');
      	$('#retail_price').val(0);
      }
   
  } else {
    $('#retail-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the Retail price.</span>');
  }
}); 

$("#wholesale_price").keyup(function(){
  var wholesale_price = $('#wholesale_price').val();
  if (wholesale_price != '') { 
      var retail_price = $('#retail_price').val();
      if (parseFloat(retail_price) >= parseFloat(wholesale_price)) {
      	$('#wholesale-price-error-msg-div').html('');
      }else{
      	$('#wholesale-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the valid Wholesale price.</span>');
      	$('#wholesale_price').val(0);
      }
   
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
$('#barcode-btn').on('click', '.btn-barcode', function (e) {
// $(".btn-barcode").click(function(){
$.ajax({
	      type: "POST",
	        url: base_url+"?/WareHouseProduct/generate_code/", 
	        dataType: 'json',
	        success: function(data) {
	        	$("#item_code").val(data);
	        	$("#item_code").prop('readonly',true);
	        	$("#barcode-btn").html('<button class="btn btn-info mt-2 edit-barcode" id="">Edit</button>');
	        }
	    });
});
$('#barcode-btn').on('click', '.edit-barcode', function (e) {
// $(".edit-barcode").click(function(){
	$("#item_code").val('');
	$("#item_code").prop('readonly',false);
	$("#barcode-btn").html(' <button class="btn btn-success mt-2 btn-barcode" id="">Generate</button>');
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
	var barcode_status = $('#barcode_status').val();

	if (category !='' && item_code !='' &&
		item_name !='' &&
		product_mrp !='' &&
		retail_price !='' &&
		wholesale_price !='' &&
		purchase_tax_type !='' &&
		select_tax_rate !='' 
		) { 

		 $('#cancel_add_new_product_btn').prop('disabled',true);
	          $('#add_new_product_btn').prop('disabled',true);
	          $('#add_new_product_btn').css('background','#1D3327');
	          $('#product-error').html('<span class="text-warning error-msg-small">Please wait we are adding product details.</span>'); 

		var formdata = new FormData();
		  formdata.append('barcode_status',barcode_status);
		  formdata.append('category_id',category);
		  formdata.append('unit_id',select_unit);
		  formdata.append('barcode',item_code);
		  formdata.append('product_title',item_name);
		  formdata.append('product_mrp',product_mrp);
		  formdata.append('retail_price',retail_price);
		  formdata.append('wholesale_price',wholesale_price);
		  formdata.append('purchase_price',0);
		  formdata.append('purchase_tax_type',purchase_tax_type);
		  formdata.append('tax_rate',select_tax_rate);
		  formdata.append('opening_quantity',opening_quantity);
		  // formdata.append('date',date);
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
			  		toastr.success('New Product has been added successfully.');
					$('#import_excel').val('');
			  	} else {
			  		toastr.error('OOPS! Something went wrong while adding the Product details. Please try again.');
		  		}
		  	} 
		});
	} else {
		$('#excel-error-msg-div').html('<span class="text-danger error-msg-small">Please select a valid excel sheet.</span>');
	}
}

function preview_excel(){
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
		  	url: base_url+"?/wareHouseProduct/importpreview",
		  	data: formdata,
		  	dataType: "json",
		  	contentType: false,
		    processData: false,
		  	success: function(data){
		  		$('#excel-error-msg-div').html('');
		  		$('#import_excel_file').prop('disabled',false);
		  		$('#import_excel_file').css('background','#005799');
			  	if (data.status == '1') {
			  		$("#product-preview").modal('show')
			  		// toastr.success('New Product has been added successfully.');
					// $('#import_excel').val('');
					// alert(JSON.stringify(data.products))
					 let html='';
			      if (data.products.length > 0) {
			        var j = 1;
			        for (var i = 0; i < data.products.length; i++) {
			        		var barcode_status = 'generate';
			        	if (data.products[i].barcode_status == '0') {
			        		barcode_status = 'not-generate';
			        	}
			        	var status = 'Pass';
			        	if (parseFloat(data.products[i].product_mrp) < parseFloat(data.products[i].retail_price)) {
			        		status = 'Faild';
			        	}else if(parseFloat(data.products[i].retail_price) < parseFloat(data.products[i].wholesale_price)){
			        		status = 'Faild';
			        	}else if(parseFloat(data.products[i].wholesale_price) < parseFloat(data.products[i].purchase_price)){
			        		status = 'Faild';
			        	}
			          html+='<tr>'
			            html+='<td>'+j+'</td>'
			            html+='<td id="product_title_'+j+'">'+data.products[i].product_title+'</td>'
			            html+='<td id="barcode_'+j+'">'+data.products[i].barcode+'</td>'
			            // html+='<td id="product_title_'+j+'">'+data.products[i].category_id+'</td>'
			            // html+='<td id="quantity_'+data[i].product_id+'">'+data[i].quantity+'</td>'
			            if(data.products[i].opening_quantity > 20){
			              html+='<td class="text-success text-right" id="quantity_'+j+'">'+data.products[i].opening_quantity+'</td>'
			            }else if(data.products[i].opening_quantity > 10){
			              html+='<td class="text-info text-right" id="quantity_'+j+'">'+data.products[i].opening_quantity+'</td>'
			            }else if(data.products[i].opening_quantity <= 10){
			              html+='<td class="text-danger text-right" id="quantity_'+j+'">'+data.products[i].opening_quantity+'</td>'
			            } 
			            html+='<td id="product_mrp_'+j+'">'+data.products[i].minimum_stock+'</td>'
			            html+='<td id="product_mrp_'+j+'"><i class="fa fa-rupee"></i> '+data.products[i].product_mrp+'</td>'
			            html+='<td id="retail_price_'+j+'"><i class="fa fa-rupee"></i> '+data.products[i].retail_price+'</td>'
			            html+='<td id="wholesale_price_'+j+'"><i class="fa fa-rupee"></i> '+data.products[i].wholesale_price+'</td>'
			            html+='<td id="purchase_price_'+j+'"><i class="fa fa-rupee"></i> '+data.products[i].purchase_price+'</td>'
			            html+='<td id="purchase_price_'+j+'"><i class="fa fa-rupee"></i> '+data.products[i].tax_rate+'</td>'
			            html+='<td id="purchase_price_'+j+'">'+barcode_status+'</td>'
			            html+='<td id="purchase_price_'+j+'">'+status+'</td>'
			            
			          html+='</tr>';
			          j++; 
			        }
			      }else{
			        html+='<tr>'+
			          '<td colspan="11" class="text-center">No Product found.</td>'+
			        '</tr>';	
			    }

			    $("#get-product-lists").html(html)

			  	} else {
			  		toastr.error('OOPS! Something went wrong while adding the Product details. Please try again.');
		  		}
		  	} 
		});
	} else {
		$('#excel-error-msg-div').html('<span class="text-danger error-msg-small">Please select a valid excel sheet.</span>');
	}
}