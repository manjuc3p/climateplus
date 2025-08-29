<?php date_default_timezone_set('Asia/Dubai');
		

    class Operations extends CI_Controller {
        
        function __construct() {
             parent::__construct();
             $this->is_logged_in();
			 require_once(APPPATH . 'third_party/TCPDF/tcpdf.php');
        }

        function is_logged_in() {
            $is_logged_in = $this->session->userdata('is_logged_in');
            if(!isset($is_logged_in) || $is_logged_in != true)
            {
                echo 'You don\'t have permission to access this page. <a href="../login">Login</a>';
                die();
                $this->load->view('login/login_form');
            }
        }
        
    
	/////////////////////// New sub_category /////////////////////////////////////
	function add_job()
	{
		$data['title']='Add Job';
		$this->load->model('Users_model');
		$data['sales_team']=$this->Users_model->get_user_list('Sales');
		$this->load->model('Setup_model');
		$data['job_types']=$this->Setup_model->get_job_types();
		$data['payment_terms']=$this->Setup_model->get_payment_terms();
		$data['main_content']='operations/add_job.php';
		$this->load->view('includes/template.php',$data);
	}

    function add_new_job(){
        
		$this->load->model('Operations_model');
		$insert_id = $this->Operations_model->add_new_job();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Operations/daily_job_list');
		}
		else{
			$this->session->set_flashdata('Warning', 'Some Error Occured');
			redirect('Operations/add_job');
		}
    }

    function daily_job_list(){
        $data['title']='Daily Job List';		
		$data['job_date'] = date('Y-m-d');
		
        if(isset($_POST['job_date'])){
			$data['job_date'] = $_POST['job_date'];
        }	
		$dep = $this->session->userdata('dept');
		$usr = $this->session->userdata('user_id');
		$this->load->model('Operations_model');
		$jobs=$this->Operations_model->get_daily_job_list($data['job_date'],1,$dep,$usr);

		$grouped_jobs = [];
        foreach ($jobs as $job) {
            $grouped_jobs[$job['job_cat']][] = $job;
        }

		$data['grouped_jobs'] = $grouped_jobs;
		
		$print = $_POST['print_opt'] ?? 0;
        if($print == 1){
			$this->load->view('operations/print/print_job_list.php',$data);
		}
		else{
			$data['main_content']='operations/daily_job_list.php';
			$this->load->view('includes/template.php',$data);
		}	
		
    }

	function view_job_details(){
		$data['title']='Job Details';
		$job = $this->uri->segment('3');
		$data['edit'] = $this->uri->segment('4');
		$this->load->model('Operations_model');
		$data['job']=$this->Operations_model->get_job_by_id($job);
		$data['job_files']=$this->Operations_model->get_job_files($job);
		$this->load->model('Users_model');
		$data['customers']=$this->Users_model->get_customer_list();
		$data['sales_team']=$this->Users_model->get_user_list('Sales');
		$data['drivers']=$this->Users_model->get_user_list('Driver');
		$this->load->model('Setup_model');
		$data['job_types']=$this->Setup_model->get_job_types();
		
		$data['main_content']='operations/view_job_details.php';
		$this->load->view('includes/template.php',$data);
	}

	function edit_job_details(){
		$data['title']='Edit Job';
		$job = $this->uri->segment('3');
		$data['edit'] = $this->uri->segment('4');
		$this->load->model('Operations_model');
		$data['job']=$this->Operations_model->get_job_by_id($job);
		$data['job_files']=$this->Operations_model->get_job_files($job);
		$this->load->model('Users_model');
		$data['customers']=$this->Users_model->get_customer_list();
		$data['sales_team']=$this->Users_model->get_user_list('Sales');		
		$data['drivers']=$this->Users_model->get_user_list('Driver');
		$this->load->model('Setup_model');
		$data['job_types']=$this->Setup_model->get_job_types();
		$data['payment_terms']=$this->Setup_model->get_payment_terms();
		
		$data['main_content']='operations/edit_job_details.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_job(){
		$this->load->model('Operations_model');
		$result = $this->Operations_model->update_job();

		if($result!=0){
			$this->session->set_flashdata('success', 'Data Updated Successfully..');
			redirect('Operations/edit_job_details/'.$result);
		}
		else{
			$this->session->set_flashdata('Warning', 'Some Error Occured');
			redirect('Operations/daily_job_list');
		}
	}

	function complete_job(){
		$data['title']='Complete Job';
		$job = $this->uri->segment('3');
		$this->load->model('Operations_model');
		$data['job']=$this->Operations_model->get_job_by_id($job);

		$data['main_content']='operations/job_comple.php';
		$this->load->view('includes/template.php',$data);
	}

	function add_job_completion(){
		$job_id = $_POST['job_id'];
		$this->load->model('Operations_model');
		//$result = $this->Operations_model->complete_job();
		$esr_file = $this->generate_esr($job_id);
		// $result = $this->Operations_model->update_esr_file_path($esr_file,$job_id);
		// if($result!=''){
		// 	$this->session->set_flashdata('success', 'Data Updated Successfully..');
		// 	redirect('Operations/completed_jobs');
		// }
		// else{
		// 	$this->session->set_flashdata('Warning', 'Some Error Occured');
		// 	redirect('Operations/daily_job_list');
		// }
	}

	function completed_jobs(){
        $data['title']='Completed Jobs';

		$dep = $this->session->userdata('dept');
		$usr = $this->session->userdata('user_id');

		$this->load->model('Operations_model');
        if(isset($_POST['job_date'])){
			$data['job_date'] = $_POST['job_date'];            
		    $data['records']=$this->Operations_model->get_completed_job_list($dep,$usr,$_POST['job_date']);
        }	
		else{
			$data['records']=$this->Operations_model->get_completed_job_list($dep,$usr,'');
		}
        
		$data['main_content']='operations/completed_jobs.php';
		$this->load->view('includes/template.php',$data);
    }

	function generate_esr(){
		//$data['job_id'] = $job_id;
		//$this->load->library('tcpdf');
		$data['job_id'] = 55;
		$this->load->model('Operations_model');
		$data['job']=$this->Operations_model->get_job_by_id($data['job_id']);
		$data['selected_options']=$this->Operations_model->get_checklist_options_for_job($data['job_id']);
		$data['new_options']=$this->Operations_model->get_new_checklist_options_for_job($data['job_id']);
		$this->load->view('operations/print/print_esr.php', $data, TRUE);
		//print_r($data['new_options']);
		//$html = $this->load->view('operations/print/print_esr.php', $data, TRUE); 
		// $pdf = new Tcpdf();

		// $pdf->SetCreator(PDF_CREATOR);
		// $pdf->SetAuthor('Your Name');
		// $pdf->SetTitle('ESR');
		// $pdf->SetSubject('Subject');

		// $pdf->AddPage();
		// $pdf->SetMargins(5, 10, 5); // Left, Top, Right margins
		// $pdf->SetAutoPageBreak(TRUE, 10); // Enable auto page break
		// $pdf->SetFont('dejavusans', '', 12);
		// $pdf->writeHTML($html, true, false, true, false, '');
		
		// $file_name = $data['job']['job_title'].'.pdf';
		// $file_path = FCPATH . 'public/uploded_documents/esr/'.$file_name;  // Save to 'uploads' directory
		// $pdf->Output($file_path, 'F');
		// return 'public/uploded_documents/esr/'.$file_name;
	}

	function send_mail_form(){
		$data['title']='Email to client';
		$data['job'] = $this->uri->segment('3');

		$this->load->model('Operations_model');
		$data['job_det']=$this->Operations_model->get_job_by_id($data['job']);
       
		$data['main_content']='operations/email_form.php';
		$this->load->view('includes/template.php',$data);
	}

	function send_mail(){
		$job = $this->uri->segment('3');
		$this->load->model('Operations_model');
		$job = $this->Operations_model->get_job_by_id($job);
		
		$to = $job['customer_email'];
		$email_subject = $job['job_title'];

		$message = '
			<!DOCTYPE html>
			<html>
			<head>
				<style>
					body {
						font-family: Arial, sans-serif;
						color: #333333;
						line-height: 1.6;
					}
					.container {
						padding: 20px;
					}
					.header {
						font-size: 18px;
						font-weight: bold;
						color: #0056b3;
						margin-bottom: 20px;
					}
					.content {
						font-size: 14px;
						margin-bottom: 20px;
					}
					.footer {
						font-size: 14px;
					}
					.signature {
						margin-top: 20px;
					}
				</style>
			</head>
			<body>
				<div class="container">
					<div class="header">Dear Sir/Madam,</div>
					<div class="content">
						Greetings from <strong>Climate Plus LLC</strong>!<br><br>
						Please find the attached document for your reference. Should you have any questions or require further assistance, do not hesitate to contact us.
					</div>
					<div class="footer">
						Best regards,<br><br>
						<strong>'.$_POST['staff_name'].'</strong><br>
						'.$_POST['staff_dept'].'<br>
						<strong>Climate Plus LLC</strong>
					</div>
				</div>
			</body>
			</html>
			';

		
		
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'www.greenearthnetwork.in', 
			'smtp_port' => 25,
			'smtp_timeout' => '20',
			'smtp_user' => 'webadmin',
			'smtp_pass' => 'WEBm@ster',
			'mailtype'  => 'html',
			'charset'   => 'iso-8859-1'
		);

			
			
			$this->load->library('email');
			$this->email->clear(TRUE);
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from("webadmin@greenearthnetwork.in",'Climate Plus LLC');
			$this->email->to($to);
			$this->email->subject($email_subject);
			$this->email->message($message);
		
		// $attachments = $this->Operations_model->get_attachments($job);
		// foreach($att as $att_file){
		// 	$att_file1 = base_url('public/uploded_documents/job_files/'.$att_file);
		// 	$this->email->attach($att_file1);
		// }

			$attachment_file = base_url($job['esr_file']);
			$this->email->attach($attachment_file);
		
		
		$res = $this->email->send();
		if ($res){
			$this->session->set_flashdata('success', 'Email Sent Successfully..');
			redirect('Operations/completed_jobs');
		}else{
			$this->session->set_flashdata('danger', 'Email Not Sent.Please try again!');
			redirect('Operations/completed_jobs'); 
		}

		
	}

	function mark_as_received(){
		$job = $_POST['job_id'];
		$this->load->model('Operations_model');
		$res = $this->Operations_model->update_payment_collection($job);
		return $res;
	}

	function cancel_job(){
		$job = $_POST['job_id'];
		$this->load->model('Operations_model');
		$res = $this->Operations_model->cancel_job($job);
		echo $res;
	}

	// public function generate_pdf() {
    //     $job_id = $this->uri->segment('3');
	// 	$this->load->library('tcpdf');
	// 	$this->load->model('Operations_model');
	// 	$data['job']=$this->Operations_model->get_job_by_id($job_id);
	// 	$data['selected_options']=$this->Operations_model->get_checklist_options_for_job($job_id);
	// 	$data['new_options']=$this->Operations_model->get_new_checklist_options_for_job($job_id);

	// 	$html = $this->load->view('operations/print/print_esr.php', $data, TRUE); // TRUE to capture the output
    
	// 	// Create new PDF document
	// 	$pdf = new Tcpdf();
		
	// 	// Set document properties
	// 	$pdf->SetCreator(PDF_CREATOR);
	// 	$pdf->SetAuthor('Your Name');
	// 	$pdf->SetTitle('ESR Report');
	// 	$pdf->SetSubject('Subject');
		
	// 	// Add a page
	// 	$pdf->AddPage();
		
	// 	// Write HTML content
	// 	$pdf->writeHTML($html, true, false, true, false, '');

    //     $file_name = $data['job']['job_title'].'.pdf';
	// 	$file_path = FCPATH . 'public/uploded_documents/esr/'.$file_name;  // Save to 'uploads' directory

    //     // Save the PDF to the server (use 'F' mode to save to a file)
    //     $pdf->Output($file_path, 'F');

    //     // You can also return a success message or redirect to another page
    //     echo 'PDF saved successfully to: ' . $file_path;
    // }


	// function add_sub_category_data()
	// {
	// 	$data['title']='Add Category';
	// 	$this->load->model('Product_model');
	// 	$insert_id = $this->Product_model->add_sub_category_data();

	// 	if($insert_id!=''){
	// 		$this->session->set_flashdata('success', 'Data Saved Successfully..');
	// 		redirect('Product/add_sub_category');
	// 	}
	// }
	// function add_sub_category()
	// {
	// 	$data['title']='Item Sub Category List';
	// 	$this->load->model('Product_model');
	// 	$data['records']=$this->Product_model->get_sub_category_list();

	// 	$data['main_content']='product/sub_category_list.php';
	// 	$this->load->view('includes/template.php',$data);
	// }
	// function edit_sub_category()
	// {
	// 	$data['title']='Edit Item sub Category';
	// 	$id = $this->uri->segment('3');

	// 	$this->load->model('Product_model');
	// 	$data['records']=$this->Product_model->get_category_record_by_id($id);

	// 	$data['main_content']='product/sub_category_edit.php';
	// 	$this->load->view('includes/template.php',$data);
	// }

	// function update_sub_category()
	// {
	// 	$data['title']='Item sub Category';
	// 	$gid=$this->input->post('id');

	// 	$this->load->model('Product_model');
	// 	$res= $this->Product_model->update_sub_category($gid);
		
	// 	if($res)
	// 	{			
	// 		$this->session->set_flashdata('success', 'Data Updated Successfully..');
	// 		redirect('Product/add_sub_category');
	// 	}
	// 	else{
	// 		$this->session->set_flashdata('error', 'duplicate entry..');
	// 		redirect("Product/edit_attribute/$gid");
	// 	}
	// }
	

}?>
