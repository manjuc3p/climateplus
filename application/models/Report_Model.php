<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Report_Model extends CI_Model
{
  function get_purchase_indent_report_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $status = $this->input->post('status'); $status_condition="";
    $created_by = $this->input->post('created_by'); $user_condition="";

    if($status!="")
    $status_condition=" and p.status='$status' ";

    if($created_by!="")
    $user_condition=" and p.created_by='$created_by' ";

    $query=$this->db->query("select p.*, concat(e.first_name,' ',e.last_name)as created_by from purchase_indent p, employee_master e where p.created_by=e.employee_id and p.approvals<2 and indent_date between '$from' and '$to' $status_condition $user_condition order by p.indent_date desc, indent_id desc");
    return $query->result();
  }

  function get_RFQ_report_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $status = $this->input->post('status'); $status_condition="";
    $created_by = $this->input->post('created_by'); $user_condition="";
    $supplier_id = $this->input->post('supplier_id'); $supplier_condition="";
    $supplier_type = $this->input->post('supplier_type'); $supplier_type_condition="";

    if($status!="")
    $status_condition=" and r.status='$status' ";

    if($created_by!="")
    $user_condition=" and r.created_by='$created_by' ";

    if($supplier_id!="")
    $supplier_condition=" and r.supplier_id='$supplier_id' ";

    if($supplier_type!="")
    $supplier_type_condition=" and s.supplier_type ='$supplier_type' ";

    $query=$this->db->query("select one.*, two.indent_code,two.rev_version,indent_date, supplier_name from
    (select r.*, concat(em.first_name,' ',em.last_name)as rfq_created_by, supplier_name from purchase_RFQ r, employee_master em, supplier_master s where r.created_by=em.employee_id and r.supplier_id=s.supplier_id and rfq_date between '$from' and '$to' $status_condition $user_condition $supplier_condition $supplier_type_condition order by r.rfq_date desc)as one left join(select * from purchase_indent)as two on(one.indent_id=two.indent_id)");
    return $query->result();
  }

  function get_supplier_transaction_records()
  {
    $supplier_id = $this->input->post('supplier_id'); $supplier_condition="";
    $supplier_type = $this->input->post('supplier_type'); $supplier_type_condition="";

    if($supplier_type!="")
    $supplier_type_condition =" where supplier_type='$supplier_type' ";

    if($supplier_id!="")
    $supplier_condition=" and supplier_id='$supplier_id' ";

    $query=$this->db->query(" select one.*, five.grn_id,five.grn_code,five.rev_version,five.grn_date, four.po_id,four.po_code,four.rev_version as po_rev_version,four.po_date,two.rfq_id,two.rfq_code,two.rfq_date,two.rev_version as rfq_rev_version, three.quotation_id,three.quotation_code,three.rev_version as purchase_quo_rev_version,three.quotation_date from
    (select supplier_id,supplier_code,supplier_name,supplier_type from supplier_master $supplier_type_condition $supplier_type_condition ) as one left join (select rfq_id,rfq_code,rfq_date,rev_version,supplier_id from purchase_RFQ ) as two on (one.supplier_id=two.supplier_id) left join (select quotation_id,quotation_code,rev_version,quotation_date,supplier_id from purchase_quotation) as three on (one.supplier_id=three.supplier_id) left join (select po_id,po_code,rev_version,po_date,supplier_id from purchase_order ) as four on(one.supplier_id=four.supplier_id) left join (select grn_id,grn_code,rev_version,grn_date,supplier_id from GRN_master) as five on (one.supplier_id=five.supplier_id) ");
    return $query->result();
  }

  function get_po_order_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $status = $this->input->post('status'); $status_condition="";
    $supplier_type = $this->input->post('supplier_type'); $supplier_type_condition="";
    $supplier_id = $this->input->post('supplier_id'); $supplier_condition="";

    if($status!="")
    $status_condition=" and r.status='$status' ";

    if($supplier_type!="")
    $supplier_type_condition=" and s.supplier_type='$supplier_type' ";

    if($supplier_id!="")
    $supplier_condition=" and r.supplier_id='$supplier_id' ";

    $query=$this->db->query("select r.*, s.supplier_name, concat(e.first_name,' ',e.last_name)as created_by from purchase_order r, supplier_master s, employee_master e where r.created_by=e.employee_id  and r.supplier_id=s.supplier_id and po_date between '$from' and '$to' $status_condition $supplier_condition $supplier_type_condition order by po_id desc");
    return $query->result();
  }

  function get_grn_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $status = $this->input->post('status'); $status_condition="";
    $created_by = $this->input->post('created_by'); $user_condition="";
    $supplier_type = $this->input->post('supplier_type'); $supplier_type_condition="";
    $supplier_id = $this->input->post('supplier_id'); $supplier_condition="";
    $po_id = $this->input->post('po_id'); $po_condition="";

    if($status!="")
    $status_condition=" and r.status='$status' ";

    if($created_by!="")
    $user_condition=" and r.created_by='$created_by' ";

    if($supplier_type!="")
    $supplier_type_condition=" where supplier_type='$supplier_type' ";

    if($supplier_id!="")
    $supplier_condition=" and r.supplier_id='$supplier_id' ";

    if($po_id!="")
    $po_condition=" and r.po_id='$po_id' ";

    $query=$this->db->query("select one.*, two.supplier_name,three.warehouse_name from (select r.*, concat(e.first_name,' ',e.last_name)as createdBy from GRN_master r, employee_master e where r.created_by=e.employee_id and grn_date between '$from' and '$to' $status_condition $user_condition $po_condition )as one left join(select supplier_id, supplier_name from supplier_master $supplier_type_condition )as two on(one.supplier_id=two.supplier_id) left join(select * from warehouse_master)as three on(one.warehouse_id=three.warehouse_id) order by grn_date desc;");
    return $query->result();
  }

  /******************************** Sales Reports ***************************************/

  function get_customer_enquiry_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $enq_from = $this->input->post('enq_from'); $enq_from_condition="";
    $status = $this->input->post('status'); $status_condition="";

    if($status!="")
    $status_condition=" and e.status='$status' ";

    if($customer_id!="")
    $customer_condition=" and e.customer_id='$customer_id' ";

    if($enq_from!="")
    $enq_from_condition=" and e.enquiry_from='$enq_from' ";

    $query=$this->db->query("select e.*,  customer_name, concat(m.employee_code,' ',first_name,' ',last_name)as created_name from enquiry_master e, customer_master c, employee_master m where e.customer_id=c.customer_id and e.enquiry_date between '$from' and '$to'  $status_condition $customer_condition $enq_from_condition and e.created_by=m.employee_id order by enquiry_date desc");
    return $query->result();
  }

  function get_site_serve_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $status = $this->input->post('status'); $status_condition="";

    if($status!="")
    $status_condition=" and e.status='$status' ";

    if($customer_id!="")
    $customer_condition=" and e.customer_id='$customer_id' ";

    $query=$this->db->query("select e.*,  customer_name, concat(em.employee_code,' ',em.first_name,' ',em.last_name)as visit_by, concat(m.employee_code,' ',m.first_name,' ',m.last_name)as created_name from site_serve_master e, customer_master c, employee_master m, employee_master em where e.customer_id=c.customer_id and e.serve_date between '$from' and '$to' $customer_condition $status_condition and e.created_by=m.employee_id and em.employee_id=e.visit_by order by serve_date desc");
    return $query->result();
  }

  function get_quotation_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $supplier_id = $this->input->post('supplier_id'); $supplier_condition="";
    $supplier_type = $this->input->post('supplier_type'); $supplier_type_condition="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";


    if($supplier_id!="")
    $supplier_condition =" and p.supplier_id='$supplier_id' ";

    if($supplier_type!="")
    $supplier_type_condition=" and s.supplier_type='$supplier_type' ";

    if($quotation_id!="")
    $quotation_condition=" and p.quotation_id='$quotation_id' ";

    $query=$this->db->query(" select one.*, two.rfq_created_by from (select p.*,s.supplier_name from purchase_quotation p, supplier_master s where p.supplier_id=s.supplier_id and quotation_date between '$from' and '$to'  $supplier_condition  $quotation_condition $supplier_type_condition)as one left join (select rfq_id,concat(e.first_name,' ',e.last_name)as rfq_created_by from purchase_RFQ r, employee_master e where r.created_by=e.employee_id)as two on(one.rfq_id=two.rfq_id) order by quotation_date desc ");
    return $query->result();
  }

  function get_cost_sheet_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $status = $this->input->post('status'); $status_condition="";

    if($status!="")
    $status_condition=" and e.status='$status' ";

    if($customer_id!="")
    $customer_condition=" and e.customer_id='$customer_id' ";

    $query=$this->db->query("select e.*,  customer_name, concat(m.employee_code,' ',m.first_name,' ',m.last_name)as created_name from cost_sheet_master e, customer_master c, employee_master m where e.customer_id=c.customer_id and e.cost_sheet_date between '$from' and '$to' $customer_condition $status_condition and e.created_by=m.employee_id order by cost_sheet_date desc");
    return $query->result();
  }

  function get_sales_quotation_report_record()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $status = $this->input->post('status'); $status_condition="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($status!="")
    $status_condition=" and e.status='$status' ";

    if($customer_id!="")
    $customer_condition=" and e.customer_id='$customer_id' ";

    if($quotation_id!="")
    $quotation_condition=" and e.quot_id='$quotation_id' ";

    $query=$this->db->query("select e.*,  customer_name, concat(m.employee_code,' ',m.first_name,' ',m.last_name)as created_name from sales_quotation_master e, customer_master c, employee_master m where e.customer_id=c.customer_id and quotation_date between '$from' and '$to' $status_condition $customer_condition $quotation_condition and e.created_by=m.employee_id order by quotation_date desc");
    return $query->result();
  }

  function get_approved_quotation_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $status = $this->input->post('status'); $status_condition="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($status!="")
    $status_condition=" and e.status='$status' ";

    if($customer_id!="")
    $customer_condition=" and e.customer_id='$customer_id' ";

    if($quotation_id!="")
    $quotation_condition=" and e.quot_id='$quotation_id' ";

    $query=$this->db->query("select e.*,  customer_name, concat(m.employee_code,' ',m.first_name,' ',m.last_name)as created_name from sales_quotation_master e, customer_master c, employee_master m where e.customer_id=c.customer_id and quotation_date between '$from' and '$to'  $status_condition  $quotation_condition and approval=1 and e.created_by=m.employee_id order by quotation_date desc");
    return $query->result();
  }

  function get_job_pack_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $status = $this->input->post('status'); $status_condition="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($status!="")
    $status_condition=" and j.status='$status' ";

    if($customer_id!="")
    $customer_condition=" and j.customer_id='$customer_id' ";

    if($quotation_id!="")
    $quotation_condition=" and j.quot_master_id='$quotation_id' ";

    $query=$this->db->query(" select j.*, c.customer_name, q.quotation_date, quotation_code, q.project_name, concat(em.employee_code,' ',em.first_name,' ',em.last_name)as created_name from Job_pack_master j, sales_quotation_master q, customer_master c, employee_master em where j.quot_master_id=q.quot_id and q.customer_id=c.customer_id and j.created_by=em.employee_id and date(j.created_date) between '$from' and '$to' $quotation_condition $customer_condition $status_condition ");
    return $query->result();
  }

  function get_job_card_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $status = $this->input->post('status'); $status_condition="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($status!="")
    $status_condition=" and j.status='$status' ";

    if($customer_id!="")
    $customer_condition=" and j.customer_id='$customer_id' ";

    if($quotation_id!="")
    $quotation_condition=" and j.quot_master_id='$quotation_id' ";

    $query=$this->db->query(" select j.*, jm.revision, jm.project_start_date, jm.project_end_date, c.customer_name, q.quotation_date, quotation_code, q.project_name, concat(em.employee_code,' ',em.first_name,' ',em.last_name)as created_name from job_card j,Job_pack_master jm,  sales_quotation_master q, customer_master c, employee_master em where j.jpack_id=jm.jpack_id and j.quot_master_id=q.quot_id and q.customer_id=c.customer_id and j.created_by=em.employee_id and card_date between '$from' and '$to' $quotation_condition $customer_condition $status_condition ");
    return $query->result();
  }

  function get_material_issue_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $status = $this->input->post('status'); $status_condition="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($status!="")
    $status_condition=" and p.status='$status' ";

    if($customer_id!="")
    $customer_condition=" and p.customer_id='$customer_id' ";

    if($quotation_id!="")
    $quotation_condition=" and p.quote_master_id='$quotation_id' ";

    $query=$this->db->query("select one.*, two.created_name from (select p.*, j.jcode,card_date, c.customer_name, q.quotation_date,q.quotation_code,q.revision from material_issue_master p, job_card j, customer_master c, sales_quotation_master q where p.job_card_id=j.jcard_id and p.quote_master_id=q.quot_id and p.customer_id=c.customer_id and issue_date between '$from' and '$to' $quotation_condition $customer_condition $status_condition  order by p.issue_date desc) as one left join(select concat(first_name,' ',last_name)as created_name,employee_id from employee_master)as two on(one.created_by=two.employee_id) order by one.issue_date desc");

    return $query->result();
  }

  function get_production_cut_sheet_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $status = $this->input->post('status'); $status_condition="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";
    $production_id = $this->input->post('production_id'); $production_condition="";

    if($status!="")
    $status_condition=" and p.status='$status' ";

    if($customer_id!="")
    $customer_condition=" and p.customer_id='$customer_id' ";

    if($quotation_id!="")
    $quotation_condition=" and p.quote_master_id='$quotation_id' ";

    if($production_id!="")
    $production_condition=" and p.production_id='$production_id' ";

    $query=$this->db->query("select one.*, two.created_name from (select p.*, j.jcode,card_date, c.customer_name, q.quotation_date,q.quotation_code,q.revision from production_cutting_master p, job_card j, customer_master c, sales_quotation_master q where p.job_card_id=j.jcard_id and p.quote_master_id=q.quot_id and p.customer_id=c.customer_id and pdate between '$from' and '$to'  $production_condition  $quotation_condition  $customer_condition  $status_condition  order by p.pdate desc) as one left join(select concat(first_name,' ',last_name)as created_name,employee_id from employee_master)as two on(one.created_by=two.employee_id)");
    return $query->result();
  }

  function get_vehicle_log_sheet_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $vehicle_id = $this->input->post('vehicle_id'); $vehicle_condition ="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";


    if($vehicle_id!="")
    $vehicle_condition=" and vs.vehicle_id='$vehicle_id' ";

    if($quotation_id!="")
    $quotation_condition=" and vs.quotation_id='$quotation_id' ";

    $query=$this->db->query(" select vs.vehicle_log_id,vs.vehicle_id, vs.jcard_id, vs.quotation_id, j.jcode,sqm.quotation_code, rto_reg_number,engine_no,vehicle_log_date,driver_name,driver_contact_no,vs.remark from vehicle_log_sheet vs, vehicle_master vm, sales_quotation_master sqm, job_card j where vs.jcard_id=j.jcard_id and vm.vehicle_id=vs.vehicle_id and vs.quotation_id=sqm.quot_id and vehicle_log_date between '$from' and '$to' $vehicle_condition  $quotation_condition ");
    return $query->result();
  }

  function get_completed_order_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";
    $jcard_id = $this->input->post('jcard_id'); $jcard_condition="";

    if($customer_id!="")
    $customer_condition=" and c.customer_id='$customer_id' ";

    if($quotation_id!="")
    $quotation_condition=" and c.quote_master_id='$quotation_id' ";

    if($jcard_id!="")
    $jcard_condition=" and c.job_card_id='$jcard_id' ";

    $query=$this->db->query("select c.*, quotation_date, quotation_code,revision,jcode, card_date, concat(first_name,' ',last_name)as created_name, cm.customer_name from completed_orders c, sales_quotation_master q, job_card j, employee_master e, customer_master cm where c.quote_master_id=q.quot_id and c.job_card_id=j.jcard_id and c.customer_id=cm.customer_id and c.created_by=e.employee_id and order_completed_date between '$from' and '$to' $quotation_condition $customer_condition $jcard_condition order by order_completed_date desc ");
    return $query->result();
  }

  function get_material_retrun_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $customer_id = $this->input->post('customer_id'); $customer_condition="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($customer_id!="")
    $customer_condition=" and c.customer_id='$customer_id' ";

    if($quotation_id!="")
    $quotation_condition=" and r.sales_quote_id='$quotation_id' ";

    $query=$this->db->query("select * from (select r.*,  concat(e.first_name,' ',e.last_name)as createdBy from goods_return r, employee_master e where r.created_by=e.employee_id and return_date between '$from' and '$to' and r.status=0 and return_type= 'return to stock' $quotation_condition order by return_id desc) as one left join(select quotation_date,quotation_code,quot_id, customer_name,q.revision,c.customer_id,q.project_name from sales_quotation_master q, customer_master c where q.customer_id=c.customer_id $customer_condition)as two on(one.sales_quote_id=two.quot_id)");
    return $query->result();
  }

  function get_sale_invoice_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $status = $this->input->post('status');
    $quotation_id = $this->input->post('quotation_id');
    $customer_id = $this->input->post('customer_id');
    $status_condition="";  $quotation_condition=""; $cust_condition='';

    if($status!="")
    $status_condition=" and i.status='$status' ";

    if($quotation_id!="")
    $quotation_condition=" and i.quote_master_id='$quotation_id' ";
    if($customer_id!="")
    $cust_condition=" and e.customer_id='$customer_id' ";

    $query=$this->db->query("select e.*, i.invoice_date, i.invoice_code, i.status as inv_status, i.invoice_type,i.received_amount, customer_name, concat(m.employee_code,' ',m.first_name,' ',m.last_name)as created_name from invoice_master i, sales_quotation_master e, customer_master c, employee_master m where i.quote_master_id=e.quot_id  and e.customer_id=c.customer_id and approval=1 and e.created_by=m.employee_id and invoice_date between '$from' and '$to' $quotation_condition $cust_condition $status_condition  order by quotation_date desc");
    return $query->result();
  }

  function sale_order_status_by_quotation()
  {
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($quotation_id!="")
    {
      $quotation_condition=" and s.quot_id='$quotation_id' ";
    }
    else
    {
      return;
    }

    $query=$this->db->query(" select quot_id,revision,quotation_date,quotation_code,s.customer_id, c.customer_name,project_name  from  sales_quotation_master s, customer_master c where s.customer_id=c.customer_id $quotation_condition ");
    return $query->result();
  }

  function get_job_pack_order_status()
  {
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($quotation_id!="")
    {
      $quotation_condition=" and j.quot_master_id='$quotation_id' ";
    }
    else
    {
      return;
    }

    $query=$this->db->query(" select j.*, c.customer_name, q.quotation_date, quotation_code, q.project_name, concat(em.employee_code,' ',em.first_name,' ',em.last_name)as created_name from Job_pack_master j, sales_quotation_master q, customer_master c, employee_master em where j.quot_master_id=q.quot_id and q.customer_id=c.customer_id and j.created_by=em.employee_id and j.status=0 $quotation_condition");
    return $query->result();
  }

  function get_job_card_order_status()
  {
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($quotation_id!="")
    {
      $quotation_condition=" and j.quot_master_id='$quotation_id' ";
    }
    else
    {
      return;
    }

    $query=$this->db->query(" select j.*, jm.revision, jm.project_start_date, jm.project_end_date, c.customer_name, q.quotation_date, quotation_code, q.project_name, concat(em.employee_code,' ',em.first_name,' ',em.last_name)as created_name from job_card j,Job_pack_master jm,  sales_quotation_master q, customer_master c, employee_master em where j.jpack_id=jm.jpack_id and j.quot_master_id=q.quot_id and q.customer_id=c.customer_id and j.created_by=em.employee_id and j.status!=1 $quotation_condition ");
    return $query->result();
  }

  function get_material_issue_order_status()
  {
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($quotation_id!="")
    {
      $quotation_condition=" and p.quote_master_id='$quotation_id' ";
    }
    else
    {
      return;
    }

    $query=$this->db->query("select one.*, two.created_name from (select p.*, j.jcode,card_date, c.customer_name, q.quotation_date,q.quotation_code,q.revision from material_issue_master p, job_card j, customer_master c, sales_quotation_master q where p.job_card_id=j.jcard_id and p.quote_master_id=q.quot_id and p.customer_id=c.customer_id and p.status=0 and j.status!=1 $quotation_condition order by p.issue_date desc) as one left join(select concat(first_name,' ',last_name)as created_name,employee_id from employee_master)as two on(one.created_by=two.employee_id)");
    return $query->result();
  }

  function get_production_order_status()
  {
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($quotation_id!="")
    {
      $quotation_condition=" and p.quote_master_id='$quotation_id' ";
    }
    else
    {
      return;
    }

    $query=$this->db->query("select one.*, two.created_name from (select p.*, j.jcode,card_date, c.customer_name, q.quotation_date,q.quotation_code,q.revision from production_cutting_master p, job_card j, customer_master c, sales_quotation_master q where p.job_card_id=j.jcard_id and p.quote_master_id=q.quot_id and p.customer_id=c.customer_id and p.status=0 and j.status!=1 $quotation_condition order by p.pdate desc) as one left join(select concat(first_name,' ',last_name)as created_name,employee_id from employee_master)as two on(one.created_by=two.employee_id)");
    return $query->result();
  }

  function get_vehicle_logsheet_order_status()
  {
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($quotation_id!="")
    {
      $quotation_condition=" and vs.quotation_id='$quotation_id' ";
    }
    else
    {
      return;
    }

    $query=$this->db->query(" select vs.vehicle_log_id,vs.vehicle_id, vs.jcard_id, vs.quotation_id, j.jcode,sqm.quotation_code, rto_reg_number,engine_no,vehicle_log_date,driver_name,driver_contact_no,vs.remark from vehicle_log_sheet vs, vehicle_master vm, sales_quotation_master sqm, job_card j where vs.jcard_id=j.jcard_id and vm.vehicle_id=vs.vehicle_id and vs.quotation_id=sqm.quot_id  $quotation_condition ");
    return $query->result();
  }

  function get_invoice_order_status()
  {
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";

    if($quotation_id!="")
    {
      $quotation_condition=" and i.quote_master_id='$quotation_id' ";
    }
    else
    {
      return;
    }

    $query=$this->db->query("select i.*, q.quotation_code, q.quotation_date,q.grand_total,q.revision, concat(m.employee_code,' ',m.first_name,' ',m.last_name)as created_name from invoice_master i, sales_quotation_master q, employee_master m where i.quote_master_id=q.quot_id and i.created_by=m.employee_id  and i.status=0 $quotation_condition order by i.invoice_date desc, invoice_code desc");
    return $query->result();
  }

  function get_vehicle_no_dropdown()
  {
    $query=$this->db->query(" select vehicle_id,rto_reg_number from vehicle_master ");
    return $query->result();
  }

  function sale_delivery_dropdown()
  {
    $query=$this->db->query(" select dc_id,dc_code,dc_date from delivery_challan ");
    return $query->result();
  }

  function get_completion_delivery_records()
  {
    $from = date('Y-m-d', strtotime($this->input->post('from')));
    $to = date('Y-m-d', strtotime($this->input->post('to')));
    $delivery_id = $this->input->post('delivery_id'); $delivery_condition="";
    $quotation_id = $this->input->post('quotation_id'); $quotation_condition="";
    $customer_id = $this->input->post('customer_id'); $customer_condition="";

    if($delivery_id!="")
    $delivery_condition=" and i.dc_id='$delivery_id' ";

    if($quotation_id!="")
    $quotation_condition=" and i.quote_master_id ='$quotation_id' ";

    if($customer_id!="")
    $customer_condition=" and i.customer_id ='$customer_id' ";

    $query=$this->db->query("select e.*, i.dc_id, i.dc_date, i.dc_code, customer_name, concat(m.employee_code,' ',m.first_name,' ',m.last_name)as created_name from delivery_challan i, sales_quotation_master e, customer_master c, employee_master m where i.quote_master_id=e.quot_id and e.customer_id=c.customer_id and approval=1 and e.created_by=m.employee_id and dc_date between '$from' and '$to' $customer_condition  $quotation_condition $delivery_condition  order by dc_date desc");
    return $query->result();
  }


/*****************************  End CI Model  *******************************/
} ?>
