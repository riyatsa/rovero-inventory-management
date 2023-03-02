<!-- /.content-wrapper -->
  <footer class="main-footer border-0">
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url()?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url()?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url()?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url()?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url()?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url()?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url()?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url()?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/toastr/toastr.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- ChartJS -->
<script src="<?php echo base_url()?>assets/plugins/chart.js/Chart.min.js"></script>
<script>
  $(function () {
    $('.datatable').DataTable({
      "scrollY":"500px",
      "scrollCollapse": true,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script>
<script>
  $('.mdate').bootstrapMaterialDatePicker({ 
    weekStart: 0, 
    time: false,
    format: 'YYYY-MM-DD',
  });
  $('.date-min-today').bootstrapMaterialDatePicker({ 
    weekStart: 0, 
    time: false,
    format: 'YYYY-MM-DD',
    minDate: moment()
  });
  // $('#filter_product_btn').addClass('toastrDefaultSuccess');
</script>
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        type: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        type: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        type: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        type: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: '../../dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });
  
  $('.text-editor').summernote();
  $('.multiple-select').select2()
</script>

<!--  -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  get_chart();
  function get_chart(){
    $.ajax({
    type  : 'ajax',
    url   : '?/WareHouseProduct/get_monthly_data/',
    async : false,
    dataType : 'json',
    success : function(data){ 
      charts(data);
    }
  });
  }
  function charts(result) {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
     var month = [];
     var valuedata = [];
     for (var i = 0; i < result.length; i++) {
      month.push(result[i].MONTHNAME);
      valuedata.push(result[i].total);
      // alert(result[i].total)
     }


 
    var areaChartData = {
      labels  : month,
      datasets: [
        {
          label               : 'Monthly Bar Chart',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : valuedata
        }, 
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }], 
      }
    } 
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    // var temp1 = areaChartData.datasets[1]
    // barChartData.datasets[0] = temp1
    barChartData.datasets[0] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      // options: barChartOptions
    }) 
  }
</script>

<!-- Sales and Purchase Bar chart Start-->
    
 <script>
  get_chart();
  function get_chart(){
    $.ajax({
    type  : 'ajax',
    url   : '?/WareHouseDashboard/getSalesPurchase/',
    async : false,
    dataType : 'json',
    success : function(data){ 
      charts(data);
    }
  });
  }
  function charts(result) {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    var allMonths = ['January','February','March', 'April','May','June','July','August','September','October','November','December']; 
    
    finalPurchase =  result.purchase_order.sort(function(a,b){
      return allMonths.indexOf(a.month) - allMonths.indexOf(b.month);
    });


    finalSales =  result.sales_order.sort(function(a,b){
      return allMonths.indexOf(a.month) - allMonths.indexOf(b.month);
    });

    // alert(JSON.stringify(finalPurchase));
    // alert(JSON.stringify(finalSales));

    var purchase_month= [];
    var sale_month = [];
    var purcase_cost = []; 
    var total_sale_value = [];
 

    for (var i = 0; i < finalPurchase.length; i++) {
        purchase_month.push(result.purchase_order[i].month);
        
    }

    for (var i = 0; i < finalPurchase.length; i++) {
        purcase_cost.push(result.purchase_order[i].total_purchase); 
    }


    for (var i = 0; i < finalSales.length; i++) {
        sale_month.push(result.sales_order[i].month);
         
    }
    
    for (var i = 0; i < finalSales.length; i++) {
        total_sale_value.push(result.sales_order[i].total_sales); 
    } 

    dataMonths = merge_array(purchase_month,sale_month);

    finalMonths =  dataMonths.sort(function(a,b){
      return allMonths.indexOf(a) - allMonths.indexOf(b);
    });

    // console.log(purchase_month);
    // console.log(sale_month);
    // console.log(purcase_cost);
    // console.log(total_sale_value);
    // console.log(dataMonths);
  
    var areaChartData = {
      labels  : finalMonths,
      datasets: [
        {
          label               : 'Monthly Purcase',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                :  purcase_cost
        }, 
        {
          label               : 'Monthly Sale',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                :  total_sale_value
        }, 
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          },
          ticks: {
            min: 0
          }
        }]
      }
    } 
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#salesPurchaseBarChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    // var temp1 = areaChartData.datasets[1]
    // barChartData.datasets[0] = temp1
    barChartData.datasets[0] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      // options: barChartOptions
    }) 


    function merge_array(array1, array2) {
    var result_array = [];
    var arr = array1.concat(array2);
    var len = arr.length;
    var assoc = {};

    while(len--) {
        var item = arr[len];

        if(!assoc[item]) 
        { 
            result_array.unshift(item);
            assoc[item] = true;
        }
    }

    return result_array;
}
  }
