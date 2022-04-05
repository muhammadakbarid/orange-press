<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('dateIna')) {
	function dateIna($data, $simple = false, $getMonth = false)
	{
		// day
		$hari = date("D", strtotime($data));
		$haris = array(
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu',
			'Sun' => 'Minggu',
		);

		$bulan = substr($data, 5, 2);
		$bulans = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);
		if ($simple) {
			return substr($data, 8, 2) . " " . $bulans[$bulan] . " " . substr($data, 0, 4);
		} elseif ($getMonth) {
			return substr($bulans[$bulan], 0, 3);
		} else {
			//return "-";
			if ($data == "0000-00-00 00:00:00") {
				echo "-";
			} else {
				return $haris[$hari] . ", " . substr($data, 8, 2) . " " . $bulans[$bulan] . " " . substr($data, 0, 4) . ", Jam " . substr($data, 11, 5);
			}
		}
	}

	function date_surat($data, $simple = false, $getMonth = false)
	{



		$bulan = substr($data, 5, 2);
		$bulans = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);
		if ($simple) {
			return substr($data, 8, 2) . " " . $bulans[$bulan] . " " . substr($data, 0, 4);
		} elseif ($getMonth) {
			return substr($bulans[$bulan], 0, 3);
		} else {
			//return "-";
			if ($data == "0000-00-00 00:00:00") {
				echo "-";
			} else {
				return "Bandung, " . substr($data, 8, 2) . " " . $bulans[$bulan] . " " . substr($data, 0, 4);
			}
		}
	}

	function cari_bulan($data)
	{
		$bulans = array(
			'1' => 'Januari',
			'2' => 'Februari',
			'3' => 'Maret',
			'4' => 'April',
			'5' => 'Mei',
			'6' => 'Juni',
			'7' => 'Juli',
			'8' => 'Agustus',
			'9' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);
		return $bulans[$data];
	}

	function tanggal_surat($data, $simple = false, $getMonth = false)
	{
		// day
		$hari = date("D", strtotime($data));
		$haris = array(
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu',
			'Sun' => 'Minggu',
		);

		$bulan = substr($data, 5, 2);
		$bulans = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);
		if ($simple) {
			return substr($data, 8, 2) . " " . $bulans[$bulan] . " " . substr($data, 0, 4);
		} elseif ($getMonth) {
			return substr($bulans[$bulan], 0, 3);
		} else {
			//return "-";
			if ($data == "0000-00-00 00:00:00") {
				echo "-";
			} else {
				return $haris[$hari] . ", " . substr($data, 8, 2) . " " . $bulans[$bulan] . " " . substr($data, 0, 4);
			}
		}
	}

	function bulan_surat($data, $simple = false, $getMonth = false)
	{


		$bulan = substr($data, 5, 2);
		$bulans = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);
		if ($simple) {
			return substr($data, 8, 2) . " " . $bulans[$bulan] . " " . substr($data, 0, 4);
		} elseif ($getMonth) {
			return substr($bulans[$bulan], 0, 3);
		} else {
			//return "-";
			if ($data == "0000-00-00 00:00:00") {
				echo "-";
			} else {
				return $bulans[$bulan] . " " . substr($data, 0, 4);
			}
		}
	}
}
