<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
	</div>
    <div class="card-body">
    	<!-- <?php print_r($facultyDetails); ?> -->
    	
        <?php echo form_open($action, 'class="user"'); ?>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">About Department : </label>
		    <div class="col-sm-10">
		      <textarea id="about" name="about" class="form-control" rows=6><?php echo (set_value('about'))?set_value('about'):$departmentsDetails->about;?></textarea>
		      <span class="validationError"><?php echo form_error('about'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Department Profile : </label>
		    <div class="col-sm-10">
		      <textarea id="profile" name="profile" class="form-control" rows=6><?php echo (set_value('profile'))?set_value('profile'):$departmentsDetails->profile;?></textarea>
		      <span class="validationError"><?php echo form_error('profile'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Vision : </label>
		    <div class="col-sm-10">
		      <textarea id="vision" name="vision" class="form-control" rows=6><?php echo (set_value('vision'))?set_value('vision'):$departmentsDetails->vision;?></textarea>
		      <span class="validationError"><?php echo form_error('vision'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Mission : </label>
		    <div class="col-sm-10">
		      <textarea id="mission" name="mission" class="form-control" rows=6><?php echo (set_value('mission'))?set_value('mission'):$departmentsDetails->mission;?></textarea>
		      <span class="validationError"><?php echo form_error('mission'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		  	<div class="col-sm-2"> &nbsp;</div>
		  	<div class="col-sm-10">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Update</button>
          		<?php
        			echo anchor('admin/departments/','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" ');
        		?>
          	</div>
          </div>  
		  
		</form>   
    </div>
  </div>

</div>
