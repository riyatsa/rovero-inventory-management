function get_warehouse_product(id='') {
	$.ajax({
    type  : 'ajax',
    url   : '?/productList/get_warehouse_product/'+id,
    async : false,
    dataType : 'json',
    success : function(data){
      // alert(JSON.stringify(data.wa.length))
      var myarray=[];
      for (var i = 0; i < data.store.length; i++) {

      	myarray.push(data.store[i].product_id);
      }
      let html='';
              var category = '';
      if (data.wa.length > 0) {
      html +='<option value="">All Products</option>';
      for (var i = 0; i < data.wa.length; i++) {
      	// alert(myarray)
      	
      	if(jQuery.inArray(data.wa[i].product_id, myarray) !== -1){

      		html +='<option disabled value="'+data.wa[i].product_id+'">'+data.wa[i].product_title+'</option>'
      	}else{

        html +='<option value="'+data.wa[i].product_id+'">'+data.wa[i].product_title+'</option>'
      	}
      }
      // $('#select_warehouse').html(category)
      }else{
        html+='<option value="">No Products</option>';	
    }
    $('#get_products').html(html);   
  }
  });
}

$('#select_warehouse').on('change',function(){
  warehouseId = $(this). children("option:selected"). val()
  // alert(warehouseId)
  get_warehouse_product(warehouseId)
});


$('#get_products').on('change',function(){
  product_id = $(this).children("option:selected").val();
  // alert(warehouseId)
  get_warehouse_single_product(product_id);
});

function get_warehouse_single_product(id){
	$.ajax({
    type  : 'ajax',
    url   : '?/productList/get_warehouse_single_product/'+id,
    async : false,
    dataType : 'json',
    success : function(data){
    	// console.log(JSON.stringify(data))
    	// `category_id`, `product_title`, `unit_id`, `uinit`, `barcode`, `sale_price`, `sale_tax_type`, `purchase_price`, `purchase_tax_type`, `tax_rate`, `opening_quantity`, `at_price`, `date`, `minimum_stock`, `iteam_location`, `product_status`, `created_date`, `updated_date`
    // alert(JSON.stringify(data))
    	$("#select_product_category").val(data.category_id);
		$("#select_unit").val(data.unit_id);
		$("#item_code").val(data.barcode);
		$("#item_name").val(data.product_title);
		$("#sale_price").val(data.retail_price);
		$("#sale_tax_price").val(data.sale_tax_type);
		$("#purchase_price").val(data.wholesale_price);
		$("#mrp_price").val(data.product_mrp);
		// $("#purchase_tax_type").val(data.purchase_tax_type);
		$("#select_tax_rate").val(data.tax_rate);
		$("#opening_quantity").val(data.opening_quantity);
		$("#date").val(data.date);
		$("#minimum_stock").val(data.minimum_stock);
  }
  });
}


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

$("#item_code").keyup(function(){
  var item_code = $('#item_code').val();
  if (item_code != '') { 
      $('#item-code-error-msg-div').html('');
   
  } else {
    $('#item-code-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the Item Code.</span>');
  }
});


$("#sale_price").keyup(function(){
  var sale_price = $('#sale_price').val();
  if (sale_price != '') { 
      $('#sale-price-error-msg-div').html('');
   
  } else {
    $('#sale-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the price.</span>');
  }
});

