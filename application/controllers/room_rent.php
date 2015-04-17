<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room_rent extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('room_model');
	}
	public function index()
	{
		// $data = array();
		// $data['room'] = $this->room_model->getAllRoom();
		// var_dump($data['room']);
		redirect('room_rent/checkIn');
	}

	public function checkIn()
	{
		$data = array();
		$data['phongConTrong'] =  $this->room_model->getEmptyRoom();
		$data['checkInForm'] =  $this->room_model->checkin_frm();
		$this->load->view('v_checkIn', $data, false);
	}

	public function doCheckIn(){
		// Add room being rent
		$object = array(
			'phong_so' => $this->input->post('phong_so'),
			'ten_khach' => $this->input->post('ten_khach'),
			'pid' => $this->input->post('pid'),
			'gioi_tinh' => $this->input->post('gioi_tinh'),
			'tien_coc' => $this->input->post('tien_coc'),
			'ngay_vao' => $this->input->post('ngay_vao'),
		);

		$this->db->insert('thue_phong', $object);
		//===============
		//Make room being rent
		$this->db->where('so_phong', $this->input->post('phong_so'));
		$object = array(
			'thue_id' => $this->db->insert_id(),
		);
		$this->db->update('phong', $object);
		redirect('http://localhost/myhotel/index.php/room_rent/checkIn', 'refresh');
	}

	public function checkout(){
		$data = array();
		$data['phongCoKhach'] =  $this->room_model->getGuestRoom();
		if($this->uri->segment(3) != "x"){
			$data['checkOutForm'] =  $this->room_model->checkout_frm();
		}
		$this->load->view('v_checkout', $data, false);
	}

	public function doCheckout(){
		$this->db->where('so_phong', $this->input->post('phong_so'));
		$object = array(
			'thue_id' => 0,
		);
		$this->db->update('phong', $object);
		redirect('http://localhost/myhotel/index.php/room_rent/checkout/x', 'refresh');
	}

}

/* End of file room_rent.php */
/* Location: ./application/controllers/room_rent.php */