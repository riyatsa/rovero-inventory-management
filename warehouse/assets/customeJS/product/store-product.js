get_warehouse_product();
function get_warehouse_product(id='') {
	$.ajax({
    type  : 'ajax',
    url   : '?/WareHouseProduct/get_store_product/'+id,
    async : false,
    dataType : 'json',
    success : function(data){ 
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) {
          var check ='';
          // alert(data[i].customer_status)
          if (data[i].product_status =='1') {
            check ='checked';
          }else{
            check ='';
        	}

          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td id="product_title_'+data[i].product_id+'">'+data[i].product_title+'</td>'+
            '<td id="barcode_'+data[i].product_id+'">'+data[i].barcode+'</td>'+ 
            '<td id="barcode_'+data[i].product_id+'">'+data[i].quantity+'</td>'+ 
            '<td id="barcode_'+data[i].product_id+'">'+data[i].unit_name+'</td>'+ 
            '<td id="barcode_'+data[i].product_id+'"><i class="fa fa-rupee"></i> '+data[i].sale_price+'</td>'+ 
            '<td id="barcode_'+data[i].product_id+'"><i class="fa fa-rupee"></i> '+data[i].purchase_price+'</td>'+  
          '</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="7" class="text-center">No Product found.</td>'+
        '</tr>';	
    }
    $('#get_customers').html(html);   
  }
  });
}

$.ajax({
    type  : 'ajax',
    url   : '?/WareHouseProduct/get_store_list',
    async : false,
    dataType : 'json',
    success : function(data){ 
      var category = '';
      category +='<option value="">All Store</option>';
      for (var i = 0; i < data.length; i++) {
        category +='<option value="'+data[i].storeId+'">'+data[i].storeName+'</option>'
      }
      $('#select_warehouse').html(category)
  }
});


$('#select_warehouse').on('change',function(){
  warehouseId = $(this). children("option:selected"). val()
  // alert(warehouseId)
  get_warehouse_product(warehouseId)
})

$('#select_product_category').change(function(){
  var category = $('#select_product_category').val(); 
  $('#select-category-error-msg-div').html('');
  if (category != '') { 
      $('#select-category-error-msg-div').html(''); 
   
  } else {
    $('#select-category-error-msg-div').html('<span class="text-danger error-msg-small">Please Select Category.</span>');  
  }
});
 
