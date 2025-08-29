<?php 


function get_quotation_wise_invamt_received($quote_id)
{
    $CI =& get_instance();
    
     $query=$CI->db->query("select COALESCE(sum(paid_amt),0)as amount from invoice_master where cancelled=0 and quote_id=$quote_id;");
    return $query->row('amount');
}

?>
