<?php if(isset($options)){
    $data = json_decode($options,true);
    //var_dump($data);
}
?>
<div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Services Settings
        <small>:)</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Services</h3>
          
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        
        <form action="<?php echo base_url('admin/services');?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
            <div class="col-md-8">
            <div class="form-group">
                <label class="form-label">Icon</label>
                <input type="text" name="icons" class="form-control" value="">
               <p class="help-block">Front End Using flaticon.css So You Can Find Icons At :- <a href="https://www.flaticon.com/free-icons/free" target="_blank">Here</a></p>
            </div>
            
            <div class="form-group">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="">
               <p class="help-block">Title Limit is 150 Characters</p>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
               <textarea name="dscription" class="form-control editors"  rows="10"></textarea>
               <!-- <p class="help-block">Message Limit is 150 Characters</p> -->
            </div>

                      
            </div><!--  close col-md-8 -->
            <div class="col-md-4">
            <div class="box box-primary">
                    <div class="box-header">
                    <h3 class="box-title">Submit All Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>
                            Active
                            <input type="radio" name="status" value="active" <?php //if($data['galley'] == 'active'){ echo 'checked'; }?>>
                            </label>
                            &nbsp;&nbsp;&nbsp;
                            <label>
                            In-Active
                            <input type="radio" name="status" value="in-active" <?php //if($data['galley'] == '' || $data['galley'] == 'in-active'){ echo 'checked'; }?> >
                            </label>
                        </div>
                  
                        <input type="submit" class="btn btn-primary btn-sm " name="services" value="Submit"/>
                        <br/><br/>
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
                    <div class="col-md-4">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
                    
                    </div>  
                    <!-- /.box-body -->
                </div>
                </form>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          ...
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <script>
  $(document).ready(function(){

      $("#icons").select2({
        templateResult: formatState
    });
  });

  function formatState (state) {
  if (!state.id) { return state.text; 
  }
  //console.log(state.element.value);
  //console.log(state.element.text);
  var $state = $(
                                                    
      '<span> <i class="'+state.element.value.toLowerCase()+'"></i> '+state.element.text.toLowerCase()+'</span>'
    
 );
 return $state;
};
  </script>