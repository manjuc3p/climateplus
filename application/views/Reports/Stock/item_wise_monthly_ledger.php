<?php $this->load->helper('stock_helper.php');?>
<div class="card-body">

		 <div class="form-group row">
		 
		      <label class="col-xs-6 col-sm-2 col-md-4 col-lg-4 col-form-label">Stock Code: <b><?php echo $model_code; ?></b></label>
		      <!--<label class="col-xs-6 col-sm-2 col-md-4 col-lg-4 col-form-label">Warehouse: <?php echo $model_code; ?></label>-->
		 </div>
            	<div class="form-group row">
		      	<label class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-form-label">For Month:</label>
		      	<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<?php echo $month_name.' '.$year; $fromdate="01-".$month_no."-".$year;?>
    	     		 </div>
            		<div class="col-sm-4">
				<table width='100%' border='0'>
				  <tr valign='top'>
				  <td>&nbsp;</td>
				  <td>
				    <form target="_blank" action="<?php echo base_url().'index.php/'; ?>Reports/print_item_wise_monthly_ledger" id="ques1" method="post" name="ques1" >
				      <input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>" />
				      <input type="hidden" name="model_code" value="<?php echo $model_code; ?>" />
				      <input type="hidden" name="from_date" value="<?php echo $from_date; ?>" />
				      <input type="hidden" name="to_date" value="<?php echo $to_date; ?>" />
				      <input type="hidden" name="month_no" value="<?php echo $month_no; ?>" />
				      <input type="hidden" name="month_name" value="<?php echo $month_name; ?>" />
				      <input tabindex="6" type="submit" id="print" value="Print" class="btn btn-warning btn-sm" />
				    </form></td>
				    <td>&nbsp;</td>
				    <td>
				      <form action="<?php echo base_url().'index.php/'; ?>Reports/export_item_wise_monthly_ledger" id="ques1" method="post" name="ques1" >
				        <input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>" />
				        <input type="hidden" name="model_code" value="<?php echo $model_code; ?>" />
				      <input type="hidden" name="from_date" value="<?php echo $from_date; ?>" />
				      <input type="hidden" name="to_date" value="<?php echo $to_date; ?>" />
				      <input type="hidden" name="month_no" value="<?php echo $month_no; ?>" />
				      <input type="hidden" name="month_name" value="<?php echo $month_name; ?>" />
				        <input tabindex="7" type="submit" id="export" value="Export to excel" class="btn btn-warning btn-sm" />
				      </form>
				    </td>
				  </tr>
				</table>
		         </div>
            </div>
            <div class="dt-responsive table-responsive">
              <table id="basic-btn" class="table table-striped table-bordered nowrap" style='font-size:11px;font-weight:bold'>
                 <thead>
                            <tr>
				<th rowspan=2 width='40%'>Date</th>
				<th rowspan=2 width='40%'>Particulars</th>
				<th rowspan=2 width='40%'>Type</th>
				<th rowspan=2 width='40%'>Vch No</th>
				<th colspan=2 align='center'>Inward</th>
				<th colspan=2 align='center'>Outward</th>
				<th colspan=2 align='center'>Closing</th>
			   </tr>
                            <tr>
				<th>Quantity</th>
				<th>Value</th>
				<th>Quantity</th>
				<th>Value</th>
				<th>Quantity</th>
				<th>Value</th>
			   </tr>
		</thead>

		<tbody>
			<tr>
				<?php  $opening_rec= get_product_opening_stock($model_code,$fromdate,$warehouse_id);
				$opening_stock=0; $opening_price=0;
				foreach($opening_rec as $op)
				{
					$opening_stock= $op->stock;
					$opening_price= $op->total_price;
				}
				
				 ?>
				<td>Opening</td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php echo $opening_stock;?></td>
				<td><?php echo sprintf("%0.2f",$opening_price);?></td>
				<td></td>
				<td></td>
				<td><?php echo $opening_stock;?></td>
				<td><?php echo sprintf("%0.2f",$opening_price);?></td>
			</tr>
			<?php $total_out=0; $total_outPrice=0; $total_closing_qty=0; $total_closing_price=0;
			$total_inward=0;  $total_inward_price=0; $inqty=0;$inprice=0;$outqty=0;$outprice=0;
			foreach($records as $r)
			{ ?>
			<tr>
				<td><?php echo date('d-M-Y',strtotime($r->stock_date));?></td>
				<td>
					<?php $invoice_rec=array();$pname ='';$vch_no = '';
						if($r->remark=='Delivery Order')
						{
							$invoice_rec= get_sales_dc($r->trans_id);
						}
						elseif($r->remark=='GRN')
						{
							$invoice_rec = get_purchase_grn($r->trans_id);
						}
						foreach($invoice_rec as $k)
						{
							$pname = $k->perticular_name;
							$vch_no = $k->vch_no;
						}
						echo $pname;
					?>
				</td>
				<td><?php if($r->remark=='Delivery Order')echo 'Sales'; elseif($r->remark=='GRN')echo 'Purchase'; else echo $r->remark; ?></td>
				<td><?php echo $vch_no;?></td>
				<td><?php if($r->stock_type=='IN') { echo $inqty=$r->inward; $total_inward=$total_inward+$r->inward; } ?></td>
				<td><?php if($r->stock_type=='IN') { echo $inprice=$r->price; $total_inward_price=$total_inward_price+$r->price;}?></td>
				<td><?php if($r->stock_type=='OUT') { echo $outqty=$r->inward; $total_out=$total_out+$r->inward;}?></td>
				<td><?php if($r->stock_type=='OUT') { echo $outprice=$r->price; $total_outPrice=$total_outPrice+$r->price;}?></td>
				<td><?php echo $opening_stock= $opening_stock+$inqty-$outqty; $total_closing_qty=$total_closing_qty+ $opening_stock;?></td>
				<td><?php echo $opening_price= $opening_price+$inprice-$outprice; $total_closing_price=$total_closing_price+$opening_price; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<th>Grand Total</th>
				<td></td>
				<td></td>
				<td></td>
				<td><?php echo $total_inward;?></td>
				<td><?php echo $total_inward_price;?></td>
				<td><?php echo $total_out;?></td>
				<td><?php echo $total_outPrice;?></td>
				<td><?php echo $opening_stock;?></td>
				<td><?php echo $opening_price;?></td>
			</tr>
		
		</tbody>
            </table>
           </div>


        
        </div>
    </div>
</div>
</div>
</div>
</div>
