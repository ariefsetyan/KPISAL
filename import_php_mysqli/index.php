
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Import Data Excel Laporan PIRT</title>

		<!-- Load File bootstrap.min.css yang ada difolder css -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Style untuk Loading -->
		<style>
        #loading{
			background: whitesmoke;
			position: absolute;
			top: 140px;
			left: 82px;
			padding: 5px 10px;
			border: 1px solid #ccc;
		}
		</style>
	</head>
	<body>
		<!-- Membuat Menu Header / Navbar -->
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#" style="color: white;"><b>Import Data Excel Laporan PIRT</b></a>
				</div>
				<!-- <p class="navbar-text navbar-right hidden-xs" style="color: white;padding-right: 10px;"> -->
					<!-- FOLLOW US ON &nbsp; -->
					<!-- <a target="_blank" style="background: #3b5998; padding: 0 5px; border-radius: 4px; color: #f7f7f7; text-decoration: none;" href="https://www.facebook.com/mynotescode">Facebook</a>  -->
					<!-- <a target="_blank" style="background: #00aced; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://twitter.com/mynotescode">Twitter</a>  -->
					<!-- <a target="_blank" style="background: #d34836; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://plus.google.com/118319575543333993544">Google+</a> -->
				</p>
			</div>
		</nav>
		
		<!-- Content -->
		<div style="padding: 0 15px;">
			<!-- 
			-- Buat sebuah tombol untuk mengarahkan ke form import data
			-- Tambahkan class btn agar terlihat seperti tombol
			-- Tambahkan class btn-success untuk tombol warna hijau
			-- class pull-right agar posisi link berada di sebelah kanan
			-->
			
			<a href="export_excel.php" class="btn btn-primary pull-right" style="margin-left:20px;">
				<span class="glyphicon glyphicon-upload"></span> Download
			</a>
			
				<a href="form.php" class="btn btn-success pull-right" style="margin-right:20px;">
				<span class="glyphicon glyphicon-upload"></span> Import Data
			</a>

			
			<h3>Data Hasil Import</h3>
			
			<hr>
			<form method="get">
				<label>Pilih Tanggal</label>
				<select name="bulan">
				<option value="01">Januari</option>
				<option value="02">Februari</option>
				<option value="03">Maret</option>
				<option value="04">April</option>
				<option value="05">Mei</option>
				<option value="06">Juni</option>
				<option value="07">Juli</option>
				<option value="08">Agustus</option>
				<option value="09">September</option>
				<option value="10">Oktober</option>
				<option value="12">November</option>
				<option value="12">Desember</option>
				</select>
				Tahun
				<select name="tahun">
				<?php
				$mulai= date('Y') - 50;
				for($i = $mulai;$i<$mulai + 100;$i++){
					$sel = $i == date('Y') ? ' selected="selected"' : '';
					echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
				}
				?>
				</select>
				<!-- <input type="date" name="tanggal"> -->
				<input type="submit" value="FILTER">
			</form>
			<br>
			
			<!-- Buat sebuah div dan beri class table-responsive agar tabel jadi responsive -->
			<div class="table-responsive">
				<table class="table table-bordered">
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
					// Load file koneksi.php
					include "koneksi.php";
					
					// Buat query untuk menampilkan semua data siswa
					// $sql = mysqli_query($connect, "SELECT * FROM siswa");
					
					$no = 1; // Untuk penomoran tabel, di awal set dengan 1


					if(isset($_GET['bulan'])){
						$tgl = $_GET['bulan'];
						$sql = mysqli_query($connect, "SELECT * FROM siswa where month(tanggal_penyuluhan)='$tgl'");
					}else{
						$sql = mysqli_query($connect, "select * from siswa");
					}
					
					// $bulan = $_POST['bulan'];
					// $sql = "SELECT * FROM tabel where month(waktu)='$bulan' ";

					while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
						echo "<tr>";
						echo "<td>".$no."</td>";
						echo "<td>".$data['no_pirt']."</td>";
						echo "<td>".$data['nama_pemilik']."</td>";
						echo "<td>".$data['alamat_rumah']."</td>";
						echo "<td>".$data['telp']."</td>";
						echo "<td>".$data['nama_produk']."</td>";
						echo "<td>".$data['nama_perusahaan']."</td>";
						echo "<td>".$data['alamat_perusahaan']."</td>";
						$tanggal = $data['tanggal_penyuluhan'];
						echo "<td>". date("d-m-Y", strtotime($tanggal)). "</td>";
						// echo "<td>".$data['tanggal_penyuluhan']."</td>";
						echo "<td>".$data['tempat']."</td>";
						echo "</tr>";
						
						$no++; // Tambah 1 setiap kali looping
					}
					?>
				</table>
			</div>
		</div>
		
	</body>
</html>
