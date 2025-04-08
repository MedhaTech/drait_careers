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
		    <label class="col-sm-2 col-form-label text-right font-weight-bold">Member Name</label>
		    <div class="col-sm-8">
		      <input type="text" name="member_name" id="member_name" class="form-control" value="<?php echo (set_value('member_name'))?set_value('member_name'):$member_name;?>">
		      <span class="validationError"><?php echo form_error('member_name'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label text-right font-weight-bold">Mobile</label>
		    <div class="col-sm-8">
		      <input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo (set_value('mobile'))?set_value('mobile'):$mobile;?>">
		      <span class="validationError"><?php echo form_error('mobile'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label text-right font-weight-bold">Email</label>
		    <div class="col-sm-8">
		      <input type="text" name="email" id="email" class="form-control" value="<?php echo (set_value('email'))?set_value('email'):$email;?>">
		      <span class="validationError"><?php echo form_error('email'); ?></span>
		    </div>
		  </div> 
		  
		  <div class="form-group row">
		  	<div class="col-sm-2"> &nbsp;</div>
		  	<div class="col-sm-10">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Submit </button>
          		<?php echo anchor('admin/categoryMembers/'.$category_id,'<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" '); ?>
          	</div>
          </div>  
		  
		</form>   
    </div>
  </div>

</div>
