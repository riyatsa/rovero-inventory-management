var email_regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
var alphabets_only = /^[A-Za-z ]+$/;


var stateList= ['Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Goa','Gujarat','Haryana',
'Himachal Pradesh','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya',
'Mizoram','Nagaland','Odisha','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh',
'Uttarakhand','West Bengal']


var state = '';
state += '<option selected value="">Select State</option>';

for (var i = 0; i < stateList.length; i++) {
  state += '<option  value="'+stateList[i]+'">'+stateList[i]+'</option>';
}

$('#state').html(state);



get_were_house();
function get_were_house() {
	$.ajax({
    type  : 'ajax',
    url   : '?/warehouse/get_werehouse_details/',
    async : false,
    dataType : 'json',
    success : function(data){
    	console.log(data)
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) {
        	status = '';
        	if (data[i].status == '1') {
        		status = 'checked';
        	}
          html +='<tr>'+
                '<td>'+ j++ +'.</td>'+
                '<td>'+data[i].warehouseName+'</td>'+
                '<td>'+data[i].userName+'</td>'+
                '<td>'+data[i].PhoneNumber+'</td>'+
                '<td>'+data[i].openingBalance+'</td>'+
                '<td>'+data[i].gstinNumber+'</td>'+
                '<td>'+
                 '<a href="javascript::void(0)" onclick="edit_werehouse('+data[i].warehouseId+')"><i class="fa fa-pencil fa-pencil-edit ml-2"></i></a>'+
                  '</td>'+
                '<td>'+
                              '<div class="custom-control custom-switch d-inline">'+
                '<input type="checkbox" '+status+' onclick="store_status('+data[i].warehouseId +','+data[i].status+')" class="custom-control-input" id="change_store_status'+data[i].warehouseId +'">'+
                '<label class="custom-control-label" for="change_store_status'+data[i].warehouseId +'"></label>'+
              '</div>'+
                '</td>'+
              '</tr>';
        }
      }else{
        html+='<tr>'+
          '<td colspan="7" class="text-center">No Data found.</td>'+
        '</tr>';	
    }
    $('#were-house-details').html(html);   
  }
  });
}



$('#werehousename').keyup(function(){
  var werehousename = $('#werehousename').val();
  if (werehousename != '') {
    $('#werehousename-error-msg-div').html('');
  } else {
    $('#werehousename-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the warehouse name.</span>');
  }
});


/*$('#phonenumber').keyup(function(){
  var phonenumber = $('#phonenumber').val();
  if (phonenumber != '') {
    $('#phonenumber-error-msg-div').html('');
  } else {
    $('#phonenumber-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Contact Number.</span>');
  }
});
*/

$('#username').keyup(function(){
  var username = $('#username').val();
  if (username != '') {
    $('#username-error-msg-div').html('');
  } else {
    $('#username-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the User Name.</span>');
  }
});


$('#password').keyup(function(){
  var password = $('#password').val();
  if (password != '') {
    $('#password-error-msg-div').html('');
  } else {
    $('#password-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the password.</span>');
  }
});

$('#gstinumber').keyup(function(){
  var gstinumber = $('#gstinumber').val();
  if (gstinumber != '') {
    $('#gstinumber-error-msg-div').html('');
  } else {
    $('#gstinumber-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the GST Number.</span>');
  }
});


$('#openingBalance').keyup(function(){
  var openingBalance = $('#openingBalance').val();
  if (openingBalance != '') {
    $('#openingBalance-error-msg-div').html('');
  } else {
    $('#openingBalance-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the Opening Balence.</span>');
  }
});


$('#phonenumber').keyup(function(){
  var phonenumber = $('#phonenumber').val();
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
});

$('#city').keyup(function(){
  var city = $('#city').val();
  if (city != '') {
    if(!isNaN(city) || !alphabets_only.test(city)) {
      $('#city-error-msg-div').html('<span class="text-danger error-msg">City name should only have alphabets.</span>');
      $('#city').val(city.slice(0,-1));
    } else {
      $('#city-error-msg-div').html('');
    }
  } else {
    $('#city-error-msg-div').html('<span class="text-danger error-msg-small">Please enter your city name.</span>');
  }
});


$('#state').change(function(){
  var state = $('#state').val();
  if (state != '') {
    $('#state-error-msg-div').html('');
  } else {
    $('#state-error-msg-div').html('<span class="text-danger error-msg-small">Please select a state.</span>');
  }
});

