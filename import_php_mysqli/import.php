<?php
/*
-- Source Code from My Notes Code (www.mynotescode.com)
--
-- Follow Us on Social Media
-- Facebook : http://facebook.com/mynotescode/
-- Twitter  : http://twitter.com/mynotescode
-- Google+  : http://plus.google.com/118319575543333993544
--
-- Terimakasih telah mengunjungi blog kami.
-- Jangan lupa untuk Like dan Share catatan-catatan yang ada di blog kami.
*/

// Load file koneksi.php
include "koneksi.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = 'data.xlsx';

	// Load librari PHPExcel nya
	require_once 'PHPExcel/PHPExcel.php';

	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

	$numrow = 1;
	foreach($sheet as $row){
		// Ambil data pada excel sesuai Kolom
		$no_pirt = $row['A']; // Ambil data NIS
		$nama_pemilik = $row['B']; // Ambil data nama
		$alamat_rumah = $row['C']; // Ambil data jenis kelamin
		$telp = $row['D']; // Ambil data telepon
		$nama_produk = $row['E']; // Ambil data alamat
		$nama_perusahaan = $row['F']; // Ambil data alamat
		$alamat_perusahaan = $row['G']; // Ambil data alamat
		$tanggal_penyuluhan = $row['H']; // Ambil data alamat
		$tempat = $row['I']; // Ambil data alamat

		// Cek jika semua data tidak diisi
		if($no_pirt == "" 
			&& $nama_pemilik == "" 
			&& $alamat_rumah == "" 
			&& $telp == "" 
			&& $nama_produk == "" 
			&& $nama_perusahaan == ""
			&& $alamat_perusahaan == ""
			&& $tanggal_penyuluhan == ""
			&& $tempat == "")
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
			// Buat query Insert
			$query = "INSERT INTO siswa 
			VALUES(
			'".$no_pirt."',
			'".$nama_pemilik."',
			'".$alamat_rumah."',
			'".$telp."',
			'".$nama_produk."',
			'".$nama_perusahaan."',
			'".$alamat_perusahaan."',
			'".$tanggal_penyuluhan."',
			'".$tempat."'
			)";

			// Eksekusi $query
			mysqli_query($connect, $query);
		}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: index.php'); // Redirect ke halaman awal
?>
