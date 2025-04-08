<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
        <div class="dropdown no-arrow">
        	<?php echo anchor('admin/sentConnect','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Back to List', 'class="text-danger" ');
        	?>
        </div>
	</div>
    <div class="card-body">
        <div id="hideDiv" class="text-center"> 
           <?php echo $this->session->flashdata('message'); ?>
        </div>
    	<div class="row">
    		<div class="col-sm-12">
    			<form>
              	  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Sent To : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo $Details->send_choice;?></label>
				    </div>
				  </div>

				  <?php
				  $CI =& get_instance();
				  if($Details->send_choice == "Students"){

				  	$send_type = explode(',',$Details->send_type);
				  	// print_r($send_type);

				  	$ac_year = $send_type[0];
				  	$ac_year = $CI->getAcademicYears($ac_year);

				  	$dept_id = $send_type[1];

				  ?>
				  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Staff Type : </label>
                    <div class="col-sm-9">
                      <label class="form-control-plaintext"><?php echo $Details->send_type;?></label>
                    </div>
                  </div>
              	  <?php } ?>

              	  <?php
				  $CI =& get_instance();
				  if($Details->send_choice == "Staff"){

				  	$staff_type_dropdown = array(" " => "Choose Staff Type", "Regular" => "Regular", "Visiting" => "Visiting", "Non-Teaching" => "Non-Teaching");

				  ?>
				  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Staff Type : </label>
                    <div class="col-sm-9">
                      <label class="form-control-plaintext"><?php echo $staff_type_dropdown[$Details->send_type];?></label>
                    </div>
                  </div>
              	  <?php } ?>

              	  <?php
				  $CI =& get_instance();
				  if($Details->send_choice == "Categories"){
				  ?>
				  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Category Type : </label>
                    <div class="col-sm-9">
                      <label class="form-control-plaintext"><?php echo $CI->getCategories($Details->send_type);?></label>
                    </div>
                  </div>
              	  <?php } ?>

              	  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Sent On : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo date('d-m-Y h:i A', strtotime($Details->sent_on));?></label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Message Type : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo $message_type_dropdown[$Details->category];?></label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Total Sent SMS : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php 
				      	echo ($Details->mobile_count * $Details->sms_count)." [".$Details->mobile_count." No's x ".$Details->sms_count." Msg. Length]";?>
				      </label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Message : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo $Details->message;?></label>
				    </div>
				  </div>
				</form>  
    		</div>
    	</div>
    	 
    </div>
  </div>

</div>