$('#Address').change(function(){
  var address = $('#Address').val();
  if (address != '') {
    $('#Address-error-msg-div').html('');
  } else {
    $('#Address-error-msg-div').html('<span class="text-danger error-msg-small">Please select a state.</span>');
  }
});

$('#pincode').keyup(function(){
    var pincode = $('#pincode').val();
       var reg = /^[0-9]+$/;
    if (pincode != '') {
      if (pincode.length > 7) {
        $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Pincode cannot be more than 7 digits.</span>');
          $('#pincode').val(pincode.slice(0,7));
      }else if(!reg.test(pincode)){
        $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Please Enter Digit only.</span>');
        $('#pincode').val('');
      } else {
        $('#pincode-error-msg-div').html('');
      }
    } else {
      $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the pincode</span>');
    }
});


function savewerehouse(){
var werehousename = $('#werehousename').val();
var phonenumber = $('#phonenumber').val();
var username = $('#username').val();
var password = $('#password').val();
var gstinumber = $('#gstinumber').val();
var gst_type = $('#gst_type').val();
var Address = $('#Address').val();
var city = $('#city').val();
var state = $('#state').val();
var pincode = $('#pincode').val();
// alert(gst_type)
 var warehouseId = $('#warehouseId').val(); 
 var openingBalance = $("#openingBalance").val();

if (werehousename !='' && phonenumber !='' && username !='' && password !='' && gstinumber !='' && openingBalance !='' && gst_type !='' &&
Address  !='' &&
city  !='' &&
state  !='' &&
pincode  !='') {
  var formdata = new FormData();
  $('#cancel_add_new_product_btn').prop('disabled',true);
  $('#add_new_product_btn').prop('disabled',true);
  $('#add_new_product_btn').css('background','#b3b3b3');
  $('#werehouse-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding warehouse.</span>');

  formdata.append('werehousename',werehousename);
  formdata.append('phonenumber',phonenumber);
  formdata.append('username',username);
  formdata.append('password',password);
  formdata.append('gstinumber',gstinumber);
  formdata.append('openingBalance',openingBalance);
  formdata.append('gst_type',gst_type);
  formdata.append('Address',Address);
  formdata.append('city',city);
  formdata.append('state',state);
  formdata.append('pincode',pincode);
  $.ajax({
      type: "POST",
        url: base_url+"?/warehouse/update_werehouse/"+warehouseId,
        data:formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
          if (data.status == '1') {
            $('#edit-werehouse-details').modal('hide');
          toastr.success('werehouse has been updated successfully.');
          }else{
          toastr.error('Something went wrong while updating warehouse. Please try again.');

          }
          $('#cancel_add_new_product_btn').prop('disabled',false);
          $('#add_new_product_btn').prop('disabled',false);
          $('#add_new_product_btn').css('background','#1D3327');
          $('#werehouse-error').html('');
        }
    });
}else{
  if (werehousename != '') {
      $('#werehousename-error-msg-div').html('');
    } else {
      $('#werehousename-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the warehouse name.</span>');
    }
  if (username != '') {
      $('#username-error-msg-div').html('');
    } else {
      $('#username-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the User Name.</span>');
    }
  if (password != '') {
      $('#password-error-msg-div').html('');
    } else {
      $('#password-error-msg-div').html('<span class="text-danger error-msg-small">Please fill the password.</span>');
    }
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

  var reg = /^[0-9]+$/;
    if (pincode != '') {
      if (pincode.length > 7) {
        $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Pincode cannot be more than 7 digits.</span>');
          $('#pincode').val(pincode.slice(0,7));
      }else if(!reg.test(pincode)){
        $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Please Enter Digit only.</span>');
        $('#pincode').val('');
      } else {
        $('#pincode-error-msg-div').html('');
      }
    } else {
      $('#pincode-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the pincode</span>');
    }

  if (state != '') {
    $('#state-error-msg-div').html('');
  } else {
    $('#state-error-msg-div').html('<span class="text-danger error-msg-small">Please select a state.</span>');
  }

  if (Address != '') {
    $('#Address-error-msg-div').html('');
  } else {
    $('#Address-error-msg-div').html('<span class="text-danger error-msg-small">Please select a state.</span>');
  }

  if (city != '') {
    if(!isNaN(city) || !alphabets_only.test(city)) {
      $('#city-error-msg-div').html('<span class="text-danger error-msg">City name should only have alphabets.</span>');
      $('#city').val(city.slice(0,-1));
    } else {
      $('#city-error-msg-div').html('');
    }
  } else {
    $('#city-error-msg-div').html('<span class="text-danger error-msg-small">Please enter your city name.</span>');
  }




}

}


