<!--
-- Source Code from My Notes Code (www.mynotescode.com)
--
-- Follow Us on Social Media
-- Facebook : http://facebook.com/mynotescode/
-- Twitter  : http://twitter.com/code_notes
-- Google+  : http://plus.google.com/118319575543333993544
--
-- Terimakasih telah mengunjungi blog kami.
-- Jangan lupa untuk Like dan Share catatan-catatan yang ada di blog kami.
-->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Import Data Excel dengan PHP</title>

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

		<!-- Load File jquery.min.js yang ada difolder js -->
		<script src="js/jquery.min.js"></script>

		<script>
		$(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
		</script>
	</head>
	<body>
		<!-- Membuat Menu Header / Navbar -->
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#" style="color: white;"><b>Import Data Excel dengan PHP</b></a>
				</div>
				<p class="navbar-text navbar-right hidden-xs" style="color: white;padding-right: 10px;">
					FOLLOW US ON &nbsp;
					<a target="_blank" style="background: #3b5998; padding: 0 5px; border-radius: 4px; color: #f7f7f7; text-decoration: none;" href="https://www.facebook.com/mynotescode">Facebook</a>
					<a target="_blank" style="background: #00aced; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://twitter.com/code_notes">Twitter</a>
					<a target="_blank" style="background: #d34836; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://plus.google.com/118319575543333993544">Google+</a>
				</p>
			</div>
		</nav>

		<!-- Content -->
		<div style="padding: 0 15px;">
			<!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
			<a href="index.php" class="btn btn-danger pull-right">
				<span class="glyphicon glyphicon-remove"></span> Cancel
			</a>

			<h3>Form Import Data</h3>
			<hr>

			<!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
			<form method="post" action="" enctype="multipart/form-data">
				<a href="Formatx.xlsx" class="btn btn-default">
					<span class="glyphicon glyphicon-download"></span>
					Download Format
				</a><br><br>

				<!--
				-- Buat sebuah input type file
				-- class pull-left berfungsi agar file input berada di sebelah kiri
				-->
				<input type="file" name="file" class="pull-left">

				<button type="submit" name="preview" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-eye-open"></span> Preview
				</button>
			</form>

			<hr>

			<!-- Buat Preview Data -->
			<?php
			// Jika user telah mengklik tombol Preview
			if(isset($_POST['preview'])){
				//$ip = ; // Ambil IP Address dari User
				$nama_file_baru = 'data.xlsx';

				// Cek apakah terdapat file data.xlsx pada folder tmp
				if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
					unlink('tmp/'.$nama_file_baru); // Hapus file tersebut

				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
				$tmp_file = $_FILES['file']['tmp_name'];

				// Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
				if($ext == "xlsx"){
					// Upload file yang dipilih ke folder tmp
					// dan rename file tersebut menjadi data{ip_address}.xlsx
					// {ip_address} diganti jadi ip address user yang ada di variabel $ip
					// Contoh nama file setelah di rename : data127.0.0.1.xlsx
					move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

					// Load librari PHPExcel nya
					require_once 'PHPExcel/PHPExcel.php';

					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

					// Buat sebuah tag form untuk proses import data ke database
					echo "<form method='post' action='import.php'>";

					// Buat sebuah div untuk alert validasi kosong
					echo "<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
					</div>";

					echo "<table class='table table-bordered'>
					<tr>
						<th colspan='5' class='text-center'>Preview Data</th>
					</tr>
					<tr>
						<th>No Pirt</th>
						<th>Nama Pemilik</th>
						<th>Alamat Rumah</th>
						<th>Telepon</th>
						<th>Nama Produk</th>
						<th>Nama Perusahaan</th>
						<th>Alamat Perusahaan</th>
						<th>Tanggal Penyuluhan</th>
						<th>Tempat</th>
					</tr>";

					$numrow = 1;
					$kosong = 0;
					foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
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
							// Validasi apakah semua data telah diisi
							$nopirt_td = ( ! empty($no_pirt))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
							$namapmlk_td = ( ! empty($nama_pemilik))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
							$almtrmh_td = ( ! empty($alamat_rumah))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
							$tel_td = ( ! empty($telp))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
							$namaprdk_td = ( ! empty($nama_produk))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$namapt_td = ( ! empty($nama_perusahaan))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$almtpt_td = ( ! empty($alamat_perusahaan))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$tglpny_td = ( ! empty($tanggal_penyuluhan))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$tmpt_td = ( ! empty($tempat))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							// Jika salah satu data ada yang kosong
							if($no_pirt == "" or 
							$nama_pemilik == "" or 
							$alamat_rumah == "" or 
							$telp == "" or 
							$nama_produk == "" or
							$nama_perusahaan == "" or
							$tanggal_penyuluhan == "" or
							$tempat == ""){
								$kosong++; // Tambah 1 variabel $kosong
							}

							echo "<tr>";
							echo "<td".$nopirt_td.">".$no_pirt."</td>";
							echo "<td".$namapmlk_td.">".$nama_pemilik."</td>";
							echo "<td".$almtrmh_td.">".$alamat_rumah."</td>";
							echo "<td".$tel_td.">".$telp."</td>";
							echo "<td".$namaprdk_td.">".$nama_produk."</td>";
							echo "<td".$namapt_td.">".$nama_perusahaan."</td>";
							echo "<td".$almtpt_td.">".$alamat_perusahaan."</td>";
							echo "<td".$tglpny_td.">".$tanggal_penyuluhan."</td>";
							echo "<td".$tmpt_td.">".$tempat."</td>";
							echo "</tr>";
						}

						$numrow++; // Tambah 1 setiap kali looping
					}

					echo "</table>";

					// Cek apakah variabel kosong lebih dari 1
					// Jika lebih dari 1, berarti ada data yang masih kosong
					if($kosong > 1){
					?>
						<script>
						$(document).ready(function(){
							// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');

							$("#kosong").show(); // Munculkan alert validasi kosong
						});
						</script>
					<?php
					}else{ // Jika semua data sudah diisi
						echo "<hr>";

						// Buat sebuah tombol untuk mengimport data ke database
						echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
					}

					echo "</form>";
				}else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
					// Munculkan pesan validasi
					echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					</div>";
				}
			}
			?>
		</div>
	</body>
</html>
