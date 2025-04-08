<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
	</div>
    <div class="card-body">
    	<!-- <?php print_r($facultyDetails); ?> -->
    	
        <?php echo form_open_multipart($action, 'class="user"'); ?>
		  
		  <div class="form-group row">
		    <label class="col-sm-3 col-form-label text-right font-weight-bold">Departments</label>
		    <div class="col-sm-4">
		    	<?php echo form_dropdown('dept_id',$deptDetails,$dept_id,'class="form-control" id="dept_id"'); ?>
        		<span class="validationError"><?php echo form_error('dept_id'); ?></span>
		    </div>
		  </div> 

		  <div class="form-group row">
		    <label class="col-sm-3 col-form-label text-right font-weight-bold">Course Type</label>
		    <div class="col-sm-4">
		    	<?php $courseTypeOpt = array('' => 'Choose', 'UG' => 'UG', 'PG' => 'PG');
					echo form_dropdown('course_type', $courseTypeOpt, '0','class="form-control" id="course_type"'); ?>
        		<span class="validationError"><?php echo form_error('course_type'); ?></span>
		    </div>
		  </div> 

		  <div class="form-group row">
		    <label class="col-sm-3 col-form-label text-right font-weight-bold">Course Name</label>
		    <div class="col-sm-4">
		      <input type="text" name="course_name" id="course_name" class="form-control" value="<?php echo (set_value('course_name'))?set_value('course_name'):$course_name;?>">
		      <span class="validationError"><?php echo form_error('course_name'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label class="col-sm-3 col-form-label text-right font-weight-bold">No. of Semesters</label>
		    <div class="col-sm-4">
		      <input type="text" name="semesters" id="semesters" class="form-control" value="<?php echo (set_value('semesters'))?set_value('semesters'):$semesters;?>">
		      <span class="validationError"><?php echo form_error('semesters'); ?></span>
		    </div>
		  </div> 
		  
		  <div class="form-group row">
		  	<div class="col-sm-3"> &nbsp;</div>
		  	<div class="col-sm-9">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Submit </button>
          		<?php echo anchor('admin/departments','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" '); ?>
          	</div>
          </div>  
		  
		</form>   
    </div>
  </div>

</div>
