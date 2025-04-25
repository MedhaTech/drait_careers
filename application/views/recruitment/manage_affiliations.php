<div class="container">

        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Add New Affiliations Details</span>
                    </div>  
                    
                <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-12">
                      <label class="tx-14 font-weight-bold">Name of the Professional Body</label>
                      <input type="text" class="form-control" placeholder="Enter Name of the Professional Body" id="name" name="name" value="<?php echo (set_value('name'))?set_value('name'):'';?>">
                      <?=form_error('name','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="tx-14 font-weight-bold">Grade of Membership</label>
                      <input type="text" class="form-control" placeholder="Enter Grade of Membership" id="grade" name="grade" value="<?php echo (set_value('grade'))?set_value('grade'):'';?>">
                      <?=form_error('grade','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="tx-14 font-weight-bold">Number of Membership</label>
                      <input type="text" class="form-control" placeholder="Enter Number of Membership" id="number" name="number" value="<?php echo (set_value('number'))?set_value('number'):'';?>">
                      <?=form_error('number','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="tx-14 font-weight-bold">Year of Selection</label>
                      <input type="year" class="form-control" placeholder="Enter Year of Selection" id="year" name="year" value="<?php echo (set_value('year'))?set_value('year'):'';?>">
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
                    <span class="widgetTitle">List of Affiliations </span>
                     <span tabindex="0" class="add no-outline">
                            <?php 
                             if(($user_data->menu_flag==7)&& (count($details)>1))
                             {
                                echo anchor('recruitment/profile?flag=8','<i class="fas fa-angle-double-right "></i> Save & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                             elseif(($user_data->menu_flag==7))
                             {
                                echo anchor('recruitment/profile?flag=8','<i class="fas fa-angle-double-right "></i> Skip & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                            ?>
                        </span>
                </div> 
                    
                <table class="table table-hover text-dark">
                    <thead>
                    <tr>
                        <th width='30%'>Name of the Professional Body </th>
                        <th width='15%'>Grade of Membership</th>
                        <th width='15%'>Number of Membership</th>
                        <th width='20%'>Year of Selection</th>
                        <th width='20%'>Actions</th>
                    </tr>
                    </thead>
                <?php  
                if($details){
                    foreach($details as $details1){ 
                    
                        echo '<tr>';
                        echo '<td>'.$details1->name.'</td>';
                        echo '<td>'.$details1->grade.'</td>';
                        echo '<td>'.$details1->number.'</td>';
                        echo '<td>'.$details1->year.'</td>';
                        echo '<td>'.anchor('recruitment/updateAffiliations/'.$details1->id,'Edit','class="btn btn-info btn-square btn-sm mx-1 my-1"').anchor('recruitment/deleteAffiliations/'.$details1->id,'Delete','class="btn btn-danger btn-square btn-sm mx-1 my-1"').'</td>';
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
