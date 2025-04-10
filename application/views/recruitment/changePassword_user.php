<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
		
	</div>
    <div class="card-body">
    	<div id="hideDiv" class="text-center"> 
           <?php echo $this->session->flashdata('message'); ?>
        </div>
        
    	<?php echo form_open($action, 'class="user"'); ?>

		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Mobile Number : </label>
		    <div class="col-sm-10">
		      <input type="text" name="mobile" id="mobile" class="form-control col-sm-8" value="<?php echo (set_value('mobile'))?set_value('mobile'):$mobile;?>" readonly>
		      <span class="validationError"><?php echo form_error('mobile'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Old Password : </label>
		    <div class="col-sm-10">
		      <input type="password" name="oldPassword" id="oldPassword" class="form-control col-sm-8" value="<?php echo (set_value('oldPassword'))?set_value('oldPassword'):$oldPassword;?>">
		      <span class="validationError"><?php echo form_error('oldPassword'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">New Password : </label>
		    <div class="col-sm-10">
		      <input type="password" name="newPassword" id="newPassword" class="form-control col-sm-8" value="<?php echo (set_value('newPassword'))?set_value('newPassword'):$newPassword;?>">
		      <span class="validationError"><?php echo form_error('newPassword'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		  	<div class="col-sm-2"> &nbsp;</div>
		  	<div class="col-sm-10">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Update</button>
          		<a href="<?=base_url();?>recruitment/profile" class="btn  btn-primary">Back</a>
          	</div>
          </div>  


    	</form>  
    </div>
  </div>

</div>
