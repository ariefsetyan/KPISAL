<?php

    $connect = new PDO("mysql:host=localhost;dbname=mynotescode", "root", "");
    $start_date_error = '';
    $end_date_error = '';
    	if(isset($_POST["export"]))
    {
		if(empty($_POST["start_date"]))
    {
	$start_date_error = '<label class="text-danger">Start Date is required</label>';
	}
    	else if(empty($_POST["end_date"]))
    {
    $end_date_error = '<label class="text-danger">End Date is required</label>';
    }else
    {

    $file_name = 'OrderData.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file_name");
    header("Content-Type: application/csv;");
 
      $file = fopen('php://output', 'w');
      $header = array("Order ID", "Customer Name", "Item Name", "Order Value", "Order Date");
    fputcsv($file, $header);

      $query = "
      SELECT * FROM siswa
      WHERE tanggal>= '".$_POST["start_date"]."'
      AND tanggal<= '".$_POST["end_date"]."'
      ORDER BY tanggal DESC

      ";

      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
 	foreach($result as $row)
      {
	   $data = array();
       $data[] = $row["no_pirt"];
       $data[] = $row["nama_pemilik"];
	   $data[] = $row["alamat_rumah"];
       $data[] = $row["telp"];
	   $data[] = $row["nama_produk"];
	   $data[] = $row["nama_perusahaan"];
	   $data[] = $row["alamat_perusahaan"];
	   $data[] = $row["tanggal_penyuluhan"];
	   $data[] = $row["tempat"];
    fputcsv($file, $data);
      }

    fclose($file);
    exit;

     }

    }     

    $query = "
    SELECT * FROM siswa
    ORDER BY tanggal DESC;

    ";  
	$statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

?>

<html>
	<head>
	<title>Membuat export data berdasarkan range tanggal menggunakan php</title>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<link rel="stylesheet" href=		"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"/>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

	</head>

	<body>
	<div class="container box">
	<h1 align="center">Membuat export data berdasarkan range tanggal menggunakan php</h1>
		
    <div class="table-responsive">
    <div class="row">
    
    	<form method="post">

	<div class="input-daterange">
    <div class="col-md-4">

		<input type="text" name="start_date" class="form-control" readonly/>

<?php echo $start_date_error; ?>

	</div>
	<div class="col-md-4">

		<input type="text" name="end_date" class="form-control" readonly/>

<?php echo $end_date_error; ?>

	</div>
	</div>

	<div class="col-md-2">
		<input type="submit" name="export" value="Export" class="btnbtn-info"/>
	</div>
		</form>
	</div>

	<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Order ID</th>
			<th>Customer Name</th>
			<th>Item</th>
			<th>Value</th>
			<th>Order Date</th>
		</tr>
	</thead>
	<tbody>

<?php

		foreach($result as $row)

      	{

		echo '

		<tr>
			<td>'.$row["no_pirt"].'</td>
			<td>'.$row["nama_pemilik"].'</td>
			<td>'.$row["alamat_rumah"].'</td>
			<td>$'.$row["telp"].'</td>
			<td>'.$row["nama_produk"].'</td>
			<td>'.$row["nama_perusahaan"].'</td>
			<td>'.$row["alamat_perusahaan"].'</td>
			<td>'.$row["tanggal_penyuluhan"].'</td>
			<td>'.$row["tempat"].'</td>
		</tr>

       		';
		}
?>
	</tbody>
	</table>
</div>
</div>
</body>
</html>

<script>
$(document).ready(function(){
$('.input-daterange').datepicker({
todayBtn:'linked',
format:"yyyy-mm-dd",
autoclose:true
});
});
</script>