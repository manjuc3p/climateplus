<style>
 .bright{
 border-right:1px solid black;
 }
 .btop{
 border-top:1px solid black;
 }
</style>
<div class="card-body">
	<form onsubmit="return check_stock_allocation();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_cost_sheet" autocomplete="off" enctype="multipart/form-data">
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
		
		<div class="form-group row" style="font-size:11px; font-weight:bold;">
	    	<div class="col-md-12">
		  	<table width='100%' border='1' id="tab_logic" >
					   <thead>
					    <tr>
					    	    <th>Description</th>     
					    	    <th>Quantity</th>        
					    	    <th>Unit Cost</th>  
					    	    <th>Total Cost</th>   
					    	    <th>Unit Landed Cost</th>   
					    	    <th>Total Landed Cost</th>   
					    	    <th>Unit Sale Price</th>   
					    	    <th>Total Sale Price</th>   
					    	    <th>Margin (%)</th>    
						</tr>
					    </thead>	
					     <tbody id="item_list_id">
						<tr class="color-default">
							
						</tr>
					   </tbody>	 
					    
				</table>
		</div>
		</div>
		
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Payment By: <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" role='group'>
				<select tabindex="3" class="form-select form-control-sm select2" id="payment_by" name="payment_by" required>
				<option value="">Select</option>
				<option value="CASH">CASH</option>
				<option value="CDC">CDC</option>
				<option value="PDC">PDC</option>
				<option value="ADVANCE">ADVANCE</option>
			      </select>
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Shipping By: <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" role='group'>
				<select tabindex="3" class="form-select form-control-sm select2" id="Shipping" name="Shipping" required>
				<option value="">Select</option>
				<option value="AS">AS</option>
				<option value="SF">SF</option>
				<option value="Courier">Courier</option>
				<option value="Truck">Truck</option>
			      </select>
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier<span style="color: red;">* </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" role='group'>
				<select tabindex="3" class="form-select form-control-sm select2" id="supplier" name="supplier" required>
				<option value="">Please select name</option>
				      <?php foreach($supplier_records as $g) { ?>
					   <option value="<?php echo $g->supplier_id;?>" ><?php echo $g->supplier_code.' '.$g->supplier_name; ?> </option>
				      <?php } ?>
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
	  					<td class='bright btop'><input step='any' type='number' min='0' id='ex_work' name='ex_work' value='0' readonly class='bg-soft-gray'/></td>
	  					<td>Costing Factor =</td>
	  					<td><input step='any' type='number' min='0' id='cost_factor' name='cost_factor' value='0' readonly class='bg-soft-gray'/></td>
	  				</tr>
	  				<tr>
	  					<td class="bright">Freight Forwarding:</td>
	  					<td class="bright"><input step='any' type='number' min='0' id='Freightamt' name='Freightamt' value='0' onblur="cost_sheet_calcualtion();"/></td>
	  					<td colspan=2></td>
	  				</tr>
	  				<tr>
	  					<td class="bright">Insurance:</td>
	  					<td class="bright"><input step='any' type='number' min='0' id='insamt' name='insamt' value='0' onblur="cost_sheet_calcualtion();"/></td>
	  					<td colspan=2></td>
	  				</tr>
	  				<tr>
	  					<td class="bright">Other Charges:</td>
	  					<td class="bright"><input step='any' type='number' min='0' id='otheramt' name='otheramt' value='0' onblur="cost_sheet_calcualtion();"/></td>
	  					<td align="center" class=" btop">AED</td>
	  					<td align="center" class=" btop">AED Amount</td>
	  				</tr>
	  				<tr>
	  					<td class="bright">
	  						<select tabindex="3" class="form-select form-control-sm select2" id="FOB" name="FOB" required>
							<option value="">Select</option>
							<option Selected value="FOB">FOB</option>
							<option value="C&F">C&F</option>
							<option value="CIF">CIF</option>
						      </select>
	  					</td>
	  					<td class="bright"><input step='any' type='number' min='0' id='totalexwork' name='totalexwork' value='0' readonly class='bg-soft-gray'/></td>
	  					<td>Rate @ <input step='any' type='number' min='0' id='rate' name='rate' value='1' onblur="cost_sheet_calcualtion();"/></td>
	  					<td> <input step='any' type='number' min='0' id='totalrate' name='totalrate' value='0' readonly class='bg-soft-gray'/></td>
	  				</tr>
	  				<tr valign='top'>
	  					<td colspan='2' class="bright" width='50%'>
	  					<table width='100%'>
	  						<tr>
	  							<td>Forwarding</td>
	  							<td width=10px></td>
	  							<td width=100px>
  								<input step='any' type='number' min='0' id='forwardingPer' name='forwardingPer' value='0' onblur="cost_sheet_calcualtion();"/>
  								</td>
	  							<td align="center">%</td>
	  						</tr>
	  						<tr>
	  							<td>Freight</td>
	  							<td width=10px></td>
	  							<td>
  								<input step='any' type='number' min='0' id='FreightPer' name='FreightPer' value='0' onblur="cost_sheet_calcualtion();"/>
  								</td>
	  							<td align="center">%</td>
	  						</tr>
	  						<tr>
	  							<td>Insurance:</td>
	  							<td width=10px></td>
	  							<td>
  								<input step='any' type='number' min='0' id='InsurancePer' name='InsurancePer' value='0' onblur="cost_sheet_calcualtion();"/>
  								</td>
	  							<td align="center">%</td>
	  						</tr>
	  						<tr>
	  							<td>Customs</td>
	  							<td width=10px></td>
	  							<td>
  								<input step='any' type='number' min='0' id='CustomsPer' name='CustomsPer' value='0' onblur="cost_sheet_calcualtion();"/>
  								</td>
	  							<td align="center">%</td>
	  						</tr>
	  						<tr>
	  							<td>Charges</td>
	  							<td width=10px></td>
	  							<td>
  								<input step='any' type='number' min='0' id='ChargesPer' name='ChargesPer' value='0' onblur="cost_sheet_calcualtion();"/>
  								</td>
	  							<td align="center">%</td>
	  						</tr>
	  						<tr>
	  							<td>Interest</td>
	  							<td width=10px></td>
	  							<td>
  								<input step='any' type='number' min='0' id='InterestPer' name='InterestPer' value='0' onblur="cost_sheet_calcualtion();"/>
  								</td>
	  							<td align="center">%</td>
	  						</tr>
	  						<tr>
	  							<td># Months</td>
	  							<td width=10px></td>
	  							<td>
  								<input step='any' type='number' min='0' id='monthPer' name='monthPer' value='0' onblur="cost_sheet_calcualtion();"/>
  								</td>
	  							<td align="center">M</td>
	  						</tr>
	  						<tr>
	  							<td>Guarantee:</td>
	  							<td width=10px></td>
	  							<td>
  								<input step='any' type='number' min='0' id='GuaranteePer' name='GuaranteePer' value='0' onblur="cost_sheet_calcualtion();"/>
  								</td>
	  							<td align="center">%</td>
	  						</tr>
	  						<tr>
	  							<td>Margin:</td>
	  							<td width=10px></td>
	  							<td>
  								<input step='any' type='number' min='0' id='MarginPer' name='MarginPer' value='25' onblur="cost_sheet_calcualtion();"/>
  								</td>
	  							<td align="center">%</td>
	  						</tr>
	  						<tr>
	  							<td>Overheads</td>
	  							<td width=10px></td>
	  							<td>
  								<input step='any' type='number' min='0' id='OverheadsPer' name='OverheadsPer' value='0' onblur="cost_sheet_calcualtion();"/>
  								</td>
	  							<td align="center">%</td>
	  						</tr>
	  						<tr height='380px' valign='bottom'>
	  							<td colspan='4'>NOTE: ALL FIGURES ARE ROUNDED UP</td>
	  						</tr>
  						</table>
	  					</td>
	  					<td colspan='2'  class="bright btop">
	  					<table width='100%'>
	  						<tr>
	  							<td width='60' class="bright">1</td>
	  							<td width='250' >Forwarding</td>
	  							<td align='right'><input type='number' min='0' id='foramt' name='foramt' value='0.00' readonly class='bg-soft-gray' /></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">2</td>
	  							<td>Freight</td>
	  							<td align='right'><input type='number' min='0' id='freamt' name='freamt' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">3</td>
	  							<td>Insurance</td>
	  							<td align='right'><input type='number' min='0' id='insuamt' name='insuamt' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  						<tr class='bg-soft-primary'>
	  							<td class="bright"></td>
	  							<td>Total CIF</td>
	  							<td align='right'><input type='number' min='0' id='cifamt' name='cifamt' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">4</td>
	  							<td>Custom Duty (CIF)</td>
	  							<td align='right'><input type='number' min='0' id='customamt' name='customamt' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">5</td>
	  							<td>Off Loading</td>
	  							<td align='right'><input type='number' min='0' id='offlamt' name='offlamt' value='0.00' class='bg-soft-warning' onblur="cost_sheet_calcualtion();"/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">6</td>
	  							<td>Demmurage</td>
	  							<td align='right'><input type='number' min='0' id='Demmurage' name='Demmurage' value='0.00' class='bg-soft-warning' onblur="cost_sheet_calcualtion();"/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">7</td>
	  							<td>Clearing</td>
	  							<td align='right'><input type='number' min='0' id='Clearing' name='Clearing' value='0.00' class='bg-soft-warning' onblur="cost_sheet_calcualtion();"/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">8</td>
	  							<td>Transportation</td>
	  							<td align='right'><input type='number' min='0' id='transamt' name='transamt' value='0.00' class='bg-soft-warning' onblur="cost_sheet_calcualtion();"/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">9</td>
	  							<td>Bank Charges</td>
	  							<td align='right'><input type='number' min='0' id='bankamt' name='bankamt' value='0.00' readonly class='bg-soft-gray' /></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">10</td>
	  							<td>Interest Expenses</td>
	  							<td align='right'><input type='number' min='0' id='expamt' name='expamt' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  						<tr class='bg-soft-primary'>
	  							<td class="bright"></td>
	  							<td>Landed Cost</td>
	  							<td align='right'><input type='number' min='0' id='Landedamt' name='Landedamt' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">11</td>
	  							<td>Guarantees</td>
	  							<td align='right'><input type='number' min='0' id='Guarantees' name='Guarantees' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">12</td>
	  							<td>Local Purchases</td>
	  							<td align='right'><input type='number' min='0' id='Purchases' name='Purchases' value='0.00' class='bg-soft-warning' onblur="cost_sheet_calcualtion();"/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">13</td>
	  							<td>Travelling Expenses</td>
	  							<td align='right'><input type='number' min='0' id='travelamt' name='travelamt' value='0.00' class='bg-soft-warning' onblur="cost_sheet_calcualtion();" /></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">14</td>
	  							<td>Inspection Cost</td>
	  							<td align='right'><input type='number' min='0' id='Inspection' name='Inspection' value='0.00' class='bg-soft-warning' onblur="cost_sheet_calcualtion();" /></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">15</td>
	  							<td>Cost of Installation</td>
	  							<td align='right'><input type='number' min='0' id='Installation' name='Installation' value='0.00' class='bg-soft-warning' onblur="cost_sheet_calcualtion();" /></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">16</td>
	  							<td>Consultancy Fees</td>
	  							<td align='right'><input type='number' min='0' id='Consultancy' name='Consultancy' value='0.00' class='bg-soft-warning' onblur="cost_sheet_calcualtion();" /></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">17	</td>
	  							<td>C.A.R. Insurance</td>
	  							<td align='right'><input type='number' min='0' id='car' name='car' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  						<tr class='bg-soft-primary'>
	  							<td class="bright">	</td>
	  							<td>Sub-Total</td>
	  							<td align='right'><input type='number' min='0' id='subtotal' name='subtotal' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  						<tr>
	  							<td class="bright">18	</td>
	  							<td>Overheads</td>
	  							<td align='right'><input type='number' min='0' id='OverheadsAmt' name='OverheadsAmt' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  						<tr class='bg-soft-primary'>
	  							<td class="bright">	</td>
	  							<td>Grand Total</td>
	  							<td align='right'><input type='number' min='0' id='grand_total' name='grand_total' value='0.00' readonly class='bg-soft-gray'/></td>
	  						</tr>
	  					</table>
	  					</td>
	  				</tr>
	  			</table>
	  		</div>
		</div>
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		
		<button type="submit"  tabindex="22"  id="add" class="btn btn-primary m-b-0">Update</button>
		<?php if($approve_flag==1){?>
		<a class="btn btn-primary m-b-0" href="#" onclick='approve();' title="approve">Approve Cost Sheet</a>
		<?php }?>
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

