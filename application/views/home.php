

    <!-- Career Openings Section -->
    <section class="career-current-opening">
        <div class="container">
            <h2 class="">Current Openings</h2>
            <div class="row">

			<?php foreach ($recruitmentList as $recruitmentList1) { ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="carer_wrappper">
                        <div class="career-opening">
                            <h3><a href="<?= base_url('recruitment');?>"><?= $recruitmentList1->title ;?></a></h3>
                            <div class="years-current"><i class="fa fa-briefcase" aria-hidden="true"></i>   <?= $recruitmentList1->department_names; ?></div>
                            <div class="place-current"><i class="fa fa-location-arrow" aria-hidden="true"></i> Bengaluru</div>
                        </div>
                        <div class="career-apply">
                            <div class="apply-now"><a target="_blank" href="<?= base_url('recruitment');?>">Apply Now</a></div>
                            <div class="read-more"><a href="<?= base_url('recruitment');?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                        </div>
                    </div>
                </div>
<?php } ?>

            </div>
        </div>
    </section>

 
