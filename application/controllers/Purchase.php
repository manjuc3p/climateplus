<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->is_logged_in();
    }

    function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        
        
        if((!isset($is_logged_in) || $is_logged_in != true) && (!isset($_COOKIE['email'])))
        {
            echo "You don\'t have permission to access this page. <a href='".base_url()."index.php/Login/sign_in'>Login</a>";
            die();
            //$this->load->view('login/login_form');
        }
    }
    

    /////////////////////Purchase Requisition Start  ////////////////////////
   function add_requisition()
   {
        $data['title']='Purchase Requisition';

	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
	$this->load->model('Users_model');
	$data['user_records']=$this->Users_model->get_user_list();
	$this->load->model('Setup_model');
	$data['terms_rec']=$this->Setup_model->get_terms_details();
	
	$data['main_content']='Purchase/requisition.php';
	$this->load->view('includes/template.php',$data);
        
    }
   function add_requisition_records()
   {    
	   $data['title']='Purchase Requisition';
	   $this->load->model('Purchase_Model');
	   $id=$this->Purchase_Model->add_requisition_records();
	   
	   if($id) 
	   {
		$this->session->set_flashdata('success', 'Data Saved Successfully..');
	        redirect('Purchase/list_requisition');
	   }	   
	   else
	   {
		$this->session->set_flashdata('error', 'Data Not Saveded..');
	        redirect('Purchase/add_requisition');
	   }
   }

  function list_requisition()
  {
        $data['title']='Purchase Requisition List';
	$this->load->model('Purchase_Model');
        $data['records']=$this->Purchase_Model->get_requisition_list();
	    
	$data['main_content']='Purchase/requisition_list.php';
	$this->load->view('includes/template.php',$data);
  }
   function edit_requisition()
  {
        $data['title']='Edit Purchase Requisition';
	$id = $this->uri->segment('3'); 
        $data['edit_flag']=$this->uri->segment('4'); 

	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();

	$this->load->model('Users_model');
	$data['user_records']=$this->Users_model->get_user_list();

	$this->load->model('Purchase_Model');
	$data['records1']=$this->Purchase_Model->get_requisition_by_id($id);
	$data['trans_records']=$this->Purchase_Model->get_requisition_tr_by_id($id);
	    
	$data['main_content']='Purchase/requisition_edit.php';
	$this->load->view('includes/template.php',$data);
  }
  function update_requisition_records()
  {
   	$data['title']='Purchase Requisition';
	$rfq_id=$this->input->post('rfq_id');
	$version=$this->input->post('revision_version');
	$this->load->model('Purchase_Model');
	$this->Purchase_Model->update_requisition_records($rfq_id);
	    
	$this->session->set_flashdata('success', 'Data Saved Successfully..');
	redirect('Purchase/list_requisition'); 
  }
  function approve_requisition_records()
  {
   	$data['title']='Purchase Requisition';
	$rfq_id=$this->input->post('rfq_id');
	$this->load->model('Purchase_Model');
	$this->Purchase_Model->approve_requisition_records($rfq_id);
	    
	$this->session->set_flashdata('success', 'Record Approved Successfully..');
	redirect('Purchase/list_requisition'); 
  }
  function delete_requisition()
  {
	$rid=$this->input->post('rid');
	$this->load->model('Purchase_Model');
	$res = $this->Purchase_Model-delete_reqisition($rid);
	echo $res;
   }

    /////////////////////Direct RFQ Start  ////////////////////////
   function add_rfq()
   {
        $data['title']='Request For Quotation(RFQ)';
	$prifix='BES/RFQ/'.date('y').'/';
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'rfq_code','purchase_RFQ',12)+1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.date('m').$digit;

	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
	$this->load->model('Users_model');
	$data['supplier_records']=$this->Users_model->get_supplier_list();
	$data['user_records']=$this->Users_model->get_user_list();
	
	$this->load->model('Purchase_Model');
        $data['indent_list']=$this->Purchase_Model->get_approved_requisition_list();

	$data['main_content']='Purchase/rfq_add.php';
	$this->load->view('includes/template.php',$data);
        
    }
   function add_direct_rfq_records()
   {    
	   $data['title']='Request For Quotation(RFQ)';
	   $this->load->model('Purchase_Model');
	   $id=$this->Purchase_Model->add_direct_rfq_records();
	   
	   if($id) 
	   {
		$this->session->set_flashdata('success', 'Data Saved Successfully..');
	        redirect('Purchase/list_direct_rfq');
	   }	   
	   else
	   {
		$this->session->set_flashdata('error', 'Data Not Saveded..');
	        redirect('Purchase/add_rfq');
	   }
   }

  function list_direct_rfq()
  {
        $data['title']='Request For Quotation(RFQ)';
	$this->load->model('Purchase_Model');
        $data['records']=$this->Purchase_Model->get_RFQ_list('direct');
	    
	$data['main_content']='Purchase/rfq_direct_list.php';
	$this->load->view('includes/template.php',$data);
  }
  
  function delete_rfq()
  {
	$rid=$this->input->post('rid');
	$this->load->model('Purchase_Model');
	$res = $this->Purchase_Model->delete_rfq($rid);
	echo $res;
   }
