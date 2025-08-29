<?php

function get_fin_year_from_date()
 {
        $CI =& get_instance();
        $query=$CI->db->query('select from_date from financial_details where active=1');
        return $query->row('from_date');

 }
function get_fin_year_to_date()
 {
        $CI =& get_instance();
        $query=$CI->db->query('select to_date from financial_details where active=1');
        return $query->row('to_date');
 }

 function get_state_code()
 {
	  $CI =& get_instance();
      $query=$CI->db->query('select state_code from company');
      return $query->row('state_code');
 }
 function get_operator_code()
 {
	  $CI =& get_instance();
     $query=$CI->db->query('select operator_code from company');
     return $query->row('operator_code');
 }
 function get_expiry_license()
 {
	  $CI =& get_instance();
     $query=$CI->db->query('select value from company');
     return $query->row('value');
 }
 function get_occu_working_time($id)
 {
	if($id=='')
	 return '';
      $CI =& get_instance();
     $query=$CI->db->query("select group_concat(working_time)as working_time from working_time where id in('$id')");
     return $query->row('working_time');
 }
 function get_occu_route_name($id)
 {
	if($id=='')
	 return '';
      $CI =& get_instance();
     $query=$CI->db->query("select group_concat(route_name)as route_name from routemaster where route_master_id in($id)");
     return $query->row('route_name');
 }
 
 function decrypt_code($en_code,$code) {
        $final='';
        $even_arr = array('0', '2', '4', '6', '8' ,'A', 'C', 'E', 'G', 'I', 'K', 'M', 'O', 'Q', 'S', 'U', 'W', 'Y');
        $odd_arr = array('1', '3', '5', '7', '9', 'B', 'D', 'F', 'H', 'J', 'L', 'N', 'P', 'R', 'T', 'V', 'X', 'Z');
        $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $alpha_num = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $only_num = array('0','1','2','3','4','5','6','7','8','9');
        static $base_table = array(
            '000000' => '0', '000001' => '1', '000010' => '2', '000011' => '3',
            '000100' => '4', '000101' => '5', '000110' => '6', '000111' => '7',
            '001000' => '8', '001001' => '9', '001010' => '10', '001011' => '11',
            '001100' => '12', '001101' => '13', '001110' => '14', '001111' => '15',
            '010000' => '16', '010001' => '17', '010010' => '18', '010011' => '19',
            '010100' => '20', '010101' => '21', '010110' => '22', '010111' => '23',
            '011000' => '24', '011001' => '25', '011010' => '26', '011011' => '27',
            '011100' => '28', '011101' => '29', '011110' => '30', '011111' => '31',
            '100000' => '32', '100001' => '33', '100010' => '34', '100011' => '35', 
            '100100' => '36');
        static $alpha_table = array(
            '0' => '0', '1' => '1', '2' => '2', '3' => '3',
            '4' => '4', '5' => '5', '6' => '6', '7' => '7',
            '8' => '8', '9' => '9',
            
            'A' => '10', 'B' => '11', 'C' => '12', 'D' => '13',
            'E' => '14', 'F' => '15', 'G' => '16', 'H' => '17',
            'I' => '18', 'J' => '19', 'K' => '20', 'L' => '21',
            'M' => '22', 'N' => '23', 'O' => '24', 'P' => '25',
            'Q' => '26', 'R' => '27', 'S' => '28', 'T' => '29',
            'U' => '30', 'V' => '31', 'W' => '32', 'X' => '33',
            'Y' => '34', 'Z' => '35');
     
        $inString = $en_code;
        $outString = "";$l="";

        for($i=1;$i<=strlen($inString);$i++) {
            if (is_numeric($inString[$i-1])){
                $keyval = array_search($inString[$i-1], $only_num);
            }
            else{
                $keyval = array_search($inString[$i-1], $alphabet);
            }
            $x = ($keyval%2);
            $outString.=$x;
        }

        $code_len = strlen($code);
    
        if($code_len == 4) {
           for($i=0;$i<=$code_len-1;$i++) {
               $output0 = substr($outString, $i * 6, 6);
               $a = bindec($output0);
               $h = array_search($a, $alpha_table);
               $final.=$h;
           }
        } 
        
        else if($code_len == 5) {
           for($i=0;$i<=$code_len-1;$i++) {
               $output0 = substr($outString, $i * 6, 6);
               $a = bindec($output0);
               $h = array_search($a, $alpha_table);
               $final.=$h;
           }
        }
       
        else if($code_len == 6) {
           for($i=0;$i<=$code_len-1;$i++) {
               $output0 = substr($outString, $i * 6, 6);
               $a = bindec($output0);
               $h = array_search($a, $alpha_table);
               $final.=$h;
           }
        } 
        
        else if($code_len == 7) {
           for($i=0;$i<=$code_len-1;$i++) {
               $output0 = substr($outString, $i * 6, 6);
               $a = bindec($output0);
               $h = array_search($a, $alpha_table);
               $final.=$h;
           }
        }
       
        else {
            $final = '0';
        }
        
        return $final;
        
 }

 function decrypt_seriel_key($code) {
         
        $date = substr($code, 0, 2);
        $t_month = substr($code, 2, 1);
        $t_year = substr($code, -1, 1);
            
        if($t_month == 'A') {
            $month = '01';
        }
        else if($t_month == 'B') {
            $month = '02';
        }
        else if($t_month == 'C') {
            $month = '03';
        }
        else if($t_month == 'D') {
            $month = '04';
        }
        else if($t_month == 'E') {
            $month = '05';
        }
        else if($t_month == 'F') {
            $month = '06';
        }
        else if($t_month == 'G') {
            $month = '07';
        }
        else if($t_month == 'H') {
            $month = '08';
        }
        else if($t_month == 'I') {
            $month = '09';
        }
        else if($t_month == 'J') {
            $month = '10';
        }
        else if($t_month == 'K') {
            $month = '11';
        }
        else if($t_month == 'L') {
            $month = '12';
        }
        else {
            $month = '';
        }
        
        
        if($t_year == 'A') {
            $year = '2018';
        }
        else if($t_year == 'B') {
            $year = '2019';
        }
        else if($t_year == 'C') {
            $year = '2020';
        }
        else if($t_year == 'D') {
            $year = '2021';
        }
        else if($t_year == 'E') {
            $year = '2022';
        }
        else if($t_year == 'F') {
            $year = '2023';
        }
        else if($t_year == 'G') {
            $year = '2024';
        }
        else if($t_year == 'H') {
            $year = '2025';
        }
        else if($t_year == 'I') {
            $year = '2026';
        }
        else if($t_year == 'J') {
            $year = '2027';
        }
        else if($t_year == 'K') {
            $year = '2028';
        }
        else if($t_year == 'L') {
            $year = '2029';
        }
        else if($t_year == 'M') {
            $year = '2030';
        }
        else if($t_year == 'N') {
            $year = '2031';
        }
        else if($t_year == 'O') {
            $year = '2032';
        }
        else if($t_year == 'P') {
            $year = '2033';
        }
        else if($t_year == 'Q') {
            $year = '2034';
        }
        else if($t_year == 'R') {
            $year = '2035';
        }
        else if($t_year == 'S') {
            $year = '2036';
        }
        else if($t_year == 'T') {
            $year = '2037';
        }
        else if($t_year == 'U') {
            $year = '2038';
        }
        else if($t_year == 'V') {
            $year = '2039';
        }
        else if($t_year == 'W') {
            $year = '2040';
        }
        else if($t_year == 'X') {
            $year = '2041';
        }
        else if($t_year == 'Y') {
            $year = '2042';
        }
        else if($t_year == 'Z') {
            $year = '2043';
        }
        else {
            $year = '';
        }
            
       $code = $date.'-'.$month.'-'.$year;
       return $code;
 }
 
 
 function get_child_count($id)
 {
	  $CI =& get_instance();
     $query=$CI->db->query("select count(*) as child_count from bmwregistration where parent = '$id' ");
     return $query->row('child_count');
 }
 
?>
