<style>
 .bright{
 border-right:1px solid black;
 }
 .btop{
 border-top:1px solid black;
 }
</style>
<div class="card-body">
	<form onsubmit="return check_stock_allocation();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_order_ack" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Select Project Enquiry <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4" role='group'>
				<select tabindex="3" class="form-select form-control-sm select2" id="enq_id" name="enq_id" required onchange="get_enquiry_info()" >
				<option value="">Select</option>
				<?php foreach($enq_records as $s) {?>
				  <option value="<?php echo $s->enquiry_id ?>"><?php echo $s->enquiry_code.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
    	     		 </div>
		</div>
		<div class="form-group row" >
	    	<div class="col-md-12" >
			<div class="dt-responsive" >
			<table class='bg-soft-green' width='100%' cellspacing="0" colspacing="0" border='1' >
				<tr>
					<th  style="background-color:#cccccc!important;">Enquiry Code</th>
					<th  style="background-color:#cccccc!important;">Enquiry Date</th>
					<th  style="background-color:#cccccc!important;">Customer</th>
				</tr>
				<tr>
					<th  style="background-color:#cccccc!important;" >
					<label id='enq_code'></label>
					<input type="hidden" id='enquiry_code' name='enquiry_code' >
					<input type="hidden" id='enquiry_revision' name='enquiry_revision' >  
					</th>
					<th  style="background-color:#cccccc!important;">
					<input type="text" id='enq_date' class="form-control" value="" readonly="TRUE">
					<input type="hidden" id='customer_id' class="form-control" value="" readonly="TRUE"></th>
					<th  style="background-color:#cccccc!important;" id='cust_name'> </th>
				</tr>
			</table>
			</div>
	   	</div>
		</div>
		
		<div class="form-group row" style="font-size:12px; font-weight:bold;">
		  	<table class="table" id="tab_logic" rowspacning='0' rowspaning='0'>
					   <thead>
					    <tr>
					    	    <th title="Item">DESCRIPTION</th>     
					    	    <th title="Item">Qty</th>        
					    	    <th title="Item">Unit Cost</th>  
					    	    <th title="Item">Total Cost</th>   
					    	    <th title="Item">Unit Landed Cost</th>   
					    	    <th title="Item">Total Landed Cost</th>   
					    	    <th title="Item">Unit Sale Price</th>   
					    	    <th title="Item">Total Sale Price</th>   
					    	    <th title="Item">Margin (%)</th>   
						</tr>
					    </thead>	
					     <tbody id="item_list_id">
						<tr class="color-default">
							
						</tr>
					   </tbody>	 
					    
				</table>
		</div>
		
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Payment By: <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" role='group'>
				<select tabindex="3" class="form-select form-control-sm select2" id="payment_by" name="payment_by" required>
				<option value="">Select</option>
				<option value="L/C">L/C</option>
				<option value="DL/C">DL/C</option>
				<option value="T/T">T/T</option>
				<option value="T/T">Consignmer</option>
			      </select>
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Shipping By: <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" role='group'>
				<select tabindex="3" class="form-select form-control-sm select2" id="payment_by" name="payment_by" required>
				<option value="">Select</option>
				<option value="AS">AS</option>
				<option value="SF">SF</option>
				<option value="Courier">Courier</option>
				<option value="Truck">Truck</option>
			      </select>
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier: <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" role='group'>
				<select tabindex="3" class="form-select form-control-sm select2" id="supplier" name="supplier" required>
				<option value="">Select</option>
			      </select>
    	     		 </div>
		</div>
		
		<div class="form-group row">
	  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	  			<table width="100%" border='1'>
	  				<tr>
	  					<td width='25%'>Total Prices In</td>
	  					<td width='25%' class="bright">AED</td>
	  					<td colspan=2></td>
	  				</tr>
	  				<tr>
	  					<td class="bright btop">Ex-Works:</td>
	  					<td class='bright btop'></td>
	  					<td>Costing Factor =</td>
	  					<td></td>
	  				</tr>
	  				<tr>
	  					<td class="bright">Freight Forwarding:</td>
	  					<td class="bright"></td>
	  					<td colspan=2></td>
	  				</tr>
	  				<tr>
	  					<td class="bright">Insurance:</td>
	  					<td class="bright"></td>
	  					<td colspan=2></td>
	  				</tr>
	  				<tr>
	  					<td class="bright">Other Charges:</td>
	  					<td class="bright"></td>
	  					<td class=" btop">AED</td>
	  					<td class=" btop">AED Amount</td>
	  				</tr>
	  				<tr>
	  					<td class="bright">
	  						<select tabindex="3" class="form-select form-control-sm select2" id="payment_by" name="payment_by" required>
							<option value="">Select</option>
							<option value="FOB">FOB</option>
							<option value="C&F">C&F</option>
							<option value="CIF">CIF</option>
						      </select>
	  					</td>
	  					<td class="bright"></td>
	  					<td>Rate @ 1.000	</td>
	  					<td>AED</td>
	  				</tr>
	  			</table>
	  		</div>
		</div>
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		
		<button type="submit"  tabindex="22"  id="add" class="btn btn-primary m-b-0">Submit</button>
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
function get_enquiry_info() 
 {
   	var enq_id = document.getElementById("enq_id").value;	
   	if(enq_id!='')
   	{
	   	$.ajax({
	   	async:"false",
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_enquiry_info",
		data: {enq_id:enq_id} ,
		dataType: "json",
		success: function(msg){
			var url1= 'index.php/Sales/edit_enquiry/'+msg.enq_id+'/1';
			var x = '<u><a target="blank" href="<?php echo base_url()?>' + url1 + '">'+msg.enquiry_code+'</a></u>';
			document.getElementById("enq_code").innerHTML=x;
			document.getElementById("enquiry_code").value=msg.enquiry_code;
			document.getElementById("enq_date").value=msg.enquiry_date;
			document.getElementById("customer_id").value=msg.customer_id;
			document.getElementById("cust_name").innerHTML=msg.cust_code+' '+msg.cust_name;
			//document.getElementById("delivery_date").value=msg.delivery_date;
			document.getElementById("enquiry_revision").value=msg.revision;
			/*if (jQuery.isEmptyObject(msg.enq_id))
			{
			 document.getElementById("add").setAttribute('disabled','true');
			 }*/
			get_enquiry_items_list();
		     }
		});
	}
	else
	{
		document.getElementById("enq_code").innerHTML='';
		document.getElementById("enq_date").value='';
		document.getElementById("customer_id").value='';
		document.getElementById("cust_name").value='';
		//document.getElementById("delivery_date").value='';
			
		document.getElementById('item_list_id').innerHTML='';
	}
 } 
 
function get_enquiry_items_list()
{
	var enq_id=$("#enq_id").val();
	var rev_version=$("#enquiry_revision").val();
	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Ajax/get_enquiry_for_cost_sheet",
        data: {enq_id:enq_id, rev_version:rev_version} ,
        success: function(msg){	       	
		document.getElementById('item_list_id').innerHTML=msg;
	     }
	});
}
</script>

