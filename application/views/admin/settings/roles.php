<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <?php $this->load->view('admin/includes/alert_bar'); ?>
    <h1>
      <i class="fa fa-users"></i> Roles List
      <small>Add, Edit, Delete</small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Roles <small class="badge">:)</small></h3>
            <!-- search by Key -->
            <div class="box-tools">
              <div class="col-xs-12">
                <div class="float-right">
                  <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a>
                </div>
              </div>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">

            <table class="table table-striped" id="mydata">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th style="text-align: right;">Actions</th>
                </tr>
              </thead>
              <tbody id="class_action">
                <?php
                $serial_no = 1;
                foreach ($items as $row) { ?>
                  <tr>
                    <td><?php echo $serial_no; ?></td>
                    <td><?php echo ucfirst($row->role); ?></td>
                    <td class="pull-right">
                      <button class="btn btn-info btn-sm item_edit" data-toggle="modal" data-target="#Modal_Edit" data-id="<?php echo encode_url($row->roleId); ?>" data-title="<?php echo $row->role; ?>">Edit</button>

                      <button class="btn btn-danger btn-sm item_delete" data-toggle="modal" data-target="#Modal_Delete" data-id="<?php echo encode_url($row->roleId); ?>">Delete</button>
                    </td>
                  </tr>
                <?php $serial_no++;
                } ?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <?php //echo $this->pagination->create_links(); 
            ?>
          </div>
        </div><!-- /.box -->
      </div>
    </div>

</div>
</section>

<!-- MODAL ADD -->
<form action="#">
  <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Rank</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group ">
              <label class="col-md-2 col-form-label">Role Name:-</label>
              <div class="col-md-10">
                <input type="text" name="role_name" id="role_name" class="form-control" placeholder="Role Title">
                <div class="alert" id="error"></div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!--END MODAL ADD-->

<!-- MODAL EDIT -->
<form>
  <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="" />
          <div class="row">
            <div class="form-group ">
              <label class="col-md-2 col-form-label" for="title_editable">Role Name:-</label>
              <div class="col-md-10">
                <input type="text" name="title_editable" id="title_editable" class="form-control" placeholder="Role Name Here">
                <div class="alert" id="error"></div>
              </div>
            </div>
          </div>

        </div>
        <div class=" modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!--END MODAL EDIT-->

<!--MODAL DELETE-->
<form>
  <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this record?</strong>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="item_id" class="form-control">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!--END MODAL DELETE-->


<script type="text/javascript">
  $(document).ready(function() {

    $('#mydata').dataTable();

    //Save product
    $('#btn_save').on('click', function() {
      var title = $('#role_name').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/ajax/saveRole') ?>",
        dataType: "JSON",
        data: {
          title
        },
        success: function(data) {
          if (data === true) {
            $('[name="role_name"]').val("");
            $('#Modal_Add').modal('hide');
            location.reload();
          } else {
            $("#error").html(data);
          }
        },
      });
      return false;
    });

    //get data for update record
    $(document).delegate(".item_edit", "click", function(e) {

      e.preventDefault();
      var title = $(this).data('title');
      var id = $(this).data('id');
      $('#title_editable').val(title);
      $('#id').val(id);
    });

    //update record to database
    $('#btn_update').on('click', function() {
      var title_editable = $('#title_editable').val();
      var capacity_editable = $('#capacity_editable').val();
      var id = $('#id').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/ajax/updateRole') ?>",
        dataType: "JSON",
        data: {
          id,
          title_editable
        },
        success: function(data) {
          $('[name="title_editable"]').val("");
          $('#Modal_Edit').modal('hide');
          location.reload();
        }
      });
      return false;
    });

    //get data for delete record
    $(".item_delete").click(function() {
      var id = $(this).data('id');
      $('[name="item_id"]').val(id);
    });

    //delete record to database
    $('#btn_delete').on('click', function() {
      var item_id = $('[name="item_id"]').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/ajax/deleteRole') ?>",
        dataType: "JSON",
        data: {
          id: item_id
        },
        success: function(data) {
          $('[name="item_id"]').val("");
          $('#Modal_Delete').modal('hide');
          location.reload();
        }
      });
      return false;
    });
  });
</script>