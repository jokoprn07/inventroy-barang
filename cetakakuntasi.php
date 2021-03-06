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

$id = (int)$_GET['id'];

$sql = mysqli_query($conn, "SELECT * FROM dp_barang WHERE id = '$id'");
$data = mysqli_fetch_assoc($sql);

$tanggal_expired = $data['jangka_waktu'];
$tanggal_terima = $data['tanggal_pembelian'];

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
						<td colspan="6" class="text-center">'.$namaper.'</td>
					</tr>
					<tr>
						<td colspan="6" class="text-center">AKUNTASI</td>
						
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style=min-width:50px>PO. DATE</td>
						<td style=min-width:50px> : '.date("d-M-y", strtotime($tanggal_terima)).'</td>
						<td style=min-width:50px>DELIVERY</td>
						<td style=min-width:50px> : '.date("d-M-y", strtotime($tanggal_expired)).'</td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style=min-width:50px>Nama Supplier </td>
						<td style=min-width:50px> : '.$data['nama_suplier'].'</td>
						<td style=min-width:50px>Kode Suplier</td>
						<td style=min-width:50px> : '.$data['kode_suplier'].'</td>
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
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
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
						<td class="text-center">HARGA BELI</td>
						<td class="text-center" style="width: 100px;">QTY</td>
						<td class="text-center" style="width: 100px;">JUMLAH TERIMA</td>
						<td class="text-center">Total</td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>';
					
					// $ppn = $data['total_pembelian'] * $data['ppn'] / 100;
					// $hasil = $ppn + $data['total_pembelian'];

					


                    foreach( $sql as $data ){
					$total = $data['harga_beli'] * $data['jumlah_terima'];
					$text .='<tr>
						<td class="text-center"></td>
						<td class="text-center">'.$data['nama_barang'].'</td>
						<td class="text-center">'.$data['satuan'].'</td>
						<td class="text-center">'.rupiah($data['harga_beli']).'</td>
						<td class="text-center">'.$data['jumlah_pembelian'].'</td>
						<td class="text-center">'.$data['jumlah_terima'].'</td>
						<td class="text-center">'.rupiah($total).'</td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style="min-width: 50px;"></td>
						<td style="min-width:50px;" class="text-center"></td>
					</tr>
					<tr>
						<td colspan="6" class="text-center">Total</td>
						<td class="text-center">'.rupiah($total).'</td>
                    </tr>';
					}
					$text .='<tr>
						<td colspan="6" style="height:40px; margin-right: 50px;">Nb : '.$data['keterangan'].'</td>
						<td style="text-align:center; ">'.$data['stat'].'</td>
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