var fadeout_time = 5000;
var alphabets_only = /^[A-Za-z ]+$/;
var alphanumeric_only = /^[a-zA-Z0-9]+$/;
var discount_percentage_max_value = 100;
var discount_amount_max_value = 99999;
var discount_amount_max_value_length = 5;
var min_purchase_amount_max_value_length = 5;
var min_purchase_amount_max_value = 99999; 
var reg = /^[0-9]+$/;
var isCustomerNew = '';
// var add_new_item_i = 0;
 

function sumMy_value(id=''){
 var qty = $("#qty_"+id).val();
 $("#qty"+id).val(qty);
 sumMyvalue(id)


  var p_price = $("#perfect_price_"+id).val();
  var price = 0;
  price = $("#price_"+id).val();
  if (parseFloat(p_price) < parseFloat(price)) {
    $("#price_"+id).val(p_price);
    $("#price-error").html('<span class="text-danger text-center w-100">Enter Valid Price</span>');
  } else {
    $("#price-error").html('');
  }
  var main_gst = $("#main_gst_"+id).val();
  var gst_price = $("#gst_price_"+id).val();
  var tax_type = 0;
  var total =0;
  if (qty !='' && qty !=null) {
    qty =parseFloat(qty); 
  } else {
    qty=parseFloat(0);
  }
  var price1 = $("#price_"+id).val();
  if (price !='' && price !=null) {
    price1 =parseFloat(price1);
    price1 = qty*price1;
  } else {
    price1=parseFloat(0);
    price1 = qty*price1;
  }
  if (main_gst !='' && main_gst !=null) {
    main_gst =parseFloat(main_gst);
    gst_price = (price1 * main_gst) / 100;
    gst_price = parseFloat(gst_price); 
  } else {
    main_gst=parseFloat(0);
    gst_price = (price1 * main_gst) / 100;
    gst_price = parseFloat(gst_price); 
  }
  total =  price1; 

  $("#total_price_"+id).val(total.toFixed(2));
  $("#gst_price_"+id).val(gst_price.toFixed(2));
  

}

