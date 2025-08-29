<?php

    class Sales_model extends CI_Model {
 
        function add_new_enquiry() 
	{
		$prifix='CAC/ENQ/';
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'enquiry_code','enquiry_master',9)+1;
		$digit=sprintf("%1$04d",$num);
		$enquiry_code =$prifix.$digit;		
		$customer_id = $this->input->post('customer_id');
		// if($cust_id=='new')
		// {
		// 	$prifix1='CM';
		// 	$num1 = $this->Setup_model->get_next_code($prifix1,'cust_code','customer_master',3)+1;
		// 	$digit1=sprintf("%1$04d",$num1);
		// 	$Code1 =$prifix1.$digit1;

		// 	$data = array(
		// 	'cust_code' => $Code1,
		// 	'cust_name' =>$this->input->post('customer_name'),
		// 	'contact_no'  => $this->input->post('cust_mobile'),
		// 	'email_id' => $this->input->post('cust_email'),
		// 	'created_by'  => $this->session->userdata('user_id'),
		// 	'created_date' =>  date('Y-m-d H:i:s'),
		// 	);
		// 	$this->db->insert('customer_master', $data);
		// 	$customer_id = $this->db->insert_id();
			
		// }
		// else
		// {
		// 	$customer_id = $cust_id;
		// }
		 
		//  echo '<pre>';print_r($_POST);exit;
		
		$data = array(
		'enquiry_code' => $enquiry_code,
		'enq_date' => date('Y-m-d',strtotime($this->input->post('enq_date'))),
		'revision_date' => date('Y-m-d',strtotime($this->input->post('enq_date'))),
		'cust_id' => $customer_id,
		'enq_type' => $this->input->post('enquiry_type'),
		'client_ref' => $this->input->post('client_ref'),
		'remark' => $this->input->post('remark'),
		//'other_file' => $other_file,
		'created_by' => $this->session->userdata('user_id'),
		'sales_person'=>$this->input->post('user_id'),
		'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('enquiry_master', $data);
		$insert_id = $this->db->insert_id();
		$approved=0;
		if($insert_id)
		{
			if($this->input->post('enquiry_type')=='1'||$this->input->post('enquiry_type')=='3')
			{
				$approved=1;
				
				for ($i = 0; $i < count($_POST['srn']); $i++)
				{	    
				      try{
				      $pid = $_POST['product_id'][$i];
				      
				     
				      $data = array(
					'enquiry_id' => $insert_id,
					'product_id' => $pid,
					'quantity'  => $_POST['trading_qty'][$i],
					'approved'  => $approved,
				      );
				      $this->db->insert('enquiry_transaction', $data);
				      }
				      catch(Exception $e){
				      	return 'duplicate';
				      }
				}
			}
			else{
				$approved=1;
				
				for ($i = 0; $i < count($_POST['product_id']); $i++)
				{	    
				      try{    
				      $data = array(
						'enquiry_id' => $insert_id,
						'product_id' => $_POST['product_id'][$i],
						'manf_length' => $_POST['manf_length'][$i],
						'manf_height' => $_POST['manf_height'][$i],
						'manf_color' => $_POST['manf_color'][$i],
						'quantity'  => $_POST['manf_qty'][$i],
						'approved'  => $approved,
				      );
				      $this->db->insert('enquiry_transaction', $data);
				      }
				      catch(Exception $e){
				      	return 'duplicate';
				      }
				}
			}
		
			
			if($this->input->post('enquiry_type')=='1')
				$etype='Trading';
			else if($this->input->post('enquiry_type')=='2')
				$etype='Manufacturing';
				else if($this->input->post('enquiry_type')=='3')
				$etype='MachineSale';
			$data = array(
			'enq_id' => $insert_id,
			'status' => "New $etype Enquiry Added",
			'status_date' =>  date('Y-m-d H:i:s'),
			);
			$this->db->insert('sales_order_status', $data);
			
			$this->load->model('Users_model');
			$data['user_records']=$this->Users_model->get_active_user_list();
      
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'enquiry_master','enquiry_id',$insert_id);
			/* notification */ 
			foreach($data['user_records'] as $r)
   			{
				$notice=add_notification($insert_id,$r->user_id,"New $etype Enquiry Received $enquiry_code","sales/edit_order/$insert_id/0");
			}
			 /* end notification */
			return $insert_id;
		 }
	}
        
       function update_enquiry_data($id) 
       {
		$new_revision= $this->input->post('revision');
    		if($this->input->post('create_revision')==1){
				$new_revision= $this->input->post('revision')+1;
			}
			else{
				$query=$this->db->query("delete from enquiry_transaction where enquiry_id=$id"); 
				$query=$this->db->query("delete from enquiry_transaction2 where enquiry_id=$id"); 
			}
         		
         		
		$data = array(
			'revision_date' => date('Y-m-d',strtotime($this->input->post('enq_date'))),
			'revision' => $new_revision,
			//'enq_type' => $this->input->post('enquiry_type'),
			'client_ref' => $this->input->post('client_ref'),
			'remark' => $this->input->post('remark'),			
			'sales_person'=>$this->input->post('user_id'),
		);
		$this->db->where('enquiry_id',$id);
		$res = $this->db->update('enquiry_master', $data);

		$allowedExts = array("jpeg","jpg","png","doc","pdf");
		$data['file_name']=$_FILES["other_file"]["name"];
		$temp = explode(".", $_FILES["other_file"]["name"]);
		$extension = end($temp);
		if (($_FILES["other_file"]["size"] < 15728640) && in_array($extension, $allowedExts))
		{
		      if ($_FILES["other_file"]["error"] > 0)
		      {
			$this->session->set_flashdata('error','Failed to upload - Please check file size and file format');
		      }
		      else
		      {
				$timestamp1=time();
				$file_tmp = $_FILES["other_file"]["tmp_name"];
				$other_file = $timestamp1."_".$_FILES['other_file']['name'];			
				move_uploaded_file($file_tmp,"/home/webadmin/gen/bsg_erp/public/uploded_documents/".$other_file);
				$query=$this->db->query("update enquiry_master set other_file='$other_file' where enquiry_id=$id");
		      }
		} 
		if($res)
		{		    
			
			
			if($this->input->post('enquiry_type')=='1'||$this->input->post('enquiry_type')=='3')
			{
				$image_name =''; $extension='';
				for ($i = 0; $i < count($_POST['product_id']); $i++)
				{	
					      	$data = array(
						'enquiry_id' => $id,
						'trans_revision' =>$new_revision,
						'product_id' => $_POST['product_id'][$i],
						'quantity'  => $_POST['trading_qty'][$i],
					      );
					      $this->db->insert('enquiry_transaction', $data);
			         }
			}

			elseif($this->input->post('enquiry_type')=='2'){

				$image_name =''; $extension='';
				for ($i = 0; $i < count($_POST['product_id']); $i++)
				{	
					      	$data = array(
						'enquiry_id' => $id,
						'trans_revision' =>$new_revision,
						'product_id' => $_POST['product_id'][$i],
						'manf_length' => $_POST['manf_length'][$i],
						'manf_height' => $_POST['manf_height'][$i],
						'manf_color' => $_POST['manf_color'][$i],
						'quantity'  => $_POST['manf_qty'][$i],
					      );
					      $this->db->insert('enquiry_transaction', $data);
			         }
			}
			else   // type=project
			{  
				for ($i = 0; $i < count($_POST['product_div_value']); $i++)
				{	
					$x= $_POST['product_div_value'][$i];
					$main_heading = $this->input->post("main_heading$x");
					$data = array(
						'enquiry_id' => $id,
						'srn' => $i+1,
						'product_desc'  => $main_heading,
						'quantity'  => $this->input->post("main_qty$x"),
				        );
				        
				       $this->db->insert('enquiry_transaction', $data);
				       $tr_id1 = $this->db->insert_id();
					      
					for ($j = 0; $j < count($_POST["sub_details$x"]); $j++)
					{
						$sub_details= $_POST["sub_details$x"][$j];
						$qty= $_POST["qty$x"][$j];
						
						$data = array(
						'enquiry_id' => $id,
						'trans_id1' => $tr_id1,
						'sub_details' => $sub_details,
						'qty'  => $qty,
					       );
					       $this->db->insert('enquiry_transaction2', $data);
					}
				}
			}
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,2,$page_name[1],'enquiry_master','enquiry_id',$id);
			return true;
		}
	}
	
	function get_enquiry_list()
	{
		$query=$this->db->query("select * from enquiry_master  e, customer_master c where e.cust_id=c.customer_id order by enq_date desc, enquiry_code desc");
		return $query->result();
	}

	function get_nonfeasible_enquiry_list()
	{
		$query=$this->db->query("select * from enquiry_master  e, customer_master c where e.cust_id=c.customer_id and order_status = 0 and cancelled=0 order by enq_date desc");
		return $query->result();
	}
	function get_enquiry_list_for_qtn()
	{
		$query=$this->db->query("select * from enquiry_master  e, customer_master c where e.cust_id=c.customer_id and feasibility in(1,2) and cancelled=0 and order_status=0 order by enq_date desc");
		return $query->result();
	}
	function get_manf_enquiry_list_for_qtn()
	{
		$query=$this->db->query("select * from enquiry_master  e, customer_master c where e.cust_id=c.customer_id and feasibility in(1,2) and cancelled=0 and order_status=0 and enq_type='2' order by enq_date desc");
		return $query->result();
	}
	function get_enquiry_record_by_id($id)
	{
		$query=$this->db->query("select e.*, c.cust_code, c.cust_name from enquiry_master e, customer_master c where e.cust_id=c.customer_id and enquiry_id='$id' ");
		return $query->result();
	}
	function get_enquiry_trans_by_id($id,$revision)
	{
		$query=$this->db->query("select * from enquiry_transaction  where enquiry_id='$id' and trans_revision='$revision' ");
		return $query->result();
	}
	function get_enquiry_trans2_by_id($id,$revision)
	{
		$query=$this->db->query("select * from enquiry_transaction2  where enquiry_id='$id' ");
		return $query->result();
	}
	
	function get_enquiry_trans_for_RFQ($id,$trans_id)
	{
		$query=$this->db->query("select * from enquiry_transaction where enquiry_id=$id and trans_id in($trans_id)");
		return $query->result();
	}
	function get_enquiry_trans_for_feasibility($id,$revision)
	{
		$query=$this->db->query("select * from enquiry_transaction where enquiry_id='$id' and trans_revision='$revision' and approved=0 ");
		return $query->result();
	}
	
	
	function get_enquiry_trans_for_quote($id,$revision)
	{
		$query=$this->db->query("select one.*, two.sale_price, two.sale_cost from (select * from enquiry_transaction where enquiry_id='$id' and trans_revision='$revision')as one left join(select * from cost_sheet_transaction)as two on(one.trans_id=two.item_id)  ");
		return $query->result();
	}

	function get_enquiry_trans_for_quote_manufacturing($enq_id,$revision)
	{
		$query=$this->db->query("select * from enquiry_transaction et left join product_master pm on et.product_id = pm.product_id where enquiry_id='$enq_id' and trans_revision='$revision' ");
		return $query->result();
	}

	function get_enquiry_trans_for_trading_quote($enq_id,$revision){
		$query=$this->db->query("select * from enquiry_transaction et left join product_master pm on et.product_id = pm.product_id where enquiry_id='$enq_id' and trans_revision='$revision' ");
		return $query->result();
	}

	function delete_enquiry($enquiry_id)
	{
		$query=$this->db->query("select count(*)as tcnt from sales_quotation_master where enq_master_id='$enquiry_id'");
		$tcnt = $query->row('tcnt');
		if($tcnt==0)
		{
			$query=$this->db->query("delete from enquiry_transaction where enquiry_id='$enquiry_id'");
			$query=$this->db->query("delete from enquiry_master where enquiry_id='$enquiry_id'");
			
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,3,$page_name[1],'enquiry_master','enquiry_id',$enquiry_id);
			return 1;
		}
		else 
			return 0;
	}
	/////////////////  enq feasibility start  ///////////////////
	function add_enquiry_feasibility_data()
	{
		$enq_id= $this->input->post('enq_id');
		$fstatus=0;  
		$cnt=count($_POST['trans_id']);   
		  
	        for ($i = 0; $i < count($_POST['trans_id']); $i++)
	        {		        	
        		$trans_id= $_POST['trans_id'][$i];        		
        		if($_POST['feasibility'][$i]==1)
        		{
        			$fstatus++;
        		}	        	
		         $data = array(
				'approved'  => $_POST['feasibility'][$i],
				'reason'  => $_POST['fremark'][$i],
		        );
			$this->db->where('trans_id',$trans_id);
			$res = $this->db->update('enquiry_transaction', $data);
		      
		      $data = array(
			'enq_id' => $enq_id,
			'enq_trans_id' =>$trans_id,
			'feasibility_status'  => $_POST['feasibility'][$i],
			'reason' =>  $_POST['fremark'][$i],
			'approved_by'  => $this->session->userdata('user_id'),
			'date' =>  date('Y-m-d H:i:s'),
			);
			$this->db->insert('enquiry_feasibility', $data);
	        }
		if($cnt==$fstatus)
		{
			$flag= 1;  // all items feasible
			$fname= 'Feasible';
		}
		elseif($fstatus==0)
		{
			$flag= 3;  // all items not feasible
			$fname= 'Not Feasible';
		}
		elseif($cnt>$fstatus)
		{
			$flag= 2;   // partial feasible
			$fname= 'Partial Feasible';
		}
		  
		$data = array(
		'feasibility' => $flag,
		);
		$this->db->where('enquiry_id',$enq_id);
		$res = $this->db->update('enquiry_master', $data);
		
		
		$enquiry_code=$this->input->post('enquiry_code');
		$status="Enquiry $enquiry_code $fname";
		$data = array(
			'enq_id' => $enq_id,
			'status' => $status,
			'status_date' =>  date('Y-m-d H:i:s'),
		);
		$this->db->insert('sales_order_status', $data);
		
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_active_user_list();
			 
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,2,$page_name[1],'enquiry_master','enquiry_id',$enq_id);
		/* notification */ 
		foreach($data['user_records'] as $r)
		{
			$notice=add_notification($enq_id,$r->user_id,$status,"sales/enq_feasibility_details/$enq_id/0");
		}
		 /* end notification */
		return true;
	}
	///////////////// Cost Sheet /////////////////////
	function add_cost_sheet($enq_id)
	{
		$data = array(
		'enq_id' =>$enq_id,
		'cs_date' => date('Y-m-d'),
		'payment_by' =>$this->input->post('payment_by'),
		'shiip_by' =>$this->input->post('Shipping'),
		'supplier_id' =>$this->input->post('supplier'),
		'fob_type' =>$this->input->post('FOB'),
		'cost_factor' =>$this->input->post('cost_factor'),
		'fnf' =>$this->input->post('Freightamt'),
		'insurance' =>$this->input->post('insamt'),
		'other_charges' =>$this->input->post('otheramt'),
		'Forwarding_per' =>$this->input->post('forwardingPer'),
		'freight_per' =>$this->input->post('FreightPer'),
		'insurence_per' =>$this->input->post('InsurancePer'),
		'customs_per' =>$this->input->post('CustomsPer'),
		'charges' =>$this->input->post('ChargesPer'),
		'interest' =>$this->input->post('InterestPer'),
		'months_per' =>$this->input->post('monthPer'),
		'guarantee' =>$this->input->post('GuaranteePer'),
		'margin' => $this->input->post('MarginPer'),
		'overheads' => $this->input->post('OverheadsPer'),
		'created_by' =>  $this->session->userdata('user_id'),
		'created_date' => date('Y-m-d'),
		);
		$this->db->insert('cost_sheet', $data);
		$insert_id = $this->db->insert_id();
		
		for ($i = 0; $i < count($_POST['trans_id']); $i++)
		{	    
		      $data = array(
			'cost_master_id' => $insert_id,
			'item_id' => $_POST['trans_id'][$i],
			'quantity' => $_POST['qty'][$i],
			'unit_cost'  => $_POST['price'][$i],
			'total_cost'  => $_POST['total'][$i],
			'Landed_price'  => $_POST['landed_price'][$i],
			'landed_cost'  => $_POST['landed_cost'][$i],
			'sale_price'  => $_POST['sale_price'][$i],
			'sale_cost'  => $_POST['sale_cost'][$i],
			'margin'  => $_POST['margin'][$i],
		      );
		      $this->db->insert('cost_sheet_transaction', $data);
		     
		}
		$data = array(
			'cost_master_id' =>$insert_id,
			'rate' =>$this->input->post('rate'),
			'aed_amt' =>$this->input->post('totalrate'),
			'forwarding' =>$this->input->post('foramt'),
			'fright' =>$this->input->post('freamt'),
			'insurance' =>$this->input->post('insuamt'),
			'cif' =>$this->input->post('cifamt'),
			'custom_duty' =>$this->input->post('customamt'),
			'off_loading' =>$this->input->post('offlamt'),
			'demmurage' =>$this->input->post('Demmurage'),
			'clearing' =>$this->input->post('Clearing'),
			'transport' =>$this->input->post('transamt'),
			'bank_charges' =>$this->input->post('bankamt'),
			'interest' =>$this->input->post('expamt'),
			'landed_cost' =>$this->input->post('Landedamt'),
			'guarantees' =>$this->input->post('Guarantees'),
			'purchase' =>$this->input->post('Purchases'),
			'travelling' =>$this->input->post('travelamt'),
			'inspection' =>$this->input->post('Inspection'),
			'installation' =>$this->input->post('Installation'),
			'consultancy' =>$this->input->post('Consultancy'),
			'car_insurance' =>$this->input->post('car'),
			'subtotal' =>$this->input->post('subtotal'),
			'overheaded' =>$this->input->post('OverheadsAmt'),
			'grand_total' =>$this->input->post('grand_total'),
		);
		$this->db->insert('cost_sheet_calculation', $data);
		
        	$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'cost_sheet','cost_sheet_id',$insert_id);
		/* notification */ 
		foreach($data['user_records'] as $r)
		{
			$notice=add_notification($enq_id,$r->user_id,$status,"sales/edit_cost_sheet/$insert_id/0");
		}
		 /* end notification */
		return $insert_id;
	}
	function get_cost_sheet_list()
	{
		$query=$this->db->query("select one.*, sale_cost from (select cost_sheet_id,c.cs_date, e.enquiry_code, project_name,project_location, m.cust_name  from cost_sheet c, enquiry_master e, customer_master m where c.enq_id=e.enquiry_id and e.cust_id=m.customer_id)as one left join(select sum(sale_cost) as sale_cost,cost_master_id from cost_sheet_transaction group by cost_master_id)as two on(one.cost_sheet_id=two.cost_master_id)");
		return $query->result();
	}
	function get_quotation_ack_by_id($sid)
	{
		$query=$this->db->query("select * from sales_quotation_ack where sno=$sid ");
		return $query->result();
	}

	/*Estimation start*/


