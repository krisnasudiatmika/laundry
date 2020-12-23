
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class User extends CI_Model {
	public function get_data(){
		$this->db->select("*");
		$this->db->from("user");
		$query = $this->db->get();
		
		return $query;
	} 
	public function login_user_model($u,$p){
		
		$this->db->where("username",$u);
		$this->db->where("password",$p);
		$query = $this->db->get('user');
		
		if($query->num_rows() > 0){
			foreach($query->result() as $rows){
				$sess = array(
					'username' => $rows->username
				
				);
			}
			
			$this->session->set_userdata($sess);
			redirect('home');
			
		}
		else {
			echo('Tidak Ada Data');
		}
		
		}
		
	public function register_user(){
		
	}
	}
	
	
	
