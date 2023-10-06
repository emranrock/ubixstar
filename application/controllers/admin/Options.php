<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Options extends My_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('global_model');
    }

    public function index()
    {
        $data['pageTitle'] = 'Add  Options';
        if (isset($_POST['options'])) {
            extract($_POST);
            $this->form_validation->set_rules('option_name', 'Option Name Required', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $final_arr = array();
                if(!empty($option_name) && isset($option)){
                    if($option_name == "Colors"){
                        $final_arr = array_combine($option['color']['name'], $option['color']['hex']);
                    }else{
                        foreach ($option as $val) {
                            if(!empty($val)){
                             $final_arr[] = $val;
                            }
                         }
                    }
                    $userInfo = array(
                        'option_name' => $option_name,
                        'option_values' => json_encode($final_arr),
                        'status' => $status
                    );
                    $result = $this->global_model->insert('front_options', $userInfo);
                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'Options Added successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Options Insertion failed');
                    }
                    redirect('admin/options/manage');
                }
            }
        }
        $data['middle'] = 'options/add';
        $this->load->view('admin/template', $data);
    }

    public function manage()
    {
        $data['pageTitle'] = 'Manage options';
         // Turn caching on 
         $this->db->cache_on();
        $qry = $this->global_model->customeQuery('select * from front_options');
         // Turn caching off 
         $this->db->cache_off();
        $data['options'] = $qry->result();
        $data['middle'] = 'options/manage';
        $this->load->view('admin/template', $data);
    }

    public function edit($id = null)
    {
        
        $data['pageTitle'] = 'Edit options';
        extract($_POST);
        $new_id = decode_url($id);
        if (isset($_POST['update'])) {
            $this->form_validation->set_rules('options_name', 'Full Name Required', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->edit();
            } else {
                if($option_name == "Colors"){
                    $final_arr = array_combine($option['color']['name'], $option['color']['hex']);
                }else{
                    foreach ($option as $val) {
                        if(!empty($val)){
                         $final_arr[] = $val;
                        }
                     }
                }
                $userInfo = array(
                    'option_name' => $options_name,
                    'option_values' => json_encode($final_arr),
                    'status' => $status
                );
                $result = $this->global_model->update('front_options', $userInfo, 'id', $new_id);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Options Updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Options Updating failed');
                }
                redirect('admin/options/manage');
            }
        } else {
            $qry = $this->global_model->customeQuery("select * from front_options where id=$new_id");
            $data['options'] = $qry->result();
            $data['middle'] = 'options/edit';
            $this->load->view('admin/template', $data);
        }
    }

    public function delete()
    {
        extract($_POST);
         $new_id = decode_url($id);
        $result = $this->global_model->delete('front_options', 'id', $new_id);
        $response;
        if ($result) {
            $response = true;
        } else {
            $response = false;
        }
        header('Content-type: application/json');
        ob_start('ob_gzhandler');
        echo json_encode($response);
        ob_end_flush();
    }
}
