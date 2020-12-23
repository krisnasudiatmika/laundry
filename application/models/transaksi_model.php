
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {
	public function getjson(){
		$this->db->select("*");
		$this->db->from("item");
		$query = $this->db->get();

		foreach($query->result_array() as $row){
			$data[] = array(
				'item_name' => $row['item_name'],
				'label' => $row['item_name'],
				'price' => $row['price']
			);


		}

		$data_json = json_encode($data);
		return $data_json;
	}

	public function get_cust_data(){
		$this->db->select("*");
		$this->db->from("customer");
		$query = $this->db->get();

		if($query -> num_rows() > 0){
		return $query->result();
		}else {
			echo('<div class="alert alert-warning" role="alert">Data Tidak Ditemukan</div>');
		}


	}

	public function get_new_price($id_cust){
		 $this->db->join('item','item.No =  new_price.id_item');
		 $this->db->where("new_price.id_customer",$id_cust);
		 $query = $this->db->get("new_price");
		 if($query->num_rows() >= 1){
			foreach($query->result_array() as $row){
			$data[] = array(
				'item_name' => $row['item_name'],
				'label' => $row['item_name'],
				'price' => $row['new_price']

			);

		$data_json = json_encode($data);

		echo($data_json);
		}
		 }else{
			 echo($this->getjson());
		 }


	}

	public function get_member($id){
		$this->db->where('id_customer',$id);
		$this->db->join('item','item.No =  new_price.id_item');

		$query = $this->db->get('new_price');
		if($query-> num_rows() > 0 ){
		foreach($query->result_array() as $row){
			$data[] = array(
				'id_item' => $row['id_item'],
				'item_name' => $row['item_name'],
				'new_price' => $row['new_price']


			);

		}
		$data_json = json_encode($data);

		echo($data_json);
		}else {
			return false;
		}


	}
	function count_items(){
        return $this->db->count_all('transaksi');
    }

    function get_items($limit, $offset){
        $data = array();
        $this->db->limit($limit, $offset);
        $Q = $this->db->get('transaksi');
        if($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
}
