/*
*productCategoryJs.js
*  
*/
var fadeout_time = 5000;
getProductCategory();

function getProductCategory(){
	$.ajax({
        type  : 'ajax',
        url   : '?/wareHouseProduct/getProductCategory/',
        async : false,
        dataType : 'json',
        success : function(data){
        	// alert(JSON.stringify(data))
            let html='';  
	        if (data.length > 0) {
	         	for (var i = 0; i < data.length; i++) {
	        		html +='<div class="col-md-3 mt-4">'+
	                  '<div class="product-category-description">'+
	                    '<ul>'+
	                      '<li class="product-category-name">'+data[i].category_name+'</li>'+
	                      '<li class="product-category-edit-delete">'+
	                        '<a class="product-category-edit-a" data-category_name="'+data[i].category_name+'" id="edit_category_'+data[i].category_id+'" onclick="edit_category('+data[i].category_id+')"><i class="fa fa-pencil text-primary"></i></a>'+
	                      '</li>'+
	                      '<li class="product-category-edit-delete">'+
	                        '<a class="product-category-delete-a" onclick="remove_category('+data[i].category_id+')" ><i class="fa fa-times text-danger"></i></a>'+
	                      '</li>'+
	                    '</ul>'+
	                  '</div>'+
	                '</div>'; 
	            }
	        }else{
	           	 html +='<div class="col-md-12 text-center">Prododuct Category Not Available.</div>';
	        }
	        $('#productCategoryDetails').html(html); 
	    }
    });
}


function addCategory() {
	var category = $('#add_product_category').val();
	if (category != '') {
		$('#add_product_category_btn').prop('disabled',true);
		$('#add_product_category_btn').css('background','#b3b3b3');
		$('#category-error').html('<span class"d-block text-warning error-msg">Please wait while we are adding product category</span>');
		$.ajax({
			type: "POST",
		  	url: base_url+"?/wareHouseProduct/insert_category",
		  	data: {category_name: category},
		  	 dataType: "json",
		  	success: function(data){
			  	if (data.status == '1') {
			  		toastr.success('Product category has been added successfully.');
			  		$('#add_product_category').val('');
					getProductCategory();
			  	} else {
			  		toastr.error('Something went wrong while adding product category. Please try again.');
		  		}
		  		$('#add_product_category_btn').prop('disabled',false);
		  		$('#add_product_category_btn').css('background','#1D3327');
		  		$('#category-error').html('');
		  	} 
		});
	}else{
		let html = "<span class='text-danger error-msg'>Please fill the category name.</span>";
		$('#category-error').html(html);
	}
}



function edit_category(id) {
	$('#edit_product_category').modal('show');
	$('#category-error').html('');
	 var category_name = $('#edit_category_'+id).data('category_name');
	 $('#edit_id').val(id);
	 $('#edit_category').val(category_name);
}

function updateproductCategory() {
	var id = $('#edit_id').val();
	var category_name = $('#edit_category').val();
	
	if (id !='' && category_name !='' ) {
		$('#edit_product_category_btn').prop('disabled',true);
		$('#edit_product_category_btn').css('background','#b3b3b3');
		$('#edit_category_error_msg_div').html('<span class="d-block text-warning error-msg"Please wait while we are updating the product category</span>');
		$.ajax({
			type: "POST",
		  	url: base_url+"?/wareHouseProduct/update_category/"+id,
		  	data: {category_name: category_name},
			dataType: "json",
			success: function(data){
				$('#edit_product_category_btn').prop('disabled',false);
		  		$('#edit_product_category_btn').css('background','#1D3327');
		  		$('#edit_category_error_msg_div').html('');
				if (data.status == '1') {
					toastr.success('Product category has been updated successfully.');
					$('#edit_product_category').modal('hide');
					getProductCategory();
				} else {
					toastr.error('Something went wrong while updating the product category. Please try again.');
					$('#edit_product_category').modal('hide');
		  		}
			} 
		});
	} else {
		let html = "<span class='text-danger error-msg'>Please Fill the category name.</span>";
		$('#edit_category_error_msg_div').html(html);
	}
}

function remove_category(id){
	$("#delete_product_category").modal('show');
	$('#remove_cat_id').val(id);
}


function deletecategory(){
	var id = $('#remove_cat_id').val();
	$.ajax({
		type: "POST",
		url: base_url+"?/wareHouseProduct/remove_category/"+id,
  		dataType: "json",
		success: function(data){
			if (data.status == '1') {
				toastr.success('Product category has been removed successfully.');
				$('#delete_product_category').modal('hide');
				getProductCategory();
		  	} else {
		  		toastr.error('Something went wrong while removing the product category. Please try again.');
				$('#delete_product_category').modal('hide');
		  	}
		} 
	});
}


$('#add_product_category').keyup(function(){
	var add_product_category = $('#add_product_category').val();
	if (add_product_category != '') {
		// $('#category-error').html('');
			$.ajax({
			type: "POST",
			url: base_url+"?/wareHouseProduct/check_duplication/",
			data : {product_category:add_product_category},
	  		dataType: "json",
			success: function(data){
				if (data.status == '1') { 
					let html = "<span class='text-danger error-msg'>Already Exist. Please enter another category.</span>";
					$('#category-error').html(html);
						$('#add_product_category_btn').prop('disabled',true);
						$('#add_product_category_btn').css('background','#b3b3b3');
			  	} else { 
			  		$('#category-error').html('');
			  		$('#add_product_category_btn').prop('disabled',false);
		  			$('#add_product_category_btn').css('background','#1D3327');
			  	}
			} 
		});
	} else {
		let html = "<span class='text-danger error-msg'>Please fill the category name.</span>";
		$('#category-error').html(html);
	}

});


$('#edit_category').keyup(function(){
	var add_product_category = $('#edit_category').val();
	if (add_product_category != '') {
		$('#edit_category_error_msg_div').html('');
	} else {
		let html = "<span class='text-danger error-msg'>Please fill the category name.</span>";
		$('#edit_category_error_msg_div').html(html);
	}
});