<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Add New Professional Membership</span>
                    </div>

                    <?= form_open($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
                    <div class="form-row mg-b-10">
                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">Professional Organization</label>
                            <input type="text" class="form-control" placeholder="Enter Professional Organization" id="professional_organization" name="professional_organization" value="<?= (set_value('professional_organization')) ? set_value('professional_organization') : ''; ?>">
                            <?= form_error('professional_organization', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Year of Selection</label>
                            <input type="text" class="form-control" placeholder="Enter Year of Selection" id="year_of_selection" name="year_of_selection" value="<?= (set_value('year_of_selection')) ? set_value('year_of_selection') : ''; ?>">
                            <?= form_error('year_of_selection', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Grade of Membership</label>
                            <input type="text" class="form-control" placeholder="Enter Grade of Membership" id="grade_of_membership" name="grade_of_membership" value="<?= (set_value('grade_of_membership')) ? set_value('grade_of_membership') : ''; ?>">
                            <?= form_error('grade_of_membership', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-square btn-sm" type="submit">Add</button>
                        <?= anchor('recruitment/profile', 'Back', 'class="btn btn-secondary btn-square btn-sm"'); ?>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div><!-- row -->

    <div class="row row-xs mt-4">
        <div class="col-lg-12">
            <?php if ($this->session->flashdata('message')) { ?>
                <div align="center" class="alert <?= $this->session->flashdata('status'); ?>" id="msg">
                    <?php echo $this->session->flashdata('message') ?>
                </div>
            <?php } ?>


            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">List of Professional Memberships</span>
                        <span tabindex="0" class="add no-outline">
                        <?php 
                             if( (count($details)>=1))
                             {
                                echo anchor('recruitment/profile?flag=8','<i class="fas fa-angle-double-right "></i> Save & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                             elseif(($user_data->menu_flag==7))
                             {
                                echo anchor('recruitment/profile?flag=8','<i class="fas fa-angle-double-right "></i> Skip & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                             else
                             {
                              echo anchor('recruitment/profile','<i class="fas fa-angle-double-right "></i> Skip & Proceed','class="btn btn-block btn-success btn-square btn-sm"');
                             }
                            ?>
                        </span>
                    </div>

                    <table class="table table-hover text-dark">
                        <thead>
                            <tr>
                                <th>Professional Organization</th>
                                <th>Year of Selection</th>
                                <th>Grade of Membership</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php if ($details) { ?>
                            <?php foreach ($details as $details1) { ?>
                                <tr>
                                    <td><?= $details1->professional_organization ?></td>
                                    <td><?= $details1->year_of_selection ?></td>
                                    <td><?= $details1->grade_of_membership ?></td>
                                    <td>
                                        <?= anchor('recruitment/updateProfessionalMembership/' . $details1->id, 'Edit', 'class="btn btn-info btn-square btn-sm mx-1 my-1"') ?>
                                        <?= anchor('recruitment/deleteProfessionalMembership/' . $details1->id, 'Delete', 'class="btn btn-danger btn-square btn-sm mx-1 my-1"') ?>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo '<tr><td colspan="4" class="text-center text-muted">No Professional Memberships added yet.</td></tr>';
                        } ?>
                    </table>
                </div>
            </div>

        </div>
    </div><!-- row -->

</div>