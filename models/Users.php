<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {

    function __construct() {
	$this->load->database();
    }
	
	function check_user($email,$password){
       if(!empty($email) && !empty($password)){
$query = $this->db->query("SELECT * FROM users WHERE email = ?", array($email));
$data =  $query->row_array();
if($query->num_rows()>0){
	

	if($data['password'] === $password ){

			$this->session->set_userdata(array('msg'=>'<div id="success_message" style="width:100%; height:100%; "> <h3>Login Successfull</h3> </div>')); 
			$this->session->set_userdata(array('user_info'=>$data));
			return 'success';
		}else{
			$this->session->set_userdata(array('msg'=>'Wrong Password')); 
			return 'error';
			}
		}else{
			$this->session->set_userdata(array('msg'=>'Wrong Email Address')); 
			return 'error';
		}
		}else{
			$this->session->set_userdata(array('msg'=>'Wrong Information')); 
			return 'error';
	}
	
}

function check_user_recover($email){
       if(!empty($email)){
$query = $this->db->query("SELECT * FROM users WHERE email = ?", array($email));
$data =  $query->row_array();
if($query->num_rows()>0){
	
    $mail['to'] = $data['email'];
    $mail['subject'] = "Recover Password";
    $mail['message'] = "Dear ".$data['firstname'];
    $mail['message'] .= "<br/><br/> You are registered with us. <br/>
                        Your Password is ".$data['password'];
        if(!send_email($mail)){
            $this->session->set_userdata(array('msg'=>'Error in sending email. Please try after sometime')); 
                    return 'error';
        }else{
            $this->session->set_userdata(array('msg'=>'We have successfully sent you an email to recover the password')); 
                return 'success';
        }
	
		}else{
			$this->session->set_userdata(array('msg'=>'Wrong Email Address')); 
			return 'error';
		}
		}else{
			$this->session->set_userdata(array('msg'=>'Wrong Information')); 
			return 'error';
	}
	
}
	
    function get_user_info($user_id) {
        $query = $this->db->query("SELECT * FROM users WHERE id = ?", array($user_id));
        return $query->row_array();
    }
    function configure_school($school_id) {
        $this->session->set_userdata(array('schoolInfo'=>$school_id)); 
       
    }

}