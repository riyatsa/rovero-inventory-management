get_warehouse_product();
function get_warehouse_product() {
	$.ajax({
    type  : 'ajax',
    url   : '?/wareHouseProduct/get_warehouse_barcode_image_details',
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
          if (data[i].product_status =='1') {
            check ='checked';
          }else{
            check ='';
        	}

          html+='<tr>'+
            '<td>'+j+'</td>'+
            '<td id="product_title_'+data[i].barcode_id+'">'+data[i].product_title+'</td>'+
            '<td id="barcode_'+data[i].barcode_id+'">'+data[i].barcode+'</td>'+ 
            '<td id="price_'+data[i].barcode_id+'"> '+data[i].retail_price+' </td>'+   
            '<td><a href="#" id="edit_id_'+data[i].barcode_id+' " onclick="VoucherPrint('+data[i].barcode+')" class="edit-a">print</a></td>'+
            
          '</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="4" class="text-center">No Customer found.</td>'+
        '</tr>';	
    }
    $('#get_barcode').html(html);   
  }
  });
}

function VoucherSourcetoPrint(source) {
    var path = source.barcode+'.png';
    return "<html><head><script>function step1(){\n" +
        "setTimeout('step2()', 10);}\n" +
        "function step2(){window.print();window.close()}\n" +
        "</scri" + "pt></head><body onload='step1()'>\n" +
        "<table height='96px' width='192px'><p>"+source.product_title+"</p><img src='../uploads/barcode/"+path+"' /></table></body></html>";
  }
  function VoucherPrint(source) {
    // alert(source)

    $.ajax({
    type  : 'ajax',
    url   : '?/wareHouseProduct/get_warehouse_barcode_image_details/'+source,
    async : false,
    dataType : 'json',
    success : function(data){ 
    Pagelink = "about:blank";
    var pwa = window.open(Pagelink, "_new");
    pwa.document.open();
    pwa.document.write(VoucherSourcetoPrint(data));
    pwa.document.close();
    }
  });
  }

 