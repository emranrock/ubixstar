<?php
if (!empty($records)) {
  foreach ($records as $row) {
    $id = $row->id;
    $title = $row->name;
  }
}

//var_dump($id);exit;
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="row">
      <div class="col-md-6">
        <h2>
          <i class="fa fa-users"></i> Edit Recipe Ingredient
          <small>Add / Edit User</small>
        </h2>
      </div>
    </div>
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

      <form action="<?php echo base_url('admin/ingredient/edit'); ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
          <div class="col-md-8">
            <input type="hidden" name="id" value="<?php if (isset($id)) {
                                                    echo $id;
                                                  } ?>" />
            <div class="form-group">
              <label class="form-label">Title</label>
              <input type="text" name="name" class="form-control" value="<?php echo $title; ?>">
            </div>

          </div><!--  close col-md-8 -->
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Submit All Information</h3>
              </div>
              <div class="box-body">

                <input type="submit" class="btn btn-primary btn-sm" name="edit" value="Submit" />
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
<script src="<?php echo base_url(); ?>admin_assets/js/editUser.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/js/common.js" charset="utf-8"></script>
<script>
  $(document).ready(function() {

    $(".remove").on('click', function() {
      $(".default").hide();
      $(".area").append(`
    <input type="file" id="images" name="image">
    <p class="help-block">Image Dimention must be 215X215 PX and Max Size 500 KB.</p>
    `);

    });
  });
</script>
<style>
  a.btn.remove {
    position: relative;
    margin-top: -25%;
    margin-left: -7%;
    color: aliceblue;
  }
</style>