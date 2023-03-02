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
var add_new_item_i = 0;

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
  function sumMyvalue(id=''){
    // alert("Hello")
    var qty = $("#qty"+id).val();
    // console.log('qty'+qty)
    var p_price = $("#perfect_price"+id).val();
     var price = 0;
     price = $("#price"+id).val();
    // alert(p_price)
    if (parseFloat(p_price) < parseFloat(price)) {
         // alert("if")
      $("#price"+id).val(p_price);
      $("#price-error").html('<span class="text-danger text-center w-100">Enter Valid Price</span>');
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
      gst_price = (price1 * main_gst) / 100;
      gst_price = parseFloat(gst_price).toFixed(2); 
    }else{
      main_gst=parseFloat(0);
      gst_price = (price1 * main_gst) / 100;
      gst_price = parseFloat(gst_price).toFixed(2); 
    }
  /*  if (gst_price !='' && gst_price !=null) {
      gst_price =parseFloat(gst_price);
    }else{
      gst_price=parseFloat(0);
    } */
    if (tax_type == 0) {
      total =  price1;
    }else{

      total =  price1+gst_price; 
    }

    // total = total - discount_price;
    // console.log(total);
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

   $("#main_total").html(parseFloat(total_amounts).toFixed(2));
   $("#main_total_amount").val(parseFloat(subtotal_amount).toFixed(2));
   $("#total_qty").html(total_qty); 

  $("#total_amount").val(parseFloat(total_amounts).toFixed(2));
  // $("#main_total_amount").val(subtotal_amount.toFixed(2));
  $("#order_discounted_price").val(subtotal_amount.toFixed(2));
  $('#total_quantity_count').val(total_qty);
  }

  $("#invoice_type").change(function(){
    $("#invoice_type").prop('disabled',true);
  });


