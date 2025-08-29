<div class="card-body">
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/edit_purchase_quotation_records" id="addform" autocomplete="off" enctype="multipart/form-data" >
<?php  foreach($records1 as $row) :?>
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Quotation Date</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	      <input type="text" name="date" id="date" class="form-control date_today" value="<?php echo date('d-m-Y',strtotime($row->quotation_date)); ?>" readonly>
	      </div>
	     <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Quotation COde</label>
	    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	
	      <input type="text" name="code" id="code" class="form-control" value="<?php echo $row->quotation_code; ?>" readonly>
	      
	      </div>	 
	</div>
	<div class="form-group row">
	     <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Uploaded Document</label>
	    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">	     
	       <?php if($row->document_path!='') {?>
		<a href="<?php echo base_url().$row->document_path;?>" download>File</a>
		<?php } else echo 'file not available';?>	      
	      </div>	 
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Vendor Quotation No</label>
	    <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
	      <input type="text" name="qno" id="qno" class="form-control" value="<?php echo $row->supplier_Qcode; ?>" required>
	      </div>
	</div>
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Remark</label>
	    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
	    	<textarea name="remark" id="remark" class="form-control" rows="3" cols="2"><?php echo $row->remark; ?></textarea>
	    </div>   	    
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Status</label>
	    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
	    	<select name="status" id="status" class="form-control" required>
	      	<option <?php if($row->status==0) echo 'selected' ?> value="0">Atcive</option>
	      	<option <?php if($row->status==1) echo 'selected' ?> value="1">InAtcive</option>
		 </select>
	    </div>   	    
	</div>
	
<input type="hidden"  name="quotation_id" value="<?php echo $row->quotation_id;?>" >
<input type="hidden"  name="project_id" value="<?php echo $row->project_id;?>" >
<input type="hidden"  name="revision_version" value="<?php echo $row->rev_version+1;?>" >
       
	
	<div class="form-group row">
	    <div class="col-md-12">
		<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
				 <tr>
				<th></th>
				<th colspan=3 align='center'>GLASS DIMENSIONS</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			    </tr>
			    <tr>
	                    	<th title="Item">Item</th>
			            <th title="">WIDTH <br>(m)</th>
			            <th title="">Height <br>(m)</th>
			            <th title=" ">Quantity</th>
	                    	    <th title="Unit Of Measurement">Unit of<br>measure</th>
			            <th title=" ">Total AREA(m<sup>2</sup>) /<br> Length/ Qty </th>
	                    	    <th title="file">Price</th>
	                            <th title="Comments">Amount</th>
	                            <th title="Comments">Attachment</th>
				</tr>
			    </thead>					
			    <tbody>			
				<?php $i=1; foreach($records2 as $tr): ?>	
				<tr class="color-default">
					<td>
						<?php foreach($item_records as $g) { ?>			
						     <?php if($tr->item_id==$g->item_master_id){ ?> 
							<label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-form-label">
							<a href="#" onclick="call_me(<?php echo $tr->item_id ?>)"> <?php echo $g->item_code.' '.$g->item_name;?></a>
							</label>
					      <?php } } ?>
				    		<input type='hidden' name='item_id[]' value="<?php echo $tr->item_id; ?>" />	
						<textarea class="form-control" name="desc[]" rows="3" cols="2" readonly><?php echo $tr->item_desc;?></textarea>
					</td>								
					<td><input type="number" min=1 class="form-control"  style="width: 90px;" id="width<?php echo $tr->quotation_trans_id;?>" name="width[]" placeholder="Width" step="0.00" value='<?php if($tr->width > 0) echo $tr->width; ?>' onblur='calculate_area("<?php echo $tr->quotation_trans_id;?>")' readonly></td>
					<td>
						<input type="number" min=1 class="form-control"  style="width: 90px;" id="height<?php echo $tr->quotation_trans_id;?>" name="height[]" placeholder="height" step="0.01" value='<?php if($tr->height >0) echo $tr->height;?>' onblur='calculate_area("<?php echo $tr->quotation_trans_id;?>")' readonly>
					</td>
					<td><input type='text' class="form-control col-md-12" id="quantity<?php echo $tr->quotation_trans_id;?>" name="quantity[]" value="<?php echo $tr->quantity; ?>" onblur='calculate_area("<?php echo $tr->quotation_trans_id;?>")' >
					</td>
					<td>
						<?php foreach($unit_records as $g) { ?>			
						     <?php if($tr->unit_id==$g->unit_id){ ?> 
							<label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-form-label">
								 <?php echo $g->unit_abbr;?>
							</label>
					      <?php } } ?>
					     
					<input type='hidden' name='unit_id[]' value="<?php echo $tr->unit_id; ?>"/>					
					</td>
					<td>
						<input type="number" min=1 class="form-control"  style="width: 90px;" id="area<?php echo $tr->quotation_trans_id;?>" name="area[]" step="0.01" readonly value='<?php  if($tr->area > 0) echo $tr->area; ?>'>
						<label><?php echo $tr->selling_unit;?></label>
						<input type="hidden" id="main_area<?php echo $tr->quotation_trans_id;?>" value='<?php  echo $tr->main_area; ?>'>
					</td>
					<td><input type='text' class="form-control col-md-12" id="price<?php echo $tr->quotation_trans_id;?>" name="price[]" value="<?php echo $tr->unit_price;?>" onblur="calculate_amount('<?php echo $tr->quotation_trans_id;?>');"></td>
					<td><input type='text' class="form-control col-md-12" id="amount<?php echo $tr->quotation_trans_id;?>" name="amount[]" value="<?php echo $tr->amount;?>" onclick="calculate_amount('<?php echo $tr->quotation_trans_id;?>');"></td>
					<td>
						<?php if($tr->file_upload_path!='') {?>
						<a href="<?php echo base_url().rem_slash($tr->file_upload_path);?>" download><?php echo $tr->file_name;?></a>
						<?php } else echo 'file not available';?>
						
						<input type="hidden" name="pi_file_name[]" value="<?php echo $tr->file_name;?>" >
						<input type="hidden" name="pi_file_path[]" value="<?php echo rem_slash($tr->file_upload_path);?>" >
					</td>
				</tr>
				 <?php  endforeach; ?>
			</tbody>
		</table>	
    </div>    
 </div>

