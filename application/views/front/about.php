<?php include('includes/top_header.php'); 
  if(isset($options['about_page'])){
    foreach ($options['about_page'] as $key => $value) {
        if($value === 'active'){
            $this->load->view('front/partials/'.$key);
            // include('partials/'.$key.'.php');
        }
    }
}
?>

