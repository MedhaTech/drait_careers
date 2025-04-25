<div class="container">

        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Add New Industrial Experience</span>
                    </div>  
                    
                <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-5">
                      <label class="tx-14 font-weight-bold">Name of the Organization</label>
                      <input type="text" class="form-control" placeholder="Enter Name of the Organization" id="organization" name="organization" value="<?php echo (set_value('organization'))?set_value('organization'):'';?>">
                      <?=form_error('organization','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-3">
                      <label class="tx-14 font-weight-bold">Position Held</label>
                      <input type="text" class="form-control" placeholder="Enter position_held" id="position_held" name="position_held" value="<?php echo (set_value('position_held'))?set_value('position_held'):'';?>">
                      <?=form_error('position_held','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Period From</label>
                      <input type="month" class="form-control" placeholder="Enter Exp From" id="period_from" name="period_from" value="<?php echo (set_value('period_from'))?set_value('period_from'):'';?>">
                      <?=form_error('period_from','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Period To</label>
                      <input type="month" class="form-control" placeholder="Enter Exp To" id="period_to" name="period_to" value="<?php echo (set_value('period_to'))?set_value('period_to'):'';?>">
                      <?=form_error('period_to','<div class="text-danger">','</div>');?>
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
                    <span class="widgetTitle">List of Industrial Experiences</span>
                     <span tabindex="0" class="add no-outline">
                            <?php 
                             if(($user_data->menu_flag==6) && (count($details)>1))
                             {
                                echo anchor('recruitment/profile?flag=7','<i class="fas fa-angle-double-right "></i> Save & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                             elseif(($user_data->menu_flag==6))
                             {
                                echo anchor('recruitment/profile?flag=7','<i class="fas fa-angle-double-right "></i> Skip & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                            ?>
                        </span>
                </div> 
                    
                <table class="table table-hover text-dark">
                    <thead>
                    <tr>
                        <th width='35%'>Name of the Organization</th>
                        <th width='15%'>Position Held</th>
                        <th width='20%'>Exp. From & To</th>
                        <th width='15%'>Total Exp.</th>
                        <th width='15%'>Actions</th>
                    </tr>
                    </thead>
                <?php  
                if($details){
                    foreach($details as $details1){ 
                        
                        $date1 = strtotime($details1->period_from);
                        $date2 = strtotime($details1->period_to);
                            
                        $diff = abs($date2 - $date1);
                        
                        $years = floor($diff / (365*60*60*24));
                        
                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    
                        echo '<tr>';
                        echo '<td>'.$details1->organization.'</td>';
                        echo '<td>'.$details1->position_held.'</td>';
                        echo '<td>'.date('M Y', strtotime($details1->period_from)).' - '.date('M Y', strtotime($details1->period_to)).'</td>';
                        echo '<td>'.$years.' years, '.$months.' months'.'</td>';
                        echo '<td>'.anchor('recruitment/updateIndustrial/'.$details1->id,'Edit','class="btn btn-info btn-square btn-sm mx-1 my-1"').anchor('recruitment/deleteIndustrial/'.$details1->id,'Delete','class="btn btn-danger btn-square btn-sm mx-1 my-1"').'</td>';
                        echo '</tr>';
                    }   }
                ?>
                </table>
              </div>
            </div>
            <?php
              
            ?>
             
           </div>
        </div><!-- row -->

  
</div>
