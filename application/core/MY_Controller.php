<?php defined('BASEPATH') or exit('No direct script access allowed');


class My_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('global_model');
	}
	protected $role = '';
	protected $vendorId = '';
	protected $name = '';
	protected $roleText = '';
	protected $global = array();

	public function response($data = NULL)
	{
		$this->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))->_display();
		exit();
	}

	/**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('admin/login');
		} else {
			$this->role = $this->session->userdata('role');
			$this->vendorId = $this->session->userdata('userId');
			$this->name = $this->session->userdata('name');
			$this->roleText = $this->session->userdata('roleText');

			$this->global['name'] = $this->name;
			$this->global['role'] = $this->role;
			$this->global['role_text'] = $this->roleText;
			
		}
	}

	/**
	 * This function is used to check the access
	 */
	function isAdmin()
	{
		if ($this->role == 'System Administrator') {
			return true;
		} else {
			//$this->loadThis();
			return false;
		}
	}

	/**
	 * This function is used to check the access
	 */
	function isTicketter()
	{
		if ($this->role != 2 || $this->role != 3) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * This function is used to load the set of views
	 */
	function loadThis()
	{
		$data['pageTitle'] = 'Team-Focus : Access Denied';
		$data['middle'] = 'access';
		$this->load->view('admin/template', $data);
	}

	/**
	 * This function is used to logged out user from system
	 */
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}
}
