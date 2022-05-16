<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// akbr helper

function test_email($to, $subject, $message)
{

  $ci = get_instance();
  //  codeigniter 3 send email controller
  $ci->load->library('email');

  $config['protocol'] = 'smtp';
  $config['smtp_host'] = 'ssl://smtp.gmail.com';
  $config['smtp_user'] = 'muhammadakbarr.id@gmail.com';
  $config['smtp_pass'] = 'muarihaku121';
  $config['smtp_port'] = 465;
  $config['mailtype'] = 'html';
  $config['charset'] = 'utf-8';
  $config['newline'] = "\r\n";

  $ci->email->initialize($config);

  $ci->email->from('akbar', 'Muhammad Akbar');
  $ci->email->to($to);
  $ci->email->subject($subject);
  $ci->email->message($message);

  if ($ci->email->send()) {
    return true;
  } else {
    // show_error($this->email->print_debugger());
    return false;
  }
}

function send_email($to, $subject, $name)
{

  $logo = 'https://i.imgur.com/mCdnh1M.png';

  $html_content = '
    <html lang="en">
  <head>
    <style>
      .container {
        max-width: 500px;
        margin: 0 auto;
        border: rgb(182, 182, 182) solid 1px;
        border-radius: 20px;
        font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
        overflow: hidden;
      }
      .header {
        background-color: #5b99e7;
        color: #fafafa;
        text-align: center;
        margin-top: 0;
        padding: 20px;
        font-size: 20px;
      }
      .content {
        padding: 20px;
        margin-top: 0;
      }
    </style>
  </head>
  <body>
    <div class="container">
    <div class="header">
    GPP System : ' . $subject . '
    </div>
      <div class="content">
        <p>Hi, ' . $name . '</p>
        Your logtime is less than 35 hours.<br>
        Please check your logtime. <br>
        Thank
        You.<br><br>
        <hr>
        <center>
          <img src="' . $logo . '" width="50px" alt="logo gpp system"/>
        </center>
      </div>
    </div>
  </body>
</html>';

  $ci = get_instance();
  //  codeigniter 3 send email controller
  $ci->load->library('email');

  $config['protocol'] = 'smtp';
  $config['smtp_host'] = 'ssl://smtp.gmail.com';
  $config['smtp_user'] = 'muhammadakbarr.id@gmail.com';
  $config['smtp_pass'] = 'muarihaku121';
  $config['smtp_port'] = 465;
  $config['mailtype'] = 'html';
  $config['charset'] = 'utf-8';
  $config['newline'] = "\r\n";

  $ci->email->initialize($config);

  $ci->email->from('akbar', 'Muhammad Akbar');
  $ci->email->to($to);
  $ci->email->subject($subject);
  $ci->email->message($html_content);

  if ($ci->email->send()) {
    return true;
  } else {
    // show_error($this->email->print_debugger());
    return false;
  }
}

function time_to_hour($time)
{
  if (isset($time)) {
    $time = explode(':', $time);
    $hour = $time[0];
    $minute = $time[1];
    $second = $time[2];
    $hour = $hour + ($minute / 60) + ($second / 3600);
    $hour = round($hour, 2);
    return $hour;
  }
}

// konversi ke rupiah dari decimal atau integer
// Rp. 12.000.000
if (!function_exists('rupiah')) {
  function rupiah($nilaiku)
  {
    return "Rp. " . number_format($nilaiku, 0, ",", ".");
  }
}

// menghilangkan karater titik pada sebuah kalimat atau angka
// digunakna jika user input nilai uang dengan titik sebagai penyebut ribu
if (!function_exists('hilangkantitik')) {
  function hilangkantitik($nilaiku)
  {
    return str_replace(".", "", $nilaiku);
  }
}

