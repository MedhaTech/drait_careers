<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">      

                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Award Details</span>
                    </div>  

                    <?=form_open($action, 'class="js-validation-login push-50" name="form" novalidate');?>
                    <div class="form-row mg-b-10">
                        <div class="form-group col-md-12">
                            <label class="tx-14 font-weight-bold">Name of the Award</label>
                            <input type="text" class="form-control" placeholder="Enter Name of the Award" id="name" name="name" 
                            value="<?php echo (set_value('name')) ? set_value('name') : $details->name; ?>">
                            <?=form_error('name','<div class="text-danger">','</div>');?>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">Award Description</label>
                            <input type="text" class="form-control" placeholder="Enter Award Description" id="award" name="award" 
                            value="<?php echo (set_value('award')) ? set_value('award') : $details->award; ?>">
                            <?=form_error('award','<div class="text-danger">','</div>');?>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">Year</label>
                            <input type="year" class="form-control" placeholder="Enter Year" id="year" name="year" 
                            value="<?php echo (set_value('year')) ? set_value('year') : $details->year; ?>">
                            <?=form_error('year','<div class="text-danger">','</div>');?>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                        <?php echo anchor('recruitment/profile','Back','class="btn btn-secondary btn-square btn-sm"'); ?>    
                    </div>

                    <?=form_close();?>
                </div>
            </div>
        </div>
    </div><!-- row -->

</div>
