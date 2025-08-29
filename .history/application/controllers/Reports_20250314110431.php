<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends CI_Controller
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
    }
  }

  ///////////////////////// Payment report  //////////////////////

  function view_payment_report(){
    $data['title']='Payment Report';
    $this->load->model('Users_model');
    $data['drivers']=$this->Users_model->get_user_list('Driver');
    $data['driver'] = '';
    $this->load->model('Setup_model');
		$data['payment_terms']=$this->Setup_model->get_payment_terms();
    $data['payment'] = '';
    
    $data['main_content']='Reports/payment_report.php';
    $this->load->view('includes/template.php',$data);
  }

  function get_payment_report(){
    $data['title']='Payment Report';
    $this->load->model('Users_model');
    $data['drivers']=$this->Users_model->get_user_list('Driver');
    $this->load->model('Setup_model');
		$data['payment_terms']=$this->Setup_model->get_payment_terms();
    
    $data['job_date'] = $_POST['job_date'];
    $data['driver'] = $_POST['driver_id'];
    $data['payment'] = $_POST['payment_term'];

    $this->load->model('Operations_model');
    $data['report']=$this->Operations_model->get_payment_report($data['job_date'],$data['driver'],$data['payment']);

    $data['main_content']='Reports/payment_report.php';
    $this->load->view('includes/template.php',$data);
  }

  function Jobs_report(){

    $data['title']='Job Summary';
    $from_date = $_POST['from']??date('Y-m-d');
    $to_date = $_POST['to']??date('Y-m-d');
    $this->load->model('Operations_model');
		$data['jobs']=$this->Operations_model->get_all_jobs($from_date,$to_date);
   
    
    $data['main_content']='Reports/job_report.php';
    $this->load->view('includes/template.php',$data);
  }

  ///////////////  PO Report ////////////////////
//   function view_po_report()
//   {
//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_grn_list();

//     $data['main_content']='Purchase/GRN_list.php';
//     $this->load->view('includes/template.php',$data);
//   }

  
//   function stock_inventory_report()
//   {
// 	$data['title']='Inventory Report';
// 	$data['warehouse_id']=3;
// 	$data['item_id']=1;

// 	$this->load->model('Stock_Model');
// 	$data['products']=$this->Stock_Model->get_stock_code_list();

// 	$this->load->model('Setup_model');
// 	$data['store_records']=$this->Setup_model->get_warehouse_list();

// 	$this->load->model('Stock_Model');
// 	$data['records']=$this->Stock_Model->get_stock_inventory_report();

// 	$data['main_content']='Reports/Stock/stock_inventory_report.php';
// 	$this->load->view('includes/template.php',$data);
//   }

//   function get_stock_inventory_report()
//   {
// 	$data['title']='Inventory Report';
// 	$data['warehouse_id']=$this->input->post('warehouse_id');
// 	$data['item_id']=$this->input->post('product_id');

// 	$this->load->model('Stock_Model');
// 	$data['products']=$this->Stock_Model->get_stock_code_list();

// 	$this->load->model('Setup_model');
// 	$data['store_records']=$this->Setup_model->get_warehouse_list();

// 	$this->load->model('Stock_Model');
// 	$data['records']=$this->Stock_Model->get_stock_inventory_report();

// 	$data['main_content']='Reports/Stock/stock_inventory_report.php';
// 	$this->load->view('includes/template.php',$data);
//   }

//   function print_stock_inventory_report()
//   {
//         $data['title']='Inventory Report';
// 	$data['warehouse_id']=$this->input->post('warehouse_id');
// 	$data['item_id']=$this->input->post('product_id');

// 	$this->load->model('Setup_model');
// 	$data['comapny_records']=$this->Setup_model->get_company_master_list();

// 	$this->load->model('Setup_model');
// 	$data['store_records']=$this->Setup_model->get_warehouse_list();

// 	$this->load->model('Stock_Model');
// 	$data['records']=$this->Stock_Model->get_stock_inventory_report();

//     	$this->load->view('Print/print_stock_inventory_report.php',$data);
//   }

//   function export_stock_inventory_report()
//   {
//         $data['title']='Inventory Report';
// 	$data['warehouse_id']=$this->input->post('warehouse_id');
// 	$data['item_id']=$this->input->post('product_id');

// 	$this->load->model('Setup_model');
// 	$data['comapny_records']=$this->Setup_model->get_company_master_list();
	

// 	$this->load->model('Setup_model');
// 	$data['store_records']=$this->Setup_model->get_warehouse_list();

// 	$this->load->model('Stock_Model');
// 	$data['records']=$this->Stock_Model->get_stock_inventory_report();

//     	$this->load->view('excel_reports/export_stock_inventory_report.php',$data);
//   }
//   ////////////////////////
//   function view_item_wise_stock()
//   {
//    	$data['title']='Item Wise Stock Details';
// 	$data['warehouse_id']=1;
// 	$data['item_id']=1;

// 	$this->load->model('Stock_Model');
// 	$data['products']=$this->Stock_Model->get_stock_code_list();

// 	$this->load->model('Setup_model');
// 	$data['store_records']=$this->Setup_model->get_warehouse_list();

//         $this->load->model('Stock_Model');
//         $data['records']=array();

//     $data['main_content']='Reports/Stock/item_wise_stock_details';
//     $this->load->view('includes/template.php',$data);
//   }
//   function get_item_wise_stock()
//   {
//    	$data['title']='Item Wise Stock Details';
// 	$data['warehouse_id']=$this->input->post('warehouse_id');
// 	$data['item_id']=$this->input->post('product_id');
	
