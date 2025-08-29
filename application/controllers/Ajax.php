<?php
class Ajax extends CI_Controller
{
	public function __construct()
	{
	     parent::__construct();
	   	 $this->is_logged_in();
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
		    echo 'You don\'t have permission to access this page. <a href="../login">Login</a>';
			die();
		}
	}		
    	function cancel_record()
    	{
		$this->load->model('Ajax_model');
		$res = $this->Ajax_model->cancel_record();
		if($res)
			echo 1;
		else 
			echo 0;
    	}
    	function delete_record()
    	{
		$this->load->model('Ajax_model');
		$res = $this->Ajax_model->delete_record();
		if($res)
			echo 1;
		else 
			echo 0;
    	}
    	function delete_sales_quotation()
    	{
		$this->load->model('Ajax_model');
		$res = $this->Ajax_model->delete_sales_quotation();
		if($res)
			echo 1;
		else 
			echo 0;
    	}
    	function check_duplicate_exist()
    	{
		$this->load->model('Ajax_model');
		$res = $this->Ajax_model->check_duplicate_exist();
		if($res)
			echo 1;
		else 
			echo 0;
    	}
		function check_duplicate_subcat_exist()
    	{
		$this->load->model('Ajax_model');
		$res = $this->Ajax_model->check_duplicate_subcat_exist();
		
		if($res)
			echo 1;
		else 
			echo 0;
    	}
    	function check_duplicate_item_exist()
    	{
			$this->load->model('Ajax_model');
			$res = $this->Ajax_model->check_duplicate_item_exist();
			if($res)
				echo 1;
			else 
				echo 0;
		}

        function get_bday_age_calculation()
        {
		$today_date = date('Y-m-d');
		$dob_date = date('Y-m-d', strtotime($this->input->post('bdate')));

		$date1=date_create($today_date);
		$date2=date_create($dob_date);

		$diff=date_diff($date1,$date2);
		$y = $diff->format("%y");
		$m = $diff->format("%m");
		$d = $diff->format("%d");

		if($y >=18 && $m >=0 && $d >=0) {
		    echo 1;
		}
		else if($today_date == $dob_date) {
		    echo 2;
		}
		else {
		    echo 0;
		}
	}
	
    function ajax_get_enquiry_info()
    {
		$value=array();
        $enq_id = $this->input->post('enq_id');
        $this->load->model('Sales_model');
        $data['records']=$this->Sales_model->get_enquiry_record_by_id($enq_id);
		foreach($data['records'] as $row)
		{
			$value=array('enq_id'=>$row->enquiry_id,'enq_type'=>$row->enq_type,'customer_id'=>$row->cust_id, 'cust_name'=>$row->cust_name, 'cust_code'=>$row->cust_code, 'enquiry_code'=>$row->enquiry_code, 'enquiry_date'=>date('d-m-Y',strtotime($row->enq_date)), 'client_ref'=>$row->client_ref, 'revision'=>$row->revision);
		}
		echo json_encode($value);
    }
     function get_enquiry_items_list()
     {
        $enq_id = $this->input->post('enq_id');
        $version = $this->input->post('rev_version');
		$this->load->model('Sales_model');
		$data['records2']=$this->Sales_model->get_enquiry_trans_for_feasibility($enq_id,$version);
		
		$this->load->view('ajax/sales_enq_item_table',$data);
     }
     function get_enquiry_for_cost_sheet()
     {
     	$enq_id = $this->input->post('enq_id');
        $version = $this->input->post('rev_version');
	
		$this->load->model('Sales_model');
		$data['records2']=$this->Sales_model->get_enquiry_trans_by_id($enq_id,$version);
	
		$this->load->view('ajax/sales_enq_item_for_costsheet',$data);
     }
     function get_enquiry_items_for_enq()
     {
        $enq_id = $this->input->post('enq_id');
        $version = $this->input->post('rev_version');
	
		$this->load->model('Sales_model');
		$data['']=$this->Sales_model->get_enquiry_trans_for_quote($enq_id,$version);
		
		$this->load->view('ajax/sales_enq_items_for_enquiry',$data);
     }
     function get_enquiry_items_for_quote()
     {
        $enq_id = $this->input->post('enq_id');
        $version = $this->input->post('rev_version');
	
		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list();
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_enquiry_record_by_id($enq_id);		
		 if($data['records'][0]->enq_type == '1'||$data['records'][0]->enq_type == '3'){			
		 	$data['records2']=$this->Sales_model->get_enquiry_trans_for_trading_quote($enq_id,$version);
			
		 }
		elseif($data['records'][0]->enq_type == '2'){//Manufacturing
			$data['records2']=$this->Sales_model->get_enquiry_trans_for_quote_manufacturing($enq_id,$version);
			$data['trans_records2']=$this->Sales_model->get_enquiry_trans2_by_id($enq_id,$version);
		
		 }
		
		  $this->load->view('ajax/sales_enq_items_for_quote',$data);
     }

	 function get_enquiry_items_for_estimate()
     {
        $enq_id = $this->input->post('enq_id');
        $version = $this->input->post('rev_version');
	
		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list();
		$this->load->model('Sales_model');
		$data['records']=$this->Sales_model->get_enquiry_record_by_id($enq_id);		
		 if($data['records'][0]->enq_type == '1'||$data['records'][0]->enq_type == '3'){			
		 	$data['records2']=$this->Sales_model->get_enquiry_trans_for_trading_quote($enq_id,$version);
			 $this->load->view('ajax/sales_enq_items_for_estimate',$data);
			
		 }
		elseif($data['records'][0]->enq_type == '2'){//Manufacturing
			$data['records2']=$this->Sales_model->get_enquiry_trans_for_quote_manufacturing($enq_id,$version);
			$data['trans_records2']=$this->Sales_model->get_enquiry_trans2_by_id($enq_id,$version);
			$this->load->view('ajax/sales_enq_items_for_estimate',$data);
		
		 }
		
     }
     
     function get_quote_items_for_allocation()
     {
        $qid = $this->input->post('qid');
        $version = $this->input->post('rev_version');
		
	$this->load->model('Sales_model');
	$data['records1']=$this->Sales_model->get_quotation_master_by_id($qid);
	foreach($data['records1'] as $v)
	{
		$version = $v->revision;
	}
	$data['records2']=$this->Sales_model->get_quotation_tr_by_id($qid,$version);
	
	$this->load->view('ajax/sales_quote_items_for_allocation',$data);
     }
     function ajax_get_quotation_info()
     {
		
        $qid = $this->input->post('qid');
        $version = $this->input->post('rev_version');
	
		$this->load->model('Setup_model');
		$data['currency_list']=$this->Setup_model->get_currency_list();
		
		$prifix='STK'.date('y');
		
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'catalyst_ref_no','invoice_master',8)+1;
		$digit=sprintf("%1$04d",$num);
		$data['catalyst_ref_no'] =$prifix.date('m').$digit;
		
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($qid);

		foreach($data['records1'] as $v)
		{				
			$version = $v->revision;
		}

		
		$data['records2']=$this->Sales_model->get_quotation_balance_tr_by_id($qid,$version);
		
		$data['records3']=$this->Sales_model->get_quotation2_tr_by_id($qid);
		$data['unit_records']=$this->Sales_model->get_units();
		//echo '<pre>';print_r($data['records1']);exit;	
		$this->load->view('ajax/sales_quote_details',$data);
     }
     function ajax_get_cust_accountId_from_quote()
     {
        $qid = $this->input->post('qid');
	
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($qid);
		foreach($data['records1'] as $v)
		{
			$customer_id = $v->customer_id;
		}
		
		$this->load->model('Accounts_model');
		$data['accountId']=$this->Accounts_model->get_cust_account_Id($customer_id);
		
		echo $data['accountId'];
     }
    
     
     function ajax_get_copy_quotation_info()
     {
        $qid = $this->input->post('qid');
        $version = $this->input->post('rev_version');
			
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($qid);
		foreach($data['records1'] as $v)
		{
			$version = $v->revision;
		}
		$data['records2']=$this->Sales_model->get_quotation_tr_by_id($qid,$version);
		$this->load->view('ajax/sales_quote_details_for_quote',$data);
     }
     function ajax_get_quotation_price()
     {
     	$qid = $this->input->post('qid');
     	$this->load->model('Sales_model');
		$price=$this->Sales_model->ajax_get_quotation_price($qid);
		echo  sprintf("%0.2f",$price);
     }
     function ajax_get_quotation() //sales
    {
		$value=array();
        $id = $this->input->post('post_id');

        $this->load->model('Sales_model');
        $data['records']=$this->Sales_model->get_quotation_master_by_id($id);
		$jpack_id=''; $project_start_date=''; $project_end_date='';
		foreach($data['records'] as $row)
		{
			$project_start_date= date('d-M-Y',strtotime($row->project_start_date??''));
			$project_end_date= date('d-M-Y',strtotime($row->project_end_date??''));

			$value=array('customer_id'=>$row->customer_id, 'customer_name'=>$row->cust_name, 'project_name'=>$row->project_name,'location'=>$row->project_location,'revision'=>$row->revision, 'project_start_date'=>$project_start_date, 'project_end_date'=>$project_end_date, 'quotation_code'=>$row->quotation_code, 'quotation_date'=>date('d-M-Y',strtotime($row->quotation_date)), 'quot_id'=>$row->quote_id, 'enq_master_id'=>$row->enq_master_id, 'enquiry_code'=>$row->enquiry_code);
		}
		echo json_encode($value);
    }

     function ajax_get_invoice_info()
     {
        $qid = $this->input->post('qid');
        $data['case_no'] = $this->input->post('case_no');       
        $version = $this->input->post('rev_version');
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_invoice_master_by_id($qid);
		$data['records2']=$this->Sales_model->get_invoice_balance_tr_by_id($qid);
		
		$this->load->view('ajax/sales_invoice_details',$data);
     }
     function ajax_add_case_in_DO()
     {
     		 $data['case_no'] = $this->input->post('case_no');
		$this->load->view('ajax/sales_invoice_details',$data);
     }
     function get_customer_address()
     {
        $cust_id = $this->input->post('customer_id');
	
	$this->load->model('Users_model');
	$data['records']=$this->Users_model->get_customer_by_id($cust_id);
	$data['cp_list']=$this->Users_model->get_customer_cp_details($cust_id);
	
	$this->load->view('ajax/customer_address',$data);
     }
     function ajax_get_term_details()
     {
     	$value=array();
        $term_id = $this->input->post('term_id');

       $this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_terms_details_by_id($term_id);
	foreach($data['records'] as $row)
	{
		$value=array('payment_term'=>$row->payment_term, 'delivery_term'=>$row->delivery_term, 'notes'=>$row->notes, 'certificate'=>$row->certificate, 'manufacture'=>$row->manufacture, 'origin'=>$row->origin);
	}
	echo json_encode($value);
     }
     function ajax_get_dc_info()
     {
        $do_id = $this->input->post('do_id');
        	
	$this->load->model('Setup_model');
	$data['packing_list']=$this->Setup_model->get_packing_type_list();
	
	$this->load->model('Sales_model');
	$data['records1']=$this->Sales_model->get_dc_master_by_id($do_id);
	$data['records2']=$this->Sales_model->get_dc_tr_by_id($do_id);
	$data['records3']=$this->Sales_model->get_dc_details_by_id($do_id);
	
	$this->load->view('ajax/do_details',$data);
     }
     function ajax_get_dc_info2()
     {
        $do_id = $this->input->post('do_id');
        $data['case_no'] = $this->input->post('case_no');
        	
	$this->load->model('Setup_model');
	$data['packing_list']=$this->Setup_model->get_packing_type_list();
	
	$this->load->model('Sales_model');
	$data['records1']=$this->Sales_model->get_dc_master_by_id($do_id);
	$data['records2']=$this->Sales_model->get_dc_tr_by_id($do_id);
	$data['records3']=$this->Sales_model->get_dc_details_by_id($do_id);
	
	$this->load->view('ajax/do_details_with_case',$data);
     }
     function ajax_get_quotation_for_po()
     {
     	$qid = $this->input->post('qid');
        $version = $this->input->post('rev_version');
	
	$this->load->model('Setup_model');
	$data['currency_list']=$this->Setup_model->get_currency_list();
	
	$prifix='STK'.date('y');
	
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'catalyst_ref_no','invoice_master',8)+1;
	$digit=sprintf("%1$04d",$num);
	$data['catalyst_ref_no'] =$prifix.date('m').$digit;
			
	$this->load->model('Sales_model');
	$data['records1']=$this->Sales_model->get_quotation_master_by_id($qid);
	foreach($data['records1'] as $v)
	{
		$version = $v->revision;
	}
	$data['records2']=$this->Sales_model->get_quotation_tr_by_id($qid,$version);
	
	$this->load->view('ajax/sales_quote_details_for_po',$data);
     }
     function ajax_get_rfq_for_po()
     {
     	$qid = $this->input->post('qid');
        $version = 1;
	
	$prifix='PO'.date('y');
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'po_code','purchase_order',7)+1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.date('m').$digit;
	
	$this->load->model('Setup_model');
	$data['currency_list']=$this->Setup_model->get_currency_list();
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$this->load->model('Users_model');
	$data['supplier_records']=$this->Users_model->get_supplier_list();
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();	
			
	$this->load->model('Purchase_Model');
	$data['records1']=$this->Purchase_Model->get_pruchase_quotation_by_id($qid);
        $data['records2']=$this->Purchase_Model->get_pruchase_quotation_tr_by_id($qid,$version);
	
	$this->load->view('ajax/RFQ_details_for_po',$data);
     }
     function ajax_get_rfq_for_quote()
     {
     	$qid = $this->input->post('qid');
        $version = 0;
	
	$this->load->model('Setup_model');
	$data['currency_list']=$this->Setup_model->get_currency_list();
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$this->load->model('Users_model');
	$data['supplier_records']=$this->Users_model->get_supplier_list();
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();		
	$this->load->model('Purchase_Model');
	$data['records1']=$this->Purchase_Model->get_pruchase_rfq_by_id($qid);
	$data['records2']=$this->Purchase_Model->get_pruchase_rfq_tr_by_id($qid,$version);
	
	$this->load->view('ajax/RFQ_details_for_quote',$data);
     }
     
     function ajax_get_po_for_grn()
     {
     	$po_id = $this->input->post('qid');
        $version = 1;
	
	$prifix='GRN'.date('y');
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'grn_code','GRN_master',8)+1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.date('m').$digit;
	
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
	$this->load->model('Setup_model');
	$data['currency_list']=$this->Setup_model->get_currency_list();
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['store_records']=$this->Setup_model->get_warehouse_list();
	$this->load->model('Users_model');
	$data['supplier_records']=$this->Users_model->get_supplier_list();
			
	$this->load->model('Purchase_Model');
	$data['records1']=$this->Purchase_Model->get_po_details_by_id($po_id);
	foreach($data['records1'] as $v)
	{
		$version = $v->revision;
	}
        $data['records2']=$this->Purchase_Model->get_po_items_by_id($po_id,$version);
	
	$this->load->view('ajax/PO_details_for_GRN.php',$data);
     }
      
     function ajax_get_supplier_accountId_from_po()
     {
        $po_id = $this->input->post('po_id');
	
	$this->load->model('Purchase_Model');
	$data['records1']=$this->Purchase_Model->get_po_details_by_id($po_id);
	foreach($data['records1'] as $v)
	{
		$supplier_id = $v->supplier_id;
	}
	
	$this->load->model('Accounts_model');
	$data['accountId']=$this->Accounts_model->get_supplier_account_Id($supplier_id);
	
	echo $data['accountId'];
     }
     function ajax_get_current_stock()
     {
     	$value=array();
     	$order_code = $this->input->post('order_code');
     	$size = $this->input->post('size');
     	$warehouse = $this->input->post('warehouse');
     	
     	$this->load->helper('stock_helper');
	$stock = get_product_current_stock($order_code,$size,$warehouse);
	$po_stock = get_po_incoming_stock($order_code,$size);
	
	
	$avg_price = sprintf("%0.2f",get_product_last_price($order_code,$size,$warehouse));
	
	$value=array('stock'=>$stock, 'po_stock'=>$po_stock, 'avg_price'=>$avg_price );
	
	echo json_encode($value);
     }
     function ajax_get_min_stock_qty()
     {
        $stock_code = $this->input->post('stock_code');
        $warehouse_id = $this->input->post('warehouse_id');

        $this->load->model('Stock_Model');
        $min_qty=$this->Stock_Model->ajax_get_min_stock_qty($stock_code,$warehouse_id);
	echo $min_qty;
     }
     function ajax_get_model_wise_stock_list()
     {	
        $data['rowId'] = $this->input->post('rowId');
        $model_code = $this->input->post('model_code');
        $warehouse_id = $this->input->post('warehouse_id');
        $data['order_code'] = $this->input->post('order_code');
        $data['newcnt'] = $this->input->post('newcnt');
        
	$this->load->model('Stock_Model');
	$data['records1']=$this->Stock_Model->ajax_get_model_wise_stock_list($model_code,$warehouse_id);
	
	$this->load->view('ajax/DC_stock_issue.php',$data);
     }
     function ajax_add_bill_row_grn()
     {
        $data['rowId'] = $this->input->post('rowId');
        $data['newcnt'] = $this->input->post('newcnt');
        $data['order_code'] = $this->input->post('model_code');
	$this->load->view('ajax/GRN_bill_row.php',$data);
     }
     function get_invoice_amount()
     {
     	$value=array();
        $data['invoice_id'] = $this->input->post('invoice_id');
        
        $this->load->model('Sales_model');
	$data['records1']=$this->Sales_model->get_invoice_amount($data['invoice_id']);
	
	foreach($data['records1'] as $v)
	{
		$grand_total = $v->grand_total;
		$paid_total = $v->amount;
	}
	$value=array('grand_total'=>$grand_total, 'paid_total'=>$paid_total, 'balance_total'=>$grand_total-$paid_total );
	
	echo json_encode($value);
     }
    function ajax_get_requisition_items()
    {	
		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list();
		
		$this->load->model('Ajax_model');
		$data['trans_records']=$this->Ajax_model->ajax_get_requisition_items();
		
		$this->load->view('ajax/requisition_item_table.php',$data);
    }

	function ajax_get_subcategory()
    {
		$value=array();
        $cat = $this->input->post('cat');

        $this->load->model('Product_model');
        $records=$this->Product_model->get_sub_category_list($cat);
		echo json_encode($records);
    }
	function get_enquiry_form()
     {
        $data['enq_type'] = $this->input->post('enq_type');
				
		$this->load->model('Product_model');
		$data['products']=$this->Product_model->get_product_list_by_category($data['enq_type']);	
		
		
		if($data['enq_type'] == '1' || $data['enq_type'] == '3')
		{
			$this->load->view('ajax/sales_enq_trading_form',$data);
		}
		elseif($data['enq_type'] == '2'){
			$this->load->view('ajax/sales_enq_manufacturing',$data);
		}
     }
	 function ajax_get_quotation_for_joborder()
     {
     	$qid = $this->input->post('qid');
       // $version = $this->input->post('rev_version');	
		
		$this->load->model('Sales_model');
		$data['records1']=$this->Sales_model->get_quotation_master_by_id($qid);
		
		foreach($data['records1'] as $v)
		{
			$version = $v->revision;
		
		}
		$data['records2']=$this->Sales_model->get_quotation_tr_by_id($qid,$version);
		$this->load->view('ajax/sales_quote_details_for_joborder',$data);
     }
     function ajax_get_invoice_info_for_warranty()
    {	
		$value=array();
        $inv_id = $this->input->post('inv_id');
        $this->load->model('Sales_model');
        $data['records']=$this->Sales_model->get_invoice_master_for_warranty_by_id($inv_id);
		foreach($data['records'] as $row)
		{
			$value=array('customer_id'=>$row->customer_id, 'cust_name'=>$row->cust_name, 'invoice_code'=>$row->invoice_code, 'invoice_date'=>date('d-m-Y',strtotime($row->invoice_date)));	
		}
		echo json_encode($value);
		
    }
	function get_invoice_items_list_for_warranty()
     {
        $inv_id = $this->input->post('inv_id');
		$this->load->model('Sales_model');
		$data['records2']=$this->Sales_model->get_invoice_tr_by_id($inv_id);
		$this->load->view('ajax/invoice_items_for_warranty',$data);
     }
	 function delete_sales_estimation()
	 {		
		$estid = $this->input->post('estID');
		$enqid = $this->input->post('enq_master_id');
		$this->load->model('Ajax_model');
		$res = $this->Ajax_model->delete_sales_estimation($estid,$enqid);
		if($res)
			echo 1;
		else 
			echo 0;
	 }
/*********************************************************************************************************************/

}

?>
