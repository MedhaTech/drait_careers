<div class="container">

    <div class="row row-xs">
       <div class="col-lg-12">
         <div class="card ht-100p shadow">
           <div class="card-body pd-y-20">      

                <div class="widgetHead mb-3">
                    <span class="widgetTitle">Update Academic and Professional Information</span>
                </div>  

            <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate'); ?>
            <div class="form-row mg-b-10">
                
                <!-- Additional Information -->
                <div class="form-group col-md-6">
                  <label class="tx-14 font-weight-bold">Additional Information</label>
                  <input type="text" class="form-control" placeholder="Enter Additional Information" id="additional_information" name="additional_information" value="<?php echo (set_value('additional_information')) ? set_value('additional_information') : $details->additional_information; ?>">
                  <?=form_error('additional_information','<div class="text-danger">','</div>'); ?>
                </div>

                <!-- Award Recognition Title -->
                <div class="form-group col-md-6">
                  <label class="tx-14 font-weight-bold">Award Recognition Title</label>
                  <input type="text" class="form-control" placeholder="Enter Award Recognition Title" id="award_recognition_title" name="award_recognition_title" value="<?php echo (set_value('award_recognition_title')) ? set_value('award_recognition_title') : $details->award_recognition_title; ?>">
                  <?=form_error('award_recognition_title','<div class="text-danger">','</div>'); ?>
                </div>

                <!-- Project Titles for Award Recognition -->
                <div class="form-group col-md-6">
                  <label class="tx-14 font-weight-bold">Project Titles for Award Recognition</label>
                  <input type="text" class="form-control" placeholder="Enter Project Titles" id="project_titles_award_recognition" name="project_titles_award_recognition" value="<?php echo (set_value('project_titles_award_recognition')) ? set_value('project_titles_award_recognition') : $details->project_titles_award_recognition; ?>">
                  <?=form_error('project_titles_award_recognition','<div class="text-danger">','</div>'); ?>
                </div>

                <!-- Professional Experience Title -->
                <div class="form-group col-md-6">
                  <label class="tx-14 font-weight-bold">Professional Experience Title</label>
                  <input type="text" class="form-control" placeholder="Enter Professional Experience Title" id="other_professional_experience_title" name="other_professional_experience_title" value="<?php echo (set_value('other_professional_experience_title')) ? set_value('other_professional_experience_title') : $details->other_professional_experience_title; ?>">
                  <?=form_error('other_professional_experience_title','<div class="text-danger">','</div>'); ?>
                </div>

                <!-- Agree to Minimum Salary -->
                <div class="form-group col-md-6">
                  <label class="tx-14 font-weight-bold">Agree to Minimum Salary</label>
                  <select class="form-control" id="agree_to_minimum_salary" name="agree_to_minimum_salary">
                    <option value="1" <?=($details->agree_to_minimum_salary == 1) ? 'selected' : '' ?>>Yes</option>
                    <option value="0" <?=($details->agree_to_minimum_salary == 0) ? 'selected' : '' ?>>No</option>
                  </select>
                  <?=form_error('agree_to_minimum_salary','<div class="text-danger">','</div>'); ?>
                </div>

                <!-- In-Service Personnel (Checkbox) -->
                <div class="form-group col-md-6">
                  <label class="tx-14 font-weight-bold">In-Service Personnel</label>
                  <input type="checkbox" id="in_service_personnel" name="in_service_personnel" value="1" <?=($details->in_service_personnel == 1) ? 'checked' : '' ?>>
                  <label for="in_service_personnel" class="tx-14">Yes, I am an in-service personnel.</label>
                </div>

                <!-- Organization Forwarded (Checkbox) -->
                <div class="form-group col-md-6">
                  <label class="tx-14 font-weight-bold">Organization Forwarded</label>
                  <input type="checkbox" id="organization_forwarded" name="organization_forwarded" value="1" <?=($details->organization_forwarded == 1) ? 'checked' : '' ?>>
                  <label for="organization_forwarded" class="tx-14">Yes, my organization has forwarded the application.</label>
                </div>
            
            </div>

            <div class="col-md-12 text-right">
                <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                <?php echo anchor('recruitment/profile','Cancel','class="btn btn-secondary btn-square btn-sm"'); ?>    
            </div>

            <?=form_close();?>
           </div>
         </div>
       </div>
    </div><!-- row -->
</div>
