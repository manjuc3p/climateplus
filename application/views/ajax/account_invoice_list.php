<?php $this->load->helper('myopeningbalance_helper');?>
<option value=''>Select</option>
<?php foreach($res as $r) {
$paid= sprintf("%0.2f",get_paid_invoice_amount($r->utype, $r->inv_id, $account_id));
	$x=$r->grand_total-$paid; ?>
<option value='<?php echo $r->inv_id.'#'.$x.'#'.$r->grand_total;?>'><?php echo $r->invoice_code.'('.$r->ref_no.') '.date('d-M-Y',strtotime($r->invoice_date)).' TotalAmount'.$r->grand_total.' Paid:'.$paid;?></option>
<?php } ?>

