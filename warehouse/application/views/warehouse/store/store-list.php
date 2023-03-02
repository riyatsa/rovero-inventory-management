   
 
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
             <a href="<?php echo base_url()?>?/warehouse-panel" class="header-left-tab-a">Warehouse Panel / </a>
              <span class="header-left-tab-span">Product List</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="product-tabs-container"> 
          <section class="content">
            <div class="container-fluid">

              <div class="text-center" id="customer-status"></div>
               <!-- <button class="btn btn-add text-white mt-0 float-right" onclick="addGstModal()" id="add_gst_btn" name="add_gst_btn">Add GST</button> -->
               
               <select id="select_warehouse" class="col-sm-3 mt-2 form-control input-txt float-right">
                 <option selected value="">Select Store</option>
                 
               </select>
              <div class="table-responsive mt-3" id="">
              <span class="d-block medium-text mb-2">Store Products</span>
                <table class="datatable table table-striped">
                  <thead class="thead-bd-color">
                    <tr>
                      <th>Sr No.</th>
                      <th>Product Title</th>
                      <th>Barcode</th> 
                      <th>Quantity</th> 
                      <th>Unit Name</th> 
                      <th>Sale Price</th>
                      <th>Purchase Price</th>
                      <!-- <th>Active/Deactive</th>
                      <th>Edit</th> -->
                    </tr>
                  </thead>
                  <tbody class="tbody-datatable" id="get_customers">
                     <!-- Custom code will be hear in data table  -->
                  </tbody>
                </table>
              </div>
            </div>
          </section> 
        </div>
      </div>
    </section>
  </div>
 
 
<script src="<?php echo base_url()?>assets/customeJS/product/store-product.js"></script> 