// 	$this->load->model('Stock_Model');
// 	$data['products']=$this->Stock_Model->get_stock_code_list();

// 	$this->load->model('Setup_model');
// 	$data['store_records']=$this->Setup_model->get_warehouse_list();

//         $this->load->model('Stock_Model');
//         $data['records']=$this->Stock_Model->get_item_stock_report_list($data['warehouse_id'],$data['item_id']);

//         $data['main_content']='Reports/Stock/item_wise_stock_details';
//         $this->load->view('includes/template.php',$data);
//    }
//    function print_item_wise_stock()
//    {
//    	$data['title']='Item Wise Stock Details';
// 	$data['warehouse_id']=$this->input->post('warehouse_id');
// 	$data['item_id']=$this->input->post('product_id');

// 	$this->load->model('Setup_model');
// 	$data['comapny_records']=$this->Setup_model->get_company_master_list();

// 	$this->load->model('Setup_model');
// 	$data['store_records']=$this->Setup_model->get_warehouse_list();

// 	$this->load->model('Stock_Model');
//         $data['records']=$this->Stock_Model->get_item_stock_report_list($data['warehouse_id'],$data['item_id']);

//         $this->load->view('Print/print_item_wise_stock.php',$data);
//   }

//   function export_item_wise_stock()
//   {
//    	$data['title']='Item Wise Stock Details';
// 	$data['warehouse_id']=$this->input->post('warehouse_id');
// 	$data['item_id']=$this->input->post('product_id');

// 	$this->load->model('Setup_model');
// 	$data['comapny_records']=$this->Setup_model->get_company_master_list();

// 	$this->load->model('Setup_model');
// 	$data['store_records']=$this->Setup_model->get_warehouse_list();

// 	$this->load->model('Stock_Model');
//         $data['records']=$this->Stock_Model->get_item_stock_report_list($data['warehouse_id'],$data['item_id']);

//     	$this->load->view('excel_reports/export_item_wise_stock.php',$data);
//   }
  
//   function view_reorder_stock_list()
//   {
//    	$data['title']='Reorder Stock Details';
// 	$data['warehouse_id']=1;
// 	$data['item_id']=1;

//         $this->load->model('Stock_Model');
//         $data['records']=$this->Stock_Model->get_reorder_stock_list();

//         $data['main_content']='Reports/Stock/reorder_stock_details';
//         $this->load->view('includes/template.php',$data);
//   }
  
//   function print_reorder_stock_list()
//   {
//    	$data['title']='Reorder Stock Details';
// 	$data['warehouse_id']=1;
// 	$data['item_id']=1;

// 	$this->load->model('Setup_model');
// 	$data['comapny_records']=$this->Setup_model->get_company_master_list();
//         $this->load->model('Stock_Model');
//         $data['records']=$this->Stock_Model->get_reorder_stock_list();

//         $this->load->view('Print/print_reorder_stock_list.php',$data);
//   }
  
//   function export_reorder_stock_list()
//   {
  
//    	$data['title']='Reorder Stock Details';
// 	$data['warehouse_id']=1;
// 	$data['item_id']=1;

// 	$this->load->model('Setup_model');
// 	$data['comapny_records']=$this->Setup_model->get_company_master_list();
//         $this->load->model('Stock_Model');
//         $data['records']=$this->Stock_Model->get_reorder_stock_list();

//         $this->load->view('excel_reports/export_reorder_stock_list.php',$data);
//   }
// /********************************  Purchase Reports -> Indent Report ***************************************/

//   function view_purchase_indent_report()
//   {
//     $data['from']=date('01-m-Y');
//     $data['to']=date('d-m-Y');
//     $data['status'] ="";
//     $data['created_by'] =""; //user id

//     $this->load->model('Setup_Model');
//     $data['user_list'] = $this->Setup_Model->get_active_employee_list();

//     $this->load->model('Report_Model');
//     $data['records']=array();

//     $data['main_content']='Reports/Purchase/purchase_indent_report.php';
//     $this->load->view('includes/template.php',$data);
//   }

//   function get_purchase_indent_report()
//   {
//     $data['from']=$this->input->post('from');
//     $data['to']=$this->input->post('to');
//     $data['status'] = $this->input->post('status');
//     $data['created_by'] = $this->input->post('created_by'); //user id

//     $this->load->model('Setup_Model');
//     $data['user_list'] = $this->Setup_Model->get_active_employee_list();

//     $this->load->model('Report_Model');
//     $data['records']=$this->Report_Model->get_purchase_indent_report_records();

//     $data['main_content']='Reports/Purchase/purchase_indent_report.php';
//     $this->load->view('includes/template.php',$data);
//   }

//   function print_purchase_indent_report()
//   {
//     $data['title']="Purchase Indent Report";
//     $data['from']=$this->input->post('from');
//     $data['to']=$this->input->post('to');
//     $data['status'] = $this->input->post('status');
//     $data['created_by'] = $this->input->post('created_by'); //user id

//     $this->load->model('Setup_Model');
//     $data['comapny_records']=$this->Setup_Model->get_company_master_list();
//     $data['user_list'] = $this->Setup_Model->get_active_employee_list();

//     $this->load->model('Report_Model');
//     $data['records']=$this->Report_Model->get_purchase_indent_report_records();

