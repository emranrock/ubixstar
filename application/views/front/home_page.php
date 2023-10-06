<?php include('includes/top_header.php'); ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Recipes List</h2>
                <ol>
                    <li><a href="<?= base_url(); ?>">Home</a></li>
                </ol>
            </div>

        </div>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
        <div class="container">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi, quas illo! Nemo inventore nulla adipisci fugit aut quae. Odio ipsa totam nostrum voluptates deserunt unde laboriosam quaerat necessitatibus iure rem.</p>
            <form method="post" action="" id="searchFrm">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">keywords</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" name="search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>


        </div>

        <div class="row">

            <div class="col-md-4">
                <div class="input-group mb-3">
                    <select class="form-select" aria-label="Default select example" id="category_filter" name="cate_filter">
                        <option value="" selected>Filter Recipe By Category</option>
                        <?php foreach ($category as $key => $value) { ?>
                            <option value="<?= $value->cat_id ?>"><?= $value->title ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3 ">
                    <select class="form-select" aria-label="Default select example" id="tag_filter" name="tag_filter">
                        <option value="" selected>Filter Recipe By Tags</option>
                        <?php foreach ($recipes as $kk => $val) { ?>
                            <option value="<?= $val->tag ?>"><?= ucfirst($val->tag) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div id="recipe_list"></div>
        </div>
    </section>

</main><!-- End #main -->