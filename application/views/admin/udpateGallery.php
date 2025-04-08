<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		  <h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
      <div class="dropdown no-arrow">
      <?php 
          echo anchor('admin/viewGallery/'.$Details->id, '<i class="fas fa-arrow-left fa-sm fa-fw text-danger"></i> Cancel', 'class="text-danger" ');
      ?>
    </div>
	  </div>
    <div class="card-body">
          <div id="hideDiv" class="text-center"> 
            <?php echo $this->session->flashdata('message'); ?>
          </div>
          <?php
            $img = base_url().'faculty/avatar.jpg';
          ?>
          <div class="form-group row">
                <?php 
                  $gallery = unserialize($Details->file_names); 
                  // $gallery = explode (",", $Gallery->file_names);  
                  if(!empty($gallery)): foreach($gallery as $file): 
                ?>
                <div class="col-sm-3 text-center">
                  <img src="<?php echo base_url('/Gallery/COLLEGE/'.$file); ?>" class="hod-pic" >
                  <br />
                  <?php echo anchor('admin/deleteGalleryImg/'.$Details->id.'/'.$file,'<i class="fas fa-trash"></i> Delete', 'class="btn btn-danger btn-sm my-2"'); ?>
                </div>
                <?php endforeach; else: ?>
                <div class="col-sm-10">
                  <p class="col-form-label text-center">No Images uploaded.</p>
                </div>
                <?php endif; ?>

                
                <div class="col-sm-3 text-center">
                <?=form_open_multipart($action)?>
                  <img src="<?=$img;?>" class="img-responsive" id="img_upload" style="height:200px;border:1px solid #afafaf;">
                  <h6 class="small text-warning mt-2">Note: Max Width x Height is 2000 X 2000 px and Only JPEG/JPG image type is allowed</h6>
                  <p id="res" class="text-danger"></p>
                  <input type="file" class="form-control" name="logo" id="logo">
                  
                  <button class="btn btn-sm btn-primary mt-2" type="submit" id="pic" disabled><i class="fa fa-check-square-o"></i> Upload Photo</button>
                  
                  <?php echo anchor('admin/viewGallery/'.$Details->id,'<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info btn-sm mt-2" '); ?>
                </form>
                </div>
              

          </div>


         

    </div>
  </div>

</div>
