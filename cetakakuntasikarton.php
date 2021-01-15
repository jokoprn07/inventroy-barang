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

$sql = mysqli_query($conn, "SELECT `id`,`nama_item`,`code`,`size`,`sb_top`,`sb_leg`,`sb_cross`, (`t_total` + `l_total` + `c_total`) AS total,`qty`,`keterangan`,`nama_customer`,`kode_customer`,`nama_suplier`,`kode_suplier`,`tanggal_pembelian`,`jangka_waktu`,`no_po`,`divisi`,`jumlah_terima` FROM `dp_karton` WHERE id = $id ");

// $sql .= mysqli_query($conn, " ");
$data = mysqli_fetch_assoc($sql);

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
					</tr>
					<tr>
						<td rowspan="2"></td>
						<td colspan="4" class="text-center">'.$namaper.'</td>
					</tr>
					<tr>
						<td colspan="4" class="text-center">AKUNTASI</td>
						
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style=min-width:50px>PO. NO</td>
						<td style=min-width:50px> : '.$data['no_po'].'</td>
						<td style=min-width:50px>PO. DATE</td>
						<td style=min-width:50px> : '.date("d-M-yy", strtotime($data['tanggal_pembelian'])).'</td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style=min-width:50px>SUPP. CODE / NAMA. SUPP</td>
						<td style=min-width:50px> : '.$data['kode_suplier'].' / '. $data['nama_suplier'] .'</td>
						<td style=min-width:50px>JADWAL KIRIM</td>
						<td style=min-width:50px> : '.date("d-M-yy", strtotime($data['jangka_waktu'])).'</td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="width:200px">CUST. CODE / NAMA. CUST</td>
						<td style=min-width:50px> : '.$data['kode_customer'].' / '.$data['nama_customer'].'</td>
						<td style=min-width:50px>DIVISI</td>
						<td style=min-width:50px> : '.$data['divisi'].'</td>
						<td style=min-width:50px></td>
					</tr>
					<tr>
						<td style="height:50px;" class="text-center">REFF. ITEM</td>
						<td class="text-center">DESCRIPTION ITEM</td>
						<td class="text-center" style="width: 100px;">SIZE</td>
						<td class="text-center" style="width: 100px;">QTY</td>
						<td class="text-center">PRICE</td>
					</tr>
					<tr>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
						<td style=min-width:50px></td>
					</tr>';




                    foreach($sql as $r){
					$text .='<tr>
						<td class="text-center"></td>
						<td class="text-center">'.$r['nama_item'].'</td>
						<td class="text-center">'.$r['size'].'</td>
						<td class="text-center">'.$r['qty'].'</td>
						<td class="text-center">'.rupiah($r['total']).'</td>
					</tr>
					';
                    }
					// $cuk = mysqli_fetch_assoc($total);

					$text .='
					<tr>
					
						<td colspan="4" style="min-width:50px;" class="text-center">Total</td>
						<td class="text-center">'.rupiah($data['total']).'</td>
					</tr>';
					
					
					$text .= '<tr>
						<td colspan="4" style="height:40px;">Nb : '.$data['keterangan'].'</td>
					</tr>
					<tr>
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
$mpdf->Output($data['nama_item'] .'.pdf', 'I');

?>