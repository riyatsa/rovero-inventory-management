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
            '<td id="barcode_img_'+data[i].barcode_id+'"><img src="../uploads/barcode/'+data[i].barcode_img+'" /></td>'+   
            '<td><a href="#" id="edit_id_'+data[i].barcode_id+' " onclick="VoucherPrint('+data[i].barcode+')" class="edit-a">print</a></td>'+
            
          '</tr>';
          j++; 
        }
      }else{
        html+='<tr>'+
          '<td colspan="5" class="text-center">No Barcode found.</td>'+
        '</tr>';	
    }
    $('#get_barcode').html(html);   
  }
  });
}

function VoucherSourcetoPrint(source) {
    var path = source+'.png';
    return "<html><head><script>function step1(){\n" +
        "setTimeout('step2()', 10);}\n" +
        "function step2(){window.print();window.close()}\n" +
        "</scri" + "pt></head><body onload='step1()'>\n" +
        "<img src='../uploads/barcode/"+path+"' /></body></html>";
  }
  function VoucherPrint(source) {
    // alert(source)
    Pagelink = "about:blank";
    var pwa = window.open(Pagelink, "_new");
    pwa.document.open();
    pwa.document.write(VoucherSourcetoPrint(source));
    pwa.document.close();
  }

 