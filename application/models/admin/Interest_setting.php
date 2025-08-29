<?php

class Interest_setting extends CI_Model {

//////////////////////////////////Intrest details start/////////////////////////////////
	
	function get_interest_details() //in use
	{
	//	$query = $this->db->query("select * from tax_data_entity where tax_type=5 order by applicable_date desc limit 1;");
		$query = $this->db->query("select * from tax_data_entity where tax_name='Interest' order by sno desc limit 10;");
		return $query->result();
	}
	
	function get_interest() // in use
	{
		$query = $this->db->query("select * from tax_data_entity where tax_name='Interest' order by sno desc limit 1;");
		return $query->result();
	}
	
	function get_interest_details_edit()
	{
		$id=$this->uri->segment(3);
		$query = $this->db->query("select * from tax_data_entity where sno='$id' ");
		return $query->result();
	}
	
	function get_vat_details()
	{
		$query = $this->db->query("select * from tax_data_entity where tax_type=4 order by applicable_date desc limit 1;");
		return $query->result();
	}

	function get_tax_details()
	{
		$query = $this->db->query("select one.tax_value,one.applicable_date,one.sno,two.sno,edu_cess,three.sno,higher_edu from
		(select tax_value,applicable_date,sno from tax_data_entity where tax_type=1 order by applicable_date desc limit 1) as one
		 left join (select sno,(tax_value) as edu_cess from tax_data_entity where tax_type=2 order by applicable_date desc limit 1) as two on (1=1)
		 left join (select sno,tax_value as higher_edu from tax_data_entity where tax_type=3 order by applicable_date desc limit 1) as three on(1=1);");
		return $query->result();
	}
    function get_discount_details()
    {
        $query = $this->db->query("select tax_code,tax_value,applicable_date,tax_period from tax_data_entity where tax_code=4 order by applicable_date desc limit 1");
        return $query->result();
    }

	function get_service_tax_details()
	{
		$query = $this->db->query("select sum(tax_value) as tax_value from tax_data_entity where tax_code=1");
		return $query->result();
	}
	function get_timeout_details()
	{
		$query = $this->db->query("select * from login_time where time_id=1;");
		return $query->result();
	}
	
	function add_intrest_details() //in use
	{
		$sno=$this->input->post('intrest_id');
		$date=date('Y-m-d',strtotime($this->input->post('date')));
		$app_date=date('Y-m-d',strtotime($this->input->post('applicable_date')));
			
		if($date!=$app_date){
		$data = array(
			'applicable_date' =>date('Y-m-d',strtotime($this->input->post('applicable_date'))),
			'tax_value' => $this->input->post('interest'),
			'tax_period' => $this->input->post('interest_in_days'),
			'tax_name'=>'Interest',
			'tax_type'=>5,
			'tax_code'=>3,
			'tax_exemption_amt'=>$this->input->post('minimum_interest')
		);
		$this->db->insert('tax_data_entity',$data);
		$insert_id = $this->db->insert_id();
		}
		
		else{
			
			$data1 = array(
			'applicable_date' =>date('Y-m-d',strtotime($this->input->post('applicable_date'))),
			'tax_value' => $this->input->post('interest'),
			'tax_period' => $this->input->post('interest_in_days'),
			'tax_name'=>'Interest',
			'tax_type'=>5,
			'tax_code'=>3,
			'tax_exemption_amt'=>$this->input->post('minimum_interest')
		);
		$this->db->where_in('sno',$sno);
		$insert_id=$this->db->update('tax_data_entity', $data1);
		
		}
		if($insert_id) {
        	$user_se_id=$this->session->userdata('session_id');			
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'tax_data_entity','sno',$insert_id);		   
	        return $insert_id;
		}
	}
	
/*	function update_intrest_details() { 
		$id=$this->input->post('interest_id');
		$data = array(
			'applicable_date' => $this->input->post('applicable_date'),
			'tax_value' => $this->input->post('interest'),
			'tax_period' => $this->input->post('interest_in_days'),
			'tax_name'=>'Interest',
			'tax_type'=>5,
			'tax_code'=>3,
			'tax_exemption_amt'=>$this->input->post('minimum_interest')
		);
		$this->db->where_in('sno',$id);
		$this->db->update('tax_data_entity', $data);
		$insert_id = $id;		
		if($id) {
        	$user_se_id=$this->session->userdata('session_id');			
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,2,$page_name[1],'tax_data_entity','sno',$id);		   
	        return $id;
		}
	}
	
	function update_interest_detailsqqqqq()
	{
		$id=$this->input->post('interest_id');
		$data = array(

			'applicable_date' => $this->input->post('applicable_date'),
			'tax_value' => $this->input->post('interest'),
			'tax_period' => $this->input->post('interest_in_days'),
			'tax_name'=>'Interest',
			'tax_type'=>5,
			'tax_code'=>3,
			'tax_exemption_amt'=>$this->input->post('minimum_interest')
		);
		$this->db->insert('tax_data_entity', $data);

		$insert_id=$this->db->insert_id();
			$uid = $this->session->userdata('user_id');		
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($uid,2,$page_name[1],'tax_data_entity','sno',$insert_id);		   
	        return $insert_id;
		
	}
	*/
//////////////////////////////////Intrest details end/////////////////////////////////

///////////////////////////////////Discount Details Start////////////////////////////////

