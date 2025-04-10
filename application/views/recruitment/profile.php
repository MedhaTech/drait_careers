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
                            <input type="hidden" name="pro-pic" class="pro-pic" id="pro-pic" value="<?= $details->profile_pic; ?>">
                            <span class="glyphicon glyphicon-camera"></span>
                            <span>Change Image</span>
                            </div>
                </label>
                <input type="File" name="image" id="image" accept="image/png, image/gif, image/jpeg" onchange="form.submit()">
                </form>
                <label style="margin-left: 15px; font-size: 12px;">Only JPG and PNG files are allowed.</label>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <?php echo anchor('recruitment/profile#personal', 'Personal Details'); ?>
                    </li>

                    <li class="list-group-item">
                        <?php
                        if ($details->menu_flag >= 1)
                            echo anchor('recruitment/profile#language', 'Languages Known');
                        else
                            echo anchor('recruitment/profile#language', 'Languages Known', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        if ($details->menu_flag >= 2)
                            echo anchor('recruitment/profile#education', 'Educational Qualification');
                        else
                            echo anchor('recruitment/profile#education', 'Educational Qualification', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        if ($details->menu_flag >= 3)
                            echo anchor('recruitment/profile#research', 'Research Experience');
                        else
                            echo anchor('recruitment/profile#research', 'Research Experience', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">

                        <?php

                        if ($details->menu_flag >= 4)
                            echo anchor('recruitment/profile#publications', 'Publications');
                        else
                            echo anchor('recruitment/profile#publications', 'Publications', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        if ($details->menu_flag >= 5)
                            echo anchor('recruitment/profile#teaching', 'Teaching Experience');
                        else
                            echo anchor('recruitment/profile#teaching', 'Teaching Experience', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        if ($details->menu_flag >= 6)
                            echo anchor('recruitment/profile#industrial', 'Industrial Experience');
                        else
                            echo anchor('recruitment/profile#industrial', 'Industrial Experience', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        if ($details->menu_flag >= 7)
                            echo anchor('recruitment/profile#affiliations', 'Affiliations');
                        else
                            echo anchor('recruitment/profile#affiliations', 'Affiliations', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        if ($details->menu_flag >= 7)
                            echo anchor('recruitment/profile#Projects', 'Projects');
                        else
                            echo anchor('recruitment/profile#Projects', 'Projects', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        if ($details->menu_flag >= 7)
                            echo anchor('recruitment/profile#Consultancy', 'Consultancy');
                        else
                            echo anchor('recruitment/profile#Consultancy', 'Consultancy', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        if ($details->menu_flag >= 7)
                            echo anchor('recruitment/profile#Seminars', 'Seminars');
                        else
                            echo anchor('recruitment/profile#Seminars', 'Seminars', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        if ($details->menu_flag >= 7)
                            echo anchor('recruitment/profile#Membership', 'Professional Membership');
                        else
                            echo anchor('recruitment/profile#Membership', 'Professional Membership', 'class="btn disabled"');
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php

                        echo anchor('recruitment/profile#references', 'References');

                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php

                        echo anchor('recruitment/profile#documents', 'Documents');

                        ?>
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
            if ($details->menu_flag >= 7)
                echo anchor('recruitment/preview', 'Proceed for Payment and Submit', 'class="btn btn-block btn-danger btn-square btn-sm payment-submit"', 'id="payment-submit');
            else
                echo anchor('recruitment/preview', 'Proceed for Payment and Submit', 'class="btn btn-block btn-danger btn-square btn-sm disabled" ');
            ?>

        </div>
        <div class="col-md-9">


            <div class="card shadow mb-4 mt-2" id="personal">
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Candiddate Name</label>
                                <h6><?php echo $details->candidate_name; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Email Address</label>
                                <h6><?php echo $details->email; ?></h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">For the Post of: </label>
                                <h6><?php echo $details->post_of; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Department Name</label>
                                <h6><?php echo $details->department; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4 mt-2" id="personal">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Personal Details</span>
                        <span tabindex="0" class="add no-outline">
                            <?php echo anchor('recruitment/updatePersonal', '<i class="fas fa-pencil-alt"></i> Manage Personal Details', 'class="font-weight-bold mx-2"'); ?>

                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Mobile No</label>
                                <h6><?php echo $details->mobile; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Date of Birth</label>
                                <h6><?php echo $details->date_of_birth; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Place of Birth</label>
                                <h6><?php echo $details->place_of_birth; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Religion & Caste</label>
                                <h6><?php echo $details->religion; ?></h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Father's Name </label>
                                <h6><?php echo $details->father_name; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Father's Occupation</label>
                                <h6><?php echo $details->father_occupation; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Address for Correspondence</label>
                                <h6><?php echo $details->address; ?></h6>
                            </div>
                            <div class="form-group">
                                <label for="name" class="p my-0 tx-14 text-gray-600">Reservation Category</label>
                                <h6><?php echo $details->reservation_category; ?></h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card shadow my-4" id="language">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Languages Known</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 1)
                                echo anchor('recruitment/manageLanguages', '<i class="fas fa-pencil-alt"></i> Manage Languages', 'class="font-weight-bold "');
                            else
                                echo anchor('recruitment/manageLanguages', '<i class="fas fa-pencil-alt"></i> Manage Languages', 'class="font-weight-bold btn disabled"');
                            ?>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table tx-14 text-dark">
                                <thead>
                                    <tr>
                                        <th>Language</th>
                                        <th>Read</th>
                                        <th>Write</th>
                                        <th>Speak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($langs as $details1) {

                                        if ($details1->reading == 1) {
                                            $read = "Yes";
                                        } else {
                                            $read = "No";
                                        }
                                        if ($details1->writ == 1) {
                                            $writ = "Yes";
                                        } else {
                                            $writ = "No";
                                        }
                                        if ($details1->speak == 1) {
                                            $speak = "Yes";
                                        } else {
                                            $speak = "No";
                                        }
                                        echo '<tr>';
                                        echo '<td>' . $details1->name . '</td>';
                                        echo '<td>' . $read . '</td>';
                                        echo '<td>' . $writ . '</td>';
                                        echo '<td>' . $speak . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow my-4" id="education">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Education</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 2)
                                echo anchor('recruitment/manageEducation', '<i class="fas fa-pencil-alt"></i> Manage Education', 'class="font-weight-bold"');
                            else
                                echo anchor('recruitment/manageEducation', '<i class="fas fa-pencil-alt"></i> Manage Education', 'class="font-weight-bold btn disabled"');
                            ?>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $education = array_reverse($education);
                            if ($education) {
                                foreach ($education as $education1) {
                                    $specialization = ($education1->specialization) ? ' - ' . $education1->specialization : null;
                            ?>
                                    <div class="media d-block d-sm-flex mb-4">
                                        <div class="wd-60 ht-60 bg-gray-200 rounded font-weight-bold d-flex align-items-center justify-content-center">
                                            <?= $education1->program; ?>
                                        </div>
                                        <div class="media-body pl-3">
                                            <h6 class="mb-0 font-weight-bold"><?= $education1->degree . $specialization; ?></h6>
                                            <p class="my-0"><?= $education1->university_name; ?></p>
                                            <span class="my-0 tx-13">
                                                <?php echo $education1->program_type . ' <span class="dot"></span> ' . date('M Y', strtotime($education1->year_of_passing)) . ' <span class="dot"></span> Marks : ' . $education1->marks_percentage . '% <span class="dot"></span> Class Awarded : ' . $education1->class_awarded; ?>
                                            </span>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "<h6 class='text-center tx-color-03'> Education details not added.</h6>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow my-4" id="research">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Research Experience</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 3)
                                echo anchor('recruitment/manageResearch', '<i class="fas fa-pencil-alt"></i> Manage Research', 'class="font-weight-bold"');
                            else
                                echo anchor('recruitment/manageResearch', '<i class="fas fa-pencil-alt"></i> Manage Research', 'class="font-weight-bold btn disabled"'); ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                            <tr>
                                <th>Institution / University Name</th>
                                <th>Area of Research</th>
                                <th>Period From & To</th>
                                <th>Total Exp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($research as $research1) {
                                echo '<tr>';
                                echo '<td>' . $research1->institution . '</td>';
                                echo '<td>' . $research1->area_of_research . '</td>';
                                echo '<td>' . date('M Y', strtotime($research1->exp_from)) . ' - ' . date('M Y', strtotime($research1->exp_to)) . '</td>';
                                echo '<td>' . $research1->total . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow my-4" id="publications">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Publications</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 4)
                                echo anchor('recruitment/managePublications', '<i class="fas fa-pencil-alt"></i> Manage Publications', 'class="font-weight-bold"');
                            else
                                echo anchor('recruitment/managePublications', '<i class="fas fa-pencil-alt"></i> Manage Publications', 'class="font-weight-bold btn disabled"'); ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                            <tr>
                                <th width='40%'>Title of the Paper</th>
                                <th width='20%'>National / International</th>
                                <th width='20%'>Year and Month of Publication</th>
                                <th width='20%'>Conference / Journal / Book</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($publications as $publications1) {
                                echo '<tr>';
                                echo '<td>' . $publications1->title_of_paper . '</td>';
                                echo '<td>' . $publications1->publication_type . '</td>';
                                echo '<td>' . date('M Y', strtotime($publications1->publication_date)) . '</td>';
                                echo '<td>' . $publications1->category . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow my-4" id="teaching">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Teaching Experience</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 5)
                                echo anchor('recruitment/manageTeaching', '<i class="fas fa-pencil-alt"></i> Manage Teaching', 'class="font-weight-bold"');
                            else
                                echo anchor('recruitment/manageTeaching', '<i class="fas fa-pencil-alt"></i> Manage Teaching', 'class="font-weight-bold btn disabled"'); ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                            <tr>
                                <th width='40%'>Name of the University / Institution</th>
                                <th width='20%'>Designation</th>
                                <th width='20%'>Exp. From & To</th>
                                <th width='20%'>Total Exp.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($teaching as $teaching1) {

                                $date1 = strtotime($teaching1->period_from);
                                $date2 = strtotime($teaching1->period_to);

                                $diff = abs($date2 - $date1);

                                $years = floor($diff / (365 * 60 * 60 * 24));

                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));

                                // $exp = ("%d years, %d months", $years, $months);


                                echo '<tr>';
                                echo '<td>' . $teaching1->institution . '</td>';
                                echo '<td>' . $teaching1->designation . '</td>';
                                echo '<td>' . date('M Y', strtotime($teaching1->period_from)) . ' - ' . date('M Y', strtotime($teaching1->period_to)) . '</td>';
                                echo '<td>' . $years . ' years, ' . $months . ' months' . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow my-4" id="industrial">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Industrial Experience</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 6)
                                echo anchor('recruitment/manageIndustrial', '<i class="fas fa-pencil-alt"></i> Manage Industrial', 'class="font-weight-bold"');
                            else
                                echo anchor('recruitment/manageIndustrial', '<i class="fas fa-pencil-alt"></i> Manage Industrial', 'class="font-weight-bold btn disabled"'); ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                            <tr>
                                <th width='40%'>Name of the Organization</th>
                                <th width='20%'>Position Held</th>
                                <th width='20%'>Exp. From & To</th>
                                <th width='20%'>Total Exp.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($industrial as $industrial1) {

                                $date1 = strtotime($industrial1->period_from);
                                $date2 = strtotime($industrial1->period_to);

                                $diff = abs($date2 - $date1);

                                $years = floor($diff / (365 * 60 * 60 * 24));

                                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));

                                // $exp = ("%d years, %d months", $years, $months);


                                echo '<tr>';
                                echo '<td>' . $industrial1->organization . '</td>';
                                echo '<td>' . $industrial1->position_held . '</td>';
                                echo '<td>' . date('M Y', strtotime($industrial1->period_from)) . ' - ' . date('M Y', strtotime($industrial1->period_to)) . '</td>';
                                echo '<td>' . $years . ' years, ' . $months . ' months' . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow my-4" id="affiliations">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Affiliations</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 7)
                                echo anchor('recruitment/manageAffiliations', '<i class="fas fa-pencil-alt"></i> Manage Affiliations', 'class="font-weight-bold"');
                            else
                                echo anchor('recruitment/manageAffiliations', '<i class="fas fa-pencil-alt"></i> Manage Affiliations', 'class="font-weight-bold btn disabled"'); ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                            <tr>
                                <th width='40%'>Name of the Professional Body </th>
                                <th width='20%'>Grade of Membership</th>
                                <th width='20%'>Number of Membership</th>
                                <th width='20%'>Year of Selection</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($affiliations as $affiliations1) {
                                echo '<tr>';
                                echo '<td>' . $affiliations1->name . '</td>';
                                echo '<td>' . $affiliations1->grade . '</td>';
                                echo '<td>' . $affiliations1->number . '</td>';
                                echo '<td>' . $affiliations1->year . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card shadow my-4" id="Projects">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Projects</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 7)
                                echo anchor('recruitment/manageProjects', '<i class="fas fa-pencil-alt"></i> Manage Projects', 'class="font-weight-bold"');
                            else
                                echo anchor('recruitment/manageProjects', '<i class="fas fa-pencil-alt"></i> Manage Projects', 'class="font-weight-bold btn disabled"'); ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark">
                        <thead>
                            <tr>
                                <th>Sponsoring Agency</th>
                                <th>Title of Project</th>
                                <th>Amount of Grant</th>
                                <th>Period</th>
                                <th>Co-investigators</th>

                            </tr>
                        </thead>
                        <?php foreach ($projects as $details1) { ?>
                            <tr>
                                <td><?= $details1->sponsoring_agency ?></td>
                                <td><?= $details1->title_of_project ?></td>
                                <td><?= $details1->amount_of_grant ?></td>
                                <td><?= $details1->period ?></td>
                                <td><?= $details1->co_investigators ?></td>

                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="card shadow my-4" id="Consultancy">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Consultancy Undertaken</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 7)
                                echo anchor('recruitment/manageConsultancies', '<i class="fas fa-pencil-alt"></i> Manage Consultancy', 'class="font-weight-bold"');
                            else
                                echo anchor('recruitment/manageConsultancies', '<i class="fas fa-pencil-alt"></i> Manage Consultancy', 'class="font-weight-bold btn disabled"'); ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark">
                        <thead>
                            <tr>
                                <th>Organization</th>
                                <th>Title of Project</th>
                                <th>Amount of Grant</th>
                                <th>Period</th>
                                <th>Co-investigators</th>

                            </tr>
                        </thead>
                        <?php foreach ($consultancy as $details1) { ?>
                            <tr>
                                <td><?= $details1->organization ?></td>
                                <td><?= $details1->title_of_project ?></td>
                                <td><?= $details1->amount_of_grant ?></td>
                                <td><?= $details1->period ?></td>
                                <td><?= $details1->co_investigators ?></td>

                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="card shadow my-4" id="Seminars">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Seminars / Workshop / Short-term Course</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 7)
                                echo anchor('recruitment/manageSeminarsWorkshopsCourses', '<i class="fas fa-pencil-alt"></i> Manage Seminars ', 'class="font-weight-bold"');
                            else
                                echo anchor('recruitment/manageSeminarsWorkshopsCourses', '<i class="fas fa-pencil-alt"></i> Manage Seminars ', 'class="font-weight-bold btn disabled"'); ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark">
                        <thead>
                            <tr>
                                <th>Title of Seminar/Workshop/Course</th>
                                <th>Organised/Conducted By</th>

                            </tr>
                        </thead>
                        <?php foreach ($seminars as $details1) { ?>
                            <tr>
                                <td><?= $details1->title_of_project ?></td>
                                <td><?= $details1->organised_conducted ?></td>

                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>

            <div class="card shadow my-4" id="Membership">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Professional Membership</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                            if ($details->menu_flag >= 7)
                                echo anchor('recruitment/manageProfessionalMemberships', '<i class="fas fa-pencil-alt"></i> Manage Professional Membership', 'class="font-weight-bold"');
                            else
                                echo anchor('recruitment/manageProfessionalMemberships', '<i class="fas fa-pencil-alt"></i> Manage Professional Membership', 'class="font-weight-bold btn disabled"'); ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark">
                        <thead>
                            <tr>
                                <th>Professional Organization</th>
                                <th>Year of Selection</th>
                                <th>Grade of Membership</th>

                            </tr>
                        </thead>
                        <?php foreach ($membership as $details1) { ?>
                            <tr>
                                <td><?= $details1->professional_organization ?></td>
                                <td><?= $details1->year_of_selection ?></td>
                                <td><?= $details1->grade_of_membership ?></td>

                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>

            <div class="card shadow my-4" id="references">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">References</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
               
                                echo anchor('recruitment/manageReferences', '<i class="fas fa-pencil-alt"></i> Manage References', 'class="font-weight-bold"');
                           ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                            <tr>
                                <th width='20%'>Name </th>
                                <th width='20%'>Occupation or Position</th>
                                <th width='20%'>Address for Communication with Contact Number</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($references as $references1) {
                                echo '<tr>';
                                echo '<td>' . $references1->name . '</td>';
                                echo '<td>' . $references1->position . '</td>';
                                echo '<td>' . $references1->number . '</td>';

                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow my-4" id="documents">
                <div class="card-body">
                    <div class="widgetHead">
                        <span class="widgetTitle">Documents</span>
                        <span tabindex="0" class="add no-outline">
                            <?php
                          
                                echo anchor('recruitment/manageDocuments', '<i class="fas fa-pencil-alt"></i> Manage Documents', 'class="font-weight-bold"');
                          ?>
                        </span>
                    </div>
                    <table class="table table-hover text-dark tx-14">
                        <thead>
                            <tr>
                                <th width='30%'>Title of the document</th>
                                <th width='15%'>Document</th>


                            </tr>
                        </thead>
                        <?php
                        foreach ($documents as $details1) {
                            $file_type = $this->admin_model->get_doc_name($details1->type);

                            echo '<tr>';
                            echo '<td>' . $file_type->name . '</td>';
                            echo '<td>' . $details1->file . '</td>';


                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>

        </div>
    </div>


</div>
<script>
    $('.payment-submit').on('click', function() {
        var pic = $('#pro-pic').val();
        if (pic == '') {
            alert("Please upload your passport size photo.");
            event.preventDefault();
        }


    });
</script>