//     $this->load->view('Print/print_purchase_indent_report.php',$data);
//   }

//   function export_purchase_indent_report()
//   {
//     $data['title']="Purchase Indent Report";
//     $data['from']=$this->input->post('from');
//     $data['to']=$this->input->post('to');
//     $data['status'] = $this->input->post('status');
//     $data['created_by'] = $this->input->post('created_by'); //user id

//     $this->load->model('Setup_Model');
//     $data['comapny_records']=$this->Setup_Model->get_company_master_list();
//     $data['user_list'] = $this->Setup_Model->get_active_employee_list();

//     $this->load->model('Report_Model');
//     $data['records']=$this->Report_Model->get_purchase_indent_report_records();

//     $this->load->view('Excel_reports/export_purchase_indent_report.php',$data);
//   }

// /************************ Purchase Report -> RFQ Reports   *********************************/

//   function view_rfq_report()
//   {
//     $data['from']=date('01-m-Y');
//     $data['to']=date('d-m-Y');
//     $data['status'] ="";
//     $data['created_by'] =""; //user id
//     $data['supplier_id'] ="";
//     $data['supplier_type'] ="";

//     $this->load->model('Setup_Model');
//     $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//     $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//     $this->load->model('Report_Model');
//     $data['records']=array();

//     $data['main_content']='Reports/Purchase/rfq_report.php';
//     $this->load->view('includes/template.php',$data);
//   }

//   function get_rfq_report()
//   {
//     $data['from']=$this->input->post('from');
//     $data['to']=$this->input->post('to');
//     $data['status'] = $this->input->post('status');
//     $data['created_by'] = $this->input->post('created_by');
//     $data['supplier_id'] = $this->input->post('supplier_id');
//     $data['supplier_type'] = $this->input->post('supplier_type');

//     $this->load->model('Setup_Model');
//     $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//     $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//     $this->load->model('Report_Model');
//     $data['records']=$this->Report_Model->get_RFQ_report_records();

//     $data['main_content']='Reports/Purchase/rfq_report.php';
//     $this->load->view('includes/template.php',$data);
//   }

//   function print_rfq_report()
//   {
//     $data['from']=$this->input->post('from');
//     $data['to']=$this->input->post('to');
//     $data['status'] = $this->input->post('status');
//     $data['created_by'] = $this->input->post('created_by');
//     $data['supplier_id'] = $this->input->post('supplier_id');
//     $data['supplier_type'] = $this->input->post('supplier_type');

//     $this->load->model('Setup_Model');
// 		$data['comapny_records']=$this->Setup_Model->get_company_master_list();
//     $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//     $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//     $this->load->model('Report_Model');
//     $data['records']=$this->Report_Model->get_RFQ_report_records();

//     $this->load->view('Print/print_rfq_report.php',$data);
//   }

//   function export_rfq_report()
//   {
//     $data['from']=$this->input->post('from');
//     $data['to']=$this->input->post('to');
//     $data['status'] = $this->input->post('status');
//     $data['created_by'] = $this->input->post('created_by');
//     $data['supplier_id'] = $this->input->post('supplier_id');
//     $data['supplier_type'] = $this->input->post('supplier_type');

//     $this->load->model('Setup_Model');
//     $data['comapny_records']=$this->Setup_Model->get_company_master_list();
//     $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//     $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//     $this->load->model('Report_Model');
//     $data['records']=$this->Report_Model->get_RFQ_report_records();

//     $this->load->view('Excel_reports/export_rfq_report.php',$data);
//   }

// /*********************************  Supplier Transaction  *********************/

// function view_supplier_transaction()
// {
//   $data['supplier_type'] ="";
//   $data['supplier_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Purchase/supplier_transaction_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_supplier_transaction()
// {
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');

//   $this->load->model('Setup_Model');
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_supplier_transaction_records();

//   $data['main_content']='Reports/Purchase/supplier_transaction_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_supplier_transaction()
// {
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');

//   $this->load->model('Setup_Model');
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_supplier_transaction_records();

//   $this->load->view('Print/print_supplier_transaction.php',$data);
// }


// function export_supplier_transaction()
// {
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');

//   $this->load->model('Setup_Model');
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_supplier_transaction_records();

//   $this->load->view('Excel_reports/export_supplier_transaction.php',$data);
// }

// function get_supplier_on_change_supplier_type()
// {
// 	$this->load->model('Setup_Model');
// 	$data['supplier_records'] = $this->Setup_Model->get_supplier_list_by_type();
// 	$this->load->view('Ajax/supplier_list.php', $data);
// }

// /************************ Purchase Report -> PO Reports   *********************************/

// function view_purchase_order_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['supplier_id'] ="";
//   $data['supplier_type'] = "";

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Purchase/purchase_order_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_purchase_order_report()
// {
//   $data['from'] = $this->input->post('from');
//   $data['to'] = $this->input->post('to');
//   $data['status'] = $this->input->post('status');
//   $data['supplier_id'] = $this->input->post('supplier_id');
//   $data['supplier_type'] = $this->input->post('supplier_type');
  
//   if($data['from']==''){
//   $data['from'] = $this->uri->segment('3');
//   $data['to'] = $this->uri->segment('4');
// }
//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Report_Model');
//   $data['records'] = $this->Report_Model->get_po_order_records();

