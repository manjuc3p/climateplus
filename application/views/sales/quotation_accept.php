<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/accept_quotation_approval" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Select Quotation <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-6 col-lg-6" role='group'>
				<select tabindex="1" class="form-select form-control-sm select2" id="qid" name="qid" required>
				<option value="">Select</option>
				<?php foreach($records as $s) {?>
				  <option value="<?php echo $s->quote_id ?>"><?php echo $s->quotation_code.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
    	     		 </div>
		</div>
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
		   <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Client PO Number</label>
		    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
	   		 <input type='text'  name="po_no" id="po_no"  tabindex='3' class="form-control form-control-sm" />		     
		    </div>
		</div>
	
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Client PO Date</label>
		   <div class="col-xs-12 col-sm-9 col-md-3 col-lg-6" role='group'>
				<div class="input-group date datepicker1">			                  
		    			<input type="text" class="form-control form-control-sm datepicker1" id="po_date" name="po_date" value="<?php echo date('d-m-Y')?>" required tabindex=1>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Remark for approval</label>
		    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
	   		 <textarea  cols='50' rows='4' name="approval_remark" id="approval_remark"  tabindex='2' class="form-control form-control-sm" ></textarea>		     
		    </div>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Status</label>
		    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
	   		 <select tabindex="4" class="form-select form-control-sm" id="status" name="status" required>
				<option value="">Select</option>
				<option value="1" selected>Accept & Lock Quotation</option>
				<option value="2">Reject/ Close Quotation</option>
			      </select>		     
		    </div>
		</div>
		
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<button type="submit"  tabindex="22"  id="add" class="btn btn-primary m-b-0" >Submit Status</button>
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

</script>
