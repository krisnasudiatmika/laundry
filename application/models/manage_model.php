
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Manage_model extends CI_Model {
	public function delete_cust($id){
		
		$this->db->delete('customer', array('id_customer' => $id));
	}
	public function get_data_transaksi(){
		$this->db->select("*");
		$this->db->from("transaksi");
		$query = $this->db->get();
		if($query -> num_rows() > 0 ){
		foreach($query->result_array() as $row){
			$data[] = array(
				'tanggal_masuk' => $row['tanggal_masuk'],
				'tanggal_ambil' => $row['tanggal_ambil'],
				'id_customer' => $row['id_customer'],
				'kode_item' => $row['kode_item'],
				'grand_total' => $row['grand_total'],
				'qty' => $row['qty'],	
				'pembayaran' => $row['pembayaran'],
				'status' => $row['status']
				
			);
			
			
		}
		$data_json = json_encode($data);
		return $data_json;
		}else {
			echo('<div class="alert alert-warning" role="alert">Data Tidak Ditemukan</div>');
		}
		
		
	}
}