<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
        <div class="dropdown no-arrow">
        	<?php echo anchor('admin/editFaculty/'.$facultyDetails->id,'<i class="fas fa-edit fa-sm fa-fw text-success"></i> Update', 'class="text-danger" ');
        	?>
        </div>
	</div>
    <div class="card-body">
        <div id="hideDiv" class="text-center"> 
           <?php echo $this->session->flashdata('message'); ?>
        </div>
    	<div class="row">
    		<div class="col-sm-9">
    			<form>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Name : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo $facultyDetails->name;?></label>
				    </div>
				  </div>
				  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Designation : </label>
                    <div class="col-sm-9">
                        <?php
                            $isHOD = null;
                            if($facultyDetails->isHOD) $isHOD = " and HOD";
                            if($facultyDetails->designation_id){
                              $designation = $this->Designations[$facultyDetails->designation_id];
                            } else {
                              $designation = '';
                            }    
                        ?>
                        <label class="form-control-plaintext"><?php echo $designation.$isHOD.' '.$facultyDetails->designation;?></label>
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Staff Type : </label>
                    <div class="col-sm-9">
                      <label class="form-control-plaintext"><?php echo $facultyDetails->staff_type;?></label>
                    </div>
                  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Qualification : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo $facultyDetails->qualification;?></label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Official Email : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo $facultyDetails->official_email;?></label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Mobile : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo $facultyDetails->mobile;?></label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Research Interests : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo $facultyDetails->research_interests;?></label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">About Yourself : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo $facultyDetails->about_yourself;?></label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Other Info : </label>
				    <div class="col-sm-9">
				      <label class="form-control-plaintext"><?php echo $facultyDetails->other_info;?></label>
				    </div>
				  </div>	
				</form>  
    		</div>
    		<div class="col-sm-3 text-center">
                <?=form_open_multipart('admin/upload_pic/'.$facultyDetails->id)?>
                <img src="<?=$img;?>" class="img-responsive" id="img_upload" style="height:200px;border:1px solid #afafaf;">
                <h6 class="small text-warning mt-2">Note: Max Width x Height is 2000 X 2000 px and Only JPEG/JPG image type is allowed</h6>
                <p id="res" class="text-danger"></p>
                <input type="file" class="form-control" name="logo" id="logo">
                <button class="btn btn-sm btn-primary mt-2" type="submit" id="pic" disabled><i class="fa fa-check-square-o"></i> Upload Photo</button>
                
                <?php
    				echo ($facultyDetails->status == "1")?'<div class="px-2 py-2 mt-5 bg-gradient-danger text-white"><i class="fas fa-times-circle"></i> Unpublished</div>':'<div class="px-2 py-2 mt-5 bg-gradient-success text-white"><i class="fas fa-check-circle"></i> Published</div>';
    			?>  
                    


                </form>
                
    		</div>
    	</div>
    	 
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary">Education Details</h6>
        <div class="dropdown no-arrow">
        	<?php echo anchor('admin/updateEducation/'.$facultyDetails->id,'<i class="fas fa-edit fa-sm fa-fw text-danger"></i> Update', 'class="text-danger" ');
        	?>
        </div>
	</div>
    <div class="card-body">    	
    	<?php
    		if(!empty($facultyEducation)){
    			echo "<ul>";
    			foreach ($facultyEducation as $facultyEducation1) {
    				echo "<li>".$facultyEducation1->education."</li>";		
    			}
    			echo "</ul>";
    		}else{
    			echo "<h5 class='text-gray-400 text-center'> No details found..! </h5>";
    		}
    	?> 
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary">Selected Publicaitons</h6>
        <div class="dropdown no-arrow">
        	<?php echo anchor('admin/updatePublications/'.$facultyDetails->id,'<i class="fas fa-edit fa-sm fa-fw text-danger"></i> Update', 'class="text-danger" ');
        	?>
        </div>
	</div>
    <div class="card-body">    	
    	 <?php
    		if(!empty($facultyPublications)){
                $facultyPublications = array_reverse($facultyPublications);
    			echo "<ul>";
    			foreach ($facultyPublications as $facultyPublications1) {
    				echo "<li>".$facultyPublications1->publications."</li>";		
    			}
    			echo "</ul>";
    		}else{
    			echo "<h5 class='text-gray-400 text-center'> No details found..! </h5>";
    		}
    	?> 
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary">Additional Responsibilities</h6>
        <div class="dropdown no-arrow">
        	<?php echo anchor('admin/updateResponsibilities/'.$facultyDetails->id,'<i class="fas fa-edit fa-sm fa-fw text-danger"></i> Update', 'class="text-danger" ');
        	?>
        </div>
	</div>
    <div class="card-body">    	
    	 <?php
    		if(!empty($facultyResponsibilities)){
    			echo "<ul>";
    			foreach ($facultyResponsibilities as $facultyResponsibilities1) {
    				echo "<li>".$facultyResponsibilities1->responsibilities."</li>";		
    			}
    			echo "</ul>";
    		}else{
    			echo "<h5 class='text-gray-400 text-center'> No details found..! </h5>";
    		}
    	?> 
    </div>
  </div>

  <div class="form-group row">
	<div class="col-sm-6">
		<?php 
		  if($facultyDetails->status == "1"){
		  	echo anchor('admin/updateStatus/'.$facultyDetails->id.'/'.$facultyDetails->status,'<i class="fas fa-check-circle"></i> Publish', 'class="btn btn-success" '); 
		  }else{
		  	echo anchor('admin/updateStatus/'.$facultyDetails->id.'/'.$facultyDetails->status,'<i class="fas fa-times-circle"></i> Unpublish', 'class="btn btn-danger" '); 
		  }
		?>
	</div>
	<div class="col-sm-6 text-right">
    <?php   
        echo anchor('admin/deleteFaculty/'.$facultyDetails->id,'<i class="fas fa-trash"></i> Delete Profile', 'class="btn btn-warning mr-2" '); 
		echo anchor('admin/faculty/','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" '); ?>
   	</div>
   </div>  

</div>