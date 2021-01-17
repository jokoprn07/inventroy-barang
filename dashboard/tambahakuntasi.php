<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include "../fungsi.php";
date_default_timezone_set('Asia/Jakarta');

if( isset($_POST['submit']) ){
  if( tambahAkuntasi($_POST) > 0 ){
    echo "<script>alert('Data Berhasil Ditambahkan');
    window.location.href = 'akuntasi.php';
    </script>";
  }else{
    echo "<script>alert('Data Gagal DItambahkan')</script>";
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
                <a  href="formpenjualannonkarton.php"><i class="fa fa-plus-square"></i> Tambah Data Non Karton</a>
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
            <h3 style="margin-left: 20px;"><i class="fas fa-plus-square"></i> Tambah Data Akuntasi</h3>
            <hr>
        </div>
      </div>

        <div class="row">
            <div class="col-md-12">
            <form action="" method="post">
              <div class="form-group col-md-6">
                    <label for="no_po">No PO :</label>
                    <select name="no_po" id="kode_pembelian" data-live-search="true" class="form-control selectpicker" onchange="cek_database()" >
                        <option value="">-- Pilih No PO --</option>
                        <?php 
                          $no_po = mysqli_query($conn, "SELECT * FROM dp_barang");
                        ?>
                        <?php foreach( $no_po as $cst ) : ?>
                        <option value="<?= $cst['kode_pembelian'] ?>"><?= $cst['kode_pembelian'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="nama_barang">Nama Barang :</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="Masukkan Nama Barang" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="nama_suplier">Nama Suplier :</label>
                    <input type="text" name="nama_suplier" id="nama_suplier" class="form-control" placeholder="Masukkan Nama Suplier " autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="code_suplier">Code Suplier :</label>
                    <input type="text" name="kode_suplier" id="kode_suplier" class="form-control" placeholder="Masukkan Kode Suplier" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="satuan">Satuan :</label>
                    <select name="satuan" id="satuan" data-live-search="true" class="form-control">
                        <option value="">-- Pilih Satuan --</option>
                        <option value="PCS">PCS</option>
                        <option value="SET">SET</option>
                        <option value="KG">KG</option>
                        <option value="LITER">LITER</option>
                        <option value="ROLL">ROLL</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="qty">Qty :</label>
                    <input type="text" name="qty" id="qty" class="form-control" placeholder="Masukkan Quantity" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="tanggal_terima">Tanggal Terima :</label>
                    <input type="date" id="tanggal_terima" name="tanggal_terima" class="form-control" placeholder="Masukkan Tanggal Terima" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="tanggal_expired">Tanggal Expired :</label>
                    <input type="date" id="tanggal_expired" name="tanggal_expired" class="form-control" placeholder="Masukkan Tanggal Expired" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="harga_beli">Harga Beli :</label>
                    <input type="number" id="harga_beli" name="harga_beli" class="form-control" placeholder="Masukkan Harga Beli" autocomplete="off">
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary form-control">Tambah Data</button>
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
    function cek_database(){
        var id = $("#kode_pembelian").val();
        $.ajax({
            url: 'autoterima.php',
            data:"kode_pembelian="+id ,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#nama_barang').val(obj.nama_barang);
            $('#satuan').val(obj.satuan);
            $('#nama_suplier').val(obj.nama_suplier);
            $('#tanggal_terima').val(obj.tanggal_pembelian);
            $('#qty').val(obj.qty);
            $('#keterangan').val(obj.keterangan);
            $('#harga_beli').val(obj.harga_beli);
            $('#kode_suplier').val(obj.kode_suplier);
          });
        }
    </script>
</body>
</html>