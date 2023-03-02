sumMyvalue();
  function sumMyvalue(id=''){
    // alert("Hello")
    var qty = $("#qty"+id).val();
    // console.log('qty'+qty)
    var price = $("#price"+id).val();
    // console.log('price'+price)
    var discount = 0;//$("#discount"+id).val();
    // console.log('discount'+discount)
    var discount_price = 0;//$("#discount_price"+id).val();
    // console.log('discount_price'+discount_price)
    var main_gst = $("#main_gst"+id).val();
    // console.log('main_gst'+main_gst)
    var gst_price = $("#gst_price"+id).val();
     // console.log('gst_price'+gst_price)

     var tax_type = 0;//$("#tax_type").val();
    var total =0;
  
    if (qty !='' && qty !=null) {
      qty =parseFloat(qty); 
    }else{
      qty=parseFloat(0);
    }
    if (price !='' && price !=null) {
      price =parseFloat(price);
      price = qty*price;
    }else{
      price=parseFloat(0);
       price = qty*price;
    }
   /* if (discount !='' && discount !=null) {
      discount =parseFloat(discount);
      discount_price = (price * discount) / 100;
      discount_price = parseFloat(discount_price);
    }else{
      discount=parseFloat(0);
      discount_price = (price * discount) / 100;
      discount_price = parseFloat(discount_price);
    }*/
   /* if (discount_price !='' && discount_price !=null) {
      discount_price =parseFloat(discount_price);
      discount_price = (price * discount) / 100;
    }else{
      discount_price=parseFloat(0);
       discount_price = (price * discount) / 100;
    }*/
    if (main_gst !='' && main_gst !=null) {
      main_gst =parseFloat(main_gst);
      gst_price = (price * main_gst) / 100;
      gst_price = parseFloat(gst_price); 
    }else{
      main_gst=parseFloat(0);
      gst_price = (price * main_gst) / 100;
      gst_price = parseFloat(gst_price); 
    }
  /*  if (gst_price !='' && gst_price !=null) {
      gst_price =parseFloat(gst_price);
    }else{
      gst_price=parseFloat(0);
    } */
    if (tax_type == 0) {
      total =  price;
    }else{

      total =  price+gst_price;
    }

    // total = total - discount_price;
    // console.log(total);
    $("#total_price"+id).val(parseFloat(total).toFixed(2));
    // $("#discount_price"+id).val(discount_price);
  $("#gst_price"+id).val(parseFloat(gst_price).toFixed(2));

    total_amounts = 0;
   $('.sub_amount').each(function() {
    if ($(this).val() !='' && $(this).val() !=null) {
        total_amounts += parseFloat($(this).val());
    }
    });

   var total_qty =0;
   $(".total_qty").each(function() {
    if ($(this).val() !='' && $(this).val() !=null) {
        total_qty += parseInt($(this).val());
    }
    });

 
   $("#main_total").html(parseFloat(total_amounts).toFixed(2));
   $("#main_total_amount").val(parseFloat(total_amounts).toFixed(2));
   // $("#order_discounted_price").val(subtotal);
   $("#total_qty").html(total_qty); 
  }

