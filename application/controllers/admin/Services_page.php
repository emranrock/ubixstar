<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Services_page extends My_Controller
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

    public function index(){
        $data['pageTitle'] = 'Team-Focus : Add Services';
        

        if(isset($_POST['services'])){
           //var_dump($_POST);exit;
           extract($_POST);

           
            $this->form_validation->set_rules('title','Please Enter Services Title','trim|required');
            $this->form_validation->set_rules('description','Please Enter Services description','trim|required');
            
                if($this->form_validation->run() == FALSE){
                    $this->index();
                }else{
                    $config['upload_path']   = APPPATH.'../uploads/front/services/'; 
                    $config['allowed_types'] = 'jpg|png'; 
                    $config['max_size']      = 950;
                    $this->load->library('upload', $config);
    
                    if ( ! $this->upload->do_upload('image')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/services_page/');
                    }else{ 
                        $uploadedImage = $this->upload->data();
                        $photo = $uploadedImage['file_name'];

                        $config_manip = array(
                            'image_library' => 'gd2',
                            'source_image' => $uploadedImage['full_path'],
                            //'new_image' => $target_path,
                            'maintain_ratio' => TRUE,
                            'width' => 1500,
                            'height'=>840,
                        );
                         $this->load->library('image_lib', $config_manip);
                        if (!$this->image_lib->resize()) {
                            $this->session->set_flashdata('error', $this->image_lib->display_errors());
                        }
                        //$this->image_lib->clear();

                            $userInfo = array(
                                
                                'title' => $title,
                                'description' => $description,
                                'image' => $photo,
                                'status' => $status,
                            );   
                        $result = $this->global_model->insert('services_page',$userInfo);

                        if($result>0){
                            $this->session->set_flashdata('success', 'New Services created successfully');
                            redirect('admin/services_page/manage');
                        }else{
                            $this->session->set_flashdata('error', 'Services creation failed');
                            redirect('admin/services_page');
                        }
                    }
                    
                }
        }else{
            $data['middle'] = 'services_page/add';
            $this->load->view('admin/template',$data);
        }

    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show Services';
        $qry = $this->global_model->customeQuery('select * from services_page');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'services_page/manage';
        $this->load->view('admin/template',$data);
    }

    public function edit($id=null){
        $data['pageTitle'] = 'Team-Focus : Edit Services';

        $new_id = decode_url($id);
        
        if($id == null){
           
            if(isset($_POST['edit'])){
                extract($_POST);
                $new_id = decode_url($id);
               
                $this->form_validation->set_rules('title','Please Enter Services Title','trim|required');
                $this->form_validation->set_rules('description','Please Enter Services description','trim|required');
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->manage();
                }else{
                        $config['upload_path']   = APPPATH.'../uploads/front/slider/'; 
                        $config['allowed_types'] = 'jpg|png'; 
                        $config['max_size']      = 950;
                        $this->load->library('upload', $config);
                        if(!empty($_FILES)){
                            if ( ! $this->upload->do_upload('image')) {
                                $this->session->set_flashdata('error', $this->upload->display_errors());
                                var_dump($this->upload->display_errors());
                            }else { 
                                $uploadedImage = $this->upload->data();
                                $photo = $uploadedImage['file_name'];
                            }    
                            $config_manip = array(
                                'image_library' => 'gd2',
                                'source_image' => $uploadedImage['full_path'],
                                //'new_image' => $target_path,
                                'maintain_ratio' => TRUE,
                                'width' => 1500,
                                'height'=>840,
                            );
                            $this->load->library('image_lib', $config_manip);
                            if (!$this->image_lib->resize()) {
                                $this->session->set_flashdata('error', $this->image_lib->display_errors());
                            }
                            $this->image_lib->clear();
                            $userInfo = array(
                                
                                'title' => $title,
                                'description' => $description,
                                'image' => $photo,
                                'status' => $status,
                            );   
                            }else{
                                $userInfo = array(
                                    
                                    'title' => $title,
                                    'description' => $description,
                                    'image' => $image,
                                    'status' => $status,
                                );   
                            }  
                            
                            $result = $this->global_model->update('services_page',$userInfo,'id',$new_id);
                            if($result>0){
                                $this->session->set_flashdata('success', 'New Services Updation successfully');
                                redirect('admin/services_page/manage');
                            }else{
                                $this->session->set_flashdata('error', 'Services Updation Failed');
                                redirect('admin/services_page/manage');
                            }
                        }
                    }
            }else{

               
                $qry = $this->global_model->customeQuery("select * from services_page where id='$new_id'");
                $data['records'] = $qry->result();
                $data['middle'] = 'services_page/edit';
                $this->load->view('admin/template',$data);
            }
        
           
       
    }

    public function delete(){
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('services_page','id',$new_id);
        if($result>0){
            echo true;
        }else{
            echo false;
        }
    }

}
