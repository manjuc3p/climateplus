<?php

function get_check_status_for_group($access_id,$group_id)
{
	$CI =& get_instance();
	if($group_id!='')
			$userquery="and group_id='$group_id'";
		else
			$userquery = '';

	$query=$CI->db->query("select count(*) as count from group_access
							where  resource_type='P'
							$userquery and access_id=$access_id
							;");
   return $query->row('count');


}


function get_check_status_for_user($access_id,$user_id)
{
	$CI =& get_instance();
	if($user_id!='')
			$userquery="and user_id='$user_id'";
		else
			$userquery = '';

	$query=$CI->db->query("select count(*) as count from user_access
							where  resource_type='P'
							$userquery and access_id=$access_id
							;");
   return $query->row('count');


}

function get_pagename_for_timeout($p_name)
{
	$CI =& get_instance();

	$query=$CI->db->query("select page_name from page_access  where timeout='L' and page_name='$p_name';");

    return $query->row('page_name');
}

function get_page_timeout($page_id)
{

    $CI =& get_instance();

    $query=$CI->db->query("select timeout from page_access where page_id='$page_id' group by page_name;");

    return $query->row('timeout');

}

function get_timeout($a)
{
    $CI =& get_instance();

    if($a=='S')
    {
      $b='short_time';
    }
    else {
	  $b='long_time';
    }
    $query=$CI->db->query("select $b as page_time from login_time;");

    return $query->row('page_time');



}
function check_page_staus()
{
  $CI =& get_instance();

    $query=$CI->db->query("select timeout from page_access where page_id='$page_id' group by page_name;");

    return $query->row('timeout');

}
function check_login_timeout($user_id)
     {
         $CI =& get_instance();
         $query=$CI->db->query("select count(*) as active,ip_address from users where user_id='$user_id' and log_status=1 and expiry > now();");
         return $query->row('active');
     }
 function set_log_out($user_id)
 {
        $CI =& get_instance();
        $date = date('Y-m-d h:i:s');
        $query=$CI->db->query("UPDATE users SET active_session='',time=now(),expiry='',ip_address='',log_status=0 where user_id='$user_id';");
 }
 
 function get_item_status1($page_name)
{
	$CI =& get_instance();

	$query=$CI->db->query("select * from page_access
							where page_name='$page_name' order by attribute;");

  return $query->result();


}
 
?>