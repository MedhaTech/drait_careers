<div class="container">

        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Add New Education</span>
                    </div>  
                    
                <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Program</label>
                      <?php $programList = array(" " => 'Select', 'UG' => 'UG', 'PG' => 'PG', 'Ph.D' => 'Ph.D', 'Other' => 'Other');
                            echo form_dropdown('program', $programList, (set_value('program'))?set_value('program'):'', 'class="form-control input-xs" id="program"'); ?>
                      <?=form_error('program','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Year of Passing</label>
                      <?php
                        // $programTypeList = array(" " => 'Select');
                    //         for($i = 1970; $i <= date('Y'); $i++){
                    //             $programTypeList[$i] = $i;
                    //         }
                    //         echo form_dropdown('year_of_passing', $programTypeList, (set_value('year_of_passing'))?set_value('year_of_passing'):'', 'class="form-control input-xs" id="year_of_passing"'); ?>
                      <input type="month" class="form-control" placeholder="Enter year_of_passing" id="year_of_passing" name="year_of_passing" value="<?php echo (set_value('year_of_passing'))?set_value('year_of_passing'):'';?>">
                      <?=form_error('year_of_passing','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-3">
                      <label class="tx-14 font-weight-bold">Degree</label>
                      <input type="text" class="form-control" placeholder="Enter Degree" id="degree" name="degree" value="<?php echo (set_value('degree'))?set_value('degree'):'';?>">
                      <?=form_error('degree','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-5">
                      <label class="tx-14 font-weight-bold">Specialization</label>
                      <input type="text" class="form-control" placeholder="Enter Specialization" id="specialization" name="specialization" value="<?php echo (set_value('specialization'))?set_value('specialization'):'';?>">
                      <?=form_error('specialization','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Institution / University Name</label>
                      <input type="text" class="form-control" placeholder="Enter Institution / University Name" id="university_name" name="university_name" value="<?php echo (set_value('university_name'))?set_value('university_name'):'';?>">
                      <?=form_error('university_name','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Program Type</label>
                      <?php $programTypeList = array(" " => 'Select', 'FullTime' => 'FullTime', 'PartTime' => 'PartTime');
                            echo form_dropdown('program_type', $programTypeList, (set_value('program_type'))?set_value('program_type'):'', 'class="form-control input-xs" id="program_type"'); ?>
                      <?=form_error('program_type','<div class="text-danger">','</div>');?>
                    </div>
                    
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Percentage of Marks</label>
                      <input type="text" class="form-control" placeholder="Enter Percentage of Marks" id="marks_percentage" name="marks_percentage" value="<?php echo (set_value('marks_percentage'))?set_value('marks_percentage'):'';?>">
                      <?=form_error('marks_percentage','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Class Awarded</label>
                      <input type="text" class="form-control" placeholder="Enter Class Awarded" id="class_awarded" name="class_awarded" value="<?php echo (set_value('class_awarded'))?set_value('class_awarded'):'';?>">
                      <?=form_error('class_awarded','<div class="text-danger">','</div>');?>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary btn-square btn-sm" type="submit">Add</button>
                    <?php echo anchor('recruitment/profile','Back','class="btn btn-secondary btn-square btn-sm"'); ?>    
                </div>

                <?=form_close();?>
               </div>
             </div>
           </div>
        </div><!-- row -->
        
        <div class="row row-xs mt-4">
           <div class="col-lg-12">
            <?php if($this->session->flashdata('message')){?> 
                <div align="center" class="alert <?=$this->session->flashdata('status');?>" id="msg">      
                    <?php echo $this->session->flashdata('message')?>
                </div>
            <?php } 
                // if($details){
            ?>
            <div class="card ht-100p shadow">
              <div class="card-body pd-y-20">
                <div class="widgetHead mb-3">
                    <span class="widgetTitle">List of Education Qualifications</span>
                      <span tabindex="0" class="add no-outline">
                            <?php 
                             if(($user_data->menu_flag==2) && (count($details)>1))
                             {
                                echo anchor('recruitment/profile?flag=3','<i class="fas fa-angle-double-right "></i> Save & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                            ?>
                        </span>
                </div> 
                    
                <table class="table table-hover text-dark">
                    <thead>
                    <tr>
                        <th>Program</th>
                        <th>Degree & Specialization</th>
                        <th>Institution / University Name</th>
                        <th>Program Type</th>
                        <th>Year Passed</th>
                        <th>Percentage of Marks</th>
                        <th>Class Awarded</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                <?php  
                    foreach($details as $details1){ 
                    
                        echo '<tr>';
                        echo '<td>'.$details1->program.'</td>';
                        echo '<td>'.$details1->degree.' - '.$details1->specialization.'</td>';
                        echo '<td>'.$details1->university_name.'</td>';
                       
                        echo '<td>'.$details1->program_type.'</td>';
                         echo '<td>'.date('M Y', strtotime($details1->year_of_passing)).'</td>';
                        echo '<td>'.$details1->marks_percentage.'</td>';
                        echo '<td>'.$details1->class_awarded.'</td>';
                        echo '<td>'.anchor('recruitment/updateEducation/'.$details1->id,'Edit','class="btn btn-info btn-square btn-sm mx-1 my-1"').anchor('recruitment/deleteEducation/'.$details1->id,'Delete','class="btn btn-danger btn-square btn-sm mx-1 my-1"').'</td>';
                        echo '</tr>';
                    } 
                ?>
                </table>
              </div>
            </div>
            <?php
                // }
            ?>
             
           </div>
        </div><!-- row -->

  
</div>
