
 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
             <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Warehouse Panel / </a>
              <span class="header-left-tab-span">WareHouse Product List</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="product-tabs-container">
          <ul class="nav nav-tabs" role="tablist"> 
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/product-category">Add Product Category</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link  nav-link-add-product nav-link-product-tab" href="?/warehouse-product" >Add Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active nav-link-product-tab" href="?/WareHouseProduct/bulk_add_product">Add Bulk Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  nav-link-product-tab" href="#" >View All Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab " href="?/warehouse-product-barcode" >View Product Barcode</a>
            </li>
          </ul>
          <section class="content">
            <div class="container-fluid">
                <button class="btn btn-success text-white my-1 mr-1 float-right" onclick="import_bulk_data()" id="import_bulk_data" name="import_bulk_data">Submit Bulk Product</button>
              <a  class="btn btn-secondary my-1 mr-1 float-right" href="?/WareHouseProduct/bulk_add_product">Cancel</a>
              <span class="d-block medium-text mt-3 mb-2">All Products</span>
              <div class="text-center" id="bulk-error"></div>
              <div class="table-responsive" id="">
                <table class="table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th >Product Title</th>
                      <th>Barcode</th> 
                      <!-- <th>Product Category</th> -->
                      <th >Available Stock</th> 
                      <th>Minimum Stock</th> 
                      <th>MRP Price</th>
                      <th>Retail Price</th>
                      <th>Wholesale Price</th>
                      <th>Purchase Price</th>
                      <th>Product Tax</th> 
                      <th>Barcode Status</th>
                      <th>Pass / Faild</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="get_customers">
                     <!-- Custom code will be hear in data table  -->
                     <?php 
                     $i=1;
                      foreach ($products as $key => $value) {

                        $status = "<span class='text-success'>Pass</span>";
                        if ((float)$value['product_mrp'] < (float)$value['retail_price']) {
                          $status = "<span class='text-danger'>Faild</span>";
                        }else if ((float)$value['retail_price'] < (float)$value['wholesale_price']) {
                          $status = "<span class='text-danger'>Faild</span>";
                        }else if ((float)$value['wholesale_price'] < (float)$value['purchase_price']) {
                          $status = "<span class='text-danger'>Faild</span>";
                        }
                        ?>
                        <tr>
                          <td><?php echo $i++ ?></td>
                          <td class="newtwo-bx">  
                            <div class="form-group">
                                  <input class="form-control tbl-fld product_title" value="<?php echo $value['product_title']; ?>" type="text" id="product_title" onkeyup="sumMyvalue()" placeholder="1">
                               </div>
                          </td>
                          <td>
                            <div class="form-group">
                              <label><?php echo $value['barcode']; ?></label>
                                  <input class="form-control tbl-fld barcode" value="<?php echo $value['barcode']; ?>"  type="hidden" id="barcode" onkeyup="sumMyvalue()" placeholder="1">
                               </div>
                          </td>
                          <td>
                              <div class="form-group">
                                <input class="form-control tbl-fld opening_quantity"  value="<?php echo $value['opening_quantity']; ?>"  type="text" id="opening_quantity" onkeyup="sumMyvalue()" placeholder="1">
                             </div>
                          </td>
                          <td>
                              <div class="form-group">
                                <input class="form-control tbl-fld minimum_stock" value="<?php echo $value['minimum_stock']; ?>"  type="text" id="minimum_stock" onkeyup="sumMyvalue()" placeholder="1">
                             </div>
                          </td>
                           <td>
                              <div class="form-group">
                                <input class="form-control tbl-fld product_mrp" value="<?php echo $value['product_mrp']; ?>"  type="text" id="product_mrp<?php echo $i;?>" onkeyup="sumMyvalue()" placeholder="1">
                             </div>
                          </td>

                         
                          <td>
                              <div class="form-group">
                                <input class="form-control tbl-fld retail_price" value="<?php echo $value['retail_price']; ?>"  type="text" id="retail_price<?php echo $i;?>" onkeyup="sumMyvalue()" placeholder="1">
                             </div>
                          </td>
                          <td>
                              <div class="form-group">
                                <input class="form-control tbl-fld wholesale_price" value="<?php echo $value['wholesale_price']; ?>"  type="text" id="wholesale_price<?php echo $i;?>" onkeyup="sumMyvalue()" placeholder="1">
                             </div>
                          </td>
                          <td>
                              <div class="form-group">
                                <input class="form-control tbl-fld purchase_price" value="<?php echo $value['purchase_price']; ?>"  type="text" id="purchase_price<?php echo $i;?>" onkeyup="sumMyvalue()" placeholder="1">
                             </div>
                          </td>
                          <td>
                              <div class="form-group">
                                <input class="form-control tbl-fld tax_rate" type="text" value="<?php echo $value['tax_rate']; ?>"  id="tax_rate" onkeyup="sumMyvalue()" placeholder="1">
                             </div>
                          </td>
                          <td>
                              <div class="form-group">
                                <input class="form-control tbl-fld barcode_status" type="text" value="<?php echo $value['barcode_status']; ?>"  id="barcode_status" onkeyup="sumMyvalue()" placeholder="1">
                             </div>
                          </td>
                          <td id="bulk_status<?php echo $i; ?>"><?php echo $status; ?></td>
                        </tr>
                        <?php
                      }
                     ?>
                  </tbody>
                </table>
              </div>
            </div>
          </section> 
        </div>
      </div>
    </section>
  </div>
 <script>
   function import_bulk_data(){

  var product_title = [];
    $(".product_title").each(function(){
      if ($(this).val() !='') {
        product_title.push($(this).val());
      }
    });
  var barcode = [];
    $(".barcode").each(function(){
      if ($(this).val() !='') {
        barcode.push($(this).val());
      }
    });
  var opening_quantity = [];
    $(".opening_quantity").each(function(){
      if ($(this).val() !='') {
        opening_quantity.push($(this).val());
      }
    });
  var minimum_stock = [];
    $(".minimum_stock").each(function(){
      if ($(this).val() !='') {
        minimum_stock.push($(this).val());
      }
    });
  var purchase_price = [];
    $(".purchase_price").each(function(){
      if ($(this).val() !='') {
        purchase_price.push($(this).val());
      }
    });
  var product_mrp = [];
    $(".product_mrp").each(function(){
      if ($(this).val() !='') {
        product_mrp.push($(this).val());
      }
    });
  var retail_price = [];
    $(".retail_price").each(function(){
      if ($(this).val() !='') {
        retail_price.push($(this).val());
      }
    });
  var wholesale_price = [];
    $(".wholesale_price").each(function(){
      if ($(this).val() !='') {
        wholesale_price.push($(this).val());
      }
    });
  var tax_rate = [];
    $(".tax_rate").each(function(){
      if ($(this).val() !='') {
        tax_rate.push($(this).val());
      }
    });
  var barcode_status = [];
    $(".barcode_status").each(function(){
      if ($(this).val() !='') {
        barcode_status.push($(this).val());
      }
    });
 
  var formdata = new FormData();
    formdata.append('product_title',product_title);
    formdata.append('barcode',barcode);
    formdata.append('opening_quantity',opening_quantity);
    formdata.append('minimum_stock',minimum_stock);
    formdata.append('purchase_price',purchase_price);
    formdata.append('product_mrp',product_mrp);
    formdata.append('retail_price',retail_price);
    formdata.append('wholesale_price',wholesale_price);
    formdata.append('tax_rate',tax_rate);
    formdata.append('barcode_status',barcode_status); 
    $("#bulk-error").html('<span class="text-warning">Please wait we are submitting the product details.</span>');
    $.ajax({
      type: "POST",
        url: base_url+"?/wareHouseProduct/importpreview_submited_data",
        data: formdata,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(data){
          if (data.status == '1') {
            toastr.success('New Product has been added successfully.'); 
            $("#bulk-error").html('<span class="text-success">Bulk data successfully added.</span>');
            setTimeout(function(){ window.location='?/warehouse-product-details' }, 3000);
          } else if(data.status == '2'){
              $("#bulk-error").html('<span class="text-danger">This data already exist in warehouse products. please upload the another data.</span>');
              toastr.error('Already exist this all data in warehouse product.');
          }else{
          $("#bulk-error").html('<span class="text-danger">OOPS! Something went wrong while adding the Product details. Please check all data once again.</span>');
            toastr.error('OOPS! Something went wrong while adding the Product details. Please check all data once again.');
          }

        }
    
    })

   }

 
               /*         if ((float)$value['product_mrp'] < (float)$value['retail_price']) {
                          $status = 'Faild';
                        }else if ((float)$value['retail_price'] < (float)$value['wholesale_price']) {
                          $status = 'Faild';
                        }else if ((float)$value['wholesale_price'] < (float)$value['purchase_price']) {
                          $status = 'Faild';
                        }*/
   $('table').on('keyup', '.product_mrp', function (e) {
   // $('.total_qty').keypress(function (e) {
      // alert("enter")
        var MyID = $(this).attr("id"); 
   var number = MyID.match(/\d+/); 
   if ($(this).val() <  $("#retail_price"+number).val()) {
       $("#bulk-error").html('<span class="text-danger">Please enter the valid retail mrp price top price.</span>')
        $("#bulk_status"+number).html("<span class='text-danger'>Faild</span>")
   }else{
    $("#bulk-error").html('')
    $("#bulk_status"+number).html("<span class='text-success'>Pass</span>")
   }
  });

   $('table').on('keyup', '.retail_price', function (e) {
   // $('.total_qty').keypress(function (e) {
      // alert("enter")
        var MyID = $(this).attr("id"); 
   var number = MyID.match(/\d+/); 
   if ($(this).val() <  $("#wholesale_price"+number).val()) {
    $("#bulk_status"+number).html("<span class='text-danger'>Faild</span>")
      $("#bulk-error").html('<span class="text-danger">Please enter the valid retail price price.</span>')
   }else if($("#product_mrp"+number).val() <  $(this).val()){
     $("#bulk-error").html('<span class="text-danger">Please enter the valid retail price less than product mrp price.</span>')
      $("#bulk_status"+number).html("<span class='text-danger'>Faild</span>")
   }else{
    $("#bulk-error").html('')
     $("#bulk_status"+number).html("<span class='text-success'>Pass</span>")
   }
  });

  $('table').on('keyup', '.wholesale_price', function (e) {
   // $('.total_qty').keypress(function (e) {
      // alert("enter")
        var MyID = $(this).attr("id"); 
   var number = MyID.match(/\d+/); 
   if ($(this).val() <  $("#purchase_price"+number).val()) {
        $("#bulk-error").html('<span class="text-danger">Please enter the valid retail Wholesale price.</span>')
   }else if($("#retail_price"+number).val() <  $(this).val()){
    $("#bulk-error").html('<span class="text-danger">Please enter the valid retail Wholesale price less than retail price.</span>')
     $("#bulk_status"+number).html("<span class='text-danger'>Faild</span>")
   }else{
    $("#bulk-error").html('')
     $("#bulk_status"+number).html("<span class='text-success'>Pass</span>")
   }
  });


  $('table').on('keyup', '.purchase_price', function (e) {
   // $('.total_qty').keypress(function (e) {
      // alert("enter")
        var MyID = $(this).attr("id"); 
   var number = MyID.match(/\d+/); 
   if($("#wholesale_price"+number).val() <  $(this).val()){
     $("#bulk_status"+number).html("<span class='text-danger'>Faild</span>")
     $("#bulk-error").html('<span class="text-danger">Please enter the valid retail purchase price.</span>')
   }else{
    $("#bulk-error").html('')
     $("#bulk_status"+number).html("<span class='text-success'>Pass</span>")
   }
  });
 </script>