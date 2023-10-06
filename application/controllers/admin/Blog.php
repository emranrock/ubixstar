<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Blog extends My_Controller
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
        $data['pageTitle'] = 'Team-Focus : Add Blog';
        if(isset($_POST['testimonial'])){
           // var_dump($_POST);exit;
           extract($_POST);

            $this->form_validation->set_rules('title','Please Enter Blog TItle','trim|required');
            $this->form_validation->set_rules('description','Please Enter Description','trim|required');
            $this->form_validation->set_rules('body','Please Enter Body','trim|required');
            $this->form_validation->set_rules('status','Please Enter status','trim|required');
            $this->form_validation->set_rules('date','Please Enter date','trim|required');
            
                if($this->form_validation->run() == FALSE)
                {
                    $this->index();
                }else{

                        $userInfo = array(
                            'title' => $title,
                            'description' => $description,
                            'body' => $body,
                            'status' => $status,
                            'date' => $date,
                        );   
                    $result = $this->global_model->insert('blogs',$userInfo);
                    if($result>0){
                        $this->session->set_flashdata('success', 'New Blog created successfully');
                        redirect('admin/blog/manage');
                    }else{
                        $this->session->set_flashdata('error', 'Blog creation failed');
                        redirect('admin/blog');
                    }
            }
            }else{
                $data['middle'] = 'blog/add';
                $this->load->view('admin/template',$data);
            }
    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show Blogs';
        $qry = $this->global_model->customeQuery('select * from blogs');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'blog/manage';
        $this->load->view('admin/template',$data);
    }

    public function edit($id=null){
        $data['pageTitle'] = 'Team-Focus : Edit Blog';
        $new_id = decode_url($id);
        if($id == null){
            if(isset($_POST['edit'])){
                extract($_POST);
                $new_id = decode_url($id);
                $this->form_validation->set_rules('title','Please Enter Blog TItle','trim|required');
                $this->form_validation->set_rules('description','Please Enter Description','trim|required');
                $this->form_validation->set_rules('body','Please Enter Body','trim|required');
                $this->form_validation->set_rules('status','Please Enter status','trim|required');
                // $this->form_validation->set_rules('date','Please Enter date','trim|required');
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->manage();
                }else{
                    $userInfo = array(
                        'title' => $title,
                        'description' => $description,
                        'body' => $body,
                        'status' => $status,
                        'date' => $date,
                    );   
                    $result = $this->global_model->update('blogs',$userInfo,'id',$new_id);
                    if($result>0){
                        $this->session->set_flashdata('success', 'New Blog Updation successfully');
                        redirect('admin/blog/manage');
                    }else{
                        $this->session->set_flashdata('error', 'Blog Updation Failed');
                        redirect('admin/blog/manage');
                    }
                } 
            }
        }else{
            $qry = $this->global_model->customeQuery("select * from blogs where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'blog/edit';
            $this->load->view('admin/template',$data);
        }
       
    }

    public function delete(){
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('blogs','id',$new_id);
        if($result>0){
            echo true;
        }else{
            echo false;
        }
    }
}
