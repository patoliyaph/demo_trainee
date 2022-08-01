<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
	
    public function fetchAllData($data,$tablename,$where)
	{
		$query = $this->db->select($data)
				->from($tablename)
				->where($where)
				->get();
		return $query->result_array();
	}

	public function imgUpload($data)
	{	
		echo $imgdata = $this->db->insert('emp',$data);
		if($imgdata)
		{
			return TRUE;
		}
	}

	public function addEmp($data)
	{	
		echo $img = $this->db->insert('emp',$data);
		if($img)
		{
			return TRUE;
		}
	}

	public function viewEmp($id)
	{
		$user = $this->db->get_where('emp',['id'=>$id]);
	    return $user-> row();

	}

	public function editEmp($id)
	{
		$user = $this->db->get_where('emp',['id'=>$id]);
	    return $user-> row();
	}
	
	public function updateEmp($data,$id)
	{
		 $this->db->update('emp',$data,['id' => $id]);
	}

	public function deleteEmp($id)
	{
		 $this->db->delete('emp',['id' => $id]);
		
	}
}
