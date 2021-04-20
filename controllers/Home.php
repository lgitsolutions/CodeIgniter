<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
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
        $this->CI->load->model('common');
        
    }
    /***** LOGOUT *********/
    public function logout()
    {
        $this->session->unset_userdata('user_info');
        $this->session->set_userdata(array(
            'msg' => 'You are successfully logged out.'
        ));
        redirect(base_index_url() . 'login');
    }
    
    
    public function index()
    {
        $sess_id = $this->session->userdata('user_info');
        $userInfo             = $this->session->userdata('user_info');
        $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users', array(
            'id' => $userInfo['id']
        ));
        $data->actionlink     = base_index_url() . 'user/edit/' . $userInfo['id'];
        $head->heading        = 'Admin Home';
        $this->load->view('header', $head);
        $this->load->view('sidebar', $sidebar);
        $this->load->view('profile/profile', $data);
        $this->load->view('footer', $js);
        $this->session->unset_userdata('msg');
        
    }
    
    public function home()
    {
        echo 'hi';
    }
}