// memberikan nilai sebuah kalimat dari nominal angka yang diberikan
// Contoh: Seratus Ribu Rupiah
function penyebut($nilai)
{
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " " . $huruf[$nilai];
  } else if ($nilai < 20) {
    $temp = penyebut($nilai - 10) . " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
  }
  return $temp;
}

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
        return substr($data, 8, 2) . " " . $bulans[$bulan] . " " . substr($data, 0, 4);
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

  function get_file($path, $file_name)
  {
    $ci = get_instance();
    $file = FCPATH . $path . $file_name;

    if (file_exists($file)) {
      $ci->load->helper('file');
      $file = file_get_contents($file);
      $ci->load->helper('download');
      force_download($file_name, $file);
    } else {
      echo "File not found";
    }
  }

  function submission_status_color($id_status)
  {
    switch ($id_status) {
      case '11': // Submitted
        return '<span class="badge badge-primary" style="background-color:#ffc857;color:#000;">Submitted</span>';
        break;
      case '10': // Lead Editor PLotted
        return '<span class="badge badge-primary" style="background-color:#ffc857;color:#000;">Lead Editor Plotted</span>';
        break;
      case '1': // Acceptance Submission
        return '<span class="badge badge-primary" style="background-color:#41ead4;color:#000;">Acceptance Submission</span>';
        break;
      case '2': // Rejected
        return '<span class="badge badge-primary" style="background-color:#bc4749;color:#fff;">Rejected</span>';
        break;
      case '3': // Paid
        return '<span class="badge badge-primary" style="background-color:#00a65a;color:#fff;">Paid</span>';
        break;
      case '12': // Editor Plotted
        return '<span class="badge badge-primary" style="background-color:#ffc857;color:#000;">Editor Plotted</span>';
        break;
      case '4': // Correction
        return '<span class="badge badge-primary" style="background-color:#ffc857;color:#000;">Correction</span>';
        break;
      case '5': // Approved
        return '<span class="badge badge-primary" style="background-color:#00a65a;color:#fff;">Approved</span>';
        break;
      case '6': // Approved PR
        return '<span class="badge badge-primary" style="background-color:#00a65a;color:#fff;">Approved Proofreading</span>';
        break;
      case '13': // Correction PR
        return '<span class="badge badge-primary" style="background-color:#ffc857;color:#000;">Correction Proofreading</span>';
        break;
      case '7': // Layout Processed
        return '<span class="badge badge-primary" style="background-color:#ffc857;color:#000;">Layout Processed</span>';
        break;
      default:
        return '<span class="badge badge-primary" style="background-color:#ccc;color:#000;">No Status</span>';
        break;
    }
  }

  function submission_check_action($id_status, $id_produk)
  {
    switch ($id_status) {
      case '11': // Submitted
        return "<a class='btn btn-xs btn-danger' href='" . base_url('Submission/plot_lead_editor/') . $id_produk . "'>Plot Lead Editor</a>";
        break;
      case '10': // Lead Editor PLotted
        return "<a class='btn btn-xs btn-warning' href='" . base_url('Submission/change_lead_editor/') . $id_produk . "'>Change Lead Editor</a>";
        break;
      case '1': // Acceptance Submission
        return "";
        break;
      case '2': // Rejected
        return "";
        break;
      case '3': // Paid
        return "<a href='" . base_url('Submission/plot_editor/') . $id_produk . "' style='margin-right: 5px;' class='btn btn-xs btn-warning'>Plot Editor</a>";
        break;
      case '12': // Editor Plotted
        return "";
        break;
      default:
        return '';
        break;
    }
  }

  function submission_check_action_lead($id_status, $id_produk)
  {
    switch ($id_status) {
      case '11': //submitted
        return "";
        break;
      case '10': //lead editor plotted
        return "<a data-id='" . $id_produk . "' id='approve' style='margin-right: 5px;' class='btn btn-xs btn-success'>Aprrove</a><a data-id='" . $id_produk . "' id='reject' class='btn btn-xs btn-danger'>Reject</a>";
        break;
      default:
        return '';
        break;
    }
  }

  function submission_check_action_penulis($id_status, $id_produk)
  {
    switch ($id_status) {
      case '1':
        return "<a href='" . base_url('Submission/bayar/') . $id_produk . "' id='approve' style='margin-right: 5px;' class='btn btn-xs btn-warning'>Bayar</a>";
        break;
      default:
        return '';
        break;
    }
  }

  function submission_check_action_editor($id_status, $id_produk)
  {
    switch ($id_status) {
      case '12': // Editor Plotted
        return "<a href='" . base_url('Submission/penyuntingan_naskah/') . $id_produk . "' style='margin-right: 5px;' class='btn btn-xs btn-warning'>Sunting Naskah</a><a id='sunting_naskah_approve' data-id='" . $id_produk . "' class='btn btn-xs btn-success'>Approve</a>";
        break;
      case '4': //Correction
        return "<a href='" . base_url('Submission/proofreading/') . $id_produk . "' style='margin-right: 5px;' class='btn btn-xs btn-warning'>Proofreading</a><a id='proofreading_approve' data-id='" . $id_produk . "' class='btn btn-xs btn-success'>Approve</a>";
        break;
      case '5': //Approved
        return "<a href='" . base_url('Submission/proofreading/') . $id_produk . "' style='margin-right: 5px;' class='btn btn-xs btn-warning'>Proofreading</a><a id='proofreading_approve' data-id='" . $id_produk . "' class='btn btn-xs btn-success'>Approve</a>";
        break;
      case '6': // Approved PR
        return "<a href='" . base_url('Submission/layout_cover/') . $id_produk . "' style='margin-right: 5px;' class='btn btn-xs btn-primary'>Add Layout Cover</a>";
        break;
      case '13': // Correction PR
        return "<a href='" . base_url('Submission/layout_cover/') . $id_produk . "' style='margin-right: 5px;' class='btn btn-xs btn-primary'>Add Layout Cover</a>";
        break;
      default:
        return '';
        break;
    }
  }
}