<div class="container">

  <div class="row row-xs">
    <div class="col-lg-12">
      <div class="card ht-100p shadow">
        <div class="card-body pd-y-20">

          <div class="widgetHead mb-3">
            <span class="widgetTitle">Add Documents</span>
          </div>

          <?= form_open_multipart($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
          <div class="form-row mg-b-10">
            <div class="form-group col-md-6">
              <label class="tx-14 font-weight-bold">Title of the document</label>
              <?php

              if ($user_data->post_of == "Non-Teaching") {
                $postList = $this->admin_model->get_doc_type_non()->result();
              } else {
                $postList = $this->admin_model->get_doc_type()->result();
              }



              ?>
              <select name="type" class="form-control col-sm-12" placeholder="Select Title of the document" id="type" required>
              <option >Select Document</option>
                <?php foreach ($postList as $post) { ?>
                  <option value="<?= $post->id; ?>" data-val="<?= $post->details; ?>"><?= $post->name; ?></option>
                <?php } ?>
              </select>

              <?= form_error('type', '<div class="text-danger">', '</div>'); ?>
              <br>
              <label id="details" style="color:red;"></label>
            </div>
            <div class="form-group col-md-6">
              <label class="tx-14 font-weight-bold">Document</label>
              <input type="file" class="form-control" required id="file" name="file" value="<?php echo (set_value('file')) ? set_value('file') : ''; ?>">
              <?= form_error('file', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="form-group col-md-6" id="otherType" style="display:none;">
              <label class="tx-14 font-weight-bold">Title</label>
              <input type="text" class="form-control" required id="title" name="title" value="<?php echo (set_value('title')) ? set_value('title') : ''; ?>">
              <?= form_error('title', '<div class="text-danger">', '</div>'); ?>
            </div>

          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-primary btn-square btn-sm" type="submit">Add</button>
            <?php echo anchor('recruitment/profile', 'Back', 'class="btn btn-secondary btn-square btn-sm"'); ?>
          </div>

          <?= form_close(); ?>



          <label>Note : Upload all the relevant documents as pdf files (file size should be less than 2 MB) </label>

        </div>
      </div>
    </div>
  </div><!-- row -->

  <div class="row row-xs mt-4">
    <div class="col-lg-12">
      <?php if ($this->session->flashdata('message')) { ?>
        <div align="center" class="alert <?= $this->session->flashdata('status'); ?>" id="msg">
          <?php echo $this->session->flashdata('message') ?>
        </div>
      <?php }

      ?>
      <div class="card ht-100p shadow">
        <div class="card-body pd-y-20">
          <div class="widgetHead mb-3">
            <span class="widgetTitle">List of Documents</span>
            <span tabindex="0" class="add no-outline">
              <?php
              if ((count($details) > 1)) {
                echo anchor('recruitment/profile?flag=8', '<i class="fas fa-angle-double-right "></i> Save & Proceed', 'class="btn btn-block btn-success btn-square btn-sm"');
              } elseif (($user_data->menu_flag == 7)) {
                echo anchor('recruitment/profile?flag=8', '<i class="fas fa-angle-double-right "></i> Skip & Proceed', 'class="btn btn-block btn-success btn-square btn-sm"');
              } else {
                echo anchor('recruitment/profile', '<i class="fas fa-angle-double-right "></i> Skip & Proceed', 'class="btn btn-block btn-success btn-square btn-sm"');
              }
              ?>
            </span>
          </div>

          <table class="table table-hover text-dark">
            <thead>
              <tr>
                <th width='30%'>Title of the document</th>
                <th width='15%'>Document</th>


                <th width='20%'>Actions</th>
              </tr>
            </thead>
            <?php if ($details) {
              foreach ($details as $details1) {
                $file_type = $this->admin_model->get_doc_name($details1->type);

                echo '<tr>';
                echo '<td>' . $file_type->name . '</td>';
                echo '<td>' . $details1->file . '</td>';


                echo '<td>' . anchor('recruitment/updateDocuments/' . $details1->id, 'Edit', 'class="btn btn-info btn-square btn-sm mx-1 my-1"') . anchor('recruitment/deleteDocuments/' . $details1->id, 'Delete', 'class="btn btn-danger btn-square btn-sm mx-1 my-1"') . '</td>';
                echo '</tr>';
              }
            } else {
              echo '<tr><td colspan="3" class="text-center text-muted">No document uploaded yet.</td></tr>';
            }
            ?>
          </table>
        </div>
      </div>


    </div>
  </div><!-- row -->


</div>
<script>
  $('#type').change(function() {

    selection = $('#type').find(":selected").text();
    details = $('#type').find(":selected").attr("data-val");
    //   alert(details);
    $("#details").html(details);
    if (selection == 'Other Certificates') {
      $('#otherType').show();
    } else {
      $('#otherType').hide();


    }
  });
</script>