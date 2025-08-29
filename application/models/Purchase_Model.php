<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Purchase_Model extends CI_Model
{
 ////////////// requision///////////////////
function add_requisition_records()
  {
	$prifix='REQ'.date('y');
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'req_code','purchase_requisition',6)+1;
	$digit=sprintf("%1$04d",$num);
	$Code =$prifix.date('m').$digit;
	    $data = array(
	      'req_code'  => $Code,
	      'req_date'  => date('Y-m-d',strtotime($this->input->post('rfq_date'))),
	      'remark'  => $this->input->post('terms'),
	      'person_id'=>$this->input->post('user_id'),		
	      'created_by' => $this->session->userdata('user_id'),
	      'created_date' => date('Y-m-d H:i:s')
	    );
	$this->db->insert('purchase_requisition', $data);
	$insert_id = $this->db->insert_id();

	for($i=0; $i<count($_POST["product_id"]); $i++)
	{
		$data = array(
		'req_master_id' => $insert_id,
		'product_id' => $_POST["product_id"][$i],
		'product_desc'  => $_POST["desc"][$i],
		'quantity'  =>  $_POST["trading_qty"][$i],
		'item_remark'  =>  $_POST["item_remark"][$i],
		);
		$this->db->insert('purchase_requisition_transaction', $data);
	}
	if($insert_id)
	{
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'purchase_requisition','req_id',$insert_id);

	}
	return $insert_id;
  }

  function update_requisition_records($id)
  {
	$data = array(
		        'remark'  => $this->input->post('remark'),
		);
		$this->db->where('req_id',$id);
		$res = $this->db->update('purchase_requisition', $data);

	$query=$this->db->query(" delete from purchase_requisition_transaction where req_master_id=$id");
       for($i=0; $i<count($_POST["product_id"]); $i++)
	{
		$data = array(
		'req_master_id' => $id,
		'product_id' => $_POST["product_id"][$i],
		'product_desc'  => $_POST["desc"][$i],
		'quantity'  =>  $_POST["trading_qty"][$i],
		'item_remark'  =>  $_POST["item_remark"][$i],
		);
		$this->db->insert('purchase_requisition_transaction', $data);
	}
    if($id)
    {
      $user_se_id=$this->session->userdata('user_id');
      $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
      $ci = get_instance();
      $ci->load->helper('log');
      $log_msg=add_log_entry($user_se_id,2,$page_name[1],'purchase_requisition','req_id',$id);

    }
    return $id;
  }
  function approve_requisition_records($id)
  {
	$data = array(
		        'approve'  => 1,
		        'approve_by'  =>$this->session->userdata('user_id'),
		        'approve_date'  => date('Y-m-d'),
		);
		$this->db->where('req_id',$id);
		$res = $this->db->update('purchase_requisition', $data);

	
    if($id)
    {
      $user_se_id=$this->session->userdata('user_id');
      $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
      $ci = get_instance();
      $ci->load->helper('log');
      $log_msg=add_log_entry($user_se_id,2,$page_name[1],'purchase_requisition','req_id',$id);

    }
    return $id;
  }
  function get_requisition_list()
  {
    	$query=$this->db->query(" select * from purchase_requisition order by req_date desc");
        return $query->result();
  }

  function get_approved_requisition_list()
  {
    	$query=$this->db->query(" select * from purchase_requisition where approve=1 and rfq_done=0 order by req_date desc");
        return $query->result();
  }
  function get_requisition_by_id($id)
  {
    $query=$this->db->query("select * from purchase_requisition where req_id =$id ");
    return $query->result();
  }
  function get_requisition_tr_by_id($id)
  {
    $query=$this->db->query("select *  from purchase_requisition_transaction  where req_master_id =$id");
    return $query->result();
  }


  function delete_reqisition($rfq_id)
  {
  	$query=$this->db->query("delete from purchase_requisition_transaction where req_master_id='$rfq_id'");
	$query=$this->db->query("delete from purchase_requisition where req_id='$rfq_id'");
	
	$user_se_id=$this->session->userdata('user_id');
	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	$ci = get_instance();
	$ci->load->helper('log');
	$log_msg=add_log_entry($user_se_id,3,$page_name[1],'purchase_requisition','req_id',$rfq_id);
	return 1;
  }
  ////////////////// RFQ start ///////////////
