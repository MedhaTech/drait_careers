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
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Title</label>
		    <div class="col-sm-10">
		      <input type="text" name="title" id="title" class="form-control" value="<?php echo (set_value('title'))?set_value('title'):$title;?>">
		      <span class="validationError"><?php echo form_error('title'); ?></span>
		    </div>
		  </div> 

		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Description</label>
		    <div class="col-sm-10">
		      <textarea id="description" name="description" class="form-control" rows="5"><?php echo (set_value('description'))?set_value('description'):$description;?></textarea>
		      <span class="validationError"><?php echo form_error('description'); ?></span>
		    </div>
		  </div>		

		  <!-- <div class="form-group row">
		    <label class="col-sm-2 col-form-label text-right font-weight-bold">File</label>
		    <div class="col-sm-10">
		      <input type="file" class="form-control" name="upload_Files[]" multiple/>        
		      <span class="validationError"><?php echo "Allows only JPG/JPEG/PNG/GIF file formats and Maximum ".$allow." Images."; ?></span>
		      <span class="validationError"><?php echo form_error('upload_Files'); ?></span>
		    </div>
		  </div>   -->
		  
		  <div class="form-group row">
		  	<div class="col-sm-2"> &nbsp;</div>
		  	<div class="col-sm-10">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Submit </button>
          		<?php echo anchor('admin/gallery','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" '); ?>
          	</div>
          </div>  
		  
		</form>   
    </div>
  </div>

</div>