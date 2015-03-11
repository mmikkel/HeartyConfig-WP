<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe_model extends CI_Model {

	function min_id(){
	
		$this->db->order_by("c_time", "desc"); 		
		$query = $this->db->get("tags");

		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $min_id = $row->min_id;
		   if(!$min_id){
		   	$min_id ='';
		   }
		}	

		return $min_id;

	}

	function add_tag($data){
		
		$query = $this->db->get_where('tags', array('media_id'=>$data['media_id']));
		if($query->num_rows() > 0){
			return FALSE;	
		}else{
			$this->db->insert('tags', $data);	
		}

	}

}




?>