<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class Doctor extends CI_Controller
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
    
    public function index($id)
    {
        
        $this->load->view('header');
        $this->load->view('login');
    }
    /*********** List of Users **********/
    public function lists($id)
    {
        $userInfo             = $this->session->userdata('user_info');
        $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
       
        $fetch = array('userrole'=>2);
        $dataa->doctors = $this->CI->common->fetchallWhere('users',$fetch);
        $head->heading  = 'Doctors List';
        $this->load->view('header', $head);
        $this->load->view('sidebar', $sidebar);
        $this->load->view('doctor/lists', $dataa);
        $this->load->view('footer');
    }
    public function addNew($id=''){
        
        $userInfo             = $this->session->userdata('user_info');
        $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $head->heading  = 'Add Doctor';
        $dataa->actionlink  = base_index_url() . 'doctor/save';
        $dataa->msg = $this->session->userdata('msg');
        $this->load->view('header', $head);
        $this->load->view('sidebar', $sidebar);
        $this->load->view('doctor/add_edit', $dataa);
        $this->load->view('footer');
        $this->session->set_userdata(array('msg'=>'')); 
    }
    
    public function save(){
        $doctorfirstname = $this->input->post('doctorfirstname');
        $feedbackurl = $this->input->post('feedbackurl');
        $twilionumber     = $this->input->post('twilionumber');
        $passcode     = $this->input->post('password');
        $email     = $this->input->post('email');
        $total_messages     = $this->input->post('total_messages');
        $default_msg     = $this->input->post('default_msg');
        $show_field     = ($this->input->post('show_field')=='on')?1:0;
        $unlimited_msgs     = ($this->input->post('unlimited_msgs')=='on')?1:0;
        /* $check_nnumber = $this->CI->common->get_row('users', array(
            'twilio_number' => $twilionumber
        )); 
        if(!empty($check_nnumber)){
            $this->session->set_userdata(array('msg'=>'<div id="error_message" style="width:100%; height:100%; "> <h3>Error</h3>The twilio number has already been assigned. </div>')); 
            redirect(base_index_url() . 'doctor/addNew');
        }else{ */
        $data = array(
                    'firstname' => $doctorfirstname,
                    'feedbackurl' => $feedbackurl,
                    'twilio_number' => $twilionumber,
                    'email' => $email,
                    'total_messages' => $total_messages,
                    'password' => $passcode,
                    'msg_default' => $default_msg,
                    'show_name_field' => $show_field,
                    'unlimited_msgs' => $unlimited_msgs,
                    'userrole' => 2,
                    );
        
        $this->CI->common->form_insert('users',$data);
        redirect(base_index_url() . 'doctor/lists');
       // }
    }
     public function edit($id)
    {
        if ($this->input->post()) { 
        $doctorfirstname = $this->input->post('doctorfirstname');
        $feedbackurl = $this->input->post('feedbackurl');
        $twilionumber     = $this->input->post('twilionumber');
        $passcode     = $this->input->post('password');
        $email     = $this->input->post('email');
        $total_messages     = $this->input->post('total_messages');
        $default_msg     = $this->input->post('default_msg');
		$show_field     = ($this->input->post('show_field')=='on')?1:0;
		$unlimited_msgs     = ($this->input->post('unlimited_msgs')=='on')?1:0;
        $data = array(
                    'firstname' => $doctorfirstname,
                    'feedbackurl' => $feedbackurl,
                    'twilio_number' => $twilionumber,
                    'email' => $email,
                    'total_messages' => $total_messages,
                    'password' => $passcode,
                    'msg_default' => $default_msg,
					'show_name_field' => $show_field,
					'unlimited_msgs' => $unlimited_msgs,
                    'userrole' => 2,
                    );
        
            $id     = $id;
        $this->CI->common->update('users',$id,$data);
            $this->session->set_userdata(array(
                'msg' => 'Details updated successfully'
            ));
        }
       $userInfo             = $this->session->userdata('user_info');
        $sidebar->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $head->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $dataa->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $dataa->doctorInfo = $this->CI->common->get_row('users', array('id' => $id));
        $head->heading  = 'Edit Doctor';
        $dataa->msg = $this->session->userdata('msg');
        $dataa->actionlink  = base_index_url() . 'doctor/edit/'.$id;
        $this->load->view('header', $head);
        $this->load->view('sidebar', $sidebar);
        $this->load->view('doctor/add_edit', $dataa);
        $this->load->view('footer');
        //$this->session->unset_userdata('msg'); 
    }
    public function deleteRecord($id)
    {
        $this->CI->common->delete_row('users', array(
            'id' => $id
        ));
    }
} 