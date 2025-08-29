<?php

    class Product_model extends CI_Model {
 
        function add_category_data() 
	{
		$query=$this->db->query("select coalesce(max(category_id),0)+1 as pid from category_master");
		$pid= $query->row('pid');
		
		$data = array(
		'category_name' => $this->input->post('cat_name'),
		'category_type' => $this->input->post('ctype'),
		'parent_id' => $pid,
		'child_id' => 0,
		'created_by' => $this->session->userdata('user_id'),
		'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('category_master', $data);
		$insert_id = $this->db->insert_id();

		if($insert_id)
		{
			
			if(isset($_POST['sub_atr_name']))
			{
			for ($i = 0; $i < count($_POST['sub_atr_name']); $i++)
		        {
		        	$query=$this->db->query("select coalesce(max(category_id),0)+1 as pid from category_master");
				$pid1= $query->row('pid');
		            try{
			      $data = array(
				'category_code' => $_POST['prefix'][$i],
				'category_name' => $_POST['sub_atr_name'][$i],
				'category_type' => $this->input->post('ctype'),
				'parent_id' => $pid1,
				'child_id' => $insert_id,
				'created_by' => $this->session->userdata('user_id'),
				'created_date' => date('Y-m-d H:i:s')
		
			      );
			      $this->db->insert('category_master', $data);
			      }
			      catch(Exception $e){
			      	return 'duplicate';
			      }
		        }
		        }
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'category_master','category_id',$insert_id);
		}
		return $insert_id;
	}
        
       function update_attribute_data($cat_id) 
	{
		

		if($cat_id)
		{
			if(isset($_POST['sub_atr_name']))
			{
			for ($i = 0; $i < count($_POST['sub_atr_name']); $i++)
		        {
		        	$query=$this->db->query("select coalesce(max(category_id),0)+1 as pid from category_master");
				$pid1= $query->row('pid');
				
			      $data = array(
				//'category_code' => $_POST['prefix'][$i],
				'category_name' => $_POST['sub_atr_name'][$i],
				//'category_type' => $this->input->post('ctype'),
				'parent_id' => $pid1,
				'child_id' => $cat_id,
				'created_by' => $this->session->userdata('user_id'),
				'created_date' => date('Y-m-d H:i:s')
			      );
			      $this->db->insert('category_master', $data);
		        }
		        }
		        if(isset($_POST['sub_atr_name_old']))
			{
		        for ($i = 0; $i < count($_POST['sub_atr_name_old']); $i++)
		        {
	        		$trans_id= $_POST['trans_id'][$i];
			      	$data = array(
				'category_name' => $_POST['sub_atr_name_old'][$i],
			      	);
				$this->db->where('category_id',$trans_id);
				$res = $this->db->update('category_master', $data);
			      
		        }
		        }
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,2,$page_name[1],'category_master','category_id',$cat_id);
			return true;
		}
		else
		{
			return false;
		}
	}
	
		
	function get_category_code_by_id($cat_id)
	{
		$query=$this->db->query("select category_code from category_master where category_id=$cat_id");
		return $category_code= $query->row('category_code');
	}

	function get_max_cat_code()
	{
		$query=$this->db->query("select max(category_code)+1 as category_code from category_master");
		return $query->row('category_code');
	}
	function get_main_category_list()
	{
		$query=$this->db->query("select * from category_master where child_id=0 order by category_name");
		return $query->result();
	}

	function get_category_record_by_id($id)
	{
		$query=$this->db->query("select * from category_master where category_id='$id' ");
		return $query->result();
	}
	function get_attribute_transaction_by_id($id)
	{
		$query=$this->db->query("select * from category_master where child_id='$id' and is_cancelled=0 ");
		return $query->result();
	}
	// function get_sub_category_list()
	// {
	// 	$query=$this->db->query("select one.*, two.category_name as pname from(select * from category_master where child_id!=0 order by category_name)as one left join(select * from category_master where child_id=0)as two on(one.child_id=two.parent_id)");
	// 	return $query->result();
	// }
	
	function get_sub_category_list($cat){
		$query=$this->db->query("select * from category_master where child_id = '$cat' order by category_name");
		return $query->result_array();
	}

	function update_sub_category($attr_id) 
	{
		$data = array(
		'category_name' => $this->input->post('attr_name'),
		);
		$this->db->where('category_id',$attr_id);
		$res = $this->db->update('category_master', $data);

		if($res)
		{
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,2,$page_name[1],'category_master','category_id',$cat_id);
			return true;
		}
	}
	function add_sub_category_data()
	{
		if(isset($_POST['sub_atr_name']))
		{
		for ($i = 0; $i < count($_POST['sub_atr_name']); $i++)
	        {
	        	$query=$this->db->query("select coalesce(max(category_id),0)+1 as pid,category_type  from category_master");
			$details1= $query->result();
			foreach($details1 as $k)
			{
				$category_type= $k->category_type;
				$pid1= $k->pid;
			}
	            try{
		      $data = array(
			'category_code' => $_POST['prefix'][$i],
			'category_name' => $_POST['sub_atr_name'][$i],
			'category_type' => $category_type,
			'parent_id' => $pid1,
			'child_id' => $this->input->post('cat_id'),
			'created_by' => $this->session->userdata('user_id'),
			'created_date' => date('Y-m-d H:i:s')
	
		      );
		      $this->db->insert('category_master', $data);
		      }
		      catch(Exception $e){
		      	return 'duplicate';
		      }
	        }
	        }
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'category_master','category_id',$this->input->post('cat_id'));
	}
	/////////////////  Product master start  ///////////////////
	function add_product_data()
	{
		$type = $this->input->post('itype');
		$prd =  $this->input->post('prd_type');
		$desc=$this->input->post('desc');
		$sanitized_idesc =  mysqli_real_escape_string($this->db->conn_id, $desc); 
		$product_code = $this->input->post('pcode');
		$len = $this->input->post('length');
		$height = $this->input->post('height');
		$clr =  $this->input->post('colour');
		$unit_price = $this->input->post('price');
		
		
			
		$data = array(
			'prd_category' => $type,
			'prd_subcat' =>$prd,
			'product_code' => $product_code,
			'product_description' => $sanitized_idesc,				
			'colour_code' => $clr,
			'length' => $this->input->post('length'),
			'height' => $this->input->post('height'),
			'unit_price' => $this->input->post('price'),
			'created_date' => date('Y-m-d'),
			'created_by'    => $this->session->userdata('user_id'),
		);
				
		
		
		$this->db->insert('product_master', $data);
		$insert_id = $this->db->insert_id();
		if($insert_id)
		{
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'product_master','product_id',$insert_id);
		}
		return $insert_id;
	}
	function update_product_data($id)
	{
		$desc=$this->input->post('desc');
		$sanitized_idesc =  mysqli_real_escape_string($this->db->conn_id, $desc); 
		
			
		$data = array(
			'prd_subcat' =>$this->input->post('prd_type'),
			'product_code' => $this->input->post('pcode'),
			'product_description' => $sanitized_idesc,				
			'colour_code' => $this->input->post('colour'),
			'length' => $this->input->post('length'),
			'height' => $this->input->post('height'),
			'unit_price' => $this->input->post('price'),
		);
				
		
		$this->db->where('product_id',$id);
		$res = $this->db->update('product_master', $data);
		if($res)
		{
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,2,$page_name[1],'product_master','product_id',$id);
		}
		return $res;
	}
	

	function get_product_by_id($id)
	{
	$query=$this->db->query("select * from product_master where product_id='$id'");
	return $query->result();
	}

	

	function get_product_list()
	{
	$query=$this->db->query("select * from product_master pm left join category_master cm on pm.prd_subcat=cm.category_id order by product_id ");
	return $query->result();
	}

	function get_active_product_list()
	{
		$query=$this->db->query("select * from item_master where cancelled=0 order by item_code");
		return $query->result();
	}
	function ajax_get_item_code($category_code, $cat_id)
	{
		
		$query=$this->db->query("select count(*)+1 as tcnt from item_master where item_code like '$category_code%' and category_id=$cat_id ");
		return $query->row('tcnt');
	}
	function get_product_list_by_category($enq_type)
	{
		$query=$this->db->query("select * from product_master where prd_category='$enq_type' ");
		return $query->result();
	}

}?>
