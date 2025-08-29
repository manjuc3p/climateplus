
	<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table" data-toggle="data-table">
                                        <thead>
                                            <tr>
							<th>Sno</th>
							<th>Customer</th>
							<th>Project</th>
							<th>Costing Date</th>
							<th>Total Sales Cost</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody style="font-size:13px; font-weight:800px;">
					<?php $i=1; foreach($records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td ><?php echo $row->cust_name.'<br> ENq PO '.$row->enquiry_code;?></td>
							<td><?php echo $row->project_name;?></td>
							<td><?php echo date('d-M-Y',strtotime($row->cs_date));?><br></td>
							<td><?php echo $row->sale_cost;?></td>
							<td>
							<a href="<?php echo base_url().'index.php/Sales/edit_cost_sheet/'.$row->cost_sheet_id.'/1/0';?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
							<!--<a target='_blank' href="<?php echo base_url().'index.php/Sales/print_cost_sheet/'.$row->cost_sheet_id;?>" title="print quotation">Print</a>-->
							</td>
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
        <!-- Static Table End -->

