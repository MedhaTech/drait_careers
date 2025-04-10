<style>
    .profile-pic {
        border-radius: 50%;
        height: 180px;
        width: 180px;
        margin-left: 30px;
        background-size: cover;
        background-position: center;
        background-blend-mode: multiply;
        vertical-align: middle;
        text-align: center;
        color: transparent;
        transition: all .3s ease;
        text-decoration: none;
        cursor: pointer;
    }

    .profile-pic:hover {
        background-color: rgba(0, 0, 0, .5);
        z-index: 10000;
        color: #fff;
        transition: all .3s ease;
        text-decoration: none;
    }

    .profile-pic span {
        display: inline-block;
        padding-top: 4.5em;
        padding-bottom: 4.5em;
    }

    form input[type="file"] {
        display: none;
        cursor: pointer;
    }
</style>

<div class="container">

    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert <?= $this->session->flashdata('status'); ?>" id="msg">
            <?php echo $this->session->flashdata('message') ?>
        </div>
    <?php } ?>

    <div class="row mb-5">
        <div class="col-md-3">

            <div class="card shadow my-2">


                <?php echo form_open_multipart('ajax-image-upload/post'); ?>
                <label for="image">

                    <?php if ($details->profile_pic == '') { ?>
                        <div class="profile-pic" style="background-image: url('https://placehold.co/160x160')">
                        <?php } else { ?>
                            <div class="profile-pic" style="background-image: url('<?= base_url(); ?>uploads/profile/<?= $details->profile_pic; ?>')">
                            <?php } ?>
                            <span class="glyphicon glyphicon-camera"></span>
                            <span>Change Image</span>
                            </div>
                </label>
                <input type="File" name="image" id="image" accept="image/png, image/gif, image/jpeg" onchange="form.submit()">
                </form>
                <label style="
    margin-left: 15px;
    font-size: 12px;
">Only JPG and PNG files are allowed.</label>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <?php echo anchor('recruitment/dashboard', 'Dashboard'); ?>
                    </li>
                    <li class="list-group-item">
                        <?php echo anchor('recruitment/profile', 'My Profile'); ?>
                    </li>
                    <li class="list-group-item">
                        <?php echo anchor('recruitment/applied', 'Applied Jobs'); ?>
                    </li>

                    <li class="list-group-item">
                        <?php echo anchor('recruitment/changePassword', 'Change Password'); ?>
                    </li>
                    <li class="list-group-item">
                        <?php echo anchor('recruitment/logout', 'Logout'); ?>
                    </li>
                </ul>
                <!--<div class="card-body">-->
                <!--  <a href="#" class="card-link">Card link</a>-->
                <!--  <a href="#" class="card-link">Another link</a>-->
                <!--</div>-->
            </div>

            <?php
            if ($details->menu_flag >= 10)
                echo anchor('recruitment/preview', 'Proceed for Payment and Submit', 'class="btn btn-block btn-danger btn-square btn-sm"');
            else
                echo anchor('recruitment/preview', 'Proceed for Payment and Submit', 'class="btn btn-block btn-danger btn-square btn-sm disabled" ');
            ?>

        </div>
        <div class="col-md-9">




            <div class="card shadow mb-4 mt-2" id="personal">
                <div class="card-body">

                    <div class="widgetHead">
                        <span class="widgetTitle">Applied Posts</span>

                    </div>

                    <div class="row">

                        <?php

                        if ($appliedList) {
                            foreach ($appliedList as $recruitmentList1) { ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="carer_wrappper">
                                        <div class="career-opening">
                                            <h3><a href="<?= base_url('career-detail'); ?>/<?= $recruitmentList1->slug; ?>" target="_blank"><?= $recruitmentList1->title; ?></a></h3>
                                           
                                            <div class="place-current"><i class="fa fa-location-arrow" aria-hidden="true"></i> Applied on <?= date('F j, Y', strtotime($recruitmentList1->applied_on)); ?></div>
                                        </div>

                                    </div>
                                </div>
                            <?php }
                        }  ?>

                    </div>
                </div>


            </div>
        </div>


    </div>
    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="<?= base_url('recruitment/apply_job'); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyModalLabel">Apply for Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Hidden input for post_id -->
                        <input type="hidden" name="post_id" id="modalPostId">
                        <!-- Department Selection -->
                        <div class="mb-3">
                            <label for="department" class="form-label">Select Department</label>
                            <select class="form-control" name="department" required>
                                <option value="">Select</option>
                                <option value="1">HR</option>
                                <option value="2">Engineering</option>
                            </select>
                        </div>
                        <!-- Terms Agreement Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="agree_terms" value="1" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">
                                I agree to the terms and conditions.
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Apply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            console.log($().jquery); // Should print the jQuery version

            $('#applyModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var postId = button.data('postid'); // Extract post ID from data attribute
                $('#modalPostId').val(postId); // Insert into hidden input in modal
            });
        });
    </script>