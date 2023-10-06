<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Slider extends My_Controller
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
        $data['pageTitle'] = 'Team-Focus : Add Slide';
        if (isset($_POST['slider'])) {
            // var_dump($_POST);exit;
            extract($_POST);

            $this->form_validation->set_rules('title', 'Slide Title', 'trim|required');
            $this->form_validation->set_rules('sub_title', 'Slide Sub Title Type', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $config['upload_path']   = APPPATH . '../uploads/front/slider/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size']      = 950;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/slider/');
                } else {
                    $uploadedImage = $this->upload->data();
                    $photo = $uploadedImage['file_name'];

                    $config_manip = array(
                        'image_library' => 'gd2',
                        'source_image' => $uploadedImage['full_path'],
                        //'new_image' => $target_path,
                        'maintain_ratio' => TRUE,
                        'width' => 1500,
                        'height' => 840,
                    );
                    $this->load->library('image_lib', $config_manip);
                    if (!$this->image_lib->resize()) {
                        $this->session->set_flashdata('error', $this->image_lib->display_errors());
                    }
                    $this->image_lib->clear();

                    $userInfo = array(
                        'title' => $title,
                        'sub_title' => $sub_title,
                        'image' => $photo,
                        'status' => $status,
                    );
                    $result = $this->global_model->insert('slider', $userInfo);
                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'New Slider created successfully');
                        redirect('admin/slider/manage');
                    } else {
                        $this->session->set_flashdata('error', 'Slider creation failed');
                        redirect('admin/slider');
                    }
                }
            }
        } else {

            $data['middle'] = 'slider/add';
            $this->load->view('admin/template', $data);
        }
    }

    public function manage()
    {
        $data['pageTitle'] = 'Team-Focus : Show Slider';
        $qry = $this->global_model->customeQuery('select * from slider');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'slider/manage';
        $this->load->view('admin/template', $data);
    }

    public function edit($id = null)
    {
        $data['pageTitle'] = 'Team-Focus : Edit Slider';

        $new_id = $id;
        if ($id == null) {
            if (isset($_POST['edit'])) {
                extract($_POST);
                $new_id = $id;
                $this->form_validation->set_rules('title', 'Slide Title', 'trim|required');
                $this->form_validation->set_rules('sub_title', 'Slide Sub Title Type', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    $this->manage();
                } else {
                    $config['upload_path']   = APPPATH . '../uploads/front/slider/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['max_size']      = 950;
                    $this->load->library('upload', $config);
                    if (!empty($_FILES)) {
                        if (!$this->upload->do_upload('image')) {
                            $this->session->set_flashdata('error', $this->upload->display_errors());
                            //var_dump($this->upload->display_errors());
                        } else {
                            $uploadedImage = $this->upload->data();
                            $photo = $uploadedImage['file_name'];
                        }
                        $config_manip = array(
                            'image_library' => 'gd2',
                            'source_image' => $uploadedImage['full_path'],
                            //'new_image' => $target_path,
                            'maintain_ratio' => TRUE,
                            'width' => 1500,
                            'height' => 840,
                        );
                        $this->load->library('image_lib', $config_manip);
                        if (!$this->image_lib->resize()) {
                            $this->session->set_flashdata('error', $this->image_lib->display_errors());
                        }
                        $this->image_lib->clear();
                        $userInfo = array(
                            'title' => $title,
                            'sub_title' => $sub_title,
                            'image' => $photo,
                            'status' => $status,
                        );
                    } else {
                        $userInfo = array(
                            'title' => $title,
                            'sub_title' => $sub_title,
                            'image' => $image,
                            'status' => $status,
                        );
                    }
                    $result = $this->global_model->update('slider', $userInfo, 'id', $new_id);
                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'New Slider Updation successfully');
                        redirect('admin/slider/manage');
                    } else {
                        $this->session->set_flashdata('error', 'Slider Updation Failed');
                        redirect('admin/slider/manage');
                    }
                }
            }
        } else {
            $qry = $this->global_model->customeQuery("select * from slider where id='$new_id'");
            $data['records'] = $qry->result();

            $data['middle'] = 'slider/edit';
            $this->load->view('admin/template', $data);
        }
    }

    public function delete()
    {
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('slider', 'id', $new_id);
        if ($result > 0) {
            echo true;
        } else {
            echo false;
        }
    }


    public function resizeImage($filename)
    {

        $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/front/slider/' . $filename;
        $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/front/slider/resized/';
        var_dump($source_path);
        exit;
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
        $this->image_lib->initialize($config);
        // Do your manipulation
        $this->image_lib->clear();
    }
}
