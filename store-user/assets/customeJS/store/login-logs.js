get_login_logs();
function get_login_logs() {
	$.ajax({
    type  : 'ajax',
    url   : '?/loginLogs/loginLogView/',
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
          if (data[i].customer_status =='1') {
            check ='checked';
          }else{
            check ='';
        	}

          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td>'+data[i].userName+'</td>'+
            '<td>'+data[i].email+'</td>'+
            '<td>'+data[i].role+'</td>'+
            '<td>'+data[i].ipAddress+'</td>'+
            '<td>'+data[i].timeDate+'</td>'+ 
          '</tr>';
          j++;
        }
      }else{
        html+='<tr>'+
          '<td colspan="6" class="text-center">No Customer found.</td>'+
        '</tr>';	
    }
    $('#login-logs').html(html);   
  }
  });
}