	function add_discount()
    {
    	$did=$this->input->post('discount_id');
	$division_id=$this->input->post('division_id');
	$category_id=$this->input->post('category_id');
        $f_date=date('Y-m-d',strtotime($this->input->post('f_date')));
        $to_date=date('Y-m-d',strtotime($this->input->post('to_date')));
		
		$data = array(
            'discount_rate' =>$this->input->post('disc_rate'),
            'disc_date_from' => date('Y-m-d',strtotime($this->input->post('date_from'))),
            'disc_date_to' => date('Y-m-d',strtotime($this->input->post('date_to'))),
            'discount_period' => $this->input->post('disc_period'),
            'division_id'=>$division_id,
            'category_id'=>$category_id,
            'discount_type'=> $this->input->post('discount_type')
        );
            $this->db->insert('discount', $data);
            $insert_id = $this->db->insert_id();
	
		if($insert_id) {
        	$user_se_id=$this->session->userdata('session_id');			
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'discount','did',$insert_id);		   
	        return $insert_id;
    	}
	}

    function update_discount()
    {
        $id=$this->input->post('discount_id');
	$division_id=$this->input->post('division_id');
        $category_id=$this->input->post('category_id');
         $data = array(
            'discount_rate' =>$this->input->post('disc_rate'),
            'disc_date_from' => date('Y-m-d',strtotime($this->input->post('date_from'))),
            'disc_date_to' => date('Y-m-d',strtotime($this->input->post('date_to'))),
            'discount_period' => $this->input->post('disc_period'),
            'division_id'=>$division_id,
            'category_id'=>$category_id,
            'discount_type'=> $this->input->post('discount_type')
        );
        $this->db->where('did',$id);
        $res=$this->db->update('discount', $data);
        return true;

      /*  $data = array(

            'applicable_date' => $this->input->post('applicable_date'),
            'tax_value' =>$this->input->post('disc_perc'),
            'tax_period' =>$this->input->post('disc_period'),
            'tax_type'=>6,
            'tax_code'=>4,
            'tax_name'=>'Discount'
        );
        $this->db->insert('tax_data_entity', $data);

        $user_se_id=$this->session->userdata('user_id');
        $session_id=$this->session->userdata('session_id');
        $ci = get_instance();
        $ci->load->helper('log');
        add_record($user_se_id,$session_id,'tax_data_entity','Vat Parameters',"Tax name: VAT"." | Tax value:".$this->input->post('vat')." | Applicable Date:".$this->input->post('applicable_date'),'Record Updated','');
       * /
       */
    }
    
	
    function get_discount_records() // in use
    {
        $query=$this->db->query("select * from (select * from discount d, category_data_entity c where c.cat_id=d.category_id)as one left join(select name,div_id from division_data_entity)as two on(one.division_id=two.div_id) ");
        return $query->result();
    }
	
	function get_discount_records_id() // in use
    {
    	$id=$this->uri->segment('3');
        $query=$this->db->query("select * from discount where did='$id' order by did desc limit 1 ");
        return $query->result();
    }
	
    

