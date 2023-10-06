<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Manage Site
            <small> <a class="btn btn-primary btn-xs" href="<?php echo base_url('admin/site_setting'); ?>"><i class="fa fa-plus"></i> Add</a></small>
        </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-hover" id="site">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sr = 1;
                                if (!empty($userRecords)) {
                                    foreach ($userRecords as $key => $value) {
                                        # code...
                                    
                                ?>
                                    <tr>
                                        <td><?php echo $sr; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo substr($value->address, 0, 50) . '...'; ?></td>
                                        <td><?php echo $value->number; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/site_setting/edit/').$value->id; ?>"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $sr++;
                                }
                            }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $("#site").dataTable();
    });
</script>