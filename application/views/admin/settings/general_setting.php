<?php
if (isset($site_info) && !empty($site_info)) {
    $data = json_decode($site_info, true);
} ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <?php $this->load->view('admin/includes/alert_bar'); ?>
       
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">General Setting </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form id="addEnquiry" action="<?php echo base_url('admin/settings/general_setting'); ?>" method="post" enctype="multipart/form-data">
                            <div class="row" id="site_form">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="form-label">Site Name</label>
                                        <input type="text" name="site_name" class="form-control" autocomplete="off" value="<?= isset($data) && !empty($data) ?  $data['site_name'] : ''; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <textarea name="address" class="form-control" cols="10" rows="5"><?= isset($data) && !empty($data) ?  $data['address'] : ''; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" name="email_address" class="form-control" autocomplete="off" value="<?= isset($data) && !empty($data) ?  $data['email_address'] : ''; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Contact Number</label>
                                        <input type="text" name="contact_number" class="form-control" autocomplete="off" value="<?= isset($data) && !empty($data) ?  $data['contact_number'] : ''; ?>" required>
                                    </div>
                                </div>
                            </div><!-- /.col 2 -->

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
                        </div>
                    </div>
                    </form>
                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>
</div>
</div>
</section>