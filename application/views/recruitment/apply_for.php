<div class="container">

  <?php if ($this->session->flashdata('message')) { ?>
    <div class="alert <?= $this->session->flashdata('status'); ?>" id="msg">
      <?php echo $this->session->flashdata('message') ?>
    </div>
  <?php } ?>

  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Apply For</h6>
        </div>
        <div class="card-body">

          <?php echo form_open($action, 'class="user"'); ?>

          <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Post Type</label>
            <div class="col-sm-9"> <?php $applypost = $this->admin_model->getPostType(); ?>
              <select name="post_of" id="post_of" class="form-control col-sm-6" required>

                <option value="">- select -</option>
                <?php
                foreach ($applypost as $post) {
                ?>
                  <option value="<?= $post->type; ?>"><?= $post->type; ?></option>

                <?php } ?>
              </select>
              <span class="validationError"><?php echo form_error('post_of'); ?></span>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label text-right font-weight-bold">Department</label>
            <div class="col-sm-9">
              <?php
              // $departmentsList = array("" => "- Select -", "Computer Science Engg" => "Computer Science Engg", "Information Science Engg" => "Information Science Engg", " Artificial Intelligence & Machine Learning" => " Artificial Intelligence & Machine Learning", "CSE (Data Science)"=>"CSE (Data Science)", "CSE (IOT and Cyber Security & Blockchain Technology)" => "CSE (IOT and Cyber Security & Blockchain Technology)", "Artificial Intelligence" => "Artificial Intelligence", "Data Science" => "Data Science");
              // echo form_dropdown('department', $departmentsList, set_value('department', ''),'class="form-control col-sm-6"'); 
              ?>
              <select name="department" id="department" class="form-control col-sm-6" required>



              </select>
              <span class="validationError"><?php echo form_error('department'); ?></span>
            </div>
          </div>


          <div class="form-group row">
            <div class="col-sm-3"> &nbsp;</div>
            <div class="col-sm-9">
              <button type="submit" class="btn btn-danger btn-square btn-sm" name="Update" id="Update"> Proceed </button>
            </div>
          </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</div>
<script>
  // $(document).on('change', '#post_of', function() {
  //   var type = $(this).val();
  //   if (type) {
  //     $.ajax({
  //       type: 'POST',
  //       url: '<?= base_url(); ?>/main/getpost',
  //       data: {
  //         'type': type
  //       },
  //       success: function(result) {
  //         $('#post_id').html(result);

  //       }
  //     });
  //   } else {
  //     $('#post_id').html('<option >Select</option>');

  //   }
  // });
  $(document).on('change', '#post_of', function() {
    var id = $(this).val();
    if (id) {
      $.ajax({
        type: 'POST',
        url: '<?= base_url(); ?>/main/getdepartment',
        data: {
          'id': id
        },
        success: function(result) {
          $('#department').html(result);

        }
      });
    } else {
      $('#department').html('<option >Select</option>');

    }
  });
</script>