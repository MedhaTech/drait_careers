<style>
    @media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
@media screen {
  div.divFooter {
    display: none;
  }
}
@media print {
  div.divFooter {
    position: fixed;
    bottom: 0;
  }
}
</style>

<div class="container">
       <?php if($this->session->flashdata('message')){?>
        <div class="alert <?=$this->session->flashdata('status');?>" id="msg">
            <?php echo $this->session->flashdata('message')?>
        </div>
    <?php } ?>
   <input type="button" class="btn btn-danger btn-sm" onclick="printDiv('section-to-print')" value="Download" />
     <a href="<?php echo base_url('main/faculty_applications/'.$details->post_id);?>" class="btn btn-success btn-sm float-right" >Back to Applications</a>
    
    <div class="row mb-5" id="section-to-print">
        
        <div class="col-md-12">
            
            <div class="card mb-4 mt-2" id="personal">
                <div class="card-body">
                    <div class="row">
                             <div class="col-md-12">
            <table>
                <tr>
                    <td width="10%" style="text-align:center;">
                         <img src="data:image/png;base64,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" alt=""><br><br><br>
       
                    </td>
                    <td colspan="2" width="90%" style="text-align:center;">
                        <h3>
                            B.M.S. COLLEGE OF ENGINEERING, BENGALURU-19

                        </h3>
                        <p>Autonomous Institute, Affiliated to VTU / Approved by AICTE / Accredited by NBA</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" width="100%" style="text-align:center;">
                        <h3>
                            APPLICATION FOR LIBRARIAN POSITION
                        </h3>
                    </td>
                </tr>
               
            </table>
            <table width="100%">
                 <tr>
                     <td width="5%"></td>
                    <td width="65%">
                    Application No. :  <?= $details->application; ?> <br>


                    
                     
                     
                     
                        <br>
                    </td>
                      <td  width="10%"></td>
                    <td  width="20%">
                        <img src="<?= base_url().'uploads/profile/'.$details->profile_pic;?>" style="width:40%;" class="profile-pic">
                    </td>
                </tr>
            </table>
            </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Candiddate Name</label>
                                <h6><?php echo $details->candidate_name; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Email Address</label>
                                <h6><?php echo $details->email; ?></h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">For the Post of: </label>
                                <h6><?php echo $details->post_of; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Department Name</label>
                                <h6><?php echo $details->department; ?></h6>
                            </div>
                        </div>
                    </div>
             
                    <div class="widgetHead">
                        <span class="widgetTitle">Personal Details</span>
                    </div>    
                    <div class="row">
                     <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Mobile No</label>
                                <h6><?php echo $details->mobile; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Date of Birth</label>
                                <h6><?php echo $details->date_of_birth; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Place of Birth</label>
                                <h6><?php echo $details->place_of_birth; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Religion & Caste</label>
                                <h6><?php echo $details->religion; ?></h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Father's Name </label>
                                <h6><?php echo $details->father_name; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Father's Occupation</label>
                                <h6><?php echo $details->father_occupation; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Address for Correspondence</label>
                                <h6><?php echo $details->address; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Reservation Category</label>
                                <h6><?php echo $details->reservation_category; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="p my-0 mb-2 tx-14 text-gray-600">Languages known</label>
                            <table class="table tx-14 text-dark">
                                <thead>
                                    <tr>
                                        <th>Language</th>
                                        <th>Read</th>
                                        <th>Write</th>
                                        <th>Speak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php  
                    foreach($langs as $details1){ 
                    
                    if($details1->reading==1) { $read="Yes";}
                    else { $read="No"; }
                     if($details1->writ==1) { $writ="Yes";}
                    else { $writ="No"; }
                     if($details1->speak==1) { $speak="Yes";}
                    else { $speak="No"; }
                        echo '<tr>';
                        echo '<td>'.$details1->name.'</td>';
                        echo '<td>'.$read.'</td>';
                        echo '<td>'.$writ.'</td>';
                        echo '<td>'.$speak.'</td>';
                         echo '</tr>';
                    } 
                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
             
                    <div class="widgetHead">
                        <span class="widgetTitle">Education</span>
                    </div>    
                    <div class="row">
                        <div class="col-md-12">
                             <?php 
                                 $education = array_reverse($education); 
                                 if($education){
                         		    foreach($education as $education1){
                         		     $specialization = ($education1->specialization) ? ' - '.$education1->specialization : null;
                        	    ?>
                        	    <div class="media d-block d-sm-flex mb-4">
                                  <div class="wd-60 ht-60 bg-gray-200 rounded font-weight-bold d-flex align-items-center justify-content-center">
                                    <?=$education1->program;?>
                                  </div>
                                  <div class="media-body pl-3">
                                    <h6 class="mb-0 font-weight-bold"><?=$education1->degree.$specialization;?></h6>
                                    <p class="my-0"><?=$education1->university_name;?></p>
                                    <span class="my-0 tx-13">
                                        <?php echo $education1->program_type.' <span class="dot"></span> '.date('M Y', strtotime($education1->year_of_passing)).' <span class="dot"></span> Marks : '.$education1->marks_percentage.'% <span class="dot"></span> Class Awarded : '.$education1->class_awarded; ?> 
                                    </span>
                                  </div>
                                </div>
                        	    <?php 
                         		    }  
                                 }else{
                        		    echo "<h6 class='text-center tx-color-03'> Education details not added.</h6>";
                        		}
                            ?>
                        </div>
                    </div>

                    <div class="widgetHead">
                        <span class="widgetTitle">Research Experience</span>
                    </div>    
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                        <tr>
                            <th>Institution / University Name</th>
                            <th>Area of Research</th>
                            <th>Period From & To</th>
                            <th>Total Exp</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  
                        foreach($research as $research1)
                          { 
                            echo '<tr>';
                            echo '<td>'.$research1->institution.'</td>';
                            echo '<td>'.$research1->area_of_research.'</td>';
                            echo '<td>'.date('M Y', strtotime($research1->exp_from)).' - '.date('M Y', strtotime($research1->exp_to)).'</td>';
                            echo '<td>'.$research1->total.'</td>';
                            echo '</tr>';
                          } 
                        ?>
                        </tbody>
                    </table>

                    <div class="widgetHead">
                        <span class="widgetTitle">Publications</span>
                        <span tabindex="0" class="add no-outline">
                            
                        </span>
                    </div>    
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                        <tr>
                            <th width='40%'>Title of the Paper</th>
                            <th width='20%'>National / International</th>
                            <th width='20%'>Year and Month of Publication</th>
                            <th width='20%'>Conference / Journal / Book</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  
                        foreach($publications as $publications1)
                          { 
                            echo '<tr>';
                            echo '<td>'.$publications1->title_of_paper.'</td>';
                            echo '<td>'.$publications1->publication_type.'</td>';
                            echo '<td>'.date('M Y', strtotime($research1->publication_date)).'</td>';
                            echo '<td>'.$publications1->category.'</td>';
                            echo '</tr>';
                          } 
                        ?>
                        </tbody>
                    </table>
 
                    <div class="widgetHead">
                        <span class="widgetTitle">Teaching Experience</span>
                    </div>    
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                        <tr>
                            <th width='40%'>Name of the University / Institution</th>
                            <th width='20%'>Designation</th>
                            <th width='20%'>Exp. From & To</th>
                            <th width='20%'>Total Exp.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  
                        foreach($teaching as $teaching1)
                          { 
                              
                            $date1 = strtotime($teaching1->period_from);
                            $date2 = strtotime($teaching1->period_to);
                            
                            $diff = abs($date2 - $date1);
                            
                            $years = floor($diff / (365*60*60*24));
                            
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        
                            // $exp = ("%d years, %d months", $years, $months);
                            
                              
                            echo '<tr>';
                            echo '<td>'.$teaching1->institution.'</td>';
                            echo '<td>'.$teaching1->designation.'</td>';
                            echo '<td>'.date('M Y', strtotime($teaching1->period_from)).' - '.date('M Y', strtotime($teaching1->period_to)).'</td>';
                            echo '<td>'.$years.' years, '.$months.' months'.'</td>';
                            echo '</tr>';
                          } 
                        ?>
                        </tbody>
                    </table> 

                    <div class="widgetHead">
                        <span class="widgetTitle">Industrial Experience</span>
                    </div>    
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                        <tr>
                            <th width='40%'>Name of the Organization</th>
                            <th width='20%'>Position Held</th>
                            <th width='20%'>Exp. From & To</th>
                            <th width='20%'>Total Exp.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  
                        foreach($industrial as $industrial1)
                          { 
                              
                            $date1 = strtotime($industrial1->period_from);
                            $date2 = strtotime($industrial1->period_to);
                            
                            $diff = abs($date2 - $date1);
                            
                            $years = floor($diff / (365*60*60*24));
                            
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        
                            // $exp = ("%d years, %d months", $years, $months);
                            
                              
                            echo '<tr>';
                            echo '<td>'.$industrial1->organization.'</td>';
                            echo '<td>'.$industrial1->position_held.'</td>';
                            echo '<td>'.date('M Y', strtotime($industrial1->period_from)).' - '.date('M Y', strtotime($industrial1->period_to)).'</td>';
                            echo '<td>'.$years.' years, '.$months.' months'.'</td>';
                            echo '</tr>';
                          } 
                        ?>
                        </tbody>
                    </table> 

                    <div class="widgetHead">
                        <span class="widgetTitle">Affiliations</span>
                        <span tabindex="0" class="add no-outline">
                           
                        </span>
                    </div>    
                       <table class="table table-hover text-dark tx-14">
                        <thead>
                        <tr>
                            <th width='40%'>Name of the Professional Body </th>
                            <th width='20%'>Grade of Membership</th>
                            <th width='20%'>Number of Membership</th>
                            <th width='20%'>Year of Selection</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  
                        foreach($affiliations as $affiliations1)
                          { 
                            echo '<tr>';
                            echo '<td>'.$affiliations1->name.'</td>';
                            echo '<td>'.$affiliations1->grade.'</td>';
                            echo '<td>'.$affiliations1->number.'</td>';
                            echo '<td>'.$affiliations1->year.'</td>';
                            echo '</tr>';
                          } 
                        ?>
                        </tbody>
                    </table>

                    <div class="widgetHead">
                        <span class="widgetTitle">References</span>
                        <span tabindex="0" class="add no-outline">
                          
                        </span>
                    </div>    
                  <table class="table table-hover text-dark tx-14">
                        <thead>
                        <tr>
                            <th width='40%'>Name </th>
                            <th width='20%'>Occupation or Position</th>
                            <th width='20%'>Address for Communication with Contact Number</th>
                           
                        </tr>
                        </thead>
                        <tbody>
                        <?php  
                        foreach($references as $references1)
                          { 
                            echo '<tr>';
                            echo '<td>'.$references1->name.'</td>';
                            echo '<td>'.$references1->position.'</td>';
                            echo '<td>'.$references1->number.'</td>';
                           
                            echo '</tr>';
                          } 
                        ?>
                        </tbody>
                    </table>

                    <div class="widgetHead">
                        <span class="widgetTitle">Documents</span>
                        <span tabindex="0" class="add no-outline">
                          
                        </span>
                    </div>    
               
                    <table class="table table-hover text-dark tx-14">
                    <thead>
                    <tr>
                        <th width='30%'>Title of the document</th>
                        <th width='15%'>Attached</th>
                        
                       
                      
                    </tr>
                    </thead>
                <?php  
                	$postList = $this->admin_model->get_doc_type()->result();
                	foreach($postList as $post) {
                	$cnt=$this->admin_model->docAttached($post->id,$details->id);
                // 	var_dump($cnt->cnt);
                	?>
                  <tr>
                      <td>
                          <?= $post->name;?>
                      </td>
                      <td>
                          <?php if($cnt->cnt>0){ echo "YES"; }?>
                      </td>
                      <?php }
                       $post = $this->admin_model->getDetails('recruitment_posts', $details->post_id)->row();
                ?>
                </table>
                
             
                    <div class="widgetHead">
                        <span class="widgetTitle">Payment Details</span>
                        <span tabindex="0" class="add no-outline">
                          
                        </span>
                    </div>    
                      <table class="table table-hover text-dark tx-14">
                    <thead>
                    <tr>
                        <th width='30%'>Payment On</th>
                        <th width='40%'>Transaction ID</th>
                        <th width='30%'>Amount</th>
                    </tr>
                    </thead>
                    <tr>
                        <td><?php echo date('d-m-Y h:i A', strtotime($details->payment_date));?></td>
                        <td><?php echo $details->txn_id;?></td>
                        <td><?php echo $post->fee;?></td>
                    </tr>
                </table>
              
              </div>
            </div>
            
               <table style="border-collapse: collapse;  width:100%;" cellspacing="0">
     
        <tr>
            <td style="padding:5pt;height:40pt;min-height:40pt;border-top-style:solid;border-top-width:1pt;border-top-color:#000;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#000;" colspan="2" width="30%">Date: <?php echo date('d-m-Y', strtotime($details->payment_date));?></td>
            <td style="padding:5pt;height:40pt;min-height:40pt;border-top-style:solid;border-top-width:1pt;border-top-color:#000;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#000;" colspan="4" width="40%"></td>
            <td style="padding:5pt;height:40pt;min-height:40pt;border-top-style:solid;border-top-width:1pt;border-top-color:#000;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#000;border-right-style:solid;border-right-width:1pt;"width="30%" >Signature</td>
        </tr>
    </table>
           
        </div>
        <div class="divFooter">Note : This document is automaticaly generated by the system.</div>


    </div>
    
             <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Documents</span>
                       
                    </div>    
                    <table class="table table-hover text-dark tx-14">
                    <thead>
                    <tr>
                        <th width='30%'>Title of the document</th>
                        <th width='15%'>Document</th>
                       
                      
                    </tr>
                    </thead>
                <?php  
                    foreach($documents as $details1){ 
                    $file_type=$this->admin_model->get_doc_name($details1->type);
              
                        echo '<tr>';
                        echo '<td>'.$file_type->name.'</td>';
                        echo '<td><a href="'.base_url().'uploads/documents/'.$details1->file.'" target="_blank" class="btn btn-success btn-sm "> Download</a></td>';
                       
                        
                       echo '</tr>';
                    } 
                ?>
                </table>
                
              </div>


<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
  
</div>