function item_wise_calcualtion(append_id)
{
	var qty = document.getElementById("qty"+append_id).value;
	var price = document.getElementById("price"+append_id).value;
	var total= qty*price;
	document.getElementById("total"+append_id).value=total;
	
	var i_value=0;i_total=0;
	$('.itemtotal1').each(function()
	{
		i_value=$(this).val();
		if(i_value=='')
			 i_value = 0;
		else
			i_total+=parseFloat(i_value);
	});
	if(isNaN(i_total)) var i_total = 0;
	document.getElementById("item_totalCost").innerHTML= parseFloat(i_total).toFixed(2);
	document.getElementById("ex_work").value= parseFloat(i_total).toFixed(2);
	
	var Freightamt = parseFloat(document.getElementById("Freightamt").value);
	var insamt = parseFloat(document.getElementById("insamt").value);
	var otheramt = parseFloat(document.getElementById("otheramt").value);
	 var sum3=  parseFloat(Freightamt+insamt+otheramt);
	
	var rate = document.getElementById("rate").value;
	document.getElementById("totalexwork").value= parseFloat((i_total+sum3)).toFixed(2);
	document.getElementById("totalrate").value= parseFloat((i_total+sum3)*rate).toFixed(2);
	cost_sheet_calcualtion();
}
function cost_sheet_calcualtion()
{
	var i_value=0;i_total=0;
	$('.itemtotal1').each(function()
	{
		i_value=$(this).val();
		if(i_value=='')
			 i_value = 0;
		else
			i_total+=parseFloat(i_value);
	});
	if(isNaN(i_total)) var i_total = 0;
	document.getElementById("item_totalCost").innerHTML= parseFloat(i_total).toFixed(2);
	document.getElementById("ex_work").value= parseFloat(i_total).toFixed(2);
	
	var Freightamt = Math.round(document.getElementById("Freightamt").value);
	var insamt = Math.round(document.getElementById("insamt").value);
	var otheramt = Math.round(document.getElementById("otheramt").value);
	var sum3=  Math.round(Freightamt+insamt+otheramt);
	var rate = document.getElementById("rate").value;
	var totalrate= (i_total+sum3)*rate;
	document.getElementById("totalexwork").value= Math.round((i_total+sum3));
	document.getElementById("totalrate").value= Math.round(totalrate);
	
	var forwardingPer = Math.round(totalrate*parseFloat(document.getElementById("forwardingPer").value)/100);
	var FreightPer = Math.round(totalrate*parseFloat(document.getElementById("FreightPer").value)/100);
	var InsurancePer = Math.round(totalrate*parseFloat(document.getElementById("InsurancePer").value)/100);
	if(Freightamt==0)
	{
		var Freightamt1= forwardingPer;
		var FreightPer1= FreightPer;
	}
	else
	{
		var Freightamt1= 0;
		var FreightPer1= 0;
	}
	
	document.getElementById("foramt").value=Freightamt1;
	document.getElementById("freamt").value=FreightPer1;
	document.getElementById("insuamt").value=InsurancePer;
	var level1 = Math.round(totalrate+Freightamt1+FreightPer1+InsurancePer);
	document.getElementById("cifamt").value=level1;
	
	var CustomsPer = Math.round(level1*parseFloat(document.getElementById("CustomsPer").value)/100);
	var ChargesPer = Math.round(level1*parseFloat(document.getElementById("ChargesPer").value)/100);
	var InterestPer = (parseFloat(document.getElementById("InterestPer").value)/100/12);
	var monthPer = (document.getElementById("monthPer").value);
	var InterestAmt =InterestPer*monthPer;
	var MarginPer = Math.round(document.getElementById("MarginPer").value);
	$('.margin').val(MarginPer);
	document.getElementById("item_totalmargin").innerHTML=MarginPer;
	
	document.getElementById("customamt").value=CustomsPer;
	var offlamt = Math.round(document.getElementById("offlamt").value);
	var Demmurage = Math.round(document.getElementById("Demmurage").value);
	var Clearing = Math.round(document.getElementById("Clearing").value);
	var transamt = Math.round(document.getElementById("transamt").value);
	document.getElementById("bankamt").value=ChargesPer;
	var level2 =CustomsPer+offlamt+Demmurage+Clearing+transamt+ChargesPer;
	var intExp = Math.round((level1+level2)*InterestAmt);
	document.getElementById("expamt").value=intExp;
	var level3 =Math.round(level1+level2+intExp);
	document.getElementById("Landedamt").value=level3;
	
	
	var GuaranteePer = level3*parseFloat(document.getElementById("GuaranteePer").value)/100;
	document.getElementById("Guarantees").value=GuaranteePer;
	var Purchases = Math.round(document.getElementById("Purchases").value);
	var travelamt = Math.round(document.getElementById("travelamt").value);
	var Inspection = Math.round(document.getElementById("Inspection").value);
	var Installation = Math.round(document.getElementById("Installation").value);
	var Consultancy = Math.round(document.getElementById("Consultancy").value);
	var car = Math.round(document.getElementById("car").value);
	var level4 =GuaranteePer+Purchases+travelamt+Inspection+Installation+Consultancy+car;
	
	document.getElementById("subtotal").value=Math.round(level3+level4);
	var OverheadsPer = Math.round((level3+level4)*parseFloat(document.getElementById("OverheadsPer").value)/100);
	document.getElementById("OverheadsAmt").value=OverheadsPer;
	document.getElementById("grand_total").value=Math.round(level3+level4+OverheadsPer);
	
	 if(i_total>0)
	 	var cost_factor=   parseFloat((level3+level4+OverheadsPer)/i_total).toFixed(2);
 	else
 	       var cost_factor= 0.00;
 	       
       document.getElementById("cost_factor").value=cost_factor;
       
       var tot_landedcost=0;tot_salescost=0; append_val=51;
	$('.price_value').each(function()
	{
		var pval=parseFloat(document.getElementById("price"+append_val).value);
		var qval=parseFloat(document.getElementById("qty"+append_val).value);
		var landedpval= parseFloat(pval*cost_factor).toFixed(3);
		var landedpamt= parseFloat(landedpval*qval).toFixed(3);
		tot_landedcost= parseFloat(tot_landedcost)+parseFloat(landedpamt).toFixed(3);
		var unit_sale_price = parseFloat((landedpval*100)/(100-MarginPer)).toFixed(3); 
		var unit_sale_cost = parseFloat(unit_sale_price*qval).toFixed(3);
		tot_salescost=parseFloat(tot_salescost)+parseFloat(unit_sale_cost).toFixed(3);
		document.getElementById("landed_price"+append_val).value=landedpval;
		document.getElementById("landed_cost"+append_val).value=landedpamt;
		document.getElementById("sale_price"+append_val).value=unit_sale_price;
		document.getElementById("sale_cost"+append_val).value=unit_sale_cost;
		append_val++;
	});
         document.getElementById("item_totallandedCost").innerHTML=tot_landedcost;
         document.getElementById("item_totalsalePrice").innerHTML=tot_salescost;
}
</script>

