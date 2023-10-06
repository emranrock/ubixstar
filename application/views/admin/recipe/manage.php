<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Recipe List
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
                    <a class="btn btn-primary" href="<?php echo base_url('admin/recipe/'); ?>"><i class="fa fa-plus"></i> Add
                        New</a>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">

                        <!-- serach by Key -->
                        <div class="box-tools">
                            <div class="col-xs-12">

                                <!-- <form action="<?php //echo base_url() 
                                                    ?>students/show" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php //echo $searchText; 
                                                                            ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form> -->
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-hover " id="timeTable">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Instructions</th>
                                    <th>Ingredients</th>
                                    <th>Category</th>
                                    <th>Tag</th>
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
                                            <td><?php echo substr(ucfirst($record->description), 0, 25) . '...'; ?></td>
                                            <td><?php echo substr(ucfirst($record->instructions), 0, 50) . '...'; ?></td>
                                            <td><?php echo $record->name; ?></td>

                                            <td><?php echo $record->cat_name; ?></td>
                                            <td><?php
                                                $tags = explode(',', $record->tag);
                                                foreach ($tags as $key => $value) {
                                                    echo ucfirst($value) . ' | ';
                                                }
                                                ?></td>
                                            <td>
                                                <a class="btn btn-xs btn-info" href="<?php echo base_url('admin/recipe/edit/') . $record->id; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-xs btn-danger delete" href="#" data-id="<?php echo $record->id; ?>" data-toggle="tooltip" data-placement="top" title="Delete">
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
                    <div class="box-footer clearfix">
                        <?php //echo $this->pagination->create_links(); 
                        ?>
                    </div>
                    <!-- Loading (remove the following to stop the loading)-->
                    <!-- <div class="overlay">
                    <i class="fa fa-refresh fa-spin"></i>
                  </div> -->
                    <!-- end loading -->
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
                url: baseURL + 'recipe/delete',
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