<?php date_default_timezone_set('Asia/Kolkata');

    class Product extends CI_Controller {
        
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
        
        /////////////////////// New main_category /////////////////////////////////////
	function add_main_category()
	{
		$data['title']='Item Category';
		//$this->load->model('Product_model');
		//$data['cat_code'] = $this->Product_model->get_max_cat_code();
		$data['main_content']='product/category_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_main_category_data()
	{
		$data['title']='Add Category';
		$this->load->model('Product_model');
		$insert_id = $this->Product_model->add_category_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Product/view_main_category_list');
		}
	}
	function view_main_category_list()
	{
		$data['title']='Item Category List';
		$this->load->model('Product_model');
		$data['records']=$this->Product_model->get_main_category_list();

		$data['main_content']='product/category_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_main_category()
	{
		$data['title']='Edit Item  Category';
		$id = $this->uri->segment('3');

		$this->load->model('Product_model');
		$data['records']=$this->Product_model->get_category_record_by_id($id);
		$data['trans_records']=$this->Product_model->get_attribute_transaction_by_id($id);

		$data['main_content']='product/category_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_main_category()
	{
		$data['title']='Item Category';
		$gid=$this->input->post('id');

		$this->load->model('Product_model');
		$res= $this->Product_model->update_attribute_data($gid);
		
		if($res)
		{
		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect("Product/edit_main_category/$gid");
		}
		else {
		$this->session->set_flashdata('error', 'Something went wrong..');
		redirect("Product/edit_main_category/$gid");
		}
	}
	/////////////////////// New sub_category /////////////////////////////////////
	function add_sub_category1()
	{
		$data['title']='Item Sub Category List';
		$this->load->model('Product_model');
		$data['cat_records']=$this->Product_model->get_main_category_list();
		$data['records']=$this->Product_model->get_sub_category_list();

		// $data['main_content']='product/sub_category_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_sub_category_data()
	{
		$data['title']='Add Category';
		$this->load->model('Product_model');
		$insert_id = $this->Product_model->add_sub_category_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Product/add_sub_category');
		}
	}
	function add_sub_category()
	{
		$data['title']='Item Sub Category List';
		$this->load->model('Product_model');
		$data['records']=$this->Product_model->get_sub_category_list();

		$data['main_content']='product/sub_category_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_sub_category()
	{
		$data['title']='Edit Item sub Category';
		$id = $this->uri->segment('3');

		$this->load->model('Product_model');
		$data['records']=$this->Product_model->get_category_record_by_id($id);

		$data['main_content']='product/sub_category_edit.php';
		$this->load->view('includes/template.php',$data);
	}

	function update_sub_category()
	{
		$data['title']='Item sub Category';
		$gid=$this->input->post('id');

		$this->load->model('Product_model');
		$res= $this->Product_model->update_sub_category($gid);
		
		if($res)
		{			
			$this->session->set_flashdata('success', 'Data Updated Successfully..');
			redirect('Product/add_sub_category');
		}
		else{
			$this->session->set_flashdata('error', 'duplicate entry..');
			redirect("Product/edit_attribute/$gid");
		}
	}
	/////////////////////// New Product /////////////////////////////////////
	function add_product()
	{
		$data['title']='Add New Item';
		
		$this->load->model('Product_model');
		$data['cat_records']=$this->Product_model->get_main_category_list();
		$this->load->model('Setup_model');
		$data['unit_records']=$this->Setup_model->get_unit_list();
		
		$data['main_content']='product/product_add.php';
		$this->load->view('includes/template.php',$data);
	}
	function add_new_product()
	{
		
		$this->load->model('Product_model');
		$insert_id = $this->Product_model->add_product_data();

		if($insert_id!=''){
			$this->session->set_flashdata('success', 'Data Saved Successfully..');
			redirect('Product/view_product_list');
		}
	}
	function view_product_list()
	{
		$data['title']='Item List';
		$this->load->model('Product_model');
		$data['records']=$this->Product_model->get_product_list();

		$data['main_content']='product/product_list.php';
		$this->load->view('includes/template.php',$data);
	}
	function edit_product()
	{
		$data['title']='Edit Item';
		$id = $this->uri->segment('3');
		
		$this->load->model('Product_model');
		$data['records']=$this->Product_model->get_product_by_id($id);
		$cat = $data['records'][0]->prd_category;
		$data['subcat']=$this->Product_model->get_sub_category_list($cat);
		//print_r($data['subcat']);
		$data['main_content']='product/product_edit.php';
		$this->load->view('includes/template.php',$data);
	}
	function update_product_data()
	{
		$gid=$this->input->post('id');

		$this->load->model('Product_model');
		$this->Product_model->update_product_data($gid);

		$this->session->set_flashdata('success', 'Data Updated Successfully..');
		redirect('Product/view_product_list');
	}
	
	function ajax_get_item_code()
	{
		$value=array();
		$data['title']='Edit Item';
		$id =$this->input->post('cat_id');

		$this->load->model('Product_model');
		$category_code=$this->Product_model->get_category_code_by_id($id);
		$num=$this->Product_model->ajax_get_item_code($category_code,$id);
		$digit=sprintf("%1$04d",$num);
		echo $data['code'] =$category_code.$digit;
		
	}
	function ajax_get_product_details()
	{
		$value=array();
		
		$id =$this->input->post('product_id');

		$this->load->model('Product_model');
		$data['records']=$this->Product_model->get_product_by_id($id);
		
		foreach($data['records'] as $row)
		{
			$value=array('item_desc'=>$row->product_description,'price'=>$row->unit_price);
		}
		echo json_encode($value);
		
	}
	function ajax_get_manf_product_details()
	{
		$value=array();
		
		$id =$this->input->post('product_id');

		$this->load->model('Product_model');
		$data['records']=$this->Product_model->get_product_by_id($id);
		
		foreach($data['records'] as $row)
		{
			$value=array('item_desc'=>$row->product_description,'price'=>$row->unit_price,'length'=>$row->length,'height'=>$row->height,'colour'=>$row->colour_code);
		}
		echo json_encode($value);
		
	}


}?>