function apply_points() {
  var point = $("#customer_points").html();
  $('#customer_point_apply').val(parseFloat(point));
  sumMyvalue();
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

  /* for the party add */

  function autocomplete(searchEle,serverResponse) {
      // alert(JSON.stringify(arr))
      var arr = JSON.parse(serverResponse)
      // return false;
      var currentFocus;

      searchEle.addEventListener("input", function(e) {
         var divCreate,
         b,
         i,
         fieldVal = this.value;
         closeAllLists();
         if (!fieldVal) {
            return false;
         }
         currentFocus = -1;
         divCreate = document.createElement("DIV");
         divCreate.setAttribute("id", this.id + "autocomplete-list");
         divCreate.setAttribute("class", "autocomplete-items");
         this.parentNode.appendChild(divCreate); 
              var btn = document.createElement("BUTTON");
                 btn.setAttribute("class", "btn btn-info add-new d-none");
                 btn.innerHTML = "<i class='fa fa-plus'></i>Add Store";
                 btn.setAttribute('onclick','click_here()');
                 divCreate.appendChild(btn);
          
          // divCreate.appendHtml("<input type='submit' onclick='OpenMyFunction()' value='submit'>");
         for (i = 0; i <arr.length; i++) {
            // alert(arr[i].vendor_name)
            if ( arr[i].storeName.substr(0, fieldVal.length).toUpperCase() == fieldVal.toUpperCase() ) {
               b = document.createElement("DIV");
               b.innerHTML = "<strong>" + arr[i].storeName.substr(0, fieldVal.length) + "</strong>";
               b.innerHTML += arr[i].storeName.substr(fieldVal.length);
               b.innerHTML += "<input type='hidden' class='"+ arr[i].storeId +"'' id='"+ arr[i].state +"' value='" + arr[i].storeName + "'>";
               b.addEventListener("click", function(e) {
                  searchEle.value = this.getElementsByTagName("input")[0].value;
                  $("#bill_state").val(this.getElementsByTagName("input")[0].getAttribute("id"));
                  $("#bill_state_id").val(this.getElementsByTagName("input")[0].getAttribute("class"));
                  // alert(this.getElementsByTagName("input")[0].getAttribute("id"))
                  closeAllLists();
               });
               divCreate.appendChild(b);
            }
         }
      });
      searchEle.addEventListener("keydown", function(e) {
         var autocompleteList = document.getElementById(
            this.id + "autocomplete-list"
         );
         if (autocompleteList)
            autocompleteList = autocompleteList.getElementsByTagName("div");
         if (e.keyCode == 40) {
            currentFocus++;
            addActive(autocompleteList);
         }
         else if (e.keyCode == 38) {
            //up
            currentFocus--;
            addActive(autocompleteList);
         }
         else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
               if (autocompleteList) autocompleteList[currentFocus].click();
            }
         }
      });
      function addActive(autocompleteList) {
         if (!autocompleteList) return false;
            removeActive(autocompleteList);
         if (currentFocus >= autocompleteList.length) currentFocus = 0;
         if (currentFocus < 0) currentFocus = autocompleteList.length - 1;
         autocompleteList[currentFocus].classList.add("autocomplete-active");
      }
      function removeActive(autocompleteList) {
         for (var i = 0; i < autocompleteList.length; i++) {
            autocompleteList[i].classList.remove("autocomplete-active");
         }
      }
      function closeAllLists(elmnt) {
         var autocompleteList = document.getElementsByClassName(
            "autocomplete-items"
         );
         for (var i = 0; i < autocompleteList.length; i++) {
            if (elmnt != autocompleteList[i] && elmnt != searchEle) {
               autocompleteList[i].parentNode.removeChild(autocompleteList[i]);
            }
         }
      }
      document.addEventListener("click", function(e) {
         closeAllLists(e.target);
      });
   }
    var xhReq = new XMLHttpRequest();
    xhReq.open("POST", "?/SalesOrder/get_store_details", false);
    xhReq.send(null);
    var serverResponse = xhReq.responseText; 
    //alert(serverResponse); // Shows "15"
    // console.log(serverResponse)
   // var animals = ["giraffe","tiger", "lion", "dog","cow","bull","cat","cheetah"];
   function get_autocomplete(){ 
      $("#searchField-error").html("");
      autocomplete(document.getElementById("searchField"),serverResponse);
   }

   function click_here(){
      // alert('Hello, this is button click addEventListener')
      $("#edit_store").modal('show');
   }
 

   function paid_amounts(){
   var main_total_amount= $("#main_total_amount").val();
   var paid_price= $("#paid_price").val();
   var total = parseFloat(main_total_amount).toFixed(2) - parseFloat(paid_price).toFixed(2);
   $("#balance_total").html(parseFloat(total).toFixed(2));
   }

   function save_product_order(){

    var customer_name = $("#customer_name").val();
    var contact_no = $("#contact_no").val();
    var gst_no = $("#customer_gst_number").val();

    var party_id = $("#bill_state_id").val();
    var party = $("#search_field_warehouse").val();
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
 /*   $(".discount").each(function(){
      if ($(this).val() !='') {
        discount.push($(this).val());
      }
    });*/

  var discount_price = [];
   /* $(".discount_price").each(function(){
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
  if (contact_no != '') {
       if (customer_name !='' && contact_no !='' && contact_no.length == 10) {

      }else{

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

        return false;*/

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


      }
     }

 $("#price-error").fadeIn();

 paid_price = parseFloat(paid_price).toFixed(2);
 main_total_amount = parseFloat(main_total_amount).toFixed(2);
       if ( paid_price < main_total_amount && payment_type !='Credit') {

       
       $("#price-error").html("<span class='text-danger'>Please Enter Valid Bill Details.</span>").fadeOut(3000);
       return false;
     }

  // var invoice_type = $("#invoice_type").val();

    $('#save-product-order').prop('disabled',true);
    $("#add_new_product_btn").prop('disabled',true);
  var applied_coupon_type = $('#applied_coupon_type').val();
  var coupon_code = $('#coupon_code').val();
  var order_discounted_percentage = $('#order_discounted_percentage').val(); 
  var order_discounted_price = $("#order_discounted_price").val();
  var cust_point = $('#customer_point_apply').val(); 
  var referral_code = $("#referrel_code").val();
  var invoice_type = $("input[name='invoice_type']:checked").val();
    var formdata = new FormData();

     formdata.append('point_less',customer_point_less);
  formdata.append('referral_code',referral_code);
   formdata.append('point',cust_point);

    formdata.append('applied_coupon_type',applied_coupon_type);
  formdata.append('coupon_code',coupon_code);

    formdata.append('order_discounted_percentage',order_discounted_percentage);
  formdata.append('order_discounted_price',order_discounted_price);

      formdata.append('invoice_type',invoice_type);
      formdata.append('party_id',party_id);
      formdata.append('party',party);
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
      formdata.append('isCustomerNew',isCustomerNew);
      formdata.append('refralCode',refralCode(4));
      formdata.append('customer_name',customer_name);
      formdata.append('contact_no',contact_no);
      formdata.append('gst_number',gst_no);

      formdata.append('select_unit',select_unit); 
      formdata.append('price',price);
      formdata.append('discount',discount);
      formdata.append('discount_price',discount_price);
      formdata.append('main_gst',main_gst);
      formdata.append('gst_price',gst_price);
      formdata.append('sub_amount',sub_amount);
    $.ajax({
        type: "POST",
          url: base_url+"?/SalesOrder/insert_sales_order/",
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(data) {
            if (data.status == '1') {  
            toastr.success('New warehouse sales product order has been added successfully.');
               window.location = "?/SalesOrder/sales_invoice/"+encodeURIComponent(btoa(data.insert_id)); 

            }else{
              $('#save-product-order').prop('disabled',false);
              $("#add_new_product_btn").prop('disabled',false);
            toastr.error('Something went wrong while warehouse sales product ordering. Please try again.');

            } 
          }
      }); 



   }

 
