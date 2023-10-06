<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Counter extends My_Controller
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
        $data['pageTitle'] = 'Team-Focus : Add Project Counter';
        

        if(isset($_POST['services'])){
           //var_dump($_POST);exit;
           extract($_POST);
            $this->form_validation->set_rules('title','Please Enter Title','trim|required');
            $this->form_validation->set_rules('total','Please Enter Total Number','trim|required');
            
                if($this->form_validation->run() == FALSE)
                {
                    $this->index();
                }else{
                            $userInfo = array(
                                'title' => $title,
                                'total' => $total,
                                'status' => $status,
                            );   
                        $result = $this->global_model->insert('projects_counter',$userInfo);

                        if($result>0){
                            $this->session->set_flashdata('success', 'New Counter created successfully');
                            redirect('admin/counter/manage');
                        }else{
                            $this->session->set_flashdata('error', 'Counter creation failed');
                            redirect('admin/counter');
                        }
                    
                       
                 } 
            }else{
                $data['middle'] = 'counters/add';
                $this->load->view('admin/template',$data);
            }
    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show Counters';
        $qry = $this->global_model->customeQuery('select * from projects_counter');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'counters/manage';
        $this->load->view('admin/template',$data);
    }

    public function edit($id=null){
        $data['pageTitle'] = 'Team-Focus : Edit Counters';
        $new_id = decode_url($id);
        if($id == null){
            if(isset($_POST['edit'])){
                extract($_POST);
                $new_id = decode_url($id);

                $this->form_validation->set_rules('title','Please Enter Title','trim|required');
                $this->form_validation->set_rules('total','Please Enter Total Number','trim|required');
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->manage();
                }else{
                    $userInfo = array(
                        'title' => $title,
                        'total' => $total,
                        'status' => $status,
                    );   
                    $result = $this->global_model->update('projects_counter',$userInfo,'id',$new_id);
                }
                //var_dump($userInfo);exit;

                if($result>0){
                    $this->session->set_flashdata('success', 'New Counter Updation successfully');
                    redirect('admin/counter/manage');
                }else{
                    $this->session->set_flashdata('error', 'Counter Updation Failed');
                    redirect('admin/counter/manage');
                }
            }
        }else{
            $qry = $this->global_model->customeQuery("select * from projects_counter where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'counters/edit';
            $this->load->view('admin/template',$data);
        }
       
    }

    public function delete(){
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('projects_counter','id',$new_id);
        if($result>0){
            echo true;
        }else{
            echo false;
        }
    }

}
