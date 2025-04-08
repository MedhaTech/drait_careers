<div class="container-fluid">

  <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->
          
  <div class="card shadow mb-4">
  	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary"><?=$pageTitle;?></h6>
    <div class="dropdown no-arrow">
    </div>
	</div>
    <div class="card-body">
      <div id="hideDiv" class="text-center"> 
        <?php echo $this->session->flashdata('message'); ?>
      </div>
      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
          <tr>
              <th width="5%">S.No</th>
              <th width="70%">Department Name</th>
              <th width="25%">SMS Usage</th>
          </tr>
          <?php $i = 1;
            foreach($connectSummary as $connectSummary1){
                echo "<tr>";
                echo "<td>".$i++."</td>";
                echo "<td>".$deptsDropdown[$connectSummary1->sent_by_name]."</td>";
                echo "<td class='text-center'>".$connectSummary1->total."</td>";
                echo "</tr>";
            }
          ?>
      </table>
    </div>
  </div>

</div>