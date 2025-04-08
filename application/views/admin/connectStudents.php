<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
  <div id="hideDiv" class="text-center"> 
    <?php echo $this->session->flashdata('message'); ?>
  </div>

  <div class="row">
  	<div class="col-md-12">
  		<div class="card shadow mb-4">
  		  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
		  </div>
		  <div class="card-body">
			<form action="<?php echo base_url('admin/connectStudents'); ?>" method="post" enctype="multipart/form-data">
			<div class="row">
			 	<div class="col-md-4 offset-md-1">
			 		<div class="form-group">
					 
						<div class="col-md-12 mt-3">

						<!-- BEGIN STUDENTS PANEL -->
						<div id="students_panel">
							<div class="form-group row">
								<div class="col-md-12">
								<?php 
									$send_type_dropdown = array('1' => 'Students Only', '2' => 'Parents Only', '3' => 'Students + Parents');
								    echo form_dropdown('send_type', $send_type_dropdown, $send_type,'class="form-control form-control-sm" id="send_type"');
				                ?>
								</div>
							</div>

							<div class="form-group row">
							    <div class="col-md-12">
						    	<?php echo form_dropdown('stu_ac_year',$acDrodown, $stu_ac_year,'class="form-control form-control-sm" id="stu_ac_year"'); ?>
					        	<span class="validationError"><?php echo form_error('stu_ac_year'); ?></span>
							    </div>
							</div>

							<div class="form-group row">
						    	<div class="col-md-12">
					    		<?php echo form_dropdown('stu_dept_id',$deptsDropdown, $stu_dept_id,'class="form-control form-control-sm" id="stu_dept_id" disabled="disabled"')?>
			        			<span class="validationError"><?php echo form_error('stu_dept_id'); ?></span>
						    	</div>
						  	</div> 

						  <div class="form-group row">
						    	<div class="col-md-12">
						    	<?php 
								  $courseOpt = array(' ' => 'Choose Course');
								  echo form_dropdown('stu_course_id', $courseOpt, $stu_course_id,'class="form-control form-control-sm" id="stu_course_id"');
						    	?>
				        		<span class="validationError"><?php echo form_error('stu_course_id'); ?></span>
						    	</div>
						  </div> 

						  <div class="form-group row">
						    	<div class="col-md-12">
						    	<?php 
						    	  $semOpt = array('0' => 'Choose Semester');
								  echo form_dropdown('stu_semester_id', $semOpt, $stu_semester_id,'class="form-control form-control-sm" id="stu_semester_id"');
						    	?>
				        		<span class="validationError"><?php echo form_error('stu_semester_id'); ?></span>
						    	</div>
						  </div> 

						  <div class="form-group row">
						    	<div class="col-md-12">
						    	<?php
						    		$secOpt = array('0' => 'Choose Section');
								  	echo form_dropdown('stu_section_id',$secOpt, $stu_section_id,'class="form-control form-control-sm" id="stu_section_id"'); ?>
				        		<span class="validationError"><?php echo form_error('stu_section_id'); ?></span>
						    	</div>
						  </div> 

						</div>
						<!-- END STUDENTS PANEL -->
 
						</div>
					</div>
			 	</div>
			 	<div class="col-md-5 offset-md-1">

			 		<div id="message_panel">
			 		<div class="form-group">
						<input type="hidden" name="send_to" id="send_to" value="">
						<div class="col-md-10" id="send_cnt">
						</div>
					</div> 
			 		
			 		<div class="form-group">
						<div class="col-md-11">
						<?php  echo form_dropdown('message_type', $message_type_dropdown, $message_type, 'class="form-control form-control-sm" id="message_type"'); ?>
		                <?=form_error('message_type','<div class="text-danger">','</div>');?>	 
						</div>
					</div>
			 		<div class="form-group">
						<div class="col-md-12">
						<label>Message</label>
						<textarea id="message" name="message" rows="7" class="form-control" placeholder="Enter your message."><?=$message;?></textarea>
						<?=form_error('message','<div class="text-danger">','</div>');?>
						<span class="error-message word-counter">0  message(s) / </span><span id="charNum" class="error-message">150 characters remaining</span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12 text-right">
						 <input type="submit" class="btn btn-primary btn-danger btn-sm" name="send" value="Send Message">
						</div>
					</div>
					</div>
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

		$("#students_panel").show();
		
		$("#stu_dept_id").attr('disabled', 'disabled');
		$("#stu_course_id").attr('disabled', 'disabled');
		$("#stu_semester_id").attr('disabled', 'disabled');
		$("#stu_section_id").attr('disabled', 'disabled');

		 
		$("#stu_ac_year").change(function(){
			event.preventDefault();
			var send_type = $("#send_type").val();
			var stu_ac_year = $("#stu_ac_year").val();
			
			if(stu_ac_year == " "){
				$('#stu_dept_id').val(' ');
				$("#stu_dept_id").attr('disabled', 'disabled');

				courses = '<option value=" ">Choose Courses</option>';
				$('select[name="stu_course_id"]').empty();
				$('select[name="stu_course_id"]').append(courses);
				$("#stu_course_id").attr('disabled', 'disabled');

				semesters = '<option value=" ">Choose Semesters</option>';
				$('select[name="stu_semester_id"]').empty();
				$('select[name="stu_semester_id"]').append(semesters);
				$("#stu_semester_id").attr('disabled', 'disabled');

				sections = '<option value=" ">Choose Sections</option>';
				$('select[name="stu_section_id"]').empty();
				$('select[name="stu_section_id"]').append(sections);
				$("#stu_section_id").attr('disabled', 'disabled');
			}else{
				$("#stu_dept_id").removeAttr('disabled');	
			}	  
		});

		$("#stu_dept_id").change(function(){
			event.preventDefault();

			var dept_id = $("#stu_dept_id").val();
			
			if(dept_id == ' '){
			    courses = '<option value=" ">Choose Courses</option>';
				$('select[name="stu_course_id"]').empty();
				$('select[name="stu_course_id"]').append(courses);
				$("#stu_course_id").attr('disabled', 'disabled');

				semesters = '<option value=" ">Choose Semesters</option>';
				$('select[name="stu_semester_id"]').empty();
				$('select[name="stu_semester_id"]').append(semesters);
				$("#stu_semester_id").attr('disabled', 'disabled');

				sections = '<option value=" ">Choose Sections</option>';
				$('select[name="stu_section_id"]').empty();
				$('select[name="stu_section_id"]').append(courses);
				$("#stu_section_id").attr('disabled', 'disabled');
			}else if(dept_id == 'all'){
				courses = '<option value="all">All Courses</option>';
				$('select[name="stu_course_id"]').empty();
				$('select[name="stu_course_id"]').append(courses);
				$("#stu_course_id").removeAttr('disabled');	
				$("#stu_course_id").attr('readonly', 'readonly');

				semesters = '<option value="all">All Semesters</option>';
				$('select[name="stu_semester_id"]').empty();
				$('select[name="stu_semester_id"]').append(semesters);
				$("#stu_semester_id").removeAttr('disabled');	
				$("#stu_semester_id").attr('readonly', 'readonly');

				sections = '<option value="all">All Sections</option>';
				$('select[name="stu_section_id"]').empty();
				$('select[name="stu_section_id"]').append(sections);
				$("#stu_section_id").removeAttr('disabled');	
				$("#stu_section_id").attr('readonly', 'readonly');
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/coursesDropdownConnect',
				'data':{'dept_id':dept_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="stu_course_id"]').empty();
					$('select[name="stu_course_id"]').append(data);
					$("#stu_course_id").removeAttr('disabled');	
					$("#stu_course_id").removeAttr('readonly');	
				}
			  });
			  
			}
		});
		
		$("#stu_course_id").change(function(){
			event.preventDefault();

			var ac_year = $("#stu_ac_year").val();
			var dept_id = $("#stu_dept_id").val();
			var course_id = $("#stu_course_id").val();
 
			if(course_id == " "){
			    semesters = '<option value=" ">Choose Semesters</option>';
				$('select[name="stu_semester_id"]').empty();
				$('select[name="stu_semester_id"]').append(semesters);
				$("#stu_semester_id").attr('disabled', 'disabled');

				sections = '<option value=" ">Choose Sections</option>';
				$('select[name="stu_section_id"]').empty();
				$('select[name="stu_section_id"]').append(sections);
				$("#stu_section_id").attr('disabled', 'disabled');
			}else if(course_id == 'all'){
			
				semesters = '<option value="all">All Semesters</option>';
				$('select[name="stu_semester_id"]').empty();
				$('select[name="stu_semester_id"]').append(semesters);
				$("#stu_semester_id").removeAttr('disabled');	
				$("#stu_semester_id").attr('readonly', 'readonly');

				sections = '<option value="all">All Sections</option>';
				$('select[name="stu_section_id"]').empty();
				$('select[name="stu_section_id"]').append(sections);
				$("#stu_section_id").removeAttr('disabled');	
				$("#stu_section_id").attr('readonly', 'readonly');
			
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/semestersDropdownConnect',
				'data':{'ac_year':ac_year, 'dept_id':dept_id, 'course_id': course_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="stu_semester_id"]').empty();
					$('select[name="stu_semester_id"]').append(data);
					$("#stu_semester_id").removeAttr('disabled');
					$("#stu_semester_id").removeAttr('readonly');		
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
			    sections = '<option value=" ">Choose Sections</option>';
				$('select[name="stu_section_id"]').empty();
				$('select[name="stu_section_id"]').append(sections);
				$("#stu_section_id").removeAttr('disabled');	
				$("#stu_section_id").attr('readonly', 'readonly');
			}else if(semester_id == 'all'){
			
				sections = '<option value="all">All Sections</option>';
				$('select[name="stu_section_id"]').empty();
				$('select[name="stu_section_id"]').append(sections);
				$("#stu_section_id").removeAttr('disabled');	
				$("#stu_section_id").attr('readonly', 'readonly');
			
			
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/sectionDropdownConnect',
				'data':{'ac_year':ac_year, 'dept_id':dept_id, 'course_id': course_id, 'semester_id': semester_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="stu_section_id"]').empty();
					$('select[name="stu_section_id"]').append(data);
					$("#stu_section_id").removeAttr('disabled');
					$("#stu_section_id").removeAttr('readonly');			
				}
			  });
			  
			}
		}); 

		function getStudents(send_type = false, ac_year = false, dept_id = false, course_id = false, semester_id = false, section_id = false){

			$.ajax({'type':'POST',
				'url':base_url+'admin/getConnectStudents',
				'data':{'send_type':send_type, 'ac_year':ac_year, 'dept_id':dept_id, 'course_id': course_id, 'semester_id': semester_id, 'section_id':section_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$("#send_cnt").html(data);
				}
			  });}

		var $remaining = $('#charNum'),
	    $messages = $remaining.prev();
	    $maxVal = 150;

		$('#message').keyup(function(){
		    var chars = this.value.length,
		        messages = Math.ceil(chars / $maxVal),
		        remaining = messages * $maxVal - (chars % (messages * $maxVal) || messages * $maxVal);

		    $remaining.text(remaining + ' characters remaining');
		    $messages.text(messages + ' message(s) / ');
		});
		
		
	});
</script>