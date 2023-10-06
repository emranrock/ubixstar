<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Add Rack and Rows ..
      <small>Add, Edit, Delete</small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Upload Your Csv <small class="badge">:)</small></h3>
          </div><!-- /.box-header -->
          <div class="box-body no-padding">
            <form action="<?php echo base_url('admin/settings/bulk'); ?>" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <input type="file" name="file" class="form-control" accept=".csv" />
                </div>
                <div class="col-md-6">
                  <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                </div>
              </div>
            </form>
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <?php if (!empty($success_msg)) { ?>
              <div class="col-xs-12">
                <div class="alert alert-success"><?php echo $success_msg; ?></div>
              </div>
            <?php }
            if (!empty($error_msg)) { ?>
              <div class="col-xs-12">
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
              </div>
            <?php } ?>
          </div>
        </div><!-- /.box -->
      </div>
    </div>

</div>
</section>