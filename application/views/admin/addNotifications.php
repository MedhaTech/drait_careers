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
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Details</label>
		    <div class="col-sm-10">
		      <textarea id="details" name="details" class="form-control" rows="5"><?php echo (set_value('details'))?set_value('details'):$details;?></textarea>
		      <span class="validationError"><?php echo form_error('details'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">File</label>
		    <div class="col-sm-10">
		    	<input name="userfile" id="userfile" size="20" type="file" class="form-control"/>
		      <span class="validationError"><?php echo form_error('userfile'); ?></span>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Link</label>
		    <div class="col-sm-10">
		      <input type="text" name="link" id="link" class="form-control" value="<?php echo (set_value('link'))?set_value('link'):$link;?>">
		      <span class="validationError"><?php echo form_error('link'); ?></span>
		    </div>
		  </div> 
		  
		  <div class="form-group row">
		  	<div class="col-sm-2"> &nbsp;</div>
		  	<div class="col-sm-10">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Submit </button>
          		<?php echo anchor('admin/notifications','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" '); ?>
          	</div>
          </div>  
		  
		</form>   
    </div>
  </div>

</div>
