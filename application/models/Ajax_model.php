<?php
	class Ajax_model extends CI_Model {
	function cancel_record() {
		$id= $this->input->post('post_id1');
		$table_name= $this->input->post('table1');
		$attribute= $this->input->post('key_name1');
		$column= $this->input->post('column');
		$value= $this->input->post('value');

		$query= $this->db->query("update $table_name set $column='$value' where $attribute='$id' ");

		$uid = $this->session->userdata('user_id');     
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($uid,3,$page_name[1],$table_name,$attribute,$id);
		return true;
	}
	function delete_record()
	{
		$table_name= $this->input->post('table_name');
		$attribute= $this->input->post('where_key');
		$id= $this->input->post('where_val');
		$query= $this->db->query("delete from $table_name where $attribute='$id' ");
		if($query)
		{
			return true;
		}
		else {
		    return false;
		}

	}
	function delete_sales_quotation()
	{
		$quoteID= $this->input->post('quoteID');
		$enq_master_id= $this->input->post('enq_master_id');
		
		$query= $this->db->query("delete from sales_quotation_transaction where quote_master_id='$quoteID' ");
		$query= $this->db->query("delete from sales_quotation_master where quote_id='$quoteID' ");
		$query= $this->db->query("update enquiry_master set order_status=0  where enquiry_id='$enq_master_id' ");
		if($query)
		{
			return true;
		}
		else {
		    return false;
		}

	}
	function check_duplicate_exist() {
		$table_name= $this->input->post('table_name');
		$attribute= $this->input->post('column_name');
		$id= $this->input->post('post_id');
		$query= $this->db->query("select count(*)as tcnt from  $table_name where $attribute='$id' ");
		return $query->row('tcnt');
	}
	
	function check_duplicate_subcat_exist() {
		$table_name= $this->input->post('table_name');
		$attribute= $this->input->post('column_name');
		$id= $this->input->post('post_id');		
		$main_cat = $this->input->post('main_cat');
		$query= $this->db->query("select count(*)as tcnt from  $table_name where $attribute='$id' and child_id = '$main_cat'");
		return $query->row('tcnt');
	}
	function check_duplicate_item_exist() {
		$desc= $this->input->post('idesc');
		$p_type= $this->input->post('itype');

		$query= $this->db->query("select count(*)as cnt from  product_master where product_description='$desc' and prd_type=$p_type ");
		return $query->row('cnt');
		
	}

	function update_record() {
		$table_name= $this->input->post('table1');
		$column= $this->input->post('column');
		$attribute= $this->input->post('key_name1');
		$id= $this->input->post('post_id1');
		$value= $this->input->post('value');
		$query= $this->db->query("update $table_name set $column='$value' where $attribute='$id' ");
		return true;
	}

	
	function approve_record()
	{
		$approved_by=$this->session->userdata('user_id');
		$table_name= $this->input->post('table');
		$attribute= $this->input->post('key_name');
		$id= $this->input->post('post_id');
		$page_id= $this->input->post('page_id');
		$page_url= $this->input->post('page_url');

		$this->load->model('Setup_model');
		$status = $this->Setup_model->get_status_level($table_name,$attribute,$id);

		$value= $this->input->post('status_value');
		$query= $this->db->query("update $table_name set status=$value where $attribute=$id ");

		$this->Setup_model->add_approval_history($page_id, $id, $approved_by, $status, $page_url);

		return $id;
	}

	function ajax_get_requisition_items()
	{
		$id=implode(',',$this->input->post('req_id'));
		$query= $this->db->query("select * from purchase_requisition_transaction where req_master_id in($id)");
		return $query->result();
	}
	
	function delete_sales_estimation($estid,$enqid)
	{
		
		$query= $this->db->query("delete from sales_estimation_transaction where trans_id='$estid' ");
		$query= $this->db->query("delete from sales_estimation_master where estimate_id='$estid' ");
		//$query= $this->db->query("update enquiry_master set order_status=0  where enquiry_id='$enq_master_id' ");
		if($query)
		{
			return true;
		}
		else {
		    return false;
		}

	}
}
?>