</script>

<!-- Sales and  Purchase Bar Chart End -->
<!-- for the purchase order -->
<!-- <script>
$.widget('custom.tableAutocomplete', $.ui.autocomplete, {
    options: {
        open: function (event, ui) { 
            $('.ui-autocomplete .ui-menu-item:first').trigger('mouseover');
        },
        focus: function (event, ui) {
            event.preventDefault();
        }
    },
    _create: function () {
        this._super(); 
        this.widget().menu("option", "items", ".ui-menu-item");
    },
    _renderMenu: function (ul, items) {
        var self = this;
        var $table = $('<table class="table-autocomplete">'),
            $thead = $('<thead>'),
            $headerRow = $('<tr>'),
            $tbody = $('<tbody>');

        $.each(self.options.columns, function (index, columnMapping) {
            $('<th>').text(columnMapping.title).appendTo($headerRow);
        });

        $thead.append($headerRow);
        $table.append($thead);
        $table.append($tbody);

        ul.html($table);

        $.each(items, function (index, item) {
            self._renderItemData(ul, ul.find("table tbody"), item);
        });
    },
    _renderItemData: function (ul, table, item) {
        return this._renderItem(table, item).data("ui-autocomplete-item", item);
    },
    _renderItem: function (table, item) {
        var self = this;
        var $tr = $('<tr class="ui-menu-item" role="presentation">');

        $.each(self.options.columns, function (index, columnMapping) {
            var cellContent = !item[columnMapping.field] ? '' : item[columnMapping.field];
            $('<td>').text(cellContent).appendTo($tr);
        });

        return $tr.appendTo(table);
    }
});

$(function () {
    var result_sample = [{
        "id": 26,
        "value": "Ladislau Santos Jr.",
        "name": "klber_moraes@email.net"
    }, {
        "id": 14,
        "value": "Pablo Santos",
        "name": "pablo@xpto.org"
    }, {
        "id": 13,
        "value": "Souza, Nogueira e Santos",
        "name": "3504 Melo Marginal"
    }];

    $('input#search_field').tableAutocomplete({
        source: result_sample,
        columns: [{
            field: 'name',
            title: 'Party'
        }, {
            field: 'value',
            title: 'Party Balance'
        }],
        delay: 300,
        select: function (event, ui) {
            if (ui.item != undefined) {
                $(this).val(ui.item.value);
                $('#selected_id').val(ui.item.id);
            }
            return false;
        }
    });
});
</script>
<script>
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td><input type='hidden'"class='hidden_row' value"''+i+''>"+ (i+1) +"</td><td>"input name='user'+i"'' type='text' placeholder='Name' class='form-control tbl-fld'  /></td><td>"input  name='pass'+i"'' type='text' placeholder='Item Code'  class='form-control tbl-fld'></td><td><input  onkeyup="sumMyvalue('"i+')"id='qty'"i+''  name='ip"+i+'' type='text' placeholder='Qty'  class='form-control tbl-fld'></td><td>"input  name='country'+i"'' type='text' placeholder='Unit'  class='form-control tbl-fld'></td><td>"input  name='ipDisp'+i"'' type='text' onkeyup="sumMyvalue('"i+')"id='price'+i+'' placeholder='Price'  class='form-control tbl-fld'></td><td>"input  name='ipDisp'+i"'' type='text' onkeyup="sumMyvalue('"i+')"id='discount'+i+'' placeholder='Percentage'  class='form-control tbl-fld'></td><td>"input  name='ipDisp'+i"'' type='text' placeholder='Amount' onkeyup="sumMyvalue('"i+')"id='discount_price'+i+'' class='form-control tbl-fld'></td><td>"input  name='ipDisp'+i"'' onkeyup="sumMyvalue('"i+')"id='main_gst'+i+'' type='text' placeholder='Percentage'  class='form-control tbl-fld'><td>"input  name='ipDisp'+i"'' type='text' onkeyup="sumMyvalue('"i+')"id='gst_price'+i+'' placeholder='Tax Amount'  class='form-control tbl-fld'></td><td>"input  name='ipDisp'+i"'' type='text' placeholder='Amount' onkeyup="sumMyvalue('"i+')"id='total_price'+i+'' class='form-control tbl-fld sub_amount'></td></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
         if(i>1){
         $("#addr"+(i-1)).html('');
         i--;
         }
     });
