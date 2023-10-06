<div class="content-wrapper" style="min-height: 1126px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Recipe Category
      <small>:)</small>
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Ingredient</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>

      <form action="<?php echo base_url('admin/ingredient'); ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
          <div class="col-md-8">

            <div class="form-group">
              <label class="form-label">Name</label>
              <input type="text" name="name" class="form-control" value="">
            </div>

          </div><!--  close col-md-8 -->
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Submit All Information</h3>
              </div>


              <input type="submit" class="btn btn-primary btn-sm " name="submit" value="Submit" />
              <br /><br />
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

              <div class="row">
                <div class="col-md-4">
                  <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
      </form>
    </div>
</div>
<!-- /.box-body -->
<div class="box-footer">
  ...
</div>
<!-- /.box-footer-->
</div>
<!-- /.box -->

</section>
<!-- /.content -->
</div>