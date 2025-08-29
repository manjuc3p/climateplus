<?php $this->load->helper('menu_helper.php');?>

                        <div class="card-body">
                        <form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Setup/access_control" id="user" method="post" name="user" >
				<div class="form-group row">
					 <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Select:</label>
					<div class="col-sm-6">
						<select required name="user_id" id="user_id" class="form-control form-control-sm select2">
							<option value="">Select User Name</option>
							<?php foreach($records as $row) { ?>
								<option value="<?php echo $row->user_id;?>"><?php echo $row->user_name;?></option>
							<?php } ?>

						</select>
					</div>
					<div class="col-sm-3">
						<input type="submit" class="btn btn-xs btn-primary px-1 py-1" value="Show"/>
						<div>
							<label class="label_bar bold" style="color: red;"><?php echo $msg;?></label>
						</div>
					</div>
				</div>
			</form>
                       
                        <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/'; ?>Setup/add_access_control" id="addform">
                	<?php if($user_id!='')
			{?>		
			<div class="form-group row">
				<label class="control-label col-sm-2 align-self-center mb-0"></label>
				<label class="control-label col-sm-2 align-self-center mb-0">Menu Name </label>
				<label class="control-label col-sm-6 align-self-center mb-0"><input type="checkbox" title="Select All" id="selectall" name="selectall" value="select_all">Select All</label>
				<input type="hidden" name="user_id" id="user_id " value="<?php echo $user_id;?>" />
			</div>
			<div class="row">
				<label class="control-label col-sm-2 align-self-center mb-0">Menu Details :</label>
				<div class="col-md-8">
					<div class="box box-default">
						<table id="display" class="table table-bordered " width="100%">
						<tbody>
							<tr>
								<td>Menu Name</td>
								<td>View</td>
								<td>Add</td>
								<td>Edit</td>
								<td>Delete</td>
								<!--<td>Print</td>-->
							</tr>
							<ul>
							<?php foreach($menu as $row1):
							$xx=get_check_item_status_checked($user_id,$row1->menu_id);?>
							<tr>
								<td>
								<li><span>* &nbsp&nbsp<?php echo $row1->menu_name ;?></span>
								</td>
								<td>
								<input title="<?php echo $row1->menu_name;?>" type="checkbox" class="case" <?php if($xx==1) echo "checked";?> name="check[]"  onclick="select_sub_childs(<?php echo $row1->menu_id;?>);" value="<?php echo $row1->menu_id ;?>" id="parent<?php echo $row1->menu_id ;?>"  >
								</td>
								<td></td>
								<td></td>
								<td></td>
								<!--<td></td>-->
							</tr>
								<ul class="findchild<?php echo $row1->menu_id ;?>">
								<?php $submenu = accesscontrol($row1->menu_pid);
								foreach($submenu as $row2):
								$yy=get_check_item_status_checked($user_id,$row2->menu_id);?>
								<tr>
									<td>
										<li style='padding-left:50px;'>
											<span>&nbsp&nbsp<?php echo $row2->menu_name;?></span>
									</td>
									<td>
										<input title="<?php echo $row2->menu_name;?>" type="checkbox" onclick="select_childs(<?php echo $row1->menu_id ;?>,<?php echo $row2->menu_id ;?>);" class="case case<?php echo $row1->menu_id;?>" <?php if($yy==1) echo "checked";?> name="check[]"  value="<?php echo $row2->menu_id ;?>" id="<?php echo $row2->menu_id ;?>"  >
									</td>
									<?php if($row2->menu_url!='blank') {?>
									<td>
										<input title="<?php echo $row2->menu_name;?> Add" type="checkbox" name="check_add[]" value="<?php echo $row2->menu_id ;?>" class="case case<?php echo $row1->menu_id;?>" <?php if(check_pageaccess_status($user_id,$row2->menu_id,'A')==1) echo "checked";?>>
									</td>
									<td>
										<input title="<?php echo $row2->menu_name;?> Edit" type="checkbox" name="check_edit[]" value="<?php echo $row2->menu_id ;?>" class="case case<?php echo $row1->menu_id;?>" <?php if(check_pageaccess_status($user_id,$row2->menu_id,'E')==1) echo "checked";?>>
									</td>
									<td>
										<input title="<?php echo $row2->menu_name;?> Delete" type="checkbox" name="check_delete[]" value="<?php echo $row2->menu_id ;?>" class="case case<?php echo $row1->menu_id;?>" <?php if(check_pageaccess_status($user_id,$row2->menu_id,'D')==1) echo "checked";?>>
									</td>
									<!--<td>
										<input title="<?php echo $row2->menu_name;?> Print" type="checkbox" name="check_print[]" value="<?php echo $row2->menu_id ;?>" class="case case<?php echo $row1->menu_id;?>" <?php if(check_pageaccess_status($user_id,$row2->menu_id,'P')==1) echo "checked";?>>
									</td>-->
									<?php } else echo "<td></td><td></td><td></td><td></td>";?>
									</li>
								</tr>
								<ul class="findchild<?php echo $row2->menu_id ;?>">
								<?php $submenu2 = accesscontrol($row2->menu_pid);
								foreach($submenu2 as $row3):?>
								<tr>
									<td>
									<li style='padding-left:80px;'>
										<span>&nbsp&nbsp<?php echo $row3->menu_name;?></span>
									</td>
									<td>
										<input title="<?php echo $row3->menu_name;?>" type="checkbox" onclick="select_childs(<?php echo $row2->menu_id ;?>,<?php echo $row3->menu_id ;?>);" class="case<?php echo $row2->menu_id.$row3->menu_id;?>" <?php if(get_check_item_status_checked($user_id,$row3->menu_id)==1) echo "checked";?> name="check[]"  value="<?php echo $row3->menu_id ;?>" id="<?php echo $row2->menu_id ;?>"  >
									</td>
									<?php if($row3->menu_url!='blank') {?>
									<td>
										<input title="<?php echo $row3->menu_name;?>" type="checkbox" name="check_add[]" value="<?php echo $row3->menu_id ;?>" class="case" <?php if(check_pageaccess_status($user_id,$row3->menu_id,'A')==1) echo "checked";?>>
									</td>
									<td>
										<input title="<?php echo $row3->menu_name;?>" type="checkbox" name="check_edit[]" value="<?php echo $row3->menu_id ;?>" class="case" <?php if(check_pageaccess_status($user_id,$row3->menu_id,'E')==1) echo "checked";?>>
									</td>
									<td>
										<input title="<?php echo $row3->menu_name;?>" type="checkbox" name="check_delete[]" value="<?php echo $row3->menu_id ;?>" class="case" <?php if(check_pageaccess_status($user_id,$row3->menu_id,'D')==1) echo "checked";?>>
									</td>
									<td>
										<input title="<?php echo $row3->menu_name;?>" type="checkbox" name="check_print[]" value="<?php echo $row3->menu_id ;?>" class="case" <?php if(check_pageaccess_status($user_id,$row3->menu_id,'P')==1) echo "checked";?>>
									</td>
									<?php } else echo "<td></td><td></td><td></td><td></td>";?>
									</li>
								</tr>
								<?php endforeach;?>
							</ul>
						<?php endforeach;?>
						</ul>
						</li>
						</tr>
						<?php endforeach;?>
						</ul>
					
						</tbody>
						<tfoot>
						</tfoot>
						</table>
					</div>
				</div>
			</div><!-- end div row -->
			<div class="form-group row">
				<label class="col-sm-2"></label>
				<div class="col-sm-10">
					<button type="submit" class="btn btn-primary m-b-0">Submit</button>
				</div>
			</div>
			<?php } ?>
			</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      



