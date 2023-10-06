<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Skills extends My_Controller
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
        $data['pageTitle'] = 'Team-Focus : Add Skills';
        

        if(isset($_POST['services'])){
           //var_dump($_POST);exit;
           extract($_POST);
            $this->form_validation->set_rules('title','Please Enter Services Title','trim|required');
            $this->form_validation->set_rules('percentage','Please Enter Services description','trim|required');
            
                if($this->form_validation->run() == FALSE)
                {
                    $this->index();
                }else{
                            $userInfo = array(
                                'skill_title' => $title,
                                'percentage' => $percentage,
                                'status' => $status,
                            );   
                        $result = $this->global_model->insert('skills',$userInfo);

                        if($result>0){
                            $this->session->set_flashdata('success', 'New Skills created successfully');
                            redirect('admin/skills/manage');
                        }else{
                            $this->session->set_flashdata('error', 'Skills creation failed');
                            redirect('admin/skills');
                        }
                    
                       
                 } 
            }else{
                $data['middle'] = 'skills/add';
                $this->load->view('admin/template',$data);
            }
    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show Skills';
        $qry = $this->global_model->customeQuery('select * from skills');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'skills/manage';
        $this->load->view('admin/template',$data);
    }

    public function edit($id=null){
        $data['pageTitle'] = 'Team-Focus : Edit Skills';
        $new_id = decode_url($id);
        if($id == null){
            if(isset($_POST['edit'])){
                extract($_POST);
                $new_id = decode_url($id);
                $this->form_validation->set_rules('title','Please Enter Services Title','trim|required');
                $this->form_validation->set_rules('percentage','Please Enter Services description','trim|required');
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->manage();
                }else{
                    $userInfo = array(
                        'skill_title' => $title,
                        'percentage' => $percentage,
                        'status' => $status,
                    );   
                }
                $result = $this->global_model->update('skills',$userInfo,'id',$new_id);
                if($result>0){
                    $this->session->set_flashdata('success', 'New Skills Updation successfully');
                    redirect('admin/skills/manage');
                }else{
                    $this->session->set_flashdata('error', 'Skills Updation Failed');
                    redirect('admin/skills/manage');
                }
            }
        }else{
            $qry = $this->global_model->customeQuery("select * from skills where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'skills/edit';
            $this->load->view('admin/template',$data);
        }
       
    }

    public function delete(){
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('skills','id',$new_id);
        if($result>0){
            echo true;
        }else{
            echo false;
        }
    }

}
