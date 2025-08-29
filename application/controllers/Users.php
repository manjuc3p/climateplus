<?php date_default_timezone_set('Asia/Kolkata');

    class Users extends CI_Controller {
        
        function __construct() {
             parent::__construct();
             $this->is_logged_in();
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
        
        /////////////////////// New user /////////////////////////////////////
	function add_user()
	{
		$data['title']='Add New User';
		$this->load->model('Setup_model');
		$data['dept_list'] = $this->Setup_model->get_active_department_list();
		$data['main_content']='users/user_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_new_user()
	{
		$data['title']='Add New User';
		$this->load->model('Users_model');
		$insert_id = $this->Users_model->add_new_user();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Users/list_users');
		}
	}
	function list_users()
	{
		$data['title']='User List';
		$this->load->model('Users_model');
		$data['records']=$this->Users_model->get_user_list();

		$data['main_content']='users/user_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_user()
	{
		$data['title']='New User';
		$id = $this->uri->segment('3');

		$this->load->model('Users_model');
		$data['records']=$this->Users_model->get_user_record_by_id($id);
		$this->load->model('Setup_model');
		$data['dept_list'] = $this->Setup_model->get_active_department_list();

		$data['main_content']='users/user_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_user_data()
	{
		$data['title']='New User';
		$gid=$this->input->post('id');

		$this->load->model('Users_model');
		$this->Users_model->update_user_data($gid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Users/list_users');
	}
	
	/////////////////////// New user /////////////////////////////////////
	function add_customer()
	{
		$data['title']='Add New Customer';
		$data['main_content']='users/customer_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_new_customer()
	{
		$data['title']='Add New Customer';
		$this->load->model('Users_model');
		$insert_id = $this->Users_model->add_customer_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Users/view_customer_list');
		}
	}
	function view_customer_list()
	{
		$data['title']='Customer List';
		$this->load->model('Users_model');
		$data['records']=$this->Users_model->get_customer_list();

		$data['main_content']='users/customer_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_customer()
	{
		$data['title']='Edit Customer';
		$id = $this->uri->segment('3');

		$this->load->model('Users_model');
		$data['records']=$this->Users_model->get_customer_by_id($id);
		$data['cp_list']=$this->Users_model->get_customer_cp_details($id);

		$data['main_content']='users/customer_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_customer_data()
	{
		$data['title']='New Customer';
		$gid=$this->input->post('id');

		$this->load->model('Users_model');
		$this->Users_model->update_customer_data($gid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Users/view_customer_list');
	}
	/////////////////////// New supplier /////////////////////////////////////
	function add_supplier()
	{
		$data['title']='Add New Supplier';
		$data['main_content']='users/supplier_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_new_supplier()
	{
		$data['title']='Add New Supplier';
		$this->load->model('Users_model');
		$insert_id = $this->Users_model->add_supplier_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Users/view_supplier_list');
		}
	}
	function view_supplier_list()
	{
		$data['title']='Supplier List';
		$this->load->model('Users_model');
		$data['records']=$this->Users_model->get_supplier_list();

		$data['main_content']='users/supplier_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_supplier()
	{
		$data['title']='Edit Supplier';
		$id = $this->uri->segment('3');

		$this->load->model('Users_model');
		$data['records']=$this->Users_model->get_supplier_by_id($id);

		$data['main_content']='users/supplier_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_supplier_data()
	{
		$data['title']='New Supplier';
		$gid=$this->input->post('id');

		$this->load->model('Users_model');
		$this->Users_model->update_supplier_data($gid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Users/view_supplier_list');
	}
}?>
