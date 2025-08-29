
<div class="card-body">
	<form class="form-horizontal" action="<?php echo base_url().'index.php/accounts/search_individual_ledger_details'; ?>" id="receipt" method="post" name="receipt" >
	    <div class="form-group row">
	    	<label class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-form-label">From</label>
		      	<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date ">			                  
		    			<input type="text" class="form-control form-control-sm " id="from_date" name="from_date" value="<?php echo date('d-M-Y',strtotime($from_date));?>" required tabindex='3'>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>
		      	<label class="col-xs-6 col-sm-2 col-md-3 col-lg-3 col-form-label">To date</label>
		      	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" role='group'>
				<div class="input-group date ">			                  
		    			<input type="text" class="form-control form-control-sm " id="to_date" name="to_date" value="<?php echo date('d-M-Y',strtotime($to_date));?>" required tabindex='3'>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>
	     </div>
	     <div class="form-group row">
		      	<label class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-form-label">Ledger Account</label>
		      	<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
				<select tabindex="1" class="form-select form-control-sm select2 select2Width" id="account_id" name="account_id" >
					<option value="">Select Code</option>
					<?php foreach($account_ledgers as $s) {?>
					  <option <?php if($s->account_id==$account_id) echo 'selected'; ?> value="<?php echo $s->account_id; ?>"><?php echo $s->account_name;?></option>
					<?php } ?>
				      </select>
    	     		 </div>
    	     		 <div class="col-sm-3">
				<table width='100%'>
				  <tr>
				    <td>
				      <input type="submit" id="view" name="go" value="Go" class="btn btn-sm btn-primary m-b-0" />
				    </form>
				  </td>
				  <td>&nbsp;</td>
				  <td>
				    <form target="_blank" action="<?php echo base_url().'index.php/'; ?>Accounts/print_individual_ledger_account_details" id="ques1" method="post" name="ques1" >
				      <input type="hidden" name="from_date" value="<?php echo $from_date; ?>" />
				      <input type="hidden" name="to_date" value="<?php echo $to_date; ?>" />
				      <input type="hidden" name="account_id" value="<?php echo $account_id; ?>" />
				      <input tabindex="6" type="submit" id="print" value="Print" class="btn btn-warning btn-sm" />
				    </form></td>
				    <td>&nbsp;</td>
				    <td>
				      <form action="<?php echo base_url().'index.php/'; ?>Accounts/export_individual_ledger_account_details" id="ques1" method="post" name="ques1" >
				      <input type="hidden" name="from_date" value="<?php echo $from_date; ?>" />
				      <input type="hidden" name="to_date" value="<?php echo $to_date; ?>" />
				      <input type="hidden" name="account_id" value="<?php echo $account_id; ?>" />
				        <input tabindex="7" type="submit" id="export" value="Export to excel" class="btn btn-warning btn-sm" />
				      </form>
				    </td>
				  </tr>
				</table>
		      </div>
	    </div>
            
	    <div class="form-group row">
                    <div class="col-md-12">
                            	<table id="example1" class="table table-bordered table-striped" width='100%' style="font-size:14px;">
	        		<thead>
					<tr>
						<th>Sr.No</th>
		                    		<th>Txn Date</th>
		        			<th>Particulars</th>
		          			<th>Voucher Code</th>
		                    		<th>Txn Type</th>
		        			<th>Debit</th>
		        			<th>Credit</th>
                			</tr>
				</thead>
				<?php
			   		$count =0;$total =0;$totalc=0;$credit_amount=0; $debit_amount=0;
					$display_total_row=0;$tamount =0;
					$opening_balance=0;$opening_bal=0;
					$for_loop=0;$closing_row=0;$display_total_closing=0;$i=0; $j=1;
			   		$val_from =date('d-m-Y',strtotime($from_date));
					$debit_amount_new =0;$credit_amount_new=0;$display_total_row=0;
			 		$this->load->helper('myopeningbalance');
		                        $opening_bal=calculate_opening_bal($from_date,$account_id);
		                       
			 		if($for_loop == 0){
		      	  		        if($opening_bal > 0) : ?>
						<tr >
							<td colspan="5">Dr. Opening Balance</td>
							<td align="right"><?php echo sprintf("%0.2f",$opening_bal)." Dr";?></td>
							<?php $opening_balance = $total ?>
							<td ></td>
					   	</tr>
						<?php else :?>
						<tr bgcolor="#ccccc">
							<td colspan="5">Cr. Opening Balance</td>
							<td ></td>
							<td align="right"><?php echo sprintf("%0.2f",($opening_bal)*(-1))." Cr";?></td>
							
					   	</tr>
					   	<?php
					   	 endif;  
					   	 }
					   	 if(!empty($ledger_transaction_records)) :
                            			foreach($ledger_transaction_records as $row):?>
						<?php
							$close_bal=$opening_bal;
							$for_loop++;?>
						<tr>
						<?php if ($row->voucher_date>0 && $row->amount>0)
						{
					   		$time= strtotime($row->voucher_date);
							$new_date= date('d-M-Y',$time);?>
							<td><?php echo $j; ?></td>
				   			<td><?php echo $new_date; ?></td>
				   			<td>
				   				<?php 
				   				if($row->voucher_type == 'S') 
			   						echo 'Ref No: '.$row->ref_no.'<br>Invoice Date: '.
			   						date('d-M-Y',strtotime($row->invoice_date)).'<br> 
			   					        Client PO: '.$row->po_code;
			   					else if($row->voucher_type == 'G') 
			   						echo 'Invoice No: '.$row->ref_no.'<br>
			   					      Invoice Date: '.date('d-M-Y',strtotime($row->invoice_date)).'<br> 
			   					      Ref No: '.$row->po_code;
		   						else
			   						echo $row->narration;?>
		   					</td>
					   		<td><?php echo $row->voucher_code; ?></td>
					   		<td>
								<?php
						   			if($row->voucher_type == 'S')
										echo 'Sales Invoice';
						   			if($row->voucher_type == 'G')
										echo 'PO GRN Invoice';
									if($row->voucher_type == 'R')
										echo 'Receipt';
									if($row->voucher_type == 'P')
										echo 'Payment';
									if($row->voucher_type == 'C')
										echo 'Credit Note';
									if($row->voucher_type == 'D')
										echo 'Debit Note';
									if($row->voucher_type == 'J')
										echo 'Journal';
									if($row->voucher_type == 'N')
										echo 'Contra Entry';
									?>
					   		</td>

					   		<?php $tamount = $row->amount;?>
							<?php if(strtoupper($row->drcr_type)=="DR") {
					   				$display_total= number_format((float)$tamount, 2, '.', '');?>
			   				<td align="right"><?php echo sprintf("%0.2f",$display_total) ; ?></td>
			   				<?php $debit_amount = $debit_amount + $tamount; } else echo "<td></td>";?>

							<?php

							if(strtoupper($row->drcr_type)=="CR"){?>
			   				<?php $display_total= number_format((float)$tamount, 2, '.', '');?>
			   				<td   align="right"><?php echo sprintf("%0.2f",$display_total) ; ?></td>
							<?php	$credit_amount = $credit_amount + $tamount;
								}
							else echo "<td></td>";

							$j++;
							}?>
				 		</tr>
							<?php
					   		$time = strtotime($to_date);
							$val_to = date( 'y-m-d', $time );
					   		$val_to = strtotime($to_date);
					   		$time2 = strtotime($row->voucher_date);
					   		if( $time2 < $val_to):
					   			if(strtoupper($row->drcr_type)=="DR"):
					 	  			$total = $total + $tamount;
					   			endif;
					   			if(strtoupper($row->drcr_type)=="CR"):
					   				$total = $total - $tamount;
								endif;
					   		endif;
					 endforeach;
					endif;?>
					<tfoot>
				               <tr>
				   			<td ></td>
				   			<td ></td><td ></td><td></td>
				   			<td style="font-weight: bold">Trans Total:</td>
				   			<?php $display_total_cr=0;
			   				if($opening_bal > 0)
							{
				   				$display_total_db = $debit_amount + $opening_bal;
								$display_total_cr = $credit_amount;
							}
							else {
				   			    $opening_bal=$opening_bal*-1;
								$display_total_cr = $credit_amount+$opening_bal;
								$display_total_db = $debit_amount;
							}?>

				   			<?php $display_total= number_format((float)($display_total_db), 2, '.', '');?>
				   			<td   align="right" style="font-weight: bold"><?php echo sprintf("%0.2f",$debit_amount);?></td>
				   			<?php
				   			if($display_total_cr < 0)
				   				$display_total= $display_total_cr*-1;
							else
								$display_total= $display_total_cr;
				   			?>
				   			<td align="right" style="font-weight: bold"><?php echo sprintf("%0.2f",$credit_amount);?></td>
					   	</tr>
				   		<?php

				   			if($display_total_cr < 0)
				   			$bal = $display_total_db - ($display_total_cr*-1);
							else {
								$bal = $display_total_db - ($display_total_cr);
							}
				   		?>
						<?php
						if($bal > 0):?>
					   		  <tr bgcolor="#ccccc">
					   			<td colspan="5">Dr. Closing Balance</td>
					   			<?php $display_total= $bal;?>
				   				<td  align="right" style="font-weight: bold"><?php echo sprintf("%0.2f",($display_total))." Dr"; ?></td>
					   			<td></td>
					   		</tr>
						<?php
						else :
						?>
				   		 <tr class="last" bgcolor="#ccccc">
				   			<td colspan="5">Cr. Closing Balance</td>
				   			<?php $display_total= $bal*-1;?>
							<td ></td>
							<td  align="right" style="font-weight: bold" ><?php echo sprintf("%0.2f",($display_total))." Cr"; ?></td>
				   		</tr>
					<?php
					endif;

					?>
			</tfoot>
			</table>
		             </div>
		         </div>
		      </form>

                </div>
    		</div>
	</div>
	</div>
	</div>
