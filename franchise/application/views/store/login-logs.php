  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <label>
              <a href="/" class="header-left-tab-a">Admin Panel / </a>
              <span class="header-left-tab-span">Login Logs</span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="text-center" id="customer-status"></div>
        <span class="d-block medium-text">All Login Logs</span>
        <div class="table-responsive mt-3" id="">
          <table class="datatable table table-striped">
            <thead class="thead-bd-color">
              <tr>
                <th>Sr No.</th>
                <th>User Name</th>
                <th>Email ID</th>
                <th>Role</th>
                <th>User IP</th> 
                <th>Logged Date</th>
              </tr>
            </thead>
            <tbody class="tbody-datatable" id="login-logs"> 
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>

<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/warehouse/login-logs.js"></script>
