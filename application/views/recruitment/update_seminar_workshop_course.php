<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Seminar/Workshop/Course</span>
                    </div>

                    <?= form_open($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
                    <div class="form-row mg-b-10">
                        <div class="form-group col-md-6">
                            <label class="tx-14 font-weight-bold">Title of Seminar/Workshop/Course</label>
                            <input type="text" class="form-control" placeholder="Enter Title" id="title_of_project" name="title_of_project" value="<?= (set_value('title_of_project')) ? set_value('title_of_project') : $details->title_of_project; ?>">
                            <?= form_error('title_of_project', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="tx-14 font-weight-bold">Organised/Conducted By</label>
                            <input type="text" class="form-control" placeholder="Enter Organiser/Conducted By" id="organised_conducted" name="organised_conducted" value="<?= (set_value('organised_conducted')) ? set_value('organised_conducted') : $details->organised_conducted; ?>">
                            <?= form_error('organised_conducted', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="form-row mg-b-10">
                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">From Date</label>
                            <input type="date" class="form-control" id="from_date" name="from_date"
                                value="<?= (set_value('from_date')) ? set_value('from_date') : $details->from_date; ?>">
                            <?= form_error('from_date', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">To Date</label>
                            <input type="date" class="form-control" id="to_date" name="to_date"
                                value="<?= (set_value('to_date')) ? set_value('to_date') : $details->to_date; ?>">
                            <?= form_error('to_date', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">Total Days</label>
                            <input type="number" class="form-control" id="total_days" name="total_days"
                                readonly
                                value="<?= (set_value('total_days')) ? set_value('total_days') : $details->total_days; ?>">
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                        <?= anchor('recruitment/manageSeminarsWorkshopsCourses', 'Cancel', 'class="btn btn-secondary btn-square btn-sm"'); ?>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div><!-- row -->

</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const fromDateInput = document.getElementById("from_date");
    const toDateInput = document.getElementById("to_date");
    const totalDaysInput = document.getElementById("total_days");

    function calculateDays() {
        const fromDate = new Date(fromDateInput.value);
        const toDate = new Date(toDateInput.value);

        if (!isNaN(fromDate) && !isNaN(toDate)) {
            const timeDiff = toDate - fromDate;
            const daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24)) + 1;
            totalDaysInput.value = daysDiff > 0 ? daysDiff : 0;
        } else {
            totalDaysInput.value = '';
        }
    }

    fromDateInput.addEventListener("change", calculateDays);
    toDateInput.addEventListener("change", calculateDays);
});
</script>
