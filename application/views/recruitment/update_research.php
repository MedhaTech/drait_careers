<div class="container">

        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Research Experience</span>
                    </div>  
                    
                <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Institution / University Name</label>
                      <input type="text" class="form-control" placeholder="Enter Institution / University Name" id="institution" name="institution" value="<?php echo (set_value('institution'))?set_value('institution'):$details->institution;?>">
                      <?=form_error('institution','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-5">
                      <label class="tx-14 font-weight-bold">Area of Research</label>
                      <input type="text" class="form-control" placeholder="Enter Ared of Research" id="area_of_research" name="area_of_research" value="<?php echo (set_value('area_of_research'))?set_value('area_of_research'):$details->area_of_research;?>">
                      <?=form_error('area_of_research','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Period From</label>
                      <input type="month" class="form-control" placeholder="Enter Exp From" id="exp_from" name="exp_from" value="<?php echo (set_value('exp_from'))?set_value('exp_from'):$details->exp_from;?>">
                      <?=form_error('exp_from','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Period To</label>
                      <input type="month" class="form-control" placeholder="Enter Exp To" id="exp_to" name="exp_to" value="<?php echo (set_value('exp_to'))?set_value('exp_to'):$details->exp_to;?>">
                      <?=form_error('exp_to','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-2">
                      <label class="tx-14 font-weight-bold">Total Exp.</label>
                      <input type="text" class="form-control" placeholder="Enter Total Exp." id="total" name="total" value="<?php echo (set_value('total'))?set_value('total'):$details->total;?>">
                      <?=form_error('total','<div class="text-danger">','</div>');?>
                    </div>
                     
                </div>
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                    <?php echo anchor('recruitment/manageResearch','Cancel','class="btn btn-secondary btn-square btn-sm"'); ?>    
                </div>

                <?=form_close();?>
               </div>
             </div>
           </div>
        </div><!-- row -->
        
</div>
