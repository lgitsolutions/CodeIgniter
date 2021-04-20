<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sendsms extends CI_Controller
{
    
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -  
     *         http://example.com/index.php/welcome/index
     *    - or -
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
        $sess_id = $this->session->userdata('user_info');
            if(empty($sess_id))
            {
                redirect(base_index_url().'login');

            }
        $this->CI =& get_instance();
        $this->CI->load->model('users');
        $this->CI->load->model('common');
        
    }
    public function create(){
        $userInfo             = $this->session->userdata('user_info');
        $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $totalmessages = $this->CI->common->get_row('sent_messages',array('doctor_id'=>$userInfo['id']));
        if(($dataa->currentuser[0]->unlimited_msgs)>0){
            $countmsg = '';
           
        }elseif(empty($totalmessages)){
            $countmsg = "You have ".$dataa->currentuser[0]->total_messages." messages in your account to send for this month.";
            }elseif($totalmessages[0]->msg_count == $dataa->currentuser[0]->total_messages ){
            $countmsg = "You have to update your account to send more messages in this month.";
            }elseif($totalmessages[0]->msg_count > $dataa->currentuser[0]->total_messages ){
            //$leftmsg = $dataa->currentuser[0]->total_messages - $totalmessages[0]->msg_count;
                $countmsg = "You have to update your account to send more messages in this month.";
            }elseif($totalmessages[0]->msg_count < $dataa->currentuser[0]->total_messages ){
            $leftmsg = $dataa->currentuser[0]->total_messages - $totalmessages[0]->msg_count;
                $countmsg = "You are left with ".$leftmsg." Messages for this month";
            }
        
        $dataa->countmsg = $countmsg;
        $dataa->totalmessages = $totalmessages;
        $dataa->msg = $this->session->userdata('msg');
        $head->heading  = 'Send SMS ';
        $dataa->actionlink  = base_index_url() . 'sendsms/send';
        $this->load->view('header1', $head);
        $this->load->view('sms/create', $dataa);
        $this->load->view('footer', $head);
        $this->session->set_userdata(array('msg'=>'')); 
    }
    public function createin(){
        $userInfo             = $this->session->userdata('user_info');
        $sidebar->campusInfo             = $this->session->userdata('schoolInfo');
        $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $dataa->msg = $this->session->userdata('msg');
        $head->heading  = 'Send SMS ';
        $dataa->actionlink  = base_index_url() . 'sendsms/sendin';
        $this->load->view('header', $head);
        $this->load->view('sidebar', $head);
        $this->load->view('sms/createin', $dataa);
        $this->load->view('footer', $head);
        $this->session->set_userdata(array('msg'=>'')); 
    }
    public function sendin(){
        $userInfo             = $this->session->userdata('user_info');
        //$sidebar->campusInfo             = $this->session->userdata('schoolInfo');
        $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $this->load->library('twilio');
         $sms_sender = $this->input->post('sender');
        $sms_reciever = $this->input->post('receiver');
        $sms_message = trim($this->input->post('default_msg'));
        $msg_number = $this->input->post('check_number');
        $firstname = $this->input->post('name');
        $from = $sms_sender; //trial account twilio number
        $to = $sms_reciever; //sms recipient number
        
        $msg = '';
        $msg .= $dataa->currentuser[0]->firstname."\r\n";
        if(!empty($firstname)){
            $msg .= "\r\nHi ".$firstname;
        }
        $msg .= "\r\n".$sms_message;
        $msg .= "\r\n".$dataa->currentuser[0]->feedbackurl;
        
        $check_nnumber = $this->CI->common->get_row('message', array(
            'receiver' => $sms_reciever,
            'sender' => $sms_sender
        ));
        if(!empty($check_nnumber) && $msg_number < 1){
             $this->session->set_userdata(array('msg'=>'<div id="error_message" style="width:100%; height:100%; "> <h3>Error</h3> Message has already been sent to '.$sms_reciever.' </div>')); 
                redirect(base_index_url().'sendsms/createin');
            
        }else{
            $response = $this->twilio->sms($from, '+1'.$to,$msg);
            if($response->IsError){
				if ($response->ResponseXml->RestException->Code == '21605') {
				  $er =  'The message Limit cannot succeed to 160 characters.';
				}
				if ($response->ResponseXml->RestException->Code == '21211') {
				  $er =  $response->ErrorMessage;
				}
				if ($response->ResponseXml->RestException->Code == '21610') {
				  $er =  'This phone number has elected not to receive any further text.  Our system will automatically not allow any further texts to be sent to this phone. '; 
				}
                $this->session->set_userdata(array('msg'=>'<div id="error_message" style="width:100%; height:100%; "> <h3>Error</h3> Sorry, there was an error sending your form. '.$er.' </div>')); 
                redirect(base_index_url().'sendsms/createin');
            }
            else{
                
                $data = array(
                        'name' => $firstname,
                        'receiver' => $sms_reciever,
                        'sender' => $sms_sender,
                        'user_id' => $userInfo['id'],
                        'status' => 1
                        );
                $this->CI->common->form_insert('message',$data);
                $update = array('msg_count'=>'msg_count'+1);
                if($dataa->currentuser[0]->unlimited_msgs==0){
                    $this->CI->common->update_counts('sent_messages',$userInfo['id'],$update);
                }
                $this->session->set_userdata(array('msg'=>'<div id="success_message" style="width:100%; height:100%; "> <h3>The text message has been sent successfully!</h3> </div>')); 
                redirect(base_index_url().'sendsms/createin');
            }
        }
    }
    public function send(){
        $userInfo             = $this->session->userdata('user_info');
        $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $this->load->library('twilio');
        $sms_sender = trim($this->input->post('sender'));
        $sms_message = trim($this->input->post('default_msg'));
        $sms_reciever = $this->input->post('receiver');
        $firstname = $this->input->post('firstname');
        $msg_number = $this->input->post('check_number');
        $from = $sms_sender; //trial account twilio number
        $to = $sms_reciever; //sms recipient number
        $msg = '';
        $msg .= $dataa->currentuser[0]->firstname."\r\n";
        if(!empty($firstname)){
            $msg .= "\r\nHi ".$firstname;
        }
        $msg .= "\r\n".$sms_message;
        $msg .= "\r\n".$dataa->currentuser[0]->feedbackurl;
		//echo strlen($msg);
        if(empty($to) || (empty($firstname) && isset($firstname))){
          echo  '<div id="error_message" style="width:100%; height:100%; "> <h3>Error</h3> Please fill required fields. </div>';  
        }else{
            $check_nnumber = $this->CI->common->get_row('message', array(
                'receiver' => $sms_reciever,
                'sender' => $sms_sender
            ));
            //echo $this->db->last_query();
            if(!empty($check_nnumber) && $msg_number < 1){
                echo  'exist';
            }else{
                $check = $this->update_msgs_check();
                if($check>0){
                    echo  '<div id="error_message" style="width:100%; height:100%; "> <h3>Error</h3> Your limit of sending messages has been crossed. </div> ';die;
                }
                $response = $this->twilio->sms($from, '+1'.$to,$msg);
                //print_r($response);
                $er = '';
                if($response->IsError){
                    if ($response->ResponseXml->RestException->Code == '21605') {
                      $er =  'The message Limit cannot succeed to 160 characters.';
                    }
					if ($response->ResponseXml->RestException->Code == '21211') {
                      $er =  $response->ErrorMessage;
                    }
                    if ($response->ResponseXml->RestException->Code == '21610') {
                      $er =  'This phone number has elected not to receive any further text.  Our system will automatically not allow any further texts to be sent to this phone. '; 
                    }
                   echo  '<div id="error_message" style="width:100%; height:100%; "> <h3>Error</h3> Sorry there was an error sending your form. <br/> <br/>'.$er.'</div> ';
                }
                else{
                    $data = array(
                            'name' => $firstname,
                            'receiver' => $sms_reciever,
                            'sender' => $sms_sender,
                            'user_id' => $userInfo['id'],
                            'status' => 1
                            );
                    $this->CI->common->form_insert('message',$data);
                    $update = array('msg_count'=>'msg_count'+1);
                    if($dataa->currentuser[0]->unlimited_msgs==0){
                        $this->CI->common->update_counts('sent_messages',$userInfo['id'],$update);
                    }
                    //echo $this->db->last_query();
                    echo  '<div id="success_message" style="width:100%; height:100%; "> <h3>The text message has been sent successfully!</h3></div>';
                }
            }
        }
    }
    public function update_msgs_check(){
        $userInfo             = $this->session->userdata('user_info');
        $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $totalmessages = $this->CI->common->get_row('sent_messages',array('doctor_id'=>$userInfo['id']));
        if(($dataa->currentuser[0]->unlimited_msgs)>0){
            $countmsg = '';
           
        }elseif(empty($totalmessages)){
            $countmsg = 0;
            }elseif($totalmessages[0]->msg_count == $dataa->currentuser[0]->total_messages ){
            $countmsg = 1;
            }else{
                $countmsg = 0;
            }
            return $countmsg;
    }
    public function update_msgs(){
        $userInfo             = $this->session->userdata('user_info');
        $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $totalmessages = $this->CI->common->get_row('sent_messages',array('doctor_id'=>$userInfo['id']));
        if(($dataa->currentuser[0]->unlimited_msgs)>0){
            $countmsg = '';
           
        }elseif(empty($totalmessages)){
            $countmsg = "You have ".$dataa->currentuser[0]->total_messages." messages in your account to send for this month.";
            }elseif($totalmessages[0]->msg_count == $dataa->currentuser[0]->total_messages ){
            $countmsg = "Please upgrade your account for unlimitted number of texts.";
            }elseif($totalmessages[0]->msg_count < $dataa->currentuser[0]->total_messages ){
            $leftmsg = $dataa->currentuser[0]->total_messages - $totalmessages[0]->msg_count;
                $countmsg = "You are left with ".$leftmsg." Messages for this month";
            }
            echo $countmsg;
    }
} 