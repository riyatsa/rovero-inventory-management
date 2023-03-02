<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<style>
   * {
      box-sizing: border-box;
   }
   body {
      margin: 10px;
      padding: 0px;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
   }
   .autocomplete {
      position: relative;
      display: inline-block;
   }
   input {
      border: none;
      background-color: #f1f1f1;
      padding: 10px;
      font-size: 16px;
      border-radius: 4px;
   }
   input[type="text"] {
      background-color: #e1f6fc;
      width: 100%;
   }
   input[type="submit"] {
      background-color: DodgerBlue;
      color: #fff;
      cursor: pointer;
   }
   .autocomplete-items {
      position: absolute;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      top: 100%;
      left: 0;
      right: 0;
   }
   .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      border: 1px solid #8e26d4;
      border-bottom: 1px solid #d4d4d4;
   }
   .autocomplete-items div:hover {
      background-color: #e9e9e9;
   }
   .autocomplete-active {
      background-color: rgb(30, 255, 169) !important;
      color: #ffffff;
   }
</style>
</head>
<body>
<h1>Autocomplete Example</h1>
<form autocomplete="off">
<div class="autocomplete" style="width:300px;">
<input id="searchField" onkeyup="get_autocomplete()" type="text" name="animal" placeholder="Animals" />
</div>
<input type="submit" />
</form>
<script>
   function autocomplete(searchEle,serverResponse) {
      // alert(JSON.stringify(arr))
      var arr = JSON.parse(serverResponse)
      // return false;
      var currentFocus;

      searchEle.addEventListener("input", function(e) {
         var divCreate,
         b,
         i,
         fieldVal = this.value;
         closeAllLists();
         if (!fieldVal) {
            return false;
         }
         currentFocus = -1;
         divCreate = document.createElement("DIV");
         divCreate.setAttribute("id", this.id + "autocomplete-list");
         divCreate.setAttribute("class", "autocomplete-items");
         this.parentNode.appendChild(divCreate); 
              var btn = document.createElement("BUTTON");
                 btn.innerHTML = "CLICK ME";
                 btn.setAttribute('onclick','click_here()');
                 divCreate.appendChild(btn);
          
          // divCreate.appendHtml("<input type='submit' onclick='OpenMyFunction()' value='submit'>");
         for (i = 0; i <arr.length; i++) {
            // alert(arr[i].vendor_name)
            if ( arr[i].vendor_name.substr(0, fieldVal.length).toUpperCase() == fieldVal.toUpperCase() ) {
               b = document.createElement("DIV");
               b.innerHTML = "<strong>" + arr[i].vendor_name.substr(0, fieldVal.length) + "</strong>";
               b.innerHTML += arr[i].vendor_name.substr(fieldVal.length);
               b.innerHTML += "<input type='hidden' value='" + arr[i].vendor_name + "'>";
               b.addEventListener("click", function(e) {
                  searchEle.value = this.getElementsByTagName("input")[0].value;
                  closeAllLists();
               });
               divCreate.appendChild(b);
            }
         }
      });
      searchEle.addEventListener("keydown", function(e) {
         var autocompleteList = document.getElementById(
            this.id + "autocomplete-list"
         );
         if (autocompleteList)
            autocompleteList = autocompleteList.getElementsByTagName("div");
         if (e.keyCode == 40) {
            currentFocus++;
            addActive(autocompleteList);
         }
         else if (e.keyCode == 38) {
            //up
            currentFocus--;
            addActive(autocompleteList);
         }
         else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
               if (autocompleteList) autocompleteList[currentFocus].click();
            }
         }
      });
      function addActive(autocompleteList) {
         if (!autocompleteList) return false;
            removeActive(autocompleteList);
         if (currentFocus >= autocompleteList.length) currentFocus = 0;
         if (currentFocus < 0) currentFocus = autocompleteList.length - 1;
         autocompleteList[currentFocus].classList.add("autocomplete-active");
      }
      function removeActive(autocompleteList) {
         for (var i = 0; i < autocompleteList.length; i++) {
            autocompleteList[i].classList.remove("autocomplete-active");
         }
      }
      function closeAllLists(elmnt) {
         var autocompleteList = document.getElementsByClassName(
            "autocomplete-items"
         );
         for (var i = 0; i < autocompleteList.length; i++) {
            if (elmnt != autocompleteList[i] && elmnt != searchEle) {
               autocompleteList[i].parentNode.removeChild(autocompleteList[i]);
            }
         }
      }
      document.addEventListener("click", function(e) {
         closeAllLists(e.target);
      });
   }
    var xhReq = new XMLHttpRequest();
    xhReq.open("POST", "?/Vendor/VendorView", false);
    xhReq.send(null);
    var serverResponse = xhReq.responseText; 
    //alert(serverResponse); // Shows "15"
    // console.log(serverResponse)
   var animals = ["giraffe","tiger", "lion", "dog","cow","bull","cat","cheetah"];
   function get_autocomplete(){
      autocomplete(document.getElementById("searchField"),serverResponse);
   }

   function click_here(){
      alert('Hello, this is button click addEventListener')
   }
</script>
</body>
</html>