sumMyvalue();
 function sumMyvalue(id='') {
  var qty = $("#qty"+id).val();
  var total_quantity_count = 0;
  if ($('.total_qty').val() != undefined) {
    $('.total_qty').each(function() {
      if ($(this).val() !='' && $(this).val() !=null) {
        total_quantity_count += parseInt($(this).val());
      }
    });
  }
  
  var p_price = $("#perfect_price"+id).val();
  var price = 0;
  price = $("#price"+id).val();
  if (parseFloat(p_price) < parseFloat(price)) {
    $("#price"+id).val(p_price);
    $("#price-error").html('<span class="text-danger text-center w-100">Enter Valid Price</span>');
  } else {
    $("#price-error").html('');
  }
  var main_gst = $("#main_gst"+id).val();
  var gst_price = $("#gst_price"+id).val();
  var tax_type = 0;
  var total =0;
  if (qty !='' && qty !=null) {
    qty =parseFloat(qty); 
  } else {
    qty=parseFloat(0);
  }
  var price1 = $("#price"+id).val();
  if (price !='' && price !=null) {
    price1 =parseFloat(price1);
    price1 = qty*price1;
  } else {
    price1=parseFloat(0);
    price1 = qty*price1;
  }
  if (main_gst !='' && main_gst !=null) {
    main_gst =parseFloat(main_gst);
    gst_price = (price1 * main_gst) / 100;
    gst_price = parseFloat(gst_price); 
  } else {
    main_gst=parseFloat(0);
    gst_price = (price1 * main_gst) / 100;
    gst_price = parseFloat(gst_price); 
  }
  total =  price1;
  var applied_coupon_type = $('#applied_coupon_type').val();
  var coupon_code = $('#coupon_code').val();
  var order_discounted_percentage = $('#order_discounted_percentage').val(); 

  $("#total_price"+id).val(total.toFixed(2));
  $("#gst_price"+id).val(gst_price.toFixed(2));
  
  total_amounts = 0;
  $('.sub_amount').each(function() {
    if ($(this).val() !='' && $(this).val() !=null) {
      total_amounts += parseFloat($(this).val());
    }
  });
  $('#total_amount').val(total_amounts.toFixed(2));
  var subtotal = 0;
  if (applied_coupon_type == 1 && order_discounted_percentage !=0) { 
    subtotal = parseFloat(total_amounts).toFixed(2) - parseFloat(order_discounted_percentage).toFixed(2);
  } else if(applied_coupon_type == 0 && order_discounted_percentage !=0) {
    subtotal_total = (parseFloat(total_amounts).toFixed(2) * parseFloat(order_discounted_percentage)) / 100;
    subtotal = parseFloat(total_amounts).toFixed(2) - parseFloat(subtotal_total).toFixed(2);
  } else { 
    subtotal = total_amounts;
  }
  
  var point = $("#customer_points").html();
  var cust_point = $('#customer_point_apply').val();
  var threshold_balance = $("#threshold_balance").val();
  var threshold_bill_amount = $("#threshold_bill_amount").val();
  if (parseFloat(point) > parseFloat(threshold_balance) && parseFloat(threshold_bill_amount) < subtotal) {
    $("#point_button").show();
  } else {
     $("#point_button").hide();
  }

  var subtotal_amount = 0
  if (cust_point != 0) {
    if (cust_point > subtotal) {
      var subtotal_amount_1 = parseFloat(cust_point) - subtotal;
      $("#customer_points").html(subtotal_amount_1);
      $("#customer_point_less").val(subtotal_amount_1);
      $("#diduct_value").html("<label class='col-md-4 col-form-label text-right ln-ht-25'><strong>Points Redeemed</strong></label><div class='col-md-8 text-right'><span class='text-danger text-right'><strong> - "+subtotal+"</strong></span></div>");
    } else {
      subtotal_amount = subtotal - parseFloat(cust_point);
      $("#customer_points").html(0);
      $("#customer_point_less").val(0);
      $("#diduct_value").html("<label class='col-md-4 col-form-label text-right ln-ht-25'><strong>Points Redeemed</strong></label><div class='col-md-8 text-right'><span class='text-danger text-right'><strong> - "+cust_point+"</strong></span></div>");
    }
  } else {
    subtotal_amount = subtotal;
  }

  $("#main_total").html(total_amounts.toFixed(2));
  $("#main_total_amount").val(subtotal_amount.toFixed(2));
  $("#order_discounted_price").val(subtotal_amount.toFixed(2));
  $('#total_quantity_count').val(total_quantity_count);
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
   var total = parseFloat(main_total_amount) - parseFloat(paid_price);
   $("#balance_total").html(total);
   }



$('#customer_name').keyup(function(){
  var customer_name = $('#customer_name').val();
  if (customer_name != '') {
    if(!isNaN(customer_name) || !alphabets_only.test(customer_name)) {
      $('#customer_name-error-msg-div').html('<span class="text-danger error-msg">Name should only have alphabets.</span>');
      $('#customer_name').val(customer_name.slice(0,-1));
    } else {
      $('#customer_name-error-msg-div').html('');
    }
  } else {
    $('#customer_name-error-msg-div').html('<span class="text-danger error-msg-small">Please enter your name.</span>');
  }
});

$('#customer_city').keyup(function(){
  var customer_city = $('#customer_city').val();
  if (customer_city != '') {
    if(!isNaN(customer_city) || !alphabets_only.test(customer_city)) {
      $('#customer_city-error-msg-div').html('<span class="text-danger error-msg">City name should only have alphabets.</span>');
      $('#customer_city').val(customer_city.slice(0,-1));
    } else {
      $('#customer_city-error-msg-div').html('');
    }
  } else {
    $('#customer_city-error-msg-div').html('<span class="text-danger error-msg-small">Please enter your city name.</span>');
  }
});


$('#contact_no').keyup(function(){
  var contact_no = $('#contact_no').val();
  if (contact_no != '') {
    if(contact_no.length > 10) {
      $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
      $('#contact_no').val(contact_no.slice(0,10));
    } else if (isNaN(contact_no)) {
      $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
      $('#contact_no').val(contact_no.slice(0,-1));
    } else {
      $('#address-phone-number-error-msg-div').html('');
    }
  } else {
    $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Please enter a valid phone number</span>');
  }
});

