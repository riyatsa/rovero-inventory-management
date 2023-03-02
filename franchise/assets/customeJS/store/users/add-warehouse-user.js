var alphabets_only = /^[A-Za-z ]+$/;

get_werehouseusers();
function get_werehouseusers() {
	$.ajax({
    type  : 'ajax',
    url   : '?/wareHouseDashboard/get_warehouse_users/',
    async : false,

    dataType : 'json',
    success : function(data){
      // alert(JSON.stringify(data))
      let html='';
      if (data.length > 0) {
        var j = 1;
        for (var i = 0; i < data.length; i++) {
          var check =''; 
          if (data[i].users_status =='1') {
            check ='checked';
          }else{
            check ='';
        	}

          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td>'+data[i].userName+'</td>'+
            '<td>'+data[i].email+'</td>'+
            '<td>'+data[i].role+'</td>'+ 
                            '<td>'+
                 '<a href="javascript::void(0)" onclick="edit_werehouse('+data[i].usersId+')"><i class="fa fa-pencil fa-pencil-edit ml-2"></i></a>'+
               '<div class="custom-control custom-switch d-inline">'+
                '<input type="checkbox" '+check+' onclick="users_status('+data[i].usersId +','+data[i].users_status+')" class="custom-control-input px-1" id="change_gst_status'+data[i].usersId +'">'+
                '<label class="custom-control-label" for="change_gst_status'+data[i].usersId +'"></label>'+
              '</div>'+
          '</tr>';
          j++;
        }
      }else{
        html+='<tr>'+
          '<td colspan="5" class="text-center">No Customer found.</td>'+
        '</tr>';	
    }
    $('#warehouse-users').html(html);   
  }
  });
}



$('#w-role').change(function(){
  var role = $('#w-role').val(); 
  $('#w-role-error-msg-div').html('');
  if (role != '') { 
      $('#edit-w-role-error-msg-div').html(''); 
   
  } else {
    $('#w-role-error-msg-div').html('<span class="text-danger error-msg-small">Please Select User Role.</span>');  
  }
});

$("#werehousename").keyup(function(){
  var werehousename = $('#werehousename').val();
  if (werehousename != '') {
    if (!alphabets_only.test(werehousename)) {
      $('#werehousename-error-msg-div').html('<span class="text-danger error-msg-small">name should have only alphabets</span>');
      $('#werehousename').focus();
      $('#werehousename').val(werehousename.slice(0,-1));
    } else {
      $('#werehousename-error-msg-div').html('');
    }
  } else {
    $('#werehousename-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the name.</span>');
  }
});

$("#w-email").keyup(function() {
  var email = $("#w-email").val();
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
          let html = "<span class='text-danger error-msg'>Please fill Valid Email.</span>";
    $('#w-email-error-msg-div').html(html); 
    }else{
       $('#w-email-error-msg-div').html(""); 
    }
});

$("#w-password").keyup(function(){
    var password = $('#w-password').val();
  if (password != '') {
    if (password.length < 8) {
      $("#w-password-error-msg-div").html('<span class="text-danger error-msg">Password should be minimum of 8 characters.</span>');
    } else {
      $("#w-password-error-msg-div").html('');
    }
  } else {
    $("#w-password-error-msg-div").html('<span class="text-danger error-msg">Please enter your password.</span>');
  }
});


