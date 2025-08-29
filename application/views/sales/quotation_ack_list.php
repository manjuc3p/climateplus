
	<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table" data-toggle="data-table">
                                        <thead>
                                            <tr>
							<th>Sno</th>
							<th>Quotation</th>
							<th>Customer</th>
							<th>Petrostar NO</th>
							<th>Ack Rev</th>
							<th>start date <br>Delivery date</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody style="font-size:12px; font-weight:700px;">
					<?php $i=1; foreach($records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td>
								<?php echo $row->quotation_code;?><br>
								<?php echo date('d-M-Y',strtotime($row->quotation_date));?><br>
								<?php echo 'R'.$row->revision;?>
							</td>
							<td ><?php echo $row->cust_name.'<br> Client PO '.$row->po_number;?></td>
							<td><?php echo $row->catalyst_ref;?></td>
							<td><?php echo $row->ack_revision;?></td>
							<td><?php echo $row->start_date.'<br>'.$row->delivery_date;?></td>
							<td>
							<a target='_blank' href="<?php echo base_url().'index.php/Sales/print_quotation_ack/'.$row->quote_id.'/'.$row->revision.'/'.$row->sno;?>" title="print quotation">Print</a>
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

