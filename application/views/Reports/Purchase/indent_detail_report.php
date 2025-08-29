<?php $this->load->helper('purchase_helper.php');?>
<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header table-card-header">
					<h5>Indent Details Report</h5>
				</div>
				<form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Reports/get_indent_detail_report" id="question" method="post" name="question" >
					<div class="form-group row">
						<label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">Project</label>
						<div class="col-sm-6">
							<select tabindex="1" name="project" id="project" class="form-control  select2" required>
								<option value="">Please Select</option>
								<?php foreach($project_records as $r):?>
									<option <?php if($project==$r->project_id):?> selected <?php endif;?> value="<?php echo $r->project_id?>" ><?php echo $r->project_code.' '.$r->project_name;?></option>
								<?php endforeach;?>
							</select>
						</div>
						<input type="submit" id="view" name="go" value="Go" class="btn btn-primary m-b-0" />
					</div>
				</form>

				<div class="card-block">
					<div class="dt-responsive table-responsive">
						<table id="basic-btn" class="table table-bordered nowrap">
							<thead>
								<tr>
									<th>Sr.No</th>
									<th>Indent Code<br>Date</th>
									<th>Buyer Name</th>
									<th>Item Name</th>
									<th>Item Description</th>
									<th>Make</th>
									<th>UOM</th>
									<th>Indent<br> Qty</th>
									<th>Indent Remark</th>
									<th>Approved Date</th>
									<th>Approve Qty</th>
									<th>Vendor Name</th>
									<th>PO No/PO.Date/PO.Revision</th>
									<th>PO Delivery Date</th>
									<th>PO Qty</th>
									<th>PO Balance Qty</th>
									<th>PO.Approved By</th>
									<th>Buyer Remark</th>
									<th>GRN No<br>GRN Date</th>
									<th>GRN Qty</th>
									<th>DC No<br>DC Date</th>
									<th>Site GRN No<br>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach($records as $row) :?>
									<tr>
										<td><?php echo  $i; $i++;?></td>
										<td>
											<a target='blank' href="<?php echo base_url().'index.php/Purchase/view_purchase_indent_details/'.$row->indent_id.'/'.$row->rev_version;?>"><?php echo $row->indent_code; ?></a>
										</br>
										<?php echo date('d-M-Y', strtotime($row->indent_date));?>
									</td>
									<td>
										<?php
										if($row->indent_id!='' || $row->item_id!='')
										{
											$buyer_id=get_approved_indent_item_details($row->indent_id,'buyer_id',$row->item_id);
											if($buyer_id!='')
											echo get_emp_details_by_id($buyer_id);
										}?>
									</td>
									<td><?php echo $row->item_code.' '.$row->item_name; ?></td>
									<td><textarea rows="7" cols="12" readonly><?php echo $row->item_desc.' '.$row->product_code_remark;?></textarea></td>
									<td><?php echo $row->make; ?></td>
									<td><?php echo $row->unit_abbr; ?></td>
									<td><?php echo $row->quantity; ?></td>
									<td><?php echo $row->comment; ?></td>
									<td><?php echo date('d-M-Y',strtotime(get_approved_indent_item_details($row->indent_id,'updated_date',$row->item_id))); ?></td>
									<td><?php echo get_approved_indent_item_details($row->indent_id,'quantity',$row->item_id); ?></td>
									<td>
										<?php $sid=get_po_item_details($row->indent_id,'pt.supplier_id',$row->item_id);?>
										<?php if($sid!='') echo get_supplier_details_by_id($sid);?>
									</td>
									<td>
										<?php echo get_po_item_details($row->indent_id,'po_code',$row->item_id); ?><br>
										<?php $pd= get_po_item_details($row->indent_id,'po_date',$row->item_id);
										if($pd!='') echo date('d-M-Y',strtotime($pd));
										?><br>
										<?php echo 'R'.get_po_item_details($row->indent_id,'po_version',$row->item_id); ?>
									</td>
									<td>
										<?php $pdDate=get_po_item_details($row->indent_id,'pt.delivery_date',$row->item_id);
										if($pdDate!='') echo date('d-M-Y',strtotime($pdDate));
										?>
									</td>
									<td>
										<?php echo $a=get_po_item_details($row->indent_id,'quantity',$row->item_id);?>
									</td>
									<td>
										<?php $b=get_po_item_details($row->indent_id,'req_qty',$row->item_id); ?>
										<?php echo $b-$a;?>
									</td>
									<td>
										<?php $E= get_po_item_details($row->indent_id,'approved_by',$row->item_id);?>
										<?php
										if($E!='')
										echo get_emp_details_by_id($E);
										?>
									</td>
									<td>
										<?php echo $a=get_po_item_details($row->indent_id,'remark',$row->item_id);?>
									</td>
									<td>
										<?php echo get_grn_item_details($row->indent_id,'grn_code',$row->item_id,'GRN');?><br>
										<?php $grnDate= get_grn_item_details($row->indent_id,'grn_date',$row->item_id,'GRN');
										if($grnDate!='') echo date('d-M-Y',strtotime($grnDate));
										?>
									</td>
									<td>
										<?php echo get_grn_item_details($row->indent_id,'accepted_quantity',$row->item_id,'GRN');?>
									</td>
									<td>
										<?php echo get_DC_item_details($row->indent_id,'dc_code',$row->item_id);?><br>
										<?php $dc_date= get_DC_item_details($row->indent_id,'dc_date',$row->item_id);
										if($dc_date!='') echo date('d-M-Y',strtotime($dc_date));
										?>
									</td>
									<td> <?php
									echo get_grn_item_details($row->indent_id,'grn_code',$row->item_id,'GRN At Site(Dc)');?>
									<br>
									<?php $grnDate= get_grn_item_details($row->indent_id,'grn_date',$row->item_id,'GRN');
									if($grnDate!='') echo date('d-M-Y',strtotime($grnDate));
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<th>Sr.No</th>
							<th>Indent Code<br>Date</th>
							<th>Buyer Name</th>
							<th>Item Name</th>
							<th>Item Description</th>
							<th>Make</th>
							<th>UOM</th>
							<th>Indent<br> Qty</th>
							<th>Indent Remark</th>
							<th>Approved Date</th>
							<th>Approve Qty</th>
							<th>Vendor Name</th>
							<th>PO No/PO.Date/PO.Revision</th>
							<th>PO Delivery Date</th>
							<th>PO Qty</th>
							<th>PO Balance Qty</th>
							<th>PO.Approved By</th>
							<th>Buyer Remark</th>
							<th>GRN No<br>GRN Date</th>
							<th>GRN Qty</th>
							<th>DC No<br>DC Date</th>
							<th>Site GRN No<br>Date</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

</div>
</div>

<div id="styleSelector">
</div>
</div>
</div>
</div>
</div>
</div>
</div>



<div id="styleSelector">
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</body>
</html>


<script>
function showmodal(indent_id,version)
{
	$('#indent-Modal').modal('show');
	document.getElementById('indent_id').value=indent_id;
	document.getElementById('version').value=version;
	return true;
}
</script>
