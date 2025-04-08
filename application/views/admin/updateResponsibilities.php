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
    	<?php
    		if(!empty($facultyResponsibilities)){
    			echo "<table class='table table-stripped'>";
    			echo "<tr>";
    			echo "<th width='5%'>#</th>";
    			echo "<th width='85%'>Details</th>";
    			echo "<th width='10%'>Action</th>";
    			echo "</tr>";
    			$i = 1;
    			foreach ($facultyResponsibilities as $facultyResponsibilities1) {
    				echo "<tr>";
    				echo "<td>".$i++."</td>";
    				echo "<td>".$facultyResponsibilities1->responsibilities."</td>";
    				echo "<td>".anchor('admin/delResponsibilities/'.$facultyResponsibilities1->id.'/'.$fid,'<i class="fas fa-times"></i>','class="text-danger"')."</td>";
    				echo "</tr>";
    			}
    			echo "</table>";
    		}else{
    			echo "<h5 class='text-gray-400 text-center'> No details found..! </h5>";
    		}
    	?> 	  
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary">Add New</h6>
	</div>
    <div class="card-body">
    	<?php echo form_open($action, 'class="user"'); ?>
    	<div class="form-group row">
		    <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Responsibilities : </label>
		    <div class="col-sm-9">
		      <textarea class="form-control col-sm-9" rows="5" id="responsibilities" name="responsibilities"></textarea>
		      <span class="validationError"><?php echo form_error('responsibilities'); ?></span>
		    </div>
		</div>
		<div class="form-group row">
		  	<div class="col-sm-3"> &nbsp;</div>
		  	<div class="col-sm-9">
          		<button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-plus"></i> Add</button>
          		<?php echo anchor('admin/facultyView/'.$fid,'<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" ');
        		?>
          	</div>
        </div> 

    	</form>	  
    </div>
  </div>
 

</div>
