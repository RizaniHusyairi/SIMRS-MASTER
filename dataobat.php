<?php
session_start();
include "asset/include/koneksi.php";
include "asset/include/fungsi.php";

if(isset($_POST['update'])){
    $id = $_POST['no_obat'];
    $Nobat = $_POST['Nama_obat'];
    $Hobat = $_POST['Harga_obat'];
    $Kobat = $_POST['keterangan_obat'];
    $que = "UPDATE tb_obat SET nama_obat = '$Nobat', harga_obat = '$Hobat' , nama_penyakit = '$Kobat' WHERE id_obat = '$id'";
    update($que);
}
if(isset($_POST['create'])){
    $Nobat = $_POST['Nama_obat'];
    $Hobat = $_POST['Harga_obat'];
    $Kobat = $_POST['keterangan_obat'];
    create('tb_obat(nama_obat,harga_obat,nama_penyakit)',"'$Nobat','$Hobat','$Kobat'");
}
if (isset($_GET['hal'])) {
    $id = $_GET['id'];
    $sql = "UPDATE tb_beliobat SET id_obat = NULL WHERE id_obat = $id";
    update($sql);
    delete('tb_obat','id_obat');
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">


    <!-- my css -->
    <link rel="icon" type="image/png" href="asset/img/logo-hospital.png">
    <link rel="stylesheet" href="asset/css/styleadmin.css">

    <title>Sistem informasi</title>
</head>

<body>
    <div class="menu-bar">
        <input type="checkbox"/>
        <div class="menu-btn_burger"></div>
        <div class="menu-btn_burger"></div>
        <div class="menu-btn_burger"></div>
    </div>
    <div class="sidebar container-fluid bg-white text-info ">
        <div class="sidebar-header text-center">
            <h3><?= $_SESSION['Name']?></h3>
            <small>level: <?= $_SESSION['level']?></small>
            <hr>
        </div>
        <?php
        if($_SESSION['level']=="Admin Apotik"){
            ?>
        <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>
                    <li class="sidebar-item ">
                        <a href="Adminpage.php" class="sidebar-link">
                            <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Daftar Pasien</a>
                    </li>
                    <li class="sidebar-item active">
                        <a href="#" class="sidebar-link"><i class="fas fa-tablets"></i> Data Obat</a>
                    </li>

                </ul>
                <ul class="menu" style="margin-top: 150px;">
                    <li class="sidebar-item  bg-danger"> <a href="logout.php" class="sidebar-link outlog"> <i
                                class="fas fa-sign-out-alt"></i> Log-out </a> </li>
                </ul>
            </div>
        </div>
        <?php 
        }
        if($_SESSION['level']=="Super Admin"){

        ?>
        <!-- MENU SUPER ADMIN -->
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item "> 
                    <a href="Adminpage.php" class="sidebar-link"> 
                        <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Data User </a> 
                </li>
                <li class="sidebar-item"> <a href="datapasien.php" class="sidebar-link"> 
                    <i class="fa fa-address-card pr-2" aria-hidden="true"></i> Data pasien </a> </li>
                <li class="sidebar-item active"> 
                    <a href="#" class="sidebar-link"> <i class="fas fa-tablets"></i> Data Obat </a> 
                </li>
                <li class="sidebar-item"> <a href="jenispoli.php" class="sidebar-link"> <i class="fas fa-person-booth"></i> Data Poli </a> </li>
            </ul>
            <ul class="menu" style="margin-top: 150px;">
                <li class="sidebar-item  bg-danger"> <a href="logout.php" class="sidebar-link outlog"> <i
                            class="fas fa-sign-out-alt"></i> Log-out </a> </li>
            </ul>
        </div>
    </div>
    <?php 
    }
    ?>
        <div class="main">
            <div class="page-heading">
                <div class="page-title">
                    
                    <div class="row">
                        <div class="col-12 col-md-7 order-md-1 order-last">
                            <h4>Sistem Informasi Manajemen Rumah Sakit</h4>
                        </div>
                        <div class="col-12 col-md-5 order-md-2  respon">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Menu</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data obat</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                           Data obat
                        </div>
                        <div class="card-body">
                            <div
                                class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="d-sm-flex justify-content-between">

                                <form class=" flex-grow-1" method="post">
                                            <input type="text" name="search" class="search" size="30"
                                                placeholder="Cari Nama atau nomor obat.." autocomplete="off">
                                            <button type="submit" name="cari"><i class="fa fa-search"
                                                    aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    <span class="badge bg-info add_obat mt-1">
                                        <i class="fas fa-user-plus"></i> Tambah Obat</span>
                                </div>
                                <div class="datatable-container">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>No. Obat</th>
                                                <th>Nama obat</th>
                                                <th>Harga</th>
                                                <th>Keterangan</th>
                                                <th class="text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(isset($_POST['cari'])){
                                                $obat = cari($_POST['search'],"tb_obat",'nama_obat','id_obat');
                                            }else{
                                                $obat = read('tb_obat');
                                            }
                                            
                                            foreach ($obat as $key) {
                                            
                                            
                                            ?>
                                            <tr>
                                                <td><?= $key['id_obat'] ?></td>
                                                <td><?= $key['nama_obat'] ?></td>
                                                <td>Rp<?= $key['harga_obat'] ?></td>
                                                <td><?= $key['nama_penyakit'] ?></td>
                                                
                                                <td class="text-end">
                                                    <div class="d-md-inline-flex flex-row">
                                                    <span class="badge bg-warning edit_obat mb-1"><i
                                                            class="fas fa-user-edit text-white"></i> Ubah</span>
                                                    <span class="badge bg-danger btnhps_poli mb-1 ms-1"><i class="far fa-trash-alt"></i> Hapus</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Rizani Husyairi</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Modal POli -->
        <div class="modal fade" id="Obat_A" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <div class="mb-3" style="display:none">
                                        <input type="text" id="no_obat" name="no_obat" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Nama_obat" class="form-label">Nama obat</label>
                                        <input type="text" class="form-control" name="Nama_obat" id="Nama_obat" placeholder="Masukkan nama obat..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Harga_obat" class="form-label">Harga obat</label>
                                        <input type="text" class="form-control" name="Harga_obat" id="Harga_obat" placeholder="Masukkan Harga obat..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan_obat" class="form-label">Keterangan obat</label>
                                        <textarea type="text" class="form-control" name="keterangan_obat" id="keterangan_obat" placeholder="Masukkan keterangan obat.."></textarea>
                                    </div>
                                    <div class="mb-3 d-flex flex-row-reverse" >
                                        <button type="Submit" id="subs" class="btn btn-primary ms-2" style="width:92px;">Submit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Akhir modal Poli -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ"
            crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="asset/js/script.js"></script>
</body>

</html>
