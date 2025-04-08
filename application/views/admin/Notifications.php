<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
  	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
    <div class="dropdown no-arrow">
      <?php 
          echo anchor('admin/addNotifications','<i class="fas fa-plus fa-sm fa-fw text-danger"></i> Add New', 'class="text-danger" ');
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