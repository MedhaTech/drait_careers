<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">
                
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Consultancy Project</span>
                    </div>

                    <?=form_open($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
                    <div class="form-row mg-b-10">

                        <!-- Organization -->
                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">Organization</label>
                            <input type="text" class="form-control" placeholder="Enter Organization" id="organization" name="organization" value="<?= (set_value('organization')) ? set_value('organization') : $details->organization; ?>">
                            <?=form_error('organization', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Title of Project -->
                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">Title of Project</label>
                            <input type="text" class="form-control" placeholder="Enter Title of Project" id="title_of_project" name="title_of_project" value="<?= (set_value('title_of_project')) ? set_value('title_of_project') : $details->title_of_project; ?>">
                            <?=form_error('title_of_project', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Amount of Grant -->
                        <div class="form-group col-md-2">
                            <label class="tx-14 font-weight-bold">Amount of Grant</label>
                            <input type="text" class="form-control" placeholder="Enter Amount of Grant" id="amount_of_grant" name="amount_of_grant" value="<?= (set_value('amount_of_grant')) ? set_value('amount_of_grant') : $details->amount_of_grant; ?>">
                            <?=form_error('amount_of_grant', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Period -->
                        <div class="form-group col-md-2">
                            <label class="tx-14 font-weight-bold">Period</label>
                            <input type="text" class="form-control" placeholder="Enter Period" id="period" name="period" value="<?= (set_value('period')) ? set_value('period') : $details->period; ?>">
                            <?=form_error('period', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Co-investigators -->
                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">Co-investigators</label>
                            <input type="text" class="form-control" placeholder="Enter Co-investigators" id="co_investigators" name="co_investigators" value="<?= (set_value('co_investigators')) ? set_value('co_investigators') : $details->co_investigators; ?>">
                            <?=form_error('co_investigators', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Program Type (Dropdown) -->
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Program Type</label>
                            <?php 
                                $programTypeList = array(" " => 'Select', 'Research' => 'Research', 'Development' => 'Development', 'Training' => 'Training');
                                echo form_dropdown('program_type', $programTypeList, (set_value('program_type')) ? set_value('program_type') : $details->program_type, 'class="form-control input-xs" id="program_type"'); 
                            ?>
                            <?=form_error('program_type', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <!-- Status (Dropdown) -->
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Status</label>
                            <?php 
                                $statusList = array(" " => 'Select', 'Ongoing' => 'Ongoing', 'Completed' => 'Completed');
                                echo form_dropdown('status', $statusList, (set_value('status')) ? set_value('status') : $details->status, 'class="form-control input-xs" id="status"'); 
                            ?>
                            <?=form_error('status', '<div class="text-danger">', '</div>'); ?>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                        <?php echo anchor('recruitment/manageConsultancies', 'Cancel', 'class="btn btn-secondary btn-square btn-sm"'); ?>
                    </div>

                    <?=form_close();?>
                </div>
            </div>
        </div>
    </div><!-- row -->
    
</div>