/// RFQ from sales enquiry ///////////////
  function add_rfqenq()
    {
        $data['title']='Vendor Facing Enquiry (RFQ)';
	$prifix='PRQ'.date('y');
	$this->load->model('Setup_model');
        //$num= $this->Setup_model->get_next_code($prifix,'rfq_code','purchase_RFQ')+1;
        $num=1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.$digit;

	$pid=$this->uri->segment('3');
        $version=$this->uri->segment('4');
        $indent_approved_id=$this->uri->segment('5');
        $user_se_id=$this->session->userdata('user_id');

	$this->load->model('Setup_Model');
	//$data['item_type']=$this->Setup_Model->get_active_item_type_list();
        //$data['supplier_records']=$this->Setup_Model->get_supplier_list();
        //$data['item_records']=$this->Setup_Model->get_active_item_list();
       // $data['unit_records']=$this->Setup_Model->get_unit_list();

	$this->load->model('Purchase_Model');
        $data['indent_list']=$this->Purchase_Model->get_approved_requisition_list();

	$this->load->model('Purchase_Model');
       // $data['records1']=$this->Purchase_Model->get_pruchase_indent_by_id($pid);
       // $data['records2']=$this->Purchase_Model->get_pruchase_indent_approved_tr($indent_approved_id,$version,$user_se_id);

	$data['main_content']='Purchase/rfq_add.php';
	$this->load->view('includes/template.php',$data);
        
    }
  function view_rfq_list()
  {
	        $data['title']='Request For Quotation(RFQ)';
	$this->load->model('Purchase_Model');
        $data['records']=$this->Purchase_Model->get_RFQ_list('sales');
	    
	$data['main_content']='Purchase/rfq_list.php';
	$this->load->view('includes/template.php',$data);
  }

  function view_rfq_details()
  {
        $data['title']='Request For Quotation(RFQ)';
	$id = $this->uri->segment('3');  
	$data['rev_version'] = $this->uri->segment('4');  
	$data['edit_flag'] = $this->uri->segment('5');    

	$this->load->model('Setup_Model');
	$data['supplier_records']=$this->Setup_Model->get_supplier_list();
	$data['item_records']=$this->Setup_Model->get_active_item_list();
	$data['unit_records']=$this->Setup_Model->get_unit_list();
	$data['comapny_records']=$this->Setup_Model->get_company_master_list();

	$this->load->model('Purchase_Model');
	$data['records1']=$this->Purchase_Model->get_pruchase_rfq_by_id($id);
	$data['records2']=$this->Purchase_Model->get_pruchase_rfq_tr_by_id($id,$data['rev_version']);
	    
	$data['main_content']='Purchase/rfq_edit.php';
	$this->load->view('includes/template.php',$data);
  }
  function update_purchase_rfq_records()
  {
   	$data['title']='Purchase Quotation';
	$rfq_id=$this->input->post('rfq_id');
	$version=$this->input->post('revision_version');
	$this->load->model('Purchase_Model');
	$this->Purchase_Model->update_purchase_RFQ($rfq_id,$version);
	    
	$this->session->set_flashdata('success', 'Data Saved Successfully..');
	redirect('Purchase/view_rfq_list'); 
  }
  function print_rfq()
  {	
        $data['title']='Request For Quotation(RFQ)';
	$id = $this->uri->segment('3');  
	$data['rev_version'] = $this->uri->segment('5');  
	$data['edit_flag'] = $this->uri->segment('4');    
		
	$this->load->model('Setup_model');
	$data['comapny_records']=$this->Setup_model->get_company_master_list();
	
	$this->load->model('Purchase_Model');
	$data['records1']=$this->Purchase_Model->get_pruchase_rfq_by_id($id);
	$data['records2']=$this->Purchase_Model->get_pruchase_rfq_tr_by_id($id,$data['rev_version']);

	$this->load->view('Purchase/print/rfq_print.php',$data);
  }
  
  function export_excel_rfq()
  {	
        $data['title']='Request For Quotation(RFQ)';
	$id = $this->uri->segment('3');  
	$data['rev_version'] = $this->uri->segment('5');  
	$data['edit_flag'] = $this->uri->segment('4');    
		
	$this->load->model('Setup_model');
	$data['comapny_records']=$this->Setup_model->get_company_master_list();
	
	$this->load->model('Purchase_Model');
	$data['records1']=$this->Purchase_Model->get_pruchase_rfq_by_id($id);
	$data['records2']=$this->Purchase_Model->get_pruchase_rfq_tr_by_id($id,$data['rev_version']);

	$this->load->view('Purchase/print/export_rfq.php',$data);
  }
  
   ///////////// quote from supplier
