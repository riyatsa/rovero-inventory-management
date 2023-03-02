function load_unseen_notification(id = ''){
    $.ajax({
      url:"?/WareHouseDashboard/notification/"+id,
      method:"POST",
      dataType:"json",
      success:function(data){
      console.log(data); 
        var  output= '';
        if (data.length > 0) {
        $('#notifications-d').show();
        $('#notificationCount').html(data.length)
          for (var i = data.length - 1; i >= 0; i--) { 

                output+='<div class="dropdown-divider"></div>';
                output+='<a id="dropdown_submit" onclick="load_unseen_notification('+data[i].purchase_id+')" href="?/PurchaseOrder/storePurchsedetails"  class="dropdown-item">';
                output+='<i class="fas fa-envelope mr-2"></i>';
                output+='<span class="text-muted text-sm">Purchase Bill number is '+data[i].bill_number+'</span>';
                output+='</a>';
                        
          }       

          $('#dropdown-menu').html(output);
       }else{
        $('#notifications-d').hide();
       }
      }
    });
  }

  load_unseen_notification();
     
  setInterval(function(){ 
    load_unseen_notification();; 
  }, 15000);

  function load_unseen_notification_1(id = ''){
    $.ajax({
      url:"?/WareHouseDashboard/notification_1/"+id,
      method:"POST",
      dataType:"json",
      success:function(data){
      console.log("new"+data); 
        var  output= '';
        if (data.length > 0) {
        $('#notifications-d_1').show();
        $('#notificationCount_1').html(data.length)
          for (var i = data.length - 1; i >= 0; i--) { 

                output+='<div class="dropdown-divider"></div>';
                output+='<a id="dropdown_submit" onclick="load_unseen_notification_1('+data[i].sales_id+')" href="?/PurchaseOrder/storePurchsedetails"  class="dropdown-item">';
                output+='<i class="fas fa-envelope mr-2"></i>';
                output+='<span class="text-muted text-sm">Return Bill number is '+data[i].bill_number+'</span>';
                output+='</a>';
                        
          }       

          $('#dropdown-menu_1').html(output);
       }else{
        $('#notifications-d_1').hide();
       }
      }
    });
  }

  load_unseen_notification_1();
     
  setInterval(function(){ 
    load_unseen_notification_1();; 
  }, 15000);