//   $data['main_content']='Reports/Purchase/purchase_order_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_purchase_order_report()
// {
//   $data['from'] = $this->input->post('from');
//   $data['to'] = $this->input->post('to');
//   $data['status'] = $this->input->post('status');
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Report_Model');
//   $data['records'] = $this->Report_Model->get_po_order_records();

//   $this->load->view('Print/print_purchase_order_report.php',$data);
// }

// function export_purchase_order_report()
// {
//   $data['from'] = $this->input->post('from');
//   $data['to'] = $this->input->post('to');
//   $data['status'] = $this->input->post('status');
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Report_Model');
//   $data['records'] = $this->Report_Model->get_po_order_records();

//   $this->load->view('Excel_reports/export_purchase_order_report.php',$data);
// }

// /************************ Purchase Report -> GRN Reports   *********************************/

// function view_GRN_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['created_by'] =""; //user id
//   $data['supplier_type'] ="";
//   $data['supplier_id'] ="";
//   $data['po_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Purchase_Model');
//   $data['po_code_records']=$this->Purchase_Model->get_purchase_order_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Purchase/GRN_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_GRN_report()
// {
//   $data['from'] = $this->input->post('from');
//   $data['to'] = $this->input->post('to');
//   $data['status'] = $this->input->post('status');
//   $data['created_by'] = $this->input->post('created_by'); //user id
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');
//   $data['po_id'] = $this->input->post('po_id');

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Purchase_Model');
//   $data['po_code_records']=$this->Purchase_Model->get_purchase_order_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']= $this->Report_Model->get_grn_records();

//   $data['main_content']='Reports/Purchase/GRN_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_GRN_report()
// {
//   $data['from'] = $this->input->post('from');
//   $data['to'] = $this->input->post('to');
//   $data['status'] = $this->input->post('status');
//   $data['created_by'] = $this->input->post('created_by'); //user id
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');
//   $data['po_id'] = $this->input->post('po_id');

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['po_code_records']=$this->Purchase_Model->get_purchase_order_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']= $this->Report_Model->get_grn_records();

//   $this->load->view('Print/print_GRN_report.php',$data);
// }

// function export_GRN_report()
// {
//   $data['from'] = $this->input->post('from');
//   $data['to'] = $this->input->post('to');
//   $data['status'] = $this->input->post('status');
//   $data['created_by'] = $this->input->post('created_by'); //user id
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');
//   $data['po_id'] = $this->input->post('po_id');

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Purchase_Model');
//   $data['po_code_records']=$this->Purchase_Model->get_purchase_order_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']= $this->Report_Model->get_grn_records();

//   $this->load->view('Excel_reports/export_GRN_report.php',$data);
// }

// /************************ Purchase Report -> Quotation Reports   *********************************/

// function view_quotation_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['supplier_type'] ="";
//   $data['supplier_id'] ="";
//   $data['quotation_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Purchase_Model');
//   $data['purchasae_quotation_records']=$this->Purchase_Model->purchase_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Purchase/quotation_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_quotation_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Purchase_Model');
//   $data['purchasae_quotation_records']=$this->Purchase_Model->purchase_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_quotation_records();

//   $data['main_content']='Reports/Purchase/quotation_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_quotation_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['purchasae_quotation_records']=$this->Purchase_Model->purchase_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_quotation_records();

//   $this->load->view('Print/print_quotation_report.php',$data);
// }

// function export_quotation_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['supplier_type'] = $this->input->post('supplier_type');
//   $data['supplier_id'] = $this->input->post('supplier_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['user_list'] = $this->Setup_Model->get_active_employee_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['purchasae_quotation_records']=$this->Purchase_Model->purchase_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_quotation_records();

//   $this->load->view('Excel_reports/export_quotation_report.php',$data);
// }

// /************************ Sales Reports -> Customer Enquiry Reports   *********************************/

// function view_customer_enquiry_report()
// {
//     $data['title'] = "Sales Enquiry Report";
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['customer_id'] =""; //user id
//   $data['enq_from'] ="";

//   $this->load->model('Users_model');
//   $data['customer_list']=$this->Users_model->get_customer_list();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Sales/customer_enquiry_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_customer_enquiry_report()
// {
//   $data['from'] = $this->input->post('from');
//   $data['to'] = $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] =$this->input->post('customer_id');
//   $data['enq_from'] =$this->input->post('enq_from');

//   if($data['from']==''){
//   $data['from'] = $this->uri->segment('3');
//   $data['to'] = $this->uri->segment('4');}
  
//   $this->load->model('Users_model');
//   $data['customer_list']=$this->Users_model->get_customer_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_customer_enquiry_records();

//   $data['main_content']='Reports/Sales/customer_enquiry_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_customer_enquiry_report()
// {
//   $data['from'] = $this->input->post('from');
//   $data['to'] = $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] =$this->input->post('customer_id');
//   $data['enq_from'] =$this->input->post('enq_from');

//   $this->load->model('Users_model');
//   $data['customer_list']=$this->Users_model->get_customer_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_customer_enquiry_records();

//   $this->load->view('Print/print_customer_enquiry_report.php',$data);
// }

// function export_customer_enquiry_report()
// {
//   $data['from'] = $this->input->post('from');
//   $data['to'] = $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] =$this->input->post('customer_id');
//   $data['enq_from'] =$this->input->post('enq_from');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_customer_enquiry_records();

//   $this->load->view('Excel_reports/export_customer_enquiry_report.php',$data);
// }

