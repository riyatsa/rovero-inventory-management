get_total_sales();
function get_total_sales() {
  var total_sales_time = $('#total_sales_select_time').val();
  var store_id = $('#total_sales_select_time_store').val();
  $.ajax({
    url: base_url+"?/AdminDashboard/total_sales_order", 
    type: "POST",
    dataType : 'JSON',
    data: {
      duration : total_sales_time,
      storeId : store_id
    },
    success: function(total_sales) {
      $('#total_sales_count').html('<i class="fa fa-inr pr-1"></i>'+total_sales.toLocaleString('en-IN')+' /-');
    }
  });
}

get_average_order_value();
function get_average_order_value() {
  var total_sales_time = $('#avg_order_value_select_time').val();
  var store_id = $('#avg_order_value_select_time_store').val();
  $.ajax({
    url: base_url+"?/AdminDashboard/average_sales_order", 
    type: "POST",
    dataType : 'JSON',
    data: {
      duration : total_sales_time,
      storeId : store_id
    },
    success: function(total_sales) {
      $('#avergare-order-sales').html('<i class="fa fa-inr pr-1"></i>'+total_sales.toLocaleString('en-IN')+' /-');
    }
  });
}

get_total_purchase();
function get_total_purchase() {
  var total_sales_time = $('#total_purchase_select_time').val();
  var store_id = $('#total_purchase_select_time_store').val();
  $.ajax({
    url: base_url+"?/AdminDashboard/total_purchase_order", 
    type: "POST",
    dataType : 'JSON',
    data: {
      duration : total_sales_time,
      storeId : store_id
    },
    success: function(total) {
      $('#total_purchase_count').html('<i class="fa fa-inr pr-1"></i>'+total.toLocaleString('en-IN')+' /-');
    }
  });
}

get_average_purchase_order_value();
function get_average_purchase_order_value() {
  var total_sales_time = $('#avg_purchase_order_value_select_time').val();
  var store_id = $('#avg_purchase_order_value_select_time_store').val();
  $.ajax({
    url: base_url+"?/AdminDashboard/average_purchase_order", 
    type: "POST",
    dataType : 'JSON',
    data: {
      duration : total_sales_time,
      storeId : store_id
    },
    success: function(total) {
      $('#avergare-purchase-order-sales').html('<i class="fa fa-inr pr-1"></i>'+total.toLocaleString('en-IN')+' /-');
    }
  });
}

get_total_no_of_orders();
function get_total_no_of_orders() {
  var no_of_orders_time = $('#no_of_orders_select_time').val();
  var store_id = $('#no_of_orders_select_time_store').val();
  $.ajax({
    url: "?/AdminDashboard/get_total_no_of_orders", 
    type: "POST",
    dataType : 'JSON',
    data: {
      duration : no_of_orders_time,
      storeId : store_id
    },
    success: function(total_orders) {
      $('#no-of-orders-count').html(total_orders.toLocaleString('en-IN'));
    }
  }); 
}

get_total_no_of_purchase_orders();
function get_total_no_of_purchase_orders() {
  var no_of_orders_time = $('#no_of_purchase_orders_select_time').val();
  var store_id = $('#no_of_purchase_orders_select_time_store').val();
  $.ajax({
    url: "?/AdminDashboard/get_total_no_of_purchase_orders", 
    type: "POST",
    dataType : 'JSON',
    data: {
      duration : no_of_orders_time,
      storeId : store_id
    },
    success: function(total_orders) {
      $('#no-of-purchase-orders-count').html(total_orders.toLocaleString('en-IN'));
    }
  }); 
}


 
get_total_order_returns();
function get_total_order_returns() {
  var total_returns_time = $('#total_returns_select_time').val();
  var store_id = $('#total_returns_select_time_store').val();
  $.ajax({
    url: "?/AdminDashboard/get_total_order_returns", 
    type: "POST",
    dataType : 'JSON',
    data: {
      duration : total_returns_time,
      storeId : store_id
    },
    success: function(product_returned_count) {
      $('#total-returns-count').html(product_returned_count.toLocaleString('en-IN'));
    }
  }); 
}





