

    <!-- Career Openings Section -->
    <section class="career-current-opening">
        <div class="container">
            <h2 class="">Current Openings</h2>
            <div class="row">

			<?php 
            
            if($recruitmentList) {
            foreach ($recruitmentList as $recruitmentList1) { ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="carer_wrappper">
                        <div class="career-opening">
                            <h3><a href="<?= base_url('recruitment');?>"><?= $recruitmentList1->title ;?></a></h3>
                            <div class="years-current"><i class="fa fa-briefcase" aria-hidden="true"></i>   <?= $recruitmentList1->department_names; ?></div>
                            <div class="place-current"><i class="fa fa-location-arrow" aria-hidden="true"></i> Bengaluru</div>
                        </div>
                        <div class="career-apply">
                            <div class="apply-now"><a target="_blank" href="<?= base_url('recruitment');?>">Apply Now</a></div>
                            <div class="read-more"><a href="<?= base_url('career-detail');?>/<?= $recruitmentList1->slug ;?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                        </div>
                    </div>
                </div>
<?php } } else {?>
    <h3 class="">No Openings</h3>
    <?php }?>

            </div>
            <h2 class="">INTERNAL - CAREER APPRAISAL SCHEME</h2>
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="carer_wrappper">
                        <div class="career-opening">
                            <h3><a href="<?= base_url('');?>/assets/internal/SelfAppraisalDrAIT2024final.docx">CAS<br> Application Form<br></a></h3>
                            <p>(AGP Rs 6000 to AGP 7000)</p>
                            
                        </div>
                        <div class="career-apply">
                            <div class="apply-now apply-now-new"><a target="_blank" href="<?= base_url('');?>/assets/internal/SelfAppraisalDrAIT2024final.docx">Download</a></div>
                            <div class="apply-now apply-now-new"><a target="_blank" href="<?= base_url('');?>/assets/internal/WebsiteCASApr2025.docx">Guidelines</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="carer_wrappper">
                        <div class="career-opening">
                            <h3><a href="<?= base_url('');?>/assets/internal/SelfAppraisalDrAIT2024final.docx">CAS<br> Application Form<br></a></h3>
                            <p>(AGP Rs 7000 to AGP 8000)</p>
                        </div>
                        <div class="career-apply">
                            <div class="apply-now apply-now-new"><a target="_blank" href="<?= base_url('');?>/assets/internal/SelfAppraisalDrAIT2024final.docx">Download</a></div>
                            <div class="apply-now apply-now-new"><a target="_blank" href="<?= base_url('');?>/assets/internal/WebsiteCASApr2025.docx">Guidelines</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="carer_wrappper">
                        <div class="career-opening">
                            <h3><a href="<?= base_url('');?>/assets/internal/SelfAppraisalDrAIT2024final.docx">CAS <br> Application Form<br></a></h3>
                            <p>(AGP Rs 8000 to AGP 9000)</p>
                        </div>
                        <div class="career-apply">
                            <div class="apply-now apply-now-new"><a target="_blank" href="<?= base_url('');?>/assets/internal/SelfAppraisalDrAIT2024final.docx">Download</a></div>
                            <div class="apply-now apply-now-new"><a target="_blank" href="<?= base_url('');?>/assets/internal/WebsiteCASApr2025.docx">Guidelines</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="carer_wrappper">
                        <div class="career-opening">
                            <h3><a href="<?= base_url('');?>/assets/internal/SelfAppraisalDrAIT2024final.docx">CAS<br> Application Form<br></a></h3>
                            <p>(AGP Rs 9000 to AGP 10000)</p>
                        </div>
                        <div class="career-apply">
                            <div class="apply-now apply-now-new"><a target="_blank" href="<?= base_url('');?>/assets/internal/SelfAppraisalDrAIT2024final.docx">Download</a></div>
                            <div class="apply-now apply-now-new"><a target="_blank" href="<?= base_url('');?>/assets/internal/WebsiteCASApr2025.docx">Guidelines</a></div>
                        </div>
                    </div>
                </div>
               


            </div>
        </div>
    </section>

 
