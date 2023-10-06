<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Recipe extends My_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('global_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        if (isset($_POST['submit'])) {

            extract($_POST);
            $this->form_validation->set_rules('title', 'Please Enter Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Please Enter description', 'trim|required');
            $this->form_validation->set_rules('instructions', 'Please Enter instructions', 'trim|required');
            $this->form_validation->set_rules('ingredients', 'Please Select ingredients', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Please Select category', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $userInfo = array(
                    'title' => $title,
                    'description' => $description,
                    'instructions' => $instructions,
                    'ingredients' => $ingredients,
                    'category_id' => $category_id,
                    'tag' => $tag,
                );
                $result = $this->global_model->insert('recipe', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Recipe Added successfully');
                    redirect('admin/recipe/manage');
                } else {
                    $this->session->set_flashdata('error', 'Recipe creation failed');
                    redirect('admin/recipe');
                }
            }
        }
        $data['pageTitle'] = 'Team-Focus : Add Recipe';
        $data['middle'] = 'recipe/add';
        $category_qry = $this->global_model->customeQuery('select * from recipe_category');
        $data['category'] = $category_qry->result();

        $ingredients_qry = $this->global_model->customeQuery('select * from recipe_ingredients');
        $data['ingredients'] = $ingredients_qry->result();

        $this->load->view('admin/template', $data);
    }

    public function manage()
    {
        $data['pageTitle'] = 'Team-Focus : Show Recipe';
        $sql = "select recipe.*,recipe_category.title as cat_name,recipe_ingredients.name from recipe 
        INNER JOIN recipe_category ON recipe_category.cat_id = recipe.category_id
        INNER JOIN recipe_ingredients ON recipe_ingredients.id = recipe.ingredients; ";
        $qry = $this->global_model->customeQuery($sql);
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'recipe/manage';
        $this->load->view('admin/template', $data);
    }

    public function edit($id = null)
    {

        $new_id = $id;
        if ($id == null) {
            if (isset($_POST['edit'])) {
                extract($_POST);
                $new_id = $id;
                $this->form_validation->set_rules('title', 'Please Enter Title', 'trim|required');
                $this->form_validation->set_rules('description', 'Please Enter description', 'trim|required');
                $this->form_validation->set_rules('instructions', 'Please Enter instructions', 'trim|required');
                $this->form_validation->set_rules('ingredients', 'Please Select ingredients', 'trim|required');
                $this->form_validation->set_rules('category_id', 'Please Select category', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $this->manage();
                } else {

                    $userInfo = array(
                        'title' => $title,
                        'description' => $description,
                        'instructions' => $instructions,
                        'ingredients' => $ingredients,
                        'category_id' => $category_id,
                        'tag' => $tag,
                    );
                    $result = $this->global_model->update('recipe', $userInfo, 'id', $new_id);
                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'New Recipe Updation successfully');
                        redirect('admin/recipe/manage');
                    } else {
                        $this->session->set_flashdata('error', 'recipe Updation Failed');
                        redirect('admin/recipe/manage');
                    }
                }
            }
        } else {
            $data['pageTitle'] = 'Team-Focus : Edit Recipe';
            $qry = $this->global_model->customeQuery("select * from recipe where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'recipe/edit';
            $category_qry = $this->global_model->customeQuery('select * from recipe_category');
            $data['category'] = $category_qry->result();

            $ingredients_qry = $this->global_model->customeQuery('select * from recipe_ingredients');
            $data['ingredients'] = $ingredients_qry->result();
            $this->load->view('admin/template', $data);
        }
    }

    public function delete()
    {
        extract($_POST);
        $new_id = $id;
        $result = $this->global_model->delete('recipe', 'id', $new_id);
        if ($result > 0) {
            echo true;
        } else {
            echo false;
        }
    }
}
