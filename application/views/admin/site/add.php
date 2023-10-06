<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="col-md-4">
            <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>
            <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>

            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> <i class="fa  fa-database"></i> Add New Site
                            <small>:)</small>
                        </h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form id="addEnquiry" action="<?= base_url('admin/site_setting/') ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row" id="site_form">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" autocomplete="off" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Contact Number</label>
                                        <input type="number" name="number" class="form-control" value="">
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="abcd@gmail.com">
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Address </label>
                                        <textarea name="address" class="form-control" row="5"></textarea>
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <label class="form-label">Facebook </label>
                                    <div class="input-group input-group-md">
                                        <input type="text" class="form-control" name="social_links[][facebook]"
                                            placeholder="https://www.facebook.com/someName">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-facebook btn-flat" id="add" disabled><i
                                                    class="fa fa-facebook"></i></button>
                                        </span>
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <label class="form-label">Twitter </label>
                                    <div class="input-group input-group-md">
                                        <input type="text" class="form-control" name="social_links[][twitter]"
                                            placeholder="https://www.twitter.com/someName">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-twitter btn-flat" id="add" disabled><i
                                                    class="fa fa-twitter"></i></button>
                                        </span>
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <label class="form-label">Instagram </label>
                                    <div class="input-group input-group-md">
                                        <input type="text" class="form-control" name="social_links[][instagram]"
                                            placeholder="https://www.instagram.com/someName">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-instagram btn-flat" id="add"
                                                disabled><i class="fa fa-instagram"></i></button>
                                        </span>
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <label class="form-label">Google </label>
                                    <div class="input-group input-group-md">
                                        <input type="text" class="form-control" name="social_links[][google]"
                                            placeholder="https://www.googleplus.com/someName">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-flat" id="add" disabled><i
                                                    class="fa fa-google"></i></button>
                                        </span>
                                    </div>
                                </div><!-- /.col 2 -->

                            </div><!-- /.row -->

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

</div>
<script src="<?php echo base_url(); ?>admin_assets/js/addUser.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/js/common.js" charset="utf-8"></script>
<script>
    $(document).ready(function () {

        $('#add').click(function () {
            var html = `
        <div class="col-md-12" id="links">
        <label class="form-label">Social Links</label>
        <div class="input-group input-group-md">
            <input type="text" class="form-control" name="social_links[]" placeholder="http://www.socialsite.com/someName">
                <span class="input-group-btn">
                <button type="button" class="btn btn-danger btn-flat" id="remove"><i class="fa fa-close"></i></button>
                </span>
        </div>
        </div>
`;
            $('#site_form').append(html);
            $("#site_form").on("click", "#remove", function () {
                $(this).closest("#links").remove();
            })
        });
    })
</script>