document.getElementById("tax_type").addEventListener("change", tax_type); 
  function tax_type(){
    $(".hidden_row").each(function(){
      if ($(this).val()==0) {
        sumMyvalue();
      }else{
        sumMyvalue($(this).val());
      }
    });
  } 

  /*  var xhReq = new XMLHttpRequest();
    xhReq.open("POST", "?/Vendor/VendorView", false);
    xhReq.send(null);
    var serverResponse = xhReq.responseText;  */
   function get_autocomplete(id) { 
    $.ajax({
        type: "POST",
          url: base_url+"?/StoreOrder/get_state_for_warehouse/"+id, 
          dataType: 'json', 
          success: function(data) {
            // alert(data.state)
          $("#bill_state").val(data.state);  
          }
      }); 
   }

   function click_here(){
      // alert('Hello, this is button click addEventListener')
      $("#add_new_vendor").modal('show');
   }

   function view_product_modal(){

      $('#select-category-error-msg-div').html(''); 
     $('#item-name-error-msg-div').html('');
     $('#item-code-error-msg-div').html('');
      $('#sale-price-error-msg-div').html('');
      $('#purchase-price-error-msg-div').html('');
     $('#opening-quantity-error-msg-div').html('');
     $('#date-error-msg-div').html('');
      $('#minimum-stock-error-msg-div').html('');
      $('#select_unit-error-msg-div').html(''); 
      $('#sale-tax-type-error-msg-div').html(''); 
      $('#select-tax-rate-error-msg-div').html(''); 
      $('#item-name-error-msg-div').html('');

    $("#add_new_product_modal").modal('show');
   }



   function paid_amounts(){
   var main_total_amount= $("#main_total_amount").val();
   var paid_price= $("#paid_price").val();
   var total = parseFloat(main_total_amount).toFixed(2) - parseFloat(paid_price).toFixed(2);
   $("#balance_total").html(total);
   }


   function save_product_order(){
    // var party_id = $("#bill_state_id").val();
    var party = $("#search_field_warehouse").val();
    var bill_date = $("#bill_date").val();
    var bill_state = $("#bill_state").val();
    var tax_type = 0;//$("#tax_type").val();
    var payment_type = $("#payment_type").val();
    var reference_no = $("#reference_no").val();
    var order_description = $("#order_description").val();
    var main_total_amount = $("#main_total_amount").val();
    var paid_price = $("#paid_price").val();


 
  var item_name = [];
    $(".order_item_name").each(function(){
      if ($(this).val() !='') {
        item_name.push($(this).val());
      }
    });

  var total_qty = [];
    $(".total_qty").each(function(){
      if ($(this).val() !='') {
        total_qty.push($(this).val());
      }
    });

  var select_unit = [];
   // $(".select_unit :selected").each(function(){
      // if ($(this).val() !='') {
        //select_unit.push($(this).val());
      /// }
  //  });

  var price = [];
    $(".price").each(function(){
      if ($(this).val() !='') {
        price.push($(this).val());
      }
    });

  var discount = [];
   /* $(".discount").each(function(){
      if ($(this).val() !='') {
        discount.push($(this).val());
      }
    });*/

  var discount_price = [];
  /*  $(".discount_price").each(function(){
      if ($(this).val() !='') {
        discount_price.push($(this).val());
      }
    });*/
  var main_gst = [];
    $(".main_gst").each(function(){
      if ($(this).val() !='') {
        main_gst.push($(this).val());
      }
    });
  var gst_price = [];
    $(".gst_price").each(function(){
      if ($(this).val() !='') {
        gst_price.push($(this).val());
      }
    });
  var sub_amount = [];
    $(".sub_amount").each(function(){
      if ($(this).val() !='') {
        sub_amount.push($(this).val());
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


    var formdata = new FormData();
      // formdata.append('party_id',party_id);
      formdata.append('party_id',party);
      formdata.append('product_id',order_product_id)
      formdata.append('bill_date',bill_date);
      formdata.append('bill_state',bill_state);
      formdata.append('tax_type',tax_type);
      formdata.append('payment_type',payment_type);
      formdata.append('reference_no',reference_no);
      formdata.append('order_description',order_description);
      formdata.append('main_total_amount',main_total_amount);
      formdata.append('paid_price',paid_price);
      formdata.append('item_name',item_name);
      formdata.append('total_qty',total_qty);
      /* for the json data */
      formdata.append('select_unit',select_unit); 
      formdata.append('price',price);
      formdata.append('discount',discount);
      formdata.append('discount_price',discount_price);
      formdata.append('main_gst',main_gst);
      formdata.append('gst_price',gst_price);
      formdata.append('sub_amount',sub_amount);
      $('#save-product-order').prop('disabled',true);
$("#add_new_product_btn").prop('disabled',true);
    $.ajax({
        type: "POST",
          url: base_url+"?/ReturnOrder/add_return_purchase_order/",
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(data) {
            if (data.status == '1') {  
            toastr.success('New product order has been update successfully.');
            window.location = "?/ReturnOrder/return_order_bill/"+encodeURIComponent(btoa(data.purchase_id));
            }else{
              $('#save-product-order').prop('disabled',false);
$("#add_new_product_btn").prop('disabled',false);
            toastr.error('Something went wrong while product ordering. Please try again.');

            } 
          }
      }); 



   }

 
/* find data with barcode value */

function get_barcode_value(id=''){
  var barcode = $("#item_code"+id).val();

  if (barcode != '') {
      $.ajax({
      type: "POST",
        url: base_url+"?/StoreOrder/get_warehouse_product_value",
        data:{barcode:barcode},
        dataType: 'json', 
        success: function(data) {
          if (typeof data.barcode) {
          $( "#item_name"+id ).val( data.product_title );
          // $("#item_code"+id).val(data.barcode);
          $("#order_product_id"+id).val(data.product_id);
          $( "#qty"+id ).val(1);
          $( "#pqty"+id ).val(data.quantity);
          $( "#price"+id ).val( data.purchase_price ); 
          $( "#mrp_price"+id ).val( data.product_mrp ); 
          $('#select_unit'+id).val(data.unit_id).trigger('change');
          $('#main_gst'+id).val(data.tax_rate).trigger('change');
          $(".add-new").click();
          sumMyvalue(id)
        }else{
            sumMyvalue(id) 
        }
        }
    });
  }else{
    sumMyvalue(id)
  }
}


$('#payment_type').on('change',function(){
  // alert("successfully")
  var value = $(this).children("option:selected").val();
  if(value == 'Cash'){
    $('#reference_no').hide()
  }else{
    $('#reference_no').show()
  }
})
 
$('#paid_price').on('keyup',function(){
  var paidValue = $('#paid_price').val();
  // alert(paidValue)
  var total_amount = $('#main_total_amount').val()
  if(parseFloat(paidValue) > parseFloat(total_amount)){
    $('#paid_price').val(paidValue.slice(0,-1));
    $('#paid-warnign-msg').html('<span class="text-danger error-msg-small">Enterd amount should not be more then total amount.</span>')
  }else{
    $('#paid-warnign-msg').html('')
  }
})

 
/**/
function save_product_order_confirm(){
     var main_total_amount = $("#main_total_amount").val();
     var paid_price = $("#paid_price").val();
     if (main_total_amount > 0 && paid_price > 0) {
       $("#view_order_confirm").modal('show');
    }else{ 
      $("#price-error").html("<span class='text-danger'>Please Enter Valid Bill Details.</span>");
    }
}

function order_confirm(){
  save_product_order();
}