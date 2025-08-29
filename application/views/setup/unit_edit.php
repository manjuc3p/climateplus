<div class="card-body">
		<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Setup/update_unit_records" autocomplete="off">
		<?php foreach($units as $r): ?>
			<div class="form-group row">
			<label class="col-sm-2 col-form-label">Unit Name</label>
			<div class="col-sm-4">
			<input type="text" class="form-control" name="uname" id="uname" pattern="[A-Za-z]+" value="<?php echo $r->unit_name; ?>" placeholder="enter unit name" readonly>
			</div>
			</div>

			<div class="form-group row">
			<label class="col-sm-2 col-form-label">Unit Abbreviation</label>
			<div class="col-sm-4">
			<input type="text" class="form-control" id="uabbr" name="uabbr"  pattern="[A-Za-z]+" value="<?php echo $r->unit_abbr; ?>" placeholder="enter your unit abbreviation" readonly>
			</div>
			</div>

			<div class="form-group row">
			<label class="col-sm-2 col-form-label">Unit Of <span style="color: red;"> * </span></label>
			<div class="col-sm-4">
			<input type="text" class="form-control" id="utype" name="utype"  pattern="[A-Za-z]+" placeholder="enter unit type " value="<?php echo $r->unit_type; ?>" required>
			</div>
			</div>

			<!--<div class="form-group row">
			<label class="col-sm-2 col-form-label">Base Unit</label>
			<div class="col-sm-4">
			<input type="text" class="form-control" id="bunit" name="bunit" placeholder="enter base unit" value="<?php //echo $r->base_unit; ?>" required>
			</div>
			</div>-->

			<div class="form-group row">
			<label class="col-sm-2 col-form-label">Conversion Factor <span style="color: red;"> * </span></label>
			<div class="col-sm-4">
			<input type="text" class="form-control" id="cf" name="cf" placeholder="enter conversion factor" value="<?php echo $r->conversion; ?>" required>
			</div>
			</div>

				<input type="hidden" if="uid" name="uid" value="<?php echo $r->unit_id ?>>">		
				<div class="form-group row">
					<label class="col-sm-2"></label>
					<div class="col-sm-4">
						<button type="submit" id="edit" class="btn btn-primary m-b-0">Update</button>
						
					</div>
				</div>
			<?php endforeach; ?>
			</form>
        </div>
    </div>
</div>
</div>
</div>
</div>
         
