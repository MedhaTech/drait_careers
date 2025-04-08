<div class="container-fluid">

    <!-- <h1 class="h3 mb-2 text-gray-800"> Grievance Tickets </h1> -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $pageTitle; ?></h6>
        </div>
        <div class="card-body">
            <?php if ($this->session->flashdata('message')) { ?>
                <div class="alert <?= $this->session->flashdata('status'); ?>" id="msg">
                    <?php echo $this->session->flashdata('message') ?>
                </div>
            <?php } ?>

            <?php echo form_open_multipart($action, 'class="user"'); ?>


            <div class="form-group row">
                <label class="col-form-label text-right font-weight-bold">Post title</label>
                <div class="col-sm-12">
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo (set_value('title')) ? set_value('title') : $title; ?>">
                    <span class="validationError"><?php echo form_error('title'); ?></span>
                </div>
            </div>
            <div class="form-group row col-sm-4">
                <label class="col-sm-3 col-form-label text-right font-weight-bold">Application Type</label>
                <div class="col-sm-4">
                    <?php $courseTypeOpt = array('' => 'Choose', 'Teaching' => 'Teaching', 'Non-Teaching' => 'Non-Teaching', 'Librarian' => 'Librarian');
                    echo form_dropdown('type', $courseTypeOpt, '0', 'class="form-control" id="type"'); ?>
                    <span class="validationError"><?php echo form_error('type'); ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-right font-weight-bold">Academic Year</label>
                <div class="col-sm-4">
                    <?php
                    $ayList = array(" " => "- Select -", "2023-24" => "2023-24", "2024-25" => "2024-25", "2025-26" => "2025-26");
                    echo form_dropdown('ay', $ayList, set_value('ay', ''), 'class="form-control"');
                    ?>
                    <span class="validationError"><?php echo form_error('ay'); ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-right font-weight-bold">Description</label>
                <div class="col-sm-4">
                    <input type="text" name="description" id="description" class="form-control" value="<?php echo (set_value('description')) ? set_value('description') : $description; ?>">
                    <span class="validationError"><?php echo form_error('description'); ?></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-right font-weight-bold">Application Fee</label>
                <div class="col-sm-4">
                    <input type="text" name="fee" id="fee" class="form-control" value="<?php echo (set_value('fee')) ? set_value('fee') : $fee; ?>">
                    <span class="validationError"><?php echo form_error('fee'); ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-right font-weight-bold">&nbsp;</label>
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="status" value="1" name="status" <?php echo ($status) ? 'checked' : ''; ?>>
                    <label class="custom-control-label" for="status">is Active</label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3"> &nbsp;</div>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Submit </button>
                    <?php echo anchor('main/jobposts', '<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" '); ?>
                </div>
            </div>

            </form>
        </div>
    </div>

</div>