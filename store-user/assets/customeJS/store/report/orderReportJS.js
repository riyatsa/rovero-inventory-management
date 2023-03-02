
$('#generate_report').on('click',function(){

	var table = $('#table').children('option:selected').val()
	var duration = $('#duration').children('option:selected').val()
	var to = $('#to').val();
	var from = $('#from').val();
	var method = ''

	if(table == 'sales'){
		method = 'daily_sale_report'
	}else{
		method = 'dailyPurchaseReport'
	}

	var formdata = new FormData();
	formdata.append('duration',duration);
	formdata.append('to',to);
	formdata.append('from',from);

	$.ajax({
	    type: "POST",
	    url: base_url+"?/SaleReport/"+method+"/",
	    data:formdata,
	    dataType: 'json',
	    contentType: false,
	    processData: false,
	    success: function(data) {  

			alert(data.path)
			var link=document.createElement('a');
			document.body.appendChild(link);
			link.href=data.path;
			link.click();	
			document.body.removeChild(link);

	    }	
	});
});