// /************************ Sales Reports -> Site Serve Reports   *********************************/

// function view_site_serve_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['customer_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Sales/site_serve_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_site_serve_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] =$this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_site_serve_records();

//   $data['main_content']='Reports/Sales/site_serve_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_site_serve_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] =$this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_site_serve_records();

//   $this->load->view('Print/print_site_serve_report.php',$data);
// }

// function export_site_serve_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] =$this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['supplier_records']=$this->Setup_Model->get_supplier_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_site_serve_records();

//   $this->load->view('Excel_reports/export_site_serve_report.php',$data);
// }

// /************************ Sales Reports -> Cost Sheet Reports   *********************************/

// function view_cost_sheet_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['customer_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Sales/cost_sheet_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_cost_sheet_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] =$this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_cost_sheet_records();

//   $data['main_content']='Reports/Sales/cost_sheet_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_cost_sheet_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] =$this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_cost_sheet_records();

//   $this->load->view('Print/print_cost_sheet_report.php',$data);
// }

// function export_cost_sheet_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] =$this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_cost_sheet_records();

//   $this->load->view('Excel_reports/export_cost_sheet_report.php',$data);
// }

// /************************ Sales Reports -> Quotation to Customer Reports   *********************************/

// function view_sales_quotation_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Sales/sales_quotation_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_sales_quotation_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

// if($data['from']==''){
//   $data['from'] = $this->uri->segment('3');
//   $data['to'] = $this->uri->segment('4');}
  
//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_sales_quotation_report_record();

//   $data['main_content']='Reports/Sales/sales_quotation_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_sales_quotation_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_sales_quotation_report_record();

//   $this->load->view('Print/print_sales_quotation_report.php',$data);
// }

// function export_sales_quotation_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_sales_quotation_report_record();

//   $this->load->view('Excel_reports/export_sales_quotation_report.php',$data);
// }

// /************************ Sales Reports -> Approved Quotation Reports   *********************************/

// function view_approved_quotation_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Sales/approved_quotation_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_approved_quotation_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_approved_quotation_records();

//   $data['main_content']='Reports/Sales/approved_quotation_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_approved_quotation_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_approved_quotation_records();

//   $this->load->view('Print/print_approved_quotation_report.php',$data);
// }

// function export_approved_quotation_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_approved_quotation_records();

//   $this->load->view('Excel_reports/export_approved_quotation_report.php',$data);
// }

// /************************ Sales Reports -> Invoice Reports   *********************************/

// function view_sales_invoice_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Sales/sales_invoice_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_sales_invoice_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['customer_id'] = $this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_sale_invoice_records();

//   $data['main_content']='Reports/Sales/sales_invoice_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_sales_invoice_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['customer_id'] = $this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_sale_invoice_records();

//   $this->load->view('Print/print_sales_invoice_report.php',$data);
// }

// function export_sales_invoice_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['customer_id'] = $this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_sale_invoice_records();

//   $this->load->view('Excel_reports/export_sales_invoice_report.php',$data);
// }

