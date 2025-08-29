<?php

date_default_timezone_set('Asia/Kolkata');

class Access_control extends CI_Model {

	function get_menu_records()
	{
		$query = $this->db->query("select * from menu_access");
		return $query->result();
	}
	function get_group_name()
	{
		$query = $this->db->query("select * from groups");
		return $query->result();
	}
	function get_sub_menu_records()
	{
		$menu_pid=0;
		$query = $this->db->query("select * from menu_access m, user_access a, users u
		where u.user_id=a.user_id and a.access_id=m.menu_id and a.resource_type='M'
		and m.menu_sid=$menu_pid");
		return $query->result();
	}
	function get_sub_menu_records2()
	{
		$menu_pid=1;
		$query = $this->db->query("select * from menu_access m, user_access a, users u where
		u.user_id=a.user_id and a.access_id=m.menu_id and a.resource_type='M'
		and m.menu_sid=$menu_pid;");
		return $query->result();
	}
	function get_user_names()
	{
		$query = $this->db->query("select u.*, g.group_name from users u, groups g where u.group_id = g.group_id and u.status=0 order by u.user_name");
		return $query->result();
	}
	function get_user_exits()
	{
		$name=$this->input->post('user_name');
		$query = $this->db->query("select count(*) as ucount from users where user_name ='$name';");
		return $query->row('ucount');
	}
	function get_group_exits()
	{
		$name=$this->input->post('group_name');
		$query = $this->db->query("select count(*) as gcount from groups where group_name ='$name';");
		return $query->row('gcount');
	}
	function get_user_wise_menu()
	{
		$uid=$this->input->post('user_name');

		$query = $this->db->query("select * from menu_access m, user_access a where
		a.access_id=m.menu_id and a.user_id=$uid");
		return $query->result();
	}

	function change_user_access()
	{
		$uid = $this->input->post('id');
		$query= $this->db->query("delete from user_access where user_id='$uid' and resource_type='M'");
		$query= $this->db->query("delete from page_access where user_id='$uid'");
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

		if(isset($_POST['check_add']))
		{
			for ($i = 0; $i < count($_POST['check_add']); $i++)
			{
				$access_id=$_POST['check_add'][$i];
				$page_id= $this->get_page_id($access_id,'add');
				if($page_id!=0)
				{
							$data = array(
								'user_id' => $uid,
								'menu_id'   => $access_id,
								'page_id'   => $page_id,
								'attribute'   => 'A',

							);
							$this->db->insert('page_access', $data);
			 }
			}
		}
		if(isset($_POST['check_edit']))
		{
			for ($i = 0; $i < count($_POST['check_edit']); $i++)
			{
				$access_id=$_POST['check_edit'][$i];
				$page_id= $this->get_page_id($access_id,'edit');

				if($page_id!=0)
				{
						$data = array(
							'user_id' => $uid,
							'menu_id'   => $access_id,
							'page_id'   => $page_id,
							'attribute'   => 'E',

						);
						$this->db->insert('page_access', $data);
				}
			}
		}
		if(isset($_POST['check_delete']))
		{
			for ($i = 0; $i < count($_POST['check_delete']); $i++)
			{
				$access_id=$_POST['check_delete'][$i];
				$page_id= $this->get_page_id($access_id,'list');

				if($page_id!=0)
				{
						$data = array(
							'user_id' => $uid,
							'menu_id'   => $access_id,
							'page_id'   => $page_id,
							'attribute'   => 'D',

						);
						$this->db->insert('page_access', $data);
				}
			}
		}
		if(isset($_POST['check_print']))
		{
			for ($i = 0; $i < count($_POST['check_print']); $i++)
			{
				$access_id=$_POST['check_print'][$i];
				$page_id= $this->get_page_id($access_id,'list');

				if($page_id!=0)
				{
							$data = array(
								'user_id' => $uid,
								'menu_id'   => $access_id,
								'page_id'   => $page_id,
								'attribute'   => 'P',

							);
							$this->db->insert('page_access', $data);
				}
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
		return $insert_id;
	}

	function get_page_id($menu_id,$page_type)
	{
		$query= $this->db->query("select menu_url from menu_access where menu_id='$menu_id'");
		$menu_url=$query->row('menu_url');
		$tmp=explode('/',$menu_url);
		$cnt=count($tmp);
		$urlName1=$tmp[$cnt-2];
		$urlName2=$tmp[$cnt-1];
		$urlName=$urlName1.'/'.$urlName2;
		if($urlName){
			$query= $this->db->query("select page_name from breadcrumb where page_url='$urlName'");
			$page_name=$query->row('page_name');
			if($page_name){
				$query= $this->db->query("select page_id from breadcrumb where page_name='$page_name' and page_type='$page_type' ");
				$page_id=$query->row('page_id');
				if(!empty($page_id))
				return $page_id;
				else return 0;
			}
			else return 0;
		}
		else return 0;
	}
	function add_group()
	{
		$name = $this->input->post('group_name');
		$desc= $this->input->post('group_desc');
		$dashboard= $this->input->post('dashboard');

		$data = array(
			'group_name' =>  $name,
			'description' =>  $desc,
			'global_dashboard' =>  $dashboard,

		);
		$this->db->insert('groups', $data);
		$insert_id=$this->db->insert_id();

		$uid = $this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($uid,1,$page_name[1],'groups','group_id',$insert_id);
		return $insert_id;
	}

	function get_max_user_ledger_id()
	{
		$query = $this->db->query("Select COALESCE(MAX(ledger_id),0)+1 as max_user_ledger_id from users;");
		return $query->row('max_user_ledger_id');
	}

	function add_user()
	{
		$group_id = $this->input->post('group_name');
		//$max_user_ledget_id = $this->get_max_user_ledger_id();

		$data = array(
			'user_name' =>  $this->input->post('user_name'),
			'user_pass' =>  $this->input->post('user_password'),
			'FirstName' =>  $this->input->post('user_fname'),
			'LastName' =>  	$this->input->post('user_lname'),
			'mobile_no' =>  $this->input->post('mobile_no'),
			'user_emailid' => $this->input->post('user_emailid'),
			'corporation' =>  implode(',',$this->input->post('occu_area')),
			'group_id' =>  	$group_id
			//'ledger_id' => $max_user_ledget_id
		);
		$this->db->insert('users', $data);
		$insert_id=$this->db->insert_id();

		// $data = array(
		// 	'account_name' => $this->input->post('user_name'),
		// 	'employee_id' => $insert_id,
		// 	'group_no'	=> 11
		// );
		//
		// $this->db->insert('general_ledger', $data);
		return $insert_id;

		$uid = $this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($uid,1,$page_name[1],'users','user_id',$insert_id);
	}

	function add_user_access($user_id)
	{
		$group_id = $this->input->post('group_name');

		$query = $this->db->query("select access_id from group_access where group_id=$group_id;");
		$data['temp'] = $query->result();

		foreach ($data['temp'] as $row)
		{
			$access_id = $row->access_id;
			$data = array(
				'user_id' =>$user_id,
				'access_id' =>  $row->access_id,
				'resource_type' => 'M'
			);

			$this->db->insert('user_access', $data);
		}
	}

	function get_user_by_id()
	{
		$user_id = $this->session->userdata('user_id');
		//$user_id =$this->uri->segment('3');
		$query = $this->db->query("select * from users where user_id='$user_id' ");
		return $query->result();
	}
	function get_user_details()
	{
		$user_id = $this->input->post('user_name');
		$query = $this->db->query("select * from users where user_id='$user_id' ");
		return $query->result();
	}
	function get_user_by_id_uri()
	{
		//$user_id = $this->input->post('user_name');
		$user_id =$this->uri->segment('3');
		$query = $this->db->query("select * from users where user_id=$user_id;");
		return $query->result();
	}

	function get_group_by_id()
	{
		$group_id = $this->uri->segment('3');
		$query = $this->db->query("select * from groups where group_id=$group_id;");
		return $query->result();
	}

	function edit_user()
	{
		$group_id = $this->input->post('group_name');
		$user_id = $this->input->post('user_id');

		$data = array(
			'user_name' =>  $this->input->post('user_name'),
			'user_pass' =>  $this->input->post('user_password'),
			'FirstName' =>  $this->input->post('user_fname'),
			'LastName' =>  	$this->input->post('user_lname'),
			'group_id' =>  	$group_id,
			'status' => $this->input->post('status'),
			'corporation' =>  implode(',',$this->input->post('occu_area')),
			'mobile_no' =>  $this->input->post('mobile_no'),
			'user_emailid' => $this->input->post('user_emailid'),
		);

		$this->db->where('user_id', $user_id);
		$this->db->update('users', $data);
		/*$query = $this->db->query("delete from user_access  where user_id=$user_id;");

		$query = $this->db->query("select * from group_access where group_id=$group_id;");
		$data['temp'] = $query->result();

		foreach ($data['temp'] as $row)
		{
		$access_id = $row->access_id;
		$resource = $row->resource_type;

		$data = array(
		'user_id' =>  $user_id,
		'access_id' =>  $access_id,
		'resource_type' => $resource );
		$this->db->insert('user_access', $data);
	}*/

	$uid = $this->session->userdata('user_id');
	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	$ci = get_instance();
	$ci->load->helper('log');
	$log_msg=add_log_entry($uid,2,$page_name[1],'users','user_id',$user_id);

	return $user_id;
}

function delete_user() {

	$user_id = $this->uri->segment('3');

	$query = $this->db->query("delete from users  where user_id= '$user_id'");
	$query0 = $this->db->query("delete from user_access  where user_id= '$user_id'");
	$query1 = $this->db->query("delete from group_access where access_id = '$user_id'");

	if($query && $query0 && $query1) {
		return 0;
	}
	else {
		return 1;
	}

	$uid = $this->session->userdata('user_id');
	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	$ci = get_instance();
	$ci->load->helper('log');
	$log_msg=add_log_entry($uid,2,$page_name[1],'users','user_id',$user_id);


}



function edit_user_profile()
{
	$group_id = $this->input->post('group_name');
	$user_id = $this->input->post('user_id');

	$data = array(
		'FirstName' =>  $this->input->post('user_fname'),
		'LastName' =>  	$this->input->post('user_lname'),
	);

	$this->db->where('user_id', $user_id);
	$this->db->update('users', $data);
	return true;
}


function edit_group()
{
	$group_id = $this->input->post('group_id');
	$name = $this->input->post('group_name');
	$desc = $this->input->post('group_desc');
	$dashboard= $this->input->post('dashboard');

	$data = array(
		'group_name' =>  $this->input->post('group_name'),
		'description' =>  $this->input->post('group_desc'),
		'global_dashboard' =>  $dashboard,
	);

	$this->db->where('group_id', $group_id);
	$this->db->update('groups', $data);

	return $group_id;

	/*		$user_se_id=$this->session->userdata('user_id');
	$session_id=$this->session->userdata('session_id');
	$ci = get_instance();
	$ci->load->helper('log');
	add_record($user_se_id,$session_id,'groups','Add New Group',"Group name :".$name." | Group Desc:".$desc." | Group Division:".$group_division,'Record Updated','');
	*/
}

function delete_group_access()
{
	$id = $this->input->post('id');
	$query = $this->db->query("delete from group_access  where group_id=$id and resource_type='M';");

	for ($i = 0; $i < count($_POST['check']); $i++)
	{
		$data = array(
			'group_id' =>  $id,
			'access_id' =>  $_POST['check'][$i],
			'resource_type' => 'M'
		);
		$this->db->insert('group_access', $data);
		$insert_id=$this->db->insert_id();
	}

	/*	$user_se_id=$this->session->userdata('user_id');
	$session_id=$this->session->userdata('session_id');
	$ci = get_instance();
	$ci->load->helper('log');
	add_record($user_se_id,$session_id,'group_access','Manage Group Access',"Group Id :".$id,'Access Changed','');

	$user_se_id=$this->session->userdata('session_id');
	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	$ci = get_instance();
	$ci->load->helper('log');
	$log_msg=add_log_entry($user_se_id,3,$page_name[1],'group_access','group_id',$insert_id);*/
	return $insert_id;

}

function get_page_names()
{
	$query = $this->db->query("select distinct page_name from page_access");
	return $query->result();
}
function get_page_names_for_log()
{
	//	$query = $this->db->query("select DISTINCT(page_name) as page_name  from page_access order by page_name asc");
	$query = $this->db->query("select page_name from page_access where atTribute in('A','P','V','E') order by page_name asc");
	return $query->result();
}
function get_page_names_for_timeout()
{
	$query = $this->db->query("select page_name from page_access group by page_name");
	return $query->result();
}
function add_page_access()
{
	$id = $this->input->post('id');
	error_reporting(0);
	$query = $this->db->query("delete from group_access  where group_id=$id and resource_type='P';");

	for ($i = 0; $i < count($_POST['check']); $i++)
	{
		$data = array(
			'group_id' =>  $id,
			'access_id' =>  $_POST['check'][$i],
			'resource_type' => 'P'
		);
		$this->db->insert('group_access', $data);
	}
}
function add_page_access_for_user()
{
	$id = $this->input->post('id');
	error_reporting(0);
	$query = $this->db->query("delete from user_access  where user_id=$id and resource_type='P';");
	//print_r($_POST['check']);
	//echo count($_POST['check']);
	//exit;
	if(($_POST['check'])!='')
	{
		for ($i = 0; $i < count($_POST['check']); $i++)
		{
			$ac_id = $_POST['check'][$i];
			$query = $this->db->query("select page_name,attribute from page_access where access_id= $ac_id;");

			$data['temp']= $query->result();
			foreach($data['temp'] as $row)
			{
				$pname= $row->page_name;
				$att= $row->attribute;
			}
			$query1 = $this->db->query(" select access_id from page_access where page_name='$pname' and attribute='$att';");
			$data['temp1']= $query1->result();

			foreach($data['temp1'] as $r)
			{
				$access_id= $r->access_id;

				$data = array(
					'user_id' =>  $id,
					'access_id' => $access_id,
					'resource_type' => 'P'
				);
				$this->db->insert('user_access', $data);
			}
		}
	}
}

function update_timeout_value()
{
	error_reporting(0);
	$query = $this->db->query("update page_access set timeout ='S';");

	for ($i = 0; $i < count($_POST['check']); $i++)
	{
		$data = array(
			'timeout' =>  'L'
		);
		$this->db->where('page_name', $_POST['check'][$i]);
		$this->db->update('page_access', $data);
	}
}

function add_font()
{
	$data = array(
		'font_size' =>  $_POST['font_size'],
		'font_family' => $_POST['font_family']
	);

	$this->db->update('font_settings', $data);
}
function get_font()
{
	$query = $this->db->query(" select * from font_settings;");
	return $query->result();
}

function get_transactions_type()
{
	// $query=$this->db->query("select * from log_type_status");
	$query=$this->db->query("select * from log_type_status order by log_type;");
	return $query->result();
}

function get_log_details()
{

	$from = date('Y-m-d', strtotime($this->input->post("from")));
	$to = date('Y-m-d', strtotime($this->input->post("to")));

	$user_id=$this->input->post('user_name');
	$log_type=$this->input->post('tr_type');
	$lcond = ""; $user_cond = "";
	if($log_type != "" ) {
		$lcond = "and l.log_type='$log_type'";
	}
	if($user_id != "" ) {
		$user_cond = "and l.user_id='$user_id'";
	}
	$query = $this->db->query("select u.user_name, lt.log_type, l.log_date, l.table_name, l.id, l.page_name from users u, log_type_status lt, log_activity l where l.user_id = u.user_id and l.log_type = lt.id  and date(l.log_date) between '$from' and '$to' $lcond $user_cond");
	return $query->result();

}

function get_log_desc() {
	$id = $this->uri->segment('3');
	$query = $this->db->query(" select * from log_activity where id = '$id'");
	return $query->result();
}


function get_log_details_by_id($code)
{
	$condition="and (log_desc like '%Cust_code:$code%' or log_desc like '%VoucherID:$code%' or log_desc like '%Invoice id:$code%')";

	$query = $this->db->query("select l.user_id, u.FirstName,u.LastName, table_name ,page_name,log_desc,log_Type ,date(log_time) as log_date,time(log_time) as log_time
	from log_entry l, users u where l.user_id=u.user_id and log_Type=1 $condition
	order by date(log_time) desc,time(log_time) desc ");
	return $query->result();

}

function get_log_history_by_id($code)
{
	$condition="and (log_desc like '%Cust_code:$code%' or log_desc like '%VoucherID:$code%' or log_desc like '%Invoice id:$code%')";

	$query=$this->db->query("select count(*) as rcount from log_entry where log_Type=2 $condition order by date(log_time) desc,time(log_time) desc limit 2");
	$count=$query->row('rcount');
	if($count >=2)
	{//for update only
		$query1 = $this->db->query("select l.user_id, u.FirstName,u.LastName, table_name ,page_name,log_desc,log_Type ,date(log_time) as log_date,time(log_time) as log_time
		from log_entry l, users u where log_Type=2 and l.user_id=u.user_id $condition
		order by date(log_time) desc,time(log_time) desc limit 2");


	}
	else if($count==0)
	{ //for mutiple add
		$query1 = $this->db->query("select l.user_id, u.FirstName,u.LastName, table_name ,page_name,log_desc,log_Type ,date(log_time) as log_date,time(log_time) as log_time
		from log_entry l, users u where log_Type=2 and l.user_id=u.user_id $condition
		order by date(log_time) desc,time(log_time) desc limit 2");
	}
	else {
		$query1 = $this->db->query("select l.user_id, u.FirstName,u.LastName, table_name ,page_name,log_desc,log_Type ,date(log_time) as log_date,time(log_time) as log_time
		from log_entry l, users u where (log_Type=2 or log_type=1) and l.user_id=u.user_id $condition
		order by date(log_time) desc,time(log_time) desc limit 2");
	}
	return $query1->result();
}

function get_bmw_history_by_id($code)
{
	$condition="and log_desc like '%Cust_code:$code%'";

	$query = $this->db->query("select l.user_id, u.FirstName,u.LastName, table_name ,page_name,log_desc,log_Type ,date(log_time) as log_date,time(log_time) as log_time
	from log_entry l, users u where l.user_id=u.user_id $condition
	order by date(log_time) desc,time(log_time) desc ");
	return $query->result();

}

// used for statistics of passco

function get_total_customer()
{
	$query=$this->db->query("select count(*) as total_customer from bmwregistration where is_closed='NO';");
	return $query->row('total_customer');
}
/*
function get_receipt()
{
$current_date=date('Y-m-d');

$query=$this->db->query("select count(*) as total_receipt from voucher_type_master_data_entity where VoucherType='R' and VoucherDate=subdate('$current_date',1);");
return $query->row('total_receipt');
}
*/
function get_bag_sale()
{
	$current_date=date('Y-m-d');

	$query=$this->db->query("select count(*) as total_bag_sale from bag_sale_header where sale_date=subdate('$current_date',1);");
	return $query->row('total_bag_sale');
}

function get_daily_waste_inward()
{
	$current_date=date('Y-m-d');

	$query=$this->db->query("select count(*) as total_inward from daily_waste_collection where collectiondate=subdate('$current_date',1)");
	return $query->row('total_inward');
}

function get_daily_waste_outward()
{
	$current_date=date('Y-m-d');

	$query=$this->db->query("select count(*) as total_outward from waste_collection_outward where collectiondate=subdate('$current_date',1)");
	return $query->row('total_outward');
}

function get_yesterday_date()
{
	$current_date=date('Y-m-d');

	$query=$this->db->query("select subdate('$current_date',1) as yesterday_date");
	return $query->row('yesterday_date');
}

function dashboard_total_occupiers()
{
	$query=$this->db->query("select count(*) as 'occ' from bmwregistration");
	return $query->row('occ');
}

function dashboard_total_category()
{
	$query=$this->db->query("select count(*) as 'cat' from category_data_entity");
	return $query->row('cat');
}

function dashboard_total_bags_procced()
{
	$query=$this->db->query("select count(*) as 'bags' from waste_collection_outward");
	return $query->row('bags');
}

/*********************************************Email Configuration ********************************************/

function get_email_configuration_details()
{
	$query=$this->db->query("select * from email_configuration order by econfig_id desc limit 1");
	return $query->result();
}

function update_email_configuration()
{
	$host_name = $this->input->post('host_name');
	$smtp_port = $this->input->post('smtp_port');
	$user_name = $this->input->post('user_name');
	$password = $this->input->post('password');
	$id = $this->input->post('id');

	if($id!='')
	{
		$data = array(
			'smtp_host_name' =>  $host_name,
			'smtp_port' =>  $smtp_port,
			'user_name' =>  $user_name,
			'password' =>  	$password,
		);

		$this->db->where('econfig_id', $id);
		$this->db->update('email_configuration', $data);

	}
	else
	{
		$data = array(
			'smtp_host_name' =>  $host_name,
			'smtp_port' =>  $smtp_port,
			'user_name' =>  $user_name,
			'password' =>  	$password,
		);
		$this->db->insert('email_configuration', $data);
		$insert_id=$this->db->insert_id();
	}

}

/**************************************Email Configuration End ****************************************/

/**************************************Complaint Master Start ****************************************/

function insert_complaint_data()
{
	$data = array(
		'type' =>  $this->input->post('comp_mast')
	);
	$this->db->insert('complaint_master', $data);
	$insert_id=$this->db->insert_id();
	return $insert_id;

}

function get_complaint_record() {
	$query=$this->db->query("select * from complaint_master order by type asc");
	return $query->result();
}

function get_complaint_record_by_id() {
	$id = $this->uri->segment('3');
	$query=$this->db->query("select * from complaint_master where complaint_master_id='$id'");
	return $query->result();
}

function update_comlpaint_master(){
	$id = $this->input->post('id');
	$data = array(
		'type' =>  $this->input->post('comp_mast'),

	);
	$this->db->where('complaint_master_id', $id);
	$this->db->update('complaint_master', $data);
	return true;

}

function delete_comp_master_record($id){
	$this->db->where('complaint_master_id', $id);
	$res=$this->db->delete('complaint_master');
	if($res){
		$user_se_id=$this->session->userdata('session_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,3,$page_name[1],'complaint_master','complaint_master_id',$id);
		return true;
	}
	else {
		return false;
	}

}
/**************************************Complaint Master End ****************************************/

/**************************************Complaint register Start ****************************************/

function occupier_name(){
	//	 $query=$this->db->query("select occupier_id,occu_name,cust_code from bmwregistration");
	$query = $this->db->query("select occupier_id,occu_name,cust_code from bmwregistration order by occu_name");
	return $query->result();
}
function occupier_type(){
	//	$query=$this->db->query("select *from complaint_master");
	$query =$this->db->query("select *from complaint_master order by type;");
	return $query->result();
}

function insert_register_data()
{
	$file_path='';
	$fDate=date('Y-m-d',strtotime($this->input->post('comp_date')));
	$user_se_id=$this->session->userdata('user_id');

	$data = array(
		'complaint_date' =>$fDate,
		'complaint_time' =>date('h-i-sa',strtotime($this->input->post('comp_time'))),
		'occupier_id' =>  $this->input->post('occu_name'),
		'complaint_id ' =>  $this->input->post('comp_type'),
		'executive_id  ' =>  $this->input->post('executive'),
		'complaint_details ' =>  $this->input->post('txar'),
		'status' =>  $this->input->post('status')
	);
	$this->db->insert('complaint_register', $data); // will insert value in db
	$insert_id = $this->db->insert_id(); // gen insert id

	$parent=0;
	$data = array(
		'file_path' => $file_path,
		'message_date' => $fDate,
		'userid' => $this->input->post('executive'),
		'msg_box' => $this->input->post('txar'),
		'msg_for_id' => $this->input->post('executive'),
		'created_by' => $user_se_id,
		'msg_parent_id'=>$parent,
	);
	$id = $this->db->insert('messenger', $data);
	return $insert_id; // returns insert id to controller
}

function get_Comp_typedata(){
	$id = $this->uri->segment('3');
	$query=$this->db->query("select *from complaint_master where complaint_master_id='$id'");
	return $query->result();
}

function get_complaint_record_by_idd() {
	$id = $this->uri->segment('3');
	$query=$this->db->query("select * from complaint_register where complaint_register_id='$id'");
	return $query->result();
}

function get_comp_reg_list() {
	$from_date = date('Y-m-d', strtotime($this->input->post('from')));
	$to_date = date('Y-m-d', strtotime($this->input->post('to')));

	$query=$this->db->query("select b.occu_name,c.type,u.user_name,cr.complaint_date,cr.complaint_details,cr.status,cr.complaint_register_id from bmwregistration b,complaint_master c,users u,complaint_register cr where cr.occupier_id=b.occupier_id and cr.complaint_id=c.complaint_master_id and cr.executive_id=u.user_id and complaint_date between '$from_date' and '$to_date' order by cr.complaint_date desc; ");
	return $query->result();

}

function update_complaint_register_list(){
	$id = $this->input->post('id');
	$data = array(
		'complaint_date' =>date('Y-m-d',strtotime($this->input->post('comp_date'))),
		'occupier_id' =>  $this->input->post('occu_name'),
		'complaint_id' =>  $this->input->post('comp_type'),
		'executive_id' =>  $this->input->post('executive'),
		'complaint_details' =>  $this->input->post('txar'),
		'status' =>  $this->input->post('status'),

	);

	$this->db->where('complaint_register_id', $id);
	$this->db->update('complaint_register', $data);
	return true;

}

function get_comp_reg_details($id) {
	$query=$this->db->query("select * from complaint_register where complaint_register_id='$id'");
	$temp['records']=$query->result();
	foreach($temp['records'] as $row)
	{
		$reg_desc=$row->complaint_details;
	}
	$reg_details=$reg_desc;
	return $reg_details;
}

function delete_comp_reg_record($id) {
	$comp_details="Record Description:".$this->get_comp_reg_details($id);
	$this->db->where('complaint_register_id', $id);
	$res=$this->db->delete('complaint_register');
	if($res){
		$user_se_id=$this->session->userdata('session_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,3,$page_name[1],'complaint_register','complaint_register_id',$id);
		return true;
	}
	else {
		return false;
	}
}


function insert_documents($file_path,$message_date,$msg_box)
{
	$fDate=date('Y-m-d',strtotime($message_date));
	$user_se_id=$this->session->userdata('user_id');
	$parent=$this->input->post("parent");
	for ($i = 0; $i < count($_POST['user']); $i++)
	{
		$user_id=$_POST['user'][$i];
		$data = array(
			'file_path' => $file_path,
			'message_date' => $fDate,
			'userid' => $user_id,
			'msg_box' => $msg_box,
			'msg_for_id' => $user_id,
			'created_by' => $user_se_id,
			'msg_parent_id'=>$parent,
		);
		$id = $this->db->insert('messenger', $data);
	}
	return $id;
}



function sent_messenger_list($from, $to) {
	$from = date('Y-m-d', strtotime($this->input->post("from")));
	$to = date('Y-m-d', strtotime($this->input->post("to")));
	$user_se_id=$this->session->userdata('user_id');


	$query=$this->db->query("select m.*, u.FirstName,u.LastName from messenger m,users u where m.userid=u.user_id and message_date between '$from' and '$to' and created_by=$user_se_id order by message_date desc");
	return $query->result();
}

function received_messenger_list($from, $to) {
	$from = date('Y-m-d', strtotime($this->input->post("from")));
	$to = date('Y-m-d', strtotime($this->input->post("to")));
	$user_se_id=$this->session->userdata('user_id');


	$query=$this->db->query("select m.*, u.FirstName,u.LastName from messenger m,users u where m.userid=u.user_id and message_date between '$from' and '$to' and userid=$user_se_id  order by message_date desc");
	return $query->result();
}

function update_messeneger_seen_data($id){
	$data = array(
		'read_flag' =>  1,
	);

	$this->db->where('msg_id', $id);
	$this->db->update('messenger', $data);
	return $id;
}

function message_details_by_id($id) {
	$query=$this->db->query("select m.*, FirstName,LastName from messenger m, users u where m.userid=u.user_id and msg_id='$id'");
	return $query->result();
}

function get_all_occupier()
{
	$query=$this->db->query(" select occupier_id, cust_code, occu_name, category_name ,name,occu_registration   from bmwregistration r, category_data_entity c, division_data_entity d where r.occu_category=c.cat_id and r.occu_division=d.div_id ");
	return $query->result();
}

/**************************************Complaint Register End ****************************************/

}?>
