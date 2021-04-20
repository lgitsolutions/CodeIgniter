<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class Messages extends CI_Controller
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
       
        $fetch = array('sender'=>$userInfo['twilio_number']);
        $dataa->messages = $this->CI->common->fetchallWhere('message',$fetch);
        $head->heading  = 'Messages List';
        $this->load->view('header', $head);
        $this->load->view('sidebar', $sidebar);
        $this->load->view('messages/lists', $dataa);
        $this->load->view('footer');
    }
    
    public function deleteRecord($id)
    {
        $this->CI->common->delete_row('users', array(
            'id' => $id
        ));
    }
} 