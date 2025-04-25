<div class="container">

        
        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update References Details</span>
                    </div>  

                
                
                   <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Language</label>
                      <input type="text" class="form-control" placeholder="Enter Language" id="name" name="name" value="<?php echo (set_value('name'))?set_value('name'):$details->name;?>">
                      <?=form_error('name','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Read</label>
                      <input type="checkbox" class="form-control"name="reading" <?php  if($details->reading==1) { echo "checked";}?> value="1">
                      <?=form_error('reading','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Write</label>
                      <input type="checkbox" class="form-control" id="writ" name="writ"  <?php  if($details->writ==1) { echo "checked";}?> value="1">
                      <?=form_error('writ','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Speak</label>
                      <input type="checkbox" class="form-control" id="speak" name="speak"  <?php  if($details->speak==1) { echo "checked";}?> value="1">
                      <?=form_error('speak','<div class="text-danger">','</div>');?>
                    </div>
                 
                </div>
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                    <?php echo anchor('recruitment/profile','Back','class="btn btn-secondary btn-square btn-sm"'); ?>    
                </div>

                <?=form_close();?>
               </div>
             </div>
           </div>
        </div><!-- row -->
        
</div>