$('#bill_state').change(function(){
  var bill_state = $('#bill_state').val();
  if (bill_state != '') {
    $('#state-error-msg-div').html('');
  } else {
    $('#state-error-msg-div').html('<span class="text-danger error-msg-small">Please select a state.</span>');
  }
});

$('#customer_pincode').keyup(function(){
    var customer_pincode = $('#customer_pincode').val();
       var reg = /^[0-9]+$/;
    if (customer_pincode != '') {
      if (customer_pincode.length > 7) {
        $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Pincode cannot be more than 7 digits.</span>');
          $('#pincode').val(customer_pincode.slice(0,7));
      }else if(!reg.test(customer_pincode)){
        $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Please Enter Digit only.</span>');
        $('#customer_pincode').val('');
      } else {
        $('#pincode-error-msg-div').html('');
      }
    } else {
      $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the pincode</span>');
    }
});

function refralCode(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   var d = new Date();

  var month = d.getMonth()+1;
  var day = d.getDate();
  // var year = d.getFullYear();
    result = "Ro"+result+month+""+day
    return result;
}



   function save_product_order(){
    // var party_id = $("#bill_state_id").val();
    // var party = $("#search_field_warehouse").val();
    /* user detail data */
    var sales_id = $("#sales_id").val();
    var customer_name = $("#customer_name").val();
    var contact_no = $("#contact_no").val();
    var customer_address = $("#customer_address").val();
    var customer_city = $("#customer_city").val();
    var customer_pincode = $("#customer_pincode").val(); 
    /*  */
    var bill_date = $("#bill_date").val();
    var bill_state = $("#bill_state").val();
    var tax_type = 0;//$("#tax_type").val();
    var payment_type = $("#payment_type").val();
    var reference_no = $("#reference_no").val();
    var order_description = $("#order_description").val();
    var main_total_amount = $("#main_total_amount").val();
    var paid_price = $("#paid_price").val();
     var customer_point_less = $("#customer_point_less").val();


 
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
        // select_unit.push($(this).val());
      // }
    // });

  var price = [];
    $(".price").each(function(){
      if ($(this).val() !='') {
        price.push($(this).val());
      }
    });

  var discount = [];
/*    $(".discount").each(function(){
      if ($(this).val() !='') {
        discount.push($(this).val());
      }
    });*/

  var discount_price = [];
/*    $(".discount_price").each(function(){
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
    var mrp_price = [];
      $(".mrp_price").each(function() {
    if ($(this).val() !='' && $(this).val() !=null) {
        mrp_price.push($(this).val());
    }
    });
// alert(JSON.stringify(sub_amount))
// return false;
 var applied_coupon_type = $('#applied_coupon_type').val();
   var coupon_code = $('#coupon_code').val();
    var order_discounted_percentage = $('#order_discounted_percentage').val(); 

    var order_discounted_price = $("#order_discounted_price").val();

        // var point = $("#customer_points").html();
  var cust_point = $('#customer_point_apply').val(); 
  var referral_code = $("#referrel_code").val();
var invoice_type = $("#invoice_type").val();
    var formdata = new FormData();
      formdata.append('sales_id',sales_id);
      formdata.append('sales_type',invoice_type);
       formdata.append('point_less',customer_point_less);
      formdata.append('referral_code',referral_code);
      formdata.append('point',cust_point);
      formdata.append('mrp_price',mrp_price);
      formdata.append('applied_coupon_type',applied_coupon_type);
      formdata.append('coupon_code',coupon_code);
      formdata.append('order_discounted_percentage',order_discounted_percentage);
      formdata.append('order_discounted_price',order_discounted_price);
      
      formdata.append('product_id',order_product_id);
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
      /*user details data */
      formdata.append('isCustomerNew',isCustomerNew);
      formdata.append('refralCode',refralCode(4));
      formdata.append('customer_name',customer_name);
      formdata.append('contact_no',contact_no);
      formdata.append('customer_address',customer_address);
      formdata.append('customer_city',customer_city);
      formdata.append('customer_pincode',customer_pincode);

      /* for the json data */
      formdata.append('select_unit',select_unit); 
      formdata.append('price',price);
      formdata.append('discount',discount);
      formdata.append('discount_price',discount_price);
      formdata.append('main_gst',main_gst);
      formdata.append('gst_price',gst_price);
      formdata.append('sub_amount',sub_amount);

      // if (customer_name !='' && contact_no !='' && contact_no.length == 10) {
        $('#save-product-order').prop('disabled',true);
$("#add_new_product_btn").prop('disabled',true);
         
    $.ajax({
        type: "POST",
          url: base_url+"?/StoreBilling/edit_store_sales_billing/",
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(data) {
            if (data.status == '1') {  
            toastr.success('New product order has been update successfully.');

            window.location = base_url+"?/StoreBilling/edit_print_invoice/"+encodeURIComponent(btoa(sales_id));
            }else{
              $('#save-product-order').prop('disabled',false);
$("#add_new_product_btn").prop('disabled',false);
            toastr.error('Something went wrong while product ordering. Please try again.');

            } 
          }
      }); 
  // }else{
    // alert("Enter Name and mobile number")
     /* if (customer_name != '') {
        if(!isNaN(customer_name) || !alphabets_only.test(customer_name)) {
            $('#customer_name-error-msg-div').html('<span class="text-danger error-msg">Name should only have alphabets.</span>');
            $('#customer_name').val(customer_name.slice(0,-1));
          } else {
            $('#customer_name-error-msg-div').html('');
          }
        } else {
          $('#customer_name-error-msg-div').html('<span class="text-danger error-msg-small">Please enter your name.</span>');
        }

         if (contact_no != '') {
          if(contact_no.length > 10) {
            $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
            $('#contact_no').val(contact_no.slice(0,10));
          } else if (contact_no.length < 10) {
            $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
            // $('#contact_no').val(contact_no.slice(0,-1));
          } else {
            $('#address-phone-number-error-msg-div').html('');
          }
        } else {
          $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Please enter a valid phone number</span>');
        }


  }*/



   }

 
  $("#invoice_type").change(function(){
    $("#invoice_type").prop('disabled',true);
  });

 
