<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends My_Controller
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

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $data['pageTitle'] = 'Team-Focus : Stores';
         // Turn caching on 
         $this->db->cache_on();
        $qry = $this->global_model->customeQuery('select * from stores order by id DESC');
         // Turn caching off 
         $this->db->cache_off();
        $data['store_list'] = $qry->result();
        $data['middle'] = 'settings/stores';
        $this->load->view('admin/template', $data);
    }

    public function general_setting()
    {
        if (isset($_POST['submit'])) {
            unset($_POST['submit']);
            extract($_POST);
            $this->form_validation->set_rules('site_name', 'Site Name Required', 'required');
            $this->form_validation->set_rules('email_address', 'Full Email Required', 'required');
            $this->form_validation->set_rules('contact_number', 'Full Contact Number Required', 'required');
            $this->form_validation->set_rules('address', 'Full address Required', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->general_setting();
            } else {
                $encoded_arr = json_encode($_POST);
                $data_ins = array(
                    'option_name' => 'site_setting',
                    'option_value' => $encoded_arr,
                );
                $result = $this->global_model->insert('options', $data_ins);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Site Settings Added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Site Settings Insertion failed');
                }
                redirect('admin/settings/general_setting');
            }
        }
        $qry = $this->global_model->customeQuery('select option_value from options where option_name="site_setting"');
        if (!empty($qry->result())) {
            $data['site_info'] = $qry->row()->option_value;
        }
        $data['pageTitle'] = 'General Settings';
        $data['middle'] = 'settings/general_setting';
        $this->load->view('admin/template', $data);
    }

    public function pre_booking_items()
    {
        $data['pageTitle'] = 'Team-Focus : Add Courier Partners';
         // Turn caching on 
         $this->db->cache_on();
        $qry = $this->global_model->customeQuery('select * from pre_booking_items order by id DESC');
         // Turn caching off 
         $this->db->cache_off();
        $data['items'] = $qry->result();
        $data['middle'] = 'settings/pre_booking';
        $this->load->view('admin/template', $data);
    }
    public function racks()
    {
        $data['pageTitle'] = 'Team-Focus : Add Rank';
         // Turn caching on 
         $this->db->cache_on();
        $qry = $this->global_model->customeQuery('select * from racks order by id DESC');
         // Turn caching off 
         $this->db->cache_off();
        $data['items'] = $qry->result();
        $data['middle'] = 'settings/racks';
        $this->load->view('admin/template', $data);
    }

    public function bulk()
    {
        /* Load form validation library*/
        $this->load->library('form_validation');
        /* Load file helper*/
        $this->load->helper('file');
        /*Get messages from the session*/
        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        $data['pageTitle'] = 'Team-Focus : Bulk Upload';
        $data['middle'] = 'settings/bulk';
        if (isset($_POST['importSubmit'])) {
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                /* Load CSV reader library */
                $this->load->library('readcsv_lib');
                /* Parse data from CSV file */
                $csvData = $this->readcsv_lib->parse_csv($_FILES['file']['tmp_name']);
                $filter_data = array();
                foreach ($csvData as $key => $value) {
                    /*$filter_data[] =  array_values($value);*/
                    foreach ($value as $kk => $vv) {
                        if ($key == 1) {
                            $filter_data[] = $kk;
                        }
                        $filter_data[] = $vv;
                    }
                }
                
                foreach ($filter_data as $kk => $vv) {
                    $rack_name = "";
                    $rack_val = "";
                    if (strpos($vv, "RACK") !== false) {
                        $rack_name = $vv;
                    } else {
                        $rack_val = $vv;
                    }
                    if (!empty($rack_name)) {
                        $id = add_and_retrieve_rack($rack_name);
                    }
                    if (!empty($rack_val)) {
                        $data_ins[] = array(
                            'rack_id' => $id,
                            'barcode' => $rack_val,
                        );
                    }
                }
                $result = $this->db->insert_batch('barcodes', $data_ins);
                if ($result > 0) {
                    $this->session->set_flashdata('success_msg', 'Barcodes Added successfully');
                } else {
                    $this->session->set_flashdata('error_msg', 'Barcodes Insertion failed');
                }
                redirect('admin/settings/bulk');
            }
        }
        $this->load->view('admin/template', $data);
    }

    public function file_check($str)
    {
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if (($ext == 'csv') && in_array($mime, $allowed_mime_types)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }

    public function add_barcode()
    {
        if ($this->input->is_ajax_request() == true) {
            $data_ins = array(
                'rack_id' => $_POST['rack'],
                'barcode' => $_POST['barcode'],
            );
             // Turn caching on 
            $this->db->cache_on();
            $result = $this->db->insert('barcodes', $data_ins);
             // Turn caching off 
            $this->db->cache_off();
            if ($result > 0) {
                $data =  'Bar codes Added successfully';
            } else {
                $data = 'Bar codes Insertion failed';
            }
            echo json_encode($data);
            exit;
        }
        $data['pageTitle'] = 'Team-Focus : Add Barcode to Racks';
         // Turn caching on 
         $this->db->cache_on();
        $qry = $this->global_model->customeQuery('select * from `barcodes`');
         // Turn caching off 
         $this->db->cache_off();
        $data['barcodes'] = $qry->result();
         // Turn caching on 
         $this->db->cache_on();
        $qry1 = $this->global_model->customeQuery('select * from `racks` order by id DESC');
         // Turn caching off 
         $this->db->cache_off();
        $data['racks'] = $qry1->result();

        $data['middle'] = 'settings/add_barcodes';
        $this->load->view('admin/template', $data);
    }

    public function update_barcode()
    {
        if ($this->input->is_ajax_request() == true) {
            $data_ins = array(
                'rack_id' => $_POST['rack'],
                'barcode' => $_POST['barcode'],
            );
            $result = $this->db->update('barcodes', $data_ins, 'id', $_POST['id']);

            if ($result > 0) {
                $data =  'Bar codes Update successfully';
            } else {
                $data = 'Bar codes Update failed';
            }
            echo json_encode($data);
            exit;
        }
    }
    public function delete_barcode()
    {
        if ($this->input->is_ajax_request() == true) {
            if (isset($_POST['id'])) {
                extract($_POST);
                $this->load->model('global_model');
                $new_id = $id;
                $qry = $this->global_model->delete("barcodes", 'id', $new_id);
                if ($qry > 0) {
                    $data = $qry;
                } else {
                    $data = 'Something Went Wrong !';
                }
                echo json_encode($data);
            }
        }
    }
    
    public function add_tags(){

        $is_option = get_option('tags');
        if (isset($_POST['add_tags'])) {
            $new_arr = [];
            foreach ($_POST as $key => $value) {
              if($key == "tags"){
               foreach ($value as $vv) {
                if(!empty($vv)){
                    $new_arr[] = $vv;
                }
               }
              }
            }
            $encoded_arr = json_encode($new_arr);

            $data_ins = array(
                'option_name' => 'tags',
                'option_value' => $encoded_arr,
            );
            if($is_option == false){
                $result = $this->global_model->insert('options', $data_ins);
            }else{
                $result = $this->global_model->update('options', $data_ins, 'option_name', 'tags');
            }
            if ($result > 0) {
                $this->session->set_flashdata('success_msg', 'Tag Added successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Tag Insertion failed');
            }
            redirect('admin/settings/add_tags');
        }
        if ($is_option == false) {
            $data['tags'] = null;
        } else {
            $data['tags'] = $is_option;
        }
        $data['pageTitle'] = 'Team-Focus : Add Tags';
        $data['middle'] = 'settings/add_tags';
        $this->load->view('admin/template', $data);
    }
    public function add_options(){

        $is_option = get_option('front_option');
        if (isset($_POST['add_option'])) {
            $new_arr = [];
            foreach ($_POST as $key => $value) {
              if($key == "tags"){
               foreach ($value as $vv) {
                if(!empty($vv)){
                    $new_arr[] = $vv;
                }
               }
              }
            }
            $encoded_arr = json_encode($new_arr);

            $data_ins = array(
                'option_name' => 'tags',
                'option_value' => $encoded_arr,
            );
            if($is_option == false){
                $result = $this->global_model->insert('options', $data_ins);
            }else{
                $result = $this->global_model->update('options', $data_ins, 'option_name', 'tags');
            }
            if ($result > 0) {
                $this->session->set_flashdata('success_msg', 'Tag Added successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Tag Insertion failed');
            }
            redirect('admin/settings/add_tags');
        }
        if ($is_option == false) {
            $data['tags'] = null;
        } else {
            $data['tags'] = $is_option;
        }
        $data['pageTitle'] = 'Team-Focus : Add Tags';
        $data['middle'] = 'settings/add_tags';
        $this->load->view('admin/template', $data);
    }
    public function roles()
    {
        $data['pageTitle'] = 'Team-Focus : Add Roles';
         // Turn caching on 
         $this->db->cache_on();
        $qry = $this->global_model->customeQuery('select * from tbl_roles where role != "system Administrator" order by roleId DESC');
         // Turn caching off 
         $this->db->cache_off();
        $data['items'] = $qry->result();
        $data['middle'] = 'settings/roles';
        $this->load->view('admin/template', $data);
    }
    public function add_payment_methods(){

        $is_option = get_option('payment_methods');
        if (isset($_POST['add_methods'])) { 
            $fields =array();
            foreach($_POST['payment_methods'] as $k=>$v){
                if(!empty($v)){
                    $fields[] =$v;
                }
            }
            $encoded_arr = json_encode($fields);
            $data_ins = array(
                'option_name' => 'payment_methods',
                'option_values' => $encoded_arr,
            );
            if($is_option == false){
                $result = $this->global_model->insert('front_options', $data_ins);
            }else{
                $result = $this->global_model->update('front_options', $data_ins, 'option_name', 'payment_methods');
            }
            if ($result > 0) {
                $this->session->set_flashdata('success_msg', 'Added successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Insertion failed');
            }
            redirect('admin/settings/add_payment_methods');
        }
        if ($is_option == false) {
            $data['payment_methods'] = null;
        } else {
            $data['payment_methods'] = $is_option;
        }
        $data['pageTitle'] = 'Team-Focus : Add Payment Methods';
        $data['middle'] = 'settings/add_payments_methods';
        $this->load->view('admin/template', $data);
    }
}
