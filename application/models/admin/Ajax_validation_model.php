<?php

class Ajax_validation_model extends CI_Model {

	function get_category_group_exist()///For Category Group
	{
		$name=$this->input->post('category_name');
		$query = $this->db->query("select count(*) as ucount from category_master where category_name ='$name';");
		return $query->row('ucount');
	}
	
	function get_category_exist()///For Category
	{
		$name=$this->input->post('category_name');
		$query = $this->db->query("select count(*) as ucount from category_data_entity where category_name ='$name';");
		return $query->row('ucount');
	}
	
	function get_category_data_exist()///For Category Data Entry
	{
		$name=$this->input->post('category_name');
		$query = $this->db->query("select count(*) as ucount from category_data_entity where category_name ='$name';");
		return $query->row('ucount');
	}
	
	function get_schema_exist()
	{
		$zone_id=$this->input->post('zone_id');
		$division_id=$this->input->post('division_id');
		$sub_category_id=$this->input->post('sub_category_id');
		$billing_freq=$this->input->post('billing_freq');
		$billing_bedwise=$this->input->post('billing_bedwise');
		$assured_rate_type=$this->input->post('assured_rate_type');
		
		$query = $this->db->query("select count(*) as ucount from billing_schema where zone_id='$zone_id' and division_id='$division_id' and category_id='$sub_category_id' and billing_freq='$billing_freq' and billing_bedwise='$billing_bedwise' and assured_rate_type='$assured_rate_type'");
		return $query->row('ucount');
	}
	function get_division_exist()
	{
		$name=$this->input->post('division_name');
		$query = $this->db->query("select count(*) as ucount from division_data_entity where name ='$name';");
		return $query->row('ucount');
	}
	function get_route_no_exist()
	{
		$name=$this->input->post('mobile_no');
		$id=$this->input->post('id');
		if($id=='')
		{
			$query = $this->db->query("select count(*) as ucount from routemaster where route_mobile_number='$name'");	
		}
		else
		{
			$query = $this->db->query("select count(*) as ucount from routemaster where route_master_id!='$id' and route_mobile_number='$name'");
		}	
		
		return $query->row('ucount');
	}
	
	function get_account_name_exist()
	{
		$name=$this->input->post('ac_name');
		/*$id=$this->input->post('id');
		if($id=='')
		{*/
			$query = $this->db->query("select count(*) as ucount from general_ledger where account_name='$name'");	
		/*}
		else
		{
			$query = $this->db->query("select count(*) as ucount from general_ledger where account_id!='$id' and account_name='$name'");
		}*/	
		
		return $query->row('ucount');
	}
	
	function get_facility_exist()
	{
		$name=$this->input->post('facility_name');
		$query = $this->db->query("select count(*) as ucount from facility_data_entity where facility_name ='$name';");
		return $query->row('ucount');
	}
	function get_waste_category_exist()
	{
		$cat_no=$this->input->post('category_number');
		$query = $this->db->query("select count(*) as ucount from waste_category_master where cat_number ='$cat_no';");
		return $query->row('ucount');
	}
	function get_corporation_exist()
    {
        $name=$this->input->post('corp_name');
        $query = $this->db->query("select count(*) as ucount from  corporation_data_entity where corp_name ='$name';");
        return $query->row('ucount');
    }
    function get_order_exist()
    {
        $no=$this->input->post('order_no');
        $query = $this->db->query("select count(*) as ucount from  Orders where order_no ='$no';");
        return $query->row('ucount');
    }
    function get_unit_exist()
    {
        $unit=$this->input->post('unit_desc');
        $query = $this->db->query("select count(*) as ucount from plants_master where p_name ='$unit';");
        return $query->row('ucount');
    }
    function get_company_locations_exist()
    {
        $name=$this->input->post('loc_name');
        $query=$this->db->query("select count(*) as ucount from company_location where loc_name='$name';");
        return $query->row('ucount');
    }
    function get_barcode_sticker_color_exists()
	{
		$color_id=$this->input->post('color_id');
		$query = $this->db->query("select count(*) as ucount from bag_data_entity where color_id='$color_id' and is_sticker='Y' and size_no=1");
		return $query->row('ucount');
	}
	
	function get_occupier_records()
	{
	    $name = $this->input->post('name');
		$type = $this->input->post('type');
		$query=$this->db->query("SELECT cust_code,occu_name,occupier_id,gst_number FROM bmwregistration where $type LIKE '%$name%' LIMIT 40");
		return $query->result();
	}
    
    function get_prefix_exist()
    {
        $div_prefix=$this->input->post('prefix');
        $query = $this->db->query("select count(*) as ucount from division_data_entity where div_prefix ='$div_prefix';");
        return $query->row('ucount');
    }    
    /**************************************************************************************************/
}
