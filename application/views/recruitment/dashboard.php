<style>
    .profile-pic {
        border-radius: 50%;
        border: 3px solid #cfcfcf;
        height: 180px;
        width: 180px;
        /* margin-left: 30px; */
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

                <?php echo form_open_multipart('ajax-image-upload/post', array('class' => 'text-center mt-3')); ?>
                <label for="image" class="text-center">

                    <?php if ($details->profile_pic == '') { ?>
                        <div class="profile-pic" style="background-image: url('https://placehold.co/160x160')">
                        <?php } else { ?>
                            <div class="profile-pic"
                                style="background-image: url('<?= base_url(); ?>uploads/profile/<?= $details->profile_pic; ?>')">
                            <?php } ?>
                            <span class="glyphicon glyphicon-camera"></span>
                            <span>Change Image</span>
                        </div>
                </label>
                <input type="File" name="image" id="image" accept="image/png, image/gif, image/jpeg"
                    onchange="form.submit()">
                </form>
                <label class="text-center small text-secondary">Only JPG and PNG files are allowed.</label>

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
                                            <h3><a
                                                    href="<?= base_url('recruitment/career'); ?>/<?= $recruitmentList1->slug; ?>"><?= $recruitmentList1->title; ?></a>
                                            </h3>
                                            <!-- <div class="years-current"><i class="fa fa-briefcase" aria-hidden="true"></i> <?= $recruitmentList1->department_names; ?></div>
                                            <div class="place-current"><i class="fa fa-location-arrow" aria-hidden="true"></i> Bengaluru</div> -->
                                        </div>
                                        <div class="career-apply">
                                            <?php
                                            $user_id = $this->session->userdata('logged_in')['id'];
                                            $alreadyApplied = $this->admin_model->hasApplied($user_id, $recruitmentList1->id);
                                            ?>

                                            <div class="apply-now">
                                                <?php if ($alreadyApplied) { ?>
                                                    <button type="button" class="btn btn-secondary" disabled>Already
                                                        Applied</button>
                                                <?php } elseif ($details->menu_flag >= 3) { ?>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#applyModal" data-postid="<?= $recruitmentList1->id; ?>">
                                                        Apply
                                                    </button>
                                                <?php }else { ?>
                                                      <button type="button" class="btn btn-primary" disabled data-toggle="tooltip" data-placement="top" title="Fill basic details before applying">
                                                        Apply
                                                    </button>
                                                <?php }?>
                                            </div>
                                            <div class="read-more"><a
                                                    href="<?= base_url('recruitment/career'); ?>/<?= $recruitmentList1->slug; ?>"
                                                    class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <h3 class="">No Openings</h3>
                        <?php } ?>

                    </div>

                    <?php if ($appliedList) { ?>
                        <div class="widgetHead">
                            <span class="widgetTitle">Applied Posts</span>
                        </div>

                        <div class="row">
                            <?php

                            foreach ($appliedList as $recruitmentList1) { ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                                    <div class="carer_wrappper">
                                        <div class="career-opening">
                                            <h3><a
                                                    href="<?= base_url('recruitment/career'); ?>/<?= $recruitmentList1->slug; ?>"><?= $recruitmentList1->title; ?></a>
                                            </h3>

                                            <div class="place-current"><i class="fa fa-location-arrow" aria-hidden="true"></i>
                                                Applied on <?= date('F j, Y', strtotime($recruitmentList1->applied_on)); ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php }
                            ?>

                        </div>
                    <?php } ?>

                    <div class="widgetHead">
                        <span class="widgetTitle text-danger">Steps to Submit Application</span>
                    </div>
                    <div class="row">
                        <ul>
                            <li><strong>Login to the Portal:</strong> Use your registered email ID and password to log
                                in.</li>
                            <li><strong>Complete Your Profile:</strong> Go to the Profile section. Fill in all the
                                required personal, educational, and professional details. Upload necessary documents and
                                save the profile.</li>
                            <li><strong>Click on ‘Apply’ Button:</strong> Click on Dashboard from the main menu after completing
                            your profile. or Locate the ‘Apply’ button at the bottom of Profile screen.</li>
                            <li><strong>Select the Post:</strong> Choose the post you want to apply for from the
                                available list. </li>
                            <li><strong>Choose Department and Designation:</strong> Select the appropriate department
                                and designation related to the post.</li>
                            <li><strong>Review and Submit:</strong> Double-check all selected options and information.
                                Click on ‘Submit Application’ to complete the process.</li>
                            <li><strong>Confirmation:</strong> After submission, you will receive an application
                                confirmation message. You can track your application status from the Dashboard.</li>
                        </ul>
                        If you face any issues, please contact our support team.
                    </div>
                </div>

            </div>
        </div>


    </div>
    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel"
        aria-hidden="true">
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
                            <label for="department" class="form-label">Choose Department</label>
                            <select class="form-control" name="department" id="departmentSelect" required>
                                <option value="">Loading...</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="designation" class="form-label">Select Applying Position</label>
                            <select class="form-control" name="designation" id="designationSelect" required>
                              
                                 <?php  if ($details->post_of == "Teaching") { echo $this->admin_model->get_designation_options('teaching', set_value('designation')); }?>
                                   <?php  if ($details->post_of == "Non-Teaching") { echo $this->admin_model->get_designation_options('non-teaching', set_value('designation')); }?>
                            </select>
                        </div>
                        <!-- Additional Information -->
                        <div class="mb-3">
                            <label for="additional_info" class="form-label">Any additional information you wish to
                                state?</label>
                            <textarea class="form-control" name="additional_info" id="additional_info" rows="3"
                                placeholder="Write here..." required></textarea>
                        </div>

                        <!-- In-service Personnel Note -->
                        <div class="mb-3">
                            <label for="in_service_note" class="form-label">In-service personnel shall forward the
                                application through the organization. However, send the advance copy of the
                                application.</label>
                            <textarea class="form-control" required name="in_service_note" id="in_service_note" rows="3"
                                placeholder="Write here..."></textarea>
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
        $(document).ready(function () {
            console.log($().jquery); // Confirm jQuery loaded

            $('#applyModal').on('show.bs.modal', function (event) {
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
                    beforeSend: function () {
                        $('#departmentSelect').html('<option>Loading...</option>');
                    },
                    success: function (response) {
                        $('#departmentSelect').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching departments: ", error);
                        $('#departmentSelect').html('<option>Error loading departments</option>');
                    }
                });
            });
        });
    </script>