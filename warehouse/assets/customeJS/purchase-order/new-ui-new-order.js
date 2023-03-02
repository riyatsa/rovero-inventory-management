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
    var price = $("#price"+id).val();
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
    if (price !='' && price !=null) {
      price =parseFloat(price);
      price = qty*price;
    }else{
      price=parseFloat(0);
       price = qty*price;
    }
 /*   if (discount !='' && discount !=null) {
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

   $("#main_total").html(total_amounts.toFixed(2));
   $("#main_total_amount").val(total_amounts.toFixed(2));
   $("#total_qty").html(total_qty); 

     $("#total_amount").val(parseFloat(total_amounts).toFixed(2));
  // $("#main_total_amount").val(subtotal_amount.toFixed(2));
  // $("#order_discounted_price").val(subtotal_amount.toFixed(2));
  $('#total_quantity_count').val(total_qty);
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
                btn.setAttribute("class", "btn btn-info add-new");
                btn.innerHTML = "<i class='fa fa-plus'></i>Add Party";
                btn.setAttribute('onclick','click_here()');
                divCreate.appendChild(btn);
          
          // divCreate.appendHtml("<input type='submit' onclick='OpenMyFunction()' value='submit'>");
         for (i = 0; i <arr.length; i++) {
            // alert(arr[i].vendor_name)
            if ( arr[i].vendor_name.substr(0, fieldVal.length).toUpperCase() == fieldVal.toUpperCase() ) {
               b = document.createElement("DIV");
               b.innerHTML = "<strong>" + arr[i].vendor_name.substr(0, fieldVal.length) + "</strong>";
               b.innerHTML += arr[i].vendor_name.substr(fieldVal.length);
               b.innerHTML += "<input type='hidden' class='"+ arr[i].vendor_Id +"'' id='"+ arr[i].state +"' value='" + arr[i].vendor_name + "'>";
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
         $("#searchField-error").html("");
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
  /*  var xhReq = new XMLHttpRequest();
    xhReq.open("POST", "?/Vendor/VendorView", false);
    xhReq.send(null);
    var serverResponse = xhReq.responseText; */
    //alert(serverResponse); // Shows "15"
    // console.log(serverResponse)
   // var animals = ["giraffe","tiger", "lion", "dog","cow","bull","cat","cheetah"];
  /* function get_autocomplete() {
      autocomplete(document.getElementById("searchField"),serverResponse);
   }*/

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

var selDiv = "";
var storedFiles = []; 
var min_files = 0; 

 
  $("#product_images").on("change", handleFileSelect);
  selDiv = $("#selectedFiles");
    
function handleFileSelect(e) { 
  var files = e.target.files;
  var filesArr = Array.prototype.slice.call(files);
  var i=1;
  if (files.length > min_files) {
    if (files.length <= 7) {
      $("#selectedFiles").html('');
      for (var i = 0; i < files.length; i++) {
              var fileName = files[i].name; // get file name
              var html = '<div class="col-md-6 mt-3" id="file_'+i+'">'+
                  '<div class="image-selected-div">'+
                    '<ul class="sorting-ui" id="product_image_'+i+'">'+
                          '<li class="image-selected-name">'+fileName+'</li>'+
                          '<li class="image-name-delete">'+
                            '<a id="file'+i+'" onclick="removeFile('+i+')" data-file="'+fileName+'" class="image-name-delete-a"><i class="fa fa-times text-danger"></i></a>'+
                          '</li>'+
                      '</ul>'+
                    '</div>'+
                  '</div>';
              selDiv.append(html);
              storedFiles.push(files[i]);
          }
      }else{
          $("#selectedFiles").html("<span class='text-danger error-msg-small'>Please select a max of 5 files for a single product.</span>");
      }
  } else {
    $("#selectedFiles").html("<span class='text-danger error-msg-small'>Please select at least 1 Image.</span>");
  } 
}

// $("#selectedFiles").sortable({ tolerance: 'pointer' });

function removeFile(id) {
  var file = $('#file'+id).data("file");
  for(var i=0;i<storedFiles.length;i++) {
    if(storedFiles[i].name === file) {
      storedFiles.splice(i,1); 
    }
  }
  $('#file_'+id).remove();
}


   function paid_amounts(){
   var main_total_amount= $("#main_total_amount").val();
   var paid_price= $("#paid_price").val();
   var total = parseFloat(main_total_amount).toFixed(2) - parseFloat(paid_price).toFixed(2);
   $("#balance_total").html(total);
   }

   function save_product_order(){
    var party_id = $("#search_field_warehouse").val();
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

$('#save-product-order').prop('disabled',true);
$("#add_new_product_btn").prop('disabled',true);
    var formdata = new FormData();
    if (storedFiles.length > 0) {
      for(var i=0, len=storedFiles.length; i<len; i++) {
        formdata.append('files[]', storedFiles[i]);
      }
    } else {
      formdata.append('files[]', '');
    }
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
    $.ajax({
        type: "POST",
          url: base_url+"?/PurchaseOrder/add_purchase_order/",
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(data) {
            if (data.status == '1') {  
            toastr.success('New warehouse product order has been update successfully.');
            window.location = "?/purchaseOrder/purchase_order_invoice/"+encodeURIComponent(btoa(data.insert_id));
            }else{
             $('#save-product-order').prop('disabled',false);
$("#add_new_product_btn").prop('disabled',false);
            toastr.error('Something went wrong while warehouse product ordering. Please try again.');

            } 
          }
      }); 



   }


   /* add product  */ 
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



