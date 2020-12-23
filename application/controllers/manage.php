
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {
	function __construct() {
parent::__construct();
$this->load->model('transaksi_model');
$this->load->library('pagination');
}
	public function customer(){
		$this->load->view('header');
		$this->load->view('nav');
		$this->db->select('*');
		$this->db->from('customer');
		$query = $this->db->get();

		$data['result'] = $query -> result();
		$this->load->view('manage_customer_page',$data);

		$this->load->view('footer');

	}
	public function delete_customer(){
		$id = $this->input->post('id_customer');
		$this->load->model('manage_model');
		$this->manage_model->delete_cust($id);
	}
	public function update_customer(){
		$id = $this->input->post('id_customer');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$tlp = $this->input->post('telepon');
		$kota = $this->input->post('kota');
		$data = array(
		'nama' => $nama,
		'alamat' => $alamat,
		'telepon' => $tlp,
		'kota' => $kota
		);
		$this->db->update('customer', $data, array('id_customer' => $id));
	}
	public function update_manage(){
		$tgl_masuk = $this->input->post('src_tglMasuk');
		$tgl_selesai = $this->input->post('src_tglSelesai');
		$id = $this->input->post('id_customer');
		$data = array(
			'tanggal_masuk' => $tgl_masuk,
			'tanggal_ambil' => $tgl_selesai
		);

		$this->db->update("transaksi",$data,"id_customer = '$id'");
	}
	public function semua_transaksi(){
		$tgl_masuk = $this->input->get('tgl_masuk');
		$tgl_selesai = $this->input->get('tgl_selesai');
		$cari = $this->input->get('cari');
		$nama = $this->input->get('nama_vila');
		if(isset($tgl_masuk) && isset($tgl_selesai) && isset($cari)){

			$date_array = explode("-",$tgl_masuk); // split the array
			$var_day = $date_array[0]; //day seqment
			$var_month = $date_array[1]; //month segment
			$var_year = $date_array[2]; //year segment
			$new_tgl_masuk = "$var_year-$var_month-$var_day";

			$date_array = explode("-",$tgl_selesai); // split the array
			$var_day = $date_array[0]; //day seqment
			$var_month = $date_array[1]; //month segment
			$var_year = $date_array[2]; //year segment
			$new_tgl_selesai = "$var_year-$var_month-$var_day";



			$this->db->select('*');
			$this->db->where('id_customer', $cari);
			$this->db->where("DATE(newdate) BETWEEN '$new_tgl_masuk' AND '$new_tgl_selesai'");
			$query = $this->db->get('transaksi');
			$data['result'] = $query->result();

			$this->db->select_sum('grand_total');
			$this->db->where('id_customer', $cari);
			$this->db->where("DATE(newdate) BETWEEN '$new_tgl_masuk' AND '$new_tgl_selesai'");
			$query = $this->db->get('transaksi');
			$data['total_invoice'] = $query->row()->grand_total;
			$data['tgl_masuk'] =$tgl_masuk;
			$data['tgl_selesai'] =$tgl_selesai;
			$data['cari']=$cari;
			$data['nama'] =$nama;

			$this->load->view('header');
			$this->load->view('nav');
			$this->load->view('search_villa',$data);


		} else {
				$this->load->library('pagination');
        $this->load->library('table');
        $this->load->model('transaksi_model');

        $result_per_page = 10;  // the number of result per page

        $config['base_url'] = base_url() . '/manage/semua_transaksi/';
        $config['total_rows'] = $this->transaksi_model->count_items();
        $config['per_page'] = $result_per_page;
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';

				$config['first_link'] = 'First';
				$config['first_tag_open'] = '<li class="page-item">';
				$config['first_tag_close'] = '</li>';

				$config['last_link'] = 'Last';
				$config['last_tag_open'] = '<li class="page-item">';
				$config['last_tag_close'] = '</li>';

				$config['next_link'] = 'Next';
				$config['next_tag_open'] = '<li class="page-item">';
				$config['next_tag_close'] = '</li>';

				$config['prev_link'] = 'Prev';
				$config['prev_tag_open'] = '<li class="page-item">';
				$config['prev_tag_close'] = '</li>';

				$config['cur_tag_open'] = '<li class="active"><a>';
				$config['cur_tag_close'] = '</a></li>';

				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);
				$msg = $this->session->flashdata('msg');

        $datatable = $this->transaksi_model->get_items($result_per_page, $this->uri->segment(3));
				$this->load->view('header');
				$this->load->view('nav');
				$this->load->view('header_filter_villa',array('msg' => $msg ));
        $this->load->view('pagination_view', array(
            'datatable' => $datatable,
            'result_per_page' => $result_per_page,
						'msg' => $msg,
						'data_json' => $this->transaksi_model->getjson(),
						'data_cust_json' => $this->transaksi_model->get_cust_data()

        ));
				$this->load->view('footer');
			}
	}
	public function edit_transaksi($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$result = $this->db->get('transaksi');
		$data['query'] = $result->result();
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('edit_transaksi_page',$data);
		$this->load->view('footer');


	}
	public function simpan_edit_tgl(){
		$id = $this->input->post('id');
		$tanggal = $this->input->post('tanggal');
		$date_array = explode("-",$tanggal); // split the array
		$var_day = $date_array[0]; //day seqment
		$var_month = $date_array[1]; //month segment
		$var_year = $date_array[2]; //year segment
		$tanggal = "$var_year-$var_month-$var_day";
		$data = array(
        'newdate' => $tanggal

		);
		$this->db->where('id',$id);
		$this->db->update('transaksi', $data);
		$this->session->set_flashdata('msg','Sukses');
		redirect('manage/semua_transaksi');
	}
	public function hapus_transaksi($id){
		$this->db->delete('transaksi',array('id' => $id));
		$this->session->set_flashdata('msg','Transaksi Berhasil Di Hapus');
		$msg = $this->session->flashdata('msg');
		redirect('manage/semua_transaksi');
	}

	public function transaksi(){
		$this->load->model('manage_model');
		$data['json'] = $this->manage_model->get_data_transaksi();
		$this->load->view('header');
		$this->load->view('nav');
		$this->db->select('*');
		$this->db->from('transaksi', $data);
		$query = $this->db->get();
		$this->load->model('transaksi_model');
		$data['result'] = $query -> result();
		$data['data_json'] = $this->transaksi_model->getjson();
		$data['data_cust_json'] = $this->transaksi_model->get_cust_data();
		$this->load->view('manage_transaksi_page',$data);

		$this->load->view('footer');


	}
	public function tes_print(){
		$this->load->view('print_page');
	}
	public function filter_result(){
		$term = $_REQUEST['term'];
		$tgl_masuk = $_REQUEST['tgl_masuk'];
		$tgl_selesai = $_REQUEST['tgl_selesai'];

		$tglmasuk = implode('-', array_reverse(explode('-', $tgl_masuk)));
		$tglselesai = implode('-', array_reverse(explode('-', $tgl_selesai)));

				$get_data = array(
			'nama' => $term,
			);

		$this->db->where($get_data);
		$this->db->where("newdate BETWEEN '$tglmasuk' AND '$tglselesai'");
		$this->db->join('customer', 'customer.id_customer = transaksi.id_customer');
		$data['query'] = $this->db->get('transaksi');

		$this->load->view('search_result',$data);

	}

	public function testing_date(){
		$this->load->view('header');
		$this->db->select('*');
		$this->db->join('customer', 'customer.id_customer = transaksi.id_customer');

		$data['query'] = $this->db->get('transaksi');
		$this->load->view('datetime_page',$data);
		$this->load->view('footer');
	}

	public function all_result(){
		$this->load->library('pagination');


		$data['base_url'] = base_url('manage/transaksi');
		$data['total_rows'] = $this->db->get('transaksi')->num_rows();
		$data['per_page'] = 3;
		$data['num_links'] = 4;
		$this->pagination->initialize($data);
		$this->db->select('*');
		$this->db->join('customer', 'customer.id_customer = transaksi.id_customer');

		$data['query'] = $this->db->get('transaksi');


		$this->load->view('search_result',$data);

	}
	public function item_save(){
		$item_name = $this->input->post('item_name');
		$price = $this->input->post('item_price');
			$data = array(
			'item_name' => $item_name,
			'price' => $price
		);

		$this->db->insert('item',$data);
	}

	public function item(){
		$this->load->view('header');
		$this->load->view('nav');
		$this->db->select('*');
		$query['data']= $this->db->get('item');

		$this->load->view('manage_item_page',$query);

		$this->load->view('footer');
	}
	public function add_data_item(){
		$item_name = $this->input->post('item_name');
		$price_val = $this->input->post('price_item');
		$id_cust = $this->input->post('id_cust');
		$item_id = $this->input->post('item_id');
		$nama_cust= $this->input->post('nama_cust');
		$alamat_cust = $this->input->post('alamat_cust');
		$tlp_cust = $this->input->post('tlp_cust');
		$kota =$this->input->post('kota');



		if(isset($item_name)){
			for($count = 0; $count<count($item_name); $count++){

					$data = array(
					'id_customer' => $id_cust,
			        'id_item' => $item_id[$count],
			        'new_price' => $price_val[$count]
			       );
			       $this->db->insert('new_price', $data);
			}

			$data_cust = array(
				'id_customer' => $id_cust,
				'nama' => $nama_cust,
				'alamat' => $alamat_cust,
				'telepon' => $tlp_cust,
				'kota' => $kota
			);
			$this->db->insert('customer',$data_cust);

		}



	}
	public function get_item_id(){
		$this->db->select('*');
		$query = $this->db->get('item');
		foreach($query->result() as $row){
			$result[] = array(
				'id_item' => $row->No,
				'item_name' => $row->item_name

			);
		}

		echo json_encode($result);
	}
	public function manage_customer(){
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->model('transaksi_model');



		$data['data_json'] = $this->transaksi_model->getjson();
		$data['data_cust_json'] = $this->transaksi_model->get_cust_data();
		$this->load->view('manage_member',$data);
		$this->load->view('footer');
	}

	public function get_cust_item(){
		$id = $this->input->post('id');
		$this->db->join('item','item.No = new_price.id_item');
		$this->db->where('id_customer',$id);
		$data['query'] = $this->db->get('new_price');
		$data['id_cust'] = $id;
		$this->load->view('manage_customer_table',$data);
	}
	public function update_price_cust(){
		$id_cust = $this->input->post('id_cust');
		$id_item = $this->input->post('id_item');
		$new_price = $this->input->post('new_price');
		$data = array(
			'new_price' => $new_price
		);

		$this->db->where('id_customer',$id_cust);
		$this->db->where('id_item',$id_item);
		$this->db->update('new_price',$data);
		$this->db->get('new_price');

	}
	public function add_cust_item(){
		$id = $this->input->post('id');
		$item_name = $this->input->post('item_name');
		$item_price = $this->input->post('item_price');

		$this->db->select('*');
		$this->db->where('id_item',$item_name);
		$this->db->where('id_customer',$id);
		$result = $this->db->get('new_price');

		if($result -> num_rows() > 0){
			echo "0";
		}
		else {

		$data = array(
			'id_customer' => $id,
			'id_item' => $item_name,
			'new_price' => $item_price
		);

		$this->db->insert('new_price',$data);
		echo "1";
		}

	}
	public function master_item(){
		$this->db->select('*');
		$query['data'] =$this->db->get('item');
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('manage_master_item',$query);
		$this->load->view('footer');
	}
	public function update_master_item(){
		$id = $this->input->post('id');
		$item_name = $this->input->post('item_name');
		$item_price = $this->input->post('item_price');
		$this->db->where('No',$id);
		$data = array(
			'item_name' => $item_name,
			'price' => $item_price
		);
		$this->db->update('item',$data);
		$this->db->get('item');
	}
	public function delete_master_item(){
		$id = $this->input->post('id');
		$this->db->delete('item',array('No' => $id));

	}
	public function add_master_item(){
		$item_name = $this->input->post('item_name');
		$item_price = $this->input->post('item_price');
		$data = array(
			'item_name' => $item_name,
			'price' => $item_price
		);

		$this->db->insert('item',$data);

	}
	public function save_tanggal(){
		 $id_transaksi = $this->input->post('trans_id');
		  $tgl = $this->input->post('tgl_masuk');
		  $data = array('tanggal_masuk' => $tgl);
		 $this->db->where('id_transaksi',$id_transaksi)->update('transaksi', $data);

		  $this->db->get('transaksi');





	}
	public function delete_transaksi(){
		$id_transaksi = $this->input->post('trans_id');
		$query = $this->db->delete('transaksi',array('id_transaksi' => $id_transaksi));

	}
	public function select_data_item(){
		$this->db->select('*');
		$query = $this->db->get('item');
		foreach ($query -> result() as $row){
			$data[]=array(
			'No' => $row->No,
			'item_name' => $row->item_name,
			'price' => $row->price
			);
		}

		print_r(json_encode($data));

	}
	public function simpan_cust_data(){
		$id = $this->input->post('id');
		$alamat = $this->input->post('alamat');
		$nama = $this->input->post('nama');
		$tlp = $this->input->post('tlp');
		$kota = $this->input->post('kota');

		$data = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'telepon' => $tlp,
			'kota' => $kota
		);
		$this->db->where('id_customer',$id);
		$this->db->update('customer',$data);
	}
	public function show_customer(){
		$this->db->select('*');
		$data['query'] = $this->db->get('customer');
		$this->load->view('manage_tampil_data_cust',$data);
	}
	public function update_item_qty(){
		$nota = $this->input->post('nota');
		$item_kode = $this->input->post('item_kode');
		$item_qty = $this->input->post('item_qty');
		$this->db->where('item_trans', $nota);
		$this->db->where('item_kode', $item_kode);
		$this->db->update('item_order',array('item_qty' =>$item_qty , ));

	}
	public function update_subtotal(){
		$nota = $this->input->post('nota');
		$totalsub = $this->input->post('totalsub');
		$totalgrand = $this->input->post('totalgrand');
		$this->db->where('id_transaksi', $nota);
		$this->db->update('transaksi',array('sub_total' =>$totalsub, 'grand_total' => $totalgrand ));


	}

	public function hapus_trx(){
		$nota = $this->input->post('nota');
		$this->db->delete('transaksi', array('id_transaksi' => $nota));
		$this->db->delete('item_order', array('item_trans' => $nota));
	}
	public function customer_data(){
		$this->load->view('header');
		$this->load->view('nav');
		$this->load->view('manage_customer');
		$this->load->view('footer');
	}
	public function get_data_customer(){
		$id = $this->input->post('id_cust');
		$this->db->select('*');
		$this->db->like('nama',$id );
		$result = $this->db->get('customer');
		$data['query'] = $result->result();
		$this->load->view('manage_customer_result',$data);


	}
	public function hapuscustomer(){
		$id = $this->input->post('id');
		$this->db->delete('customer', array('id_customer' => $id));
	}
	public function updatecustomer(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$tlp = $this->input->post('tlp');
		$kota = $this->input->post('kota');

		$data = array(
		'nama' => $nama,
		'alamat' => $alamat,
		'telepon' => $tlp,
		'kota' => $kota
		);
		$this->db->update('customer', $data, array('id_customer' => $id));


	}

}
