<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room_model extends CI_Model {

	private $table_phong = 'phong';
	private $table_giaPhong = 'gia_phong';
	private $table_thuePhong = 'thue_phong';

	public $emptyRoom = null;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->db->where('thue_id =',0);
		$this->emptyRoom =  $this->db->get($this->table_phong)->result();
		
		foreach ($this->emptyRoom as $p) {
			$p->don_gia = $this->getRoomPrice($p->loai_phong);
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

		public function frm_input($fld){

			return '<div class="form-group">
			<label for="">'.$fld.'</label>
			<input type="text" class="form-control" id="'.$fld.'" name="'.$fld.'" value="" placeholder= "'.$fld.'">
		</div>';
	}

	public function checkin_frm(){
		$str = '<form action="" method="POST" role="form">';
		$str.= $this->frm_input('phong_so');
		$str.= $this->frm_input('ten_khach');
		$str.= $this->frm_input('ten_khach');
		$str.= $this->frm_input('pid');
		$str.= $this->frm_input('ngay_vao');
		$str.='<div class="form-group">
		<label for="">label</label>
		<input type="date" class="form-control" id="birthday" name="birthday" placeholder="Input field">
	</div><button type="submit" class="btn btn-primary">Submit</button></form>';
	return $str;
}
}	
/* End of file room_model.php */
/* Location: ./application/models/room_model.php */