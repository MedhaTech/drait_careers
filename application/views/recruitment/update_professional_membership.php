<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Professional Membership</span>
                    </div>

                    <?=form_open($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
                    <div class="form-row mg-b-10">
                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">Professional Organization</label>
                            <input type="text" class="form-control" placeholder="Enter Professional Organization" id="professional_organization" name="professional_organization" value="<?= (set_value('professional_organization')) ? set_value('professional_organization') : $details->professional_organization; ?>">
                            <?=form_error('professional_organization', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Year of Selection</label>
                            <input type="text" class="form-control" placeholder="Enter Year of Selection" id="year_of_selection" name="year_of_selection" value="<?= (set_value('year_of_selection')) ? set_value('year_of_selection') : $details->year_of_selection; ?>">
                            <?=form_error('year_of_selection', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Grade of Membership</label>
                            <input type="text" class="form-control" placeholder="Enter Grade of Membership" id="grade_of_membership" name="grade_of_membership" value="<?= (set_value('grade_of_membership')) ? set_value('grade_of_membership') : $details->grade_of_membership; ?>">
                            <?=form_error('grade_of_membership', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                        <?= anchor('recruitment/manageProfessionalMemberships', 'Cancel', 'class="btn btn-secondary btn-square btn-sm"'); ?>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div><!-- row -->

</div>
