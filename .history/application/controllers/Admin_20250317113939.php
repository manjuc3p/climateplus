<?php

date_default_timezone_set('Asia/Kolkata');

class Admin extends CI_Controller {

	function __construct() 
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
	function view_admin_dashboard() 
    {
	
		$data['main_content'] = 'dashboard.php';
		$this->load->view('includes/template_home', $data);
   	}

	function view_operations_dashboard() 
	{
		$data['today'] = date('Y-m-d');
		$this->load->model('Operations_model');
		$data['job_summary'] = $this->Operations_model->get_job_summary();
		$data['main_content'] = 'op_dashboard.php';
		$this->load->view('includes/template_home', $data);
	}
	function company_details()
	{
		$data['title']='Company Master';
		$this->load->model('Setup_model');
	    	$data['company_details']=$this->Setup_model->get_company_master_list();
	    	$data['bank_details']=$this->Setup_model->get_company_bank_list();
	    	$data['stamp_details']=$this->Setup_model->get_company_stamp_list();

	    	$data['main_content']='setup/company.php';
	    	$this->load->view('includes/template.php',$data);
	}

	function add_company_records()
	{
		$data['title']='Company Master';
		$this->load->model('Setup_model');
		$insert_id=$this->Setup_model->update_company_record_by_id();
		if($insert_id==1)
		{
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Admin/company_details');
		}
	}
	//////////// Tax/Vat master   ///////////////////////
	function tax_details()
	{
		$data['title']='Vat Master';
		$data['main_content']='setup/vat_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_tax_details()
	{
		$data['title']='Vat Master';
		$this->load->model('Setup_model');
		$insert_id = $this->Setup_model->add_tax_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Admin/view_tax_list');
		}
	}
	function view_tax_list()
	{
		$data['title']='Vat Master';
		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_tax_list();

		$data['main_content']='setup/vat_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_tax()
	{
		$data['title']='Edit Vat Master';
		$id = $this->uri->segment('3');

		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_tax_by_id($id);

		$data['main_content']='setup/vat_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_tax_details()
	{
		$data['title']='Edit Vat Master';
		$gid=$this->input->post('vat_id');

		$this->load->model('Setup_model');
		$this->Setup_model->update_tax_data($gid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Admin/view_tax_list');
	}
	////////////////////////////////////////////////////////////
	function packing_type()
	{
		$data['title']='Packing Type';
		$data['main_content']='setup/packing_type_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_packing_type()
	{
		$data['title']='Packing Type';
		$this->load->model('Setup_model');
		$insert_id = $this->Setup_model->add_packing_type();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Admin/view_packing_type_list');
		}
	}
	function view_packing_type_list()
	{
		$data['title']='Packing Type List';
		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_packing_type_list();

		$data['main_content']='setup/packing_type_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_packing_type()
	{
		$data['title']='Edit Packing Type';
		$id = $this->uri->segment('3');

		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_packing_type_by_id($id);

		$data['main_content']='setup/packing_type_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_packing_type_details()
	{
		$data['title']='Packing Type';
		$gid=$this->input->post('id');

		$this->load->model('Setup_model');
		$this->Setup_model->update_packing_type_data($gid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Admin/view_packing_type_list');
	}
	////////////////////////////////////////////////////////////
	function add_currency()
	{
		$data['title']='Currency Details';
		$data['main_content']='setup/currency_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_currency_data()
	{
		$data['title']='Currency Details';
		$this->load->model('Setup_model');
		$insert_id = $this->Setup_model->add_currency_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Admin/view_currency_list');
		}
	}
	function view_currency_list()
	{
		$data['title']='Currency List';
		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_currency_list();

		$data['main_content']='setup/currency_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_currency()
	{
		$data['title']='Edit Currency';
		$id = $this->uri->segment('3');

		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_currency_by_id($id);

		$data['main_content']='setup/currency_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_currency_details()
	{
		$data['title']='Currency';
		$gid=$this->input->post('id');

		$this->load->model('Setup_model');
		$this->Setup_model->update_currency_data($gid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Admin/view_currency_list');
	}
	////////////////////////////////////////////////////////////
	function add_department()
	{
		$data['title']='Add Department Details';
		$data['main_content']='setup/department_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_department_data()
	{
		$data['title']='Department Details';
		$this->load->model('Setup_model');
		$insert_id = $this->Setup_model->add_department_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Admin/view_department_list');
		}
	}
	function view_department_list()
	{
		$data['title']='Department List';
		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_department_list();

		$data['main_content']='setup/department_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_department()
	{
		$data['title']='Edit Department';
		$id = $this->uri->segment('3');

		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_department_record_by_id($id);

		$data['main_content']='setup/department_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_department_details()
	{
		$data['title']='Department';
		$gid=$this->input->post('id');

		$this->load->model('Setup_model');
		$this->Setup_model->update_department_data($gid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Admin/view_department_list');
	}
	//////// Terms & condition ////////
	function add_terms_condition()
	{
		$data['title']='Add Terms Details';
		
		$data['main_content']='setup/terms_conditions.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_terms_details()
	{
		$data['title']='Terms';

		$this->load->model('Setup_model');
		$this->Setup_model->add_terms_details();

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Admin/list_terms_condition');
	}
	function list_terms_condition()
	{
		$data['title']='Terms List';
		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_terms_details();

		$data['main_content']='setup/terms_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_terms_condition()
	{
		$data['title']='Edit Terms';
		$id = $this->uri->segment('3');
		$data['tname'] = $this->uri->segment('3');

		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_terms_details_by_id($id);

		$data['main_content']='setup/terms_conditions_edit.php';
		$this->load->view('includes/template.php',$data);
	}
	function update_terms_details()
	{
		$data['title']='Terms';
		$tname=$this->input->post('tname');
		$tid=$this->input->post('id');
		$this->load->model('Setup_model');
		$this->Setup_model->update_terms_details($tid,$tname);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Admin/list_terms_condition');
	}
	//////////// warehouse master   ///////////////////////
	  function add_warehouse()
	  {
	    $data['title']='Add Warehouse Master';
	    $this->load->model('Users_model');
	    $data['emp_records']=$this->Users_model->get_user_list();

	    $data['main_content']='setup/warehouse_master_add.php';
	    $this->load->view('includes/template.php',$data);
	  }

	  function add_warehouse_details()
	  {
	    $this->load->model('Setup_model');
	    $insert_id=$this->Setup_model->add_warehouse_master_data();

	    if($insert_id!='')
	    {
	      $this->session->set_flashdata('success', 'Data Saved Successfully..');
	      redirect('Admin/view_warehouse_list');
	    }
	  }

	  function view_warehouse_list()
	  {
	    $data['title']='Warehouse List';
	    $this->load->model('Setup_model');
	    $data['records']=$this->Setup_model->get_warehouse_list();

	    $data['main_content']='setup/warehouse_master_list.php';
	    $this->load->view('includes/template.php',$data);
	  }
	  function edit_warehouse()
	  {
		$data['title']='Warehouse Master';
		$wid = $this->uri->segment('3');
		$this->load->model('Setup_model');
		$data['records']=$this->Setup_model->get_warehouse_by_id($wid);
		$data['emp_records']=$this->Setup_model->get_active_employee_list();
		$data['state_records']=$this->Setup_model->get_state_records();

		$data['main_content']='setup/warehouse_master_edit.php';
		$this->load->view('includes/template.php',$data);
	  }

	  function update_warehouse_details()
	  {
	    $wid=$this->input->post('warehouse_id');

	    $this->load->model('Setup_model');
	    $this->Setup_model->update_warehouse_data($wid);

	    $this->session->set_flashdata('success', 'Data Updated Successfully..');
	    redirect('setup/view_warehouse_list');
	  }
function dbbackup()
	  {
	       // Load the DB utility class
		$this->load->dbutil();
		$date= date('Y-m-d h:i:s');
		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup();

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		//write_file(' /var/www/html/petrostar_erp/mybackup.gz', $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download("catalystdb$date.sql.gz", $backup);
	  }
/***********************************    End CI Controller*************************************/
}
?>
