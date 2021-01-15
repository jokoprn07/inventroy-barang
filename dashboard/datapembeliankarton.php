<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include "../fungsi.php";
date_default_timezone_set('Asia/Jakarta');

$jumlahDataPerHalaman = "10";
$jumlahData = count(query("SELECT * FROM dp_karton"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET['halaman']) ) ? $_GET['halaman'] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

if( isset($_POST['search']) ){
  $barang = cariKarton(mysqli_real_escape_string($conn, $_POST['keyword']));

  if ( $barang == null ){
    $notFound = true;
  }
}
$barang = mysqli_query($conn, "SELECT * FROM dp_karton GROUP BY no_po ASC LIMIT $awalData, $jumlahDataPerHalaman");

function rupiah($angka){
	$hasil = "Rp. " . number_format($angka,0,".",".");
	return $hasil;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="1"> 
    <title>Dashboard | Inventory Barang</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/all.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
</head>
<body>
<!-- Start Nav Atas -->

<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>    
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Welcome Admin</a> 
      </div>
      <div style="color: white;padding: 15px 20px 15px 20px;float: right;font-size: 16px;"> 
        <span style="margin-right:20px"><?php echo date('l, d F, Y'); ?></span>
        <a href="../login/logout.php" class="btn btn-danger square-btn-adjust">Logout</a> 
      </div>
    </nav>   

<!-- End Nav Atas  -->
<!-- Start Side Nav -->

<nav class="navbar-default navbar-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
          <li>
            <a  class="active-menu" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
          </li> 
          <li>
            <a  href="#"><i class="fas fa-shopping-cart"></i> Pembelian<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="datapembelian.php"><i class="fa fa-database"></i> Data Pembelian Non Karton</a>
              </li>
              <<li>
                <a href="datapembeliankarton.php"><i class="fa fa-database"></i> Data Pembelian Karton</a>
              </li>
              <li>
                <a  href="formpembelian.php"><i class="fa fa-plus-square"></i> Tambah Pembelian Non Karton</a>
              </li>
              <li>
                <a  href="formpembeliannonkarton.php"><i class="fa fa-plus-square"></i> Tambah Pembelian Karton</a>
              </li>
            </ul>
          </li>
         <li>
            <a  href="#"><i class="far fa-money-bill-alt"></i> Penjualan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="datapenjualan.php"><i class="fa fa-database"></i> Data Penjualan Non Karton</a>
              </li>
              <li>
                <a  href="datapenjualankarton.php"><i class="fa fa-database"></i> Data Penjualan Karton</a>
              </li>
              <li>
                <a  href="formpenjualan.php"><i class="fa fa-plus-square"></i> Tambah Data Non Karton</a>
              </li>
              <li>
                <a  href="formpenjualankarton.php"><i class="fa fa-plus-square"></i> Tambah Data Karton</a>
              </li>
            </ul>
          </li>
          <li>
            <a  href="#"><i class="fas fa-box-open"></i>  Stock Gudang<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="databarang.php"><i class="fas fa-cube"></i> Data Non Karton</a>
              </li>
              <li>
                <a  href="datakarton.php"><i class="fas fa-box-open"></i> Data Karton</a>
              </li>
              <li>
                <a  href="tambah.php"><i class="fa fa-plus-square"></i> Tambah Data Barang</a>
              </li>
              <li>
                <a  href="tambahkarton.php"><i class="fa fa-plus-square"></i> Tambah Data Karton</a>
              </li>
            </ul>
          </li>
          <li>
            <a  href="#"><i class="fas fa-shopping-cart"></i> Akuntasi<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="akuntasi.php"><i class="fa fa-database"></i> Data Akuntasi Non Karton</a>
              </li>
              <li>
                <a href="akuntasikarton.php"><i class="fa fa-database"></i> Data Akuntasi Karton</a>
              </li>
            </ul>
          </li>
          <li>
            <a  href="#"><i class="fas fa-box-open"></i>  Penerimaan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="penerimaan.php"><i class="fas fa-cube"></i> Penerimaan Barang Non Karton</a>
              </li>
              <li>
                <a  href="penerimaanbarangkarton.php"><i class="fa fa-cube"></i> Penerimaan Barang Karton</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="customer.php"><i class="fas fa-users"></i> Customer</a>
          </li>
          <li>
            <a href="suplier.php"><i class="fas fa-users"></i> Suplier</a>
          </li>
          <li>
            <a  href="#"><i class="fas fa-box-open"></i>  Laporan Balancing<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="barangjadi.php"><i class="fas fa-cube"></i> Barang Jadi</a>
              </li>
              <li>
                <a  href="ms.php"><i class="fa fa-cube"></i> MS</a>
              </li>
              <li>
                <a  href="orderbuyer.php"><i class="fas fa-vr-cardboard"></i> Order Buyer</a>
              </li>
            </ul>
          </li>
          <li>
            <a  href="#"><i class="fas fa-box-open"></i>  Laporan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="laporanpenjualan.php"><i class="fas fa-cube"></i> Penjualan</a>
              </li>
              <li>
                <a  href="laporanpembelian.php"><i class="fa fa-plus-square"></i> Pembelian</a>
              </li>
              <li>
                <a  href="laporankarton.php"><i class="fas fa-vr-cardboard"></i> Karton</a>
              </li>
              <li>
                <a  href="laporanpenerimaan.php"><i class="fas fa-boxes"></i> Penerimaan Barang</a>
              </li>
              <!-- <li>
                <a  href="laporanakuntasi.php"><i class="fas fa-money-bill-alt"></i> Akuntasi</a>
              </li> -->
            </ul>
          </li>
          <li>
            <a  href="#"><i class="fas fa-cog"></i>  Pengaturan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="admin.php"><i class="fas fa-user-cog"></i> Admin</a>
              </li>
              <li>
                <a  href="perusahaan.php"><i class="fa fa-home"></i> Perusahaan</a>
              </li>
            </ul>
          </li>
        </div>      
    </nav>


    <!-- End Side Nav  -->
    
    <div id="page-wrapper">
      <div id="page-inner">

      <div class="row">
        <div class="col-12">
            <h3 style="margin-left: 20px;"><i class="fas fa-cube"></i> Data Pembelian Karton</h3>
            <hr>
        </div>
      </div>

    <form class="form-inline " action="" method="post">
      <input class="form-control" size="50" type="text" name="keyword" id="keyword" placeholder="Cari Berdasarkan Nama Customer, Code Customer & Nama Item" autocomplete="on">
      <button class="btn btn-primary form-control" name="search"><i class="fas fa-search"></i></button>
    </form>

    <br>
    <div id="container">
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th class="text-center" rowspan="2"  style="vertical-align: middle;">No</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">Kode Customer</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">Kode Suplier</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">Tanggal Pembelian</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">No PO</th>
            <th class="text-center" scope="col" rowspan="2"  style="vertical-align: middle;">Aksi</th>
            </tr>
            
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach($barang as $data) : ?>
            <tr class="text-center">
            <td class="text-center"><?= $i++; ?></td>
            <td><?= $data['kode_customer']; ?></td>
            <td><?= $data['kode_suplier']; ?></td>
            <td><?= date("d-M-yy", strtotime($data['tanggal_pembelian'])); ?></td>
            
            <td><?= $data['no_po']; ?></td>
            <td>
            <a href="detailpembeliankarton.php?no_po=<?= $data['no_po']; ?>" ><button class="btn btn-success"><i class="fas fa-info"></i> Detail</button></a> | 
             <a href="../cetakpembeliankarton.php?no_po=<?= $data['no_po']; ?>" target="_blank"><button class="btn btn-success"><i class="fas fa-info"></i> Cetak</button></a>
            </td>
            </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      
<?php if( isset($notFound) ) : ?>
<div class="alert alert-danger text-center">
Tidak Ditemukan
</div>
<?php endif; ?>
      </div>

    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <?php if( $halamanAktif > 1 ) : ?>
          <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a></li>
          <?php endif; ?>

          <?php for( $i= 1; $i <= $jumlahHalaman; $i++ ) : ?>
          <?php if($i == $halamanAktif ) : ?>
          <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?> <span class="sr-only">(current)</span></a></li>
          <?php else : ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
          <?php endif; ?>
          <?php endfor; ?>

          <?php if( $halamanAktif < $jumlahHalaman ) : ?>
          <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a></li>
          <?php endif; ?>
        </ul>
      </nav>


    </div>
    </div>

     <!-- /. WRAPPER  -->
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!--DATA TABLE-->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/jquery-3.4.1.slim.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/script.js"></script>

</body>
</html>