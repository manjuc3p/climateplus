
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Climate+</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?php echo base_url()?>public/logo/favicon.ico" />
      	<!-- Bootstrap 3.3.6 -->
  	<!--<link rel="stylesheet" href="<?php echo base_url()?>public/bootstrap/css/bootstrap.min.css">-->
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="<?php echo base_url()?>public/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href="<?php echo base_url();?>public/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="<?php echo base_url()?>public/assets/css/core/libs.min.css" />
      
      <!-- Aos Animation Css -->
      <link rel="stylesheet" href="<?php echo base_url()?>public/assets/vendor/aos/dist/aos.css" />
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="<?php echo base_url()?>public/assets/css/hope-ui.min.css?v=2.0.0" />
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="<?php echo base_url()?>public/assets/css/custom.min.css?v=2.0.0" />
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="<?php echo base_url()?>public/assets/css/dark.min.css"/>
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="<?php echo base_url()?>public/assets/css/customizer.min.css" />
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="<?php echo base_url()?>public/assets/css/rtl.min.css"/>
     
      
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/select2/css/select2.min.css" />

    <script type="text/javascript" src="<?php echo base_url();?>public/assets/jquery/js/jquery.min.js"></script>
  </head>
  
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
    
    <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="<?php echo base_url().'index.php/'; ?>Admin/view_admin_dashboard" class="navbar-brand">
                <!--Logo start-->
                <!--logo End-->
                
                <!--Logo start-->
                <div class="logo-main">
                    <img  src="<?php echo base_url()?>public/logo/logo192x192.png" width='50px'  />
                </div>
                <!--logo End-->                
                <h4 class="logo-title">Climate+</h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
        </div>
        
          <style>
			 .sidebar-list{
			 	font-size:12px;
			 	font-weight:bold;
			 	margin:0px!important;
			 }
		   </style>
        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="sidebar-list">
                <!-- Sidebar Menu Start -->
                <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                    
                    <!--<li class="nav-item">
                        <a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/'; ?>Admin/view_login_dashboard">
                           
                            <span class="item-name">Dashboard</span>
                        </a>
                    </li>                    
                    <li><hr class="hr-horizontal"></li>-->
                    
            <?php $this->load->helper('menu');
		if(isset($_COOKIE['userid']))
		   $user_id=$_COOKIE['userid'];
		
		else if($this->session->userdata('user_id')!='')
		   $user_id=$this->session->userdata('user_id');	
				
		$access_menu = get_menu($user_id);			
		if(!empty($access_menu)) // user access control
		{
			foreach($access_menu as $node)
		 	{
		 		$temppid = $node->menu_pid;
				$num_rows = get_menu_sid_count($temppid);
				if($num_rows > 0)
				{?>	
                    		<li class="nav-item">
                        		<a class="nav-link " data-bs-toggle="collapse" href="#menu<?php echo $node->menu_id; ?>" role="button" aria-expanded="false" aria-controls="menu<?php echo $node->menu_id; ?>">
				            <i class="icon">                                
				                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-20">
				                    <path opacity="0.4" d="M10.0833 15.958H3.50777C2.67555 15.958 2 16.6217 2 17.4393C2 18.2559 2.67555 18.9207 3.50777 18.9207H10.0833C10.9155 18.9207 11.5911 18.2559 11.5911 17.4393C11.5911 16.6217 10.9155 15.958 10.0833 15.958Z" fill="currentColor"></path>
				                    <path opacity="0.4" d="M22.0001 6.37867C22.0001 5.56214 21.3246 4.89844 20.4934 4.89844H13.9179C13.0857 4.89844 12.4102 5.56214 12.4102 6.37867C12.4102 7.1963 13.0857 7.86 13.9179 7.86H20.4934C21.3246 7.86 22.0001 7.1963 22.0001 6.37867Z" fill="currentColor"></path>
				                    <path d="M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z" fill="currentColor"></path>
				                    <path d="M21.9998 17.3992C21.9998 19.2648 20.4609 20.7777 18.5609 20.7777C16.6621 20.7777 15.1221 19.2648 15.1221 17.3992C15.1221 15.5325 16.6621 14.0195 18.5609 14.0195C20.4609 14.0195 21.9998 15.5325 21.9998 17.3992Z" fill="currentColor"></path>
				                </svg>
				            </i>
                    			    <span class="item-name"><?php echo $node->menu_name; ?></span>
				            <i class="right-icon">
				                <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
				                </svg>
				            </i>
                        		</a>
				        <ul class="sub-nav collapse" id="menu<?php echo $node->menu_id; ?>" data-bs-parent="#sidebar-menu">
					    <?php
			          	    $res = get_menu_sid($temppid,$user_id);
		    			    foreach($res as $row)
 					    { 
						$path=$_SERVER['PHP_SELF'];
						$page_name=str_replace("/index.php/","",$path);
						$page_name=$this->uri->segment(1).'/'.$this->uri->segment(2);?>						
				            <li class="nav-item">
				                <a class="nav-link <?php if($row->menu_url==$page_name) echo 'active'; ?>" href="<?php echo base_url().'index.php/'.$row->menu_url;?>">
				                  <i class="icon">
				                        <svg class="icon-10" xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
				                            <g>
				                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
				                            </g>
				                        </svg>
				                    </i>
				                  <i class="sidenav-mini-icon"> B </i>
				                  <span class="item-name"><?php echo $row->menu_name; ?></span>
				                </a>
				            </li> 
						<?php						        
					     } ?>                                        
				        </ul>
                    		</li>                    
                    		<li><hr class="hr-horizontal"></li>                   
                    		<?php }
					else{?>
                        			<li class="nav-item">
							<a class="nav-link " aria-current="page" href="<?php echo base_url().'index.php/'.$node->menu_url;?>">
							   
							    <span class="item-name"><?php echo $node->menu_name; ?></span>
							</a>
						    </li>                    
				<?php } 
				} //end foreach 
			  }?>	
                </ul>
                <!-- Sidebar Menu End -->        
                </div>
        </div>
        <div class="sidebar-footer"></div>
       </aside>   
    
