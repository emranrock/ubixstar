<?php include('includes/top_header.php'); 
  if(isset($options['services_page'])){
    foreach ($options['services_page'] as $key => $value) {
        if($value == 'active'){
            $this->load->view('front/partials/'.$key);
        }
    }
}
?>

