<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Pricing extends My_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['pageTitle'] = 'Team-Focus : Add Pricing Plans';
        if (isset($_POST['submit'])) {
            //var_dump($_POST);exit;

            extract($_POST);

            $this->form_validation->set_rules('title', 'Please Enter Title', 'trim|required');
            $this->form_validation->set_rules('amount', 'Please Enter Amount', 'trim|required');
            $this->form_validation->set_rules('duration', 'Please Enter Duration', 'trim|required');
            $this->form_validation->set_rules('btn_text', 'Please Enter Button Text', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $var = $duration_number.' '.$duration;
                $userInfo = array(
                    'title' => $title,
                    'icon' => 'n/a',
                    'amount' => $amount,
                    'duration' => $var,
                    'btn_text' => $btn_text,
                    'features' => $features,
                    'active' => $active,
                    'status' => $status,
                );

                $result = $this->global_model->insert('plans', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New plans  Created Successfully');
                    redirect('admin/pricing/manage');
                } else {
                    $this->session->set_flashdata('error', 'plans creation failed');
                    redirect('admin/pricing');
                }
            }
        }
        $data['middle'] = 'pricing/add';
        $this->load->view('admin/template', $data);
    }

    public function manage()
    {
        $data['pageTitle'] = 'Team-Focus : Show Pricing';
        $qry = $this->global_model->customeQuery('select * from plans');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'pricing/manage';
        $this->load->view('admin/template', $data);
    }

    public function edit($id = null)
    {
        $data['pageTitle'] = 'Team-Focus : Edit About';
        $new_id = $id;
        if ($id == null) {
            if (isset($_POST['edit'])) {
                extract($_POST);
                $new_id = $id;
                $this->form_validation->set_rules('title', 'Please Enter Title', 'trim|required');
                $this->form_validation->set_rules('amount', 'Please Enter Amount', 'trim|required');
                $this->form_validation->set_rules('duration', 'Please Enter Duration', 'trim|required');
                $this->form_validation->set_rules('btn_text', 'Please Enter Button Text', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $this->manage();
                } else {
                    $var = $duration_number . ' ' . $duration;
                    $userInfo = array(
                        'title' => $title,
                        'icon' => 'n/a',
                        'amount' => $amount,
                        'duration' => $var,
                        'btn_text' => $btn_text,
                        'features' => $features,
                        'active' => $active,
                        'status' => $status,
                    );

                    //$result = $this->global_model->insert('plans', $userInfo);
                    $result = $this->global_model->update('plans',$userInfo,'id',$new_id);
                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'New plans  Created Successfully');
                        redirect('admin/pricing/manage');
                    } else {
                        $this->session->set_flashdata('error', 'plans creation failed');
                        redirect('admin/pricing');
                    }
                }
            }
        } else {
            $qry = $this->global_model->customeQuery("select * from plans where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'pricing/edit';
            $this->load->view('admin/template', $data);
        }
    }

    public function delete()
    {
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('plans', 'id', $new_id);
        if ($result > 0) {
            echo true;
        } else {
            echo false;
        }
    }


    public function resizeImage($filename)
    {

        $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/front/aboutus/' . $filename;
        $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/front/aboutus/resized/';
        //var_dump( $source_path);exit;
        $config_manip = array(
            //'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'width' => 1500,
            'height' => 840,
        );
        $this->load->library('image_lib');
        // Set your config up
        $this->image_lib->initialize($config_manip);
        // Do your manipulation
        $this->image_lib->clear();
    }
}
