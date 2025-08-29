<?php
function accesscontrol($id)
{
	$CI =& get_instance();
	$query=$CI->db->query("select * from menu_access where menu_sid='$id' and active=0");
	 return $query->result();
}

function get_check_item_status_checked($user_id,$menu_id)
{
    $CI =& get_instance();
	$query=$CI->db->query("select count(*) as count from user_access where resource_type='M' and user_id='$user_id' and access_id=$menu_id");
    return $query->row('count');
}

function get_checkbox_checked_group_access($menu_id,$group_id)
{
	$CI =& get_instance();
	$query=$CI->db->query("select count(*) as count from group_access where resource_type='M' and group_id='$group_id' and access_id=$menu_id");
    return $query->row('count');
}

function check_occupier_blocked($occupier_id)
{
	$CI =& get_instance();
	$query=$CI->db->query("select block as block_status from occupier_block_app_data where occupier_id='$occupier_id' ");
    return $query->row('block_status');
}


function get_menu($uid) {
	$CI =& get_instance();
	
	//$query=$CI->db->query("select * from menu_access where menu_sid=0 order by indexid");

	$query=$CI->db->query("select * from user_access u,menu_access m where m.menu_id=u.access_id and menu_sid=0 and resource_type='M' and user_id='$uid' and active=0 order by indexid");
	
		return $query->result();

}
function get_menu_sid($temppid,$uid)
{
	$CI =& get_instance();
	$query=$CI->db->query("select * from user_access u,menu_access m where m.menu_id=u.access_id and menu_sid='$temppid'and user_id='$uid' and active=0 order by indexid");
	//$query=$CI->db->query("select * from menu_access where menu_sid='$temppid' and active=0 order by indexid ");
	return $query->result();
}

function get_menu_sid_count($temppid)
{
	$CI =& get_instance();

	$query=$CI->db->query("select count(*) as mcount from menu_access where menu_sid='$temppid' and active=0 order by indexid ");
	return $query->row('mcount');
}

function get_menu_by_url($url) {
	$CI =& get_instance();
	$query=$CI->db->query("select * from menu_access where menu_url='$url' ");
   	return $query->result();
}

function get_menu_pid($temppid) {
	$CI =& get_instance();
	$query=$CI->db->query("select * from menu_access where menu_pid='$temppid' order by indexid ");
   	return $query->result();
}

function get_access($session_id,$page) {
	$CI =& get_instance();
	// /index.php/Patient/view_dashboard
	$page_name=explode('/', $page);
	$res1=$page_name[2]."/".$page_name[3];
	$query=$CI->db->query("select  count(*) as pagecount from menu_access where menu_url='$res1' and user_role='$session_id' ");
   	return $query->row('pagecount');
}

function menu_exist($id,$menu) {
	$CI =& get_instance();
	$query=$CI->db->query("select count(*) as rcount from user_menu_access where user_id='$id' and menu_id='$menu'; ");
	return $query->row('rcount');
}

