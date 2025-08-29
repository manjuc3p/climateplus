<div class="card-body">
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_enquiry_feasibility_data" autocomplete="off" enctype="multipart/form-data">
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
		
		<div class="form-group row" style="height:250px; overflow: auto;">
		  	<table class="table table-bordered table-hover" id="tab_logic">
					   <thead>
					    <tr>
					    	    <th title="Item">Details</th>     
					    	    <th title="Item">Feasibility</th>    
					    	    
						</tr>
					    </thead>	
					     <tbody id="item_list_id">
						<tr class="color-default">
							
						</tr>
					   </tbody>	 
					    
				</table>
		</div>
		
		
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<button type="submit"  tabindex="12"  id="add" class="btn btn-primary m-b-0">Update Feasibility Status</button>
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
	$("#add_row").click(function()
	{
	     $('#addr'+i).html("<td><input type='text' name='order_code[]' id='order_code"+i+"' tabindex='18' class='form-control form-control-sm ' placeholder='Enter Order Code Here' required onkeyup='get_product_description("+i+");'><br><input type='text' name='pcode[]' id='pcode"+i+"'  class='form-control form-control-sm bg-soft-primary' placeholder='' readonly ></td><td><textarea rows='7' cols='30' name='desc[]' id='desc"+i+"' class='form-control form-control-sm' required></textarea></td><td><input type='number'  name='qty[]' id='qty"+i+"' tabindex='19' class='form-control form-control-sm bg-soft-primary' placeholder='' required ></td><td><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytbbody tr:last').after('<tr id="addr'+(i+1)+'"></tr>');
	      i++; 	     	
	});
        $("#delete_row").click(function(){
    		 if(i>1){
			 $("#addr"+(i-1)).html('');
			 i--;
		 }
	 });
   });   
   function remove_row(append_id)
   {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
   }
  
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
        url:"<?php echo base_url()?>index.php/Ajax/get_enquiry_items_list",
        data: {enq_id:enq_id, rev_version:rev_version} ,
        success: function(msg){	       	
		document.getElementById('item_list_id').innerHTML=msg;
	     }
	});
}
</script>
