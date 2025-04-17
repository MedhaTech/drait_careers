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

                <?php $this->load->view('recruitment/template/side_header'); ?>

            </div>



        </div>
        <div class="col-md-9">




            <div class="card shadow mb-4 mt-2" id="personal">
                <div class="card-body">

                    <div class="widgetHead">
                        <span class="widgetTitle">Current Openings</span>

                    </div>

                    <div class="row">

                        <?php

                        if ($recruitmentList) {
                            foreach ($recruitmentList as $recruitmentList1) { ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="carer_wrappper">
                                        <div class="career-opening">
                                            <h3><a href="<?= base_url('recruitment/career'); ?>/<?= $recruitmentList1->slug; ?>"><?= $recruitmentList1->title; ?></a></h3>
                                            <div class="years-current"><i class="fa fa-briefcase" aria-hidden="true"></i> <?= $recruitmentList1->department_names; ?></div>
                                            <div class="place-current"><i class="fa fa-location-arrow" aria-hidden="true"></i> Bengaluru</div>
                                        </div>
                                        <div class="career-apply">
                                            <?php
                                            $user_id = $this->session->userdata('logged_in')['id'];
                                            $alreadyApplied = $this->admin_model->hasApplied($user_id, $recruitmentList1->id);
                                            ?>

                                            <div class="apply-now">
                                                <?php if ($alreadyApplied) { ?>
                                                    <button type="button" class="btn btn-secondary" disabled>Already Applied</button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applyModal" data-postid="<?= $recruitmentList1->id; ?>">
                                                        Apply Now
                                                    </button>
                                                <?php } ?>
                                            </div>
                                            <div class="read-more"><a href="<?= base_url('recruitment/career'); ?>/<?= $recruitmentList1->slug; ?>" class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <h3 class="">No Openings</h3>
                        <?php } ?>

                    </div>
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
                                            <h3><a href="<?= base_url('recruitment/career'); ?>/<?= $recruitmentList1->slug; ?>"><?= $recruitmentList1->title; ?></a></h3>

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
            <form method="post" action="<?= base_url('recruitment/preview'); ?>">
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
                            <select class="form-control" name="department" id="departmentSelect" required>
                                <option value="">Loading...</option>
                            </select>
                        </div>
                        <!-- Additional Information -->
                        <div class="mb-3">
                            <label for="additional_info" class="form-label">Any additional information you wish to state?</label>
                            <textarea class="form-control" name="additional_info" id="additional_info" rows="3" placeholder="Write here..."></textarea>
                        </div>

                        <!-- In-service Personnel Note -->
                        <div class="mb-3">
                            <label for="in_service_note" class="form-label">In-service personnel shall forward the application through the organization. However, send the advance copy of the application.</label>
                            <textarea class="form-control" name="in_service_note" id="in_service_note" rows="3" placeholder="Write here..."></textarea>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Proceed</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            console.log($().jquery); // Confirm jQuery loaded

            $('#applyModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var postId = button.data('postid');
                $('#modalPostId').val(postId);

                // Fetch departments via AJAX
                $.ajax({
                    url: "<?= base_url('recruitment/getdepartment'); ?>",
                    type: "POST",
                    data: {
                        id: postId
                    },
                    beforeSend: function() {
                        $('#departmentSelect').html('<option>Loading...</option>');
                    },
                    success: function(response) {
                        $('#departmentSelect').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching departments: ", error);
                        $('#departmentSelect').html('<option>Error loading departments</option>');
                    }
                });
            });
        });
    </script>