function get_item_status_menu($user_id,$menu_id) //used in user access
{
	$CI =& get_instance();
	if($user_id!='')
			$userquery="and user_id='$user_id'";
		else
			$userquery = '';

	$query=$CI->db->query("select count(*) as count from user_access
							where  resource_type='M'
							$userquery and access_id=$menu_id
							;");

   return $query->row('count');
}

 function get_company_code()
 {
	$CI =& get_instance();
    $query=$CI->db->query('select company_code from company');
    return $query->row('company_code');
 }

 function get_company_names()
 {
	$CI =& get_instance();
    $query=$CI->db->query('select company_name from company');
    return $query->row('company_name');
 }

	function get_company_logo()
	{
		$CI =& get_instance();
		$query=$CI->db->query("select logo from company	;");
	    return $query->row('logo');
	}

	function get_company_details() {
		$CI =& get_instance();
		$query=$CI->db->query("select company_name,company_code,company_email,company_telephone,company_faxno,company_add1,company_add2,company_city,company_pin,company_state,company_website,company_date,company_remark,invoice_ref_no,company_createdby,company_mpcb,company_vat,company_mpcb_expiry,gst_number,pan_number,print_header_pmc,print_header_passco from company");
		 return $query->result();
	}

	
	function get_account_id($id)
	{
        $CI =& get_instance();
        $query=$CI->db->query("select account_id from general_ledger where customer_id = '$id' ");
        return $query->row('account_id');
    }

    ///////////// user access and page access ///
    function check_pageaccess_status($user_id,$menu_id,$type)
    {
		$CI =& get_instance();
	    	$query=$CI->db->query("select count(*) as count from page_access where user_id='$user_id' and menu_id=$menu_id and attribute='$type'");
	    	return $query->row('count');
    }
    function get_add_menu_pageaccess($page_name,$type) {
	$CI =& get_instance();
	$query=$CI->db->query("select page_url,link_status from breadcrumb where master_page=(select master_page from breadcrumb where page_url='$page_name') and page_type='$type'");
   	return $query->result();
    }
   function get_access_level($user_id,$page_url)
   {
	$CI =& get_instance();

	$query=$CI->db->query("select page_id from breadcrumb where page_url='$page_url';");
	$page_id=$query->row('page_id');
	$query=$CI->db->query("select attribute from page_access where user_id=$user_id and page_id='$page_id';");
	$temp['rec']=$query->result();
	$access_str='';
	foreach ($temp['rec'] as $row) {
		$access_str=$access_str.$row->attribute;
	}
	return($access_str);
    }

    function get_user_name_byid($id)
    {
	if($id=='') $id=0;
	$CI =& get_instance();
	$query=$CI->db->query("select concat(FirstName,' ',LastName)as username from users where user_id=$id");
	 return $query->row('username');
   }

	 function get_userid_by_name($username)
	 {
	 	$CI =& get_instance();
	 	$query=$CI->db->query("select user_id from users where user_name='$username' ");
	     return $query->row('user_id');
	 }


	  function get_notification()
	 {
		 $CI=&get_instance();
		 $user_se_id=$CI->session->userdata('user_id');
		 $query=$CI->db->query(" select * from notification where read_flag=0 and user_id=$user_se_id");
		  return $query->result();
	 }
	 
 function convert_number_to_words($no)
{
	$cpre='';
	$lpre='';
	$tpre='';
	$hpre='';
	$upre='';
	$ppre='';
	$words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve',
					'13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Forty',
					'50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninety','100' => 'Hundred','1000' => 'Thousand','100000' => 'Hundred thousand','10000000' => 'million');

    $a=sprintf("%0.2f",$no);
	$Fils=explode(".",$a);
	$rup=$Fils[0];

	if ($rup>=10000000)
	{
	 $cror=(int)($rup/10000000);
		if ($cror <= 20)
		{
		 $cpre=$words["$cror"]." million ";
		}
		else
		{
		 $tens=(int)($cror/10)*10;
		 $units=$cror%10;
		 $cpre=$words["$tens"]." ".$words["$units"]." million ";
		}

	 $rup=$rup%10000000;
	}
	if ($rup>=100000)
	{
	 	$lakh=(int)($rup/100000);
		if ($lakh <= 20)
		{
		 $lpre=$words["$lakh"]." Hundred ";
		}
		else
		{
		 $tens=(int)($lakh/10)*10;
		 $units=$lakh%10;
		 $lpre=$words["$tens"]." ".$words["$units"]." Hundred " ;
		}
	 	$rup=$rup%100000;
	}
	if ($rup>=1000)
	{
	 	$thou=(int)($rup/1000);
		if ($thou <= 20)
		{
		 $tpre=$words["$thou"]." Thousand ";
		}
		else
		{
		 $tens=(int)($thou/10)*10;
		 $units=$thou%10;
		 $tpre=$words["$tens"]." ".$words["$units"]." Thousand ";
		}
	 	$rup=$rup%1000;
	}
	if ($rup>=100)
	{
	 	$hun=(int)($rup/100);
		$hpre=$words["$hun"]." Hundred ";
	 	$rup=$rup%100;
	}
	$tns=$rup;
	if ($tns <= 20)
	{
		$upre="".$words["$tns"];
	}
	else
	{
		$tens=(int)($tns/10)*10;
		$units=$tns%10;
		$upre="".$words["$tens"]." ".$words["$units"];
	}

	if(!empty($Fils[1]))
    {
        $pai=abs($Fils[1]);
    if ($pai == 0)
        $ppre=' ';
    elseif ($pai <= 20)
    {
        $ppre="  and ".$words["$pai"]." Fils";
    }
    else
    {
        $tens=(int)($pai/10)*10;
        $units=$pai%10;
        $ppre="  and ".$words["$tens"]." ".$words["$units"]." Fils";

    }

    }
    else {
        $Fils[1]=0;
        $ppre='';
    }
	$rvalue=" ".$cpre.$lpre.$tpre.$hpre.$upre.$ppre." Only";
	return $rvalue;
	}


    function convert_number($number) {
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . convert_number(abs($number));
        }
        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
    
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number($remainder);
                }
                break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        $word = strtoupper($string);
        return $word;
    }
/************************* End Helper ****************************************/
?>
