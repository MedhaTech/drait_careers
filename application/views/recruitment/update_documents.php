<div class="container">

        
          <div class="row row-xs">
           <div class="col-lg-12">
             <div class="card ht-100p shadow">
               <div class="card-body pd-y-20">      
               
                    <div class="widgetHead mb-3">
                        <span class="widgetTitle">Update Document</span>
                    </div>  
                    
                <?=form_open_multipart($action,'class="js-validation-login push-50" name="form" novalidate');?>
                <div class="form-row mg-b-10">
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Title of the document</label>
                      <?php

if($user_data->post_of=="Non-Teaching")
{
  $postList = $this->admin_model->get_doc_type_non()->result();
}
else{
  $postList = $this->admin_model->get_doc_type()->result();
}
            		      	
            		      
            		      
            		      ?>
            		      <select name="type" class="form-control col-sm-12"  id="type" placeholder="Select Title of the document" required>
            		         
            		          <?php foreach($postList as $post) {?>
                            <option value="<?= $post->id;?>" <?php if($post->id==$details->type) { echo "selected";}?> data-val="<?= $post->details;?>" ><?= $post->name;?></option>
                            <?php }?>
                            </select>
            		      
                      <?=form_error('type','<div class="text-danger">','</div>');?>
                       <br>
                      <label id="details" style="color:red;"></label>  
                    </div>
                    <div class="form-group col-md-6">
                      <label class="tx-14 font-weight-bold">Document</label>
                      <input type="file" class="form-control" required  id="file" name="file" value="<?php echo (set_value('file'))?set_value('file'):'';?>">
                      <?=form_error('file','<div class="text-danger">','</div>');?>
                        <label class="tx-14 font-weight-bold"><?=$details->file;?></label>
                    </div>
                     <div class="form-group col-md-6" id="otherType" style="display:none;">
                      <label class="tx-14 font-weight-bold">Title</label>
                      <input type="text" class="form-control" required  id="title" name="title" value="<?php echo (set_value('title'))?set_value('title'):$details->title;?>">
                      <?=form_error('title','<div class="text-danger">','</div>');?>
                    </div>
                 
                </div>
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary btn-square btn-sm" type="submit">Update</button>
                    <?php echo anchor('recruitment/manageDocuments','Cancel','class="btn btn-secondary btn-square btn-sm"'); ?>    
                </div>

                <?=form_close();?>
                  <label>Note : Upload all the relevant documents as pdf files (file size should be less than 2 MB) </label>
               </div>
             </div>
           </div>
        </div><!-- row -->
        
</div>
<script>    
$('#type').change(function(){

   selection = $('#type').find(":selected").text();
   details = $('#type').find(":selected").attr("data-val");
//   alert(details);
 $("#details").html(details);
if(selection=='Other Certificates')
{
           $('#otherType').show();
}
else
{
           $('#otherType').hide();
           
          
   }
});
</script>