function add_estimation_data()
{
	$enq_id = $this->input->post('enq_id');
	$code = $this->input->post('qcode');
	$cp_select=$this->input->post('cp_select');
	
	$data = array(
	'estimate_code' => $code,
	'estimate_date' => date('Y-m-d',strtotime($this->input->post('qdate'))),
	'revision_date'=> date('Y-m-d',strtotime($this->input->post('qdate'))),
	'enq_master_id' => $enq_id,
	'customer_id' => $this->input->post('customer_id'),
	'sub_total' => $this->input->post('sub_total'),
	'vat_amt' => $this->input->post('vat_amt'),
	'vat_percent' => $this->input->post('vat_percent'),
	'margin_percent' =>$this->input->post('margin'),
	'margin' => $this->input->post('margint_amt'),
	'currency_id' => $this->input->post('cid'),
	'currency_rate' => $this->input->post('crate'),		
	'grand_total' => $this->input->post('grand_total'),
	'payment_term' => $this->input->post('term1'),
	'delivery_term' => $this->input->post('term2'),
	
	'validity' => $this->input->post('validity'),
	
	'billing_addr' => $this->input->post('billing_addr1'),
	'billing_city' => $this->input->post('billing_city'),
	'billing_state' => $this->input->post('billing_state'),
	'billing_pincode' => $this->input->post('billing_po'),
	'billing_country' => $this->input->post('billing_country'),
	
	'shipping_addr' => $this->input->post('shipping_addr1'),
	'shipping_city' => $this->input->post('shipping_city'),
	'shipping_state' => $this->input->post('shipping_state'),
	'shipping_pincode' => $this->input->post('shipping_po'),
	'shipping_country' => $this->input->post('shipping_country'),
	'bank_id' =>  $this->input->post('bank'),
	
	'cp_name' => $this->input->post("cp_name$cp_select"),
	'cp_mobile' => $this->input->post("cp_mobile$cp_select"),
	'cp_email' => $this->input->post("cp_email$cp_select"),
	'sales_person'=>$this->input->post('user_id'),	
	'created_by' => $this->session->userdata('user_id'),
	'created_date' => date('Y-m-d H:i:s')
	);
	$this->db->insert('sales_estimation_master', $data);
	$insert_id = $this->db->insert_id();
	
	if($this->input->post("cp_new$cp_select")==1)
	{
		$data = array(
		'cust_id' =>$this->input->post('customer_id'),
		'cp_name' => $this->input->post("cp_name$cp_select"),
		'cp_mobile' => $this->input->post("cp_mobile$cp_select"),
		'cp_email' => $this->input->post("cp_email$cp_select"),
		  );
			  $this->db->insert('customer_contact_person', $data);
	}
	
	if($insert_id)
	{	
		for ($i = 0; $i < count($_POST['product_id']); $i++)
			{		
			  $data = array(
				'quote_master_id' => $insert_id,
				'product_id' => $_POST['product_id'][$i],
				'manf_length'=> $_POST['manf_length'][$i],
				'manf_height'=> $_POST['manf_height'][$i],
				'manf_color' => $_POST['manf_color'][$i],
				'quantity'   => $_POST['qty'][$i],		
				'price'      => $_POST['price'][$i],
				'mar_per'    => $_POST['mar_per'][$i],
				'mar_val'    => $_POST['mar_val'][$i],
				'total'  	 => $_POST['total'][$i],
			  );
			  
			 $this->db->insert('sales_estimation_transaction', $data);	
			}
		
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_active_user_list();
 		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'sales_estimation_master','estimate_id',$insert_id);
		/* notification */ 
		foreach($data['user_records'] as $r)
		   {
			$notice=add_notification($insert_id,$r->user_id,"Sales Estimation generated $code","sales/edit_estimation/$insert_id/1/0");
		}
		 /* end notification */
	}
	return $insert_id;
}

