<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Pre Booking Items List
      <small>Add, Edit, Delete</small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Booking Items List <small class="badge">:)</small></h3>
            <!-- serach by Key -->
            <div class="box-tools">
              <div class="col-xs-12">
                <div class="float-right">
                  <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a>
                </div>

              </div>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">

            <table class="table table-striped table-bordered" id="mydata">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th class="pull-right">Actions</th>
                </tr>
              </thead>
              <tbody id="class_action">
                <?php
                $serial_no = 1;
                foreach ($items as $row) { ?>
                  <tr>
                    <td><?php echo $serial_no; ?></td>
                    <td><?php echo ucwords($row->item); ?></td>
                    <td><?php echo ucwords($row->status); ?></td>
                    <td class="pull-right">
                      <button class="btn btn-info btn-xs item_edit" data-toggle="modal" data-target="#Modal_Edit" data-id="<?php echo encode_url($row->id); ?>" data-name="<?php echo $row->item; ?>" data-status="<?php echo $row->status; ?>">Edit</button>
                      &nbsp;
                      <button class="btn btn-danger btn-xs item_delete" data-toggle="modal" data-target="#Modal_Delete" data-id="<?php echo encode_url($row->id); ?>">Delete</button>
                    </td>
                  </tr>
                <?php $serial_no++; } ?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
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
          <h5 class="modal-title" id="exampleModalLabel">Add New Items</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group ">
              <label class="col-md-2 col-form-label">Item Name:-</label>
              <div class="col-md-10">
                <input type="text" name="item_name" id="item_name" class="form-control" placeholder="Item Name Here">
                <div class="alert" id="error"></div>
              </div>
            </div>
            <div class="form-group ">
              <label class="col-md-2 col-form-label">Active</label>
              <div class="col-md-10">
                <label for="enable">
                  Yes:-
                  <input type="radio" name="status" value="yes">
                </label>
                <label for="disable">
                  No:-
                  <input type="radio" name="status" value="no">
                </label>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="item_id" value="" />
          <div class="row">
            <div class="form-group ">
              <label class="col-md-2 col-form-label" for="store_name_edit">Item Name:-</label>
              <div class="col-md-10">
                <input type="text" name="item_name" id="item_name_edit" class="form-control" placeholder="Item Name Here">
                <div class="alert" id="error"></div>
              </div>
            </div>

            <div class="form-group ">
              <label class="col-md-2 col-form-label">Active</label>
              <div class="col-md-10">
                <label for="enable">
                  Yes:-
                  <input type="radio" name="status" id="yes" value="yes">
                  No:-
                  <input type="radio" name="status" id="no" value="no">
                </label>
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
      var item_name = $('#item_name').val();
      var status = $('[name="status"]').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/ajax/saveitem') ?>",
        dataType: "JSON",
        data: {
          item_name,
          status
        },
        success: function(data) {
          if (data === true) {
            $('[name="item_name"]').val("");
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
    $(".item_edit").click(function(e) {
      e.preventDefault();
      var name = $(this).data('name');
      var status = $(this).data('status');
      var id = $(this).data('id');
      $('#item_name_edit').val(name);
      $('#item_id').val(id);
      if (status == "yes") {
        $("#yes").iCheck('check');
      } else {
        $("#no").iCheck('check');
      }
    });

    //update record to database
    $('#btn_update').on('click', function() {
      var item_name = $('#item_name_edit').val();
      var id = $('#item_id').val();
      var status = $('[name="status"]').is(":checked");
      console.log(status);
      return false;
      if (status == true) {
        status = 'yes';
      } else {
        status = 'no';
      }
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/ajax/item_update') ?>",
        dataType: "JSON",
        data: {
          id,
          item_name,
          status
        },
        success: function(data) {
          $('[name="item_name_edit"]').val("");
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
        url: "<?php echo base_url('admin/ajax/item_delete') ?>",
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