<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Brands extends My_Controller
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
        $data['pageTitle'] = 'Team-Focus : Add Brand';
        if(isset($_POST['brands'])){
           // var_dump($_POST);exit;
           extract($_POST);
           
           $this->form_validation->set_rules('title','Please Enter Title','trim|required');
           
            
                if($this->form_validation->run() == FALSE)
                {
                    $this->index();
                }else{
                    $config['upload_path']   = APPPATH.'../uploads/front/brands/'; 
                    $config['allowed_types'] = 'jpg|png'; 
                    $config['max_size']      = 2048;
                    if(!is_dir($config['upload_path'])){
                        mkdir($config['upload_path'], 0777, TRUE);
                    }
                    //var_dump($config);exit;
                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('image')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/brands/');
                    }else { 
                        $uploadedImage = $this->upload->data();
                        $photo = $uploadedImage['file_name'];
                      //  var_dump($uploadedImage);exit;
                      
                      $imgConfig = array();
                        
                    $imgConfig['image_library']   = 'GD2';
                                            
                    $imgConfig['source_image']    = APPPATH.'../uploads/front/brands/'.$photo;
                                            
                    $imgConfig['wm_text']         = 'Copyright 2020 - firstook.com';
                                            
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
                            'image' => $photo,
                            'status' => $status,
                        );   
                    $result = $this->global_model->insert('brands',$userInfo);
                    if($result>0){
                        $this->session->set_flashdata('success', 'New Brand Image Created Successfully');
                        redirect('admin/brands/manage');
                    }else{
                        $this->session->set_flashdata('error', 'Brand Image creation failed');
                        redirect('admin/brands');
                    }
                 } 
            }
            }else{
                $data['middle'] = 'brands/add';
                $this->load->view('admin/template',$data);
            }
    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show Brand Images';
        $qry = $this->global_model->customeQuery('select * from brands');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'brands/manage';
        $this->load->view('admin/template',$data);
    }

    public function edit($id=null){
        $data['pageTitle'] = 'Team-Focus : Edit Brand Image';
        $new_id = decode_url($id);
        if($id == null){
            if(isset($_POST['edit'])){
                extract($_POST);
                $new_id = decode_url($id);
                $this->form_validation->set_rules('status','Please select Status','trim|required');
                $this->form_validation->set_rules('title','Please Enter Title','trim|required');
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->manage();
                }else{
                    $config['upload_path']   = APPPATH.'../uploads/front/brands/'; 
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
                            'image' => $photo,
                            'status' => $status,
                        );   
                    }else{
                        $userInfo = array(
                           
                            'title' => $title,
                            'image' => $photo,
                            'status' => $status,
                        );   
                    }
                    $result = $this->global_model->update('brands',$userInfo,'id',$new_id);
                    if($result>0){
                        $this->session->set_flashdata('success', 'New brand Image Updation successfully');
                        redirect('admin/brands/manage');
                    }else{
                        $this->session->set_flashdata('error', 'brand Image Updation Failed');
                        redirect('admin/brands/manage');
                    }
                  
                }
            }
        }else{
            $qry = $this->global_model->customeQuery("select * from brands where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'brands/edit';
            $this->load->view('admin/template',$data);
        }
       
    }

    public function delete(){
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('brands','id',$new_id);
        if($result>0){
            echo true;
        }else{
            echo false;
        }
    }


    public function resizeImage($filename)
    {
     
       $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/front/brands/' . $filename;
       $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/front/brands/resized/';
       var_dump( $source_path);exit;
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
        $this->image_lib->initialize($config);
        // Do your manipulation
        $this->image_lib->clear();
       
    }

}
