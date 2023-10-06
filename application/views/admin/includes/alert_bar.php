 <?php
    $error = $this->session->flashdata('error');
    if ($error) {
    ?>
     <div class="alert alert-danger alert-dismissable">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <p>
             <?php
                if (gettype($error) == "array") {
                    foreach ($error as $key => $value) {
                        if (isset($value->errorMessage)) {
                            echo ucfirst($key) . ':- ' . $value->errorMessage . '<br/>';
                        } else {
                            if (isset($value->order_id) && !empty($value->order_id)) {
                                echo ucfirst($key) . ':- ' . $value->order_id[0] . '<br/>';
                            } else {
                                if(gettype($value) == "object" || gettype($value) == "array"){
                                    foreach($value as $k=>$v){
                                        echo  ucfirst($k) . ':- ' .  $v . '<br/>';
                                    }
                                }else{
                                    echo  ucfirst($key) . ':- ' .  $value . '<br/>';
                                }
                            }
                        }
                    }
                } else {
                    echo $error;
                }
                ?>
         </p>
     </div>
 <?php }
    $success = $this->session->flashdata('success');
    if ($success) {
    ?>
     <div class="alert alert-success alert-dismissable">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <?php echo $this->session->flashdata('success'); ?>
     </div>
 <?php } ?>