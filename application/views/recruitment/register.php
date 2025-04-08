<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
   <div class="row">
        <div class="col-lg-3 d-none d-lg-block  titlePanel px-5 py-5">
           
          </div>
          <div class="col-lg-6 bg-gray-100">
            <div class="p-5">
              <div class="text-center">
               
                <h1 class="h4 font-weight-bold text-gray-900">Dr.AIT Recruitment Portal</h1>
                <p class='mb-4'>Use registered Email-id to Login into the portal</p>
              </div>
              <?php echo form_open($action, 'class="user"'); ?>
              	 
                
                <div class="form-group">
                    <label for="name" class='font-weight-bold'>Candidate Name</label>
                    <input class="form-control form-control-user" type="text" placeholder="Enter Candidate Name" id="candidate_name" name="candidate_name"  autocomplete="off"  value="<?php echo (set_value('candidate_name'))?set_value('candidate_name'):'';?>">
                    <span class="validationError"><?php echo form_error('candidate_name'); ?></span>
                </div>
                 <div class="form-group">
                    <label for="name" class='font-weight-bold'>Mobile number</label>
                    <input class="form-control form-control-user" type="text" placeholder="Enter Mobile number" name="mobile" id="mobile" autocomplete="off" value="<?php echo (set_value('mobile'))?set_value('mobile'):'';?>">
                    <span class="validationError"><?php echo form_error('mobile'); ?></span>
                </div>
                <div class="form-group">
                    <label for="name" class='font-weight-bold'>Email ID</label>
                    <input class="form-control form-control-user" type="text" placeholder="Enter Email" name="email" id="email" autocomplete="off" value="<?php echo (set_value('email'))?set_value('email'):'';?>">
                    <span class="validationError"><?php echo form_error('email'); ?></span>
                </div>
                
                <div class="form-group">
                  <label for="password" class='font-weight-bold'>Password</label>
                  <input class="form-control form-control-user" type="password" placeholder="Enter Password" name="password" id="password" value="<?php echo (set_value('password'))?set_value('password'):'';?>">
                  <span class="validationError"><?php echo form_error('password'); ?></span>
                </div>
                
                <div class="form-group">
                  <label for="password" class='font-weight-bold'>Confirm Password</label>
                  <input class="form-control form-control-user" type="password" placeholder="Enter Confirm Password" name="passconf" id="passconf"  value="<?php echo (set_value('passconf'))?set_value('passconf'):'';?>">
                  <span class="validationError"><?php echo form_error('passconf'); ?></span>
                </div>
                  
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-user btn-block" name="register" id="register">Register</button>
                </div>  
                
                <hr>
                 
                <div class="text-center">
                    <?php echo anchor('recruitment',"Already registered, Click here to Login",'class="small"'); ?>
                </div>
                                    
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>