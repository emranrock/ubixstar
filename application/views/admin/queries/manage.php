<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Queries List
            <small>Add, Edit, Delete</small>
        </h1>

    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
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
                    <div class="col-md-6">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
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
                                    <th>Full Names</th>
                                    <th>Emails</th>
                                    <th>Subjects</th>
                                    <th>Messages</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    $sr=1;
                    if(!empty($userRecords))
                    {
                      
                        foreach($userRecords as $record)
                        {

                    ?>
                                <tr>
                                    <td><?php echo $sr; ?></td>
                                    <td><?php echo $record->full_name; ?></td>
                                    <td><?php echo $record->email; ?></td>
                                    <td><?php echo $record->subject; ?></td>
                                    <td><?php echo $record->message; ?></td>
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
    $("#timeTable").dataTable({
    
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true

    });
});
</script>