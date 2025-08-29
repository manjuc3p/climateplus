<?php
   
class month_model extends CI_Model   
{
	function get_records()
	{
		$query=$this->db->get('months');		
		return $query->result();
	}
	
	function get_dates_of_fin_year($months_id)
	{
		$query = $this->db->query("select no_of_days,month_name from months where months_id='$months_id'");
		return $query->row();
	}
	
	
	function get_dates_of_fin_year_start($months_id)
	{
		$query = $this->db->query("select * from months where months_id='$months_id'");
		return $query->row();
	}
}
   
?>