<div class="form-group row">
<label class="col-sm-2"></label>
<div class="col-sm-10">
<?php if($edit_flag!=0){?>
<button type="submit" id='edit' class="btn btn-primary m-b-0">Submit</button>
<a href="<?php echo base_url().'index.php/Purchase/accept_purchase_quotation/'.$row->quotation_id.'/'.$row->rev_version;?>" title="Accept Quotation" class="btn btn-warning"><span>Accept</span></a>
<?php } ?></div>
</div>

<?php endforeach; ?>
</form>

        </div>
    </div>
</div>
</div>
</div>
</div>

<script>

 function call_me(item_id) 
 {
   	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Setup/ajax_get_item_details",
        data: {item_id:item_id} ,
        dataType: "json",
        success: function(msg){	       	
		////  view model popup
		$('#indent-Modal').modal('show');
		document.getElementById('model_heading').innerHTML=msg.item_name;
	 	document.getElementById('pocode').innerHTML=msg.pocode;	
	 	document.getElementById('site_name').innerHTML=msg.project_name;
	 	document.getElementById('lastpo_price').innerHTML=msg.po_price;
	 	document.getElementById('lastpo_qty').innerHTML=msg.po_qty;
	     }
	});
        //return true;
 }

function calculate_amount(item_id)
{
	var quantity = document.getElementById("quantity"+item_id).value;
	var price = document.getElementById("price"+item_id).value;
        var total_amount = quantity*price;
	//alert(total_amount);
	document.getElementById("amount"+item_id).value=total_amount;
}

function resend_quatation(quatation_id, rev_version, sid)
{
	var r= confirm("Are you sure you want to resend?");
	if(r == true) 
        {
		var remark = prompt("Please enter Remark/comment:", "");
                if(remark!='')
		{
			
			window.open('<?php echo base_url();?>index.php/Purchase/resend_RFQ_request/'+quatation_id+'/'+rev_version+'/'+sid+'/'+remark);
		}
		else
		{
			alert('Quatation not Resend');
			return false;
		}
	}
	else
	{
		return false;
	}
	return true;
}

function calculate_area(append_id)
{       
	
	var width = parseFloat(document.getElementById("width"+append_id).value);

	var height = parseFloat(document.getElementById("height"+append_id).value);
	var quantity = parseFloat(document.getElementById("quantity"+append_id).value);	
	var area = parseFloat(document.getElementById("main_area"+append_id).value);	
        
	var area= parseFloat(quantity*area).toFixed(2);
	document.getElementById("area"+append_id).value=parseFloat(area).toFixed(2);
}
</script>
