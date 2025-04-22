<!-- Career Openings Section -->
<section class="career-current-opening">
    <div class="container">
        <h2 class="">CURRENT OPENINGS</h2>
        <p class="current text-secondary">Applicants interested in faculty positions are requested to update their profiles using the prescribed proforma, along with all relevant supporting documents.
            Submitted applications will be duly scrutinized and considered as and when suitable positions become available throughout the year.
            </h>
        <div class="row justify-content-center">

            <?php

            if ($recruitmentList) {
                foreach ($recruitmentList as $recruitmentList1) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="carer_wrappper card shadow">
                            <div class="career-opening">
                                <h3><a href="<?= base_url('recruitment'); ?>"><?= $recruitmentList1->title; ?></a></h3>
                                <!-- <div class="years-current"><i class="fa fa-book" aria-hidden="true"></i>
                                    <?= $recruitmentList1->department_names; ?></div>
                                <div class="place-current"><i class="fa fa-university" aria-hidden="true"></i> Dr.AIT
                                </div> -->
                            </div>
                            <div class="career-apply">
                                <div class="apply-now"><a target="_blank" href="<?= base_url('recruitment'); ?>">Apply Now</a>
                                </div>
                                <div class="read-more"><a
                                        href="<?= base_url('career-detail'); ?>/<?= $recruitmentList1->slug; ?>"><i
                                            class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <h3 class="">No Openings</h3>
            <?php } ?>

        </div>
        <h2 class="">INTERNAL - CAREER ADVANCEMENT SCHEME</h2>
        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="carer_wrappper card shadow">
                    <div class="career-opening">
                        <h3 class="mb-3">
                            Application Form for Academic Grade Pay (AGP) Upgradation
                        </h3>
                        <p><strong>(AGP from Rs.6000 to Rs.7000)</strong></p>
                        <div class="qualification-details mt-3">
                            <h5>Eligibility for Assistant Professors(CAS)</h5>
                            <ul>
                                <li>Should possess M. Tech Degree / Ph. D degree is preferable.</li>
                                <li>Should have completed 5 years of teaching experience in the AGP of Rs. 6000/-.</li>
                                <li>Should have completed Faculty Development Program (AICTE approved) of 06 weeks.</li>
                                <li>All CAS applications submitted, along with the proforma and all supporting
                                    documents, will be reviewed biannually - in the months of June and December.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="career-apply mt-4">
                        <div class="apply-now apply-now-new">
                            <a target="_blank"
                                href="<?= base_url(''); ?>/assets/internal/SelfAppraisalDrAIT2024final.docx">
                                <i class="fa fa-download"></i> Download Application Form
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="carer_wrappper card shadow">
                    <div class="career-opening">
                        <h3 class="mb-3">Application Form for Academic Grade Pay (AGP) Upgradation </h3>
                        <p><strong>(AGP from Rs.7000 to Rs.8000)</strong></p>
                        <div class="qualification-details mt-3">
                            <h5>Eligibility for Assistant Professors(CAS)</h5>
                            <ul>
                                <li>Should possess M.Tech Degree / Ph.D degree is preferable.</li>
                                <li>Should have completed 5 years of teaching experience in the AGP of Rs. 7000/-.</li>
                                <li>Should have registered for Ph.D degree.</li>
                                <li>Should have completed Faculty Development Program (AICTE approved) of 06 weeks.</li>
                                <li>All CAS applications submitted, along with the proforma and all supporting
                                    documents, will be reviewed biannually - in the months of June and December.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="career-apply mt-4">
                        <div class="apply-now apply-now-new">
                            <a target="_blank"
                                href="<?= base_url(''); ?>/assets/internal/SelfAppraisalDrAIT2024final.docx">
                                <i class="fa fa-download"></i> Download Application Form
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="carer_wrappper card shadow">
                    <div class="career-opening">
                        <h3 class="mb-3">Application Form for Academic Grade Pay (AGP) Upgradation </h3>
                        <p><strong>(AGP from Rs.8000 to Rs.9000)</strong></p>
                        <div class="qualification-details mt-3">
                            <h5>Eligibility for Assistant Professors(CAS)</h5>
                            <ul>
                                <li>Should possess B.E, M. Tech Degree with first class and Ph. D degree.
                                </li>
                                <li>Minimum 13 years of experience in academic/research/industry, of which 3 years should be as an Assistant Professor with AGP Rs.8000/- 
                                </li>
                                <li>Should have post Ph. D degree experience of 2 years.
                                </li>
                                <li>Should have completed Faculty Development Program (AICTE approved) as per norms.
                                </li>
                                <li> <b>Desirable:</b><br>
                                 Should have successfully guided 01 Ph. D student.
                                 <br> OR
                                </li>
                                <li>Should have at least 04 publications in SCI-Indexed Journals and 02 in Web of Science/ Scopus-Indexed Journals.
                                </li>
                                <li> Should have involvement in terms of Research and Development (R&D), patent filing, consultancy services, development of e-content, establishment or contribution to Centre of Excellence (CoEs), and/or recognition through prestigious national awards.
                                </li>
                                <li>All CAS applications submitted, along with the proforma and all supporting documents, will be reviewed biannually—in the months of June and December.</li>
                               
                            </ul>
                        </div>
                    </div>

                    <div class="career-apply mt-4">
                        <div class="apply-now apply-now-new">
                            <a target="_blank"
                                href="<?= base_url(''); ?>/assets/internal/SelfAppraisalDrAIT2024final.docx">
                                <i class="fa fa-download"></i> Download Application Form
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="carer_wrappper card shadow">
                    <div class="career-opening">
                        <h3 class="mb-3">Application Form for Academic Grade Pay (AGP) Upgradation </h3>
                        <p><strong>(AGP from Rs.9000 to Rs.10000)</strong></p>
                        <div class="qualification-details mt-3">
                            <h5>Eligibility for Assistant Professors(CAS)</h5>
                            <ul>
                                <li>Should possess B.E, M. Tech Degree with first class and Ph. D degree.
                                </li>
                                <li>Minimum 16 years of experience in academic/research/industry, of which 3 years should be as an Assistant Professor with AGP Rs.9000/- 
                                </li>
                                <li>Should have post Ph. D degree experience of 5 years.
                                </li>
                                <li>Should have completed Faculty Development Program (AICTE approved) as per norms.
                                </li>
                                <li> <b>Desirable:</b><br>
                                 Should have successfully guided 02 Ph. D student.
                                 <br> OR
                                </li>
                                <li>Should have at least 04 publications in SCI-Indexed Journals and 04 in Web of Science/ Scopus-Indexed Journals.
                                </li>
                                <li> Should have involvement in terms of Research and Development (R&D), patent filing, consultancy services, development of e-content, establishment or contribution to Centre of Excellence (CoEs), and/or recognition through prestigious national awards.
                                </li>
                                <li>All CAS applications submitted, along with the proforma and all supporting documents, will be reviewed biannually—in the months of June and December.</li>
                               
                            </ul>
                        </div>
                    </div>

                    <div class="career-apply mt-4">
                        <div class="apply-now apply-now-new">
                            <a target="_blank"
                                href="<?= base_url(''); ?>/assets/internal/SelfAppraisalDrAIT2024final.docx">
                                <i class="fa fa-download"></i> Download Application Form
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</section>