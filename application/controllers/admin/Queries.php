<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Queries extends My_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
    }

    public function index(){
        $this->manage();
    }

    public function manage(){
        $data['pageTitle'] = 'Team-Focus : Show Queries';
        $qry = $this->global_model->customeQuery('select * from queries');
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'queries/manage';
        $this->load->view('admin/template',$data);
    }
}
