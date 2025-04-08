<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>


<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $pageTitle; ?></h6>
            </div>
            <!-- Nested Row within Card Body -->
            <div class="row">

                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">


                            <?php if ($this->session->flashdata('message')) { ?>
                                <div class="alert <?= $this->session->flashdata('status'); ?>" id="msg">
                                    <?php echo $this->session->flashdata('message') ?>
                                </div>
                            <?php } ?>

                        </div>
                        <?php echo form_open_multipart($action, 'class="user"'); ?>

                        <div class="form-group">
                            <label>Post title</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo (set_value('title')) ? set_value('title') : $title; ?>">
                            <span class="validationError"><?php echo form_error('title'); ?></span>
                        </div>
                        <div class="form-group">
                            <label>Post Description</label>
                            <textarea name="description" id="description" class="form-control"><?php echo (set_value('description')) ? set_value('description') : $description; ?></textarea>
                            <span class="validationError"><?php echo form_error('description'); ?></span>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label>Application Type</label>
                                <?php $courseTypeOpt = array('' => 'Choose', 'Teaching' => 'Teaching', 'Non-Teaching' => 'Non-Teaching', 'Librarian' => 'Librarian');
                                echo form_dropdown('type', $courseTypeOpt, '0', 'class="form-control" id="type"'); ?>
                                <span class="validationError"><?php echo form_error('type'); ?></span>
                            </div>
                            <div class="col-sm-4">
                                <label>Academic Year</label>
                                <?php
                                $ayList = array(" " => "- Select -", "2023-24" => "2023-24", "2024-25" => "2024-25", "2025-26" => "2025-26");
                                echo form_dropdown('ay', $ayList, set_value('ay', ''), 'class="form-control"');
                                ?>
                                <span class="validationError"><?php echo form_error('ay'); ?></span>
                            </div>
                            <div class="col-sm-4">
                                <label>Application Fee</label>
                                <input type="text" name="fee" id="fee" class="form-control" value="<?php echo (set_value('fee')) ? set_value('fee') : $fee; ?>">
                                <span class="validationError"><?php echo form_error('fee'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">

                            <?= form_label('Departments:', 'departments[]') ?>
                            <select name="departments[]" class="form-control" multiple="multiple">
                                <?php 
                                foreach($departments_list as $dep)
                                {
                                    ?>
                                <option value="<?=$dep->id;?>"><?=$dep->department_name;?></option>
                                <?php }?>
                            </select>
                            <span class="validationError"><?php echo form_error('departments'); ?></span>
                        </div>
                        <div class="form-group row">

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="status" value="1" name="status" <?php echo ($status) ? 'checked' : ''; ?>>
                                <label class="custom-control-label" for="status">is Active</label>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-danger" name="Update" id="Update"><i class="fas fa-edit"></i> Submit </button>
                                <?php echo anchor('main/jobposts', '<i class="fas fa-arrow-left fa-sm fa-fw"></i> Cancel', 'class="btn btn-info" '); ?>
                            </div>
                        </div>

                        <hr>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>