<?php $this->load->helper('menu'); ?>

<style>
body {
    padding-top: 50px;
}
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
/* Red */
$bgDefault      : #e74c3c;
$bgHighlight    : #c0392b;
$colDefault     : #ecf0f1;
$colHover       : #ffbbbc;
</style>

<div class="navbar navbar-default navbar-fixed-top " role="navigation">
    <div class="container ">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">PESPL</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" ><span class="glyphicon glyphicon-user"></span> <?php echo ucfirst($this->session->userdata('firstname'));?></a>
                	<ul class="dropdown-menu">
                        <li><a href="<?php echo base_url().'index.php/'; ?>setup/profile" >Profile</a></li>
                        <li><a href="<?php echo base_url().'index.php/'; ?>Login/change_pass">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url().'index.php/'; ?>pmc/Login/logout">Sign out</a></li>
                        </ul>
            	</li>
            </ul>
            <ul class="nav navbar-nav">
            	 <?php	    	
				$uid = $this->session->userdata('user_id');
				$access_type = $this->session->userdata('role');
				
				$access_menu = get_menu($uid);
				
				if(!empty($access_menu)) // user access control
				{
						foreach($access_menu as $node)
					 	{
					 		$temppid = $node->menu_pid;
							$num_rows = get_menu_sid_count($temppid);
							if($num_rows > 0)
							{?>
						        <li class="dropdown">
						          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						            <?php echo $node->menu_name; ?> <b class="caret"></b>
						            
						          </a>
						          <ul class="dropdown-menu multi-level">
						          	<?php
						    			 $res = get_menu_sid($temppid,$uid,$access_type);
						    			 foreach($res as $row)
				 						 {
				 						 	if ($row->menu_url!=" ")
				 						 	{?>
				 						 		<?php 
				 						 			$temppid2 = $row->menu_pid;									    			 
													$num_rows2 = get_menu_sid_count($temppid2);
													if($num_rows2>0)
													{
												?>
						            				<li class="dropdown-submenu">
							            				<a href="<?php echo base_url().'index.php/'.$row->menu_url;?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							            					<i class="fa fa-circle-o"></i>
							            					<?php echo $row->menu_name; ?>
							            					
							            				</a>
					            						<?php									          		
														 $res2 = get_menu_sid($temppid2,$uid,$access_type);?>																										 	
							            					<ul class="dropdown-menu">											          	
												    			<?php foreach($res2 as $row2)
										 						 {
										 						 	if ($row2->menu_url!=" ")
										 						 	{?>
												            			<li><a href="<?php echo base_url().'index.php/'.$row2->menu_url;?>"><i class="fa fa-circle-o"></i><?php echo $row2->menu_name; ?></a></li>
												            			
											            		 <?php }
																 }?>
												            </ul>										           
					            					</li>
					            					<?php }
					            					else { ?>
					            							<li>
					            								<a href="<?php echo base_url().'index.php/'.$row->menu_url;?>"><i class="fa fa-circle-o"></i><?php echo $row->menu_name; ?></a>
			            									</li>
					            					<?php } ?>
						            			
					            		 <?php }
										 }?>
						          </ul>
						        </li>						        
	    					<?php }							
							else 
							{ ?>									
								<li>
							    	<a href="<?php echo base_url() . 'index.php/'.$node->menu_url; ?>">
							    		<i class=""></i> <span><?php echo $node->menu_name; ?></span> 
							    	</a>
				    		 </li>
							<?php } 
						 }
				  }?>	
		      	</li>
		      		</ul>
            	
            	
                <!--<li class="active"><a href="#">Home</a></li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 1 <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">One more separated link</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 2 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                        
                    </ul>
                </li>
            </ul>!-->
        </div><!--/.nav-collapse -->
    </div>
</div>

