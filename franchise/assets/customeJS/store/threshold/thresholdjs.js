function edit_threshold_confirm(){
	$('#edit_threshold_confirm').modal('show')
}
function updateThreshold(){
  $('#edit_threshold_confirm').modal('hide');
  var threshold_point =$('#threshold_point').val();
  var threshold_bill_amount = $('#threshold_bill_amount').val();
  var percentage = $('#percentage').val();
   

  if(threshold_point != '' || threshold_bill_amount != '' || percentage != ''){

    var formdata = new FormData();
    formdata.append('threshold_point',threshold_point);
    formdata.append('threshold_bill_amount',threshold_bill_amount);
    formdata.append('percentage',percentage); 

    $.ajax({
    type: "POST",
    url: "?/Threshold/updateThresholdData/1", 
    data:formdata,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(data){ 

      if (data.status == '1') { 

        
        $('#threshold_point').html(threshold_point);
        $('#threshold_bill_amount').html(threshold_bill_amount);
        $('#percentage').html(percentage);
        
        toastr.success(data.message);

       
      
      }else{  
        toastr.error(data.message+' Please try again.');
      }      
      

    }
    })

  }else{
    $('#item-code-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the minimum stock.</span>');
  }



}
