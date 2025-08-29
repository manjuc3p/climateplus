<?php
//https://php-minify.com/php-obfuscator/

date_default_timezone_set('Asia/Kolkata');
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function index()
	{
		$data['msg']="";
		$this->load->view('login/login.php',$data);
	}
	function sign_in()
	{
		$data['msg']="";
		$this->load->view('login/login.php',$data);
	}	
    function validate_credentials()
    {
		$date = date('Y-m-d h:i:s');
		$today=date('Y-m-d');
		$remember = $this->input->post('remember_me');
		if($remember) {			
			$rememberme = "'remember_me'=> true";
		}
        $this->load->model('Login_model');
        $query = $this->Login_model->validate();
                
        if($query) 
        {
            foreach($query as $key) 
            {
                $sess_id = $key->user_id.'-'.time();                            
                $data = array(
					'user_id' =>$key->user_id,
					'user_name' =>$key->user_name,
					'user_pass' =>$key->password,
					'dept' =>$key->dept_name,
					'email_id' =>$key->email_id,
					'contact_no' =>$key->contact_no,
					'time'=>$date,
					'is_logged_in' => true,
					'edit_icon'=>"<span class='btn-inner'><svg class='icon-20' width='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' ><path d='M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path><path fill-rule='evenodd' clip-rule='evenodd' d='M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path><path d='M15.1655 4.60254L19.7315 9.16854' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path></svg></span>",
					'delete_icon'=>"<span class='btn-inner'><svg class='icon-20' width='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='currentColor'><path d='M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path><path d='M20.708 6.23975H3.75' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path><path d='M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'></path></svg></span>",
					 $rememberme
				);
				$this->session->set_userdata($data);    

				$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
				$ci = get_instance();
				$ci->load->helper('log');
				$log_msg=add_log_entry($key->user_id,5,$page_name[1],'users','user_id',$key->user_id);    
				if($key->department == 2){
					redirect('Admin/view_accounts_dashboard');
				}
				elseif($key->department == 3){
					redirect('Admin/view_operations_dashboard');
				}  
				else{
					redirect('Admin/view_admin_dashboard');
				}
			}
		}
        else 
        {
            $this->session->set_flashdata('error', 'Invalid Username or Password...');                      
            $this->load->view('login/login.php');
        }
       }
    
     

   	function check_duplicate() {
		$this->load->model('Login_model');
        $ecount = $this->Login_model->check_duplicate_entry();
		echo $ecount;
	}
	
	function check_user_name_exist() {
		$this->load->model('Login_model');
        $ecount = $this->Login_model->check_user_name_exist();
		
		echo $ecount;
	}
	//////////////**********User Profile start ***********///////////
	function profile()
	{
	    $data['title']="My Profile";
	    $user_id=$this->session->userdata('user_id');
	    $this->load->model('Setup_model');
	    $data['user']=$this->Setup_model->get_employee_details_by_id($user_id);
	    $data['user']="";
	    $data['main_content']='login/profile.php';
	    $this->load->view('includes/template.php',$data);
	}
	
	/*******************************************
		change password function starts here
	*******************************************/
	public function change_pass()
	{
	 	$data['title']="Change My Password";
		$data['main_content']='login/change_pass.php';
		$this->load->view('includes/template',$data);
	}
	
	public function change_password()
	{
	 	$data['title']="Change My Password";
		$this->load->model('Login_model');
		$query=$this->Login_model->change_password();
		
		if($query==-1)
		{
			$this->session->set_flashdata('warning', 'Old password not match...');
			$data['msg']= "";
			redirect('Login/change_pass');			
		}
		else if($query==0)
		{
			$this->session->set_flashdata('warning', 'New password & confirm password not match...');
			$data['msg']= "";
			redirect('Login/change_pass');	
		}
		else
		{	
			$this->session->set_flashdata('success', 'password changed successfuly...');
			$data['msg']= "";
			redirect('Login/change_pass');			
		}
	}
	
	/*******************************************
		forget password function starts here
	*******************************************/
	function reset_password()
	{
		$email =$this->input->post('email');
		$this->load->model('Login_model');
        	$password = $this->Login_model->get_password();
        	$fname = $this->Login_model->get_first_name();
		
		if($password)
		{
		    $headers = 'From: info@sunshot.in' . "\r\n";
				$headers .= "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		    $to=$email;
		    $subject="Sunshot password assistance";
		    $body="
		   <HTML>
		    <body style='border:1px solid red;'>
		    <font face='arial'>
		    
		    <br><br>
			Dear Sir/Madam <b>".$fname."</b>,
				<br><br>

		    We received your request.<br>
		    Password for your Sunshot account is : $password  
		    <br><br>
		    
		    You can login by clicking on the below link:<br> 
		    <a href='http://www.sunshotview.com/sunshot/'>www.sunshot.com</a>
		    <br><br> 
		    
		  	<p style=' color:#4c4c4c;'>Thanks,<br>
		    <b>Sunshot Technologies Pvt.Ltd.</b><br>
		    (Formely Agneya Carbon Ventures Pvt.Ltd.)<br>
		    B-312,GO Square Corporate Park,
		    Wakad-Hinjewadi Road,Wakad,Pune 411057
		    Tel:020 60123800/+91 9637113279<br>
		    <a href='http://www.sunshot.in'>www.sunshot.in</a>
		    
		    
				<table width='100%'>
		    <tr>
			<td width='25%'><img src='". base_url()."public/images/dashboard_logo.png' width='100'></td>
			</tr>
		    </table>
		    </font></body></html>
		    ";

		    mail($to,$subject,$body,$headers);
		    $this->session->set_flashdata('success', 'Password will be sent to your registered email id...');
				$data['msg']="";
				$this->load->view('login/login.php', $data);
		}
		else
		{
			$this->session->set_flashdata('warning', 'This email is not registered with us.');
				$data['msg']="";
				$this->load->view('login/login.php', $data);
		}
			
	}
	function verify()
	{
		$pid =$this->uri->segment(3);
		$this->load->model('Login_model');
		$data = $this->Login_model->email_verification();
		$this->load->view('login/verify.php', $data);
		//redirect('Login/index');
	}
	/*******************************************
		logout function starts here
	*******************************************/
	function logout()
	{
		$user_id=$this->session->userdata('user_id');
       	        $session_id=$this->session->userdata('session_id');
		
		$user_se_id=$this->session->userdata('session_id');
		$page_name=explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg=add_log_entry($user_se_id,6,$page_name[1],'users','user_id',$user_se_id);    

		$this->load->model('Login_model');
		$data = $this->Login_model->update_session_id($session_id,$user_id);
		$this->session->sess_destroy();
		redirect('Login');

	}	
	

}
