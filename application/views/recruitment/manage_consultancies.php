<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">

                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Add New Consultancy Project</span>
                    </div>

                    <?= form_open($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
                    <div class="form-row mg-b-10">
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Organization</label>
                            <input type="text" class="form-control" placeholder="Enter Organization" id="organization" name="organization" value="<?php echo (set_value('organization')) ? set_value('organization') : ''; ?>">
                            <?= form_error('organization', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Title of Project</label>
                            <input type="text" class="form-control" placeholder="Enter Title of Project" id="title_of_project" name="title_of_project" value="<?php echo (set_value('title_of_project')) ? set_value('title_of_project') : ''; ?>">
                            <?= form_error('title_of_project', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="tx-14 font-weight-bold">Amount of Grant</label>
                            <input type="text" class="form-control" placeholder="Enter Amount of Grant" id="amount_of_grant" name="amount_of_grant" value="<?php echo (set_value('amount_of_grant')) ? set_value('amount_of_grant') : ''; ?>">
                            <?= form_error('amount_of_grant', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="tx-14 font-weight-bold">Period</label>
                            <input type="text" class="form-control" placeholder="Enter Period" id="period" name="period" value="<?php echo (set_value('period')) ? set_value('period') : ''; ?>">
                            <?= form_error('period', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="tx-14 font-weight-bold">Co-investigators</label>
                            <input type="text" class="form-control" placeholder="Enter Co-investigators" id="co_investigators" name="co_investigators" value="<?php echo (set_value('co_investigators')) ? set_value('co_investigators') : ''; ?>">
                            <?= form_error('co_investigators', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-square btn-sm" type="submit">Add</button>
                        <?php echo anchor('recruitment/profile', 'Back', 'class="btn btn-secondary btn-square btn-sm"'); ?>
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
            <?php }
            ?>
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">List of Consultancy Projects</span>
                        <span tabindex="0" class="add no-outline">
                        <?php 
                             if( (count($details)>1))
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
                                <th>Organization</th>
                                <th>Title of Project</th>
                                <th>Amount of Grant</th>
                                <th>Period</th>
                                <th>Co-investigators</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php if ($details) {
                            foreach ($details as $details1) { ?>
                                <tr>
                                    <td><?= $details1->organization ?></td>
                                    <td><?= $details1->title_of_project ?></td>
                                    <td><?= $details1->amount_of_grant ?></td>
                                    <td><?= $details1->period ?></td>
                                    <td><?= $details1->co_investigators ?></td>
                                    <td>
                                        <?= anchor('recruitment/updateConsultancy/' . $details1->id, 'Edit', 'class="btn btn-info btn-square btn-sm mx-1 my-1"') ?>
                                        <?= anchor('recruitment/deleteConsultancy/' . $details1->id, 'Delete', 'class="btn btn-danger btn-square btn-sm mx-1 my-1"') ?>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo '<tr><td colspan="6" class="text-center text-muted">No Consultancy Projects added yet.</td></tr>';
                        } ?>
                    </table>
                </div>
            </div>

        </div>
    </div><!-- row -->

</div>