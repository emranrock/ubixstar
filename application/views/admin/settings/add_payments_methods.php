<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa  fa-users"></i> Add Payment Methods
      <small>:)</small>

    </h1>
    <div class="pull-right">
      Please Use This Plus Button To Add More Fields &nbsp;
      <a href="#" class="btn btn-navy btn-xs add_field pull-right">
        <span class="fa fa-plus"></span>
      </a>
    </div>
    <?php
    $this->load->helper('form');
    $error = $this->session->flashdata('error');
    if ($error) {
    ?>
      <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $this->session->flashdata('error'); ?>
      </div>
    <?php } ?>
    <?php
    $success = $this->session->flashdata('success');
    if ($success) {
    ?>
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $this->session->flashdata('success'); ?>
      </div>
    <?php } ?>
  </section>
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <form action="<?php echo base_url('admin/settings/add_payment_methods'); ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <?php if (empty($payment_methods)) { ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">Payment Method</label>
                      <input type="text" name="payment_methods[]" class="form-control" autocomplete="off" value="" required>
                    </div>
                  </div>
                  <?php } else {
                  foreach ($payment_methods['data'] as $value) { ?>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Payment Method</label>
                        <input type="text" name="payment_methods[]" class="form-control" autocomplete="off" value="<?= $value; ?>">
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
              <div class="row" id="site_form">
              </div><!-- /.row -->
              <div class="form-group">
                <input type="submit" class="btn btn-primary btn-sm" value="Submit" name="add_methods" />
              </div>
            </div><!-- /.box-body -->
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  $(document).ready(function(e) {
    $(".add_field").on("click", function(e) {
      e.preventDefault();
      $("#site_form").append(`<div class="col-md-6">
          <div class="form-group">
          <label class="form-label">Payment Method</label>
          <input type="text" name="payment_methods[]" class="form-control" autocomplete="off" value="">
        </div>
      </div>`);
    });
  });
</script>