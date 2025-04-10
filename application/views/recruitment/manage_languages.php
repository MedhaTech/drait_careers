<div class="container">

        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Add New Language Details</span>
                    </div>  
                    
                <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Language</label>
                      <input type="text" class="form-control" placeholder="Enter Language" id="name" name="name" value="<?php echo (set_value('name'))?set_value('name'):'';?>">
                      <?=form_error('name','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Read</label>
                      <input type="checkbox" class="form-control"name="reading" value="1">
                      <?=form_error('reading','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Write</label>
                      <input type="checkbox" class="form-control" id="writ" name="writ" value="1">
                      <?=form_error('writ','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Speak</label>
                      <input type="checkbox" class="form-control" id="speak" name="speak" value="1">
                      <?=form_error('speak','<div class="text-danger">','</div>');?>
                    </div>
                 
                </div>
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary btn-square btn-sm" type="submit">Add</button>
                    <?php echo anchor('recruitment/profile','Cancel','class="btn btn-secondary btn-square btn-sm"'); ?>    
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
                if($details){
            ?>
            <div class="card ht-100p shadow">
              <div class="card-body pd-y-20">
                <div class="widgetHead mb-3">
                    <span class="widgetTitle">List of Languages</span>
                      <span tabindex="0" class="add no-outline">
                            <?php 
                             if(($user_data->menu_flag==1) && (count($details)>0))
                             {
                                echo anchor('recruitment/profile?flag=2','<i class="fas fa-angle-double-right "></i> Save & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                            ?>
                        </span>
                </div> 
                    
                <table class="table table-hover text-dark">
                    <thead>
                    <tr>
                        <th width='30%'>Name</th>
                        <th width='15%'>Read</th>
                        <th width='15%'>Write</th>
                       <th width='15%'>Speak</th>
                        <th width='20%'>Actions</th>
                    </tr>
                    </thead>
                <?php  
                    foreach($details as $details1){ 
                    
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
                        echo '<td>'.anchor('recruitment/updateLanguages/'.$details1->id,'Edit','class="btn btn-info btn-square btn-sm mx-1 my-1"').anchor('recruitment/deleteLanguages/'.$details1->id,'Delete','class="btn btn-danger btn-square btn-sm mx-1 my-1"').'</td>';
                        echo '</tr>';
                    } 
                ?>
                </table>
              </div>
            </div>
            <?php
                }
            ?>
             
           </div>
        </div><!-- row -->

  
</div>
