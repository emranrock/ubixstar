<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function commonQuery($sql)
	{
		$query = $this->db->query($sql);
		return $query;
	}


	function commonInsert($tbl, $data)
	{
		$this->db->insert($tbl, $data);
		return $this->db->insert_id();
	}


	function commonUpdate($tbl, $data, $fld, $id)
	{
		$this->db->where($fld, $id);
		$this->db->update($tbl, $data);
		return $this->db->affected_rows();
	}


	function commonDelete($tbl, $rowid, $fld)
	{
		$this->db->where_in($fld, $rowid);
		$this->db->delete($tbl);
		return $this->db->affected_rows();
	}


	function commonSelect($tbl, $options = NULL)
	{
		$sql = "select * from " . $tbl;
		if ($options != NULL) {
			if (array_key_exists('where', $options)) {
				$where = array($options['where']);
				if (count($where) > 0) {
					$where = current($where);
					$sql .= " where ";
					$once = 1;
					foreach ($where as $k => $v) {
						$sql .= ($once) ?  " $k = '$v'" : " and $k = '$v'";
						$once = 0;
					}
				}
			}
			if (array_key_exists('orderby', $options)) {
				$orderby = array($options['orderby']);
				//print_r($options['where']);//exit;
				if (count($orderby) > 0) {

					$orderby = current($orderby);

					$sql .= " order by ";

					$once = 1;

					foreach ($orderby as $k => $v) {

						$sql .= ($once) ?  " $k $v" : " , $k  $v ";

						$once = 0;
					}
				}
			}
		}

		$query = $this->db->query($sql);
		return $query;
	}

	
}
