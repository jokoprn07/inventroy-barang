<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include "../fungsi.php";
date_default_timezone_set('Asia/Jakarta');

$id = (int)$_GET["id"];

$barang = query( "SELECT * FROM penerimaan WHERE id = $id")[0];

if( isset($_POST['submit']) ){
  if( editAkuntasi($_POST) > 0 ){
    echo "<script>alert('Data Berhasil Diubah');
    window.location.href = 'akuntasi.php';
    </script>";
  }else{
    echo "<script>alert('Data Gagal Diubah')</script>";
  }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
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
              <li>
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
            <h3 style="margin-left: 20px;"><i class="fas fa-plus-square"></i> Ubah Penerimaan Barang</h3>
            <hr>
        </div>
      </div>

        <div class="row">
            <div class="col-md-12">
            <form action="" method="post">
            <input type="hidden" name="id" id="id" value="<?= $barang['id']; ?>" >
                
                <div class="form-group col-md-6">
                    <label for="nama_barang">Nama Barang :</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Masukkan Nama Barang" autocomplete="off" value="<?= $barang['nama_barang']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="nama_suplier">Nama Suplier :</label>
                    <input type="text" name="nama_suplier" id="nama_suplier" class="form-control" placeholder="Masukkan Nama Suplier " autocomplete="off" value="<?= $barang['nama_suplier']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="kode_suplier">Kode Suplier :</label>
                    <input type="text" name="kode_suplier" id="kode_suplier" class="form-control" placeholder="Masukkan Kode Suplier " autocomplete="off" value="<?= $barang['kode_suplier']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="satuan">Satuan :</label>
                    <select name="satuan" id="satuan" data-live-search="true" class="form-control">
                        <option value="">-- Pilih Satuan --</option>
                        <option value="PCS" <?= $barang['satuan'] == "PCS" ? "selected" : null ?>>PCS</option>
                        <option value="SET" <?= $barang['satuan'] == "SET" ? "selected" : null ?>>SET</option>
                        <option value="KG" <?= $barang['satuan'] == "KG" ? "selected" : null ?>>KG</option>
                        <option value="LITER" <?= $barang['satuan'] == "LITER" ? "selected" : null ?>>LITER</option>
                        <option value="ROLL" <?= $barang['satuan'] == "ROLL" ? "selected" : null ?>>ROLL</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="qty">Qty :</label>
                    <input type="text" name="qty" id="qty" class="form-control" placeholder="Masukkan Quantity" autocomplete="off" value="<?= $barang['qty']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="jumlah_terima">Jumlah Terima :</label>
                    <input type="text" name="jumlah_terima" id="jumlah_terima" class="form-control" placeholder="Masukkan Jumlah Terima" autocomplete="off" value="<?= $barang['jumlah_terima']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="tanggal_terima">Tanggal Terima :</label>
                    <input type="date" id="tanggal_terima" name="tanggal_terima" class="form-control" placeholder="Masukkan Tanggal Terima" autocomplete="off" value="<?= $barang['tanggal_terima']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="tanggal_expired">Tanggal Expired :</label>
                    <input type="date" id="tanggal_expired" name="tanggal_expired" class="form-control" placeholder="Masukkan Tanggal Expired" autocomplete="off" value="<?= $barang['tanggal_expired']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="harga_beli">Harga Beli :</label>
                    <input type="number" id="harga_beli" name="harga_beli" class="form-control" placeholder="Masukkan Harga Beli" autocomplete="off" value="<?= $barang['harga_beli']; ?>">
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary form-control">Edit Data</button>
            </form>
            </div>
        </div>

      </div>
    </div>
     <!-- /. WRAPPER  -->
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!--DATA TABLE-->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script type="text/javascript">

      $('#jumlah_terima').on('keyup', function(){
        var jumlah_terima = $(this).val();
        var qty = $('#qty').val();
        
        if( jumlah_terima > qty ){
          alert('Maaf, Jumlah Terima Terlalu Besar Dari Jumlah Pembelian Barang');
        }

      });
    </script>
</body>
</html>