<div class="container">

        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Teaching Experience</span>
                    </div>  
                    
                <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-5">
                      <label class="tx-14 font-weight-bold">Institution / University Name</label>
                      <input type="text" class="form-control" placeholder="Enter Institution / University Name" id="institution" name="institution" value="<?php echo (set_value('institution'))?set_value('institution'):$details->institution;?>">
                      <?=form_error('institution','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-3">
                      <label class="tx-14 font-weight-bold">Designation</label>
                      <input type="text" class="form-control" placeholder="Enter Designation" id="designation" name="designation" value="<?php echo (set_value('designation'))?set_value('designation'):$details->designation;?>">
                      <?=form_error('designation','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Period From</label>
                      <input type="month" class="form-control" placeholder="Enter Exp From" id="period_from" name="period_from" value="<?php echo (set_value('period_from'))?set_value('period_from'):$details->period_from;?>">
                      <?=form_error('period_from','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Period To</label>
                      <input type="month" class="form-control" placeholder="Enter Exp To" id="period_to" name="period_to" value="<?php echo (set_value('period_to'))?set_value('period_to'):$details->period_to;?>">
                      <?=form_error('period_to','<div class="text-danger">','</div>');?>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                    <?php echo anchor('recruitment/manageTeaching','Cancel','class="btn btn-secondary btn-square btn-sm"'); ?>    
                </div>

                <?=form_close();?>
               </div>
             </div>
           </div>
        </div><!-- row -->
        
</div>
