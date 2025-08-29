<div class="card-body">
		<?php foreach($records1 as $row) { ?>	
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Quotation date</label>
		    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" role='group'>
				<div class="input-group date ">			                  
		    			<input type="text" class="form-control form-control-sm " id="qdate" name="qdate" value="<?php echo date('d-m-Y',strtotime($row->quotation_date))?>" required tabindex='1' readonly>
			      	</div>
    	     		 </div>

	     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">Quotation Code:</label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			      <input type="text" name="qcode" id="qcode" class="form-control form-control-sm bg-soft-gray"  readonly tabindex='2' value="<?php echo $row->quotation_code; ?>">
		     </div>
	     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">Revision:<?php echo $row->revision; ?></label>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Client PO Number</label>
		    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
	   		 <input type='text'  name="po_no" id="po_no"  value="<?php echo $row->po_number;?>" class="form-control form-control-sm" readonly/>		     
		    </div>
		</div>
		
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table">
                                <thead>
                                    <tr>
						<th>Sno</th>
						<th>Type</th>
						<th>File</th>
				   </tr>
				</thead>

				<tbody style="font-size:12px; font-weight:700px;">
				<?php $i=1; foreach($records as $row) :?>
				<tr>
					<td><?php echo $i;$i++;?></td>
					<td>
						<?php echo $row->doc_type;?>
					</td>
					<td>
					<?php if($row->doc_path!='')
					{?>
					<a download href="<?php echo base_url().'public/uploded_documents/'.$row->doc_path;?>">Download</a>
					<?php }?>
					</td>
				</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
                </div>
                <form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_quotation_documents" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Upload Client PO copyUpload Drawing(PDF/PNG/JPEG)</label>
		    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
	   		 <input type='file'  name="po_file" id="po_file"  class="form-control form-control-sm" />		     
		    </div>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Upload Drawing(PDF/PNG/JPEG)</label>
		    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
	   		  <input type='file'  name="drawing_file" id="drawing_file"  class="form-control form-control-sm" />		     
		    </div>
		</div>
		
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<input type="hidden"  name="quote_id" value="<?php echo $row->quote_id;?>" >
		<button type="submit"  tabindex="22"  id="add" class="btn btn-primary m-b-0" >Submit Documents</button>
		</div>
		</div>
		</form>
		<?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Static Table End -->



<script>

function confirmcancel(id)
{   
	var r= confirm("Are you sure you want to Cancel Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Ajax/cancel_record",
     		type: "POST",
     		data: {table1:'sales_quotation_master', column:'status', value:'1', key_name1:'quote_id', post_id1:id} ,
     		success: function(msg) {
     			if(msg==1) 
     			{     	
			         alert("Record Cancel"); 				
        			 window.location.href="<?php echo $_SERVER['PHP_SELF']?>";   		                    		  
			}
		        else {
			      	alert("Can't Cancel record. Data already exist!!!");
		       }
		    },
		});
      		return true;
      	}
        else
        	return false;
	    	
}
</script>
