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
      // html +='<option value="">All Products</option>';
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



function saveProducts(){ 
  var warehouse_id =  $("#select_warehouse").val();
  var product_id = $("#get_products").val(); 

  if (product_id !='') { 

     $('#cancel_add_new_product_btn').prop('disabled',true);
            $('#add_new_product_btn').prop('disabled',true);
            $('#add_new_product_btn').css('background','#1D3327');
            $('#product-error').html('<span class="text-warning error-msg-small">Please wait we are adding product details.</span>'); 

    var formdata = new FormData(); 
      formdata.append('warehouse_id',warehouse_id);
      formdata.append('product_id',product_id); 
    $.ajax({
        type: "POST",
          url: base_url+"?/StoreProduct/add_store_product/",
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(data) {
            if (data.status == '1') { 
              $('#select_warehouse').trigger('change')
              // $("#get_products").val(''); 
             /* $("#select_product_category").val('');
        $("#select_unit").val('');
        $("#item_code").val('');
        $("#item_name").val('');
        $("#sale_price").val('');
        $("#sale_tax_price").val('');
        $("#purchase_price").val('');*/
        // $("#purchase_tax_type").val('');
       /* $("#select_tax_rate").val('');
        $("#opening_quantity").val('');
        $("#date").val();
        $("#minimum_stock").val();*/
            toastr.success('New Outlet product has been Added successfully.');
            }else{
            toastr.error('Something went wrong while updating Outlet product . Please try again.');

            }
            $('#cancel_add_new_product_btn').prop('disabled',false);
            $('#add_new_product_btn').prop('disabled',false);
            $('#add_new_product_btn').css('background','#1D3327');
            $('#product-error').html('');
          }
      }); 
  }else{
    if (item_name != '') { 
          $('#product-error').html('');
       
      } else {
        $('#product-error').html('<span class="text-danger error-msg-small">Please Select the Products.</span>');
      }
  }

}



 