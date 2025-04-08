<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
  	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$Category.' - Members';?></h6>
    <div class="dropdown no-arrow">
      <?php 
          echo anchor('admin/addCategoryMembers/'.$category_id,'<i class="fas fa-plus fa-sm fa-fw"></i> Add New', 'class="btn btn-info btn-sm mx-2"');
          echo anchor('admin/categories','<i class="fas fa-arrow-left fa-sm fa-fw"></i> Back to List', 'class="btn btn-danger btn-sm" ');
      ?>
    </div>
	</div>
    <div class="card-body">
      <div id="hideDiv" class="text-center"> 
        <?php echo $this->session->flashdata('message'); ?>
      </div>
      <?php echo $table;?>
    </div>
  </div>

</div>