
$('#generate_report').on('click',function(){

	var to = $('#to').val();
	var from = $('#from').val();
	var table = $('#table').children('option:selected').val()
	var duration = $('#duration').children('option:selected').val()
	var store = $('#store').children('option:selected').val()
	var customer = $('#customer').children('option:selected').val()
	var method = ''

	if(table == 'sales'){
		method = 'daily_sale_report'
	}else if (table == 'purchase'){
		method = 'dailyPurchaseReport'
	}else if(table =='store_sales'){
		method = 'store_sales'
	}else{
		method = 'daily_purchase_return_report'
	}

	var formdata = new FormData();
	formdata.append('duration',duration);
	formdata.append('to',to);
	formdata.append('from',from);
	formdata.append('store',store);
	formdata.append('customer',customer);

	$.ajax({
	    type: "POST",
	    url: base_url+"?/BillReport/"+method+"/",
	    data:formdata,
	    dataType: 'json',
	    contentType: false,
	    processData: false,
	    success: function(data) {  

			// alert(data.path)
			var link=document.createElement('a');
			document.body.appendChild(link);
			link.href=data.path;
			link.click();	
			document.body.removeChild(link);

	    }	
	});
});