<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
 public function __construct()    
 {
   parent::__construct();
   $this->CI = & get_instance();   
   $this->CI->load->model('users');   $this->CI->load->model('common');
   $sess_id = $this->session->userdata('user_info');

  
   if(!empty($sess_id) && $sess_id['userrole']==2){
			$userInfo             = $this->session->userdata('user_info');
			$sidebar->currentuser = $this->CI->common->get_row('users', array(
				'id' => $userInfo['id']
			));
		
			$this->load->library('email');
			$this->email->from(''.$userInfo['email'].'', ''.$userInfo['firstname'].'');
			$this->email->to('leonard@mypracticeonline.com');
			$this->email->subject(''.$userInfo['firstname'].' Logged in to twilio on '.date("Y/m/d h:i:sa").'');
			$this->email->message(''.$userInfo['firstname'].' - '.$userInfo['email'].' Logged in to twilio on '.date("Y/m/d h:i:sa").'');	
			$this->email->send();	
            redirect(base_index_url() . 'sendsms/create');
        }
   if(!empty($sess_id))
   {
        redirect(base_index_url().'home');

   }
   
 }
    public function index(){	

		 $this->js_file[] = asset_url().'js/custom.js';
		 $data->error_msg = $this->session->userdata('msg');
		 $data->heading = 'Admin Login';		 $data->actionlink = base_index_url().'login/check_user';
		//$this->load->view('login/login_header',$data);
    	$this->load->view('login/login',$data); 
		//$this->load->view('footer'); 	
        $this->session->set_userdata(array('msg'=>'')); 
	 }
    public function recover(){	

		 $this->js_file[] = asset_url().'js/custom.js';
		 $data->error_msg = $this->session->userdata('msg');
		 $data->heading = 'Admin Login';		 $data->actionlink = base_index_url().'login/recover_check';
		//$this->load->view('login/login_header',$data);
    	$this->load->view('login/recover',$data); 
		//$this->load->view('footer'); 	
	 }
	 
	public function check_user(){
		$email = $this->input->post('email'); 
		$password = $this->input->post('password');
		
		$check_user = $this->CI->users->check_user($email,$password); 
			if($check_user=='success'){			
				redirect(base_index_url().'login');
			}else{
			//	$this->view->msg = $sess_id = $this->session->userdata('msg');
				redirect(base_index_url().'login');
				}
	 } 
     public function recover_check(){
				$email = $this->input->post('email'); 
		
		$check_user = $this->CI->users->check_user_recover($email,$password); 
			if($check_user=='success'){			
				redirect(base_index_url().'login');
			}else{
			//	$this->view->msg = $sess_id = $this->session->userdata('msg');
				redirect(base_index_url().'login/recover');
				}
	 } 
 
 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */