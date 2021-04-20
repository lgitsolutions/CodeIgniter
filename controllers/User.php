<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
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
        if (empty($sess_id)) {
            redirect(base_index_url() . 'login');
            
        }
        $this->CI =& get_instance();
        $this->CI->load->model('users');
        $this->CI->load->model('common');
    }
    
    public function index()
    {
        /*$user = $this->CI->users->get_user_info(2);
        echo "Hello " . $user['name'];
        echo asset_url() ;*/
        $this->load->view('header');
        $this->load->view('login');
    }
    
    public function edit($id)
    {
        if ($this->input->post()) {
            $email           = $this->input->post('email');
            $firstname       = $this->input->post('firstname');
            $default_msg        = $this->input->post('default_msg');
            $password        = $this->input->post('password');
            $feedbackurl = $this->input->post('feedbackurl');
            $show_field     = ($this->input->post('show_field')=='on')?1:0;
            /********** FILE UPLOAD ***********/
            
            $data   = array(
                'email' => $email,
                'firstname' => $firstname,
                'password' => $password,
                'msg_default' => $default_msg,
                'feedbackurl' => $feedbackurl,
				'show_name_field' => $show_field,
            );
            $id     = $id;
            $update = $this->CI->common->update('users', $id, $data);
            $this->session->set_userdata(array(
                'msg' => 'User updated successfully'
            ));
        redirect(base_index_url() . 'home');
        }
        
    }
    public function deleteRecord($id)
    {
        $this->CI->common->delete_row('users', array(
            'id' => $id
        ));
    }
} 