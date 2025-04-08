<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
  <div id="hideDiv" class="text-center"> 
    <?php echo $this->session->flashdata('message'); ?>
  </div>

  <div class="row">
  	<div class="col-md-12">
  		<div class="card shadow mb-4">
  		  <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
		  </div> -->
		  <div class="card-body">
			<div class="row">
			 	<div class="col-md-12 text-center mt-3 mb-3">
			 		<h4 class="text-danger"> <?=$sentMessage; ?></h4>
			 	</div>
			 </div>			
			 <div class="row mt-5">

			 	<div class="col-xl-3 col-md-6 mb-4">
	              <div class="card border-left-primary shadow h-100 py-2">
	                <div class="card-body">
	                  <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Send SMS to</div>
	                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=anchor('admin/connectStudents','STUDENTS');?></div>
	                    </div>
	                    <div class="col-auto">
	                      <i class="fas fa-users fa-2x text-gray-300"></i>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>

	            <div class="col-xl-3 col-md-6 mb-4">
	              <div class="card border-left-success shadow h-100 py-2">
	                <div class="card-body">
	                  <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Send SMS to</div>
	                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=anchor('admin/connectStaff','FACULTY', 'class="text-success"');?></div>
	                    </div>
	                    <div class="col-auto">
	                      <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>

	            <div class="col-xl-3 col-md-6 mb-4">
	              <div class="card border-left-info shadow h-100 py-2">
	                <div class="card-body">
	                  <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Send SMS to</div>
	                      <div class="row no-gutters align-items-center">
	                        <div class="col-auto">
	                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=anchor('admin/connectCategories','CATEGORIES','class="text-info"');?></div>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="col-auto">
	                      <i class="fas fa-address-book fa-2x text-gray-300"></i>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>

	            <div class="col-xl-3 col-md-6 mb-4">
	              <div class="card border-left-info shadow h-100 py-2">
	                <div class="card-body">
	                  <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sent SMS</div>
	                      <div class="row no-gutters align-items-center">
	                        <div class="col-auto">
	                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=anchor('admin/sentConnect','View Status','class="text-info"');?></div>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="col-auto">
	                      <i class="fas fa-binoculars fa-2x text-gray-300"></i>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>


			 </div>	  
		  </div>
  		</div>
  	</div>
  </div>        

</div>