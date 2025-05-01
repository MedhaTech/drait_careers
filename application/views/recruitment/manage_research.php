<div class="container">

        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Add New Research Experience</span>
                    </div>  
                    
                <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Institution / University Name</label>
                      <input type="text" class="form-control" placeholder="Enter Institution / University Name" id="institution" name="institution" value="<?php echo (set_value('institution'))?set_value('institution'):'';?>">
                      <?=form_error('institution','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-5">
                      <label class="tx-14 font-weight-bold">Area of Research</label>
                      <input type="text" class="form-control" placeholder="Enter Ared of Research" id="area_of_research" name="area_of_research" value="<?php echo (set_value('area_of_research'))?set_value('area_of_research'):'';?>">
                      <?=form_error('area_of_research','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Period From</label>
                      <input type="month" class="form-control" placeholder="Enter Exp From" id="exp_from" name="exp_from" value="<?php echo (set_value('exp_from'))?set_value('exp_from'):'';?>">
                      <?=form_error('exp_from','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Period To</label>
                      <input type="month" class="form-control" placeholder="Enter Exp To" id="exp_to" name="exp_to" value="<?php echo (set_value('exp_to'))?set_value('exp_to'):'';?>">
                      <?=form_error('exp_to','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Total Exp.</label>
                      <input type="text" class="form-control" placeholder="Enter Total Exp." id="total" name="total" value="<?php echo (set_value('total'))?set_value('total'):'';?>">
                      <?=form_error('total','<div class="text-danger">','</div>');?>
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
                
            ?>
            <div class="card ht-100p shadow">
              <div class="card-body pd-y-20">
                <div class="widgetHead mb-3">
                    <span class="widgetTitle">List of Research Experiences</span>
                    <span tabindex="0" class="add no-outline">
                            <?php 
                             if(($user_data->menu_flag==3) && (count($details)>0))
                             {
                                echo anchor('recruitment/profile?flag=4','<i class="fas fa-angle-double-right "></i> Save & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                             elseif(($user_data->menu_flag==3))
                             {
                                echo anchor('recruitment/profile?flag=4','<i class="fas fa-angle-double-right "></i> Skip & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                             else
                             {
                              echo anchor('recruitment/profile','<i class="fas fa-angle-double-right "></i> Skip & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                            ?>
                        </span>
                </div> 
                    
                <table class="table table-hover text-dark">
                    <thead>
                    <tr>
                        <th>Institution / University Name</th>
                        <th>Area of Research</th>
                        <th>Period From & To</th>
                        <th>Total Exp</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                <?php  if($details){
                    foreach($details as $details1){ 
                    
                        echo '<tr>';
                        echo '<td>'.$details1->institution.'</td>';
                        echo '<td>'.$details1->area_of_research.'</td>';
                        echo '<td>'.date('M Y', strtotime($details1->exp_from)).' - '.date('M Y', strtotime($details1->exp_to)).'</td>';
                        echo '<td>'.$details1->total.'</td>';
                        echo '<td>'.anchor('recruitment/updateResearch/'.$details1->id,'Edit','class="btn btn-info btn-square btn-sm mx-1 my-1"').anchor('recruitment/deleteResearch/'.$details1->id,'Delete','class="btn btn-danger btn-square btn-sm mx-1 my-1"').'</td>';
                        echo '</tr>';
                    } }
                ?>
                </table>
              </div>
            </div>
           
             
           </div>
        </div><!-- row -->

  
</div>