function saveProducts(){

  var category = $("#select_product_category").val();
  var select_unit = $("#prod_select_unit").val();
  var item_code = $("#prod_item_code").val();
  var item_name = $("#prod_item_name").val();
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
    date !=''
    ) { 

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
          url: base_url+"?/WareHouseProduct/add_warehouse_product/",
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(data) {
            if (data.status == '1') { 
              $("#select_product_category").val('');
        $("#prod_select_unit").val('');
        $("#prod_item_code").val('');
        $("#prod_item_name").val('');
        $("#sale_price").val('');
        $("#sale_tax_price").val('');
        $("#purchase_price").val('');
        // $("#purchase_tax_type").val();
        $("#select_tax_rate").val('');
        $("#opening_quantity").val('');
        $("#date").val();
        $("#minimum_stock").val();
            toastr.success('New warehouse product has been update successfully.');
            $("#add_new_product_modal").modal('hide');
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
/*  */




function updatevendorDetails(){

  // var edit_vendor_id = $('#edit_vendor_id').val();
  var vendorname = $('#vendorname').val();
  var phonenumber = $('#phonenumber').val();
  var email = $('#email').val(); 
  var gst_type = $('#gst_type').children("option:selected").val();
  var gstinumber = $('#gstinumber').val();
  var openingBalance =$('#openingBalance').val();
  var address = $('#address').val();
  var city = $('#city').val();
  var state = $('#state').val();
  var pincode = $('#pincode').val();
  // alert(address);
  if (vendorname !='' && phonenumber !='' && email !='' && gstinumber !='' && 
    openingBalance !='' && gst_type !='' && address  !='' && state  !='' && pincode  !='') {
    var formdata = new FormData();
  $('#edit-vendor-close-btn').prop('disabled',true);
  $('#edit_vendor_btn').prop('disabled',true);
  $('#edit_vendor_btn').css('background','#b3b3b3');
  // $('#Store-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding store.</span>');
 
  formdata.append('vendor_name',vendorname);
  formdata.append('phone_number',phonenumber);
  formdata.append('email',email); 
  formdata.append('gstin_number',gstinumber);
  formdata.append('opening_balance',openingBalance);
  formdata.append('gst_type',gst_type);
  formdata.append('address',address);
  formdata.append('city',city);
  formdata.append('state',state);
  formdata.append('pincode',pincode);   

    $.ajax({
      type: "POST",
        url: base_url+"?/vendor/insertVendor",
        data:formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
          if (data.status == '1') {
           $('#vendorname').val('');
          $('#phonenumber').val('');
          $('#email').val('');
          // $('#password').val('');
          $('#gstinumber').val('');
          $('#openingBalance').val('');
          $('#address').val('');
          $('#city').val('');
          $('#state').val('');
          $('#pincode').val('');
          $("#add_new_vendor").modal('hide');
          toastr.success('New vendor has been added successfully.');
          }else{
          toastr.error('Something went wrong while adding vendor. Please try again.');

          }
          $('#edit-vendor-close-btn').prop('disabled',false);
          $('#edit_vendor_btn').prop('disabled',false);
          $('#edit_vendor_btn').css('background','#1D3327');
          $('#Store-error').html('');
        }
    });

  }else{
 
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

  if (barcode != '') {
      $.ajax({
      type: "POST",
        url: base_url+"?/WareHouseProduct/get_warehouse_product_value",
        data:{barcode:barcode},
        dataType: 'json', 
        success: function(data) {
          if (data!=null) {
          $( "#item_name"+id ).val( data.product_title );
          // $("#item_code"+id).val(data.barcode);
          $("#order_product_id"+id).val(data.product_id);
          $( "#qty"+id ).val(1);
          $( "#pqty"+id ).val(data.quantity);
          $( "#price"+id ).val( data.purchase_price ); 
          $( "#mrp_price"+id ).val( data.product_mrp ); 
          // $('#select_unit'+id).val(data.unit_id).trigger('change');
          $('#main_gst'+id).val(data.tax_rate).trigger('change');
          $("#qty"+id).focus();
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
          html += '<input class="form-control bg-white tbl-fld total_qty"  min="0" oninput="this.value = Math.abs(this.value)"  type="number" id="qty'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" placeholder="1" value="1">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          html += '<div class="form-group">';
          html += '<input class="form-control tbl-fld ptotal_qty"  min="0" oninput="this.value = Math.abs(this.value)" readonly  type="text" id="pqty'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" value="'+data.quantity+'">';
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
          html += '<input class="form-control tbl-fld mrp_price" id="mrp_price'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" type="text" placeholder="25" readonly value="'+data.product_mrp+'">';
          html += '</div>';
          html += '</td>';
          html += '<td>';
          var price_per_unit = 0;
          if (is_contact == 1) {
            price_per_unit = data.wholesale_price;
          } else {
            price_per_unit = data.retail_price;
          }
          html += '<div class="form-group">';
          html += '<input type="hidden" name="perfect_price" id="perfect_price">';
          html += '<input class="form-control bg-white tbl-fld price"  min="0" oninput="this.value = Math.abs(this.value)" id="price'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" type="number" placeholder="0" value="0">';                          
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



