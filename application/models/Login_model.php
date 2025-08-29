<?php
 class Login_model extends CI_Model
 {
    
    function validate()
    {
        $email =$this->input->post('email');
        $pass =$this->input->post('password');     

		$sanitized_userid =  mysqli_real_escape_string($this->db->conn_id, $email); 

		$sanitized_password = mysqli_real_escape_string($this->db->conn_id, $pass);
	
        $query= $this->db->query("select u.*,dept.dept_name from users u left join department_master dept on u.department = dept.dept_id  where email_id='$sanitized_userid' and password='$sanitized_password' and active='0' ");
        return $query->result();      
    }
    function update_session_id($session_id,$user_id)
    {
        $date = date('Y-m-d h:i:s');
        //$query=$this->db->query("update users set active_session='',ip_address='',expiry=now(),time=now(),log_status=0 where user_id='$user_id'");
        $login_rec='';
        //$ci = get_instance();
        //$ci->load->helper('log');
    
    }
    function update_login_time($session_id,$user_id)
    {
        $ip_address=$_SERVER['REMOTE_ADDR'];
        $query=$this->db->query("UPDATE users SET active_session='$session_id',time=now(),expiry=date_add(now(), interval 20 minute),ip_address='$ip_address',log_status=1 where user_id='$user_id';");
        $login_rec=$ip_address;
        $user_se_id=$this->session->userdata('user_id');
        $session_id=$this->session->userdata('session_id');
        $ci = get_instance();
        $ci->load->helper('log');
        add_record($user_se_id,$session_id,'users','login Details',$login_rec,'User Login ','');
    }
	function check_pass()
	{
		$uname = $this->input->post('user_name');
		$upass = $this->input->post('user_pass');
		$query= $this->db->query("select count(*) as ucount from users u,user_access ua ,page_access pa, groups g where u.user_id = ua.user_id and ua.access_id = pa.access_id and u.group_id=g.group_id and u.user_name='$uname' and u.user_pass = '$upass' and pa.attribute='R' and g.group_name='Admin'");
		return $query->row('ucount');

	}
     function change_password()
     {
            	$user_id=$this->session->userdata('user_id');
		$name=$this->session->userdata('user_name');
		$old_pass=$this->input->post('opass');
		$new_pass=$this->input->post('npass');
		$confirm_pass=$this->input->post('cpass');

		//$pass_details = "User name :".$name." / "."Old password :".$old_pass." / "."New password :".$new_pass;
		if($new_pass == $confirm_pass)
		{
			$query= $this->db->query("select * from users where user_id='$user_id' and password= '$old_pass'");
			$data['temp']=$query->result();
			if (!empty($data['temp']))
			{
				  $query2=$this->db->query("update users set password='$new_pass' where user_id='$user_id';");
				  if($query2)
					 return 2;
				  else
					 return -1;
			}
		}
		  else
			 return 0;
	}

   function get_group_name($id)
   {
   		$this->db->select('group_name');
		$this->db->where('group_id', $id);
		$query = $this->db->get('groups');
		return $query->row('group_name');
   }
   
   function alert_for_expiry()
   {
   	  $today = date('Y-m-d');
   	  $after30day = date('Y-m-d', strtotime("$today +30 day"));
	  $query= $this->db->query("truncate table alerts");
   	 ///***** vehicle registration expiry******////
   	  $query= $this->db->query("select vehicle_id from vehicle_data_entity where reg_expiry between '$today' and '$after30day' ");
	  $vehicalReg =  $query->result();	
	  if(!empty($vehicalReg))
      { 
	      $vehicle_id='';$i=0;
		  foreach($vehicalReg as $reg)
		  {
		  	$vehicle_id = $reg->vehicle_id.','.$vehicle_id;
			$i++;
		  }
		  $alert_level= 1;
		  $alert_sub=$i.' '."Vehicle Registration Expiring";
		  $url ="vehicle/get_vehicle_details/2";
		  $data = 
	  		  array(
					'alert_level' => $alert_level,
					'alert_subject' => $alert_sub,
					'alert_description' => $vehicle_id,
					'alert_date' => $today,
					'alert_url'=>$url,
				);
		  $insert_id=$this->db->insert('alerts', $data);
	 }
	 /* $query= $this->db->query("select vehicle_id from vehicle_data_entity where reg_expiry < '$today'");
	  $vehicalReg =  $query->result();	
	  if(!empty($vehicalReg))
      { 
	      $vehicle_id='';$i=0;
		  foreach($vehicalReg as $reg)
		  {
		  	$vehicle_id = $reg->vehicle_id.','.$vehicle_id;
			$i++;
		  }
		  $alert_level= 1;
		  $alert_sub=$i.' '."Vehicle Registration Expried";
		  $url ="vehicle/get_vehicle_details/2";
		  $data = 
	  		  array(
					'alert_level' => $alert_level,
					'alert_subject' => $alert_sub,
					'alert_description' => $vehicle_id,
					'alert_date' => $today,
					'alert_url'=>$url,
				);
		  $insert_id=$this->db->insert('alerts', $data);
	 } */
	 ///***** vehicle insurance expiry******////
   	  $query= $this->db->query("select vehicle_id from vehicle_data_entity where insurance_date between '$today' and '$after30day'");
	  $vehicalReg =  $query->result();	
	  if(!empty($vehicalReg))
      { 
	      $vehicle_id='';$i=0;
		  foreach($vehicalReg as $reg)
		  {
		  	$vehicle_id = $reg->vehicle_id.','.$vehicle_id;
			$i++;
		  }
		  $alert_level= 1;
		  $alert_sub=$i.' '."Vehicle Insurance Expiring";
		  $url ="vehicle/get_vehicle_details/1";
		  $data = 
	  		  array(
					'alert_level' => $alert_level,
					'alert_subject' => $alert_sub,
					'alert_description' => $vehicle_id,
					'alert_date' => $today,
					'alert_url'=>$url,
				);
		  $insert_id=$this->db->insert('alerts', $data);
	 }
	 
	 ///***** vehicle rto_fit_date expiry******////
   	  $query= $this->db->query("select vehicle_id from vehicle_data_entity where rto_fit_date between '$today' and '$after30day'");
	  $vehicalReg =  $query->result();	
	  if(!empty($vehicalReg))
      { 
	      $vehicle_id='';$i=0;
		  foreach($vehicalReg as $reg)
		  {
		  	$vehicle_id = $reg->vehicle_id.','.$vehicle_id;
			$i++;
		  }
		  $alert_level= 1;
		  $alert_sub=$i.' '."Vehicle RTO Fitness Expiring";
		  $url ="vehicle/get_vehicle_details/3";
		  $data = 
	  		  array(
					'alert_level' => $alert_level,
					'alert_subject' => $alert_sub,
					'alert_description' => $vehicle_id,
					'alert_date' => $today,
					'alert_url'=>$url,
				);
		  $insert_id=$this->db->insert('alerts', $data);
	 }
	 
	 ///***** vehicle mpcb_date expiry******////
   	  $query= $this->db->query("select vehicle_id from vehicle_data_entity where mpcb_date between '$today' and '$after30day'");
	  $vehicalReg =  $query->result();	
	  if(!empty($vehicalReg))
      { 
	      $vehicle_id='';$i=0;
		  foreach($vehicalReg as $reg)
		  {
		  	$vehicle_id = $reg->vehicle_id.','.$vehicle_id;
			$i++;
		  }
		  $alert_level= 1;
		  $alert_sub=$i.' '."Vehicle MPCB Autho Expiring";
		  $url ="vehicle/get_vehicle_details/4";
		  $data = 
	  		  array(
					'alert_level' => $alert_level,
					'alert_subject' => $alert_sub,
					'alert_description' => $vehicle_id,
					'alert_date' => $today,
					'alert_url'=>$url,
				);
		  $insert_id=$this->db->insert('alerts', $data);
	 }
	 
	 ///***** vehicle puc_date expiry******////
   	  $query= $this->db->query("select vehicle_id from vehicle_data_entity where puc_date between '$today' and '$after30day'");
	  $vehicalReg =  $query->result();	
	  if(!empty($vehicalReg))
      { 
	      $vehicle_id='';$i=0;
		  foreach($vehicalReg as $reg)
		  {
		  	$vehicle_id = $reg->vehicle_id.','.$vehicle_id;
			$i++;
		  }
		  $alert_level= 1;
		  $alert_sub=$i.' '."Vehicle PUC Expiring";
		  $url ="vehicle/get_vehicle_details/5";
		  $data = 
	  		  array(
					'alert_level' => $alert_level,
					'alert_subject' => $alert_sub,
					'alert_description' => $vehicle_id,
					'alert_date' => $today,
					'alert_url'=>$url,
				);
		  $insert_id=$this->db->insert('alerts', $data);
	 }
	  
	///***** Driver licen expiry******////
	 $query= $this->db->query("select driver_id,driver_firstname,driver_lic_expiry from driver_data_entity where driver_lic_expiry <= '$today'");
	 $driver_lic_exp =  $query->result();	
	 if(!empty($driver_lic_exp))
     { 	
	     $d_id='';$i=0;
		 foreach($driver_lic_exp as $reg)
		 {
		  	$d_id = $reg->driver_id.','.$d_id;
			$i++;
		 }
		 $alert_level= 1;
		 $alert_sub=$i.' '." Driver Licence Expired";
		 $url = "reports/view_driver_liecnse_details";
		 $data = 
	  		  array(
					'alert_level' => $alert_level,
					'alert_subject' => $alert_sub,
					'alert_description' => $d_id,
					'alert_date' => $today,
					'alert_url'=>$url,
				);
		  $insert_id=$this->db->insert('alerts', $data);
	 }
	 
	///***** Route Update ******////
	$query= $this->db->query("select count(*) as updatecount from route_details where route_date= '$today'");
	$route_details = $query->row('updatecount');	 	
	if($route_details==0)
	{
		$query= $this->db->query("select max(route_date) as last_update from route_details");
		$last_update= $query->row('last_update');	 	
	
		 $alert_level= 1;
		 $alert_sub="Route Not Updated Today";
		 $url ="route/show_daily_route_details";
		 $data = 
	  		  array(
					'alert_level' => $alert_level,
					'alert_subject' => $alert_sub,
					'alert_description' => $last_update,
					'alert_date' => $today,
					'alert_url'=>$url,
				);
		  $insert_id=$this->db->insert('alerts', $data);
	 }
	///***** Certificate Renewal Reminder ******////
	/*$query= $this->db->query("select * from (select * from certificatehistory where CertificateTo <= '$today' order by CertificateTo desc )as tmp group by tmp.CustomerID");
	$certificate = $query->result();	 
    if(!empty($certificate))
    {
    	$CustomerID=''; $c=0;
    	foreach($driver_lic_exp as $reg)
	    {
	    	$CustomerID = $reg->CustomerID.','.$CustomerID;
			$c++;
		}
     	
		$alert_level= 1;
		$alert_sub= $c.' '."Certificate Renewal Reminder";
		$url ="reports/get_certificate_renewal_reminder";		
		$data = 
  		  array(
				'alert_level' => $alert_level,
				'alert_subject' => $alert_sub,
				'alert_description' => $row['CustomerID'],
				'alert_date' => $today,
				'alert_url'=>$url,
			);
	  $insert_id=$this->db->insert('alerts', $data);
	}
	*/	
    //***** license key expiry******////
    	$this->load->model('company/company_model');
        $data['company_rec'] = $this->company_model->get_company_records();
        foreach ($data['company_rec'] as $row) {
            $state_code = $row->state_code;
            $op_code = $row->operator_code;
            $v_key = $row->value;
        }
        $code_1 = $state_code.$op_code;
        
        if($v_key != '') 
        {
            $first = substr($v_key, 0, 1);
            $last = substr($v_key, -1, 1);
            $middle = substr($v_key, 1, 24);
            $mid_len = strlen($middle);
            
            if($first == 'G' && $mid_len == 24 && $last == 'N') 
            {
                $this->load->helper('user_helper.php');
                $v_final = decrypt_code($middle, $code_1); // decode seriel_key
                $v_date = decrypt_seriel_key($v_final); // get date
                $today_date = date('d-m-Y');
                //$today_date = '07-07-2018';
                
                $present_date = date('Y-m-d',strtotime($today_date));
                $exp_date = date('Y-m-d',strtotime($v_date));               
	
			    $datetime1 = date_create($present_date);
			    $datetime2 = date_create($exp_date);			    
			    $interval = date_diff($datetime1,$datetime2);			    
			    $days = $interval->format('%a');
	
                if($days<=7 && $days>=0) 
                {
                	$exp_date= date('d-m-Y' ,strtotime($exp_date));
                	$alert_level= 1;
					$alert_sub= "BMW License Key will be expired on $exp_date";
					$url ="Admin/view_renew_license";		
					$data = 
			  		  array(
							'alert_level' => $alert_level,
							'alert_subject' => $alert_sub,
							'alert_description' => 'Please contact Greenearthnetwork Admin',
							'alert_date' => $today,
							'alert_url'=>$url,
						);
				  $insert_id=$this->db->insert('alerts', $data);
				}
			}
		}
   
   }
   

 }
?>
