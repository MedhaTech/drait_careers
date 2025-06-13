<div class="container">

    <div class="row row-xs">
        <div class="col-lg-12">
            <div class="card ht-100p shadow">
                <div class="card-body pd-y-20">      

                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Skill Details</span>
                    </div>  

                    <?=form_open($action, 'class="js-validation-login push-50" name="form" novalidate');?>
                    <div class="form-row mg-b-10">
                        <div class="form-group col-md-12">
                            <label class="tx-14 font-weight-bold">Name of the Skill</label>
                            <input type="text" class="form-control" placeholder="Enter Name of the Skill" id="name" name="name" 
                            value="<?php echo (set_value('name')) ? set_value('name') : $details->name; ?>">
                            <?=form_error('name','<div class="text-danger">','</div>');?>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">Description</label>
                            <input type="text" class="form-control" placeholder="Enter Description" id="description" name="description" 
                            value="<?php echo (set_value('description')) ? set_value('description') : $details->description; ?>">
                            <?=form_error('description','<div class="text-danger">','</div>');?>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="tx-14 font-weight-bold">Skill Rating (1 to 10)</label>
                            <input type="number" min="1" max="10" class="form-control" placeholder="Enter Skill Rating" id="number" name="number" 
                            value="<?php echo (set_value('number')) ? set_value('number') : $details->number; ?>">
                            <?=form_error('number','<div class="text-danger">','</div>');?>
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
