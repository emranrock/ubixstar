<?php if (isset($general_setting) && !empty($general_setting)) {
    $company = "GET Way";
    $tel = "+123456789";
    $address = "123 Street, New York, USA";
    $email = "info@example.com";
    $social_links = array("facebook" => "#", "google" => "#", "twitter" => "#", "instagram" => "#");
    if ($general_setting->num_rows() > 0) {
        foreach ($general_setting->result() as $key => $value) {
            $company = $value->name;
            $tel = $value->number;
            $address = $value->address;
            $email = $value->email;
            $social_links = json_decode($value->social_links, true);
        }
    }
    $brand = explode(" ", $company);
} ?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="<?= base_url(); ?>" class="logo d-flex align-items-center me-auto me-lg-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1><?= $company ?></h1>
        </a>


        <a class="btn-book-a-table" href="<?= base_url('admin') ?>">Login</a>

    </div>
</header><!-- End Header -->