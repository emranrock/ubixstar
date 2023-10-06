<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Pricing List
            <small>Add, Edit, Delete</small>
        </h1>

    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
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
                    <div class="col-md-6">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <div class="form-group">
                    <a class="btn btn-primary btn-xs" href="<?php echo base_url('admin/pricing/'); ?>"><i class="fa fa-plus"></i> Add
                        New</a>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-hover " id="timeTable">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Title</th>
                                    <th>Duration</th>
                                    <th>Amount</th>
                                    <th>features</th>
                                    <th>Default</th>
                                    <th>Button Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sr = 1;
                                if (!empty($userRecords)) {

                                    foreach ($userRecords as $record) {

                                ?>
                                        <tr>
                                            <td><?php echo $sr; ?></td>
                                            <td><?php echo ucfirst($record->title); ?></td>
                                            <td><?php echo ucfirst($record->duration); ?></td>
                                            <td><?php echo ucfirst($record->amount); ?></td>
                                            <td><?php echo ucfirst($record->features); ?></td>
                                            <td><?php echo ucfirst($record->active); ?></td>
                                            <td><?php echo ucfirst($record->btn_text); ?></td>

                                            <td><?php echo $record->status; ?></td>
                                            <td>
                                                <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/pricing/edit/') . $record->id; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-sm btn-danger delete" href="#" data-id="<?php echo $record->id; ?>" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa fa-trash"></i></a>
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
<script type="text/javascript" src="<?php echo base_url('admin_assets/js/common.js'); ?>" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $("#timeTable").dataTable({

            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true

        });

        $(".delete").on('click', function() {
            var id = $(this).data('id');
            var currentRow = $(this).parent();
            jQuery.ajax({
                type: "POST",
                url: baseURL + 'pricing/delete',
                data: {
                    id: id
                }
            }).done(function(data) {
                currentRow.parents('tr').remove();
                if (data.status = true) {
                    alert("Record successfully deleted");
                } else if (data.status = false) {
                    alert("Record deletion failed");
                } else {
                    alert("Access denied..!");
                }
            });
        });

    });
</script>