function add_quote_from_supplier()
{
	$data['title']='Quote From Supplier';
        error_reporting(0);
	$prifix='STK'.date('y');
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'po_code','purchase_order',8)+1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.date('m').$digit;
	
	$this->load->model('Purchase_Model');
	$data['records']=$this->Purchase_Model->get_RFQ_list('direct');
	
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();

	$this->load->model('Setup_model');
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['currency_list']=$this->Setup_model->get_currency_list();
    	$data['bank_details']=$this->Setup_model->get_company_bank_list();
	$data['terms_rec']=$this->Setup_model->get_terms_details();
    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
	$this->load->model('Users_model');
	$data['user_records']=$this->Users_model->get_user_list();
	$data['supplier_records']=$this->Users_model->get_supplier_list();
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
	$data['reorder_list']="";
	$data['main_content']='Purchase/quotation_add.php';
	$this->load->view('includes/template.php',$data);

}
   function add_purchase_quotation_records()
   {    
	        $data['title']='Purchase Quotation';
	   $this->load->model('Purchase_Model');
	   $this->Purchase_Model->add_purchase_quotation();
	    
	   $this->session->set_flashdata('success', 'Data Saved Successfully..');
	   redirect('Purchase/view_quotation_list');
   }

  function view_quotation_list()
  {
	$data['title']='Purchase Quotation';
	$this->load->model('Purchase_Model');
        $data['records']=$this->Purchase_Model->get_quotation_list();
	    
	$data['main_content']='Purchase/quotation_list.php';
	$this->load->view('includes/template.php',$data);
  }
  function edit_purchase_quotation()
  {
        $data['title']='Purchase Quotation';
	$quotation_id=$this->uri->segment('3');
        $version=$this->uri->segment('4');
	$data['edit_flag'] = $this->uri->segment('5'); 
	$this->load->model('Setup_model');
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['currency_list']=$this->Setup_model->get_currency_list();
    	$data['bank_details']=$this->Setup_model->get_company_bank_list();
	$data['terms_rec']=$this->Setup_model->get_terms_details();
    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
	$this->load->model('Users_model');
	$data['user_records']=$this->Users_model->get_user_list();
	$data['supplier_records']=$this->Users_model->get_supplier_list();
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();

	$this->load->model('Purchase_Model');
        $data['records1']=$this->Purchase_Model->get_pruchase_quotation_by_id($quotation_id);
        $data['records2']=$this->Purchase_Model->get_pruchase_quotation_tr_by_id($quotation_id,$version);
	$data['main_content']='Purchase/quotation_edit.php';
	$this->load->view('includes/template.php',$data);
  }
  function edit_purchase_quotation_records()
    {
        $data['title']='Purchase Quotation';
	$qid=$this->input->post('quotation_id');
	$version=$this->input->post('revision_version');
	$this->load->model('Purchase_Model');
	$this->Purchase_Model->update_purchase_quotation($qid,$version);
	    
	$this->session->set_flashdata('success', 'Data Saved Successfully..');
	redirect('Purchase/view_quotation_list');        
    }    

    
  function purchase_quotation_details()
  {
	        $data['title']='Purchase Quotation';
	$quotation_id=$this->uri->segment('3');
        $version=$this->uri->segment('4');
	$data['edit_flag'] = $this->uri->segment('5');    
	
	$this->load->model('Setup_Model');
        $data['item_records']=$this->Setup_Model->get_active_item_list();
        $data['unit_records']=$this->Setup_Model->get_unit_list();
	$data['supplier_records']=$this->Setup_Model->get_supplier_list();

	$this->load->model('Purchase_Model');
        $data['records1']=$this->Purchase_Model->get_pruchase_quotation_by_id($quotation_id);
        $data['records2']=$this->Purchase_Model->get_pruchase_quotation_tr_by_id($quotation_id,$version);
	$data['main_content']='Purchase/quotation_details.php';
	$this->load->view('includes/template.php',$data);
  }
  function accept_purchase_quotation()
  {
	        $data['title']='Purchase Quotation';
	$qid=$this->uri->segment('3');
        $version=$this->uri->segment('4');
	$this->load->model('Purchase_Model');
	$this->Purchase_Model->accept_purchase_quotation($qid,$version);
	    
	$this->session->set_flashdata('success', 'Data Saved Successfully..');
	redirect('Purchase/view_quotation_list');   
  }
  ////////////////////////////////////////////////////////////////
  function add_purchase_order()
  {
        $data['title']='Purchase Order';
        
	$this->load->model('Sales_model');
	$data['records']=$this->Sales_model->get_approved_quotations_for_po();	
	
	$this->load->model('Setup_model');
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['currency_list']=$this->Setup_model->get_currency_list();
    	$data['bank_details']=$this->Setup_model->get_company_bank_list();
	$data['terms_rec']=$this->Setup_model->get_terms_details();
    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
	$this->load->model('Users_model');
	$data['user_records']=$this->Users_model->get_user_list();
	$data['supplier_records']=$this->Users_model->get_supplier_list();
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();

	$data['main_content']='Purchase/purchase_order_add.php';
	$this->load->view('includes/template.php',$data);
  }
  function add_purchase_order_records()
  {    
           $data['title']='Purchase Order';
	   $this->load->model('Purchase_Model');
	   $this->Purchase_Model->add_purchase_order();
	    
	   $this->session->set_flashdata('success', 'Data Saved Successfully..');
	   redirect('Purchase/purchase_order_list');
   }

  function purchase_order_list()
  {
        $data['title']='Purchase Order List';
	$this->load->model('Purchase_Model');
        $data['records']=$this->Purchase_Model->get_po_list();
	    
	$data['main_content']='Purchase/purchase_order_list.php';
	$this->load->view('includes/template.php',$data);
  }
  function edit_purchase_order()
  {
        $data['title']='Edit Purchase Order';
	$po_id=$this->uri->segment('3');
        $version=$this->uri->segment('4');
        $data['edit_flag']=$this->uri->segment('5');
        $data['ptype']='';

	$this->load->model('Setup_model');
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['currency_list']=$this->Setup_model->get_currency_list();
    	$data['bank_details']=$this->Setup_model->get_company_bank_list();
	$data['terms_rec']=$this->Setup_model->get_terms_details();
    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
	
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
	$this->load->model('Purchase_Model');
	$data['records1']=$this->Purchase_Model->get_po_details_by_id($po_id);
	$data['records2']=$this->Purchase_Model->get_po_items_by_id($po_id,$version);
	
	$this->load->model('Users_model');
	$data['user_records']=$this->Users_model->get_user_list();
	$data['supplier_records']=$this->Users_model->get_supplier_list();

	$data['main_content']='Purchase/purchase_order_edit.php';
	$this->load->view('includes/template.php',$data);	
  }
  
  function update_purchase_order_records()
  {    
           $data['title']='Purchase Order';
		$po_id=$this->input->post('po_id');
		$ptype=$this->input->post('ptype');
	   $this->load->model('Purchase_Model');
	   $this->Purchase_Model->update_purchase_order_records($po_id);
	    
	   $this->session->set_flashdata('success', 'Data Saved Successfully..');
	   if($ptype=='direct')
	   {
	   	redirect('Purchase/po_direct_list');
	   }
	   else
	  	 redirect('Purchase/po_direct_list');
   }
  function PO_print()
  {        
        $data['title']='Purchase Order Print';
	$po_id=$this->uri->segment('3');
	$data['rev_version'] = $this->uri->segment('4');  

	$this->load->model('Setup_model');
	$data['comapny_records']=$this->Setup_model->get_company_master_list();
	
	$this->load->model('Purchase_Model');
        $data['records1']=$this->Purchase_Model->get_po_details_by_id($po_id);
        $data['records2']=$this->Purchase_Model->get_po_items_by_id($po_id,$data['rev_version']);

	$this->load->view('Purchase/print/po_print.php',$data);
   }
   function delete_po()
   {   
	$rid=$this->input->post('po_id');
	$this->load->model('Purchase_Model');
	$res = $this->Purchase_Model->delete_po($rid);
	echo $res;
   }
  ////////////////////// PO direct ///////////////////////////
  function add_PO_direct()
  {
   	$data['title']='Purchase Order';
        error_reporting(0);
	$prifix='BES/PO/'.date('y').'/';
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'po_code','purchase_order',11)+1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.date('m').$digit;
	
	$this->load->model('Purchase_Model');
	$data['records']=$this->Purchase_Model->get_approved_quotation_list();
	
	$this->load->model('Setup_model');
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['currency_list']=$this->Setup_model->get_currency_list();
    	$data['bank_details']=$this->Setup_model->get_company_bank_list();
	$data['terms_rec']=$this->Setup_model->get_terms_details();
    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
	$this->load->model('Users_model');
	$data['user_records']=$this->Users_model->get_user_list();
	$data['supplier_records']=$this->Users_model->get_supplier_list();
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
	
	$data['main_content']='Purchase/po_direct_add.php';
	$this->load->view('includes/template.php',$data);
  }
  function add_PO_direct_from_reorder()
  {
   	$data['title']='Purchase Order';
        error_reporting(0);
	$prifix='STK'.date('y');
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'po_code','purchase_order',8)+1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.date('m').$digit;
	
	$this->load->model('Purchase_Model');
	$data['records']=$this->Purchase_Model->get_RFQ_list('direct');
	
	$this->load->model('Setup_model');
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['currency_list']=$this->Setup_model->get_currency_list();
    	$data['bank_details']=$this->Setup_model->get_company_bank_list();
	$data['terms_rec']=$this->Setup_model->get_terms_details();
    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
	$this->load->model('Users_model');
	$data['user_records']=$this->Users_model->get_user_list();
	$data['supplier_records']=$this->Users_model->get_supplier_list();
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
  	$this->load->model('Stock_Model');
        $data['reorder_list']=$this->Stock_Model->get_reorder_stock_for_PO();

	$data['main_content']='Purchase/po_direct_add.php';
	$this->load->view('includes/template.php',$data);
  }
  function add_purchase_order_direct()
  {    
           $data['title']='Purchase Order';
	   $this->load->model('Purchase_Model');
	   $this->Purchase_Model->add_purchase_order();
	    
	   $this->session->set_flashdata('success', 'Data Saved Successfully..');
	   redirect('Purchase/po_direct_list');
   }

 function edit_PO_direct()
  {
        $data['title']='Edit Purchase Order';
	$po_id=$this->uri->segment('3');
        $version=$this->uri->segment('4');
        $data['edit_flag']=$this->uri->segment('5');
        $data['ptype']='direct';

	$this->load->model('Setup_model');
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['currency_list']=$this->Setup_model->get_currency_list();
    	$data['bank_details']=$this->Setup_model->get_company_bank_list();
	$data['terms_rec']=$this->Setup_model->get_terms_details();
    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();
	
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
	$this->load->model('Purchase_Model');
	$data['records1']=$this->Purchase_Model->get_po_details_by_id($po_id);
	$data['records2']=$this->Purchase_Model->get_po_items_by_id($po_id,$version);
	
	$this->load->model('Users_model');
	$data['user_records']=$this->Users_model->get_user_list();
	$data['supplier_records']=$this->Users_model->get_supplier_list();

	$data['main_content']='Purchase/po_direct_edit.php';
	$this->load->view('includes/template.php',$data);	
  }
  
  function po_direct_list()
  {
        $data['title']='PO  List';
	$this->load->model('Purchase_Model');
        $data['records']=$this->Purchase_Model->get_direct_po_list();
	    
	$data['main_content']='Purchase/po_direct_list.php';
	$this->load->view('includes/template.php',$data);
  }
 /////////////////////////// GRN /////////////////////////////
  function add_grn()
  {
        $data['title']='Purchase GRN';
	$prifix='GRN'.date('y');
	$this->load->model('Setup_model');
	$num= $this->Setup_model->get_next_code($prifix,'grn_code','GRN_master',8)+1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.$digit;

	$this->load->model('Users_model');	
        $data['supplier_records']=$this->Users_model->get_supplier_list();
	$data['store_records']=$this->Setup_model->get_warehouse_list();
	$data['user_records']=$this->Users_model->get_user_list();
	
	$this->load->model('Setup_model');
    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();

	$this->load->model('Purchase_Model');
        $data['po_records']=$this->Purchase_Model->get_all_po_list();
        
        $this->load->model('Accounts_model');
        $data['sundry_accounts1'] =$this->Accounts_model->get_general_ledger_by_group('Purchase Accounts'); 
        $data['sundry_accounts2'] =$this->Accounts_model->get_gen_ledger_creditors_records(); 
        $data['sundry_accounts3'] =$this->Accounts_model->get_all_general_ledger_accounts(); 
	        

	$data['main_content']='Purchase/GRN_add.php';
	$this->load->view('includes/template.php',$data);	
  }
 
  function add_grn_records()
  {
        $data['title']='GRN List';
  	$this->load->model('Stock_Model');
        $this->Stock_Model->add_grn_details();
	    
        $this->session->set_flashdata('success', 'Data Saved Successfully..');
        redirect('Purchase/view_grn_list');
  }
  
  function view_grn_list()
  {    
	        $data['title']='Purchase GRN';
	$this->load->model('Stock_Model');
        $data['records']=$this->Stock_Model->get_grn_list();
	    
        $data['main_content']='Purchase/GRN_list.php';
	$this->load->view('includes/template.php',$data);
   }
	
  function edit_grn()
  {
        $data['title']='Edit GRN';
	$grn_id=$this->uri->segment('3');
        //$version=$this->uri->segment('4');

	$this->load->model('Setup_model');
	$data['currency_list']=$this->Setup_model->get_currency_list();
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['store_records']=$this->Setup_model->get_warehouse_list();
	$this->load->model('Users_model');
	$data['supplier_records']=$this->Users_model->get_supplier_list();
	
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
	$this->load->model('Stock_Model');
	$data['records1']=$this->Stock_Model->get_grn_details_by_id($grn_id);
        $data['records2']=$this->Stock_Model->get_grn_trans_by_id($grn_id);
	$data['inventory_records']=$this->Stock_Model->get_grn_added_stock_by_id($grn_id);

	$data['main_content']='Purchase/GRN_edit.php';
	$this->load->view('includes/template.php',$data);	
  }

  
  function GRN_print()
  {
	$grn_id = $this->uri->segment('3');
	
	$this->load->model('Setup_model');
	$data['comapny_records']=$this->Setup_model->get_company_master_list();
        	
	$this->load->model('Stock_Model');
	$data['records1']=$this->Stock_Model->get_grn_details_by_id($grn_id);
        $data['records2']=$this->Stock_Model->get_grn_trans_by_id($grn_id);
	
	$this->load->view('Purchase/print/grn_print.php',$data);
  }
  function delete_grn()
  {
	$rid=$this->input->post('po_id');
	$this->load->model('Purchase_Model');
	$res = $this->Purchase_Model->delete_grn($rid);
	echo $res;
  }
  
  function accept_grn()
  {
	$rid=$this->input->post('po_id');
	$this->load->model('Stock_Model');
	$res = $this->Stock_Model->accept_grn($rid);
	echo $res;
  }

 /////////////////////////// stock return /Goods return /////////////////////////////
  function add_stock_adjustment()
  {
        $data['title']='Stock Adjustment';
	/*$d1= date('Y/m');
	$prifix='RT/'.$d1;
	$this->load->model('Sales_model');
	$num= $this->Sales_model->get_next_code($prifix,'return_code','goods_return')+1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.$digit;*/

	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
	$this->load->model('Setup_model');
	$data['currency_list']=$this->Setup_model->get_currency_list();
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['store_records']=$this->Setup_model->get_warehouse_list();
	$this->load->model('Users_model');
	$data['supplier_records']=$this->Users_model->get_supplier_list();

	$data['main_content']='stock/stock_adjustment_add.php';
	$this->load->view('includes/template.php',$data);	
  }
 
  function stock_adjustment_details()
  {
        $data['title']='Stock Adjustment';
  	$this->load->model('Stock_Model');
        $this->Stock_Model->stock_adjustment_details();
	    
        $this->session->set_flashdata('success', 'Data Saved Successfully..');
        redirect('Purchase/get_stock_adjustment_list');
  }
  
  function get_stock_adjustment_list()
  {    
        $data['title']='Stock Adjustment';
	$this->load->model('Stock_Model');
        $data['records']=$this->Stock_Model->get_stock_adjustment_list();
	    
        $data['main_content']='stock/stock_adjustment_list.php';
	$this->load->view('includes/template.php',$data);
   }
	
  function edit_stock_adjustment()
  {
        $data['title']='Edit Stock Adjustment';
	$return_id=$this->uri->segment('3');
      
	$this->load->model('Product_model');
	$data['products']=$this->Product_model->get_product_list();
	$this->load->model('Setup_model');
	$data['currency_list']=$this->Setup_model->get_currency_list();
	$data['vat_percent']=$this->Setup_model->get_vat_for_calculation();
	$data['store_records']=$this->Setup_model->get_warehouse_list();
	$this->load->model('Users_model');
	$data['supplier_records']=$this->Users_model->get_supplier_list();
	
	$this->load->model('Stock_Model');
	$data['records1']=$this->Stock_Model->get_stk_adjustment_by_id($return_id);
        $data['records2']=$this->Stock_Model->get_stk_adjustment_trans_by_id($return_id);

	$data['main_content']='stock/stock_adjustment_edit.php';
	$this->load->view('includes/template.php',$data);	
  }
  function update_stock_adjustment()
  {
        $data['title']='Stock Adjustment';
  	$this->load->model('Stock_Model');
        $this->Stock_Model->update_stock_adjustment_details();
	    
        $this->session->set_flashdata('success', 'Data Saved Successfully..');
        redirect('Purchase/get_stock_adjustment_list');
  }
  
  
  /// Min stock qty ///
  function add_min_stock()
  {
        $data['title']='Minimum Stock Quantity';
        
	$this->load->model('Stock_Model');
	$data['products']=$this->Stock_Model->get_stock_code_list();

	$data['main_content']='stock/min_stock_add.php';
	$this->load->view('includes/template.php',$data);	
  }
  function add_min_stock_details()
  {
  	$data['title']='Minimum Stock Quantity';
  	
        $this->load->model('Stock_Model');
        $min_qty=$this->Stock_Model->add_min_stock_qty();
	    
        $this->session->set_flashdata('success', 'Data Saved Successfully..');
        redirect('Purchase/add_min_stock');
  }
  ///////////////  Stock Allocation ///////////////
  function add_stock_allocation()
  {
        $data['title']='Stock Allocation';
	$data['warehouse_id']=3;
	$data['item_id']='';
        
	$this->load->model('Setup_model');
	$data['store_records']=$this->Setup_model->get_warehouse_list();
	
	$this->load->model('Sales_model');
	$data['quote_records']=$this->Sales_model->get_approved_quotations_for_invoice();
		
	$this->load->model('Stock_Model');
	$data['products']=$this->Stock_Model->get_stock_code_list();
	$data['records']=array();
	$data['main_content']='stock/stock_allocation_add.php';
	$this->load->view('includes/template.php',$data);	
  }
  
  function get_item_wise_stock_allocation()
  {
   	$data['title']='Stock Allocation';
   	
	$data['warehouse_id']=$this->uri->segment('3');
	$data['item_id']=$this->uri->segment('4');
	if($data['warehouse_id']=='')
	{
	$data['warehouse_id']=$this->input->post('warehouse_id');
	$data['item_id']=$this->input->post('product_id');
	}
	$this->load->model('Stock_Model');
	$data['products']=$this->Stock_Model->get_stock_code_list();	
	$this->load->model('Sales_model');
	$data['quote_records']=$this->Sales_model->get_approved_quotations_for_invoice();
		

	$this->load->model('Setup_model');
	$data['store_records']=$this->Setup_model->get_warehouse_list();

        $this->load->model('Stock_Model');
        $data['records']=$this->Stock_Model->get_item_stock_report_list($data['warehouse_id'],$data['item_id']);

        $data['main_content']='stock/stock_allocation_add';
        $this->load->view('includes/template.php',$data);
   }
   
  
  function add_stock_allocation_details()
  {
   	$data['title']='Stock Allocation';
	$data['warehouse_id']=$this->input->post('warehouse_id');
	$data['item_id']=$this->input->post('product_id');
	$warehouse_id=$this->input->post('warehouse_id');
	$item_id=$this->input->post('product_id');
	
	$this->load->model('Sales_model');
	$data['quote_records']=$this->Sales_model->get_approved_quotations_for_invoice();
	$this->load->model('Stock_Model');
	$data['products']=$this->Stock_Model->get_stock_code_list();

	$this->load->model('Setup_model');
	$data['store_records']=$this->Setup_model->get_warehouse_list();

        $this->load->model('Stock_Model');
        $res=$this->Stock_Model->add_stock_allocation_details();
        $data['records']=$this->Stock_Model->get_item_stock_report_list($data['warehouse_id'],$data['item_id']);
        if($res)
        	$this->session->set_flashdata('success', 'Data Saved Successfully..');
        	
        redirect("Purchase/get_item_wise_stock_allocation/$warehouse_id/$item_id");	
        //$data['main_content']='stock/stock_allocation_add';
        //$this->load->view('includes/template.php',$data);
   }
  ///// common cancel for all //
  function cancel_record()
  {
	$table_name = $this->input->post('table_name');
	$column = $this->input->post('column');
	$set_val = $this->input->post('set_val');
	$where_key = $this->input->post('where_key');
	$where_val = $this->input->post('where_val');

	$this->load->model('Ajax_model');
        $res=$this->Ajax_model->cancel_record();
	if($res)
	echo 1;
	else 
	echo 0;
  } 
}

?>
