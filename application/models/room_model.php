<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room_model extends CI_Model {

	private $table_phong = 'phong';
	private $table_giaPhong = 'gia_phong';
	private $table_thuePhong = 'thue_phong';

	public $emptyRoom = null;
	public $guestRoom = null;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->db->where('thue_id =',0);
		$this->emptyRoom =  $this->db->get($this->table_phong)->result();
		
		foreach ($this->emptyRoom as $p) {
			$p->don_gia = $this->getRoomPrice($p->loai_phong);
		}

		$this->db->where('thue_id >',0);
		$this->guestRoom =  $this->db->get($this->table_phong)->result();
		
		foreach ($this->guestRoom as $p) {
			$p->don_gia = $this->getRoomPrice($p->loai_phong);
			$p->ngay_vao = $this->billById($p->thue_id)->ngay_vao;
			$p->ten_khach = $this->billById($p->thue_id)->ten_khach;
			$p->pid = $this->billById($p->thue_id)->pid;
			$p->gioi_tinh = $this->billById($p->thue_id)->gioi_tinh;
			$checkOut = '<a href="http://localhost/myhotel/index.php/room_rent/checkout/'.$p->thue_id.'" class="btn btn-primary">'.$p->so_phong.'</a>';
			$p->checkout=$checkOut;
		}
	}

	public function getAllRoom(){
		$this->db->distinct();
		$query = $this->db->get($this->table_phong);
		return $query->num_rows() > 0 ? $query->result() : NULL;
	}

	// Input: 1 array and all data field (fld) want to show
	public function printTBL($array= null, $fld=null){
		//$array= $this->g_emptyRoom();
		//$fld = ['so_phong','loai_phong','thue_id']; // can use to show more column

		$str = '<table class="table table-striped table-hover">
		<thead>';
			$str.='<tr>';
			foreach ($fld as $fl) {
				$str.= '<th>'.$fl.'</th>';
			}
			$str.='</tr>';
			$str.='</thead>';
			$str.='<tbody>';
			foreach ($array as $p) {
				$str.='<tr>';
				foreach ($fld as $key => $value) {
					$str .= '<td>'.$p->{$fld[$key]}.'</td>';
				}
				$str.='</tr>';
			}
			$str.='</tbody></table>';
			return $str;
		}

	// public function g_emptyRoom(){
	// 	$this->db->where('thue_id =',0);
	// 	$this->emptyRoom =  $this->db->get($this->table_phong)->result();

	// 	foreach ($this->emptyRoom as $p) {
	// 		$p->don_gia = $this->getRoomPrice($p->loai_phong);
	// 	}
	// }

		public function getEmptyRoom(){
			return $this->printTBL($this->emptyRoom, ['so_phong','loai_phong','don_gia']);
		}

		public function getRoomPrice($roomType){
			$this->db->where('loai_phong',$roomType);
			return $this->db->get($this->table_giaPhong)->result()[0]->don_gia;
		}

		public function frm_input($fld)
		{
			return '<div class="form-group">
						<label for="">'.$fld.'</label>
						<input type="text" class="form-control" id="'.$fld.'" name="'.$fld.'" value="" placeholder= "'.$fld.'">
					</div>';
		}

	public function checkin_frm()
	{
		$str = '<form action="http://localhost/myhotel/index.php/room_rent/doCheckIn" method="POST" role="form">';
		$str.= $this->frm_input('phong_so');
		$str.= $this->frm_input('ten_khach');
		$str.= $this->frm_input('gioi_tinh');
		$str.= $this->frm_input('pid');
		$str.= $this->frm_input('tien_coc');
		$str.='<div class="form-group"> <label for="">ngay_vao</label>
					<input type="date" class="form-control" id="ngay_vao" name="ngay_vao" placeholder="Input field">
				</div><button type="submit" class="btn btn-primary">CheckIn</button></form>';
		return $str;
	}

	//******************************************************************************************************************88
	public function getGuestRoom(){
		return $this->printTBL($this->guestRoom, ['checkout','ten_khach','pid', 'gioi_tinh','ngay_vao']);
	}

	public function billById($thue_id){
		$this->db->where('id',$thue_id);
		return $this->db->get($this->table_thuePhong)->result()[0];
	}

	public function frm_input2($fld,$bill)
		{
			return '<div class="form-group">
						<label for="">'.$fld.'</label>
						<input type="text" class="form-control" id="'.$fld.'" name="'.$fld.'" value="'.$bill->{$fld}.'" placeholder= "'.$fld.'">
					</div>';
		}

	public function room_price_by_no($so_phong){
		$this->db->where('so_phong',$so_phong);
		return $this->getRoomPrice($this->db->get($this->table_phong)->result()[0]->loai_phong);
	}

	public function checkout_frm()
	{
		$thue_id = $this->uri->segment(3); // BIll ID
		$bill = $this->billById($thue_id);

		$bill->don_gia = $this->room_price_by_no($bill->phong_so);
		$diff = abs(strtolower(date("Y-m-d")) - strtotime($bill->ngay_vao));
		$diff = floor($diff*3600*24);
		if($diff == 0){
			$diff = 1;
		}
		$bill->tien_phong = $diff*$bill->don_gia;

		$fld1 = ['id','phong_so','ten_khach','pid','gioi_tinh','ngay_vao'];
		$fld2 = ['tien_coc','tien_phong','tien_mini_bar','tien_khac','ghi_chu'];
		
		$str = '<form action="http://localhost/myhotel/index.php/room_rent/doCheckout/'.$thue_id.'" method="POST" role="form">';

		foreach ($fld1 as $f) {
			$str.= $this->frm_input2($f,$bill);
		}
		$str.='<div class="form-group"> <label for="">ngay_ra</label>
					<input type="date" class="form-control" id="ngay_ra" name="ngay_ra" value="'.date("Y-m-d").'" placeholder="Input field">
				</div>';

		foreach ($fld2 as $f) {
			$str.= $this->frm_input2($f,$bill);
		}
		$str.='<button type="submit" class="btn btn-primary">CheckOut</button></form>';

		return $str;
	}
}	
/* End of file room_model.php */
/* Location: ./application/models/room_model.php */