<script language='javascript'>

// if all checkbox are selected, check the selectall checkbox and vicevers

if($(".case").length == $(".case:checked").length) {

	$("#selectall").attr("checked", "checked");
}


$("#selectall").click(function () {

	if ($(this).is(':checked'))
	{
		$('.case').attr('checked', this.checked);
		$("#main input:checkbox").prop("checked",true);
	}
	else
	{
		$('.case').removeAttr("checked");
		$("#main input:checkbox").prop("checked",false);
	}
});

$(".case").click(function(){

	if($(".case").length == $(".case:checked").length) {
		$("#selectall").attr("checked", "checked");
	}
	else {
		$("#selectall").removeAttr("checked");
	}
});

$("#main input:checkbox").click(function(){

	if($("#main input:checkbox").length ==$("#main input:checkbox:checked").length) {

		$("#selectall").attr("checked", "checked");
	}
	else
	{

		$("#selectall").attr("checked", "checked");

	}
});

</script>

<script language='javascript'>
// if all checkbox are selected, check the selectall checkbox and viceversa
function select_sub_childs(a)
{
	if ($("#parent"+a).is(':checked'))
	{
		$(".case"+a).attr("checked", "checked");
	}
	else
	{
		$('.case'+a).removeAttr("checked");
	}
}

function select_childs(a,b)
{

	$('.case'+a+b).click(function ()
	{
		if ($(this).is(':checked'))
		{
			$("#parent"+a).attr('checked', this.checked);
			$("#parent"+a).prop('checked', true);
			$('.child'+a+b).attr('checked', this.checked);
		}
		else
		{
			$('.child'+a+b).removeAttr("checked");
			var num = $(".findchild"+a+" "+"input:checkbox:checked").length ;

			if(num==0)
			{

				$("#parent"+a).removeAttr("checked");
				$("#parent"+a).prop('checked', false);
			}

		}
	});
}

function select_last_child(a,b,c)
{

	$('.child'+a+b).click(function ()
	{
		if ($(this).is(':checked'))
		{
			$("#parent"+a).attr('checked', this.checked);
			$("#"+b).attr('checked', this.checked);
		}
		else
		{
			var num_child = $(".child"+a+b+":checked").length ;
			if(num_child==0)
			{
				$("#"+b).removeAttr("checked");
			}

			var num = $(".findchild"+a+" "+"input:checkbox:checked").length ;
			if(num==0)
			{
				$("#parent"+a).removeAttr("checked");
			}
		}
	});
}
</script>

<script type="text/javascript">

$('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
$('.tree li.parent_li > span').on('click', function (e) {
	var children = $(this).parent('li.parent_li').find(' > ul > li');
	if (children.is(":visible")) {
		children.hide('fast');
		$(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus').removeClass('icon-minus-sign');
	} else {
		children.show('fast');
		$(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
	}
	e.stopPropagation();
});



</script>
