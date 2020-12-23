
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {


	public function index(){
		$this->load->view('header');
		$this->load->view('nav');

		$this->load->model('transaksi_model');

		$data['data_json'] = $this->transaksi_model->getjson();
		$data['data_cust_json'] = $this->transaksi_model->get_cust_data();



		$this->load->view('transaksi_page', $data);

		$this->load->view('footer');
	}
	public function testing(){
		$item_name = $this->input->post('item_name');
		$item_kode = $this->input->post('item_kode');
		$trans_total = $this->input->post('trans_total');
		$trans_id_cust = $this->input->post('trans_id_cust');
		$tgl_masuk = $this->input->post('tgl_masuk');
		$tgl_selesai = $this->input->post('tgl_selesai');
		$pembayaran = $this->input->post('pembayaran');
		$pewangi = $this->input->post('pewangi');
		$status = $this->input->post('status');

		if(isset($item_name)){
			for($count = 0; $count<count($item_name); $count++){
			echo($item_name[$count]);
					$data = array(
						'item_kode' => $item_kode,
			        'item_nama' => $item_name[$count]
			       );
			       $this->db->insert('item_order', $data);
			}
			$query = array(
			'id_customer' => $trans_id_cust,
			'kode_item' => $item_kode,
			'grand_total' => $trans_total,
			'tanggal_masuk' => $tgl_masuk,
			'tanggal_ambil' => $tgl_selesai,
			'pembayaran' => $pembayaran,
			'pewangi' => $pewangi,
			'status' => $status

		);
		$this->db->insert('transaksi', $query);

		}



	}



	public function save_db(){
		$store_id ="";

		$id = $this->db->query("SELECT max(right(id_customer,4)) as hasil FROM customer");

		foreach ($id->result() as $row)
			{
			        $new_id =  $row->hasil;


			}

			$new_id = $new_id + 1 ;
		$create_id = str_pad($new_id, 10,'0',STR_PAD_LEFT);
		$store_id .= 'CS'. $create_id;


		echo $store_id;

		}

	public function cek_hargabaru(){
		$id = $this->input->post('id');
		$this->load->model('transaksi_model');
		$data['price_list'] = $this->transaksi_model->get_new_price($id);

	}
	public function get_data_member(){
		$id = $this->input->post('id');
		$this->load->model('transaksi_model');
		$this->transaksi_model->get_member($id);
	}

	public function save_transaksi(){
		$id = $this->input->post('cust_id');
		$sub_total = $this->input->post('sub_total');
		$tgl_masuk = $this->input->post('tgl_masuk');
		$grand_total = $this->input->post('grand_total');
		$catatan = $this->input->post('catatan');
		$no_nota = $this->input->post('no_nota');
		$qty = $this->input->post('qty');
		$tax = $this->input->post('tax');
		$spot = $this->input->post('spot');
		$expres = $this->input->post('expres');

		$newdate = implode('-', array_reverse(explode('-', $tgl_masuk)));

		$data = array(
			'id_customer' => $id,
			'tanggal_masuk' => $tgl_masuk,
			'grand_total' => $grand_total,
			'sub_total' => $sub_total,
			'catatan' => $catatan,
			'id_transaksi' => $no_nota,
			'qty'=> $qty,
			'tax' => $tax,
			'express' => $expres,
			'spotting' => $spot,
			'newdate' => $newdate
		);
		$this->db->insert('transaksi',$data);
	}
	public function get_no_nota(){
		$new_id="";
		$query = $this->db->query('SELECT max(right(id_transaksi,9)) as hasil FROM transaksi');
		foreach($query -> result() as $row){
			$last_id = $row->hasil;
		}
		$last_id = $last_id + 1 ;
		$create_id = str_pad($last_id, 10,'0',STR_PAD_LEFT);
		$new_id .= ''. $create_id;


		echo $new_id;
	}

	public function add_colom(){
		for($i= 0 ; $i <= 100 ; $i++){
			$data = array(
				'nama' => 'krisna'.$i
			);

			$this->db->insert('customer',$data);
		}
	}

	public function testing_print(){
		$this->load->view('header');
		$this->load->view('printarea');
	}

	public function save_trans_item(){
		$cust_id = $this->input->post('no_nota');
		$item_name = $this->input->post('item_name');
		$item_qty = $this->input->post('item_qty');

		for($count = 0; $count<count($item_name); $count++){

				$data = array(
				'item_trans' => $cust_id,
						'item_kode' => $item_name[$count],
						'item_qty' => $item_qty[$count]

					 );
					 $this->db->insert('item_order', $data);
		}
	}
	public function search_trans(){
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('search_trans');
		$this->load->view('footer');
	}
	public function search_trans_result($trans_no){
	$this->db->where('id_transaksi',$trans_no);
	$this->db->join('item_order','item_order.item_trans = transaksi.id_transaksi');
	$this->db->join('customer','customer.id_customer = transaksi.id_customer');
	$this->db->join('item','item.No = item_order.item_kode');


		$data['query'] = $this->db->get('transaksi');
	
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('search_trans_result',$data);
		$this->load->view('footer');
	}
	public function get_new_price(){
		$trans_cust = $this->input->post('cust_id');
		$trans_item = $this->input->post('item_id');
		$this->db->where('id_customer',$trans_cust);
		$this->db->where('id_item',$trans_item);
		$result = $this->db->get('new_price')->row();
		echo $result->new_price;

	}
	public function cek_comma(){
		$this->load->view('header');
		$this->load->view('cek_comma');
		$this->load->view('footer');

	}
	}