function edit_werehouse(id){

    $.ajax({
      type  : 'ajax',
      url   : '?/warehouse/get_single_werehouse_details/'+id,
      async : false,
      dataType : 'json',
      success : function(data){  
         $('#werehousename').val(data.warehouseName);
          $('#phonenumber').val(data.PhoneNumber);
          $('#username').val(data.userName);
          // $('#password').val(data.password);
          $('#gstinumber').val(data.gstinNumber);
          $('#openingBalance').val(data.openingBalance);
          $('#Address').val(data.address);
          $('#city').val(data.city);
           $('#state').val(data.state);
           $('#pincode').val(data.pincode); 
           $('#warehouseId').val(data.warehouseId); 
           var gst_type = '';
           if (data.gst_type == 'unregistered') {
                    gst_type += '<option value="">Select GST Type</option>';
                    gst_type += '<option  selected value="unregistered">Unregistrade</option>';
                    gst_type += '<option value="registered_business_regular">Registered Business - Regular</option>';
                    gst_type += '<option value="registered_business_composition">Registered Business - Composition</option>';
           }else if(data.gst_type == 'registered_business_regular'){
                    gst_type += '<option value="">Select GST Type</option>';
                    gst_type += '<option value="unregistered">Unregistrade</option>';
                    gst_type += '<option selected  value="registered_business_regular">Registered Business - Regular</option>';
                    gst_type += '<option value="registered_business_composition">Registered Business - Composition</option>';
           }else if(data.gst_type == 'registered_business_composition'){
                    gst_type += '<option value="">Select GST Type</option>';
                    gst_type += '<option value="unregistered">Unregistrade</option>';
                    gst_type += '<option value="registered_business_regular">Registered Business - Regular</option>';
                    gst_type += '<option selected  value="registered_business_composition">Registered Business - Composition</option>';
           }else {
                    gst_type += '<option value="">Select GST Type</option>';
                    gst_type += '<option value="unregistered">Unregistrade</option>';
                    gst_type += '<option value="registered_business_regular">Registered Business - Regular</option>';
                    gst_type += '<option value="registered_business_composition">Registered Business - Composition</option>';
           }
           $('#gst_type').html(gst_type);
      }
    });

$('#edit-werehouse-details').modal('show');
}

function delete_werehouse_modal($id){
  $('#delete-werehouse').val($id);
  $('#delete_werehouse').modal('show');
}

function deletewerehouse(){
   var id = $('#delete-werehouse').val();
      $.ajax({
      type  : 'ajax',
      url   : '?/warehouse/remove_werehouse_details/'+id,
      async : false,
      dataType : 'json',
      success : function(data){
        if (data.status == '1') {
          $('#delete_werehouse').modal('hide');
          get_were_house();
         toastr.success('warehouse has been remove successfully.');
          }else{
          toastr.error('Something went wrong while removing warehouse. Please try again.');

          }
      }
      });

}

function store_status(id,status){
  // alert(status)
  var store_status = '';
  if (status !='1') {
    store_status ='1'; 
  }else{
    store_status ='0';
  }
  $.ajax({
    type: "POST",
    url: base_url+"?/warehouse/remove_werehouse_details/"+id,
    data: {status: store_status},
    dataType: "json",
    success: function(data){
      if (data.status == '1') {
        $('#change_store_status'+id).attr("onclick","store_status("+id+","+store_status+")");
        toastr.success('User status has been updated successfully.');
      } else {
        $('#change_store_status'+id).attr("onclick","store_status("+id+","+status+")");
        if(status == '0'){
          $('#change_store_status'+id). prop("checked", false);
        }else{
          $('#change_store_status'+id). prop("checked", true);
        }
        toastr.error('Something went wrong updating the status. Please try again.');
      }
    },
    error: function(data){
       $('#change_store_status'+id).attr("onclick","store_status("+id+","+status+")");
        if(status == '0'){
          $('#change_store_status'+id). prop("checked", false);
        }else{
          $('#change_store_status'+id). prop("checked", true);
        }
      toastr.error('Something went wrong updating the status. Please try again.');
    } 
  });
}



