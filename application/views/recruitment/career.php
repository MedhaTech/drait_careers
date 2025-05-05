<style>
    .profile-pic {
        border-radius: 50%;
        border: 3px solid #cfcfcf;
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


            <?php echo form_open_multipart('ajax-image-upload/post', array('class' => 'text-center mt-3')); ?>
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

                  

                    <div class="row">
                        <article class="card p-4">
                            <h2 class=""><?= $post->title; ?></h2>
                            <p class="text-muted">
                                <small>
                                    Posted by <strong>Admin</strong> on <?= date('F j, Y', strtotime($post->updated_on)); ?>
                                </small>
                            </p>
                            <hr>
                            <div class="blog-content">
                                <!-- Job Description -->
                                <p><?= $post->description; ?></p>

                                <!-- Departments -->
                                <h5>Departments</h5>
                                <p><?= $this->admin_model->getdeptpost($post->departments); ?></p>

                                
                            </div>
                        </article>
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
                            <select class="form-control" name="department" id="departmentSelect" required>
                                <option value="">Loading...</option>
                            </select>
                        </div>
                        <!-- Terms Agreement Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="agree_terms" value="1" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">
                                I, hereby declare that the above information provided is true to the best of my knowledge and belief.
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