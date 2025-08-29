<?php  $this->load->helper('menu_helper.php');
foreach($comapny_records as $row) {
	$company_name=$row->company_name;
	$company_address=$row->company_address;
	$company_city= $row->company_city;

	$company_pincode= $row->company_pincode;
	$company_country= $row->company_country;
	$company_email_id= $row->company_email_id;
	$company_telephone= $row->company_telephone;
	$company_website= $row->company_website;
	$company_TRN= $row->company_TRN;

}

$mis_cnt=0;
foreach($records1 as $row) {
	$project_name=$row->project_name;
	$project_location=$row->project_location;
	$enquiry_code=$row->enquiry_code;
	
	$inspection_date=date('d-M-Y',strtotime($row->inspection_date));
	$quotation_date=date('d-M-Y',strtotime($row->quotation_date));
	$quotation_date=date('d-M-Y',strtotime($row->revision_date?? ''));
	$quotation_code=$row->quotation_code;
	$customer_id=$row->customer_id;
	$customer_name=$row->cust_name;
	$cp_name=$row->cp_name;
	$cp_mobile=$row->cp_mobile;
	$cp_email=$row->cp_email;
	$po_number=$row->po_number;
	$no_of_panels=$row->no_of_panels;
	
	
	$billing_addr=$row->billing_addr;
	$billing_city=$row->billing_city;
	$billing_state=$row->billing_state;
	$billing_pincode=$row->billing_pincode;
	$billing_country= $row->billing_country;	
	$shipping_addr= $row->shipping_addr;
	$shipping_city= $row->shipping_city;
	$shipping_pincode= $row->shipping_pincode;
	$shipping_country= $row->shipping_country;	
	$remark=$row->fatremark;
	$client_ref=$row->client_ref;
	$stamp_image=$row->stamp_image;
	
	
}

 
$logo1=base_url().'public/logo/Logo-bsg.jpg';
$print_header="";?>

<style>
@media print {
    body {
        margin: 0;
        padding: 0;
    }

    header, footer {
        position: fixed;
        width: 100%;
    }

    header {
        top: 0;
    }

    footer {
        bottom: 0;
    }

    main {
       margin-top: 100px;
    }
    img {
       /* max-width: 150%;
        height: auto;*/
    }
}
</style>

