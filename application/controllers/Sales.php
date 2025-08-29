<?php 
date_default_timezone_set('Asia/Kolkata');
		//use Dompdf\Dompdf;
		//require_once FCPATH . 'vendor/autoload.php';
    class Sales extends CI_Controller {
        
        function __construct() {
             parent::__construct();
             $this->is_logged_in();
			 $this->load->model('Sales_model');
			 $this->load->model('Setup_model');
			 
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
        
        /////////////////////// New user  /////////////////////////////////////
	function add_enquiry()
	{
		$data['title']='Add New Enquiry';
		$this->load->model('Product_model');
		$data['products1']=$this->Product_model->get_product_list_by_category('1');
		$data['products2']=$this->Product_model->get_product_list_by_category('2');
		$data['products3']=$this->Product_model->get_product_list_by_category('3');
		$this->load->model('Users_model');
		$data['cust_records'] = $this->Users_model->get_active_customer_list();
		$data['user_records']=$this->Users_model->get_user_list();
		$this->load->model('Sales_model');
		$data['enq_records']=$this->Sales_model->get_enquiry_list();
		$data['main_content']='sales/enquiry_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_new_enquiry()
	{
		$data['title']='Add New Enquiry';
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->add_new_enquiry();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_enquiry_list');
		}
	}
	function view_enquiry_list()
	{
		$data['title']='Enquiry List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_enquiry_list();

		$data['main_content']='sales/enquiry_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_enquiry()
	{
		$data['title']='Enquiry Edit';
		$id = $this->uri->segment('3');
		$data['edit_flag'] = $this->uri->segment('4');
		$version = $this->uri->segment('5');
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_enquiry_record_by_id($id);
		$data['trans_records']=$this->Sales_model->get_enquiry_trans_by_id($id,$version);
		//$data['trans_records2']=$this->Sales_model->get_enquiry_trans2_by_id($id,$version);

		$this->load->model('Product_model');
		$category = $data['records'][0]->enq_type;
		$data['products']=$this->Product_model->get_product_list_by_category($category);
		
		$this->load->model('Users_model');
		$data['supplier_records']=$this->Users_model->get_supplier_list();
		$data['user_records']=$this->Users_model->get_user_list();
		$this->load->model('Setup_model');
		$data['terms_rec']=$this->Setup_model->get_terms_details();
		// echo '<pre>';
		// print_r($data);exit;
		$data['main_content']='sales/enquiry_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_enquiry_data()
	{
		$data['title']='New Enquiry';
		$gid=$this->input->post('id');

		$this->load->model('Sales_model');
		$this->Sales_model->update_enquiry_data($gid);
		echo $this->db->last_query()."<br>";

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Sales/view_enquiry_list');
	}
	function delete_enquiry()
	{
		$enquiry_id=$this->input->post('enquiry_id');
		$this->load->model('Sales_model');
		$res = $this->Sales_model->delete_enquiry($enquiry_id);
		echo $res;
	}
	function convert_enquiry_to_RFQ()
	{
		$enq_id=$this->input->post('id');
		$selected_tr=$this->input->post('selected_tr');
		$data['enquiry_code']=$this->input->post('enquiry_code');
		$data['clien_ref']=$this->input->post('clien_ref');
		$data['rfq_type']=$this->input->post('rfq_type');
        	$enq_revision = $this->input->post('revision');
		
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_enquiry_record_by_id($enq_id);
		$data['records2']=$this->Sales_model->get_enquiry_trans_for_RFQ($enq_id,$selected_tr);
		
	   	$this->load->model('Purchase_Model');
	   	$rfq_id = $this->Purchase_Model->add_purchase_rfq($enq_id,$data['records2'],$enq_revision);
	   
		$this->load->model('Setup_model');
        	$data['comapny_records']=$this->Setup_model->get_company_master_list();
        	
		
		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Purchase/view_rfq_list');
		
	}
	/////////////////////// feasibility enquiry /////////////////////////////////////
	function add_enquiry_feasibility()
	{
		$data['title']='Add Enquiry  feasibility';
		$this->load->model('Sales_model');
		$data['enq_records']=$this->Sales_model->get_nonfeasible_enquiry_list();
		$data['main_content']='sales/add_enq_feasibility.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_enquiry_feasibility_data()
	{
		$data['title']='Add New Customer';
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->add_enquiry_feasibility_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/add_enquiry_feasibility');
		}
	}
	///////////////// COST SHEET //////////////
	function order_acknowledge()
	{
		$data['title']='Cost Sheet';
		$this->load->model('Sales_model');
		$data['enq_records']=$this->Sales_model->get_feasible_enquiry_list();
		$this->load->model('Users_model');
		$data['supplier_records']=$this->Users_model->get_supplier_list();

		$data['main_content']='sales/cost_sheet.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function add_cost_sheet()
	{
		$data['title']='Cost Sheet';
		
		$enq_id=$this->input->post('enq_id');
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->add_cost_sheet($enq_id);

		redirect('Sales/cost_sheet_list');
	}
	function cost_sheet_list()
	{
		$data['title']='Cost Sheet List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_cost_sheet_list();

		$data['main_content']='sales/cost_sheet_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function print_cost_sheet()
	{
	        $data['title']='Cost Sheet Print';
		$id = $this->uri->segment('3');  
		$data['rev_version'] = $this->uri->segment('4');  
		$data['ack_id'] = $this->uri->segment('5');    
		
		$this->load->model('Setup_model');
        	$data['comapny_records']=$this->Setup_model->get_company_master_list();

		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($id);
		$data['records2']=$this->Sales_model->get_quotation_tr_by_id($id,$data['rev_version']);
		$data['records3']=$this->Sales_model->get_quotation_ack_by_id($data['ack_id']);

		$this->load->view('sales/print/quotation_ack_print.php',$data);
	}
	function edit_cost_sheet()
	{
		$data['title']='Cost Sheet Details Edit';
		$id = $this->uri->segment('3');
		$data['edit_flag'] = $this->uri->segment('4');
		$data['approve_flag'] = $this->uri->segment('5');
		//$version = $this->uri->segment('5');
        	//$version = 1;


		$data['main_content']='sales/cost_sheet_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_cost_sheet()
	{
		$data['title']='New Enquiry';
		$gid=$this->input->post('id');

		$this->load->model('Sales_model');
		$this->Sales_model->update_enquiry_data($gid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Sales/view_enquiry_list');
	}

/* Estimation start */


function add_estimation()
	{
		$data['title']='Add New Estimate';
		$this->load->model('Sales_model');
		$data['enq_records']=$this->Sales_model->get_manf_enquiry_list_for_qtn();
		
		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list();
		$prifix='CAC/EST/';
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'estimate_code','sales_estimation_master',9)+1;
		$digit=sprintf("%1$04d",$num);
		$code =$prifix.$digit;
		$data['code'] =$code;
		
		$this->load->model('Setup_model');
		$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
		$data['currency_list']=$this->Setup_model->get_currency_list();
	    $data['bank_details']=$this->Setup_model->get_company_bank_list();
		
		$data['terms_rec']=$this->Setup_model->get_terms_all_details();
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_user_list();
		$this->load->model('Sales_model');
		$data['qtn_records']=$this->Sales_model->get_all_quotation_list();
		
		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list();
			
		
		$data['main_content']='sales/estimate_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_estimation_data()
	{
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->add_estimation_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_estimation_list');
		}
	}
	function view_estimation_list()
	{
		$data['title']='Estimation List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_estimation_list();

		$data['main_content']='sales/estimation_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_estimation()
	{
		$data['title']='Edit estimation';
		$id = $this->uri->segment('3');
		$version = $this->uri->segment('4');
		$data['edit_flag'] = $this->uri->segment('5');

		$this->load->model('Users_model');
		$data['cust_records'] = $this->Users_model->get_active_customer_list();
		$this->load->model('Setup_model');
		$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
		$data['currency_list']=$this->Setup_model->get_currency_list();
	    $data['bank_details']=$this->Setup_model->get_company_bank_list();
		$data['terms_rec']=$this->Setup_model->get_terms_details();
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($id);		
		$data['records2']=$this->Sales_model->get_quotation_tr_by_id($id,$version);
		//echo '<pre>';print_r($data['records2']);exit;
		$data['records3']=$this->Sales_model->get_quotation2_tr_by_id($id);
		$enq_type = $data['records1'][0]->enq_type;
		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list_by_category($enq_type);
		//echo '<pre>';print_r($data['products']);exit;

		$data['main_content']='sales/quotation_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_estimation_data()
	{
		$data['title']='New Supplier';
		$qid=$this->input->post('quote_id');

		$this->load->model('Sales_model');
		$this->Sales_model->update_quotation_data($qid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Sales/view_quotation_list');
	}
	function print_estimation()
	{
	    $data['title']='Estimation Print';
		$id = $this->uri->segment('3');  
		$data['rev_version'] = $this->uri->segment('4');  
		$enq_type = $this->uri->segment('5');    
		$data['disc'] = $this->uri->segment('6'); 
		
		$this->load->model('Users_model');
		$data['customer_list']=$this->Users_model->get_customer_list();
        $data['comapny_records']=$this->Setup_model->get_company_master_list();
		$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_estimation_master_by_id($id);
		$data['records2']=$this->Sales_model->get_estimation_tr_by_id($id);
		//echo '<pre>';print_r($data['records2']);exit;
		$this->load->view('sales/print/mfg_estimation_print.php',$data);
	}
	
	function excel_estimation()
	{
	        
		$id = $this->uri->segment('3');  
		$data['rev_version'] = $this->uri->segment('4');  
		$data['edit_flag'] = $this->uri->segment('5');    
		$enq_type = $this->uri->segment('5');
		$this->load->model('Setup_model');
        $data['comapny_records']=$this->Setup_model->get_company_master_list();

		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($id);
		$data['records2']=$this->Sales_model->get_quotation_tr_by_id($id,$data['rev_version']);
		$data['records3']=$this->Sales_model->get_quotation2_tr_by_id($id);
		if($enq_type == '1'){
			$this->load->view('sales/print/trd_quotation_excel.php',$data);
		}
		else if($enq_type == '3'){
			$this->load->view('sales/print/ms_quotation_excel.php',$data);
		}
		
	}

/*Estimation End*/





	/////////////////////// New quotation /////////////////////////////////////
	function add_quotation()
	{
		$data['title']='Add New Quotaion';
		$this->load->model('Sales_model');
		$data['enq_records']=$this->Sales_model->get_enquiry_list_for_qtn();
		
		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list();
		$prifix='CAC/QTN/';
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'quotation_code','sales_quotation_master',9)+1;
		$digit=sprintf("%1$04d",$num);
		$code =$prifix.$digit;
		$data['code'] =$code;
		
		$this->load->model('Setup_model');
		$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
		$data['currency_list']=$this->Setup_model->get_currency_list();
	    $data['bank_details']=$this->Setup_model->get_company_bank_list();
		
		$data['terms_rec']=$this->Setup_model->get_terms_all_details();
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_user_list();
		$this->load->model('Sales_model');
		$data['qtn_records']=$this->Sales_model->get_all_quotation_list();
		
		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list();
			
		
		$data['main_content']='sales/quotation_add.php';
		
		$this->load->view('includes/template.php',$data);
	}
	function add_quotation_data()
	{
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->add_quotation_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_quotation_list');
		}
	}
	function view_quotation_list()
	{
		$data['title']='Quotaion List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_quotation_list();

		$data['main_content']='sales/quotation_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_quotation()
	{
		$data['title']='Edit Quotation';
		$id = $this->uri->segment('3');
		$version = $this->uri->segment('4');
		$data['edit_flag'] = $this->uri->segment('5');

		$this->load->model('Users_model');
		$data['cust_records'] = $this->Users_model->get_active_customer_list();
		$this->load->model('Setup_model');
		$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
		$data['currency_list']=$this->Setup_model->get_currency_list();
	    $data['bank_details']=$this->Setup_model->get_company_bank_list();
		$data['terms_rec']=$this->Setup_model->get_terms_details();
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($id);		
		$data['records2']=$this->Sales_model->get_quotation_tr_by_id($id,$version);
		//echo '<pre>';print_r($data['records2']);exit;
		$data['records3']=$this->Sales_model->get_quotation2_tr_by_id($id);
		$enq_type = $data['records1'][0]->enq_type;
		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list_by_category($enq_type);
		//echo '<pre>';print_r($data['products']);exit;

		$data['main_content']='sales/quotation_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_quotation_data()
	{
		$data['title']='New Supplier';
		$qid=$this->input->post('quote_id');

		$this->load->model('Sales_model');
		$this->Sales_model->update_quotation_data($qid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Sales/view_quotation_list');
	}
	function print_quotation()
	{
	    $data['title']='Quotation Print';
		$id = $this->uri->segment('3');  
		$data['rev_version'] = $this->uri->segment('4');  
		$enq_type = $this->uri->segment('5');    
		$data['disc'] = $this->uri->segment('6'); 
		
		$this->load->model('Setup_model');
		//$data['customer_list']=$this->Setup_model->get_customer_list();
        $data['comapny_records']=$this->Setup_model->get_company_master_list();
		$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($id);
		$data['records2']=$this->Sales_model->get_quotation_tr_by_id($id,$data['rev_version']);
		$data['records3']=$this->Sales_model->get_quotation2_tr_by_id($id);
		

		if($enq_type == '1'){
			
			$this->load->view('sales/print/trd_quotation_print.php',$data);
		}
		elseif($enq_type == '2'){
			
			$this->load->view('sales/print/mfg_quotation_print.php',$data);
		}
		else if($enq_type == '3'){
			
			$this->load->view('sales/print/ms_quotation_print.php',$data);
		}

		// $dompdf = new Dompdf();
		
		// $dompdf->loadHtml($html);
		// $dompdf->setPaper('A4', 'portrait');
		// $dompdf->render();
		
		// $dompdf->stream('quotation.pdf', array('Attachment' => 0));
		
	}
	
	function excel_quotation()
	{
	        
		$id = $this->uri->segment('3');  
		$data['rev_version'] = $this->uri->segment('4');  
		$data['edit_flag'] = $this->uri->segment('5');    
		$enq_type = $this->uri->segment('5');
		$this->load->model('Setup_model');
        $data['comapny_records']=$this->Setup_model->get_company_master_list();

		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($id);
		$data['records2']=$this->Sales_model->get_quotation_tr_by_id($id,$data['rev_version']);
		$data['records3']=$this->Sales_model->get_quotation2_tr_by_id($id);
		if($enq_type == '1'){
			$this->load->view('sales/print/trd_quotation_excel.php',$data);
		}
		else if($enq_type == '3'){
			$this->load->view('sales/print/ms_quotation_excel.php',$data);
		}
		
	}
	
	////////// Order acceptance ///////////
	
	
	function order_acceptance()
	{
		$data['title']='Accept Quotation';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_pending_quotations();
		$prifix='STK'.date('y');
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'catalyst_ref_no','invoice_master',8)+1;
		$digit=sprintf("%1$04d",$num);
		$data['catalyst_ref_no'] =$prifix.date('m').$digit;
		 		
		$data['currency_list']=$this->Setup_model->get_currency_list();	 
		
		$data['main_content']='sales/quotation_accept.php';
		$this->load->view('includes/template.php',$data);
	}
	function accept_quotation_approval()
	{
		$data['title']='Quotaion Approval';
	
		$qid=$this->input->post('qid');
		
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($qid);
		
		foreach($data['records1'] as $v)
		{
			$version = $v->revision;
		}
		
		$insert_id = $this->Sales_model->add_quotation_approval($qid,$version);

		if($insert_id!='')
		{
			$this->session->set_flashdata('success', 'Quotation Approved Successfully..');
			redirect('Sales/approved_quotation_list');
		}
	}
	function approved_quotation_list()
	{
		$data['title']='Approved Quotation List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_approved_quotations();

		$data['main_content']='sales/quotation_accepted_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function view_quotation_files()
	{
		$data['title']=' Quotation Documents List';
		$qid=$this->uri->segment('3');
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($qid);
		$data['records']=$this->Sales_model->get_quote_documents_by_id($qid);

		$data['main_content']='sales/quotation_documents_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_quotation_documents()
	{
		$qid=$this->input->post('quote_id');

		$this->load->model('Sales_model');
		$this->Sales_model->add_quotation_documents($qid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Sales/approved_quotation_list');
	}
	/////////////////////// New Invoices /////////////////////////////////////
	function add_invoice()
	{

		$data['title']='Generate Invoice';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_approved_quotations_for_invoice();
		//echo '<pre>';print_r($data['records']);exit;
		$prifix='BES/PI/'.date('y').'/';
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'invoice_code','invoice_master',11)+1;
		$digit=sprintf("%1$04d",$num);
		$data['code'] =$prifix.$digit;		
		
		$this->load->model('Setup_model');
		$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
		$data['currency_list']=$this->Setup_model->get_currency_list();
		$data['bank_details']=$this->Setup_model->get_company_bank_list();
		$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_user_list();
		$data['cust_records'] = $this->Users_model->get_active_customer_list();
		
		$this->load->model('Accounts_model');
	        $data['sundry_accounts1'] =$this->Accounts_model->get_gen_ledger_detors_records(); 
	        $data['sundry_accounts2'] =$this->Accounts_model->get_general_ledger_by_group('Sales Accounts'); 
	        $data['sundry_accounts3'] =$this->Accounts_model->get_all_general_ledger_accounts(); 
	
	
		$data['main_content']='sales/invoice_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_invoice_data()
	{
		$data['title']='Add New Invoice';
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->add_invoice_data();

		// if($insert_id!=''){
		// 	$this->session->set_flashdata('success', 'Data Saved Successfully..');
		// 	redirect('Sales/view_invoice_list');
		// }
	}
	function get_invoice_code()
	{
		$type = $this->input->post('type');
		$ref_no= $this->input->post('ref_no');
		if($type=='PI')
		{
			$prifix=  'BES/PI/'.date('y').'/';
		}		
		else {
	  		$prifix='BES/TI/'.date('y').'/';
  		}
   		//$lnt= strlen($prifix)+2;
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'invoice_code','invoice_master',11)+1;
		$digit=sprintf("%1$04d",$num);
		$data['code'] =$prifix.$digit;
		 echo $data['code'];
	}
	function get_catalyst_code()
	{
		$type = $this->input->post('type');
	
  		$prifix=$type.date('y');
		//$lnt= strlen($prifix)+2;
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'catalyst_ref_no','invoice_master',8)+1;
		$digit=sprintf("%1$04d",$num);
		$data['catalyst_ref_no'] =$prifix.date('m').$digit;
		 echo $data['catalyst_ref_no'];
	}
	function view_invoice_list()
	{
		$data['title']='Invoice List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_invoice_list();

		$data['main_content']='sales/invoice_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_invoice()
	{
		$data['title']='Edit Invoice';
		$id = $this->uri->segment('3');
		$data['edit_flag'] = $this->uri->segment('4');  
		//$data['edit_flag'] = $this->uri->segment('5');  

		
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_invoice_master_by_id($id);
		$data['records2']=$this->Sales_model->get_invoice_tr_by_id($id);
	//	$data['records3']=$this->Sales_model->get_invoice2_tr_by_id($id);
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_user_list();
		$data['cust_records'] = $this->Users_model->get_active_customer_list();

		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list();
		$this->load->model('Setup_model');
		$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
		$data['currency_list']=$this->Setup_model->get_currency_list();
	    	$data['bank_details']=$this->Setup_model->get_company_bank_list();
	    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
		
		$data['main_content']='sales/invoice_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_invoice_data()
	{
		$data['title']='Edit Invoice';
		$gid=$this->input->post('invoice_id');

		$this->load->model('Sales_model');
		$this->Sales_model->update_invoice_data($gid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Sales/view_invoice_list');
	}
	function print_invoice()
	{
	    $data['title']='Invoice Print';
		$id = $this->uri->segment('3');  
		$data['rev_version'] = $this->uri->segment('4');  
		$data['edit_flag'] = $this->uri->segment('5');    
		
		$this->load->model('Setup_model');
		//$data['customer_list']=$this->Setup_model->get_customer_list();
        $data['comapny_records']=$this->Setup_model->get_company_master_list();

		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_invoice_master_by_id($id);
		$data['records2']=$this->Sales_model->get_invoice_tr_by_id($id);
		//$data['records3']=$this->Sales_model->get_invoice2_tr_by_id($id);
// echo '<pre>';
// print_r($data['records2']);exit;
		$this->load->view('sales/print/invoice_print.php',$data);
	}
	function excel_invoice()
	{
	        $data['title']='Invoice Print';
		$id = $this->uri->segment('3');  
		$data['rev_version'] = $this->uri->segment('4');  
		$data['edit_flag'] = $this->uri->segment('5');    
		
		$this->load->model('Setup_model');
		//$data['customer_list']=$this->Setup_model->get_customer_list();
        	$data['comapny_records']=$this->Setup_model->get_company_master_list();

		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_invoice_master_by_id($id);
		$data['records2']=$this->Sales_model->get_invoice_tr_by_id($id);

		$this->load->view('sales/print/invoice_excel.php',$data);
	}
	function delete_invoice()
	{
		
		$quote_id=$this->input->post('quote_id');
		$invoice_id=$this->input->post('invoice_id');
		$this->load->model('Sales_model');
		$res = $this->Sales_model->delete_invoice($invoice_id,$quote_id);
		echo $res;
	}
	///////////// delivery //// 
	function add_delivery_challan()
	{
		$data['title']='Delivery Order';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_tax_invoice_list();
		$prifix='BES/DO/'.date('y');
   		//$lnt= strlen($prifix)+2;
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'dc_code','delivery_order',11)+1;
		$digit=sprintf("%1$04d",$num);
		$data['code'] =$prifix.$digit;
		
		$data['qid'] = $this->input->post('qid');
		$data['warehouse_id'] = 3;
		$data['case_no'] = 1;
		
		$version = $this->input->post('rev_version');
		
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_invoice_master_by_id($data['qid']);
		$data['records2']=$this->Sales_model->get_invoice_balance_tr_by_id($data['qid']);
		
		
		//$this->load->helper('Stock_helper');
		//$data['bill_entry']=get_bill_entry_fromstock($data['warehouse_id']);
	
		$data['main_content']='sales/dc_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_dc_data()
	{
		$data['title']='Add Delivery Order';
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->add_dc_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_dc_list');
		}
	}
	function edit_delivery_challan()
	{
		$data['title']='Edit Delivery Order';
		$id = $this->uri->segment('3');
		$data['warehouse_id'] = 3;
		
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_tax_invoice_list();
		
		$prifix='D-DO'.date('y');
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'dc_code','delivery_order',9)+1;
		$digit=sprintf("%1$04d",$num);
		$data['code'] =$prifix.date('m').$digit;
		
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_dc_master_by_id($id);
		$data['records2']=$this->Sales_model->get_dc_tr_by_id($id);

		$data['main_content']='sales/dc_edit.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function update_dc_data()
	{		
		$data['title']='Add Delivery Order';
		$dc_id=$this->input->post('dc_id');
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->update_dc_data($dc_id);

		if($insert_id)
		{
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_dc_list');
		}
	}
	function view_dc_list()
	{
		$data['title']='Delivery Order List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_dc_list();

		$data['main_content']='sales/dc_list.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function print_dc()
	{
	        $data['title']='Delivery Order Print';
		$id = $this->uri->segment('3');  
		$data['rev_version'] = $this->uri->segment('4');  
		$data['edit_flag'] = $this->uri->segment('5');    
		
		$this->load->model('Setup_model');
        	$data['comapny_records']=$this->Setup_model->get_company_master_list();

		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_dc_master_by_id($id);
		$data['records2']=$this->Sales_model->get_dc_tr_by_id($id);

		$this->load->view('sales/print/dc_print.php',$data);
	}
	function dummy_dc()
	{
		$data['title']='Dummy Delivery Order';
		$id = $this->uri->segment('3');
		
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_tax_invoice_list();
		
		$prifix='D-DO'.date('y');
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'dc_code','delivery_order',9)+1;
		$digit=sprintf("%1$04d",$num);
		$data['code'] =$prifix.date('m').$digit;
		
		$this->load->model('Setup_model');
		$data['packing_list']=$this->Setup_model->get_packing_type_list();
		
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_dc_master_by_id($id);
		$data['records2']=$this->Sales_model->get_dc_tr_by_id($id);
		$data['records3']=$this->Sales_model->get_dc_details_by_id($id);

		
		$data['main_content']='sales/dc_dummy_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_dummy_dc_data()
	{		
		$data['title']='Add Delivery Order';
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->add_dummy_dc_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_dc_list');
		}
	}
	function delete_issued_stock()
	{
		$do_id=$this->input->post('do_id');
		$model_code=$this->input->post('model_code');
		$this->load->model('Sales_model');
		$res = $this->Sales_model->delete_issued_stock($do_id,$model_code);
		echo $res;
	}
	function delete_dc_record()
	{
		$do_id=$this->input->post('do_id');
		$invoice_id=$this->input->post('invoice_id');
		$this->load->model('Sales_model');
		$res = $this->Sales_model->delete_dc_record($do_id,$invoice_id);
		echo $res;
	}
	//////////// add_job_card ////////////////
	function add_job_card()
	{
		$data['title']='Create Job Card';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_approved_quotations_for_jobcard();
		
		$prifix='JOB'.date('y');
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'jcode','job_card',6)+1;
		$digit=sprintf("%1$04d",$num);
		$data['code'] =$prifix.$digit;		
		
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_user_list();
		
		$data['main_content']='sales/job_card_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_job_card_records()
	{
		$data['title']='Add Job Card';
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->save_job_card();
		// echo $insert_id;exit;
		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_job_card_list');
		}
	}
	function view_job_card_list()
	{
		$data['title']='Job Card List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_job_card_list();
		// echo '<pre>';print_r($records);exit;
		$data['main_content']='sales/job_card_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_job_card()
	{
		$data['title']='Edit Job Card';
		$id = $this->uri->segment('3');
		
		$data['edit_flag']=0;
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_user_list();
		
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_jcard_master_by_id($id);
		$data['records2']=$this->Sales_model->get_jcard_details_by_id($id);

		// echo '<pre>';
		// print_r($data['records1']);exit;

		$data['main_content']='sales/job_card_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_jobcard_data()
	{	
		$data['title']='Update Job Card ';
		$pl_id=$this->input->post('jcard_id');
		$insert_id = $this->Sales_model->update_job_card_records($pl_id);

		// if($insert_id!=''){
		// 	$this->session->set_flashdata('success', 'Data Saved Successfully..');
		// 	redirect('Sales/view_job_card_list');
		// }
	}
	function print_job_card_records()
	{
	    $data['title']='Job Card Print';
		$id = $this->uri->segment('3');  
		// $data['rev_version'] = $this->uri->segment('4');  
		// $data['logo_flag'] = $this->uri->segment('5');    
		
		$this->load->model('Setup_model');
		//$data['customer_list']=$this->Setup_model->get_customer_list();
        	$data['comapny_records']=$this->Setup_model->get_company_master_list();

		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_user_list();

		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_jcard_master_by_id($id);
		$data['records2']=$this->Sales_model->get_jcard_details_by_id($id);
		// echo '<pre>';
		// print_r($data['records1']);print_r($data['records2']);exit;
		$this->load->view('sales/print/joborder_print.php',$data);
		
	}

	function delete_jobcard()
	{
		$pl_id=$this->input->post('jcard_id');
		$this->load->model('Sales_model');
		$res = $this->Sales_model->delete_jobcard($pl_id);
		echo $res;
	}
	/////////////////////////packing List //////////////////////////
	function add_packing_list()
	{
		$data['title']='Factory Acceptance Test (FAT)';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_quote_list_for_FAT();
		$this->load->model('Setup_model');
	    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
		
		$data['main_content']='sales/packing_list_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_packing_list_data()
	{
	
		$data['title']='Add FAT List';
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->add_packing_list_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_packing_list');
		}
	}
	function edit_packing_list()
	{
		$data['title']='Edit FAT List';
		$id = $this->uri->segment('3');
		
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_pl_master_by_id($id);
		$data['records2']=$this->Sales_model->get_pl_details_by_id($id);
		//$data['records3']=$this->Sales_model->get_pl_packing_wt_by_id($id);
		
		$data['main_content']='sales/packing_list_edit.php';
		$this->load->view('includes/template.php',$data);
	}
	function update_packing_list_data()
	{	
		$data['title']='Update FAT List';
		$fat_id=$this->input->post('fat_id');
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->update_packing_list_data($fat_id);

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_packing_list');
		}
	}
	function view_packing_list()
	{
		$data['title']='FAT Certificate List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_pl_list();

		$data['main_content']='sales/packing_list.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function print_packing_list()
	{
	        $data['title']='FAT List Print';
		$id = $this->uri->segment('3');  
		$data['dc_id'] = $this->uri->segment('4');   
		
		$this->load->model('Setup_model');
		//$data['customer_list']=$this->Setup_model->get_customer_list();
        	$data['comapny_records']=$this->Setup_model->get_company_master_list();

		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_pl_master_by_id($id);
		$data['records2']=$this->Sales_model->get_pl_details_by_id($id);

		$this->load->view('sales/print/packing_list_print.php',$data);
	}
	function delete_pl_record()
	{
		$pl_id=$this->input->post('pl_id');
		$this->load->model('Sales_model');
		$res = $this->Sales_model->delete_PL_record($pl_id);
		echo $res;
	}
	/////////////////////// Certificate ///////////////////////
	function add_certificate()
	{
		$data['title']='Add SAT Certificate';
		
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_dc_list();
		$this->load->model('Setup_model');
	    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
		$data['main_content']='sales/SAT_certificate.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function add_SAT_data()
	{
	
		$data['title']='Add SAT Certificate';
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->add_SAT_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_SAT_list');
		}
	}
	function view_SAT_list()
	{
		$data['title']='SAT Certificate List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_SAT_list();

		$data['main_content']='sales/SAT_certificate_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_SAT_data()
	{
		$data['title']='Edit SAT Certificate';
		$id = $this->uri->segment('3');
		
		$this->load->model('Sales_model');
		$data['dcrecords']=$this->Sales_model->get_dc_list();
		$data['records1']=$this->Sales_model->get_SAT_master_by_id($id);
		$data['records2']=$this->Sales_model->get_SAT_details_by_id($id);
		
		$this->load->model('Setup_model');
	    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
		
		$data['main_content']='sales/SAT_certificate_edit.php';
		$this->load->view('includes/template.php',$data);
	}
	function update_SAT_data()
	{	
		$data['title']='Update SAT Certificate';
		$pl_id=$this->input->post('sat_id');
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->update_SAT_data($pl_id);

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_SAT_list');
		}
	}
	function print_SAT_certificate()
	{
	        $data['title']='SAT Certificate Print';
		$id = $this->uri->segment('3');  
		$data['dc_id'] = $this->uri->segment('4');   
		
		$this->load->model('Setup_model');
        	$data['comapny_records']=$this->Setup_model->get_company_master_list();

		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_SAT_master_by_id($id);
		$data['records2']=$this->Sales_model->get_SAT_details_by_id($id);

		$this->load->view('sales/print/SAT_certificate_print.php',$data);
	}
	function delete_SAT_record()
	{
		$pl_id=$this->input->post('pl_id');
		$this->load->model('Sales_model');
		$res = $this->Sales_model->delete_SAT_record($pl_id);
		echo $res;
	}


	// Warranty Code start
	
	function add_warranty()
	{
		$data['title']='Add Warranty';
		
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_invoice_list();
		$data['main_content']='sales/add_warranty.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function add_warranty_data()
	{
	
		$data['title']='Add Warranty Data';
		$this->load->model('Sales_model');
		$insert_id = $this->Sales_model->add_warranty_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Sales/view_warranty_list');
		}
	}
	function view_warranty_list()
	{
		$data['title']='Warranty List';
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_warranty_list();
// echo '<pre>';print_r($data['records']);exit;
		$data['main_content']='sales/warranty_list.php';
		$this->load->view('includes/template.php',$data);
	}
	// function edit_warranty_data()
	// {
	// 	$data['title']='Edit SAT Certificate';
	// 	$id = $this->uri->segment('3');
		
	// 	$this->load->model('Sales_model');
	// 	$data['dcrecords']=$this->Sales_model->get_warranty_list();
	// 	$data['records1']=$this->Sales_model->get_warranty_master_by_id($id);
	// 	$data['records2']=$this->Sales_model->get_warranty_details_by_id($id);
		
	// 	$this->load->model('Setup_model');
	//     	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
		
	// 	$data['main_content']='sales/SAT_certificate_edit.php';
	// 	$this->load->view('includes/template.php',$data);
	// }
	// function update_warranty_data()
	// {	
	// 	$data['title']='Update SAT Certificate';
	// 	$pl_id=$this->input->post('sat_id');
	// 	$this->load->model('Sales_model');
	// 	$insert_id = $this->Sales_model->update_SAT_data($pl_id);

	// 	if($insert_id!=''){
	// 		$this->session->set_flashdata('success', 'Data Saved Successfully..');
	// 		redirect('Sales/view_SAT_list');
	// 	}
	// }
	function print_warranty()
	{
	    $data['title']='Warranty Certificate';
		$id = $this->uri->segment('3');  
		$this->load->model('Setup_model');
        $data['comapny_records']=$this->Setup_model->get_company_master_list();

		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_warranty_master_by_id($id);
		$data['records2']=$this->Sales_model->get_warranty_prod_details_by_id($id);
		$data['records3']=$this->Sales_model->get_warranty_terms_details_by_id($id);

		$this->load->view('sales/print/warranty_print.php',$data);
	}
	function delete_warranty()
	{
		$warr_id=$this->input->post('warr_id');
		$this->load->model('Sales_model');
		$res = $this->Sales_model->delete_warranty($warr_id);
		echo $res;
	}
	

	// Warranty Code end
}?>
