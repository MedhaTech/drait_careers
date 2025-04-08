<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
	</div>
    <div class="card-body">
    	<div class="row mb-3">
        		<div class="col-md-2">
        			<?php 
        			    echo form_dropdown('ac_year', $academicYears, $getactiveAY, 'class="form-control" id="ac_year"');
        			?>
        		</div>
        		<div class="col-md-2">
        			<?php 
        			    echo form_dropdown('dept_id',$deptsDropdown,'0','class="form-control" id="dept_id"');
        			?>
        		</div>
        		<div class="col-md-2">
        			<?php 
        				$courseOpt = array('0' => 'Courses');
						echo form_dropdown('course_id', $courseOpt, '0','class="form-control" id="course_id"');
        			?>
        		</div>
        		<div class="col-md-2">
        			<?php 
        				$semOpt = array('0' => 'Semesters');
					echo form_dropdown('semester_id', $semOpt, '0','class="form-control" id="semester_id"');
        			?>
        		</div>
        		<div class="col-md-2">
        			<?php 
        				$secOpt = array('0' => 'Sections');
					echo form_dropdown('section_id', $secOpt, '0','class="form-control" id="section_id"');
        			?>
        		</div>
        		<div class="col-md-2">
        			<button class="btn btn-primary btn-square btn-sm" id="filter"><i class="fa fa-filter"></i> Filter</button>
        		</div>
        </div>
        
        <div id="hideDiv" class="text-center"> 
    		<?php echo $this->session->flashdata('message'); ?>
    	</div>
    	
    	<div class="block-content" id="studentsPanel">
    		<div class="row">
    		  <div class="col-md-12">
    		  	<table class="table table-bordered table-hover" id="dataTable11" width="100%" cellspacing="0">
    		  	  <thead>
				  <tr>
				   <th width="3%">
                        <input id="selectall" name="selectall" type="checkbox">
				   </th>
				   <th width="15%">USN</th>
				   <th width="27%">Student Name</th>
				   <th width="15%">Section</th>
				   <th width="20%">Student Mobile</th>
				   <th width="20%">Parent Mobile</th>
				  </tr>
				  </thead>
				  <tbody id="res">
				  </tbody>
    		  	</table>
    		  </div>
    		</div>                   
    		<div class="row mt-3 mb-3">
	        	<div class="col-md-2">
	       			<?php 
	       				$academicYears = array(" " => "Academic Year") + $academicYears;
		  				echo form_dropdown('ac_year1', $academicYears, '0', 'class="form-control" id="ac_year1"');
	       			?>
	       		</div>
	        	<div class="col-md-2">
	        		<?php 
	       			    echo form_dropdown('dept_id1',$deptsDropdown,'0','class="form-control" id="dept_id1"');
	       			?>
	       		</div>
	       		<div class="col-md-2">
	       			<?php 
	       				$courseOpt = array('0' => 'Courses');
						echo form_dropdown('course_id1', $courseOpt, '0','class="form-control" id="course_id1"');
	        		?>
	        	</div>
	        	<div class="col-md-2">
	       			<?php 
	       				$semOpt = array('0' => 'Semesters');
						echo form_dropdown('semester_id1', $semOpt, '0','class="form-control" id="semester_id1"');
	        		?>
	       		</div>
	        	<div class="col-md-2">
	       			<?php 
	       				$secOpt = array('0' => 'Sections');
						echo form_dropdown('section_id1', $secOpt, '0','class="form-control" id="section_id1"');
	       			?>
	        	</div>
	       		<div class="col-md-2">
	       			<button class="btn btn-primary btn-square btn-sm" id="promote"><i class="fa fa-exchange-alt"></i> Promote </button>
	       		</div>
	        </div>
	    </div>
	    <div class="row">
	        <div class="col-md-12 text-center" id="process" style="display: none;">
                    <?='<img src="'.base_url().'assets/img/Processing.gif"/>'; ?>                           
        	</div>
        </div>


    </div>
  </div>

</div>

