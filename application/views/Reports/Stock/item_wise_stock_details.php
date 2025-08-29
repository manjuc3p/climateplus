<div class="card-body">
	
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Reports/get_item_wise_stock" id="addform" autocomplete="off" enctype="multipart/form-data" >
            <div class="form-group row">
              <label class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-form-label">Warehouse</label>
              <div class="col-xs-12 col-sm-10 col-md-2 col-lg-2">
                <select name="warehouse_id" id="warehouse_id" class="form-control select2" required >
		      <option value="">Select warehouse</option>
		      <?php foreach($store_records as $g) { ?>
			   <option selected value="<?php echo $g->warehouse_id;?>"><?php echo $g->warehouse_name.' '.$g->city.' '.$g->person_incharge; ?></option>
		      <?php } ?>
	      	  </select>
              </div>
              
              	<label class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Product</label>
              	<div class="col-xs-12 col-sm-10 col-md-3 col-lg-3">
		        <select tabindex="1" class="form-select form-control-sm select2 select2Width" id="product_id" name="product_id" >
			<option value="">Select Code</option>
			<?php foreach($products as $s) {?>
			  <option <?php if($s->product_id==$item_id) echo 'selected'; ?> value="<?php echo $s->product_id; ?>"><?php echo $s->item_name;?></option>
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
                    <form target="_blank" action="<?php echo base_url().'index.php/'; ?>Reports/print_item_wise_stock" id="ques1" method="post" name="ques1" >
                      <input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>" />
                      <input type="hidden" name="product_id" value="<?php echo $item_id; ?>" />
                      <input tabindex="6" type="submit" id="print" value="Print" class="btn btn-warning btn-sm" />
                    </form></td>
                    <td>&nbsp;</td>
                    <td>
                      <form action="<?php echo base_url().'index.php/'; ?>Reports/export_item_wise_stock" id="ques1" method="post" name="ques1" >
                        <input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>" />
                        <input type="hidden" name="product_id" value="<?php echo $item_id; ?>" />
                        <input tabindex="7" type="submit" id="export" value="Export to excel" class="btn btn-warning btn-sm" />
                      </form>
                    </td>
                  </tr>
                </table>
              </div>
            </div>

	   <div class="dt-responsive table-responsive">
		<table id="datatable" class="table table-striped" data-toggle="data-table">	
		<thead>
		<tr>
			<th>Sr. No</th>
			<th>Stock Date</th>
			<th>Item Code</th>
			<th>Bill No</th>
			<th>Order ref</th>
			<th>Box no</th>
			<th>Quantity</th>
			<th>Strage Location</th>
		</tr>
		</thead>
		<tbody>
		<?php $i=1; foreach($records as $row) :?>
		<tr>
			<td><?php echo  $i; $i++;?></td>
			<td><?php echo date('d-m-Y',strtotime($row->stock_date)); ?></td>
			<td>
					<?php echo $row->item_code.' '.$row->item_name;?>
			</td>
			<td><?php echo $row->bill_no; ?></td>
			<td><?php echo $row->order_ref_no; ?></td>
			<td><?php echo $row->box_no; ?></td>
			<td><?php echo $row->qty; ?></td>
			<td><?php echo $row->storage_location; ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
           </div>


        
        </div>
    </div>
</div>
</div>
</div>
</div>
