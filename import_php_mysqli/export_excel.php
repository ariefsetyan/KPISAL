<!DOCTYPE html>
<html>
<head>
	<title>Export Data Laporan PIRT - www.malasngoding.com</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;

	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>

	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_PIRT.xls");
	?>
	
	<center>
		<h1>Export Data Laporan PIRT <br/> Dinas Kesehatan Kota Surabaya</h1>
	</center>
	
	<table border="1">
		<tr>
			<th>No</th>
			<th>No PIRT</th>
			<th>Nama Pemilik</th>
			<th>Alamat Rumah</th>
			<th>Telepon</th>
			<th>Nama Produk</th>
			<th>Nama Perusahaan</th>
			<th>Alamat Perusahaan</th>
			<th>Tanggal Penyuluhan PIRT</th>
			<th>Tempat</th>
		</tr>
		<?php 
		// koneksi database
		
		$koneksi = mysqli_connect("localhost","root","","mynotescode");

		// menampilkan data pegawai
		// $data = mysqli_query($koneksi,"select * from siswa");

		if(isset($_GET['bulan'])){
			$tgl = $_GET['bulan'];
			$sql = mysqli_query($koneksi, "SELECT * FROM siswa where month(tanggal)='$tgl'");
		}else{
			$sql = mysqli_query($koneksi, "select * from siswa");
		}
		$no = 1;
		while($d = mysqli_fetch_array($sql)){
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['no_pirt']; ?></td>
			<td><?php echo $d['nama_pemilik']; ?></td>
			<td><?php echo $d['alamat_rumah']; ?></td>
			<td><?php echo $d['telp']; ?></td>
			<td><?php echo $d['nama_produk']; ?></td>
			<td><?php echo $d['nama_perusahaan']; ?></td>
			<td><?php echo $d['alamat_perusahaan']; ?></td>
			<td><?php echo $d['tanggal_penyuluhan']; ?></td>
			<td><?php echo $d['tempat']; ?></td>
		</tr>
		<?php 
		}
		?>
	</table>
</body>
</html>