function update_estimation_data($qid)
{
	$new_revision= $this->input->post('revision');
		if($this->input->post('create_revision')==1)
			 $new_revision= $this->input->post('revision')+1;
	$data = array(
		'revision' => $new_revision,
		'revision_date'=> date('Y-m-d',strtotime($this->input->post('rev_date'))),
		'customer_id' => $this->input->post('customer_id'),
		'sub_total' => $this->input->post('sub_total'),
		'vat_amt' => $this->input->post('vat_amt'),
		'vat_percent' => $this->input->post('vat_percent'),
		'discount_percent' =>$this->input->post('discount'),
		'discount' => $this->input->post('discount_amt'),
		'currency_id' => $this->input->post('cid'),
		'currency_rate' => $this->input->post('crate'),			
		'grand_total' => $this->input->post('grand_total'),
		'payment_term' => $this->input->post('term1'),
		'delivery_term' => $this->input->post('term2'),
		'validity' => $this->input->post('validity'),
		
		'billing_addr' => $this->input->post('billing_addr1'),
		'billing_city' => $this->input->post('billing_city'),
		'billing_state' => $this->input->post('billing_state'),
		'billing_pincode' => $this->input->post('billing_po'),
		'billing_country' => $this->input->post('billing_country'),
		
		'shipping_addr' => $this->input->post('shipping_addr1'),
		'shipping_city' => $this->input->post('shipping_city'),
		'shipping_state' => $this->input->post('shipping_state'),
		'shipping_pincode' => $this->input->post('shipping_po'),
		'shipping_country' => $this->input->post('shipping_country'),
		
		'cp_name' => $this->input->post("cp_name"),
		'cp_mobile' => $this->input->post("cp_mobile"),
		'cp_email' => $this->input->post("cp_email"),
		
		
		'sales_person'=>$this->input->post('user_id'),	
		'approval'=>0,		
	);		
	$this->db->where('quote_id',$qid);
	$this->db->update('sales_estimation_master', $data);
	
	$enqid=$this->input->post('enq_id');
	
	
	
	// if($this->input->post('create_revision')!=1)
	// {
	// 	$query=$this->db->query("select group_concat(trans_id)as res from sales_estimation_transaction where quote_master_id=$qid and trans_revision=$new_revision");
	// 	$trid= $query->row('res');
	// 	$query=$this->db->query("delete from sales_estimation_transaction where quote_master_id=$qid and trans_revision=$new_revision");
	// 	$query=$this->db->query("delete from sales_estimation_transaction2 where quote_master_id=$qid and trans_id1 in($trid)");
		
	// }		
	
	for ($i = 0; $i < count($_POST['desc']); $i++)
		{	
		  $data = array(
		'quote_master_id' => $qid,
		'trans_revision' => $new_revision,
		'product_id' => $_POST['product_id'][$i],
		'quantity'  => $_POST['qty'][$i],	
		'price'  => $_POST['price'][$i],
		'dis_per'  => $_POST['dis_per'][$i],
		'dis_val'  => $_POST['dis_val'][$i],
		'total'  => $_POST['total'][$i],
		  );
		  $this->db->insert('sales_quotation_transaction', $data);
		  $trans_id1 = $this->db->insert_id();	
		
		}
			if(isset($_POST['new_product_id']))
		{
			for ($i = 0; $i < count($_POST['new_product_id']); $i++)
			{
			  $data = array(
			'quote_master_id' => $qid,
			'trans_revision' => $new_revision,
			'product_id' => $_POST['new_product_id'][$i],
			'quantity'  => $_POST['new_qty'][$i],	
			'price'  => $_POST['new_price'][$i],
			'total'  => $_POST['new_total'][$i],
			  );
				  $this->db->insert('sales_quotation_transaction', $data);
		  }
		}
		
	$qcode=$this->input->post('qcode');
	$data = array(
	'enq_id' => $this->input->post('enq_id'),
	'status' => "$qcode Quotation Revised ",
	'status_date' =>  date('Y-m-d H:i:s'),
	);
	$this->db->insert('sales_order_status', $data);
	
	$this->load->model('Users_model');
	$data['user_records']=$this->Users_model->get_active_user_list();

	$user_se_id=$this->session->userdata('user_id');
	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	$ci = get_instance();
	$ci->load->helper('log');
	$log_msg=add_log_entry($user_se_id,2,$page_name[1],'sales_quotation_master','quote_id',$qid);
	/* notification */ 
	foreach($data['user_records'] as $r)
	{
		$revision=$this->input->post('revision');
		$notice=add_notification($qid,$r->user_id,"$qcode Quotation Revised","sales/edit_quotation/$qid/$revision/0");
	}
	 /* end notification */
	return $insert_id;
	}

	function get_all_estimation_list()
	{
		$query=$this->db->query("select e.*, c.cust_code, c.cust_name,i.enquiry_code, i.enq_date, i.client_ref from sales_quotation_master  e, customer_master c,enquiry_master i  where e.customer_id=c.customer_id and e.enq_master_id=i.enquiry_id order by quotation_date desc, quotation_code desc");
		return $query->result();
	}
	function get_estimation_list()
	{
		$query= $this->db->query("select e.*, c.cust_code, c.cust_name,i.enquiry_code, i.enq_date, i.client_ref, i.enq_type from sales_estimation_master e, customer_master c,enquiry_master i where e.customer_id=c.customer_id and e.enq_master_id=i.enquiry_id and approval=0 order by estimate_date desc, estimate_code desc");
		return $query->result();
	}

	/*Estimation end*/
	
	//// Quotation start /////////////
	function add_quotation_data()
	{
		
		$enq_id = $this->input->post('enq_id');
		$enq_type = $this->input->post('enq_type');
		$code = $this->input->post('qcode');
		$cp_select=$this->input->post('cp_select');
		
		$data = array(
		'quotation_code' => $code,
		'quotation_date' => date('Y-m-d',strtotime($this->input->post('qdate'))),
		'revision_date'=> date('Y-m-d',strtotime($this->input->post('qdate'))),
		'enq_master_id' => $enq_id,
		'customer_id' => $this->input->post('customer_id'),
		'sub_total' => $this->input->post('sub_total'),
		'vat_amt' => $this->input->post('vat_amt'),
		'vat_percent' => $this->input->post('vat_percent'),
		'discount_percent' =>$this->input->post('discount'),
		'discount' => $this->input->post('discount_amt'),
		'currency_id' => $this->input->post('cid'),
		'currency_rate' => $this->input->post('crate'),		
		'grand_total' => $this->input->post('grand_total'),
		'payment_term' => $this->input->post('term1'),
		'delivery_term' => $this->input->post('term2'),
		//'note_terms' => $this->input->post('terms'),
		//'client_ref' => $this->input->post('client_ref'),
		'validity' => $this->input->post('validity'),
		
		'billing_addr' => $this->input->post('billing_addr1'),
		'billing_city' => $this->input->post('billing_city'),
		'billing_state' => $this->input->post('billing_state'),
		'billing_pincode' => $this->input->post('billing_po'),
		'billing_country' => $this->input->post('billing_country'),
		
		'shipping_addr' => $this->input->post('shipping_addr1'),
		'shipping_city' => $this->input->post('shipping_city'),
		'shipping_state' => $this->input->post('shipping_state'),
		'shipping_pincode' => $this->input->post('shipping_po'),
		'shipping_country' => $this->input->post('shipping_country'),
		'bank_id' =>  $this->input->post('bank'),
		
		'cp_name' => $this->input->post("cp_name$cp_select"),
		'cp_mobile' => $this->input->post("cp_mobile$cp_select"),
		'cp_email' => $this->input->post("cp_email$cp_select"),
		'sales_person'=>$this->input->post('user_id'),	
		'created_by' => $this->session->userdata('user_id'),
		'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('sales_quotation_master', $data);
		$insert_id = $this->db->insert_id();
		
		if($this->input->post("cp_new$cp_select")==1)
		{
			$data = array(
			'cust_id' =>$this->input->post('customer_id'),
			'cp_name' => $this->input->post("cp_name$cp_select"),
			'cp_mobile' => $this->input->post("cp_mobile$cp_select"),
			'cp_email' => $this->input->post("cp_email$cp_select"),
		      );
	      		$this->db->insert('customer_contact_person', $data);
	    }
	        
		$query=$this->db->query("update enquiry_master set order_status=1 where enquiry_id=$enq_id");
		
		if($insert_id)
		{	
			if ($enq_type = '2'){
			for ($i = 0; $i < count($_POST['product_id']); $i++)
		        {		
			      $data = array(
					'quote_master_id' => $insert_id,
					'product_id' => $_POST['product_id'][$i],
					'manf_length'=> $_POST['manf_length'][$i],
					'manf_height'=> $_POST['manf_height'][$i],
					'manf_color' => $_POST['manf_color'][$i],
					'quantity'   => $_POST['qty'][$i],	
					'balance_qty'=> $_POST['qty'][$i],	
					'price'      => $_POST['price'][$i],
					'dis_per'    => $_POST['dis_per'][$i],
					'dis_val'    => $_POST['dis_val'][$i],
					'total'  	 => $_POST['total'][$i],
			      );
				 
			     $this->db->insert('sales_quotation_transaction', $data);	
				}
			}
			else{
				for ($i = 0; $i < count($_POST['product_id']); $i++)
		        {		
			      $data = array(
					'quote_master_id' => $insert_id,
					'product_id' => $_POST['product_id'][$i],
					'quantity'   => $_POST['qty'][$i],	
					'balance_qty'=> $_POST['qty'][$i],	
					'price'      => $_POST['price'][$i],
					'dis_per'    => $_POST['dis_per'][$i],
					'dis_val'    => $_POST['dis_val'][$i],
					'total'  	 => $_POST['total'][$i],
			      );
				 
			     $this->db->insert('sales_quotation_transaction', $data);	
				 echo $this->db->last_query();exit;
				}
			} 
			$data = array(
			'enq_id' => $enq_id,
			'status' => "Quotation generated $code",
			'status_date' =>  date('Y-m-d H:i:s'),
			);
			$this->db->insert('sales_order_status', $data);
			
			$this->load->model('Users_model');
			$data['user_records']=$this->Users_model->get_active_user_list();
      
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'sales_quotation_master','quote_id',$insert_id);
			/* notification */ 
			foreach($data['user_records'] as $r)
   			{
				$notice=add_notification($insert_id,$r->user_id,"Sales Quotation generated $code","sales/edit_quotation/$insert_id/1/0");
			}
			 /* end notification */
		}
		return $insert_id;
	}

	function update_quotation_data($qid)
	{
		$new_revision= $this->input->post('revision');
    		if($this->input->post('create_revision')==1)
         		$new_revision= $this->input->post('revision')+1;
		$data = array(
		    'revision' => $new_revision,
			'revision_date'=> date('Y-m-d',strtotime($this->input->post('rev_date'))),
			'customer_id' => $this->input->post('customer_id'),
			'sub_total' => $this->input->post('sub_total'),
			'vat_amt' => $this->input->post('vat_amt'),
			'vat_percent' => $this->input->post('vat_percent'),
			'discount_percent' =>$this->input->post('discount'),
			'discount' => $this->input->post('discount_amt'),
			'currency_id' => $this->input->post('cid'),
			'currency_rate' => $this->input->post('crate'),			
			'grand_total' => $this->input->post('grand_total'),
			'payment_term' => $this->input->post('term1'),
			'delivery_term' => $this->input->post('term2'),
			'validity' => $this->input->post('validity'),
			
			'billing_addr' => $this->input->post('billing_addr1'),
			'billing_city' => $this->input->post('billing_city'),
			'billing_state' => $this->input->post('billing_state'),
			'billing_pincode' => $this->input->post('billing_po'),
			'billing_country' => $this->input->post('billing_country'),
			
			'shipping_addr' => $this->input->post('shipping_addr1'),
			'shipping_city' => $this->input->post('shipping_city'),
			'shipping_state' => $this->input->post('shipping_state'),
			'shipping_pincode' => $this->input->post('shipping_po'),
			'shipping_country' => $this->input->post('shipping_country'),
			
			'cp_name' => $this->input->post("cp_name"),
			'cp_mobile' => $this->input->post("cp_mobile"),
			'cp_email' => $this->input->post("cp_email"),
			
			
			'sales_person'=>$this->input->post('user_id'),	
			'approval'=>0,		
		);		
		$this->db->where('quote_id',$qid);
		$this->db->update('sales_quotation_master', $data);
		
		$enqid=$this->input->post('enq_id');
		
		
		
		if($this->input->post('create_revision')!=1)
		{
		    $query=$this->db->query("select group_concat(trans_id)as res from sales_quotation_transaction where quote_master_id=$qid and trans_revision=$new_revision");
		    $trid= $query->row('res');
		    $query=$this->db->query("delete from sales_quotation_transaction where quote_master_id=$qid and trans_revision=$new_revision");
		    $query=$this->db->query("delete from sales_quotation_transaction2 where quote_master_id=$qid and trans_id1 in($trid)");
		    
		}		
		
		for ($i = 0; $i < count($_POST['desc']); $i++)
	        {	
		      $data = array(
			'quote_master_id' => $qid,
			'trans_revision' => $new_revision,
			'product_id' => $_POST['product_id'][$i],
			'quantity'  => $_POST['qty'][$i],	
			'balance_qty'=> $_POST['qty'][$i],	
			'price'  => $_POST['price'][$i],
			'dis_per'  => $_POST['dis_per'][$i],
			'dis_val'  => $_POST['dis_val'][$i],
			'total'  => $_POST['total'][$i],
		      );
		      $this->db->insert('sales_quotation_transaction', $data);
		      $trans_id1 = $this->db->insert_id();	
		      
		    //   $append_id=$_POST['append_id'][$i];
		    //   if(isset($_POST["sub_details$append_id"]))
		    //   {
			// for ($k = 0; $k < count($_POST["sub_details$append_id"]); $k++)
			// {	
			// 	$data = array(
			// 	'quote_master_id' => $qid,
			// 	'trans_id1' => $trans_id1,
			// 	'sub_details'  => $_POST["sub_details$append_id"][$k],
			// 	'qty'  => $_POST["qty$append_id"][$k],
			// 	);
			// 	$this->db->insert('sales_quotation_transaction2', $data);
			// }	
		    //   }   
	        }
                if(isset($_POST['new_product_id']))
	        {
		        for ($i = 0; $i < count($_POST['new_product_id']); $i++)
		        {
			      $data = array(
				'quote_master_id' => $qid,
				'trans_revision' => $new_revision,
				'product_id' => $_POST['new_product_id'][$i],
				'quantity'  => $_POST['new_qty'][$i],	
				'price'  => $_POST['new_price'][$i],
				'total'  => $_POST['new_total'][$i],
			      );
		      		$this->db->insert('sales_quotation_transaction', $data);
		      }
	        }
	        
		$qcode=$this->input->post('qcode');
		$data = array(
		'enq_id' => $this->input->post('enq_id'),
		'status' => "$qcode Quotation Revised ",
		'status_date' =>  date('Y-m-d H:i:s'),
		);
		$this->db->insert('sales_order_status', $data);
		
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_active_user_list();

		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,2,$page_name[1],'sales_quotation_master','quote_id',$qid);
		/* notification */ 
		foreach($data['user_records'] as $r)
		{
			$revision=$this->input->post('revision');
			$notice=add_notification($qid,$r->user_id,"$qcode Quotation Revised","sales/edit_quotation/$qid/$revision/0");
		}
		 /* end notification */
		return $insert_id;
	}
	
	function get_all_quotation_list()
	{
		$query=$this->db->query("select e.*, c.cust_code, c.cust_name,i.enquiry_code, i.enq_date, i.client_ref from sales_quotation_master  e, customer_master c,enquiry_master i  where e.customer_id=c.customer_id and e.enq_master_id=i.enquiry_id order by quotation_date desc, quotation_code desc");
		return $query->result();
	}
	function get_quotation_list()
	{
		$query=$this->db->query("select e.*, c.cust_code, c.cust_name,i.enquiry_code, i.enq_date, i.client_ref, i.enq_type from sales_quotation_master  e, customer_master c,enquiry_master i  where e.customer_id=c.customer_id and e.enq_master_id=i.enquiry_id and approval=0 order by quotation_date desc, quotation_code desc");
		return $query->result();
	}
	function get_pending_quotations()
	{
		$query=$this->db->query("select * from sales_quotation_master  e, customer_master c where e.customer_id=c.customer_id and approval=0 order by quotation_date desc");
		return $query->result();
	}
	function get_approved_quotations()
	{
		$query=$this->db->query("select e.*, c.cust_code, c.cust_name, u.user_name from sales_quotation_master  e, customer_master c, users u where e.customer_id=c.customer_id and e.approval_by=user_id and  approval in(1,2) and invoice_id=0 order by quotation_date desc,quotation_code desc");
		return $query->result();
	}
	function get_approved_quotations_for_ack()
	{
		$query=$this->db->query("select e.*, c.cust_code, c.cust_name, u.user_name from sales_quotation_master  e, customer_master c, users u where e.customer_id=c.customer_id and e.approval_by=user_id and  approval=1 and invoice_id=0 order by quotation_date desc,quotation_code desc");
		return $query->result();
	}
	function get_approved_quotations_for_invoice()
	{
		$query=$this->db->query("select e.*, c.cust_code, c.cust_name, u.user_name from sales_quotation_master  e, customer_master c, users u where e.customer_id=c.customer_id and e.approval_by=user_id and  approval=1 and invoice_id=0 order by quotation_date desc");
		return $query->result();
	}

	function get_approved_quotations_for_jobcard()
	{
		$query=$this->db->query("select e.quote_id,e.quotation_code,c.cust_name from sales_quotation_master e, customer_master c, users u,enquiry_master eq where e.customer_id=c.customer_id and e.approval_by=user_id and approval=1 and invoice_id=0 and eq.enq_type=2 and eq.enquiry_id=e.enq_master_id and (e.project_start_date is null or length(trim(e.project_start_date))=0) order by quotation_date desc");
		return $query->result();
	}
	
		function get_approved_quotations_for_po()
	{
		$query=$this->db->query("select e.*, c.cust_code, c.cust_name, u.user_name from sales_quotation_master  e, customer_master c, users u where e.customer_id=c.customer_id and e.approval_by=user_id and  approval=1 order by quote_id desc");
		return $query->result();
	}
	function get_quotation_master_by_id($id)
	{	
		$query=$this->db->query("select one.*, two.*, three.user_name, three.contact_no, four.currabrev from (select e.*,  c.cust_code, c.cust_name,c.trn_no, i.enquiry_code, i.enq_date, i.client_ref,i.enq_type from sales_quotation_master  e, customer_master c, enquiry_master i where e.customer_id=c.customer_id and e.enq_master_id=i.enquiry_id and quote_id='$id')as one left join(select * from company_bank_details)as two on(one.bank_id=two.bid) left join(select * from users)as three on(one.sales_person=three.user_id) left join(select id,currabrev from currency_master)as four on(one.currency_id=four.id)");
		return $query->result();
	}
	function ajax_get_quotation_price($qid)
	{	
		$query=$this->db->query("select (currency_rate*grand_total)as gtotal from sales_quotation_master where quote_id=$qid");
		return $query->row('gtotal');
	}
	function get_quotation_tr_by_id($id,$rev)
	{
		$query=$this->db->query("select * from sales_quotation_transaction sqt left join product_master pm on sqt.product_id = pm.product_id left join category_master cm on pm.prd_subcat = cm.category_id where quote_master_id='$id' and trans_revision='$rev' ");
		return $query->result();
	}
	function get_quotation2_tr_by_id($id)
	{
		$query=$this->db->query("select one.* from (select * from sales_quotation_transaction2  where quote_master_id='$id')as one ");
		// echo $this->db->last_query();exit;
		return $query->result();
	}
	function get_quotation_balance_tr_by_id($id,$rev)
	{
		$query = $this->db->query("SELECT sqt.*,pm.product_code,pm.product_description FROM sales_quotation_transaction AS sqt LEFT JOIN product_master AS pm ON sqt.product_id = pm.product_id WHERE sqt.quote_master_id = '$id' AND sqt.trans_revision = '$rev' AND sqt.balance_qty > 0 ORDER BY CAST(sqt.srn AS INTEGER), sqt.srn ASC;");
		//$query=$this->db->query("select * from sales_quotation_transaction  where quote_master_id='$id' and trans_revision= and balance_qty>0 order by cast(srn as integer),srn asc");
		return $query->result();
	}
	function add_quotation_approval($quot_id,$version)
	{
		$data = array(
		'approval' =>$this->input->post('status'),
		'approval_remark' => $this->input->post('approval_remark'),
		'approval_by' => $this->session->userdata('user_id'),
		'approval_date' => date('Y-m-d H:i:s'),
		);
		$this->db->where('quote_id',$quot_id);
		$res = $this->db->update('sales_quotation_master', $data);
		
		$allowedExts = array("jpeg","jpg","png","doc","pdf");
		$data['file_name']=$_FILES["po_file"]["name"];
		$temp = explode(".", $_FILES["po_file"]["name"]);
		$extension = end($temp);
		if (($_FILES["po_file"]["size"] < 15728640) && in_array($extension, $allowedExts))
		{
		      if ($_FILES["po_file"]["error"] > 0)
		      {
			$this->session->set_flashdata('error','Failed to upload - Please check file size and file format');
		      }
		      else
		      {
				$timestamp1=time();
				$file_tmp = $_FILES["po_file"]["tmp_name"];
				//$other_file = $timestamp1."_".$_FILES['po_file']['name'];	
				$other_file = $timestamp1."_POfile.".$extension;			
				move_uploaded_file($file_tmp,"/home/webadmin/gen/bsg_erp/public/uploded_documents/".$other_file);
				
				$data = array(
					'quote_master_id' => $quot_id,
					'doc_type' => "PO File",
					'doc_path' =>  $other_file,
				);
				$this->db->insert('quotation_documents', $data);
		      }
		} 
		
		$data['file_name']=$_FILES["drawing_file"]["name"];
		$temp = explode(".", $_FILES["drawing_file"]["name"]);
		$extension = end($temp);
		if (($_FILES["drawing_file"]["size"] < 15728640) && in_array($extension, $allowedExts))
		{
		      if ($_FILES["drawing_file"]["error"] > 0)
		      {
			$this->session->set_flashdata('error','Failed to upload - Please check file size and file format');
		      }
		      else
		      {
				$timestamp1=time();
				$file_tmp = $_FILES["drawing_file"]["tmp_name"];
				//$other_file = $timestamp1."_".$_FILES['po_file']['name'];	
				$other_file = $timestamp1."_Drawingfile.".$extension;			
				move_uploaded_file($file_tmp,"/home/webadmin/gen/bsg_erp/public/uploded_documents/".$other_file);
				
				$data = array(
					'quote_master_id' => $quot_id,
					'doc_type' => "Drawing File",
					'doc_path' =>  $other_file,
				);
				$this->db->insert('quotation_documents', $data);
		      }
		} 
			
		$details =$this->get_quotation_master_by_id($quot_id);
		foreach($details as $k)
		{
			$enq_id=$k->enq_master_id;
			$quotation_code=$k->quotation_code;
		}
		if($this->input->post('status')==1)
		$status='approved';
		else
		$status='Cancelled';
		if($res)
		{	
			$data = array(
			'enq_id' => $enq_id,
			'status' => "Quotation $status",
			'status_date' =>  date('Y-m-d H:i:s'),
			);
			$this->db->insert('sales_order_status', $data);
			
			$this->load->model('Users_model');
			$data['user_records']=$this->Users_model->get_active_user_list();
			
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,2,$page_name[1],'sales_quotation_master','quote_id',$quot_id);
			// /* notification */ 
			// foreach($data['user_records'] as $r)
   			// {
			// 	$notice=add_notification($insert_id,$r->user_id,"Quotation $status $quotation_code","sales/edit_quotation/$quot_id/$version/0");
			// }
			//  /* end notification */
			return true;
		}
		else
		{
			return false;
		}
	}
	function get_quote_documents_by_id($id)
	{
		$query=$this->db->query("select * from sales_quotation_master m, quotation_documents d  where m.quote_id=d.quote_master_id and d.quote_master_id='$id'");
		return $query->result();
	}
	function add_quotation_documents($quot_id)
	{
		$allowedExts = array("jpeg","jpg","png","doc","pdf");
		$data['file_name']=$_FILES["po_file"]["name"];
		$temp = explode(".", $_FILES["po_file"]["name"]);
		$extension = end($temp);
		if (($_FILES["po_file"]["size"] < 15728640) && in_array($extension, $allowedExts))
		{
		      if ($_FILES["po_file"]["error"] > 0)
		      {
			$this->session->set_flashdata('error','Failed to upload - Please check file size and file format');
		      }
		      else
		      {
				$timestamp1=time();
				$file_tmp = $_FILES["po_file"]["tmp_name"];
				//$other_file = $timestamp1."_".$_FILES['po_file']['name'];	
				$other_file = $timestamp1."_POfile.".$extension;			
				move_uploaded_file($file_tmp,"/home/webadmin/gen/bsg_erp/public/uploded_documents/".$other_file);
				
				$data = array(
					'quote_master_id' => $quot_id,
					'doc_type' => "PO File",
					'doc_path' =>  $other_file,
				);
				$this->db->insert('quotation_documents', $data);
		      		$insertid = $this->db->insert_id();	
		      }
		} 
		
		$data['file_name']=$_FILES["drawing_file"]["name"];
		$temp = explode(".", $_FILES["drawing_file"]["name"]);
		$extension = end($temp);
		if (($_FILES["drawing_file"]["size"] < 15728640) && in_array($extension, $allowedExts))
		{
		      if ($_FILES["drawing_file"]["error"] > 0)
		      {
			$this->session->set_flashdata('error','Failed to upload - Please check file size and file format');
		      }
		      else
		      {
				$timestamp1=time();
				$file_tmp = $_FILES["drawing_file"]["tmp_name"];
				//$other_file = $timestamp1."_".$_FILES['po_file']['name'];	
				$other_file = $timestamp1."_Drawingfile.".$extension;			
				move_uploaded_file($file_tmp,"/home/webadmin/gen/bsg_erp/public/uploded_documents/".$other_file);
				
				$data = array(
					'quote_master_id' => $quot_id,
					'doc_type' => "Drawing File",
					'doc_path' =>  $other_file,
				);
				$this->db->insert('quotation_documents', $data);
		      		$insertid = $this->db->insert_id();	
		      }
		} 
			
		
		if($other_file)
		{	
			
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'quotation_documents','sno',$insertid);
			return true;
		}
		else
		{
			return false;
		}
	}
	//////// invoice//////////
	
	function add_invoice_data()
	{
		$type = $this->input->post('inv_type');
  		$prifix=$type.date('y');
   		//$lnt= strlen($prifix)+2;
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'invoice_code','invoice_master',7)+1;		
		$digit=sprintf("%1$04d",$num);
		$code =$prifix.date('m').$digit;

		$data = array(
			'invoice_code' => $this->input->post('invcode'),
			'inv_type' => $this->input->post('inv_type'),
			'invoice_date' => date('Y-m-d',strtotime($this->input->post('invdate'))),
			'enq_id' => $this->input->post('enq_id'),
			'quote_id' => $this->input->post('qid'),
			'customer_id' => $this->input->post('customer_id'),
			'delivery_to'=>$this->input->post('customer_id'),
			
			'sub_total' => $this->input->post('sub_total'),
			'discount_percent' =>$this->input->post('discount'),
			'discount_amt' => $this->input->post('discount_amt'),
			'vat_amt' => $this->input->post('vat_amt'),
			'vat_percent' => $this->input->post('vat_percent'),
			// 'other1' => $this->input->post('miscellaneous1'),
			// 'other1_amt' => $this->input->post('miscellaneous_amt1'),
			// 'other2' => $this->input->post('miscellaneous2'),
			// 'other2_amt' => $this->input->post('miscellaneous_amt2'),
			// 'other3' => $this->input->post('miscellaneous3'),
			// 'other3_amt' => $this->input->post('miscellaneous_amt3'),			
			'grand_total' => $this->input->post('grand_total'),			
			'currency_id' =>$this->input->post('cid'),
			'currency_rate' => $this->input->post('crate'),
			
			'hs_code' => $this->input->post('hs_code'),
			'po_number' => $this->input->post('po_number'),
			'catalyst_ref_no' => $this->input->post('ref_no'),
			'paid_amt' => $this->input->post('received_amt'),
			'received_percent' => $this->input->post('received_percent'),
			'payment_mode' => $this->input->post('payment_mode'),
			'payment_term' => $this->input->post('term1'),			
			'delivery_term' => $this->input->post('term2'),
			'manufacture' => $this->input->post('manufacture'),
			'origin' => $this->input->post('origin'),
			'bank_id' =>  $this->input->post('bank'),	
			'sales_person'=>$this->input->post('user_id'),	
			// 'stamp_id'=>$this->input->post('stamp'),	
			'created_by' => $this->session->userdata('user_id'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('invoice_master', $data);
		
		$insert_id = $this->db->insert_id();
		
		$data = array(
			'invoice_id' => $insert_id,
			'billing_addr' => $this->input->post('billing_addr1'),
			'billing_city' => $this->input->post('billing_city'),
			'billing_state' => $this->input->post('billing_state'),
			'billing_pincode' => $this->input->post('billing_po'),
			'billing_country' => $this->input->post('billing_country'),
			
			'shipping_addr' => $this->input->post('shipping_addr1'),
			'shipping_city' => $this->input->post('shipping_city'),
			'shipping_state' => $this->input->post('shipping_state'),
			'shipping_pincode' => $this->input->post('shipping_po'),
			'shipping_country' => $this->input->post('shipping_country'),
			
			'cp_name' => $this->input->post("cp_name"),
			'cp_mobile' => $this->input->post("cp_mobile"),
			'cp_email' => $this->input->post("cp_email"),
		);
		$this->db->insert('invoice_details', $data);
		
		if($insert_id)
		{
			for ($i = 0; $i < count($_POST['desc']); $i++)
		        {	
			      $data = array(
				'inv_master_id' => $insert_id,
				'product_id' => $_POST['product_id'][$i],
				'item_desc'  => $_POST['desc'][$i],
				'quantity'  => $_POST['qty'][$i],							
				'balance_qty'  => $_POST['qty'][$i],
				'unit'  => $_POST['unit'][$i],
				'price'  => $_POST['price'][$i],
				'dis_per'  => $_POST['dis_per'][$i],
				'total'  => $_POST['total'][$i],
				// 'item_remark'  => $_POST['item_remark'][$i],
			      );
			      $this->db->insert('invoice_transaction', $data);	
			      $trans_id1 = $this->db->insert_id();	
			      if($type=='TI')
			      {
			      	$trans_id=$_POST['trans_id'][$i];
			      	$bal_qty=0;
					$query=$this->db->query("update sales_quotation_transaction set balance_qty='$bal_qty' where trans_id=$trans_id");
			      }
			      $append_id=$_POST['append_id'][$i];
			      if(isset($_POST["sub_details$append_id"]))
			      {
				for ($k = 0; $k < count($_POST["sub_details$append_id"]); $k++)
				{	
					$data = array(
					'inv_master_id' => $insert_id,
					'trans_id1' => $trans_id1,
					'sub_details'  => $_POST["sub_details$append_id"][$k],
					'qty'  => $_POST["qty$append_id"][$k],
					);
					$this->db->insert('invoice_transaction2', $data);
				}	
			      }      
		        }
		        	 
			$enqid= $this->input->post('enq_id');
			$revision= $this->input->post('revision');
			$qid=$this->input->post('qid');
			$query=$this->db->query("update enquiry_master set order_status=2 where enquiry_id=$enqid");
			if($type=='TI')
			{
				/// unblocking stock//////////////////
				$qqid=$this->input->post('qid');
				$query=$this->db->query("update stock_details set allocation='0', allocation_for='0' where stock_type='IN' and status='0' and allocation_for=$qqid and allocation='1'");
				
				$query=$this->db->query("select sum(balance_qty)as bal from sales_quotation_transaction where quote_master_id=$qid and trans_revision=$revision");
				$balance_qty= $query->row('bal');
				if($balance_qty==0)
				{				
				   $query=$this->db->query("update sales_quotation_master set invoice_id=$insert_id where quote_id=$qid");
				}
				// add code for Voucher entry here ///
				
					$AccountCode =$this->input->post('invcode');  
					      
					$vdate=$this->input->post('invdate');
					$vtime=date('h:i:s');
					
					/// debit entry 
					for($i=0;$i<count($_POST['inv_debtor']);$i++)
					{
						$debtor=$_POST['inv_debtor'][$i];
						$dr_amount=$_POST['inv_dr_amount'][$i];
						if($dr_amount>0)
						{
						$data = array(
							'voucher_code' =>$AccountCode,
							'voucher_date' => date('Y-m-d h:i:s',strtotime("$vdate $vtime")),
							'voucher_type' => 'S',  /// Sales invoice  entry
							'customer_id' => $this->input->post('customer_id'),
							'account_id' => $debtor,
							'amount' => $dr_amount,
							'drcr_type' => 'Dr',
							//'narration' => $this->input->post('narration'),
							'trans_id' => $insert_id,
							'trans_type'=>'S',
							'recordCreatedBy'=>$this->session->userdata('user_id')
						);
						$this->db->insert('voucher_transaction',$data);
						$vid = $this->db->insert_id();
						}
					}
					
					// credit entry
					for($i=0;$i<count($_POST['inv_creditor']);$i++)
					{
						$creditor=$_POST['inv_creditor'][$i];
						$cr_amount=$_POST['inv_cr_amount'][$i];
						if($cr_amount>0)
						{
						$data = array(
							'voucher_code' =>$AccountCode,
							'voucher_date' => date('Y-m-d h:i:s',strtotime("$vdate $vtime")),
							'voucher_type' => 'S',  /// Sales invoice  entry
							'customer_id' => $this->input->post('customer_id'),
							'account_id' => $creditor,
							'amount' => $cr_amount,
							'drcr_type' => 'Cr',
							//'narration' => $this->input->post('narration'),
							'trans_id' => $insert_id,
							'trans_type'=>'S',
							'recordCreatedBy'=>$this->session->userdata('user_id')
						);
						$this->db->insert('voucher_transaction',$data);
						$vid = $this->db->insert_id();
						}
					}
					      
				      if($vid) {
					$user_se_id=$this->session->userdata('session_id');
				  	$uid = $this->session->userdata('user_id');
					$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
					$ci = get_instance();
					$ci->load->helper('log');
					$log_msg=add_log_entry($uid,1,$page_name[1],'voucher_transaction','voucher_id',$vid);
					return $insert_id;
				      }
			}		
			
			$data = array(
			'enq_id' => $enqid,
			'status' => "Invoice generated $code",
			'status_date' =>  date('Y-m-d H:i:s'),
			);
			$this->db->insert('sales_order_status', $data);
			
			$this->load->model('Users_model');
			$data['user_records']=$this->Users_model->get_active_user_list();
      
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'invoice_master','invoice_id',$insert_id);
			/* notification */ 
			foreach($data['user_records'] as $r)
   			{
				$notice=add_notification($insert_id,$r->user_id,"$type Invoice generated $code","sales/edit_invoice/$insert_id/0");
			}
			 /* end notification */
		}
		return $insert_id;
	}
	function update_invoice_data($inv_id)
	{	
		$type = $this->input->post('inv_type');
		
		$data = array(
			'delivery_to'=>$this->input->post('customer_id'),
			'sub_total' => $this->input->post('sub_total'),
			'vat_amt' => $this->input->post('vat_amt'),
			'vat_percent' => $this->input->post('vat_percent'),
			'discount_percent' =>$this->input->post('discount'),
			'discount_amt' => $this->input->post('discount_amt'),
			'other1' => $this->input->post('miscellaneous1'),
			'other1_amt' => $this->input->post('miscellaneous_amt1'),
			'other2' => $this->input->post('miscellaneous2'),
			'other2_amt' => $this->input->post('miscellaneous_amt2'),
			'other3' => $this->input->post('miscellaneous3'),
			'other3_amt' => $this->input->post('miscellaneous_amt3'),
			'grand_total' => $this->input->post('grand_total'),
			'currency_id' =>$this->input->post('cid'),
			'currency_rate' => $this->input->post('crate'),
			
			'hs_code' => $this->input->post('hs_code'),
			'po_number' => $this->input->post('po_no'),
			'catalyst_ref_no' => $this->input->post('catalyst_ref'),
			'paid_amt' => $this->input->post('received_amt'),
			'received_percent' => $this->input->post('received_percent'),
			'payment_mode' => $this->input->post('payment_mode'),
			'payment_term' => $this->input->post('term1'),			
			'delivery_term' => $this->input->post('term2'),
			'manufacture' => $this->input->post('manufacture'),
			'origin' => $this->input->post('origin'),
			'bank_id' =>  $this->input->post('bank'),	
			'sales_person'=>$this->input->post('user_id'),	
			'stamp_id'=>$this->input->post('stamp'),		
		);		
		$this->db->where('invoice_id',$inv_id);
		$this->db->update('invoice_master', $data);
		
		
	        $query=$this->db->query("delete from invoice_details where invoice_id=$inv_id ");
	        if($this->input->post('cp_select')!='')
	        {
	        	$cp_select= $this->input->post('cp_select');
			$cp_name = $this->input->post("cp_name$cp_select");
			$cp_mobile = $this->input->post("cp_mobile$cp_select");
			$cp_email = $this->input->post("cp_email$cp_select");
	        }
	        else
	        {
			$cp_name = $this->input->post("cp_name");
			$cp_mobile = $this->input->post("cp_mobile");
			$cp_email = $this->input->post("cp_email");
	        }
		$data = array(
			'invoice_id' => $inv_id,
			'billing_addr' => $this->input->post('billing_addr1'),
			'billing_city' => $this->input->post('billing_city'),
			'billing_state' => $this->input->post('billing_state'),
			'billing_pincode' => $this->input->post('billing_po'),
			'billing_country' => $this->input->post('billing_country'),
			
			'shipping_addr' => $this->input->post('shipping_addr1'),
			'shipping_city' => $this->input->post('shipping_city'),
			'shipping_state' => $this->input->post('shipping_state'),
			'shipping_pincode' => $this->input->post('shipping_po'),
			'shipping_country' => $this->input->post('shipping_country'),
			
			'cp_name' => $cp_name,
			'cp_mobile' => $cp_mobile,
			'cp_email' => $cp_email,
		);
		$this->db->insert('invoice_details', $data);
		
	        $query=$this->db->query("delete from invoice_transaction where inv_master_id=$inv_id ");
		
		for ($i = 0; $i < count($_POST['order_code']); $i++)
	        {	
		      $data = array(
			'inv_master_id' => $inv_id,
			'srn' => $_POST['srn'][$i],
			'product_id' => $_POST['product_id'][$i],
			'order_code' => $_POST['order_code'][$i],
			'item_desc'  => $_POST['desc'][$i],
			'ordered_qty'  => $_POST['ordered_qty'][$i],
			'quantity'  => $_POST['qty'][$i],
			//'balance_qty'  => $_POST['qty'][$i],
			'price'  => $_POST['price'][$i],
			'total'  => $_POST['total'][$i],
			'size'  => $_POST['size'][$i],
			'status'=>$_POST['type'][$i],
		      );
		      $this->db->insert('invoice_transaction', $data);
	        }		        
	        	       

		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,2,$page_name[1],'invoice_master','invoice_id',$qid);
		
		return $insert_id;
	}
	function add_dummy_invoice_data()
	{
  		$prifix='DI'.date('y');
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'invoice_code','invoice_master',7)+1;		
		$digit=sprintf("%1$04d",$num);
		$code =$prifix.date('m').$digit;

		$data = array(
			'invoice_code' => $this->input->post('invcode'),
			'inv_type' => 'DI',
			'invoice_date' => date('Y-m-d',strtotime($this->input->post('invdate'))),
			'enq_id' => $this->input->post('enq_id'),
			'quote_id' => $this->input->post('quote_id'),
			'customer_id' => $this->input->post('customer_id'),
			'delivery_to'=>$this->input->post('customer_id'),
			
			'sub_total' => $this->input->post('sub_total'),
			'discount_percent' =>$this->input->post('discount'),
			'discount_amt' => $this->input->post('discount_amt'),
			'vat_amt' => $this->input->post('vat_amt'),
			'vat_percent' => $this->input->post('vat_percent'),
			'other1' => $this->input->post('miscellaneous1'),
			'other1_amt' => $this->input->post('miscellaneous_amt1'),
			'other2' => $this->input->post('miscellaneous2'),
			'other2_amt' => $this->input->post('miscellaneous_amt2'),
			'other3' => $this->input->post('miscellaneous3'),
			'other3_amt' => $this->input->post('miscellaneous_amt3'),			
			'grand_total' => $this->input->post('grand_total'),			
			'currency_id' =>$this->input->post('cid'),
			'currency_rate' => $this->input->post('crate'),
			
			'hs_code' => $this->input->post('hs_code'),
			'po_number' => $this->input->post('po_no'),
			'catalyst_ref_no' => $this->input->post('catalyst_ref'),
			//'paid_amt' => $this->input->post('received_amt'),
			//'received_percent' => $this->input->post('received_percent'),
			//'payment_mode' => $this->input->post('payment_mode'),
			'payment_term' => $this->input->post('term1'),			
			'delivery_term' => $this->input->post('term2'),
			'manufacture' => $this->input->post('manufacture'),
			'origin' => $this->input->post('origin'),
			'bank_id' =>  $this->input->post('bank'),	
			'sales_person'=>$this->input->post('user_id'),	
			'stamp_id'=>$this->input->post('stamp'),	
			'created_by' => $this->session->userdata('user_id'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('invoice_master', $data);
		$insert_id = $this->db->insert_id();

		$data = array(
			'invoice_id' => $insert_id,
			'billing_addr' => $this->input->post('billing_addr1'),
			'billing_city' => $this->input->post('billing_city'),
			'billing_state' => $this->input->post('billing_state'),
			'billing_pincode' => $this->input->post('billing_po'),
			'billing_country' => $this->input->post('billing_country'),
			
			'shipping_addr' => $this->input->post('shipping_addr1'),
			'shipping_city' => $this->input->post('shipping_city'),
			'shipping_state' => $this->input->post('shipping_state'),
			'shipping_pincode' => $this->input->post('shipping_po'),
			'shipping_country' => $this->input->post('shipping_country'),
			
			'cp_name' => $this->input->post("cp_name"),
			'cp_mobile' => $this->input->post("cp_mobile"),
			'cp_email' => $this->input->post("cp_email"),
		);
		$this->db->insert('invoice_details', $data);
		
		if($insert_id)
		{
			
			for ($i = 0; $i < count($_POST['order_code']); $i++)
		        {	
			      $data = array(
				'inv_master_id' => $insert_id,
				'srn' => $_POST['srn'][$i],
				'product_id' => $_POST['product_id'][$i],
				'order_code' => $_POST['order_code'][$i],
				'item_desc'  => $_POST['desc'][$i],
				'size'  => $_POST['size'][$i],
				'ordered_qty'  => $_POST['ordered_qty'][$i],
				'quantity'  => $_POST['qty'][$i],
				//'balance_qty'  => $_POST['qty'][$i],
				'price'  => $_POST['price'][$i],
				'total'  => $_POST['total'][$i],
				'status'=>$_POST['type'][$i],
			      );
			      $this->db->insert('invoice_transaction', $data);
		        }
			
			$this->load->model('Users_model');
			$data['user_records']=$this->Users_model->get_active_user_list();
      
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'invoice_master','invoice_id',$insert_id);
			/* notification */ 
			foreach($data['user_records'] as $r)
   			{
				$notice=add_notification($insert_id,$r->user_id,"Dummy Invoice generated $code","sales/edit_invoice/$insert_id/0");
			}
			 /* end notification */
		}
		return $insert_id;
	}
	function get_invoice_list()
	{
		$query=$this->db->query("select e.*,  m.quotation_code, quotation_date, c.cust_name from invoice_master  e, customer_master c, enquiry_master i, sales_quotation_master m where e.customer_id=c.customer_id and e.enq_id=i.enquiry_id and e.quote_id=m.quote_id order by invoice_date desc, invoice_code desc");
		return $query->result();
	}
	function get_tax_invoice_list()
	{
		$query=$this->db->query("select * from invoice_master  e, customer_master c, enquiry_master i where e.customer_id=c.customer_id and e.enq_id=i.enquiry_id and inv_type in('TI','DI') and fully_delivered=0 order by invoice_date desc");
		return $query->result();
	}
	
	function get_invoice_master_by_id($id)
	{	
		$query=$this->db->query("select one.*, two.*, three.user_name, three.contact_no, four.currabrev, five.cp_name, five.cp_mobile, five.cp_email, five.billing_addr, five.billing_city, five.billing_state, five.billing_pincode, five.billing_country, five.shipping_addr, five.shipping_city, five.shipping_pincode, five.shipping_country,five.shipping_state, six.stamp_image from (select e.*, em.project_name, project_location, enquiry_code, enq_date,c.cust_name, c.trn_no, m.quotation_code, m.quotation_date, m.revision from invoice_master  e, customer_master c, sales_quotation_master m, enquiry_master em where e.delivery_to=c.customer_id and e.quote_id=m.quote_id and e.enq_id=em.enquiry_id and e.invoice_id='$id')as one left join(select * from company_bank_details)as two on(one.bank_id=two.bid)  left join(select * from users)as three on(one.sales_person=three.user_id) left join(select id,currabrev from currency_master)as four on(one.currency_id=four.id) left join(select * from invoice_details)as five on(one.invoice_id=five.invoice_id) left join(select * from company_stamp_image)as six on(one.stamp_id=six.img_id)");
		return $query->result();
	}
	function get_invoice_tr_by_id($id)
	{
		$query=$this->db->query("select * from invoice_transaction  where inv_master_id='$id' order by cast(srn as integer) asc ");
		return $query->result();
	}
	function get_invoice_balance_tr_by_id($id)
	{
		$query=$this->db->query("select * from invoice_transaction  where inv_master_id='$id' and fully_delivered=0 ");
		return $query->result();
	}
	function get_invoice_master_for_warranty_by_id($id)
	{	
		$query=$this->db->query("select one.*, five.cp_name from (select e.*,c.cust_name from invoice_master e, customer_master c where e.delivery_to=c.customer_id and e.invoice_id='$id')as one left join(select * from invoice_details)as five on(one.invoice_id=five.invoice_id);");
		return $query->result();
	}
	
	///aacount receipt related entry
	function get_invoice_amount($id)
	{
		$query=$this->db->query("select * from (select grand_total from invoice_master where invoice_id='$id')as one left join(select coalesce(sum(amount),0)as amount from voucher_transaction  where voucher_type='R' and trans_id=$id and drcr_type='Cr')as two on(1=1) ");
		return $query->result();
	}
	function delete_invoice($invoice_id,$quote_id)
	{
		
		$query=$this->db->query("select count(*)as tcnt from delivery_order where invoice_id='$invoice_id'");
		$tcnt = $query->row('tcnt');
		if($tcnt==0)
		{
			$query=$this->db->query("delete from invoice_transaction where inv_master_id='$invoice_id'");
			$query=$this->db->query("delete from invoice_details where invoice_id='$invoice_id'");
			$query=$this->db->query("delete from invoice_master where invoice_id='$invoice_id'");
			
			$query=$this->db->query("update sales_quotation_master set invoice_id=0 where quote_id=$quote_id");
			$query=$this->db->query("update voucher_transaction set cancel=1 where trans_id=$invoice_id and voucher_type='S'");
			
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,3,$page_name[1],'invoice_master','invoice_id',$invoice_id);
			return 1;
		}
		else 
			return 0;
	}
	/////////// delivery ///////////
	function add_dc_data()
	{
		$inv_id=$this->input->post('invoice_id');
  		$prifix='BES/DO/'.date('y');
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'dc_code','delivery_order',9)+1;
		$digit=sprintf("%1$04d",$num);
		$code =$prifix.date('m').$digit;
		
		$data = array(
			'dc_code' => $code,
			//'dc_type' => $this->input->post('inv_type'),
			'dc_date' => date('Y-m-d',strtotime($this->input->post('invdate'))),
			'invoice_id' => $this->input->post('invoice_id'),
			'enq_id' => $this->input->post('enq_id'),
			'quote_id' => $this->input->post('quote_id'),
			'customer_id' => $this->input->post('customer_id'),
			'stamp_id'=>$this->input->post('stamp'),	
			'created_by' => $this->session->userdata('user_id'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('delivery_order', $data);
		$insert_id = $this->db->insert_id();
		
		$enqid= $this->input->post('enq_id');
		$invoice_id=$this->input->post('invoice_id');
		$query=$this->db->query("update enquiry_master set order_status=3 where enquiry_id=$enqid");		
		$query=$this->db->query("update invoice_master set fully_delivered=1 where invoice_id=$inv_id");
		if($insert_id)
		{			
			for ($i = 0; $i < count($_POST['desc']); $i++)
		        {	
		             $condition="";
			      $data = array(
				'dc_master_id' => $insert_id,
				//'srn' => $_POST['srn'][$i],
				'item_desc'  => $_POST['desc'][$i],
				'ordered_qty'  => $_POST['qty'][$i],
				'quantity'  => $_POST['delivered_qty'][$i],
				'delivery_status'  => 'F',
			      );
			      $this->db->insert('delivery_order_transaction', $data);
		        
		        }
		        
			$data = array(
			'enq_id' => $enqid,
			'status' => "Delivery Order generated  $code",
			'status_date' =>  date('Y-m-d H:i:s'),
			);
			$this->db->insert('sales_order_status', $data);
			
			$this->load->model('Users_model');
			$data['user_records']=$this->Users_model->get_active_user_list();
      
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'delivery_order','dc_id',$insert_id);
			/* notification */ 
			foreach($data['user_records'] as $r)
   			{
				$notice=add_notification($insert_id,$r->user_id,"Delivery Order generated $code","sales/edit_delivery_order/$insert_id/0");
			}
			 /* end notification */
		}
		return $insert_id;
	}
	
	function update_dc_data($id)
	{
		$data = array(
			'dc_date' => date('Y-m-d',strtotime($this->input->post('invdate'))),
		);	
		$this->db->where('dc_id',$id);
		$this->db->update('delivery_order', $data);
		
		for ($i = 0; $i < count($_POST['desc']); $i++)
	        {	
	             $condition="";
		      /*$data = array(
			'dc_master_id' => $insert_id,
			//'case_no' => $_POST['case_box'][$i],
			'srn' => $_POST['srn'][$i],
			'size' => $_POST['size'][$i],
			'order_code'  => $_POST['order_code'][$i],
			'item_desc'  => $_POST['desc'][$i],
			'ordered_qty'  => $_POST['qty'][$i],
			'quantity'  => $_POST['delivered_qty'][$i],
			'delivery_status'  => $_POST['type'][$i],
		      );
		      $this->db->insert('delivery_order_transaction', $data);*/
		      
	         }
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,2,$page_name[1],'delivery_order','dc_id',$id);
			
		return $id;
	}
	
	function get_dc_list()
	{
		$query=$this->db->query("select * from delivery_order  e, customer_master c, invoice_master i where e.customer_id=c.customer_id and e.invoice_id=i.invoice_id order by dc_id desc");
		return $query->result();
	}
	
	function get_dc_master_by_id($id)
	{	
		$query=$this->db->query("select one.*,two.*, three.user_name, three.contact_no, four.ptype, five.cp_name, five.cp_mobile, five.cp_email, five.billing_addr, five.billing_city, five.billing_state, five.billing_pincode, five.billing_country, five.shipping_addr, five.shipping_city, five.shipping_pincode, five.shipping_country,five.shipping_state, six.stamp_image from (select dc_id,d.dc_code,dc_date,e.*, c.cust_name, c.trn_no,packing_id, total_case,volume_unit, m.quotation_code, m.quotation_date from delivery_order d, invoice_master  e, customer_master c, sales_quotation_master m where d.invoice_id=e.invoice_id and e.customer_id=c.customer_id and e.quote_id=m.quote_id  and d.dc_id='$id')as one left join(select * from company_bank_details)as two on(one.bank_id=two.bid) left join(select * from users)as three on(one.sales_person=three.user_id)  left join(select * from packing_type)as four on(one.packing_id=four.sno) left join(select * from invoice_details)as five on(one.invoice_id=five.invoice_id) left join(select * from company_stamp_image)as six on(one.stamp_id=six.img_id)");
		return $query->result();
	}
	function get_dc_tr_by_id($id)
	{
		$query=$this->db->query("select * from delivery_order_transaction  where dc_master_id='$id' order by cast(srn as integer) asc");
		return $query->result();
	}
	
	function get_quote_list_for_FAT()
	{
		$query=$this->db->query("select q.*, m.cust_name from sales_quotation_master q, customer_master m  where q.customer_id=m.customer_id and project_status='Ready for FA' ");
		return $query->result();
	}
	
	function delete_issued_stock($do_id,$model_code)
	{
		$query=$this->db->query("delete from stock_details where dc_id='$do_id' and model_code='$model_code' and stock_type='OUT' and remark='Delivery Order'");
		
		$this->db->query("update stock_details set status='0', dc_id=0 where stock_type='IN' and dc_id=$do_id and status='issued' and model_code='$model_code'");
		
		return true;
	}
	function delete_dc_record($do_id,$invoice_id)
	{
		$query=$this->db->query("select count(*)as tcnt from packing_order where do_id='$do_id'");
		$tcnt = $query->row('tcnt');
		if($tcnt==0)
		{
			$query=$this->db->query("delete from delivery_order_transaction where dc_master_id='$do_id'");
			$query=$this->db->query("delete from delivery_order where dc_id='$do_id'");
			//$query=$this->db->query("delete from stock_details where trans_id='$do_id' and stock_type='OUT' and remark='Delivery Order'");
			//$query=$this->db->query("update stock_details set status='0' where stock_type='IN' and status='issued' and dc_id='$do_id'");
			
			$query=$this->db->query("update invoice_master set fully_delivered=0 where invoice_id=$invoice_id");
			
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,3,$page_name[1],'delivery_order','dc_id',$do_id);
			return 1;
		}
		else 
			return 0;
	}
	/////////// Packing list order ///////////
	function add_packing_list_data()
	{
		$data = array(
			'inspection_date' => date('Y-m-d',strtotime($this->input->post('Inspectiondate'))),
			'customer_id' => $this->input->post('customer_id'),
			'quote_id' => $this->input->post('quot_id'),
			'no_of_panels' => $this->input->post('PANELS'),
			'remark' => $this->input->post('remark'),	
			'stamp_id' => $this->input->post('stamp'),	
			'created_by' => $this->session->userdata('user_id'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('FAT_master', $data);
		$insert_id = $this->db->insert_id();
		
		$quote_id= $this->input->post('quot_id');
		$query=$this->db->query("update sales_quotation_master set project_status='FAT Created' where quote_id=$quote_id");
		if($insert_id)
		{	
		
			for ($c = 0; $c < count($_POST['test_result']); $c++)
		        {		
			        $data = array(
					'fat_master_id' => $insert_id,
					'test_type'=>'VISUAL INSPECTION',
					'test_id'=>$c+1,
					'finished_status' => $_POST["test_result"][$c],
					'finished_remark' => $_POST["testremark"][$c],
			      );
		      	    $this->db->insert('FAT_details', $data);
			}
			for ($c = 0; $c < count($_POST['test_result1']); $c++)
		        {		
			        $data = array(
					'fat_master_id' => $insert_id,
					'test_type'=> 'ELECTRICAL FUNCTION TEST',
					'test_id'=> $c+1,
					'finished_status' => $_POST["test_result1"][$c],
					'finished_remark' => $_POST["testremark1"][$c],
			      );
		      	    $this->db->insert('FAT_details', $data);
			}
	         }
		$data = array(
		'quot_master_id' => $this->input->post('quot_id'),
		'project_status'  => 'FAT Created',
		'created_by'    => $this->session->userdata('user_id'),
		'created_date'  => date('Y-m-d h:i:s'),
		);
		$this->db->insert('project_status', $data);
		
		$enquiry_id= $this->input->post('enquiry_id');  
		$data = array(
		'enq_id' => $enquiry_id,
		'status' => "FAT Data generated",
		'status_date' =>  date('Y-m-d H:i:s'),
		);
		$this->db->insert('sales_order_status', $data);
		
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_active_user_list();

		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'FAT_master','fat_id',$insert_id);
		/* notification */ 
		foreach($data['user_records'] as $r)
		{
			$notice=add_notification($insert_id,$r->user_id,"FAT Data generated $code","sales/edit_packing_list/$insert_id/0");
		}
		 /* end notification */
		return $insert_id;
	}
	function update_packing_list_data($id)
	{
		$data = array(
			'no_of_panels' => $this->input->post('PANELS'),
			'remark' => $this->input->post('remark'),	
		);	
		$this->db->where('fat_id',$id);
		$this->db->update('FAT_master', $data);
		
		$query=$this->db->query("delete from  FAT_details where fat_master_id=$id");	
		
		for ($c = 0; $c < count($_POST['test_result']); $c++)
	        {		
		        $data = array(
				'fat_master_id' => $id,
				'finished_status' => $_POST["test_result"][$c],
				'finished_remark' => $_POST["testremark"][$c],
		      );
	      	    $this->db->insert('FAT_details', $data);
		  }			
			
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,2,$page_name[1],'FAT_master','fat_id',$id);
			
		return $id;
	}
	function get_pl_list()
	{
		$query=$this->db->query("select * from FAT_master  e, customer_master c, sales_quotation_master i where e.customer_id=c.customer_id and e.quote_id=i.quote_id order by inspection_date desc");
		return $query->result();
	}
	
	function get_pl_master_by_id($id)
	{	
		$query=$this->db->query("select one.*,two.*, three.user_name, three.contact_no, cp_name, cp_mobile, cp_email, billing_addr, billing_city, billing_state, billing_pincode, billing_country, shipping_addr, shipping_city, shipping_pincode, shipping_country,shipping_state, six.stamp_image from (select fat_id, d.inspection_date,no_of_panels, d.remark as fatremark,d.stamp_id, c.cust_name, m.*, t.project_name, t.enquiry_code, project_location, t.client_ref from FAT_master d, customer_master c, sales_quotation_master m,enquiry_master t where m.customer_id=c.customer_id and d.quote_id=m.quote_id and t.enquiry_id=m.enq_master_id and d.fat_id='$id')as one left join(select * from company_bank_details)as two on(one.bank_id=two.bid) left join(select * from users)as three on(one.sales_person=three.user_id) left join(select * from company_stamp_image)as six on(one.stamp_id=six.img_id)");
		return $query->result();
	}
	function get_pl_tr_by_id($id)
	{
		$query=$this->db->query("select one.*, two.rowcnt, three.net_wt ,gross_wt,volume,diamention from (select * from packing_order_transaction  where pl_master_id='$id' order by cast(srn as integer) asc)as one left join(select count(*) as rowcnt, case_no from packing_order_transaction  where pl_master_id='$id' group by case_no)as two on(one.case_no=two.case_no) left join(select  net_wt ,gross_wt,volume,diamention,case_no from packing_order_details where pl_master_id='$id')as three on(three.case_no=two.case_no) ");
		return $query->result();
	}
	
	function get_pl_details_by_id($id)
	{
		$query=$this->db->query("select *  from FAT_details  where fat_master_id='$id' ");
		return $query->result();
	}
	function delete_PL_record($pl_id)
	{
		$query=$this->db->query("delete from FAT_details where fat_master_id='$pl_id'");
		$query=$this->db->query("delete from FAT_master where fat_id='$pl_id'");
		
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,3,$page_name[1],'FAT_master','fat_id',$pl_id);
		return 1;
		
	}
	
	//////////// job card///////////
	////////////////////////////////////////////////////////
  function save_job_card()
  {
	$prifix='JOB'.date('y');
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'jcode','job_card',6)+1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.$digit;

	$data = array(
		'jcode' =>$data['Code'],
		'card_date' => date('Y-m-d',strtotime($this->input->post('carddate'))),
		'quot_master_id' => $this->input->post('quot_id'),
		'version'  => $this->input->post('revision'),
		'customer_id'  => $this->input->post('customer_id'),
		'remark'  => $this->input->post('note'),
		'created_by'    => $this->session->userdata('user_id'),
		'created_date'  => date('Y-m-d h:i:s'),
		'job_nature'=> $this->input->post('job_nature'),
		'status'=> $this->input->post('pstatus'),
		'job_start_date'=> date('Y-m-d',strtotime($this->input->post('start_date'))),
		'job_end_date'=> date('Y-m-d',strtotime($this->input->post('end_date'))),
		'project_name' => $this->input->post('project_name')
	);
	$this->db->insert('job_card', $data);
	$insert_id = $this->db->insert_id();
	if ($insert_id)
	{
		for ($i = 0; $i < count($_POST['prod_desc']); $i++){
			$data = array(
				'jobcard_no' => $_POST['code'],
				'prod_srno' => $_POST['srn'][$i],
				'prod_description' => $_POST['prod_desc'][$i],
				'prod_qty' => $_POST['prod_qty'][$i],
				'jcard_id' => $insert_id
				
			);
			//echo '<pre>';print_r($data);exit;
			$this->db->insert('jobcard_details', $data);
		}
	}
	
	$sdate=  date('Y-m-d',strtotime($this->input->post('start_date')));
	$edate=  date('Y-m-d',strtotime($this->input->post('end_date')));
	$pstatus=$this->input->post('pstatus');
	$qid=$this->input->post('quot_id');
	
	$query=$this->db->query("update sales_quotation_master set jcard_id='$insert_id', project_start_date='$sdate' , project_end_date='$edate', project_status='$pstatus' where quote_id=$qid");
	$data = array(
		'quot_master_id' => $this->input->post('quot_id'),
		'project_status'  => $pstatus,
		'created_by'    => $this->session->userdata('user_id'),
		'created_date'  => date('Y-m-d h:i:s'),
	);
	$this->db->insert('project_status', $data);
	
	$enquiry_id= $this->input->post('enquiry_id');  
	$data = array(
	'enq_id' => $enquiry_id,
	'status' => "Job Card generated",
	'status_date' =>  date('Y-m-d H:i:s'),
	);
	$this->db->insert('sales_order_status', $data);
    	error_reporting(0);

	if($insert_id)
	{
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'job_card','jcard_id',$insert_id);
	}
	return $insert_id;
  }

  function get_job_card_list()
  {
    $query=$this->db->query(" select j.*, q.revision, q.project_start_date, q.project_end_date, c.cust_name, q.quotation_date, quotation_code, eq.project_name, concat(em.user_name)as created_name from job_card j,  sales_quotation_master q, customer_master c, users em, enquiry_master eq where j.quot_master_id=q.quote_id and q.customer_id=c.customer_id and q.enq_master_id=eq.enquiry_id and j.created_by=em.user_id");
	// echo $this->db->last_query();exit;
	return $query->result();
  }

  function get_job_card()
  {
    $query=$this->db->query("  select jcard_id,jcode,card_date,quot_master_id from job_card ");
    return $query->result();
  }

  function get_jcard_master_by_id($id)
  {
    $query=$this->db->query(" select j.*, c.cust_name, q.quotation_date, quotation_code, user_name as created_name, project_start_date, project_end_date,eq.project_name, eq.project_location from job_card j, sales_quotation_master q, customer_master c, users em, enquiry_master eq where j.quot_master_id=q.quote_id and q.customer_id=c.customer_id and j.created_by=em.user_id and q.enq_master_id=eq.enquiry_id and j.jcard_id=$id and j.status!=1");
	return $query->result();
  }
  function get_jcard_details_by_id($id)
  {
    $query=$this->db->query("select * from jobcard_details where jcard_id =$id");
    return $query->result();
  }

