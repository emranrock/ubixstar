<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class teams extends My_Controller
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
        $data['pageTitle'] = 'Team-Focus : Add Team Member';
        if(isset($_POST['slider'])){
           // var_dump($_POST);exit;
           extract($_POST);

            $this->form_validation->set_rules('position','Member Position','trim|required');
            //$this->form_validation->set_rules('sub_title','Slide Sub Title Type','trim|required');
            
                if($this->form_validation->run() == FALSE)
                {
                    $this->index();
                }else{
                    $config['upload_path']   = APPPATH.'../uploads/front/teams/'; 
                    $config['allowed_types'] = 'jpg|png'; 
                    $config['max_size']      = 1024;
                    $this->load->library('upload', $config);
    
                    if ( ! $this->upload->do_upload('image')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/teams/');
                    }else { 
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
                        $this->image_lib->clear();

                        $new_array = array();
                        $links_obj='';
                        if(!empty($links)){
                            foreach ($links as $key => $value) {
                                $new_array[$key]=$value;
                            }
                            $links_obj = json_encode($new_array);
                        }else{
                            $links_obj = null;
                        }

                        $userInfo = array(
                            'name' => $name,
                            'position' => $position,
                            'short_text' => $short_text,
                            'image' => $photo,
                            'links' => $links_obj,
                            'status'=>$status,
                        );   
                        $result = $this->global_model->insert('teams',$userInfo);
                        if($result>0){
                            $this->session->set_flashdata('success', 'New Team Member created successfully');
                            redirect('admin/team/manage');
                        }else{
                            $this->session->set_flashdata('error', 'Team Member creation failed');
                            redirect('admin/team');
                        }
                 } 
                }
            }else{

                $data['middle'] = 'teams/add';
                $this->load->view('admin/template',$data);
            }
    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show Teams';
        $qry = $this->global_model->customeQuery('select * from teams');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'teams/manage';
        $this->load->view('admin/template',$data);
    }

    public function edit($id=null){
        $data['pageTitle'] = 'Team-Focus : Edit Teams';
        $new_id = decode_url($id);
        if($id == null){
            if(isset($_POST['edit'])){
                extract($_POST);
                $new_id = decode_url($id);
                $this->form_validation->set_rules('position','Member Position','trim|required');
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->manage();
                }else{
                    $config['upload_path']   = APPPATH.'../uploads/front/teams/'; 
                    $config['allowed_types'] = 'jpg|png'; 
                    $config['max_size']      = 1024;
                    $this->load->library('upload', $config);
                    if(!empty($_FILES)){
                        if ( ! $this->upload->do_upload('image')) {
                            $this->session->set_flashdata('error', $this->upload->display_errors());
                            //var_dump($this->upload->display_errors());
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
                        $new_array = array();
                        $links_obj='';
                        if(!empty($links)){
                            foreach ($links as $key => $value) {
                                $new_array[$key]=$value;
                            }
                            $links_obj = json_encode($new_array);
                        }else{
                            $links_obj = null;
                        }
                        $userInfo = array(
                            'name' => $name,
                            'position' => $position,
                            'short_text' => $short_text,
                            'image' => $photo,
                            'links' => $links_obj,
                            'status'=>$status,
                        );    
                    }else{
                        $new_array = array();
                        $links_obj='';
                        if(!empty($links)){
                            foreach ($links as $key => $value) {
                                $new_array[$key]=$value;
                            }
                            $links_obj = json_encode($new_array);
                        }else{
                            $links_obj = null;
                        }
                        $userInfo = array(
                            'name' => $name,
                            'position' => $position,
                            'short_text' => $short_text,
                            'image' => $photo,
                            'links' => $links_obj,
                            'status'=>$status,
                        ); 
                    }
                    $result = $this->global_model->update('teams',$userInfo,'id',$new_id);
                    if($result>0){
                        $this->session->set_flashdata('success', 'Team Member Updation successfully');
                        redirect('admin/teams/manage');
                    }else{
                        $this->session->set_flashdata('error', 'Team Member Updation Failed');
                        redirect('admin/teams/manage');
                    }
                  
                }

            

            }
        }else{
            $qry = $this->global_model->customeQuery("select * from teams where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'teams/edit';
            $this->load->view('admin/template',$data);
        }
       
    }

    public function delete(){
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('teams','id',$new_id);
        if($result>0){
            echo true;
        }else{
            echo false;
        }
    }


    public function resizeImage($filename)
    {
     
       $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/front/teams/' . $filename;
       $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/front/teams/resized/';
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
        $this->image_lib->initialize($config);
        // Do your manipulation
        $this->image_lib->clear();
       
    }

}
