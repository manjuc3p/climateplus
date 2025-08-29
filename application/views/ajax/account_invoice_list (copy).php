<?php $this->load->helper('myopeningbalance_helper');?>
<?php if($res) { ?>
<table class="table table-bordered table-hover" id="inv_table"  width='100%' border=1>
	<tr>
		<td>Sr No</td>
		<td>Bill No</td>
		<td>Ref NO</td>
		<td>Invoice Date</td>
		<td>TotalAmount</td>
		<td>Paid</td>
		<td>Balance</td>
	</tr>
<?php $i=1; foreach($res as $r) { 
	$paid= sprintf("%0.2f",get_paid_invoice_amount($r->utype, $r->inv_id, $account_id));
	$x=$r->grand_total-$paid;
?>
	<tr>
		<td><?php echo $i;?> <input type='checkbox' class="case"  name='select_invoice[]' id=''  onclick="p_check();" value='<?php echo $r->inv_id.'#'.$x.'#'.$r->grand_total;?>' /></td>
		<td><?php echo $r->invoice_code;?></td>
		<td><?php echo $r->ref_no;?></td>
		<td><?php echo date('d-M-Y',strtotime($r->invoice_date));?></td>
		<td align='right'><?php echo sprintf("%0.2f",$r->grand_total);?></td>
		<td align='right'><?php echo $paid; ?></td>
		<td align='right'><?php echo sprintf("%0.2f",$r->grand_total-$paid);?></td>
	</tr>
	
<?php  $i++; } ?>
</table>
<?php } ?> 
<select>
<?php foreach($res as $r) {
$paid= sprintf("%0.2f",get_paid_invoice_amount($r->utype, $r->inv_id, $account_id));
	$x=$r->grand_total-$paid; ?>
<option value='<?php echo $r->inv_id.'#'.$x.'#'.$r->grand_total;?>'><?php echo $r->invoice_code.'('.$r->ref_no.') '.date('d-M-Y',strtotime($r->invoice_date)).' TotalAmount'.$r->grand_total.' Paid:'.$paid;?></option>
<?php } ?>
</select>

