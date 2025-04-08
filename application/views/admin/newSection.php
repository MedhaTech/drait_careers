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
		    <label class="col-sm-2 col-form-label text-right font-weight-bold">Academic Year</label>
		    <div class="col-sm-4">
		    	<?php echo form_dropdown('ac_year',$acDrodown, $ac_year,'class="form-control" id="ac_year"'); ?>
        		<span class="validationError"><?php echo form_error('ac_year'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label text-right font-weight-bold">Department</label>
		    <div class="col-sm-4">
		    	<?php echo form_dropdown('dept_id',$deptsDropdown, $dept_id,'class="form-control" id="dept_id"'); ?>
        		<span class="validationError"><?php echo form_error('dept_id'); ?></span>
		    </div>
		  </div> 

		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label text-right font-weight-bold">Course</label>
		    <div class="col-sm-4">
		    	<?php 
        			$courseOpt = array(' ' => 'Choose Course');
					echo form_dropdown('course_id', $courseOpt, '0','class="form-control" id="course_id"');
        		?>
		      	<span class="validationError"><?php echo form_error('course_id'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label text-right font-weight-bold">Semesters</label>
		    <div class="col-sm-4">
		    	<?php 
        			$semesterOpt = array(' ' => 'Choose Semester');
					echo form_dropdown('semester_id', $semesterOpt, '0','class="form-control" id="semester_id"');
        		?>
		      	<span class="validationError"><?php echo form_error('semester_id'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label text-right font-weight-bold">Section Name</label>
		    <div class="col-sm-4">
		      <input type="text" name="sections" id="sections" class="form-control" value="<?php echo (set_value('sections'))?set_value('sections'):$sections;?>">
		      <span class="validationError"><?php echo form_error('sections'); ?></span>
		    </div>
		  </div> 
		  
		  <div class="form-group row">
		  	<div class="col-sm-2"> &nbsp;</div>
		  	<div class="col-sm-10">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Submit </button>
          		<?php echo anchor('admin/sections','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" '); ?>
          	</div>
          </div>  
		  
		</form>   
    </div>
  </div>

</div>

<script>
	$(document).ready(function(){
		var base_url = '<?php echo base_url(); ?>';
		
		$("#dept_id").change(function(){
			event.preventDefault();

			var dept_id = $("#dept_id").val();

			if(dept_id == ' '){
			   alert("Please Select Depearment");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/coursesDropdown',
				'data':{'dept_id':dept_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="course_id"]').empty();
					$('select[name="course_id"]').append(data);
				}
			  });
			  
			}
		});
		
		$("#course_id").change(function(){
			event.preventDefault();

			var course_id = $("#course_id").val();

			if(course_id == ' '){
			   alert("Please Select Depearment");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/getSemesters',
				'data':{'course_id': course_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="semester_id"]').empty();
					$('select[name="semester_id"]').append(data);
				}
			  });
			  
			}
		});
		
	});
</script>