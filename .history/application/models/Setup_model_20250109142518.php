<?php
	class Setup_model extends CI_Model {
	
	function get_next_code($prifix,$column,$table,$sublen)
  	{
	    $query=$this->db->query("select max(substr($column,$sublen))as count from $table where $column like '%$prifix%'");
	    return $query->row('count');
  	}
	//////////////// users start ///////////////
	function get_company_master_list() {
	    $query = $this->db->query("select * from company_master cm LEFT join company_bank_details cb on cm.company_id=cb.company_id ");
	    return $query->result();
        }
        function get_company_bank_list() {
	    $query = $this->db->query("select * from company_bank_details ");
	    return $query->result();
        }
        function get_company_stamp_list() {
	    $query = $this->db->query("select * from company_stamp_image ");
	    return $query->result();
        }
        
  	function update_company_record_by_id()
  	{
  		$id=1;
		$data = array(
		'company_name' => $this->input->post('company_name'),
		'company_address' => $this->input->post('company_address'),
		'company_city' => $this->input->post('company_city'),
		'company_state' => 'Maharashtra',
		'company_pincode' => $this->input->post('company_pincode'),
		'company_country' => $this->input->post('company_country'),
		'company_email_id' => $this->input->post('company_email_id'),
		'company_telephone' => $this->input->post('company_telephone'),
		'company_TRN' => $this->input->post('company_trn'),		
		'company_website' => $this->input->post('website'),	
		);
		$this->db->where('company_id',$id);
		$this->db->update('company_master', $data);
		
		if(isset($_POST['bname']))
		{
			for ($i = 0; $i < count($_POST['bname']); $i++)
			{
			     if($_POST['bname'][$i]!='')
			     {
			      $data = array(
				'company_id' =>1,
				'bank_name' => $_POST['bname'][$i],
				'bank_account' => $_POST['bacc'][$i],
				'bank_branch' => $_POST['bbranch'][$i],
				'bank_iban' => $_POST['biban'][$i],
				'bank_swift' => $_POST['bswift'][$i],
			      );
			      $this->db->insert('company_bank_details', $data);
			      }
			}
	        }
	        
	        if(isset($_POST['bname_old']))
		{
	        for ($i = 0; $i < count($_POST['bname_old']); $i++)
	        {
		      $trans_id= $_POST['trans_id'][$i];
		      $data = array(
			'company_id' =>1,
			'bank_name' => $_POST['bname_old'][$i],
			'bank_account' => $_POST['bacc_old'][$i],
			'bank_branch' => $_POST['bbranch_old'][$i],
			'bank_iban' => $_POST['biban_old'][$i],
			'bank_swift' => $_POST['bswift_old'][$i],
		      );
			$this->db->where('bid',$trans_id);
			$res = $this->db->update('company_bank_details', $data);
	        }
	        }
		
		if(isset($_POST['image_name']))
		{
			for ($i = 0; $i < count($_POST['image_name']); $i++)
			{
			     if($_POST['image_name'][$i]!='')
			     {
			     	$stamp_image = base64_encode(file_get_contents($_FILES['stamp_image']['tmp_name'][$i]));
			      $data = array(
				'company_id' =>1,
				'stamp_name' => $_POST['image_name'][$i],
				'stamp_image' => $stamp_image,
			      );
			      $this->db->insert('company_stamp_image', $data);
			      }
			}
	        }
	        
	                
		$insert_id=$this->db->insert_id();
		$uid = $this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($uid,2,$page_name[1],'company_master','company_id',$id);
		return $id;
	}
	/////////////////  Tax/ Vat start  ///////////////////
	// function add_tax_data()
	// {
	// 	$data = array(
	// 	'vat_percent'  => $this->input->post('vat_percent'),
	// 	'applicable_date'  => date('Y-m-d',strtotime($this->input->post('applicable_date'))),
	// 	'created_by'  =>$this->session->userdata('user_id'),
	// 	);
	// 	$this->db->insert('vat_master', $data);
	// 	$insert_id = $this->db->insert_id();
	// 	if($insert_id)
	// 	{
	// 	$user_se_id=$this->session->userdata('user_id');
	// 	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 	$ci = get_instance();
	// 	$ci->load->helper('log');
	// 	$log_msg=add_log_entry($user_se_id,1,$page_name[1],'vat_master','vat_id',$insert_id);

	// 	}
	// 	return $insert_id;
	// }

	// function update_tax_data($id)
	// {
	// 	$data = array(
	// 	'vat_percent'  => $this->input->post('vat_percent'),
	// 	'applicable_date' => date('Y-m-d',strtotime($this->input->post('applicable_date'))),
	// 	);
	// 	$this->db->where('vat_id',$id);
	// 	$this->db->update('vat_master', $data);
	// 	if($id)
	// 	{
	// 	$user_se_id=$this->session->userdata('user_id');
	// 	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 	$ci = get_instance();
	// 	$ci->load->helper('log');
	// 	$log_msg=add_log_entry($user_se_id,21,$page_name[1],'vat_master','vat_id',$id);
	// 	}
	// 	return $id;
	// }

	// function get_tax_by_id($id)
	// {
	// 	$query=$this->db->query("select * from vat_master where vat_id='$id'");
	// 	return $query->result();
	// }

	// function get_tax_list()
	// {
	// 	$query=$this->db->query("select * from vat_master order by applicable_date desc ");
	// 	return $query->result();
	// }

	// function get_vat_for_calculation()
	// {
	// 	$query=$this->db->query("select vat_percent from vat_master order by applicable_date desc limit 1");
	// 	return $query->row('vat_percent');
	// }
	/////////////////  packing_type start  ///////////////////
	// function add_packing_type()
	// {
	// 	$data = array(
	// 	'ptype'  => $this->input->post('ptype'),
	// 	//'quantity'  => $this->input->post('qty'),
	// 	'created_by'  =>$this->session->userdata('user_id'),
	// 	);
	// 	$this->db->insert('packing_type', $data);
	// 	$insert_id = $this->db->insert_id();
	// 	if($insert_id)
	// 	{
	// 	$user_se_id=$this->session->userdata('user_id');
	// 	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 	$ci = get_instance();
	// 	$ci->load->helper('log');
	// 	$log_msg=add_log_entry($user_se_id,1,$page_name[1],'packing_type','sno',$insert_id);

	// 	}
	// 	return $insert_id;
	// }

	// function update_packing_type_data($id)
	// {
	// 	$data = array(
	// 	'ptype'  => $this->input->post('ptype'),
	// 	//'quantity'  => $this->input->post('qty'),
	// 	);
	// 	$this->db->where('sno',$id);
	// 	$this->db->update('packing_type', $data);
	// 	if($id)
	// 	{
	// 	$user_se_id=$this->session->userdata('user_id');
	// 	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 	$ci = get_instance();
	// 	$ci->load->helper('log');
	// 	$log_msg=add_log_entry($user_se_id,21,$page_name[1],'packing_type','sno',$id);
	// 	}
	// 	return $id;
	// }

	// function get_packing_type_by_id($id)
	// {
	// 	$query=$this->db->query("select * from packing_type where sno='$id'");
	// 	return $query->result();
	// }

	// function get_packing_type_list()
	// {
	// 	$query=$this->db->query("select * from packing_type order by ptype ");
	// 	return $query->result();
	// }
	/////////////// currency_list /////////////////
	// function add_currency_data() {
	// 	$data = array(
	// 	'currency' => $this->input->post('currency'),
	// 	'currabrev' => $this->input->post('currabrev'),
	// 	'country' => $this->input->post('country'),
	// 	'rate' => $this->input->post('rate'),
	// 	'remark' => $this->input->post('remark'),
	// 	'created_by' => $this->session->userdata('user_id'),
	// 	);
	// 	$this->db->insert('currency_master', $data);
	// 	$insert_id = $this->db->insert_id();

	// 	if($insert_id)
	// 	{
	// 	$user_se_id=$this->session->userdata('user_id');
	// 	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 	$ci = get_instance();
	// 	$ci->load->helper('log');
	// 	$log_msg=add_log_entry($user_se_id,1,$page_name[1],'currency_master','id',$insert_id);
	// 	}
	// 	return $insert_id;
	// }

	// function update_currency_data() 
	// {
	// 	$id = $this->input->post('id');

	// 	if($this->input->post('status') == 1)
	// 	{
	// 	$inactive_date = date('Y-m-d', strtotime($this->input->post('inactive_date')));
	// 	}
	// 	else {
	// 	$inactive_date ="";
	// 	}

	// 	$data = array(
	// 	'currency' => $this->input->post('currency'),
	// 	'currabrev' => $this->input->post('currabrev'),
	// 	'country' => $this->input->post('country'),
	// 	'rate' => $this->input->post('rate'),
	// 	'remark' => $this->input->post('remark'),
	// 	'status' => $this->input->post('status'),
	// 	'inactive_date' => $inactive_date
	// 	);
	// 	$this->db->where('id',$id);
	// 	$this->db->update('currency_master', $data);
	// 	if($id)
	// 	{
	// 	$user_se_id=$this->session->userdata('user_id');
	// 	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 	$ci = get_instance();
	// 	$ci->load->helper('log');
	// 	$log_msg=add_log_entry($user_se_id,2,$page_name[1],'currency_master','id',$id);
	// 	return true;
	// 	}
	// 	else
	// 	{
	// 	return false;
	// 	}
	// }
	// function get_currency_list() {
	// 	$query = $this->db->query("select * from currency_master order by country");
	// 	return $query->result();
	// }

	// function get_currency_by_id($id) {
	// 	$query = $this->db->query("select * from currency_master where id = '$id'");
	// 	return $query->result();
	// }
	//////////////////////// department /////////////
	function add_department_data() 
	{
		$data = array(
		'dept_name' => $this->input->post('dept_name'),
		'remark' => $this->input->post('remark'),
		'created_by' => $this->session->userdata('user_id')
		);
		$this->db->insert('department_master', $data);
		$insert_id = $this->db->insert_id();

		if($insert_id)
		{
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'department_master','dept_id',$insert_id);
		}
		return $insert_id;
	}
	function update_department_data($dept_id) 
	{
		$data = array(
		'dept_name' => $this->input->post('dept_name'),
		'remark' => $this->input->post('remark'),
		'status' => $this->input->post('status'),
		);
		$this->db->where('dept_id',$dept_id);
		$res = $this->db->update('department_master', $data);

		if($res)
		{
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,2,$page_name[1],'department_master','dept_id',$dept_id);
		return true;
		}
		else
		{
		return false;
		}
	}
	function get_department_list()
	{
		$query=$this->db->query("select * from department_master order by dept_name");
		return $query->result();
	}

	function get_active_department_list()
	{
		$query=$this->db->query("select * from department_master where status=0 order by dept_name");
		return $query->result();
	}

	function get_department_record_by_id($dept_id)
	{
		$query=$this->db->query("select * from department_master where dept_id='$dept_id' ");
		return $query->result();
	}
	
	//////////////// users start ///////////////

	function get_active_employee_list()
	{
		$query=$this->db->query("select * from users where active=0 order by user_name");
		return $query->result();
	}

	//job types
	function get_job_types(){
		$this->db->select('*');
		$this->db->from('job_types');
		$res = $this->db->get()->result();

		return $res;
	}

	function get_job_type_by_id($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$res = $this->db->get('job_types')->result();
		return $res;
	}
	//////////////// Employee start ///////////////
	// function add_employee_data()
	// {   
	// 	$data = array(      
	// 	'user_name'  => $this->input->post('first_name'),
	// 	'email_id'  => $this->input->post('company_email'),
	// 	'password'  => $this->input->post('password'),
	// 	'mobile_no' => $this->input->post('mobile1'),
	// 	'group_id' => $this->input->post('department'),
	// 	'area_id' => implode(',',$this->input->post('area_id')),
	// 	'created_date' => date('Y-m-d'),           
	// 	);
	// 	$this->db->insert('users', $data);
	// 	$insert_id = $this->db->insert_id();

	// 	if($this->input->post('department')==2)
	// 	{      
	// 		$x= array(
	// 		'address'  => $this->input->post('address'),
	// 		'aadhar_no'  => $this->input->post('aadhar_no'),
	// 		'pan_no'  => $this->input->post('pan_no'),
	// 		'activation_date'  => date('Y-m-d',strtotime($this->input->post('rdate'))),
	// 		'expiry_date'  => date('Y-m-d',strtotime($this->input->post('exdate')))
	// 		);
	// 		$this->db->where('user_id',$insert_id);
	// 		$this->db->update('users', $x);
			
	// 		$grp_no=7; 
	// 		    $data1 = array(
	// 			'account_name' => $this->input->post('first_name').' - '.$insert_id,
	// 			'group_no' => $grp_no,
	// 			'customer_id' => $insert_id,
	// 			'opening_bal_type' => 'Dr',
	// 		    );
	// 		    $this->db->insert('general_ledger', $data1);
	// 		    $ledger_id=$this->db->insert_id();
	// 	}

	// 	$allowedExts = array("jpeg","jpg","png","doc","pdf");
	// 	$data['file_name']=$_FILES["file_upload"]["name"];
	// 	$temp = explode(".", $_FILES["file_upload"]["name"]);
	// 	$extension = end($temp);
	// 	if (($_FILES["file_upload"]["size"] < 15728640) && in_array($extension, $allowedExts))
	// 	{
	// 	      if ($_FILES["file_upload"]["error"] > 0)
	// 	      {
	// 		$this->session->set_flashdata('error','Failed to upload - Please check file size and file format');
	// 	      }
	// 	      else
	// 	      {
	// 	      		//$ext = pathinfo($_FILES["file_upload"], PATHINFO_EXTENSION);
	// 			$timestamp1=time();
	// 			$image_name = $timestamp1."_".$_FILES['file_upload']['name'];			
	// 			//move_uploaded_file($file_tmp,"/home/webadmin/gen/rise_shine/public/user_documents/".$image_name);
	// 			move_uploaded_file($file_tmp,"https://app.risenshine.in/public/user_documents/".$image_name);
				
	// 			$data = array(
	// 				'user_id'  => $insert_id,
	// 				'file_name'  => $image_name,
	// 				'file_type'  => $extension,
	// 				'uploaded_date'  => date('Y-m-d'),
	// 			);
	// 			$this->db->insert('user_document_upload', $data);
	// 	      }
	// 	}  



	// 	if($insert_id)
	// 	{
	// 	$user_se_id=$this->session->userdata('user_id');
	// 	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 	$ci = get_instance();
	// 	$ci->load->helper('log');
	// 	$log_msg=add_log_entry($user_se_id,1,$page_name[1],'users','user_id',$insert_id);
	// 	}
	// 	return $insert_id;
	// 	}

	// 	function update_employee_data($id)
	// 	{

	// 	$data = array(
	// 	//'first_name'  => $this->input->post('first_name'),
	// 	'mobile_no'  => $this->input->post('mobile1'),
	// 	'area_id' => implode(',',$this->input->post('area_id')),
	// 	);
	// 	$this->db->where('user_id',$id);
	// 	$this->db->update('users', $data);

	// 	if($this->input->post('department_id')==2)
	// 	{      
	// 	      $x= array(
	// 	      'address'  => $this->input->post('address'),
	// 	      'aadhar_no'  => $this->input->post('aadhar_no'),
	// 	      'pan_no'  => $this->input->post('pan_no'),
	// 	      'activation_date'  => date('Y-m-d',strtotime($this->input->post('rdate'))),
	// 	      'expiry_date'  => date('Y-m-d',strtotime($this->input->post('exdate')))
	// 	      );
	// 		$this->db->where('user_id',$id);
	// 		$this->db->update('users', $x);
	// }

	// if(isset($_FILES["file_upload"]))
	// {
	// 	    $allowedExts = array("jpeg","jpg","png","doc","pdf");
	// 	    $data['file_name']=$_FILES["file_upload"]["name"];
	// 	    $temp = explode(".", $_FILES["file_upload"]["name"]);
	// 	    $extension = end($temp);
	// 	    if (($_FILES["file_upload"]["size"] < 15728640) && in_array($extension, $allowedExts))
	// 	    {
	// 		      if ($_FILES["file_upload"]["error"] > 0)
	// 		      {
	// 			$this->session->set_flashdata('error','Failed to upload - Please check file size and file format');
	// 		      }
	// 		      else
	// 		      {
	// 				$timestamp1=time();
	// 		      		//$ext = pathinfo($_FILES["file_upload"], PATHINFO_EXTENSION);
	// 				$image_name = $timestamp1."_".$_FILES['file_upload']['name'];			
	// 				move_uploaded_file($file_tmp,"https://app.risenshine.in/public/user_documents/".$image_name);
								
	// 				$data = array(
	// 				      'user_id'  => $id,
	// 				      'file_name'  => $image_name,
	// 				      'file_type'  => $extension,
	// 				      'uploaded_date'  => date('Y-m-d'),
	// 				);
	// 				$this->db->insert('user_document_upload', $data);
	// 		      }
	// 	    }  
	// }
	// if($id)
	// {
	// $user_se_id=$this->session->userdata('user_id');
	// $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// $ci = get_instance();
	// $ci->load->helper('log');
	// $log_msg=add_log_entry($user_se_id,2,$page_name[1],'users','user_id',$id);

	// }
	// return $id;
	// }

	// function get_employee_list()
	// {
	// // $query=$this->db->query("select * from employee_master");
	// $query=$this->db->query("select one.*, two.group_name from (select * from users where user_id>0) as one left join ( select group_id ,group_name from group_master) as two on (one.group_id=two.group_id) order by one.user_name");
	// return $query->result();
	// }

	// function get_employee_documents_by_id($id)
	// {
	// $query=$this->db->query("select * from user_document_upload where user_id=$id order by uploaded_date desc");
	// return $query->result();
	// }


	// function get_employee_details_by_id($id)
	// {
	// $query=$this->db->query("select * from users where user_id='$id'");
	// return $query->result();
	// }
	////////////////// Access control ///////////////
	function get_menu_list()
	{
	$query= $this->db->query("select * from menu_access where menu_sid=0 and active=0");
	return $query->result();
	}
	function get_all_menu_list()
	{
	$query= $this->db->query("select * from menu_access where active=0");
	return $query->result();
	}
	function add_access_control()
	{
		$uid=$this->input->post('user_id');
		$query= $this->db->query("delete from user_access where user_id='$uid' and resource_type='M'");
		$query= $this->db->query("delete from page_access where user_id='$uid'");

		if(isset($_POST['check']))
		{
			for ($i = 0; $i < count($_POST['check']); $i++)
			{
			$access_id=$_POST['check'][$i];

			$data = array(
			'user_id' => $uid,
			'access_id'   => $access_id,
			'resource_type'   => 'M',

			);
			$this->db->insert('user_access', $data);
			}
			$insert_id = $this->db->insert_id() ;
		}
		if(isset($_POST['check_add']))
		{
			for ($i = 0; $i < count($_POST['check_add']); $i++)
			{
			$access_id=$_POST['check_add'][$i];
			$page_id= $this->get_page_id($access_id,'add');

			$data = array(
			'user_id' => $uid,
			'menu_id'   => $access_id,
			'page_id'   => $page_id,
			'attribute'   => 'A',

			);
			$this->db->insert('page_access', $data);
			}
		}
		if(isset($_POST['check_edit']))
		{
			for ($i = 0; $i < count($_POST['check_edit']); $i++)
			{
			$access_id=$_POST['check_edit'][$i];
			$page_id= $this->get_page_id($access_id,'edit');

			$data = array(
			'user_id' => $uid,
			'menu_id'   => $access_id,
			'page_id'   => $page_id,
			'attribute'   => 'E',

			);
			$this->db->insert('page_access', $data);
			}
		}
		if(isset($_POST['check_delete']))
		{
			for ($i = 0; $i < count($_POST['check_delete']); $i++)
			{
			$access_id=$_POST['check_delete'][$i];
			$page_id= $this->get_page_id($access_id,'list');

			$data = array(
			'user_id' => $uid,
			'menu_id'   => $access_id,
			'page_id'   => $page_id,
			'attribute'   => 'D',

			);
			$this->db->insert('page_access', $data);
			}
		}
	
		if($insert_id)
		{
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'user_access','access_id',$insert_id);
		}
		return $uid;
	}
	function get_page_id($menu_id,$page_type)
	{
		$query= $this->db->query("select menu_url from menu_access where menu_id='$menu_id'");
		$menu_url=$query->row('menu_url');
		$query= $this->db->query("select page_name from breadcrumb where page_url='$menu_url'");
		$page_name=$query->row('page_name');
		if($page_name!=''){
			$query= $this->db->query("select page_id from breadcrumb where page_name='$page_name' and page_type='$page_type' ");
			$page_id=$query->row('page_id');
			return $page_id;
		}
		return 0;
	}

       ////////////// terms and condition /////////////////
       
	
	// function get_terms_details()
	// {
	// 	$query=$this->db->query("select * from terms_details group by term_name");
	// 	return $query->result();
	// }
	// function get_terms_details_by_id($id)
	// {
	// 	$query=$this->db->query("select * from terms_details where term_name='$id'");
	// 	return $query->result();
	// }
	// function get_terms_all_details()
	// {
	// 	$query=$this->db->query("select * from terms_details");
	// 	return $query->result();
	// }
	
	// function add_terms_details()
	// {
	// 	$data = array(
	// 	'term_name'  => $this->input->post('term'),
	// 	'notes'  => $this->input->post('details1'),
	// 	);
	// 	$this->db->insert('terms_details', $data);
	// 	$insert_id = $this->db->insert_id();
			
	// 	$user_se_id=$this->session->userdata('user_id');
	// 	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 	$ci = get_instance();
	// 	$ci->load->helper('log');
	// 	$log_msg=add_log_entry($user_se_id,1,$page_name[1],'terms_details','tid',$tid);
	// }
	// function update_terms_details($tid,$tname)
	// {
	// 	$query=$this->db->query("delete from terms_details where term_name='$tname'");
		
	// 	for ($i = 0; $i < count($_POST['details']); $i++)
	// 	{
	// 	    	$data = array(
	// 		'term_name'  => $tname,
	// 		'notes'  => $_POST['details'][$i],
	// 		);
	// 		$this->db->insert('terms_details', $data);
	// 		$insert_id = $this->db->insert_id();
	// 	}
	  
			
	// 	$user_se_id=$this->session->userdata('user_id');
	// 	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	// 	$ci = get_instance();
	// 	$ci->load->helper('log');
	// 	$log_msg=add_log_entry($user_se_id,2,$page_name[1],'terms_details','tid',$tid);
	// }
	
	//////////////  unit start  ///////////////////

	//   function add_units()
	//   {
	//     $data = array(
	//       'unit_name'  => $this->input->post('uname'),
	//       'unit_abbr'  => $this->input->post('uabbr'),
	//       'unit_type'  => $this->input->post('utype'),
	//       'conversion'  => $this->input->post('cf'),
	//       //'base_unit'  => $this->input->post('bunit')
	//     );
	//     $this->db->insert('unit_master', $data);
	//     if($insert_id)
	//     {
	//       $user_se_id=$this->session->userdata('user_id');
	//       $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	//       $ci = get_instance();
	//       $ci->load->helper('log');
	//       $log_msg=add_log_entry($user_se_id,1,$page_name[1],'unit_master','unit_id',$insert_id);

	//     }
	//     return $insert_id = $this->db->insert_id();
	//   }

	//   function update_units()
	//   {
	//     $unit_id=$this->input->post('uid');
	//     $data = array(
	//       //'unit_name'  => $this->input->post('uname'),
	//       //'unit_abbr'  => $this->input->post('uabbr'),
	//       'unit_type'  => $this->input->post('utype'),
	//       'conversion'  => $this->input->post('cf'),
	//       //'base_unit'  => $this->input->post('bunit')
	//     );
	//     $this->db->where('unit_id',$unit_id);
	//     $this->db->update('unit_master', $data);
	//     if($id)
	//     {
	//       $user_se_id=$this->session->userdata('user_id');
	//       $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	//       $ci = get_instance();
	//       $ci->load->helper('log');
	//       $log_msg=add_log_entry($user_se_id,2,$page_name[1],'unit_master','unit_id',$id);

	//     }
	//     return $unit_id;
	//   }

	//   function get_unit_list()
	//   {
	//     $query=$this->db->query("select * from unit_master order by unit_name");
	//     return $query->result();
	//   }

	//   function get_active_unit_list()
	//   {
	//     $query=$this->db->query("select * from unit_master where status=0 order by unit_name");
	//     return $query->result();
	//   }
	//   function get_units_by_id($id)
	//   {
	//     $query=$this->db->query("select * from unit_master where unit_id='$id' order by unit_name");
	//     return $query->result();
	//   }
  
  	//////////////  Warehouse start  ///////////////////

