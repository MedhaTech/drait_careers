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
                    <div class="form-group col-md-9">
                      <label class="tx-14 font-weight-bold">Name</label>
                      <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name" value="<?php echo (set_value('name'))?set_value('name'):$details->name;?>">
                      <?=form_error('name','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="tx-14 font-weight-bold">Occupation or Position</label>
                      <input type="text" class="form-control" placeholder="Enter Occupation or Position" id="position" name="position" value="<?php echo (set_value('position'))?set_value('position'):$details->position;?>">
                      <?=form_error('position','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-5">
                      <label class="tx-14 font-weight-bold">Address for Communication with Contact Number</label>
                      <input type="text" class="form-control" placeholder="Enter Address for Communication with Contact Number" id="number" name="number" value="<?php echo (set_value('number'))?set_value('number'):$details->number;?>">
                      <?=form_error('number','<div class="text-danger">','</div>');?>
                    </div>
                 
                </div>
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                    <?php echo anchor('recruitment/dashboard','Cancel','class="btn btn-secondary btn-square btn-sm"'); ?>    
                </div>

                <?=form_close();?>
               </div>
             </div>
           </div>
        </div><!-- row -->
        
</div>
