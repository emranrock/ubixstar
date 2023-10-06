<?php
if (!empty($records)) {
  foreach ($records as $row) {
    $id = $row->id;
    $icon = $row->icon;
    $amount = $row->amount;
    $duration = $row->duration;
    $title = $row->title;
    $features = $row->features;
    $active = $row->active;
    $btn_text = $row->btn_text;
    $status = $row->status;
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
          <i class="fa fa-users"></i> Edit Plans
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
        <h3 class="box-title">Blog</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>

      <form action="<?php echo base_url('admin/pricing/edit'); ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
          <div class="col-md-8">
            <input type="hidden" name="id" value="<?php if (isset($id)) {
                                                    echo $id;
                                                  } ?>" />

            <div class="form-group">
              <label class="form-label">Title</label>
              <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
              <p class="help-block">Title Limit is 150 Characters</p>
            </div>
            <div class="form-group">
              <label class="form-label">Amount</label>
              <input type="number" name="amount" class="form-control" value="<?php echo $amount; ?>">
              <!-- <p class="help-block">Title Limit is 150 Characters</p> -->
            </div>

            <div class="form-group">
              <label class="icons">Duration</label>
              <div class="input-group">
                <?php $data = explode(" ", $duration); ?>
                
                <div class="input-group-addon">
                  <select id="duration" name="duration">
                    <option value="day" <?php if ($data[1] == 'day') {
                                          echo 'selected';
                                        } else {
                                          echo '';
                                        } ?>>Day</option>
                    <option value="month" <?php if ($data[1] == 'month') {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          } ?>>Month</option>
                    <option value="year" <?php if ($data[1] == 'year') {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          } ?>>Year</option>
                    <option value="days" <?php if ($data[1] == 'days') {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          } ?>>Days</option>
                    <option value="months" <?php if ($data[1] == 'months') {
                                              echo 'selected';
                                            } else {
                                              echo '';
                                            } ?>>Months</option>
                    <option value="years" <?php if ($data[1] == 'years') {
                                            echo 'selected';
                                          } else {
                                            echo '';
                                          } ?>>Years</option>
                  </select>
                </div>
                <input type="number" name="duration_number" class="form-control" value="<?php echo $data[0]; ?>">
              </div>
            </div>


            <div class="form-group">
              <label class="form-label">Features</label>
              <textarea name="features" class="form-control editors" rows="10" col="3"><?php echo $features; ?></textarea>

            </div>

            <div class="form-group">
              <label class="form-label">Set as Default</label>
              <select class="form-control select2" id="active" name="active">
                <option value="N" <?php if ($active == 'N') {
                                    echo 'selected';
                                  } else {
                                    echo '';
                                  } ?>>No</option>
                <option value="Y" <?php if ($active == 'Y') {
                                    echo 'selected';
                                  } else {
                                    echo '';
                                  } ?>>YES</option>

              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Button Text</label>
              <input type="text" name="btn_text" class="form-control" value="<?php echo $btn_text; ?>">
            </div>

          </div><!--  close col-md-8 -->
          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Submit All Information</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>
                    Active
                    <input type="radio" name="status" value="active" <?php if ($status == 'active') {
                                                                        echo 'checked';
                                                                      } ?>>
                  </label>
                  &nbsp;&nbsp;&nbsp;
                  <label>
                    In-Active
                    <input type="radio" name="status" value="in-active" <?php if ($status == '' || $status == 'in-active') {
                                                                          echo 'checked';
                                                                        } ?>>
                  </label>
                </div>

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
<script>
  $(document).ready(function() {

    $("#icons").select2({
      templateResult: formatState
    });
  });

  function formatState(state) {
    if (!state.id) {
      return state.text;
    }
    //console.log(state.element.value);
    //console.log(state.element.text);
    var $state = $(

      '<span> <i class="' + state.element.value.toLowerCase() + '"></i> ' + state.element.text.toLowerCase() + '</span>'

    );
    return $state;
  };
</script>