<div class="container">

        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Personal</span>
                    </div>  
                    
                <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                 
                   
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Mobile No</label>
                      <input type="text" class="form-control" placeholder="Enter Mobile No" required id="mobile" name="mobile" value="<?php echo (set_value('mobile'))?set_value('mobile'):$details->mobile;?>">
                      <?=form_error('mobile','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Father's Name</label> 
                      <input type="text" class="form-control" placeholder="Enter Father's Name" required id="father_name" name="father_name" value="<?php echo (set_value('father_name'))?set_value('father_name'):$details->father_name;?>">
                      <?=form_error('father_name','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Date of Birth</label>
                      <input type="date" class="form-control"  id="date_of_birth" name="date_of_birth" required value="<?php echo (set_value('date_of_birth'))?set_value('date_of_birth'):$details->date_of_birth;?>">
                      <?=form_error('date_of_birth','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Father's Occupation</label>
                    <input type="tex" class="form-control" placeholder="Enter Father's Occupation" required  id="father_occupation" name="father_occupation" value="<?php echo (set_value('father_occupation'))?set_value('father_occupation'):$details->father_occupation;?>">
                      <?=form_error('father_occupation','<div class="text-danger">','</div>');?>
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Place of Birth</label>
                      <input type="text" class="form-control" placeholder="Enter Place of Birth" id="place_of_birth" name="place_of_birth" value="<?php echo (set_value('place_of_birth'))?set_value('place_of_birth'):$details->place_of_birth;?>">
                      <?=form_error('place_of_birth','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Address for Correspondence</label>
                      <input type="text" class="form-control" placeholder="Enter Address for Correspondence" id="address" name="address" value="<?php echo (set_value('address'))?set_value('address'):$details->address;?>">
                      <?=form_error('address','<div class="text-danger">','</div>');?>
                    </div>
                     <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Religion & Caste</label>
                      <input type="text" class="form-control" placeholder="Enter Religion & Caste" id="religion" name="religion" value="<?php echo (set_value('religion'))?set_value('religion'):$details->religion;?>">
                      <?=form_error('religion','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Reservation Category</label>
                      <input type="text" class="form-control" placeholder="Enter Reservation Category" id="reservation_category" name="reservation_category" value="<?php echo (set_value('reservation_category'))?set_value('reservation_category'):$details->reservation_category;?>">
                      <?=form_error('reservation_category','<div class="text-danger">','</div>');?>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <?php if($details->menu_flag==0) {?>
                    <input type="hidden" class="form-control" id="menu_flag" name="menu_flag" value="1">
                    <button class="btn btn-primary btn-square btn-sm" type="submit">Update & Proceed</button>
                    <?php } else {?>
                     <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                    <?php }?>
                    <?php echo anchor('recruitment/profile','Back','class="btn btn-secondary btn-square btn-sm"'); ?>    
                    
                </div>

                <?=form_close();?>
               </div>
             </div>
           </div>
        </div><!-- row -->
        
</div>
