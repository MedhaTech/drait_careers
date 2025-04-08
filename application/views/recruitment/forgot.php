<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
        <div class="col-lg-3 d-none d-lg-block  titlePanel px-5 py-5">
            
          </div>
          <div class="col-lg-6 bg-gray-100" >
            <div class="p-5">
              <div class="text-center">
                  
               
                <h1 class="h4 font-weight-bold text-gray-900">Dr.AIT Recruitment Portal</h1>
                <p class='mb-4'>Forgot Password
</p>
                <?php if(isset($msg)){
                if($msg=='success')
                {
                    echo " <p class='mb-4'> Email-id successufully verified</p>";
                }
                else
                {
                      echo " <p class='mb-4'> Something went wrong!</p>";
                }
                
                }?>
              </div>
              <?php echo form_open($action, 'class="user"'); ?>
              	<?php echo '<span class="text-danger">'.validation_errors().'</span>'; ?> 
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Email ID</label>
                    <input class="form-control form-control-user" type="text" placeholder="Enter Email" name="email" id="email" autocomplete="off">
                </div>
                
               
                  
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-user btn-block" name="login" id="login">Reset Password</button>
                </div>  
                
                <hr>
                <div class="text-center">
                    <!--<a class="small" href="forgot-password.html">Forgot Password?</a>-->
                    <?php echo anchor('recruitment/index',"Login Here",'class="small"'); ?>
                </div>
              
                                    
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>