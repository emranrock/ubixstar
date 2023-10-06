<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Global_Model extends CI_Model
{

	//protected $_table = NULL;
	//protected $_primary_key = 'seq_id';
	//protected $_timestamps = FALSE;
	//protected $_created_on_field = 't_created_on';
	//protected $_updated_on_field = 't_updated_on';
	//protected $_timestamps_format = 'Y-m-d H:i:s';

	public function __construct()
	{
		parent::__construct();
	}


	function login($email, $password)
	{
		$this->db->select('BaseTbl.userId, BaseTbl.password, BaseTbl.full_name,BaseTbl.roleId');
		$this->db->from('tbl_users as BaseTbl');
		$this->db->join('tbl_roles as Roles', 'Roles.roleId = BaseTbl.roleId');
		$this->db->where('BaseTbl.email', $email);
		$query = $this->db->get();
		$user = $query->result_array();
		if (!empty($user)) {
			if (password_verify($password, $user[0]['password'])) {
				return array('id' => $user[0]['userId'], 'name' => $user[0]['full_name'], 'roleid' => $user[0]['roleId']);
			} else {
				return array();
			}
		} else {
			return array();
		}
	}

	function Listing($table, $page, $segment,$searchText = '')
	{
		$this->db->select('*');
		$this->db->from($table);
		//$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
		if (!empty($searchText)) {
			$likeCriteria = "(id  LIKE '%" . $searchText . "%'
                            OR  name  LIKE '%" . $searchText . "%'
                            OR  mobile  LIKE '%" . $searchText . "%')";
			$this->db->where($likeCriteria);
		}
		//$this->db->where('BaseTbl.isDeleted', 0);
		//$this->db->where('BaseTbl.roleId !=', 1);
		$this->db->limit($page, $segment);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getById($table, $field, $id)
	{
		$this->db->where($field, $id);
		$query = $this->db->get($table);
		return $query->result();
	}

	public function checkAttendance($table, $field, $id, $field2, $date)
	{
		$this->db->where($field, $id);
		$this->db->where($field2, $date);
		$query = $this->db->get($table);
		return $query;
	}

	public function insert($table, $data)
	{
		$qry = $this->db->insert($table, $data);
		//var_dump($qry);exit;
		return $qry;
		//return $this->db->last_insert_id();
	}

	public function insertFees($table, $data)
	{
		$qry = $this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update($table, $data, $field, $id)
	{
		$this->db->where('' . $field . '', $id);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}

	public function customeQuery($qrystring)
	{
		$qry = $this->db->query($qrystring);
		return $qry;
	}

	public function insertUpdate($table, $data, $field, $id)
	{
		$count = $this->count($table, $field, $id);

		if ($count == 0) {
			return $this->insert($table, $data);
		}

		return $this->update($table, $data, $field, $id);
	}

	public function count($table, $field, $id)
	{
		$this->db->where($field, $id);
		$query = $this->db->get($table);
		//var_dump($query->result());exit;
		return $query->num_rows();
	}

	public function counts($table, $filed)
	{
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	public function delete($table, $field, $id = false)
	{
		if (!$id) {
			die('You must supply parameter 1 for delete() method');
		}

		if (is_numeric($id)) {
			$this->db->where($field, $id);
		}
		$this->db->delete($table);
		return $this->db->affected_rows();
	}

	function make_query($table, $select_column, $order_column, $where, $like, $or_like = false)
	{
		$this->db->select($select_column);
		$this->db->from($table);
		if (isset($_POST["search"]["value"])) {
			$this->db->like($like, $_POST["search"]["value"]);
			$this->db->or_like($or_like, $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by($where, 'DESC');
		}
	}

	function make_datatables($table, $select_column, $order_column, $where, $like, $or_like)
	{
		$this->make_query($table, $select_column, $order_column, $where, $like, $or_like);
		if ($_POST["length"] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function get_filtered_data($table, $select_column, $order_column, $where, $like, $or_like)
	{
		$this->make_query($table, $select_column, $order_column, $where, $like, $or_like);
		$query = $this->db->get();
		return $query->num_rows();
	}
	function get_all_data($table)
	{
		$this->db->select("*");
		$this->db->from($table);
		return $this->db->count_all_results();
	}


	function autocomplete($postData)
	{
		$response = array();
		if (isset($postData['search'])) {
			// Select record
			$this->db->select('*');
			$this->db->where("tracking_no like '%" . $postData['search'] . "%' ");
			$records = $this->db->get('forwards')->result();
			foreach ($records as $row) {
				$response[] = array("value" => $row->tracking_no, "label" => $row->tracking_no);
			}
		}
		return $response;
	}
}
