<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">
                
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Education</span>
                    </div>

                    <?=form_open($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
                    <div class="form-row mg-b-10">
                        <div class="form-group col-md-2">
                            <label class="tx-14 font-weight-bold">Program</label>
                            <?php 
                                $programList = array(" " => 'Select', 'UG' => 'UG', 'PG' => 'PG', 'Ph.D' => 'Ph.D', 'Other' => 'Other');
                                echo form_dropdown('program', $programList, (set_value('program')) ? set_value('program') : $details->program, 'class="form-control input-xs" id="program"'); 
                            ?>
                            <?=form_error('program', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <label class="tx-14 font-weight-bold">Year of Passing</label>
                            <input type="month" class="form-control" id="year_of_passing" name="year_of_passing" value="<?= (set_value('year_of_passing')) ? set_value('year_of_passing') : $details->year_of_passing; ?>">
                            <?=form_error('year_of_passing', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Degree</label>
                            <input type="text" class="form-control" placeholder="Enter Degree" id="degree" name="degree" value="<?= (set_value('degree')) ? set_value('degree') : $details->degree; ?>">
                            <?=form_error('degree', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-md-5">
                            <label class="tx-14 font-weight-bold">Specialization</label>
                            <input type="text" class="form-control" placeholder="Enter Specialization" id="specialization" name="specialization" value="<?= (set_value('specialization')) ? set_value('specialization') : $details->specialization; ?>">
                            <?=form_error('specialization', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="tx-14 font-weight-bold">Institution / University Name</label>
                            <input type="text" class="form-control" placeholder="Enter Institution / University Name" id="university_name" name="university_name" value="<?= (set_value('university_name')) ? set_value('university_name') : $details->university_name; ?>">
                            <?=form_error('university_name', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="tx-14 font-weight-bold">Program Type</label>
                            <?php 
                                $programTypeList = array(" " => 'Select', 'FullTime' => 'FullTime', 'PartTime' => 'PartTime');
                                echo form_dropdown('program_type', $programTypeList, (set_value('program_type')) ? set_value('program_type') : $details->program_type, 'class="form-control input-xs" id="program_type"'); 
                            ?>
                            <?=form_error('program_type', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="tx-14 font-weight-bold">Percentage of Marks</label>
                            <input type="text" class="form-control" placeholder="Enter Percentage of Marks" id="marks_percentage" name="marks_percentage" value="<?= (set_value('marks_percentage')) ? set_value('marks_percentage') : $details->marks_percentage; ?>">
                            <?=form_error('marks_percentage', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="tx-14 font-weight-bold">Class Awarded</label>
                            <input type="text" class="form-control" placeholder="Enter Class Awarded" id="class_awarded" name="class_awarded" value="<?= (set_value('class_awarded')) ? set_value('class_awarded') : $details->class_awarded; ?>">
                            <?=form_error('class_awarded', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                        <?php echo anchor('recruitment/manageEducation', 'Cancel', 'class="btn btn-secondary btn-square btn-sm"'); ?>
                    </div>

                    <?=form_close();?>
                </div>
            </div>
        </div>
    </div><!-- row -->
    
</div>
