 //store-purchase-order.js
sumMyvalue();
  function sumMyvalue(id=''){
    // alert("Hello")
    var qty = $("#qty"+id).val();
    var received_qty = $("#received_qty"+id).val();
    // console.log('qty'+qty)
    var price = $("#price"+id).val();
  
    if (qty !='' && qty !=null) {
      qty =parseFloat(qty); 
    }else{
      qty=parseFloat(0);
    }
var defference = qty - received_qty;

  var total_qty = 0;
  $(".received_qty").each(function(){
      if ($(this).val() !='') {
        // received_qty.push($(this).val());
        total_qty = parseInt(total_qty)+parseInt($(this).val());
      }
    }); 
   $("#total_qty").html(total_qty);  
  $("#defference"+id).val(defference);

  }

function save_product_order(){ 

    var sales_id = $("#purchase_id").val();  
  
  var received_qty = [];
  $(".received_qty").each(function(){
      if ($(this).val() !='') {
        received_qty.push($(this).val());
      }
    }); 
  var order_item_code = [];
  $(".order_item_code").each(function(){
      if ($(this).val() !='') {
        order_item_code.push($(this).val());
      }
    }); 

  var order_product_id = [];
  $(".order_product_id").each(function(){
      if ($(this).val() !='') {
        order_product_id.push($(this).val());
      }
    }); 
// alert(JSON.stringify(sub_amount))
// return false;
// var missing_broken_type = $("#missing_broken_type").val();
 var missing_broken_type = [];
  $(".missing_broken_type").each(function(){
      if ($(this).val() !='') {
        missing_broken_type.push($(this).val());
      }
    }); 


    var formdata = new FormData();
      formdata.append('sales_id',sales_id);
      formdata.append('received_qty',received_qty); 
      formdata.append('product_id',order_product_id);
      formdata.append('barcode',order_item_code);
      formdata.append('missing_broken_type',missing_broken_type);
    $.ajax({
        type: "POST",
          url: base_url+"?/StoreOrder/accept_warehouse_approvel_product/"+sales_id,
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(data) {
            if (data.status == '1') {  
            toastr.success('New warehouse product order has been update successfully.');
            window.location = "?/StoreOrder/accepted_order_bill/"+encodeURIComponent(btoa(sales_id));
            }else{
            toastr.error('Something went wrong while warehouse product ordering. Please try again.');

            } 
          }
      }); 



   }


/**/
function save_product_order_confirm(){ 
  $("#report-error").html('');
  $("#report-error").fadeIn();
  var flag = 0;
   $(".total_qty").each(function(){
       var MyID = $(this).attr("id"); 
        var number = MyID.match(/\d+/); 
        if ($(this).val() != $("#received_qty"+number).val()) {
          var missing = $("#missing_broken_type"+number).val();
          if (missing =='0') {
            flag = 1;
            
            return false;
          }
        }
    }); 
   if (flag ==0) { 
      $("#view_order_confirm").modal('show');
   }else{
     $("#report-error").html('<span class="text-danger">Please Select valid Resions in receive defferent quantity.</span>');
     $("#report-error").fadeOut(5000);
   }
 
}

function order_confirm(){
   $("#view_order_confirm").modal('hide');
  save_product_order();
}


