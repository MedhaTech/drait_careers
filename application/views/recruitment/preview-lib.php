<div class="container">
    
    <?php if($this->session->flashdata('message')){?>
        <div class="alert <?=$this->session->flashdata('status');?>" id="msg">
            <?php echo $this->session->flashdata('message')?>
        </div>
    <?php } ?>
    
    <div class="row mb-5">
        
        <div class="col-md-12">
            
            <div class="card shadow mb-4 mt-2" id="personal">
                <div class="card-body">
                    <div class="row">
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
              </div>
            </div>
            
            <div class="card shadow mb-4 mt-2" id="personal">
                <div class="card-body">
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
              </div>
            </div>
            
            <div class="card shadow my-4" id="education">
                <div class="card-body">
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
              </div>
            </div>
            
            <div class="card shadow my-4" id="research">
                <div class="card-body">
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
              </div>
            </div>
            
            <div class="card shadow my-4" id="publications">
                <div class="card-body">
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
              </div>
            </div>
            
            <div class="card shadow my-4" id="teaching">
                <div class="card-body">
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
              </div>
            </div>
            
            <div class="card shadow my-4" id="industrial">
                <div class="card-body">
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
              </div>
            </div>
            
            <div class="card shadow my-4" id="affiliations">
                <div class="card-body">
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
              </div>
            </div>
            
            <div class="card shadow my-4" id="references">
                <div class="card-body">
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
              </div>
            </div>
            
            <div class="card shadow my-4" id="documents">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Documents</span>
                        <span tabindex="0" class="add no-outline">
                          
                        </span>
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
                        echo '<td>'.$details1->file.'</td>';
                       
                        
                       echo '</tr>';
                    } 
                ?>
                </table>
              </div>
            </div>
            <?php 
                if($details->payment_status) {
                    $post = $this->admin_model->getDetails('recruitment_posts', $details->post_id)->row();
            ?>
            
                <div class="card shadow my-4" id="documents">
                <div class="card-body">
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
            
            <div>
                <?php echo anchor('','Print', 'class="btn btn-danger"');?>  
            </div>
            
                
            <?php
                } else {
                    echo '<h6 class="mb-0 font-weight-bold">Declaration:</h6>';
                    echo '<p><input type="checkbox" class="" style="width:5%;" /> I, '.$details->candidate_name.' hereby certify that all the information given by me are true to the best of my knowledge. In the event of any information being found incorrect or misleading, candidate shall be liable to cancellation by the university at any time and I shall not be entitled for refund of any fee paid by me to the College. I have carefully studied the notification of faculty recruitment - 2023. </p>';
                    echo anchor('recruitment/payment','Click here to Pay Fee','class="btn btn-danger btn-sm"');  
                } 
            ?>
        </div>
    </div>

  
</div>