</script> -->

<!-- new order ui 09-10-2020 -->
<script>
  $("#myinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".myTable").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>
<script>
var input = document.getElementById('myinput');
var message = document.getElementsByClassName('newone')[0];
input.addEventListener('focus', function() {
    message.style.display = 'block';
});
input.addEventListener('focusout', function() {
    message.style.display = 'none';
});
</script>
      <?php
       $units ='';
       if (isset($unit) && count($unit) > 0) {
         foreach ($unit as $key => $val) { 
            $units .= "<option value='".$val['unit_id']."'>".$val['unit_name']."</option>";
         }
       }
       ?>
     <?php
      $gsts ='';
     if (isset($gst) && count($gst) > 0) {
       foreach ($gst as $key => $val) { 
          $gsts .= "<option value='".$val['gst_value']."'>".$val['gst_name']."</option>";
       }
     }
     ?>


<script>
  var units = "<?php echo $units; ?>";
  var gsts = "<?php echo $gsts; ?>";
  var actions = $("table td:last-child").html(); 
  var i = 1;
    $(".add-new").click(function(){ 

   var inc = i - 1;
  var item_code = '';
   if (inc > 0) {
      item_code = $("#item_code"+inc).val();
      // alert(item_name)
   }else{
       item_code = $("#item_code").val();
       // alert(item_name)
   }

   if (item_code =='' || item_code ==undefined) {
      // alert(item_name)
      if (item_code !=undefined) { 
         
      return false;
      }
   }
    var index = $("table tbody tr:last-child").index();
        var row = '<tr id="tr_item'+i+'">' +
            '<td><input type="hidden" class="order_product_id" id="order_product_id'+i+'" ><input type="hidden" class="hidden_row" value="'+i+'"><input type="text" class="form-control tbl-fld order_item_name" id="item_name'+i+'" placeholder="Name"></td>' +
            '<td><input type="text" class="form-control tbl-fld order_item_code"  onkeyup="get_barcode_value('+i+')" onfocus="get_barcode_value('+i+')" id="item_code'+i+'" placeholder="Item Code"></td>' +
            '<td><input type="text" class="form-control tbl-fld total_qty" value="0" oninput="oninput_fun('+i+')" onkeyup="sumMyvalue('+i+')" id="qty'+i+'" placeholder="Quantity"></td>' +
            '<td><input type="text" class="form-control tbl-fld ptotal_qty" readonly onkeyup="sumMyvalue('+i+')" id="pqty'+i+'" placeholder="Quantity"></td>' +
            '<td class="d-none"><select class="form-control tbl-fld2 select_unit" onchange="sumMyvalue('+i+')" id="select_unit'+i+'" ><option value="0">None</option>'+units+'</select></td>' +
            '<td><input type="text" class="form-control tbl-fld mrp_price" onkeyup="sumMyvalue('+i+')" readonly id="mrp_price'+i+'" placeholder="MRP"></td>' +
            '<td> <input type="hidden" name="perfect_price" id="perfect_price'+i+'"><input type="text" class="form-control tbl-fld price" onkeyup="sumMyvalue('+i+')" id="price'+i+'" placeholder="Price"></td>' +
            '<td class="d-none"><input type="text" class="form-control tbl-fld discount" onkeyup="sumMyvalue('+i+')" id="discount'+i+'" placeholder="Percentage" value="0"></td>' +
            '<td class="d-none"><input type="text" class="form-control tbl-fld discount_price" onkeyup="sumMyvalue('+i+')" id="discount_price'+i+'" placeholder="Amount" value="0"></td>' +
            '<td><select class="form-control tbl-fld2 main_gst" onchange="sumMyvalue('+i+')" id="main_gst'+i+'" ><option value="0">Select GST</option>'+gsts+'</select></td>' +
            '<td><input type="text" class="form-control tbl-fld gst_price" onkeyup="sumMyvalue('+i+')" id="gst_price'+i+'" placeholder="Amount"></td>' +
            '<td><input type="text" class="form-control tbl-fld sub_amount" onkeyup="sumMyvalue('+i+')" id="total_price'+i+'" placeholder="Amount"></td>' +
      '<td><a class="delete" title="Delete" onclick="remove_tr('+i+')"><i class="material-icons">&#xE872;</i></a></td>' +
        '</tr>';
      $("table").append(row);   
    $("table tbody tr").eq(index + 1).find(".edit").toggle();
     // $("#item_code"+i).focus()
        i++;
    });
  // Add row on add button click
 /* $(document).on("click", ".add", function(){
    var empty = false;
    var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
      if(!$(this).val()){
        $(this).addClass("error");
        empty = true;
      } else{
                $(this).removeClass("error");
            }
    });
    $(this).parents("tr").find(".error").first().focus();
    if(!empty){
      input.each(function(){
        $(this).parent("td").html($(this).val());
      });     
      $(this).parents("tr").find(".add, .edit").toggle();
      $(".add-new").removeAttr("disabled");
    }   
    })*/
  
  // Delete row on delete button click
 /* $(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
    $(".add-new").removeAttr("disabled");
    });*/

  function oninput_fun(id){
    var qty = $("#qty"+id).val();
  if (/\D/g.test(qty)){
      var qtys = qty.replace(/\D/g,'')
  $("#qty"+id).val(qtys);
}
}

  function remove_tr(id=''){

   $("#tr_item"+id).remove();
   $(".add-new").removeAttr("disabled");
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

   $("#main_total").html(total_amounts);
   $("#main_total_amount").val(total_amounts);
   $("#total_qty").html(total_qty); 
  }
 
  $('table').on('keypress', '.total_qty', function (e) {
      // $('.total_qty').keypress(function (e) {
         // alert("enter")
      if (e.which === 13) { 
           $(this).closest('tr').nextAll().eq(0).find('.order_item_code').focus()
      }
     });
</script>
<script>
  $('.select2').select2({
  // minimumInputLength: 3 // only start searching when the user has input 3 or more characters
});
</script>


<script>
  $('#sidebar-expand-close-bar').on('click', function() {
    setTimeout(function(){ check_sidebar_expand_close(); }, 50);
  });

  function check_sidebar_expand_close() {
    var body_sidebar_class = '';
    if($("body").hasClass("sidebar-collapse")) {
      body_sidebar_class = 'sidebar-collapse';
    }

    $.ajax({
      type  : 'POST',
      url   : '?/admin_Sidebar_Check',
      data : {
        verify_admin_request : '1',
        body_sidebar_class : body_sidebar_class
      },
      dataType : 'json',
      success : function(data) {
        
      }
    });
  }
</script>

</body>
</html>