<html>
	<head>
		<title>
			FAT Certificate
		</title>
	</head>
	<body topmargin=0 style="margin-left: 5px; margin-top:5px; font-family:Arial;">
		<center>
			<header>
			<table border=0 width=100%>
				<thead>
				<tr>
					<td align='left'><img style='opacity: 0.5' src="<?php echo base_url().'public/logo/Logo-bsg.jpg'?>" alt='logo.png' ></td>
					<td align='right'><img src="<?php echo base_url().'public/logo/logo.png'?>" alt='logo.png' ></td>
					<td>&nbsp;</td>
				</tr>
				</thead>
			</table>
			</header>
			<br><br><br><br>
			<main>
			<table border=0 width=100%>
				<tr>
					<td colspan='2' align='center' style="font-size:28px;"><b><u>FACTORY ACCEPTANCE TEST CERTIFICATE</b></u></td>
				</tr>
			</table>
			<br><br><br><br><br><br>
			<table width=80% border=0 style="font-family:Arial; font-size: 17px; line-height: 1.2">
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>
						MANUFACTURER :
					</th>
					<td>
						<b><?php echo $company_name;?></b>
					</td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>PROJECT :</th>
					<td ><?php echo $project_name;?></td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>VENUE :</th>
					<td ><?php echo "BESA warehouse";?></td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>DATE :</th>
					<td ><?php echo $inspection_date;?></td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>ATTENDEES :</th>
					<td ><?php echo $cp_name.' '.$cp_mobile.' '.$cp_email;?></td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>PROJECT LOCATION  :</th>
					<td ><?php echo $project_location;?></td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>LIST OF PANELS FOR INSPECTION :</th>
					<td ><?php echo $no_of_panels;?></td>
				</tr>
				
				<tr>
					<td width='80px'><br><br><br><br></td>
					<td colspan='2'><?php echo $remark;?></td>
				</tr>
				
				<tr valign='bottom'>
					<td width='80px' height='200px'><br><br><br><br></td>
					<td colspan='2'>Tested By,</td>
				</tr>
				<tr>
					<td width='80px'><br><br><br><br></td>
					<td>
					<?php 
					if($stamp_image!='')
					{
      						$binary = base64_decode(str_replace(" ", "+", $stamp_image));
					?>
					<img style="width: 100px; height:100px; margin:auto; display: block;" src="<?php if($binary!='') echo 'data:' .';base64,' . base64_encode($binary); ?>">
					<?php } ?>
					</td>
				</tr>
			 </table>
			 <br><br><br>
			 <div style='page-break-before: always;'></div>
			<br><br><br><br><br><br><br><br><br><br>


			 <table width=80% border=1 style="font-family:Arial; font-size: 17px; line-height: 1.2">
				<tr>
					<td width=100>
						Client :
					</td>
					<td align='left' width='400px'>
						<?php echo $customer_name;?>
					</td>
					<td>
						Inspection date :
					</td>
					<td>
						<?php echo $inspection_date;?>
					</td>
				</tr>
				<tr>
					<td width=100>
						Contractor :
					</td>
					<td >
						
					</td>
					<td>
						<b>Job Reference</b>
					</td>
					<td>
						<?php echo $quotation_code;?>
					</td>
				</tr>
				<tr>
					<td width=100>
						Consultant :
					</td>
					<td >
						
					</td>
					<td>
						<b>P.O Reference :</b>
					</td>
					<td>
						<?php echo $po_number;?>	
					</td>
				</tr>
				<tr>
					<td width=100>
						Project :
					</td>
					<td colspan='3'>
						<b><?php echo $project_name;?>	</b>
					</td>
				</tr>
				
			</table>
			<br><br><br>
			<table width=80% border=1 style="font-family:Arial; font-size: 17px; line-height: 1.2">
				<thead>
				<tr>
					<th>SI.NO.</th>
					<th>SEQUENCE</th>
					<th>FINISHED</th>
					<th>REMARK</th>
				</tr>
				</thead>
				<tr>
					<th>I</th>
					<th>VISUAL INSPECTION</th>
					<td></td>
					<td></td>
				</tr>
				<?php $count=count($records2);
				$i=1;
				foreach($records2 as $tr) {
				if($tr->test_type=='VISUAL INSPECTION'){
				if($tr->test_id=='1'){ ?>
				<tr>
					<td>1</td>
					<td>Dimension of the enclosures - 1000H x 800W x 250D</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='2'){ ?>
				<tr>
					<td>2</td>
					<td>Enclosure Color RAL 7032</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='3'){ ?>
				<tr>
					<td>3</td>
					<td>Ingress protection (IP65)</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='4'){ ?>
				<tr>
					<td>4</td>
					<td>Size of cables as per the approved wiring drawing</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='5'){ ?>
				<tr>
					<td>5</td>
					<td>Availability of earth strip</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='6'){ ?>
				<tr>
					<td>6</td>
					<td>Clearance & Creep age distance</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='7'){ ?>
				<tr>
					<td>7</td>
					<td>Visual inspection of Firmness of connections</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='8'){ ?>
				<tr>
					<td>8</td>
					<td>Visual inspection of Door Locks, & Hinges</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='9'){ ?>
				<tr>
					<td>9</td>
					<td>Visual inspection of Name plates, Component labels</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='10'){ ?>
				<tr>
					<td>10</td>
					<td>Protection of internal cables & wires</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='11'){ ?>
				<tr>
					<td>11</td>
					<td>Earthing of doors </td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='12'){ ?>
				<tr>
					<td>12</td>
					<td>Sizing, Marking & identification of terminals</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='13'){ ?>
				<tr>
					<td>13</td>
					<td>Gland plate details - check Top/Bottom entry</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='14'){ ?>
				<tr>
					<td>14</td>
					<td>Color coding, identification & marking of cables,</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='15'){ ?>
				<tr>
					<td>15</td>
					<td>Reachability and accessibility if terminals & connections</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='16'){ ?>
				<tr>
					<td>16</td>
					<td>Rating, Breaking capacity as per the specification, major components</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='17'){ ?>
				<tr>
					<td>17</td>
					<td>Make of Major components as per BOM</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } $i++; } 
				} ?>
				</table>
				<br><br><br>
			 	<div style='page-break-before: always;'></div>
				<br><br><br><br><br><br><br><br><br><br><br><br><br>
				
				<table width=80% border=1 style="font-family:Arial; font-size: 17px; line-height: 1.2">
				<thead>
				<tr>
					<th>SI.NO.</th>
					<th>SEQUENCE</th>
					<th>FINISHED</th>
					<th>REMARK</th>
				</tr>
				</thead>	
				<?php $i=18;
				foreach($records2 as $tr) {
				if($tr->test_type=='VISUAL INSPECTION'){
				if($tr->test_id=='18'){ ?>
				<tr>
					<td>18</td>
					<td>Identification of component</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='19'){ ?>
				<tr>
					<td>19</td>
					<td>Bill of Material as per approved drawing</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } } }?>
				<tr>
					<th>II</th>
					<th>ELECTRICAL FUNCTION TEST</th>
					<td></td>
					<td></td>
				</tr>
				<?php foreach($records2 as $tr) {
				if($tr->test_type=='ELECTRICAL FUNCTION TEST'){
				if($tr->test_id=='1'){ ?>
				<tr>
					<td>1</td>
					<td>Function Test of Main Incomer 3P, Isolator</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='2'){ ?>
				<tr>
					<td>2</td>
					<td>Function Test of Three Pole, 20A, 10kA MCBs </td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='3'){ ?>
				<tr>
					<td>3</td>
					<td>Function Test of Single Pole, 20A, 10kA MCBs </td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='4'){ ?>
				<tr>
					<td>4</td>
					<td>Function Test of Four Pole, 40A, 30mA ELCBs</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='5'){ ?>
				<tr>
					<td>5</td>
					<td>Function Test of 14 pin Plug in relays With Base</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='6'){ ?>
				<tr>
					<td>6</td>
					<td>Function Test of 24 Hours Timer</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='7'){ ?>
				<tr>
					<td>7</td>
					<td>Function Test of Three pole 9A, contactor</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='8'){ ?>
				<tr>
					<td>8</td>
					<td>Function Test of Overload relay</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='9'){ ?>
				<tr>
					<td>9</td>
					<td>Function Test of Control Transformer</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='10'){ ?>
				<tr>
					<td>10</td>
					<td>Function Test of Selector switches</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='11'){ ?>
				<tr>
					<td>11</td>
					<td>Function Test of Indication lamps</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='12'){ ?>
				<tr>
					<td>12</td>
					<td>Manual operations of components.</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='13'){ ?>
				<tr>
					<td>13</td>
					<td>Drawing, Manual & Documentation.</td>
					<td align='center'> <?php if($tr->finished_status=='1') echo '&#10003;'; else echo '&#x2718;';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } 
				if($tr->test_id=='14'){ ?>
				<tr>
					<td>14</td>
					<td>Protection of Live Parts.</td>
					<td> <?php echo $tr->finished_status; if($tr->finished_status=='1') echo 'Finished'; else echo 'Not Finished';?></td>
					<td><?php echo $tr->finished_remark;?></td>
				</tr>
				<?php } } } ?>
				<tr valign='middle'>
					<td ><h4>Inspected: </h4> </td>
					<td colspan='3' align='left'>
						PASSED
					</td>
				</tr>
				</table>
				<br><br><br><br><br><br>
				<table border=0 width=100%>
				<tr valign='bottom'>
					<td width='200px'></td>
					<td align='left'>Tested By,</td>
				</tr>
				<tr>
					<td></td>
					
					<td align='left'>
					<?php 
					if($stamp_image!='')
					{
      						$binary = base64_decode(str_replace(" ", "+", $stamp_image));
					?>
					<img style="width: 100px; height:100px;" src="<?php if($binary!='') echo 'data:' .';base64,' . base64_encode($binary); ?>">
					<?php } ?>
					</td>
				</tr>
			</table>
			
			</main>
			 <footer>
			<table border=0 width=100% >
				<tr>
					<td align='center'><img src="<?php echo base_url().'public/logo/footer4.png'?>" alt='logo.png' ></td>
				</tr>
				
			</table>
			 </footer>
		</center>
	</body>
</html>








<style>
      .pagenum:before { content: counter(page); }
</style>



