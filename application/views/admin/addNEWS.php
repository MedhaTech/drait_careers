<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
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
		    <label class="col-sm-1 col-form-label text-right font-weight-bold">Title</label>
		    <div class="col-sm-11">
		      <input type="text" name="news_title" id="news_title" class="form-control" value="<?php echo (set_value('news_title'))?set_value('news_title'):$news_title;?>">
		      <span class="validationError"><?php echo form_error('news_title'); ?></span>
		    </div>
		  </div> 
		  <!-- <div class="form-group row">
		    <label class="col-sm-1 col-form-label text-right font-weight-bold">Slug</label>
		    <div class="col-sm-11">
		      <input type="text" name="news_slug" id="news_slug" class="form-control" value="<?php echo (set_value('news_slug'))?set_value('news_slug'):$news_slug;?>">
		      <span class="validationError"><?php echo form_error('news_slug'); ?></span>
		    </div>
		  </div>  -->
		  <div class="form-group row">
		    <label class="col-sm-1 col-form-label text-right font-weight-bold">Date</label>
		    <div class="col-sm-4">
		    	<div class="input-group date" id="id_4">
                    <input type="text" id="news_date" name="news_date" value="<?php echo (set_value('news_date'))?set_value('news_date'):$news_date;?>" class="form-control"/>
                    <div class="input-group-addon input-group-append">
                        <div class="input-group-text"> <i class="glyphicon glyphicon-calendar fa fa-calendar"></i></div>
                    </div>
                </div>
		      <span class="validationError"><?php echo form_error('news_date'); ?></span>
		    </div>
		  </div> 

		  <div class="form-group row">
		    <label class="col-sm-1 col-form-label text-right font-weight-bold">Details</label>
		    <div class="col-sm-11">
		        <textarea id="details" name="details" class="form-control" rows="5"><?php echo (set_value('details'))?set_value('details'):$details;?></textarea>
                <script>
                        CKEDITOR.replace( 'details' );
                </script>
		      <span class="validationError"><?php echo form_error('details'); ?></span>
		    </div>
		  </div>

		 <!--  <div class="form-group row">
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
		  </div>  -->
		  
		  <div class="form-group row">
		  	<div class="col-sm-2"> &nbsp;</div>
		  	<div class="col-sm-10">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Submit </button>
          		<?php echo anchor('admin/news','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" '); ?>
          	</div>
          </div>  
		  
		</form>   
    </div>
  </div>

</div>