//   function add_warehouse_master_data()
//   {
//     $data = array(
//       'warehouse_name'  => $this->input->post('warehouse_name'),
//       'person_incharge'  => $this->input->post('person_incharge'),
//       'contact_no'  => $this->input->post('contact_no'),
//       'address'  => $this->input->post('address'),
//       'city'  => $this->input->post('city'),
//       'pincode'  => $this->input->post('pincode'),
//       //'created_by' => $this->session->userdata('user_id'),
//       //'created_date' =>  date('Y-m-d H:i:s'),
//     );

//     $this->db->insert('warehouse_master', $data);
//     $insert_id = $this->db->insert_id();
//     if($insert_id)
//     {
//       $user_se_id=$this->session->userdata('user_id');
//       $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
//       $ci = get_instance();
//       $ci->load->helper('log');
//       $log_msg=add_log_entry($user_se_id,1,$page_name[1],'warehouse_master','warehouse_id',$insert_id);

//     }
//     return $insert_id;
//   }


//   function update_warehouse_data($id)
//   {
//     $data = array(
      
//       'warehouse_name'  => $this->input->post('warehouse_name'),
//       'person_incharge'  => $this->input->post('person_incharge'),
//       'contact_no'  => $this->input->post('contact_no'),
//       'address'  => $this->input->post('address'),
//       'city'  => $this->input->post('city'),
//       'pincode'  => $this->input->post('pincode'),
//     );
//     $this->db->where('warehouse_id',$id);
//     $this->db->update('warehouse_master', $data);
//     if($id)
//     {
//       $user_se_id=$this->session->userdata('user_id');
//       $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
//       $ci = get_instance();
//       $ci->load->helper('log');
//       $log_msg=add_log_entry($user_se_id,2,$page_name[1],'warehouse_master','warehouse_id',$id);

//     }
//     return $id;

//   }
//   function get_warehouse_list()
//   {
//     //$query=$this->db->query("select * from warehouse_master order by warehouse_id");
//     $query=$this->db->query("select one.*, two.* from ( select * from warehouse_master ) as one left join (select user_id, user_name from users) as two on (one.person_incharge=two.user_id);");
//     return $query->result();
//   }

//   function get_warehouse_by_id($id)
//   {
//     $query=$this->db->query("select * from warehouse_master where warehouse_id='$id' order by warehouse_id");
//     //$query=$this->db->query("select w.*, e.employee_id, employee_code, first_name, last_name from warehouse_master w, employee_master e where e.employee_id=w.person_incharge and warehouse_id='$id' order by warehouse_id ");
//     return $query->result();
//   }


}
?>