<script>
	$(document).ready(function(){
		var base_url = '<?php echo base_url(); ?>';
		$("#studentsPanel").hide();

		$('#selectall').on('click',function(){
		        if(this.checked){
		            $('.check').each(function(){
		                this.checked = true;
		            });
		        }else{
		             $('.check').each(function(){
		                this.checked = false;
		            });
		        }
		    });

		$('.check').on('click',function(){
			if($('.check:checked').length == $('.check').length){
		    	$('#selectall').prop('checked',true);
			}else{
		    	$('#selectall').prop('checked',false);
			}
		});

		$("#dept_id").change(function(){
			event.preventDefault();

			var dept_id = $("#dept_id").val();
			
			if(dept_id == ' '){
			   alert("Please Select Depearment");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/promoteCoursesDropdown',
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

			var ac_year = $("#ac_year").val();
			var dept_id = $("#dept_id").val();
			var course_id = $("#course_id").val();
 
			if(course_id == ' '){
			   alert("Please Select Depearment");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/promoteSemestersDropdown',
				'data':{'ac_year':ac_year, 'dept_id':dept_id, 'course_id': course_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="semester_id"]').empty();
					$('select[name="semester_id"]').append(data);
				}
			  });
			  
			}
		});

		$("#semester_id").change(function(){
			event.preventDefault();

			var ac_year = $("#ac_year").val();
			var dept_id = $("#dept_id").val();
			var course_id = $("#course_id").val();
			var semester_id = $("#semester_id").val();
 
			if(semester_id == ' '){
			   alert("Please Select Semester");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/promoteSectionDropdown',
				'data':{'ac_year':ac_year, 'dept_id':dept_id, 'course_id': course_id, 'semester_id': semester_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="section_id"]').empty();
					$('select[name="section_id"]').append(data);
				}
			  });
			  
			}
		});


		$("#ac_year1").change(function(){
			event.preventDefault();

			var dept_id = $("#dept_id1").val();
			
			if(dept_id == ' '){
			   alert("Please Select Depearment");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/promoteCoursesDropdown',
				'data':{'dept_id':dept_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="course_id1"]').empty();
					$('select[name="course_id1"]').append(data);
				}
			  });
			  
			}
		});


		$("#dept_id1").change(function(){
			event.preventDefault();

			var dept_id = $("#dept_id1").val();
			
			if(dept_id == ' '){
			   alert("Please Select Depearment");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/promoteCoursesDropdown',
				'data':{'dept_id':dept_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="course_id1"]').empty();
					$('select[name="course_id1"]').append(data);
				}
			  });
			  
			}
		});
		
		$("#course_id1").change(function(){
			event.preventDefault();

			var ac_year = $("#ac_year1").val();
			var dept_id = $("#dept_id1").val();
			var course_id = $("#course_id1").val();
 
			if(course_id == ' '){
			   alert("Please Select Depearment");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/promoteSemestersDropdown',
				'data':{'ac_year':ac_year, 'dept_id':dept_id, 'course_id': course_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="semester_id1"]').empty();
					$('select[name="semester_id1"]').append(data);
				}
			  });
			  
			}
		});

		$("#semester_id1").change(function(){
			event.preventDefault();

			var ac_year = $("#ac_year1").val();
			var dept_id = $("#dept_id1").val();
			var course_id = $("#course_id1").val();
			var semester_id = $("#semester_id1").val();
 
			if(semester_id == ' '){
			   alert("Please Select Semester");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/promoteSectionDropdown',
				'data':{'ac_year':ac_year, 'dept_id':dept_id, 'course_id': course_id, 'semester_id': semester_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="section_id1"]').empty();
					$('select[name="section_id1"]').append(data);
				}
			  });
			  
			}
		});
		
		$("#filter").click(function(){
			event.preventDefault();
			$("#res").hide();
			$("#process").show();
	        
	        var ac_year = $("#ac_year").val();    	
	        var dept_id = $("#dept_id").val();
			var course_id = $("#course_id").val();
			var semester_id = $("#semester_id").val();
			var section_id = $("#section_id").val();
			 
			 
			$.ajax({'type':'POST',
				'url':base_url+'admin/promoteStudentsFilter',
				'data':{'ac_year':ac_year, 'dept_id':dept_id, 'course_id':course_id, 'semester_id':semester_id, 'section_id': section_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$("#process").hide();
					$("#studentsPanel").show();
					$("#res").show();
					$("#dept_id1").val(dept_id);
					$("#res").html(data);
				}
				});
		});

		$("#promote").click(function(){
			event.preventDefault();
			// $("#res").hide();
			// $("#process").show();
	        
	        var ac_year = $("#ac_year1").val();    	
	        var dept_id = $("#dept_id1").val();
			var course_id = $("#course_id1").val();
			var semester_id = $("#semester_id1").val();
			var section_id = $("#section_id1").val();
			
			if (ac_year == "0" || dept_id == "0" || course_id == "0" || semester_id == "0" || section_id == "0"){
				$("#err").html("Select Semester and Section..!!!");
			}else{
				var check1 = [];
				var check = [];
				$('input[name="students"]:checked').each(function() {
					   check.push($(this).val());
					   check1 = check.join(", ");
				});

				$.ajax({'type':'POST',
					'url':base_url+'admin/promoteStudentsUpdate',
					'data':{'ac_year':ac_year, 'dept_id':dept_id, 'course_id':course_id, 'semester_id':semester_id, 'section_id': section_id, 'students':check1},
					'dataType':'text',
					'cache':false,
					'success':function(data){
						var redirect = base_url + 'admin/promoteStudents';
						window.location.replace(redirect);
						// $("#process").hide();
						// $("#studentsPanel").show();
						// $("#res").show();
						// $("#studentsPanel").html(data);
					}
				});
			}
				
		});
		
		jQuery('.students-dataTable').dataTable({
	            columnDefs: [ { orderable: false, targets: [ 1 ] } ],
	            pageLength: 50,
	            lengthMenu: [[50,100], [50, 100]]
	        });
	});
</script>