<?php

    class Users_model extends CI_Model {
 
    function add_new_user() 
	{
		$data = array(
		'user_name' => $this->input->post('first_name'),
		'email_id' => $this->input->post('company_email'),
		'password' => $this->input->post('password'),
		'contact_no' => $this->input->post('mobile1'),
		'department' => $this->input->post('department'),
		'address' => $this->input->post('address'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'country' => $this->input->post('country'),
		'gender' => $this->input->post('gender'),
		'bdate' => date('Y-m-d',strtotime($this->input->post('bdate'))),
		'created_by' => $this->session->userdata('user_id'),
		'created_date' => date('Y-m-d H:i')
		);
		$this->db->insert('users', $data);
		$insert_id = $this->db->insert_id();

		if($insert_id)
		{
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'users','user_id',$insert_id);
		}
		return $insert_id;
	}
        
    function update_user_data($user_id) 
	{
		$data = array(
		'department' => $this->input->post('department'),
		'contact_no' => $this->input->post('mobile1'),
		'address' => $this->input->post('address'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'country' => $this->input->post('country'),
		'gender' => $this->input->post('gender'),
		'bdate' => date('Y-m-d',strtotime($this->input->post('bdate'))),
		);
		$this->db->where('user_id',$user_id);
		$res = $this->db->update('users', $data);

		if($res)
		{
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['REQUEST_URI']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,2,$page_name[1],'users','user_id',$user_id);
			return true;
		}
		else
		{
			return false;
		}
	}
	function get_user_list($dept='')
	{
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('department_master dept','u.department = dept.dept_id','left');
		if($dept != ''){
			$this->db->where('dept.dept_name',$dept);
		}
		$query=$this->db->get();
		return $query->result();
	}

	// function get_sales_team_list()
	// {
	// 	//$query=$this->db->query("select u.* from users u where designation=1 order by user_id");
	// 	$this->db->select('')
	// 	return $query->result();
	// }

	// function get_active_user_list()
	// {
	// 	$query=$this->db->query("select u.*, d.dept_name from users u, department_master d where u.dept_id=d.dept_id and active=0 order by user_name");
	// 	return $query->result();
	// }

	function get_user_record_by_id($user_id)
	{
		$query=$this->db->query("select * from users where user_id='$user_id' ");
		return $query->result();
	}
	/////////////////  Customer master start  ///////////////////
	function add_customer_data()
	{
		
		$prifix='CM';
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'cust_code','customer_master',3)+1;
		$digit=sprintf("%1$04d",$num);
		$Code =$prifix.$digit;
   
		$data = array(
		'cust_code' => $Code,
		'cust_name' => $this->input->post('cust_name'),
		'email_id' => $this->input->post('email'),
		'contact_no' => $this->input->post('contact_no'),
		'trn_no' => $this->input->post('trn_no'),
		'billing_address' => $this->input->post('billing_addr1'),
		'billing_city' => $this->input->post('billing_city'),
		'billing_state' => $this->input->post('billing_state'),
		'billing_country' => $this->input->post('billing_country'),
		'billing_po_box' => $this->input->post('billing_po'),
		
		'shipping_address' => $this->input->post('shipping_addr1'),
		'shipping_city' => $this->input->post('shipping_city'),
		'shipping_state' => $this->input->post('shipping_state'),
		'shipping_country' => $this->input->post('shipping_country'),
		'shipping_po_box' => $this->input->post('shipping_po'),
		'created_date' => date('Y-m-d H:i:s'),
		'created_by'    => $this->session->userdata('user_id'),
		);
		$this->db->insert('customer_master', $data);
		$insert_id = $this->db->insert_id();
		
		//  $grp_no=30;
		//     $data1 = array(
		// 	'account_name' => $this->input->post('cust_name').' '.$Code,
		// 	'group_no' => $grp_no,
		// 	'customer_id' => $cust_id,
		// 	'opening_bal_type' => 'Dr',
		//     );
		//     $this->db->insert('general_ledger', $data1);
		//     $ledger_id=$this->db->insert_id();
		    
		if(isset($_POST['cp_name']))
		{
			for ($i = 0; $i < count($_POST['cp_name']); $i++)
			{
			     if($_POST['cp_name'][$i]!='')
			     {
			      $data = array(
				'cust_id' =>$insert_id,
				'cp_name' => $_POST['cp_name'][$i],
				'cp_mobile' => $_POST['cp_mobile'][$i],
				'cp_email' => $_POST['cp_email'][$i],
			      );
			      $this->db->insert('customer_contact_person', $data);
			      }
			}
	        }
	        
		if($insert_id)
		{
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['REQUEST_URI']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'customer_master','customer_id',$insert_id);
		}
		return $insert_id;
	}

	function update_customer_data($id)
	{
	    $data = array(
		'cust_name' => $this->input->post('cust_name'),
		'email_id' => $this->input->post('email'),
		'contact_no' => $this->input->post('contact_no'),
		'trn_no' => $this->input->post('trn_no'),
		'btype' => $this->input->post('btype'),
		'ctype' => $this->input->post('ctype'),
		'billing_address' => $this->input->post('billing_addr1'),
		'billing_city' => $this->input->post('billing_city'),
		'billing_state' => $this->input->post('billing_state'),
		'billing_country' => $this->input->post('billing_country'),
		'billing_po_box' => $this->input->post('billing_po'),
		
		'shipping_address' => $this->input->post('shipping_addr1'),
		'shipping_city' => $this->input->post('shipping_city'),
		'shipping_state' => $this->input->post('shipping_state'),
		'shipping_country' => $this->input->post('shipping_country'),
		'shipping_po_box' => $this->input->post('shipping_po'),
		
		//'active' => $this->input->post('active'),
		 );
		 $this->db->where('customer_id',$id);
		 $res = $this->db->update('customer_master', $data);
		 
		 if(isset($_POST['cp_name']))
		 {
			for ($i = 0; $i < count($_POST['cp_name']); $i++)
			{
			     if($_POST['cp_name'][$i]!='')
			     {
			      $data = array(
				'cust_id' =>$id,
				'cp_name' => $_POST['cp_name'][$i],
				'cp_mobile' => $_POST['cp_mobile'][$i],
				'cp_email' => $_POST['cp_email'][$i],
			      );
			      $this->db->insert('customer_contact_person', $data);
			      }
			}
	         }
	        if(isset($_POST['cp_name_old']))
		{
	        for ($i = 0; $i < count($_POST['cp_name_old']); $i++)
	        {
		      $trans_id= $_POST['trans_id'][$i];
		      $data = array(
			'cust_id' =>$id,
			'cp_name' => $_POST['cp_name_old'][$i],
			'cp_mobile' => $_POST['cp_mobile_old'][$i],
			'cp_email' => $_POST['cp_email_old'][$i],
		      );
			$this->db->where('cp_id',$trans_id);
			$res = $this->db->update('customer_contact_person', $data);
	        }
	        }
		if($res)
		{
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,2,$page_name[1],'customer_master','customer_id',$id);
			return true;
		}
		else
		{
			return false;
		}
	}

	function get_customer_by_id($id)
	{
		$query=$this->db->query("select * from customer_master where customer_id='$id'");
		return $query->result();
	}

	function get_customer_cp_details($id)
	{
		$query=$this->db->query("select * from customer_contact_person where cust_id='$id'");
		return $query->result();
	}

	function get_customer_list()
	{
		$query=$this->db->query("select * from customer_master order by cust_name");
		return $query->result();
	}

	// function get_active_customer_list()
	// {
	// 	$query=$this->db->query("select * from customer_master where active=0 order by cust_name");
	// 	return $query->result();
	// }
	
	/////////////////  Supplier master start  ///////////////////
	// function add_supplier_data()
	// {
	// 	//$prifix='CM'.date('y');
	// 	$prifix='SP';
	// 	$this->load->model('Setup_model');
	// 	$num = $this->Setup_model->get_next_code($prifix,'supplier_code','supplier_master',3)+1;
	// 	$digit=sprintf("%1$04d",$num);
	// 	$Code =$prifix.$digit;
   
	// 	$data = array(
	// 	'supplier_code' => $Code,
	// 	'supplier_name' => $this->input->post('cust_name'),
	// 	'supplier_type' => $this->input->post('stype'),
	// 	'website' => $this->input->post('website'),
	// 	'email_id' => $this->input->post('email'),
	// 	'contact_no' => $this->input->post('contact_no'),
	// 	'trn_no' => $this->input->post('trn_no'),
	// 	'billing_address' => $this->input->post('billing_addr1'),
	// 	'billing_city' => $this->input->post('billing_city'),
	// 	'billing_state' => $this->input->post('billing_state'),
	// 	'billing_country' => $this->input->post('billing_country'),
	// 	'billing_po_box' => $this->input->post('billing_po'),
		
	// 	'shipping_address' => $this->input->post('shipping_addr1'),
	// 	'shipping_city' => $this->input->post('shipping_city'),
	// 	'shipping_state' => $this->input->post('shipping_state'),
	// 	'shipping_country' => $this->input->post('shipping_country'),
	// 	'shipping_po_box' => $this->input->post('shipping_po'),
		
	// 	'bank_name' => $this->input->post('bname'),
	// 	'bank_account' => $this->input->post('acc_no'),
	// 	'bank_branch' => $this->input->post('branch'),
	// 	'bank_IBAN' => $this->input->post('iban'),
	// 	'bank_swift' => $this->input->post('swift'),
		
	// 	'intermidiate_Bname' => $this->input->post('int_bname'),
	// 	'intermidiate_Bacc' => $this->input->post('int_acc_no'),
	// 	'intermidiate_Bbranch' => $this->input->post('int_branch'),
	// 	'intermidiate_IBAN' => $this->input->post('int_iban'),
	// 	'intermidiate_swift' => $this->input->post('int_swift'),
		
	// 	'contact_person' => $this->input->post('cp_name'),
	// 	'contact_person_number' => $this->input->post('cp_mobile'),
	// 	//'remark' => $this->input->post('remark'),
	// 	'created_date' => date('Y-m-d H:i'),
	// 	'created_by'    => $this->session->userdata('user_id'),
	// 	);
	// 	$this->db->insert('supplier_master', $data);
	// 	$insert_id = $this->db->insert_id();
	// 	if($insert_id)
	// 	{
	// 	$user_se_id=$this->session->userdata('user_id');
	// 	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 	$ci = get_instance();
	// 	$ci->load->helper('log');
	// 	$log_msg=add_log_entry($user_se_id,1,$page_name[1],'supplier_master','supplier_id',$insert_id);
	// 	}
	// 	return $insert_id;
	// }

	// function update_supplier_data($id)
	// {
	//     $data = array(
	// 	'supplier_name' => $this->input->post('cust_name'),
	// 	'email_id' => $this->input->post('email'),
	// 	'contact_no' => $this->input->post('contact_no'),
	// 	'trn_no' => $this->input->post('trn_no'),
	// 	'website' => $this->input->post('website'),
	// 	'billing_address' => $this->input->post('billing_addr1'),
	// 	'billing_city' => $this->input->post('billing_city'),
	// 	'billing_state' => $this->input->post('billing_state'),
	// 	'billing_country' => $this->input->post('billing_country'),
	// 	'billing_po_box' => $this->input->post('billing_po'),
		
	// 	'shipping_address' => $this->input->post('shipping_addr1'),
	// 	'shipping_city' => $this->input->post('shipping_city'),
	// 	'shipping_state' => $this->input->post('shipping_state'),
	// 	'shipping_country' => $this->input->post('shipping_country'),
	// 	'shipping_po_box' => $this->input->post('shipping_po'),
		
		
	// 	'bank_name' => $this->input->post('bname'),
	// 	'bank_account' => $this->input->post('acc_no'),
	// 	'bank_branch' => $this->input->post('branch'),
	// 	'bank_IBAN' => $this->input->post('iban'),
	// 	'bank_swift' => $this->input->post('swift'),
		
	// 	'intermidiate_Bname' => $this->input->post('int_bname'),
	// 	'intermidiate_Bacc' => $this->input->post('int_acc_no'),
	// 	'intermidiate_Bbranch' => $this->input->post('int_branch'),
	// 	'intermidiate_IBAN' => $this->input->post('int_iban'),
	// 	'intermidiate_swift' => $this->input->post('int_swift'),
		
	// 	'contact_person' => $this->input->post('cp_name'),
	// 	'contact_person_number' => $this->input->post('cp_mobile'),
	// 	'active' => $this->input->post('active'),
	// 	 );
	// 	 $this->db->where('supplier_id',$id);
	// 	 $this->db->update('supplier_master', $data);
	// 	if($res)
	// 	{
	// 		$user_se_id=$this->session->userdata('user_id');
	// 		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 		$ci = get_instance();
	// 		$ci->load->helper('log');
	// 		$log_msg=add_log_entry($user_se_id,2,$page_name[1],'supplier_master','supplier_id',$id);
	// 		return true;
	// 	}
	// 	else
	// 	{
	// 		return false;
	// 	}
	// }

	// function get_supplier_by_id($id)
	// {
	// $query=$this->db->query("select * from supplier_master where supplier_id='$id'");
	// return $query->result();
	// }

	// function get_supplier_list()
	// {
	// $query=$this->db->query("select * from supplier_master order by supplier_name");
	// return $query->result();
	// }

	// function get_active_supplier_list()
	// {
	// 	$query=$this->db->query("select * from supplier_master where active=0 order by supplier_name");
	// 	return $query->result();
	// }

}?>