/* find data with barcode value */

function get_barcode_value(id=''){
  var barcode = $("#item_code"+id).val();
var invoice_type = $("#invoice_type").val();
  if (barcode != '') {
      $.ajax({
      type: "POST",
        url: base_url+"?/StoreOrder/get_store_product_value",
        data:{barcode:barcode},
        dataType: 'json', 
        success: function(data) {
          if (data !=null) {
          $( "#item_name"+id ).val(data.product_title );
          // $("#item_code"+id).val(data.barcode);
          $("#order_product_id"+id).val(data.store_product_id);
          $( "#qty"+id ).val(1);
          $( "#pqty"+id ).val(data.quantity);
          // $( "#price"+id ).val( data.sale_price ); 
          $( "#mrp_price"+id ).val( data.mrp_price ); 
          // $("#perfect_price"+id).val(data.sale_price);
                    
         if (invoice_type =='1') { 
            $( "#price"+id ).val(data.wholesale_price); 
            $("#perfect_price"+id).val(data.wholesale_price);
         }else{
            $( "#price"+id ).val(data.sale_price); 
            $("#perfect_price"+id).val(data.sale_price);
         }
          // $('#select_unit'+id).val(data.unit_id).trigger('change');
          $('#main_gst'+id).val(data.tax_rate).trigger('change');
          $( "#qty"+id ).focus();
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

function valid_referral(){
  var contact_no = $("#contact_no").val(); 
  var referral = $("#referral").val();
  if (contact_no !='' && referral !='') {
     $.ajax({
      type: "POST",
        url: base_url+"?/storeBilling/check_valid_referal_code/"+contact_no,
        data:{contact_no:contact_no,referral:referral},
        dataType: 'json', 
        success: function(data) {
          if (data.status =='1') {
            $("#referrel_code").val(referral)
             $("#error-referral").html('<span class="text-success">Valid referral.</span>');
          }else{
            $("#error-referral").html('<span class="text-danger">Please Enter Valid referral Code</span>');
            $("#referral").val('');
          }
        }
      });
  }else{
    // alert("enter contact number")
    $("#error-referral").html('<span class="text-danger">Enter Mobile Number and name.</span>');
  }
}

function apply_points(){
  var point = $("#customer_points").html();
  $('#customer_point_apply').val(parseFloat(point));
  sumMyvalue();
}


$('#contact_no').on('keyup blur',function(){
  
  var contact_no = $(this).val();

  if(contact_no.length == 10){ 

    $.ajax({
      type: "POST",
        url: base_url+"?/storeBilling/customerData/"+contact_no,
        dataType: 'json', 
        success: function(data) {   
          if(data.status != '0'){
            isCustomerNew = 'yes';
            $('#customer_name').val(data.customer.name)
            $('#customer_points').html(data.customer.balance)
            $('#phone-number-info-msg-div').html('<span class="text-danger error-msg-small">This is an old customer</span>')   
          }else{
            isCustomerNew = 'no';
            $('#customer_name').val('')
            $('#phone-number-info-msg-div').html('<span class="text-danger error-msg-small">This is a new customer</span>')
          }
        }
    });


  }

});



$('#payment_type').on('change',function(){

  var value = $(this).children("option:selected").val();
  if(value == 'Cash'){
    $('#reference_no').hide()
  }else{
    $('#reference_no').show()
  }
})
 

// $('#main_total_amount')
$('#paid_price').on('keyup blur',function(){
  var paidValue = $(this).val();
  // alert(paidValue)
  var total_amount = $('#main_total_amount').val()
  if(parseFloat(paidValue) > parseFloat(total_amount)){
    $('#paid_price').val(paidValue.slice(0,-1));
    $('#paid-warnign-msg').html('<span class="text-danger error-msg-small">Enterd amount should not be more then total amount.</span>')
  }else{
    $('#paid-warnign-msg').html('')
  }

})

function valid_coupon(){
  var coupon = $('#CouponCode').val();
  if (coupon != '') {
    $.ajax({
      type: "POST",
      url: base_url+'?/coupon/get_valid_coupon/'+coupon, 
      dataType: "json",
      success: function(data){ 
        // alert(data)
        if (data.status == '1' && (data.coupon_data.coupon_category_name == 0 || data.coupon_data.coupon_category_name == 1)) {
          $('#applied_coupon_type').val(data.coupon_data.coupon_category_name);
          $('#coupon_code').val(coupon);
          $('#order_discounted_percentage').val(data.coupon_data.coupon_discount); 

            $('#CouponCode').prop('disabled',true);
            $('#valid_coupon').prop('disabled',true);
            $('#applied-coupon-div').html('<a class="remove-coupon" onclick="remove_coupon()">Remove</a>')
            
            
            toastr.success('Successfully applied promo.');
          sumMyvalue();
        } else {
         toastr.error('This Coupon is not valid.');
        }
      } 
    });
  } else{
    toastr.warning('Please enter a coupon code.');
  } 
}

function remove_coupon() { 
  $('#applied_coupon_type').val(0);
  $('#coupon_code').val(0);
  $('#order_discounted_percentage').val(0); 
   $('#applied-coupon-div').html(' <button class="btn btn-info" onclick="valid_coupon()" >apply</button>')
  $('#CouponCode').prop('disabled',false);
  $('#valid_coupon').prop('disabled',false);
  $('#CouponCode').val(''); 
  sumMyvalue();
}


/**/
function save_product_order_confirm(id){
   $("#price-error").fadeIn();
  $("#view_order_confirm").modal('hide');
       var customer_name = $("#customer_name").val();
      var contact_no = $("#contact_no").val();
      var customer_address = $("#customer_address").val();
      var customer_city = $("#customer_city").val();
      var customer_pincode = $("#customer_pincode").val(); 
     var main_total_amount = $("#main_total_amount").val();
     var paid_price = $("#paid_price").val();
     var payment_type = $("#payment_type").val();
 
     if (contact_no != '') {
       if (customer_name !='' && contact_no !='' && contact_no.length == 10) {

      }else{

        if (customer_name != '') {
        if(!isNaN(customer_name) || !alphabets_only.test(customer_name)) {
            $('#customer_name-error-msg-div').html('<span class="text-danger error-msg">Name should only have alphabets.</span>');
            $('#customer_name').val(customer_name.slice(0,-1));
          } else {
            $('#customer_name-error-msg-div').html('');
          }
        } else {
          $('#customer_name-error-msg-div').html('<span class="text-danger error-msg-small">Please enter your name.</span>');
        }

         if (contact_no != '') {
          if(contact_no.length > 10) {
            $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
            $('#contact_no').val(contact_no.slice(0,10));
          } else if (contact_no.length < 10) {
            $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
            // $('#contact_no').val(contact_no.slice(0,-1));
          } else {
            $('#address-phone-number-error-msg-div').html('');
          }
        } else {
          $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Please enter a valid phone number</span>');
        }

        return false;
      }
     }

     
     if (main_total_amount > 0) {
     if (id !=3 && paid_price <= 0 && payment_type !='Credit') {
      alert('true')
       $("#price-error").html("<span class='text-danger'>Please Enter Valid Bill Details.</span>").fadeOut(3000);
       return false;
     } 

     if ( payment_type =='Credit' && contact_no.length < 10) {

       if (customer_name != '') {
        if(!isNaN(customer_name) || !alphabets_only.test(customer_name)) {
            $('#customer_name-error-msg-div').html('<span class="text-danger error-msg">Name should only have alphabets.</span>');
            $('#customer_name').val(customer_name.slice(0,-1));
          } else {
            $('#customer_name-error-msg-div').html('');
          }
        } else {
          $('#customer_name-error-msg-div').html('<span class="text-danger error-msg-small">Please enter your name.</span>');
        }

         if (contact_no != '') {
          if(contact_no.length > 10) {
            $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
            $('#contact_no').val(contact_no.slice(0,10));
          } else if (contact_no.length < 10) {
            $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
            // $('#contact_no').val(contact_no.slice(0,-1));
          } else {
            $('#address-phone-number-error-msg-div').html('');
          }
        } else {
          $('#address-phone-number-error-msg-div').html('<span class="text-danger error-msg-small">Please enter a valid phone number</span>');
        }

        return false;
     }


       $("#view_order_confirm").modal('show');
    }else{ 
      $("#price-error").html("<span class='text-danger'>Please Enter Valid Bill Details.</span>");
    }
}

function order_confirm(){
   $("#view_order_confirm").modal('hide');
  save_product_order();
}


function remove_selected_item(i) {
  $('#tr-item-'+i).remove();
  sumMyvalue();
}

function remove_selected__item(i){
  $('#tr-item-'+i).remove();
  $('#tr-item_'+i).remove();
  sumMyvalue();
}


$('#add-new-item-btn').on('click', function() {
  var selected_item_name = $('#selected-item-name').val();
  var selected_item_product_id = $('#selected-item-product-id').val();
  var is_contact = $('input[name="is_contact"]:checked').val();

  if (selected_item_product_id != '') {
    var order_product_id_array = [];
    if ($('.order_product_id').val() != undefined) {
      $('.order_product_id').each(function() {
        if ($(this).val() != '') {
          order_product_id_array.push($(this).val());
        }
      }); 
    }

    if (jQuery.inArray(selected_item_product_id, order_product_id_array) === -1) {
      $('#selected-item-name-error-msg-div').html('');
      $.ajax({
        type: "POST",
        url: base_url+"?/StoreBilling/add_new_item_for_billing",
        data: {
          selected_item_product_id : selected_item_product_id
        },
        dataType: 'json',
        success: function(data) {
          var html = '';
          html += '<tr id="tr-item-'+add_new_item_i+'">';
          html += '<td class="newtwo-bx">';
          html += '<input type="hidden" class="hidden_row" value="0">';
          html += '<input type="hidden" class="order_product_id" name="order_product_id" id="order_product_id'+add_new_item_i+'" value="'+selected_item_product_id+'">';
          html += '<input type="hidden" class="order_item_name" id="item_name'+add_new_item_i+'" value="'+data.product_title+'">';
          html += '<span>'+data.product_title+'</span>';
          html += '</td>';
          html += '<td>';
          html += '<input type="hidden" class="order_item_code" id="item_code'+add_new_item_i+'" value="'+data.barcode+'">';
          html += '<span>'+data.barcode+'</span>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control bg-white tbl-fld total_qty"  min="0" oninput="this.value = Math.abs(this.value)" type="number" id="qty'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" placeholder="1" value="1">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control tbl-fld ptotal_qty" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,\'\')" readonly  type="text" id="pqty'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" value="'+data.quantity+'">';
          html += '</div>';
          html += '</td>';
          html += '<td class="d-none">';
          html += '<div class="form-group">';
          html += '<select class="form-control bg-white tbl-fld2 select_unit" onchange="sumMyvalue('+add_new_item_i+')" id="select_unit'+add_new_item_i+'">';
          html += '<option value="0">None</option>';
          html += '</select>';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control tbl-fld mrp_price" id="mrp_price'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" type="text" placeholder="25" readonly value="'+data.mrp_price+'">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          var price_per_unit = 0;
          if (is_contact == 1) {
            price_per_unit = data.wholesale_price;
          } else {
            price_per_unit = data.sale_price;
          }
          html += '<div class="form-group">';
          html += '<input type="hidden" name="perfect_price" id="perfect_price">';
          html += '<input class="form-control bg-white tbl-fld price" readonly id="price'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')"  min="0" oninput="this.value = Math.abs(this.value)" type="number" placeholder="0" value="'+price_per_unit+'">';                          
          html += '</div>';
          html += '</td>';
          html += '<td class="d-none">';
          html += '<div class="form-group">';
          html += '<input class="form-control tbl-fld discount'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" id="discount'+add_new_item_i+'" type="text">';
          html += '</div>';
          html += '</td>';
          html += '<td class="d-none">';
          html += '<div class="form-group">';
          html += '<input class="form-control tbl-fld discount_price" onkeyup="sumMyvalue('+add_new_item_i+')" id="discount_price'+add_new_item_i+'" type="text">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input type="text" class="form-control tbl-fld2 main_gst" value="'+data.tax_rate+'" readonly onkeyup="sumMyvalue('+add_new_item_i+')" id="main_gst'+add_new_item_i+'"> ';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control bg-white tbl-fld gst_price" onkeyup="sumMyvalue('+add_new_item_i+')" type="text" id="gst_price'+add_new_item_i+'" placeholder="1.25">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control bg-white tbl-fld sub_amount" type="text" onkeyup="sumMyvalue('+add_new_item_i+')" id="total_price'+add_new_item_i+'" placeholder="26.25">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<a class="delete" title="Delete" onclick="remove_selected_item('+add_new_item_i+')"><i class="fa fa-trash text-danger"></i></a>';
          html += '</td>';
          html += '</tr>';
          $('#tbody-bill').append(html);
          $('#selected-item-name').val('');
          $('#selected-item-product-id').val('');
           $("#qty"+add_new_item_i).focus();
          sumMyvalue(add_new_item_i);
          add_new_item_i++;
        }
      }); 
    } else {
      $('#selected-item-name').val('');
      $('#selected-item-product-id').val('');
      
      var id = 0;
      $('.order_product_id').each(function() {
        if ($(this).val() == selected_item_product_id) {
          var MyID = $(this).attr("id"); 
          id = MyID.match(/\d+/);  
          if (id == '' || id == null) {
            id = 0;
          }
          var item_qty = $('#qty'+id).val();
          $('#qty'+id).val(parseInt(item_qty) + 1);
           $("#qty"+add_new_item_i).focus();
        }
      });
      sumMyvalue(id);
      $('#selected-item-name-error-msg-div').html('');
      // $('#selected-item-name-error-msg-div').html('<span class="text-danger error-msg-small">'+selected_item_name+' is already selected. Please select a product</span>');
    }
  } else {
    $('#selected-item-name').val('');
    $('#selected-item-product-id').val('');
    $('#selected-item-name-error-msg-div').html('<span class="text-danger error-msg-small">Please enter a product name</span>');
  }
});




function view_all_items_modal() {
  // alert(html)
  $('#all-items-list').html(''); 
  $("#view-all-items-modal").modal('show');
var html = '';
   $('.order_product_id').each(function() {
        if ($(this).val() !='') {
          var MyID = $(this).attr("id"); 
          id = MyID.match(/\d+/);  
          if (id == '' || id == null) {
            id = 0;
          }
       /*   var item_qty = $('#qty'+id).val();
          $('#qty'+id).val(parseInt(item_qty) + 1);
           var item_qty = $('#qty'+id).val();
          $('#qty'+id).val(parseInt(item_qty) + 1);*/
          var product_title = $('#item_name'+id).val();
          var barcode = $('#item_code'+id).val();
          var quantity = $('#pqty'+id).val();
          var mrp_price = $('#mrp_price'+id).val(); 
          var price_per_unit = $('#price'+id).val();
          var tax_rate = $('#main_gst'+id).val();
          var discount = $("#discount"+id).val();
          var discount_price = $("#discount_price"+id).val();
          var gst_price = $("#gst_price"+id).val();
          var total_price = $("#total_price"+id).val();
          var qty = $('#qty'+id).val();

          var total_p = parseFloat(total_price)/parseFloat(price_per_unit);
          // alert(total_p)

 
          html += '<tr id="tr-item_'+id+'">';
          html += '<td class="newtwo-bx">';
          html += '<input type="hidden" class="hidden_row" value="0">';
          html += '<input type="hidden" class="order_product_id_" name="order_product_id" id="order_product_id_'+id+'" value="'+$(this).val()+'">';
          html += '<input type="hidden" class="order_item_name" id="item_name_'+id+'" value="'+product_title+'">';
          html += '<span>'+product_title+'</span>';
          html += '</td>';
          html += '<td>';
          html += '<input type="hidden" class="order_item_code_" id="item_code_'+id+'" value="'+barcode+'">';
          html += '<span>'+barcode+'</span>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control bg-white tbl-fld " oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,\'\')"  type="text" id="qty_'+id+'" onkeyup="sumMy_value('+id+')" placeholder="1" value="'+qty+'">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control tbl-fld ptotal_qty_" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,\'\')" readonly  type="text" id="pqty_'+id+'" onkeyup="sumMy_value('+id+')" value="'+quantity+'">';
          html += '</div>';
          html += '</td>';
          html += '<td class="d-none">';
          html += '<div class="form-group">';
          html += '<select class="form-control bg-white tbl-fld2 select_unit_" onchange="sumMy_value('+id+')" id="select_unit_'+id+'">';
          html += '<option value="0">None</option>';
          html += '</select>';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control tbl-fld mrp_price_" id="mrp_price_'+id+'" onkeyup="sumMy_value('+id+')" type="text" placeholder="25" readonly value="'+mrp_price+'">';
          html += '</div>';
          html += '</td>';
          html += '<td>'; 
          html += '<div class="form-group">';
          html += '<input type="hidden" name="perfect_price_" id="perfect_price">';
          html += '<input class="form-control bg-white tbl-fld price" readonly id="price_'+id+'" onkeyup="sumMy_value('+id+')" type="text" placeholder="0" value="'+price_per_unit+'">';                          
          html += '</div>';
          html += '</td>';
          html += '<td class="d-none">';
          html += '<div class="form-group">';
          html += '<input class="form-control tbl-fld discount'+id+'" onkeyup="sumMy_value('+id+')" id="discount_'+id+'" value="'+discount+'" type="text">';
          html += '</div>';
          html += '</td>';
          html += '<td class="d-none">';
          html += '<div class="form-group">';
          html += '<input class="form-control tbl-fld discount_price_" onkeyup="sumMy_value('+id+')" id="discount_price_'+id+'" value="'+discount_price+'" type="text">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input type="text" class="form-control tbl-fld2 main_gst_" value="'+tax_rate+'" readonly onkeyup="sumMy_value('+id+')" id="main_gst_'+id+'"> ';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control bg-white tbl-fld gst_price_" onkeyup="sumMy_value('+id+')" type="text" id="gst_price_'+id+'" value="'+gst_price+'" placeholder="1.25">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control bg-white tbl-fld sub_amount_" type="text" onkeyup="sumMy_value('+id+')" id="total_price_'+id+'" value="'+total_price+'" placeholder="26.25">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<a class="delete" title="Delete" onclick="remove_selected__item('+id+')"><i class="fa fa-trash text-danger"></i></a>';
          html += '</td>';
          html += '</tr>';
          
        }
      });
// alert(html)
$('#all-items-list').html(html); 
}


