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
var add_new_item_i = 100;

 
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
//store-purchase-order.js
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
      gst_price = parseFloat(gst_price).toFixed(2); 
    }else{
      main_gst=parseFloat(0);
      gst_price = (price * main_gst) / 100;
      gst_price = parseFloat(gst_price).toFixed(2); 
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
   $("#total_qty").html(total_qty); 


   /*   $("#main_total").html(total_amounts.toFixed(2));
   $("#main_total_amount").val(total_amounts.toFixed(2));
   $("#total_qty").html(total_qty); */

     $("#total_amount").val(parseFloat(total_amounts).toFixed(2));
  // $("#main_total_amount").val(subtotal_amount.toFixed(2));
  // $("#order_discounted_price").val(subtotal_amount.toFixed(2));
  $('#total_quantity_count').val(total_qty);

  }






   function paid_amounts(){
   var main_total_amount= $("#main_total_amount").val();
   var paid_price= $("#paid_price").val();
   var total = parseFloat(main_total_amount).toFixed(2) - parseFloat(paid_price).toFixed(2);
   $("#balance_total").html(parseFloat(total).toFixed(2));
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
          url: base_url+"?/PurchaseOrder/add_sales_order/"+purchase_id,
          data:formdata,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(data) {
            if (data.status == '1') {  
            toastr.success('New warehouse product order has been update successfully.');
            window.location = "?/PurchaseOrder/sales_order_bill/"+encodeURIComponent(btoa(data.id));
            }else{
             $('#save-product-order').prop('disabled',false);
$("#add_new_product_btn").prop('disabled',false);
            toastr.error('Something went wrong while warehouse product ordering. Please try again.');

            } 
          }
      }); 



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
    $("#searchField-error").html("<span class='text-danger'>Please Fill the vendor.<span>");
  }
}

function order_confirm(){
   $("#view_order_confirm").modal('hide');
  save_product_order();
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
          html += '<input class="form-control tbl-fld ptotal_qty"  min="0" oninput="this.value = Math.abs(this.value)"   readonly  type="number" id="pqty'+add_new_item_i+'" onkeyup="sumMyvalue('+add_new_item_i+')" value="'+data.quantity+'">';
          html += '</div>';
          html += '</td>';
          html += '<td class="d-none">';
          html += '<div class="form-group">';
          html += '<select class="form-control bg-white tbl-fld2 select_unit" onchange="sumMyvalue('+add_new_item_i+')" id="select_unit'+add_new_item_i+'">';
          html += '<option value="0">None</option>';
          html += '</select>';
          html += '</div>';
          html += '</td>';
          html += '<td class="d-none">';
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
          html += '<input class="form-control bg-white tbl-fld price" id="price'+add_new_item_i+'" min="0" oninput="this.value = Math.abs(this.value)"  onkeyup="sumMyvalue('+add_new_item_i+')" type="number" placeholder="0" value="'+price_per_unit+'">';                          
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
    url: base_url+"?/StoreOrder/get_state_for_warehouse/"+id, 
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
          html += '<td class="d-none">';
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








