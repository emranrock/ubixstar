<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Ingredient extends My_Controller
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
            $this->form_validation->set_rules('name', 'Please Enter Ingredient Name', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $userInfo = array(
                    'name' => $name
                );
                $result = $this->global_model->insert('recipe_ingredients', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Recipe Ingredients Added successfully');
                    redirect('admin/ingredient/manage');
                } else {
                    $this->session->set_flashdata('error', 'Recipe Ingredients creation failed');
                    redirect('admin/ingredient');
                }
            }
        }
        $data['pageTitle'] = 'Team-Focus : Add Ingredient';
        $data['middle'] = 'ingredient/add';
        $this->load->view('admin/template', $data);
    }

    public function manage()
    {
        $data['pageTitle'] = 'Team-Focus : Show Recipe Ingredient';
        $qry = $this->global_model->customeQuery('select * from recipe_ingredients');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'ingredient/manage';
        $this->load->view('admin/template', $data);
    }

    public function edit($id = null)
    {

        if ($id == null) {
            if (isset($_POST['edit'])) {
                extract($_POST);
                $new_id = $id;
                $this->form_validation->set_rules('name', 'Please Enter ingredient', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $this->manage();
                } else {
                    $userInfo = array(
                        'name' => $name
                    );
                    $result = $this->global_model->update('recipe_ingredients', $userInfo, 'id', $new_id);
                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'Recipe Ingredient Updation successfully');
                        redirect('admin/ingredient/manage');
                    } else {
                        $this->session->set_flashdata('error', 'Recipe Ingredient Updation Failed');
                        redirect('admin/ingredient/manage');
                    }
                }
            }
        } else {
            $data['pageTitle'] = 'Team-Focus : Edit Recipe Ingredient';
            $qry = $this->global_model->customeQuery("select * from recipe_ingredients where id='$id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'ingredient/edit';
            $this->load->view('admin/template', $data);
        }
    }

    public function delete()
    {
        extract($_POST);
        $new_id = $id; //decode_url($id);
        $result = $this->global_model->delete('recipe_ingredients', 'id', $new_id);
        if ($result > 0) {
            echo true;
        } else {
            echo false;
        }
    }
}
