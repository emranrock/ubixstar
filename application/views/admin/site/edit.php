<?php
if (!empty($records)) {
    foreach($records as $row){
        $id = $row->id;
        $name = $row->name;
        $contact = $row->number;
        $email = $row->email;
        $address = $row->address;
        $links = $row->social_links;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> <i class="fa fa-users"></i> Edit Site
                            <small>Add / Edit Site Setting</small></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="addEnquiry" action="<?php echo base_url('admin/site_setting/edit') ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row" id="site_form">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" autocomplete="off" value="<?php echo $name; ?>" required>
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Contact Number</label>
                                        <input type="number" name="number" class="form-control" value="<?php echo $contact; ?>">
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="abcd@gmail.com" value="<?php echo $email; ?>">
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Address </label>
                                        <textarea name="address" class="form-control" row="5"><?php echo trim($address); ?></textarea>
                                    </div>
                                </div>
                                <?php $data = json_decode($links); ?>
                                <div class="col-md-12">
                                    <label class="form-label">Facebook </label>
                                    <div class="input-group input-group-md">
                                        <input type="text" class="form-control" name="social_links[][facebook]" placeholder="https://www.facebook.com/someName" value="<?php echo $data->facebook; ?>">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-facebook btn-flat" id="add" disabled><i class="fa fa-facebook"></i></button>
                                        </span>
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <label class="form-label">Twitter </label>
                                    <div class="input-group input-group-md">
                                        <input type="text" class="form-control" name="social_links[][twitter]" placeholder="https://www.twitter.com/someName" value="<?php echo $data->twitter; ?>">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-twitter btn-flat" id="add" disabled><i class="fa fa-twitter"></i></button>
                                        </span>
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <label class="form-label">Instagram </label>
                                    <div class="input-group input-group-md">
                                        <input type="text" class="form-control" name="social_links[][instagram]" placeholder="https://www.instagram.com/someName" value="<?php echo $data->instagram; ?>">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-instagram btn-flat" id="add" disabled><i class="fa fa-instagram"></i></button>
                                        </span>
                                    </div>
                                </div><!-- /.col 2 -->
                                <div class="col-md-12">
                                    <label class="form-label">Google </label>
                                    <div class="input-group input-group-md">
                                        <input type="text" class="form-control" name="social_links[][google]" placeholder="https://www.googleplus.com/someName" value="<?php echo $data->google; ?>">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-flat" id="add" disabled><i class="fa fa-google"></i></button>
                                        </span>
                                    </div>
                                </div><!-- /.col 2 -->

                            </div><!-- /.row -->

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Update" name="update" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>

<script type="text/javascript" src="<?php echo base_url('admin_assets/js/common.js'); ?>" charset="utf-8"></script>
<script>
    $(document).ready(function() {
        $(".remove_1").on('click', function() {
            $(".default_1").hide();
            $(".area_1").append(`<input type="file" id="logo" name="logo"><p class="help-block">Image Dimention must be 1500X840 PX and Max Size 900 KB.</p>`);
            return false;
        });
        $(".remove_2").on('click', function() {
            $(".default_2").hide();
            $(".area_2").append(`<input type="file" id="images" name="fav"><p class="help-block">Image Dimention must be 1500X840 PX and Max Size 900 KB.</p>`);
            return false;
        });

    });
</script>