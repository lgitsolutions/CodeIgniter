<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Model {

  
    function __construct() {
	$this->load->database();
    }
	
	
	function form_insert($table,$data){
		$this->db->insert($table, $data);
		}
		
	function fetchall($table){
		$records = $this->db->select('*')->get($table);
		return $records->result();
		}
	function fetchallWhere($table,$data){
		$record = $this->db->get_where($table,$data);
		return $record->result();
		}		
function fetchResult($table,$data,$field,$asc, $limit, $offset){
	
 $query = $this->db->order_by($field, $asc)->get_where($table, $data, $limit, $offset);
//$this->db->order_by($field, $asc);
	//$query = $this->db->get();
	return $query->result();
}	
	
	function get_row($table,$data){
		$record = $this->db->get_where($table,$data);
		return $record->result();
		
		}	
		
	function update($table,$id,$data){
		
		$this->db->where('id', $id);
		$this->db->update($table, $data);

		}
    function update_counts($table,$doctor_id,$data){
        $query1 = $this->db->get_where('sent_messages',array('doctor_id'=>$doctor_id));
        $check = $query1->result();
        if(!empty($check)){
            $query = "UPDATE `sent_messages` SET `msg_count` = `msg_count`+1 WHERE `doctor_id` = '".$doctor_id."'";
            $this->db->query($query);
            }else{
                $insert = array(
                    'msg_count' => 1,
                    'doctor_id' => $doctor_id
                );
                $this->db->insert('sent_messages',$insert);
            }
		//$this->db->update($table, $data);

		}
function get_row_of_table($tbl,$data){
		$record = $this->db->get_where($tbl,$data);
		return $record->row_array();
		
		}
		
function delete_row($table,$data){
		$this->db->delete($table, $data); 
	}		

function check_records(){
    $query = "SELECT id FROM `users` WHERE  `update_msg_date` = '".date('Y-m-d')."' ";
    $records = $this->db->query($query);
    return $records->result();
}
	

	
}