getGst();
function getGst() {
	$.ajax({
    type  : 'ajax',
    url   : '?/GST/viewGst/',
    async : false,
    dataType : 'json',
    success : function(data){
      // alert(JSON.stringify(data))
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) {
          var check ='';
          // alert(data[i].customer_status)
          if (data[i].status =='1') {
            check ='checked';
          }else{
            check ='';
        	}

          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td id="gst_name_'+data[i].gst_id+'">'+data[i].gst_name+'</td>'+
            '<td id="gst_value_'+data[i].gst_id+'">'+data[i].gst_value+'</td>'+ 
            '<td>'+
              '<div class="custom-control custom-switch d-inline">'+
                '<input type="checkbox" '+check+' onclick="gst_status('+data[i].gst_id +','+data[i].status+')" class="custom-control-input" id="change_gst_status'+data[i].gst_id +'">'+
                '<label class="custom-control-label" for="change_gst_status'+data[i].gst_id +'"></label>'+
              '</div>'+
            '</td>'+
            '<td><a href="#" id="edit_store_'+data[i].gst_id+' " onclick="edit_store('+data[i].gst_id+')" class="edit-a">Edit</a></td>'+
            
          '</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="7" class="text-center">No Customer found.</td>'+
        '</tr>';	
    }
    $('#get_customers').html(html);   
  }
  });
}


$('#storename').on('keyup blur',function(){
  var storename = $('#storename').val(); 
  if (storename != '') {
    $('#storename-error-msg-div').html('');
  } else {
    $('#storename-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the store name.</span>');
  }
}); 

$('#phonenumber').on('keyup blur',function(){
  var phonenumber = $('#phonenumber').val();
  if (phonenumber != '') {
    $('#phonenumber-error-msg-div').html('');
  } else {
    $('#phonenumber-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Contact Number.</span>');
  }
});



function addGstModal(){
  $('#add_store').modal('show'); 
}

function addGst(){ 
  var gst_name = $('#add_gst_name').val();
  var gst_value = $('#add_gst_value').val();
   
  if (gst_name !='' && gst_value !='') {
    
    $('#add-gst-close-btn').prop('disabled',true);
    $('#add_gst_btn').prop('disabled',true);
    $('#add_gst_btn').css('background','#b3b3b3');
    // $('#Store-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding store.</span>');
    
    var formdata = new FormData();
    formdata.append('gst_name',gst_name);
    formdata.append('gst_value',gst_value);
  
    $.ajax({
      type: "POST",
      url: base_url+"?/GST/insertGst", 
      data:formdata,
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function(data){ 
        if (data.status == '1') {
          $('#add_store').modal('hide'); 
          getGst();
          toastr.success('New GST has been added successfully.');
        }else{
          toastr.error('Something went wrong while adding werehouse. Please try again.'); 
        }
          $('#add-gst-close-btn').prop('disabled',false);
          $('#add_gst_btn').prop('disabled',false);
          $('#add_gst_btn').css('background','#1D3327');
          // $('#Store-error').html('');
        }
       
    });
  }else{
    if (gst_name != '') {
        $('#gst_name-error-msg-div').html('');
    } else {
        $('#gst_name-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the GST.</span>');
    }
    if (gst_value != '') {
        $('#username-error-msg-div').html('');
    } else {
        $('#username-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the User Name.</span>');
    } 
  }
}

 





function edit_store(id){
  $('#edit_store').modal('show');
  $.ajax({
    type: "POST",
    url: base_url+"?/GST/viewGst/"+id, 
    dataType: "json",
    success: function(data){
      console.log(data.gst_name);
        var gst_id = $('#gst_id').val(data.gst_id);
        var gst_name = $('#gst_name').val(data.gst_name);
        var gst_value = $('#gst_value').val(data.gst_value);
         
    }
  });
}



function updateGstDetails(){

  var gst_id = $('#gst_id').val();
  var gst_name = $('#gst_name').val();
  var gst_value = $('#gst_value').val();
   
  if (gst_id != '' && gst_name !='' && gst_value !='') {
    var formdata = new FormData();
  $('#edit-gst-close-btn').prop('disabled',true);
  $('#edit_gst_btn').prop('disabled',true);
  $('#edit_gst_btn').css('background','#b3b3b3');
  $('#Store-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding store.</span>');
 
  formdata.append('gst_name',gst_name);
  formdata.append('gst_value',gst_value);
 
    $.ajax({
      type: "POST",
        url: base_url+"?/GST/updateGst/"+gst_id,
        data:formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
          if (data.status == '1') {
            $('#gst_name_'+gst_id).html(gst_name);
            $('#gst_value_'+gst_id).html(gst_value); 
            $('#edit_store').modal('hide');
          toastr.success('New GST has been updated successfully.');

          }else{
          toastr.error('Something went wrong while updating GST. Please try again.');

          }
          $('#edit-gst-close-btn').prop('disabled',false);
          $('#edit_gst_btn').prop('disabled',false);
          $('#edit_gst_btn').css('background','#1D3327');
          $('#Store-error').html('');
        }
    });

  }else{
    if (gst_name != '') {
        $('#gst_name-error-msg-div').html('');
      } else {
        $('#gst_name-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the GST.</span>');
      }
    if (gst_value != '') {
        $('#username-error-msg-div').html('');
      } else {
        $('#username-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the User Name.</span>');
      }
    

  }
}


function gst_status(id,status){
  var gst_status = '';
  if (status !='1') {
    gst_status ='1';
  }else{
    gst_status ='0';
  }
  $.ajax({
    type: "POST",
    url: base_url+"?/GST/updateGstStatus/"+id,
    data: {gst_status: gst_status},
    dataType: "json",
    success: function(data){
      if (data.status == '1') {
        $('#change_gst_status'+id).attr("onclick","gst_status("+id+","+gst_status+")");
        toastr.success('Store status has been updated successfully.');
      } else {
        $('#change_gst_status'+id).attr("onclick","gst_status("+id+","+status+")");
        if(status == '0'){
          $('#change_gst_status'+id). prop("checked", false);
        }else{
          $('#change_gst_status'+id). prop("checked", true);
        }
        toastr.error('Something went wrong updating the store status. Please try again.');
      }
    },
    error: function(data){
       $('#change_gst_status'+id).attr("onclick","gst_status("+id+","+status+")");
        if(status == '0'){
          $('#change_gst_status'+id). prop("checked", false);
        }else{
          $('#change_gst_status'+id). prop("checked", true);
        }
      toastr.error('Something went wrong updating the store status. Please try again.');
    } 
  });
}
