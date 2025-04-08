<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
  	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
       <!--  <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            	<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(17px, 19px, 0px);">
              <?php echo anchor('admin/newFaculty', '<i class="fa fa-plus"></i> New Faculty','class="dropdown-item"');?>
            </div>
        </div> -->
	</div>
    <div class="card-body">
      <div id="hideDiv" class="text-center"> 
        <?php echo $this->session->flashdata('message'); ?>
      </div>
      <?php echo $table;?>
    </div>
  </div>

</div>