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

sumMyvalue();
  function sumMyvalue(id=''){
    // alert("Hello")
    var qty = $("#qty"+id).val();
    // console.log('qty'+qty)
    // var price = $("#price"+id).val();
    var p_price = $("#perfect_price"+id).val();
         var price = 0;
     price = $("#price"+id).val();
    // alert(p_price)
    if (parseFloat(p_price) < parseFloat(price)) {
         // alert("if")
      $("#price"+id).val(p_price);
      $("#price-error").html('<span class="text-danger text-center w-100">Enter Valid Price</span>').fadeOut(3000);
       // sumMyvalue(id)
    }else{
      $("#price-error").html('');
      // alert("else")
    }
    // console.log('price'+price)
    // var discount = $("#discount"+id).val();
    // console.log('discount'+discount)
    // var discount_price = $("#discount_price"+id).val();
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
    var price1 = $("#price"+id).val();
    if (price !='' && price !=null) {
      price1 =parseFloat(price1);
      price1 = qty*price1;
    }else{
      price1=parseFloat(0);
       price1 = qty*price1;
    }
    /*if (discount !='' && discount !=null) {
      discount =parseFloat(discount);
      discount_price = (price * discount) / 100;
      discount_price = parseFloat(discount_price);
    }else{*/
     /* discount=parseFloat(0);
      discount_price = (price * discount) / 100;
      discount_price = parseFloat(discount_price);*/
    // }
   /* if (discount_price !='' && discount_price !=null) {
      discount_price =parseFloat(discount_price);
      discount_price = (price * discount) / 100;
    }else{
      discount_price=parseFloat(0);
       discount_price = (price * discount) / 100;
    }*/
    if (main_gst !='' && main_gst !=null) {
      main_gst =parseFloat(main_gst);
      gst_price = (price1 * main_gst) / 100;
      gst_price = parseFloat(gst_price); 
    }else{
      main_gst=parseFloat(0);
      gst_price = (price1 * main_gst) / 100;
      gst_price = parseFloat(gst_price); 
    }
  /*  if (gst_price !='' && gst_price !=null) {
      gst_price =parseFloat(gst_price);
    }else{
      gst_price=parseFloat(0);
    } */ 
    // if (tax_type == 0) {
    	total =  price1;
    // }else{

   		// total =  price+gst_price;
    // }

    // total = total - discount_price;
    // console.log(total);
   var applied_coupon_type = $('#applied_coupon_type').val();
   var coupon_code = $('#coupon_code').val();
    var order_discounted_percentage = $('#order_discounted_percentage').val(); 



    $("#total_price"+id).val(parseFloat(total).toFixed(2));
    // $("#discount_price"+id).val(discount_price.toFixed(2));
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
 

   var subtotal = 0;
    if (applied_coupon_type == 1 && order_discounted_percentage !=0) { 
      // alert("price")
      subtotal = parseFloat(total_amounts).toFixed(2) - parseFloat(order_discounted_percentage).toFixed(2);
    }else if(applied_coupon_type == 0 && order_discounted_percentage !=0){ 
      // alert(order_discounted_percentage)
       subtotal_total = (parseFloat(total_amounts).toFixed(2) * order_discounted_percentage) / 100;
       subtotal = parseFloat(total_amounts).toFixed(2) - parseFloat(subtotal_total).toFixed(2);
    }else{ 
      // alert("no changes")
      subtotal = total_amounts;
    }

    var point = $("#customer_points").html();
  var cust_point = $('#customer_point_apply').val();
  var threshold_balance = $("#threshold_balance").val();
  var threshold_bill_amount = $("#threshold_bill_amount").val();
  if (parseFloat(point) > parseFloat(threshold_balance) && parseFloat(threshold_bill_amount) < subtotal) {
    $("#point_button").show();
  }else{
     $("#point_button").hide();
  }
  var subtotal_amount = 0
    if (cust_point != 0) {
      if (cust_point > subtotal) {
        var subtotal_amount_1 = parseFloat(cust_point) - subtotal;
        $("#customer_points").html(parseFloat(subtotal_amount_1).toFixed(2));
        $("#customer_point_less").val(parseFloat(subtotal_amount_1).toFixed(2));
        $("#diduct_value").html("<label class='col-md-4 col-form-label text-right ln-ht-25'><strong>Points Redeemed</strong></label><div class='col-md-8 text-right'><span class='text-danger text-right'><strong> - "+subtotal+"</strong></span></div>");
      }else{
        subtotal_amount = subtotal - parseFloat(cust_point);
        $("#customer_points").html(0);
        $("#customer_point_less").val(0);
        $("#diduct_value").html("<label class='col-md-4 col-form-label text-right ln-ht-25'><strong>Points Redeemed</strong></label><div class='col-md-8 text-right'><span class='text-danger text-right'><strong> - "+cust_point+"</strong></span></div>");
      }
    }else{

    subtotal_amount = subtotal;
    }


   $("#main_total").html(parseFloat(total_amounts).toFixed(2));
   $("#main_total_amount").val(parseFloat(subtotal_amount).toFixed(2));
   $("#order_discounted_price").val(parseFloat(subtotal_amount).toFixed(2));
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
   $("#balance_total").html(parseFloat(total).toFixed(2));
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



   function save_product_order(status){
    $("#price-error").fadeIn();
    // var party_id = $("#bill_state_id").val();
    // var party = $("#search_field_warehouse").val();
    /* user detail data */
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
      formdata.append('status',status);
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

    if (status !=3 && paid_price <= 0 && payment_type !='Credit') {
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

        $('#save-product-order').prop('disabled',true);
        $("#add_new_product_btn").prop('disabled',true);
        $("#confirm-order").empty();
         
        $.ajax({
            type: "POST",
              url: base_url+"?/StoreBilling/add_store_sales_billing/",
              data:formdata,
              dataType: 'json',
              contentType: false,
              processData: false,
              success: function(data) {
                if (data.status == '1') {  
                toastr.success('New product order has been update successfully.');

                window.location = base_url+"?/StoreBilling/print_invoice/"+encodeURIComponent(btoa(data.sales_id));
                }else if(data.status == '2'){
                    toastr.error('Something went wrong, this order duplicate. Please try again.');
                }else{
                  $('#save-product-order').prop('disabled',false);
                  $("#add_new_product_btn").prop('disabled',false);
                toastr.error('Something went wrong while product ordering. Please try again.');

                } 
              }
          }); 
    }else{ 
      $("#price-error").html("<span class='text-danger'>Please Enter Valid Bill Details.</span>").fadeOut(3000);
    } 
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
            if (data.customer.reffered_by !='' && data.customer.reffered_by !=null) {
              // $("#referral-label").hide();
              $("#referral").val(data.customer.reffered_by);
              $("#referral").prop('disabled',true);
              $("#error-referral").html("");
              $("#applied-referral-div").hide();
            $("#referrel_code").val(data.customer.reffered_by);
            }else{
              $("#referral-label").show();
              $("#referral").val('');
              $("#referral").prop('disabled',false);
              $("#applied-referral-div").show();
            $("#referrel_code").val('');
            $("#error-referral").html("");
            }
            $('#phone-number-info-msg-div').html('<span class="text-danger error-msg-small">This is an old customer</span>')   
          }else{
              $("#referral-label").show();
              $("#referral").val('');
              $("#referral").prop('disabled',false);
              $("#applied-referral-div").show();
            $("#referrel_code").val('');
            $("#error-referral").html("");
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
      // alert('true')
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
      $("#confirm-order").html('<button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn"  data-dismiss="modal">Cancel</button><button class="btn btn-add btn-add-2 text-white mt-0" onclick="order_confirm('+id+')" id="add_new_product_btn" name="add_new_product_btn">Confirm</button>');
    }else{
      // alert("Hello")
      $("#price-error").html("<span class='text-danger'>Please Enter Valid Bill Details.</span>").fadeOut(3000);
    } 

}

function order_confirm(id){ 
   $("#confirm-order").html('<div class="spinner-grow text-success"></div> please wait..');
  save_product_order(id);
}
