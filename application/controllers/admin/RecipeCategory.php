<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class RecipeCategory extends My_Controller
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
            $this->form_validation->set_rules('name', 'Please Enter Person Name', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $userInfo = array(
                    'title' => $name
                );
                $result = $this->global_model->insert('recipe_category', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Recipe Category Added successfully');
                    redirect('admin/recipeCategory/manage');
                } else {
                    $this->session->set_flashdata('error', 'Recipe Category creation failed');
                    redirect('admin/recipeCategory');
                }
            }
        }
        $data['pageTitle'] = 'Team-Focus : Add Category';
        $data['middle'] = 'recipe_category/add';
        $this->load->view('admin/template', $data);
    }

    public function manage()
    {
        $data['pageTitle'] = 'Team-Focus : Show Recipe Category';
        $qry = $this->global_model->customeQuery('select * from recipe_category');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'recipe_category/manage';
        $this->load->view('admin/template', $data);
    }

    public function edit($id = null)
    {

        if ($id == null) {
            if (isset($_POST['edit'])) {
                extract($_POST);
                $new_id = $id;
                $this->form_validation->set_rules('name', 'Please Enter Category', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $this->manage();
                } else {
                    $userInfo = array(
                        'title' => $name
                    );
                    $result = $this->global_model->update('recipe_category', $userInfo, 'cat_id', $new_id);
                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'Recipe Category Updation successfully');
                        redirect('admin/recipeCategory/manage');
                    } else {
                        $this->session->set_flashdata('error', 'Recipe Category Updation Failed');
                        redirect('admin/recipeCategory/manage');
                    }
                }
            }
        } else {
            $data['pageTitle'] = 'Team-Focus : Edit Recipe Category';
            $qry = $this->global_model->customeQuery("select * from recipe_category where cat_id='$id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'recipe_category/edit';
            $this->load->view('admin/template', $data);
        }
    }

    public function delete()
    {
        extract($_POST);
        $new_id = $id; //decode_url($id);
        $result = $this->global_model->delete('recipe_category', 'cat_id', $new_id);
        if ($result > 0) {
            echo true;
        } else {
            echo false;
        }
    }
}
