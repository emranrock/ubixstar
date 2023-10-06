<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Calltoaction extends My_Controller
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
        $data['pageTitle'] = 'Team-Focus : Add Call To Action';
        

        if(isset($_POST['submit'])){
         
           extract($_POST);
            $this->form_validation->set_rules('title','Please Enter Title','trim|required');
            $this->form_validation->set_rules('short_description','Please Enter Short Description','trim|required');
            $this->form_validation->set_rules('btn_text','Please Enter Button Text','trim|required');
                if($this->form_validation->run() == FALSE)
                {
                    $this->index();
                }else{
                            $userInfo = array(
                                'title' => $title,
                                'description' => $short_description,
                                'link' => $btn_text,
                                //'status' => $status,
                            );   
                        $result = $this->global_model->insert('call_to_action',$userInfo);
                       // var_dump($result);exit;
                        if($result>0){
                            $this->session->set_flashdata('success', 'New Call to Action created successfully');
                            redirect('admin/calltoaction/manage');
                        }else{
                            $this->session->set_flashdata('error', 'Call to Action creation failed');
                            redirect('admin/calltoaction');
                        }
                    
                       
                 } 
            }else{
                $data['middle'] = 'calltoaction/add';
                $this->load->view('admin/template',$data);
            }
    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show Action';
        $qry = $this->global_model->customeQuery('select * from call_to_action');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'calltoaction/manage';
        $this->load->view('admin/template',$data);
    }

    public function edit($id=null){
        $data['pageTitle'] = 'Team-Focus : Edit Action';
        $new_id = decode_url($id);
        if($id == null){
            if(isset($_POST['edit'])){
                extract($_POST);
                $new_id = decode_url($id);

                $this->form_validation->set_rules('title','Please Enter Title','trim|required');
                $this->form_validation->set_rules('short_description','Please Enter Short Description','trim|required');
                $this->form_validation->set_rules('btn_text','Please Enter Button Text','trim|required');
                
                if($this->form_validation->run() == FALSE)
                {
                    $this->manage();
                }else{
                    $userInfo = array(
                        'title' => $title,
                        'description' => $short_description,
                        'link' => $btn_text,
                        //'status' => $status,
                    );   
                    $result = $this->global_model->update('call_to_action',$userInfo,'id',$new_id);
                }
                //var_dump($userInfo);exit;

                if($result>0){
                    $this->session->set_flashdata('success', 'New Call to Action Updation successfully');
                    redirect('admin/calltoaction/manage');
                }else{
                    $this->session->set_flashdata('error', 'Call to Action Updation Failed');
                    redirect('admin/calltoaction/manage');
                }
            }
        }else{
            $qry = $this->global_model->customeQuery("select * from call_to_action where id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'calltoaction/edit';
            $this->load->view('admin/template',$data);
        }
       
    }

    public function delete(){
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('call_to_action','id',$new_id);
        if($result>0){
            echo true;
        }else{
            echo false;
        }
    }

}