//update job card
function update_job_card_records($id){
	$data = array(
		'jcode' =>$this->input->post('jcode'),
		'card_date' => date('Y-m-d',strtotime($this->input->post('card_date'))),
		'quot_master_id' => $this->input->post('quot_id'),
		'version'  => $this->input->post('revision'),
		'customer_id'  => $this->input->post('customer_id'),
		'remark'  => $this->input->post('note'),
		'created_by'    => $this->session->userdata('user_id'),
		'created_date'  => date('Y-m-d h:i:s'),
		'job_nature'=> $this->input->post('job_nature'),
		'status'=> $this->input->post('pstatus'),
		'job_start_date'=> date('Y-m-d',strtotime($this->input->post('start_date'))),
		'job_end_date'=> date('Y-m-d',strtotime($this->input->post('end_date'))),
		'project_name' => $this->input->post('project_name')
	);
	
	$this->db->where('jcard_id',$id);
	$this->db->update('job_card', $data);
	// echo '<pre>';
	// print_R($this->db->last_query());exit;
	$query=$this->db->query("delete from  jobcard_details where jcard_id=$id");	

    for ($i = 0; $i < count($_POST['prod_desc']); $i++){
		$data = array(
			'jobcard_no' => $this->input->post('jcode'),
			'prod_srno' => $_POST['srn'][$i],
			'prod_description' => $_POST['prod_desc'][$i],
			'prod_qty' => $_POST['prod_qty'][$i],
			'jcard_id' => $id
			
		);

		$id= $this->db->insert('jobcard_details', $data);
	}
    if($id)
    {
      $user_se_id=$this->session->userdata('user_id');
      $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
      $ci = get_instance();
      $ci->load->helper('log');
      $log_msg=add_log_entry($user_se_id,2,$page_name[1],'job_card_details','card_trnsa_id',$id);

    }
    return $id;
  }
