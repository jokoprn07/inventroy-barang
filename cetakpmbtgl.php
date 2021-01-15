<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

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

if(isset($_POST['tanggal'])){
    $tglawal = $_POST['tglawal'];
    $tglakhir = $_POST['tglakhir'];
    
    $sql = mysqli_query($conn, "SELECT * FROM dp_barang WHERE tanggal_pembelian BETWEEN '$tglawal' AND '$tglakhir' ");
    $data = mysqli_fetch_assoc($sql);
}  

$jadwal = $data['jangka_waktu'];
$tanggal = $data['tanggal_pembelian'];
$total = 0;
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
				<td rowspan="2"></td>
				<td colspan="6" class="text-center">'.$namaper.'</td>
			</tr>
			<tr>
				<td colspan="6" style="background:red;" class="text-center">PURCHASE ORDER</td>
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
				<td style=min-width:50px>PO. NO</td>
				<td style=min-width:50px> : '.$data['kode_pembelian'].'</td>
				<td style=min-width:50px>PO. DATE</td>
				<td style=min-width:50px> : '.date("d-F-Y", strtotime($tanggal)).'</td>
				<td style=min-width:50px>NAMA.SUPP</td>
				<td style=min-width:50px> : '.$data['nama_suplier'].'</td>
				<td style=min-width:50px></td>
			</tr>
			<tr>
				<td style=min-width:50px>SUPP. CODE</td>
				<td style=min-width:50px> : '.$data['kode_suplier'].'</td>
				<td style=min-width:50px>JADWAL KIRIM</td>
				<td style=min-width:50px> : '.date("d-F-Y", strtotime($jadwal)).'</td>
				<td style=min-width:50px></td>
				<td style=min-width:50px></td>
				<td style=min-width:50px></td>
			</tr>
			<tr>
				<td style=min-width:50px>CUST. CODE</td>
				<td style=min-width:50px> : '.$data['kode_customer'].'</td>
				<td style=min-width:50px>NAMA.CUST</td>
				<td style=min-width:50px> : '.$data['nama_customer'].'</td>
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
				<td class="text-center">SIZE / CM (W X D X H)</td>
				<td class="text-center" style="width: 100px;">QTY</td>
				<td class="text-center">PRICE</td>
				<td class="text-center" style="min-width:50px">TOTAL</td>
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
			$text .='
			<tr>
				<td class="text-center"></td>
				<td class="text-center">'.$data['nama_barang'].'</td>
				<td class="text-center">'.$data['satuan'].'</td>
				<td style=min-width:50px></td>
				<td class="text-center">'.$data['jumlah_pembelian'].'</td>
				<td class="text-center">'.rupiah($data['harga_beli']).'</td>
				<td class="text-center">'.rupiah($data['total_pembelian']).'</td>
			</tr>';
			}
            $ppn = $data['total_pembelian'] * $data['ppn'] / 100;
            // $hasil = $ppn + $data['total_pembelian'];
                    
	        $text .='                
			<tr>
				<td style=min-width:50px></td>
				<td style=min-width:50px></td>
				<td colspan="4" class="text-center" style="background:yellow;">PPN '.$data['ppn'].'%</td>
				<td style="min-width:50px;" class="text-center">'.rupiah($ppn).'</td>
			</tr>';
			$query = mysqli_query($conn, "SELECT SUM(total_pembelian) AS total FROM dp_barang WHERE tanggal_pembelian BETWEEN '$tglawal' AND '$tglakhir' ");

			while( $total = mysqli_fetch_array($query) ){
			$text .='
			<tr>
				<td style=min-width:50px></td>
				<td style=min-width:50px></td>
				<td style=min-width:50px></td>
				<td style=min-width:50px></td>
				<td style=min-width:50px></td>
				<td style=min-width:50px></td>
				<td class="text-center">'.rupiah($total['total'] + $ppn ).'</td>
			</tr>';
			}
			$text .='
            <tr>
				<td colspan="6" style="height:40px;">Nb : '.$data['keterangan'].'</td>
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