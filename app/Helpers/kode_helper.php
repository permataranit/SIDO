<?php

function kodeauto($tabel, $kolom, $kodeawal)
{
	$db  = \Config\Database::connect();

	// membuat query max
	$carikode = $db->query("SELECT max($kolom) as old_id FROM $tabel");
	$old_id = $carikode->getRowArray();
	$datakode = $old_id['old_id'];

	if ($datakode) {
		$nilaikode = substr($datakode, 1);

		// menjadikan $nilaikode ( int )
		$kode = (int)$nilaikode;

		// setiap $kode di tambah 1
		$kode = $kode + 1;
		$kode_otomatis = $kodeawal . str_pad($kode, 4, "0", STR_PAD_LEFT);
	} else {
		$kode_otomatis = $kodeawal . "0001";
	}

	return $kode_otomatis;
}
