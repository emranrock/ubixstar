<?php if (isset($options)) {
    $data = json_decode($options, true);
}
?>
<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"> Site Settings
                    <small>Set Option to Hide and Show section at Your Site</small>
                </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>

            <form action="<?php echo base_url('admin/site_setting/service_page'); ?>" method="post">
                <div class="box-body ">
                    <div class="col-md-8 connectedSortable">
                        <div class="row">
                            <input type="hidden" name="id" value="<?php echo $ids; ?>" />
                            <?php foreach ($data['services_page'] as $key => $value) {?>
                                <div class="col-md-4">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title"><?= ucfirst($key) ?> Section</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>
                                                Active
                                                <input type="radio" name="option[services_page][<?= $key ?>]" value="active" <?php if (isset($value) && $value == 'active') {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                                In-Active
                                                <input type="radio" name="option[services_page][<?= $key ?>]" value="in-active" <?php if (!isset($value) || $value == '' || $value == 'in-active') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div><!--  close col-md-8 -->
                    </div>
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Submit All Information</h3>
                            </div>
                            <input type="submit" class="btn btn-primary btn-md pull-right" name="services_page_settings" value="Submit" />

                            <div class="box-body">


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
                    </div>
            </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            ...
        </div>
        <!-- /.box-footer-->
    </section>
    <!-- /.content -->
</div>
<style>
    .seprator {
        background-color: #0075ff;
        color: #fff;
        font-size: 16px;
        text-align: center;
        font-weight: 600;
        border-radius: 5px;
        margin-bottom: 5px;
    }
</style>