</div>



<script>
$(document).ready(function(){
	var i=1;
	$("#dr_add_row").click(function()
	{
	     $('#dr_addr'+i).html("<td><select class='form-select form-control-sm select2 select2Width' id='debtor"+i+"' name='debtor[]' onchange='get_account_balance("+i+",'dr')' requird><option value=''>Select Code</option><?php foreach($sundry_detors_records as $s) {?>  <option value='<?php echo $s->account_id; ?>'><?php echo $s->account_name;?></option><?php } ?></select><br><label id='set_balancedr"+i+"'>Balance</label></td><td><input type='number' step='0.01' name='dr_amount[]' id='dr_amount"+i+"' class='form-control form-control-sm debit_sum' min='0' required onkeyup='calculate_grand_total()'></td><td><a onclick='remove_row_dr("+i+");' id='delete_row1' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#dr_body tr:last').after('<tr id="dr_addr'+(i+1)+'"></tr>');
	      i++; 	     	
	     $('.select2').select2({ width: "220px" });
	});
	$("#delete_row1").click(function(){
		 if(i>1){
			 $("#dr_addr"+(i-1)).html('');
			 i--;
		 }
	 });
	 
	 var k=1;
	$("#cr_add_row").click(function()
	{
	     $('#cr_addr'+k).html("<td><select class='form-select form-control-sm select2 select2Width' id='debtor"+k+"' name='debtor[]' onchange='get_account_balance("+k+",'dr')' requird><option value=''>Select Code</option><?php foreach($sundry_detors_records as $s) {?>  <option value='<?php echo $s->account_id; ?>'><?php echo $s->account_name;?></option><?php } ?></select><br><label id='set_balancedr"+k+"'>Balance</label></td><td><input type='number' step='0.01' name='dr_amount[]' id='dr_amount"+k+"' class='form-control form-control-sm credit_sum' min='0' required onkeyup='calculate_grand_total()'></td><td><a onclick='remove_row_cr("+k+");' id='delete_row2' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#cr_body tr:last').after('<tr id="cr_addr'+(k+1)+'"></tr>');
	      k++; 	     	
	     $('.select2').select2({ width: "220px" });
	});
	$("#delete_row2").click(function(){
		 if(k>1){
			 $("#cr_addr"+(k-1)).html('');
			 i--;
		 }
	 });
});  


function remove_row_cr(append_id)
{    	 
$('#cr_addr'+append_id).attr("id","cr_addr"+append_id+"x");
$('#cr_addr'+append_id+"x").remove();
}

function get_account_balance(append_id,type)
{
	var account_id=document.getElementById("debtor"+append_id).value;
	var today="<?php echo date('Y-m-d')?>";
	$.ajax
	({
		url: "<?php echo site_url('Accounts/get_account_balance'); ?>",
		type: 'POST',
		data: {account_id: account_id, today:today },
		success: function(msg) {
			if(msg)
			{
				//alert(msg);
				document.getElementById('set_balance'+type+append_id).innerHTML='Balance: '+msg;
				
			}
		}
	});
}
function calculate_grand_total()
{
	var i_value=0;i_total=0;
	$('.debit_sum').each(function()
	{
		i_value=$(this).val();
		if(i_value=='')
			 i_value = 0;
		else
			i_total+=parseFloat(i_value);
	});
	if(isNaN(i_total)) var dr_total = 0;
	
	var k_value=0;k_total=0;
	$('.credit_sum').each(function()
	{
		k_value=$(this).val();
		if(k_value=='')
			 k_value = 0;
		else
			k_total+=parseFloat(k_value);
	});
	if(isNaN(k_total)) var cr_total = 0;

	document.getElementById("debit_total").value= parseFloat(i_total).toFixed(2);
	document.getElementById("credit_total").value= parseFloat(k_total).toFixed(2);
	//check_total();
}

function check_total()
{
 	var dr_total=$('#debit_total').val();
	var cr_total=$('#credit_total').val();

	 if(parseFloat(cr_total) != parseFloat(dr_total))
	{
	     alert("Both debit total and credit total must match");
	     return false;
	}
}
    
</script>
