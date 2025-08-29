<?php
date_default_timezone_set('Asia/Kolkata');
defined('BASEPATH') OR exit('No direct script access allowed');

	class Setup extends CI_Controller {
	
	public function __construct() {
         parent::__construct();
       	 $this->is_logged_in();
    }
    /******* Log Out ***********************/
    function is_logged_in() 
    {
	$is_logged_in = $this->session->userdata('is_logged_in');
	if(!isset($is_logged_in) || $is_logged_in != true) {
		echo "You don\'t have permission to access this page. <a href='".base_url()."index.php/login'>Login</a>";	
		die();
		//$this->load->view('login/login_form');
	}		
    }
    //********** Access Control*********//
    function access_control()
    {
	$data['title']='User Access Control';

	$data['user_id']=$this->input->post('user_id');
	
	$data['msg']='';
	$this->load->model('Setup_model');
	$data['records'] = $this->Setup_model->get_active_employee_list();
	$data['menu'] = $this->Setup_model->get_menu_list();

	$data['main_content']='setup/access_control.php';
	$this->load->view('/includes/template',$data);
    }

    function add_access_control()
    {
	$this->load->model('Setup_model');
	$insert_id = $this->Setup_model->add_access_control();

	if($insert_id!='')
	{
	$this->session->set_flashdata('success', 'Data Saved Successfully..');
	redirect('setup/access_control');
	}
    }
    //////////// Unit master   ///////////////////////

  function view_unit_list()
  {
	$data['title']='Unit Master';
	$this->load->model('Setup_model');
	$data['units']=$this->Setup_model->get_active_unit_list();

	$data['main_content']='setup/unit_list.php';
	$this->load->view('includes/template.php',$data);
  }

  function add_units()
  {
        $data['title']='Unit Master';
    	$data['main_content']='setup/unit_add.php';
    	$this->load->view('includes/template.php',$data);
  }

  function add_unit_records()
  {
	$data['title']='Unit Master';
	$this->load->model('Setup_model');
	$insert_id=$this->Setup_model->add_units();
	if($insert_id!='')
	{
	$this->session->set_flashdata('success', 'Data Saved Successfully..');
	redirect('Setup/view_unit_list');
	}
  }

  function edit_units()
  {
        $data['title']='Unit Master';
	$id=$this->uri->segment('3');

	$this->load->model('Setup_model');
	$data['units']=$this->Setup_model->get_units_by_id($id);

	$data['main_content']='setup/unit_edit.php';
	$this->load->view('includes/template.php',$data);
  }

  function update_unit_records()
  {
	$this->load->model('Setup_model');
	$insert_id=$this->Setup_model->update_units();
	if($insert_id!='')
	{
	$this->session->set_flashdata('success', 'Data Updated Successfully..');
	redirect('Setup/view_unit_list');
	}
  }
  //job_types_master
  function list_job_types(){
	$data['title']='Job Types';
	$this->load->model('Setup_model');
	$data['job_types']=$this->Setup_model->get_job_types();

	$data['main_content']='setup/job_type_list.php';
	$this->load->view('includes/template.php',$data);
  }
}?>
