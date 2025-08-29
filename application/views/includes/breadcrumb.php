<?php
      $path=$_SERVER['PHP_SELF'];
      $page_name=str_replace("/catalyst/index.php/","",$path);

	if($this->uri->segment(6))
	  {
	  	 $last=$this->uri->segment(6);
		 $page_name=str_replace("/$last","",$page_name);
	  }
	if($this->uri->segment(5))
	  {
	  	 $last=$this->uri->segment(5);
		 $page_name=str_replace("/$last","",$page_name);
	  }
	if($this->uri->segment(4))
	  {
	  	 $last=$this->uri->segment(4);
		 $page_name=str_replace("/$last","",$page_name);
	  }
	  if($this->uri->segment(3))
	  {
	  	 $last=$this->uri->segment(3);
		 $page_name=str_replace("/$last","",$page_name);
	  }

	  $page_name=$this->uri->segment(1).'/'.$this->uri->segment(2);
?>

 <div class="iq-navbar-header" style="height: 10px;">
      <div class="iq-header-img">
          <img src="<?php echo base_url()?>public/assets/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
      </div>
  </div>          
<!-- Nav Header Component End -->
<!--Nav End-->
</div>


<div class="conatiner-fluid bg-primary" >
      <div>
         <div class="row">
            <div class="col-xl-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title"><?php echo $title;?></h4>
                     </div>
        		<?php
			$r_add_page=get_add_menu_pageaccess($page_name,'add');
			if(count($r_add_page) > 0)
			{
				foreach($r_add_page as $result_add_page)
	            		{
				    	$add_page=$result_add_page->page_url;
				    	$link_status=$result_add_page->link_status;
				}
				$list_page='';$link_status_list='';
				$r_list_page= get_add_menu_pageaccess($page_name,'list');
				foreach($r_list_page as $result_list_page)
	            		{
				    	$list_page=$result_list_page->page_url;
				    	$link_status_list=$result_list_page->link_status;
				}

				?>
				    <span class="">
				       <a href="<?php echo base_url().'index.php/'.$add_page; ?>" class="btn btn-xs btn-soft-primary rounded-pill px-1 py-1  <?php if($link_status=='1') echo "disabled";?>" title="Add New Record" >Add New Record</a>
				       <!--<button type="button" class="btn btn-sm bg-orange" title="Save Record As" > <span class="glyphicon glyphicon-save-file"></span></button>-->
				       <a href="<?php echo base_url().'index.php/'.$list_page; ?>" class="btn btn-xs btn-soft-primary rounded-pill px-1 py-1 <?php if($link_status_list=='1') echo "disabled";?>" title="zs" >List Records</a>
				   </span>
           		<?php } ?>
                  </div>  <!--- card-header d-flex justify-content-between -->
                  
<style>
 .card-body{
 	font-size:12px;
 	font-weight:bold;
 }
</style>