function updateStoreDetails(){

  var password = $('#password').val();
  var storename = $('#storename').val();
  var phonenumber = $('#phonenumber').val();
  var username = $('#username').val(); 
  var gst_type = $('#gst_type'). children("option:selected").val();
  var gstinumber = $('#gstinumber').val();
  var openingBalance =$('#openingBalance').val();
  var address = $('#address').val();
  var city = $('#city').val();
  var state = $('#state').val();
  var pincode = $('#pincode').val();
  // alert(address);
  if ( storename !='' && phonenumber !='' && username !='' && gstinumber !='' && 
    openingBalance !='' && gst_type !='' && address  !='' && state  !='' && pincode  !='') {
    var formdata = new FormData();
  $('#edit-store-close-btn').prop('disabled',true);
  $('#edit_store_btn').prop('disabled',true);
  $('#edit_store_btn').css('background','#b3b3b3');
  $('#Store-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding store.</span>');
 
  formdata.append('password',password);
  formdata.append('storename',storename);
  formdata.append('phonenumber',phonenumber);
  formdata.append('username',username); 
  formdata.append('gstinumber',gstinumber);
  formdata.append('openingBalance',openingBalance);
  formdata.append('gst_type',gst_type);
  formdata.append('address',address);
  formdata.append('city',city);
  formdata.append('state',state);
  formdata.append('pincode',pincode);   

    $.ajax({
      type: "POST",
        url: base_url+"?/SalesOrder/insertStore/",
        data:formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
          if (data.status == '1') {
             var password = $('#password').val('');
              var storename = $('#storename').val('');
              var phonenumber = $('#phonenumber').val('');
              var username = $('#username').val(''); 
              var gst_type = $('#gst_type'). children("option:selected").val(0);
              var gstinumber = $('#gstinumber').val('');
              var openingBalance =$('#openingBalance').val('');
              var address = $('#address').val('');
              var city = $('#city').val('');
              var state = $('#state').val('');
              var pincode = $('#pincode').val('');
            // $('#state').val('');
            // $('#pincode').val('');
            $('#edit_store').modal('hide');
          toastr.success('New store has been updated successfully.');


          }else{
          toastr.error('Something went wrong while updating store. Please try again.');

          }
          $('#edit-store-close-btn').prop('disabled',false);
          $('#edit_store_btn').prop('disabled',false);
          $('#edit_store_btn').css('background','#1D3327');
          $('#Store-error').html('');
        }
    }); 

  }else{
    if (storename != '') {
        $('#storename-error-msg-div').html('');
      } else {
        $('#storename-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the werehouse name.</span>');
      }
    if (username != '') {
        $('#username-error-msg-div').html('');
      } else {
        $('#username-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the User Name.</span>');
      }
     
    if (gstinumber != '') {
        $('#gstinumber-error-msg-div').html('');
      } else {
        $('#gstinumber-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the GST Number.</span>');
      }
    if (openingBalance != '') {
        $('#openingBalance-error-msg-div').html('');
    } else {
        $('#openingBalance-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Opening Balence.</span>');
    }

    if (phonenumber != '') {
      if(phonenumber.length > 10) {
        $('#phonenumber-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
        $('#customer_number').val(phonenumber.slice(0,10));
      } else if (isNaN(phonenumber)) {
        $('#phonenumber-error-msg-div').html('<span class="text-danger error-msg-small">Mobile number should be of 10 characters</span>');
        $('#phonenumber').val(phonenumber.slice(0,-1));
      } else {
        $('#phonenumber-error-msg-div').html('');
      }

    } else {
      $('#phonenumber-error-msg-div').html('<span class="text-danger error-msg-small">Please enter a valid phone number</span>');
    }
     
    if (address != '') {
        $('#address-error-msg-div').html('');
    } else {
        $('#address-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the address.</span>');
    }

    if (city != '') {
        $('#city-error-msg-div').html('');
    } else {
        $('#city-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the city.</span>');
    }

    if (state != '') {
        $('#state-error-msg-div').html('');
    } else {
        $('#state-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the state.</span>');
    }

    if (pincode != '') {
        $('#pincode-error-msg-div').html('');
    } else {
        $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the pincode.</span>');
    }

  }
}

