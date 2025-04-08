<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
	</div>
    <div class="card-body">
          <div id="hideDiv" class="text-center"> 
	        <?php echo $this->session->flashdata('message'); ?>
	      </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Title</label>
		    <div class="col-sm-10">
		    	<p class="col-form-label"><?=$Gallery->title;?></p>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label text-right font-weight-bold">Description</label>
		    <div class="col-sm-10">
		    	<p class="col-form-label"><?=$Gallery->description;?></p>
		    </div>
		  </div>

		  <div class="form-group row">
		  	    <?php 
		  	    	$gallery = unserialize($Gallery->file_names); 
		  	    	// $gallery = explode (",", $Gallery->file_names);  
					if(!empty($gallery)): foreach($gallery as $file): 
		       	?>
		        <div class="col-sm-3 text-center mb-2">
		          <img src="<?php echo base_url('/Gallery/COLLEGE/'.$file); ?>" class="hod-pic" >
		          <!-- <?php echo anchor('admin/deleteGalleryImg/'.$Gallery->id.'/'.$file,'<i class="fas fa-trash"></i> Delete', 'class="btn btn-danger btn-sm mt-2"'); ?> -->
		        </div>
		        <?php endforeach; else: ?>
		        <div class="col-sm-10">
			    	<p class="col-form-label text-center">No Images uploaded.</p>
			    </div>
		        <?php endif; ?>
		  </div>
		 
    </div>
  </div>

  <div class="form-group row">
	<div class="col-sm-6">
		<?php echo anchor('admin/editGallery/'.$Gallery->id,'<i class="fas fa-edit fa-sm fa-fw"></i> Edit ', 'class="btn btn-info btn-sm" '); ?>
		<?php echo anchor('admin/udpateGallery/'.$Gallery->id,'<i class="fas fa-images fa-sm fa-fw"></i> Images ', 'class="btn btn-success btn-sm" '); ?>
		<?php echo anchor('admin/deleteGallery/'.$Gallery->id,'<i class="fas fa-trash fa-sm fa-fw"></i> Delete ', 'class="btn btn-danger btn-sm" '); ?>
	</div>
	<div class="col-sm-6 text-right">
    	<?php echo anchor('admin/gallery','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Back to List', 'class="btn btn-warning btn-sm" '); ?>
    </div>
   </div>

</div>
