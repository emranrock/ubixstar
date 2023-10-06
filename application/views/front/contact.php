<?php include('includes/top_header.php'); 
  if(isset($options['contact_page'])){
    foreach ($options['contact_page'] as $key => $value) {
        if($value == 'active'){
            $this->load->view('front/partials/'.$key,$general_setting);
        }
    }
}
?>

