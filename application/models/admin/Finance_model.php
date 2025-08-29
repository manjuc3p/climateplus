<?php date_default_timezone_set('Asia/Kolkata');

class Finance_model extends CI_Model {

	function get_records()
	{
		$this->db->order_by('from_date','desc');
		$query = $this->db->get('financial_details');
		return $query->result();
	}
	function get_dates_of_fin_year($financial_details_id)
	{
		$query = $this->db->query("select from_date,to_date from financial_details where financial_details_id='$financial_details_id'");
		return $query->result();
	}
	function get_active_fin_year_descr()
	{
		$query = $this->db->query("select from_date,to_date,active_year from financial_details where active=1");
		return $query->row();
	}
	
	// sales_bsticker
	function get_active_fin_year_descr_sales_bsticker()
	{
		$query = $this->db->query("select from_date,to_date,active_year from financial_details where active=1");
		return $query->row();
	}
	
	// sales details_bsticker
	function get_active_fin_year_descr_bsticker()
	{
		$query = $this->db->query("select from_date,to_date,active_year from financial_details where active=1");
		return $query->row();
	}
	
	function get_active_fin_year()
	{
		$query = $this->db->query("select from_date,to_date,descr from financial_details where active=1");
		return $query->row();
	}
	function get_active_year()
	{
		$query = $this->db->query("select from_date,to_date from financial_details where active=1");
		return $query->result();
	}
	
	function get_active_fin_desc()
	{
		$one =1;
		$this->db->select('descr');
		$this->db->where('active', $one);
		$query = $this->db->get('financial_details');

		$description="";
		return $query->row();
	}
	
	function add_finicial_record()
	{		
		$from = date('Y-m-d',strtotime($this->input->post('from_date')));
		$to = date('Y-m-d',strtotime($this->input->post('to_date')));
		$desc= date('y',strtotime($this->input->post('from_date'))).'-'.date('y',strtotime($this->input->post('to_date')));
		$flag=0;
		$query = $this->db->query("select * from financial_details where from_date = '$from'");
		if($query->num_rows()>= 1)
		{
			$flag = 1;
			return $flag;
		}
		$query = $this->db->query("select * from financial_details where to_date = '$to'");
		if($query->num_rows()>= 1)
		{
			$flag = 1;
			return $flag;
		}
		$data = array(
			'from_date' => $from,
			'to_date' => $to,
			'descr' => $desc
		);
		$this->db->insert('financial_details', $data);
		
		$insert_id=$this->db->insert_id();
			$uid = $this->session->userdata('user_id');		
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($uid,1,$page_name[1],'financial_details','financial_details_id',$insert_id);		   
	        return $flag;
		
	}

	function select_record()
	{
		$id=$this->input->post('fin_id');
		if($id!=''){
		$data = array(
			'active'=>0
		);
		$this->db->update('financial_details', $data);
		$id=$this->input->post('fin_id');
		$data = array(
			'active'=>1
		);
		$this->db->where('financial_details_id',$id);
		$this->db->update('financial_details', $data);
		
	/*	$uid = $this->session->userdata('user_id');		
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($uid,2,$page_name[1],'financial_details','financial_details_id',$id); */	
		return $id;
	}
	}		
	
	/*function get_excess_billing_amount()
	{
		$query=$this->db->query("select min_amount from mimimum_excess_invoice_amount");
		return $query->row('min_amount');
	}*/
	}