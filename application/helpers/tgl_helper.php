<?php
function tgl_indo($datetime){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
    $expl = explode(' ', $datetime);
    $rawDate = $expl[0];
    $rawTime = $expl[1];
    $date = explode('-', $rawDate);
    $time = explode(':', $rawTime);
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $date[2].' '.$bulan[(int)$date[1]].' '.$date[0].' '.$time['0'].':'.$time['1'];
}

// echo tgl_indo(date('Y-m-d')); // 21 Oktober 2017

// echo "<br/>";
// echo "<br/>";

// echo tgl_indo("1994-02-15"); // 15 Februari 1994
?>