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
        			    echo form_dropdown('dept_id',$deptsDropdown,'0','class="form-control" id="dept_id"');
        			?>
        		</div>
        		<div class="col-md-2">
        			<?php 
        				$courseOpt = array('0' => 'All Courses');
						echo form_dropdown('course_id', $courseOpt, '0','class="form-control" id="course_id"');
        			?>
        		</div>
        		<div class="col-md-2">
        			<?php 
        				$semOpt = array('0' => 'All Semesters');
					echo form_dropdown('semester_id', $semOpt, '0','class="form-control" id="semester_id"');
        			?>
        		</div>
        		<div class="col-md-2">
        			<?php 
        				$secOpt = array('0' => 'All Sections');
					echo form_dropdown('section_id', $secOpt, '0','class="form-control" id="section_id"');
        			?>
        		</div>
        		<div class="col-md-4">
        			<button class="btn btn-primary btn-square btn-sm" id="filter"><i class="fa fa-filter"></i> Filter</button>
        			<?php echo anchor('admin/upload','<i class="fas fa-upload"></i> Upload', 'class="btn btn-sm btn-success"');?>
        		</div>
        </div>
        
          <div id="hideDiv" class="text-center"> 
    		<?php echo $this->session->flashdata('message'); ?>
    	  </div>
    	
    	<div class="block-content" id="res">
    		<h5 class="text-center mt-5 text-danger">Students Count</h5>
			<?php
				if($studentsStats){
					
					$table_setup = array ('table_open'=> '<table class="table table-bordered table-hover" id="dataTable1" width="100%" cellspacing="0">');
			        $this->table->set_template($table_setup);
			        $this->table->set_heading(
									array('data' => 'S.No', 'width' => "5%"),
			        				array('data' => 'Department', 'width' => "20%"),
			                        array('data' => 'Course Name', 'width' => "20%"),
			                        // array('data' => 'Semester', 'width' => "20%"),
			                        // array('data' => 'Section', 'width' => "20%"),
			                        array('data' => 'Count', 'width' => "15%")
			                        );		
					$i=1;
				    foreach ($studentsStats as $studentsStats1) {

				      		$this->table->add_row($i++,
						      		  $studentsStats1->department_name,
						      		  $studentsStats1->course_type.' - '.$studentsStats1->course_name,
						      		  // $studentsStats1->semester,
						      		  // $studentsStats1->sections,
						      		  $studentsStats1->cnt
				                );
				      }
				      $data['table']=$this->table->generate();			 		 

			 		 echo $data['table'];
				}
			?>	                          
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

			var dept_id = $("#dept_id").val();
			var course_id = $("#course_id").val();
 
			if(course_id == ' '){
			   alert("Please Select Depearment");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/semestersDropdown1',
				'data':{'dept_id':dept_id, 'course_id': course_id},
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

			var dept_id = $("#dept_id").val();
			var course_id = $("#course_id").val();
			var semester_id = $("#semester_id").val();
 
			if(semester_id == ' '){
			   alert("Please Select Semester");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/sectionDropdown',
				'data':{'dept_id':dept_id, 'course_id': course_id, 'semester_id': semester_id, 'type': 'All'},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="section_id"]').empty();
					$('select[name="section_id"]').append(data);
				}
			  });
			  
			}
		});


		
		$("#filter").click(function(){
			event.preventDefault();
			$("#res").hide();
			$("#process").show();
	            	
	        var dept_id = $("#dept_id").val();
			var course_id = $("#course_id").val();
			var semester_id = $("#semester_id").val();
			var section_id = $("#section_id").val();
			 
			 
			$.ajax({'type':'POST',
				'url':base_url+'admin/studentsFilter',
				'data':{'dept_id':dept_id, 'course_id':course_id, 'semester_id':semester_id, 'section_id': section_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$("#process").hide();
					$("#res").show();
					$("#res").html(data);
				}
				});
		});
		
		jQuery('.students-dataTable').dataTable({
	            columnDefs: [ { orderable: false, targets: [ 1 ] } ],
	            pageLength: 50,
	            lengthMenu: [[50,100], [50, 100]]
	        });
	});
</script>