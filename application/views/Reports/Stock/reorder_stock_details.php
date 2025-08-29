<div class="card-body">

            <div class="form-group row">
              <label class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-form-label"></label>
             
            	<div class="col-sm-3">
                <table width='100%'>
                  <tr>
                    
                  <td>&nbsp;</td>
                  <td>
                    <form target="_blank" action="<?php echo base_url().'index.php/'; ?>Reports/print_reorder_stock_list" id="ques1" method="post" name="ques1" >
                      <input tabindex="6" type="submit" id="print" value="Print" class="btn btn-warning btn-sm" />
                    </form></td>
                    <td>&nbsp;</td>
                    <td>
                      <form action="<?php echo base_url().'index.php/'; ?>Reports/export_reorder_stock_list" id="ques1" method="post" name="ques1" >
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
				<th>Srn <input type="checkbox" class="selectall" name="selectall" id="selectall" value="select_all"></th>
				<th>Stock Code</th>
				<th>Desc</th>
				<th>Inventory Qty</th>
				<th>PO Qty</th>
				<th>Total Stock</th>
				<th>Min Qty</th>
			</tr>
		 </thead>

		<tbody>
		<?php $i=1; foreach($records as $row) :?>
			<tr>
				<td><?php echo $i;$i++;?>
				<input type="checkbox" id="select_checkbox" class="case" name="select_checkbox[]" value="<?php echo $row->stock_code; ?>" onclick="p_check();"/></td>
				<td>
					<?php echo $row->stock_code;?>
				</td>
				<td>
					<textarea readonly><?php echo $row->item_desc;?></textarea>
				</td>
				<td>
					<?php echo $row->invstock;?>
				</td>
				<td>
					<?php echo $row->postock;?>
				</td>
				<td>
					<?php echo $row->total_stock;?>
				</td>
				<td><?php echo $row->min_qty;?></td>
				
			</tr>
		<?php endforeach; ?>
		</tbody>
            </table>
           </div>
		<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/add_PO_direct_from_reorder">
		<input type="hidden"  name="selected_tr" id="selected_tr"  >
		
		
		<button tabindex="46" type="submit" disabled id="convert_excel" class="btn btn-primary m-b-0">Create PO Stock</button>
		</form>
        </div>
    </div>
</div>
</div>
</div>
</div>

<script>
function p_check() {
	var checked= $('input[name="select_checkbox[]"]:checked').length;

	if (checked > 0) {
		document.getElementById("convert_excel").disabled=false;
	}
	else {
		document.getElementById("convert_excel").disabled=true;
	}
	
	var allVals = [];
	$(".case:checked").each(function() {
		allVals.push($(this).val());
	});
	document.getElementById("selected_tr").value=allVals;
}
// if all checkbox are selected, check the selectall checkbox and viceversa

$('#selectall').click(function(event) {
	var checked= $('input[name="select_checkbox[]"]:checked');

	if(this.checked) {
		// Iterate each checkbox
		$('.case:checkbox').each(function() {
			this.checked = true;
			document.getElementById("convert_excel").disabled=false;
		});
	}
	else {
		$('.case:checkbox').each(function() {
			this.checked = false;
			document.getElementById("convert_excel").disabled=true;
		});
	}

	$('.case').on('click',function(){
		if($('.case:checked').length == $('.case').length){
			$('#select_checkbox').prop('checked',true);
		}else{
			$('#select_checkbox').prop('checked',false);
		}
	});
	
	var allVals = [];
	$(".case:checked").each(function() {
		allVals.push($(this).val());
	});
	document.getElementById("selected_tr").value=allVals;
});
</script>
