<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller
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
        $this->CI =& get_instance();
        $this->CI->load->model('users');
        $this->CI->load->model('common');
        
    }
    
    public function sendsms(){
        $this->load->library('twilio');
         $currentuser =  $this->CI->common->get_row('users', array(
            'id' => $_GET['sender']
        ));
        
        $sms_reciever = $_GET['reciever'];
        $firstname = $_GET['reciever_name'];
        $msg = '';
        $msg .= $currentuser[0]->firstname."\r\n";
        if(!empty($firstname)){
            $msg .= "Hi ".$firstname;
        }
        $msg .= "\r\n".$currentuser[0]->msg_default;
       
        $check_nnumber = $this->CI->common->get_row('message', array(
            'receiver' => $sms_reciever,
            'sender' => $currentuser[0]->twilio_number
        ));
       
        
        if(!empty($check_nnumber) && $_GET['sent']==0){
            $data['status'] = 'Error';
            $data['msg'] = 'Message has already been sent to '.$sms_reciever;
        }else{
            $response = $this->twilio->sms($currentuser[0]->twilio_number, '+1'.$sms_reciever,$msg);
            
            if($response->IsError){
                 if (!strstr($response->ResponseText, 160)) {
                    $data['status'] = 'Error';
                    $data['msg'] = "The message Limit cannot succeed to 160 characters.";
                    }
                if (!strstr($response->ResponseText, 'STOP')) {
                    $data['status'] = 'Error';
                    $data['msg'] =  "This phone number has elected not to receive any further text.  Our system will automatically not allow any further texts to be sent to this phone.";
                }
               
            }
            else{
                
                $insert = array(
                        'receiver' => $sms_reciever,
                        'sender' => $currentuser[0]->twilio_number,
                        'user_id' => $currentuser[0]->id,
                        'status' => 1
                        );
                $this->CI->common->form_insert('message',$insert);
                $update = array('msg_count'=>'msg_count'+1);
                $this->CI->common->update_counts('sent_messages',$currentuser[0]->id,$update);
                $data['status'] = 'Success';
                $data['msg'] = 'The text message has been sent successfully!';
                
            }
        }
        echo json_encode($data);
    }
    
    function updatemessages(){
        
        $records = $this->CI->common->check_records();
        foreach($records as $record){
            $this->CI->common->delete_row('sent_messages',array('doctor_id'=>$record->id));
            $update = array(
                'update_msg_date' => date("Y-m-d", strtotime("+1 month"))
            );
            $this->CI->common->update('users',$record->id,$update);
            
        }
        
        
    }
    
    
    
    
} 