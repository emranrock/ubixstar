<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Category extends My_Controller
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
        $data['pageTitle'] = 'Team-Focus : Add  New Category';
        if(isset($_POST['add'])){
           // var_dump($_POST);exit;
           extract($_POST);

            $this->form_validation->set_rules('title','Please Enter Category TItle','trim|required');
            
                if($this->form_validation->run() == FALSE)
                {
                    $this->index();
                }else{
                        $userInfo = array(
                            'name' => $title,
                            'status' => $status,
                        );   
                    $result = $this->global_model->insert('image_category',$userInfo);
                    if($result>0){
                        $this->session->set_flashdata('success', 'New Image Category Created successfully');
                        redirect('admin/category/manage');
                    }else{
                        $this->session->set_flashdata('error', 'Image Category Creation failed');
                        redirect('admin/category');
                    }
                  
            }
            }else{
                $data['middle'] = 'category/add';
                $this->load->view('admin/template',$data);
            }
    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show category Images';
        $qry = $this->global_model->customeQuery('select * from image_category');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'category/manage';
        $this->load->view('admin/template',$data);
    }

    public function edit($id=null){
        $data['pageTitle'] = 'Team-Focus : Edit Image Category';
        $new_id = decode_url($id);
        if($id == null){
            if(isset($_POST['edit'])){
                extract($_POST);
                $new_id = decode_url($id);
                $this->form_validation->set_rules('title','Please Enter Category TItle','trim|required');
               
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->manage();
                }else{
                   
                        $userInfo = array(
                            
                            'name' => $title,
                            'status' => $status,
                        );   
                    $result = $this->global_model->update('image_category',$userInfo,'id',$new_id);
                    if($result>0){
                        $this->session->set_flashdata('success', 'New Image Category Updation successfully');
                        redirect('admin/category/manage');
                    }else{
                        $this->session->set_flashdata('error', 'Image Category Updation Failed');
                        redirect('admin/category/manage');
                    }
                  
                }
            }
        }else{
            $qry = $this->global_model->customeQuery("select * from image_category where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'category/edit';
            $this->load->view('admin/template',$data);
        }
       
    }

    public function delete(){
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('image_category','id',$new_id);
        if($result>0){
            echo true;
        }else{
            echo false;
        }
    }


}
