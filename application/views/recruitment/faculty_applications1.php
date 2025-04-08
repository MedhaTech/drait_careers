

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
     <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Appln. No.</th>
                <th>Name</th>
                <th>Department</th>
                <th>Applied Post</th>
                <th>Mobile</th>
                 <th>Email</th>
                  <th>Date</th>
                   <th>Scrutiny Status</th>
                  
            </tr>
        </thead>
 
        <tfoot>
           <tr>
                <th>No</th>
                <th>Appln. No.</th>
                <th>Name</th>
                <th>Department</th>
                <th>Applied Post</th>
                <th>Mobile</th>
                 <th>Email</th>
                  <th>Date</th>
                   <th>Scrutiny Status</th>
                    
            </tr>
        </tfoot>
 
        <tbody>
            <?php 	$i = 1;
				foreach ($table as $staffList1) {

				
					if($staffList1->scrutinity=='0')
					{
					    $scr="Pending";
					}
					else
					{
					    $scr="Completed";
					    
					}?>
            <tr>
                
              	<td><?=$i++;?>
						<td><?=$staffList1->application;?>
						<td><?= $staffList1->candidate_name;?>
					<td><?=	$staffList1->department;?>
					<td><?=	$staffList1->post_of;?>
					<td><?=	$staffList1->mobile;?>
					<td><?=	wordwrap($staffList1->email,10,"<br>\n",TRUE);?>
					<td><?=	date('d-m-Y', strtotime($staffList1->payment_date));?>
					<td><?=	$scr;?>
				
                      
            </tr>
            <?php 
				}?>
     
        </tbody>
    </table>
    </div>
  </div>

</div>


<script>
    $(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>