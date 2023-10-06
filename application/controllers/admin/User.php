<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User extends My_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('user_model');
        $this->load->model('global_model');
        $this->load->helper('comm');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
       
       
         // Turn caching on 
         $this->db->cache_on();
        $qry = $this->global_model->customeQuery("Select count(userId) as total_employee from tbl_users where roleId=3 ");
         // Turn caching off 
         $this->db->cache_off();
        if ($qry->num_rows() > 0) {
            $data['total_employee'] = $qry->row()->total_employee;
        } else {
            $data['total_employee'] = 0;
        }
        $data['middle'] = 'dashboard';
        $data['pageTitle'] = 'Team-Focus : Dashboard';
        $this->load->view('admin/template', $data);
    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {

        if ($this->isAdmin() != 1) {
            $this->loadThis();
        } else {
            $data['pageTitle'] = 'Team_focus : User Listing';
            $role = $this->session->userdata('role');

            if ($role == 1) {
                 // Turn caching on 
                 $this->db->cache_on();
                $qry = $this->global_model->customeQuery("Select tbl_users.email,tbl_users.full_name,tbl_users.phone_number,tbl_users.roleId,tbl_users.userId from tbl_users inner join tbl_roles on tbl_users.roleId = tbl_roles.roleId where tbl_users.isDeleted !=1 and  tbl_roles.role != 'System Administrator' ");
                 // Turn caching off 
                $this->db->cache_off();
            }

            $data['userRecords'] = $qry->result();
            $data['middle'] = 'users';
            $this->load->view('admin/template', $data);
            //$this->loadViews("users", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        $data['roles'] = $this->user_model->getUserRoles();
        $data['pageTitle'] = 'Add New User';
        $data['middle'] = 'addNew';
        $this->load->view('admin/template', $data);
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if (empty($userId)) {
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if (empty($result)) {
            echo ("true");
        } else {
            echo ("false");
        }
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->addNew();
        } else {
            $name = ucwords(strtolower($this->input->post('fname')));
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $mobile = $this->input->post('mobile');

            $userInfo = array(
                'email' => $email, 'password' => getHashedPassword($password), 'roleId' => $roleId, 'full_name' => $name,
                'phone_number' => $mobile
            );
            $result = $this->user_model->addNewUser($userInfo);
            if ($result > 0) {
                $this->session->set_flashdata('success', 'New User created successfully');
            } else {
                $this->session->set_flashdata('error', 'User creation failed');
            }
            redirect('admin/addNew');
        }
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if ($userId == null) {
            redirect('userListing');
        }
        $data['roles'] = $this->user_model->getUserRoles();
        $data['userInfo'] = $this->user_model->getUserInfo($userId);
        $data['pageTitle'] = 'Edit User';
        $data['middle'] = 'editOld';
        $this->load->view('admin/template', $data);
    }


    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        $this->load->library('form_validation');

        $userId = $this->input->post('userId');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'matches[cpassword]|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]|max_length[20]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->editOld($userId);
        } else {
            $name = ucwords(strtolower($this->input->post('fname')));
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $mobile = $this->input->post('mobile');

            $userInfo = array();

            if (empty($password)) {
                $userInfo = array(
                    'email' => $email, 'roleId' => $roleId, 'full_name' => $name,
                    'phone_number' => $mobile
                );
            } else {
                $userInfo = array(
                    'email' => $email, 'password' => getHashedPassword($password), 'roleId' => $roleId,
                    'full_name' => ucwords($name), 'phone_number' => $mobile
                );
            }
            $result = $this->user_model->editUser($userInfo, $userId);
            if ($result == true) {
                $this->session->set_flashdata('success', 'User updated successfully');
            } else {
                $this->session->set_flashdata('error', 'User updation failed');
            }

            redirect('admin/userListing');
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        $userId = $this->input->post('userId');
        //$dec_id = decode_url($userId);
        $userInfo = array('isDeleted' => 1);
        $result = $this->user_model->deleteUser($userId, $userInfo);
        if ($result > 0) {
            echo (json_encode(array('status' => TRUE)));
        } else {
            echo (json_encode(array('status' => FALSE)));
        }
    }

    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $data['middle'] = 'changePassword';
        $data['pageTitle'] = 'Change Password';
        $this->load->view('admin/template', $data);
    }


    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('oldPassword', 'Old password', 'required|max_length[20]');
        $this->form_validation->set_rules('newPassword', 'New password', 'required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword', 'Confirm new password', 'required|matches[newPassword]|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $this->loadChangePass();
        } else {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');

            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);

            if (empty($resultPas)) {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('admin/loadChangePass');
            } else {
                $usersData = array(
                    'password' => getHashedPassword($newPassword), 'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s')
                );
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Password Updated successful');
                } else {
                    $this->session->set_flashdata('error', 'Password Update failed');
                }
                redirect('admin/loadChangePass');
            }
        }
    }

    function pageNotFound()
    {
        $data['middle'] = '404';
        $data['pageTitle'] = 'Team-Focus :404 - Page Not Found';
        $this->load->view('admin/template', $data);
    }
}
