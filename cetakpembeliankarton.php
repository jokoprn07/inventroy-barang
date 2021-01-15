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

$id = $_GET['no_po'];

$sql = mysqli_query($conn, "SELECT * FROM dp_karton WHERE no_po = '$id' ");

// $sql .= mysqli_query($conn, " ");
$data = mysqli_fetch_assoc($sql);


$jadwal = $data['jangka_waktu'];
$tanggal = $data['tanggal_pembelian'];
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
						<td colspan="13" class="text-center">'.$namaper.'</td>
					</tr>
					<tr>
						<td colspan="13" class="text-center">PURCHASE ORDER</td>
						
					</tr>
					<tr>
						<td>PO. NO</td>
						<td colspan="3"> : '.$data['no_po'].'</td>
						<td>PO. DATE</td>
						<td colspan="3"> : '.date("d-M-Y", strtotime($tanggal)).'</td>
						<td colspan="6"></td>
					</tr>
					<tr>
						<td>SUPP. CODE / NAMA. SUPP</td>
						<td colspan="3"> : '.$data['kode_suplier'].' / '. $data['nama_suplier'] .'</td>
						<td>JADWAL KIRIM</td>
						<td colspan="3"> : '.date("d-M-Y", strtotime($jadwal)).'</td>
						<td colspan="6"></td>
					</tr>
					<tr>
						<td>CUST. CODE / NAMA. CUST</td>
						<td colspan="3"> : '.$data['kode_customer'].' / '.$data['nama_customer'].'</td>
						<td>DIVISI</td>
						<td colspan="3"> : '.$data['divisi'].'</td>
						<td colspan="10"></td>
					</tr>
					<tr>
						<td style="height:50px;" class="text-center" scope="col" rowspan="2">REFF. ITEM</td>
						<td class="text-center" scope="col" rowspan="2">DESCRIPTION ITEM</td>
						<td class="text-center" style="width: 100px;" scope="col" rowspan="2">SIZE BARANG ( CM )</td>
						<td class="text-center" scope="col" colspan="3"  style="vertical-align: middle;">Size Box ( mm )</td>
						<td class="text-center" scope="col" rowspan="2" style="width: 100px;">QTY</td>
						<td class="text-center" scope="col" colspan="2"  style="vertical-align: middle;">Top</td>
						<td class="text-center" scope="col" colspan="2"  style="vertical-align: middle;">Leg</td>
						<td class="text-center" scope="col" colspan="2"  style="vertical-align: middle;">Cross</td>
						<td class="text-center" scope="col" rowspan="2">PRICE</td>
					</tr>
					<tr>
					<td style="vertical-align: middle;" style="width:100px;" class="text-center">Top</td>
					<td style="vertical-align: middle;"  style="width:100px;" class="text-center">Leg</td>
					<td style="vertical-align: middle;" style="width:100px;" class="text-center">Cross</td>
					// <!-- For Top -->
					<td style="vertical-align: middle;">Harga</td>
					<td style="vertical-align: middle;">Total</td>
					// <!-- For Leg -->
					<td style="vertical-align: middle;">Harga</td>
					<td style="vertical-align: middle;">Total</td>
					// <!-- For Cross -->
					<td style="vertical-align: middle;">Harga</td>
					<td style="vertical-align: middle;">Total</td>
            		</tr>
					';
                    $sql = mysqli_query($conn, "SELECT `nama_item`,`size`,`qty`, `sb_top`,`sb_leg`,`sb_cross`,`t_harga`,`c_harga`,`l_harga`,`t_total`,`l_total`,`c_total`, (t_total +l_total + c_total) as JmlPembelian FROM `dp_karton` ");
                    

                    while ($r = mysqli_fetch_array($sql)){
                    $zJmlPembelian += $r['JmlPembelian'];
					$text .='<tr>
						<tr class="text-center">
            <td></td>
            <td class="text-center">'. $r['nama_item'].'</td>
            <td class="text-center">'. $r['size'].'</td>
            <!-- For Size Box -->
            <td class="text-center" scope="col" rowspan="1">'. $r['sb_top'].'</td>
            <td class="text-center" scope="col" rowspan="1">'. $r['sb_leg'].'</td>
			<td class="text-center" scope="col" rowspan="1">'. $r['sb_cross'].'</td>
			
            <td class="text-center">'. $r['qty'].'</td>
            <!-- For Top -->
            <td class="text-center" scope="col" rowspan="1">'. rupiah($r['t_harga']).'</td>
            <td class="text-center" scope="col" rowspan="1">'. rupiah($r['t_total']).'</td>
            <!-- For Leg -->
            <td class="text-center" scope="col" rowspan="1">'. rupiah($r['l_harga']).'</td>
            <td class="text-center" scope="col" rowspan="1">'. rupiah($r['l_total']).'</td>
            <!-- For Cross -->
            <td class="text-center" scope="col" rowspan="1">'. rupiah($r['c_harga']).'</td>
			<td class="text-center" scope="col" rowspan="1">'. rupiah($r['c_total']).'</td>
			<td class="text-center">'. rupiah($r['JmlPembelian']).'</td>
            <!-- For Amount -->
					</tr>
					';
                    }
					// $cuk = mysqli_fetch_assoc($total);

					$text .='
					<tr>
					
						<td colspan="13" style="min-width:50px;" class="text-center">Total</td>
						<td class="text-center">'.rupiah($zJmlPembelian).'</td>
					</tr>';
					
					
					$text .= '<tr>
						<td colspan="14" style="height:40px;">Nb : '.$data['keterangan'].'</td>
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
$mpdf->Output($data['no_po'] .'.pdf', 'I');

?>