function save_warehouse_user(){
    var role = $('#w-role').val(); 
    var werehousename = $('#werehousename').val();
    var email = $("#w-email").val();
    var password = $('#w-password').val();

    if (role !='' && werehousename !='' && email !='' && password !='') {
      var formdata = new FormData();
  $('#cancel_add_new_product_btn').prop('disabled',true);
  $('#add_new_product_btn').prop('disabled',true);
  $('#add_new_product_btn').css('background','#b3b3b3');
  $('#werehouse-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding warehouse User.</span>');

  formdata.append('role',role);
  formdata.append('userName',werehousename);
  formdata.append('email',email);
  formdata.append('password',password); 

  $.ajax({
      type: "POST",
        url: base_url+"?/wareHouseDashboard/add_warehouseusers/",
        data:formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
          if (data.status == '1') { 
            // $('#w-role').val(); 
            $('#werehousename').val('');
            $("#w-email").val('');
            $('#w-password').val('');

          toastr.success('New warehouse has been added successfully.');
          }else{
          toastr.error('Something went wrong while adding warehouse Users. Please try again.');

          }
          $('#cancel_add_new_product_btn').prop('disabled',false);
          $('#add_new_product_btn').prop('disabled',false);
          $('#add_new_product_btn').css('background','#1D3327');
          $('#werehouse-error').html('');
        }
    }); 
    }else{
        if (role != '') { 
        $('#edit-w-role-error-msg-div').html(''); 

        } else {
        $('#w-role-error-msg-div').html('<span class="text-danger error-msg-small">Please Select User Role.</span>');  
        }

        if (werehousename != '') {
          if (!alphabets_only.test(werehousename)) {
          $('#werehousename-error-msg-div').html('<span class="text-danger error-msg-small">name should have only alphabets</span>');
          $('#werehousename').focus();
          $('#werehousename').val(werehousename.slice(0,-1));
          } else {
          $('#werehousename-error-msg-div').html('');
          }
        } else {
        $('#werehousename-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the name.</span>');
        }

        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
          let html = "<span class='text-danger error-msg'>Please fill Valid Email.</span>";
          $('#w-email-error-msg-div').html(html); 
        }else{
          $('#w-email-error-msg-div').html(""); 
        }

        if (password !='') {
          if (password.length < 8) {
            $("#w-password-error-msg-div").html('<span class="text-danger error-msg">Password should be minimum of 8 characters.</span>');
          } else {
            $("#w-password-error-msg-div").html('');
          }
        } else {
        $("#w-password-error-msg-div").html('<span class="text-danger error-msg">Please enter your password.</span>');
        }
    }
}


function edit_werehouse(id){

    $.ajax({
      type  : 'ajax',
      url   : '?/wareHouseDashboard/get_wereehous_single_user/'+id,
      async : false,
      dataType : 'json',
      success : function(data){  
          // $('#w-role').val(data.role); 
         $('#edit-werehousename').val(data.userName);
         $("#edit-w-email").val(data.email);
         // $('#edit-w-password').val();
           $('#usersId').val(data.usersId); 
           var usersId = '';
           if (data.role == 'superviser') {
                    usersId +='<option value="">Select Role</option>';
                    usersId +='<option selected value="superviser">Super Visor</option>';
                    usersId +='<option value="selsuser">Sels User</option>';
           }else if(data.role == 'selsuser'){
                    usersId +='<option value="">Select Role</option>';
                    usersId +='<option value="superviser">Super Visor</option>';
                    usersId +='<option selected value="selsuser">Sels User</option>';
           }else {
                    usersId +='<option value="">Select Role</option>';
                    usersId +='<option value="superviser">Super Visor</option>';
                    usersId +='<option value="selsuser">Sels User</option>';
           }
           $('#edit-w-role').html(usersId);
      }
    });

$('#edit-warehouse-users').modal('show');
}



$('#edit-w-role').change(function(){
  var role = $('#edit-w-role').val(); 
  $('#edit-w-role-error-msg-div').html('');
  if (role != '') { 
      $('#edit-w-role-error-msg-div').html(''); 
   
  } else {
    $('#edit-w-role-error-msg-div').html('<span class="text-danger error-msg-small">Please Select User Role.</span>');  
  }
});

$("#edit-werehousename").keyup(function(){
  var werehousename = $('#edit-werehousename').val();
  if (werehousename != '') {
    if (!alphabets_only.test(werehousename)) {
      $('#edit-werehousename-error-msg-div').html('<span class="text-danger error-msg-small">name should have only alphabets</span>');
      $('#edit-werehousename').focus();
      $('#edit-werehousename').val(werehousename.slice(0,-1));
    } else {
      $('#edit-werehousename-error-msg-div').html('');
    }
  } else {
    $('#edit-werehousename-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the name.</span>');
  }
});

$("#edit-w-email").keyup(function() {
  var email = $("#edit-w-email").val();
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
          let html = "<span class='text-danger error-msg'>Please fill Valid Email.</span>";
    $('#edit-w-email-error-msg-div').html(html); 
    }else{
       $('#edit-w-email-error-msg-div').html(""); 
    }
});

