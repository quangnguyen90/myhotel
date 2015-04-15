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
		$data = array();
		$data['room'] = $this->room_model->getAllRoom();
		var_dump($data['room']);
	}

	public function checkIn()
	{
		$data = array();
		$data['phongConTrong'] =  $this->room_model->getEmptyRoom();
		$data['checkInForm'] =  $this->room_model->checkin_frm();
		$this->load->view('v_checkIn', $data, false);
	}

}

/* End of file room_rent.php */
/* Location: ./application/controllers/room_rent.php */