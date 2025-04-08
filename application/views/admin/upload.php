<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
  <div id="hideDiv" class="text-center"> 
    <?php echo $this->session->flashdata('message'); ?>
  </div>

  <div class="row">
  	<div class="col-md-8 offset-md-2">
  		<div class="card shadow mb-4">
  		  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Student Details Upload</h6>
		  </div>
		  <div class="card-body">
			<form action="<?php echo base_url('admin/studentImport'); ?>" method="post" enctype="multipart/form-data">			  
						  <div class="form-group row">
						    <label class="col-sm-3 col-form-label text-right font-weight-bold">Academic Year</label>
						    <div class="col-sm-7">
						    	<?php echo form_dropdown('stu_ac_year',$acDrodown, '','class="form-control" id="stu_ac_year"'); ?>
				        		<span class="validationError"><?php echo form_error('stu_ac_year'); ?></span>
						    </div>
						  </div>

						  <div class="form-group row">
						    <label class="col-sm-3 col-form-label text-right font-weight-bold">Department</label>
						    <div class="col-sm-7">
						    	<?php echo form_dropdown('stu_dept_id',$deptsDropdown, '','class="form-control" id="stu_dept_id"'); ?>
				        		<span class="validationError"><?php echo form_error('stu_dept_id'); ?></span>
						    </div>
						  </div> 

						  <div class="form-group row">
						    <label class="col-sm-3 col-form-label text-right font-weight-bold">Course</label>
						    <div class="col-sm-7">
						    	<?php 
								  $courseOpt = array('0' => 'Choose Course');
								  echo form_dropdown('stu_course_id', $courseOpt, '0','class="form-control" id="stu_course_id"');
						    	?>
				        		<span class="validationError"><?php echo form_error('stu_course_id'); ?></span>
						    </div>
						  </div> 

						  <div class="form-group row">
						    <label class="col-sm-3 col-form-label text-right font-weight-bold">Semester</label>
						    <div class="col-sm-7">
						    	<?php 
						    	  $semOpt = array('0' => 'Choose Semester');
								  echo form_dropdown('stu_semester_id', $semOpt, '0','class="form-control" id="stu_semester_id"');
						    	?>
				        		<span class="validationError"><?php echo form_error('stu_semester_id'); ?></span>
						    </div>
						  </div> 

						  <div class="form-group row">
						    <label class="col-sm-3 col-form-label text-right font-weight-bold">Section</label>
						    <div class="col-sm-7">
						    	<?php
						    		$secOpt = array('0' => 'Choose Section');
								  	echo form_dropdown('stu_section_id',$secOpt, '','class="form-control" id="stu_section_id"'); ?>
				        		<span class="validationError"><?php echo form_error('stu_section_id'); ?></span>
						    </div>
						  </div> 

						  <div class="form-group row">
						    <label class="col-sm-3 col-form-label text-right font-weight-bold">Upload</label>
						    <div class="col-sm-4">
						    	<input type="file" name="file" />
						    </div>
						  </div> 
				  
						  <div class="form-group row">
						  	<div class="col-sm-3"> &nbsp;</div>
						  	<div class="col-sm-9">
						  		<input type="submit" class="btn btn-primary btn-danger btn-sm" name="importStudent" value="Upload Student">
						  		<?php echo anchor('admin/students','Student List', 'class="btn btn-sm btn-success"');?>
				          	</div>
				          </div>  
			</form>   
		  </div>
  		</div>
  	</div>
  </div>        

</div>

<script>
	$(document).ready(function(){
		var base_url = '<?php echo base_url(); ?>';
		
		$("#stu_dept_id").change(function(){
			event.preventDefault();

			var dept_id = $("#stu_dept_id").val();
			
			if(dept_id == ' '){
			   alert("Please Select Depearment");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/coursesDropdown',
				'data':{'dept_id':dept_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="stu_course_id"]').empty();
					$('select[name="stu_course_id"]').append(data);
				}
			  });
			  
			}
		});
		
		$("#stu_course_id").change(function(){
			event.preventDefault();

			var ac_year = $("#stu_ac_year").val();
			var dept_id = $("#stu_dept_id").val();
			var course_id = $("#stu_course_id").val();
 
			if(course_id == ' '){
			   alert("Please Select Course");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/semestersDropdown1',
				'data':{'ac_year':ac_year, 'dept_id':dept_id, 'course_id': course_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="stu_semester_id"]').empty();
					$('select[name="stu_semester_id"]').append(data);
				}
			  });
			  
			}
		});

		$("#stu_semester_id").change(function(){
			event.preventDefault();

			var ac_year = $("#stu_ac_year").val();
			var dept_id = $("#stu_dept_id").val();
			var course_id = $("#stu_course_id").val();
			var semester_id = $("#stu_semester_id").val();
 
			if(semester_id == ' '){
			   alert("Please Select Semester");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/sectionDropdown',
				'data':{'ac_year':ac_year, 'dept_id':dept_id, 'course_id': course_id, 'semester_id': semester_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="stu_section_id"]').empty();
					$('select[name="stu_section_id"]').append(data);
				}
			  });
			  
			}
		});
		
	});
</script>