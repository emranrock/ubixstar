<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Services extends My_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn(); 
        $this->load->library('form_validation');
        
    }

    public function index(){
        $data['pageTitle'] = 'Team-Focus : Add Services';
        

        if(isset($_POST['services'])){
           //var_dump($_POST);exit;
           extract($_POST);

            $this->form_validation->set_rules('icons','Please Select icon','trim|required');
            $this->form_validation->set_rules('title','Please Enter Services Title','trim|required');
            $this->form_validation->set_rules('dscription','Please Enter Services description','trim|required');
            
                if($this->form_validation->run() == FALSE)
                {
                    $this->index();
                }else{
                            $userInfo = array(
                                'icon' => $icons,
                                'title' => $title,
                                'desciption' => $dscription,
                                'status' => $status,
                            );   
                        $result = $this->global_model->insert('services',$userInfo);

                        if($result>0){
                            $this->session->set_flashdata('success', 'New Services created successfully');
                            redirect('admin/services/manage');
                        }else{
                            $this->session->set_flashdata('error', 'Services creation failed');
                            redirect('admin/services');
                        }
                    
                       
                 } 
            }else{
                $data['middle'] = 'services/add';
                $this->load->view('admin/template',$data);
            }
    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show Services';
        $qry = $this->global_model->customeQuery('select * from services');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'services/manage';
        $this->load->view('admin/template',$data);
    }

    public function edit($id=null){
        $data['pageTitle'] = 'Team-Focus : Edit Services';
        $new_id = $id;
        if($id == null){
            if(isset($_POST['edit'])){
                extract($_POST);
                $new_id = $id;
                $this->form_validation->set_rules('icons','Please Select icon','trim|required');
                $this->form_validation->set_rules('title','Please Enter Services Title','trim|required');
                $this->form_validation->set_rules('dscription','Please Enter Services description','trim|required');
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->manage();
                }else{
                    $userInfo = array(
                        'icon' => $icons,
                        'title' => $title,
                        'desciption' => $dscription,
                        'status' => $status,
                    );   
                }
                $result = $this->global_model->update('services',$userInfo,'id',$new_id);
                if($result>0){
                    $this->session->set_flashdata('success', 'New Services Updation successfully');
                    redirect('admin/services/manage');
                }else{
                    $this->session->set_flashdata('error', 'Services Updation Failed');
                    redirect('admin/services/manage');
                }
            }
        }else{
            $qry = $this->global_model->customeQuery("select * from services where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'services/edit';
            $this->load->view('admin/template',$data);
        }
       
    }

    public function delete(){
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('services','id',$new_id);
        if($result>0){
            echo true;
        }else{
            echo false;
        }
    }

}