get_sales_by_item_count();
function get_sales_by_item_count() {
  var sales_by_item_select_product = $('#sales_by_item_select_product').val();
  var sales_by_item_select_time = $('#sales_by_item_select_time').val(); 
  var sales_by_item_select_store = $('#sales_by_item_select_store').val(); 
  $.ajax({
    url: "?/AdminDashboard/get_sales_by_item_count", 
    type: "POST",
    dataType : 'JSON',
    data: {
      duration : sales_by_item_select_time,
      product_id : sales_by_item_select_product, 
      storeId:sales_by_item_select_store
    },
    success: function(sales_by_item_count) {
      $('#sales_by_item_count').empty('');
      if (sales_by_item_count == 0) {
        $('#sales_by_item_error_div').html('<span class="text-danger">No data Available</span>');
      } else {
        $('#sales_by_item_error_div').html('');
      }
      show_sales_by_item_count(sales_by_item_count);
    }
  });
}
  var sales_by_item_count_chart = '';
function show_sales_by_item_count(sales_by_item) {
  var sales_by_item_count_canvas = $('#sales_by_item_count').get(0).getContext('2d');
  var sales_by_item_count_data  = {
    labels: [
      'Total Sales: '+sales_by_item.qty,
      'Total Sales price: '+sales_by_item.total,
    ],
    datasets: [{
      data: [sales_by_item.qty,sales_by_item.total],
      backgroundColor : ['#99ffdd','#2DCD7A'],
    }]
  }

  var sales_by_item_count_options = {
    maintainAspectRatio : false,
    responsive : true,
  };

  if(sales_by_item_count_chart) {
    sales_by_item_count_chart.destroy();
  }

  sales_by_item_count_chart = new Chart(sales_by_item_count_canvas, {
    // doughnut
    type: 'pie',
    data: sales_by_item_count_data,
    options: sales_by_item_count_options      
  });
}


/*top*/

get_top_selling_items();
function get_top_selling_items() {
  var top_selling_items_select = $('#top_selling_items_select').val();
  var top_selling_items_select_time = $('#top_selling_items_select_time').val();
  var top_selling_items_select_store = $('#top_selling_items_select_store').val();
  $.ajax({
    url: "?/AdminDashboard/get_top_selling_items", 
    type: "POST",
    dataType : 'JSON',
    data: {
      top_selling_items_select : top_selling_items_select,
      storeId:top_selling_items_select_store,
      duration:top_selling_items_select_time
    },
    success: function(top_selling_items) {
      $('#top_selling_items_result').empty('');
      if (top_selling_items.length == 0) {
        $('#top_selling_items_error_div').html('<span class="text-danger">No data Available</span>');
        // $("#top_selling_items_result").empty();
        show_top_selling_items(top_selling_items,top_selling_items_select);
      } else {
        $('#top_selling_items_error_div').html('');
        show_top_selling_items(top_selling_items,top_selling_items_select);
      }
    }
  });
}
  var top_selling_chart = '';
function show_top_selling_items(top_selling_items,top_selling_items_select) {
  var top_selling_canvas = $('#top_selling_items_result').get(0).getContext('2d');
  var label_array = [];
  var product_sales_array = [];
  var background_color_array = [];
  var background_colors = ['#2DCD7A','#FF9F43','#2DCD7A','#ED5F5F','#FF9F43','#2DCD7A','#ED5F5F','#FF9F43','#2DCD7A','#ED5F5F'];
  var lenght_t = 5;
   if (top_selling_items.length > 10 && top_selling_items_select == 10) {
    lenght_t = 10;
  }else if(top_selling_items.length <= 0){
    lenght_t = 0;
  }else if(top_selling_items.length > 15 && top_selling_items_select == 15){
    lenght_t = 15;
  }
  for (var i = 0; i < lenght_t; i++) {
    label_array.push(top_selling_items[i].product_name + '' +top_selling_items[i].product_amount);
    // background_color_array.push(background_colors[i]);product_name

    product_sales_array.push(top_selling_items[i].product_amount);

  }
  var top_selling_data  = {
    labels: label_array,
    datasets: [{
      label               : 'Top Selling Products',
      backgroundColor     : 'rgba(60,141,188,0.9)',
      borderColor         : 'rgba(60,141,188,0.8)',
      pointRadius         : false,
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data                : product_sales_array
    }]
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

  var barChartData = jQuery.extend(true, {}, top_selling_data);
  var temp0 = top_selling_data.datasets[0];
  barChartData.datasets[0] = temp0;

  var top_selling_options = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false
  }

  if(top_selling_chart) {
    top_selling_chart.destroy();
  }

  top_selling_chart = new Chart(top_selling_canvas, {
    type: 'bar',
    data: barChartData,
    options: top_selling_options      
  });
}

 

