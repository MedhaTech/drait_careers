<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
  <div id="hideDiv" class="text-center"> 
    <?php echo $this->session->flashdata('message'); ?>
  </div>

  <div class="row">
  	<div class="col-md-12">
  		<div class="card shadow mb-4">
  		  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Connect - Send SMS to Categories</h6>
		  </div>
		  <div class="card-body">
			<?=form_open($action);?>
			<div class="row">
			 	<div class="col-md-4 offset-md-1">
			 		<div class="form-group">
						 
						<div class="col-md-12 mt-3">
							
							<div class="form-group">
								<div class="col-md-12">
								<label class="font-weight-bold">Categories</label>
								<?php 
									echo form_dropdown('category_id', $category_dropdown,  $category_id, 'class="form-control form-control-sm" id="category_id"'); ?>
				                <span class="validationError"><?php echo form_error('category_id'); ?></span>
								</div>
							</div>	

							<div class="form-group">
								<div class="col-md-12">
								<label class="font-weight-bold">Message Type</label>
								<?php  echo form_dropdown('message_type', $message_type_dropdown,  $message_type, 'class="form-control form-control-sm" id="message_type"'); ?>
				                <span class="validationError"><?php echo form_error('message_type'); ?></span>
								</div>
							</div>	
						  	 
						   
							 
						</div>

					</div>
			 	</div>
			 	<div class="col-md-5 offset-md-1">
			 		
			 		<div class="form-group">
						<div class="col-md-12">
						<label class="font-weight-bold">Message</label>
						<textarea id="message" name="message" rows="7" class="form-control" placeholder="Enter your message."><?=$message;?></textarea>
						<span class="validationError"><?php echo form_error('message'); ?></span>
						<span class="error-message word-counter">0  message(s) / </span><span id="charNum" class="error-message">150 characters remaining</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12 text-right">
						 <!-- <button id="send_btn" name="send_btn" type="submit" class="btn btn-sm btn-primary btn-square"> <i class="fas fa-send push-5-r"></i> Send Message </button> -->
						 <button type="submit" class="btn btn-primary btn-sm btn-square" name="send" id="send">Send Message </button>
						</div>
					</div>
			 	</div>
			 </div>				  
			<?=form_close();?>
		  </div>
  		</div>
  	</div>
  </div>        

</div>

<script>
	$(document).ready(function(){
		var base_url = '<?php echo base_url(); ?>';

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

<style>
    /*.message_panel {
    	pointer-events: none;
	}
	#message_panel {
    	pointer-events: none;
	}*/
    </style>