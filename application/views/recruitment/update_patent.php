<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">

                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Patent</span>
                    </div>

                    <?= form_open($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
                    <div class="form-row mg-b-10">

                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Application Number</label>
                            <input type="text" class="form-control" name="application_number" placeholder="Enter Application Number" value="<?= (set_value('application_number')) ? set_value('application_number') : $details->application_number; ?>">
                            <?= form_error('application_number', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Title of Patent</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title of Patent" value="<?= (set_value('title')) ? set_value('title') : $details->title; ?>">
                            <?= form_error('title', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Name of the Applicants</label>
                            <input type="text" class="form-control" name="applicants" placeholder="Enter Applicant Names" value="<?= (set_value('applicants')) ? set_value('applicants') : $details->applicants; ?>">
                            <?= form_error('applicants', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="tx-14 font-weight-bold">Status</label>
                            <?php
                            $statusList = array(" " => 'Select', 'Filed' => 'Filed', 'Published' => 'Published', 'Granted' => 'Granted');
                            echo form_dropdown('status', $statusList, (set_value('status')) ? set_value('status') : $details->status, 'class="form-control input-xs"');
                            ?>
                            <?= form_error('status', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group col-md-3" id="filed-date">
                            <label class="tx-14 font-weight-bold">Filed Date</label>
                            <input type="date" class="form-control" name="filed_date" value="<?= (set_value('filed_date')) ? set_value('filed_date') : $details->filed_date; ?>">
                        </div>

                        <div class="form-group col-md-3" id="published-date">
                            <label class="tx-14 font-weight-bold">Published Date</label>
                            <input type="date" class="form-control" name="published_date" value="<?= (set_value('published_date')) ? set_value('published_date') : $details->published_date; ?>">
                        </div>

                        <div class="form-group col-md-3" id="granted-date">
                            <label class="tx-14 font-weight-bold">Granted Date</label>
                            <input type="date" class="form-control" name="granted_date" value="<?= (set_value('granted_date')) ? set_value('granted_date') : $details->granted_date; ?>">
                        </div>


                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                        <?= anchor('recruitment/managePatents', 'Cancel', 'class="btn btn-secondary btn-square btn-sm"'); ?>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleDateFields() {
        const status = document.querySelector('[name="status"]').value;

        // Get each date field by ID
        const filed = document.getElementById('filed-date');
        const published = document.getElementById('published-date');
        const granted = document.getElementById('granted-date');

        // Hide all by default
        filed.style.display = 'none';
        published.style.display = 'none';
        granted.style.display = 'none';

        // Show fields based on status
        if (status === 'Filed') {
            filed.style.display = 'block';
        } else if (status === 'Published') {
            filed.style.display = 'block';
            published.style.display = 'block';
        } else if (status === 'Granted') {
            filed.style.display = 'block';
            published.style.display = 'block';
            granted.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleDateFields(); // Run on page load
        document.querySelector('[name="status"]').addEventListener('change', toggleDateFields); // Update on change
    });
</script>
