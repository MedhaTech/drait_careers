<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
  <div id="hideDiv" class="text-center"> 
    <?php echo $this->session->flashdata('message'); ?>
  </div>

  <div class="row">
  	<div class="col-md-12">
  		<div class="card shadow mb-4">
  		  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Connect - Compose SMS</h6>
		  </div>
		  <div class="card-body">
			<form method="post" enctype="multipart/form-data">			  
			<div class="row">
			 	<div class="col-md-4 offset-md-1">
			 		<div class="form-group">
						<div class="col-md-12">
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" class="custom-control-input" id="defaultInline1" name="choice" value="Students" checked>
							  <label class="custom-control-label" for="defaultInline1">Students</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" class="custom-control-input" id="defaultInline2" name="choice" value="Staff">
							  <label class="custom-control-label" for="defaultInline2">Staff</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" class="custom-control-input" id="defaultInline3" name="choice" value="Categories">
							  <label class="custom-control-label" for="defaultInline3">Categories</label>
							</div>
						</div>
						<div class="col-md-12 mt-3">

						<!-- BEGIN STUDENTS PANEL -->
						<div id="students_panel">
							<div class="form-group row">
								<div class="col-md-12">
								<?php 
									$send_type_dropdown = array('1' => 'Students Only', '2' => 'Parents Only', '3' => 'Students + Parents');
								    echo form_dropdown('send_type', $send_type_dropdown, '0','class="form-control form-control-sm" id="send_type"');
				                ?>
								</div>
							</div>

							<div class="form-group row">
							    <div class="col-md-12">
						    	<?php echo form_dropdown('stu_ac_year',$acDrodown, '','class="form-control form-control-sm" id="stu_ac_year"'); ?>
					        	<span class="validationError"><?php echo form_error('stu_ac_year'); ?></span>
							    </div>
							</div>

							<div class="form-group row">
						    	<div class="col-md-12">
					    		<?php echo form_dropdown('stu_dept_id',$deptsDropdown, '','class="form-control form-control-sm" id="stu_dept_id" disabled="disabled"')?>
			        			<span class="validationError"><?php echo form_error('stu_dept_id'); ?></span>
						    	</div>
						  	</div> 

						  <div class="form-group row">
						    	<div class="col-md-12">
						    	<?php 
								  $courseOpt = array('0' => 'Choose Course');
								  echo form_dropdown('stu_course_id', $courseOpt, '0','class="form-control form-control-sm" id="stu_course_id"');
						    	?>
				        		<span class="validationError"><?php echo form_error('stu_course_id'); ?></span>
						    	</div>
						  </div> 

						  <div class="form-group row">
						    	<div class="col-md-12">
						    	<?php 
						    	  $semOpt = array('0' => 'Choose Semester');
								  echo form_dropdown('stu_semester_id', $semOpt, '0','class="form-control form-control-sm" id="stu_semester_id"');
						    	?>
				        		<span class="validationError"><?php echo form_error('stu_semester_id'); ?></span>
						    	</div>
						  </div> 

						  <div class="form-group row">
						    	<div class="col-md-12">
						    	<?php
						    		$secOpt = array('0' => 'Choose Section');
								  	echo form_dropdown('stu_section_id',$secOpt, '','class="form-control form-control-sm" id="stu_section_id"'); ?>
				        		<span class="validationError"><?php echo form_error('stu_section_id'); ?></span>
						    	</div>
						  </div> 


						</div>
						<!-- END STUDENTS PANEL -->

						<!-- BEGIN STAFF PANEL -->
						<div id="staff_panel" style="visibility:none;">
							<div class="form-group row">
						    	<div class="col-md-12">
					    		<?php echo form_dropdown('sta_dept_id',$deptsDropdown, '','class="form-control form-control-sm" id="sta_dept_id"')?>
			        			<span class="validationError"><?php echo form_error('sta_dept_id'); ?></span>
						    	</div>
						  	</div> 	

						  	<div class="custom-control custom-checkbox">
							    <input type="checkbox" class="custom-control-input" name="staff_type" id="staff_type1" value="Regular">
							    <label class="custom-control-label" for="staff_type1">Regular</label>
							</div>
							<div class="custom-control custom-checkbox">
							    <input type="checkbox" class="custom-control-input" name="staff_type" id="staff_type2" value="Visiting">
							    <label class="custom-control-label" for="staff_type2">Visiting</label>
							</div>
							<div class="custom-control custom-checkbox">
							    <input type="checkbox" class="custom-control-input" name="staff_type" id="staff_type3" value="Non-Teaching">
							    <label class="custom-control-label" for="staff_type3">Non-Teaching</label>
							</div>
						</div>
						<!-- END STAFF PANEL -->

						<!-- BEGIN CATEGORIES PANEL -->
						<div id="categories_panel" style="visibility:none;">
							CATEGORIES
						</div>
						<!-- END CATEGORIES PANEL -->
						</div>
					</div>
			 	</div>
			 	<div class="col-md-5 offset-md-1">

			 		<div id="proceed_panel">
			 		<div class="form-group">
						<div class="col-md-12 text-center">
						 <button id="proceed_button" name="proceed_button" type="button" class="btn btn-sm btn-primary btn-square"> Proceed to Send SMS </button>
						</div>
					</div>
					</div>

			 		<div id="message_panel" style="display: none;">
			 		<div class="form-group">
						<input type="hidden" name="send_to" id="send_to" value="">
						<div class="col-md-10" id="send_cnt">
						</div>
					</div> 
			 		
			 		<div class="form-group">
						<div class="col-md-11">
						<?php  echo form_dropdown('message_type', $message_type_dropdown, '0','class="form-control form-control-sm" id="message_type"'); ?>
		                <?=form_error('message_type','<div class="text-danger">','</div>');?>	 
						</div>
					</div>
			 		<div class="form-group">
						<div class="col-md-12">
						<label>Message</label>
						<textarea id="message" name="message" rows="7" class="form-control" placeholder="Enter your message."></textarea>
						<?=form_error('message','<div class="text-danger">','</div>');?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12 text-right">
						 <button id="send_btn" name="send_btn" type="button" class="btn btn-sm btn-primary btn-square"> <i class="fas fa-send push-5-r"></i> Send Message </button>
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
		$("#staff_panel").hide();
		$("#categories_panel").hide();
		$("#message_panel").hide();

		$("#stu_dept_id").attr('disabled', 'disabled');
		$("#stu_course_id").attr('disabled', 'disabled');
		$("#stu_semester_id").attr('disabled', 'disabled');
		$("#stu_section_id").attr('disabled', 'disabled');

		$('input[type=radio][name=choice]').change(function() {
			if (this.value == 'Students') {
				$("#students_panel").show();
				$("#staff_panel").hide();
				$("#categories_panel").hide();
			}
			if (this.value == 'Staff') {
				$("#students_panel").hide();
				$("#staff_panel").show();
				$("#categories_panel").hide();
			}
			if (this.value == 'Categories') {
				$("#students_panel").hide();
				$("#staff_panel").hide();
				$("#categories_panel").show();
			}
		});
		
		$("#stu_ac_year").change(function(){
			event.preventDefault();
			var send_type = $("#send_type").val();
			var stu_ac_year = $("#stu_ac_year").val();
			
			if(stu_ac_year == " "){
				$('#stu_dept_id').val('0');
				$("#stu_dept_id").attr('disabled', 'disabled');
			}else{
				$("#stu_dept_id").removeAttr('disabled');	
			}
			getStudents(send_type);
			console.log(send_type);			
				  
		});

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

		$('#proceed_button').click(function(e) {
			event.preventDefault();
			var choice = $('input:radio[name=choice]:checked').val();
			switch(choice){
				case "Students":
					alert("Students");
					break;
				case "Staff":
					var dept_id = $("#sta_dept_id").val();
					if(dept_id != 0){
						var staff_type = [];
						$.each($("input[name='staff_type']:checked"), function(){            
			            	staff_type.push($(this).val());
			            });
						if(staff_type != ""){
							$("#proceed_panel").hide();
							$("#message_panel").show();		
							// sessionStorage.setItem("lastname", "Smith");
							$.ajax({'type':'POST',
								'url':base_url+'admin/staffMobile',
								'data':{'dept_id':dept_id, 'staff_type': staff_type},
								'dataType':'text',
								'cache':false,
								'success':function(data){
									console.log(data);
									// $('select[name="stu_section_id"]').empty();
									// $('select[name="stu_section_id"]').append(data);
								}
							});

						}else{
							alert("Select Staff Type");
						}
					}else{
						alert("Select Depearment");
					}
					break;
				case "Categories":
					alert("Categories");
					break;
			}
		}); 

		 

		$('input[name=staff_type]').change(function() {
		// $(".staff_type").change(function(){
			event.preventDefault();      
			// $('#message_panel').css('pointer-events', 'none');

			var staff_type = [];
			$.each($("input[name='staff_type']:checked"), function(){            
            	staff_type.push($(this).val());
            });

			var dept_id = $("#sta_dept_id").val();
			if(dept_id == 0){
				alert("Select Depearment");
			}else{

			}
			// if(staff_type == ''){
			//    $("#send_to").val('');
			//    $("#send_cnt").html("<p class='text-danger'> Total Count:0</p>");
			// }else{ 
			//   $.ajax({'type':'POST',
			// 	'url':base_url+'admin_home/connectStaffType',
			// 	'data':{'staff_type':staff_type},
			// 	'dataType':'json',
			// 	'cache':false,
			// 	'success':function(data){
			// 		$("#send_to").val(data.mobile);
			// 		$("#send_cnt").html("<p class='text-danger'> Total Count:"+data.cnt+"</p>");
			// 	}
			//   });
			  
			// }
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

			
		
		
	});
</script>

<style>
    /*.message_panel {
    	pointer-events: none;
	}
	#message_panel {
    	pointer-events: none;
	}*/
    </style>