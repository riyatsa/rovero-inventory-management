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
              <!-- <tr>
                <td>Brunoi Tandel</td>
                <td>ab@gm.com</td>
                <td>9876543210</td>
                <td>12/05/2020</td>
                <td>77</td>
                <td>7</td>
                <td>
                  <div class="custom-control custom-switch d-inline">
                    <input type="checkbox" class="custom-control-input" id="change_status_customer_1">
                    <label class="custom-control-label" for="change_status_customer_1"></label>
                  </div>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>

<!-- Custome JS --> 
<script src="<?php echo base_url()?>assets/customeJS/admin-js/login-logs.js"></script>
