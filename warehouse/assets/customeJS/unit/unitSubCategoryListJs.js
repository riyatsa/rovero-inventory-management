getUnitSubcategory();
function getUnitSubcategory() {
	$.ajax({
    type  : 'ajax',
    url   : '?/unit/viewUnitSubCategory/',
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
          if (data[i].unit_status =='1') {
            check ='checked';
          }else{
            check ='';
        	}

          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td id="unit_name_'+data[i].unit_id+'">'+data[i].unit_name+'</td>'+
            '<td id="unit_short_name_'+data[i].unit_id+'">'+data[i].unit_short_name+'</td>'+ 
            '<td>'+
              '<div class="custom-control custom-switch d-inline">'+
                '<input type="checkbox" '+check+' onclick="unit_status('+data[i].unit_id +','+data[i].unit_status+')" class="custom-control-input" id="change_unit_status'+data[i].unit_id +'">'+
                '<label class="custom-control-label" for="change_unit_status'+data[i].unit_id +'"></label>'+
              '</div>'+
            '</td>'+
            '<td><a href="#" id="edit_unit_'+data[i].unit_id+' " onclick="edit_unit('+data[i].unit_id+')" class="edit-a">Edit</a></td>'+
            
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


function unit_status(id,status){
  var unit_status = '';
  if (status !='1') {
    unit_status ='1';
  }else{
    unit_status ='0';
  }
  $.ajax({
    type: "POST",
    url: base_url+"?/unit/updateUnitStatusSubCategory/"+id,
    data: {unit_status: unit_status},
    dataType: "json",
    success: function(data){
      if (data.status == '1') {
        $('#change_unit_status'+id).attr("onclick","unit_status("+id+","+unit_status+")");
        toastr.success('Unit status has been updated successfully.');
      } else {
        $('#change_unit_status'+id).attr("onclick","unit_status("+id+","+status+")");
        if(status == '0'){
          $('#change_unit_status'+id). prop("checked", false);
        }else{
          $('#change_unit_status'+id). prop("checked", true);
        }
        toastr.error('Something went wrong updating the unit status. Please try again.');
      }
    },
    error: function(data){
       $('#change_unit_status'+id).attr("onclick","unit_status("+id+","+status+")");
        if(status == '0'){
          $('#change_unit_status'+id). prop("checked", false);
        }else{
          $('#change_unit_status'+id). prop("checked", true);
        }
      toastr.error('Something went wrong updating the store status. Please try again.');
    } 
  });
}
$('#add_unit_subcategory_name').on('keyup blur',function(){
  var add_unit_subcategory_name = $('#add_unit_subcategory_name').val(); 
  if (add_unit_subcategory_name != '') {
    $('#add_unit-name-error-msg-div').html('');
  } else {
    $('#add_unit-name-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Unit name.</span>');
  }
}); 

$('#add_unit_subcategory_value').on('keyup blur',function(){
  var add_unit_subcategory_value = $('#add_unit_subcategory_value').val();
  if (add_unit_subcategory_value != '') {
    $('#add_unit_value-error-msg-div').html('');
  } else {
    $('#add_unit_value-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Unit unit short name.</span>');
  }
});



function addUnitSubCategoryModal(){
  $('#addUnitSubCategory').modal('show');

   $.ajax({
    type: "POST",
    url: base_url+"?/unit/viewUnit/", 
    dataType: "json",
    success: function(data){ 
        var unit_category = ''; 
        unit_category += '<option selected value="">Select Unit Type</option>';
        for (var i = data.length - 1; i >= 0; i--) { 
          unit_category += '<option   value="'+data[i].unit_id+'">'+data[i].unit_name+'('+data[i].unit_short_name+')</option>';
        }
         
        $('#unit_category').html(unit_category);    
    }
  });
}
 


function addunitSubCategory(){ 
  var unit_category =  $('#unit_category').children("option:selected").val();
  var add_unit_subcategory_name = $('#add_unit_subcategory_name').val();
  var add_unit_subcategory_value = $('#add_unit_subcategory_value').val(); 
  if (unit_category!= ''&& add_unit_subcategory_name !='' && add_unit_subcategory_value !='') {
    
    $('#add-unit-close-btn').prop('disabled',true);
    $('#add_unit_btn').prop('disabled',true);
    $('#add_unit_btn').css('background','#b3b3b3');
    // $('#Store-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding store.</span>');
    
    var formdata = new FormData();
    formdata.append('unit_id',unit_category);
    formdata.append('unit_name',add_unit_subcategory_name);
    formdata.append('unit_short_name',add_unit_subcategory_value);
  
    $.ajax({
      type: "POST",
      url: base_url+"?/unit/insertUnitSubCategory", 
      data:formdata,
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function(data){ 
        if (data.status == '1') {
          $('#addUnitSubCategory').modal('hide'); 
          getUnitSubcategory();
          toastr.success('New Unit has been added successfully.');
        }else{
          toastr.error('Something went wrong while adding werehouse. Please try again.'); 
        }
          $('#add-unit-close-btn').prop('disabled',false);
          $('#add_unit_btn').prop('disabled',false);
          $('#add_unit_btn').css('background','#1D3327');
          // $('#Store-error').html('');
        }
       
    });
  }else{
    if (add_unit_name != '') {
        $('#add_unit-name-error-msg-div').html('');
    } else {
        $('#add_unit-name-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Unit.</span>');
    }
    if (add_unit_value != '') {
        $('#add_unit_value-error-msg-div').html('');
    } else {
        $('#add_unit_value-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Unit Name.</span>');
    } 
  }
}

 





function edit_unit(id){
  $('#edit_unit_sub_category').modal('show');
  $.ajax({
    type: "POST",
    url: base_url+"?/unit/viewUnitSubCategory/"+id, 
    dataType: "json",
    success: function(data){
      console.log(data);
        // $('#unit_id').val(data.unit_id);
        // $('#unit_name').val(data.unit_name);
        // $('#unit_value').val(data.unit_short_name);
         
    }
  });
}



function updateUnitSubCategoryDetails(){

  var unit_id = $('#unit_id').val();
  var unit_name = $('#unit_name').val();
  var unit_value = $('#unit_value').val();
   
  if (unit_id != '' && unit_name !='' && unit_value !='') {
    var formdata = new FormData();
  $('#edit-unit-close-btn').prop('disabled',true);
  $('#edit_unit_btn').prop('disabled',true);
  $('#edit_unit_btn').css('background','#b3b3b3');
  // $('#Store-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding store.</span>');
 
  formdata.append('unit_name',unit_name);
  formdata.append('unit_short_name',unit_value);
 
    $.ajax({
      type: "POST",
        url: base_url+"?/unit/updateUnitSubCategory/"+unit_id,
        data:formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
          if (data.status == '1') {
            
            $('#unit_name_'+unit_id).html(unit_name);
            $('#unit_short_name_'+unit_id).html(unit_value); 
            $('#edit_unit_sub_category').modal('hide');
          toastr.success('New Unit has been updated successfully.');

          }else{
          toastr.error('Something went wrong while updating Unit. Please try again.');

          }  
          $('#edit-unit-close-btn').prop('disabled',false);
          $('#edit_unit_btn').prop('disabled',false);
          $('#edit_unit_btn').css('background','#1D3327s');
        }
    });

  }else{
    if (add_unit_name != '') {
        $('#unit-name-error-msg-div').html('');
      } else {
        $('#unit-name-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Unit name.</span>');
      }
    if (add_unit_value != '') {
        $('#unit-value-error-msg-div').html('');
      } else {
        $('#unit-value-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Unit Short name .</span>');
      } 
  }
}
 