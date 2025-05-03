<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">

                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Add New Patent</span>
                    </div>

                    <?= form_open($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
                    <div class="form-row mg-b-10">
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Application Number</label>
                            <input type="text" class="form-control" placeholder="Enter Application Number" name="application_number" value="<?= set_value('application_number'); ?>">
                            <?= form_error('application_number', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Title of Patent</label>
                            <input type="text" class="form-control" placeholder="Enter Title of Patent" name="title" value="<?= set_value('title'); ?>">
                            <?= form_error('title', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Applicants</label>
                            <input type="text" class="form-control" placeholder="Enter Applicant Names" name="applicants" value="<?= set_value('applicants'); ?>">
                            <?= form_error('applicants', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select</option>
                                <option value="Filed">Filed</option>
                                <option value="Published">Published</option>
                                <option value="Granted">Granted</option>
                            </select>
                            <?= form_error('status', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-3" id="filed-date">
                            <label class="tx-14 font-weight-bold">Filed Date</label>
                            <input type="date" class="form-control" name="filed_date" value="<?= set_value('filed_date'); ?>">
                        </div>
                        <div class="form-group col-md-3" id="published-date">
                            <label class="tx-14 font-weight-bold">Published Date</label>
                            <input type="date" class="form-control" name="published_date" value="<?= set_value('published_date'); ?>">
                        </div>
                        <div class="form-group col-md-3" id="granted-date">
                            <label class="tx-14 font-weight-bold">Granted Date</label>
                            <input type="date" class="form-control" name="granted_date" value="<?= set_value('granted_date'); ?>">
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
    </div>

    <div class="row row-xs mt-4">
        <div class="col-lg-12">
            <?php if ($this->session->flashdata('message')) { ?>
                <div align="center" class="alert <?= $this->session->flashdata('status'); ?>" id="msg">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            <?php } ?>


            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">List of Patents</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ((count($details) >= 1)) {
                                echo anchor('recruitment/profile?flag=8', '<i class="fas fa-angle-double-right "></i> Save & Proceed', 'class="btn btn-block btn-success btn-square btn-sm"');
                            } else {
                                echo anchor('recruitment/profile', '<i class="fas fa-angle-double-right "></i> Skip & Proceed', 'class="btn btn-block btn-success btn-square btn-sm"');
                            }
                            ?>
                        </span>
                    </div>

                    <table class="table table-hover text-dark">
                        <thead>
                            <tr>
                                <th>Application No.</th>
                                <th>Title</th>
                                <th>Applicants</th>
                                <th>Status</th>
                                <th>Filed Date</th>
                                <th>Published Date</th>
                                <th>Granted Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($details) { ?>
                                <?php foreach ($details as $patent) { ?>
                                    <tr>
                                        <td><?= $patent->application_number; ?></td>
                                        <td><?= $patent->title; ?></td>
                                        <td><?= $patent->applicants; ?></td>
                                        <td><?= $patent->status; ?></td>
                                        <td>
                                            <?= ($patent->filed_date && in_array($patent->status, ['Filed', 'Published', 'Granted']))
                                                ? $patent->filed_date
                                                : ''; ?>
                                        </td>
                                        <td>
                                            <?= ($patent->published_date && in_array($patent->status, ['Published', 'Granted']))
                                                ? $patent->published_date
                                                : ''; ?>
                                        </td>
                                        <td>
                                            <?= ($patent->granted_date && $patent->status === 'Granted')
                                                ? $patent->granted_date
                                                : ''; ?>
                                        </td>
                                        <td>
                                            <?= anchor('recruitment/updatePatent/' . $patent->id, 'Edit', 'class="btn btn-info btn-square btn-sm mx-1 my-1"'); ?>
                                            <?= anchor('recruitment/deletePatent/' . $patent->id, 'Delete', 'class="btn btn-danger btn-square btn-sm mx-1 my-1"'); ?>
                                        </td>
                                    </tr>
                            <?php }
                            } else {
                                echo '<tr><td colspan="8" class="text-center text-muted">No patents added yet.</td></tr>';
                            }  ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function toggleDateFields() {
        const status = document.querySelector('[name="status"]').value;

        document.getElementById('filed-date').style.display = 'none';
        document.getElementById('published-date').style.display = 'none';
        document.getElementById('granted-date').style.display = 'none';

        if (status === 'Filed') {
            document.getElementById('filed-date').style.display = 'block';
        } else if (status === 'Published') {
            document.getElementById('filed-date').style.display = 'block';
            document.getElementById('published-date').style.display = 'block';
        } else if (status === 'Granted') {
            document.getElementById('filed-date').style.display = 'block';
            document.getElementById('published-date').style.display = 'block';
            document.getElementById('granted-date').style.display = 'block';
        }
    }

    // Run on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleDateFields();
        document.querySelector('[name="status"]').addEventListener('change', toggleDateFields);
    });
</script>