/* find data with barcode value */

function get_barcode_value(id=''){
  var barcode = $("#item_code"+id).val();
var invoice_type = $("#invoice_type").val();
  if (barcode != '') {
      $.ajax({
      type: "POST",
        url: base_url+"?/WareHouseProduct/get_warehouse_product_value",
        data:{barcode:barcode},
        dataType: 'json', 
        success: function(data) {
          if (data!= null) {
          $( "#item_name"+id ).val( data.product_title );
          // $("#item_code"+id).val(data.barcode);
          $("#order_product_id"+id).val(data.product_id);
          $( "#qty"+id ).val(1);
          $( "#pqty"+id ).val(data.quantity);
          
          // $( "#price"+id ).val( data.purchase_price ); 
          if (invoice_type =='1') { 
            $( "#price"+id ).val(data.wholesale_price); 
            $("#perfect_price"+id).val(data.wholesale_price);
         }else{
            $( "#price"+id ).val(data.retail_price); 
            $("#perfect_price"+id).val(data.retail_price);
         }
          $( "#mrp_price"+id ).val(data.product_mrp); 
         $("#qty"+id).focus();

           // $("#perfect_price"+id).val(data.purchase_price);
          // $('#select_unit'+id).val(data.unit_id).trigger('change');
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

 


$('#add-new-item-btn').on('click', function() {
  var selected_item_name = $('#selected-item-name').val();
  var selected_item_product_id = $('#selected-item-product-id').val();
  var is_contact = $('input[name="is_contact"]:checked').val();
  // $("input[name='invoice_type']").prop('disabled',true);
   var invoice_type = $("input[name='invoice_type']:checked").val();
       

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
        url: base_url+"?/PurchaseOrder/add_new_item_for_warehouse_billing",
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
          html += '<input class="form-control bg-white tbl-fld total_qty"   min="0" oninput="this.value = Math.abs(this.value)"  type="number" id="qty'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" placeholder="1" value="1">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control tbl-fld ptotal_qty"   min="0" oninput="this.value = Math.abs(this.value)"  readonly  type="text" id="pqty'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" value="'+data.quantity+'">';
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
          html += '<input class="form-control tbl-fld mrp_price" id="mrp_price'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')"  type="text" placeholder="25" readonly value="'+data.product_mrp+'">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          var price_per_unit = 0;
          if (invoice_type == 1) {
            price_per_unit = data.wholesale_price;
          } else {
            price_per_unit = data.retail_price;
          }
          html += '<div class="form-group">';
          html += '<input type="hidden" name="perfect_price" id="perfect_price">';
          html += '<input class="form-control bg-white tbl-fld price" id="price'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')"   min="0" oninput="this.value = Math.abs(this.value)"  type="number" placeholder="0" value="'+price_per_unit+'">';                          
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
          sumMyvalue(add_new_item_i);
          $("#qty"+add_new_item_i).focus();
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
           $("#qty"+id).focus();
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

function get_autocomplete(id) { 
  $.ajax({
    type: "POST",
    url: base_url+"StoreOrder/get_state_for_warehouse/"+id, 
    dataType: 'json', 
    success: function(data) {
      $("#bill_state").val(data.state);  
    }
  }); 
}

function remove_selected_item(i) {
  $('#tr-item-'+i).remove();
  sumMyvalue();
}

function click_here() {
  $("#add_new_vendor").modal('show');
}



/**/
function save_product_order_confirm(){
  $("#price-error").fadeIn();
     var main_total_amount = $("#main_total_amount").val();
     var paid_price = $("#paid_price").val();
     if (main_total_amount > 0 && paid_price > 0) {
      $("#confirm-order").html('<button class="btn btn-default btn-close btn-add-2 ml-2" id="cancel_add_new_product_btn"  data-dismiss="modal">Cancel</button>                  <button class="btn btn-add btn-add-2 text-white mt-0" onclick="order_confirm()" id="add_new_product_btn" name="add_new_product_btn">Confirm</button>');
       $("#view_order_confirm").modal('show');
    }else{ 
      $("#price-error").html("<span class='text-danger'>Please Enter Valid Bill Details.</span>");
      $("#price-error").fadeOut(5000);
    }
}

function order_confirm(){
   // $("#order_btns").html();
    $("#confirm-order").html('<div class="spinner-grow text-success"></div> please wait..');
  save_product_order();
}


$("#search_field_warehouse").on('change',function(){
      var store = $(this).val();
      var gst = $(this).find(':selected').data('gst_number') 
      var id = $(this).find(':selected').data('id') 
       $("#bill_state_id").val(id)
       $("#customer_gst_number").val(gst)
});


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


$('#contact_no').on('keyup blur',function(){
  
  var contact_no = $(this).val();

  if(contact_no.length == 10){ 

    $.ajax({
      type: "POST",
        url: base_url+"?/salesOrder/customerData/"+contact_no,
        dataType: 'json', 
        success: function(data) {   
        /*  if(data.status != '0'){
            isCustomerNew = 'yes';
            $('#customer_name').val(data.customer.name) 
            $('#phone-number-info-msg-div').html('<span class="text-danger error-msg-small">This is an old customer</span>')   
          }else{
            
            isCustomerNew = 'no';
            $('#customer_name').val('')
            $('#phone-number-info-msg-div').html('<span class="text-danger error-msg-small">This is a new customer</span>')
          }*/

            if(data.status != '0'){
          isCustomerNew = 'yes';
          $('#customer_name').val(data.customer.name)
          $('#customer_points').html(data.customer.balance)
          if (data.customer.reffered_by !='') {
            $('#referel-div').hide();
            // $("#referral-label").hide();
            // $("#referral").hide();
            // $("#applied-referral-div").hide();
            $("#referrel_code").val(data.customer.reffered_by);
            $("#customer-credit-point").show();
            if (data.customer.credit_total !='' && data.customer.credit_total !='null' && data.customer.credit_total !=null) {
            var htm = '<div class="col-md-7"><p>Pending Balence: '+data.customer.credit_total+'</p></div><div class="col-md-5"><a href="#" id="view_store_'+data.customer.customer_id+' " onclick="get_credit_history('+contact_no+')" class="edit-a">View</a></div>';
             $("#customer-credit-point").html(htm);
            }else{
              var htm = '<div class="col-md-7"><p>Pending Balence: '+0+'</p></div><div class="col-md-5"><a href="#" id="view_store_'+data.customer.customer_id+' " onclick="get_credit_history('+contact_no+')" class="edit-a">View</a></div>';
             $("#customer-credit-point").html(htm);
            }
          } else {
            $("#customer-credit-point").hide();
            // $("#referral-label").show();
            // $("#referral").show();
            // $("#applied-referral-div").show();
            // $("#referrel_code").val('');
            $('#customer_points').html('0');
          }
          $('#phone-number-info-msg-div').html('<span class="text-danger error-msg-small">This is an old customer</span>');  
        } else {
          $('#referel-div').show();
          $('#customer_points').html('0');
          isCustomerNew = 'no';
          $('#customer_name').val('');
          $('#phone-number-info-msg-div').html('<span class="text-danger error-msg-small">This is a new customer</span>');
        }

        }

      
    });


  }

});



function get_credit_history(num) {

  $("#display-credit-history").modal('show');

  $.ajax({
    type  : 'ajax',
    url   : '?/SalesOrder/get_credit_history/'+num,
    async : false,
    dataType : 'json',
    success : function(data){ 
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) { 
          var name ='Unregistered';
          var mobile_num ='Unregistered';
          if (data[i].customer_mobile !='') {
            mobile_num = data[i].customer_mobile;
            name = data[i].customer_name;
          }
          
          html+='<tr>'
            html+='<td>'+j+'</td>'
            html+='<td id="customer_name'+data[i].credit_id+'">'+name+'</td>'
            html+='<td id="customer_mobile'+data[i].credit_id+'">'+mobile_num+'</td>'
            html+='<td id="bill_number'+data[i].credit_id+'">'+data[i].bill_number+'</td>'
            html+='<td id="total_'+data[i].credit_id+'"><i class="fa fa-rupee"></i>'+data[i].credit_balance+'</td>'
            html+='<td id="created_date_'+data[i].credit_id+'">'+data[i].created_date+'</td>'
            
            if(data[i].credit_status == '1'){
              html+='<td id="status_'+data[i].bill_number+'" class="text-success">Paid</td>'
            }else if(data[i].credit_status == '0'){
              html+='<td id="status_'+data[i].bill_number+'" class="text-danger">Unpaid <a id="credit_bill_store_'+data[i].bill_number+' " onclick="view_credit_bill(\''+data[i].bill_number+'\',\''+data[i].role+'\')" class="edit-a"><i class="fa fa-pencil text-info"></i></a></td>'
            } 
            
          html+='</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="7" class="text-center">No Result Found.</td>'+
        '</tr>';  
    }
    $('#get_credit_order').html(html);   
  }
  }); 
}



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



function valid_coupon(){
  var coupon = $('#CouponCode').val();
  if (coupon != '') {
    $.ajax({
      type: "POST",
      url: base_url+'?/coupon/get_valid_coupon/'+coupon, 
      dataType: "json",
      success: function(data) {
        if (data.status == '1' && (data.coupon_data.coupon_category_name == 0 || data.coupon_data.coupon_category_name == 1)) {
          $('#applied_coupon_type').val(data.coupon_data.coupon_category_name);
          $('#coupon_code').val(coupon);
          $('#order_discounted_percentage').val(data.coupon_data.coupon_discount); 

          $('#CouponCode').prop('disabled',true);
          $('#valid_coupon').prop('disabled',true);
          $('#coupon-code-btn').html('Remove');
          $('#coupon-code-btn').attr('onclick','remove_coupon()');
          // $('#applied-coupon-div').html('<a class="remove-coupon" onclick="remove_coupon()">Remove</a>')

          toastr.success('Successfully applied promo.');
          sumMyvalue();
        } else {
          $('CouponCode').val('0');
         toastr.error('This Coupon is not valid.');
        }
      } 
    });
  } else{
    toastr.warning('Please enter a coupon code.');
  } 
}

function remove_coupon() { 
  $('#applied_coupon_type').val('0');
  $('#coupon_code').val('0');
  $('CouponCode').val('0');
  $('#order_discounted_percentage').val('0'); 
  $('#applied-coupon-div').html(' <button class="btn btn-info" onclick="valid_coupon()" >apply</button>')
  $('#CouponCode').prop('disabled',false);
  $('#valid_coupon').prop('disabled',false);
  $('#CouponCode').val('');
  $('#coupon-code-btn').html('Apply');
  $('#coupon-code-btn').attr('onclick','valid_coupon()');
  sumMyvalue();
}





function view_credit_bill(bill_num,role){
   $.ajax({
    type  : 'ajax',
    url   : '?/SalesOrder/get_current_store_sales_order_bill/'+bill_num+'/'+role,
    async : false,
    dataType : 'json',
    success : function(data){
      if (data !='') { 
        // alert("test")
        $("#display-calc-data").modal('show');
        var balance = data.productData[0].balance;  
        $("#credited_bill").html(balance);
        $("#sales_id").val(bill_num);
        $("#role").val(role);
        $("#bill_number").val(bill_num);
        $("#pay_amount").val('');

      } 
    }
  });
}

$("#post-paid-amount").on('click',function(){
  $('#pay-amount-error').html('');
  var balance = $("#credited_bill").html();
  var id = $("#sales_id").val();
  var bill_num = $("#bill_number").val();
  var pay_amount = $("#pay_amount").val();
  var role = $("#role").val();
 
  balance = parseFloat(balance);
  pay_amount = parseFloat(pay_amount)

  if (balance == pay_amount) { 
    $('#pay-amount-error').html('');
    var formdata = new FormData();
      formdata.append('pay_amount',pay_amount);
      formdata.append('bill_number',bill_num);
      formdata.append('role',role);
       $.ajax({
          type  : 'POST',
          url   : '?/SalesOrder/update_credited_bill/'+id,
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success : function(data){
            if (data.status == '1') { 
            $("#status_"+bill_num).html('<span class="text-success">Paid</span>')
            $("#display-calc-data").modal('hide');
              $('#contact_no').blur();
                toastr.success('successfully paid amount');
            }else{
              toastr.error('failed paid. Please try again.');
            }
          }
        });

  }else{
    $('#pay-amount-error').html('<span class="text-danger text-small">amount didn\'t match.</span>');
  }

});



function valid_referral(){ 
  var contact_no = $("#contact_no").val(); 
  var referral = $("#referral").val();
  if (contact_no !='' && referral !='') {
    $.ajax({
      type: "POST",
      url: base_url+"?/SalesOrder/check_valid_referal_code/"+contact_no,
      data:{contact_no:contact_no,referral:referral},
      dataType: 'json',
      success: function(data) { 
        if (data.status =='1') {
          $("#referrel_code").val(referral)
          $("#error-referral").html('<span class="text-success error-msg-small">Valid Referral.</span>');
        } else {
          $("#referral").val('');
          $("#error-referral").html('<span class="text-danger error-msg-small">Please Enter Valid referral Code</span>');
        }
      }
    });
  } else {
    if (contact_no == '') {
      $('#phone-number-info-msg-div').html('<span class="text-danger error-msg-small">Please enter a valid customer number</span>');
    } else {
      $('#phone-number-info-msg-div').html('');
    }

    if (referral == '') {
      $("#error-referral").html('<span class="text-danger error-msg-small">Enter Mobile Number or Referel Code.</span>');
    } else {
      $("#error-referral").html('');
    }
  }
}