/////////////////////////////////////////Discount details End////////////////////////////////




	function update_tax_details()
	{
		$id=$this->input->post('tax_type');

		$ecess= ($this->input->post('service_rate')/100)*$this->input->post('edu_cess');
        $hcess= ($this->input->post('service_rate')/100)*$this->input->post('higher_edu_cess');
		$data = array(

			'applicable_date' => $this->input->post('applicable_date'),
			'tax_value' => $this->input->post('service_rate'),
			'tax_type'=>1,
			'tax_code'=>1,
			'tax_name'=>'Service Tax'
		);
		$this->db->insert('tax_data_entity', $data);

		$data = array(

			'applicable_date' => $this->input->post('applicable_date'),
			'tax_value' => $ecess,
			'tax_type'=>2,
			'tax_code'=>1,
			'tax_name'=>'Edu Cess'
		);
		$this->db->insert('tax_data_entity', $data);
		$data = array(

			'applicable_date' => $this->input->post('applicable_date'),
			'tax_value' => $hcess,
			'tax_type'=>3,
			'tax_code'=>1,
			'tax_name'=>'Higher Edu Cess'
		);
		$this->db->insert('tax_data_entity', $data);

		$insert_id=$this->db->insert_id();
			$uid = $this->session->userdata('user_id');		
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($uid,2,$page_name[1],'tax_data_entity','sno',$insert_id);		   
	        return $insert_id;
		
		}

	function update_vat_details()
	{
		$id=$this->input->post('interest_id');

		$data = array(

			'applicable_date' => $this->input->post('applicable_date'),
			'tax_value' => $this->input->post('vat'),
			'tax_type'=>4,
			'tax_code'=>2,
			'tax_name'=>'VAT'
		);
		$this->db->insert('tax_data_entity', $data);

		$insert_id=$this->db->insert_id();
			$uid = $this->session->userdata('user_id');		
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($uid,2,$page_name[1],'tax_data_entity','sno',$insert_id);		   
	        return $insert_id;
		
		}

	function update_time_details()
	{
		$id=$this->input->post('interest_id');

		$data = array(

			'short_time' => $this->input->post('short_time'),
			'long_time' => $this->input->post('long_time'),
			);

		$this->db->where('time_id', $id);
		$this->db->update('login_time', $data);

		$insert_id=$this->db->insert_id();
			$uid = $this->session->userdata('user_id');		
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($uid,2,$page_name[1],'login_time','time_id',$insert_id);		   
	        return $insert_id;
		
		}

   function cal_discount()
   {
         $query1=$this->db->query("select discount_period,discount_rate_one,discount_rate_three,disc_app_date from discount order by disc_app_date desc limit 1");
         $data['disc_rec']=$query1->result();

         foreach ($data['disc_rec'] as $r)
         {
             $discount_rate_one=$r->discount_rate_one;
             $discount_rate_three=$r->discount_rate_three;
             $disc_app_date=$r->disc_app_date;
             $disc_period=$r->discount_period;

         }


            $query3 = $this->db->query("select from_date,to_date from financial_details where active=1");
            $temp['rec']=$query3->result();
            foreach ($temp['rec'] as $r1)
            {
            $from_date=$r1->from_date;
            $to_date=$r1->to_date;
            }

            //check for yearly cnt

            $query2=$this->db->query("select GrandTotal as y_amt,count(*) as y_cnt,CustomerID from invoice_master where invoicedate between $from_date and '$disc_app_date' and (invoicecode like ('PMC/__________________') or invoicecode like ('PESPL/__________________') )group by CustomerID");
            $temp['yearly_rec']=$query2->result();
            foreach ($temp['yearly_rec'] as $r1)
            {
                    if($r1->y_cnt==1)//yearly bill is genrated
                    {
                        $cnt=$this->check_for_previous_auto_credit_note($r1->CustomerID,$from_date,$to_date); //check for previous credit note for 3
                        if($cnt==0)
                        {
                            $this->load->model('pmc/accounts/debit_note');
                            $balance=$this->debit_note->get_opening_bal($r1->CustomerID,$disc_app_date);
                            $sale_amt=$this->check_for_sale_amount($r1->CustomerID,$disc_app_date,$from_date);
                            $outstanding=$balance-$sale_amt;
                            if($outstanding < 0 ) // credit amount
                            {
                                $one_y_amt=$r1->y_amt;
                                $three_y_amt=$r1->y_amt;
                                if($outstanding >= $three_y_amt)
                                {
                                    $disc_perc=(100-$discount_rate_three)/100;
                                    $amount=$three_y_amt*$disc_perc;

                                    $this->load->model('pmc/accounts/debit_note');
                                    $this->debit_note->add_auto_cr_note($r1->CustomerID,$amount,$discount_rate_three);
                                    $this->debit_note->update_occupier_discount($r1->CustomerID,3,$from_date);
                                }
                                else
                                {
                                    $disc_perc=(100-$discount_rate_one)/100;
                                    $amount=$three_y_amt*$disc_perc;

                                    $this->load->model('pmc/accounts/debit_note');
                                    $this->debit_note->add_auto_cr_note($r1->CustomerID,$amount,$discount_rate_one);
                                    $this->debit_note->update_occupier_discount($r1->CustomerID,1,$from_date);
                                }


                            } // for credit balance
                        } // for previous auto cr note

                    } //check for yeraly bill
            }//end for each

   }

   function check_for_previous_auto_credit_note($occupier_id,$from_date,$to_date)
    {
            $query=$this->db->query("select discount_for from bmwregistration r where discount_date between '$from_date' and '$to_date' and occupier_id='$occupier_id' ;");
            $discount_for=$query->row('discount_for');
            if($discount_for==1)
            {
           $query=$this->db->query("select count(*) as auto_crcount from bmwregistration r where discount_date between '$from_date' and '$to_date' and occupier_id='$occupier_id' ;");
           return $query->row('auto_crcount');
            }
            else {
           $query=$this->db->query("select count(*) as auto_crcount from bmwregistration r where discount_date >='$from_date' and occupier_id='$occupier_id' and discount_for=3;");
           return $query->row('auto_crcount');
            }

    }

    function check_for_sale_amount($occupier_id,$disc_app_date,$from_date)
    {

           $query=$this->db->query("select sum(Amount) as sale_amount from ledger_transactions l, bmwregistration r where r.ledger_id = l.OccupierID and r.occupier_id='$occupier_id' and VoucherDate between '$from_date' and '$disc_app_date' and VoucherType='S' ");
           return $query->row('sale_amount');

    }
	
	
	/* ---------- gst strt --------- */
	
	function add_gst_record()
	{
		$hsn = $this->input->post('hsn_code');
		$gst_per = $this->input->post('gst_per');
		$sgst_percentage=$this->input->post('sgst_per');
		$cgst_percentage=$this->input->post('cgst_per');
		$effective_date = date('Y-m-d', strtotime($this->input->post('effective_date')));
		$data = array(
			'type_of_item' => $this->input->post('type_of_item'),
			'hsn_code' => $this->input->post('hsn_code'),
			'gst_percentage' => $this->input->post('gst_per'),
			'sgst_percentage' => $this->input->post('sgst_per'),
			'cgst_percentage' => $this->input->post('cgst_per'),
			'Igst_percentage' => $this->input->post('Igst_per'),
			'effective_date' => $effective_date,
        );
		$insert_id=$this->db->insert('gst_master', $data);

		$user_se_id=$this->session->userdata('session_id');			
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,1,$page_name[1],'gst_master','gst_master_id',$insert_id);		   
        return $insert_id;
	}
	
	function get_gst_records_sort_by_order()
	{
		$query = $this->db->query("select * from gst_master");
		return $query->result();
	}
	
	function get_gst_records_by_id($id)
	{
		$id = $this->uri->segment('3');
		$query = $this->db->query("select * from gst_master where gst_master_id = '$id' ");
		return $query->result();
	}
	
	function update_gst_record()
	{
		$id=$this->input->post('gst_master_id');
		$hsn = $this->input->post('hsn_code');
		$gst_per = $this->input->post('gst_per');
		$sgst_percentage=$this->input->post('sgst_per');
		$cgst_percentage=$this->input->post('cgst_per');
		
		$effective_date = date('Y-m-d', strtotime($this->input->post('effective_date')));
		$old_effective_date = date('Y-m-d', strtotime($this->input->post('old_effective_date')));
		
		if($effective_date==$old_effective_date)
		{
			
			$data = array(
			//'type_of_item' => $this->input->post('type_of_item'),
			'hsn_code' => $this->input->post('hsn_code'),
			'gst_percentage' => $this->input->post('gst_per'),
			'sgst_percentage' => $this->input->post('sgst_per'),
			'cgst_percentage' => $this->input->post('cgst_per'),
			'Igst_percentage' => $this->input->post('Igst_per'),
			'effective_date' => $effective_date,
			);
			$this->db->where('gst_master_id',$id);
			$res=$this->db->update('gst_master', $data);
			
			$log_entry=2;  //update
		}
		
		else {
			$data = array(
			'type_of_item' => $this->input->post('type_of_item'),
			'hsn_code' => $this->input->post('hsn_code'),
			'gst_percentage' => $this->input->post('gst_per'),
			'sgst_percentage' => $this->input->post('sgst_per'),
			'cgst_percentage' => $this->input->post('cgst_per'),
			'effective_date' => $effective_date,
	        );
			$res=$this->db->insert('gst_master', $data);
			
			$log_entry=1;  //add
		}
		
        if($res)
        {
		$user_se_id=$this->session->userdata('session_id');			
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,$log_entry,$page_name[1],'gst_master','gst_master_id',$id);		   
		
		return true;
        }
        else
        {
            return false;
        }
	}

	//for bmw bag
	function get_lastest_gst_detail() {
       	$query = $this -> db -> query("select * from gst_master where type_of_item=1 order by effective_date desc limit 1");
        return $query -> result();
    }
	
	//for bmw bag
	function get_lastest_gst_detail_bag_purchase() {
       	$query = $this -> db -> query("select * from gst_master where type_of_item=4 order by effective_date desc limit 1");
        return $query -> result();
    }
	
	//for bmw sticker
	function get_latest_gst_detail_for_bmw_sticker() {
       	$query = $this -> db -> query("select * from gst_master where type_of_item=2 order by effective_date desc limit 1");
        return $query -> result();
    }
	
	function get_count_of_type_of_item()
	{

		$type_of_item = $this->input->post('type_of_item');
		$query= $this->db->query("select count(*) as count from gst_master where type_of_item=$type_of_item");
		return $query->result();
	}
	/* ---------- gst end --------- */

	////// Sticker Rate
	
	function add_sticker_rate()
    {
    	$id=$this->input->post('id');
	    $date=date('Y-m-d',strtotime($this->input->post('date')));
        
		$data = array(
            'date' => date('Y-m-d',strtotime($this->input->post('date'))),
            'sticker_rate'=> $this->input->post('sticker_rate')
        );
            $this->db->insert('sticker_rate', $data);
            $insert_id = $this->db->insert_id();
	
		if($insert_id) {
        	$user_se_id=$this->session->userdata('session_id');			
			$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
			$ci = get_instance();
			$ci->load->helper('log');
			$log_msg=add_log_entry($user_se_id,1,$page_name[1],'sticker_rate','id',$insert_id);		   
	        return $insert_id;
    	}
	}
	
	function get_sticker_records() // in use
    {
        $query=$this->db->query("select * from sticker_rate; ");
        return $query->result();
    }
	
		function get_sticker_record_id() // in use
    {
    	$id=$this->uri->segment('3');
        $query=$this->db->query("select * from sticker_rate where id='$id' order by date ");
        return $query->result();
    }	
	
	function update_sticker() 
		{
			$id = $this->input->post('id');
			$sticker_rate = $this->input->post('sticker_rate');
			$date = $this->input->post('date');
			
			$data = array(
				'date' => date('Y-m-d',strtotime($this->input->post('date'))),
				'sticker_rate'=>$this->input->post('sticker_rate'),
			);
				$this->db->where('id',$id);
			    $res=$this->db->update('sticker_rate', $data);
	        if($res)
	        {
	        	
				$uid = $this->session->userdata('user_id');		
				$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
				$ci = get_instance();
				$ci->load->helper('log');
				$log_msg=add_log_entry($uid,2,$page_name[1],'sticker_rate','id',$id);		   
					
			return true;
	        }
	        else {
	        return false;
	        }
	}
		
		function delete_sticker_rate(){
		
		$id = $this->input->post('id');
		$query = $this->db->query("delete from sticker_rate where id = '$id'");
         return true;
	}
		
		
		function get_sticker_amount() {
			$query = $this->db->query("select sticker_rate from sticker_rate order by date desc limit 1;");
			return $query->result();
		}
	
}
