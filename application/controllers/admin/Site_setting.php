<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Site_setting extends My_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('global_model');
        $this->load->helper('security');
    }

    public function index()
    {
        $data['pageTitle'] = 'Team-Focus : Add Site Settings';
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Site Title', 'required');
            $this->form_validation->set_rules('number', 'Site Contact Number', 'required');
            $this->form_validation->set_rules('email', 'Site Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                
                extract($_POST);
                $arr = array();
                foreach ($social_links as $key => $value) {
                    foreach ($value as $k => $v) {
                        $arr[$k] = $v;
                    }
                }
                $obj = json_encode($arr);
                $userInfo = array(
                    'name' => $name,
                    'number' => $number,
                    'email' => $email,
                    'address' => $address,
                    'social_links' => $obj,
                );
                $result = $this->global_model->insert('site_setting', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Site created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Site creation failed');
                }
                redirect('admin/site_setting');
            }
        } else {
            $data['middle'] = 'site/add';
            $this->load->view('admin/template', $data);
        }
    }

    public function show()
    {
        $data['pageTitle'] = 'Team-Focus : Manage Site';
        $qry = $this->global_model->customeQuery('select * from site_setting');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'site/manage';
        $this->load->view('admin/template', $data);
    }

    public function edit($rid = null)
    {
        $data['pageTitle'] = 'Team-Focus : Edit Site';
        if (isset($_POST['update'])) {

            $this->form_validation->set_rules('name', 'Site Title', 'required');
            $this->form_validation->set_rules('number', 'Site Contact Number', 'required');
            $this->form_validation->set_rules('email', 'Site Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->show();
            } else {
                extract($_POST);
                $arr = array();
                foreach ($social_links as $key => $value) {
                    foreach ($value as $k => $v) {
                        $arr[$k] = $v;
                    }
                }
                $userInfo = array(
                    'name' => $name,
                    'number' => $number,
                    'email' => $this->input->post('email', TRUE),
                    'address' =>$this->input->post('address', TRUE),
                    'social_links' => json_encode($arr),
                );
                $result = $this->global_model->update('site_setting', $userInfo, 'id', $id);
                if ($result) {
                    $this->session->set_flashdata('success', 'Site Updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Site Updated failed');
                }
                redirect('admin/site_setting/show');
            }
        } else {
            $qry = $this->global_model->customeQuery("select * from site_setting where id=$rid");
            $data['records'] = $qry->result();
            $data['middle'] = 'site/edit';
            $this->load->view('admin/template', $data);
        }
    }


    public function delete()
    {
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('site_setting', 'site_id', $new_id);
        if ($result > 0) {
            echo true;
        } else {
            echo false;
        }
    }

    // home items settings

    public function home_page()
    {
        if (isset($_POST['home_page_settings'])) {
            extract($_POST);
            $new_arr = array();
            foreach ($option as $key => $value) {

                foreach ($value as $k => $v) {

                    $new_arr[$key][$k] = $v;
                }
            }
            $obj = json_encode($new_arr);
            $userInfo = array(
                'option_value' => $obj,
            );
            if ($id > 0) {
                $result = $this->global_model->update('options', $userInfo, 'id', $id);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Site Options Updating successfully');
                } else {
                    $this->session->set_flashdata('error', 'Site Option Updating Failed');
                }
            } else {
                $result = $this->global_model->insert('options', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Site Options Created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Site Option Creation Failed');
                }
            }
            redirect('admin/site_setting/home_page');
        } else {
            $res = $this->global_model->customeQuery('select id,option_value from options where option_name="home_page"');
            foreach($res->result() as $result){
                $data['ids'] = $result->id;
                $data['options'] = $result->option_value;
            }
            $data['pageTitle'] = 'Home Page Setting';
            $data['middle'] = 'site/homepage';
            $this->load->view('admin/template', $data);
        }
    }
    // about items settings

    public function about_page()
    {
        if (isset($_POST['about_page_settings'])) {
            extract($_POST);
            $new_arr = array();
            foreach ($option as $key => $value) {

                foreach ($value as $k => $v) {

                    $new_arr[$key][$k] = $v;
                }
            }
            $obj = json_encode($new_arr);
            $userInfo = array(
                'option_value' => $obj,
            );
            if ($id > 0) {
                $result = $this->global_model->update('options', $userInfo, 'id', $id);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'about Options Updating successfully');
                } else {
                    $this->session->set_flashdata('error', 'about Option Updating Failed');
                }
            } else {
                $result = $this->global_model->insert('options', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'about Options Created successfully');
                } else {
                    $this->session->set_flashdata('error', 'about Option Creation Failed');
                }
            }

            redirect('admin/site_setting/about_page');
        } else {
            $res = $this->global_model->customeQuery('select id,option_value from options where option_name="about_page"');
            foreach($res->result() as $result){
                $data['ids'] = $result->id;
                $data['options'] = $result->option_value;
            }
            $data['pageTitle'] = 'About Page Setting';
            $data['middle'] = 'site/aboutpage';
            $this->load->view('admin/template', $data);
        }
    }

    public function service_page()
    {
        if (isset($_POST['services_page_settings'])) {
            extract($_POST);
            $new_arr = array();
            foreach ($option as $key => $value) {

                foreach ($value as $k => $v) {

                    $new_arr[$key][$k] = $v;
                }
            }
            $obj = json_encode($new_arr);
            $userInfo = array(
                'option_value' => $obj,
            );
            if ($id > 0) {
                $result = $this->global_model->update('options', $userInfo, 'id', $id);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'services Options Updating successfully');
                } else {
                    $this->session->set_flashdata('error', 'services Option Updating Failed');
                }
            } else {
                $result = $this->global_model->insert('options', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'services Options Created successfully');
                } else {
                    $this->session->set_flashdata('error', 'services Option Creation Failed');
                }
            }
            redirect('admin/site_setting/service_page');
        } else {
            $res = $this->global_model->customeQuery('select id,option_value from options where option_name="services_page"');
            foreach($res->result() as $result){
                $data['ids'] = $result->id;
                $data['options'] = $result->option_value;
            }
            $data['pageTitle'] = 'Services Page Setting';
            $data['middle'] = 'site/services_page';
            $this->load->view('admin/template', $data);
        }
    }

    public function contact_page()
    {
        if (isset($_POST['contact_page_settings'])) {
            extract($_POST);
            $new_arr = array();
            foreach ($option as $key => $value) {

                foreach ($value as $k => $v) {

                    $new_arr[$key][$k] = $v;
                }
            }
            $obj = json_encode($new_arr);
            $userInfo = array(
                'option_value' => $obj,
            );
            if ($id > 0) {
                $result = $this->global_model->update('options', $userInfo, 'id', $id);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Contact Options Updating successfully');
                } else {
                    $this->session->set_flashdata('error', 'Contact Option Updating Failed');
                }
            } else {
                $result = $this->global_model->insert('options', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Contact Options Created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Contact Option Creation Failed');
                }
            }
            redirect('admin/site_setting/contact_page');
        } else {
            $res = $this->global_model->customeQuery('select id,option_value from options where option_name="contact_page"');
            foreach($res->result() as $result){
                $data['ids'] = $result->id;
                $data['options'] = $result->option_value;
            }
            $data['pageTitle'] = 'Contact Page Setting';
            $data['middle'] = 'site/contact_page';
            $this->load->view('admin/template', $data);
        }
    }
}
