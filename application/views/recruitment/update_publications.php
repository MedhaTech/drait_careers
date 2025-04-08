<div class="container">

        <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Publication Details</span>
                    </div>  
                    
                <?=form_open($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-12">
                      <label class="tx-14 font-weight-bold">Title of the Paper</label>
                      <input type="text" class="form-control" placeholder="Enter Title of the Paper" id="title_of_paper" name="title_of_paper" value="<?php echo (set_value('title_of_paper'))?set_value('title_of_paper'):$details->title_of_paper;?>">
                      <?=form_error('title_of_paper','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="tx-14 font-weight-bold">National / International</label>
                      <?php $programList = array(" " => 'Select', 'National' => 'National', 'International' => 'International');
                            echo form_dropdown('publication_type', $programList, (set_value('publication_type'))?set_value('publication_type'):$details->publication_type, 'class="form-control input-xs" id="publication_type"'); ?>
                      <?=form_error('publication_type','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="tx-14 font-weight-bold">Year and Month of Publication</label>
                      <input type="month" class="form-control" placeholder="Enter Exp From" id="publication_date" name="publication_date" value="<?php echo (set_value('publication_date'))?set_value('publication_date'):$details->publication_date;?>">
                      <?=form_error('publication_date','<div class="text-danger">','</div>');?>
                    </div>
                    <div class="form-group col-md-4">
                      <label class="tx-14 font-weight-bold">Conference / Journal / Book</label>
                      <?php $categoryList = array(" " => 'Select', 'Conference' => 'Conference', 'Journal' => 'Journal', 'Book' => 'Book');
                            echo form_dropdown('category', $categoryList, (set_value('category'))?set_value('category'):$details->category, 'class="form-control input-xs" id="category"'); ?>
                      <?=form_error('category','<div class="text-danger">','</div>');?>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                    <?php echo anchor('recruitment/managePublications','Cancel','class="btn btn-secondary btn-square btn-sm"'); ?>    
                </div>

                <?=form_close();?>
               </div>
             </div>
           </div>
        </div><!-- row -->
        
</div>
