<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {

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
   $this->CI->load->model('users');   $this->CI->load->model('common');
 }

  public function index() {
        redirect(base_index_url().'home');
    }
/*********** List of Users **********/  public function lists() {	 $userInfo = $this->session->userdata('user_info');	 $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users',array('id'=>$userInfo['id']));	  		  $dataa->listing =  $this->CI->common->fetchall('roles');	   $head->heading = 'Roles List';       $this->load->view('header',$head);	   $this->load->view('sidebar',$sidebar); 	   $this->load->view('role/list',$dataa); 	   $this->load->view('footer');		    }	/********** Add Retailer ************/	public function addRole(){		$userInfo = $this->session->userdata('user_info');	 $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users',array('id'=>$userInfo['id']));	  	 	 	  $head->heading = 'Add Role';		$records->actionlink = base_index_url().'role/save';	 	$this->load->view('header',$head);	   $this->load->view('sidebar',$sidebar); 	   $this->load->view('role/add_edit',$records); 	   $this->load->view('footer',$js);	}	/************* Save User *******/	public function save(){	  	     $roletype = $this->input->post('roletype'); 	     $user_capabilities = $this->input->post('user_capabilities'); 	  				$data = array(					'role' => $roletype,					'capabilities' => @implode(",",$user_capabilities)										);		$this->CI->common->form_insert('roles',$data);			$this->session->set_userdata(array('msg'=>'Role Add Successfully.')); 		redirect(base_index_url().'role/lists');		/* }else{			echo 'error in uploading.';		} */			}				public function edit($id){		if($this->input->post())    	{			  $roletype = $this->input->post('roletype'); 	     $user_capabilities = $this->input->post('user_capabilities'); 								$data = array(					'role' => $roletype,					'capabilities' => @implode(",",$user_capabilities)					);			$id = $id;						$update = $this->CI->common->update('roles',$id,$data);		$this->session->set_userdata(array('msg'=>'Role updated successfully'));			}		$userInfo = $this->session->userdata('user_info');	 $sidebar->currentuser = $head->currentuser = $dataa->currentuser = $this->CI->common->get_row('users',array('id'=>$userInfo['id']));	  	 	 	  $head->heading = 'Edit Role';		$records->actionlink = base_index_url().'role/edit/'.$id;	 $records->record = $this->CI->common->get_row('roles',array('id'=>$id));	 $records->msg = $this->session->userdata('msg');	 	$this->load->view('header',$head);	   $this->load->view('sidebar',$sidebar); 	   $this->load->view('role/add_edit',$records); 	   $this->load->view('footer',$js);		}				
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */