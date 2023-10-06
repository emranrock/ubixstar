<div class="content-wrapper" style="min-height: 1126px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> User Management
      <small>Add, Edit, Delete</small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12 text-right">
        <div class="form-group">
          <a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/addNewUser'); ?>"><i class="fa fa-plus"></i> Add New</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Users List</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover" id="users">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Role</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($userRecords)) {
                  $sr = 1;
                  foreach ($userRecords as $record) {
                ?>
                    <tr>
                      <td><?php echo $sr; ?></td>
                      <td><?php echo $record->full_name; ?></td>
                      <td><?php echo $record->email; ?></td>
                      <td><?php echo $record->phone_number; ?></td>
                      <td><?php echo get_roles($record->roleId); ?></td>
                      <td class="text-center">
                        <!-- <a class="btn btn-sm btn-default" href="<?php echo base_url('admin/member/manage/') . encode_url($record->userId); ?>"><i class="fa fa-user"></i></a> -->
                        <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/editOld/') . encode_url($record->userId); ?>"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                <?php
                    $sr++;
                  }
                } else {
                  echo 'No Users Found';
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
    $('#users').dataTable();
  });
</script>