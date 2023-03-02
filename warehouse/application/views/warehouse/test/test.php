
<style>
	#project-label {
display: block;
font-weight: bold;
margin-bottom: 1em;
}
#project-icon {
float: left;
height: 32px;
width: 32px;
}
#project-description {
margin: 0;
padding: 0;
}
 
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="/" class="header-left-tab-a">Admin Panel / </a>
              <span class="header-left-tab-span">Coupon</span>
            </label>
          </div>
        </div>
      </div>
    </div>

<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12"> 
<div id="project-label">Select a project (type "s" for a start):</div>
<input id="project" class="proj">
<input type="text" id="project-id">
<p id="project-description"></p>
</div>
</div>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-md-12"> 
<div id="project-label">Select a project (type "s" for a start):</div>
<input id="project1" class="proj">
<input type="text" id="project-id1">
<p id="project-description1"></p>
</div>
</div>
</div>
</section>
</div>
<script>
	$(function() {

 var xhReq = new XMLHttpRequest();
 xhReq.open("POST", "?/WareHouseProduct/getProductCategory", false);
 xhReq.send(null);
 var serverResponse = xhReq.responseText;
 // alert(serverResponse); // Shows "15"
//overriding jquery-ui.autocomplete .js functions
$.ui.autocomplete.prototype._renderMenu = function(ul, items) {
  var self = this;
  //table definitions
  ul.append("<div class='content-wrapper'><div class='container-fluid'><div class='row'> <table class='table table-responsive'><thead><tr><th>ID#</th><th>Name</th><th>Cool&nbsp;Points</th></tr></thead><tbody></tbody></table></div></div></div>");
  $.each( items, function( index, item ) {
    self._renderItemData(ul, ul.find("table tbody"), item );
  });
};
$.ui.autocomplete.prototype._renderItemData = function(ul,table, item) {
  return this._renderItem( table, item ).data( "ui-autocomplete-item", item );
};
$.ui.autocomplete.prototype._renderItem = function(table, item) {
  return $( "<tr class='ui-menu-item' role='presentation'></tr>" )
    //.data( "item.autocomplete", item )
    .append( "<td >"+item.id+"</td>"+"<td>"+item.value+"</td>"+"<td>"+item.cp+"</td>" )
    .appendTo( table );
};
//random json values
var projects = [
	{id:1,value:"Thomas",cp:134},
    {id:65,value:"Richard",cp:1743},
    {id:235,value:"Harold",cp:7342},
    {id:78,value:"Santa Maria",cp:787},
    {id:75,value:"Gunner",cp:788},
    {id:124,value:"Shad",cp:124},
    {id:1233,value:"Aziz",cp:3544},
    {id:244,value:"Buet",cp:7847}
];
/*$( ".proj" ).autocomplete({
	minLength: 1,
	source: projects,
    
	focus: function( event, ui ) {
		console.log(ui.item.value);
        $( "#project" ).val( ui.item.value );
		$( "#project-id" ).val( ui.item.id );
		$( "#project-description" ).html( ui.item.cp );
		return false;
	}
})*/
$(".proj").on('keyup',function(index) {
	 var MyID = $(this).attr("id");
	 // alert(MyID)
	 var number = MyID.match(/\d+/);
	 // alert(number)
	 if (number ==null) {
	 	number ='';
	 }
	 $( "#"+MyID ).autocomplete({ 
		minLength: 1,
		source: projects,
	    
		focus: function( event, ui ) {
			console.log(ui.item.value);
	        $( "#project"+number ).val( ui.item.value );
			$( "#project-id"+number ).val( ui.item.id );
			$( "#project-description"+number ).html( ui.item.cp );
			return false;
		}
	})
});


});
</script>
<script type="text/javascript">
    
    var myArray = [
        { "id" : "1", "firstName" : "Hardik", "lastName" : "Savani" }, 
        { "id" : "2", "firstName" : "Vimal", "lastName" : "Kashiyani" }, 
        { "id" : "3", "firstName" : "Harshad", "lastName" : "Pathak" }, 
        { "id" : "4", "firstName" : "Harsukh", "lastName" : "Makawana" }
      ];
    
      var myObj = [];
   
      $.each(myArray, function (i, value) {
          myObj.push({firstName: value.firstName, lastName: value.lastName});
      });  
   
      console.log(myObj);
   
</script>