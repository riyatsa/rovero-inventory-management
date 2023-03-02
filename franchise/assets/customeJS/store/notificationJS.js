function load_unseen_notification(id = ''){
    $.ajax({
      url:"?/StoreDashboard/notification/"+id,
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
                output+='<a id="dropdown_submit" onclick="load_unseen_notification('+data[i].sales_id+')" href="?/StoreOrder/warehouse_approved_products"  class="dropdown-item">';
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