//   function update_jcard_record($id)
//   {
	
// 	$data = array(
// 		'jcode' =>$this->input->post('jcode'),
// 		'card_date' => date('Y-m-d',strtotime($this->input->post('carddate'))),
// 		'quot_master_id' => $this->input->post('quot_id'),
// 		'version'  => $this->input->post('revision'),
// 		'customer_id'  => $this->input->post('customer_id'),
// 		'remark'  => $this->input->post('note'),
// 		'created_by'    => $this->session->userdata('user_id'),
// 		'created_date'  => date('Y-m-d h:i:s'),
// 		'job_nature'=> $this->input->post('job_nature'),
// 		'status'=> $this->input->post('pstatus'),
// 		'job_start_date'=> date('Y-m-d',strtotime($this->input->post('start_date'))),
// 		'job_end_date'=> date('Y-m-d',strtotime($this->input->post('end_date')))
// 	);
	
// 	$this->db->where('jcard_id',$id);
// 	$this->db->update('job_card', $data);

// 	$query=$this->db->query("delete from  jobcard_details where jcard_id=$id");	

//     for ($i = 0; $i < count($_POST['prod_desc']); $i++){
// 		$data = array(
// 			'jobcard_no' => $_POST['code'],
// 			'prod_srno' => $_POST['srn'][$i],
// 			'prod_description' => $_POST['prod_desc'][$i],
// 			'prod_qty' => $_POST['prod_qty'][$i],
// 			'jcard_id' => $insert_id
			
