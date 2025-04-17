<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Add New Seminar/Workshop/Course</span>
                    </div>

                    <?= form_open($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
                    <div class="form-row mg-b-10">
                        <div class="form-group col-md-6">
                            <label class="tx-14 font-weight-bold">Title of Seminar/Workshop/Course</label>
                            <input type="text" class="form-control" placeholder="Enter Title" id="title_of_project" name="title_of_project" value="<?= (set_value('title_of_project')) ? set_value('title_of_project') : ''; ?>">
                            <?= form_error('title_of_project', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="tx-14 font-weight-bold">Organised/Conducted By</label>
                            <input type="text" class="form-control" placeholder="Enter Organiser/Conducted By" id="organised_conducted" name="organised_conducted" value="<?= (set_value('organised_conducted')) ? set_value('organised_conducted') : ''; ?>">
                            <?= form_error('organised_conducted', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-square btn-sm" type="submit">Add</button>
                        <?= anchor('recruitment/manageSeminarsWorkshopsCourses', 'Cancel', 'class="btn btn-secondary btn-square btn-sm"'); ?>
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
                        <span class="widgetTitle">List of Seminars/Workshops/Courses</span>
                    </div>

                    <table class="table table-hover text-dark">
                        <thead>
                            <tr>
                                <th>Title of Seminar/Workshop/Course</th>
                                <th>Organised/Conducted By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php if ($details) { ?>
                            <?php foreach ($details as $details1) { ?>
                                <tr>
                                    <td><?= $details1->title_of_project ?></td>
                                    <td><?= $details1->organised_conducted ?></td>
                                    <td>
                                        <?= anchor('recruitment/updateSeminarsWorkshopsCourses/' . $details1->id, 'Edit', 'class="btn btn-info btn-square btn-sm mx-1 my-1"') ?>
                                        <?= anchor('recruitment/deleteSeminarsWorkshopsCourses/' . $details1->id, 'Delete', 'class="btn btn-danger btn-square btn-sm mx-1 my-1"') ?>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo '<tr><td colspan="3" class="text-center text-muted">No seminars/workshops/courses added yet.</td></tr>';
                        } ?>
                    </table>
                </div>
            </div>

        </div>
    </div><!-- row -->

</div>