$("#purchase_price").keyup(function(){
  var purchase_price = $('#purchase_price').val();
  if (purchase_price != '') { 
      $('#purchase-price-error-msg-div').html('');
   
  } else {
    $('#purchase-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the purchase price.</span>');
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


function saveProducts(){

	var category = $("#select_product_category").val();
	var select_unit = $("#select_unit").val();
	var item_code = $("#item_code").val();
	var item_name = $("#item_name").val();
	var sale_price = $("#sale_price").val();
	var sale_tax_price = $("#sale_tax_price").val();
	var purchase_price = $("#purchase_price").val();
	// var purchase_tax_type = $("#purchase_tax_type").val();
	var select_tax_rate = $("#select_tax_rate").val();
	var opening_quantity = $("#opening_quantity").val();
	var date = $("#date").val();
	var minimum_stock = $("#minimum_stock").val();
	var warehouse_id =  $("#select_warehouse").val();
	var product_id = $("#get_products").val();
	var discount_in_percent = $("#discount_in_percent").val();
	var discount_in_price = $("#discount_in_price").val();

	if (product_id !='' && category !='' && select_unit !='' && item_code !='' &&
		item_name !='' &&
		sale_price !='' &&
		sale_tax_price !='' && select_tax_rate !='' && 
		date !=''
		) { 

		 $('#cancel_add_new_product_btn').prop('disabled',true);
	          $('#add_new_product_btn').prop('disabled',true);
	          $('#add_new_product_btn').css('background','#1D3327');
	          $('#product-error').html('<span class="text-warning error-msg-small">Please wait we are adding product details.</span>'); 

		var formdata = new FormData();
		  formdata.append('discount_in_percent',discount_in_percent);
		  formdata.append('discount_in_price',discount_in_price);
		  formdata.append('warehouse_id',warehouse_id);
		  formdata.append('product_id',product_id);
		  formdata.append('category_id',category);
		  formdata.append('unit_id',select_unit);
		  formdata.append('barcode',item_code);
		  formdata.append('product_title',item_name);
		  formdata.append('sale_price',sale_price);
		  formdata.append('sale_tax_type',sale_tax_price);
		  formdata.append('purchase_price',purchase_price);
		  // formdata.append('purchase_tax_type',purchase_tax_type);
		  formdata.append('tax_rate',select_tax_rate);
		  formdata.append('opening_quantity',opening_quantity);
		  formdata.append('date',date);
		  formdata.append('minimum_stock',minimum_stock);
	  $.ajax({
	      type: "POST",
	        url: base_url+"?/StoreProduct/add_warehouse_product/",
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
				// $("#purchase_tax_type").val('');
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
		// alert("bug")
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
		if (sale_price != '') { 
		      $('#sale-price-error-msg-div').html('');
		   
		  } else {
		    $('#sale-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the price.</span>');
		  }
		if (purchase_price != '') { 
		      $('#purchase-price-error-msg-div').html('');
		   
		  } else {
		    $('#purchase-price-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the purchase price.</span>');
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


function get_barcode_single_product(){
		$("#product-error").html('');
	var barcode = $("#item_code").val();
		$.ajax({
    type  : 'POST',
    url   : '?/productList/get_warehouse_single_product_search_by_barcode/',
    data : { barcode:barcode },
    async : false,
    dataType : 'json',
    success : function(data){

    	if (data.barcode !='0') {
    		    	// `category_id`, `product_title`, `unit_id`, `uinit`, `barcode`, `sale_price`, `sale_tax_type`, `purchase_price`, `purchase_tax_type`, `tax_rate`, `opening_quantity`, `at_price`, `date`, `minimum_stock`, `iteam_location`, `product_status`, `created_date`, `updated_date`
    // alert(JSON.stringify(data.warehouseId))
    	$("#select_product_category").val(data.category_id);
		$("#select_unit").val(data.unit_id);
		$('#select_warehouse').val(data.warehouseId);
		$("#item_name").val(data.product_title);
		$("#sale_price").val(data.sale_price);
		$("#sale_tax_price").val(data.sale_tax_type);
		$("#get_products").val(data.product_id);
		$("#purchase_price").val(data.purchase_price);
		// $("#purchase_tax_type").val(data.purchase_tax_type);
		$("#select_tax_rate").val(data.tax_rate);
		$("#opening_quantity").val(data.opening_quantity);
		$("#date").val(data.date);
		$("#minimum_stock").val(data.minimum_stock);
	}else{
		$("#product-error").html("<span class='text-danger'>Already This Product available in store product.</span>");
	}


  }
  });
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
		  	url: base_url+"?/StoreProduct/importExcel",
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