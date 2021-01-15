<?php

session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: login/index.php");
  exit();
}

require_once __DIR__ . '/vendor/autoload.php';

include 'fungsi.php';
$perusahaan = mysqli_query($conn, "SELECT * FROM perusahaan");
$cek = mysqli_fetch_assoc($perusahaan);
// return $cek;
$namaper = $cek['nama_perusahaan'];

$id = $_GET['id'];

$sql = mysqli_query($conn, "SELECT * FROM dk_penjualan WHERE kode_penjualan = '$id'");
$data = mysqli_fetch_assoc($sql);

$tanggal = $data['tanggal_penjualan'];
function rupiah($angka){
	$hasil = "Rp. " . number_format($angka,0,".",".");
	return $hasil;
}

$text = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Barang</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="1"> 
    <link href="dashboard/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="dashboard/assets/fontawesome/css/all.css" rel="stylesheet" />
    <link href="dashboard/assets/css/style.css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
    <link href="dashboard/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="dashboard/assets/js/jquery.js"></script>
    <script src="dashboard/assets/js/bootstrap.min.js"></script>
    <script src="dashboard/assets/js/bootbox.min.js"></script>
    <style>        
        .footer{
            padding-top: 20px;
            margin-left: 500px;
        }
    </style>
</head>
<body>

<div class="container">
		

</div>

<div class="table-responsive" style="margin-top: 20px;">
      <table class="table table-striped table-bordered">
        <thead>
        <tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td rowspan="2"></td>
						<td colspan="5" class="text-center">'.$namaper.'</td>
					</tr>
					<tr>
						<td colspan="5" class="text-center">Penjualan</td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style=min-width:50px>Kode Penjualan</td>
						<td style=min-width:50px> : '.$data['kode_penjualan'].'</td>
						<td style=min-width:50px>Tanggal Penjualan</td>
						<td style=min-width:50px> : '.date("d-M-yy", strtotime($tanggal)).'</td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style=min-width:50px>CUST. CODE</td>
						<td style=min-width:50px> : '.$data['kode_customer'].'</td>
						<td style=min-width:50px>NAMA.CUST</td>
						<td style=min-width:50px> : '.$data['nama_customer'].' </td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="height:50px;" class="text-center">REFF. ITEM</td>
						<td class="text-center">DESCRIPTION ITEM</td>
						<td class="text-center" style="width: 100px;">SATUAN</td>
						<td class="text-center" style="width: 100px;">Jumlah Item</td>
						<td class="text-center">HARGA JUAL</td>
						<td class="text-center">TOTAL</td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>';
				
                    foreach( $sql as $data ){
					$text .='<tr>
						<td class="text-center"></td>
						<td class="text-center">'.$data['nama_barang'].'</td>
						<td class="text-center">'.$data['size'].'</td>
						<td style=min-width:50px>'.$data['jumlah_penjualan'].'</td>
						<td class="text-center">'.rupiah($data['harga_jual']).'</td>';
						$ppn = $data['jumlah_penjualan'] * $data['harga_jual'];
						$text .='
						<td class="text-center">'.rupiah($data['total_penjualan']).'</td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td colspan="3" class="text-center"></td>
						<td style="min-width:50px;" class="text-center"></td>
					</tr>
					';
					}					
					$sql = mysqli_query($conn, "SELECT SUM(total_penjualan) AS total FROM dk_penjualan WHERE kode_penjualan = '$id'");
$data = mysqli_fetch_assoc($sql);

					$text .='
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td colspan="3" style="min-width:50px">Total</td>
						<td class="text-center">'.rupiah($data['total']).'</td>
					</tr>';

					$sql = mysqli_query($conn, "SELECT keterangan FROM dk_penjualan WHERE kode_penjualan = '$id'");
$data = mysqli_fetch_assoc($sql);

					$text .= '
					<tr>
						<td colspan="5" style="height:40px;">Nb : '.$data['keterangan'].'</td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
				';  

$text .= '</thead>
        </table>
        <div class="footer">
            <div style="float:left; margin-left: 330px;">'.$cek['kota_perusahaan'].', '.date('d-M-Y').'</div>
            <div style="margin-top:70px; float:left; margin-left: 400px;">'.$cek['pemilik'].'</div>
        </div>


        <script src="dashboard/assets/js/jquery.metisMenu.js"></script>
    <!--DATA TABLE-->
    <script src="dashboard/assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="dashboard/assets/js/jquery-3.4.1.slim.js"></script>
    <script src="dashboard/assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="dashboard/assets/js/script.js"></script>
    
</body>
</html>';

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
$mpdf->WriteHTML($text);
$mpdf->Output($data['nama_barang'].'.pdf', 'I');

?>