// function view_completion_delivery_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['delivery_id'] ="";
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Sales/completion_delivery_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_completion_delivery_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['delivery_id'] =  $this->input->post('delivery_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['customer_id'] = $this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['delivery_records']=$this->Report_Model->sale_delivery_dropdown();
//   $data['records']=$this->Report_Model->get_completion_delivery_records();

//   $data['main_content']='Reports/Sales/completion_delivery_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_completion_delivery_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['delivery_id'] =  $this->input->post('delivery_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['customer_id'] = $this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['delivery_records']=$this->Report_Model->sale_delivery_dropdown();
//   $data['records']=$this->Report_Model->get_completion_delivery_records();

//   $this->load->view('Print/print_completion_delivery_report.php',$data);
// }

// function export_completion_delivery_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['delivery_id'] =  $this->input->post('delivery_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['customer_id'] = $this->input->post('customer_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['delivery_records']=$this->Report_Model->sale_delivery_dropdown();
//   $data['records']=$this->Report_Model->get_completion_delivery_records();

//   $this->load->view('Excel_reports/export_completion_delivery_report.php',$data);
// }

// function view_installation_note_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['delivery_id'] ="";
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Sales/installation_note_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// /************************ Production Reports -> Job Pack Reports   *********************************/

// function view_job_pack_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Production/job_pack_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_job_pack_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');
  
// if($data['from']==''){
//   $data['from'] = $this->uri->segment('3');
//   $data['to'] = $this->uri->segment('4');}
  
//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_job_pack_records();

//   $data['main_content']='Reports/Production/job_pack_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_job_pack_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_job_pack_records();

//   $this->load->view('Print/print_job_pack_report.php',$data);
// }

// function export_job_pack_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_job_pack_records();

//   $this->load->view('Excel_reports/export_job_pack_report.php',$data);
// }

// /************************ Production Reports -> Job Card Reports   *********************************/

// function view_job_card_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Production/job_card_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_job_card_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_job_card_records();

//   $data['main_content']='Reports/Production/job_card_report.php';
//   $this->load->view('includes/template.php',$data);
// }


// function print_job_card_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_job_card_records();

//   $this->load->view('Print/print_job_card_report.php',$data);
// }

// function export_job_card_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_job_card_records();

//   $this->load->view('Excel_reports/export_job_card_report.php',$data);
// }

// /************************ Production Reports -> Material Issue Reports   *********************************/

// function view_material_issue_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Production/material_issue_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_material_issue_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_material_issue_records();

//   $data['main_content']='Reports/Production/material_issue_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_material_issue_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_material_issue_records();

//   $this->load->view('Print/print_material_issue_report.php',$data);
// }

// function export_material_issue_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_material_issue_records();

//   $this->load->view('Excel_reports/export_material_issue_report.php',$data);
// }

// /************************ Production Reports -> Cutting Sheet Reports   *********************************/

// function view_production_cutsheet_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['status'] ="";
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";
//   $data['production_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();
//   $data['production_records']=$this->Purchase_Model->get_production_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Production/production_cutsheet_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_production_cut_sheet_records()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['production_id'] = $this->input->post('production_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();
//   $data['production_records']=$this->Purchase_Model->get_production_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_production_cut_sheet_records();

//   $data['main_content']='Reports/Production/production_cutsheet_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_production_cut_sheet_records()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['production_id'] = $this->input->post('production_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();
//   $data['production_records']=$this->Purchase_Model->get_production_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_production_cut_sheet_records();

//   $this->load->view('Print/print_production_cut_sheet_records.php',$data);
// }

// function export_production_cut_sheet_records()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['status'] =$this->input->post('status');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['production_id'] = $this->input->post('production_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();
//   $data['production_records']=$this->Purchase_Model->get_production_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_production_cut_sheet_records();

//   $this->load->view('Excel_reports/export_production_cut_sheet_records.php',$data);
// }

// /************************ Production Reports -> Vehicle Log Sheet Reports   *********************************/

// function view_vehicle_log_sheet_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['vehicle_id']="";
//   $data['quotation_id']="";

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();
//   $data['vehicle_records']=$this->Report_Model->get_vehicle_no_dropdown();

//   $data['main_content']='Reports/Production/vehicle_log_sheet_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_vehicle_log_sheet_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['vehicle_id']= $this->input->post('vehicle_id');
//   $data['quotation_id']= $this->input->post('quotation_id');

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['vehicle_records']=$this->Report_Model->get_vehicle_no_dropdown();
//   $data['records']=$this->Report_Model->get_vehicle_log_sheet_records();

//   $data['main_content']='Reports/Production/vehicle_log_sheet_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_vehicle_log_sheet_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['vehicle_id']= $this->input->post('vehicle_id');
//   $data['quotation_id']= $this->input->post('quotation_id');

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Setup_Model');
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_vehicle_log_sheet_records();
//   $data['vehicle_records']=$this->Report_Model->get_vehicle_no_dropdown();

//   $this->load->view('Print/print_vehicle_log_sheet_report.php',$data);
// }

// function export_vehicle_log_sheet_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['vehicle_id']= $this->input->post('vehicle_id');
//   $data['quotation_id']= $this->input->post('quotation_id');

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_vehicle_log_sheet_records();
//   $data['vehicle_records']=$this->Report_Model->get_vehicle_no_dropdown();

//   $this->load->view('Excel_reports/export_vehicle_log_sheet_report.php',$data);
// }

// /************************ Production Reports -> Compledted order Reports   *********************************/

// function view_completed_order_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";
//   $data['jcard_id'] = "";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();
//   $data['job_card_records']=$this->Purchase_Model->get_job_card_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Production/completed_order_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_completed_order_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['jcard_id'] = $this->input->post('jcard_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();
//   $data['job_card_records']=$this->Purchase_Model->get_job_card_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_completed_order_records();

//   $data['main_content']='Reports/Production/completed_order_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_completed_order()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['jcard_id'] = $this->input->post('jcard_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();
//   $data['job_card_records']=$this->Purchase_Model->get_job_card_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_completed_order_records();

//   $this->load->view('Print/print_completed_order.php',$data);
// }

// function export_completed_order()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');
//   $data['jcard_id'] = $this->input->post('jcard_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();
//   $data['job_card_records']=$this->Purchase_Model->get_job_card_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_completed_order_records();

//   $this->load->view('Excel_reports/export_completed_order.php',$data);
// }

// /************************ Production Reports -> Material Return Reports   *********************************/

// function view_material_retrun_report()
// {
//   $data['from']=date('01-m-Y');
//   $data['to']=date('d-m-Y');
//   $data['customer_id'] ="";
//   $data['quotation_id'] ="";

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=array();

//   $data['main_content']='Reports/Production/material_retrun_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_material_retrun_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_material_retrun_records();

//   $data['main_content']='Reports/Production/material_retrun_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function print_material_retrun_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();
//   $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_material_retrun_records();

//   $this->load->view('Print/print_material_retrun_report.php',$data);
// }

// function export_material_retrun_report()
// {
//   $data['from']= $this->input->post('from');
//   $data['to']= $this->input->post('to');
//   $data['customer_id'] = $this->input->post('customer_id');
//   $data['quotation_id'] = $this->input->post('quotation_id');

//   $this->load->model('Setup_Model');
//   $data['customer_list']=$this->Setup_Model->get_customer_list();

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//   $this->load->model('Report_Model');
//   $data['records']=$this->Report_Model->get_material_retrun_records();

//   $this->load->view('Excel_reports/export_material_retrun_report.php',$data);
// }

// /************************ order status report   *********************************/

// function view_order_status_report()
// {
//   $data['quotation_id'] ="";

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown_order_status();

//   $this->load->model('Sales_Model');
//   $data['fixed_head_records']=array();

//   $this->load->model('Report_Model');
//   $data['job_pack_records']=array();
//   $data['job_card_records']=array();
//   $data['material_issue_records']=array();
//   $data['production_records']=array();
//   $data['sales_records']=array();
//   $data['vehicle_logsheet_records']=array();
//   $data['invoice_records']=array();

//   $data['main_content']='Reports/order_status_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// function get_order_status_report()
// {
//   $data['quotation_id'] =$this->input->post('quotation_id');

//   $this->load->model('Purchase_Model');
//   $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown_order_status();

//   $this->load->model('Sales_Model');
//   $data['fixed_head_records']=$this->Sales_Model->get_quotation_master_by_id($data['quotation_id']);

//   $this->load->model('Report_Model');
//   $data['job_pack_records']=$this->Report_Model->get_job_pack_order_status();
//   $data['job_card_records']=$this->Report_Model->get_job_card_order_status();
//   $data['material_issue_records']=$this->Report_Model->get_material_issue_order_status();
//   $data['production_records']=$this->Report_Model->get_production_order_status();
//   $data['sales_records']=$this->Report_Model->sale_order_status_by_quotation();
//   $data['vehicle_logsheet_records']=$this->Report_Model->get_vehicle_logsheet_order_status();
//   $data['invoice_records']= $this->Report_Model->get_invoice_order_status();

//   $data['main_content']='Reports/order_status_report.php';
//   $this->load->view('includes/template.php',$data);
// }

// ///////////////////////// Barcode Wise Stock /////////
// function view_barcode_wise_stock()
// {
//     $data['barcode']='';
//     $this->load->model('Stock_Model');
//     $data['records']="";

//     $data['main_content']='Reports/Stock/barcode_wise_report.php';
//     $this->load->view('includes/template.php',$data);
//   }

//   function get_barcode_wise_report()
//   {
//     $data['barcode']=$this->input->post('barcode');

//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_barcode_wise_report($data['barcode']);

//     $data['main_content']='Reports/Stock/barcode_wise_report.php';
//     $this->load->view('includes/template.php',$data);
//   }

//   function print_barcode_wise_report()
//   {
//     $data['barcode']=$this->input->post('barcode');

//     $this->load->model('Setup_Model');
//     $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_barcode_wise_report($data['barcode']);

//     $this->load->view('Print/print_barcode_wise_report.php',$data);
//   }

//   function export_barcode_wise_report()
//   {
//     $data['barcode']=$this->input->post('barcode');

//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_barcode_wise_report($data['barcode']);

//     $this->load->view('Excel_reports/export_barcode_wise_report.php',$data);
//   }

//   ///////////////////////// Item Wise wastege details /////////
//   function view_item_wise_waste()
//   {
//     $data['from']=date('01-m-Y');
//     $data['to']=date('d-m-Y');
//     $data['item_id']=$this->input->post('item_id');
//     $data['quotation_id'] = $this->input->post('quotation_id');
//     $this->load->model('Setup_Model');
//     $data['item_records']=$this->Setup_Model->get_active_item_list();
//     $this->load->model('Stock_Model');
//     $data['records']="";

//     $this->load->model('Purchase_Model');
//     $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//     $data['main_content']='Reports/Stock/item_wise_wastage.php';
//     $this->load->view('includes/template.php',$data);
//   }

//   function get_item_wise_waste()
//   {
//     $data['from']=$this->input->post('from');
//     $data['to']=$this->input->post('to');
//     $data['item_id']=$this->input->post('item_id');
//     $data['quotation_id'] = $this->input->post('quotation_id');
//     $this->load->model('Setup_Model');
//     $data['item_records']=$this->Setup_Model->get_active_item_list();
//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_item_wise_waste($data['item_id'],$data['from'],$data['to'],$data['quotation_id']);

//     $this->load->model('Purchase_Model');
//     $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//     $data['main_content']='Reports/Stock/item_wise_wastage.php';
//     $this->load->view('includes/template.php',$data);
//   }

//   function print_item_wise_waste()
//   {
//     $data['from']=$this->input->post('from');
//     $data['to']=$this->input->post('to');
//     $data['item_id']=$this->input->post('item_id');
//     $data['quotation_id'] = $this->input->post('quotation_id');

//     $this->load->model('Setup_Model');
//     $data['item_records']=$this->Setup_Model->get_active_item_list();
//     $data['comapny_records']=$this->Setup_Model->get_company_master_list();
    
//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_item_wise_waste($data['item_id'],$data['from'],$data['to'],$data['quotation_id']);

//     $this->load->model('Purchase_Model');
//     $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//     $this->load->view('Print/print_item_wise_waste.php',$data);
//   }

//   function export_item_wise_waste()
//   {
//     $data['from']=$this->input->post('from');
//     $data['to']=$this->input->post('to');
//     $data['item_id']=$this->input->post('item_id');
//     $data['quotation_id'] = $this->input->post('quotation_id');
//     $this->load->model('Setup_Model');
//     $data['item_records']=$this->Setup_Model->get_active_item_list();
//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_item_wise_waste($data['item_id'],$data['from'],$data['to'],$data['quotation_id']);

//     $this->load->model('Purchase_Model');
//     $data['sale_quotation_records']=$this->Purchase_Model->sale_quotation_dropdown();

//     $this->load->view('Excel_reports/export_item_wise_waste.php',$data);
//   }

//   function view_reorder_level_stock()
//   {
//     $data['warehouse_id']=3;
//     $data['item_id']=$this->input->post('item_id');
//     $this->load->model('Setup_Model');
//     $data['item_records']=$this->Setup_Model->get_active_item_list();
//     $data['store_records']=$this->Setup_Model->get_warehouse_list();

//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_warehouseWise_stock_report($data['warehouse_id'],$data['item_id'],'','');

//     $data['main_content']='Reports/Stock/reorder_level_stock_report.php';
//     $this->load->view('includes/template.php',$data);
//   }

//   function get_reorder_level_stock()
//   {
//     $data['warehouse_id']=$this->input->post('warehouse_id');
//     $data['item_id']=$this->input->post('item_id');
//     $this->load->model('Setup_Model');
//     $data['item_records']=$this->Setup_Model->get_active_item_list();
//     $data['store_records']=$this->Setup_Model->get_warehouse_list();

//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_warehouseWise_stock_report($data['warehouse_id'],$data['item_id'],'','');

//     $data['main_content']='Reports/Stock/reorder_level_stock_report.php';
//     $this->load->view('includes/template.php',$data);
//   }

//   function print_reorder_level_stock()
//   {
//     $data['warehouse_id']=$this->input->post('warehouse_id');
//     $data['item_id']=$this->input->post('item_id');

//     $this->load->model('Setup_Model');
//     $data['item_records']=$this->Setup_Model->get_active_item_list();
//     $data['store_records']=$this->Setup_Model->get_warehouse_list();
//     $data['comapny_records']=$this->Setup_Model->get_company_master_list();

//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_warehouseWise_stock_report($data['warehouse_id'],$data['item_id'],'','');

//     $this->load->view('Print/print_reorder_level_stock.php',$data);
//   }

//   function export_reorder_level_stock()
//   {
//     $data['warehouse_id']=$this->input->post('warehouse_id');
//     $data['item_id']=$this->input->post('item_id');
//     $this->load->model('Setup_Model');
//     $data['item_records']=$this->Setup_Model->get_active_item_list();
//     $data['store_records']=$this->Setup_Model->get_warehouse_list();

//     $this->load->model('Stock_Model');
//     $data['records']=$this->Stock_Model->get_warehouseWise_stock_report($data['warehouse_id'],$data['item_id'],'','');

//     $this->load->view('Excel_reports/export_reorder_level_stock.php',$data);
//   }
//   function item_wise_ledger()
//   {
// 	$data['title']='Stock Code Ledger details';
// 	$data['model_code']=$this->uri->segment('3');
// 	$data['warehouse_id']=$this->uri->segment('4');
// 	$data['from_date']=date('01-01-Y');
// 	$data['to_date']=date('31-12-Y');
	
//     	$year=date('Y');
//         $this->load->model('Stock_Model');
//         $data['records']=$this->Stock_Model->item_wise_ledger($data['warehouse_id'],$data['model_code'],$year);
       
// 	$data['main_content']='Reports/Stock/item_wise_ledger.php';
// 	$this->load->view('includes/template.php',$data);
//   }
//    function get_item_wise_ledger()
//   {
// 	$data['title']='Stock Code Ledger details';
// 	$data['model_code']=$this->input->post('model_code');
// 	$data['warehouse_id']=$this->input->post('warehouse_id');
// 	$data['from_date']=$this->input->post('from_date');
// 	$data['to_date']=$this->input->post('to_date');
	
//     	$year=date('Y',strtotime($this->input->post('from_date')));
//         $this->load->model('Stock_Model');
//         $data['records']=$this->Stock_Model->item_wise_ledger($data['warehouse_id'],$data['model_code'],$year);
       
// 	$data['main_content']='Reports/Stock/item_wise_ledger.php';
// 	$this->load->view('includes/template.php',$data);
//   }
//    function print_item_wise_ledger()
//   {
// 	$data['title']='Stock Code Ledger details';
// 	$data['model_code']=$this->input->post('model_code');
// 	$data['warehouse_id']=$this->input->post('warehouse_id');
// 	$data['from_date']=$this->input->post('from_date');
// 	$data['to_date']=$this->input->post('to_date');
	
// 	$this->load->model('Setup_model');
//     	$data['comapny_records']=$this->Setup_model->get_company_master_list();
    	
//     	$year=date('Y',strtotime($this->input->post('from_date')));
//         $this->load->model('Stock_Model');
//         $data['records']=$this->Stock_Model->item_wise_ledger($data['warehouse_id'],$data['model_code'],$year);
       
// 	$this->load->view('Print/print_item_wise_ledger.php',$data);
//   }
//    function export_item_wise_ledger()
//   {
// 	$data['title']='Stock Code Ledger details';
// 	$data['model_code']=$this->input->post('model_code');
// 	$data['warehouse_id']=$this->input->post('warehouse_id');
// 	$data['from_date']=$this->input->post('from_date');
// 	$data['to_date']=$this->input->post('to_date');
	
// 	$this->load->model('Setup_model');
//     	$data['comapny_records']=$this->Setup_model->get_company_master_list();
    
//     	$year=date('Y',strtotime($this->input->post('from_date')));
//         $this->load->model('Stock_Model');
//         $data['records']=$this->Stock_Model->item_wise_ledger($data['warehouse_id'],$data['model_code'],$year);
       
// 	 $this->load->view('Excel_reports/export_item_wise_ledger.php',$data);
//   }
/********************************  End CI Controller ***************************************/
} ?>
