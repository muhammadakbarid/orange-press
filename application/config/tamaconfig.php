<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['sitename'] = '<i class="fa fa-laptop-code"></i> SIPD';
$config['sitename_mini'] = '<i class="fa fa-laptop-code"></i>';

// Data eselon: eselon 1 sd eselon 4
$config['list_eselon'] = array(1, 2, 3, 4);

// status jabawan: Kasubag, kabag, dll
$config['list_status_jabatan'] = array(
  1 => "Kepala Bagian",
  2 => "Kapala Sub Bagian",
  5 => "Ketua DPRD",
  6 => "Wakil Ketua DPRD",
  7 => "Anggota DPRD",
  8 => "Staff",
  9 => "TKK"
);

// menjabat sebagai fungsional
$config['list_fungsi_jabatan'] = array(
  1 => "KPA",
  2 => "PPTK",
  3 => "Bendahara Pengeluaran Pembantu",
  4 => "Sekretaris",
  5 => "Sekretaris Daerah"
);
