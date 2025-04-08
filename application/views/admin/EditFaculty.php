<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
	</div>
    <div class="card-body">
    	<!-- <?php print_r($facultyDetails); ?> -->
        <?php echo form_open($action, 'class="user"'); ?>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Name : </label>
		    <div class="col-sm-9">
		      <input type="text" name="name" id="name" class="form-control" value="<?php echo (set_value('name'))?set_value('name'):$facultyDetails->name;?>">
		      <span class="validationError"><?php echo form_error('name'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Designation</label>
		    <div class="col-sm-3">
		      <?php
		        array_unshift($DesignationList,"- Select -");
		      	echo form_dropdown('designation_id', $DesignationList, set_value('designation_id', $facultyDetails->designation_id),'class="form-control"'); 
		      ?>
		      <span class="validationError"><?php echo form_error('designation_id'); ?></span>
		    </div>
		    <!-- <div class="col-sm-2 mt-2">
                <div class="custom-control custom-checkbox">
                	<input type="checkbox" class="custom-control-input" id="isPrincipal" name="isPrincipal" <?php echo ($facultyDetails->isPrincipal)?'checked':'';?>>
                    <label class="custom-control-label" for="isPrincipal">is Principal</label>
                </div>
			</div> -->
			<div class="col-sm-2 mt-2">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="isHOD" name="isHOD" <?php echo ($facultyDetails->isHOD)?'checked':'';?>>
                	<label class="custom-control-label" for="isHOD">is HOD</label>
                </div>
			</div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Additional Designation </label>
		    <div class="col-sm-9">
		      <input type="text" name="designation" id="designation" class="form-control" value="<?php echo (set_value('designation'))?set_value('designation'):$facultyDetails->designation;?>">
		      <span class="validationError"><?php echo form_error('designation'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Staff Type</label>
		    <div class="col-sm-9">
		      <?php
		      	$staffTypeList = array(" "=>"Choose", "Regular" => "Regular", "Visiting" => "Visiting");
		      	echo form_dropdown('staff_type', $staffTypeList, set_value('staff_type', $facultyDetails->staff_type),'class="form-control col-sm-6"'); 
		      ?>
		      <span class="validationError"><?php echo form_error('staff_type'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Department : </label>
		    <div class="col-sm-9">
		      <?php 
		        echo form_dropdown('department_id', $departments, set_value('department_id', $facultyDetails->department_id),'class="form-control"'); 
		      ?>
              <span class="validationError"><?php echo form_error('department_id'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Qualification : </label>
		    <div class="col-sm-9">
		      <input type="text" name="qualification" id="qualification" class="form-control" value="<?php echo (set_value('qualification'))?set_value('qualification'):$facultyDetails->qualification;?>">
		      <span class="validationError"><?php echo form_error('qualification'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Official Email : </label>
		    <div class="col-sm-9">
		      <input type="text" name="official_email" id="official_email" class="form-control" value="<?php echo (set_value('official_email'))?set_value('official_email'):$facultyDetails->official_email;?>">
		      <span class="validationError"><?php echo form_error('official_email'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Mobile : </label>
		    <div class="col-sm-9">
		      <input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo (set_value('mobile'))?set_value('mobile'):$facultyDetails->mobile;?>">
		      <span class="validationError"><?php echo form_error('mobile'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Research Interests : </label>
		    <div class="col-sm-9">
		      <textarea id="research_interests" name="research_interests" class="form-control" rows=6><?php echo (set_value('research_interests'))?set_value('research_interests'):$facultyDetails->research_interests;?></textarea>
		      <span class="validationError"><?php echo form_error('research_interests'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">About Yourself : </label>
		    <div class="col-sm-9">
		      <textarea id="about_yourself" name="about_yourself" class="form-control" rows=6><?php echo (set_value('about_yourself'))?set_value('about_yourself'):$facultyDetails->about_yourself;?></textarea>
		      <span class="validationError"><?php echo form_error('about_yourself'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Other Info : </label>
		    <div class="col-sm-9">
		      <textarea id="other_info" name="other_info" class="form-control" rows=6><?php echo (set_value('other_info'))?set_value('other_info'):$facultyDetails->other_info;?></textarea>
		      <span class="validationError"><?php echo form_error('other_info'); ?></span>
		    </div>
		  </div>
		  <div class="form-group row">
		  	<div class="col-sm-3"> &nbsp;</div>
		  	<div class="col-sm-9">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Update</button>
          		<?php
        			echo anchor('admin/facultyView/'.$facultyDetails->id,'<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" ');
        		?>
          	</div>
          </div>  
		  
		</form>   
    </div>
  </div>

</div>
