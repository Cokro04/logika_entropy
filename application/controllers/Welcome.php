<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	// public $sa;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Data');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function entropy()
	{
		$where = 111603;
		$data_criteria = $this->Data->get_criteria($where);
		$data_sum = $this->Data->sumdata($where);
		if ($data_sum->num_rows() > 0) {

			$criteria = $data_sum->row();
			$urgensi = $criteria->urgensi;
			$psd = $criteria->psd;
			$qty = $criteria->qty;
			$standard_time = $criteria->stt;
			$setup_time = $criteria->sut;
		}
		$criteria1 = 0;
		$criteria2 = 0;
		$criteria3 = 0;
		$criteria4 = 0;
		$criteria5 = 0;
		$totalAlternatif = count($data_criteria);
		$N = (-1 / log($totalAlternatif));
		// $count = 0;
		$hasil = array();
		foreach ($data_criteria as $row) {
			$hasil[] = array(
				$criteria1 += $row->urgensi / $urgensi * log($row->urgensi / $urgensi),
				$criteria2 += $row->psd / $psd * log($row->psd / $psd),
				$criteria3 += $row->qty / $qty * log($row->qty / $qty),
				$criteria4 += $row->setup_time / $setup_time * log($row->setup_time / $setup_time),
				$criteria5 += $row->standard_time / $standard_time * log($row->standard_time / $standard_time)
			);
		}
		$nilaitotal_ej = ((1 - ($N * $criteria1)) + (1 - ($N * $criteria2)) + (1 - ($N * $criteria3)) + (1 - ($N * $criteria4)) + (1 - ($N * $criteria5)));
		// print_r($nilaitotal_ej);

		$urgensi_w = ((1 - ($N * $criteria1)) / $nilaitotal_ej);
		$psd_w = ((1 - ($N * $criteria2)) / $nilaitotal_ej);
		$qty_w = ((1 - ($N * $criteria3)) / $nilaitotal_ej);
		$sut_w = ((1 - ($N * $criteria4)) / $nilaitotal_ej);
		$stt_w = ((1 - ($N * $criteria5)) / $nilaitotal_ej);
		$total_w = (((1 - ($N * $criteria1)) / $nilaitotal_ej) + ((1 - ($N * $criteria2)) / $nilaitotal_ej) + ((1 - ($N * $criteria3)) / $nilaitotal_ej) + ((1 - ($N * $criteria4)) / $nilaitotal_ej) + ((1 - ($N * $criteria5)) / $nilaitotal_ej));

		$data = array(
			'urgensi' => $urgensi_w,
			'psd' => $psd_w,
			'qty' => $qty_w,
			'sut' => $sut_w,
			'stt' => $stt_w,
			'total' => $total_w
		);

		// $coba['data'] = $qty;
		$this->load->view('welcome_message', $data);
	}

	public function hore()
	{

		$da = $this->Data->getdata('tbl_operator');
		// $length = sizeof($da);
		// $data = $da->result_array();
		// $sa = $data[0]["nama_lengkap"];
		// echo $length;

		$a = 1;
		foreach ($da->result_array() as $row) {
			$data[] = $row['nama_lengkap'];
			// $copet[] = $data[$a++];
			$length = count($data);
			for ($i = 0; $i < $length; $i++) {
				${"location" . ($a++)} = $data[$a];
			}
			echo $location;
			// for ($i = 0; $i < count($da); $i++) {
			// $data = $row["nama_lengkap"];
			// echo ($length);
			// extract($data);
			// print_r(explode(" ", $data));
			// echo json_encode($data);
			// echo $i++;
			// echo json_encode($data[$a++]);
			// }
		}



		// for ($i = 0; $i < count($da); $i++) {
		// 	echo implode(" ", $da[$i]) . "<br>";
		// }
		// $data = array();
		// foreach ($da as $row) {
		// 	$data[] = array(
		// 		$row->nama_lengkap
		// 	);
		// }
		// print_r($data);

		// for($i=0; $i < count($barang); $i++){
		// 	echo $barang[$i]."<br>";
		// }
	}
	public function da()
	{
		$l = array('name1', 'name2', 'name3', 'name4');
		$length = sizeof($l);
		for ($i = 0; $i < $length; $i++) {
			${"location" . ($i + 1)} = $l[$i];
		}
		$location1 = 'saya';
		echo "$location1<br />$location2<br />$location3<br />$location4<br />";
	}
}