$("#edit-w-password").keyup(function(){
    var password = $('#edit-w-password').val();
  if (password != '') {
    if (password.length < 8) {
      $("#edit-w-password-error-msg-div").html('<span class="text-danger error-msg">Password should be minimum of 8 characters.</span>');
    } else {
      $("#edit-w-password-error-msg-div").html('');
    }
  } else {
    $("#edit-w-password-error-msg-div").html('<span class="text-danger error-msg">Please enter your password.</span>');
  }
});


function edit_update_warehouse_btn(){
    var role = $('#edit-w-role').val(); 
    var werehousename = $('#edit-werehousename').val();
    var email = $("#edit-w-email").val();
    var usersId = $('#usersId').val();
    alert(role)
    alert(werehousename)
    alert(email)
    if (role !='' && werehousename !='' && email !='' && usersId !='') {
      var formdata = new FormData(); 
  $('#edit-werehouse-error').html('<span class="d-block text-warning error-msg">Please wait while we are adding warehouse User.</span>');

  formdata.append('role',role);
  formdata.append('userName',werehousename);
  formdata.append('email',email);
  // formdata.append('usersId',usersId); 

  $.ajax({
      type: "POST",
        url: base_url+"?/wareHouseDashboard/update_warehouseusers/"+usersId,
        data:formdata,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
          if (data.status == '1') { 
            // $('#w-role').val(); 
            $('#werehousename').val('');
            $("#w-email").val('');
            $('#w-password').val('');
             $('#edit-werehouse-error').html('');
             $('#edit-warehouse-users').modal('hidden');
          toastr.success('New warehouse has been update successfully.');
          }else{
          toastr.error('Something went wrong while updating warehouse Users. Please try again.');

          }
          $('#cancel_add_new_product_btn').prop('disabled',false);
          $('#add_new_product_btn').prop('disabled',false);
          $('#add_new_product_btn').css('background','#1D3327');
          $('#werehouse-error').html('');
        }
    }); 
    }else{
        if (role != '') { 
        $('#edit-w-role-error-msg-div').html(''); 

        } else {
        $('#w-role-error-msg-div').html('<span class="text-danger error-msg-small">Please Select User Role.</span>');  
        }

        if (werehousename != '') {
          if (!alphabets_only.test(werehousename)) {
          $('#werehousename-error-msg-div').html('<span class="text-danger error-msg-small">name should have only alphabets</span>');
          $('#werehousename').focus();
          $('#werehousename').val(werehousename.slice(0,-1));
          } else {
          $('#werehousename-error-msg-div').html('');
          }
        } else {
        $('#werehousename-error-msg-div').html('<span class="text-danger error-msg-small">Please enter the name.</span>');
        }

        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
          let html = "<span class='text-danger error-msg'>Please fill Valid Email.</span>";
          $('#w-email-error-msg-div').html(html); 
        }else{
          $('#w-email-error-msg-div').html(""); 
        }

        
    }
}


function users_status(id,status){
  var users_status = '';
  if (status !='1') {
    gst_status ='1';
  }else{
    gst_status ='0';
  }
  $.ajax({
    type: "POST",
    url: base_url+"?/wareHouseDashboard/update_warehouse_users_status/"+id,
    data: {users_status: users_status},
    dataType: "json",
    success: function(data){
      if (data.status == '1') {
        $('#change_gst_status'+id).attr("onclick","users_status("+id+","+users_status+")");
        toastr.success('Users status has been updated successfully.');
      } else {
        $('#change_gst_status'+id).attr("onclick","users_status("+id+","+status+")");
        if(status == '0'){
          $('#change_gst_status'+id). prop("checked", false);
        }else{
          $('#change_gst_status'+id). prop("checked", true);
        }
        toastr.error('Something went wrong updating the users status. Please try again.');
      }
    },
    error: function(data){
       $('#change_gst_status'+id).attr("onclick","users_status("+id+","+status+")");
        if(status == '0'){
          $('#change_gst_status'+id). prop("checked", false);
        }else{
          $('#change_gst_status'+id). prop("checked", true);
        }
      toastr.error('Something went wrong updating the users status. Please try again.');
    } 
  });
}
