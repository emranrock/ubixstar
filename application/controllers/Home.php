<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');
	}

	public function index()
	{
		$data['pageTitle'] = "Home";
		$data['content'] = "home_page";

		/** general Setting */
		$general_setting = $this->global_model->customeQuery('select * from site_setting');
		$data['general_setting'] = $general_setting;
		$sql = "select tag from recipe";
		$recipes = $this->global_model->customeQuery($sql);
		$data['recipes'] = $recipes->result();
		$category_qry = $this->global_model->customeQuery('select * from recipe_category');
		$data['category'] = $category_qry->result();

		$this->load->view('front/home', $data);
	}


	public function list()
	{

		extract($_POST);
		if (!empty($search)) {
			$sql = "select recipe.*,recipe_category.title as cat_name,recipe_ingredients.name from recipe 
			INNER JOIN recipe_category ON recipe_category.cat_id = recipe.category_id
			INNER JOIN recipe_ingredients ON recipe_ingredients.id = recipe.ingredients where  recipe.title LIKE '%$search%' OR recipe_ingredients.name LIKE '%$search%'; ";
		} else if (!empty($filter_cat)) {
			$sql = "select recipe.*,recipe_category.title as cat_name,recipe_ingredients.name from recipe 
			INNER JOIN recipe_category ON recipe_category.cat_id = recipe.category_id
			INNER JOIN recipe_ingredients ON recipe_ingredients.id = recipe.ingredients where  recipe_category.cat_id = $filter_cat; ";
		} else if (!empty($filter_tag)) {
			$sql = "select recipe.*,recipe_category.title as cat_name,recipe_ingredients.name from recipe 
			INNER JOIN recipe_category ON recipe_category.cat_id = recipe.category_id
			INNER JOIN recipe_ingredients ON recipe_ingredients.id = recipe.ingredients where  recipe.tag LIKE '%$filter_tag%'; ";
		} else {
			$sql = "select recipe.*,recipe_category.title as cat_name,recipe_ingredients.name from recipe 
			INNER JOIN recipe_category ON recipe_category.cat_id = recipe.category_id
			INNER JOIN recipe_ingredients ON recipe_ingredients.id = recipe.ingredients; ";
		}
		$recipes = $this->global_model->customeQuery($sql);
		if ($recipes->num_rows() > 0) {
			$output = '<div class="row">';
			foreach ($recipes->result() as $key => $value) {
				$output .= '<div class="col-md-4 ">
					<div class="card" style="width: auto;">
						<div class="card-body">
							<h5 class="card-title">' . ucfirst($value->title) . '</h5>
							<h6 class="card-subtitle mb-3 text-muted small">' . ucfirst($value->tag) . '</h6>
							<p class="card-text">' . ucfirst($value->description) . '</p>
							<a href="#" class="card-link">' . $value->cat_name . '</a>
							<a href="#" class="card-link">' . $value->name . '</a>
						</div>
					</div>
				</div>';
			}
			$output .= '</div>';
		} else {
			$output = 'No Result Found';
		}
		echo $output;
	}
}
