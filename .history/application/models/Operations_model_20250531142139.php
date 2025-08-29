<?php
	date_default_timezone_set('Asia/Dubai');
    class Operations_model extends CI_Model {
 
    function add_new_job() 
	{
		
		$data = array(
		'job_date' => $this->input->post('job_date'),
		'job_type' => $this->input->post('job_type'),
		'customer' => $this->input->post('customer'),
        'contact' => $this->input->post('contact'),
		'customer_email' => $this->input->post('cust_email'),
		'job_location' => $this->input->post('location'),		
		'location_link' => $this->input->post('location_link'),
        'job_desc' => $this->input->post('job_desc'),
		'job_title' => $this->input->post('job_title'),
		'job_time' => $this->input->post('job_time'),
		'po_number' => $this->input->post('po_number'),
		'invoice_number' => $this->input->post('invoice_number'),
        'sales' => $this->input->post('sales'),
		'payment' => $this->input->post('payment_term'),
		'created_by' => $this->session->userdata('user_id'),
		'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('job_master', $data);
		$insert_id = $this->db->insert_id();

		if($insert_id)
		{
			
			if ($_FILES["job_file"]) {
					$allowedExts = array("jpeg", "jpg", "png", "doc", "pdf");
					for ($i = 0; $i < count($_FILES['job_file']["name"]); $i++) {
						if ($_FILES['job_file']["name"][$i] != '') {
							$file_name = $_FILES["job_file"]["name"][$i];		
							$pattern = '/[^a-zA-Z0-9_]/';
							$fname = preg_replace($pattern, '_', $file_name);
							$fname=str_replace(' ', '_', $file_name);					
							$temp = explode(".", $fname);
							$extension = end($temp);
							$job_file = '';
							if (($_FILES["job_file"]["size"][$i] < 15728640) && in_array($extension, $allowedExts)) {
								if ($_FILES["job_file"]["error"][$i] > 0) {
									$this->session->set_flashdata('error', 'Failed to upload - Please check file size and file format');
								} else {
									$timestamp1 = time();
									$file_tmp = $_FILES["job_file"]["tmp_name"][$i];
									$job_file = $timestamp1 . "_" . $fname;
									$dest = FCPATH . 'public/uploded_documents/job_files/'.$job_file;	
							 		move_uploaded_file($file_tmp,$dest);
									$data1 = array(
										'job_id' => $insert_id,
										'document_path' => $job_file,
									);
									$this->db->insert('job_files', $data1);
									
								}
							}
						}
					}
				}
			
			$user=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['REQUEST_URI']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user,1,$page_name[1],'job_master','job_id',$insert_id);
		}
		return $insert_id;
		
	}

    function get_daily_job_list($job_date,$job_type,$dep='',$usr=0){

        $this->db->select('jm.*,jt.job_type as job_cat,u1.user_name as sales,u2.user_name as staff,pt.term');
        $this->db->from('job_master jm');
		$this->db->join('job_types jt','jm.job_type = jt.id','left');
        $this->db->join('users u1','jm.sales = u1.user_id','left');
        $this->db->join('users u2','jm.staff_assign = u2.user_id','left');
		$this->db->join('payment_terms pt','jm.payment = pt.id','left');
		$this->db->where('( (jm.job_date = "'.$job_date.'" AND jm.new_job_date is NULL) OR (jm.new_job_date = "'.$job_date.'") )', NULL, FALSE);
		$this->db->where('jm.completed', 0);
		$this->db->where('jm.cancelled', 0);
		$this->db->order_by('job_type');
		if($dep == 'Driver'){
			$this->db->where('staff_assign',$usr);
		}
         $res = $this->db->get()->result_array();
		//$res = $this->db->get_compiled_select();

        return $res;
    }

	function get_job_by_id($job){

		$this->db->select('jm.*,cm.cust_name,u1.user_name as salesperson,u2.user_name as staff,pt.term,dept.dept_name');
        $this->db->from('job_master jm');
        $this->db->join('customer_master cm','jm.customer = cm.	customer_id','left');
        $this->db->join('users u1','jm.sales = u1.user_id','left');
        $this->db->join('users u2','jm.staff_assign = u2.user_id','left');
		$this->db->join('payment_terms pt','jm.payment = pt.id','left');
		$this->db->join('department_master dept','u2.department = dept.dept_id','left');
        $this->db->where('job_id',$job);
        $res = $this->db->get()->row_array();

        return $res;
	}

	function get_job_files($job){
		$this->db->select('*');
		$this->db->where('job_id',$job);
		$qry = $this->db->get('job_files');

		return $qry->result();
	}

	function update_job(){
		
		$job_id = $_POST['job_id'];
		
		$data=array(
			'job_date' => $this->input->post('job_date'),
			'job_type' => $this->input->post('job_type'),
			'job_title' => $this->input->post('job_title'),
			'customer' => $this->input->post('customer'),
			'contact' => $this->input->post('contact'),
			'customer_email' => $this->input->post('cust_email'),
			'job_desc' => $this->input->post('job_desc'),
			'job_time' => $this->input->post('job_time'),
			'job_location' => $this->input->post('location'),	
			'location_link' => $this->input->post('location_link'),
			'sales' => $this->input->post('sales'),
			'payment' => $this->input->post('payment_term'),
			'comments' => $this->input->post('comments'),
		);		
		if($_POST['new_job_date'] != ''){
			$data['new_job_date'] = $_POST['new_job_date'];
		}
		if($_POST['dept']=='Accounts'||$_POST['dept']=='Admin'||$_POST['dept']=='Office Admin' )
			$data['payment_status'] = $this->input->post('payment_status');
		if($_POST['dept']=='Operations'||$_POST['dept']=='Admin'||$_POST['dept']=='Office Admin')
			$data['staff_assign'] = $this->input->post('staff');

			
		$this->db->where('job_id',$job_id);
		$res = $this->db->update('job_master',$data);	

		$deleted_ids = $_POST['dltd_files'];
				if (!empty($deleted_ids)) {
					$deleted_ids_array = explode(',', $deleted_ids);
					
					foreach($deleted_ids_array as $file){
						$this->db->select('*');
						$this->db->where('id',$file);
						$q = $this->db->get('job_files');

						$file_name = $q->row('document_path');
						$file_path ='public/uploded_documents/job_files/'.$file_name;
						if(file_exists($file_path)){
							$file_del = unlink($file_path);
							if($file_del){
								$this->db->where('id', $file);
								$this->db->delete('job_files');
								echo 'deleted';
							}
						}
					}
				}
		if ($_FILES["job_file"]) {
			$allowedExts = array("jpeg", "jpg", "png", "doc", "pdf");
			for ($i = 0; $i < count($_FILES['job_file']["name"]); $i++) {
				if ($_FILES['job_file']["name"][$i] != '') {
					$file_name = $_FILES["job_file"]["name"][$i];		
					$pattern = '/[^a-zA-Z0-9_]/';
					$fname = preg_replace($pattern, '_', $file_name);
					$fname=str_replace(' ', '_', $file_name);					
					$temp = explode(".", $fname);
					$extension = end($temp);
					$job_file = '';
					if (($_FILES["job_file"]["size"][$i] < 15728640) && in_array($extension, $allowedExts)) {
						if ($_FILES["job_file"]["error"][$i] > 0) {
							$this->session->set_flashdata('error', 'Failed to upload - Please check file size and file format');
						} else {
							$timestamp1 = time();
							$file_tmp = $_FILES["job_file"]["tmp_name"][$i];
							$job_file = $timestamp1 . "_" . $fname;
							$dest = FCPATH . 'public/uploded_documents/job_files/'.$job_file;	
							 move_uploaded_file($file_tmp,$dest);
							$data1 = array(
								'job_id' => $job_id,
								'document_path' => $job_file,
							);
							$this->db->insert('job_files', $data1);
							
						}
					}
				}
			}
		}

		
	}

	function get_all_jobs($from_date,$to_date,$status){
		$this->db->select('jm.*,u2.user_name,jt.job_type');
		$this->db->from('job_master jm');
		$this->db->join('users u2','jm.staff_assign = u2.user_id','left');
		$this->db->join('job_types jt','jm.job_type = jt.id','left');
		$this->db->where('( ((jm.job_date >= "'.$from_date.'" AND jm.new_job_date is NULL) AND (jm.job_date <= "'.$to_date.'" AND jm.new_job_date is NULL ) ) OR (jm.new_job_date >= "'.$from_date.'" AND jm.new_job_date <= "'.$to_date.'") )', NULL, FALSE);
		
		if($status == 1){
			$this->db->where('completed', 1);			
		}
		if($status == 2){
			$this->db->where('completed', 0);

		}
		$this->db->where('cancelled',0);
		$result = $this->db->get()->result();

		return $result; 
	}
	
	function complete_job(){

		$job_id = $_POST['job_id'];

		$signatureData = $_POST['signature-data'];
		$signatureData = str_replace('data:image/png;base64,', '', $signatureData);
		$signatureData = base64_decode($signatureData);
		$sign_fileName = 'public/uploded_documents/signatures/signature_' . time() . '.png';
		file_put_contents($sign_fileName, $signatureData);

		$allowedExts = array("jpeg","jpg","png","doc","pdf");
		$file_name=$_FILES["job_photo"]["name"];
		$pattern = '/[^a-zA-Z0-9_]/';
		$data['file_name'] = preg_replace($pattern, '_', $file_name);
		$temp = explode(".", $_FILES["job_photo"]["name"]);
		$extension = end($temp); 
		$job_photo='';
		if (($_FILES["job_photo"]["size"] < 15728640) && in_array($extension, $allowedExts))
		{
				if ($_FILES["job_photo"]["error"] > 0)
				{
						$this->session->set_flashdata('error','Failed to upload - Please check file size and file format');
				}
				else
				{
					$timestamp1=time();
					$file_tmp = $_FILES["job_photo"]["tmp_name"];
					$job_photo = $timestamp1."_".$file_name;	
					$dest = FCPATH . 'public/uploded_documents/job_photos/' . $job_photo;	
					move_uploaded_file($file_tmp,$dest);
				}
		}

		$data=array(
			'completed' => 1,
			'payment_collection' => $_POST['payment_collection'],
			'amount_collected' => $_POST['amt_collected']??0,
			'job_start_time' => $_POST['job_start_time'],
			//'job_end_time' => $_POST['job_end_time'],date("H:i")
			'job_end_time' => date("H:i"),
			'work_done' => $_POST['work_done'],
			'parts' => $_POST['parts'],
			'customer_sign' => $sign_fileName,
			'job_photo' => $job_photo,
		);

		$this->db->where('job_id',$job_id);
		$res = $this->db->update('job_master',$data);
		if(isset($_POST['checklist_options'])){
			$res = $this->update_checklist_options($job_id);
		}
		
		$res = $this->add_new_checklist_options($job_id);

		return $res;
	}

	function update_checklist_options($job){
		$options = $_POST['checklist_options'];
		$id=1;
		foreach($options as $opt){
			$id = $this->db->insert('job_checklist',['job_id'=>$job,'checklist_option'=>$opt]);
		}
		return $id;
	}

	function add_new_checklist_options($job_id){
		$options = $_POST['new_chklist_option'];
		$id=1;
		foreach($options as $opt){
			if($opt != ''){
				$id = $this->db->insert('other_job_checklists',['job_id'=>$job_id,'checklist_option'=>$opt]);
			}
			
		}
		 return $id;
	}

	function update_esr_file_path($esr_file_path,$job){
		$this->db->set('esr_file',$esr_file_path);
		$this->db->where('job_id',$job);
		$res = $this->db->update('job_master');
		return $res;
	}

	function get_completed_job_list($dep,$user,$job_date=''){
		$this->db->select('jm.*,jt.report_abbr,cm.cust_name,u1.user_name as sales,u2.user_name as staff');
        $this->db->from('job_master jm');
		$this->db->join('job_types jt','jm.job_type = jt.id','left');
        $this->db->join('customer_master cm','jm.customer = cm.	customer_id','left');
        $this->db->join('users u1','jm.sales = u1.user_id','left');
        $this->db->join('users u2','jm.staff_assign = u2.user_id','left');
		$this->db->where('completed',1);
		if($dep == 'Driver'){
			$this->db->where('jm.staff_assign',$user);
		}
		if($job_date != ''){
			$this->db->where('job_date',$job_date);
		}
		$this->db->where('cancelled',0);
		$this->db->order_by('job_id','desc');        
        $res = $this->db->get()->result();
		//echo $this->db->get_compiled_select();exit;
        return $res;
	}

	function get_checklist_options_for_job($job_id){
		$this->db->select('*');
		$this->db->where('job_id',$job_id);
		$res = $this->db->get('job_checklist');

		return array_column($res->result_array(), 'checklist_option');
	}

	function get_new_checklist_options_for_job($job_id){
		$this->db->select('*');
		$this->db->where('job_id',$job_id);
		$res = $this->db->get('other_job_checklists');

		return $res->result();
	}
        
    function get_payment_report($job_date,$driver,$payment_term){
		$this->db->select('*');
		$this->db->from('job_master jm');
		$this->db->join('payment_terms pt','jm.payment = pt.id','left');
		$this->db->join('users u','jm.staff_assign = u.user_id','left');
		if($driver != ''){
			$this->db->where('staff_assign',$driver);
		}
		if($payment_term != ''){
			$this->db->where('payment',$payment_term);
		}
		$this->db->where('( (jm.job_date = "'.$job_date.'" AND jm.new_job_date is NULL) OR (jm.new_job_date = "'.$job_date.'") )', NULL, FALSE);
		
		
		$this->db->where('cancelled',0);
		$res = $this->db->get()->result();
		return $res;
	}

	// function upload_attachments($job){
	// 	$att_files=[];
	// 	if ($_FILES["mail_file"]) {
	// 		$allowedExts = array("jpeg", "jpg", "png", "doc", "pdf");
			
	// 		for ($i = 0; $i < count($_FILES['mail_file']["name"]); $i++) {
	// 			if ($_FILES['mail_file']["name"][$i] != '') {
	// 				$file_name = $_FILES["mail_file"]["name"][$i];		
	// 				$pattern = '/[^a-zA-Z0-9_]/';
	// 				$fname = preg_replace($pattern, '_', $file_name);
	// 				$fname=str_replace(' ', '_', $file_name);					
	// 				$temp = explode(".", $fname);
	// 				$extension = end($temp);
	// 				$mail_file = '';
	// 				if (($_FILES["mail_file"]["size"][$i] < 15728640) && in_array($extension, $allowedExts)) {
	// 					if ($_FILES["mail_file"]["error"][$i] > 0) {
	// 						$this->session->set_flashdata('error', 'Failed to upload - Please check file size and file format');
	// 					} else {
	// 						$timestamp1 = time();
	// 						$file_tmp = $_FILES["mail_file"]["tmp_name"][$i];
	// 						$mail_file = 'email_'.$timestamp1 . "_" . $fname;
	// 						$dest = FCPATH . 'public/uploded_documents/job_files/'.$mail_file;
	// 						if(move_uploaded_file($file_tmp,$dest))
	// 						{
	// 							$att_files[]=$mail_file;
	// 							$data1 = array(
	// 								'job_id' => $job,
	// 								'document_path' => $mail_file,
	// 							);
	// 							$this->db->insert('email_files', $data1);
	// 						}
							
							
	// 					}
	// 				}
	// 			}
	// 		}
	// 	}
	// 	return $att_files;
	// }

	// function get_attachments($job){
	// 	$this->db->select('*');
	// 	$this->db->where('job_id',$job);
	// 	$res = $this->db->get('email_files')->result();
	// 	return $res;
	// }

	function get_job_summary(){

		$result=array();
		$today = date('Y-m-d');
		$firstDay = date('Y-m-01');
		$last_day_of_week = date("Y-m-d", strtotime("saturday this week"));
		$last_day_of_month = date("Y-m-t");
		//completed jobs
		$completed = $this->get_all_jobs($firstDay,$last_day_of_month,1);
		$result['completed']=count($completed);
		//upcoming jobs for week
		
		$week_jobs = $this->get_all_jobs($today,$last_day_of_week,2);
		$result['week_jobs']=count($week_jobs);
		//upcoming jobs for month
		$month_jobs = $this->get_all_jobs($today,$last_day_of_month,2);
		$result['month_jobs']=count($month_jobs);

		//pending jobs
		$pending=$this->get_all_jobs($firstDay,$last_day_of_month,2);
		$result['pending']=count($pending);

		return $result;
	}

	function get_job_summary_for_accounts(){
		$result=array();
		$today = date('Y-m-d');
		$firstDay = date('Y-m-01');
		$last_day_of_week = date("Y-m-d", strtotime("saturday this week"));
		$last_day_of_month = date("Y-m-t");
		//completed jobs
		$completed = $this->get_all_jobs($firstDay,$last_day_of_month,1);
		$result['completed']=count($completed);
		//pending jobs
		$pending=$this->get_all_jobs($firstDay,$last_day_of_month,2);
		$result['pending']=count($pending);
		//total cash collected
		$total_amt_collected = $this->get_total_cash_collected(1,$firstDay,$last_day_of_month);
		$result['collected_amt']=$total_amt_collected;
		//total cash collected
		$total_amt_with_team = $this->get_total_cash_collected(2,$firstDay,$last_day_of_month);
		$result['amt_with_team']=$total_amt_with_team;

		return $result;
	}

	function update_payment_collection($job){
		$this->db->set('collected_by_accounts',1);
		$this->db->where('job_id',$job);
		$res = $this->db->update('job_master');
		echo $res;
		return $res;
	}

	function get_total_cash_collected($type,$firstDay,$last_day_of_month){
		$this->db->select('sum(amount_collected) as total_amt');
		$this->db->from('job_master');
		$this->db->where('job_date >=', $firstDay);
		$this->db->where('job_date <=', $last_day_of_month);
		if($type=1){
			$this->db->where('collected_by_accounts', 1);
		}else{
			$this->db->where('collected_by_accounts', 0);
		}
		$this->db->where('cancelled',0);
		$amt = $this->db->get()->row('total_amt');

		return $amt;
	}

	function cancel_job($job){
		$this->db->set('cancelled',1);
		$this->db->where('job_id',$job);
		$res = $this->db->update('job_master');

		return $res;
	}

}?>