function add_direct_rfq_records()
  {
	$prifix='BES/RFQ/'.date('y').'/';
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'rfq_code','purchase_RFQ',12)+1;
	$digit=sprintf("%1$04d",$num);
	$Code =$prifix.$digit;

	if($this->input->post('req_id')=='') $type='direct'; else $type='requisition';

        $data = array(
	      'rfq_code' => $Code,
	      'rev_version'  => $type,
	      'rfq_date'  => date('Y-m-d',strtotime($this->input->post('rfq_date'))),
	      'supplier_id'  => $this->input->post('supplier_id'),
	      'rfq_type'  => 'direct',
	      'payment_term'  => $this->input->post('pterm'),
	      'delivery_term'  => $this->input->post('dterm'),
	      'sales_person'=>$this->input->post('user_id'),	
	      'remark'  => $this->input->post('terms'),
	      'created_by'    => $this->session->userdata('user_id'),
	    );
	$this->db->insert('purchase_RFQ', $data);
	$insert_id = $this->db->insert_id();

	for ($i = 0; $i < count($_POST['desc']); $i++)
        {	
	      $data = array(
		'rfq_master_id' => $insert_id,
		'rfq_version' => 0,	
		'product_id' => $_POST['product_id'][$i],
		'item_desc'  => $_POST['desc'][$i],
		'quantity'  => $_POST['trading_qty'][$i],
		//'size'  => $_POST['size'][$i],
		'comment'  => $_POST['item_remark'][$i],
		//'file_upload_path'  => $image_name,
	      );
	      $this->db->insert('purchase_RFQ_transaction', $data);

	     $transId=  $_POST['trans_id'][$i];
	     $trans_masterId=  $_POST['trans_master_id'][$i];
	    if($transId)
            {
		$query=$this->db->query("update purchase_requisition_transaction set rfq_created=1 where trans_id='$transId' and req_master_id=$trans_masterId");
		$query=$this->db->query(" select if(one.c1=tt.c2,1,0)as mycnt1 from (select count(*)as c1 from purchase_requisition_transaction where req_master_id =$trans_masterId)as one join (select count(*)as c2 from purchase_requisition_transaction where req_master_id=$trans_masterId and rfq_created=1)as tt on(1=1)");
		$ch1 = $query->row('mycnt1');
		if($ch1==1)
			$query=$this->db->query("update purchase_requisition set  rfq_done=1 where req_id=$trans_masterId");
	    }
        }
	if($insert_id)
	{
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'purchase_RFQ','rfq_id',$insert_id);

	}
	return $insert_id;
  }
  function delete_rfq($rfq_id)
  {
	
  	$query=$this->db->query("select count(*)as tcnt from purchase_quotation where rfq_id='$rfq_id'");
	$tcnt = $query->row('tcnt');
        if($tcnt==0)
        {
  	$query=$this->db->query("delete from purchase_RFQ_transaction where rfq_master_id='$rfq_id'");
	$query=$this->db->query("delete from purchase_RFQ where rfq_id='$rfq_id'");
	
	$user_se_id=$this->session->userdata('user_id');
	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	$ci = get_instance();
	$ci->load->helper('log');
	$log_msg=add_log_entry($user_se_id,3,$page_name[1],'purchase_RFQ','rfq_id',$rfq_id);
	return 1;
	}
	else
	return 0;
  }
  ////////////////////////////////////////////////////////////////////////
  function add_purchase_rfq($enq_id,$records2, $enq_revision)
  {
	$prifix='RFQ'.date('y');
	$this->load->model('Setup_model');
	$num = $this->Setup_model->get_next_code($prifix,'rfq_code','purchase_RFQ',8)+1;
	if($num==1)
	{
		$Code ='RFQ23080766';
	}
	else
	{
	$digit=sprintf("%1$04d",$num);
	$Code =$prifix.date('m').$digit;
	}

	    $data = array(
	      'rfq_code' => $Code,
	      'rev_version'  => $enq_revision,
	      'rfq_date'  => date('Y-m-d'),
	      'supplier_id'  => $this->input->post('supp_id'),
	      'indent_id'  => $enq_id,
	      'rfq_type'  => 'sales',
	      //'payment_term'  => $this->input->post('pterm'),
	      //'delivery_term'  => $this->input->post('dterm'),
	      
	      'sales_person'=>$this->input->post('sales_person'),	
	      'remark'  => $this->input->post('remark'),
	      'created_by'    => $this->session->userdata('user_id'),
	    );
	$this->db->insert('purchase_RFQ', $data);
	$insert_id = $this->db->insert_id();

	foreach($records2 as $r)
	{
		$data = array(
		'rfq_master_id' => $insert_id,
		'rfq_version' => $enq_revision,		
		'srn' => $r->srn,
		'product_id' =>$r->product_id,
		'order_code' => $r->order_code,
		'item_desc'  => $r->product_desc,
		'quantity'  => $r->quantity,
		'size'  => $r->size,
		'file_upload_path' => $r->file_name,    
		'comment'  => $r->item_remark,
		);
		$this->db->insert('purchase_RFQ_transaction', $data);
	}
	if($insert_id)
	{
		$user_se_id=$this->session->userdata('user_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'purchase_RFQ','rfq_id',$insert_id);

	}
	return $insert_id;
  }

  function update_purchase_RFQ($id,$version)
  {
    for ($i = 0; $i < count($_POST["item_id"]); $i++)
    {
    	$area=$_POST['area'][$i];
    	$quantity=$_POST['quantity'][$i];
    	$rfq_trans_id=$_POST['rfq_trans_id'][$i];
    	$comment=$_POST['comment'][$i];
        $query=$this->db->query("update purchase_RFQ_transaction set area=$area, quantity=$quantity, comment='$comment' where rfq_trans_id=$rfq_trans_id");
    }
    if($id)
    {
      $user_se_id=$this->session->userdata('user_id');
      $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
      $ci = get_instance();
      $ci->load->helper('log');
      $log_msg=add_log_entry($user_se_id,2,$page_name[1],'purchase_quotation','quotation_id',$id);

    }
    return $id;
  }
  function get_RFQ_list($type)
  {
    if($type=='sales')
    {
    	$query=$this->db->query("select one.*, two.enquiry_code, two.client_ref, two.cust_id from (select r.*, em.user_name as rfq_created_by, s.supplier_name from purchase_RFQ r, users em, supplier_master s where r.created_by=em.user_id and r.supplier_id=s.supplier_id and r.status=0 and r.rfq_type='sales' and quotation_created=0  order by r.rfq_date desc)as one left join(select * from enquiry_master)as two on(one.indent_id=two.enquiry_id) order by rfq_date desc, rfq_code desc");
    }
    else
    {
    	
    	$query=$this->db->query("select one.* from (select r.*, em.user_name as rfq_created_by, s.supplier_name from purchase_RFQ r, users em, supplier_master s where r.created_by=em.user_id and r.supplier_id=s.supplier_id and r.rfq_type='direct' and r.status=0 and quotation_created=0 order by r.rfq_date desc)as one order by rfq_date desc, rfq_code desc");
    }
    return $query->result();
  }

  function get_pruchase_rfq_by_id($id)
  {
    $query=$this->db->query("select one.*, three.user_name, three.contact_no, two.enquiry_code,client_ref from (select r.*, em.user_name as rfq_created_by,  s.supplier_name, s.contact_person, s.billing_address, s.billing_city, s.billing_state, s.billing_po_box, s.billing_country,s.email_id, s.contact_no from purchase_RFQ r, users em, supplier_master s where r.created_by=em.user_id and r.supplier_id=s.supplier_id and r.status=0 and rfq_id=$id order by r.rfq_date desc)as one left join(select * from enquiry_master)as two on(one.indent_id=two.enquiry_id) left join(select * from users)as three on(one.sales_person=three.user_id) ");
    return $query->result();
  }


  function get_pruchase_rfq_tr_by_id($id,$version)
  {
  //order by lpad(srn,3,'0')
    $query=$this->db->query("select *  from purchase_RFQ_transaction  where rfq_master_id =$id and rfq_version=$version order by cast(srn as integer),srn asc");
    return $query->result();
  }

  
  /////////////////////// purchase order Start////////////////////////////////
  function add_purchase_order()
  {
  		$code= $this->input->post('po_code');
		$data = array(
		'po_code' => $this->input->post('po_code'),
		'po_date' => date('Y-m-d',strtotime($this->input->post('podate'))),
		'revision_date'=> date('Y-m-d',strtotime($this->input->post('podate'))),
		'qtn_id' => $this->input->post('qid'),
		'supplier_ref' => $this->input->post('ref_no'),
		'supplier_id' => $this->input->post('supplier_id'),
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
		'payment_term1' => $this->input->post('term1'),
		'delivery_term' => $this->input->post('term2'),
		'shipping_term' => $this->input->post('terms'),
		'certificate_term'  => $this->input->post('certificate_details'),
		'remark' =>  $this->input->post('po_type'),	
		'approved_person'=>$this->input->post('user_id'),
		'stamp_id'=>$this->input->post('stamp'),		
		'created_by' => $this->session->userdata('user_id'),
		'created_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('purchase_order', $data);
		$insert_id = $this->db->insert_id();

		if($insert_id)
		{
			for ($i = 0; $i < count($_POST['product_id']); $i++)
		        {	
			      $data = array(
				'po_master_id' => $insert_id,
				'product_id' => $_POST['product_id'][$i],
				'item_desc'  => $_POST['desc'][$i],
				'quantity'  => $_POST['trading_qty'][$i],	
				'price'  => $_POST['price'][$i],
				'total'  => $_POST['total'][$i],
				'item_remark'  => $_POST['item_remark'][$i],
			      );
			      $this->db->insert('purchase_order_transaction', $data);			      
		        }
		      	
			$this->load->model('Users_model');
			$data['user_records']=$this->Users_model->get_active_user_list();
      
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'purchase_order','po_id',$insert_id);
			/* notification */ 
			foreach($data['user_records'] as $r)
   			{
				$notice=add_notification($insert_id,$r->user_id,"PO generated $code","purchase/edit_po/$insert_id/1/0");
			}
			 /* end notification */
		}
		return $insert_id;
  }
  function update_purchase_order_records($id) 
  {
		$new_revision= $this->input->post('revision');
    		if($this->input->post('create_revision')==1)
         		$new_revision= $this->input->post('revision')+1;
         		
		$data = array(
		        'revision' => $new_revision,
			'revision_date'=> date('Y-m-d',strtotime($this->input->post('rev_date'))),
			'supplier_ref' => $this->input->post('ref_no'),
			//'supplier_id' => $this->input->post('supplier_id'),
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
			'payment_term1' => $this->input->post('term1'),
			'delivery_term' => $this->input->post('term2'),
			'shipping_term' => $this->input->post('terms'),
			
			'stamp_id'=>$this->input->post('stamp'),	
			//'bank_id' =>  $this->input->post('bank'),	
			'approved_person'=>$this->input->post('user_id'),
		);
		$this->db->where('po_id',$id);
		$res = $this->db->update('purchase_order', $data);
		
		if($res)
		{	
			if($this->input->post('create_revision')!=1)
			{
		    	$query=$this->db->query("delete from purchase_order_transaction where po_master_id=$id and trans_revision=$new_revision");
			}	        
		        for ($i = 0; $i < count($_POST['product_id']); $i++)
	        	{	
			      $data = array(
				'po_master_id' => $id,
				'trans_revision' => $new_revision,
				'product_id' => $_POST['product_id'][$i],
				'item_desc'  => $_POST['desc'][$i],
				'quantity'  => $_POST['trading_qty'][$i],	
				'price'  => $_POST['price'][$i],
				'total'  => $_POST['total'][$i],
				'item_remark'  => $_POST['item_remark'][$i],
			      );
			      $this->db->insert('purchase_order_transaction', $data);
	        	}
                	
			$user_se_id=$this->session->userdata('user_id');
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,2,$page_name[1],'purchase_order','po_id',$id);
			return true;
		}
		else
		{
			return false;
		}
  }
  function delete_po($po_id)
  {
  	$query=$this->db->query("delete from purchase_order_transaction where po_master_id='$po_id'");
	$query=$this->db->query("delete from purchase_order where po_id='$po_id'");
	
	$user_se_id=$this->session->userdata('user_id');
	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	$ci = get_instance();
	$ci->load->helper('log');
	$log_msg=add_log_entry($user_se_id,3,$page_name[1],'purchase_order','po_id',$po_id);
	return 1;
  }
  function get_supplier_currency($id)
  {
    $query=$this->db->query("select cm.rate, s.class from supplier_master s, currency_master cm where s.currency_id=cm.id and supplier_id=$id");
    return $query->result();
  }
  
  function get_direct_po_list()
  {
    $query=$this->db->query("select r.*, s.supplier_name from purchase_order r, supplier_master s where r.supplier_id=s.supplier_id and grn_status=0 and r.remark='direct' order by po_id desc");
    return $query->result();
  }
  function get_all_po_list()
  {
    $query=$this->db->query("select r.*, s.supplier_name from purchase_order r, supplier_master s where r.supplier_id=s.supplier_id and grn_status=0 order by po_id desc");
    return $query->result();
  }
  function get_po_list()
  {
    $query=$this->db->query("select r.*, s.supplier_name from purchase_order r, supplier_master s where r.supplier_id=s.supplier_id and grn_status=0  and r.remark='from quotation' order by po_id desc");
    return $query->result();
  }

  function get_po_details_by_id($po_id)
  {
    $query=$this->db->query("select one.*, three.user_name, three.contact_no, four.currabrev, six.stamp_image from (select po.*, supplier_name,contact_no, s.email_id, billing_address, s.billing_city, s.billing_state, s.billing_po_box, s.billing_country, s.shipping_address, s.shipping_city, s.shipping_po_box, s.shipping_country,s.shipping_state, contact_person as cp_name, contact_person_number as cp_mobile  from purchase_order po, supplier_master s where po.supplier_id=s.supplier_id and po.po_id=$po_id)as one left join(select * from users)as three on(one.approved_person=three.user_id) left join(select id,currabrev from currency_master)as four on(one.currency_id=four.id) left join(select * from company_stamp_image)as six on(one.stamp_id=six.img_id)");
    return $query->result();
  }


  function get_po_items_by_id($po_id,$revision)
  {
    $query=$this->db->query("select * from purchase_order_transaction tr where  po_master_id=$po_id and trans_revision='$revision'");
    return $query->result();
  }

  function delete_grn($grn_id)
  {
  	$query=$this->db->query("delete from GRN_transaction where grn_master_id='$grn_id'");
	$query=$this->db->query("delete from GRN_master where grn_id='$grn_id'");
	
	$user_se_id=$this->session->userdata('user_id');
	$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
	$ci = get_instance();
	$ci->load->helper('log');
	$log_msg=add_log_entry($user_se_id,3,$page_name[1],'GRN_master','grn_id',$grn_id);
	return 1;
  }


  ////////////// Report Functions //////////

  function get_indent_records()
  {
    $from_date = date('Y-m-d', strtotime($this->input->post('from')));
    $to_date = date('Y-m-d', strtotime($this->input->post('to')));
    $project = $this->input->post('project');
    $projectCondition='';
    if($from_date=='' && $to_date==''){
      return;
    }

    if($project!='') {
      $projectCondition ="and p.project_id = '$project'";
    }

    $query=$this->db->query("select p.*, pm.project_code, pm.project_name, concat(e.first_name,' ',e.last_name)as created_by from purchase_indent p, project_master pm, employee_master e where p.project_id=pm.project_id and p.created_by=e.employee_id and indent_date between '$from_date' and '$to_date' $projectCondition ");
    return $query->result();
  }

  function get_detailed_indent_records()
  {
    $project = $this->input->post('project');
    $query=$this->db->query("select * from purchase_indent p, purchase_indent_transaction tr, item_master i, unit_master u where p.indent_id=tr.indent_master_id and tr.item_id=i.item_master_id and tr.unit_id=u.unit_id and p.status=0 and p.rev_version=tr.indent_version and p.project_id=$project");
    return $query->result();
  }

  function get_rfq_records()
  {
    $from_date = date('Y-m-d', strtotime($this->input->post('from')));
    $to_date = date('Y-m-d', strtotime($this->input->post('to')));
    $project = $this->input->post('project');

    $dateCondition=''; $projectCondition='';

    if($from_date!='' && $to_date!=''){
      $dateCondition =" and r.rfq_date between '$from_date' and '$to_date' ";
    }

    if($project!='') {
      $projectCondition ="and r.project_id = '$project'";
    }

    $query=$this->db->query("select r.*, i.indent_code, pm.project_name, pm.project_code, concat(e.first_name,' ',e.last_name)as created_by from purchase_RFQ r,purchase_indent i, project_master pm, employee_master e where r.project_id=pm.project_id and r.created_by=e.employee_id  and r.indent_id=i.indent_id $dateCondition $projectCondition");
    return $query->result();
  }


  function get_quotation_records() {
    $from_date = date('Y-m-d', strtotime($this->input->post('from')));
    $to_date = date('Y-m-d', strtotime($this->input->post('to')));
    $project = $this->input->post('project');

    $dateCondition=''; $projectCondition='';

    if($from_date!='' && $to_date!=''){
      $dateCondition =" and pq.quotation_date between '$from_date' and '$to_date' ";
    }

    if($project!='') {
      $projectCondition ="and pq.project_id = '$project'";
    }

    $query=$this->db->query("select pq.*, pi.indent_code, rfq.rfq_code, pm.project_code,pm.project_name,c.company_code,c.company_name, s.supplier_code,s.supplier_name,concat(e.first_name,' ',e.last_name)as created_by from purchase_quotation pq, purchase_indent pi,purchase_RFQ rfq, project_master pm, company_master c, supplier_master s, employee_master e where pq.indent_id=pi.indent_id and pq.rfq_id=rfq.rfq_id and pq.project_id=pm.project_id and pq.company_id=c.company_id and pq.supplier_id=s.supplier_id and pq.created_by=e.employee_id $dateCondition $projectCondition ");
    return $query->result();
  }

  function get_total_employee_count()
  {
    $query=$this->db->query(" select COALESCE(count(*),0) as employee_count from employee_master ");
    return $query->row('employee_count');
  }

  function get_total_enquiry_count_of_month()
  {
    $from_date=date('Y-m-01');
    $to_date=date('Y-m-t');

    $query=$this->db->query(" select COALESCE(count(*),0) as enquiry_count from enquiry_master where status=0 and enquiry_date between '$from_date' and '$to_date' ");
    return $query->row('enquiry_count');
  }

  function get_total_job_pack_of_month()
  {
    $today=date('Y-m-d');

    $query=$this->db->query(" select COALESCE(count(*),0) as job_pack_count from Job_pack_master where status=0 and project_start_date <='$today' and project_end_date >='$today' ");
    return $query->row('job_pack_count');
  }

  function get_purchased_order_of_month()
  {
    $from_date=date('Y-m-01');
    $to_date=date('Y-m-t');

    $query=$this->db->query(" select COALESCE(count(*),0) as purchased_count from purchase_indent where status=0 and indent_date between '$from_date' and '$to_date' ");
    return $query->row('purchased_count');
  }

  function get_quotation_of_month()
  {
    $from_date=date('Y-m-01');
    $to_date=date('Y-m-t');

    $query=$this->db->query(" select COALESCE(count(*),0) as quotation_count from sales_quotation_master where status=0 and quotation_date between '$from_date' and '$to_date' ");
    return $query->row('quotation_count');
  }

  function get_inventory_item_count()
  {
    $query=$this->db->query(" select COALESCE(count(*),0) as inventory_item_count from item_master where status=0 ");
    return $query->row('inventory_item_count');
  }

  function get_registered_vehicle_count()
  {
    $query=$this->db->query(" select COALESCE(count(*),0) as vehicle_count from vehicle_master where status=0 ");
    return $query->row('vehicle_count');
  }

  function daily_quotation_barchart($qdate) //Quotation
	{
    $query = $this->db->query(" select COALESCE(count(*),0) as quotation_count, quotation_date from sales_quotation_master where month(quotation_date)=month('$qdate') and year(quotation_date)=year('$qdate') and status!=1 group by quotation_date;");
		return $query->result();
	}

  function daily_enquiry_barchart($date) ///Enquiry
	{
    // $query = $this->db-> query("select COALESCE(count(*),0) as enquiry_count ,enquiry_date from enquiry_master where status=0 and enquiry_date='$date' group by enquiry_date");
    $query = $this->db-> query("select COALESCE(count(*),0) as enquiry_count ,enquiry_date  from enquiry_master where month(enquiry_date)=month('$date') and year(enquiry_date)=year('$date') and status!=1 group by enquiry_date");
    return $query->result();
	}

  function get_purchase_timeline_report_records()
  {
    $query = $this->db-> query(" select one.*,two.rev_version,two.po_code,two.po_id, two.po_date, three.rev_version, three.grn_id, three.grn_code, three.grn_date from (select r.rfq_id,r.rfq_code,r.rfq_date,pq.quotation_id,pq.quotation_code,pq.quotation_date, r.rev_version, pq.rev_version as purchase_rev_version from purchase_RFQ r, purchase_quotation pq  where r.rfq_id=pq.rfq_id ) as one left join
    (select po_id,po_code,po_date,rev_version,quotation_id from purchase_order) as two on (one.quotation_id=two.quotation_id) left join ( select grn_id,grn_code,grn_date,quotation_id,rev_version from GRN_master) as three on (one.quotation_id=three.quotation_id) ");
    return $query->result();
  }

  function get_sales_timeline_report_records()
  {
    $query = $this->db-> query(" select four.LPO_received,four.LPO_date,four.LPO_amount,four.quot_master_id,four.jpack_id,three.jcard_id,three.jcode,three.card_date,one.quot_id,one.quotation_code, one.revision, one.quotation_date,two.enquiry_code,two.enquiry_id,two.enquiry_date, two.rev_version from (select quot_id,quotation_code,quotation_date,enq_master_id,revision from sales_quotation_master) as one left join (select enquiry_code,enquiry_id,enquiry_date,rev_version from enquiry_master ) as two on (one.enq_master_id=two.enquiry_id) left join (select jcard_id,jcode,card_date,quot_master_id from job_card) as three on (one.quot_id=three.quot_master_id) left join ( select LPO_received,LPO_date,LPO_amount,quot_master_id,jpack_id from Job_pack_master ) as four on (one.quot_id=four.quot_master_id) ");
    return $query->result();
  }

  function get_purchase_order_dropdown()
  {
    $query = $this->db-> query(" select po_id,po_code,po_date from purchase_order ");
    return $query->result();
  }

  function purchase_quotation_dropdown()
  {
    $query = $this->db-> query(" select quotation_id,quotation_code,quotation_date from purchase_quotation; ");
    return $query->result();
  }


  function sale_quotation_dropdown()
  {
    $query = $this->db-> query(" select quot_id,quotation_code,quotation_date from sales_quotation_master; ");
    return $query->result();
  }

  function get_production_dropdown()
  {
    $query = $this->db-> query(" select production_id,pcode,pdate from production_cutting_master ");
    return $query->result();
  }

  function get_job_card_dropdown()
  {
    $query = $this->db-> query(" select jcard_id,jcode,card_date from job_card ");
    return $query->result();
  }

  function sale_quotation_dropdown_order_status()
  {
    $query = $this->db-> query(" select quot_id,quotation_code,quotation_date,project_name,customer_name from sales_quotation_master s, customer_master c where s.customer_id=c.customer_id ");
    return $query->result();
  }

  function get_completed_project_count()
  {
    $query=$this->db->query(" select COALESCE(count(*),0) as project_count from completed_orders ");
    return $query->row('project_count');
  }

  function get_customer_count()
  {
    $query=$this->db->query(" select COALESCE(count(*),0) as customer_count from customer_master where cancelled=0 ");
    return $query->row('customer_count');
  }

  function get_supplier_count()
  {
    $query=$this->db->query(" select COALESCE(count(*),0) as supplier_count from supplier_master where status=0 ");
    return $query->row('supplier_count');
  }

 /////////////////Quotation start//////////////////
function add_purchase_quotation()
  {
  
    $rfq_id=$this->input->post('qid');
    $data = array(
      		'quote_code' => $this->input->post('po_code'),
      		'quote_date'  => date('Y-m-d',strtotime($this->input->post('podate'))),
      		'rfq_id'  => $this->input->post('qid'),
      		'supplier_id'  => $this->input->post('supplier_id'),
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
		'grand_total' => $this->input->post('grand_total'),
		'payment_term1' => $this->input->post('term1'),
		'shipping_term' => $this->input->post('term2'),
                'remark'  => $this->input->post('terms'),
      		'created_by'    => $this->session->userdata('user_id'),
		'created_date' => date('Y-m-d H:i:s')
    );
    $this->db->insert('purchase_quotation', $data);
    $insert_id = $this->db->insert_id();

    for ($i = 0; $i < count($_POST["product_id"]); $i++)
    {
      $data = array(
        'quote_id' => $insert_id,
        'product_id'  => $_POST["product_id"][$i],
        'item_desc'  => $_POST["desc"][$i],
        'quantity'  => $_POST["trading_qty"][$i],
        'price'  => $_POST["price"][$i],
        'total'    => $_POST["total"][$i],
        'item_remark'  => $_POST["item_remark"][$i],
      );
      $this->db->insert('purchase_quotation_transaction', $data);
    }

    //$query=$this->db->query("update purchase_RFQ set quotation_created=1 where rfq_id =$insert_id");

    if($insert_id)
    {
      $user_se_id=$this->session->userdata('user_id');
      $page_name=explode('index.php/', $_SERVER['PHP_SELF']);
      $ci = get_instance();
      $ci->load->helper('log');
      $log_msg=add_log_entry($user_se_id,1,$page_name[1],'purchase_quotation','quote_id',$insert_id);

    }
    return $insert_id;
  }

  function get_quotation_list()
  {
    $query=$this->db->query("select one.* from (select p.*,s.supplier_name from purchase_quotation p, supplier_master s where p.supplier_id=s.supplier_id)as one order by quote_date desc, rfq_id desc");
    return $query->result();
  }

  function get_approved_quotation_list()
  {
    $query=$this->db->query("select one.* from (select p.*,s.supplier_name from purchase_quotation p, supplier_master s where p.supplier_id=s.supplier_id and approve=1)as one order by quote_date desc, rfq_id desc");
    return $query->result();
  }
  function get_pruchase_quotation_by_id($id)
  {
    $query=$this->db->query("select * from purchase_quotation where quote_id =$id");
    return $query->result();
  }
  function get_pruchase_quotation_tr_by_id($id,$version)
  {
    $query=$this->db->query("select * from purchase_quotation_transaction where quote_id =$id");
    return $query->result();
  }

/************************************   End CI Model    *********************************************/
} ?>
