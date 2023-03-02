   
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">WareHouse Panel / </a>
              <span class="header-left-tab-span">Purchase Order</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="product-tabs-container">
          <!-- <ul class="nav nav-tabs d-none" role="tablist">
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/product-category">Add Product Category</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link active nav-link-add-product nav-link-product-tab" href="#" >Add Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-product-tab" href="?/warehouse-product-details" >View All Product</a>
            </li>
          </ul> -->
          <div class="tab-content">
             <form novalidate action="#" method="post">
<section id="party">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-3">
            <div class="form-group string required search_field">
               <label>Party</label>
               <input class="string required form-control" type="text" name="search_field" id="search_field" />
            </div>
         </div>
         <div class="col-md-5"></div>
         <div class="col-md-3">
            <div class="row">
               <div class="col-md-4">
                  <div class="tp-txt">Bill Number</div>
               </div>
               <div class="col-md-8">
                  <div class="tp-bx">
                     <div class="form-group">
                        <input class="form-control tp-fld" type="text" placeholder="12">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="tp-txt">Bill Date</div>
               </div>
               <div class="col-md-8">
                  <div class="tp-bx">
                     <div class="form-group">
                        <input class="form-control tp-fld2" type="date" placeholder="07/10/2020">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="tp-txt">State of Supply</div>
               </div>
               <div class="col-md-8">
                  <div class="tp-bx">
                     <div class="form-group">
                        <select class="form-control tp-fld">
                          <option>None</option>
                          <option>2</option>
                          <option>3</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-1"></div>
           <div id="price-error" class="col-md-12 text-center"></div>
      </div>
   </div>
   <div class="w-100">
      <div class="party-tbl">
<table id="party" class="table table-striped">
  <thead>
    <tr>
      <th width="2%" rowspan="2" scope="col">#</th>
      <th width="30%" rowspan="2" scope="col">Item</th>
      <th width="9%" rowspan="2" scope="col">Item Code</th>
      <th width="7%" rowspan="2" scope="col">Qty</th>
      <th width="7%" rowspan="2" scope="col">Unit</th>
      <th width="7%" rowspan="2" scope="col" class="price aln-cntr-price">
         Price/Unit
         <div class="tax">
            <div class="form-group">
            <select class="form-control tax-fld"  id="tax_type" >
               <option value="0">Tax Included</option>
               <option value="1">Tax Excluded</option>
            </select>
            </div>
         </div>
      </th>
      <th colspan="2" align="center" scope="col" class="aln-cntr">Discount</th>
      <th colspan="2" scope="col" class="aln-cntr">Tax</th>
      <th width="10%" rowspan="2" valign="middle" scope="col">Amount</th>
    </tr>
    <tr>
      <th width="7%" scope="col" class="aln-cntr">%</th>
      <th width="5%" scope="col" class="aln-cntr aln-cntr-amt">Amount</th>
      <th width="10%" scope="col" class="aln-cntr">%</th>
      <th width="5%" scope="col" class="aln-cntr aln-cntr-amt">Amount</th>
      </tr>
  </thead>
  <tbody>
    <tr id='addr0'>
      <th scope="row"><input type="hidden" class="hidden_row" value="0">1</th>
      <td>
         <div class="form-group">
            <input class="form-control tbl-fld" type="text" placeholder="Cheri">
         </div>
      </td>
      <td>
         <div class="form-group">
            <input class="form-control tbl-fld" type="text" placeholder="1234567">
         </div>
      </td>
      <td>
         <div class="form-group">
            <input class="form-control tbl-fld" onkeyup="sumMyvalue()" id="qty" type="text" placeholder="1">
         </div>
      </td>
      <td>
         <div class="form-group">
            <select class="form-control tbl-fld2">
               <option>None</option>
               <option>2</option>
               <option>3</option>
            </select>
         </div>
      </td>
      <td>
         <div class="form-group">
            <input class="form-control tbl-fld" onkeyup="sumMyvalue()" type="text" id="price" placeholder="25">
         </div>
      </td>
      <td>
         <div class="form-group">
            <input class="form-control tbl-fld" onkeyup="sumMyvalue()" id="discount" type="text">
         </div>
      </td>
      <td>
         <div class="form-group">
            <input class="form-control tbl-fld" onkeyup="sumMyvalue()" id="discount_price" type="text">
         </div>
      </td>
      <td>
         <div class="form-group">
            <select class="form-control tbl-fld2" onchange="sumMyvalue()" id="main_gst">
               <option value="">Eligible for ITC</option>
               <option value="5">GST@5%</option>
               <option value="">None</option>
            </select>
         </div>
      </td>
      <td>
         <div class="form-group">
            <input class="form-control tbl-fld" type="text" onkeyup="sumMyvalue()" id="gst_price" placeholder="1.25">
         </div>
      </td>
      <td>
         <div class="form-group">
            <input class="form-control tbl-fld sub_amount" type="text" onkeyup="sumMyvalue()" id="total_price" placeholder="26.25">
         </div>
      </td>
    </tr>
    <tr id='addr1'></tr>
  </tbody>
</table>
<table width="100%" class="table table-striped">
  <thead>
  <tr>
    <td width="2%">1</td>
    <td width="30%"><a id="add_row" class="btn add-btn">Add Row</a><div class="total-txt">Total</div></td>
    <td width="16%" class="text-right">2</td>
    <td width="7%">&nbsp;</td>
    <td width="7%">&nbsp;</td>
    <td class="text-right"><span id="main_total">0</span></td>
  </tr>
  </thead>
</table>
      </div>
   </div>
   <div class="container-fluid">
      <div class="party-ftr">
         <div class="row">
            <div class="col-md-3">
               <div class="form-group">
                  <label>Payment Type</label>
                  <select class="form-control  tbl-fld1">
                     <option>Cheque</option>
                     <option>Online</option>
                     <option>Cash</option>
                  </select>
               </div>
               <div class="form-group">
                  <input class="form-control tbl-fld1" type="text" placeholder="Reference Number">
               </div>
               <div class="form-group">
                  <textarea class="form-control tbl-fld3" name="" cols="" rows="" placeholder="Description"></textarea>
               </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-3">
               <div class="form-group row">
                  <label class="col-md-3 col-form-label text-right ln-ht-25">Total</label>
                  <div class="col-md-9">
                     <input type="text" readonly class="form-control tbl-fld3 text-right" id="main_total_amount" value="0">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-form-label text-right ln-ht-25">Paid</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control tbl-fld3 text-right" value="0">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-form-label text-right ln-ht-25"><strong>Balance</strong></label>
                  <div class="col-md-9">
                     <div class="text-right ln-ht-25"><span id="balance_total"></span></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<div class="w-100">
   <div class="save-bx">
      <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6"></div>
         <div class="col-md-3">
            <div class="save-btn"><a href="#">Save</a></div>
         </div>
      </div>
   </div>
</div>
</section>
</form>
</div>
</div>
</div>
</section>
</div>

<script src="<?php echo base_url()?>assets/customeJS/product/product-order.js"></script>


