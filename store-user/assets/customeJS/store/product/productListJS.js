get_warehouse_product();
function get_warehouse_product(id='') {
	$.ajax({
    type  : 'ajax',
    url   : '?/productList/get_store_warehouse_product/'+id,
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
            // '<td>'+
            //   '<div class="custom-control custom-switch d-inline">'+
            //     '<input type="checkbox" '+check+' onclick="gst_status('+data[i].product_id +','+data[i].product_status+')" class="custom-control-input" id="change_gst_status'+data[i].product_id +'">'+
            //     '<label class="custom-control-label" for="change_gst_status'+data[i].product_id +'"></label>'+
            //   '</div>'+
            // '</td>'+
            // '<td><a href="#" id="edit_store_'+data[i].product_id+' " onclick="edit_store('+data[i].product_id+')" class="edit-a">Edit</a></td>'+
            
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
    url   : '?/productList/getWareouses',
    async : false,
    dataType : 'json',
    success : function(data){
      // alert(JSON.stringify(data))
      var category = '';
      category +='<option value="">All warehouse</option>';
      for (var i = 0; i < data.length; i++) {
        category +='<option value="'+data[i].warehouseId+'">'+data[i].warehouseName+'</option>'
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



function edit_store(id){
  $('#edit_store').modal('show');
  $.ajax({
    type: "POST",
    url: base_url+"?/WareHouseProduct/get_single_warehouse_product/"+id, 
    dataType: "json",
    success: function(data){
var gst = '';
 gst +='<option value="">Select GST Rate</option>';
for (var i = 0; i < data.gst.length; i++) {
 if ( data.gst[i].gst_id == data.product.tax_rate) {
  gst +='<option selected value="'+data.gst[i].gst_id+'">'+data.gst[i].gst_name+'</option>';
 }else{
  gst +='<option value="'+data.gst[i].gst_id+'">'+data.gst[i].gst_name+'</option>'
 }
}
// alert(gst)

var category = '';
 category +='<option value="">Select Category</option>';
for (var i = 0; i < data.category.length; i++) {
 if ( data.category[i].category_id ==data.product.category_id) {
  category +='<option selected value="'+data.category[i].category_id+'">'+data.category[i].category_name+'</option>';
 }else{
  category +='<option value="'+data.category[i].category_id+'">'+data.category[i].category_name+'</option>'
 }
}


var unit = '';
 unit +='<option value="">Select Unit</option>';
for (var i = 0; i < data.unit.length; i++) {
 if ( data.unit[i].unit_id ==data.product.unit_id) {
  unit +='<option selected value="'+data.unit[i].unit_id+'">'+data.unit[i].unit_name+'</option>';
 }else{
  unit +='<option value="'+data.unit[i].unit_id+'">'+data.unit[i].unit_name+'</option>'
 }
}

sale_tax_price = '';
if (data.product.sale_tax_type == 'exclude') {
  sale_tax_price += '<option selected value="exclude">Exclude</option>';
  sale_tax_price += '<option value="include">Include</option>';
}else if (data.product.sale_tax_type == 'include') {
  sale_tax_price += '<option value="exclude">Exclude</option>';
  sale_tax_price += '<option selected value="include">Include</option>';
}

purchase_tax_type = '';
if (data.product.purchase_tax_type == 'exclude') {
  purchase_tax_type += '<option selected value="exclude">Exclude</option>';
  purchase_tax_type += '<option value="include">Include</option>';
}else if (data.product.purchase_tax_type == 'include') {
  purchase_tax_type += '<option value="exclude">Exclude</option>';
  purchase_tax_type += '<option selected value="include">Include</option>';
}
// alert(category)
  
  $("#sale_tax_price").html(sale_tax_price);
  $("#select_product_category").html(category);
  $("#purchase_tax_type").html(purchase_tax_type);
  $("#select_unit").html(unit);
  $("#select_tax_rate").html(gst);
/**************************************/
  $("#item_code").val(data.product.barcode);
  $("#item_name").val(data.product.product_title);
  $("#sale_price").val(data.product.sale_price);
  $("#purchase_price").val(data.product.purchase_price);
  $("#opening_quantity").val(data.product.opening_quantity);
  $("#date").val(data.product.date);
  $("#minimum_stock").val(data.product.minimum_stock);
  $('#product_id').val(data.product.product_id);

    }
  });
}


function gst_status(id,status){
  var product_status = '';
  if (status !='1') {
    product_status ='1';
  }else{
    product_status ='0';
  }
  $.ajax({
    type: "POST",
    url: base_url+"?/WareHouseProduct/change_produuct_status/"+id,
    data: {product_status: product_status},
    dataType: "json",
    success: function(data){
      if (data.status == '1') {
        $('#change_gst_status'+id).attr("onclick","gst_status("+id+","+product_status+")");
        toastr.success('product status has been updated successfully.');
      } else {
        $('#change_gst_status'+id).attr("onclick","gst_status("+id+","+status+")");
        if(status == '0'){
          $('#change_gst_status'+id). prop("checked", false);
        }else{
          $('#change_gst_status'+id). prop("checked", true);
        }
        toastr.error('Something went wrong updating the product status. Please try again.');
      }
    },
    error: function(data){
       $('#change_gst_status'+id).attr("onclick","gst_status("+id+","+status+")");
        if(status == '0'){
          $('#change_gst_status'+id). prop("checked", false);
        }else{
          $('#change_gst_status'+id). prop("checked", true);
        }
      toastr.error('Something went wrong updating the product status. Please try again.');
    } 
  });
}



function saveProducts(){
  var id =$('#product_id').val();
  var category = $("#select_product_category").val();
  var select_unit = $("#select_unit").val();
  var item_code = $("#item_code").val();
  var item_name = $("#item_name").val();
  var sale_price = $("#sale_price").val();
  var sale_tax_price = $("#sale_tax_price").val();
  var purchase_price = $("#purchase_price").val();
  var purchase_tax_type = $("#purchase_tax_type").val();
  var select_tax_rate = $("#select_tax_rate").val();
  var opening_quantity = $("#opening_quantity").val();
  var date = $("#date").val();
  var minimum_stock = $("#minimum_stock").val();

  if (category !='' && select_unit !='' && item_code !='' &&
    item_name !='' &&
    sale_price !='' &&
    sale_tax_price !='' &&
    purchase_price !='' &&
    purchase_tax_type !='' &&
    select_tax_rate !='' && 
    date !='' ) { 

     $('#cancel_add_new_product_btn').prop('disabled',true);
            $('#add_new_product_btn').prop('disabled',true);
            $('#add_new_product_btn').css('background','#1D3327');
            $('#product-error').html('<span class="text-warning error-msg-small">Please wait we are adding product details.</span>'); 

    var formdata = new FormData();
      formdata.append('category_id',category);
      formdata.append('unit_id',select_unit);
      formdata.append('barcode',item_code);
      formdata.append('product_title',item_name);
      formdata.append('sale_price',sale_price);
      formdata.append('sale_tax_type',sale_tax_price);
      formdata.append('purchase_price',purchase_price);
      formdata.append('purchase_tax_type',purchase_tax_type);
      formdata.append('tax_rate',select_tax_rate);
      formdata.append('opening_quantity',opening_quantity);
      formdata.append('date',date);
      formdata.append('minimum_stock',minimum_stock);
    $.ajax({
        type: "POST",
          url: base_url+"?/WareHouseProduct/edit_warehouse_product/"+id,
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(data) {
            if (data.status == '1') { 
              // $('#w-role').val(); 
              $('#werehousename').val('');
              $("#w-email").val('');
              $('#w-password').val('');
               $('#edit-product-error').html('');
               // $('#edit-warehouse-users').modal('hidden');
               $('#edit_store').modal('hide');
               get_warehouse_product();
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