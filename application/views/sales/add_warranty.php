<div class="card-body">
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_warranty_data" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Select Invoice <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4" role='group'>
				<select tabindex="3" class="form-select form-control-sm select2" id="inv_id" name="inv_id" required onchange="get_invoice_info()" >
				<option value="">Select Invoice</option>
				<?php foreach($records as $s) {?>
				  <option value="<?php echo $s->invoice_id ?>"><?php echo $s->invoice_code.'-'.$s->cust_name;?></option>
				<?php } ?>
			      </select>
    	     		 </div>
		</div>
		<div class="form-group row" >
	    	<div class="col-md-12" >
			<div class="dt-responsive" >
			<table class='bg-soft-green' width='100%' cellspacing="0" colspacing="0" border='1' >
				<tr>
					<th  style="background-color:#cccccc!important;">Voucher Code</th>
					<th  style="background-color:#cccccc!important;">Invoice Date Date</th>
					<th  style="background-color:#cccccc!important;">Customer</th>
				</tr>
				<tr>
					<th  style="background-color:#cccccc!important;" >
					
					<input type="text" id='invoice_code' name='invoice_code' class="form-control" >
					<input type="hidden" id='enquiry_revision' name='enquiry_revision' >  
					</th>
					<th  style="background-color:#cccccc!important;"><input class="form-control" type="text" id='invoice_date' name='invoice_date' ></th>
					
					<input type="hidden" id='customer_id' class="form-control" value="" readonly="TRUE"></th>
					<th  style="background-color:#cccccc!important;" >
                        <input type="text" id='cust_name' name='cust_name' class="form-control" value="" readonly="TRUE" class="form-control">
                   </th>
				</tr>
			</table>
			</div>
	   	</div>
		</div>
		
        <div class="form-group row" style="height:250px; overflow: auto;">
		  	<table class="table table-bordered table-hover" id="tab_logic">
              <thead>
                <tr>
                        <th title="Item">Sl.No</th>     
                        <th title="Item">Description</th> 
                        <th title="Item">Quantity</th>     
                        <th></th>
                </tr>
                </thead>	
					<tbody id="item_list_id">
						<tr class="color-default">
							
						</tr>
					   </tbody>	 
					    
				</table>
		</div>
        <div class="form-group row">
           
        <table id="myTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        
                        <th width="70%">Terms & Conditions</th>
                        <th>Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="warranty_terms[]" class="form-control"></td>
        
                        <td><button class="btn" onclick="addRow()"><span class="fa fa-plus"></span></button> <button class="btn" onclick="deleteRow(this)"><span class="fa fa-trash"></span></button></td>
                    </tr>
                </tbody>
            </table>

           

        </div>
		
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<button type="submit"  tabindex="12"  id="add" class="btn btn-primary m-b-0">Generate Warranty</button>
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
  
function get_invoice_info() 
 {
   	var inv_id = document.getElementById("inv_id").value;	
   
	   	$.ajax({
	   	async:"false",
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_invoice_info_for_warranty",
		data: {inv_id:inv_id} ,
		dataType: "json",
		success: function(msg){
           
			document.getElementById("invoice_code").value=msg.invoice_code;
            document.getElementById("cust_name").value=msg.cust_name;
            document.getElementById("invoice_date").value=msg.invoice_date;
			get_enquiry_items_list();
		     }
		});
	
 } 
 
function get_enquiry_items_list()
{
	var inv_id=$("#inv_id").val();
	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Ajax/get_invoice_items_list_for_warranty",
        data: {inv_id:inv_id} ,
        success: function(msg){	       	
		document.getElementById('item_list_id').innerHTML=msg;
	     }
	});
}

function addRow() {
    var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.rows.length);
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);

    cell1.innerHTML = '<input type="text" name="name[]">';
    cell2.innerHTML = '<button class="btn" onclick="addRow()"><span class="fa fa-plus"></span></button> <button class="btn" onclick="deleteRow(this)"><span class="fa fa-trash"></span></button>';
}

function deleteRow(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
</script>