// 		);
// 		//echo '<pre>';print_r($data);exit;
// 		$id= $this->db->insert('jobcard_details', $data);
// 	}
// 	$query = $this->db->query("UPDATE `sales_quotation_master` SET `project_start_date` = '', `project_end_date` = '', `project_status` = '' WHERE `sales_quotation_master`.`quote_id` = $this->input->post('quot_id')");
//     echo $this->db->last_query();exit;
// 	if($id)
//     {
//       $user_se_id=$this->session->userdata('user_id');
//       $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
//       $ci = get_instance();
//       $ci->load->helper('log');
//       $log_msg=add_log_entry($user_se_id,2,$page_name[1],'job_card_details','card_trnsa_id',$id);

//     }
//     return $id;
//   }
 

  function delete_jobcard($pl_id)
	{
		$query=$this->db->query("delete from job_card where jcard_id='$pl_id'");
		$query=$this->db->query("delete from jobcard_details where jjcard_id='$pl_id'");
		echo $this->db->last_query();exit;
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,3,$page_name[1],'job_card','jcode',$pl_id);
		return 1;
		
	}
  
   /////////// Add SAT certificate ///////////
	function add_SAT_data()
	{
		$dcid=$this->input->post('dc_id');
		$rec= $this->get_dc_master_by_id($dcid);
		foreach($rec as $v)
		{
			$quote_id = $v->quote_id;
			$customer_id = $v->customer_id;
			$invoice_id = $v->invoice_id;
		}
		$data = array(
			'inspection_date' => date('Y-m-d',strtotime($this->input->post('Inspectiondate'))),
			'customer_id' => $customer_id,
			'dc_id' => $this->input->post('dc_id'),
			'quote_id' => $quote_id,
			'validation_approve' => $this->input->post('validation_app'),
			'remark' => $this->input->post('remark'),	
			'stamp_id' => $this->input->post('stamp'),	
			'created_by' => $this->session->userdata('user_id'),
			'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('SAT_master', $data);
		$insert_id = $this->db->insert_id();
		
		$query=$this->db->query("update sales_quotation_master set project_status='SAT Created' where quote_id=$quote_id");
		
		if($insert_id)
		{	
		
			for ($c = 0; $c < count($_POST['bname']); $c++)
			{
			     $data = array(
					'sat_master_id' => $insert_id,
					'test_type' => 'EQUIPMENT LIST',
					'test_name' => $_POST["bname"][$c],
			      );
		      	    $this->db->insert('SAT_details', $data);
		        }
			for ($c = 0; $c < count($_POST['image_name']); $c++)
			{
			     $data = array(
					'sat_master_id' => $insert_id,
					'test_type' => 'REFERENCE DOCUMENTS',
					'test_name' => $_POST["image_name"][$c],
			      );
		      	    $this->db->insert('SAT_details', $data);
		        }
			for ($c = 0; $c < count($_POST['test_name']); $c++)
			{
			     $data = array(
					'sat_master_id' => $insert_id,
					'test_type' => 'TESTS TO BE PERFORME',
					'test_name' => $_POST["test_name"][$c],
					'test_status' => $_POST["test_result"][$c],
					'test_remark' => $_POST["test_remark"][$c],
			      );
		      	    $this->db->insert('SAT_details', $data);
		        }
		        for ($c = 0; $c < count($_POST['addr_name1']); $c++)
			{
			     $data = array(
					'sat_master_id' => $insert_id,
					'test_type' => 'Digital Inputs',
					//'test_name' => $_POST["testremark"][$c],
					'test_status' => $_POST["plc_result1"][$c],
					'test_phy_addr' => $_POST["addr_name1"][$c],
					'test_real_value' => $_POST["realval1"][$c],
					'test_measured_value' => $_POST["measuredval1"][$c],
					'test_remark' => $_POST["plc_remark1"][$c],
			      );
		      	    $this->db->insert('SAT_details', $data);
		        }
		        
		        for ($c = 0; $c < count($_POST['addr_name2']); $c++)
			{
			     $data = array(
					'sat_master_id' => $insert_id,
					'test_type' => 'Digital Outputs',
					//'test_name' => $_POST["testremark"][$c],
					'test_status' => $_POST["plc_result2"][$c],
					'test_phy_addr' => $_POST["addr_name2"][$c],
					'test_real_value' => $_POST["realval2"][$c],
					'test_measured_value' => $_POST["measuredval2"][$c],
					'test_remark' => $_POST["plc_remark2"][$c],
			      );
		      	    $this->db->insert('SAT_details', $data);
		        }
		        
		        for ($c = 0; $c < count($_POST['addr_name3']); $c++)
			{
			     $data = array(
					'sat_master_id' => $insert_id,
					'test_type' => 'Analog Inputs',
					//'test_name' => $_POST["testremark"][$c],
					'test_status' => $_POST["plc_result3"][$c],
					'test_phy_addr' => $_POST["addr_name3"][$c],
					'test_real_value' => $_POST["realval3"][$c],
					'test_measured_value' => $_POST["measuredval3"][$c],
					'test_remark' => $_POST["plc_remark3"][$c],
			      );
		      	    $this->db->insert('SAT_details', $data);
		        }
		        
		        for ($c = 0; $c < count($_POST['addr_name4']); $c++)
			{
			     $data = array(
					'sat_master_id' => $insert_id,
					'test_type' => 'Analog Outputs',
					//'test_name' => $_POST["testremark"][$c],
					'test_status' => $_POST["plc_result4"][$c],
					'test_phy_addr' => $_POST["addr_name4"][$c],
					'test_real_value' => $_POST["realval4"][$c],
					'test_measured_value' => $_POST["measuredval4"][$c],
					'test_remark' => $_POST["plc_remark4"][$c],
			      );
		      	    $this->db->insert('SAT_details', $data);
		        }
		 }
		$data = array(
		'quot_master_id' => $quote_id,
		'project_status'  => 'SAT Created',
		'created_by'    => $this->session->userdata('user_id'),
		'created_date'  => date('Y-m-d h:i:s'),
		);
		$this->db->insert('project_status', $data);
		
		//$this->load->model('Users_model');
		//$data['user_records']=$this->Users_model->get_active_user_list();

		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'SAT_master','sat_id',$insert_id);
		
		 /* end notification */
		return $insert_id;
	}
	function update_SAT_data($id)
	{
		$data = array(
			'validation_approve' => $this->input->post('validation_app'),
			'remark' => $this->input->post('remark'),	
			'stamp_id' => $this->input->post('stamp'),	
		);	
		$this->db->where('sat_id',$id);
		$this->db->update('SAT_master', $data);
		
		$query=$this->db->query("delete from  SAT_details where sat_master_id=$id");	
		for ($c = 0; $c < count($_POST['bname']); $c++)
		{
		     $data = array(
				'sat_master_id' => $id,
				'test_type' => 'EQUIPMENT LIST',
				'test_name' => $_POST["bname"][$c],
		      );
	      	    $this->db->insert('SAT_details', $data);
	        }
		for ($c = 0; $c < count($_POST['image_name']); $c++)
		{
		     $data = array(
				'sat_master_id' => $id,
				'test_type' => 'REFERENCE DOCUMENTS',
				'test_name' => $_POST["image_name"][$c],
		      );
	      	    $this->db->insert('SAT_details', $data);
	        }
		for ($c = 0; $c < count($_POST['test_name']); $c++)
		{
		     $data = array(
				'sat_master_id' => $id,
				'test_type' => 'TESTS TO BE PERFORME',
				'test_name' => $_POST["test_name"][$c],
				'test_status' => $_POST["test_result"][$c],
				'test_remark' => $_POST["test_remark"][$c],
		      );
	      	    $this->db->insert('SAT_details', $data);
	        }
	        for ($c = 0; $c < count($_POST['addr_name1']); $c++)
		{
		     $data = array(
				'sat_master_id' => $id,
				'test_type' => 'Digital Inputs',
				//'test_name' => $_POST["testremark"][$c],
				'test_status' => $_POST["plc_result1"][$c],
				'test_phy_addr' => $_POST["addr_name1"][$c],
				'test_real_value' => $_POST["realval1"][$c],
				'test_measured_value' => $_POST["measuredval1"][$c],
				'test_remark' => $_POST["plc_remark1"][$c],
		      );
	      	    $this->db->insert('SAT_details', $data);
	        }
	        
	        for ($c = 0; $c < count($_POST['addr_name2']); $c++)
		{
		     $data = array(
				'sat_master_id' => $id,
				'test_type' => 'Digital Outputs',
				//'test_name' => $_POST["testremark"][$c],
				'test_status' => $_POST["plc_result2"][$c],
				'test_phy_addr' => $_POST["addr_name2"][$c],
				'test_real_value' => $_POST["realval2"][$c],
				'test_measured_value' => $_POST["measuredval2"][$c],
				'test_remark' => $_POST["plc_remark2"][$c],
		      );
	      	    $this->db->insert('SAT_details', $data);
	        }
	        
	        for ($c = 0; $c < count($_POST['addr_name3']); $c++)
		{
		     $data = array(
				'sat_master_id' => $id,
				'test_type' => 'Analog Inputs',
				//'test_name' => $_POST["testremark"][$c],
				'test_status' => $_POST["plc_result3"][$c],
				'test_phy_addr' => $_POST["addr_name3"][$c],
				'test_real_value' => $_POST["realval3"][$c],
				'test_measured_value' => $_POST["measuredval3"][$c],
				'test_remark' => $_POST["plc_remark3"][$c],
		      );
	      	    $this->db->insert('SAT_details', $data);
	        }
	        
	        for ($c = 0; $c < count($_POST['addr_name4']); $c++)
		{
		     $data = array(
				'sat_master_id' => $id,
				'test_type' => 'Analog Outputs',
				//'test_name' => $_POST["testremark"][$c],
				'test_status' => $_POST["plc_result4"][$c],
				'test_phy_addr' => $_POST["addr_name4"][$c],
				'test_real_value' => $_POST["realval4"][$c],
				'test_measured_value' => $_POST["measuredval4"][$c],
				'test_remark' => $_POST["plc_remark4"][$c],
		      );
	      	    $this->db->insert('SAT_details', $data);
	        }			
			
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,2,$page_name[1],'SAT_master','sat_id',$id);
			
		return $id;
	}
	function get_SAT_list()
	{
		$query=$this->db->query("select * from SAT_master  e, customer_master c, sales_quotation_master i where e.customer_id=c.customer_id and e.quote_id=i.quote_id order by inspection_date desc");
		return $query->result();
	}

	function get_SAT_master_by_id($id)
	{	
		$query=$this->db->query("select one.*,two.*, three.user_name, three.contact_no, cp_name, cp_mobile, cp_email, billing_addr, billing_city, billing_state, billing_pincode, billing_country, shipping_addr, shipping_city, shipping_pincode, shipping_country,shipping_state, six.stamp_image from (select d.sat_id, d.remark as dremark, d.inspection_date,validation_approve, dc_id, d.remark as fatremark,d.stamp_id, c.cust_name, m.*, t.project_name, t.enquiry_code, project_location, t.client_ref from SAT_master d, customer_master c, sales_quotation_master m,enquiry_master t where m.customer_id=c.customer_id and d.quote_id=m.quote_id and t.enquiry_id=m.enq_master_id and d.sat_id='$id')as one left join(select * from company_bank_details)as two on(one.bank_id=two.bid) left join(select * from users)as three on(one.sales_person=three.user_id) left join(select * from company_stamp_image)as six on(one.stamp_id=six.img_id)");
		return $query->result();
	}
	

	function get_SAT_details_by_id($id)
	{
		$query=$this->db->query("select *  from SAT_details  where sat_master_id='$id' ");
		return $query->result();
	}
	function delete_SAT_record($pl_id)
	{
		$query=$this->db->query("delete from SAT_details where sat_master_id='$pl_id'");
		$query=$this->db->query("delete from SAT_master where sat_id='$pl_id'");
		
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,3,$page_name[1],'FAT_master','fat_id',$pl_id);
		return 1;
		
	}
	function get_units()
	{
		$query=$this->db->query("select unit_abbr from unit_master order by unit_id asc ");
		return $query->result();
	}
	function get_estimation_master_by_id($id){

		$query=$this->db->query("select one.*, two.*,three.user_name,four.currabrev from(select es.*,cs.cust_name,cs.trn_no,cs.contact_no from sales_estimation_master es, customer_master cs where estimate_id= '$id' and es.customer_id = cs.customer_id) as one left join(select * from company_bank_details)as two on(one.bank_id=two.bid) left join(select * from users)as three on(one.sales_person=three.user_id)left join(select id,currabrev from currency_master)as four on(one.currency_id=four.id)");
		return $query->result();
	}
	function get_estimation_tr_by_id($id)
	{
		$query=$this->db->query("select est.*,pm.prd_category,pm.product_description from sales_estimation_transaction est, product_master pm where est.est_master_id ='$id' and est.product_id=pm.product_id;");
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	function add_warranty_data()
	{
		$prifix='CAC/WAR/';
		$this->load->model('Setup_model');
		$num = $this->Setup_model->get_next_code($prifix,'warr_code','warranty_master',9)+1;
		$digit=sprintf("%1$04d",$num);
		$warrranty_code =$prifix.$digit;		
		$data = array(
			'warr_code'=>$warrranty_code,
			'inv_id' => $this->input->post('inv_id'),
			'inv_code' => $this->input->post('invoice_code'),
			'cust_name' => $this->input->post('cust_name'),
			'inv_date' => $this->input->post('invoice_date'),
				
			'created_by' => $this->session->userdata('user_id'),
			'created_on' => date('Y-m-d H:i:s')
		);
		$this->db->insert('warranty_master', $data);
		$insert_id = $this->db->insert_id();
		
		// $quote_id= $this->input->post('quot_id');
		// $query=$this->db->query("update sales_quotation_master set project_status='FAT Created' where quote_id=$quote_id");
		if($insert_id)
		{	
		
			for ($c = 0; $c < count($_POST['prod_desc']); $c++)
		        {		
			        $data1 = array(
					'warr_id' => $insert_id,
					'prod_desc'=>$_POST['prod_desc'][$c],
					'qty'=>$_POST['quantity'][$c]					
			      );
				 //
		      	    $this->db->insert('warranty_prod_details', $data1);
			}
			for ($c = 0; $c < count($_POST['warranty_terms']); $c++)
		        {		
			        $data = array(
						'warr_id' => $insert_id,
						'terms'=> $_POST["warranty_terms"][$c],					
			      );
		      	    $this->db->insert('warranty_terms_details', $data);
			}
	         }
		
		
		
		
		$this->load->model('Users_model');
		$data['user_records']=$this->Users_model->get_active_user_list();

		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'warranty_master','warr_id',$insert_id);
		/* notification */ 
		foreach($data['user_records'] as $r)
		{
			$notice=add_notification($insert_id,$r->user_id,"Warranty Data generated $code","sales/edit_packing_list/$insert_id/0");
		}
		 /* end notification */
		return $insert_id;
	}

	function get_warranty_list()
	{
		$query=$this->db->query("select * from warranty_master order by warr_id desc");
		return $query->result();
	}
	function delete_warranty($warr_id)
	{
		$query=$this->db->query("delete from warranty_master where warr_id='$warr_id'");
		$query=$this->db->query("delete from warranty_prod_details where warr_id='$warr_id'");
		$query=$this->db->query("delete from warranty_terms_details where warr_id='$warr_id'");
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,3,$page_name[1],'warranty_master','warr_id',$warr_id);
		return 1;
		
	}
	function get_warranty_master_by_id($id){
		$query=$this->db->query(" SELECT wm.*,cs.trn_no FROM `warranty_master` wm, customer_master cs WHERE warr_id=$id and wm.cust_name = cs.cust_name;");
		return $query->result();
	 
	}
	function get_warranty_prod_details_by_id($id){
		$query=$this->db->query(" select * from warranty_prod_details where warr_id=$id");
		return $query->result();
	 
	}
	function get_warranty_terms_details_by_id($id){
		$query=$this->db->query(" select * from warranty_terms_details where warr_id=$id");
		return $query->result();
	 
	}
}?>
