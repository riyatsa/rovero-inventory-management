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
    if (tax_type == 0) {
      total =  price1;
    }else{

      total =  price1+gst_price;
    }

    // total = total - discount_price;
    // console.log(total);
    $("#total_price"+id).val(total.toFixed(2));
    // $("#discount_price"+id).val(discount_price.toFixed(2));
  $("#gst_price"+id).val(gst_price);

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

   $("#main_total").html(total_amounts.toFixed(2));
   $("#main_total_amount").val(total_amounts.toFixed(2));
   $("#total_qty").html(total_qty); 
  }

  $("#invoice_type").change(function(){
    $("#invoice_type").prop('disabled',true);
  });

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
   $("#balance_total").html(total);
   }

   function save_product_order(){
    var party_id = $("#bill_state_id").val();
    var party = $("#searchField").val();
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
    $(".main_gst  :selected").each(function(){
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
  var invoice_type = $("#invoice_type").val();


    var formdata = new FormData();
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




/**/
function save_product_order_confirm(){
  var vendore = $("#searchField").val();
   $("#searchField-error").html("");
  if (vendore !='') { 
  // $("#view_order_confirm").modal('show');
   var main_total_amount = $("#main_total_amount").val();
      var paid_price = $("#paid_price").val();
      if (main_total_amount > 0 && paid_price > 0) {
       $("#view_order_confirm").modal('show');
      }else{ 
        $("#price-error").html("<span class='text-danger'>Please Enter Valid Bill Details.</span>");
      }
  }else{
    $("#searchField-error").html("<span class='text-danger'>Please Fill the Store Name.<span>");
  }
}

function order_confirm(){
   $("#view_order_confirm").modal('hide');
  save_product_order();
}

