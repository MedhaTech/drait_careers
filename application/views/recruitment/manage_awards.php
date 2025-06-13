<div class="container">

        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Add Award Details</span>
                    </div>  
                    
                <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-12">
                      <label class="tx-14 font-weight-bold">Name of the Award</label>
                      <input type="text" class="form-control" placeholder="Enter Name of the Award" id="name" name="name" value="<?php echo (set_value('name'))?set_value('name'):'';?>">
                      <?=form_error('name','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Award Description</label>
                      <input type="text" class="form-control" placeholder="Enter Award Description" id="award" name="award" value="<?php echo (set_value('award'))?set_value('award'):'';?>">
                      <?=form_error('grade','<div class="text-danger">','</div>');?>
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Year</label>
                      <input type="year" class="form-control" placeholder="Enter Year" id="year" name="year" value="<?php echo (set_value('year'))?set_value('year'):'';?>">
                      <?=form_error('year','<div class="text-danger">','</div>');?>
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
                    <span class="widgetTitle">List of Awards </span>
                     <span tabindex="0" class="add no-outline">
                            <?php 
                             if(($user_data->menu_flag==2)&& (count($details)>1))
                             {
                                echo anchor('recruitment/profile?flag=3','<i class="fas fa-angle-double-right "></i> Save & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                             elseif(($user_data->menu_flag==2))
                             {
                                echo anchor('recruitment/profile?flag=3','<i class="fas fa-angle-double-right "></i> Skip & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
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
                        <th width='30%'>Name of the Award </th>
                        <th width='15%'>Description</th>
                        <th width='20%'>Year</th>
                        <th width='20%'>Actions</th>
                    </tr>
                    </thead>
                <?php  
                if($details){
                    foreach($details as $details1){ 
                    
                        echo '<tr>';
                        echo '<td>'.$details1->name.'</td>';
                        echo '<td>'.$details1->award.'</td>';
                        echo '<td>'.$details1->year.'</td>';
                        echo '<td>'.anchor('recruitment/updateAwards/'.$details1->id,'Edit','class="btn btn-info btn-square btn-sm mx-1 my-1"').anchor('recruitment/deleteAwards/'.$details1->id,'Delete','class="btn btn-danger btn-square btn-sm mx-1 my-1"').'</td>';
                        echo '</tr>';
                    }    }
                ?>
                </table>
              </div>
            </div>
            <?php
             
            ?>
             
           </div>
        </div><!-- row -->

  
</div>
