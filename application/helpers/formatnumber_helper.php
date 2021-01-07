<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

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
