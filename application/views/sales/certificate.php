<style type="text/css">

.select2Width {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 220px !important;
  min-width: 220px !important;
}
</style>

<div class="card-body">
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_new_certificate" autocomplete="off" enctype="multipart/form-data">
		<h5>MATERIAL TEST CERTIFICATE</h5>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Customer <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" >
	    			<input type="text" name="customer" id="customer"  class="form-control form-control-sm" value="" >
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Size <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	    			<input type="text" name="size_no" id="size_no"  class="form-control form-control-sm" value="" >
	  		</div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Valve Type <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg2">	    			
	    			<input type="text" name="vtype" id="vtype"  class="form-control form-control-sm" value="" >
	  		</div>
		</div>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">PETROSTAR REF.<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" >
	    			<input type="text" name="ref" id="ref"  class="form-control form-control-sm" value="" required>
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">ANSI Class <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	    			<input type="text" name="size_no" id="size_no"   class="form-control form-control-sm" value="" >
	  		</div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Model NO <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	    			<input type="text" name="vtype" id="vtype"   class="form-control form-control-sm" value="" >
	  		</div>
		</div>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Certificate No.<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" >
	    			<input type="text" name="ref" id="ref"  class="form-control form-control-sm" value="" required>
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Ends <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	    			<input type="text" name="size_no" id="size_no"   class="form-control form-control-sm" value="" >
	  		</div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	    			<input type="text" name="vtype" id="vtype"   class="form-control form-control-sm" value="" >
	  		</div>
		</div>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Certi Date<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" role='group'>
				<div class="input-group date datepicker1">			                  
		    			<input type="text" class="form-control form-control-sm datepicker1" id="enq_date" name="enq_date" value="<?php echo date('d-m-Y')?>" required tabindex=1>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Quantity <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	    			<input type="text" name="size_no" id="size_no"   class="form-control form-control-sm" value="" >
	  		</div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Valve ID<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	    			
	    			<input type="text" name="vtype" id="vtype"   class="form-control form-control-sm" value="" >
	  		</div>
		</div>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Tag No.<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" >
	    			<input type="text" name="ref" id="ref"  class="form-control form-control-sm" value="" required>
    	     		 </div>
		</div>
		<div class="form-group row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<table width='100%' border="1">
			<tr class='bg-soft-warning'>
				<td>Hydro test data</td>
				<td>SHELL TEST</td>
				<td>H.P CLOSURF</td>
				<td>L.P(AIR)TEST</td>
				<td>BACK SEAT</td>
				<td>TEST STD</td>
				<td>VISUAL INSPECTION</td>
			</tr>
			
			<tr>
				<td class='bg-soft-warning'>PRESSURE(MPa)</td>
				<td><input type="text" name="htp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="htp2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="htp3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="htp4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="htp5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="htp6"  class="form-control form-control-sm" value="" ></td>
			</tr>
			
			<tr>
				<td class='bg-soft-warning'>DURATION(Min)</td>
				<td><input type="text" name="htd1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="htd2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="htd3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="htd4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="htd5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="htd6"  class="form-control form-control-sm" value="" ></td>
			</tr>
		</table>
		</div>
		</div>
		
		<div class="form-group row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<table width='100%' border="1">
			<tr class='bg-soft-warning'>
				<td>DESIGN PARA.</td>
				<td>FACE TO FACE</td>
				<td>END CONNECTION</td>
				<td>DESIGN STANDARD1</td>
				<td>DESIGN STANDARD2</td>
				<td>FIRE SAFE DESIGN</td>
				<td>SOUR SPEC</td>
			</tr>
			
			<tr>
				<td class='bg-soft-warning'>STANDARDS</td>
				<td><input type="text" name="dps1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="dps2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="dps3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="dps4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="dps5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="dps6"  class="form-control form-control-sm" value="" ></td>
			</tr>
			
			<tr>
				<td class='bg-soft-warning'>RESULT</td>
				<td><input type="text" name="dpr1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="dpr2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="dpr3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="dpr4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="dpr5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="dpr6"  class="form-control form-control-sm" value="" ></td>
			</tr>
		</table>
		</div>
		</div>
		<div class="form-group row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<table width='100%' border="1">
			<tr class='bg-soft-warning'>
				<td></td>
				<td>SPECIAL TESTS</td>
			</tr>
			
			<tr>
				<td class='bg-soft-warning'>Anti-static </td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			
			<tr>
				<td class='bg-soft-warning'>Cavity Relief :</td>
				<td><input type="text" name="sp2"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Painting</td>
				<td><input type="text" name="sp3"  class="form-control form-control-sm" value="" ></td>
			</tr>
			
			<tr>
				<td >
				<input type="text" name="sp_lable4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp4"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td >
				<input type="text" name="sp_lable5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp5"  class="form-control form-control-sm" value="" ></td>
			</tr>
		</table>
		</div>
		</div>
		<div class="form-group row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<table width='100%' border="1">
			<tr class='bg-soft-warning'>
				<td>PARTS</td>
				<td>BODY/ADAPTOR</td>
				<td>BALL/PLUG/DISC</td>
				<td>STEM/ HINGE</td>
				<td>OPERATOR</td>
				<td>SEAT RING</td>
				<td>SOFT SEAT</td>
				<td>SPRING</td>
				<td>GASKET</td>
				<td>PACKING</td>
			</tr>
			
			<tr>
				<td class='bg-soft-warning'>MATERIAL GRADE</td>
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm6"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm7"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm8"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
			</tr>
			
			<tr>
				<td class='bg-soft-warning'>COATING</td>
				<td><input type="text" name="ptc1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc6"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc7"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc8"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc9"  class="form-control form-control-sm" value="" ></td>
			</tr>
		</table>
		</div>
		</div>
		
		<div class="form-group row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<table width='100%' border="1">
			<tr class='bg-soft-warning'>
				<td colspan='2'>DESCRIPTION</td>
				<td colspan='15'>CHENICAL ANAL YSIS</td>
			</tr>
			<tr class='bg-soft-warning'>
				<td>PART</td>
				<td>HEAT/BATCH</td>
				<td>BALL/PLUG/DISC</td>
				<td>C</td>
				<td>Mn</td>
				<td>P</td>
				<td>S</td>
				<td>Si</td>
				<td>Cr</td>
				<td>Mo</td>
				<td>Ni</td>
				<td>N</td>
				<td>V</td>
				<td>Cu</td>
				<td>Al</td>
				<td>Oth</td>
				<td>Oth</td>
			</tr>
			
			<tr>
				<td class='bg-soft-warning' rowspan='5'>BODY/ BONNET/ Disc</td>
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm6"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm7"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm8"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm6"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm7"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm8"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm6"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm7"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm8"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm6"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm7"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm8"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm6"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm7"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm8"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm9"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>STEM</td>
				<td><input type="text" name="ptc1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc5"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc6"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc7"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc8"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc9"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptc9"  class="form-control form-control-sm" value="" ></td>
			</tr>
		</table>
		</div>
		</div>
		
		<div class="form-group row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<table width='100%' border="1">
			<tr class='bg-soft-warning'>
				<td align='center'>DESCRIPTION</td>
				<td colspan='5' align='center'>MECHANICAL ANALYSIS</td>
				<td colspan='4' align='center' style="border-left:1px solid black;">IMPACT TEST</td>
			</tr>
			<tr class='bg-soft-warning'>
				<td>PART</td>
				<td>T.S Mpa</td>
				<td>Y.P Mpa</td>
				<td>EL</td>
				<td>RA</td>
				<td>BH</td>
				<td colspan='4' align='center'  style="border-left:1px solid black;">j  (-- Deg C)</td>
			</tr>
			
			<tr>
				<td class='bg-soft-warning' rowspan='5'>BODY/ BONNET/ Disc</td>
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				
				
				<td style="border-left:1px solid black;"><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				
			</tr>
			<tr>
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				
				
				<td style="border-left:1px solid black;"><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				
				
				<td style="border-left:1px solid black;"><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				
				
				<td style="border-left:1px solid black;"><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				
				
				<td style="border-left:1px solid black;"><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>STEM</td>
				
				<td><input type="text" name="ptm1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
				
				
				<td style="border-left:1px solid black;"><input type="text" name="ptm2"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm3"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm4"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="ptm5"  class="form-control form-control-sm" value="" ></td>
			</tr>
		</table>
		</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-1">Note 1</label>
			<div class="col-sm-5">
				<textarea rows=7 name="note1" class="form-control form-control-sm">Notes: *Hydrostatic medium is water., **Seat test is conducted on both sides for bi-directional valves./ WCB Normalizing Temp - 920 DegC for 3 Hours and air cooling & Tempering Temp 600 Deg C for 4 hours and air cooling</textarea>
			</div>
			<label class="col-sm-1">Note 2</label>
			<div class="col-sm-5">
				<textarea rows=7 name="note2" class="form-control form-control-sm">We here by confirm that the valves referred in this certificate is confirmed to meet the referred data and approved for release to customer</textarea>
			</div>
		</div>
		
		<h5>COMPLIANCE CERTIFICATE </h5><br>
		<div class="form-group row">
			<label class="col-sm-2">Details</label>
			<div class="col-sm-10">
				<textarea  name="details" class="form-control form-control-sm"></textarea>
			</div>
		</div>
		
		<div class="form-group row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<table width='100%' border="1">
			<tr class='bg-soft-warning'>
				<td>MATERIAL COMPLIANCE</td>
				<td>RESULT</td>
				<td>REMARKS</td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Body</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Bonnet / Adaptor</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Disc/ Ball</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Stem/Hinge</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr class='bg-soft-warning'>
				<td>DIMENSIONAL / DESIGN COMPLIANCE</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Forging Markings – MSS SP 25/55</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>End Dimensions ASME B16.5</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Face to face Dimension ASME B16.10</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Design –  BS1414/ ASME 16.34/ API 600</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr class='bg-soft-warning'>
				<td>PERFORMANCE COMPLIANCE</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Hydro Test – API 598</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Witness Party</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			
			<tr class='bg-soft-warning'>
				<td>COROSION PROTECTION COMPLIANCE</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Surface Preperation</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Painting</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Paint Final Coat Color</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
			<tr>
				<td class='bg-soft-warning'>Coating DFT</td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
				<td><input type="text" name="sp1"  class="form-control form-control-sm" value="" ></td>
			</tr>
		</table>
		</div>
		</div>
		
		<div class="form-group row">
			<label class="col-sm-2">confirmation</label>
			<div class="col-sm-10">
				<textarea  name="details" class="form-control form-control-sm">We here by confirm that the valves referred in this certificate is confirmed to meet the referred data and purchase order requirements. Material approved for release to customer with EN 10204/3.1 certificate</textarea>
			</div>
		</div>
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<button type="submit"  tabindex="502"  id="add" class="btn btn-primary m-b-0">Submit</button>
		</div>
		</div>
		</form>

        </div>
    </div>
</div>
</div>
</div>
</div>


