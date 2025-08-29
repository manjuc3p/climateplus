<?php $this->load->helper('stock_helper.php');?>
<div class="card-body">

	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Reports/get_item_wise_ledger" id="addform" autocomplete="off" enctype="multipart/form-data" >
		 <div class="form-group row">
		 
		      <label class="col-xs-6 col-sm-2 col-md-4 col-lg-4 col-form-label">Stock Code: <b><?php echo $model_code; ?></b></label>
		      <!--<label class="col-xs-6 col-sm-2 col-md-4 col-lg-4 col-form-label">Warehouse: <?php echo $model_code; ?></label>-->
		 </div>
            	<div class="form-group row">
		      	<label class="col-xs-6 col-sm-2 col-md-1 col-lg-1 col-form-label">From</label>
		      	<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date ">			                  
		    			<input type="text" class="form-control form-control-sm " id="from_date" name="from_date" value="<?php echo date('d-M-Y',strtotime($from_date));?>" required tabindex='3'>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>
		      	<label class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-form-label">To date</label>
		      	<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date ">			                  
		    			<input type="text" class="form-control form-control-sm " id="to_date" name="to_date" value="<?php echo date('d-M-Y',strtotime($to_date));?>" required tabindex='3'>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>
            		<div class="col-sm-3">
				<table width='100%'>
				  <tr>
				    <td>
				      <input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>" />
				      <input type="hidden" name="model_code" value="<?php echo $model_code; ?>" />
				      <input type="submit" id="view" name="go" value="Go" class="btn btn-sm btn-primary m-b-0" />
				    </form>
				  </td>
				  <td>&nbsp;</td>
				  <td>
				    <form target="_blank" action="<?php echo base_url().'index.php/'; ?>Reports/print_item_wise_ledger" id="ques1" method="post" name="ques1" >
				      <input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>" />
				      <input type="hidden" name="model_code" value="<?php echo $model_code; ?>" />
				      <input type="hidden" name="from_date" value="<?php echo $from_date; ?>" />
				      <input type="hidden" name="to_date" value="<?php echo $to_date; ?>" />
				      <input tabindex="6" type="submit" id="print" value="Print" class="btn btn-warning btn-sm" />
				    </form></td>
				    <td>&nbsp;</td>
				    <td>
				      <form action="<?php echo base_url().'index.php/'; ?>Reports/export_item_wise_ledger" id="ques1" method="post" name="ques1" >
				        <input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>" />
				        <input type="hidden" name="model_code" value="<?php echo $model_code; ?>" />
				      <input type="hidden" name="from_date" value="<?php echo $from_date; ?>" />
				      <input type="hidden" name="to_date" value="<?php echo $to_date; ?>" />
				        <input tabindex="7" type="submit" id="export" value="Export to excel" class="btn btn-warning btn-sm" />
				      </form>
				    </td>
				  </tr>
				</table>
		         </div>
            </div>

            <div class="dt-responsive table-responsive">
              <table id="basic-btn" class="table table-striped table-bordered nowrap">
                 <thead>
                            <tr>
				<th rowspan=2 width='40%'>Particulars</th>
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
				<?php  $opening_rec= get_product_opening_stock($model_code,$from_date,$warehouse_id);
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
				<td></td>
				<td><?php echo $opening_stock;?></td>
				<td><?php echo sprintf("%0.2f",$opening_price);?></td>
			</tr>
			<?php $total_out=0; $total_outPrice=0; $total_closing_qty=0; $total_closing_price=0;
			$total_inward=0;  $total_inward_price=0; 
			foreach($records as $r)
			{ ?>
			<tr>
				<td><?php echo $r->month_name;?></td>
				<td><?php echo $r->inward; $total_inward=$total_inward+$r->inward;?></td>
				<td><?php echo $r->inward_price; $total_inward_price=$total_inward_price+$r->inward_price;?></td>
				<td><?php echo $r->outward; $total_out=$total_out+$r->outward;?></td>
				<td><?php echo $r->outward_price; $total_outPrice=$total_outPrice+$r->outward_price;?></td>
				<td><?php echo $r->inward-$r->outward; $total_closing_qty=$total_closing_qty+ ($r->inward-$r->outward);?></td>
				<td><?php echo $r->inward_price-$r->outward_price; $total_closing_price=$total_closing_price+($r->inward_price-$r->outward_price); ?></td>
			</tr>
			<?php } ?>
			<tr>
				<th>Grand Total</th>
				<td><?php echo $total_inward;?></td>
				<td><?php echo $total_inward_price;?></td>
				<td><?php echo $total_out;?></td>
				<td><?php echo $total_outPrice;?></td>
				<td><?php echo $total_closing_qty;?></td>
				<td><?php echo $total_closing_price;?></td>
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
