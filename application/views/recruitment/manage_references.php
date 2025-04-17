<div class="container">

  <div class="row row-xs">
    <div class="col-lg-12">
      <div class="card ht-100p shadow">
        <div class="card-body pd-y-20">

          <div class="widgetHead mb-3">
            <span class="widgetTitle">Add New References Details</span>
          </div>

          <?= form_open($action, 'class="js-validation-login push-50" name="form" novalidate'); ?>
          <div class="form-row mg-b-10">
            <div class="form-group col-md-9">
              <label class="tx-14 font-weight-bold">Name</label>
              <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name" value="<?php echo (set_value('name')) ? set_value('name') : ''; ?>">
              <?= form_error('name', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="form-group col-md-4">
              <label class="tx-14 font-weight-bold">Occupation or Position</label>
              <input type="text" class="form-control" placeholder="Enter Occupation or Position" id="position" name="position" value="<?php echo (set_value('position')) ? set_value('position') : ''; ?>">
              <?= form_error('position', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="form-group col-md-5">
              <label class="tx-14 font-weight-bold">Address for Communication with Contact Number</label>
              <input type="text" class="form-control" placeholder="Enter Address for Communication with Contact Number" id="number" name="number" value="<?php echo (set_value('number')) ? set_value('number') : ''; ?>">
              <?= form_error('number', '<div class="text-danger">', '</div>'); ?>
            </div>

          </div>
          <div class="col-md-12 text-right">
            <button class="btn btn-primary btn-square btn-sm" type="submit">Add</button>
            <?php echo anchor('recruitment/profile', 'Cancel', 'class="btn btn-secondary btn-square btn-sm"'); ?>
          </div>

          <?= form_close(); ?>
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
            <span class="widgetTitle">List of References</span>
            <span tabindex="0" class="add no-outline">
              <?php
              if (($user_data->menu_flag == 8)) {
                echo anchor('recruitment/profile?flag=9', '<i class="fas fa-angle-double-right "></i> Save & Proceed', 'class="btn btn-block btn-success btn-square btn-sm"');
              }
              ?>
            </span>
          </div>

          <table class="table table-hover text-dark">
            <thead>
              <tr>
                <th width='30%'>Name</th>
                <th width='15%'>Occupation or Position</th>
                <th width='15%'>Address for Communication with Contact Number</th>

                <th width='20%'>Actions</th>
              </tr>
            </thead>
            <?php
            if ($details) {
              foreach ($details as $details1) {

                echo '<tr>';
                echo '<td>' . $details1->name . '</td>';
                echo '<td>' . $details1->position . '</td>';
                echo '<td>' . $details1->number . '</td>';

                echo '<td>' . anchor('recruitment/updateReferences/' . $details1->id, 'Edit', 'class="btn btn-info btn-square btn-sm mx-1 my-1"') . anchor('recruitment/deleteReferences/' . $details1->id, 'Delete', 'class="btn btn-danger btn-square btn-sm mx-1 my-1"') . '</td>';
                echo '</tr>';
              }
            } else {
              echo '<tr><td colspan="4" class="text-center text-muted">No References added yet.</td></tr>';
            }
            ?>
          </table>
        </div>
      </div>
      <?php

      ?>

    </div>
  </div><!-- row -->


</div>