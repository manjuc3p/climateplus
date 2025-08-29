<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Stock_Model extends CI_Model
{
    /////////////////////// GRN and stock entry Start////////////////////////////////
    function add_grn_details()
    {
	$po_id=$this->input->post('pid');
	$data = array(
		'grn_code' => $this->input->post('code'),
		'rev_version'  => 1,
		'grn_date'  => date('Y-m-d',strtotime($this->input->post('date'))),
		'supplier_id' => $this->input->post('supplier_id'),
		'invoice_no' =>$this->input->post('invoice_no'),
		'invoice_date' =>date('Y-m-d',strtotime($this->input->post('inv_date'))),
		'warehouse_id' =>$this->input->post('warehouse_id'),
		'po_id'  => $this->input->post('pid'),
		'delivery_by'  => $this->input->post('deliverd_by'),
		'delivery_details'  => $this->input->post('remark'),
		'sub_total' => $this->input->post('sub_total'),
		'vat_amt' => $this->input->post('vat_amt'),
		'vat_percent' => $this->input->post('vat_percent'),
		'discount_percent' =>$this->input->post('discount'),
		'discount' => $this->input->post('discount_amt'),
		'currency_id' => $this->input->post('cid'),
		'currency_rate' => $this->input->post('crate'),
		'other1' => $this->input->post('miscellaneous1'),
		'other1_amt' => $this->input->post('miscellaneous_amt1'),
		'other2' => $this->input->post('miscellaneous2'),
		'other2_amt' => $this->input->post('miscellaneous_amt2'),
		'other3' => $this->input->post('miscellaneous3'),
		'other3_amt' => $this->input->post('miscellaneous_amt3'),
		'grand_total' => $this->input->post('grand_total'),
			
		'sales_person'=>$this->input->post('user_id'),	
		'stamp_id'=>$this->input->post('stamp'),	
			
		'created_by'    => $this->session->userdata('user_id'),
		//'max_approvals' => $max_approvals
	);
	$this->db->insert('GRN_master', $data);
	$insert_id = $this->db->insert_id();

  	for ($i = 0; $i < count($_POST["product_id"]); $i++)
	{
		//$balance_qty=$_POST["req_quantity"][$i]-$_POST["quantity"][$i];
		$data1 = array(
			'grn_master_id' => $insert_id,
			'trans_revision' => 1,
			'product_id' => $_POST['product_id'][$i],
			'item_desc'  => $_POST['desc'][$i],
			'quantity'  => $_POST['qty'][$i],	
			'price'  => $_POST['price'][$i],
			'total'  => $_POST['total'][$i],
			'item_remark'  => $_POST['item_remark'][$i],
			'storage_location'  => $_POST["storage_location"][$i],
		);
		 $this->db->insert('GRN_transaction', $data1);
		$grn_trans_id = $this->db->insert_id();

	   $appendtrid= $_POST['append_trans_id'][$i];
	   if(isset($_POST["bill_entry$appendtrid"]))
	   {
           for ($k = 0; $k < count($_POST["bill_entry$appendtrid"]); $k++)
           {
              	 $bill_no=$_POST["bill_entry$appendtrid"][$k];
                 $order_ref_no=$_POST["order_no$appendtrid"][$k];
                 $box_no=$_POST["box_no$appendtrid"][$k];
                 $quantity=$_POST["qty$appendtrid"][$k];
                 //$location=$_POST["location$appendtrid"][$k];
              		  $location='';           
		 for($j = 0; $j <$quantity; $j++)
		 {
		      	  $data2 = array(
			    'trans_id' => $grn_trans_id,
			    'dc_id' => $insert_id,
			    'stock_date' => date('Y-m-d',strtotime($this->input->post('date'))),
			    'year' => date('Y',strtotime($this->input->post('date'))),
			    'stock_type' => 'IN',
		    	    'warehouse_id' => $this->input->post("warehouse_id"),
			    'product_id'  => $_POST['product_id'][$i],
	    		    'item_desc'  => $_POST['desc'][$i],
	   	            'model_code'  => $_POST['product_id'][$i],
		   	    'bill_no'  => $bill_no,
		   	    'order_ref_no'  => $order_ref_no,
		   	    'box_no'  => $box_no,
		   	    'quantity'  => 1,
		   	    'price'  => $_POST['price'][$i]*$this->input->post('crate'),
			    'remark' => 'GRN',
			    'storage_location'  => $_POST["storage_location"][$i],
		    	    'created_by'    => $this->session->userdata('user_id'),
			    'created_date' =>  date('Y-m-d H:i:s'),
			);
			$this->db->insert('stock_details', $data2);
		 }
          } //for loop bill entry
          }	
	}     // end for loop	              
	 $status=$this->input->post('po_status');
	 $query=$this->db->query("update purchase_order set grn_status=$status where po_id=$po_id;");
	 
        //////////////// account entry for po invoice cr to supplier & dr to company /////
		$AccountCode =$this->input->post('code');  
		$vdate=$this->input->post('date');
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
				'voucher_type' => 'G',  /// po invoice  entry
				'customer_id' => $this->input->post('supplier_id'),
				'account_id' => $debtor,
				'amount' => $dr_amount,
				'drcr_type' => 'Dr',
				//'narration' => $this->input->post('narration'),
				'trans_id' => $insert_id,
				'trans_type'=>'G',
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
				'voucher_type' => 'G',  /// po invoice  entry
				'customer_id' => $this->input->post('supplier_id'),
				'account_id' => $creditor,
				'amount' => $cr_amount,
				'drcr_type' => 'Cr',
				//'narration' => $this->input->post('narration'),
				'trans_id' => $insert_id,
				'trans_type'=>'G',
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
       ///////////////////////////////////////////////////////////////////////////////////
	if($insert_id)
        {
            $user_se_id=$this->session->userdata('user_id');
            $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
            $ci = get_instance();
            $ci->load->helper('log');
            $log_msg=add_log_entry($user_se_id,1,$page_name[1],'GRN_master','grn_id',$insert_id);

        }
	return $insert_id;
    }

    function update_grn_records($grnid)
    {
	  for ($i = 0; $i < count($_POST["trans_id"]); $i++)
	  {
		$trans_id=$_POST['trans_id'][$i];
		$price=$_POST['price'][$i];
		$total=$_POST['total'][$i];
		$crate=$this->input->post('crate');
		$stockprice=$price*$crate;
		$item_remark=$_POST['item_remark'][$i];
		$storage_location=$_POST['storage_location'][$i];
		

		$query=$this->db->query("update GRN_transaction set price=$price, total=$total, item_remark='$item_remark', storage_location='$storage_location' where trans_id=$trans_id");
		
		$query=$this->db->query("update stock_details set price='$stockprice', storage_location='$storage_location' where remark='GRN' and trans_id=$trans_id and stock_type='IN' and dc_id=$grnid");
	  }	
		$query=$this->db->query("update voucher_transaction set cancel=1 where trans_id=$grnid and voucher_type='G' and cancel=0 ");
		
		/////////////// account entry for po invoice cr to supplier & dr to company /////
		$AccountCode =$this->input->post('GRNcode');  
		$vdate=date('Y-m-d');
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
				'voucher_type' => 'G',  /// po invoice  entry
				'customer_id' => $this->input->post('supplier_id'),
				'account_id' => $debtor,
				'amount' => $dr_amount,
				'drcr_type' => 'Dr',
				'trans_id' => $grnid,
				'trans_type'=>'G',
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
				'voucher_type' => 'G',  /// po invoice  entry
				'customer_id' => $this->input->post('supplier_id'),
				'account_id' => $creditor,
				'amount' => $cr_amount,
				'drcr_type' => 'Cr',
				'trans_id' => $grnid,
				'trans_type'=>'G',
				'recordCreatedBy'=>$this->session->userdata('user_id')
			);
			$this->db->insert('voucher_transaction',$data);
			$vid = $this->db->insert_id();
			}
		}	
		
		if($grnid)
        	{
		    $user_se_id=$this->session->userdata('user_id');
		    $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		    $ci = get_instance();
		    $ci->load->helper('log');
		    $log_msg=add_log_entry($user_se_id,2,$page_name[1],'GRN_master','grn_id',$grnid);

        	}
		return $grnid;	
    }
   function accept_grn($grn_id)
   {
   	$rec= $this->get_grn_trans_by_id($grn_id);
   	foreach($rec as $row)
   	{
		$data2 = array(
		    'trans_id' => $row->trans_id,
		    'stock_date' => date('Y-m-d'),
		    'stock_type' => 'IN',
	    	    'warehouse_id' => $row->warehouse_id,
		    'product_id' => $row->product_id,
		    'order_code' => $row->order_code,
		    'item_desc'  => $row->item_desc,
		    'size'  => $row->size,	
		    'quantity'  => $row->quantity,	
	   	    'price'  => $row->price,
		    'storage_location'  => $row->storage_location,
	   	    'item_remark' => $row->item_remark,
	    	    'created_by'    => $this->session->userdata('user_id'),
		    'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('stock_details', $data2);
		$stock_id = $this->db->insert_id();
   	}
   	if($stock_id)
   	{
		$query=$this->db->query("update GRN_master set approvals=1 where grn_id='$grn_id';");
		 
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'stock_details','stock_id',$stock_id);
		
		return $stock_id;
	}
	else 
		return '';
   }
   
   function get_all_grn_list()
   {
	 $query=$this->db->query("select one.*, two.supplier_name,three.warehouse_name from (select r.*,  po.po_code, po_date, revision as po_revision, concat(e.user_name)as createdBy from GRN_master r, users e, purchase_order po where r.created_by=e.user_id and r.po_id=po.po_id)as one left join(select supplier_id, supplier_name from supplier_master)as two on(one.supplier_id=two.supplier_id) left join(select * from warehouse_master)as three on(one.warehouse_id=three.warehouse_id) order by grn_date desc;");
        return $query->result();
    }
   function get_grn_list()
   {
	 $query=$this->db->query("select one.*, two.supplier_name,three.warehouse_name from (select r.*,  po.po_code, po_date, revision as po_revision, concat(e.user_name)as createdBy from GRN_master r, users e, purchase_order po where r.created_by=e.user_id and r.po_id=po.po_id )as one left join(select supplier_id, supplier_name from supplier_master)as two on(one.supplier_id=two.supplier_id) left join(select * from warehouse_master)as three on(one.warehouse_id=three.warehouse_id) order by grn_date desc;");
        return $query->result();
    }

   function get_grn_details_by_id($id)
    {
	$query=$this->db->query("select one.*, two.*, three.user_name, three.contact_no, four.currabrev,six.stamp_image  from (select g.* from GRN_master g  where grn_id=$id)as one left join(select * from supplier_master)as two on(one.supplier_id=two.supplier_id) left join(select * from users)as three on(one.sales_person=three.user_id) left join(select id,currabrev from currency_master)as four on(one.currency_id=four.id) left join(select * from company_stamp_image)as six on(one.stamp_id=six.img_id)");
        return $query->result();
    }

    function get_grn_trans_by_id($id)
    {
	$query=$this->db->query("select * from GRN_transaction where grn_master_id =$id");
        return $query->result();
    }


    /*function update_grn_details($id,$version)
    {
	$data = array(
	    'rev_version'  => $version,
	    'warehouse_id' =>$this->input->post('warehouse_id'),
	    'remark'  => $this->input->post("remark"),
            'status'  => $this->input->post('status'),
	    //'inactive_date'  => $inactive_date,
	);
	$this->db->where('grn_id', $id);
        $this->db->update('GRN_master', $data);

	$stock_from=$this->input->post("stock_from");
        $query=$this->db->query("delete from stock_details where trans_id=$id and stock_from='$stock_from'");
  	for ($i = 0; $i < count($_POST["item_id"]); $i++)
	{

		$data1 = array(
		    'grn_master_id' => $id,
		    'grn_version' => $version,
		    'supplier_id' => $this->input->post('supplier_id'),
		    'item_id'  => $_POST["item_id"][$i],
	   	    'item_desc'  => $_POST["desc"][$i],
		    'unit_id'  => $_POST["unit_id"][$i],
		    'order_quantity'  => $_POST["ordered_quantity"][$i],
		    'deliverd_quantity'  => $_POST["quantity"][$i],
		    'unit_price'  => $_POST["price"][$i],
		    'amount'    => $_POST["amount"][$i],
		    'rack'    => $_POST["rack"][$i],
		    'shell'    => $_POST["shell"][$i],
		    'bin'    => $_POST["bin"][$i],
		);
		 $this->db->insert('GRN_transaction', $data1);
		if($_POST["quantity"][$i] >0)
  		{
			$data2 = array(
			    'trans_id' => $insert_id,
			    'stock_date' => date('Y-m-d',strtotime($this->input->post('date'))),
			    'supplier_id' => $this->input->post('supplier_id'),
			    'stock_type' => 'IN',
			    'stock_from' => $this->input->post("stock_from"),
		    	    'warehouse_id' =>$this->input->post('warehouse_id'),
			    'item_id'  => $_POST["item_id"][$i],
		   	    'item_desc'  => $_POST["desc"][$i],
			    'unit_id'  => $_POST["unit_id"][$i],
			    'quantity'  => $_POST["quantity"][$i],
			    'unit_price'  => $_POST["price"][$i],
			    'amount'    => $_POST["amount"][$i],
	    		    'remark'  => $this->input->post("remark"),
		    	    'created_by'    => $this->session->userdata('user_id'),
			);
			 $this->db->insert('stock_details', $data2);
		}   //end of if
	}
	if($id)
        {
            $user_se_id=$this->session->userdata('user_id');
            $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
            $ci = get_instance();
            $ci->load->helper('log');
            $log_msg=add_log_entry($user_se_id,2,$page_name[1],'GRN_master','grn_id',$id);

        }
	return $insert_id;
    }*/
    
 /// stock adjustment /////////
   function stock_adjustment_details()
   {
        $d1= date('Y');
	$prifix='Adj/'.$d1.'/';
	$this->load->model('Setup_model');
	$num= $this->Setup_model->get_next_code($prifix,'stock_code','stock_adjustment',10)+1;
	$digit=sprintf("%1$04d",$num);
	$data['Code'] =$prifix.$digit;

	$data = array(
	    'stock_code' => $data['Code'],
	    'stock_date'  => date('Y-m-d',strtotime($this->input->post('date'))),
	    'warehouse_id'  => $this->input->post("warehouse_id"),
	    'stock_type' => $this->input->post("inward_type"),
	    'product_id'  => $this->input->post("product_id"),
	    'order_code'  => $this->input->post("order_code"),
   	    'item_desc'  => $this->input->post("desc"),
   	    'size'  => $this->input->post("size"),
   	    'model_code'  => $this->input->post("stock_code"),
	    'remark'  => $this->input->post("remark"),
	    'created_by'    => $this->session->userdata('user_id'),
	    'created_date' =>  date('Y-m-d H:i:s'),
	);
	$this->db->insert('stock_adjustment', $data);
	$insert_id = $this->db->insert_id();
	
	if($this->input->post("min_stock_qty")>0)
	{
		$this->add_min_stock_qty();
	}
	
	if($this->input->post("inward_type")=='Opening' ||  $this->input->post("inward_type")=='IN')
		$intype='IN';
	else
		 $intype='OUT';
  	for ($i = 0; $i < count($_POST["bill_entry"]); $i++)
	{
		for($k = 0; $k < $_POST['qty'][$i]; $k++)
		{
		$data2 = array(
		    'trans_id' => $insert_id,
		    'stock_date' => date('Y-m-d',strtotime($this->input->post('date'))),
		    'stock_type' => $intype,
	    	    'warehouse_id' => $this->input->post("warehouse_id"),
		    'product_id'  => $this->input->post("product_id"),
		    'year'  => $_POST['year'][$i],
    		    'order_code'  => $this->input->post("order_code"),
    		    'item_desc'  => $this->input->post("desc"),
   	    	    'size'  => $this->input->post("size"),
   	            'model_code'  => $this->input->post("stock_code"),
	   	    'bill_no'  => $_POST['bill_entry'][$i],
	   	    'order_ref_no'  => $_POST['ref_no'][$i],
	   	    'box_no'  => $_POST['box_no'][$i],
	   	    'quantity'  => 1,
	   	    'price'  => $_POST['price'][$i],
	   	    'storage_location' => $_POST['storage_location'][$i],
	   	    'item_remark' =>  $_POST['item_remark'][$i],
		    'remark' => 'stock adjustment-'.$this->input->post("inward_type"),
	    	    'created_by'    => $this->session->userdata('user_id'),
		    'created_date' =>  date('Y-m-d H:i:s'),
		);
		$this->db->insert('stock_details', $data2);
		}
	}  //end for
	if($insert_id)
        {
            $user_se_id=$this->session->userdata('user_id');
            $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
            $ci = get_instance();
            $ci->load->helper('log');
            $log_msg=add_log_entry($user_se_id,1,$page_name[1],'stock_adjustment','sno',$insert_id);

        }
	return $insert_id;
   }
   function update_stock_adjustment_details()
   {
	$sno=$this->input->post("sno");
	
	$data = array(
	    'warehouse_id'  => $this->input->post("warehouse_id"),
	    'remark'  => $this->input->post("remark"),
	);
	$this->db->where('sno',$sno);
	$this->db->update('stock_adjustment', $data);
	
  	if($this->input->post("inward_type")=='Opening' ||  $this->input->post("inward_type")=='IN')
		$intype='IN';
	else
		 $intype='OUT';
		 
	$query=$this->db->query("delete from stock_details where trans_id=$sno and status=0;");	 
  	for ($i = 0; $i < count($_POST["bill_entry"]); $i++)
	{
		for($k = 0; $k < $_POST['qty'][$i]; $k++)
		{
		$data2 = array(
		    'trans_id' => $sno,
		    'stock_date' => date('Y-m-d',strtotime($this->input->post('stock_date'))),
		    'stock_type' => $intype,
	    	    'warehouse_id' => $this->input->post("warehouse_id"),
		    'product_id'  => $this->input->post("product_id"),
		    'year'  => $_POST['year'][$i],
    		    'order_code'  => $this->input->post("order_code"),
    		    'item_desc'  => $this->input->post("desc"),
   	    	    'size'  => $this->input->post("size"),
   	            'model_code'  => $this->input->post("stock_code"),
	   	    'bill_no'  => $_POST['bill_entry'][$i],
	   	    'order_ref_no'  => $_POST['ref_no'][$i],
	   	    'box_no'  => $_POST['box_no'][$i],
	   	    'quantity'  => 1,
	   	    'price'  => $_POST['price'][$i],
	   	    'storage_location' => $_POST['storage_location'][$i],
	   	    'item_remark' =>  $_POST['item_remark'][$i],
		    'remark' => 'stock adjustment-'.$this->input->post("inward_type"),
	    	    'created_by'    => $this->session->userdata('user_id'),
		    'created_date' =>  date('Y-m-d H:i:s'),
		);
		$this->db->insert('stock_details', $data2);
		}
	}  //end for
	
		
	if($sno)
        {
            $user_se_id=$this->session->userdata('user_id');
            $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
            $ci = get_instance();
            $ci->load->helper('log');
            $log_msg=add_log_entry($user_se_id,2,$page_name[1],'stock_adjustment','sno',$sno);

        }
	return $sno;
   }
   function get_stock_adjustment_list()
   {
	$query=$this->db->query(" select * from stock_adjustment order by stock_date desc");
	return $query->result();
    }
   function get_stk_adjustment_by_id($id)
    {
	$query=$this->db->query("select one.*, two.min_qty from(select * from stock_adjustment where sno=$id)as one left join(select coalesce(sum(min_qty),0)as min_qty,stock_code from reorder_stock_qty group by stock_code)as two on(one.model_code=two.stock_code)");
        return $query->result();
    }

    function get_stk_adjustment_trans_by_id($id)
    {
	$query=$this->db->query("select *, coalesce(sum(quantity),0)as total_qty from stock_details where trans_id =$id and remark like 'stock adjustment%' group by bill_no,order_ref_no");
        return $query->result();
    }
    
    function ajax_get_min_stock_qty($stock_code)
    {
	$query=$this->db->query("select coalesce(sum(min_qty),0)as min_qty from reorder_stock_qty where stock_code='$stock_code'");
        return $query->row('min_qty');
    }
    function add_min_stock_qty()
    {
        $stock_code = $this->input->post("stock_code"); 
        $min_stock_qty = $this->input->post("min_stock_qty"); 
    	$query=$this->db->query("select count(*)as tcnt from  reorder_stock_qty where stock_code ='$stock_code'");
    	$tcnt = $query->row('tcnt');
    	if($tcnt==0)
    	{
	    	$data = array(
		    'order_code'  => $this->input->post("order_code"),
	   	    'size'  => $this->input->post("size"),
	   	    'stock_code'  => $this->input->post("stock_code"),
	   	    'min_qty' => $this->input->post("min_stock_qty"),
		    'created_by'    => $this->session->userdata('user_id'),
		    'created_date' =>  date('Y-m-d H:i:s'),
		);
		$this->db->insert('reorder_stock_qty', $data);
		$insert_id = $this->db->insert_id();
		if($insert_id)
		{
		    $user_se_id=$this->session->userdata('user_id');
		    $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		    $ci = get_instance();
		    $ci->load->helper('log');
		    $log_msg=add_log_entry($user_se_id,1,$page_name[1],'reorder_stock_qty','sno',$insert_id);

		}
		return $insert_id;
	}
	else
	{
		$query=$this->db->query("update  reorder_stock_qty set min_qty='$min_stock_qty'  where stock_code ='$stock_code'");

		return $stock_code;
	}
    }
    
    function add_stock_allocation_details()
    {
        $stock_id = $this->input->post("stock_id"); 
        $quantity = $this->input->post("allocation"); 
	$model_code  = $this->input->post("model_code");
	$bill_no  = $this->input->post("bill_no");
	$order_ref_no  =$this->input->post("order_ref_no");
	$box_no = $this->input->post("box_no");
        $job_id= $this->input->post("qid");
	 			 
         //$query=$this->db->query("update stock_details set allocation='0' where model_code='$model_code' and bill_no='$bill_no' and order_ref_no='$order_ref_no' and box_no='$box_no' and stock_type='IN' and status='0'");
	 if($quantity>0)
	 { 
         $query=$this->db->query("update stock_details set allocation='1', allocation_for='$job_id' where model_code='$model_code' and bill_no='$bill_no' and order_ref_no='$order_ref_no' and box_no='$box_no' and stock_type='IN' and status='0' and allocation='0' limit $quantity");
         if($query){
         $data = array(
		    'model_code'  => $model_code,
	   	    'bill_no'  => $bill_no,
	   	    'order_ref_no'  => $order_ref_no,
	   	    'box_no' => $box_no,
	   	    'quantity' => $quantity,
	   	    'quotation_id' => $job_id,
	   	    'allocation_type' => 'allocate',
		    'created_by'    => $this->session->userdata('user_id'),
		    'created_date' =>  date('Y-m-d H:i:s'),
		);
		$this->db->insert('stock_allocation', $data);
		$insert_id = $this->db->insert_id();
         }
         }
	if($stock_id)
	{
	    $user_se_id=$this->session->userdata('user_id');
	    $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	    $ci = get_instance();
	    $ci->load->helper('log');
	    $log_msg=add_log_entry($user_se_id,2,$page_name[1],'stock_details','stock_id',$stock_id);

	}
	return $stock_id;
    }
    
    function ajax_get_model_wise_stock_list($model_code,$warehouse_id)
    { 
        $tmp ='';
    	$x= explode(',',$model_code);
    	for($k=0; $k<count($x);$k++)
    	{
    		$tmp = $tmp."'".$x[$k]."',";
    	}
        $model_code= $tmp."' '";
    	
    	$query=$this->db->query("select *, sum(quantity)as stock, group_concat(stock_id)as stk_id from stock_details where stock_type='IN' and status='0' and model_code in($model_code) and warehouse_id='$warehouse_id' group by model_code,bill_no,order_ref_no,box_no;");
	return $query->result();
    }
    function get_dc_issued_stock_by_id($dc_id)
    {
    	$query=$this->db->query("select *, sum(quantity)as stock from stock_details where stock_type='OUT' and trans_id='$dc_id' group by model_code,bill_no,order_ref_no,box_no;");
	return $query->result();
    }
    function get_grn_added_stock_by_id($grn_id)
    {
    	$query=$this->db->query("select *, sum(quantity)as stock from stock_details where stock_type='IN' and dc_id='$grn_id' group by model_code,bill_no,order_ref_no,box_no;");
	return $query->result();
    }
    function get_reorder_stock_for_PO()
    {
    	 $model_code = $this->input->post("selected_tr"); 
    	$tmp ='';
    	$x= explode(',',$model_code);
    	for($k=0; $k<count($x);$k++)
    	{
    		$tmp = $tmp."'".$x[$k]."',";
    	}
        $model_code= $tmp."' '";
        
    	$query=$this->db->query("select r.order_code, r.size, p.product_description from reorder_stock_qty r, product_master p where r.order_code=p.pcode and r.stock_code in($model_code)");
	return $query->result();
    }
   ////// Report ////////////
   function get_stock_code_list()
   {
   	$query=$this->db->query("select s.*, sum(quantity)as qty, i.item_code, i.item_name from stock_details s, item_master i where s.product_id=i.item_id group by product_id");
	return $query->result();
   }
    function get_item_stock_report_list($warehouse_id,$model_code)
    {
    	$itemcondition='';
    	if($model_code!='')
    	 $itemcondition="and model_code='$model_code'";
    	 
	$query=$this->db->query("select *, sum(quantity)as qty, sum(allocation)as allocation, i.item_code, i.item_name from stock_details s, item_master i where s.product_id=i.item_id and warehouse_id='$warehouse_id' $itemcondition and stock_type='IN' and status='0'  group by model_code,bill_no,box_no order by model_code");
	return $query->result();
    }
    function get_stock_inventory_report()
    {
    	$warehouse_id= $this->input->post("warehouse_id");
    	$model_code= $this->input->post("product_id");
    	$size= $this->input->post("size");
    	
    	$itemcondition='';
    	if($model_code!='')
    	 $itemcondition="and model_code='$model_code'";
    	 
	$query=$this->db->query("select zero.*, (coalesce(one.in_qty,0)-coalesce(two.out_qty,0)) as stock, four.allocation from (select s.*, i.item_code, item_name from stock_details s, item_master i where s.product_id=i.item_id and warehouse_id='$warehouse_id' $itemcondition group by order_code,size)as zero left join (select coalesce(sum(quantity),0)as in_qty, order_code,model_code,size from stock_details where stock_type='IN' group by model_code)as one on(zero.model_code=one.model_code) left join(select coalesce(sum(quantity),0)as out_qty, order_code,item_desc,size from stock_details where stock_type='OUT' group by order_code,size)as two on(zero.order_code=two.order_code and zero.size=two.size) left join(select coalesce(sum(allocation),0)as allocation, order_code,model_code,size, item_code, item_name from stock_details s, item_master i where s.product_id=i.item_id and stock_type='IN' and status='0' group by model_code)as four on(zero.model_code=four.model_code)");
	return $query->result();
    }

   function get_reorder_stock_list()
   {
    	$warehouse_id= $this->input->post("warehouse_id");
   	$query=$this->db->query("select * from (select two.item_desc,one.order_code, one.size, one.stock_code, min_qty, Coalesce(two.inv_stock,0)as invstock, Coalesce(three.po_stock,0)as postock, Coalesce(Coalesce(two.inv_stock,0)+Coalesce(three.po_stock,0),0)as total_stock from(select * from reorder_stock_qty)as one left join(select sum(quantity)as inv_stock, model_code, item_desc from stock_details where stock_type='IN' and status='0' group by model_code)as two on(one.stock_code=two.model_code ) left join (select Coalesce(sum(quantity),0)as po_stock, order_code, size from purchase_order p, purchase_order_transaction tr where p.po_id=tr.po_master_id and grn_status=0 and p.cancelled=0 group by order_code,size)as three on(one.order_code=three.order_code and one.size=three.size))as tmp where total_stock<=min_qty");
   	return $query->result();
   }
   
   
   function item_wise_ledger($warehouse_id,$model_code,$year)
   {
   	$query=$this->db->query("select zero.*, one.stock_id, one.model_code, one.stock_date, Coalesce(one.inward,0)as inward, Coalesce(two.outward,0)as outward, Coalesce(two.price,0)as outprice, Coalesce(one.inward*one.price,0)as inward_price, Coalesce(two.outward*two.price,0)as outward_price from (SELECT month_no,month_name from monthvalue)as zero left join(select stock_id,model_code, count(*)as inward, stock_date, month(stock_date)as inmonth, price from stock_details where stock_type='IN' and warehouse_id=$warehouse_id and year(stock_date)='$year' and model_code='$model_code' group by month(stock_date))as one on(zero.month_no=one.inmonth) left join(select stock_id,model_code, count(*)as outward, stock_date, month(stock_date)as outmonth, price from stock_details where stock_type='OUT' and warehouse_id=$warehouse_id and year(stock_date)='$year' and model_code='$model_code' group by month(stock_date))as two on(zero.month_no=two.outmonth)");
   	return $query->result();
   } 
    function item_wise_monthly_ledger($warehouse_id,$model_code,$year,$month)
   {
   	$query=$this->db->query("select stock_id,stock_type,stock_date,quantity,trans_id, price, remark, sum(quantity)as inward, (sum(quantity)*price)as total from stock_details where warehouse_id=$warehouse_id and year(stock_date)='$year' and month(stock_date)='$month' and model_code='$model_code' group by remark, trans_id");
   	return $query->result();
   } 
   
} ?>
