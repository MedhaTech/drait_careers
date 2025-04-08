<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
	</div>
    <div class="card-body">
    	<!-- <?php print_r($studentDetails); ?> -->
        <?php echo form_open($action, 'class="user"'); ?>
		  <div class="form-group row">
		    <label class="col-sm-3 col-form-label text-right font-weight-bold"> USN : </label>
		    <div class="col-sm-9">
		      <input type="text" name="usn" id="usn" class="form-control" value="<?php echo (set_value('usn'))?set_value('usn'):$studentDetails->usn;?>">
		      <span class="validationError"><?php echo form_error('usn'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-3 col-form-label text-right font-weight-bold"> Student Name : </label>
		    <div class="col-sm-9">
		      <input type="text" name="student_name" id="student_name" class="form-control" value="<?php echo (set_value('student_name'))?set_value('student_name'):$studentDetails->student_name;?>">
		      <span class="validationError"><?php echo form_error('student_name'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-3 col-form-label text-right font-weight-bold"> Student Mobile : </label>
		    <div class="col-sm-9">
		      <input type="text" name="student_mobile" id="student_mobile" class="form-control" value="<?php echo (set_value('student_mobile'))?set_value('student_mobile'):$studentDetails->student_mobile;?>">
		      <span class="validationError"><?php echo form_error('student_mobile'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-3 col-form-label text-right font-weight-bold"> Parent Mobile : </label>
		    <div class="col-sm-9">
		      <input type="text" name="parent_mobile" id="parent_mobile" class="form-control" value="<?php echo (set_value('parent_mobile'))?set_value('parent_mobile'):$studentDetails->parent_mobile;?>">
		      <span class="validationError"><?php echo form_error('parent_mobile'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		  	<div class="col-sm-3"> &nbsp;</div>
		  	<div class="col-sm-9">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Update</button>
          		<?php
        			echo anchor('admin/students','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" ');
        		?>
          	</div>
          </div>  
		  
		</form>   
    </div>
  </div>

</div>
