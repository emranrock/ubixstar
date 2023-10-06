<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="box-header">
      <h3>
        <i class="fa fa-users"></i> Barcodes List
        <small>Add, Edit, Delete</small>
        <div class="pull-right">
          <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a>
        </div>
      </h3>

    </div><!-- /.box-header -->

  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive no-padding">

            <table class="table table-striped" id="mydata">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Rack & Rows</th>
                  <th>Barcodes </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="class_action">
                <?php
                $serial_no = 1;
                foreach ($barcodes as $data) {

                ?>
                  <tr>
                    <td><?php echo $serial_no; ?></td>
                    <td><?php echo get_rack_name($data->rack_id); ?></td>
                    <td><?php echo $data->barcode; ?></td>
                    <td>
                      <button class="btn btn-primary btn-sm item_edit" data-toggle="modal" data-target="#Modal_edit" data-rack_id="<?php echo $data->rack_id; ?>" data-barcode="<?php echo $data->barcode; ?>" data-id="<?php echo $data->id; ?>"><span class="fa fa-plus"></span> &nbsp;Edit</button>

                      <button class="btn btn-danger btn-sm item_delete" data-toggle="modal" data-target="#Modal_Delete" data-id="<?php echo $data->id; ?>"><span class="fa fa-trash"></span>&nbsp;Delete</button>
                    </td>
                  </tr>
                <?php $serial_no++;
                } ?>
              </tbody>

            </table>
          </div><!-- /.box-body -->

        </div><!-- /.box -->
      </div>
    </div>

</div>
</section>

<!-- MODAL add -->
<form>
  <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Barcode</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="" />
          <div class="row">
            <div class="form-group ">
              <label class="col-md-2 col-form-label" for="rank">Select Rack:-</label>
              <div class="col-md-10">
                <select name="rack" id="rack" class="form-control">
                  <option value="0">Select Rack</option>
                  <?php
                  foreach ($racks as $rank) { ?>
                    <option value="<?= $rank->id; ?>"><?= $rank->title; ?></option>
                  <?php }
                  ?>
                </select>
              </div>
              <div class="alert"></div>
            </div>
            <div class="form-group ">
              <label class="col-md-2 col-form-label" for="rows">Enter Barcode:-</label>
              <div class="col-md-10">
                <input type="text" name="barcode" id="barcode" class="form-control" placeholder="barcode">
              </div>
              <div class="alert"></div>
            </div>

          </div>
          <div class="alert" id="error"></div>
        </div>
        <div class=" modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" type="submit" id="btn_add" class="btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!--END MODAL add-->

<!-- MODAL edit -->
<form>
  <div class="modal fade" id="Modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Barcode</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id_editable" value="" />
          <div class="row">
            <div class="form-group ">
              <label class="col-md-2 col-form-label" for="rack_editable">Select Rack:-</label>
              <div class="col-md-10">
                <select name="rack_editable" id="rack_editable" class="form-control">
                  <option value="0">Select Rack</option>
                  <?php
                  foreach ($racks as $rank) { ?>
                    <option value="<?= $rank->id; ?>"><?= $rank->title; ?></option>
                  <?php }
                  ?>
                </select>
              </div>
              <div class="alert"></div>
            </div>
            <div class="form-group ">
              <label class="col-md-2 col-form-label" for="barcode_editable">Enter Barcode:-</label>
              <div class="col-md-10">
                <input type="text" name="barcode_editable" id="barcode_editable" class="form-control" placeholder="barcode">
              </div>
              <div class="alert"></div>
            </div>
          </div>
          <div class="alert" id="error"></div>
        </div>
        <div class=" modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!--END MODAL edit-->
!--MODAL DELETE-->
<form>
  <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Barcode</h5>
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


    $("#btn_add").on('click', function(e) {
      e.preventDefault();
      var rack = $("#rack").val();
      var barcode = $("#barcode").val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/settings/add_barcode') ?>",
        dataType: "JSON",
        data: {
          rack: rack,
          barcode: barcode
        },
        success: function(data) {
          console.log(data);
          if (data === "Barcodes Added successfully") {
            var success = `<span class="alert-success">${data}</span>`;
            $("#error").html(success);
          } else {
            var error = `<span class="alert-danger">${data}</span>`;
            $("#error").html(error);
          }
          $("#Modal_Add").modal('hide');
        },
        error: function(e) {
          console.log(e);
        }
      });
    });

    //get data for update record
    $(document).on('click', ".item_edit", function(e) {
      e.preventDefault();
      var rank = $(this).data('rack_id');
      var barcode = $(this).data('barcode');
      var id = $(this).data('id');

      $('#rack_editable').val(rank);
      $('#barcode_editable').val(barcode);
      $('#id_editable').val(id);
    });

    //update record to database
    $('#btn_update').on('click', function() {
      var rack = $('#rack_editable').val();
      var barcode = $('#barcode_editable').val();
      var id = $('#id_editable').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/settings/update_barcode') ?>",
        dataType: "JSON",
        data: {
          id,
          rack,
          barcode
        },
        success: function(data) {
          $('[name="rack_editable"]').val("");
          $('[name="barcode_editable"]').val("");
          $('#Modal_Edit').modal('hide');
          location.reload();
        }
      });
      return false;
    });

    //get data for delete record
    $(document).on('click', ".item_delete", function() {
      var id = $(this).data('id');
      $('[name="item_id"]').val(id);
    });
    //delete record to database
    $('#btn_delete').on('click', function() {
      var item_id = $('[name="item_id"]').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/settings/delete_barcode') ?>",
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