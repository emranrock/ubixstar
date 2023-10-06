<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class About extends My_Controller
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
        $data['pageTitle'] = 'Team-Focus : Add About Us';
        if(isset($_POST['submit'])){
           
           extract($_POST);
           
           $this->form_validation->set_rules('title','Please Enter Title','trim|required');
           $this->form_validation->set_rules('description','Please Enter description','trim|required');
           
            
                if($this->form_validation->run() == FALSE)
                {
                    $this->index();
                }else{
                   
                    $config['upload_path']   = APPPATH.'../uploads/front/aboutus/'; 
                    $config['allowed_types'] = 'jpg|png|jpeg'; 
                    $config['max_size']      = 2048;
                    if(!is_dir($config['upload_path'])){
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    //var_dump($config);exit;
                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('image')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/about/');
                    }else { 
                        $uploadedImage = $this->upload->data();
                        $photo = $uploadedImage['file_name'];
                      //  var_dump($uploadedImage);exit;
                      
                      $imgConfig = array();
                        
                    $imgConfig['image_library']   = 'GD2';
                                            
                    $imgConfig['source_image']    = APPPATH.'../uploads/front/aboutus/'.$photo;
                                            
                    $imgConfig['wm_text']         = 'Copyright 2020 - By GetWay';
                                            
                    $imgConfig['wm_type']         = 'text';
                                            
                    $imgConfig['wm_font_size']    = '16';

                    $imgConfig['create_thumb'] = true;

                    $imgConfig['maintain_ratio'] = true;

                    $imgConfig['wm_vrt_alignment'] = 'middle';

                    $imgConfig['wm_hor_alignment'] = 'center';

                   $this->load->library('image_lib', $imgConfig);
                        
                    $this->image_lib->initialize($imgConfig);
                                            
                    $this->image_lib->watermark(); 

                    if (!$this->image_lib->watermark()) {
                        echo  $this->image_lib->display_errors();
                        
                    }

                    if (!$this->image_lib->resize()) {
                        echo  $this->session->set_flashdata('error', $this->image_lib->display_errors());
                    }

                       
                        //$this->image_lib->clear();
                        $userInfo = array(
                            'title' => $title,
                            'description'=>$description,
                            'image' => $photo,
                            'status' => $status,
                        );   
                       
                    $result = $this->global_model->insert('about',$userInfo);
                    if($result>0){
                        $this->session->set_flashdata('success', 'New About  Created Successfully');
                        redirect('admin/about/manage');
                    }else{
                        $this->session->set_flashdata('error', 'About creation failed');
                        redirect('admin/about');
                    }
                 } 
            }
            }else{
                $data['middle'] = 'about/add';
                $this->load->view('admin/template',$data);
            }
    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show About us';
        $qry = $this->global_model->customeQuery('select * from about');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'about/manage';
        $this->load->view('admin/template',$data);
    }

    public function edit($id=null){
        $data['pageTitle'] = 'Team-Focus : Edit About';
        $new_id = $id;
        if($id == null){
            if(isset($_POST['edit'])){
                extract($_POST);
                $new_id = $id;
                $this->form_validation->set_rules('status','Please select Status','trim|required');
                $this->form_validation->set_rules('title','Please Enter Title','trim|required');
                $this->form_validation->set_rules('description','Please Enter Description','trim|required');
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->manage();
                }else{
                    $config['upload_path']   = APPPATH.'../uploads/front/aboutus/'; 
                    $config['allowed_types'] = 'jpg|png'; 
                    $config['max_size']      = 2048;
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
                            'image' => $photo,
                            'status' => $status,
                        );   
                    }
                    $result = $this->global_model->update('about',$userInfo,'id',$new_id);
                    if($result>0){
                        $this->session->set_flashdata('success', 'New about Updation successfully');
                        redirect('admin/about/manage');
                    }else{
                        $this->session->set_flashdata('error', 'about Updation Failed');
                        redirect('admin/about/manage');
                    }
                  
                }
            }
        }else{
            $qry = $this->global_model->customeQuery("select * from about where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'about/edit';
            $this->load->view('admin/template',$data);
        }
       
    }

    public function delete(){
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('about','id',$new_id);
        if($result>0){
            echo true;
        }else{
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
           'height'=>840,
       );
       $this->load->library('image_lib');
        // Set your config up
        $this->image_lib->initialize($config_manip);
        // Do your manipulation
        $this->image_lib->clear();
       
    }

}
