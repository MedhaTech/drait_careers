<style>
  .logo {
    width: auto;
    height: auto;
    margin-top: 150px !important;
}
  </style>
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7 d-none d-lg-block text-center bg-gray-100 titlePanel">
            <img src="<?= base_url();?>assets/images/full_logo-wide.png" class="logo"/>
            <h3 class="text-danger">ADMIN PANEL</h3>
          </div>
          <div class="col-lg-5">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login into Account</h1>
              </div>
              <?php echo form_open($action, 'class="user"'); ?>
              	<?php echo '<span class="text-danger">'.validation_errors().'</span>'; ?> 
                <div class="form-group">
                    <label for="name">Username</label>
                    <input class="form-control form-control-user" type="text" placeholder="Enter Username" name="username" autocomplete="off">
                </div>
                
                <div class="form-group">
                  <label for="password">Password</label>
                  <input class="form-control form-control-user" type="password" placeholder="Enter Password" name="password">
                </div>
                  
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-user btn-block" name="login" id="login">Login</button>
                </div>  
                
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>